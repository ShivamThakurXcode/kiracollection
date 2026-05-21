<!-- Cart Sidebar Start -->
<div data-state="close" class="cart-sidebar fixed xl:top-[30px] xl:right-[22px] right-0 top-0 xl:h-[calc(100vh-52px)] h-full z-99 max-w-[480px] w-full bg-white xl:rounded-2xl rounded-none shadow-2xl transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-x-0 data-[state=open]:opacity-100 data-[state=open]:visible data-[state=close]:translate-x-[200px] data-[state=close]:opacity-0 data-[state=close]:invisible">
  <div class="cart-products w-full h-full flex flex-col">
    <!-- Header -->
    <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-primary-lighter to-amber-50">
      <div>
        <h5 class="text-lg font-bold text-light-primary-text">Shopping Cart</h5>
        <p class="text-sm text-light-secondary-text"><span id="cartItemsCount">0</span> Item(s) in Cart</p>
      </div>
      <button data-close-sidebar=".cart-sidebar" class="close-sidebar-btn cursor-pointer inline-flex items-center justify-center size-9 rounded-full bg-white hover:bg-primary-lighter transition-colors shadow-sm">
        <i class="hgi hgi-stroke hgi-multiplication-sign text-xl leading-5 text-light-primary-text"></i>
      </button>
    </div>

    <!-- Cart Items -->
    <div id="cartItemsContainer" class="flex-1 overflow-y-auto px-4 py-4 space-y-3">
      <!-- Rendered by JavaScript -->
    </div>

    <!-- Empty Cart -->
    <div id="cartEmptyState" class="flex-1 flex flex-col items-center justify-center px-6 py-10 hidden">
      <div class="w-20 h-20 rounded-full bg-primary-lighter flex items-center justify-center mb-4">
        <i class="hgi hgi-stroke hgi-shopping-cart-01 text-4xl text-primary/60"></i>
      </div>
      <p class="text-lg font-semibold text-light-primary-text mb-1">Your cart is empty</p>
      <p class="text-sm text-light-secondary-text mb-6 text-center">Looks like you haven't added any items yet</p>
      <a href="shop.php" class="btn btn-primary rounded-[60px] px-6 py-2.5 text-sm font-semibold">Start Shopping</a>
    </div>

    <!-- Footer -->
    <div id="cartFooter" class="border-t border-gray-200 p-5 space-y-3 bg-gray-50/50">
      <div class="flex items-center justify-between">
        <span class="text-sm font-medium text-light-secondary-text">Subtotal</span>
        <span id="cartSubtotal" class="text-lg font-bold text-primary">₹0</span>
      </div>
      <div class="flex items-center gap-x-3">
        <a href="cart.php" class="flex-1 btn btn-default outline shadow-none border border-gray-300 hover:border-primary hover:text-primary rounded-[60px] py-2.5 text-sm font-semibold text-center transition-colors">
          View Cart
        </a>
        <a href="checkout.php" class="flex-1 btn btn-primary rounded-[60px] py-2.5 text-sm font-semibold text-center transition-all hover:shadow-lg hover:shadow-primary/20">
          Checkout
        </a>
      </div>
    </div>
  </div>
</div>
<!-- Cart Sidebar End -->
