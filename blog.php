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

  // Pagination: 9 blogs per page
  $blogs_per_page = 9;
  $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
  $total_blogs = count($filtered_blogs);
  $total_pages = ceil($total_blogs / $blogs_per_page);
  $offset = ($current_page - 1) * $blogs_per_page;
  $paginated_blogs = array_slice($filtered_blogs, $offset, $blogs_per_page);
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
  <?php
  $pageTitle = 'Blog';
  $breadcrumbBg = 'images/breadcrumb/b-1.jpg';
  include 'components/breadcrumb.php';
  ?>

  <!-- Blog Grid Section -->
  <div class="pb-12 pt-8">
    <div class="container px-12">
      <div class="grid grid-cols-12 gap-6">
        <div class="xl:col-span-12 col-span-12">
          <?php if ($current_category): ?>
            <div class="mb-8 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
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
            <div class="grid grid-cols-12 gap-6">
              <?php
              foreach ($paginated_blogs as $index => $blog):
                $delay = (0.2 + (($index % 6) * 0.1)) . 's';
                ?>
                <div class="col-span-12 md:col-span-6 lg:col-span-4">
                  <?php renderBlogCard($blog, $delay, true); ?>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- Pagination -->
          <?php if ($total_pages > 1): ?>
            <div class="mt-12 wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
              <div class="flex items-center justify-center gap-2">
                <?php if ($current_page > 1): ?>
                  <a href="?<?= http_build_query(array_merge($_GET, ['page' => $current_page - 1])) ?>"
                    class="w-10 h-10 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors">
                    <i class="hgi hgi-stroke hgi-chevron-left"></i>
                  </a>
                <?php endif; ?>

                <?php
                $start_page = max(1, $current_page - 2);
                $end_page = min($total_pages, $current_page + 2);

                if ($start_page > 1): ?>
                  <a href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>"
                    class="w-10 h-10 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors">1</a>
                  <?php if ($start_page > 2): ?>
                    <span class="px-2 text-light-secondary-text">...</span>
                  <?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                  <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" class="w-10 h-10 rounded-full flex items-center justify-center transition-colors <?=
                         $i === $current_page
                         ? 'bg-primary text-white'
                         : 'bg-white border border-gray-300 hover:border-primary hover:bg-primary/10 text-light-primary-text'
                         ?>">
                    <?= $i ?>
                  </a>
                <?php endfor; ?>

                <?php if ($end_page < $total_pages): ?>
                  <?php if ($end_page < $total_pages - 1): ?>
                    <span class="px-2 text-light-secondary-text">...</span>
                  <?php endif; ?>
                  <a href="?<?= http_build_query(array_merge($_GET, ['page' => $total_pages])) ?>"
                    class="w-10 h-10 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors"><?= $total_pages ?></a>
                <?php endif; ?>

                <?php if ($current_page < $total_pages): ?>
                  <a href="?<?= http_build_query(array_merge($_GET, ['page' => $current_page + 1])) ?>"
                    class="w-10 h-10 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors">
                    <i class="hgi hgi-stroke hgi-chevron-right"></i>
                  </a>
                <?php endif; ?>
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