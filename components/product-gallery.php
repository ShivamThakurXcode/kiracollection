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

$defaultImage = $galleryImages[0] ?? ($product['image'] ?? 'images/product/p-1.jpeg');
$productName = $product['name'] ?? 'Product Image';
?>
<!-- ========== Product Gallery Start ========== -->
<div class="xl:col-span-7 lg:col-span-6 mt-6 lg:mt-8">
  <div class="w-full overflow-hidden rounded-3xl bg-white p-4 lg:p-6">
    <div class="rounded-2xl bg-white border border-gray-200 p-3">
      <img id="product-gallery-main-image" src="<?php echo htmlspecialchars($defaultImage); ?>"
        alt="<?php echo htmlspecialchars($productName); ?>"
        class="w-full max-h-[520px] object-contain rounded-2xl" />
    </div>

    <?php if (count($galleryImages) > 1): ?>
      <div class="mt-4 grid grid-cols-4 sm:grid-cols-5 gap-3" id="product-gallery-thumbnails">
        <?php foreach ($galleryImages as $index => $image): ?>
          <button type="button"
            class="gallery-thumb overflow-hidden rounded-xl border <?php echo $index === 0 ? 'border-primary' : 'border-gray-200'; ?> bg-white"
            data-gallery-image="<?php echo htmlspecialchars($image); ?>"
            data-gallery-alt="<?php echo htmlspecialchars($productName); ?>">
            <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($productName); ?>"
              class="h-20 w-full object-cover" />
          </button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
  (function () {
    const mainImage = document.getElementById('product-gallery-main-image');
    const thumbnails = document.getElementById('product-gallery-thumbnails');

    if (!mainImage || !thumbnails) {
      return;
    }

    thumbnails.addEventListener('click', function (event) {
      const button = event.target.closest('[data-gallery-image]');
      if (!button) {
        return;
      }

      const image = button.getAttribute('data-gallery-image');
      const altText = button.getAttribute('data-gallery-alt') || mainImage.alt;
      if (image) {
        mainImage.src = image;
        mainImage.alt = altText;
      }

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