<?php
session_start();
require_once __DIR__ . '/includes/db.php';

$db = getDB();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
    require_once __DIR__ . '/includes/sync.php';
    syncProducts();
    $deleted = true;
}

// Search & filter
$search = trim($_GET['search'] ?? '');
$category = $_GET['category'] ?? '';
$sort = $_GET['sort'] ?? 'newest';
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 15;
$offset = ($page - 1) * $perPage;

$where = [];
$params = [];

if ($search) {
    $where[] = "(name LIKE ? OR sku LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if ($category) {
    $where[] = "category = ?";
    $params[] = $category;
}

$whereClause = $where ? "WHERE " . implode(" AND ", $where) : "";

$orderMap = [
    'newest' => 'id DESC',
    'oldest' => 'id ASC',
    'name' => 'name ASC',
    'name_desc' => 'name DESC',
    'price' => 'current_price ASC',
    'price_desc' => 'current_price DESC',
];
$orderBy = $orderMap[$sort] ?? 'id DESC';

$countStmt = $db->prepare("SELECT COUNT(*) FROM products $whereClause");
$countStmt->execute($params);
$totalProducts = $countStmt->fetchColumn();
$totalPages = ceil($totalProducts / $perPage);

$stmt = $db->prepare("SELECT * FROM products $whereClause ORDER BY $orderBy LIMIT $perPage OFFSET $offset");
$stmt->execute($params);
$products = $stmt->fetchAll();

$categories = $db->query("SELECT DISTINCT category FROM products ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<div class="page-header">
    <div>
        <h2>Products</h2>
        <p><?= $totalProducts ?> total products</p>
    </div>
    <a href="product-add.php" class="btn-primary">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Product
    </a>
</div>

<?php if (isset($deleted)): ?>
    <div class="flash-message flash-success">Product deleted successfully. Frontend data synced.</div>
<?php endif; ?>

<div class="filter-bar">
    <form method="GET" class="filter-form">
        <div class="search-box">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#919eab" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" name="search" placeholder="Search by name or SKU..." value="<?= htmlspecialchars($search) ?>">
        </div>
        <select name="category" class="filter-select">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= htmlspecialchars($cat) ?>" <?= $category === $cat ? 'selected' : '' ?>><?= htmlspecialchars($cat) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="sort" class="filter-select">
            <option value="newest" <?= $sort === 'newest' ? 'selected' : '' ?>>Newest</option>
            <option value="oldest" <?= $sort === 'oldest' ? 'selected' : '' ?>>Oldest</option>
            <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Name A-Z</option>
            <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : '' ?>>Name Z-A</option>
            <option value="price" <?= $sort === 'price' ? 'selected' : '' ?>>Price Low-High</option>
            <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Price High-Low</option>
        </select>
        <button type="submit" class="btn-filter">Filter</button>
        <?php if ($search || $category): ?>
            <a href="products.php" class="btn-clear">Clear</a>
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
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Stock</th>
                    <th>Rating</th>
                    <th style="width:120px">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                    <tr><td colspan="9" class="empty-row">No products found. <a href="product-add.php">Add your first product</a></td></tr>
                <?php else: ?>
                    <?php foreach ($products as $p): ?>
                    <tr>
                        <td>#<?= $p['id'] ?></td>
                        <td>
                            <?php if ($p['image']): ?>
                                <img src="../<?= htmlspecialchars($p['image']) ?>" alt="" class="table-thumb" onerror="this.style.display='none'">
                            <?php endif; ?>
                        </td>
                        <td><a href="product-edit.php?id=<?= $p['id'] ?>" class="table-link"><?= htmlspecialchars(mb_substr($p['name'], 0, 50)) ?><?= mb_strlen($p['name']) > 50 ? '...' : '' ?></a></td>
                        <td><span class="badge badge-cat"><?= htmlspecialchars($p['category']) ?></span></td>
                        <td><?= htmlspecialchars($p['current_price']) ?></td>
                        <td><?= $p['discount_badge'] ? '<span class="badge badge-discount">' . htmlspecialchars($p['discount_badge']) . '</span>' : '-' ?></td>
                        <td>
                            <?php if ($p['available'] <= 0): ?>
                                <span class="status status-out">Out</span>
                            <?php elseif ($p['available'] < 10): ?>
                                <span class="status status-low"><?= $p['available'] ?></span>
                            <?php else: ?>
                                <span class="status status-ok"><?= $p['available'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= str_repeat('★', (int)$p['rating']) ?><?= $p['rating'] ? number_format($p['rating'], 1) : '-' ?></td>
                        <td>
                            <div class="action-btns">
                                <a href="product-edit.php?id=<?= $p['id'] ?>" class="btn-action btn-edit" title="Edit">✎</a>
                                <a href="?delete=<?= $p['id'] ?>" class="btn-action btn-delete" onclick="return confirmDelete('Delete product \'<?= htmlspecialchars(addslashes($p['name'])) ?>\'? This will also remove all associated sizes, colors, and images.')" title="Delete">✕</a>
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
            <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>&sort=<?= urlencode($sort) ?>" class="page-link <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
