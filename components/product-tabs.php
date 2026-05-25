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
      

    </div>
  </div>
</section>
<!-- ========== Product Tabs End ========== -->
