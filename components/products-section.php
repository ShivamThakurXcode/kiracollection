<!-- ========== Products Section Start ========== -->
<section class="pb-[70px]">
    <div class="container">
        <div class="mb-10 text-center">
            <h3 data-wow-delay=".2s" class="pb-6 wow animate__animated animate__fadeInUp">Our Art Collection</h3>
            <div data-wow-delay=".2s" class="flex items-center justify-center gap-x-4 wow animate__animated animate__fadeInUp">
                <div class="flex gap-x-4 overflow-x-scroll lg:overflow-x-visible home-two-product-filter">
                    <?php foreach (['all-products' => 'All Art', 'lippan-art' => 'Lippan Art', 'mandala-art' => 'Mandala Art', 'wall-decor' => 'Wall Decor', 'mirrors' => 'Mirror Art', 'home-decor' => 'Home Decor'] as $tabId => $tabName): ?>
                        <button data-tab="<?= $tabId ?>" class="btn btn-default outline btn-large py-2.5 px-[22px] rounded-[55px] <?= ($tabId === 'all-products') ? '' : 'shadow-none' ?>"><?= $tabName ?></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="tab-content" id="deal-tab-content">
            <?php
            $tabProducts = [
                'all-products' => $productsSectionProducts,
                'lippan-art' => $productsSectionProducts,
                'mandala-art' => $productsSectionProducts,
                'wall-decor' => $productsSectionProducts,
                'mirrors' => $productsSectionProducts,
                'home-decor' => $productsSectionProducts
            ];

            foreach ($tabProducts as $tabId => $products): ?>
                <div class="tab-pane" id="<?= $tabId ?>">
                    <div class="grid 2xl:grid-cols-5 xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
                        <?php
                        foreach ($products as $index => $product):
                            $delay = (0.2 + ($index * 0.1)) . 's';
                            $card = new ProductCard($product, 'bordered', $delay);
                            echo "<div class=''>" . $card->render() . "</div>";
                        endforeach;
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="home-four-deal-slider-nav-bottom flex items-center justify-center gap-x-6 mt-7 md:hidden"></div>
    </div>
</section>
<!-- ========== Products Section End ========== -->
