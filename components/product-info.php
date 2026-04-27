<?php
/**
 * Product Info Component
 * Displays product title, price, rating, variations, and add to cart
 * 
 * @param array $product Product data array
 */
if (!isset($product)) {
    return;
}

$name = $product['name'] ?? 'Product Name';
$category = $product['category'] ?? 'Category';
$currentPrice = $product['current_price'] ?? '₹0';
$oldPrice = $product['old_price'] ?? '';
$discountPercentage = $product['discount_percentage'] ?? '';
$discountBadge = $product['discount_badge'] ?? '';
$rating = $product['rating'] ?? 0;
$reviews = $product['reviews'] ?? 0;
$sold = $product['sold'] ?? 0;
$available = $product['available'] ?? 0;
$sku = $product['sku'] ?? 'SKU-' . ($product['id'] ?? '001');
$description = $product['description'] ?? '';

// Size options
$sizeOptions = $product['size_options'] ?? ['S', 'M', 'L', 'XL', 'XXL'];
$selectedSize = $sizeOptions[0] ?? 'S';

// Color options
$colorOptions = $product['color_options'] ?? [
    ['name' => 'Natural White', 'hex' => '#F5F0E8', 'image' => ''],
    ['name' => 'Cream Beige', 'hex' => '#E8D5B7', 'image' => ''],
    ['name' => 'Terracotta', 'hex' => '#C67B5C', 'image' => ''],
];
$selectedColor = $colorOptions[0]['name'] ?? 'Natural White';

