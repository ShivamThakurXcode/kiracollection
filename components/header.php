<!-- ========== HEADER Section Start ========== -->
<header>

  <!-- ── TOP BAR ── -->
  <div class="header-top border-b border-amber-100/80" style="background: linear-gradient(135deg,#fffbeb 0%,#fff7ed 50%,#fffbeb 100%);">
    <div class="container">
      <div class="flex items-center justify-between py-2.5">

        <!-- Left: Support + Marketplace -->
        <div class="hidden xl:flex items-center gap-x-5">
          <a href="https://wa.me/918979111484?text=Hi!%20I'm%20interested%20in%20your%20art%20pieces."
            target="_blank" rel="noopener"
            class="flex items-center gap-x-1.5 text-sm text-stone-600 hover:text-amber-700 transition-colors font-medium">
            <i class="hgi hgi-stroke hgi-whatsapp text-green-500" style="font-size:18px;"></i>
            <!-- UPDATE: phone -->
            <span class="hidden 2xl:inline">Need Help?</span>
            <span class="bg-amber-100 hover:bg-amber-200 transition-colors py-0.5 px-2.5 text-xs rounded-full text-amber-800 font-semibold">+91 89791 11484</span>
          </a>

          <!-- Marketplace badges -->
          <div class="flex items-center gap-x-2">
            <!-- UPDATE: Flipkart store URL -->
            <a href="#" target="_blank" rel="noopener" title="Shop on Flipkart"
              class="flex items-center gap-x-1.5 bg-blue-50 hover:bg-blue-100 transition-colors py-1 px-3 rounded-full text-xs font-bold text-[#2874F0]">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><rect width="12" height="12" rx="2" fill="#2874F0"/><text x="50%" y="50%" dominant-baseline="central" text-anchor="middle" fill="white" font-size="8" font-weight="bold" font-family="Arial">F</text></svg>
              Flipkart
            </a>
            <!-- UPDATE: Amazon store URL -->
            <a href="#" target="_blank" rel="noopener" title="Shop on Amazon"
              class="flex items-center gap-x-1.5 bg-amber-50 hover:bg-amber-100 transition-colors py-1 px-3 rounded-full text-xs font-bold text-amber-900">
              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><rect width="12" height="12" rx="2" fill="#FF9900"/><text x="50%" y="50%" dominant-baseline="central" text-anchor="middle" fill="white" font-size="8" font-weight="bold" font-family="Arial">a</text></svg>
              Amazon
            </a>
          </div>
        </div>

        <!-- Centre: Free shipping badge -->
        <div class="flex items-center gap-x-2 text-sm text-stone-600 font-medium">
          <i class="hgi hgi-stroke hgi-truck-01 text-amber-600" style="font-size:18px;"></i>
          Free Shipping on orders above
          <span class="bg-amber-500 text-white text-xs font-bold py-0.5 px-2.5 rounded-full">₹999</span>
        </div>

        <!-- Right: Nav links -->
        <div class="hidden xl:flex items-center gap-x-0">
          <?php
          $topLinks = [
            ['label' => 'About Us',  'href' => 'about.php'],
            ['label' => 'My Account','href' => 'account.php'],
            ['label' => 'Wishlist',  'href' => 'wishlist.php'],
            ['label' => 'Shop',      'href' => 'shop.php'],
            ['label' => 'Contact',   'href' => 'contact.php'],
            ['label' => 'Blog',      'href' => 'blog.php'],
          ];
          $last = count($topLinks) - 1;
          foreach ($topLinks as $i => $lnk):
          ?>
          <a href="<?= $lnk['href'] ?>"
            class="text-sm text-stone-600 hover:text-amber-700 transition-colors font-medium <?= $i < $last ? 'pr-4 mr-4 border-r border-amber-200' : '' ?>">
            <?= $lnk['label'] ?>
          </a>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </div>
  <!-- ── TOP BAR END ── -->


  <!-- ── MOBILE HEADER ── -->
  <div class="block xl:hidden sticky-header border-b border-amber-100/80" style="background: linear-gradient(135deg,#fffbeb 0%,#fff7ed 50%,#fffbeb 100%);">
    <div class="container">
      <div class="flex justify-between items-center py-3">

        <!-- Hamburger -->
        <button id="sidebar-menu-btn" aria-label="Open menu"
          class="size-10 rounded-full bg-amber-100/80 hover:bg-amber-200 transition-colors flex items-center justify-center flex-shrink-0">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
            <path d="M20 12L10 12" stroke="#92400e" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M20 5L4 5"  stroke="#92400e" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M20 19L4 19" stroke="#92400e" stroke-width="1.8" stroke-linecap="round"/>
          </svg>
        </button>

        <!-- Logo -->
        <a href="index.php" class="flex-shrink-0">
          <img src="images/logo-header.png" alt="KiraCollection Art" style="height:52px; width:auto;">
        </a>

        <!-- Mobile action icons -->
        <div class="flex items-center gap-x-2">
          <a href="wishlist.php" class="relative size-10 rounded-full bg-amber-100/80 hover:bg-amber-200 transition-colors flex items-center justify-center" aria-label="Wishlist">
            <i class="hgi hgi-stroke hgi-favourite text-amber-800" style="font-size:20px;"></i>
            <span class="wishlist-count absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold w-4.5 h-4.5 rounded-full flex items-center justify-center leading-none" style="width:18px;height:18px;font-size:10px;">0</span>
          </a>
          <button class="relative cart-sidebar-btn size-10 rounded-full bg-amber-100/80 hover:bg-amber-200 transition-colors flex items-center justify-center" aria-label="Cart">
            <i class="hgi hgi-stroke hgi-shopping-cart-01 text-amber-800" style="font-size:20px;"></i>
            <span class="cart-count absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center leading-none" style="width:18px;height:18px;font-size:10px;">0</span>
          </button>
        </div>

      </div>

      <!-- Mobile Search -->
      <div class="pb-3">
        <div class="relative search-input-container">
          <div class="input-group w-full px-4 py-2.5 rounded-full border border-amber-200 bg-white/90">
            <div class="input-group-addon" data-align="inline-end">
              <i class="hgi hgi-stroke hgi-search-01 text-amber-500" style="font-size:18px;"></i>
            </div>
            <input type="text" id="mobile-search" autocomplete="off"
              class="peer form-control header-search-input"
              placeholder="Search art, decor, gifts..." />
          </div>
          <?php include __DIR__ . '/search-dropdown.php'; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- ── MOBILE HEADER END ── -->


  <!-- ── DESKTOP HEADER ── -->
  <div class="hidden xl:block sticky-header border-b border-amber-100/80" style="background: linear-gradient(135deg,#fffbeb 0%,#fff7ed 50%,#fffbeb 100%);">
    <div class="container">
      <div class="flex items-center justify-between gap-x-6 py-3">

        <!-- Logo + Category Dropdown -->
        <div class="flex items-center gap-x-5 flex-shrink-0">
          <a href="index.php">
            <img src="images/logo-header.png" alt="KiraCollection Art" style="height:60px; width:auto;">
          </a>

          <!-- Category dropdown trigger -->
          <div class="relative group">
            <button id="dropdownButton" aria-expanded="false" aria-haspopup="true"
              class="flex items-center gap-x-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold text-sm px-4 py-2.5 rounded-full transition-colors">
              <i class="hgi hgi-stroke hgi-grid-view" style="font-size:18px;"></i>
              All Categories
              <i class="hgi hgi-stroke hgi-arrow-down-01" style="font-size:14px;"></i>
            </button>

            <!-- Dropdown panel -->
            <div id="dropdownMenu"
              class="hide absolute left-0 top-full mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-amber-100/60 z-50 overflow-hidden py-2">
              <?php
              $artCategories = [
                ['href' => 'shop.php?category=Lippan+Art',       'icon' => 'hgi-paint-brush-01', 'label' => 'Lippan Art'],
                ['href' => 'shop.php?category=Mandala+Art',      'icon' => 'hgi-sun-cloud-01',   'label' => 'Mandala Art'],
                ['href' => 'shop.php?category=Wall+Decor',       'icon' => 'hgi-image-01',       'label' => 'Wall Decor'],
                ['href' => 'shop.php?category=Mirror+Art',       'icon' => 'hgi-diamond-01',     'label' => 'Mirror Art'],
                ['href' => 'shop.php?category=Home+Decor',       'icon' => 'hgi-home-01',        'label' => 'Home Decor'],
                ['href' => 'shop.php?category=Handcrafted+Gifts','icon' => 'hgi-gift',           'label' => 'Handcrafted Gifts'],
              ];
              foreach ($artCategories as $cat): ?>
              <a href="<?= $cat['href'] ?>"
                class="flex items-center gap-x-3 px-4 py-2.5 text-sm font-medium text-stone-700 hover:bg-amber-50 hover:text-amber-800 transition-colors">
                <span class="size-7 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                  <i class="hgi hgi-stroke <?= $cat['icon'] ?> text-amber-700" style="font-size:16px;"></i>
                </span>
                <?= $cat['label'] ?>
              </a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <!-- Desktop Search -->
        <div class="flex-1 max-w-xl relative search-input-container">
          <div class="input-group px-4 py-2.5 rounded-full border border-amber-200 bg-white/90 shadow-sm">
            <div class="input-group-addon" data-align="inline-end">
              <i class="hgi hgi-stroke hgi-search-01 text-amber-500" style="font-size:18px;"></i>
            </div>
            <input type="text" id="desktop-search" autocomplete="off"
              class="peer form-control header-search-input"
              placeholder="Search art, decor, gifts..." />
          </div>
          <?php include __DIR__ . '/search-dropdown.php'; ?>
        </div>

        <!-- Nav + Actions -->
        <div class="flex items-center gap-x-6 flex-shrink-0">

          <?php
          $currentPage = basename($_SERVER['PHP_SELF']);
          if (!function_exists('isActive')) {
            function isActive($page, $current) { return $page === $current ? 'active' : ''; }
          }
          $navLinks = [
            ['href' => 'index.php',   'label' => 'Home'],
            ['href' => 'about.php',   'label' => 'About'],
            ['href' => 'shop.php',    'label' => 'Shop'],
            ['href' => 'blog.php',    'label' => 'Blog'],
            ['href' => 'contact.php', 'label' => 'Contact'],
          ];
          ?>
          <nav class="main-menu">
            <ul class="flex items-center">
              <?php foreach ($navLinks as $lnk): ?>
              <li>
                <a class="<?= isActive($lnk['href'], $currentPage) ?>"
                  href="<?= $lnk['href'] ?>"><?= $lnk['label'] ?></a>
              </li>
              <?php endforeach; ?>
            </ul>
          </nav>

          <!-- Account -->
          <a href="account.php" aria-label="My Account"
            class="size-10 rounded-full bg-amber-100 hover:bg-amber-200 transition-colors flex items-center justify-center flex-shrink-0">
            <i class="hgi hgi-stroke hgi-user text-amber-800" style="font-size:20px;"></i>
          </a>

          <!-- Wishlist -->
          <a href="wishlist.php" aria-label="Wishlist"
            class="relative size-10 rounded-full bg-amber-100 hover:bg-amber-200 transition-colors flex items-center justify-center flex-shrink-0">
            <i class="hgi hgi-stroke hgi-favourite text-amber-800" style="font-size:20px;"></i>
            <span class="wishlist-count absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center" style="width:18px;height:18px;font-size:10px;line-height:1;">0</span>
          </a>

          <!-- Cart -->
          <button class="relative cart-sidebar-btn size-10 rounded-full bg-amber-100 hover:bg-amber-200 transition-colors flex items-center justify-center flex-shrink-0" aria-label="Cart">
            <i class="hgi hgi-stroke hgi-shopping-cart-02 text-amber-800" style="font-size:20px;"></i>
            <span class="cart-count absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center" style="width:18px;height:18px;font-size:10px;line-height:1;">0</span>
          </button>

        </div>
      </div>
    </div>
  </div>
  <!-- ── DESKTOP HEADER END ── -->

</header>
<!-- ========== HEADER Section End ========== -->
