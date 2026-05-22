<!-- ========== Newsletter Strip ========== -->
<section style="background:#556b2f; padding:40px 0;">
  <div class="container">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
      <div>
        <h3 style="font-family:'Urbanist',sans-serif;font-size:1.375rem;font-weight:700;color:#fff;margin-bottom:4px;">Stay Updated with New Art Arrivals</h3>
        <p style="font-size:0.875rem;color:rgba(255,255,255,0.80);">Subscribe for exclusive offers and first access to new collections.</p>
      </div>
      <form class="flex items-center gap-2 w-full md:w-auto" onsubmit="return false;" style="min-width:0;">
        <input type="email" placeholder="Enter your email address"
          style="flex:1;min-width:0;padding:10px 16px;border-radius:8px;border:1.5px solid rgba(255,255,255,0.3);outline:none;font-size:0.875rem;color:#212529;background:#fff;font-family:'DM Sans',sans-serif;" />
        <button type="submit"
          style="flex-shrink:0;padding:10px 20px;border-radius:8px;background:#ffd700;color:#3d5a1f;font-size:0.875rem;font-weight:700;border:none;cursor:pointer;white-space:nowrap;font-family:'DM Sans',sans-serif;">
          Subscribe
        </button>
      </form>
    </div>
  </div>
</section>

