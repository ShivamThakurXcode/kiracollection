<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sellzy - Multipurpose eCommerce</title>
  <?php
  include 'components/links.php';
  include 'components/ProductCard.php';
  include 'data/products.php';
  ?>
</head>

<body>

  <?php include 'components/preloader.php' ?>

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

  <?php include 'components/hero-section.php' ?>

  <?php include 'components/category-section.php' ?>

  <?php include 'components/most-loved-products-section.php' ?>

  <?php include 'components/offer-section.php' ?>

  <?php include 'components/products-section.php' ?>

  <?php include 'components/limited-time-section.php' ?>

  <?php include 'components/favourite-category-section.php' ?>

  <?php include 'components/blog-section.php' ?>

  <?php include 'components/subscribe-section.php' ?>

  <?php include 'components/footer.php' ?>
  <?php include 'components/scripts.php' ?>

  <script>
    console.log('Page started loading at:', new Date().toISOString());
    window.addEventListener('load', function() {
      console.log('Page fully loaded at:', new Date().toISOString());
      setTimeout(function() {
        var preloader = document.getElementById('preloader');
        if (preloader && preloader.style.display !== 'none') {
          console.log('Forcing preloader to hide');
          preloader.style.display = 'none';
          preloader.classList.add('loaded');
        }
      }, 3000);
    });
  </script>

</body>

</html>