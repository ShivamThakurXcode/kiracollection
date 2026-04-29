<?php
// Load product data
require_once 'data/products.php';
require_once 'components/ProductCard.php';

// Get product ID from URL parameter, default to 1
$productId = isset($_GET['id']) ? intval($_GET['id']) : 1;
$product = getProductById($productId);

// Get related products
$relatedProducts = getRelatedProducts($productId, $product['category'] ?? null, 4);

// Set page title
$pageTitle = $product['name'] ?? 'Product Details';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($pageTitle); ?> - Sellzy</title>

    <!-- ========== Favicon ========== -->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon" />

    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet" />

    <!-- ========== Huge Icons CSS ========== -->
    <link rel="stylesheet" href="assets/css/vendor/hugeicons/hgi-stroke-rounded.css" />

    <!-- ========== Slick CSS ========== -->
    <link rel="stylesheet" href="assets/css/vendor/slick.min.css" />

    <!-- ========== Nice Select CSS ========== -->
    <link rel="stylesheet" href="assets/css/vendor/nice-select.css" />

    <!-- ========== NoUI Slider CSS ========== -->
    <link rel="stylesheet" href="assets/css/vendor/nouislider.min.css" />

    <!-- ========== Animate CSS ========== -->
    <link rel="stylesheet" href="assets/css/vendor/animate.min.css" />

    <!-- ========== Custom CSS ========== -->
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
    <?php include 'components/preloader.php'; ?>
    <?php include 'components/modal-overlay.php'; ?>
    <?php include 'components/scroll-to-top-button.php'; ?>
    <?php include 'components/sidebar.php'; ?>
    <?php include 'components/cart-sidebar.php'; ?>
    <?php include 'components/login-sidebar.php'; ?>
    <?php include 'components/forgot-password-sidebar.php'; ?>
    <?php include 'components/reset-password-sidebar.php'; ?>
    <?php include 'components/otp-verification-sidebar.php'; ?>
    <?php include 'components/register-sidebar.php'; ?>
    <?php include 'components/quick-view-sidebar.php'; ?>

    <!-- ========== Header Start ========== -->
    <?php include 'components/header.php'; ?>
    <!-- ========== Header End ========== -->

    <!-- ========== Breadcrumb Start ========== -->
    <?php include 'components/breadcrumb.php'; ?>
    <!-- ========== Breadcrumb End ========== -->

    <!-- ========== Product Details Section Start ========== -->
    <section>
      <div class="container">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12">
          <?php include 'components/product-gallery.php'; ?>
          <?php include 'components/product-info.php'; ?>
        </div>
      </div>
    </section>
    <!-- ========== Product Details Section End ========== -->

    <!-- ========== CTA Info Section Start ========== -->
    <section class="py-12">
      <div class="container">
        <div class="grid grid-cols-12 gap-6">
          <div class="md:col-span-6 col-span-12 xl:col-span-3">
            <div class="p-6 border-gray-300 border rounded-2xl text-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
              <span class="inline-flex items-center justify-center size-14 bg-warning-lighter rounded-full">
                <i class="hgi hgi-stroke hgi-container-truck text-3xl text-light-primary-text"></i>
              </span>
              <h5 class="pt-3 pb-0.5">Free Shipping</h5>
              <p>Enjoy the Convenience of Free Shipping on Every Order</p>
            </div>
          </div>
          <div class="md:col-span-6 col-span-12 xl:col-span-3">
            <div class="p-6 border-gray-300 border rounded-2xl text-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
              <span class="inline-flex items-center justify-center size-14 bg-warning-lighter rounded-full">
                <i class="hgi hgi-stroke hgi-customer-support text-3xl text-light-primary-text"></i>
              </span>
              <h5 class="pt-3 pb-0.5">24x7 Support</h5>
              <p>Round-the-Clock Assistance, Anytime You Need It</p>
            </div>
          </div>
          <div class="md:col-span-6 col-span-12 xl:col-span-3">
            <div class="p-6 border-gray-300 border rounded-2xl text-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
              <span class="inline-flex items-center justify-center size-14 bg-warning-lighter rounded-full">
                <i class="hgi hgi-stroke hgi-delivery-return-02 text-3xl text-light-primary-text"></i>
              </span>
              <h5 class="pt-3 pb-0.5">30 Days Return</h5>
              <p>Your Satisfaction is Our Priority: Return Any Product Within 30 Days</p>
            </div>
          </div>
          <div class="md:col-span-6 col-span-12 xl:col-span-3">
            <div class="p-6 border-gray-300 border rounded-2xl text-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
              <span class="inline-flex items-center justify-center size-14 bg-warning-lighter rounded-full">
                <i class="hgi hgi-stroke hgi-transaction text-3xl text-light-primary-text"></i>
              </span>
              <h5 class="pt-3 pb-0.5">Secure Payment</h5>
              <p>Seamless Shopping Backed by Safe and Secure Payment Options</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ========== CTA Info Section End ========== -->

    <!-- ========== Product Tabs Start ========== -->
    <?php include 'components/product-tabs.php'; ?>
    <!-- ========== Product Tabs End ========== -->

    <!-- ========== Related Products Start ========== -->
    <?php include 'components/related-products.php'; ?>
    <!-- ========== Related Products End ========== -->

    <!-- ========== Subscribe Section Start ========== -->
    <?php include 'components/subscribe-section.php'; ?>
    <!-- ========== Subscribe Section End ========== -->

    <!-- ========== Footer Start ========== -->
    <?php include 'components/footer.php'; ?>
    <!-- ========== Footer End ========== -->

    <!-- ========== Scripts Start ========== -->
    <?php include 'components/scripts.php'; ?>
    <!-- ========== Scripts End ========== -->
</body>
</html>
