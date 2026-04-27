<!-- ========== Limited Time Section Start ========== -->
<section class="mb-[70px]">
    <div class="w-full relative bg-primary">
        <div class="container py-12">
            <div class="flex flex-col md:flex-row items-center justify-between mb-8">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <h3 data-wow-delay=".2s" class="wow animate__animated animate__fadeInUp mb-2 text-white">Limited Time Deals</h3>
                    <p data-wow-delay=".2s" class="wow animate__animated animate__fadeInUp text-white">Up to 69% discount for limited time 🔥</p>
                </div>
                <div data-wow-delay=".2s" class="wow animate__animated animate__fadeInUp flex items-center"><a class='btn btn-primary bg-white text-primary-darker font-semibold btn-large rounded-[60px] text-sm leading-6 group py-1.5 pl-3 pr-2' href='shop-left-sidebar-3col.html'>View All Products <span class="size-8 bg-primary inline-flex items-center justify-center rounded-full rotate-[-40deg] transform group-hover:rotate-0 transition-all duration-300"><i class="hgi hgi-stroke hgi-arrow-right-02 text-xl text-primary-lighter"></i></span></a></div>
            </div>
            <div class="grid grid-cols-12 gap-x-6 gap-y-6">
                <div class="bg-white rounded-[32px] pt-8 pb-12 xl:col-span-4 col-span-12 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <div class="mb-3"><img alt="product-1" class="max-w-[512px] w-full xl:max-h-[361px] h-full bg-cover mx-auto rounded-2xl" src="assets/images/home-2/product-image-21.png" /></div>
                    <div class="text-center px-15">
                        <h3 class="mb-4">Stay Fit. Stay Healthy.</h3>
                        <p class="text-light-primary-text mb-4">Discover Vitamins, Supplements, Skincare & Immunity Boosters — All in One Place.</p><a href="#" class="btn btn-primary btn-large rounded-[60px] group py-2 pl-5 pr-3">Explore Wellness <span class="size-8 bg-white inline-flex items-center justify-center rounded-full rotate-[-40deg] transform group-hover:rotate-0 transition-all duration-300"><i class="hgi hgi-stroke hgi-arrow-right-02 text-xl text-primary-darker"></i></span></a>
                    </div>
                </div>
                <div class="xl:col-span-4 col-span-12 lg:col-span-6 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <div class="flex items-center justify-between pb-6 mb-7 border-b border-[rgba(145,158,171,0.24)]">
                        <h4>Top Rate</h4>
                        <div class="home-one-top-rate-slider-nav md:flex items-center justify-between gap-x-6 hidden"></div>
                    </div>
                    <div data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "arrows": true, "autoplay": true, "autoplaySpeed": 7000, "rows": 3, "loop": true, "appendArrows": ".home-one-top-rate-slider-nav"}' class="home-one-top-rate-slider -mx-3 sellzy-slider">
                        <?php foreach (array_slice($productsSectionProducts, 0, 6) as $product): ?>
                            <div class="p-3">
                                <div class="p-4 bg-white rounded-2xl flex items-center flex-col md:flex-row gap-4">
                                    <a class='md:size-32 size-full flex-none rounded-2xl bg-[#FFEFF6]' href='product-details.html'><img src="<?= $product['image'] ?>" alt="product-1" class="w-full h-full object-cover rounded-2xl" /></a>
                                    <div class="flex-1 flex flex-col gap-y-[15px]">
                                        <p class="font-semibold text-light-primary-text hover:text-primary transition-colors duration-300"><a href='product-details.html'><?= $product['name'] ?></a></p>
                                        <div class="flex justify-between">
                                            <div class="flex flex-col gap-y-[15px]">
                                                <div class="rating-section flex items-center">
                                                    <div class="bg-[url('../images/star-icon.png')] w-[90px] h-4.5 bg-repeat-x overflow-hidden bg-position-[0_0]">
                                                        <div style="width: 80%" class="bg-[url('../images/star-icon.png')] h-4.5 bg-repeat-x bg-position-[0_-18px]"></div>
                                                    </div><span class="text-sm leading-[22px] font-normal inline-block ml-1"><?= $product['reviews'] ?></span>
                                                </div>
                                                <div class="price-section flex items-center gap-x-3"><span class="current-price font-semibold text-light-primary-text"><?= $product['currentPrice'] ?></span><span class="old-price text-sm leading-[22px] font-normal text-light-disabled-text line-through"><?= $product['oldPrice'] ?></span></div>
                                            </div>
                                            <div class="flex items-end"><a class='btn btn-primary btn-large rounded-[100px] group py-2.5 px-[22px]' href='cart-single-vendor.html'><i class="hgi hgi-stroke hgi-shopping-cart-02 text-xl text-white"></i> Add</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="xl:col-span-4 col-span-12 lg:col-span-6 wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                    <div class="flex items-center justify-between pb-6 mb-7 border-b border-[rgba(145,158,171,0.24)]">
                        <h4>Top Items</h4>
                        <div class="home-one-top-items-slider-nav md:flex items-center justify-between gap-x-6 hidden"></div>
                    </div>
                    <div data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "arrows": true, "autoplay": true, "autoplaySpeed": 7000, "rows": 3, "loop": true, "appendArrows": ".home-one-top-items-slider-nav"}' class="home-one-top-items-slider -mx-3 sellzy-slider">
                        <?php foreach (array_slice($productsSectionProducts, 3, 6) as $product): ?>
                            <div class="p-3">
                                <div class="p-4 bg-white rounded-2xl flex items-center flex-col md:flex-row gap-4">
                                    <a class='md:size-32 size-full flex-none rounded-2xl bg-[#FFEFF6]' href='product-details.html'><img src="<?= $product['image'] ?>" alt="product-1" class="w-full h-full object-cover rounded-2xl" /></a>
                                    <div class="flex-1 flex flex-col gap-y-[15px]">
                                        <p class="font-semibold text-light-primary-text hover:text-primary transition-colors duration-300"><a href='product-details.html'><?= $product['name'] ?></a></p>
                                        <div class="flex justify-between">
                                            <div class="flex flex-col gap-y-[15px]">
                                                <div class="rating-section flex items-center">
                                                    <div class="bg-[url('../images/star-icon.png')] w-[90px] h-4.5 bg-repeat-x overflow-hidden bg-position-[0_0]">
                                                        <div style="width: 80%" class="bg-[url('../images/star-icon.png')] h-4.5 bg-repeat-x bg-position-[0_-18px]"></div>
                                                    </div><span class="text-sm leading-[22px] font-normal inline-block ml-1"><?= $product['reviews'] ?></span>
                                                </div>
                                                <div class="price-section flex items-center gap-x-3"><span class="current-price font-semibold text-light-primary-text"><?= $product['currentPrice'] ?></span><span class="old-price text-sm leading-[22px] font-normal text-light-disabled-text line-through"><?= $product['oldPrice'] ?></span></div>
                                            </div>
                                            <div class="flex items-end"><a class='btn btn-primary btn-large rounded-[100px] group py-2.5 px-[22px]' href='cart-single-vendor.html'><i class="hgi hgi-stroke hgi-shopping-cart-02 text-xl text-white"></i> Add</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========== Limited Time Section End ========== -->
