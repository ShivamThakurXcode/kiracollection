<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Account - KiraCollection Art</title>
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

  <?php
  $pageTitle = 'My Account';
  $breadcrumbBg = 'images/breadcrumb/b-1.jpg';
  include 'components/breadcrumb.php';
  ?>

  <section class="pb-[70px] pt-8">
    <div class="container">
      <!-- Account Header -->
      <div class="flex items-center gap-4 mb-8">
        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center">
          <i class="hgi hgi-stroke hgi-user text-3xl text-amber-600"></i>
        </div>
        <div>
          <h2 class="text-2xl font-bold text-gray-800" id="account-greeting">Hello, Guest</h2>
          <p class="text-gray-500 text-sm">Manage your orders and profile</p>
        </div>
      </div>

      <!-- Tabs -->
      <div class="flex gap-2 border-b border-gray-200 mb-8">
        <button
          class="tab-btn px-6 py-3 font-semibold text-sm border-b-2 transition-colors border-amber-500 text-amber-600"
          data-tab="orders">My Orders</button>
        <button
          class="tab-btn px-6 py-3 font-semibold text-sm border-b-2 transition-colors border-transparent text-gray-500 hover:text-amber-600"
          data-tab="profile">My Profile</button>
      </div>

      <!-- Tab: My Orders -->
      <div id="tab-orders">
        <div id="orders-empty" class="text-center py-16 hidden">
          <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="hgi hgi-stroke hgi-package text-4xl text-gray-400"></i>
          </div>
          <p class="text-gray-500 text-lg mb-4">No orders yet</p>
          <a href="shop.php" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-6 py-3 rounded-full text-sm transition-colors">
            Start Shopping
          </a>
        </div>
        <div id="orders-list" class="flex flex-col gap-4"></div>
      </div>

      <!-- Tab: My Profile -->
      <div id="tab-profile" class="hidden max-w-lg">
        <form id="profile-form" class="flex flex-col gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" name="name" id="profile-name"
              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm"
              placeholder="Your full name" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" name="email" id="profile-email"
              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm"
              placeholder="your@email.com" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="tel" name="phone" id="profile-phone"
              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm"
              placeholder="+91 XXXXX XXXXX" />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <textarea name="address" id="profile-address" rows="3"
              class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm resize-none"
              placeholder="Your delivery address"></textarea>
          </div>
          <button type="submit"
            class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3.5 rounded-full text-sm transition-colors">
            Save Profile
          </button>
          <p id="profile-saved" class="text-green-600 text-sm text-center hidden">Profile saved successfully!</p>
        </form>
      </div>
    </div>
  </section>

  <?php include 'components/subscribe-section.php' ?>
  <?php include 'components/footer.php' ?>
  <?php include 'components/scripts.php' ?>

  <script>
  (function () {
    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        document.querySelectorAll('.tab-btn').forEach(function (b) {
          b.classList.remove('border-amber-500', 'text-amber-600');
          b.classList.add('border-transparent', 'text-gray-500');
        });
        this.classList.add('border-amber-500', 'text-amber-600');
        this.classList.remove('border-transparent', 'text-gray-500');
        document.getElementById('tab-orders').classList.add('hidden');
        document.getElementById('tab-profile').classList.add('hidden');
        document.getElementById('tab-' + this.dataset.tab).classList.remove('hidden');
      });
    });

    // Load profile
    function loadProfile() {
      var profile = {};
      try { profile = JSON.parse(localStorage.getItem('kira_profile') || '{}'); } catch(e) {}
      if (profile.name) {
        document.getElementById('account-greeting').textContent = 'Hello, ' + profile.name;
        document.getElementById('profile-name').value = profile.name || '';
        document.getElementById('profile-email').value = profile.email || '';
        document.getElementById('profile-phone').value = profile.phone || '';
        document.getElementById('profile-address').value = profile.address || '';
      }
    }

    // Save profile
    document.getElementById('profile-form').addEventListener('submit', function (e) {
      e.preventDefault();
      var data = {
        name: document.getElementById('profile-name').value,
        email: document.getElementById('profile-email').value,
        phone: document.getElementById('profile-phone').value,
        address: document.getElementById('profile-address').value
      };
      localStorage.setItem('kira_profile', JSON.stringify(data));
      if (data.name) document.getElementById('account-greeting').textContent = 'Hello, ' + data.name;
      var msg = document.getElementById('profile-saved');
      msg.classList.remove('hidden');
      setTimeout(function () { msg.classList.add('hidden'); }, 3000);
    });

    // Load orders from localStorage
    function loadOrders() {
      var orders = [];
      try { orders = JSON.parse(localStorage.getItem('kira_orders') || '[]'); } catch(e) {}
      var list = document.getElementById('orders-list');
      var empty = document.getElementById('orders-empty');
      if (!orders.length) {
        empty.classList.remove('hidden');
        list.innerHTML = '';
        return;
      }
      empty.classList.add('hidden');
      var html = '';
      orders.forEach(function (o) {
        var statusColor = o.status === 'paid' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700';
        html += '<div class="border border-gray-200 rounded-2xl p-5">' +
          '<div class="flex items-start justify-between gap-4 mb-3">' +
          '<div><p class="text-xs text-gray-500">Order #</p><p class="font-bold text-gray-800">' + (o.orderNumber || 'N/A') + '</p></div>' +
          '<span class="px-3 py-1 rounded-full text-xs font-semibold ' + statusColor + '">' + (o.status || 'Pending') + '</span>' +
          '</div>' +
          '<div class="text-sm text-gray-600 flex gap-6">' +
          '<span>' + (o.date || '') + '</span>' +
          '<span class="font-semibold text-gray-800">₹' + (o.total || '0') + '</span>' +
          '</div>' +
          '</div>';
      });
      list.innerHTML = html;
    }

    loadProfile();
    loadOrders();
  })();
  </script>
</body>
</html>
