<!-- Quick View Sidebar Start -->
<div data-state="close" class="quick-view-sidebar fixed xl:top-[30px] xl:right-[22px] right-0 top-0 xl:h-[calc(100vh-52px)] h-full z-99 max-w-[950px] w-full bg-white xl:rounded-2xl rounded-none transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-x-0 data-[state=open]:opacity-100 data-[state=open]:visible data-[state=close]:translate-x-[200px] data-[state=close]:opacity-0 data-[state=close]:invisible">
    <div class="quick-view-sidebar-header px-6 py-[15px] border-b border-gray-300 relative">
        <h5>Quick View</h5><button data-close-sidebar=".quick-view-sidebar" class="close-sidebar-btn absolute top-1/2 right-6 -translate-y-1/2 cursor-pointer inline-flex items-center justify-center size-9 rounded-full bg-[rgba(145,158,171,0.08)]"><i class="hgi hgi-stroke hgi-multiplication-sign text-xl leading-5 text-light-primary-text"></i></button>
    </div>
    <div class="quick-view-sidebar-content lg:flex lg:flex-row p-6 gap-x-6 gap-y-6 lg:gap-y-0 w-full lg:h-full h-[calc(100%-60px)] overflow-y-auto">
        <div class="product-images-wrapper lg:max-w-[350px] w-full lg:flex-none lg:overflow-y-auto lg:h-[calc(100%-60px)] h-auto mb-6 lg:mb-0">
            <div class="space-y-4" id="quickViewImages">
                <img class="max-h-[300px] w-full rounded-xl object-cover" src="assets/images/default-product.png" alt="product-image" />
            </div>
        </div>
        <div class="product-details-wrapper w-full lg:flex-1 @container/quick-view-product-details lg:overflow-y-auto lg:h-[calc(100%-60px)] h-auto pr-4">
            <p class="uppercase text-info text-xs leading-[18px] font-bold new-arrival-badge mb-4">New Arrival</p>
            <h4 class="line-clamp-2 mb-4" id="quickViewTitle">Product Name</h4>
            <div class="rating-section flex items-center mb-4">
                <div class="flex items-center gap-x-1" id="quickViewRating">
                    <i class="hgi hgi-stroke hgi-star text-secondary text-lg"></i>
                    <i class="hgi hgi-stroke hgi-star text-secondary text-lg"></i>
                    <i class="hgi hgi-stroke hgi-star text-secondary text-lg"></i>
                    <i class="hgi hgi-stroke hgi-star text-secondary text-lg"></i>
                    <i class="hgi hgi-stroke hgi-star text-gray-300 text-lg"></i>
                </div>
                <span class="font-normal inline-block ml-1" id="quickViewReviews">(0 reviews)</span>
            </div>
            <div class="price-section flex items-center gap-x-3 mb-6">
                <span class="current-price text-2xl leading-9 font-bold text-light-primary-text relative after:absolute after:h-6 after:w-px after:bg-gray-300 after:right-0 after:top-1/2 after:-translate-y-1/2 pr-3 inline-block" id="quickViewPrice">₹0</span>
                <span class="old-price text-2xl leading-9 font-normal text-light-disabled-text" id="quickViewOldPrice"></span>
            </div>
            <div class="product-add-to-cart-section py-6 border-b border-dashed border-gray-300 border-t">
                <div class="product-add-to-cart-btn-section">
                    <p class="font-semibold text-light-primary-text mb-4">Quantity:</p>
                    <div class="flex items-center justify-between gap-x-4 gap-y-4 flex-wrap md:flex-nowrap md:gap-y-0">
                        <div class="quantity-section flex-1 max-w-[126px] border border-gray-300 rounded-[80px] px-4 py-[11px] flex items-center justify-between"><button class="quantity-btn inline-flex items-center justify-center hover:text-primary"><i class="hgi hgi-stroke hgi-minus-sign text-xl leading-5"></i></button><input type="text" class="quantity-input text-center w-full focus:outline-none font-semibold text-base leading-6 text-light-primary-text" value="1" /><button class="quantity-btn inline-flex items-center justify-center hover:text-primary"><i class="hgi hgi-stroke hgi-plus-sign text-xl leading-5"></i></button></div>
                        <div class="flex-1"><a href="#" class="btn btn-warning btn-large rounded-[80px] w-full">Buy Now</a></div>
                        <div class="flex-1"><button type="button" class="add-to-cart-btn btn btn-primary btn-large rounded-[80px] w-full"><i class="hgi hgi-stroke hgi-shopping-cart-add-02 text-2xl leading-6 text-white"></i> Add to Cart</button></div>
                    </div>
                </div>
            </div>
            <div class="product-extra-info-section flex flex-col gap-y-4 my-6" id="quickViewExtraInfo">
                <div class="product-extra-info-item flex items-center gap-x-4 gap-y-4 flex-wrap @md/quick-view-product-details:flex-nowrap @md/quick-view-product-details:gap-y-0">
                    <p class="font-semibold text-light-primary-text">SKU:</p>
                    <p id="quickViewSku">SKU-001</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View Sidebar End -->
