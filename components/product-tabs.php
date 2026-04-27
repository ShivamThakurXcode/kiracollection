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
        <div class="product-details-tab-content">
          <p class="mb-6">
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
        <div class="product-details-tab-content p-0!">
          <div class="grid grid-cols-12 gap-6 mb-6">
            <div class="col-span-12 md:col-span-4">
              <div class="p-6 border border-gray-300 rounded-3xl text-center">
                <h3 class="text-5xl font-bold mb-2">
                  <?php echo number_format($product['rating'] ?? 0, 1); ?>
                </h3>
                <div class="rating-section flex items-center justify-center mb-2">
                  <div
                    class="bg-[url('../images/star-icon.png')] w-[90px] h-4.5 bg-repeat-x overflow-hidden bg-position-[0_0]"
                  >
                    <div
                      style="width: <?php echo (($product['rating'] ?? 0) / 5) * 100; ?>%"
                      class="bg-[url('../images/star-icon.png')] h-4.5 bg-repeat-x bg-position-[0_-18px]"
                    ></div>
                  </div>
                </div>
                <p class="text-light-disabled-text">
                  Based on <?php echo number_format($product['reviews'] ?? 0); ?> reviews
                </p>
              </div>
            </div>
            <div class="col-span-12 md:col-span-8">
              <div class="flex flex-col gap-y-4">
                <?php for ($i = 5; $i >= 1; $i--): ?>
                  <div class="flex gap-x-4 items-center">
                    <span class="font-semibold text-light-primary-text"><?php echo $i; ?> Star</span>
                    <div class="progress w-full flex-1 h-1.5 bg-[rgba(145,158,171,0.24)] rounded-[50px] overflow-hidden">
                      <div
                        style="width: <?php echo rand(10, 80); ?>%"
                        class="progress-bar h-full bg-primary rounded-[50px]"
                      ></div>
                    </div>
                    <span><?php echo number_format(rand(1000, 50000)); ?></span>
                  </div>
                <?php endfor; ?>
              </div>
            </div>
          </div>
          
          <div class="col-span-12 flex items-center justify-center py-6">
            <a href="#review-form" class="btn btn-primary outline btn-large rounded-[100px]">
              Write a Review
            </a>
          </div>
          
          <div id="review-form" class="comment-form-wrapper p-6 border-t border-gray-300 border-b">
            <div class="comment-respond p-6 border border-gray-300 rounded-3xl">
              <h5 class="mb-6">Add Comment</h5>
              <div class="flex items-center gap-x-3 mb-6">
                <p class="text-light-primary-text font-medium">
                  Your review about this product:
                </p>
                <div class="rating-section flex items-center justify-center">
                  <div
                    class="bg-[url('../images/star-icon.png')] w-[90px] h-4.5 bg-repeat-x overflow-hidden bg-position-[0_0]"
                  >
                    <div
                      style="width: 0%"
                      class="bg-[url('../images/star-icon.png')] h-4.5 bg-repeat-x bg-position-[0_-18px]"
                    ></div>
                  </div>
                </div>
              </div>
              <form class="flex flex-col gap-y-6" action="#">
                <div class="input-group medium rounded-[20px] px-3.5 resize-none">
                  <textarea
                    id="post-comment"
                    rows="4"
                    class="peer form-control placeholder-transparent focus:placeholder-transparent"
                    placeholder="Comment *"
                  ></textarea>
                  <label
                    for="post-comment"
                    class="absolute left-[14px] top-1/2 -translate-y-1/2 text-xs leading-[18px] transition-all peer-placeholder-shown:text-light-disabled-text peer-focus:text-light-disabled-text peer-placeholder-shown:text-[16px] peer-placeholder-shown:top-6 peer-focus:text-[12px] peer-focus:top-0 peer-[:not(:placeholder-shown)]:text-[12px] peer-[:not(:placeholder-shown)]:top-0 bg-white peer-focus:px-1 peer-[:not(:placeholder-shown)]:px-1"
                  >
                    Comment *
                  </label>
                </div>
                <div class="relative w-full">
                  <input
                    type="text"
                    id="review-name"
                    class="peer form-control input-group medium rounded-[80px] px-3.5 placeholder-transparent focus:placeholder-transparent focus:outline-none"
                    placeholder="Name *"
                  />
                  <label
                    for="review-name"
                    class="absolute left-[14px] top-1/2 -translate-y-1/2 text-xs leading-[18px] transition-all peer-placeholder-shown:text-light-disabled-text peer-focus:text-light-disabled-text peer-placeholder-shown:text-[16px] peer-placeholder-shown:top-1/2 peer-focus:text-[12px] peer-focus:top-0 peer-[:not(:placeholder-shown)]:text-[12px] peer-[:not(:placeholder-shown)]:top-0 bg-white peer-focus:px-1 peer-[:not(:placeholder-shown)]:px-1"
                  >
                    Name *
                  </label>
                </div>
                <div class="relative w-full">
                  <input
                    type="email"
                    id="review-email"
                    class="peer form-control input-group medium rounded-[80px] px-3.5 placeholder-transparent focus:placeholder-transparent focus:outline-none"
                    placeholder="Email *"
                  />
                  <label
                    for="review-email"
                    class="absolute left-[14px] top-1/2 -translate-y-1/2 text-xs leading-[18px] transition-all peer-placeholder-shown:text-light-disabled-text peer-focus:text-light-disabled-text peer-placeholder-shown:text-[16px] peer-placeholder-shown:top-1/2 peer-focus:text-[12px] peer-focus:top-0 peer-[:not(:placeholder-shown)]:text-[12px] peer-[:not(:placeholder-shown)]:top-0 bg-white peer-focus:px-1 peer-[:not(:placeholder-shown)]:px-1"
                  >
                    Email *
                  </label>
                </div>
                <div class="flex md:justify-end justify-center gap-x-4">
                  <button class="btn btn-default outline btn-large rounded-[100px] py-[11px] shadow-none">
                    Cancel
                  </button>
                  <button class="btn btn-primary btn-large rounded-[100px] py-[11px]">
                    Post Review
                  </button>
                </div>
              </form>
            </div>
          </div>
          
          <div class="comment-list-wrapper p-6">
            <div class="comment-list-title flex items-center justify-between pb-6 border-b border-gray-300 mb-6">
              <h5>Customer Ratings & Review</h5>
              <div class="relative min-w-[100px]">
                <select id="review-sorting" class="rounded-[100px]! review-select filter-select label">
                  <option value="newest">Newest</option>
                  <option value="oldest">Oldest</option>
                  <option value="popular">Popular</option>
                  <option value="rating">Rating</option>
                </select>
                <label for="review-sorting" class="nice-select-label">Sorting</label>
              </div>
            </div>
            <ol class="comment-list">
              <li class="comment">
                <div class="comment-body">
                  <div class="comment-avatar-card flex items-center gap-x-4 mb-3">
                    <div class="comment-author-avatar size-12 rounded-full">
                      <img src="assets/images/blog/user-avatar-1.png" alt="Comment Author Avatar" />
                    </div>
                    <div class="comment-author-info">
                      <h6 class="font-semibold">John Doe</h6>
                      <p class="text-sm text-light-disabled-text">2 days ago</p>
                    </div>
                  </div>
                  <div class="rating-section flex items-center mb-3">
                    <div
                      class="bg-[url('../images/star-icon.png')] w-[90px] h-4.5 bg-repeat-x overflow-hidden bg-position-[0_0]"
                    >
                      <div
                        style="width: 80%"
                        class="bg-[url('../images/star-icon.png')] h-4.5 bg-repeat-x bg-position-[0_-18px]"
                      ></div>
                    </div>
                  </div>
                  <p class="mb-4">
                    Excellent product! The quality exceeded my expectations. Would definitely recommend to others looking for authentic handcrafted items.
                  </p>
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
