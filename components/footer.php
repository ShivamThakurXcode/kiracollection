<!-- ========== Newsletter Strip ========== -->
<section style="background: linear-gradient(135deg,#d97706 0%,#b45309 100%);">
  <div class="container py-10 sm:py-12">
    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="text-center md:text-left">
        <h3 class="text-2xl sm:text-3xl font-bold text-white mb-1" style="font-family:var(--font-urbanist);letter-spacing:-0.01em;">
          Stay Updated with New Art Arrivals
        </h3>
        <p class="text-amber-100 text-sm">Subscribe for exclusive offers and first access to new collections.</p>
      </div>
      <form class="flex items-center gap-2 w-full md:w-auto" onsubmit="return false;">
        <input type="email" placeholder="Your email address"
          class="flex-1 md:w-64 px-4 py-3 rounded-full border-0 outline-none text-stone-800 text-sm bg-white/95 placeholder-stone-400"
          style="min-width:0;" />
        <button type="submit"
          class="bg-white text-amber-700 font-bold px-5 py-3 rounded-full hover:bg-amber-50 transition-colors text-sm whitespace-nowrap flex-shrink-0">
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
      <div class="grid grid-cols-12 gap-x-8 gap-y-10">

        <!-- Column 1: Brand -->
        <div class="col-span-12 xl:col-span-4 flex flex-col gap-y-5">
          <a href="index.php" class="inline-block">
            <img src="images/logo-footer.png" alt="KiraCollection Art" style="height:52px;width:auto;">
          </a>
          <p class="footer-text" style="max-width:340px;font-size:0.9375rem;line-height:1.7;">
            Discover exquisite handcrafted lippan art, sacred mandala designs, and elegant home decor pieces.
            Each piece is crafted with love and tradition to transform your living space.
          </p>
          <!-- Social icons -->
          <div class="footer-social">
            <!-- UPDATE: add real social URLs -->
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
        <div class="col-span-6 sm:col-span-4 xl:col-span-2">
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
        <div class="col-span-6 sm:col-span-4 xl:col-span-2">
          <h5 class="footer-title">Shop On</h5>
          <div class="flex flex-col gap-y-3 mt-1">
            <!-- UPDATE: Flipkart store URL -->
            <a href="#" target="_blank" rel="noopener"
              class="flex items-center gap-x-3 text-white px-4 py-3 rounded-xl transition-all duration-200 hover:translate-x-1"
              style="background:rgba(40,116,240,0.18);border:1px solid rgba(40,116,240,0.3);">
              <span class="size-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#2874F0;">
                <svg width="14" height="14" viewBox="0 0 14 14"><text x="50%" y="50%" dominant-baseline="central" text-anchor="middle" fill="white" font-size="10" font-weight="bold" font-family="Arial">F</text></svg>
              </span>
              <div>
                <p class="text-[10px] leading-none opacity-60 uppercase tracking-wide">Available on</p>
                <p class="font-bold text-sm">Flipkart</p>
              </div>
            </a>
            <!-- UPDATE: Amazon store URL -->
            <a href="#" target="_blank" rel="noopener"
              class="flex items-center gap-x-3 text-white px-4 py-3 rounded-xl transition-all duration-200 hover:translate-x-1"
              style="background:rgba(255,153,0,0.18);border:1px solid rgba(255,153,0,0.3);">
              <span class="size-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#FF9900;">
                <svg width="14" height="14" viewBox="0 0 14 14"><text x="50%" y="50%" dominant-baseline="central" text-anchor="middle" fill="white" font-size="10" font-weight="bold" font-family="Arial">a</text></svg>
              </span>
              <div>
                <p class="text-[10px] leading-none opacity-60 uppercase tracking-wide">Available on</p>
                <p class="font-bold text-sm">Amazon</p>
              </div>
            </a>
          </div>
        </div>

        <!-- Column 4: Contact -->
        <div class="col-span-12 sm:col-span-4 xl:col-span-4">
          <h5 class="footer-title">Get In Touch</h5>
          <ul class="footer-contact">
            <li>
              <span class="footer-contact__icon"><i class="hgi hgi-stroke hgi-maps-global-01"></i></span>
              <span>Sneh Vandan House, Opposite Shilpgram Parking, Tajganj, Agra</span>
            </li>
            <li>
              <span class="footer-contact__icon"><i class="hgi hgi-stroke hgi-call"></i></span>
              <!-- UPDATE: phone -->
              <a href="tel:8979111484" class="hover:text-amber-300 transition-colors">+91 89791 11484</a>
            </li>
            <li>
              <span class="footer-contact__icon"><i class="hgi hgi-stroke hgi-mail-02"></i></span>
              <!-- UPDATE: email -->
              <a href="mailto:info@kiracollectionart.com" class="hover:text-amber-300 transition-colors break-all">info@kiracollectionart.com</a>
            </li>
            <li>
              <span class="footer-contact__icon"><i class="hgi hgi-stroke hgi-whatsapp"></i></span>
              <a href="https://wa.me/918979111484?text=Hi!%20I'm%20interested%20in%20your%20art%20pieces."
                target="_blank" rel="noopener" class="hover:text-amber-300 transition-colors">
                Chat on WhatsApp
              </a>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </div><!-- /footer-top -->

  <!-- Bottom bar -->
  <div class="footer-bottom">
    <div class="container">
      <div class="footer-bottom__row">
        <p>© 2026 KiraCollection Art &nbsp;|&nbsp; Developed by Dynexia IT Solutions</p>
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
<div id="floating-buttons">

  <!-- WhatsApp -->
  <a href="https://wa.me/918979111484?text=Hi!%20I'm%20interested%20in%20your%20art%20pieces."
    target="_blank" rel="noopener"
    class="floating-btn-wa group"
    style="display:flex;align-items:center;justify-content:center;width:52px;height:52px;border-radius:50%;background:#25D366;animation:fadeInUp 0.45s ease 0.3s both;"
    title="Chat on WhatsApp" aria-label="Chat on WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="white">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
    <!-- Tooltip -->
    <span style="position:absolute;right:calc(100% + 10px);top:50%;transform:translateY(-50%);background:#1c1917;color:#fff;font-size:11px;font-weight:600;padding:4px 10px;border-radius:6px;white-space:nowrap;pointer-events:none;opacity:0;transition:opacity 0.2s;" class="floating-tooltip">Chat on WhatsApp</span>
  </a>

  <!-- Call -->
  <a href="tel:8979111484"
    class="floating-btn-call group"
    style="display:flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:50%;background:#b45309;animation:fadeInUp 0.45s ease 0.1s both;"
    title="Call Us Now" aria-label="Call Us Now">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.21 2 2 0 012 .01h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
    </svg>
    <span style="position:absolute;right:calc(100% + 10px);top:50%;transform:translateY(-50%);background:#1c1917;color:#fff;font-size:11px;font-weight:600;padding:4px 10px;border-radius:6px;white-space:nowrap;pointer-events:none;opacity:0;transition:opacity 0.2s;" class="floating-tooltip">Call Us Now</span>
  </a>

</div><!-- /#floating-buttons -->

<style>
.floating-btn-wa:hover .floating-tooltip,
.floating-btn-call:hover .floating-tooltip { opacity: 1 !important; }
</style>