// Calculate rating percentage
$ratingPercentage = ($rating / 5) * 100;
?>
<!-- ========== Product Info Start ========== -->
<div class="xl:col-span-5 lg:col-span-6 mt-6 lg:mt-0">
  <div class="rounded-3xl border border-gray-300 p-6">
    <?php if (!empty($discountBadge)): ?>
      <span
        class="product-discount-badge inline-block mb-6 uppercase relative bg-error text-warning-lighter font-medium text-sm leading-[22px] px-1 after:absolute after:top-0 after:left-full after:z-10 after:w-1 after:h-full after:bg-[url('images/discount-shape.html')] after:bg-contain after:bg-no-repeat"
      ><?php echo htmlspecialchars($discountBadge); ?></span>
    <?php endif; ?>
    
    <p class="uppercase text-info text-xs leading-[18px] font-bold new-arrival-badge mb-6">
      <?php echo htmlspecialchars($category); ?>
    </p>
    
    <div class="product-title-section flex items-center justify-between mb-6">
      <h3 class="line-clamp-1">
        <?php echo htmlspecialchars($name); ?>
      </h3>
      <a class="size-10 inline-flex flex-none items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 border border-gray-300" href="wishlist-style-v1.html">
        <i class="hgi hgi-stroke hgi-favourite text-xl text-light-secondary-text"></i>
      </a>
    </div>
    
    <div class="rating-section flex items-center mb-4">
      <div
        class="bg-[url('../images/star-icon.png')] w-[90px] h-4.5 bg-repeat-x overflow-hidden bg-position-[0_0]"
      >
        <div
          style="width: <?php echo $ratingPercentage; ?>%"
          class="bg-[url('../images/star-icon.png')] h-4.5 bg-repeat-x bg-position-[0_-18px]"
        ></div>
      </div>
      <span class="font-normal inline-block ml-1">
        (<?php echo number_format($reviews); ?> reviews)
      </span>
    </div>
    
    <div class="price-section flex items-center gap-x-3 mb-6">
      <span
        class="current-price text-2xl leading-9 font-bold text-light-primary-text relative after:absolute after:h-6 after:w-px after:bg-gray-300 after:right-0 after:top-1/2 after:-translate-y-1/2 pr-3 inline-block"
      ><?php echo htmlspecialchars($currentPrice); ?></span>
      <?php if (!empty($oldPrice)): ?>
        <span
          class="old-price text-2xl leading-9 font-normal text-light-disabled-text"
        ><?php echo htmlspecialchars($oldPrice); ?></span>
      <?php endif; ?>
      <?php if (!empty($discountPercentage)): ?>
        <span
          class="product-discount-badge uppercase relative bg-warning text-black font-medium text-sm leading-[22px] px-1 after:absolute after:top-0 after:left-full after:z-10 after:w-1 after:h-full after:bg-[url('images/discount-warning-shape.html')] after:bg-contain after:bg-no-repeat"
        ><?php echo htmlspecialchars($discountPercentage); ?></span>
      <?php endif; ?>
    </div>
    
    <div class="product-add-to-cart-section py-6 border-b border-dashed border-gray-300 border-t">
      <?php if (!empty($colorOptions)): ?>
        <div class="color-variation-section mb-6">
          <div class="color-variation-section-title mb-4">
            <p class="font-semibold text-light-primary-text flex items-center gap-x-2.5">
              Color:
              <span class="text-light-primary-text font-normal capitalize color-variation-selected-color">
                <?php echo htmlspecialchars($selectedColor); ?>
              </span>
            </p>
          </div>
          <div class="color-variation-items flex items-center gap-x-2">
            <?php foreach ($colorOptions as $index => $color): ?>
              <div class="color-variation-item">
                <button
                  data-color-text="<?php echo htmlspecialchars($color['name']); ?>"
                  data-color="<?php echo htmlspecialchars($color['hex']); ?>"
                  class="cursor-pointer flex items-center justify-center rounded-full size-10 border <?php echo $index === 0 ? 'border-primary' : 'border-gray-300'; ?> hover:bg-[rgba(145,158,171,0.08)]"
                  style="<?php if (!empty($color['image'])): ?>background-image: url('<?php echo htmlspecialchars($color['image']); ?>'); background-size: cover;<?php else: ?>background-color: <?php echo htmlspecialchars($color['hex']); ?>;<?php endif; ?>"
                  title="<?php echo htmlspecialchars($color['name']); ?>"
                ></button>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
      
      <?php if (!empty($sizeOptions)): ?>
        <div class="size-variation-section mb-6">
          <div class="size-variation-section-title mb-4 flex items-center justify-between">
            <p class="font-semibold text-light-primary-text flex items-center gap-x-2.5">
              Size:
              <span class="text-light-primary-text font-normal capitalize size-variation-selected-size">
                <?php echo htmlspecialchars($selectedSize); ?>
              </span>
            </p>
            <a href="#" class="text-sm leading-[22px] hover:underline variation-size-guide-btn">
              Size Guide
            </a>
          </div>
          <div class="size-variation-items flex items-center gap-2 2xl:flex-nowrap flex-wrap">
            <?php foreach ($sizeOptions as $index => $size): ?>
              <div class="size-variation-item">
                <button
                  data-size-text="<?php echo htmlspecialchars($size); ?>"
                  class="cursor-pointer flex items-center justify-center text-sm leading-6 px-[38px] py-1.5 font-semibold border <?php echo $index === 0 ? 'border-primary bg-primary text-white' : 'border-gray-300 text-light-primary-text'; ?> rounded-[100px] hover:bg-[rgba(145,158,171,0.08)]"
                >
                  <?php echo htmlspecialchars($size); ?>
                </button>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
      
      <div class="product-add-to-cart-btn-section">
        <p class="font-semibold text-light-primary-text mb-4">Quantity:</p>
        <div class="flex items-center justify-between gap-x-4 gap-y-4 flex-wrap md:flex-nowrap md:gap-y-0">
          <div class="quantity-section flex-1 max-w-[185px] border border-gray-300 rounded-[80px] px-4 py-[11px] flex items-center justify-between">
            <button class="quantity-btn inline-flex items-center justify-center hover:text-primary">
              <i class="hgi hgi-stroke hgi-minus-sign text-xl leading-5"></i>
            </button>
            <input
              type="text"
              class="quantity-input text-center w-full focus:outline-none font-semibold text-base leading-6 text-light-primary-text"
              value="1"
            />
            <button class="quantity-btn inline-flex items-center justify-center hover:text-primary">
              <i class="hgi hgi-stroke hgi-plus-sign text-xl leading-5"></i>
            </button>
          </div>
          <button class="btn btn-warning btn-large rounded-[80px] flex-1">
            Buy Now
          </button>
          <button class="btn btn-primary btn-large rounded-[80px] flex-1">
            <i class="hgi hgi-stroke hgi-shopping-cart-add-02 leading-6 text-2xl text-white"></i>
            Add to Cart
          </button>
        </div>
      </div>
    </div>
    
    <div class="product-share-and-compare-section flex items-center gap-x-4 mt-6">
      <a
        href="#"
        class="product-share-btn text-info inline-flex items-center gap-x-2.5 pr-4 relative after:absolute after:top-1/2 after:-translate-y-1/2 after:right-0 after:w-px after:h-3 after:bg-gray-300"
      >
        <i class="hgi hgi-stroke hgi-share-05 text-xl leading-5"></i>
        <span>Share</span>
      </a>
      <a class="product-compare-btn text-info inline-flex items-center gap-x-2.5" href="compare.html">
        <i class="hgi hgi-stroke hgi-git-compare text-xl leading-5"></i>
        <span>Compare</span>
      </a>
    </div>
    
    <div class="product-extra-info-section flex flex-col gap-y-4 mt-6">
      <div class="product-extra-info-item flex items-center gap-x-4 gap-y-4 flex-wrap md:flex-nowrap md:gap-y-0">
        <p class="font-semibold text-light-primary-text">Free Shipping:</p>
        <p>Estimated Delivery Time 5-7 Days</p>
      </div>
      <div class="product-extra-info-item flex items-center gap-x-4 gap-y-4 flex-wrap md:flex-nowrap md:gap-y-0">
        <p class="font-semibold text-light-primary-text">SKU:</p>
        <p><?php echo htmlspecialchars($sku); ?></p>
      </div>
      <div class="product-extra-info-item flex items-center gap-x-4 gap-y-4 flex-wrap md:flex-nowrap md:gap-y-0">
        <p class="font-semibold text-light-primary-text">Categories:</p>
        <p><?php echo htmlspecialchars($category); ?></p>
      </div>
      <div class="product-extra-info-item flex items-center gap-x-4 gap-y-4 flex-wrap md:flex-nowrap md:gap-y-0">
        <p class="font-semibold text-light-primary-text">Availability:</p>
        <p><?php echo $available > 0 ? $available . ' in stock' : 'Out of stock'; ?></p>
      </div>
      <div class="product-extra-info-item flex items-center gap-x-4 gap-y-4 flex-wrap md:flex-nowrap md:gap-y-0">
        <p class="font-semibold text-light-primary-text">Sold:</p>
        <p><?php echo number_format($sold); ?> sold</p>
      </div>
    </div>
  </div>
</div>
<!-- ========== Product Info End ========== -->
