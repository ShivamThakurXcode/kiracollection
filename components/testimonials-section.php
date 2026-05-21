<?php
$testimonialsDataFile = __DIR__ . '/../data/testimonials.php';
$testimonials = [];
if (file_exists($testimonialsDataFile)) {
    include $testimonialsDataFile;
}
?>
<!-- ========== Testimonials Section Start ========== -->
<section class="py-28 md:py-32 my-10 bg-primary">
    <div class="container">
        <div class="py-8 text-center wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
            <span
                class="inline-block text-secondary font-semibold text-sm uppercase tracking-widest mb-2">Testimonials</span>
            <h3 class="text-3xl md:text-4xl font-bold font-urbanist text-white">What Our Customers Say</h3>
            <p class="text-white mt-2 max-w-2xl mx-auto">Hear from our happy customers about their experience with
                KiraCollection</p>
        </div>
        <?php if (!empty($testimonials)): ?>
            <div class="sellzy-slider testimonials-slider"
                data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "arrows": true, "dots": false, "autoplay": true, "autoplaySpeed": 4000, "responsive": [{"breakpoint": 1025, "settings": {"slidesToShow": 2}}, {"breakpoint": 769, "settings": {"slidesToShow": 1}}]}'>
                <?php foreach ($testimonials as $t): ?>
                    <?php
                    $rating = (int) ($t['rating'] ?? 0);
                    if ($rating < 0) {
                        $rating = 0;
                    } elseif ($rating > 5) {
                        $rating = 5;
                    }
                    ?>
                    <div class="px-3 py-4 h-full flex">
                        <div
                            class="testimonial-card bg-white rounded-2xl p-8 border border-gray-300 w-full flex flex-col hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center gap-x-1 mb-4">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i
                                        class="hgi hgi-stroke hgi-star <?= $i <= $rating ? 'text-secondary' : 'text-gray-300' ?> text-lg"></i>
                                <?php endfor; ?>
                            </div>
                            <p
                                class="text-light-secondary-text text-sm leading-relaxed flex-grow mt-2 mb-6 italic line-clamp-4">
                                "<?= htmlspecialchars($t['content']) ?>"
                            </p>
                            <div class="flex items-center gap-x-4 pt-4 border-t border-gray-200">
                                <div class="size-12 rounded-full overflow-hidden bg-primary-lighter flex-shrink-0">
                                    <?php if (!empty($t['image'])): ?>
                                        <img src="<?= htmlspecialchars($t['image']) ?>" alt="<?= htmlspecialchars($t['name']) ?>"
                                            class="w-full h-full object-cover" onerror="this.style.display='none'">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <h6 class="text-sm font-semibold text-light-primary-text">
                                        <?= htmlspecialchars($t['name']) ?>
                                    </h6>
                                    <?php if (!empty($t['designation'])): ?>
                                        <p class="text-xs text-light-secondary-text"><?= htmlspecialchars($t['designation']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-light-secondary-text">Testimonials coming soon!</p>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- ========== Testimonials Section End ========== -->