<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wishlist - KiraCollection Art</title>
  <?php include 'components/links.php'; ?>
</head>

<body>

  <?php include 'components/preloader.php' ?>

  <?php include 'components/modal-overlay.php' ?>

  

  <?php include 'components/sidebar.php' ?>

  <?php include 'components/cart-sidebar-inline.php' ?>

  <?php include 'components/register-sidebar.php' ?>

  <?php include 'components/login-sidebar.php' ?>

  <?php include 'components/forgot-password-sidebar.php' ?>

  <?php include 'components/otp-verification-sidebar.php' ?>

  <?php include 'components/quick-view-sidebar.php' ?>

  <?php include "components/header.php" ?>

  <!-- Breadcrumb Section -->
  <?php
  $pageTitle = 'Wishlist';
  $breadcrumbBg = 'assets/images/about/woman-bg.png';
  include 'components/breadcrumb.php';
  ?>

  <!-- Wishlist Section -->
  <section class="pb-[70px] pt-8">
    <div class="container">
      <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-x-2">
          <h2 class="text-2xl md:text-3xl font-bold text-light-primary-text">Wishlist</h2>
          <span class="text-light-secondary-text text-lg" id="wishlistItemsCount">(0 items)</span>
        </div>
      </div>

      <div id="wishlistEmptyState" class="text-center py-12 hidden">
        <p class="text-light-secondary-text text-lg mb-4">Your wishlist is empty.</p>
        <a href="shop.php" class="btn btn-primary btn-large rounded-[60px] inline-block">Browse Products</a>
      </div>

      <div id="wishlistItemsGrid" class="grid grid-cols-12 gap-6"></div>
    </div>
  </section>

  <?php include 'components/subscribe-section.php' ?>

  <?php include 'components/footer.php' ?>
  <?php include 'components/scripts.php' ?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      function renderWishlistPage() {
        if (!window.getWishlist) return;

        var items = window.getWishlist();
        var grid = document.getElementById('wishlistItemsGrid');
        var emptyState = document.getElementById('wishlistEmptyState');
        var countEl = document.getElementById('wishlistItemsCount');

        countEl.textContent = '(' + items.length + ' items)';

        if (!items.length) {
          grid.innerHTML = '';
          emptyState.classList.remove('hidden');
          return;
        }

        emptyState.classList.add('hidden');

        var html = '';
        items.forEach(function (item) {
          var img = item.image || 'assets/images/default-product.png';
          var price = item.price || '₹0';
          var productData = JSON.stringify({
            id: item.id,
            name: item.name,
            price: item.price,
            image: item.image
          }).replace(/"/g, '&quot;');

          html +=
            '<div class="col-span-12 md:col-span-6 lg:col-span-4">' +
            '<div class="border border-gray-300 rounded-2xl p-6 bg-white h-full flex flex-col">' +
            '<div class="mb-4 h-[220px] overflow-hidden rounded-xl bg-[#F4F3F5]">' +
            '<img src="' + img + '" alt="' + item.name + '" class="w-full h-full object-cover" onerror="this.style.display=\'none\'" />' +
            '</div>' +
            '<h6 class="text-lg font-semibold text-light-primary-text mb-3">' + item.name + '</h6>' +
            '<p class="text-light-primary-text font-semibold mb-4">' + price + '</p>' +
            '<div class="mt-auto flex items-center justify-between gap-3">' +
            '<button class="add-to-cart-btn btn btn-primary rounded-[60px] py-2 px-4 text-sm" data-product="' + productData + '">Add to Cart</button>' +
            '<button class="wishlist-remove text-error hover:text-red-700" data-id="' + item.id + '"><i class="hgi hgi-stroke hgi-delete-01 text-xl"></i></button>' +
            '</div>' +
            '</div>' +
            '</div>';
        });

        grid.innerHTML = html;

        grid.querySelectorAll('.wishlist-remove').forEach(function (btn) {
          btn.addEventListener('click', function () {
            var id = this.getAttribute('data-id');
            if (window.removeFromWishlist) {
              window.removeFromWishlist(id);
            }
            renderWishlistPage();
          });
        });
      }

      renderWishlistPage();
    });
  </script>

</body>

</html>