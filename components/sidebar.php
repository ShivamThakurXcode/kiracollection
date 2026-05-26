<style>
  /* ===== KiraCollection Sidebar ===== */
  #sidebar {
    border-right: 1px solid #faf0ea;
    box-shadow: 8px 0 40px rgba(0, 0, 0, 0.07) !important;
    scrollbar-width: none;
    -ms-overflow-style: none;
  }
  #sidebar::-webkit-scrollbar { display: none; }

  /* ---- Close button ---- */
  #side-bar-menu-close {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #fff5ee;
    border: 1.5px solid #ffe4cc;
    color: #f97316;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease, color 0.2s ease, transform 0.15s ease;
    flex-shrink: 0;
  }
  #side-bar-menu-close:hover {
    background: #f97316;
    color: #fff;
    border-color: #f97316;
    transform: rotate(90deg);
  }

  /* ---- Search input ---- */
  #sidebar .sb-search-input {
    width: 100%;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 9px 14px;
    font-size: 13.5px;
    outline: none;
    background: #fff;
    color: #3d3829;
    font-family: 'DM Sans', sans-serif;
    transition: border-color 0.18s ease;
  }
  #sidebar .sb-search-input:focus { border-color: #f97316; }
  #sidebar .sb-search-input::placeholder { color: #c0bab4; }

  /* ---- Search results dropdown ---- */
  #sidebar .search-result-container {
    border-radius: 18px;
    border: 1px solid #f0ebe5;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
  }

  /* ---- Nav links ---- */
  #sidebar .sb-nav ul {
    display: flex;
    flex-direction: column;
    gap: 2px;
    padding: 0;
    margin: 0;
    list-style: none;
  }
  #sidebar .sb-nav ul li a {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14.5px;
    font-weight: 500;
    font-family: 'DM Sans', sans-serif;
    color: #4a4438;
    padding: 11px 14px;
    border-radius: 12px;
    text-decoration: none;
    transition: background 0.18s ease, color 0.18s ease, padding-left 0.18s ease;
    line-height: 1.4;
  }
  #sidebar .sb-nav ul li a:hover {
    background: #fff5ee;
    color: #f97316;
    padding-left: 20px;
  }
  #sidebar .sb-nav ul li a.active {
    background: #fff5ee;
    color: #f97316;
    font-weight: 600;
  }
  #sidebar .sb-nav ul li a .nav-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #f97316;
    opacity: 0;
    flex-shrink: 0;
    transition: opacity 0.18s ease;
  }
  #sidebar .sb-nav ul li a.active .nav-dot,
  #sidebar .sb-nav ul li a:hover .nav-dot {
    opacity: 1;
  }

  /* ---- Divider ---- */
  .sb-divider {
    height: 1px;
    background: linear-gradient(to right, transparent, #f0ebe5 20%, #f0ebe5 80%, transparent);
    margin: 4px 0;
  }

  /* ---- Shop Now CTA ---- */
  .sb-cta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 13px 24px;
    background: #f97316;
    color: #fff;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    text-decoration: none;
    border-radius: 100px;
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 18px rgba(249, 115, 22, 0.3);
    transition: background 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
  }
  .sb-cta:hover {
    background: #ea580c;
    transform: translateY(-1px);
    box-shadow: 0 6px 24px rgba(249, 115, 22, 0.4);
    color: #fff;
  }

  /* ---- Social icons ---- */
  .sb-social-link {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f97316;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: background 0.2s ease, transform 0.2s ease;
  }
  .sb-social-link:hover {
    background: #ea580c;
    transform: translateY(-3px);
  }

  /* ---- Recent search tags ---- */
  .sb-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 10px 5px 12px;
    background: #fff5ee;
    border: 1px solid #ffe4cc;
    border-radius: 100px;
    font-size: 12px;
    font-weight: 500;
    color: #ea580c;
    cursor: pointer;
    transition: background 0.15s ease;
  }
  .sb-tag:hover { background: #ffe4cc; }
  .sb-tag .sb-tag-x {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: rgba(249,115,22,0.15);
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }
</style>

<!-- SIDEBAR START -->
<div
  class="fixed top-0 left-0 w-[300px] bg-white h-full z-91 px-5 py-7 flex flex-col justify-between gap-y-7 overflow-y-auto transition-all duration-300 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-x-0 data-[state=open]:opacity-100 data-[state=open]:visible data-[state=close]:-translate-x-[220px] data-[state=close]:opacity-0 data-[state=close]:invisible"
  id="sidebar" data-state="close">

  <div class="flex flex-col gap-y-6">

    <!-- ── Logo + Close ── -->
    <div class="flex items-center justify-between pb-5" style="border-bottom:1px solid #f5ede6;">
      <div class="flex items-center gap-x-2">
        <img src="images/logo-header.png" alt="KiraCollection Art"
             style="height:38px;width:auto;object-fit:contain;"
             onerror="this.style.display='none';document.getElementById('sb-logo-text').style.display='block'">
        <span id="sb-logo-text" style="display:none;font-size:15px;font-weight:700;color:#f97316;letter-spacing:0.02em;font-family:'Urbanist',sans-serif;">KiraCollection</span>
      </div>
      <button id="side-bar-menu-close" aria-label="Close menu">
        <i class="hgi hgi-stroke hgi-multiplication-sign text-sm"></i>
      </button>
    </div>

    <!-- ── Search ── -->
    <div class="relative search-input-container">
      <i class="hgi hgi-stroke hgi-search-01" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:15px;color:#c0bab4;pointer-events:none;z-index:1;"></i>
      <input type="text" class="header-search-input sb-search-input" placeholder="Search artworks…" style="padding-left:36px;" />

      <div data-state="close"
        class="search-result-container p-4 absolute w-full top-[calc(100%+10px)] left-0 bg-white z-9 transform data-[state=close]:translate-y-3 data-[state=close]:opacity-0 data-[state=close]:invisible transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)] data-[state=open]:translate-y-0 data-[state=open]:opacity-100 data-[state=open]:visible">
        <div class="search-suggestions">
          <p style="font-size:11px;letter-spacing:2.5px;text-transform:uppercase;color:#bbb;font-weight:600;margin-bottom:10px;">Recent</p>
          <div class="flex flex-wrap gap-2 recent-search-list mb-3">
            <button class="sb-tag recent-search-item">
              Lippan Art
              <span class="sb-tag-x"><i class="hgi hgi-stroke hgi-cancel-01" style="font-size:9px;color:#f97316;"></i></span>
            </button>
            <button class="sb-tag recent-search-item">
              Mandala Art
              <span class="sb-tag-x"><i class="hgi hgi-stroke hgi-cancel-01" style="font-size:9px;color:#f97316;"></i></span>
            </button>
            <button class="sb-tag recent-search-item">
              Home Decor
              <span class="sb-tag-x"><i class="hgi hgi-stroke hgi-cancel-01" style="font-size:9px;color:#f97316;"></i></span>
            </button>
          </div>
        </div>
        <div class="search-results hidden">
          <div class="search-results-list flex flex-col gap-y-1"></div>
        </div>
        <div class="search-empty hidden">
          <p style="font-size:13px;text-align:center;color:#bbb;padding:16px 0;">No results found</p>
        </div>
      </div>
    </div>

    <!-- ── Navigation ── -->
    <nav class="sb-nav">
      <ul>
        <li><a href="index.php" class="active"><span class="nav-dot"></span>Home</a></li>
        <li><a href="about.php"><span class="nav-dot"></span>About Us</a></li>
        <li><a href="shop.php"><span class="nav-dot"></span>Shop</a></li>
        <li><a href="blog.php"><span class="nav-dot"></span>Blog</a></li>
        <li><a href="contact.php"><span class="nav-dot"></span>Contact</a></li>
        <div class="sb-divider"></div>
        <li><a href="wishlist.php"><span class="nav-dot"></span>Wishlist</a></li>
        <li><a href="cart.php"><span class="nav-dot"></span>Cart</a></li>
      </ul>
    </nav>

    <!-- ── CTA button ── -->
    <a href="shop.php" class="sb-cta">
      <i class="hgi hgi-stroke hgi-shopping-bag-01 text-sm"></i>
      Explore Collection
    </a>

  </div>

  <!-- ── Footer: Social ── -->
  <div>
    <p style="font-size:10.5px;letter-spacing:3px;text-transform:uppercase;color:#ccc;font-weight:600;margin-bottom:12px;">Follow Us</p>
    <ul class="flex items-center gap-x-3" style="list-style:none;padding:0;margin:0;">
      <li>
        <a href="#" class="sb-social-link" aria-label="Instagram">
          <i class="hgi hgi-stroke hgi-instagram text-sm text-white"></i>
        </a>
      </li>
      <li>
        <a href="#" class="sb-social-link" aria-label="Facebook">
          <i class="hgi hgi-stroke hgi-facebook-01 text-sm text-white"></i>
        </a>
      </li>
      <li>
        <a href="#" class="sb-social-link" aria-label="YouTube">
          <i class="hgi hgi-stroke hgi-youtube text-sm text-white"></i>
        </a>
      </li>
      <li>
        <a href="#" class="sb-social-link" aria-label="Pinterest">
          <i class="hgi hgi-stroke hgi-pinterest text-sm text-white"></i>
        </a>
      </li>
    </ul>
  </div>

</div>
<!-- SIDEBAR END -->
