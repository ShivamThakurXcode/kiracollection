<?php
/**
 * Seed Products Script - Inserts all products from data/products.php into the database
 * Run this file once: http://your-site/config/seed-products.php
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/../admin/includes/db.php';

try {
    $db = getDB();

    // Create tables if not exist
    $db->exec("
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

    $db->exec("
        CREATE TABLE IF NOT EXISTS `product_images` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `product_id` INT NOT NULL,
            `image_path` VARCHAR(500) NOT NULL,
            `sort_order` INT DEFAULT 0,
            FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS `product_sizes` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `product_id` INT NOT NULL,
            `size_label` VARCHAR(100) NOT NULL,
            `dimension` VARCHAR(100) DEFAULT '',
            `price_multiplier` DECIMAL(3,1) DEFAULT 1.0,
            FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS `product_colors` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `product_id` INT NOT NULL,
            `color_name` VARCHAR(100) NOT NULL,
            `color_hex` VARCHAR(100) DEFAULT '',
            `color_image` VARCHAR(500) DEFAULT '',
            FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    $db->exec("
        CREATE TABLE IF NOT EXISTS `product_additional_info` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `product_id` INT NOT NULL,
            `info_key` VARCHAR(100) NOT NULL,
            `info_value` VARCHAR(500) DEFAULT '',
            FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    // Load all products
    require_once __DIR__ . '/../data/products.php';

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

    // Remove duplicates by ID
    $unique = [];
    $seen = [];
    foreach ($allProducts as $p) {
        if (!in_array($p['id'], $seen)) {
            $unique[] = $p;
            $seen[] = $p['id'];
        }
    }
    $allProducts = $unique;

    echo "<h2>Seeding " . count($allProducts) . " products...</h2>";

    // Clear existing
    $db->exec("DELETE FROM product_additional_info");
    $db->exec("DELETE FROM product_colors");
    $db->exec("DELETE FROM product_sizes");
    $db->exec("DELETE FROM product_images");
    $db->exec("DELETE FROM products");

    $insertStmt = $db->prepare("
        INSERT INTO products (id, name, category, image, current_price, old_price, discount_percentage, discount_badge, rating, reviews, sold, available, description, materials, dimensions, weight, care_instructions, sku)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $defaultSizes = [
        ['Small', '6" - 8"', 0.6],
        ['Medium', '10" - 14"', 1.0],
        ['Large', '16" - 24"', 1.6],
        ['Extra Large', '30" - 36"', 2.4],
    ];

    $defaultColors = [
        ['Natural White', '#F5F0E8'],
        ['Cream Beige', '#E8D5B7'],
        ['Terracotta', '#C67B5C'],
    ];

    $sizeStmt = $db->prepare("INSERT INTO product_sizes (product_id, size_label, dimension, price_multiplier) VALUES (?, ?, ?, ?)");
    $colorStmt = $db->prepare("INSERT INTO product_colors (product_id, color_name, color_hex) VALUES (?, ?, ?)");

    foreach ($allProducts as $p) {
        $description = $p['description'] ?? 'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.';
        $materials = $p['materials'] ?? 'POP Clay, Mirror Work, Natural Colors';
        $dimensions = $p['dimensions'] ?? '12" x 12" x 1"';
        $weight = $p['weight'] ?? '1.2 kg';
        $care = $p['care_instructions'] ?? 'Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.';
        $sku = $p['sku'] ?? ('SKU-' . str_pad($p['id'], 3, '0', STR_PAD_LEFT));

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
            $p['available'] ?? 0,
            $description,
            $materials,
            $dimensions,
            $weight,
            $care,
            $sku
        ]);

        // Add sizes
        foreach ($defaultSizes as $s) {
            $sizeStmt->execute([$p['id'], $s[0], $s[1], $s[2]]);
        }

        // Add colors
        foreach ($defaultColors as $c) {
            $colorStmt->execute([$p['id'], $c[0], $c[1]]);
        }

        echo "<p>✓ Product #{$p['id']}: {$p['name']}</p>";
    }

    $count = $db->query("SELECT COUNT(*) FROM products")->fetchColumn();
    echo "<h3>Success! {$count} products seeded into database.</h3>";
    echo '<p><a href="../shop.php">Go to Shop Page</a></p>';

} catch (Exception $e) {
    echo "<h3>Error: " . $e->getMessage() . "</h3>";
}
