<?php
session_start();
require_once __DIR__ . '/includes/db.php';
$db = getDB();

// Ensure testimonials table exists
try {
    $db->query("SELECT 1 FROM testimonials LIMIT 1");
} catch (PDOException $e) {
    $db->exec("
        CREATE TABLE IF NOT EXISTS `testimonials` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `name` VARCHAR(200) NOT NULL,
            `designation` VARCHAR(200) DEFAULT '',
            `content` TEXT NOT NULL,
            `image` VARCHAR(500) DEFAULT '',
            `rating` INT DEFAULT 5,
            `is_active` TINYINT(1) DEFAULT 1,
            `sort_order` INT DEFAULT 0,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $db->prepare("DELETE FROM testimonials WHERE id = ?")->execute([$id]);
    require_once __DIR__ . '/includes/sync.php';
    syncTestimonials();
    $_SESSION['flash'] = 'Testimonial deleted successfully!';
    header('Location: testimonials.php');
    exit;
}

// Toggle active
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $current = $db->query("SELECT is_active FROM testimonials WHERE id = $id")->fetchColumn();
    $new = $current ? 0 : 1;
    $db->prepare("UPDATE testimonials SET is_active = ? WHERE id = ?")->execute([$new, $id]);
    require_once __DIR__ . '/includes/sync.php';
    syncTestimonials();
    $_SESSION['flash'] = 'Testimonial status updated!';
    header('Location: testimonials.php');
    exit;
}

$stmt = $db->query("SELECT * FROM testimonials ORDER BY sort_order ASC, id ASC");
$testimonials = $stmt->fetchAll();
$flash = $_SESSION['flash'] ?? '';
unset($_SESSION['flash']);
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<div class="page-header">
    <div>
        <h2>Testimonials</h2>
        <p>Manage customer testimonials</p>
    </div>
    <a href="testimonial-add.php" class="btn-primary">+ Add Testimonial</a>
</div>

<?php if ($flash): ?>
    <div class="flash-message flash-success"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>

<div class="table-card">
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($testimonials)): ?>
                    <tr>
                        <td colspan="6" class="empty-row">No testimonials found. <a href="testimonial-add.php">Add one now</a></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($testimonials as $t): ?>
                        <tr>
                            <td>
                                <div class="flex items-center gap-x-3">
                                    <?php if ($t['image']): ?>
                                        <img src="../<?= htmlspecialchars($t['image']) ?>" class="table-thumb" style="width:36px;height:36px;border-radius:50%;object-fit:cover">
                                    <?php endif; ?>
                                    <span class="font-medium"><?= htmlspecialchars($t['name']) ?></span>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($t['designation'] ?? '') ?></td>
                            <td>
                                <span style="color:#ffd700;"><?= str_repeat('★', $t['rating']) . str_repeat('☆', 5 - $t['rating']) ?></span>
                            </td>
                            <td>
                                <a href="?toggle=<?= $t['id'] ?>" class="status <?= $t['is_active'] ? 'status-ok' : 'status-low' ?>">
                                    <?= $t['is_active'] ? 'Active' : 'Inactive' ?>
                                </a>
                            </td>
                            <td><?= $t['sort_order'] ?></td>
                            <td>
                                <div class="action-btns">
                                    <a href="testimonial-edit.php?id=<?= $t['id'] ?>" class="btn-action btn-edit" title="Edit">✎</a>
                                    <a href="?delete=<?= $t['id'] ?>" class="btn-action btn-delete" title="Delete" onclick="return confirm('Delete this testimonial?')">✕</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
