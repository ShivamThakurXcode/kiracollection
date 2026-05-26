<?php
$pageTitle = $pageTitle ?? 'Page';
$breadcrumbBg = $breadcrumbBg ?? 'images/breadcrumb/b-1.jpg';
?>
<!-- ========== Breadcrumb Section Start ========== -->
<section class="breadcrumb-hero" style="background-image: url('<?php echo htmlspecialchars($breadcrumbBg); ?>');">
  <div class="breadcrumb-hero__overlay"></div>
  <div class="container">
    <div class="breadcrumb-hero__content">
      <h1 class="breadcrumb-hero__title"><?php echo htmlspecialchars($pageTitle); ?></h1>
      <div class="breadcrumb-hero__trail">
        <a href='index.php'>Home</a>
        <span>»</span>
        <span><?php echo htmlspecialchars($pageTitle); ?></span>
      </div>
    </div>
  </div>
</section>
<!-- ========== Breadcrumb Section End ========== -->