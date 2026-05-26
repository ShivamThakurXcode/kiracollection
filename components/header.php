<!-- ========== HEADER Section Start ========== -->
<header>

  <!-- ── TOP BAR ── -->
  <div class="hidden header-top border-b" style="background:#fff;border-color:#dfe3e8;">
    <div class="container">
      <div class="flex items-center xl:justify-between justify-center py-2">

        <!-- Left: WhatsApp support + Marketplace badges -->
        <div class="xl:flex items-center gap-x-5 hidden">
          <p class="flex items-center gap-x-2 text-sm" style="color:#495057;">
            <i class="hgi hgi-stroke hgi-whatsapp text-xl" style="color:#25D366;"></i>
            Need Support?
            <a href="https://wa.me/918979111484" target="_blank" rel="noopener"
              class="py-1 px-3 text-xs rounded-[60px] font-semibold transition-colors"
              style="background:#e8f5e8;color:#3d5a1f;"
              onmouseover="this.style.background='#a8d5a8'" onmouseout="this.style.background='#e8f5e8'">
              +91 89791 11484 <!-- UPDATE: phone -->
            </a>
          </p>

          <!-- Marketplace badges -->
          <div class="flex items-center gap-x-2">
            <a href="#" target="_blank" rel="noopener" title="Shop on Flipkart"
              class="flex items-center gap-x-1.5 py-1 px-3 rounded-[60px] text-xs font-semibold transition-colors"
              style="background:#e8f0ff;color:#2874F0;"
              onmouseover="this.style.background='#d0e0ff'" onmouseout="this.style.background='#e8f0ff'">
              <!-- UPDATE: Flipkart store URL -->
              <svg width="12" height="12" viewBox="0 0 12 12"><rect width="12" height="12" rx="2" fill="#2874F0"/><text x="50%" y="50%" dominant-baseline="central" text-anchor="middle" fill="white" font-size="8" font-weight="bold" font-family="Arial">F</text></svg>
              Flipkart
            </a>
            <a href="#" target="_blank" rel="noopener" title="Shop on Amazon"
              class="flex items-center gap-x-1.5 py-1 px-3 rounded-[60px] text-xs font-semibold transition-colors"
              style="background:#fff3e0;color:#b45000;"
              onmouseover="this.style.background='#ffe0b2'" onmouseout="this.style.background='#fff3e0'">
              <!-- UPDATE: Amazon store URL -->
              <svg width="12" height="12" viewBox="0 0 12 12"><rect width="12" height="12" rx="2" fill="#FF9900"/><text x="50%" y="50%" dominant-baseline="central" text-anchor="middle" fill="white" font-size="8" font-weight="bold" font-family="Arial">a</text></svg>
              Amazon
            </a>
          </div>
        </div>

        <!-- Centre: Free shipping badge -->
        <p class="flex items-center gap-x-2 text-sm font-medium" style="color:#495057;">
          <i class="hgi hgi-stroke hgi-truck-01 text-xl" style="color:#556b2f;"></i>
          Free Shipping on orders above
          <span class="py-1 px-3 text-xs rounded-[60px] font-semibold" style="background:#e8f5e8;color:#3d5a1f;">₹999</span>
        </p>

        <!-- Right: Top nav links -->
        <div class="hidden xl:flex items-center">
          <?php
          $topLinks = [
            ['label' => 'About Us',   'href' => 'about.php'],
            ['label' => 'My Account', 'href' => 'account.php'],
            ['label' => 'Wishlist',   'href' => 'wishlist.php'],
            ['label' => 'Shop',       'href' => 'shop.php'],
            ['label' => 'Contact',    'href' => 'contact.php'],
            ['label' => 'Blog',       'href' => 'blog.php'],
          ];
          $last = count($topLinks) - 1;
          foreach ($topLinks as $i => $lnk):
          ?>
          <a href="<?= $lnk['href'] ?>"
            class="text-sm font-medium transition-colors <?= $i < $last ? 'pr-4 mr-4 border-r' : '' ?>"
            style="color:#495057;border-color:#dfe3e8;"
            onmouseover="this.style.color='#556b2f'" onmouseout="this.style.color='#495057'">
            <?= $lnk['label'] ?>
          </a>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </div>
  <!-- ── TOP BAR END ── -->


  <!-- ── MOBILE HEADER ── -->
  <div class="block xl:hidden sticky-header border-b" style="background:#fff;border-color:#dfe3e8;">
    <div class="container">

      <!-- Row 1: hamburger / logo / icons -->
      <div class="flex justify-between items-center py-3">
        <button id="sidebar-menu-btn" aria-label="Open menu"
          class="size-11 rounded-xl flex items-center justify-center transition-colors"
          style="background:#e8f5e8;" onmouseover="this.style.background='#a8d5a8'" onmouseout="this.style.background='#e8f5e8'">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M20 12L10 12" stroke="#556b2f" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M20 5L4 5"   stroke="#556b2f" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M20 19L4 19" stroke="#556b2f" stroke-width="1.8" stroke-linecap="round"/>
          </svg>
        </button>

        <a href="index.php">
          <img src="images/logo.webp" alt="KiraCollection Art" class="h-14 w-auto">
        </a>

        <div class="flex items-center gap-x-2">
          <a href="wishlist.php" aria-label="Wishlist"
            class="size-11 rounded-xl flex items-center justify-center transition-colors"
            style="position:relative;background:#e8f5e8;" onmouseover="this.style.background='#a8d5a8'" onmouseout="this.style.background='#e8f5e8'">
            <i class="hgi hgi-stroke hgi-favourite text-xl" style="color:#556b2f;"></i>
            <span class="wishlist-count" style="position:absolute;top:-5px;right:-5px;min-width:17px;height:17px;background:#cb0233;color:#fff;font-size:10px;font-weight:700;border-radius:999px;display:flex;align-items:center;justify-content:center;padding:0 3px;line-height:1;border:2px solid #fff;">0</span>
          </a>
          <button aria-label="Cart"
            class="size-11 rounded-xl flex items-center justify-center transition-colors cart-sidebar-btn"
            style="position:relative;background:#e8f5e8;" onmouseover="this.style.background='#a8d5a8'" onmouseout="this.style.background='#e8f5e8'">
            <i class="hgi hgi-stroke hgi-shopping-cart-01 text-xl" style="color:#556b2f;"></i>
            <span class="cart-count" style="position:absolute;top:-5px;right:-5px;min-width:17px;height:17px;background:#cb0233;color:#fff;font-size:10px;font-weight:700;border-radius:999px;display:flex;align-items:center;justify-content:center;padding:0 3px;line-height:1;border:2px solid #fff;">0</span>
          </button>
        </div>
      </div>

      <!-- Row 2: Mobile search -->
      <div class="pb-3">
        <div class="relative search-input-container">
          <i class="hgi hgi-stroke hgi-search-01" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:16px;color:#919eab;pointer-events:none;"></i>
          <input type="text" id="mobile-search"
            class="header-search-input"
            placeholder="Search art, decor, gifts…"
            style="width:100%;border:1px solid #e5e7eb;border-radius:8px;padding:9px 14px 9px 36px;font-size:13.5px;outline:none;background:#fff;color:#212529;font-family:'DM Sans',sans-serif;transition:border-color 0.18s;" onfocus="this.style.borderColor='#556b2f'" onblur="this.style.borderColor='#e5e7eb'" />
          <!-- Search dropdown -->
          <div data-state="close"
            class="search-result-container p-4 absolute w-full top-[calc(100%+8px)] left-0 border bg-white rounded-2xl z-50
                   transform data-[state=close]:translate-y-2 data-[state=close]:opacity-0 data-[state=close]:invisible
                   transition-all duration-300 ease-[cubic-bezier(0.645,0.045,0.355,1)]
                   data-[state=open]:translate-y-0 data-[state=open]:opacity-100 data-[state=open]:visible"
            style="border-color:#dfe3e8;box-shadow:0 8px 24px rgba(145,158,171,0.14);">
            <div class="search-results hidden">
              <p class="text-sm font-semibold mb-3" style="color:#212529;">Search Results</p>
              <div class="search-results-list flex flex-col gap-y-2"></div>
            </div>
            <div class="search-empty hidden text-sm" style="color:#919eab;">No products found.</div>
            <div class="search-suggestions">
              <div class="recent-search-wrapper mb-4">
                <div class="flex justify-between items-center mb-2">
                  <p class="text-xs font-bold uppercase tracking-wide" style="color:#919eab;">Recent</p>
                  <button class="text-xs font-semibold" style="color:#556b2f;">Reset History</button>
                </div>
                <div class="flex flex-wrap gap-1.5 recent-search-list">
                  <?php foreach (['Lippan Art Mirror', 'Mandala Clock', 'Wall Panel'] as $term): ?>
                  <button class="recent-search-item inline-flex items-center gap-1.5 text-xs font-medium px-3 py-1.5 rounded-[60px] border transition-colors"
                    style="background:#e8f5e8;color:#3d5a1f;border-color:#a8d5a8;">
                    <?= $term ?>
                    <i class="hgi hgi-stroke hgi-cancel-01" style="font-size:10px;"></i>
                  </button>
                  <?php endforeach; ?>
                </div>
              </div>
              <div>
                <p class="text-xs font-bold uppercase tracking-wide mb-3" style="color:#919eab;">Recommended</p>
                <div class="recommended-search-list flex flex-col divide-y" style="border-color:#f4f6f8;">
                  <?php
                  $suggestions = [
                    ['img'=>'images/product/p-1.jpeg','label'=>'Lippan Art Mirror Frames','href'=>'shop.php?category=Lippan+Art'],
                    ['img'=>'images/product/p-2.png', 'label'=>'Sacred Mandala Wall Art',  'href'=>'shop.php?category=Mandala+Art'],
                    ['img'=>'images/product/p-5.png', 'label'=>'Handcrafted Home Decor',   'href'=>'shop.php?category=Home+Decor'],
                    ['img'=>'images/product/p-7.png', 'label'=>'Handcrafted Gift Sets',    'href'=>'shop.php?category=Handcrafted+Gifts'],
                  ];
                  foreach ($suggestions as $s): ?>
                  <a href="<?= $s['href'] ?>" class="flex items-center gap-x-3 py-2 first:pt-0 last:pb-0"
                    onmouseover="this.querySelector('span').style.color='#556b2f'" onmouseout="this.querySelector('span').style.color='#212529'">
                    <div class="size-9 rounded-lg overflow-hidden flex-shrink-0" style="background:#e8f5e8;">
                      <img src="<?= $s['img'] ?>" alt="<?= htmlspecialchars($s['label']) ?>" class="w-full h-full object-cover" />
                    </div>
                    <span class="text-sm font-semibold transition-colors" style="color:#212529;">
                      <?= htmlspecialchars($s['label']) ?>
                    </span>
                  </a>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- ── MOBILE HEADER END ── -->


  <!-- ── DESKTOP HEADER ── -->
  <div class="hidden xl:flex header-bottom sticky-header border-b" style="background:#fff;border-color:#dfe3e8;">
    <div class="container">
      <div class="flex items-center justify-between gap-x-4 py-2">

        <!-- Logo + Category Dropdown -->
        <div class="flex items-center gap-x-4 flex-shrink-0">
          <a href="index.php">
            <img src="images/logo.webp" alt="KiraCollection Art" class="h-12 w-auto">
          </a>
        </div>

        <!-- Desktop Search -->
        <div class="relative search-input-container" style="flex:0 1 280px;max-width:280px;">
          <i class="hgi hgi-stroke hgi-search-01" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:16px;color:#919eab;pointer-events:none;"></i>
          <input type="text" id="desktop-search"
            class="header-search-input"
            placeholder="Search art, decor, gifts…"
            style="width:100%;border:1px solid #e5e7eb;border-radius:8px;padding:9px 14px 9px 36px;font-size:13.5px;outline:none;background:#fff;color:#212529;font-family:'DM Sans',sans-serif;transition:border-color 0.18s;" onfocus="this.style.borderColor='#556b2f'" onblur="this.style.borderColor='#e5e7eb'" />
          <!-- Search dropdown -->
          <div data-state="close"
            class="search-result-container p-4 absolute w-full top-[calc(100%+8px)] left-0 border bg-white rounded-2xl z-50
                   transform data-[state=close]:translate-y-2 data-[state=close]:opacity-0 data-[state=close]:invisible
                   transition-all duration-300 ease-[cubic-bezier(0.645,0.045,0.355,1)]
                   data-[state=open]:translate-y-0 data-[state=open]:opacity-100 data-[state=open]:visible"
            style="border-color:#dfe3e8;box-shadow:0 8px 24px rgba(145,158,171,0.14);min-width:320px;">
            <div class="search-results hidden">
              <p class="text-sm font-semibold mb-3" style="color:#212529;">Search Results</p>
              <div class="search-results-list flex flex-col gap-y-2"></div>
            </div>
            <div class="search-empty hidden text-sm" style="color:#919eab;">No products found.</div>
            <div class="search-suggestions">
              <p class="text-xs font-bold uppercase tracking-wide mb-3" style="color:#919eab;">Popular</p>
              <div class="recommended-search-list flex flex-col divide-y" style="border-color:#f4f6f8;">
                <?php foreach ($suggestions as $s): ?>
                <a href="<?= $s['href'] ?>" class="flex items-center gap-x-3 py-2 first:pt-0 last:pb-0"
                  onmouseover="this.querySelector('span').style.color='#556b2f'" onmouseout="this.querySelector('span').style.color='#212529'">
                  <div class="size-9 rounded-lg overflow-hidden flex-shrink-0" style="background:#e8f5e8;">
                    <img src="<?= $s['img'] ?>" alt="<?= htmlspecialchars($s['label']) ?>" class="w-full h-full object-cover" />
                  </div>
                  <span class="text-sm font-semibold transition-colors" style="color:#212529;">
                    <?= htmlspecialchars($s['label']) ?>
                  </span>
                </a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Nav + Action icons -->
        <div class="flex items-center gap-x-3 flex-shrink-0">

          <?php
          $currentPage = basename($_SERVER['PHP_SELF']);
          if (!function_exists('isActive')) {
            function isActive($page, $current) { return $page === $current ? 'active' : ''; }
          }
          ?>
          <nav class="main-menu">
            <ul>
              <li><a class="<?= isActive('index.php',   $currentPage) ?>" href="index.php">Home</a></li>
              <li><a class="<?= isActive('about.php',   $currentPage) ?>" href="about.php">About</a></li>
              <li><a class="<?= isActive('shop.php',    $currentPage) ?>" href="shop.php">Shop</a></li>
              <li><a class="<?= isActive('blog.php',    $currentPage) ?>" href="blog.php">Blog</a></li>
              <li><a class="<?= isActive('contact.php', $currentPage) ?>" href="contact.php">Contact</a></li>
            </ul>
          </nav>

          <div class="flex items-center gap-x-2 flex-shrink-0">
            <a href="#" target="_blank" rel="noopener" title="Shop on Flipkart"
              class="inline-flex items-center gap-x-2 rounded-md border px-3 py-2 text-xs font-semibold transition-colors"
              style="border-color:#dfe3e8;background:#f8fbff;color:#2874F0;"
              onmouseover="this.style.background='#e8f0ff';this.style.borderColor='#b9d0ff'" onmouseout="this.style.background='#f8fbff';this.style.borderColor='#dfe3e8'">
              <img src="images/flipkar.svg" alt="Flipkart" style="width:72px;height:22px;object-fit:contain;" />
            </a>
            <a href="#" target="_blank" rel="noopener" title="Shop on Amazon"
              class="inline-flex items-center gap-x-2 rounded-md border px-3 py-2 text-xs font-semibold transition-colors"
              style="border-color:#dfe3e8;background:#fff7ef;color:#b45000;"
              onmouseover="this.style.background='#fff0df';this.style.borderColor='#ffd0a8'" onmouseout="this.style.background='#fff7ef';this.style.borderColor='#dfe3e8'">
              <img src="images/amzon-black-text.svg" alt="Amazon" style="width:72px;height:22px;object-fit:contain;" />
            </a>
          </div>

          <!-- Account -->
          <a href="account.php" aria-label="My Account"
            class="size-11 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors"
            style="background:#e8f5e8;" onmouseover="this.style.background='#a8d5a8'" onmouseout="this.style.background='#e8f5e8'">
            <i class="hgi hgi-stroke hgi-user text-xl" style="color:#556b2f;"></i>
          </a>

          <!-- Wishlist -->
          <a href="wishlist.php" aria-label="Wishlist"
            class="size-11 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors"
            style="position:relative;background:#e8f5e8;" onmouseover="this.style.background='#a8d5a8'" onmouseout="this.style.background='#e8f5e8'">
            <i class="hgi hgi-stroke hgi-favourite text-xl" style="color:#556b2f;"></i>
            <span class="wishlist-count" style="position:absolute;top:-5px;right:-5px;min-width:17px;height:17px;background:#cb0233;color:#fff;font-size:10px;font-weight:700;border-radius:999px;display:flex;align-items:center;justify-content:center;padding:0 3px;line-height:1;border:2px solid #fff;">0</span>
          </a>

          <!-- Cart -->
          <button aria-label="Cart"
            class="size-11 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors cart-sidebar-btn"
            style="position:relative;background:#e8f5e8;" onmouseover="this.style.background='#a8d5a8'" onmouseout="this.style.background='#e8f5e8'">
            <i class="hgi hgi-stroke hgi-shopping-cart-02 text-xl" style="color:#556b2f;"></i>
            <span class="cart-count" style="position:absolute;top:-5px;right:-5px;min-width:17px;height:17px;background:#cb0233;color:#fff;font-size:10px;font-weight:700;border-radius:999px;display:flex;align-items:center;justify-content:center;padding:0 3px;line-height:1;border:2px solid #fff;">0</span>
          </button>

        </div>
      </div>
    </div>
  </div>
  <!-- ── DESKTOP HEADER END ── -->

</header>
<!-- ========== HEADER Section End ========== -->
