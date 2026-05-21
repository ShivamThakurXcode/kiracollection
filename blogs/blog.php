<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog - KiraCollection Art</title>
  <?php
  include 'components/links.php';
  include 'components/BlogCard.php';
  include_once 'data/blogs.php';

  // Filter blogs by category if specified
  $current_category = isset($_GET['category']) ? $_GET['category'] : '';
  $filtered_blogs = $current_category ? array_filter($blogs, function ($blog) use ($current_category) {
    return strtolower($blog['category']) === strtolower($current_category);
  }) : $blogs;

  // Reset array keys after filtering
  $filtered_blogs = array_values($filtered_blogs);

  // Sorting
  $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
  if ($sort === 'oldest') {
    $filtered_blogs = array_reverse($filtered_blogs);
  } elseif ($sort === 'most-viewed') {
    usort($filtered_blogs, function ($a, $b) {
      return $b['views'] - $a['views'];
    });
  } elseif ($sort === 'most-commented') {
    usort($filtered_blogs, function ($a, $b) {
      return $b['comments'] - $a['comments'];
    });
  } elseif ($sort === 'a-z-order') {
    usort($filtered_blogs, function ($a, $b) {
      return strcmp($a['title'], $b['title']);
    });
  } elseif ($sort === 'z-a-order') {
    usort($filtered_blogs, function ($a, $b) {
      return strcmp($b['title'], $a['title']);
    });
  }
  ?>
</head>

