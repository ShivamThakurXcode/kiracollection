<?php
require_once __DIR__ . '/../admin/includes/db.php';
header('Content-Type: application/json');

$q = trim($_GET['q'] ?? '');
if (strlen($q) < 2) {
    echo json_encode([]);
    exit;
}

try {
    $db = getDB();
    $stmt = $db->prepare("SELECT id, name, image, current_price, old_price, discount_percentage, slug FROM products WHERE name LIKE ? LIMIT 12");
    $stmt->execute(["%$q%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ensure image paths are set
    foreach ($results as &$product) {
        if (empty($product['image'])) {
            $product['image'] = 'assets/images/default-product.png';
        }
    }
    unset($product);

    echo json_encode($results);
} catch (Exception $e) {
    // Fallback to flat-file products when DB is unavailable
    require_once __DIR__ . '/../data/products.php';
    $allProducts = array_merge(
        $homeFourPicksProducts ?? [],
        $topRateProducts ?? [],
        $topItemsProducts ?? [],
        $categoryPromoProducts ?? [],
        $mostLovedProducts ?? [],
        $productsSectionProducts ?? [],
        $limitedTimeProducts ?? [],
        $favouriteCategoryProducts ?? [],
        $newArrivalsProducts ?? []
    );

    $results = [];
    $needle = strtolower($q);
    foreach ($allProducts as $product) {
        $name = strtolower($product['name'] ?? '');
        if ($name !== '' && strpos($name, $needle) !== false) {
            $results[] = [
                'id' => $product['id'] ?? 0,
                'name' => $product['name'] ?? '',
                'image' => $product['image'] ?? 'assets/images/default-product.png',
                'current_price' => $product['current_price'] ?? '',
                'old_price' => $product['old_price'] ?? '',
                'discount_percentage' => $product['discount_percentage'] ?? '',
                'slug' => $product['slug'] ?? '',
            ];
            if (count($results) >= 12) {
                break;
            }
        }
    }
    

    echo json_encode($results);
}