<!-- ========== Footer ========== -->
<footer style="background:#fff;color:#212529;border-top:1px solid #dfe3e8;">

  <!-- Main footer columns -->
  <div style="padding:52px 0 40px;">
    <div class="container">
      <div class="grid grid-cols-12 gap-x-8 gap-y-10">

        <!-- Column 1: Brand -->
        <div class="col-span-12 lg:col-span-4">
          <a href="index.php" style="display:inline-block;margin-bottom:20px;">
            <img src="images/logo-header.png" alt="KiraCollection Art" style="height:48px;width:auto;">
          </a>
          <p style="font-size:0.9375rem;line-height:1.75;color:#495057;margin-bottom:24px;max-width:320px;">
            Discover exquisite handcrafted lippan art, sacred mandala designs, and elegant home decor pieces.
            Each piece is crafted with love and tradition to transform your living space.
          </p>
          <!-- Social icons using HugeIcons (same library as admin for consistency) -->
          <div style="display:flex;flex-wrap:wrap;gap:8px;">
            <!-- UPDATE: add real social URLs -->
            <a href="#" title="Instagram" aria-label="Instagram" class="kira-social-btn">
              <i class="hgi hgi-stroke hgi-instagram"></i>
            </a>
            <a href="#" title="Facebook" aria-label="Facebook" class="kira-social-btn">
              <i class="hgi hgi-stroke hgi-facebook-01"></i>
            </a>
            <a href="#" title="YouTube" aria-label="YouTube" class="kira-social-btn">
              <i class="hgi hgi-stroke hgi-youtube"></i>
            </a>
            <a href="#" title="Pinterest" aria-label="Pinterest" class="kira-social-btn">
              <i class="hgi hgi-stroke hgi-pinterest"></i>
            </a>
            <a href="https://wa.me/918979111484" title="WhatsApp" aria-label="WhatsApp" target="_blank" rel="noopener" class="kira-social-btn">
              <i class="hgi hgi-stroke hgi-whatsapp"></i>
            </a>
          </div>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="col-span-6 sm:col-span-4 lg:col-span-2">
          <h5 class="kira-footer-title">Quick Links</h5>
          <ul class="kira-footer-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>

        <!-- Column 3: Marketplace — using real SVG logos from images/ folder -->
        <div class="col-span-6 sm:col-span-4 lg:col-span-2">
          <h5 class="kira-footer-title">Also Available On</h5>
          <div style="display:flex;flex-direction:column;gap:12px;margin-top:4px;">

            <!-- Flipkart — uses images/flipkar.svg -->
            <!-- UPDATE: Flipkart store URL -->
            <a href="#" target="_blank" rel="noopener"
              style="display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;border:1.5px solid #dfe3e8;background:#f9fafb;text-decoration:none;transition:border-color 0.2s,background 0.2s;"
              onmouseover="this.style.borderColor='#2874F0';this.style.background='#e8f0ff';"
              onmouseout="this.style.borderColor='#dfe3e8';this.style.background='#f9fafb';">
              <span style="width:80px;height:24px;display:flex;align-items:center;flex-shrink:0;">
                <img src="images/flipkar.svg" alt="Flipkart" style="width:80px;height:24px;object-fit:contain;" />
              </span>
              <span style="font-size:11px;color:#919eab;font-weight:500;white-space:nowrap;">Shop Now →</span>
            </a>

            <!-- Amazon — uses images/amzon-black-text.svg (dark text, suits white bg) -->
            <!-- UPDATE: Amazon store URL -->
            <a href="#" target="_blank" rel="noopener"
              style="display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;border:1.5px solid #dfe3e8;background:#f9fafb;text-decoration:none;transition:border-color 0.2s,background 0.2s;"
              onmouseover="this.style.borderColor='#FF9900';this.style.background='#fff8ee';"
              onmouseout="this.style.borderColor='#dfe3e8';this.style.background='#f9fafb';">
              <span style="width:80px;height:24px;display:flex;align-items:center;flex-shrink:0;">
                <img src="images/amzon-black-text.svg" alt="Amazon" style="width:80px;height:24px;object-fit:contain;" />
              </span>
              <span style="font-size:11px;color:#919eab;font-weight:500;white-space:nowrap;">Shop Now →</span>
            </a>

          </div>
        </div>

        <!-- Column 4: Contact — HugeIcons matching admin icon style -->
        <div class="col-span-12 sm:col-span-4 lg:col-span-4">
          <h5 class="kira-footer-title">Contact Us</h5>
          <ul class="kira-footer-contact">
            <li>
              <span class="kira-contact-icon">
                <i class="hgi hgi-stroke hgi-maps-global-01" style="font-size:18px;"></i>
              </span>
              <span>Sneh Vandan House, Opposite Shilpgram Parking, Tajganj, Agra</span>
            </li>
            <li>
              <span class="kira-contact-icon">
                <i class="hgi hgi-stroke hgi-call" style="font-size:18px;"></i>
              </span>
              <!-- UPDATE: phone -->
              <a href="tel:8979111484" class="kira-contact-link">+91 89791 11484</a>
            </li>
            <li>
              <span class="kira-contact-icon">
                <i class="hgi hgi-stroke hgi-mail-02" style="font-size:18px;"></i>
              </span>
              <!-- UPDATE: email -->
              <a href="mailto:info@kiracollectionart.com" class="kira-contact-link" style="word-break:break-all;">info@kiracollectionart.com</a>
            </li>
            <li>
              <span class="kira-contact-icon">
                <i class="hgi hgi-stroke hgi-whatsapp" style="font-size:18px;"></i>
              </span>
              <a href="https://wa.me/918979111484?text=Hi!%20I'm%20interested%20in%20your%20art%20pieces."
                target="_blank" rel="noopener" class="kira-contact-link">Chat on WhatsApp</a>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <!-- Bottom bar -->
  <div style="border-top:1px solid #dfe3e8;padding:16px 0;">
    <div class="container">
      <div class="kira-footer-bottom">
        <p style="font-size:13px;color:#919eab;margin:0;">© 2026 KiraCollection Art &nbsp;|&nbsp; Developed by Dynexia IT Solutions</p>
        <div style="display:flex;align-items:center;gap:12px;font-size:13px;">
          <a href="privacy-policy.php" class="kira-bottom-link">Privacy</a>
          <span style="color:#dfe3e8;">•</span>
          <a href="terms-and-conditions.php" class="kira-bottom-link">Terms</a>
          <span style="color:#dfe3e8;">•</span>
          <a href="support.php" class="kira-bottom-link">Support</a>
        </div>
      </div>
    </div>
  </div>

