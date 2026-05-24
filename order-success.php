<?php
require_once 'config/database.php';

$orderNumber = isset($_GET['order']) ? htmlspecialchars(trim($_GET['order'])) : '';
$order = null;
$orderItems = [];

if ($orderNumber) {
  try {
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE order_number = ? LIMIT 1");
    $stmt->execute([$orderNumber]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order) {
      $iStmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
      $iStmt->execute([$order['id']]);
      $orderItems = $iStmt->fetchAll(PDO::FETCH_ASSOC);
    }
  } catch (Exception $e) {
    // DB not available, show generic success
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order Confirmed - KiraCollection Art</title>
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

  <section class="py-16">
    <div class="container max-w-2xl mx-auto text-center">
      <!-- Success Icon -->
      <div class="flex items-center justify-center mb-6">
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center">
          <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </div>
      </div>

      <h1 class="text-3xl font-bold text-gray-800 mb-2">Order Confirmed!</h1>
      <p class="text-gray-500 text-lg mb-6">Thank you for your purchase. Your handcrafted art is on its way.</p>

      <?php if ($orderNumber): ?>
      <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-6 text-left">
        <div class="flex items-center justify-between mb-4">
          <div>
            <p class="text-xs text-gray-500 uppercase tracking-wide">Order Number</p>
            <p class="text-xl font-bold text-amber-700"><?= $orderNumber ?></p>
          </div>
          <?php if ($order): ?>
          <div class="text-right">
            <p class="text-xs text-gray-500 uppercase tracking-wide">Payment</p>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?= $order['payment_status'] === 'paid' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' ?>">
              <?= ucfirst($order['payment_status'] ?? 'pending') ?>
            </span>
          </div>
          <?php endif; ?>
        </div>

        <?php if ($order): ?>
        <div class="grid grid-cols-2 gap-3 text-sm mb-4">
          <div>
            <p class="text-gray-500 text-xs">Customer</p>
            <p class="font-medium"><?= htmlspecialchars($order['customer_name']) ?></p>
          </div>
          <div>
            <p class="text-gray-500 text-xs">Payment Method</p>
            <p class="font-medium"><?= $order['payment_method'] === 'cod' ? 'Cash on Delivery' : 'Online (Razorpay)' ?></p>
          </div>
          <div class="col-span-2">
            <p class="text-gray-500 text-xs">Delivery Address</p>
            <p class="font-medium"><?= htmlspecialchars($order['address'] . ', ' . $order['city'] . ', ' . $order['state'] . ' - ' . $order['pincode']) ?></p>
          </div>
        </div>
        <?php endif; ?>

        <?php if ($orderItems): ?>
        <div class="border-t border-amber-200 pt-4">
          <p class="text-xs text-gray-500 uppercase tracking-wide mb-3">Items Ordered</p>
          <div class="flex flex-col gap-2">
            <?php foreach ($orderItems as $item): ?>
            <div class="flex justify-between items-center text-sm">
              <span class="text-gray-700"><?= htmlspecialchars($item['product_name']) ?> <span class="text-gray-400">×<?= $item['quantity'] ?></span></span>
              <span class="font-semibold">₹<?= number_format($item['price'] * $item['quantity'], 0) ?></span>
            </div>
            <?php endforeach; ?>
          </div>
          <?php if ($order): ?>
          <div class="flex justify-between items-center font-bold text-base pt-3 border-t border-amber-200 mt-3">
            <span>Total</span>
            <span class="text-amber-700">₹<?= number_format($order['total_amount'], 0) ?></span>
          </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="shop.php"
          class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-8 py-3.5 rounded-full transition-colors text-sm">
          Continue Shopping
        </a>
        <a href="contact.php"
          class="border border-amber-400 text-amber-600 hover:bg-amber-50 font-semibold px-8 py-3.5 rounded-full transition-colors text-sm">
          Track Your Order
        </a>
      </div>
    </div>
  </section>

  <?php include 'components/footer.php' ?>
  <?php include 'components/scripts.php' ?>

  <script>
    // Clear cart from localStorage on success page load
    localStorage.removeItem('cart');
    if (window.updateCartCount) window.updateCartCount();
  </script>
</body>
</html>
