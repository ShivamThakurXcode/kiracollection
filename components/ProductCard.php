<?php
/**
 * Dynamic Product Card Component
 * Reusable product card component for the Kira Collection e-commerce site
 */
class ProductCard
{
    private $product;
    private $cardType;
    private $animationDelay;

    public function __construct($product, $cardType = 'default', $animationDelay = '0.2s')
    {
        $this->product = $product;
        $this->cardType = $cardType;
        $this->animationDelay = $animationDelay;
    }

    /**
     * Render the product card HTML
     */
    public function render()
    {
        $cardClass = $this->getCardClass();
        $borderClass = $this->getBorderClass();

        return "
        <div class='{$cardClass} {$borderClass} wow animate__animated animate__fadeInUp' data-wow-delay='{$this->animationDelay}'>
            {$this->renderProductImage()}
            {$this->renderProductContent()}
        </div>";
    }

    /**
     * Get card CSS classes based on type
     */
    private function getCardClass()
    {
        $baseClasses = "rounded-2xl product-card-1 p-4 group";

        switch ($this->cardType) {
            case 'bordered':
                return "border border-gray-300 {$baseClasses}";
            case 'white-bg':
                return "bg-white {$baseClasses}";
            default:
                return "bg-white {$baseClasses}";
        }
    }

    /**
     * Get border class if needed
     */
    private function getBorderClass()
    {
        return in_array($this->cardType, ['bordered']) ? '' : '';
    }

    /**
     * Format price with rupee symbol when missing
     */
    private function formatPrice($price)
    {
        if ($price === null || $price === '') {
            return '';
        }

        $priceStr = trim((string) $price);
        if (preg_match('/[₹$]/', $priceStr)) {
            return $priceStr;
        }

        $numeric = preg_replace('/[^0-9.]/', '', $priceStr);
        if ($numeric === '') {
            return $priceStr;
        }

        $value = (float) $numeric;
        $value = floor($value) == $value ? (int) $value : $value;

        return '₹' . number_format($value, 0, '.', ',');
    }

    /**
     * Format discount percentage to "NN% OFF" when missing
     */
    private function formatDiscountPercentage($discount)
    {
        if ($discount === null || $discount === '') {
            return '';
        }

        $discountStr = trim((string) $discount);
        if (stripos($discountStr, '%') !== false) {
            return strtoupper($discountStr);
        }

        if (preg_match('/^[0-9]+(\.[0-9]+)?$/', $discountStr)) {
            $clean = rtrim(rtrim($discountStr, '0'), '.');
            return $clean . '% OFF';
        }

        return $discountStr;
    }

    /**
     * Render product image section
     */
    private function renderProductImage()
    {
        $imageUrl = $this->product['image'] ?? 'assets/images/product-placeholder.png';
        $productName = $this->product['name'] ?? 'Product';
        $productId = $this->product['id'] ?? 1;
        $productUrl = 'product-detail.php?id=' . $productId;

        return "
        <div class='product-image-container relative'>
            <div class='product-image rounded-xl mb-4 overflow-hidden h-[300px] bg-primary-lighter'>
                <a href='{$productUrl}'>
                    <img 
                        src='{$imageUrl}' 
                        alt='{$productName}' 
                        class='group-hover:scale-110 transition-all transform group-hover:-rotate-3 ease-in-out duration-300 h-full w-full object-cover'
                    />
                </a>
            </div>
            {$this->renderActionButtons()}
        </div>";
    }

