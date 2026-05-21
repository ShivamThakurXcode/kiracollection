<?php
// Dynamic blog grid component - uses data from admin panel
if (!isset($blogs)) {
    include_once __DIR__ . '/../data/blogs.php';
}
if (!function_exists('renderBlogCard')) {
    include_once __DIR__ . '/BlogCard.php';
}

$show_sorting = isset($show_sorting) ? $show_sorting : true;
$filtered_blogs = isset($filtered_blogs) ? $filtered_blogs : $blogs;
$current_category = isset($current_category) ? $current_category : '';
$sort = isset($sort) ? $sort : 'newest';
?>
<!-- ========== Blog Grid Section Start ========== -->
<div class="pb-12">
  <div class="container">
    <div class="grid grid-cols-12 gap-6">
      <div class="xl:col-span-9 col-span-12">
        <?php if ($show_sorting): ?>
        <div class="flex items-center justify-between mb-12 wow animate__animated animate__fadeInUp"
          data-wow-delay="0.2s">
          <div class="flex items-center gap-x-4">
            <a class='w-10 h-10 rounded-full inline-flex items-center justify-center btn btn-default outline shadow-none cursor-pointer' href='blog.php'>
              <span class="inline-flex items-center justify-center">
                <i class="hgi hgi-stroke hgi-left-to-right-list-bullet text-2xl leading-6 text-light-primary-text"></i>
              </span>
            </a>
            <a href="#" class="w-10 h-10 rounded-full inline-flex items-center justify-center btn-primary cursor-pointer">
              <span class="inline-flex items-center justify-center"><i class="hgi hgi-stroke hgi-more-01 text-2xl leading-6 text-white"></i></span>
            </a>
          </div>
          <div class="relative min-w-[100px]">
            <select id="sorting" class="filter-select label" onchange="window.location.href='blog.php?sort='+this.value">
              <option value="newest" <?= $sort === 'newest' ? 'selected' : '' ?>>Newest First</option>
              <option value="oldest" <?= $sort === 'oldest' ? 'selected' : '' ?>>Oldest First</option>
              <option value="most-viewed" <?= $sort === 'most-viewed' ? 'selected' : '' ?>>Most Viewed</option>
              <option value="most-commented" <?= $sort === 'most-commented' ? 'selected' : '' ?>>Most Commented</option>
              <option value="a-z-order" <?= $sort === 'a-z-order' ? 'selected' : '' ?>>A-Z Order</option>
              <option value="z-a-order" <?= $sort === 'z-a-order' ? 'selected' : '' ?>>Z-A Order</option>
            </select>
            <label for="sorting" class="nice-select-label">Sorting</label>
          </div>
        </div>
        <?php endif; ?>

        <?php if (empty($filtered_blogs)): ?>
          <div class="text-center py-12">
            <p class="text-light-secondary-text text-lg">No blog posts found.</p>
            <a href="blog.php" class="btn btn-primary btn-large rounded-[60px] mt-4 inline-block">View All Blogs</a>
          </div>
        <?php else: ?>
          <div class="grid grid-cols-12 gap-6 pb-12">
            <?php foreach ($filtered_blogs as $index => $blog):
              $delay = (0.2 + (($index % 6) * 0.1)) . 's';
            ?>
              <div class="col-span-12 md:col-span-6 lg:col-span-4 wow animate__animated animate__fadeInUp" data-wow-delay="<?= $delay ?>">
                <?php renderBlogCard($blog, $delay, true); ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!-- ========== Blog Grid Section End ========== -->
