<?php
/**
 * KiraCollection - Database Installation Script
 * Run this file ONCE in your browser to set up the database.
 * URL: http://your-site/config/install.php
 */

// Display errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/database.php';

$stepRaw = isset($_GET['step']) ? $_GET['step'] : '1';
$step = $stepRaw === 'complete' ? 'complete' : (int) $stepRaw;
$error = '';
$success = '';

// Try to connect without database first
try {
    $pdo = new PDO("mysql:host=$db_host;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    $error = "Cannot connect to MySQL: " . $e->getMessage();
}

// Get the directory path for includes
$adminIncludesDir = __DIR__ . '/../admin/includes';

function runInstallStep($pdo, $step, $db_name, $db_host, $db_user, $db_pass)
{
    if ($step >= 2) {
        // Create database
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `$db_name`");
    }

    if ($step >= 3) {
        // Create tables
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `admins` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `username` VARCHAR(100) NOT NULL UNIQUE,
                `email` VARCHAR(255) NOT NULL UNIQUE,
                `password_hash` VARCHAR(255) NOT NULL,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `products` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(255) NOT NULL,
                `category` VARCHAR(100) NOT NULL DEFAULT 'Lippan Art',
                `image` VARCHAR(500) DEFAULT '',
                `current_price` VARCHAR(50) DEFAULT '',
                `old_price` VARCHAR(50) DEFAULT '',
                `discount_percentage` VARCHAR(50) DEFAULT '',
                `discount_badge` VARCHAR(50) DEFAULT '',
                `rating` DECIMAL(2,1) DEFAULT 0,
                `reviews` INT DEFAULT 0,
                `sold` INT DEFAULT 0,
                `available` INT DEFAULT 0,
                `description` TEXT,
                `materials` VARCHAR(500) DEFAULT '',
                `dimensions` VARCHAR(200) DEFAULT '',
                `weight` VARCHAR(100) DEFAULT '',
                `care_instructions` TEXT,
                `sku` VARCHAR(100) DEFAULT '',
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `product_images` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `product_id` INT NOT NULL,
                `image_path` VARCHAR(500) NOT NULL,
                `sort_order` INT DEFAULT 0,
                FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `product_sizes` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `product_id` INT NOT NULL,
                `size_label` VARCHAR(100) NOT NULL,
                `dimension` VARCHAR(100) DEFAULT '',
                `price_multiplier` DECIMAL(3,1) DEFAULT 1.0,
                FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `product_colors` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `product_id` INT NOT NULL,
                `color_name` VARCHAR(100) NOT NULL,
                `color_hex` VARCHAR(100) DEFAULT '',
                `color_image` VARCHAR(500) DEFAULT '',
                FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `product_additional_info` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `product_id` INT NOT NULL,
                `info_key` VARCHAR(100) NOT NULL,
                `info_value` VARCHAR(500) DEFAULT '',
                FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `blogs` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `title` VARCHAR(255) NOT NULL,
                `slug` VARCHAR(255) NOT NULL UNIQUE,
                `category` VARCHAR(100) DEFAULT '',
                `category_color` VARCHAR(50) DEFAULT 'primary',
                `image` VARCHAR(500) DEFAULT '',
                `excerpt` TEXT,
                `content` LONGTEXT,
                `meta_title` VARCHAR(255) DEFAULT '',
                `meta_description` TEXT DEFAULT NULL,
                `author` VARCHAR(200) DEFAULT '',
                `author_image` VARCHAR(500) DEFAULT '',
                `date` VARCHAR(50) DEFAULT '',
                `reading_time` VARCHAR(50) DEFAULT '',
                `comments` INT DEFAULT 0,
                `views` INT DEFAULT 0,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS `blog_tags` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `blog_id` INT NOT NULL,
                `tag` VARCHAR(100) NOT NULL,
                FOREIGN KEY (`blog_id`) REFERENCES `blogs`(`id`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $pdo->exec("
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

        $pdo->exec("
                CREATE TABLE IF NOT EXISTS `contact_messages` (
                    `id` INT AUTO_INCREMENT PRIMARY KEY,
                    `first_name` VARCHAR(100) NOT NULL,
                    `last_name` VARCHAR(100) NOT NULL,
                    `email` VARCHAR(255) NOT NULL,
                    `phone` VARCHAR(50) DEFAULT NULL,
                    `subject` VARCHAR(255) NOT NULL,
                    `message` TEXT NOT NULL,
                    `status` VARCHAR(30) NOT NULL DEFAULT 'new',
                    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            ");
    }

    if ($step >= 4) {
        // Import existing products
        require_once __DIR__ . '/../data/products.php';

        // Check if products already exist
        $count = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
        if ($count == 0) {
            $allProducts = array_merge(
                $homeFourPicksProducts ?? [],
                $topRateProducts ?? [],
                $topItemsProducts ?? [],
                $categoryPromoProducts ?? [],
                $mostLovedProducts ?? [],
                $productsSectionProducts ?? [],
                $limitedTimeProducts ?? [],
                $favouriteCategoryProducts ?? []
            );

            $insertStmt = $pdo->prepare("
                INSERT INTO products (id, name, category, image, current_price, old_price, discount_percentage, discount_badge, rating, reviews, sold, available)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            foreach ($allProducts as $p) {
                try {
                    $insertStmt->execute([
                        $p['id'],
                        $p['name'],
                        $p['category'],
                        $p['image'],
                        $p['current_price'],
                        $p['old_price'] ?? '',
                        $p['discount_percentage'] ?? '',
                        $p['discount_badge'] ?? '',
                        $p['rating'] ?? 0,
                        $p['reviews'] ?? 0,
                        $p['sold'] ?? 0,
                        $p['available'] ?? 0
                    ]);

                    // Add default size options for each product
                    $sizeStmt = $pdo->prepare("INSERT INTO product_sizes (product_id, size_label, dimension, price_multiplier) VALUES (?, ?, ?, ?)");
                    $defaultSizes = [
                        ['Small', '6\" - 8\"', 0.6],
                        ['Medium', '10\" - 14\"', 1.0],
                        ['Large', '16\" - 24\"', 1.6],
                        ['Extra Large', '30\" - 36\"', 2.4],
                    ];
                    foreach ($defaultSizes as $s) {
                        $sizeStmt->execute([$p['id'], $s[0], $s[1], $s[2]]);
                    }

                    // Add default color options
                    $colorStmt = $pdo->prepare("INSERT INTO product_colors (product_id, color_name, color_hex) VALUES (?, ?, ?)");
                    $defaultColors = [
                        ['Natural White', '#F5F0E8'],
                        ['Cream Beige', '#E8D5B7'],
                        ['Terracotta', '#C67B5C'],
                    ];
                    foreach ($defaultColors as $c) {
                        $colorStmt->execute([$p['id'], $c[0], $c[1]]);
                    }
                } catch (PDOException $e) {
                    // Skip duplicates
                }
            }

            // Update product details for each product
            $detailStmt = $pdo->prepare("UPDATE products SET description = ?, materials = ?, dimensions = ?, weight = ?, care_instructions = ?, sku = ? WHERE id = ?");
            foreach ($allProducts as $p) {
                $detailStmt->execute([
                    'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.',
                    'POP Clay, Mirror Work, Natural Colors',
                    '12" x 12" x 1"',
                    '1.2 kg',
                    'Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.',
                    'SKU-' . str_pad($p['id'], 3, '0', STR_PAD_LEFT),
                    $p['id']
                ]);
            }
        }
    }

    if ($step >= 5) {
        // Import existing blogs
        require_once __DIR__ . '/../data/blogs.php';

        $count = $pdo->query("SELECT COUNT(*) FROM blogs")->fetchColumn();
        if ($count == 0 && isset($blogs)) {
            $insertStmt = $pdo->prepare("
                INSERT INTO blogs (id, title, slug, category, category_color, image, excerpt, content, author, author_image, date, reading_time, comments, views)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $tagStmt = $pdo->prepare("INSERT INTO blog_tags (blog_id, tag) VALUES (?, ?)");

            foreach ($blogs as $b) {
                try {
                    $insertStmt->execute([
                        $b['id'],
                        $b['title'],
                        $b['slug'],
                        $b['category'],
                        $b['category_color'] ?? 'primary',
                        $b['image'],
                        $b['excerpt'],
                        $b['content'],
                        $b['author'] ?? 'KiraCollection',
                        $b['author_image'] ?? '',
                        $b['date'],
                        $b['reading_time'] ?? '',
                        $b['comments'] ?? 0,
                        $b['views'] ?? 0
                    ]);

                    if (isset($b['tags']) && is_array($b['tags'])) {
                        foreach ($b['tags'] as $tag) {
                            $tagStmt->execute([$b['id'], $tag]);
                        }
                    }
                } catch (PDOException $e) {
                    // Skip duplicates
                }
            }
        }
    }

    if ($step >= 6) {
        // Import testimonials
        $count = $pdo->query("SELECT COUNT(*) FROM testimonials")->fetchColumn();
        if ($count == 0) {
            $testimonials = [
                ['name' => 'Priya Sharma', 'designation' => 'Home Decor Enthusiast', 'content' => 'Absolutely love the lippan art mirror frame! The craftsmanship is exquisite and it adds such a warm, traditional touch to my living room. Highly recommend KiraCollection for authentic handmade art.', 'image' => 'assets/images/testimonials/user-1.svg', 'rating' => 5, 'sort_order' => 1],
                ['name' => 'Rahul Verma', 'designation' => 'Interior Designer', 'content' => 'I have been sourcing mandala art pieces for my clients and KiraCollection never disappoints. The attention to detail and quality of materials is outstanding. Every piece tells a story.', 'image' => 'assets/images/testimonials/user-2.svg', 'rating' => 5, 'sort_order' => 2],
                ['name' => 'Ananya Gupta', 'designation' => 'Art Collector', 'content' => 'The dot mandala decor piece I ordered exceeded my expectations. The colors are vibrant, the finish is perfect, and it arrived beautifully packaged. Will definitely order again!', 'image' => 'assets/images/testimonials/user-3.svg', 'rating' => 5, 'sort_order' => 3],
                ['name' => 'Vikram Singh', 'designation' => 'Happy Customer', 'content' => 'Bought a lippan wall panel as a housewarming gift and it was a huge hit! Everyone admired the intricate mirror work and the earthy tones. Great customer service too.', 'image' => 'assets/images/testimonials/user-4.svg', 'rating' => 5, 'sort_order' => 4],
                ['name' => 'Neha Patel', 'designation' => 'Art Lover', 'content' => 'KiraCollection is my go-to for unique home decor. The mandala clocks are stunning and become conversation starters in my home. Proud to support Indian artisans!', 'image' => 'assets/images/testimonials/user-5.svg', 'rating' => 5, 'sort_order' => 5],
            ];
            $insertStmt = $pdo->prepare("INSERT INTO testimonials (name, designation, content, image, rating, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($testimonials as $t) {
                $insertStmt->execute([$t['name'], $t['designation'], $t['content'], $t['image'], $t['rating'], $t['sort_order']]);
            }
        }
    }

    if ($step >= 7) {
        // Create default admin
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins");
        $stmt->execute();
        $adminCount = $stmt->fetchColumn();

        if ($adminCount == 0) {
            $passwordHash = password_hash('admin123', PASSWORD_BCRYPT);
            $insertAdmin = $pdo->prepare("INSERT INTO admins (username, email, password_hash) VALUES (?, ?, ?)");
            $insertAdmin->execute(['admin', 'admin@kiracollection.com', $passwordHash]);
        }
    }

    return true;
}

// Process steps
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['install'])) {
    try {
        $targetStep = (int) $_POST['install'];
        runInstallStep($pdo, $targetStep, $db_name, $db_host, $db_user, $db_pass);

        // If all steps done, sync frontend files and show completion
        if ($targetStep >= 6) {
            require_once __DIR__ . '/../admin/includes/sync.php';
            syncProducts();
            syncBlogs();
            syncTestimonials();
            // Redirect to final step to show completion via GET
            header('Location: install.php?step=complete');
            exit;
        } else {
            // Redirect to the next step to show via GET
            $nextStep = $targetStep + 1;
            header("Location: install.php?step=$nextStep");
            exit;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation - KiraCollection Admin</title>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Urbanist:wght@600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #fffbeb;
            color: #212529;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 680px;
            width: 100%;
        }

        .card {
            background: #fff;
            border-radius: 24px;
            padding: 48px;
            box-shadow: 0 24px 48px rgba(145, 158, 171, 0.12);
            border: 1px solid #dfe3e8;
        }

        .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo h1 {
            font-family: 'Urbanist', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: #556b2f;
        }

        .logo span {
            color: #daa520;
        }

        .logo p {
            color: #495057;
            font-size: 14px;
            margin-top: 4px;
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 32px;
            position: relative;
        }

        .step-indicator::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #dfe3e8;
            transform: translateY(-50%);
            z-index: 0;
        }

        .step-dot {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #dfe3e8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            color: #919eab;
            position: relative;
            z-index: 1;
            border: 3px solid #fff;
        }

        .step-dot.active {
            background: #556b2f;
            color: #fff;
        }

        .step-dot.completed {
            background: #a8d5a8;
            color: #fff;
        }

        .step-label {
            font-size: 11px;
            text-align: center;
            margin-top: 6px;
            color: #919eab;
            position: absolute;
            width: 80px;
            left: 50%;
            transform: translateX(-50%);
        }

        .step-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        h2 {
            font-family: 'Urbanist', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #212529;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #495057;
            font-size: 14px;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .info-box {
            background: #e8f5e8;
            border: 1px solid #a8d5a8;
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 13px;
            color: #3d5a1f;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .info-box strong {
            color: #556b2f;
        }

        .alert-error {
            background: #fcd1ca;
            border: 1px solid #ef6168;
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 14px;
            color: #ae013c;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #e9fcd4;
            border: 1px solid #aaf27f;
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 14px;
            color: #229a16;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            border-radius: 60px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: #556b2f;
            color: #fff;
        }

        .btn-primary:hover {
            background: #3d5a1f;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #ffd700;
            color: #212529;
        }

        .btn-secondary:hover {
            background: #daa520;
            transform: translateY(-1px);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .config-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .config-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #f4f6f8;
        }

        .config-table td:first-child {
            font-weight: 600;
            color: #495057;
            width: 140px;
        }

        .config-table td:last-child {
            color: #212529;
            font-family: monospace;
        }

        .success-icon {
            text-align: center;
            margin-bottom: 16px;
        }

        .success-icon span {
            font-size: 64px;
            line-height: 1;
        }

        .admin-creds {
            background: #fff7cd;
            border: 1px solid #ffe16a;
            border-radius: 12px;
            padding: 16px 20px;
            margin-top: 16px;
        }

        .admin-creds p {
            font-size: 13px;
            color: #b78103;
        }

        .admin-creds code {
            background: rgba(255, 193, 7, 0.2);
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 13px;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #919eab;
        }

        @media (max-width: 600px) {
            .card {
                padding: 24px;
            }

            .step-label {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="logo">
                <h1>Kira<span>Collection</span></h1>
                <p>Admin Panel Installation</p>
            </div>

            <?php if ($error): ?>
                <div class="alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <?php if ($error && strpos($error, 'Cannot connect') !== false): ?>
                <div class="info-box">
                    <strong>Cannot connect to MySQL.</strong><br>
                    Please make sure MySQL is running and update the credentials in <code>config/database.php</code>.
                </div>
                <table class="config-table">
                    <tr>
                        <td>Host</td>
                        <td><?= htmlspecialchars($db_host) ?></td>
                    </tr>
                    <tr>
                        <td>Database</td>
                        <td><?= htmlspecialchars($db_name) ?></td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td><?= htmlspecialchars($db_user) ?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><?= $db_pass ? '****' : '(empty)' ?></td>
                    </tr>
                </table>
                <div class="actions">
                    <a href="install.php" class="btn btn-primary">Retry</a>
                </div>
                <?php exit; ?>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="actions">
                    <a href="install.php" class="btn btn-primary">Retry Installation</a>
                </div>
                <?php exit; ?>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="actions">
                    <a href="install.php" class="btn btn-primary">Retry Installation</a>
                </div>
                <?php exit; ?>
            <?php endif; ?>

            <!-- Step Progress -->
            <?php if (is_int($step)): ?>
                <div class="step-indicator">
                    <div class="step-wrapper">
                        <div class="step-dot <?= $step >= 2 ? ($step > 2 ? 'completed' : 'active') : '' ?>">1</div>
                        <div class="step-label">Connect</div>
                    </div>
                    <div class="step-wrapper">
                        <div class="step-dot <?= $step >= 3 ? ($step > 3 ? 'completed' : 'active') : '' ?>">2</div>
                        <div class="step-label">Tables</div>
                    </div>
                    <div class="step-wrapper">
                        <div class="step-dot <?= $step >= 4 ? ($step > 4 ? 'completed' : 'active') : '' ?>">3</div>
                        <div class="step-label">Products</div>
                    </div>
                    <div class="step-wrapper">
                        <div class="step-dot <?= $step >= 5 ? ($step > 5 ? 'completed' : 'active') : '' ?>">4</div>
                        <div class="step-label">Blogs</div>
                    </div>
                    <div class="step-wrapper">
                        <div class="step-dot <?= $step >= 6 ? ($step >= 6 ? 'active' : '') : '' ?>">5</div>
                        <div class="step-label">Admin</div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Step Content -->
            <?php if ($step === 1): ?>
                <h2>Welcome to Installation</h2>
                <p class="subtitle">This script will set up the MySQL database for KiraCollection admin panel. It will
                    create all required tables and import existing data.</p>

                <div class="info-box">
                    <strong>Before you begin:</strong><br>
                    • Make sure MySQL server is running on <code><?= htmlspecialchars($db_host) ?></code><br>
                    • Verify credentials in <code>config/database.php</code><br>
                    • This will <strong>not</strong> overwrite existing data if already installed
                </div>

                <table class="config-table">
                    <tr>
                        <td>MySQL Host</td>
                        <td><?= htmlspecialchars($db_host) ?></td>
                    </tr>
                    <tr>
                        <td>Database Name</td>
                        <td><?= htmlspecialchars($db_name) ?></td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td><?= htmlspecialchars($db_user) ?></td>
                    </tr>
                </table>

                <form method="POST">
                    <div class="actions">
                        <button type="submit" name="install" value="2" class="btn btn-primary">Start Installation →</button>
                    </div>
                </form>

            <?php elseif ($step === 2): ?>
                <?php runInstallStep($pdo, 2, $db_name, $db_host, $db_user, $db_pass); ?>
                <h2>Step 1: Database Created ✓</h2>
                <p class="subtitle">Database <code><?= htmlspecialchars($db_name) ?></code> has been created.</p>
                <div class="info-box">Next step: Create all required database tables.</div>
                <form method="POST">
                    <div class="actions">
                        <button type="submit" name="install" value="3" class="btn btn-primary">Create Tables →</button>
                    </div>
                </form>

            <?php elseif ($step === 3): ?>
                <?php runInstallStep($pdo, 3, $db_name, $db_host, $db_user, $db_pass); ?>
                <h2>Step 2: Tables Created ✓</h2>
                <p class="subtitle">All 8 database tables have been created successfully:</p>
                <div class="info-box">
                    <strong>Tables created:</strong> admins, products, product_images, product_sizes, product_colors,
                    product_additional_info, blogs, blog_tags, testimonials
                </div>
                <form method="POST">
                    <div class="actions">
                        <button type="submit" name="install" value="4" class="btn btn-primary">Import Products →</button>
                    </div>
                </form>

            <?php elseif ($step === 4): ?>
                <?php runInstallStep($pdo, 4, $db_name, $db_host, $db_user, $db_pass); ?>
                <h2>Step 3: Products Imported ✓</h2>
                <p class="subtitle">All existing products have been imported into the database.</p>
                <div class="info-box">
                    <strong>Products imported:</strong>
                    <?php
                    $countPdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
                    echo $countPdo->query("SELECT COUNT(*) FROM products")->fetchColumn() . ' products';
                    ?>
                    with sizes, colors, and additional info.
                </div>
                <form method="POST">
                    <div class="actions">
                        <button type="submit" name="install" value="5" class="btn btn-primary">Import Blogs →</button>
                    </div>
                </form>

            <?php elseif ($step === 5): ?>
                <?php runInstallStep($pdo, 5, $db_name, $db_host, $db_user, $db_pass); ?>
                <h2>Step 4: Blogs Imported ✓</h2>
                <p class="subtitle">All existing blog posts have been imported into the database.</p>
                <div class="info-box">
                    <strong>Blogs imported:</strong>
                    <?php
                    $countPdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
                    echo $countPdo->query("SELECT COUNT(*) FROM blogs")->fetchColumn() . ' blog posts';
                    ?>
                    with tags and categories.
                </div>
                <form method="POST">
                    <div class="actions">
                        <button type="submit" name="install" value="6" class="btn btn-primary">Create Admin →</button>
                    </div>
                </form>

            <?php elseif ($step === 'complete'): ?>
                <?php
                $countPdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
                $prodCount = $countPdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
                $blogCount = $countPdo->query("SELECT COUNT(*) FROM blogs")->fetchColumn();
                ?>
                <div class="success-icon"><span>✅</span></div>
                <h2 style="text-align:center;">Installation Complete!</h2>
                <p class="subtitle" style="text-align:center;">Your database is set up with <?= $prodCount ?> products and
                    <?= $blogCount ?> blog posts.</p>

                <div class="admin-creds">
                    <p><strong>Default Admin Credentials:</strong></p>
                    <p>Username: <code>admin</code></p>
                    <p>Password: <code>admin123</code></p>
                    <p style="margin-top:8px;font-size:12px;">⚠ Change these after first login.</p>
                </div>

                <div class="actions">
                    <a href="../admin/login.php" class="btn btn-primary">Go to Admin Login →</a>
                    <a href="install.php?step=1" class="btn btn-secondary"
                        style="background:#dfe3e8;color:#495057;">Re-install</a>
                </div>
                <p style="text-align:center;margin-top:16px;">
                    <a href="../index.php" style="color:#556b2f;font-size:14px;">← Back to Website</a>
                </p>

            <?php endif; ?>
        </div>
        <div class="footer-text">
            KiraCollection Art Admin Panel &bull; Installation Script
        </div>
    </div>
</body>

</html>