<?php
session_start();
require_once __DIR__ . '/includes/db.php';

$db = getDB();

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->execute([$id]);
    require_once __DIR__ . '/includes/sync.php';
    syncBlogs();
    $deleted = true;
}

$search = trim($_GET['search'] ?? '');
$category = $_GET['category'] ?? '';
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 15;
$offset = ($page - 1) * $perPage;

$where = [];
$params = [];

if ($search) {
    $where[] = "(title LIKE ? OR excerpt LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if ($category) {
    $where[] = "category = ?";
    $params[] = $category;
}

$whereClause = $where ? "WHERE " . implode(" AND ", $where) : "";

$countStmt = $db->prepare("SELECT COUNT(*) FROM blogs $whereClause");
$countStmt->execute($params);
$totalBlogs = $countStmt->fetchColumn();
$totalPages = ceil($totalBlogs / $perPage);

$stmt = $db->prepare("SELECT * FROM blogs $whereClause ORDER BY id DESC LIMIT $perPage OFFSET $offset");
$stmt->execute($params);
$blogs = $stmt->fetchAll();

$categories = $db->query("SELECT DISTINCT category FROM blogs ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<div class="page-header">
    <div>
        <h2>Blogs</h2>
        <p><?= $totalBlogs ?> total posts</p>
    </div>
    <a href="blog-add.php" class="btn-primary">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Blog
    </a>
</div>

<?php if (isset($deleted)): ?>
    <div class="flash-message flash-success">Blog deleted successfully. Frontend data synced.</div>
<?php endif; ?>

<div class="filter-bar">
    <form method="GET" class="filter-form">
        <div class="search-box">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#919eab" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" name="search" placeholder="Search by title..." value="<?= htmlspecialchars($search) ?>">
        </div>
        <select name="category" class="filter-select">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= htmlspecialchars($cat) ?>" <?= $category === $cat ? 'selected' : '' ?>><?= htmlspecialchars($cat) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn-filter">Filter</button>
        <?php if ($search || $category): ?>
            <a href="blogs.php" class="btn-clear">Clear</a>
        <?php endif; ?>
    </form>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:50px">ID</th>
                    <th style="width:60px">Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th style="width:120px">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($blogs)): ?>
                    <tr><td colspan="8" class="empty-row">No blog posts found. <a href="blog-add.php">Write your first post</a></td></tr>
                <?php else: ?>
                    <?php foreach ($blogs as $b): ?>
                    <tr>
                        <td>#<?= $b['id'] ?></td>
                        <td>
                            <?php if ($b['image']): ?>
                                <img src="../<?= htmlspecialchars($b['image']) ?>" alt="" class="table-thumb" onerror="this.style.display='none'">
                            <?php endif; ?>
                        </td>
                        <td><a href="blog-edit.php?id=<?= $b['id'] ?>" class="table-link"><?= htmlspecialchars(mb_substr($b['title'], 0, 60)) ?><?= mb_strlen($b['title']) > 60 ? '...' : '' ?></a></td>
                        <td><span class="badge badge-cat"><?= htmlspecialchars($b['category']) ?></span></td>
                        <td><?= htmlspecialchars($b['author'] ?: '-') ?></td>
                        <td><?= htmlspecialchars($b['date']) ?></td>
                        <td><?= number_format($b['views']) ?></td>
                        <td>
                            <div class="action-btns">
                                <a href="blog-edit.php?id=<?= $b['id'] ?>" class="btn-action btn-edit" title="Edit">✎</a>
                                <a href="../blog-details.php?slug=<?= urlencode($b['slug']) ?>" class="btn-action btn-view" target="_blank" title="View">👁</a>
                                <a href="?delete=<?= $b['id'] ?>" class="btn-action btn-delete" onclick="return confirmDelete('Delete blog \'<?= htmlspecialchars(addslashes($b['title'])) ?>\'?')" title="Delete">✕</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>" class="page-link <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
