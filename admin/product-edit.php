<?php
session_start();
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$db = getDB();
$id = (int)($_GET['id'] ?? 0);

if (!$id) {
    header('Location: products.php');
    exit;
}

$product = $db->prepare("SELECT * FROM products WHERE id = ?");
$product->execute([$id]);
$product = $product->fetch();

if (!$product) {
    header('Location: products.php');
    exit;
}

// Get related data
$productImages = $db->prepare("SELECT * FROM product_images WHERE product_id = ? ORDER BY sort_order");
$productImages->execute([$id]);
$productImages = $productImages->fetchAll();

$productSizes = $db->prepare("SELECT * FROM product_sizes WHERE product_id = ?");
$productSizes->execute([$id]);
$productSizes = $productSizes->fetchAll();

$productColors = $db->prepare("SELECT * FROM product_colors WHERE product_id = ?");
$productColors->execute([$id]);
$productColors = $productColors->fetchAll();

$productInfo = $db->prepare("SELECT * FROM product_additional_info WHERE product_id = ?");
$productInfo->execute([$id]);
$productInfo = $productInfo->fetchAll();

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = sanitize($_POST['name'] ?? '');
        if (empty($name)) $errors[] = 'Product name is required.';

        $category = sanitize($_POST['category'] ?? 'Lippan Art');
        $currentPrice = sanitize($_POST['current_price'] ?? '');
        $oldPrice = sanitize($_POST['old_price'] ?? '');
        $discountPct = sanitize($_POST['discount_percentage'] ?? '');
        $discountBadge = sanitize($_POST['discount_badge'] ?? '');
        $rating = (float)($_POST['rating'] ?? 0);
        $reviews = (int)($_POST['reviews'] ?? 0);
        $sold = (int)($_POST['sold'] ?? 0);
        $available = (int)($_POST['available'] ?? 0);
        $description = $_POST['description'] ?? '';
        $materials = sanitize($_POST['materials'] ?? '');
        $dimensions = sanitize($_POST['dimensions'] ?? '');
        $weight = sanitize($_POST['weight'] ?? '');
        $careInstructions = $_POST['care_instructions'] ?? '';
        $sku = sanitize($_POST['sku'] ?? '');

        $image = $product['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = uploadImage($_FILES['image'], __DIR__ . '/../uploads/products', 'prod_');
            $image = 'uploads/products/' . basename($imagePath);
        }

        if (empty($errors)) {
            $db->beginTransaction();

            $stmt = $db->prepare("
                UPDATE products SET name=?, category=?, image=?, current_price=?, old_price=?, discount_percentage=?, discount_badge=?, rating=?, reviews=?, sold=?, available=?, description=?, materials=?, dimensions=?, weight=?, care_instructions=?, sku=?
                WHERE id=?
            ");
            $stmt->execute([$name, $category, $image, $currentPrice, $oldPrice, $discountPct, $discountBadge, $rating, $reviews, $sold, $available, $description, $materials, $dimensions, $weight, $careInstructions, $sku, $id]);

            // Gallery images
            if (isset($_FILES['gallery']) && is_array($_FILES['gallery']['name'])) {
                $imgStmt = $db->prepare("INSERT INTO product_images (product_id, image_path, sort_order) VALUES (?, ?, ?)");
                $maxOrder = $db->prepare("SELECT MAX(sort_order) FROM product_images WHERE product_id = ?");
                $maxOrder->execute([$id]);
                $order = ($maxOrder->fetchColumn() ?? 0) + 1;
                foreach ($_FILES['gallery']['name'] as $i => $name) {
                    if ($_FILES['gallery']['error'][$i] === UPLOAD_ERR_OK) {
                        $file = [
                            'name' => $_FILES['gallery']['name'][$i],
                            'type' => $_FILES['gallery']['type'][$i],
                            'tmp_name' => $_FILES['gallery']['tmp_name'][$i],
                            'error' => $_FILES['gallery']['error'][$i],
                            'size' => $_FILES['gallery']['size'][$i],
                        ];
                        $path = uploadImage($file, __DIR__ . '/../uploads/products', 'gal_' . $id . '_');
                        $imgStmt->execute([$id, 'uploads/products/' . basename($path), $order++]);
                    }
                }
            }

            // Delete removed gallery images
            if (isset($_POST['delete_images']) && is_array($_POST['delete_images'])) {
                $delStmt = $db->prepare("DELETE FROM product_images WHERE id = ? AND product_id = ?");
                foreach ($_POST['delete_images'] as $imgId) {
                    $delStmt->execute([(int)$imgId, $id]);
                }
            }

            // Replace sizes
            $db->exec("DELETE FROM product_sizes WHERE product_id = $id");
            if (isset($_POST['sizes']) && is_array($_POST['sizes'])) {
                $sizeStmt = $db->prepare("INSERT INTO product_sizes (product_id, size_label, dimension, price_multiplier) VALUES (?, ?, ?, ?)");
                foreach ($_POST['sizes'] as $size) {
                    if (!empty($size['label'])) {
                        $sizeStmt->execute([$id, sanitize($size['label']), sanitize($size['dimension'] ?? ''), (float)($size['multiplier'] ?? 1.0)]);
                    }
                }
            }

            // Replace colors
            $db->exec("DELETE FROM product_colors WHERE product_id = $id");
            if (isset($_POST['colors']) && is_array($_POST['colors'])) {
                $colorStmt = $db->prepare("INSERT INTO product_colors (product_id, color_name, color_hex, color_image) VALUES (?, ?, ?, ?)");
                foreach ($_POST['colors'] as $color) {
                    if (!empty($color['name'])) {
                        $colorStmt->execute([$id, sanitize($color['name']), sanitize($color['hex'] ?? '#000000'), '']);
                    }
                }
            }

            // Replace additional info
            $db->exec("DELETE FROM product_additional_info WHERE product_id = $id");
            if (isset($_POST['additional_info']) && is_array($_POST['additional_info'])) {
                $infoStmt = $db->prepare("INSERT INTO product_additional_info (product_id, info_key, info_value) VALUES (?, ?, ?)");
                foreach ($_POST['additional_info'] as $info) {
                    if (!empty($info['key'])) {
                        $infoStmt->execute([$id, sanitize($info['key']), sanitize($info['value'] ?? '')]);
                    }
                }
            }

            $db->commit();

            require_once __DIR__ . '/includes/sync.php';
            syncProducts();

            $_SESSION['flash'] = 'Product updated successfully!';
            header("Location: products.php");
            exit;
        }
    } catch (Exception $e) {
        $db->rollBack();
        $errors[] = 'Error: ' . $e->getMessage();
    }
}

