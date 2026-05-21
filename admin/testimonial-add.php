<?php
session_start();
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$db = getDB();
$errors = [];
$old = $_POST;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = sanitize($_POST['name'] ?? '');
        if (empty($name)) $errors[] = 'Name is required.';

        $designation = sanitize($_POST['designation'] ?? '');
        $content = $_POST['content'] ?? '';
        if (empty($content)) $errors[] = 'Content is required.';
        $rating = (int)($_POST['rating'] ?? 5);
        $sortOrder = (int)($_POST['sort_order'] ?? 0);

        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = uploadImage($_FILES['image'], __DIR__ . '/../uploads/testimonials', 'test_');
            $image = 'uploads/testimonials/' . basename($image);
        }

        if (empty($errors)) {
            $stmt = $db->prepare("INSERT INTO testimonials (name, designation, content, image, rating, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $designation, $content, $image, $rating, $sortOrder]);

            require_once __DIR__ . '/includes/sync.php';
            syncTestimonials();

            $_SESSION['flash'] = 'Testimonial added successfully!';
            header('Location: testimonials.php');
            exit;
        }
    } catch (Exception $e) {
        $errors[] = 'Error: ' . $e->getMessage();
    }
}
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<div class="page-header">
    <div>
        <h2>Add Testimonial</h2>
        <p>Add a new customer testimonial</p>
    </div>
    <a href="testimonials.php" class="btn-secondary">← Back to Testimonials</a>
</div>

<?php if (!empty($errors)): ?>
    <div class="flash-message flash-error">
        <?php foreach ($errors as $err): ?>
            <div><?= htmlspecialchars($err) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="admin-form">
    <div class="form-section">
        <h3>Testimonial Information</h3>
        <div class="form-row">
            <div class="form-group">
                <label>Name <span class="required">*</span></label>
                <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required placeholder="e.g. Priya Sharma">
            </div>
            <div class="form-group">
                <label>Designation</label>
                <input type="text" name="designation" value="<?= htmlspecialchars($old['designation'] ?? '') ?>" placeholder="e.g. Happy Customer">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5" value="<?= htmlspecialchars($old['rating'] ?? '5') ?>">
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" min="0" value="<?= htmlspecialchars($old['sort_order'] ?? '0') ?>">
            </div>
        </div>
        <div class="form-group">
            <label>Content <span class="required">*</span></label>
            <textarea name="content" rows="5" required><?= htmlspecialchars($old['content'] ?? '') ?></textarea>
        </div>
        <div class="form-group">
            <label>Profile Image</label>
            <div class="file-upload">
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp">
                <div class="upload-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#919eab" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <span>Click to upload profile image</span>
                    <span class="file-hint">JPG, PNG, WebP • Max 5MB</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn-primary">Add Testimonial</button>
        <a href="testimonials.php" class="btn-secondary">Cancel</a>
    </div>
</form>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
