<!-- ========== Blog Section Start ========== -->
<?php
include_once 'data/blogs.php';
include 'components/BlogCard.php';

// Get latest 4 blogs for home page
$latest_blogs = array_slice($blogs, 0, 4);
?>
<section class="pb-[70px]">
    <div class="container">
        <?php if (!empty($latest_blogs)): ?>
        <div class="md:flex md:justify-between md:items-end mb-10">
          <div class="wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
            <h3 class="mb-2">From Our Art Journal</h3>
            <p class="text-light-secondary-text">Stories, techniques, and inspiration from our artisans</p>
          </div>
          <a href="blog.php" class="btn btn-primary rounded-[60px] py-2 px-6 text-sm mt-4 md:mt-0 wow animate__animated animate__fadeInUp inline-block" data-wow-delay=".3s">
            View All Posts
          </a>
        </div>
        <?php endif; ?>
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