    /**
     * Render action buttons (wishlist, quick view)
     */
    private function renderActionButtons()
    {
        $productId = $this->product['id'] ?? 1;
        $productName = $this->product['name'] ?? 'Product';
        $productPrice = $this->formatPrice($this->product['current_price'] ?? '₹0');
        $productOldPrice = $this->formatPrice($this->product['old_price'] ?? '');
        $productImage = $this->product['image'] ?? 'assets/images/default-product.png';
        $productRating = $this->product['rating'] ?? 0;
        $productReviews = $this->product['reviews'] ?? 0;
        $productSku = $this->product['sku'] ?? ('SKU-' . str_pad($productId, 3, '0', STR_PAD_LEFT));
        $productData = htmlspecialchars(json_encode([
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'old_price' => $productOldPrice,
            'image' => $productImage,
            'rating' => $productRating,
            'reviews' => $productReviews,
            'sku' => $productSku,
        ]), ENT_QUOTES, 'UTF-8');

        return "
        <div class='product-btn-actions absolute bottom-0 right-0 left-0 flex justify-center z-9 transition-all duration-300 ease-in-out opacity-0 group-hover:opacity-100 group-hover:bottom-3'>
            <ul class='flex items-center gap-x-px'>
                <li>
                    <button type='button' data-product='{$productData}' aria-label='Add to Wishlist' class='add-to-wishlist-btn product-btn-action-item relative size-11 bg-white inline-flex items-center justify-center rounded-tl-sm rounded-bl-sm before:absolute before:left-[calc(50%-8px)] before:bottom-full before:z-9 before:border-8 before:border-transparent before:border-t-black before:opacity-0 before:invisible before:-mb-3.5 hover:before:opacity-100 hover:before:visible before:transition-all before:duration-300 after:absolute after:bottom-full after:left-1/2 after:-translate-x-1/2 after:rounded-sm after:bg-gray-800 after:whitespace-nowrap after:text-white after:text-xs after:leading-[18px] after:py-[3px] after:px-2 after:content-[attr(aria-label)] after:opacity-0 after:invisible after:transition-all after:duration-300 hover:after:opacity-100 hover:after:visible hover:after:-translate-y-2.5 hover:before:-translate-y-2.5'>
                        <i class='hgi hgi-stroke hgi-favourite text-2xl leading-6 text-light-secondary-text'></i>
                    </button>
                </li>
                <li>
                    <a aria-label='Quick view' data-product='{$productData}' class='quick-view-sidebar-btn product-btn-action-item relative size-11 bg-white inline-flex items-center justify-center rounded-tr-sm rounded-br-sm before:absolute before:left-[calc(50%-8px)] before:bottom-full before:z-9 before:border-8 before:border-transparent before:border-t-black before:opacity-0 before:invisible before:-mb-3.5 hover:before:opacity-100 hover:before:visible before:transition-all before:duration-300 after:absolute after:bottom-full after:left-1/2 after:-translate-x-1/2 after:rounded-sm after:bg-gray-800 after:whitespace-nowrap after:text-white after:text-xs after:leading-[18px] after:py-[3px] after:px-2 after:content-[attr(aria-label)] after:opacity-0 after:invisible after:transition-all after:duration-300 hover:after:opacity-100 hover:after:visible hover:after:-translate-y-2.5 hover:before:-translate-y-2.5' href='#'>
                        <i class='hgi hgi-stroke hgi-view text-2xl leading-6 text-light-primary-text'></i>
                    </a>
                </li>
            </ul>
        </div>";
    }

    /**
     * Render product content section
     */
    private function renderProductContent()
    {
        return "
        <div class='product-content'>
            {$this->renderCategory()}
            {$this->renderProductName()}
            {$this->renderPriceSection()}
            {$this->renderRatingSection()}
            {$this->renderActionSection()}
        </div>";
    }

    /**
     * Render discount badge if available
     */
    private function renderDiscountBadge()
    {
        if (!empty($this->product['discount_badge'])) {
            return "
            <span class='product-discount-badge inline-block relative bg-error text-warning-lighter font-medium text-sm leading-[22px] px-1 after:absolute after:top-0 after:left-full after:z-10 after:w-1 after:h-full after:bg-[url(\"images/discount-shape.png\")] after:bg-no-repeat after:bg-contain uppercase'>
                {$this->product['discount_badge']}
            </span>";
        }
        return '';
    }

    /**
     * Render category/store name
     */
    private function renderCategory()
    {
        $category = $this->product['category'] ?? 'Store Name/Category';
        $badge = $this->renderDiscountBadge();
        return "
        <div class='py-3 flex items-center justify-between gap-3 text-sm leading-[22px]'>
            <span>{$category}</span>
            {$badge}
        </div>";
    }

