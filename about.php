<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - kiracollection art</title>

  <?php include 'components/links.php' ?>
</head>

<body>

  <?php include 'components/preloader.php' ?>

  <?php include 'components/modal-overlay.php' ?>

  

  <?php include 'components/sidebar.php' ?>

  <?php include 'components/cart-sidebar-inline.php' ?>

  <?php include 'components/register-sidebar.php' ?>

  <?php include 'components/login-sidebar.php' ?>

  <?php include 'components/forgot-password-sidebar.php' ?>

  <?php include 'components/reset-password-sidebar.php' ?>

  <?php include 'components/otp-verification-sidebar.php' ?>

  <?php include 'components/quick-view-sidebar.php' ?>

  <?php include "components/header.php" ?>

  <!-- Breadcrumb Section -->
  <?php
  $pageTitle = 'About Us';
  $breadcrumbBg = 'images/breadcrumb/b-1.jpg';
  include 'components/breadcrumb.php';
  ?>

  <?php include 'components/about-content.php' ?>

  <?php include 'components/footer.php' ?>

  <?php include 'components/scripts.php' ?>

</body>

</html>