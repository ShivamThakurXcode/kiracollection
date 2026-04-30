<?php
$pageTitle = $pageTitle ?? 'Page';
?>
<!-- ========== Breadcrumb Section Start ========== -->
<div class="pb-12">
  <div class="container">
    <div class="breadcrumb">
      <ul>
        <li>
          <a href='index.php'>
            <span>
              <i class="hgi hgi-stroke hgi-home-01 text-[20px]"></i>
            </span>
            Home
          </a>
        </li>
        <li class="text-light-disabled-text">&#8226;</li>
        <li><span><?php echo htmlspecialchars($pageTitle); ?></span></li>
      </ul>
    </div>
  </div>
</div>
<!-- ========== Breadcrumb Section End ========== -->
