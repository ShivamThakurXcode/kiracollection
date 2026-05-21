<?php
require_once __DIR__ . '/../includes/auth.php';
requireLogin();
$currentAdmin = getCurrentAdmin();
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - KiraCollection Art</title>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Urbanist:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/admin.css">
</head>

<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-logo">
                    <svg width="32" height="32" viewBox="0 0 100 100" fill="none">
                        <circle cx="50" cy="50" r="45" stroke="#ffd700" stroke-width="2" fill="none" />
                        <circle cx="50" cy="50" r="30" stroke="#ffd700" stroke-width="1.5" fill="none" />
                        <circle cx="50" cy="50" r="15" stroke="#ffd700" stroke-width="1" fill="none" />
                        <circle cx="50" cy="50" r="6" fill="#ffd700" />
                        <line x1="50" y1="5" x2="50" y2="20" stroke="#ffd700" stroke-width="1.5" />
                        <line x1="50" y1="80" x2="50" y2="95" stroke="#ffd700" stroke-width="1.5" />
                        <line x1="5" y1="50" x2="20" y2="50" stroke="#ffd700" stroke-width="1.5" />
                        <line x1="80" y1="50" x2="95" y2="50" stroke="#ffd700" stroke-width="1.5" />
                        <line x1="18.2" y1="18.2" x2="28.3" y2="28.3" stroke="#ffd700" stroke-width="1.2" />
                        <line x1="71.7" y1="71.7" x2="81.8" y2="81.8" stroke="#ffd700" stroke-width="1.2" />
                        <line x1="18.2" y1="81.8" x2="28.3" y2="71.7" stroke="#ffd700" stroke-width="1.2" />
                        <line x1="71.7" y1="28.3" x2="81.8" y2="18.2" stroke="#ffd700" stroke-width="1.2" />
                        <path d="M50 5 A45 45 0 0 1 95 50" stroke="#ffd700" stroke-width="0.8" fill="none"
                            opacity="0.4" />
                        <path d="M50 95 A45 45 0 0 1 5 50" stroke="#ffd700" stroke-width="0.8" fill="none"
                            opacity="0.4" />
                    </svg>
                </div>
                <span class="sidebar-title">Kira<span>Collection</span></span>
            </div>

            <nav class="sidebar-nav">
                <a href="index.php" class="nav-item <?= $currentPage === 'index.php' ? 'active' : '' ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="products.php"
                    class="nav-item <?= strpos($currentPage, 'product') !== false ? 'active' : '' ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                        <line x1="12" y1="22.08" x2="12" y2="12" />
                    </svg>
                    <span>Products</span>
                </a>
                <a href="blogs.php" class="nav-item <?= strpos($currentPage, 'blog') !== false ? 'active' : '' ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                        <polyline points="10 9 9 9 8 9" />
                    </svg>
                    <span>Blogs</span>
                </a>
                <a href="contact-messages.php"
                    class="nav-item <?= strpos($currentPage, 'contact') !== false ? 'active' : '' ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        <path d="M8 9h8" />
                        <path d="M8 13h5" />
                    </svg>
                    <span>Contact Messages</span>
                </a>
                <a href="testimonials.php"
                    class="nav-item <?= strpos($currentPage, 'testimonial') !== false ? 'active' : '' ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                    </svg>
                    <span>Testimonials</span>
                </a>
                <div class="nav-divider"></div>
                <a href="profile.php"
                    class="nav-item <?= $currentPage === 'profile.php' ? 'active' : '' ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <span>Profile</span>
                </a>
                <a href="logout.php" class="nav-item logout-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    <span>Logout</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="admin-info">
                    <div class="admin-avatar"><?= strtoupper(substr($currentAdmin['username'] ?? 'A', 0, 1)) ?></div>
                    <div class="admin-details">
                        <span class="admin-name"><?= htmlspecialchars($currentAdmin['name'] ?? $currentAdmin['username'] ?? 'Admin') ?></span>
                        <span class="admin-role">Administrator</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="topbar">
                <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="18" x2="21" y2="18" />
                    </svg>
                </button>
                <div class="topbar-title">
                    <?php
                    $pageTitles = [
                        'index.php' => 'Dashboard',
                        'products.php' => 'Products',
                        'product-add.php' => 'Add Product',
                        'product-edit.php' => 'Edit Product',
                        'blogs.php' => 'Blogs',
                        'blog-add.php' => 'Add Blog',
                        'blog-edit.php' => 'Edit Blog',
                        'contact-messages.php' => 'Contact Messages',
                        'testimonials.php' => 'Testimonials',
                        'testimonial-add.php' => 'Add Testimonial',
                        'testimonial-edit.php' => 'Edit Testimonial',
                        'profile.php' => 'My Profile',
                    ];
                    echo $pageTitles[$currentPage] ?? 'Admin Panel';
                    ?>
                </div>
                <div class="topbar-actions">
                    <a href="../index.php" class="topbar-link" target="_blank">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                            <polyline points="15 3 21 3 21 9" />
                            <line x1="10" y1="14" x2="21" y2="3" />
                        </svg>
                        View Site
                    </a>
                </div>
            </header>

            <div class="content-area">