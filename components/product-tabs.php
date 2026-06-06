<?php
/**
 * Product Tabs Component
 * Displays product description, additional info, and reviews tabs
 * 
 * @param array $product Product data array
 */
if (!isset($product)) {
    return;
}

$name = $product['name'] ?? 'Product Name';
$description = $product['description'] ?? 'No description available.';
$additionalInfo = $product['additional_info'] ?? [];
$materials = $product['materials'] ?? '';
$dimensions = $product['dimensions'] ?? '';
$weight = $product['weight'] ?? '';
$careInstructions = $product['care_instructions'] ?? '';
?>
<!-- ========== Product Tabs Start ========== -->
<section class="pb-12">
  <div class="container">
    <div id="product-details-tabs">
      <ul class="filter-list">
        <li>
          <button class="active" data-tab="description">Description</button>
        </li>
        <li><button data-tab="additional-info">Additional Info</button></li>
        <li><button data-tab="reviews">Reviews</button></li>
      </ul>
      
      <div id="description" class="product-details-tab active fade">
        <h5 class="product-details-tab-title">Description</h5>
        <div class="product-details-tab-content bg-white rounded-2xl border border-gray-200 p-6">
          <p class="mb-6 text-gray-800">
            <?php echo nl2br(htmlspecialchars($description)); ?>
          </p>
          <?php if (!empty($materials)): ?>
            <p class="mb-6">
              <strong>Material:</strong> <?php echo htmlspecialchars($materials); ?>
            </p>
          <?php endif; ?>
          <?php if (!empty($careInstructions)): ?>
            <p class="mb-6">
              <strong>Care Instructions:</strong> <?php echo nl2br(htmlspecialchars($careInstructions)); ?>
            </p>
          <?php endif; ?>
        </div>
      </div>
      
      <div id="additional-info" class="product-details-tab hidden">
        <h5 class="product-details-tab-title">Additional Info</h5>
        <div class="product-details-tab-content">
          <table class="w-full">
            <tbody>
              <?php if (!empty($dimensions)): ?>
                <tr>
                  <td class="font-semibold py-3 pr-4">Dimensions</td>
                  <td class="py-3"><?php echo htmlspecialchars($dimensions); ?></td>
                </tr>
              <?php endif; ?>
              <?php if (!empty($weight)): ?>
                <tr>
                  <td class="font-semibold py-3 pr-4">Weight</td>
                  <td class="py-3"><?php echo htmlspecialchars($weight); ?></td>
                </tr>
              <?php endif; ?>
              <?php if (!empty($materials)): ?>
                <tr>
                  <td class="font-semibold py-3 pr-4">Materials</td>
                  <td class="py-3"><?php echo htmlspecialchars($materials); ?></td>
                </tr>
              <?php endif; ?>
              <?php foreach ($additionalInfo as $label => $value): ?>
                <tr>
                  <td class="font-semibold py-3 pr-4"><?php echo htmlspecialchars($label); ?></td>
                  <td class="py-3"><?php echo htmlspecialchars($value); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div id="reviews" class="product-details-tab hidden">
        <h5 class="product-details-tab-title">Reviews</h5>
        <div class="product-details-tab-content">
          <div class="comment-list-wrapper p-6">
            <div class="comment-list-title pb-4 border-b border-gray-300 mb-4">
              <h5>Customer Ratings & Review</h5>
            </div>
            <ol class="comment-list space-y-6">
              <li class="comment">
                <div class="comment-body">
                  <div class="comment-avatar-card flex items-center gap-x-4 mb-3">
                    <div class="comment-author-avatar size-12 rounded-full overflow-hidden bg-gray-200">
                    </div>
                    <div class="comment-author-info flex-1">
                      <p class="comment-author font-semibold text-gray-800">Robert Fox</p>
                    </div>
                  </div>
                  <div class="flex items-center mb-3">
                    <div class="rating-section flex items-center">
                      <div class="text-sm font-medium mr-2">4.5</div>
                      <div class="stars text-yellow-400">★★★★☆</div>
                    </div>
                  </div>
                  <div class="comment-content mb-3">
                    <p class="text-gray-700">Very nice! The art looks beautiful and the packaging was great.</p>
                  </div>
                </div>
              </li>
              <li class="comment">
                <div class="comment-body">
                  <div class="comment-avatar-card flex items-center gap-x-4 mb-3">
                    <div class="comment-author-avatar size-12 rounded-full overflow-hidden bg-gray-200">
                    </div>
                    <div class="comment-author-info flex-1">
                      <p class="comment-author font-semibold text-gray-800">Jenny Wilson</p>
                    </div>
                  </div>
                  <div class="flex items-center mb-3">
                    <div class="rating-section flex items-center">
                      <div class="text-sm font-medium mr-2">5.0</div>
                      <div class="stars text-yellow-400">★★★★★</div>
                    </div>
                  </div>
                  <div class="comment-content mb-3">
                    <p class="text-gray-700">Absolutely love it — colors and texture are perfect.</p>
                  </div>
                </div>
              </li>
            </ol>
          </div>
        </div>
      </div>
      

    </div>
  </div>
</section>
<!-- ========== Product Tabs End ========== -->
