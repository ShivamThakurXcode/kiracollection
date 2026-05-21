<?php
session_start();
require_once __DIR__ . '/admin/includes/db.php';

function ensureContactMessagesTable(PDO $db): void
{
  $db->exec("
    CREATE TABLE IF NOT EXISTS `contact_messages` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `first_name` VARCHAR(100) NOT NULL,
      `last_name` VARCHAR(100) NOT NULL,
      `email` VARCHAR(255) NOT NULL,
      `phone` VARCHAR(50) DEFAULT NULL,
      `subject` VARCHAR(255) NOT NULL,
      `message` TEXT NOT NULL,
      `status` VARCHAR(30) NOT NULL DEFAULT 'new',
      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  ");
}

$ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $firstName = trim($_POST['firstName'] ?? '');
  $lastName = trim($_POST['lastName'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $subject = trim($_POST['subject'] ?? '');
  $message = trim($_POST['message'] ?? '');
  $errors = [];

  if ($firstName === '' || $lastName === '' || $email === '' || $subject === '' || $message === '') {
    $errors[] = 'Please fill in all required fields.';
  }
  if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
  }

  if (empty($errors)) {
    try {
      $db = getDB();
      ensureContactMessagesTable($db);
      $stmt = $db->prepare("INSERT INTO contact_messages (first_name, last_name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->execute([
        $firstName,
        $lastName,
        $email,
        $phone !== '' ? $phone : null,
        $subject,
        $message,
      ]);
      if ($ajax) {
        echo json_encode(['success' => true, 'message' => 'Thank you for reaching out. We have received your message and will reply soon.']);
        exit;
      }
      $_SESSION['contact_success'] = 'Thank you for reaching out. We have received your message and will reply soon.';
    } catch (PDOException $e) {
      if ($ajax) {
        echo json_encode(['success' => false, 'message' => 'We could not save your message right now. Please try again later.']);
        exit;
      }
      $_SESSION['contact_error'] = 'We could not save your message right now. Please try again later.';
    }
  } else {
    if ($ajax) {
      echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
      exit;
    }
    $_SESSION['contact_error'] = implode(' ', $errors);
  }

  if (!$ajax) {
    header('Location: contact.php#contact-form');
    exit;
  }
}

