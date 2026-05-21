<?php
session_start();
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$db = getDB();
$id = (int)($_GET['id'] ?? 0);
$testimonial = $db->prepare("SELECT * FROM testimonials WHERE id = ?");
$testimonial->execute([$id]);
$testimonial = $testimonial->fetch();

if (!$testimonial) {
    header('Location: testimonials.php');
    exit;
}

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
        $image = $testimonial['image'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = uploadImage($_FILES['image'], __DIR__ . '/../uploads/testimonials', 'test_');
            $image = 'uploads/testimonials/' . basename($image);
        }

        if (empty($errors)) {
            $stmt = $db->prepare("UPDATE testimonials SET name = ?, designation = ?, content = ?, image = ?, rating = ?, sort_order = ? WHERE id = ?");
            $stmt->execute([$name, $designation, $content, $image, $rating, $sortOrder, $id]);

            require_once __DIR__ . '/includes/sync.php';
            syncTestimonials();

            $_SESSION['flash'] = 'Testimonial updated successfully!';
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
        <h2>Edit Testimonial</h2>
        <p>Update customer testimonial</p>
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
                <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? $testimonial['name']) ?>" required>
            </div>
            <div class="form-group">
                <label>Designation</label>
                <input type="text" name="designation" value="<?= htmlspecialchars($old['designation'] ?? $testimonial['designation']) ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5" value="<?= htmlspecialchars($old['rating'] ?? $testimonial['rating']) ?>">
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" min="0" value="<?= htmlspecialchars($old['sort_order'] ?? $testimonial['sort_order']) ?>">
            </div>
        </div>
        <div class="form-group">
            <label>Content <span class="required">*</span></label>
            <textarea name="content" rows="5" required><?= htmlspecialchars($old['content'] ?? $testimonial['content']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Profile Image</label>
            <?php if ($testimonial['image']): ?>
                <div class="current-image">
                    <img src="../<?= htmlspecialchars($testimonial['image']) ?>" alt="Current image">
                </div>
            <?php endif; ?>
            <div class="file-upload">
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp">
                <div class="upload-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#919eab" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <span>Click to upload new image (leave empty to keep current)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn-primary">Update Testimonial</button>
        <a href="testimonials.php" class="btn-secondary">Cancel</a>
    </div>
</form>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
