<?php
/**
 * Related Products Component
 * Displays related products grid using ProductCard class
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
      <?php
      foreach ($relatedProducts as $index => $product):
        $delay = (0.2 + ($index * 0.1)) . 's';
        $card = new ProductCard($product, 'bordered', $delay);
      ?>
        <div class="col-span-12 sm:col-span-6 md:col-span-4 lg:col-span-3">
          <?php echo $card->render(); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- ========== Related Products End ========== -->
