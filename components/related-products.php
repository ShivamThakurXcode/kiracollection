<?php
/**
 * Related Products Component
 * Displays related products grid
 * 
 * @param array $relatedProducts Array of related product data
 */
if (!isset($relatedProducts) || empty($relatedProducts)) {
    return;
}
?>
<!-- ========== Related Products Start ========== -->
<section class="pb-12">
  <div class="container">
    <div class="section-header text-center mb-8">
      <h2 class="mb-2">Related Products</h2>
      <p class="text-light-disabled-text">You may also like these products</p>
    </div>
    <div class="grid grid-cols-12 gap-6">
      <?php foreach ($relatedProducts as $product): ?>
        <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3">
          <div class="product-card group">
            <div class="product-image-container relative">
              <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="product-image rounded-xl bg-[#F4F3F5] mb-4 overflow-hidden">
                <img
                  src="<?php echo htmlspecialchars($product['image']); ?>"
                  alt="<?php echo htmlspecialchars($product['name']); ?>"
                  class="w-full h-full object-cover rounded-xl group-hover:scale-105 transition-transform duration-300"
                />
              </a>
              <?php if (!empty($product['discount_badge'])): ?>
                <span class="product-discount-badge absolute top-1/2 -translate-y-1/2 left-0 bg-error text-warning-lighter font-medium text-sm leading-[22px] px-1 after:absolute after:top-0 after:left-full after:z-10 after:w-1 after:h-full after:bg-[url('images/discount-shape.html')] after:bg-contain">
                  <?php echo htmlspecialchars($product['discount_badge']); ?>
                </span>
              <?php endif; ?>
              <div class="product-btn-actions absolute bottom-0 right-0 left-0 flex justify-center z-9 transition-all duration-300 ease-in-out opacity-0 group-hover:opacity-100 group-hover:bottom-3">
                <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-medium rounded-full">
                  <i class="hgi hgi-stroke hgi-eye text-xl"></i>
                </a>
                <a href="#" class="btn btn-primary btn-medium rounded-full ml-2">
                  <i class="hgi hgi-stroke hgi-shopping-cart-add-02 text-xl"></i>
                </a>
                <a href="#" class="btn btn-primary btn-medium rounded-full ml-2">
                  <i class="hgi hgi-stroke hgi-favourite text-xl"></i>
                </a>
              </div>
            </div>
            <div class="product-content">
              <div class="rating-section flex items-center mb-2">
                <div
                  class="bg-[url('../images/star-icon.png')] w-[90px] h-4.5 bg-repeat-x overflow-hidden bg-position-[0_0]"
                >
                  <div
                    style="width: <?php echo (($product['rating'] ?? 0) / 5) * 100; ?>%"
                    class="bg-[url('../images/star-icon.png')] h-4.5 bg-repeat-x bg-position-[0_-18px]"
                  ></div>
                </div>
                <span class="font-normal inline-block ml-1 text-sm">
                  (<?php echo number_format($product['reviews'] ?? 0); ?>)
                </span>
              </div>
              <h6 class="text-base font-semibold mb-2 line-clamp-2">
                <a href="product-detail.php?id=<?php echo $product['id']; ?>">
                  <?php echo htmlspecialchars($product['name']); ?>
                </a>
              </h6>
              <div class="price-section flex items-center gap-x-2">
                <span class="current-price text-lg font-bold text-light-primary-text">
                  <?php echo htmlspecialchars($product['current_price']); ?>
                </span>
                <?php if (!empty($product['old_price'])): ?>
                  <span class="old-price text-base text-light-disabled-text line-through">
                    <?php echo htmlspecialchars($product['old_price']); ?>
                  </span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- ========== Related Products End ========== -->
