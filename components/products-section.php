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

function filterProductsByCategory($products, $category)
{
    return array_values(array_filter($products, function ($product) use ($category) {
        return isset($product['category']) && strtolower($product['category']) === strtolower($category);
    }));
}

$maxPerTab = 10;
?>
<section class="pb-[70px]">
    <div class="container">
        <div class="mb-10 text-center">
            <h3 data-wow-delay=".2s" class="pb-6 wow animate__animated animate__fadeInUp">Our Art Collection</h3>
            <div data-wow-delay=".2s"
                class="flex items-center justify-center gap-x-4 wow animate__animated animate__fadeInUp">
                <div class="flex gap-x-4 overflow-x-scroll lg:overflow-x-visible home-two-product-filter">
                    <?php foreach (['all-products' => 'All Art', 'lippan-art' => 'Lippan Art', 'mandala-art' => 'Mandala Art', 'wall-decor' => 'Wall Decor', 'mirrors' => 'Mirror Art', 'home-decor' => 'Home Decor'] as $tabId => $tabName): ?>
                        <button data-tab="<?= $tabId ?>"
                            class="btn btn-default outline btn-large py-2.5 px-[22px] rounded-[55px] <?= ($tabId === 'all-products') ? '' : 'shadow-none' ?>"><?= $tabName ?></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="tab-content" id="deal-tab-content">
            <?php
            $tabProducts = [
                'all-products' => $allProducts,
                'lippan-art' => filterProductsByCategory($allProducts, 'Lippan Art'),
                'mandala-art' => filterProductsByCategory($allProducts, 'Mandala Art'),
                'wall-decor' => filterProductsByCategory($allProducts, 'Wall Decor'),
                'mirrors' => filterProductsByCategory($allProducts, 'Mirror Art'),
                'home-decor' => filterProductsByCategory($allProducts, 'Home Decor')
            ];

            foreach ($tabProducts as $tabId => $products): ?>
                <div class="tab-pane" id="<?= $tabId ?>">
                    <div class="grid 2xl:grid-cols-5 xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
                        <?php
                        $renderProducts = array_slice($products, 0, $maxPerTab);
                        foreach ($renderProducts as $index => $product):
                            $delay = (0.2 + ($index * 0.1)) . 's';
                            $card = new ProductCard($product, 'bordered', $delay);
                            echo "<div class=''>" . $card->render() . "</div>";
                        endforeach;
                        ?>
                        <?php if (empty($renderProducts)): ?>
                            <div class="col-span-full text-center text-light-secondary-text">No products found.</div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="home-four-deal-slider-nav-bottom flex items-center justify-center gap-x-6 mt-7 md:hidden"></div>
    </div>
</section>
<!-- ========== Products Section End ========== -->