$contactSuccess = $_SESSION['contact_success'] ?? '';
$contactError = $_SESSION['contact_error'] ?? '';
unset($_SESSION['contact_success'], $_SESSION['contact_error']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - KiraCollection Art</title>
  <?php include 'components/links.php'; ?>
</head>

<body>


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
  <?php
  $pageTitle = 'Contact';
  $breadcrumbBg = 'images/breadcrumb/b-2.jpg';
  include 'components/breadcrumb.php';
  ?>

  <!-- Contact Section -->
  <section class="pb-[70px] pt-8">
    <div class="container">
      <!-- Quick Contact Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div
          class="text-center p-6 border border-gray-200 rounded-2xl bg-white shadow-[0_14px_40px_rgba(85,107,47,0.08)] hover:shadow-lg transition-shadow wow animate__animated animate__fadeInUp"
          data-wow-delay="0.2s">
          <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="hgi hgi-stroke hgi-call text-white text-xl"></i>
          </div>
          <h4 class="font-semibold text-light-primary-text mb-2">Phone</h4>
          <a href="tel:8979111484" class="text-primary hover:underline font-medium">8979111484</a>
        </div>

        <div
          class="text-center p-6 border border-gray-200 rounded-2xl bg-white shadow-[0_14px_40px_rgba(85,107,47,0.08)] hover:shadow-lg transition-shadow wow animate__animated animate__fadeInUp"
          data-wow-delay="0.3s">
          <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="hgi hgi-stroke hgi-mail-01 text-white text-xl"></i>
          </div>
          <h4 class="font-semibold text-light-primary-text mb-2">Email</h4>
          <a href="mailto:info@kiracollectionart.com"
            class="text-primary hover:underline font-medium">info@kiracollectionart.com</a>
        </div>

        <div
          class="text-center p-6 border border-gray-200 rounded-2xl bg-white shadow-[0_14px_40px_rgba(85,107,47,0.08)] hover:shadow-lg transition-shadow wow animate__animated animate__fadeInUp"
          data-wow-delay="0.4s">
          <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="hgi hgi-stroke hgi-location-01 text-white text-xl"></i>
          </div>
          <h4 class="font-semibold text-light-primary-text mb-2">Address</h4>
          <p class="text-light-secondary-text text-sm">Sneh Vandan House, Opposite Shilpgram Parking, Tajganj Agra</p>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
        <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-[0_14px_40px_rgba(85,107,47,0.08)]">
          <h2 class="text-2xl md:text-3xl font-bold text-light-primary-text mb-6">Get in Touch</h2>
          <p class="text-light-secondary-text mb-8 text-lg leading-[26px]">
            Have questions about our art pieces? Need help with your order? We're here to help! Fill out the form
            below and we'll get back to you within 24 hours.
          </p>
          <?php if ($contactSuccess): ?>
            <div
              class="contact-alert mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
              <?= htmlspecialchars($contactSuccess) ?>
            </div>
          <?php endif; ?>
          <?php if ($contactError): ?>
            <div class="contact-alert mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
              <?= htmlspecialchars($contactError) ?>
            </div>
          <?php endif; ?>
          <form id="contact-form" method="post" action="#contact-form" class="space-y-6">
            <div class="grid grid-cols-12 gap-6">
              <div class="md:col-span-6 col-span-12">
                <label class="block text-light-primary-text font-medium mb-2">First Name *</label>
                <input type="text" name="firstName" required
                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                  placeholder="Enter your first name" />
              </div>
              <div class="md:col-span-6 col-span-12">
                <label class="block text-light-primary-text font-medium mb-2">Last Name *</label>
                <input type="text" name="lastName" required
                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                  placeholder="Enter your last name" />
              </div>
            </div>
            <div class="grid grid-cols-12 gap-6">
              <div class="md:col-span-6 col-span-12">
                <label class="block text-light-primary-text font-medium mb-2">Email Address *</label>
                <input type="email" name="email" required
                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                  placeholder="your.email@example.com" />
              </div>
              <div class="md:col-span-6 col-span-12">
                <label class="block text-light-primary-text font-medium mb-2">Phone Number</label>
                <input type="tel" name="phone"
                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                  placeholder="+91 98765 43210" />
              </div>
            </div>
            <div>
              <label class="block text-light-primary-text font-medium mb-2">Subject *</label>
              <input type="text" name="subject" required
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                placeholder="Enter your subject" />
            </div>
            <div>
              <label class="block text-light-primary-text font-medium mb-2">Message *</label>
              <textarea name="message" rows="6" required
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all resize-none"
                placeholder="Tell us more about your inquiry..."></textarea>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
              <button type="submit" id="contactSubmitBtn"
                class="btn btn-primary btn-large rounded-[60px] py-3 px-8 font-semibold hover:transform hover:scale-105 transition-all">Send
                Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Map Section -->
  <!-- <section class="pb-[70px]">
    <div class="container">
      <div class="wow animate__animated animate__fadeInUp" data-wow-delay="0.6s">
        <div class="bg-gray-100 rounded-2xl overflow-hidden h-[400px] flex items-center justify-center">
          <div class="text-center">
            <i class="hgi hgi-stroke hgi-map-01 text-6xl text-light-primary-text mb-4"></i>
            <h3 class="text-xl font-semibold text-light-primary-text mb-2">Find Us On Map</h3>
            <p class="text-light-secondary-text mb-4">Interactive map loading...</p>
            <button class="btn btn-primary rounded-[60px] py-2 px-6">Open in Google Maps</button>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <!-- FAQ Section -->
  <!-- <section class="pb-[70px]">
    <div class="container">
      <div class="wow animate__animated animate__fadeInUp" data-wow-delay="0.7s">
        <div class="text-center mb-12">
          <h2 class="text-2xl md:text-3xl font-bold text-light-primary-text mb-4">Frequently Asked Questions</h2>
          <p class="text-light-secondary-text text-lg max-w-2xl mx-auto">
            Quick answers to common questions about our art pieces, ordering, and services.
          </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
          <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <button
              class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
              <span class="font-semibold text-light-primary-text">How long does shipping take?</span>
              <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
            </button>
            <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
              <p class="text-light-secondary-text">
                Standard shipping takes 5-7 business days within India. Express shipping (2-3 days) is available for an
                additional charge. International shipping takes 10-15 business days.
              </p>
            </div>
          </div>

          <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <button
              class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
              <span class="font-semibold text-light-primary-text">Do you offer custom art commissions?</span>
              <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
            </button>
            <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
              <p class="text-light-secondary-text">
                Yes, we accept custom art commissions. Contact us with your requirements and our artists will work
                with you to create a unique piece tailored to your vision.
              </p>
            </div>
          </div>

          <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <button
              class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
              <span class="font-semibold text-light-primary-text">What is your return policy?</span>
              <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
            </button>
            <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
              <p class="text-light-secondary-text">
                We offer a 7-day return policy for unused items in original packaging. Custom pieces are non-returnable
                unless damaged during shipping.
              </p>
            </div>
          </div>

          <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <button
              class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
              <span class="font-semibold text-light-primary-text">How do I care for my art piece?</span>
              <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
            </button>
            <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
              <p class="text-light-secondary-text">
                Keep away from direct sunlight and moisture. Dust gently with a soft cloth. For Lippan art with mirrors,
                avoid harsh chemicals. Professional cleaning is recommended for valuable pieces.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <?php include 'components/subscribe-section.php' ?>

  <?php include 'components/footer.php' ?>
  <?php include 'components/scripts.php' ?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // FAQ Toggle
      const faqToggles = document.querySelectorAll('.faq-toggle');
      faqToggles.forEach(function (toggle) {
        toggle.addEventListener('click', function () {
          const content = this.nextElementSibling;
          const icon = this.querySelector('i');

          content.classList.toggle('hidden');
          icon.classList.toggle('rotate-180');
        });
      });

      // Contact form AJAX submit
      const contactForm = document.getElementById('contact-form');
      const submitBtn = document.getElementById('contactSubmitBtn');
      if (contactForm && submitBtn) {
        contactForm.addEventListener('submit', function (e) {
          e.preventDefault();
          submitBtn.disabled = true;
          submitBtn.innerHTML = 'Submitting...';

          var formData = new FormData(contactForm);

          fetch(contactForm.getAttribute('action') || window.location.href, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
          })
            .then(function (res) { return res.json(); })
            .then(function (data) {
              // Remove existing alerts
              var oldAlerts = contactForm.querySelectorAll('.contact-alert');
              oldAlerts.forEach(function (el) { el.remove(); });

              var alertDiv = document.createElement('div');
              alertDiv.className = 'contact-alert mb-6 rounded-xl border px-4 py-3 text-sm';

              if (data.success) {
                alertDiv.className += ' border-green-200 bg-green-50 text-green-800';
                alertDiv.textContent = data.message;
                contactForm.reset();
              } else {
                alertDiv.className += ' border-red-200 bg-red-50 text-red-800';
                alertDiv.textContent = data.message;
              }

              contactForm.insertBefore(alertDiv, contactForm.firstChild);

              // Auto-hide after 6 seconds
              setTimeout(function () {
                alertDiv.style.transition = 'opacity 0.5s ease';
                alertDiv.style.opacity = '0';
                setTimeout(function () { alertDiv.remove(); }, 500);
              }, 6000);
            })
            .catch(function () {
              var alertDiv = document.createElement('div');
              alertDiv.className = 'contact-alert mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800';
              alertDiv.textContent = 'Could not send your message. Please try again.';
              contactForm.insertBefore(alertDiv, contactForm.firstChild);
            })
            .finally(function () {
              submitBtn.disabled = false;
              submitBtn.innerHTML = 'Send Message';
            });
        });
      }
    });
  </script>

</body>

</html>