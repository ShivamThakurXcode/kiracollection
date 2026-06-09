<!-- ========== Products Section Start ========== -->
<?php
 $useDb = false;
 $allProducts = [];

if (file_exists(__DIR__ . '/../admin/includes/db.php') && file_exists(__DIR__ . '/../config/database.php')) {
    try {
        require_once __DIR__ . '/../admin/includes/db.php';
        $db = getDB();
        $allProducts = $db->query("SELECT * FROM products ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
        $useDb = true;
    } catch (Exception $e) {
        $useDb = false;
    }
}

if (!$useDb) {
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
}

 $allProducts = array_values($allProducts);

 $maxDisplay = 10;
 $displayProducts = array_slice($allProducts, 0, $maxDisplay);
?>
<section class="py-16 md:py-24">
    <div class="container">
        <div class="grid 2xl:grid-cols-5 xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
            <?php
            foreach ($displayProducts as $index => $product):
                $delay = (0.2 + ($index * 0.1)) . 's';
                $card = new ProductCard($product, 'white-bg', $delay);
                echo "<div class=''>" . $card->render() . "</div>";
            endforeach;
            ?>
            <?php if (empty($displayProducts)): ?>
                <div class="col-span-full text-center text-light-secondary-text">No products found.</div>
            <?php endif; ?>
        </div>
        <div class="home-four-deal-slider-nav-bottom flex items-center justify-center gap-x-6 mt-7 md:hidden"></div>
    </div>
</section>
<!-- ========== Products Section End ========== -->