<body>


  <?php include 'components/modal-overlay.php' ?>

  <?php include 'components/scroll-to-top-button.php' ?>

  <?php include 'components/sidebar.php' ?>

  <?php include 'components/cart-sidebar-inline.php' ?>

  <?php include 'components/register-sidebar.php' ?>

  <?php include 'components/login-sidebar.php' ?>

  <?php include 'components/forgot-password-sidebar.php' ?>

  <?php include 'components/otp-verification-sidebar.php' ?>

  <?php include 'components/quick-view-sidebar.php' ?>

  <?php include "components/header.php" ?>

  <!-- Breadcrumb Section -->
  <?php include 'components/breadcrumb.php' ?>

  <!-- Blog Grid Section -->
  <div class="pb-12 pt-8">
    <div class="container">
      <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
          <div class="flex items-center justify-between mb-12 wow animate__animated animate__fadeInUp"
            data-wow-delay="0.2s">
            <div class="flex items-center gap-x-4">
              <a class='w-10 h-10 rounded-full inline-flex items-center justify-center btn btn-default outline shadow-none cursor-pointer'
                href='blog.php'>
                <span class="inline-flex items-center justify-center">
                  <i
                    class="hgi hgi-stroke hgi-left-to-right-list-bullet text-2xl leading-6 text-light-primary-text"></i>
                </span>
              </a>
              <a href="#"
                class="w-10 h-10 rounded-full inline-flex items-center justify-center btn-primary cursor-pointer">
                <span class="inline-flex items-center justify-center"><i
                    class="hgi hgi-stroke hgi-more-01 text-2xl leading-6 text-white"></i></span>
              </a>
            </div>
            <!-- sorting -->
            <div class="relative min-w-[100px]">
              <select id="sorting" class="filter-select label"
                onchange="window.location.href='blog.php?category=<?= urlencode($current_category) ?>&sort='+this.value">
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

          <?php if ($current_category): ?>
            <div class="mb-6 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
              <p class="text-light-secondary-text">Showing results for: <strong
                  class="text-primary"><?= htmlspecialchars($current_category) ?></strong>
                <a href="blog.php" class="text-primary hover:underline ml-2">(Clear filter)</a>
              </p>
            </div>
          <?php endif; ?>

          <?php if (empty($filtered_blogs)): ?>
            <div class="text-center py-12 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
              <p class="text-light-secondary-text text-lg">No blog posts found for this category.</p>
              <a href="blog.php" class="btn btn-primary btn-large rounded-[60px] mt-4 inline-block">View All Blogs</a>
            </div>
          <?php else: ?>
            <div class="grid grid-cols-12 gap-6 pb-12">
              <?php
              foreach ($filtered_blogs as $index => $blog):
                $delay = (0.2 + (($index % 6) * 0.1)) . 's';
                $colSpan = '';
                $colSpan = 'col-span-12 md:col-span-6 lg:col-span-4';
                ?>
                <div class="<?= $colSpan ?>">
                  <?php renderBlogCard($blog, $delay, true); ?>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- pagination -->
          <?php if (!empty($filtered_blogs)): ?>
            <div data-wow-delay="0.2s" class="grid grid-cols-12 wow animate__animated animate__fadeInUp">
              <div class="col-span-12">
                <ul class="flex items-center justify-center gap-x-1.5 blog-pagination">
                  <li class="group blog-pagination-item">
                    <a href="#"
                      class="inline-flex items-center justify-center md:size-10 size-9 rounded-[50px] bg-white cursor-pointer border border-gray-300 group-hover:font-semibold group-hover:border-primary group-hover:bg-[rgba(0,171,85,0.08)] transition-colors duration-300 ease-in-out">
                      <span class="inline-flex items-center justify-center">
                        <i
                          class="hgi hgi-stroke hgi-arrow-left-01 text-[20px] group-hover:font-semibold leading-5 text-light-primary-text group-hover:text-primary"></i></span>
                    </a>
                  </li>
                  <li class="group blog-pagination-item">
                    <a href="#" class="inline-flex items-center justify-center md:size-10 size-9 rounded-[50px] active">
                      1
                    </a>
                  </li>
                  <li class="group blog-pagination-item">
                    <a href="#"
                      class="inline-flex items-center justify-center md:size-10 size-9 rounded-[50px] text-base leading-6 text-light-primary-text group-hover:text-primary group-hover:font-semibold bg-white cursor-pointer border border-gray-300 group-hover:border-primary group-hover:bg-[rgba(0,171,85,0.08)] transition-colors duration-300 ease-in-out">
                      2
                    </a>
                  </li>
                  <li class="group blog-pagination-item">
                    <a href="#"
                      class="inline-flex items-center justify-center md:size-10 size-9 rounded-[50px] text-base leading-6 text-light-primary-text group-hover:text-primary group-hover:font-semibold bg-white cursor-pointer border border-gray-300 group-hover:border-primary group-hover:bg-[rgba(0,171,85,0.08)] transition-colors duration-300 ease-in-out">
                      3
                    </a>
                  </li>
                  <li class="blog-pagination-item">
                    <a href="#" class="inline-flex items-center justify-center md:size-10 size-9 rounded-[50px] bg-white">
                      <span class="inline-flex items-center justify-center">
                        <i
                          class="hgi hgi-stroke hgi-more-horizontal text-[20px] leading-5 text-light-primary-text"></i></span>
                    </a>
                  </li>
                  <li class="group blog-pagination-item">
                    <a href="#"
                      class="inline-flex items-center justify-center md:size-10 size-9 rounded-[50px] group-hover:font-semibold bg-white cursor-pointer border border-gray-300 group-hover:border-primary group-hover:bg-[rgba(0,171,85,0.08)] transition-colors duration-300 ease-in-out">
                      <span class="inline-flex items-center justify-center">
                        <i
                          class="hgi hgi-stroke hgi-arrow-right-01 text-[20px] leading-5 group-hover:font-semibold text-light-primary-text group-hover:text-primary"></i></span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <!-- Blog Sidebar -->
        <?php include 'components/blog-sidebar.php' ?>
      </div>
    </div>
  </div>

  <?php include 'components/subscribe-section.php' ?>

  <?php include 'components/footer.php' ?>
  <?php include 'components/scripts.php' ?>

</body>

</html>