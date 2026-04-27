<!-- Cart Sidebar Start -->
<div data-state="close" class="cart-sidebar flex fixed xl:top-[30px] xl:right-[22px] right-0 top-0 xl:h-[calc(100vh-52px)] h-full z-99 max-w-[600px] w-full bg-white xl:rounded-2xl rounded-none transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-x-0 data-[state=open]:opacity-100 data-[state=open]:visible data-[state=close]:translate-x-[200px] data-[state=close]:opacity-0 data-[state=close]:invisible">
    <div class="cart-products xl:max-w-[600px] w-full h-full flex flex-col justify-between">
        <div class="cart-products-header pt-6 px-6 pb-4 border-b border-gray-300 flex flex-col gap-y-1 relative">
            <h5>Cart Products</h5>
            <p>1 Item in Cart</p>
            <button data-close-sidebar=".cart-sidebar" class="close-sidebar-btn absolute top-6 right-6 cursor-pointer inline-flex items-center justify-center size-9 rounded-full bg-[rgba(145,158,171,0.08)]">
                <i class="hgi hgi-stroke hgi-multiplication-sign text-xl leading-5 text-light-primary-text"></i>
            </button>
        </div>
        <div class="cart-products-content p-6 flex flex-col gap-y-4 overflow-y-auto h-[calc(100%-250px)]">
            <?php for ($i = 0; $i < 5; $i++): ?>
                <div class="cart-product-item flex flex-col sm:flex-row items-center sm:gap-x-4 gap-y-2 sm:gap-y-0 p-4 border border-gray-300 rounded-2xl">
                    <a class='cart-product-item-image sm:w-[102px] sm:h-[102px] rounded-xl bg-[#F4F3F5] overflow-hidden relative' href='product-details.html'>
                        <img src="assets/images/home-3/watermelon.png" alt="Product Image" class="w-full h-full object-cover rounded-xl" />
                    </a>
                    <div class="cart-product-item-content flex flex-col gap-y-2 flex-1 w-full">
                        <div class="flex items-center justify-between gap-x-2">
                            <h6 class="text-base font-semibold"><a href='product-details.html'>Fresh Bask Basket Fruits</a></h6>
                            <div class="cart-edit-remove flex items-center gap-x-3">
                                <button><i class="hgi hgi-stroke hgi-edit-02 text-xl text-light-primary-text"></i></button>
                                <button><i class="hgi hgi-stroke hgi-delete-01 text-xl text-light-primary-text"></i></button>
                            </div>
                        </div>
                        <p class="text-sm leading-[22px]">Color: Black, Size: 250 ML</p>
                        <div class="flex items-center justify-between">
                            <div class="price-section flex items-center gap-x-3">
                                <span class="current-price text-base font-semibold text-light-primary-text">$27.49</span>
                                <span class="old-price text-base text-light-disabled-text line-through">$39.99</span>
                            </div>
                            <div class="border border-gray-300 inline-flex items-center justify-center rounded-[80px] max-w-[108px] py-2.5 px-4">
                                <button class="inline-flex items-center justify-center hover:text-primary"><i class="hgi hgi-stroke hgi-remove-circle text-2xl leading-6"></i></button>
                                <input type="text" readonly value="1" class="border-0 w-full grow text-center focus:outline-none font-semibold" />
                                <button class="inline-flex items-center justify-center hover:text-primary"><i class="hgi hgi-stroke hgi-add-circle text-2xl leading-6"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="cart-products-footer p-6 border-t border-gray-300 flex flex-col gap-y-4">
            <div class="cart-subtotal flex items-center justify-between">
                <h5>Subtotal</h5>
                <h5>$27.49</h5>
            </div>
            <div class="cart-buttons flex items-center gap-x-4">
                <a class='btn btn-default outline btn-large rounded-[80px] flex-1 shadow-none' href='cart-single-vendor.html'>View Cart</a>
                <a class='btn btn-primary btn-large rounded-[80px] flex-1' href='checkout.html'>Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>
<!-- Cart Sidebar End -->
