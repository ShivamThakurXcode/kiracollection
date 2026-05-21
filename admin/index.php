<?php
session_start();
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/includes/db.php';

$db = getDB();

// Stats
$totalProducts = $db->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalBlogs = $db->query("SELECT COUNT(*) FROM blogs")->fetchColumn();
$lowStock = $db->query("SELECT COUNT(*) FROM products WHERE available > 0 AND available < 10")->fetchColumn();
$totalViews = $db->query("SELECT SUM(views) FROM blogs")->fetchColumn() ?: 0;

$recentProducts = $db->query("SELECT id, name, category, current_price, available FROM products ORDER BY id DESC LIMIT 5")->fetchAll();
$recentBlogs = $db->query("SELECT id, title, category, date, views FROM blogs ORDER BY id DESC LIMIT 5")->fetchAll();
?>
<div class="dashboard">
    <div class="page-header">
        <h2>Dashboard</h2>
        <p>Overview of your KiraCollection store</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon stat-icon-products">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#556b2f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
            </div>
            <div class="stat-info">
                <span class="stat-value"><?= $totalProducts ?></span>
                <span class="stat-label">Total Products</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-blogs">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#daa520" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            </div>
            <div class="stat-info">
                <span class="stat-value"><?= $totalBlogs ?></span>
                <span class="stat-label">Total Blogs</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-stock">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#cb0233" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <div class="stat-info">
                <span class="stat-value"><?= $lowStock ?></span>
                <span class="stat-label">Low Stock Items</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon stat-icon-views">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1890ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </div>
            <div class="stat-info">
                <span class="stat-value"><?= number_format($totalViews) ?></span>
                <span class="stat-label">Blog Views</span>
            </div>
        </div>
    </div>

    <div class="quick-actions">
        <a href="product-add.php" class="quick-action-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New Product
        </a>
        <a href="blog-add.php" class="quick-action-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add New Blog
        </a>
    </div>

    <div class="tables-grid">
        <div class="table-card">
            <div class="table-card-header">
                <h3>Recent Products</h3>
                <a href="products.php" class="view-all">View All</a>
            </div>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentProducts)): ?>
                            <tr><td colspan="5" class="empty-row">No products yet. <a href="product-add.php">Add your first product</a></td></tr>
                        <?php else: ?>
                            <?php foreach ($recentProducts as $p): ?>
                            <tr>
                                <td>#<?= $p['id'] ?></td>
                                <td><a href="product-edit.php?id=<?= $p['id'] ?>" class="table-link"><?= htmlspecialchars($p['name']) ?></a></td>
                                <td><span class="badge badge-cat"><?= htmlspecialchars($p['category']) ?></span></td>
                                <td><?= htmlspecialchars($p['current_price']) ?></td>
                                <td>
                                    <?php if ($p['available'] <= 0): ?>
                                        <span class="status status-out">Out</span>
                                    <?php elseif ($p['available'] < 10): ?>
                                        <span class="status status-low"><?= $p['available'] ?></span>
                                    <?php else: ?>
                                        <span class="status status-ok"><?= $p['available'] ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-card">
            <div class="table-card-header">
                <h3>Recent Blogs</h3>
                <a href="blogs.php" class="view-all">View All</a>
            </div>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentBlogs)): ?>
                            <tr><td colspan="5" class="empty-row">No blogs yet. <a href="blog-add.php">Write your first blog</a></td></tr>
                        <?php else: ?>
                            <?php foreach ($recentBlogs as $b): ?>
                            <tr>
                                <td>#<?= $b['id'] ?></td>
                                <td><a href="blog-edit.php?id=<?= $b['id'] ?>" class="table-link"><?= htmlspecialchars($b['title']) ?></a></td>
                                <td><span class="badge badge-cat"><?= htmlspecialchars($b['category']) ?></span></td>
                                <td><?= htmlspecialchars($b['date']) ?></td>
                                <td><?= number_format($b['views']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
