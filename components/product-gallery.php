<?php
/**
 * Product Gallery Component
 * Displays product image gallery with thumbnail and main image sliders
 * 
 * @param array $product Product data array
 */
if (!isset($product)) {
    return;
}

$images = $product['images'] ?? [];
$defaultImage = $product['image'] ?? 'images/product/p-1.jpeg';

// If no images array, use default image repeated
if (empty($images)) {
    $images = [$defaultImage, $defaultImage, $defaultImage, $defaultImage, $defaultImage, $defaultImage];
}
?>
<!-- ========== Product Gallery Start ========== -->
<div class="xl:col-span-7 lg:col-span-6">
  <div class="flex gap-x-6 xl:flex-row flex-col gap-y-6 xl:gap-y-0 xl:gap-x-6">
    <div class="xl:w-[114px] lg:w-full order-2 xl:order-1 flex-none overflow-hidden">
      <div
        class="product-details-small-slider -m-2.5 sellzy-slider"
        data-slick='{"slidesToShow": 6, "slidesToScroll": 1, "arrows": false, "infinite": true, "loop": true, "vertical": true, "verticalSwiping": true, "asNavFor": ".product-details-big-slider", "focusOnSelect": true, "responsive": [{"breakpoint": 1025, "settings": {"slidesToShow": 4, "vertical": false, "verticalSwiping": false}}, {"breakpoint": 769, "settings": {"slidesToShow": 3, "vertical": false, "verticalSwiping": false}}, {"breakpoint": 480, "settings": {"slidesToShow": 2, "vertical": false, "verticalSwiping": false}}]}'
      >
        <?php foreach ($images as $index => $image): ?>
          <div class="single-product-small-slider-item p-2.5 rounded-lg overflow-hidden">
            <img
              src="<?php echo htmlspecialchars($image); ?>"
              alt="<?php echo htmlspecialchars($product['name'] ?? 'Product Image'); ?> - <?php echo $index + 1; ?>"
              class="w-full h-full object-cover rounded-lg"
            />
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="w-full xl:flex-1 order-1 xl:order-2 overflow-hidden relative">
      <div
        class="product-details-big-slider -mx-3 sellzy-slider"
        data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows": true, "asNavFor": ".product-details-small-slider", "appendArrows": ".product-details-big-slider-nav", "responsive": [{"breakpoint": 769, "settings": {"slidesToShow": 1, "arrows": false}}]}'
      >
        <?php foreach ($images as $index => $image): ?>
          <div class="single-product-big-slider-item px-3 rounded-2xl overflow-hidden">
            <img
              src="<?php echo htmlspecialchars($image); ?>"
              alt="<?php echo htmlspecialchars($product['name'] ?? 'Product Image'); ?> - <?php echo $index + 1; ?>"
              class="w-full h-full object-cover rounded-3xl"
            />
          </div>
        <?php endforeach; ?>
      </div>
      <div class="product-details-big-slider-nav absolute top-1/2 -translate-y-1/2 left-0 right-0 flex items-center justify-between px-3"></div>
    </div>
  </div>
</div>
<!-- ========== Product Gallery End ========== -->
