<!-- ========== Favourite Category Section Start ========== -->
<section class="pb-[70px]">
    <div class="container">
        <div class="md:flex md:justify-between md:items-center mb-10">
            <div class="text-center md:text-left wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h3>Category Favorites</h3>
            </div>
            <div class="flex items-center gap-x-5">
                <div data-wow-delay=".2s" class="home-two-category-promo-slider-nav md:flex items-center justify-between gap-x-6 hidden wow animate__animated animate__fadeInUp"></div>
            </div>
        </div>
        <div data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "loop": true, "arrows": true, "infinite": true, "appendArrows": ".home-two-category-promo-slider-nav", "autoplay": true, "autoplaySpeed": 7000, "responsive": [{"breakpoint": 1441, "settings": {"slidesToShow": 4}}, {"breakpoint": 1025, "settings": {"slidesToShow": 3}}, {"breakpoint": 769, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}' class="home-two-category-promo-slider -mx-3 sellzy-slider">
            <?php
            $promoCategories = [
                ['Traditional Lippan Art', '45 Products', 'promo-1.png', 'bg-primary-light'],
                ['Sacred Mandala Designs', '68 Products', 'promo-2.png', 'bg-[#84A9FF]'],
                ['Wall Art Decor', '52 Products', 'promo-bg-1.jpg', 'bg-[#74CAFF]'],
                ['Mirror Art Pieces', '38 Products', 'promo-bg-2.jpg', 'bg-warning-light'],
                ['Home Decor Collection', '75 Products', 'promo-bg-3.jpg', 'bg-[#84A9FF]']
            ];
            foreach ($promoCategories as $index => $promo):
                $delay = (0.2 + ($index * 0.1)) . 's';
                $bgStyle = strpos($promo[3], 'bg-') === 0 ? $promo[3] : "bg-[{$promo[3]}]";
            ?>
                <div data-wow-delay="<?= $delay ?>" class="mx-3 wow animate__animated animate__fadeInUp">
                    <div class="flex flex-col justify-end text-center min-h-[520px] rounded-2xl bg-[url(assets/images/home-2/<?= $promo[2] ?>)] bg-left bg-cover bg-no-repeat relative overflow-hidden">
                        <div class="py-10 <?= $bgStyle ?> rounded-b-2xl relative z-10">
                            <h4 class="pb-2 text-xl font-bold"><?= $promo[0] ?></h4>
                            <p class="text-gray-900 font-semibold"><?= $promo[1] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- ========== Favourite Category Section End ========== -->
