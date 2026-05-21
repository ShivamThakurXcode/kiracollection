<!-- ========== Blog Section Start ========== -->
<?php
include_once 'data/blogs.php';
include 'components/BlogCard.php';

// Get latest 4 blogs for home page
$latest_blogs = array_slice($blogs, 0, 4);
?>
<section class="pb-[70px]">
    <div class="container">
        <div class="grid grid-cols-12 gap-6">
            <?php if (!empty($latest_blogs)): ?>
                <?php
                foreach ($latest_blogs as $index => $blog):
                    $delay = (0.2 + ($index * 0.1)) . 's';
                ?>
                    <div class="md:col-span-6 col-span-12 xl:col-span-3 wow animate__animated animate__fadeInUp" data-wow-delay="<?= $delay ?>">
                        <?php renderBlogCardSimple($blog, $delay); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- ========== Blog Section End ========== -->
