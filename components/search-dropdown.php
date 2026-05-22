<!-- Search Suggestions Dropdown -->
<div data-state="close"
  class="search-result-container absolute w-full top-[calc(100%+8px)] left-0 border border-amber-100 shadow-2xl bg-white rounded-2xl z-50 p-4
         transform data-[state=close]:translate-y-2 data-[state=close]:opacity-0 data-[state=close]:invisible
         transition-all duration-250 ease-[cubic-bezier(0.645,0.045,0.355,1)]
         data-[state=open]:translate-y-0 data-[state=open]:opacity-100 data-[state=open]:visible"
  style="min-width:300px;">

  <!-- Live search results -->
  <div class="search-results hidden">
    <p class="text-sm font-semibold text-stone-800 mb-3">Search Results</p>
    <div class="search-results-list flex flex-col gap-y-2"></div>
  </div>

  <!-- No results -->
  <div class="search-empty hidden text-sm text-stone-400 py-2 text-center">
    No products found.
  </div>

  <!-- Default suggestions -->
  <div class="search-suggestions">
    <!-- Recent searches -->
    <div class="recent-search-wrapper mb-4">
      <div class="flex justify-between items-center mb-2">
        <p class="text-xs font-bold text-stone-500 uppercase tracking-wide">Recent</p>
        <button class="text-xs text-amber-600 font-semibold hover:text-amber-700 transition-colors">Clear</button>
      </div>
      <div class="flex flex-wrap gap-1.5 recent-search-list">
        <?php
        $recentSearches = ['Lippan Art Mirror', 'Mandala Clock', 'Wall Panel'];
        foreach ($recentSearches as $term):
        ?>
        <button class="recent-search-item inline-flex items-center gap-1.5 text-xs font-medium bg-amber-50 hover:bg-amber-100 text-amber-800 px-3 py-1.5 rounded-full transition-colors border border-amber-200/60">
          <?= htmlspecialchars($term) ?>
          <i class="hgi hgi-stroke hgi-cancel-01" style="font-size:10px;"></i>
        </button>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Recommended products -->
    <div>
      <p class="text-xs font-bold text-stone-500 uppercase tracking-wide mb-3">Recommended</p>
      <div class="recommended-search-list flex flex-col divide-y divide-stone-100">
        <?php
        $suggestions = [
          ['img' => 'images/product/p-1.jpeg', 'label' => 'Lippan Art Mirror Frames',  'href' => 'shop.php?category=Lippan+Art'],
          ['img' => 'images/product/p-2.png',  'label' => 'Sacred Mandala Wall Art',   'href' => 'shop.php?category=Mandala+Art'],
          ['img' => 'images/product/p-5.png',  'label' => 'Handcrafted Home Decor',    'href' => 'shop.php?category=Home+Decor'],
          ['img' => 'images/product/p-7.png',  'label' => 'Handcrafted Gift Sets',     'href' => 'shop.php?category=Handcrafted+Gifts'],
        ];
        foreach ($suggestions as $s):
        ?>
        <a href="<?= $s['href'] ?>" class="flex items-center gap-x-3 py-2 first:pt-0 last:pb-0 group">
          <div class="size-10 rounded-xl bg-amber-50 overflow-hidden flex-shrink-0 border border-amber-100/60">
            <img src="<?= $s['img'] ?>" alt="<?= htmlspecialchars($s['label']) ?>"
              class="w-full h-full object-cover" onerror="this.style.display='none'" />
          </div>
          <span class="text-sm font-semibold text-stone-700 group-hover:text-amber-700 transition-colors">
            <?= htmlspecialchars($s['label']) ?>
          </span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
