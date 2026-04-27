<!-- ========== Most Loved Products Section Start ========== -->
<section class="pb-[70px]">
    <div class="container">
        <div class="flex items-center md:justify-between justify-center mb-10">
            <div>
                <h3 class="text-light-primary-text wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">Most Loved Products</h3>
            </div>
            <div class="new-branded-products-multi-vendor-nav md:flex items-center justify-center gap-x-6 hidden wow animate__animated animate__fadeInUp" data-wow-delay="0.2s"></div>
        </div>
        <div class="new-branded-product-multi-vendor-slider-wrapper">
            <div data-slick='{"slidesToShow": 5, "slidesToScroll": 1, "loop": true, "autoplay": true, "autoplaySpeed": 7000, "arrows": true, "infinite": true, "appendArrows": ".new-branded-products-multi-vendor-nav", "responsive": [{"breakpoint": 1441, "settings": {"slidesToShow": 4}}, {"breakpoint": 1025, "settings": {"slidesToShow": 3}}, {"breakpoint": 769, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}' class="new-branded-product-multi-vendor-slider -mx-3 sellzy-slider">
                <?php echo renderProductCards($mostLovedProducts, 'bordered', 'mx-3'); ?>
            </div>
        </div>
    </div>
</section>
<!-- ========== Most Loved Products Section End ========== -->
