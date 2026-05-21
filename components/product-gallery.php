<?php
if (!isset($product)) {
  return;
}

$defaultImage = $product['image'] ?? 'images/product/p-1.jpeg';
?>
<!-- ========== Product Gallery Start ========== -->
<div class="xl:col-span-7 lg:col-span-6 mt-6 lg:mt-8">
  <div class="w-full overflow-hidden rounded-3xl bg-white p-4 lg:p-6">
    <img src="<?php echo htmlspecialchars($defaultImage); ?>"
      alt="<?php echo htmlspecialchars($product['name'] ?? 'Product Image'); ?>"
      class="w-full max-h-[520px] object-contain rounded-2xl" />
  </div>
</div>
<!-- ========== Product Gallery End ========== -->