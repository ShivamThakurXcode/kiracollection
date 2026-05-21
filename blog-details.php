<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog Details - KiraCollection Art</title>
    <?php
    include 'components/links.php';
    include 'components/BlogCard.php';
    include_once 'data/blogs.php';

    // Get blog by slug
    $blog_slug = isset($_GET['slug']) ? $_GET['slug'] : '';
    $current_blog = null;

    foreach ($blogs as $blog) {
        if ($blog['slug'] === $blog_slug) {
            $current_blog = $blog;
            break;
        }
    }

    // If blog not found, redirect to blog list
    if (!$current_blog) {
        header('Location: blog.php');
        exit;
    }

    // Get related blogs (same category, excluding current)
    $related_blogs = array_filter($blogs, function ($b) use ($current_blog) {
        return $b['category'] === $current_blog['category'] && $b['id'] !== $current_blog['id'];
    });
    $related_blogs = array_slice(array_values($related_blogs), 0, 3);

    // Get recent blogs (excluding current)
    $recent_blogs = array_filter($blogs, function ($b) use ($current_blog) {
        return $b['id'] !== $current_blog['id'];
    });
    $recent_blogs = array_slice(array_values($recent_blogs), 0, 3);

    $categoryColors = [
        'warning' => 'text-warning-dark bg-[rgba(255,193,7,0.16)]',
        'success' => 'text-success-dark bg-[rgba(84,214,44,0.16)]',
        'primary' => 'text-primary-dark bg-[rgba(0,171,85,0.16)]',
        'info' => 'text-info-dark bg-[rgba(32,201,151,0.16)]'
    ];

    $colorClass = isset($categoryColors[$current_blog['category_color']])
        ? $categoryColors[$current_blog['category_color']]
        : $categoryColors['warning'];
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
    $pageTitle = 'Blog Detail';
    $breadcrumbBg = 'images/breadcrumb/b-1.jpg';
    include 'components/breadcrumb.php';
    ?>

    <!-- Blog Details Section -->
    <div class="pb-12 pt-2">
        <div class="container px-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <!-- Blog Header -->
                    <div class="mb-10 wow animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                        <div class="aspect-[16/9] overflow-hidden rounded-2xl">
                            <img src="<?= $current_blog['image'] ?>"
                                alt="<?= htmlspecialchars($current_blog['title']) ?>"
                                class="rounded-2xl w-full h-full object-cover" />
                        </div>
                        <div class=" rounded-2xl bg-white p-6 md:p-8 -mt-10 md:-mt-14 relative z-10">
                            <div class="mb-4">
                                <a href='blog.php?category=<?= urlencode($current_blog['category']) ?>'
                                    class="<?= $colorClass ?> px-3 py-1 inline-flex rounded-full text-sm leading-[22px] hover:opacity-80 transition-opacity">
                                    <?= htmlspecialchars($current_blog['category']) ?>
                                </a>
                            </div>
                            <h1 class="text-3xl md:text-4xl font-bold text-light-primary-text mb-4">
                                <?= htmlspecialchars($current_blog['title']) ?>
                            </h1>
                            <p class="text-light-secondary-text text-sm leading-[22px] mb-5">
                                <?= htmlspecialchars($current_blog['excerpt']) ?>
                            </p>
                            <div class="flex flex-wrap items-center gap-4 text-light-secondary-text text-sm">
                                <div class="flex items-center gap-x-2">
                                    <i class="hgi hgi-stroke hgi-calendar-03 text-base"></i>
                                    <span><?= $current_blog['date'] ?></span>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <i class="hgi hgi-stroke hgi-clock text-base"></i>
                                    <span><?= $current_blog['reading_time'] ?></span>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <i class="hgi hgi-stroke hgi-eye text-base"></i>
                                    <span><?= $current_blog['views'] ?> Views</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Content -->
                    <div class="prose max-w-none mb-8 wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
                        <?= $current_blog['content'] ?>
                    </div>

                    <!-- Tags -->
                    <div class="mb-8 wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="text-light-primary-text font-semibold">Tags:</span>
                            <?php foreach ($current_blog['tags'] as $tag): ?>
                                <a href="#"
                                    class="btn btn-default outline text-sm leading-[22px] font-normal py-1 px-3 rounded-[50px] cursor-pointer shadow-none hover:bg-primary hover:text-white transition-colors">
                                    <?= htmlspecialchars($tag) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Related Posts -->
                    <?php if (!empty($related_blogs)): ?>
                        <div class="wow animate__animated animate__fadeInUp" data-wow-delay="0.8s">
                            <h3 class="text-2xl font-semibold text-light-primary-text mb-6">Related Posts</h3>
                            <div class="grid md:grid-cols-3 gap-6">
                                <?php foreach ($related_blogs as $index => $related_blog): ?>
                                    <div class="col-span-1">
                                        <?php renderBlogCard($related_blog, '0s', false); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Blog Sidebar -->
                <?php // include 'components/blog-sidebar.php' ?>
            </div>
        </div>
    </div>

    <?php include 'components/subscribe-section.php' ?>

    <?php include 'components/footer.php' ?>
    <?php include 'components/scripts.php' ?>

    <script>
        // Update sidebar category links to work with filtering
        document.addEventListener('DOMContentLoaded', function () {
            const categoryCheckboxes = document.querySelectorAll('.widget-category-content-list-items input[type="checkbox"]');
            categoryCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    const categoryName = this.closest('label').querySelector('span:nth-child(2)').textContent.trim();
                    if (this.checked) {
                        window.location.href = 'blog.php?category=' + encodeURIComponent(categoryName);
                    }
                });
            });
        });
    </script>

</body>

</html>