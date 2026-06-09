<?php
// ========== Testimonials Section ==========
$testimonialsDataFile = __DIR__ . '/../data/testimonials.php';
$testimonials = [];
if (file_exists($testimonialsDataFile)) {
    include $testimonialsDataFile;
}

// Sort by sort_order, then id
if (!empty($testimonials)) {
    usort($testimonials, function ($a, $b) {
        $so = ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0);
        return $so !== 0 ? $so : (($a['id'] ?? 0) <=> ($b['id'] ?? 0));
    });
}
?>

<?php if (!empty($testimonials)): ?>
<!-- ========== Testimonials Section Start ========== -->
<section class=" relative overflow-hidden">

    <!-- Soft decorative blobs matching the brand palette -->
    <div class="pointer-events-none absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary/5 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-32 -right-24 w-[28rem] h-[28rem] rounded-full bg-secondary/10 blur-3xl"></div>

    <div class="container relative z-10">

        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-12 md:mb-16 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
            <span class="inline-flex items-center gap-2 bg-primary/10 text-primary font-semibold text-xs uppercase tracking-[0.2em] mb-5 px-5 py-2 rounded-full">
                <i class="hgi hgi-stroke hgi-quote-up text-base"></i>
                Customer Stories
            </span>
            <h3 class="font-urbanist font-bold text-light-primary-text mb-4">What Art Lovers Are Saying</h3>
            <p class="text-light-secondary-text">Real words from people who brought a piece of India's artistic heritage into their homes.</p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <?php foreach ($testimonials as $index => $t):
                $delay   = (0.2 + ($index * 0.1)) . 's';
                $name    = htmlspecialchars($t['name'] ?? '', ENT_QUOTES);
                $role    = htmlspecialchars(ucfirst($t['designation'] ?? 'Customer'), ENT_QUOTES);
                $content = htmlspecialchars($t['content'] ?? '', ENT_QUOTES);
                $rating  = max(0, min(5, (int)($t['rating'] ?? 5)));
                $img     = !empty($t['image']) ? htmlspecialchars($t['image'], ENT_QUOTES) : '';
                $initial = strtoupper(mb_substr(trim($t['name'] ?? 'K'), 0, 1));
            ?>
            <article
                class="group relative flex flex-col h-full bg-white rounded-3xl p-7 md:p-8 border border-primary/5 shadow-[0_10px_40px_-15px_rgba(85,107,47,0.18)] transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_22px_55px_-18px_rgba(85,107,47,0.30)] wow animate__animated animate__fadeInUp"
                data-wow-delay="<?= $delay ?>">

                <!-- Decorative quote mark -->
                <span class="absolute top-6 right-7 text-primary/10 transition-colors duration-500 group-hover:text-secondary/40">
                    <i class="hgi hgi-stroke hgi-quote-up text-5xl"></i>
                </span>

                <!-- Star Rating -->
                <div class="flex items-center gap-1 mb-5" aria-label="<?= $rating ?> out of 5 stars">
                    <?php for ($s = 1; $s <= 5; $s++): ?>
                        <svg class="w-4 h-4 <?= $s <= $rating ? 'text-secondary' : 'text-gray-200' ?>" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M9.05 2.93c.3-.92 1.6-.92 1.9 0l1.42 4.36a1 1 0 0 0 .95.69h4.58c.97 0 1.37 1.24.59 1.81l-3.71 2.7a1 1 0 0 0-.36 1.12l1.42 4.36c.3.92-.76 1.69-1.54 1.12l-3.71-2.7a1 1 0 0 0-1.18 0l-3.71 2.7c-.78.57-1.84-.2-1.54-1.12l1.42-4.36a1 1 0 0 0-.36-1.12l-3.71-2.7c-.78-.57-.38-1.81.59-1.81h4.58a1 1 0 0 0 .95-.69L9.05 2.93Z"/>
                        </svg>
                    <?php endfor; ?>
                </div>

                <!-- Content -->
                <p class="text-light-secondary-text leading-relaxed mb-7 flex-grow relative z-10">
                    <?= $content ?>
                </p>

                <!-- Author -->
                <div class="flex items-center gap-4 pt-6 border-t border-gray-100 mt-auto">
                    <?php if ($img): ?>
                        <img src="<?= $img ?>" alt="<?= $name ?>"
                            class="w-12 h-12 rounded-full object-cover ring-2 ring-primary/15"
                            onerror="this.onerror=null;this.outerHTML='<div class=&quot;w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-urbanist font-bold text-lg ring-2 ring-primary/15&quot;><?= $initial ?></div>';" />
                    <?php else: ?>
                        <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-urbanist font-bold text-lg ring-2 ring-primary/15">
                            <?= $initial ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <h4 class="font-urbanist font-bold text-light-primary-text leading-tight"><?= $name ?></h4>
                        <p class="text-sm text-light-disabled-text"><?= $role ?></p>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<!-- ========== Testimonials Section End ========== -->
<?php endif; ?>