    /**
     * Render product name
     */
    private function renderProductName()
    {
        $name = $this->product['name'] ?? 'Product Name';
        $productId = $this->product['id'] ?? 1;
        $url = 'product-detail.php?id=' . $productId;
        return "
        <h6 class='text-[18px] leading-7 font-bold pb-3'>
            <a href='{$url}'>{$name}</a>
        </h6>";
    }

    /**
     * Render price section
     */
    private function renderPriceSection()
    {
        $currentPrice = $this->formatPrice($this->product['current_price'] ?? '$0.00');
        $oldPrice = $this->formatPrice($this->product['old_price'] ?? '');
        $discountPercentage = $this->formatDiscountPercentage($this->product['discount_percentage'] ?? '');

        $priceHtml = "<span class='current-price text-[16px] leading-6 font-semibold text-light-primary-text'>{$currentPrice}</span>";

        if (!empty($oldPrice)) {
            $priceHtml .= "<span class='old-price text-sm leading-[22px] text-light-disabled-text line-through'>{$oldPrice}</span>";
        }

        if (!empty($discountPercentage)) {
            $priceHtml .= "<span class='discount-percentage text-sm leading-[22px] font-semibold text-error'>{$discountPercentage}</span>";
        }

        return "<div class='price-section flex items-center gap-x-3 mb-3'>{$priceHtml}</div>";
    }

    /**
     * Render rating section
     */
    private function renderRatingSection()
    {
        $rating = $this->product['rating'] ?? 0;
        $reviews = $this->product['reviews'] ?? 0;
        $ratingWidth = ($rating / 5) * 100; // Convert to percentage

        return "
        <div class='rating-section flex items-center mb-3'>
            <div class='bg-[url(\"../images/star-icon.png\")] w-[90px] h-4.5 bg-repeat-x overflow-hidden bg-position-[0_0]'>
                <div style='width: {$ratingWidth}%' class='bg-[url(\"../images/star-icon.png\")] h-4.5 bg-repeat-x bg-position-[0_-18px]'></div>
            </div>
        </div>";
    }

    /**
     * Render action section with add to cart button only
     */
    private function renderActionSection()
    {
        $productId = $this->product['id'] ?? 1;
        $productName = $this->product['name'] ?? 'Product';
        $productPrice = $this->formatPrice($this->product['current_price'] ?? '₹0');
        $productOldPrice = $this->formatPrice($this->product['old_price'] ?? '');
        $productImage = $this->product['image'] ?? 'assets/images/default-product.png';
        $productRating = $this->product['rating'] ?? 0;
        $productReviews = $this->product['reviews'] ?? 0;
        $productSku = $this->product['sku'] ?? ('SKU-' . str_pad($productId, 3, '0', STR_PAD_LEFT));
        $productData = htmlspecialchars(json_encode([
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'old_price' => $productOldPrice,
            'image' => $productImage,
            'rating' => $productRating,
            'reviews' => $productReviews,
            'sku' => $productSku,
        ]), ENT_QUOTES, 'UTF-8');

        return "
        <div class='btn-section flex items-center gap-x-4'>
            <button class='add-to-cart-btn btn btn-primary rounded-full font-semibold text-sm leading-6 px-6.5 py-2 flex-1' data-product='{$productData}'>
                <i class='hgi hgi-stroke hgi-shopping-cart-02 text-xl text-white'></i>
                <span>Add to Cart</span>
            </button>
        </div>";
    }
}

/**
 * Helper function to render multiple product cards
 */
function renderProductCards($products, $cardType = 'default', $containerClass = 'mx-3 ')
{
    $html = '';
    $delay = 0.2;

    foreach ($products as $index => $product) {
        $currentDelay = ($delay + ($index * 0.1)) . 's';
        $card = new ProductCard($product, $cardType, $currentDelay);
        $html .= "
        <div class='{$containerClass}'>
            {$card->render()}
        </div>";
    }

    return $html;
}
?>