$flash = $_SESSION['flash'] ?? '';
unset($_SESSION['flash']);
require_once __DIR__ . '/partials/header.php';
?>
<div class="page-header">
    <div>
        <h2>Edit Product</h2>
        <p>#<?= $id ?> — <?= htmlspecialchars($product['name']) ?></p>
    </div>
    <a href="products.php" class="btn-secondary">← Back to Products</a>
</div>

<?php if ($flash): ?>
    <div class="flash-message flash-success"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>
<?php if (!empty($errors)): ?>
    <div class="flash-message flash-error">
        <?php foreach ($errors as $err): ?>
            <div><?= htmlspecialchars($err) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="admin-form">
    <div class="form-grid">
        <div class="form-section">
            <h3>Basic Information</h3>
            <div class="form-group">
                <label>Product Name <span class="required">*</span></label>
                <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? $product['name']) ?>" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category">
                        <?php foreach (getProductCategories() as $cat): ?>
                            <option value="<?= $cat ?>" <?= ($_POST['category'] ?? $product['category']) === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>SKU</label>
                    <input type="text" name="sku" value="<?= htmlspecialchars($_POST['sku'] ?? $product['sku']) ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Current Price</label>
                    <input type="text" name="current_price" value="<?= htmlspecialchars($_POST['current_price'] ?? $product['current_price']) ?>">
                </div>
                <div class="form-group">
                    <label>Old Price</label>
                    <input type="text" name="old_price" value="<?= htmlspecialchars($_POST['old_price'] ?? $product['old_price']) ?>">
                </div>
                <div class="form-group">
                    <label>Discount %</label>
                    <input type="text" name="discount_percentage" value="<?= htmlspecialchars($_POST['discount_percentage'] ?? $product['discount_percentage']) ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Discount Badge</label>
                <select name="discount_badge">
                    <?php foreach (getDiscountBadges() as $badge): ?>
                        <option value="<?= $badge ?>" <?= ($_POST['discount_badge'] ?? $product['discount_badge']) === $badge ? 'selected' : '' ?>><?= $badge ?: 'None' ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group"><label>Rating</label><input type="number" name="rating" step="0.1" min="0" max="5" value="<?= htmlspecialchars($_POST['rating'] ?? $product['rating']) ?>"></div>
                <div class="form-group"><label>Reviews</label><input type="number" name="reviews" min="0" value="<?= htmlspecialchars($_POST['reviews'] ?? $product['reviews']) ?>"></div>
                <div class="form-group"><label>Sold</label><input type="number" name="sold" min="0" value="<?= htmlspecialchars($_POST['sold'] ?? $product['sold']) ?>"></div>
                <div class="form-group"><label>Stock</label><input type="number" name="available" min="-1" value="<?= htmlspecialchars($_POST['available'] ?? $product['available']) ?>"></div>
            </div>
        </div>

        <div class="form-section">
            <h3>Media</h3>
            <div class="form-group">
                <label>Current Main Image</label>
                <?php if ($product['image']): ?>
                    <div class="current-image">
                        <img src="../<?= htmlspecialchars($product['image']) ?>" alt="" onerror="this.style.display='none'">
                    </div>
                <?php endif; ?>
                <div class="file-upload">
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" id="mainImage" onchange="previewMainImage(this)">
                    <div class="upload-placeholder" id="mainImagePreview">
                        <span>Click to replace image</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Gallery Images</label>
                <?php if (!empty($productImages)): ?>
                    <div class="gallery-preview existing-gallery">
                        <?php foreach ($productImages as $img): ?>
                            <div class="gallery-item">
                                <img src="../<?= htmlspecialchars($img['image_path']) ?>" alt="" onerror="this.style.display='none'">
                                <label class="gallery-delete">
                                    <input type="checkbox" name="delete_images[]" value="<?= $img['id'] ?>"> Remove
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="file-upload">
                    <input type="file" name="gallery[]" accept="image/jpeg,image/png,image/webp" multiple id="galleryImages" onchange="previewGallery(this)">
                    <div class="upload-placeholder"><span>Click to add more images</span></div>
                </div>
                <div id="galleryPreview" class="gallery-preview"></div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <h3>Description & Details</h3>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="5" class="rich-textarea"><?= htmlspecialchars($_POST['description'] ?? $product['description']) ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group"><label>Materials</label><input type="text" name="materials" value="<?= htmlspecialchars($_POST['materials'] ?? $product['materials']) ?>"></div>
            <div class="form-group"><label>Dimensions</label><input type="text" name="dimensions" value="<?= htmlspecialchars($_POST['dimensions'] ?? $product['dimensions']) ?>"></div>
            <div class="form-group"><label>Weight</label><input type="text" name="weight" value="<?= htmlspecialchars($_POST['weight'] ?? $product['weight']) ?>"></div>
        </div>
        <div class="form-group">
            <label>Care Instructions</label>
            <textarea name="care_instructions" rows="3"><?= htmlspecialchars($_POST['care_instructions'] ?? $product['care_instructions']) ?></textarea>
        </div>
    </div>

    <div class="form-section">
        <h3>Size Options</h3>
        <div id="sizesContainer">
            <?php if (!empty($productSizes)): ?>
                <?php $si = 0; foreach ($productSizes as $size): ?>
                <div class="dynamic-row size-row">
                    <input type="text" name="sizes[<?= $si ?>][label]" value="<?= htmlspecialchars($size['size_label']) ?>">
                    <input type="text" name="sizes[<?= $si ?>][dimension]" value="<?= htmlspecialchars($size['dimension']) ?>">
                    <input type="number" name="sizes[<?= $si ?>][multiplier]" step="0.1" min="0" value="<?= htmlspecialchars($size['price_multiplier']) ?>">
                    <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()">✕</button>
                </div>
                <?php $si++; endforeach; ?>
            <?php else: ?>
            <div class="dynamic-row size-row">
                <input type="text" name="sizes[0][label]" placeholder="Label (e.g. Small)">
                <input type="text" name="sizes[0][dimension]" placeholder='Dimension (e.g. 6" - 8")'>
                <input type="number" name="sizes[0][multiplier]" step="0.1" min="0" placeholder="Price Multiplier" value="1.0">
                <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()" style="display:none">✕</button>
            </div>
            <?php endif; ?>
        </div>
        <button type="button" class="btn-add-row" onclick="addSizeRow()">+ Add Size</button>
    </div>

    <div class="form-section">
        <h3>Color Options</h3>
        <div id="colorsContainer">
            <?php if (!empty($productColors)): ?>
                <?php $ci = 0; foreach ($productColors as $color): ?>
                <div class="dynamic-row color-row">
                    <input type="text" name="colors[<?= $ci ?>][name]" value="<?= htmlspecialchars($color['color_name']) ?>">
                    <input type="color" name="colors[<?= $ci ?>][hex]" value="<?= htmlspecialchars($color['color_hex']) ?>">
                    <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()">✕</button>
                </div>
                <?php $ci++; endforeach; ?>
            <?php else: ?>
            <div class="dynamic-row color-row">
                <input type="text" name="colors[0][name]" placeholder="Color name">
                <input type="color" name="colors[0][hex]" value="#F5F0E8">
                <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()" style="display:none">✕</button>
            </div>
            <?php endif; ?>
        </div>
        <button type="button" class="btn-add-row" onclick="addColorRow()">+ Add Color</button>
    </div>

    <div class="form-section">
        <h3>Additional Information</h3>
        <div id="infoContainer">
            <?php if (!empty($productInfo)): ?>
                <?php $ii = 0; foreach ($productInfo as $info): ?>
                <div class="dynamic-row info-row">
                    <input type="text" name="additional_info[<?= $ii ?>][key]" value="<?= htmlspecialchars($info['info_key']) ?>">
                    <input type="text" name="additional_info[<?= $ii ?>][value]" value="<?= htmlspecialchars($info['info_value']) ?>">
                    <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()">✕</button>
                </div>
                <?php $ii++; endforeach; ?>
            <?php else: ?>
            <div class="dynamic-row info-row">
                <input type="text" name="additional_info[0][key]" placeholder="Key (e.g. Handcrafted)">
                <input type="text" name="additional_info[0][value]" placeholder="Value (e.g. Yes)">
                <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()" style="display:none">✕</button>
            </div>
            <?php endif; ?>
        </div>
        <button type="button" class="btn-add-row" onclick="addInfoRow()">+ Add Info</button>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Update Product</button>
        <a href="products.php" class="btn-secondary">Cancel</a>
    </div>
