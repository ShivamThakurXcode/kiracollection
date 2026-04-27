<!-- ========== Blog Section Start ========== -->
<section class="pb-[70px]">
    <div class="container">
        <div class="flex justify-between items-center mb-10 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
            <h3>Latest Blog</h3><a class='text-light-primary-text hover:underline font-bold font-urbanist lg:text-2xl lg:leading-9 text-xl leading-[30px]' href='blog-grid.html'>View All</a>
        </div>
        <div class="grid grid-cols-12 gap-6">
            <?php
            $blogs = [
                ['blog-grid-5.png', 'The Future of Industrial Design'],
                ['blog-grid-6.png', 'The Future of Industrial Design'],
                ['blog-grid-7.png', 'The Future of Industrial Design'],
                ['blog-grid-8.png', 'The Future of Industrial Design']
            ];
            foreach ($blogs as $index => $blog):
                $delay = (0.2 + ($index * 0.1)) . 's';
            ?>
                <div class="md:col-span-6 col-span-12 xl:col-span-3 wow animate__animated animate__fadeInUp" data-wow-delay="<?= $delay ?>">
                    <div class="border border-gray-300 rounded-2xl p-6 hover:transform hover:translate-y-[-5px] hover:transition-all hover:ease-[cubic-bezier(0.02,0.01,0.47,1)] hover:duration-250 transition-all ease-[cubic-bezier(0.02,0.01,0.47,1)] duration-250">
                        <div class="mb-6"><a href='blog-details.html'><img src="assets/images/blog/<?= $blog[0] ?>" alt="blog-1" class="rounded-2xl" /></a></div>
                        <div class="mb-4"><a href="#" class="text-warning-dark bg-[rgba(255,193,7,0.16)] px-2 py-px inline-flex rounded-full text-xs leading-[18px]">Category Name</a></div>
                        <div class="flex divide-x divide-[rgba(145,158,171,0.24)]">
                            <p class="text-light-secondary-text text-sm leading-[22px] inline-flex items-center gap-x-2 pr-4"><span><i class="hgi hgi-stroke hgi-calendar-03 text-base text-light-secondary-text"></i></span><span> 09 Feb 2027</span></p>
                            <p class="text-light-secondary-text text-sm leading-[22px] inline-flex items-center gap-x-2 pl-4"><span><i class="hgi hgi-stroke hgi-chatting-01 text-base text-light-secondary-text"></i></span><span>Comment</span><span>(10)</span></p>
                        </div>
                        <h6 class="mt-4 mb-3 hover:text-primary"><a href='blog-details.html'><?= $blog[1] ?></a></h6>
                        <p class="mb-4">So you have heard about this site or you have been to it, but you cannot figure out.</p>
                        <a class='btn btn-primary btn-large rounded-[60px] group py-2 pl-5 pr-3' href='blog-details.html'>Read More <span class="size-8 bg-white inline-flex items-center justify-center rounded-full rotate-[-40deg] transform group-hover:rotate-0 transition-all duration-300"><i class="hgi hgi-stroke hgi-arrow-right-02 text-xl text-primary-darker"></i></span></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- ========== Blog Section End ========== -->
