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
        <!-- simplified: showing only reviews -->
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
                        <div class="testimonial-card bg-white rounded-2xl p-6 border border-gray-200 w-full flex flex-col hover:shadow transition-shadow duration-300">
                            <p class="text-gray-800 text-sm leading-relaxed flex-grow mt-2 mb-4 italic">
                                "<?= htmlspecialchars($t['content']) ?>"
                            </p>
                            <div class="pt-2">
                                <h6 class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($t['name']) ?></h6>
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