<?php include_once 'data/products.php'; ?>

<!-- ========== Category Section Start ========== -->
<section class="py-[70px]">
    <div class="container">
        <div class="md:flex md:justify-between md:items-center mb-10">
            <div class="text-center md:text-left wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h3 class="pb-3">Shop By Art Category</h3>
                <p>Up to 69% discount on handcrafted art pieces 🔥</p>
            </div>
            <div data-wow-delay=".2s" class="home-two-category-slider-nav md:flex items-center justify-between gap-x-6 hidden wow animate__animated animate__fadeInUp"></div>
        </div>
        <div data-slick='{"slidesToShow": 8, "slidesToScroll": 1, "loop": true, "arrows": true, "infinite": true, "appendArrows": ".home-two-category-slider-nav", "autoplay": true, "autoplaySpeed": 7000, "responsive": [{"breakpoint": 1441, "settings": {"slidesToShow": 5}}, {"breakpoint": 1025, "settings": {"slidesToShow": 3}}, {"breakpoint": 769, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}' class="home-two-category-slider -mx-3 sellzy-slider">
            <?php
            foreach ($categoryCards as $index => $category):
                $delay = (0.2 + ($index * 0.1)) . 's';
            ?>
                <div data-wow-delay="<?= $delay ?>" class="mx-3 wow animate__animated animate__fadeInUp">
                    <a href="<?= $category['url'] ?>" class="block">
                        <div class="overflow-hidden rounded-full bg-[#D4E0B5]"><img src="<?= $category['image'] ?>" alt="<?= $category['name'] ?>" class="rounded-full transition-transform duration-300 ease-in-out hover:scale-[1.15]" /></div>
                        <p class="text-center pt-6 font-semibold text-light-primary-text hover:text-primary"><?= $category['name'] ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- ========== Category Section End ========== -->
