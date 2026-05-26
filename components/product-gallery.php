<?php
if (!isset($product)) {
  return;
}

$galleryImages = $product['images'] ?? [];
if (empty($galleryImages)) {
  $galleryImages = [$product['image'] ?? 'images/product/p-1.jpeg'];
}

$galleryImages = array_values(array_filter($galleryImages, function ($image) {
  return !empty($image);
}));

$galleryImages = array_slice($galleryImages, 0, 4);

$defaultImage = $galleryImages[0] ?? ($product['image'] ?? 'images/product/p-1.jpeg');
$productName = $product['name'] ?? 'Product Image';
?>
<!-- ========== Product Gallery Start ========== -->
<div class="xl:col-span-7 lg:col-span-6 mt-6 lg:mt-8">
  <div class="w-full overflow-hidden rounded-3xl bg-white p-4 lg:p-6">
    <div class="grid grid-cols-2 gap-3 md:gap-4" id="product-gallery-grid">
      <?php foreach ($galleryImages as $index => $image): ?>
        <button type="button"
          class="gallery-thumb group relative overflow-hidden rounded-2xl border <?php echo $index === 0 ? 'border-primary' : 'border-gray-200'; ?> bg-white"
          style="aspect-ratio: 4 / 3;"
          data-gallery-image="<?php echo htmlspecialchars($image); ?>"
          data-gallery-alt="<?php echo htmlspecialchars($productName); ?>">
          <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($productName); ?>"
            class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
        </button>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script>
  (function () {
    const thumbnails = document.getElementById('product-gallery-grid');

    if (!thumbnails) {
      return;
    }

    thumbnails.addEventListener('click', function (event) {
      const button = event.target.closest('[data-gallery-image]');
      if (!button) {
        return;
      }

      const image = button.getAttribute('data-gallery-image');
      thumbnails.querySelectorAll('[data-gallery-image]').forEach(function (thumb) {
        thumb.classList.remove('border-primary');
        thumb.classList.add('border-gray-200');
      });

      button.classList.add('border-primary');
      button.classList.remove('border-gray-200');
    });
  })();
</script>
<!-- ========== Product Gallery End ========== -->