</form>

<script>
let sizeIndex = <?= count($productSizes) ?>, colorIndex = <?= count($productColors) ?>, infoIndex = <?= count($productInfo) ?>;

function addSizeRow() {
    const container = document.getElementById('sizesContainer');
    const row = document.createElement('div');
    row.className = 'dynamic-row size-row';
    row.innerHTML = `<input type="text" name="sizes[${sizeIndex}][label]" placeholder="Label"><input type="text" name="sizes[${sizeIndex}][dimension]" placeholder='Dimension'><input type="number" name="sizes[${sizeIndex}][multiplier]" step="0.1" min="0" placeholder="Multiplier" value="1.0"><button type="button" class="btn-remove-row" onclick="this.parentElement.remove()">✕</button>`;
    container.appendChild(row); sizeIndex++;
}

function addColorRow() {
    const container = document.getElementById('colorsContainer');
    const row = document.createElement('div');
    row.className = 'dynamic-row color-row';
    row.innerHTML = `<input type="text" name="colors[${colorIndex}][name]" placeholder="Color name"><input type="color" name="colors[${colorIndex}][hex]" value="#F5F0E8"><button type="button" class="btn-remove-row" onclick="this.parentElement.remove()">✕</button>`;
    container.appendChild(row); colorIndex++;
}

function addInfoRow() {
    const container = document.getElementById('infoContainer');
    const row = document.createElement('div');
    row.className = 'dynamic-row info-row';
    row.innerHTML = `<input type="text" name="additional_info[${infoIndex}][key]" placeholder="Key"><input type="text" name="additional_info[${infoIndex}][value]" placeholder="Value"><button type="button" class="btn-remove-row" onclick="this.parentElement.remove()">✕</button>`;
    container.appendChild(row); infoIndex++;
}

function previewMainImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('mainImagePreview').innerHTML = `<img src="${e.target.result}" class="preview-img">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewGallery(input) {
    const container = document.getElementById('galleryPreview');
    container.innerHTML = '';
    if (input.files) {
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'gallery-thumb';
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }
}
</script>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
