<!-- ========== Newsletter Strip ========== -->
<section class="bg-amber-500 py-10">
  <div class="container">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
      <div>
        <h3 class="text-2xl font-bold text-white mb-1">Stay Updated with New Art Arrivals</h3>
        <p class="text-amber-100 text-sm">Subscribe to get exclusive offers and first access to new collections.</p>
      </div>
      <form class="flex items-center gap-3 w-full md:w-auto" onsubmit="return false;">
        <input type="email" placeholder="Enter your email address"
          class="flex-1 md:w-72 px-4 py-3 rounded-full border-0 outline-none text-gray-800 text-sm" />
        <button type="submit"
          class="bg-white text-amber-600 font-semibold px-6 py-3 rounded-full hover:bg-amber-50 transition-colors text-sm whitespace-nowrap">
          Subscribe
        </button>
      </form>
    </div>
  </div>
</section>

<!-- ========== Footer Section Start ========== -->
<footer class="footer-shell">
  <div class="footer-bg"></div>
  <div class="footer-top">
    <div class="container">
      <div class="grid grid-cols-12 gap-8">

        <!-- Column 1: Brand -->
        <div class="col-span-12 xl:col-span-4 flex flex-col gap-y-6">
          <div>
            <a href='index.php'>
              <img src="images/logo-footer.png" alt="Kiracollection Art" class="h-14 w-auto">
            </a>
          </div>
          <p class="footer-text">
            Discover exquisite handcrafted lippan art, sacred mandala designs, and elegant home decor pieces. Each piece
            is crafted with love and tradition to transform your living space.
          </p>
          <div class="footer-social">
            <!-- UPDATE: add real social URLs below -->
            <a class="footer-social__btn" href="#" title="Instagram" aria-label="Instagram">
              <i class="hgi hgi-stroke hgi-instagram"></i>
            </a>
            <a class="footer-social__btn" href="#" title="Facebook" aria-label="Facebook">
              <i class="hgi hgi-stroke hgi-facebook-01"></i>
            </a>
            <a class="footer-social__btn" href="#" title="YouTube" aria-label="YouTube">
              <i class="hgi hgi-stroke hgi-youtube"></i>
            </a>
            <a class="footer-social__btn" href="#" title="Pinterest" aria-label="Pinterest">
              <i class="hgi hgi-stroke hgi-pinterest"></i>
            </a>
            <a class="footer-social__btn" href="https://wa.me/918979111484" title="WhatsApp" aria-label="WhatsApp" target="_blank" rel="noopener">
              <i class="hgi hgi-stroke hgi-whatsapp"></i>
            </a>
          </div>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="col-span-6 md:col-span-3 xl:col-span-2">
          <h5 class="footer-title">Quick Links</h5>
          <ul class="footer-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>

        <!-- Column 3: Marketplace -->
        <div class="col-span-6 md:col-span-3 xl:col-span-2">
          <h5 class="footer-title">Also Available On</h5>
          <div class="flex flex-col gap-y-3 mt-2">
            <!-- UPDATE: Flipkart store URL -->
            <a href="#" target="_blank" rel="noopener"
              class="flex items-center gap-x-3 bg-[#2874F0] text-white px-4 py-2.5 rounded-xl hover:opacity-90 transition-opacity">
              <svg width="22" height="22" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="6" fill="white"/>
                <text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="#2874F0" font-size="24" font-weight="bold" font-family="Arial">F</text>
              </svg>
              <div>
                <p class="text-[10px] leading-none opacity-80">Shop on</p>
                <p class="font-bold text-sm leading-tight">Flipkart</p>
              </div>
            </a>
            <!-- UPDATE: Amazon store URL -->
            <a href="#" target="_blank" rel="noopener"
              class="flex items-center gap-x-3 bg-[#232F3E] text-white px-4 py-2.5 rounded-xl hover:opacity-90 transition-opacity">
              <svg width="22" height="22" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="6" fill="#FF9900"/>
                <text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="white" font-size="24" font-weight="bold" font-family="Arial">a</text>
              </svg>
              <div>
                <p class="text-[10px] leading-none opacity-80">Shop on</p>
                <p class="font-bold text-sm leading-tight">Amazon</p>
              </div>
            </a>
          </div>
        </div>

        <!-- Column 4: Contact -->
        <div class="col-span-12 md:col-span-6 xl:col-span-4">
          <h5 class="footer-title">Contact</h5>
          <ul class="footer-contact">
            <li>
              <span class="footer-contact__icon"><i class="hgi hgi-stroke hgi-maps-global-01"></i></span>
              <span>Sneh Vandan House, Opposite Shilpgram Parking, Tajganj Agra</span>
            </li>
            <li>
              <span class="footer-contact__icon"><i class="hgi hgi-stroke hgi-call"></i></span>
              <!-- UPDATE: phone -->
              <a href="tel:8979111484" class="hover:text-amber-400 transition-colors">+91 89791 11484</a>
            </li>
            <li>
              <span class="footer-contact__icon"><i class="hgi hgi-stroke hgi-mail-02"></i></span>
              <!-- UPDATE: email -->
              <a href="mailto:info@kiracollectionart.com" class="hover:text-amber-400 transition-colors">info@kiracollectionart.com</a>
            </li>
            <li>
              <span class="footer-contact__icon"><i class="hgi hgi-stroke hgi-whatsapp"></i></span>
              <a href="https://wa.me/918979111484?text=Hi!%20I'm%20interested%20in%20your%20art%20pieces." target="_blank" rel="noopener" class="hover:text-amber-400 transition-colors">Chat on WhatsApp</a>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container">
      <div class="footer-bottom__row">
        <p>© 2026 KiraCollection Art | Developed by Dynexia IT Solutions</p>
        <div class="footer-bottom__links">
          <a href="privacy-policy.php">Privacy</a>
          <span>•</span>
          <a href="terms-and-conditions.php">Terms</a>
          <span>•</span>
          <a href="support.php">Support</a>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- ========== Footer Section End ========== -->

<!-- ========== Fixed Floating Buttons ========== -->
<div id="floating-buttons" style="position:fixed;bottom:0;right:1.5rem;z-index:9999;display:flex;flex-direction:column;align-items:center;gap:0.5rem;padding-bottom:1rem;">
  <!-- WhatsApp Button -->
  <a href="https://wa.me/918979111484?text=Hi!%20I'm%20interested%20in%20your%20art%20pieces."
    target="_blank" rel="noopener"
    title="Chat on WhatsApp"
    class="floating-btn-wa group flex items-center justify-center w-14 h-14 rounded-full bg-[#25D366] hover:bg-[#1ebe57] shadow-lg transition-all duration-300 hover:scale-110"
    style="animation:fadeInUp 0.5s ease 0.2s both;">
    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="white">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
    <span class="absolute right-16 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Chat on WhatsApp</span>
  </a>
  <!-- Call Button -->
  <a href="tel:8979111484"
    title="Call Us Now"
    class="floating-btn-call group flex items-center justify-center w-12 h-12 rounded-full bg-amber-500 hover:bg-amber-600 shadow-lg transition-all duration-300 hover:scale-110"
    style="animation:fadeInUp 0.5s ease 0.1s both;">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.21 2 2 0 012 .01h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
    </svg>
    <span class="absolute right-14 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Call Us Now</span>
  </a>
</div>

<style>
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}
</style>
