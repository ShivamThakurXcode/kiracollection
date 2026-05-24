<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop - KiraCollection Art</title>
  <?php
  include 'components/links.php';
  include 'components/ProductCard.php';
  require_once 'admin/includes/db.php';
  include_once 'data/products.php';

  // Simple function to render product card
  function renderProductCard($product)
  {
    $card = new ProductCard($product, 'bordered');
    echo $card->render();
  }

  // Function to build query string
  function buildQueryString($params)
  {
    $current_params = $_GET;

    // Update parameters
    foreach ($params as $key => $value) {
      if ($value === '' || $value === null) {
        unset($current_params[$key]);
      } else {
        $current_params[$key] = $value;
      }
    }

    // Remove page parameter if not specifically set
    if (!isset($params['page'])) {
      unset($current_params['page']);
    }

    return http_build_query($current_params);
  }

  // Helper to parse price string to int
  function parsePrice($priceStr)
  {
    return (int) str_replace(['₹', ',', ' '], '', $priceStr);
  }

  // -- Shop defaults --
  $current_category = isset($_GET['category']) ? $_GET['category'] : '';
  $min_price = isset($_GET['min_price']) ? (int) $_GET['min_price'] : 0;
  $max_price = isset($_GET['max_price']) ? (int) $_GET['max_price'] : 10000;
  $search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
  $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
  $products_per_page = 12;
  $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
  $use_db = false;

  try {
    $db = getDB();
    $use_db = true;
  } catch (Exception $e) {
    $use_db = false;
  }

  if ($use_db) {
    // ----- DB mode -----
    $categories = [];
    $catStmt = $db->query("SELECT DISTINCT category FROM products WHERE category != '' ORDER BY category");
    while ($row = $catStmt->fetch()) {
      $categories[] = $row['category'];
    }

    $conditions = [];
    $query_params = [];

    if ($current_category) {
      $conditions[] = "LOWER(category) = LOWER(?)";
      $query_params[] = $current_category;
    }

    if ($search) {
      $conditions[] = "(LOWER(name) LIKE ? OR LOWER(category) LIKE ?)";
      $query_params[] = "%$search%";
      $query_params[] = "%$search%";
    }

    $whereClause = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';

    // Fetch all matching products
    $allSql = "SELECT * FROM products $whereClause ORDER BY id DESC";
    $allStmt = $db->prepare($allSql);
    $allStmt->execute($query_params);
    $filtered = $allStmt->fetchAll();

    // All products for category counts
    $allProductsStmt = $db->query("SELECT * FROM products ORDER BY id DESC");
    $all_products = $allProductsStmt->fetchAll();

    // Apply price filter in PHP
    if ($min_price > 0 || $max_price < 10000) {
      $filtered = array_filter($filtered, function ($p) use ($min_price, $max_price) {
        $price = parsePrice($p['current_price']);
        return (!$min_price || $price >= $min_price) && (!$max_price || $price <= $max_price);
      });
    }

    // Apply sorting in PHP (prices are stored as strings)
    if ($sort === 'newest') {
      usort($filtered, function ($a, $b) {
        return $b['id'] <=> $a['id'];
      });
    } elseif ($sort === 'price-low') {
      usort($filtered, function ($a, $b) {
        return parsePrice($a['current_price']) - parsePrice($b['current_price']);
      });
    } elseif ($sort === 'price-high') {
      usort($filtered, function ($a, $b) {
        return parsePrice($b['current_price']) - parsePrice($a['current_price']);
      });
    } elseif ($sort === 'name') {
      usort($filtered, function ($a, $b) {
        return strcmp($a['name'], $b['name']);
      });
    }

    $total_products = count($filtered);
    $total_pages = max(1, ceil($total_products / $products_per_page));
    $offset = ($current_page - 1) * $products_per_page;
    $paginated_products = array_slice($filtered, $offset, $products_per_page);
  }

  if (!$use_db) {
    // ----- Flat-file fallback (includes ALL product arrays) -----
    $all_products = array_merge(
      $homeFourPicksProducts ?? [],
      $topRateProducts ?? [],
      $topItemsProducts ?? [],
      $categoryPromoProducts ?? [],
      $mostLovedProducts ?? [],
      $productsSectionProducts ?? [],
      $limitedTimeProducts ?? [],
      $favouriteCategoryProducts ?? [],
      $newArrivalsProducts ?? []
    );

    $seen_ids = [];
    $unique = [];
    foreach ($all_products as $p) {
      if (!in_array($p['id'], $seen_ids)) {
        $unique[] = $p;
        $seen_ids[] = $p['id'];
      }
    }
    $all_products = $unique;

    $categories = [];
    foreach ($all_products as $p) {
      if (!in_array($p['category'], $categories))
        $categories[] = $p['category'];
    }

    $filtered = $all_products;

    if ($current_category) {
      $filtered = array_filter($filtered, function ($p) use ($current_category) {
        return strtolower($p['category']) === strtolower($current_category);
      });
    }
    if ($search) {
      $filtered = array_filter($filtered, function ($p) use ($search) {
        return strpos(strtolower($p['name']), $search) !== false || strpos(strtolower($p['category']), $search) !== false;
      });
    }
    if ($min_price > 0 || $max_price < 10000) {
      $filtered = array_filter($filtered, function ($p) use ($min_price, $max_price) {
        $price = parsePrice($p['current_price']);
        return (!$min_price || $price >= $min_price) && (!$max_price || $price <= $max_price);
      });
    }
    if ($sort === 'newest') {
      usort($filtered, function ($a, $b) {
        return $b['id'] <=> $a['id'];
      });
    } elseif ($sort === 'price-low') {
      usort($filtered, function ($a, $b) {
        return parsePrice($a['current_price']) - parsePrice($b['current_price']);
      });
    } elseif ($sort === 'price-high') {
      usort($filtered, function ($a, $b) {
        return parsePrice($b['current_price']) - parsePrice($a['current_price']);
      });
    } elseif ($sort === 'name') {
      usort($filtered, function ($a, $b) {
        return strcmp($a['name'], $b['name']);
      });
    }

    $total_products = count($filtered);
    $total_pages = max(1, ceil($total_products / $products_per_page));
    $offset = ($current_page - 1) * $products_per_page;
    $paginated_products = array_slice($filtered, $offset, $products_per_page);
  }
  ?>
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

  <!-- Breadcrumb Section -->
  <?php include 'components/breadcrumb.php' ?>

  <!-- Shop Section -->
  <section class="pb-[70px] pt-8">
    <div class="container">
      <div class="grid grid-cols-12 gap-6">
        <!-- Products Grid -->
        <div class="col-span-12">
          <!-- Header + Sort Bar -->
          <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4 wow animate__animated animate__fadeInUp"
            data-wow-delay="0.2s">
            <div>
              <h1 class="text-2xl md:text-3xl font-bold text-light-primary-text mb-2">
                <?= $current_category ? htmlspecialchars($current_category) : 'All Products' ?>
              </h1>
              <p class="text-light-secondary-text">
                Showing <?= count($paginated_products) ?> of <?= $total_products ?> products
              </p>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
              <span class="text-sm text-gray-500">Sort by:</span>
              <div class="flex flex-wrap gap-2">
                <?php
                $sortOptions = [
                  'newest' => 'Newest',
                  'price-low' => 'Price ↑',
                  'price-high' => 'Price ↓',
                  'name' => 'Name A-Z',
                ];
                foreach ($sortOptions as $key => $label):
                ?>
                <a href="?<?= buildQueryString(['sort' => $key]) ?>"
                  class="px-3 py-1.5 rounded-full text-xs font-medium border transition-colors <?= $sort === $key ? 'bg-amber-500 text-white border-amber-500' : 'border-gray-300 text-gray-600 hover:border-amber-400 hover:text-amber-600' ?>">
                  <?= $label ?>
                </a>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <!-- Products -->
          <?php if (empty($paginated_products)): ?>
            <div class="text-center py-12 wow animate__animated animate__fadeInUp" data-wow-delay="0.3s">
              <i class="hgi hgi-stroke hgi-search-01 text-6xl text-light-secondary-text mb-4"></i>
              <h3 class="text-xl font-semibold text-light-primary-text mb-2">No products found</h3>
              <p class="text-light-secondary-text mb-6">Try adjusting your filters or search terms</p>
              <button onclick="clearFilters()" class="btn btn-primary rounded-[60px] py-2 px-6">Clear All Filters</button>
            </div>
          <?php else: ?>
            <div class="grid grid-cols-12 gap-6" id="products-container">
              <?php foreach ($paginated_products as $index => $product): ?>
                <div class="md:col-span-6 col-span-12 xl:col-span-3 wow animate__animated animate__fadeInUp"
                  data-wow-delay="<?= (0.1 + ($index * 0.05)) ?>s">
                  <?php renderProductCard($product); ?>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- Pagination -->
          <?php if ($total_pages > 1): ?>
            <div class="mt-12 wow animate__animated animate__fadeInUp" data-wow-delay="0.4s">
              <div class="flex items-center justify-center gap-2">
                <?php if ($current_page > 1): ?>
                  <a href="?<?= buildQueryString(['page' => $current_page - 1]) ?>"
                    class="w-10 h-10 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors">
                    <i class="hgi hgi-stroke hgi-chevron-left"></i>
                  </a>
                <?php endif; ?>

                <?php
                $start_page = max(1, $current_page - 2);
                $end_page = min($total_pages, $current_page + 2);

                if ($start_page > 1) {
                  echo '<a href="?' . buildQueryString(['page' => 1]) . '" class="w-10 h-10 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors">1</a>';
                  if ($start_page > 2) {
                    echo '<span class="px-2 text-light-secondary-text">...</span>';
                  }
                }

                for ($i = $start_page; $i <= $end_page; $i++): ?>
                  <a href="?<?= buildQueryString(['page' => $i]) ?>" class="w-10 h-10 rounded-full flex items-center justify-center transition-colors <?=
                        $i === $current_page
                        ? 'bg-primary text-white'
                        : 'bg-white border border-gray-300 hover:border-primary hover:bg-primary/10 text-light-primary-text'
                        ?>">
                    <?= $i ?>
                  </a>
                <?php endfor; ?>

                <?php if ($end_page < $total_pages): ?>
                  <?php if ($end_page < $total_pages - 1): ?>
                    <span class="px-2 text-light-secondary-text">...</span>
                  <?php endif; ?>
                  <a href="?<?= buildQueryString(['page' => $total_pages]) ?>"
                    class="w-10 h-10 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors">
                    <?= $total_pages ?>
                  </a>
                <?php endif; ?>

                <?php if ($current_page < $total_pages): ?>
                  <a href="?<?= buildQueryString(['page' => $current_page + 1]) ?>"
                    class="w-10 h-10 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:border-primary hover:bg-primary/10 transition-colors">
                    <i class="hgi hgi-stroke hgi-chevron-right"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <?php include 'components/subscribe-section.php' ?>

  <?php include 'components/footer.php' ?>
  <?php include 'components/scripts.php' ?>

  <script>
    function buildQueryString(params) {
      const urlParams = new URLSearchParams(window.location.search);

      // Update parameters
      Object.keys(params).forEach(key => {
        if (params[key] === '' || params[key] === null) {
          urlParams.delete(key);
        } else {
          urlParams.set(key, params[key]);
        }
      });

      // Remove page parameter if not specifically set
      if (!params.hasOwnProperty('page')) {
        urlParams.delete('page');
      }

      return urlParams.toString();
    }

    function updateFilters() {
      const minPrice = document.getElementById('min-price').value;
      const maxPrice = document.getElementById('max-price').value;
      const category = document.querySelector('input[name="category"]:checked')?.value || '';
      const rating = document.querySelector('input[name="rating"]:checked')?.value || '';
      const materials = Array.from(document.querySelectorAll('input[name="material[]"]:checked')).map(el => el.value);

      const urlParams = new URLSearchParams();
      if (minPrice) urlParams.set('min_price', minPrice);
      if (maxPrice) urlParams.set('max_price', maxPrice);
      if (category) urlParams.set('category', category);
      if (rating) urlParams.set('rating', rating);
      materials.forEach(m => urlParams.append('materials[]', m));

      window.location.href = 'shop.php?' + urlParams.toString();
    }

    function setPriceRange(min, max) {
      document.getElementById('min-price').value = min;
      document.getElementById('max-price').value = max;
      updateFilters();
    }

    function clearFilters() {
      window.location.href = 'shop.php';
    }
  </script>

</body>

</html>