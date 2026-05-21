<?php
session_start();
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$db = getDB();
$errors = [];
$success = false;

$adminId = $_SESSION['admin_id'] ?? 0;
$stmt = $db->prepare("SELECT id, username, email, name FROM admins WHERE id = ?");
$stmt->execute([$adminId]);
$admin = $stmt->fetch();

if (!$admin) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $name = sanitize($_POST['name'] ?? '');
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (empty($username)) $errors[] = 'Username is required.';
    if (empty($email)) $errors[] = 'Email is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format.';

    $check = $db->prepare("SELECT id FROM admins WHERE (username = ? OR email = ?) AND id != ?");
    $check->execute([$username, $email, $adminId]);
    if ($check->fetch()) $errors[] = 'Username or email already taken.';

    if (!empty($newPassword) || !empty($confirmPassword)) {
        $stmt = $db->prepare("SELECT password_hash FROM admins WHERE id = ?");
        $stmt->execute([$adminId]);
        $row = $stmt->fetch();

        if (empty($currentPassword)) {
            $errors[] = 'Current password is required to set a new password.';
        } elseif (!password_verify($currentPassword, $row['password_hash'])) {
            $errors[] = 'Current password is incorrect.';
        }

        if (strlen($newPassword) < 6) $errors[] = 'New password must be at least 6 characters.';
        if ($newPassword !== $confirmPassword) $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        $db->beginTransaction();
        try {
            $updateStmt = $db->prepare("UPDATE admins SET username = ?, email = ?, name = ? WHERE id = ?");
            $updateStmt->execute([$username, $email, $name ?: null, $adminId]);

            if (!empty($newPassword)) {
                $hash = password_hash($newPassword, PASSWORD_DEFAULT);
                $pwStmt = $db->prepare("UPDATE admins SET password_hash = ? WHERE id = ?");
                $pwStmt->execute([$hash, $adminId]);
            }

            $db->commit();

            $_SESSION['admin_username'] = $username;
            $_SESSION['admin_email'] = $email;

            $success = true;
            $_SESSION['flash'] = 'Profile updated successfully!';

            $admin['username'] = $username;
            $admin['email'] = $email;
            $admin['name'] = $name;
        } catch (Exception $e) {
            $db->rollBack();
            $errors[] = 'Error: ' . $e->getMessage();
        }
    }
}
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<div class="page-header">
    <div>
        <h2>My Profile</h2>
        <p>Update your account information and password</p>
    </div>
</div>

<?php if ($success): ?>
    <div class="flash-message flash-success">Profile updated successfully!</div>
<?php endif; ?>
<?php if (!empty($errors)): ?>
    <div class="flash-message flash-error">
        <?php foreach ($errors as $err): ?>
            <div><?= htmlspecialchars($err) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" class="admin-form">
    <div class="form-section">
        <h3>Account Information</h3>
        <p class="section-desc">Update your personal details and login credentials</p>
        <div class="form-row">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($admin['name'] ?? '') ?>" placeholder="Your full name">
            </div>
            <div class="form-group">
                <label>Username <span class="required">*</span></label>
                <input type="text" name="username" value="<?= htmlspecialchars($admin['username']) ?>" required placeholder="Login username">
            </div>
        </div>
        <div class="form-group">
            <label>Email Address <span class="required">*</span></label>
            <input type="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>" required placeholder="your@email.com">
        </div>
    </div>

    <div class="form-section">
        <h3>Change Password</h3>
        <p class="section-desc">Leave blank if you don't want to change your password</p>
        <div class="form-group">
            <label>Current Password</label>
            <input type="password" name="current_password" placeholder="Enter current password">
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" placeholder="Min. 6 characters" minlength="6">
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" placeholder="Re-enter new password">
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Save Changes</button>
    </div>
</form>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
