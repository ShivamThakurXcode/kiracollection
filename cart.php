<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cart - KiraCollection Art</title>
  <?php include 'components/links.php'; ?>
</head>

<body>

  <?php include 'components/preloader.php' ?>

  <?php include 'components/modal-overlay.php' ?>

  <?php include 'components/scroll-to-top-button.php' ?>

  <?php include 'components/sidebar.php' ?>

  <?php include 'components/cart-sidebar-inline.php' ?>

  <?php include 'components/register-sidebar.php' ?>

  <?php include 'components/login-sidebar.php' ?>

  <?php include 'components/forgot-password-sidebar.php' ?>

  <?php include 'components/otp-verification-sidebar.php' ?>

  <?php include 'components/quick-view-sidebar.php' ?>

  <?php include "components/header.php" ?>

  <!-- Breadcrumb Section -->
  <?php include 'components/breadcrumb.php' ?>

  <!-- Cart Section -->
  <section class="pb-[70px] pt-8">
    <div class="container">
      <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-x-2">
          <h2 class="text-2xl md:text-3xl font-bold text-light-primary-text">Cart</h2>
          <span class="text-light-secondary-text text-lg" id="cartItemsCount">(0 items)</span>
        </div>
        <button id="cartRemoveAllBtn"
          class="inline-flex items-center gap-x-1.5 text-error hover:text-red-700 font-semibold transition-colors">
          <i class="hgi hgi-stroke hgi-cancel-01 text-xl"></i>
          Remove All
        </button>
      </div>

      <!-- Empty State -->
      <div id="cartEmptyState" class="hidden text-center py-20">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
          <i class="hgi hgi-stroke hgi-shopping-cart-01 text-5xl text-gray-300"></i>
        </div>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Your cart is empty</h3>
        <p class="text-gray-400 mb-6">Browse our handcrafted art collection and find something you love.</p>
        <a href="shop.php" class="btn btn-primary rounded-[60px] px-8 py-3 inline-block">Browse Products</a>
      </div>

      <div id="cartContent" class="grid grid-cols-12 gap-x-6 gap-y-8">
        <div class="xl:col-span-8 col-span-12">
          <div class="border border-gray-200 rounded-2xl overflow-hidden bg-white">
            <div class="overflow-x-auto">
            <table class="w-full cart-table min-w-[500px]">
              <thead class="bg-primary-lighter">
                <tr>
                  <th class="text-left font-semibold text-primary-dark px-4 py-3 text-sm uppercase tracking-wide">
                    Product</th>
                  <th class="text-left font-semibold text-primary-dark px-4 py-3 text-sm uppercase tracking-wide">Price
                  </th>
                  <th class="text-left font-semibold text-primary-dark px-4 py-3 text-sm uppercase tracking-wide">
                    Quantity</th>
                  <th class="text-left font-semibold text-primary-dark px-4 py-3 text-sm uppercase tracking-wide">Total
                  </th>
                  <th class="text-center font-semibold text-primary-dark px-4 py-3 text-sm uppercase tracking-wide">
                    Action</th>
                </tr>
              </thead>
              <tbody id="cartTableBody"></tbody>
            </table>
            </div>
          </div>
        </div>

        <div class="xl:col-span-4 col-span-12">
          <div class="border border-gray-200 rounded-2xl p-6 bg-white space-y-6">
            <div class="bg-primary-lighter/60 rounded-[100px] px-4 py-3">
              <a href="shop.php" class="flex items-center gap-x-2 text-sm font-bold text-light-primary-text">
                <span class="text-primary"><i class="hgi hgi-stroke hgi-car-03 text-2xl"></i></span>
                Spend ₹1,500 more for
                <span class="text-primary">Free Shipping</span>
              </a>
            </div>

            <div class="border border-gray-200 rounded-2xl px-6 py-8 space-y-5">
              <h3 class="text-lg font-bold text-light-primary-text">Order Summary</h3>

              <div class="relative">
                <div class="flex items-center border border-gray-300 rounded-[100px] overflow-hidden">
                  <input type="text" placeholder="Coupon Code"
                    class="flex-1 px-4 py-3 border-0 focus:outline-none text-sm" />
                  <button
                    class="bg-primary hover:bg-primary-dark text-white px-5 py-3 font-semibold text-sm transition-colors">Apply</button>
                </div>
              </div>

              <div class="space-y-3 pb-4 border-b border-gray-200">
                <div class="flex justify-between text-sm">
                  <span class="text-light-secondary-text">Sub-Total</span>
                  <span class="font-semibold text-light-primary-text" id="cartSubtotal">₹0</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-light-secondary-text">Shipping</span>
                  <span class="font-semibold text-success">Free</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-light-secondary-text">VAT (12%)</span>
                  <span class="font-semibold text-light-primary-text" id="cartVat">₹0</span>
                </div>
              </div>

              <div class="flex justify-between">
                <span class="font-bold text-light-primary-text">Total</span>
                <span class="font-bold text-lg text-primary" id="cartTotal">₹0</span>
              </div>

              <label class="flex items-center gap-x-3 cursor-pointer">
                <span class="relative inline-flex w-5 h-5">
                  <input type="checkbox"
                    class="peer appearance-none w-full h-full border-2 border-gray-300 rounded-sm bg-white checked:bg-primary checked:border-primary focus:outline-none transition-all" />
                  <span
                    class="absolute inset-0 inline-flex items-center justify-center text-white opacity-0 peer-checked:opacity-100 transition-all">
                    <i class="hgi hgi-stroke hgi-tick-02 text-[18px] leading-[18px]"></i>
                  </span>
                </span>
                <span class="text-sm text-light-secondary-text">
                  I agree with the <span class="text-primary font-semibold underline">Terms</span> and <span
                    class="text-primary font-semibold underline">Conditions</span>
                </span>
              </label>

              <div class="space-y-3">
                <button id="checkoutBtn"
                  class="btn btn-primary w-full py-3 rounded-[80px] text-center font-semibold block">Proceed to
                  Checkout</button>
                <a href="shop.php"
                  class="btn btn-default outline shadow-none w-full py-3 rounded-[80px] text-center font-semibold border border-gray-300 hover:border-primary hover:text-primary transition-colors block">
                  Continue Shopping
                  <i class="hgi hgi-stroke hgi-arrow-right-02 text-xl align-middle ml-1"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /#cartContent -->
    </div>
  </section>

  <?php include 'components/subscribe-section.php' ?>

  <?php include 'components/footer.php' ?>
  <?php include 'components/scripts.php' ?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var removeAllBtn = document.getElementById('cartRemoveAllBtn');
      if (removeAllBtn && window.getCart && window.removeFromCart) {
        removeAllBtn.addEventListener('click', function () {
          var items = window.getCart();
          items.forEach(function (item) {
            window.removeFromCart(item.id);
          });
          renderCartPage();
        });
      }

      function parsePrice(value) {
        return parseInt(String(value || '0').replace(/[^0-9]/g, ''), 10) || 0;
      }

      function formatPrice(value) {
        return '₹' + Number(value || 0).toLocaleString('en-IN');
      }

      function renderCartPage() {
        if (!window.getCart || !window.updateCartQuantity || !window.removeFromCart) return;

        var items = window.getCart();
        var empty = document.getElementById('cartEmptyState');
        var content = document.getElementById('cartContent');
        if (empty && content) {
          if (!items.length) {
            empty.classList.remove('hidden');
            content.classList.add('hidden');
          } else {
            empty.classList.add('hidden');
            content.classList.remove('hidden');
          }
        }

        var tbody = document.getElementById('cartTableBody');
        var countEl = document.getElementById('cartItemsCount');
        var subtotalEl = document.getElementById('cartSubtotal');
        var vatEl = document.getElementById('cartVat');
        var totalEl = document.getElementById('cartTotal');

        if (!tbody) return;

        var html = '';
        var subtotal = 0;
        var count = 0;

        items.forEach(function (item) {
          var qty = item.quantity || 1;
          var price = parsePrice(item.price);
          var lineTotal = price * qty;
          subtotal += lineTotal;
          count += qty;

          var productData = JSON.stringify({
            id: item.id,
            name: item.name,
            price: item.price,
            image: item.image
          }).replace(/"/g, '&quot;');

          html +=
            '<tr class="border-t border-gray-100">' +
            '<td class="py-4 px-4">' +
            '<div class="flex items-center gap-x-4">' +
            '<div class="w-20 h-20 rounded-xl bg-[#F4F3F5] flex-shrink-0 overflow-hidden">' +
            '<img src="' + (item.image || '') + '" alt="' + (item.name || 'Product') + '" class="w-full h-full object-cover" onerror="this.style.display=\'none\'" />' +
            '</div>' +
            '<div>' +
            '<a href="product-detail.php?id=' + item.id + '" class="font-semibold text-light-primary-text hover:text-primary transition-colors">' + (item.name || 'Product') + '</a>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '<td class="py-4 px-4">' +
            '<span class="font-semibold text-light-primary-text">' + formatPrice(price) + '</span>' +
            '</td>' +
            '<td class="py-4 px-4">' +
            '<div class="inline-flex items-center border border-gray-300 rounded-[80px] py-2 px-3">' +
            '<button class="cart-qty-minus hover:text-primary transition-colors" data-id="' + item.id + '"><i class="hgi hgi-stroke hgi-remove-circle text-xl"></i></button>' +
            '<input type="text" readonly value="' + qty + '" class="w-10 text-center border-0 focus:outline-none font-semibold text-light-primary-text bg-transparent" />' +
            '<button class="cart-qty-plus hover:text-primary transition-colors" data-id="' + item.id + '"><i class="hgi hgi-stroke hgi-add-circle text-xl"></i></button>' +
            '</div>' +
            '</td>' +
            '<td class="py-4 px-4">' +
            '<span class="font-semibold text-light-primary-text">' + formatPrice(lineTotal) + '</span>' +
            '</td>' +
            '<td class="py-4 px-4 text-center">' +
            '<div class="flex items-center justify-center gap-x-3">' +
            '<button class="add-to-wishlist-btn hover:text-primary transition-colors" data-product="' + productData + '" title="Add to Wishlist"><i class="hgi hgi-stroke hgi-favourite text-2xl text-light-secondary-text"></i></button>' +
            '<button class="cart-remove hover:text-error transition-colors" data-id="' + item.id + '" title="Remove"><i class="hgi hgi-stroke hgi-delete-01 text-2xl text-light-secondary-text"></i></button>' +
            '</div>' +
            '</td>' +
            '</tr>';
        });

        tbody.innerHTML = html;
        if (countEl) countEl.textContent = '(' + count + ' items)';

        var vat = Math.round(subtotal * 0.12);
        var total = subtotal + vat;
        if (subtotalEl) subtotalEl.textContent = formatPrice(subtotal);
        if (vatEl) vatEl.textContent = formatPrice(vat);
        if (totalEl) totalEl.textContent = formatPrice(total);

        tbody.querySelectorAll('.cart-qty-minus').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var id = this.getAttribute('data-id');
            var items = window.getCart();
            items.forEach(function (item) {
              if (String(item.id) === String(id)) {
                window.updateCartQuantity(item.id, (item.quantity || 1) - 1);
              }
            });
            renderCartPage();
          });
        });

        tbody.querySelectorAll('.cart-qty-plus').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var id = this.getAttribute('data-id');
            var items = window.getCart();
            items.forEach(function (item) {
              if (String(item.id) === String(id)) {
                window.updateCartQuantity(item.id, (item.quantity || 1) + 1);
              }
            });
            renderCartPage();
          });
        });

        tbody.querySelectorAll('.cart-remove').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var id = this.getAttribute('data-id');
            window.removeFromCart(id);
            renderCartPage();
          });
        });
      }

      // Show/hide empty state
      var allItems = window.getCart ? window.getCart() : [];
      var emptyState = document.getElementById('cartEmptyState');
      var cartContent = document.getElementById('cartContent');
      if (emptyState && cartContent) {
        if (allItems.length === 0) {
          emptyState.classList.remove('hidden');
          cartContent.classList.add('hidden');
        } else {
          emptyState.classList.add('hidden');
          cartContent.classList.remove('hidden');
        }
      }

      // Checkout button validation
      var checkoutBtn = document.getElementById('checkoutBtn');
      if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function () {
          var current = window.getCart ? window.getCart() : [];
          if (!current.length) {
            alert('Your cart is empty. Please add items before proceeding.');
            return;
          }
          window.location.href = 'checkout.php';
        });
      }

      renderCartPage();
    });
  </script>

</body>

</html>