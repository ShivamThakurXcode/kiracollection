<!-- ========== Favourite Category Section Start ========== -->
<section class="pb-[70px]">
    <div class="container">
        <div class="md:flex md:justify-between md:items-center mb-10">
            <div class="text-center md:text-left wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h3>Browse by Collection</h3>
            </div>
            <div class="flex items-center gap-x-5">
                <div data-wow-delay=".2s"
                    class="home-two-category-promo-slider-nav md:flex items-center justify-between gap-x-6 hidden wow animate__animated animate__fadeInUp">
                </div>
            </div>
        </div>
        <div data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "loop": true, "arrows": true, "infinite": true, "appendArrows": ".home-two-category-promo-slider-nav", "autoplay": true, "autoplaySpeed": 7000, "responsive": [{"breakpoint": 1441, "settings": {"slidesToShow": 4}}, {"breakpoint": 1025, "settings": {"slidesToShow": 3}}, {"breakpoint": 769, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'
            class="home-two-category-promo-slider -mx-3 sellzy-slider">
            <?php
            $promoCategories = [
                ['Lippan Art', 'Clay & Mirror Masterpieces', 'p-1.jpeg', 'bg-primary'],
                ['Mandala Art', 'Sacred Geometry Designs', 'p-2.png', 'bg-primary'],
                ['Wall Decor', 'Statement Wall Pieces', 'p-3.jpeg', 'bg-primary'],
                ['Mirror Art', 'Reflective Handcrafted Frames', 'p-4.png', 'bg-primary'],
                ['Home Decor', 'Artisan Home Accents', 'p-5.jpeg', 'bg-primary']
            ];
            foreach ($promoCategories as $index => $promo):
                $delay = (0.2 + ($index * 0.1)) . 's';
                $bgStyle = strpos($promo[3], 'bg-') === 0 ? $promo[3] : "bg-[{$promo[3]}]";
                ?>
                <div data-wow-delay="<?= $delay ?>" class="mx-3 wow animate__animated animate__fadeInUp">
                    <div class="rounded-2xl overflow-hidden border border-gray-300 bg-white">
                        <div class="p-4 bg-[#f4f6f8] flex items-center justify-center">
                            <img src="images/product/<?= $promo[2] ?>" alt="<?= $promo[0] ?>"
                                class="h-48 w-48 object-contain">
                        </div>
                        <div class="py-6 px-4 text-center <?= $bgStyle ?>">
                            <h4 class="text-white pb-2 text-xl font-bold"><?= $promo[0] ?></h4>
                            <p class="text-white font-semibold"><?= $promo[1] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- ========== Favourite Category Section End ========== -->