<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Support - KiraCollection Art</title>
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
  <?php
  $pageTitle = 'Support';
  $breadcrumbBg = 'assets/images/about/female-green-bg.jpg';
  include 'components/breadcrumb.php';
  ?>
  <section class="py-20 md:py-24">
    <div class="container">
      <div class="max-w-4xl mx-auto">
        <!-- FAQ Section -->
        <div
          class="bg-white rounded-2xl p-8 md:p-12 border border-gray-200 shadow-[0_14px_40px_rgba(85,107,47,0.08)] mb-8">
          <h2 class="text-2xl md:text-3xl font-bold font-urbanist text-light-primary-text mb-2">How Can We Help You?
          </h2>
          <p class="text-light-secondary-text mb-8">Find answers to common questions or reach out to our support team.
          </p>

          <div class="space-y-4">
            <div class="border border-gray-200 rounded-2xl overflow-hidden">
              <button
                class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
                <span class="font-semibold text-light-primary-text">How do I place an order?</span>
                <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
              </button>
              <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                <p class="text-light-secondary-text">Simply browse our shop, add items to your cart, and proceed to
                  checkout. You can place an order without creating an account, though registering gives you access to
                  order tracking and faster checkout.</p>
              </div>
            </div>

            <div class="border border-gray-200 rounded-2xl overflow-hidden">
              <button
                class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
                <span class="font-semibold text-light-primary-text">What payment methods do you accept?</span>
                <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
              </button>
              <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                <p class="text-light-secondary-text">We accept all major credit/debit cards, UPI (Google Pay, PhonePe,
                  Paytm), net banking, and cash on delivery for eligible orders.</p>
              </div>
            </div>

            <div class="border border-gray-200 rounded-2xl overflow-hidden">
              <button
                class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
                <span class="font-semibold text-light-primary-text">How long does shipping take?</span>
                <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
              </button>
              <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                <p class="text-light-secondary-text">Standard shipping takes 5-7 business days within India. Express
                  shipping (2-3 days) is available for an additional charge. International orders typically arrive
                  within 10-15 business days.</p>
              </div>
            </div>

            <div class="border border-gray-200 rounded-2xl overflow-hidden">
              <button
                class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
                <span class="font-semibold text-light-primary-text">Can I track my order?</span>
                <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
              </button>
              <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                <p class="text-light-secondary-text">Yes! Once your order ships, you will receive a tracking number via
                  email and SMS to monitor your delivery in real time.</p>
              </div>
            </div>

            <div class="border border-gray-200 rounded-2xl overflow-hidden">
              <button
                class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
                <span class="font-semibold text-light-primary-text">What is your return policy?</span>
                <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
              </button>
              <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                <p class="text-light-secondary-text">We offer a 7-day return policy for unused items in original
                  packaging. Custom pieces are non-returnable unless damaged during shipping. Please see our Terms &
                  Conditions for full details.</p>
              </div>
            </div>

            <div class="border border-gray-200 rounded-2xl overflow-hidden">
              <button
                class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
                <span class="font-semibold text-light-primary-text">Do you offer custom art commissions?</span>
                <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
              </button>
              <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                <p class="text-light-secondary-text">Yes! We accept custom art commissions. Contact us with your
                  requirements, and our skilled artisans will work with you to create a unique piece tailored to your
                  vision.</p>
              </div>
            </div>

            <div class="border border-gray-200 rounded-2xl overflow-hidden">
              <button
                class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition-colors faq-toggle">
                <span class="font-semibold text-light-primary-text">How do I care for my art piece?</span>
                <i class="hgi hgi-stroke hgi-chevron-down text-primary transition-transform"></i>
              </button>
              <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                <p class="text-light-secondary-text">Keep your art away from direct sunlight and moisture. Dust gently
                  with a soft, dry cloth. For Lippan art with mirrors, avoid harsh chemicals. Handle with care to
                  preserve its beauty for years to come.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Support -->
        <div class="bg-white rounded-2xl p-8 md:p-12 border border-gray-200 shadow-[0_14px_40px_rgba(85,107,47,0.08)]">
          <h2 class="text-2xl md:text-3xl font-bold font-urbanist text-light-primary-text mb-2">Still Need Help?</h2>
          <p class="text-light-secondary-text mb-8">Our support team is available 24/7 to assist you with any questions
            or concerns.</p>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-6 border border-gray-200 rounded-2xl hover:shadow-lg transition-shadow">
              <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="hgi hgi-stroke hgi-call text-white text-xl"></i>
              </div>
              <h4 class="font-semibold text-light-primary-text mb-2">Phone</h4>
              <a href="tel:8979111484" class="text-primary hover:underline font-medium">8979111484</a>
            </div>

            <div class="text-center p-6 border border-gray-200 rounded-2xl hover:shadow-lg transition-shadow">
              <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="hgi hgi-stroke hgi-mail-01 text-white text-xl"></i>
              </div>
              <h4 class="font-semibold text-light-primary-text mb-2">Email</h4>
              <a href="mailto:support@kiracollectionart.com"
                class="text-primary hover:underline font-medium">support@kiracollectionart.com</a>
            </div>

            <div class="text-center p-6 border border-gray-200 rounded-2xl hover:shadow-lg transition-shadow">
              <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="hgi hgi-stroke hgi-location-01 text-white text-xl"></i>
              </div>
              <h4 class="font-semibold text-light-primary-text mb-2">Visit Us</h4>
              <p class="text-light-secondary-text text-sm">Sneh Vandan House, Opposite Shilpgram Parking, Tajganj Agra
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include 'components/subscribe-section.php' ?>
  <?php include 'components/footer.php' ?>
  <?php include 'components/scripts.php' ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const faqToggles = document.querySelectorAll('.faq-toggle');
      faqToggles.forEach(function (toggle) {
        toggle.addEventListener('click', function () {
          const content = this.nextElementSibling;
          const icon = this.querySelector('i');
          content.classList.toggle('hidden');
          icon.classList.toggle('rotate-180');
        });
      });
    });

    window.addEventListener('load', function () {
      var preloader = document.getElementById('preloader');
      if (preloader) preloader.classList.add('hidden');
    });
  </script>
</body>

</html>