</footer>
<!-- ========== Footer End ========== -->

<!-- ========== Fixed Floating Buttons ========== -->
<div style="position:fixed;bottom:24px;right:20px;z-index:9000;display:flex;flex-direction:column;align-items:center;gap:8px;">

  <!-- WhatsApp -->
  <a href="https://wa.me/918979111484?text=Hi!%20I'm%20interested%20in%20your%20art%20pieces."
    target="_blank" rel="noopener"
    title="Chat on WhatsApp" aria-label="Chat on WhatsApp"
    style="width:50px;height:50px;border-radius:50%;background:#25D366;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,0.2);text-decoration:none;transition:transform 0.2s,box-shadow 0.2s;"
    onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 20px rgba(0,0,0,0.25)'"
    onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 12px rgba(0,0,0,0.2)'">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white">
      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
  </a>

  <!-- Call -->
  <a href="tel:8979111484"
    title="Call Us Now" aria-label="Call Us Now"
    style="width:42px;height:42px;border-radius:50%;background:#556b2f;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,0.18);text-decoration:none;transition:transform 0.2s,box-shadow 0.2s;"
    onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 20px rgba(0,0,0,0.22)'"
    onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 12px rgba(0,0,0,0.18)'">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
      stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.01 1.21 2 2 0 012 .01h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
    </svg>
  </a>

</div>

<!-- ========== Footer Component Styles ========== -->
<style>
/* Footer titles — matches admin .table-card-header style */
.kira-footer-title {
  font-family: 'Urbanist', sans-serif;
  font-size: 14px;
  font-weight: 700;
  color: #212529;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 16px;
  padding-bottom: 10px;
  border-bottom: 1px solid #dfe3e8;
}

/* Quick links */
.kira-footer-links {
  display: flex;
  flex-direction: column;
  gap: 10px;
  list-style: none;
  margin: 0;
  padding: 0;
}
.kira-footer-links a {
  font-size: 14px;
  font-weight: 500;
  color: #495057;
  text-decoration: none;
  transition: color 0.2s;
}
.kira-footer-links a:hover { color: #556b2f; }

/* Social icon buttons — matches admin .btn-action style */
.kira-social-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 8px;
  background: #e8f5e8;
  color: #556b2f;
  text-decoration: none;
  transition: background 0.2s, transform 0.2s;
  font-size: 18px;
}
.kira-social-btn:hover {
  background: #a8d5a8;
  transform: translateY(-1px);
}

/* Contact list */
.kira-footer-contact {
  display: flex;
  flex-direction: column;
  gap: 14px;
  list-style: none;
  margin: 0;
  padding: 0;
}
.kira-footer-contact li {
  display: grid;
  grid-template-columns: 36px 1fr;
  gap: 12px;
  align-items: start;
}

/* Contact icon — matches admin .stat-icon style */
.kira-contact-icon {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  background: #e8f5e8;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: #556b2f;
  flex-shrink: 0;
}

.kira-contact-link {
  font-size: 14px;
  font-weight: 500;
  color: #495057;
  text-decoration: none;
  transition: color 0.2s;
  line-height: 1.5;
  padding-top: 8px;
  display: inline-block;
}
.kira-contact-link:hover { color: #556b2f; }

/* Bottom bar */
.kira-footer-bottom {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}

.kira-bottom-link {
  font-size: 13px;
  color: #919eab;
  text-decoration: none;
  transition: color 0.2s;
}
.kira-bottom-link:hover { color: #556b2f; }

/* Mobile bottom bar center */
@media (max-width: 640px) {
  .kira-footer-bottom {
    flex-direction: column;
    text-align: center;
    align-items: center;
  }
}
</style>
