<?php
require_once 'config/database.php';

// Handle COD order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  header('Content-Type: application/json');

  if ($_POST['action'] === 'place_cod_order') {
    try {
      $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8mb4", $db_user, $db_pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Create tables if not exist
      $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_number VARCHAR(20) UNIQUE NOT NULL,
        customer_name VARCHAR(200) NOT NULL,
        email VARCHAR(200) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        address TEXT NOT NULL,
        city VARCHAR(100) NOT NULL,
        state VARCHAR(100) NOT NULL,
        pincode VARCHAR(10) NOT NULL,
        country VARCHAR(100) DEFAULT 'India',
        total_amount DECIMAL(10,2) NOT NULL,
        payment_method VARCHAR(50) NOT NULL,
        payment_status VARCHAR(50) DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )");

      $pdo->exec("CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        product_id INT,
        product_name VARCHAR(300) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        quantity INT NOT NULL,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
      )");

      $orderNumber = 'KC' . date('Ymd') . strtoupper(substr(uniqid(), -6));
      $items = json_decode($_POST['items'] ?? '[]', true);
      $shipping = json_decode($_POST['shipping'] ?? '{}', true);
      $total = floatval($_POST['total'] ?? 0);
      $fullAddress = trim(($shipping['address1'] ?? '') . ' ' . ($shipping['address2'] ?? ''));

      $stmt = $pdo->prepare("INSERT INTO orders
        (order_number,customer_name,email,phone,address,city,state,pincode,country,total_amount,payment_method,payment_status)
        VALUES (?,?,?,?,?,?,?,?,?,?,'cod','pending')");
      $stmt->execute([
        $orderNumber,
        ($shipping['firstName'] ?? '') . ' ' . ($shipping['lastName'] ?? ''),
        $shipping['email'] ?? '',
        $shipping['phone'] ?? '',
        $fullAddress,
        $shipping['city'] ?? '',
        $shipping['state'] ?? '',
        $shipping['pincode'] ?? '',
        $shipping['country'] ?? 'India',
        $total
      ]);
      $orderId = $pdo->lastInsertId();

      $itemStmt = $pdo->prepare("INSERT INTO order_items (order_id,product_id,product_name,price,quantity) VALUES (?,?,?,?,?)");
      foreach ($items as $item) {
        $price = floatval(preg_replace('/[^0-9.]/', '', $item['price'] ?? '0'));
        $itemStmt->execute([$orderId, $item['id'] ?? null, $item['name'] ?? '', $price, intval($item['qty'] ?? 1)]);
      }

      echo json_encode(['success' => true, 'order_number' => $orderNumber]);
    } catch (Exception $e) {
      echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
  }

  if ($_POST['action'] === 'create_razorpay_order') {
    $total = intval(floatval($_POST['total'] ?? 0) * 100); // paise
    $url = 'https://api.razorpay.com/v1/orders';
    $data = json_encode(['amount' => $total, 'currency' => 'INR', 'receipt' => 'rcpt_' . time()]);
    $ch = curl_init($url);
    curl_setopt_array($ch, [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
      CURLOPT_USERPWD => $razorpay_key_id . ':' . $razorpay_key_secret,
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
    exit;
  }

  if ($_POST['action'] === 'verify_razorpay') {
    $sig = hash_hmac('sha256', $_POST['razorpay_order_id'] . '|' . $_POST['razorpay_payment_id'], $razorpay_key_secret);
    if ($sig !== $_POST['razorpay_signature']) {
      echo json_encode(['success' => false, 'error' => 'Invalid signature']);
      exit;
    }
    try {
      $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8mb4", $db_user, $db_pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_number VARCHAR(20) UNIQUE NOT NULL,
        customer_name VARCHAR(200) NOT NULL,
        email VARCHAR(200) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        address TEXT NOT NULL,
        city VARCHAR(100) NOT NULL,
        state VARCHAR(100) NOT NULL,
        pincode VARCHAR(10) NOT NULL,
        country VARCHAR(100) DEFAULT 'India',
        total_amount DECIMAL(10,2) NOT NULL,
        payment_method VARCHAR(50) NOT NULL,
        payment_status VARCHAR(50) DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )");
      $pdo->exec("CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        product_id INT,
        product_name VARCHAR(300) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        quantity INT NOT NULL,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
      )");

      $orderNumber = 'KC' . date('Ymd') . strtoupper(substr(uniqid(), -6));
      $items = json_decode($_POST['items'] ?? '[]', true);
      $shipping = json_decode($_POST['shipping'] ?? '{}', true);
      $total = floatval($_POST['total'] ?? 0);
      $fullAddress = trim(($shipping['address1'] ?? '') . ' ' . ($shipping['address2'] ?? ''));

      $stmt = $pdo->prepare("INSERT INTO orders
        (order_number,customer_name,email,phone,address,city,state,pincode,country,total_amount,payment_method,payment_status)
        VALUES (?,?,?,?,?,?,?,?,?,?,'razorpay','paid')");
      $stmt->execute([
        $orderNumber,
        ($shipping['firstName'] ?? '') . ' ' . ($shipping['lastName'] ?? ''),
        $shipping['email'] ?? '',
        $shipping['phone'] ?? '',
        $fullAddress,
        $shipping['city'] ?? '',
        $shipping['state'] ?? '',
        $shipping['pincode'] ?? '',
        $shipping['country'] ?? 'India',
        $total
      ]);
      $orderId = $pdo->lastInsertId();

      $itemStmt = $pdo->prepare("INSERT INTO order_items (order_id,product_id,product_name,price,quantity) VALUES (?,?,?,?,?)");
      foreach ($items as $item) {
        $price = floatval(preg_replace('/[^0-9.]/', '', $item['price'] ?? '0'));
        $itemStmt->execute([$orderId, $item['id'] ?? null, $item['name'] ?? '', $price, intval($item['qty'] ?? 1)]);
      }

      echo json_encode(['success' => true, 'order_number' => $orderNumber]);
    } catch (Exception $e) {
      echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checkout - KiraCollection Art</title>
  <?php include 'components/links.php'; ?>
</head>
<body>
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
  $pageTitle = 'Checkout';
  $breadcrumbBg = 'assets/images/about/woman-bg.png';
  include 'components/breadcrumb.php';
  ?>

  <section class="pb-[70px] pt-8">
    <div class="container">
      <!-- Step Indicator -->
      <div class="flex items-center gap-4 mb-8">
        <div class="flex items-center gap-2" id="step-indicator-1">
          <div class="w-8 h-8 rounded-full bg-amber-500 text-white flex items-center justify-center text-sm font-bold step-circle-1">1</div>
          <span class="font-semibold text-amber-700 hidden sm:block">Shipping Details</span>
        </div>
        <div class="flex-1 h-px bg-gray-300 max-w-16"></div>
        <div class="flex items-center gap-2" id="step-indicator-2">
          <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-sm font-bold step-circle-2">2</div>
          <span class="text-gray-400 hidden sm:block">Payment</span>
        </div>
      </div>

      <div class="grid grid-cols-12 gap-8">
        <!-- Left: Form -->
        <div class="col-span-12 lg:col-span-7">

          <!-- Step 1: Shipping -->
          <div id="step-1">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Shipping Details</h2>
            <form id="shipping-form" class="grid grid-cols-2 gap-4" novalidate>
              <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                <input type="text" name="firstName" required
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm" />
                <p class="text-red-500 text-xs mt-1 hidden error-msg">Required</p>
              </div>
              <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                <input type="text" name="lastName" required
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm" />
                <p class="text-red-500 text-xs mt-1 hidden error-msg">Required</p>
              </div>
              <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                <input type="email" name="email" required
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm" />
                <p class="text-red-500 text-xs mt-1 hidden error-msg">Valid email required</p>
              </div>
              <div class="col-span-2 sm:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                <input type="tel" name="phone" required
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm" />
                <p class="text-red-500 text-xs mt-1 hidden error-msg">Required</p>
              </div>
              <div class="col-span-2 sm:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Pincode *</label>
                <input type="text" name="pincode" required maxlength="6"
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm" />
                <p class="text-red-500 text-xs mt-1 hidden error-msg">Required</p>
              </div>
              <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 1 *</label>
                <input type="text" name="address1" required
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm" />
                <p class="text-red-500 text-xs mt-1 hidden error-msg">Required</p>
              </div>
              <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 2 <span class="text-gray-400">(optional)</span></label>
                <input type="text" name="address2"
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm" />
              </div>
              <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                <input type="text" name="city" required
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm" />
                <p class="text-red-500 text-xs mt-1 hidden error-msg">Required</p>
              </div>
              <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">State *</label>
                <input type="text" name="state" required
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm" />
                <p class="text-red-500 text-xs mt-1 hidden error-msg">Required</p>
              </div>
              <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <input type="text" name="country" value="India"
                  class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-amber-400 text-sm bg-gray-50" />
              </div>
              <div class="col-span-2">
                <button type="submit"
                  class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3.5 rounded-full transition-colors text-sm">
                  Continue to Payment →
                </button>
              </div>
            </form>
          </div>

          <!-- Step 2: Payment -->
          <div id="step-2" class="hidden">
            <div class="flex items-center gap-3 mb-6">
              <button id="back-to-step1" class="text-amber-600 hover:text-amber-700 flex items-center gap-1 text-sm font-medium">
                ← Back
              </button>
              <h2 class="text-xl font-bold text-gray-800">Payment Method</h2>
            </div>

            <!-- COD Option -->
            <div class="border-2 border-gray-200 rounded-2xl p-5 mb-4 cursor-pointer hover:border-amber-400 transition-colors payment-option" data-method="cod">
              <div class="flex items-center gap-4">
                <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center payment-radio" data-for="cod">
                  <div class="w-2.5 h-2.5 rounded-full bg-amber-500 hidden dot"></div>
                </div>
                <div class="flex items-center gap-3 flex-1">
                  <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-800">Cash on Delivery</p>
                    <p class="text-sm text-gray-500">Pay when your order arrives at your door</p>
                  </div>
                </div>
              </div>
              <div class="mt-4 hidden cod-content">
                <button id="place-cod-order"
                  class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3.5 rounded-full transition-colors text-sm">
                  Place Order (Cash on Delivery)
                </button>
              </div>
            </div>

            <!-- Razorpay Option -->
            <div class="border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-amber-400 transition-colors payment-option" data-method="razorpay">
              <div class="flex items-center gap-4">
                <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center payment-radio" data-for="razorpay">
                  <div class="w-2.5 h-2.5 rounded-full bg-amber-500 hidden dot"></div>
                </div>
                <div class="flex items-center gap-3 flex-1">
                  <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><polyline points="2,10 22,10"/><line x1="6" y1="15" x2="10" y2="15"/></svg>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-800">Pay Online (Razorpay)</p>
                    <p class="text-sm text-gray-500">UPI, Cards, Net Banking, Wallets — fast &amp; secure</p>
                  </div>
                </div>
              </div>
              <div class="mt-4 hidden razorpay-content">
                <button id="pay-razorpay"
                  class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 rounded-full transition-colors text-sm">
                  Pay Now with Razorpay
                </button>
              </div>
            </div>

            <div id="payment-error" class="mt-4 text-red-600 text-sm hidden"></div>
          </div>

        </div>

        <!-- Right: Order Summary (sticky) -->
        <div class="col-span-12 lg:col-span-5">
          <div class="sticky top-24 bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Order Summary</h3>
            <div id="checkout-items" class="flex flex-col gap-3 mb-4 max-h-64 overflow-y-auto"></div>
            <div class="border-t border-gray-200 pt-4 flex flex-col gap-2 text-sm">
              <div class="flex justify-between text-gray-600">
                <span>Subtotal</span>
                <span id="summary-subtotal">₹0</span>
              </div>
              <div class="flex justify-between text-gray-600">
                <span>Shipping</span>
                <span class="text-green-600 font-medium">Free</span>
              </div>
              <div class="flex justify-between text-gray-600">
                <span>GST (12%)</span>
                <span id="summary-gst">₹0</span>
              </div>
              <div class="flex justify-between text-gray-800 font-bold text-base pt-2 border-t border-gray-200">
                <span>Total</span>
                <span id="summary-total">₹0</span>
              </div>
            </div>
            <!-- Trust badges -->
            <div class="grid grid-cols-2 gap-2 mt-5">
              <div class="flex items-center gap-2 text-xs text-gray-500">
                <i class="hgi hgi-stroke hgi-truck-01 text-amber-500 text-base"></i> Free Shipping
              </div>
              <div class="flex items-center gap-2 text-xs text-gray-500">
                <i class="hgi hgi-stroke hgi-shield-01 text-amber-500 text-base"></i> Secure Payment
              </div>
              <div class="flex items-center gap-2 text-xs text-gray-500">
                <i class="hgi hgi-stroke hgi-return text-amber-500 text-base"></i> 30 Days Return
              </div>
              <div class="flex items-center gap-2 text-xs text-gray-500">
                <i class="hgi hgi-stroke hgi-customer-support text-amber-500 text-base"></i> 24/7 Support
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include 'components/footer.php' ?>
  <?php include 'components/scripts.php' ?>

  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

  <script>
  (function () {
    var cart = [];
    var shipping = {};
    var subtotal = 0;
    var gst = 0;
    var total = 0;

    function parsePrice(str) {
      return parseFloat(String(str).replace(/[^0-9.]/g, '')) || 0;
    }

    function formatINR(n) {
      return '₹' + n.toLocaleString('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
    }

    function loadCart() {
      try { cart = JSON.parse(localStorage.getItem('cart') || '[]'); } catch(e) { cart = []; }
      if (!cart.length) { window.location.href = 'cart.php'; return; }
      renderSummary();
    }

    function renderSummary() {
      var html = '';
      subtotal = 0;
      cart.forEach(function (item) {
        var p = parsePrice(item.price);
        var q = parseInt(item.qty || item.quantity || 1);
        subtotal += p * q;
        html += '<div class="flex items-center gap-3">' +
          '<div class="w-14 h-14 rounded-xl bg-gray-100 overflow-hidden flex-none">' +
          '<img src="' + (item.image || '') + '" alt="' + (item.name || '') + '" class="w-full h-full object-cover" onerror="this.style.display=\'none\'" />' +
          '</div>' +
          '<div class="flex-1 min-w-0">' +
          '<p class="text-sm font-medium text-gray-800 truncate">' + (item.name || '') + '</p>' +
          '<p class="text-xs text-gray-500">Qty: ' + q + '</p>' +
          '</div>' +
          '<p class="text-sm font-semibold text-gray-800 whitespace-nowrap">' + formatINR(p * q) + '</p>' +
          '</div>';
      });
      document.getElementById('checkout-items').innerHTML = html;
      gst = Math.round(subtotal * 0.12);
      total = subtotal + gst;
      document.getElementById('summary-subtotal').textContent = formatINR(subtotal);
      document.getElementById('summary-gst').textContent = formatINR(gst);
      document.getElementById('summary-total').textContent = formatINR(total);
    }

    // Step navigation
    document.getElementById('shipping-form').addEventListener('submit', function (e) {
      e.preventDefault();
      var valid = true;
      var fields = this.querySelectorAll('[required]');
      fields.forEach(function (f) {
        var err = f.parentElement.querySelector('.error-msg');
        if (!f.value.trim()) {
          valid = false;
          if (err) err.classList.remove('hidden');
          f.classList.add('border-red-400');
        } else {
          if (err) err.classList.add('hidden');
          f.classList.remove('border-red-400');
        }
      });
      if (!valid) return;

      var data = new FormData(this);
      shipping = {};
      data.forEach(function (v, k) { shipping[k] = v; });
      sessionStorage.setItem('kira_shipping', JSON.stringify(shipping));

      document.getElementById('step-1').classList.add('hidden');
      document.getElementById('step-2').classList.remove('hidden');
      document.querySelector('.step-circle-2').classList.remove('bg-gray-200', 'text-gray-500');
      document.querySelector('.step-circle-2').classList.add('bg-amber-500', 'text-white');
    });

    document.getElementById('back-to-step1').addEventListener('click', function () {
      document.getElementById('step-2').classList.add('hidden');
      document.getElementById('step-1').classList.remove('hidden');
    });

    // Payment option selection
    document.querySelectorAll('.payment-option').forEach(function (opt) {
      opt.addEventListener('click', function () {
        document.querySelectorAll('.payment-option').forEach(function (o) {
          o.classList.remove('border-amber-400');
          o.querySelector('.dot').classList.add('hidden');
          var method = o.dataset.method;
          var content = o.querySelector('.' + method + '-content');
          if (content) content.classList.add('hidden');
        });
        this.classList.add('border-amber-400');
        this.querySelector('.dot').classList.remove('hidden');
        var m = this.dataset.method;
        var c = this.querySelector('.' + m + '-content');
        if (c) c.classList.remove('hidden');
      });
    });

    // COD order
    document.getElementById('place-cod-order').addEventListener('click', function () {
      var btn = this;
      btn.disabled = true;
      btn.textContent = 'Placing Order...';
      var formData = new FormData();
      formData.append('action', 'place_cod_order');
      formData.append('items', JSON.stringify(cart));
      formData.append('shipping', JSON.stringify(shipping));
      formData.append('total', total);
      fetch('checkout.php', { method: 'POST', body: formData })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (data.success) {
            localStorage.removeItem('cart');
            window.location.href = 'order-success.php?order=' + data.order_number;
          } else {
            document.getElementById('payment-error').textContent = data.error || 'Order failed. Please try again.';
            document.getElementById('payment-error').classList.remove('hidden');
            btn.disabled = false;
            btn.textContent = 'Place Order (Cash on Delivery)';
          }
        })
        .catch(function () {
          document.getElementById('payment-error').textContent = 'Network error. Please try again.';
          document.getElementById('payment-error').classList.remove('hidden');
          btn.disabled = false;
          btn.textContent = 'Place Order (Cash on Delivery)';
        });
    });

    // Razorpay payment
    document.getElementById('pay-razorpay').addEventListener('click', function () {
      var btn = this;
      btn.disabled = true;
      btn.textContent = 'Opening Payment...';
      var formData = new FormData();
      formData.append('action', 'create_razorpay_order');
      formData.append('total', total);
      fetch('checkout.php', { method: 'POST', body: formData })
        .then(function (r) { return r.json(); })
        .then(function (rzpOrder) {
          if (rzpOrder.error) {
            document.getElementById('payment-error').textContent = rzpOrder.error.description || 'Razorpay error.';
            document.getElementById('payment-error').classList.remove('hidden');
            btn.disabled = false;
            btn.textContent = 'Pay Now with Razorpay';
            return;
          }
          var options = {
            key: '<?= htmlspecialchars($razorpay_key_id) ?>',
            amount: rzpOrder.amount,
            currency: rzpOrder.currency,
            name: 'KiraCollection Art',
            description: 'Handcrafted Art Order',
            order_id: rzpOrder.id,
            handler: function (response) {
              var vData = new FormData();
              vData.append('action', 'verify_razorpay');
              vData.append('razorpay_order_id', response.razorpay_order_id);
              vData.append('razorpay_payment_id', response.razorpay_payment_id);
              vData.append('razorpay_signature', response.razorpay_signature);
              vData.append('items', JSON.stringify(cart));
              vData.append('shipping', JSON.stringify(shipping));
              vData.append('total', total);
              fetch('checkout.php', { method: 'POST', body: vData })
                .then(function (r) { return r.json(); })
                .then(function (res) {
                  if (res.success) {
                    localStorage.removeItem('cart');
                    window.location.href = 'order-success.php?order=' + res.order_number;
                  } else {
                    document.getElementById('payment-error').textContent = res.error || 'Verification failed.';
                    document.getElementById('payment-error').classList.remove('hidden');
                    btn.disabled = false;
                    btn.textContent = 'Pay Now with Razorpay';
                  }
                });
            },
            prefill: {
              name: (shipping.firstName || '') + ' ' + (shipping.lastName || ''),
              email: shipping.email || '',
              contact: shipping.phone || ''
            },
            theme: { color: '#f59e0b' },
            modal: {
              ondismiss: function () {
                btn.disabled = false;
                btn.textContent = 'Pay Now with Razorpay';
              }
            }
          };
          var rzp = new Razorpay(options);
          rzp.open();
        })
        .catch(function () {
          document.getElementById('payment-error').textContent = 'Network error. Please try again.';
          document.getElementById('payment-error').classList.remove('hidden');
          btn.disabled = false;
          btn.textContent = 'Pay Now with Razorpay';
        });
    });

    // Restore shipping from sessionStorage
    var saved = sessionStorage.getItem('kira_shipping');
    if (saved) {
      try {
        shipping = JSON.parse(saved);
        var form = document.getElementById('shipping-form');
        Object.keys(shipping).forEach(function (k) {
          var el = form.querySelector('[name="' + k + '"]');
          if (el) el.value = shipping[k];
        });
      } catch(e) {}
    }

    loadCart();
  })();
  </script>
</body>
</html>
