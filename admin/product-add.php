<?php
session_start();
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$db = getDB();
$errors = [];
$success = false;
$old = $_POST;
$maxGalleryImages = 4;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate
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

        // Handle main image upload
        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = uploadImage($_FILES['image'], __DIR__ . '/../uploads/products', 'prod_');
            // Store relative path
            $image = 'uploads/products/' . basename($image);
        }

        if (empty($errors)) {
            $db->beginTransaction();

            // Get next ID
            $maxId = $db->query("SELECT MAX(id) FROM products")->fetchColumn();
            $newId = ($maxId ? $maxId + 1 : 52);

            if (!$sku) {
                $sku = 'SKU-' . str_pad($newId, 3, '0', STR_PAD_LEFT);
            }

            $stmt = $db->prepare("
                INSERT INTO products (id, name, category, image, current_price, old_price, discount_percentage, discount_badge, rating, reviews, sold, available, description, materials, dimensions, weight, care_instructions, sku)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$newId, $name, $category, $image, $currentPrice, $oldPrice, $discountPct, $discountBadge, $rating, $reviews, $sold, $available, $description, $materials, $dimensions, $weight, $careInstructions, $sku]);

            // Handle gallery images
            if (isset($_FILES['gallery']) && is_array($_FILES['gallery']['name'])) {
                $selectedGalleryCount = 0;
                $imgStmt = $db->prepare("INSERT INTO product_images (product_id, image_path, sort_order) VALUES (?, ?, ?)");
                $order = 0;
                foreach ($_FILES['gallery']['name'] as $i => $name) {
                    if ($_FILES['gallery']['error'][$i] === UPLOAD_ERR_OK) {
                        if ($selectedGalleryCount >= $maxGalleryImages) {
                            break;
                        }
                        $file = [
                            'name' => $_FILES['gallery']['name'][$i],
                            'type' => $_FILES['gallery']['type'][$i],
                            'tmp_name' => $_FILES['gallery']['tmp_name'][$i],
                            'error' => $_FILES['gallery']['error'][$i],
                            'size' => $_FILES['gallery']['size'][$i],
                        ];
                        $path = uploadImage($file, __DIR__ . '/../uploads/products', 'gal_' . $newId . '_');
                        $imgStmt->execute([$newId, 'uploads/products/' . basename($path), $order++]);
                        $selectedGalleryCount++;
                    }
                }
            }

            // Handle sizes
            if (isset($_POST['sizes']) && is_array($_POST['sizes'])) {
                $sizeStmt = $db->prepare("INSERT INTO product_sizes (product_id, size_label, dimension, price_multiplier) VALUES (?, ?, ?, ?)");
                foreach ($_POST['sizes'] as $size) {
                    if (!empty($size['label'])) {
                        $sizeStmt->execute([$newId, sanitize($size['label']), sanitize($size['dimension'] ?? ''), (float)($size['multiplier'] ?? 1.0)]);
                    }
                }
            }

            // Handle colors
            if (isset($_POST['colors']) && is_array($_POST['colors'])) {
                $colorStmt = $db->prepare("INSERT INTO product_colors (product_id, color_name, color_hex, color_image) VALUES (?, ?, ?, ?)");
                foreach ($_POST['colors'] as $color) {
                    if (!empty($color['name'])) {
                        $colorStmt->execute([$newId, sanitize($color['name']), sanitize($color['hex'] ?? '#000000'), '']);
                    }
                }
            }

            // Handle additional info
            if (isset($_POST['additional_info']) && is_array($_POST['additional_info'])) {
                $infoStmt = $db->prepare("INSERT INTO product_additional_info (product_id, info_key, info_value) VALUES (?, ?, ?)");
                foreach ($_POST['additional_info'] as $info) {
                    if (!empty($info['key'])) {
                        $infoStmt->execute([$newId, sanitize($info['key']), sanitize($info['value'] ?? '')]);
                    }
                }
            }

            $db->commit();

            // Sync frontend files
            require_once __DIR__ . '/includes/sync.php';
            syncProducts();

            $success = true;
            $_SESSION['flash'] = 'Product created successfully!';
            header('Location: products.php');
            exit;
        }
    } catch (Exception $e) {
        $db->rollBack();
        $errors[] = 'Error: ' . $e->getMessage();
    }
}
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<style>
/* Multi-step form styles */
.step-indicator {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
    margin-bottom: 32px;
    padding: 20px 24px;
    background: #fff;
    border-radius: 16px;
    border: 1px solid #dfe3e8;
    box-shadow: 0 8px 16px rgba(145,158,171,0.08);
}
.step-item {
    display: flex;
    align-items: center;
    gap: 10px;
    position: relative;
}
.step-number {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    font-family: 'Urbanist', sans-serif;
    transition: all 0.3s ease;
    flex-shrink: 0;
    border: 2px solid #dfe3e8;
    color: #919eab;
    background: #fff;
}
.step-item.active .step-number {
    background: #556b2f;
    color: #fff;
    border-color: #556b2f;
    box-shadow: 0 4px 12px rgba(85,107,47,0.3);
}
.step-item.completed .step-number {
    background: #a8d5a8;
    color: #fff;
    border-color: #a8d5a8;
}
.step-label {
    font-size: 13px;
    font-weight: 600;
    color: #919eab;
    font-family: 'DM Sans', sans-serif;
    white-space: nowrap;
}
.step-item.active .step-label { color: #556b2f; }
.step-item.completed .step-label { color: #3d5a1f; }
.step-connector {
    width: 40px;
    height: 2px;
    background: #dfe3e8;
    margin: 0 12px;
    flex-shrink: 0;
    transition: background 0.3s ease;
}
.step-connector.completed { background: #a8d5a8; }

.step-panel { display: none; }
.step-panel.active { display: block; }

.step-actions {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid #dfe3e8;
}
.btn-prev, .btn-next {
    padding: 11px 28px;
    border-radius: 60px;
    font-size: 14px;
    font-weight: 600;
    font-family: 'DM Sans', sans-serif;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-prev {
    background: #dfe3e8;
    color: #495057;
}
.btn-prev:hover { background: #c4cdd5; color: #212529; }
.btn-next {
    background: #556b2f;
    color: #fff;
}
.btn-next:hover { background: #3d5a1f; transform: translateY(-1px); box-shadow: 0 6px 12px rgba(85,107,47,0.2); }
.btn-next:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none; }

@media (max-width: 768px) {
    .step-indicator { flex-wrap: wrap; gap: 8px; padding: 16px; }
    .step-connector { width: 20px; margin: 0 6px; }
    .step-label { font-size: 11px; }
}
</style>
<div class="page-header">
    <div>
        <h2>Add New Product</h2>
        <p>Create a new product for KiraCollection</p>
    </div>
    <a href="products.php" class="btn-secondary">← Back to Products</a>
</div>

<?php if (!empty($errors)): ?>
    <div class="flash-message flash-error">
        <?php foreach ($errors as $err): ?>
            <div><?= htmlspecialchars($err) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Step Indicator -->
<div class="step-indicator" id="stepIndicator">
    <div class="step-item active" data-step="1">
        <div class="step-number">1</div>
        <span class="step-label">Basic Info</span>
    </div>
    <div class="step-connector" data-connector="1"></div>
    <div class="step-item" data-step="2">
        <div class="step-number">2</div>
        <span class="step-label">Media</span>
    </div>
    <div class="step-connector" data-connector="2"></div>
    <div class="step-item" data-step="3">
        <div class="step-number">3</div>
        <span class="step-label">Description</span>
    </div>
    <div class="step-connector" data-connector="3"></div>
    <div class="step-item" data-step="4">
        <div class="step-number">4</div>
        <span class="step-label">Sizes & Colors</span>
    </div>
    <div class="step-connector" data-connector="4"></div>
    <div class="step-item" data-step="5">
        <div class="step-number">5</div>
        <span class="step-label">Additional</span>
    </div>
</div>

<form method="POST" enctype="multipart/form-data" class="admin-form" id="productForm">
    <!-- Step 1: Basic Information -->
    <div class="step-panel active" data-step="1">
        <div class="form-section">
            <h3>Basic Information</h3>
            <div class="form-group">
                <label>Product Name <span class="required">*</span></label>
                <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required placeholder="e.g. Traditional Lippan Art Mirror Frame">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category">
                        <?php foreach (getProductCategories() as $cat): ?>
                            <option value="<?= $cat ?>" <?= ($old['category'] ?? '') === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>SKU</label>
                    <input type="text" name="sku" value="<?= htmlspecialchars($old['sku'] ?? '') ?>" placeholder="Auto-generated if empty">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Current Price</label>
                    <input type="text" name="current_price" value="<?= htmlspecialchars($old['current_price'] ?? '') ?>" placeholder="₹2,499">
                </div>
                <div class="form-group">
                    <label>Old Price</label>
                    <input type="text" name="old_price" value="<?= htmlspecialchars($old['old_price'] ?? '') ?>" placeholder="₹3,199">
                </div>
                <div class="form-group">
                    <label>Discount %</label>
                    <input type="text" name="discount_percentage" value="<?= htmlspecialchars($old['discount_percentage'] ?? '') ?>" placeholder="22% OFF">
                </div>
            </div>
            <div class="form-group">
                <label>Discount Badge</label>
                <select name="discount_badge">
                    <?php foreach (getDiscountBadges() as $badge): ?>
                        <option value="<?= $badge ?>" <?= ($old['discount_badge'] ?? '') === $badge ? 'selected' : '' ?>><?= $badge ?: 'None' ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Rating (1-5)</label>
                    <input type="number" name="rating" step="0.1" min="0" max="5" value="<?= htmlspecialchars($old['rating'] ?? '0') ?>">
                </div>
                <div class="form-group">
                    <label>Reviews</label>
                    <input type="number" name="reviews" min="0" value="<?= htmlspecialchars($old['reviews'] ?? '0') ?>">
                </div>
                <div class="form-group">
                    <label>Sold</label>
                    <input type="number" name="sold" min="0" value="<?= htmlspecialchars($old['sold'] ?? '0') ?>">
                </div>
                <div class="form-group">
                    <label>Available (Stock)</label>
                    <input type="number" name="available" min="-1" value="<?= htmlspecialchars($old['available'] ?? '0') ?>">
                </div>
            </div>
        </div>
        <div class="step-actions">
            <div></div>
            <button type="button" class="btn-next" onclick="nextStep()">Next Step →</button>
        </div>
    </div>

    <!-- Step 2: Media -->
    <div class="step-panel" data-step="2">
        <div class="form-section">
            <h3>Media</h3>
            <div class="form-group">
                <label>Main Product Image</label>
                <div class="file-upload">
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" id="mainImage" onchange="previewMainImage(this)">
                    <div class="upload-placeholder" id="mainImagePreview">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#919eab" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <span>Click to upload main image</span>
                        <span class="file-hint">JPG, PNG, WebP • Max 5MB</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Gallery Images (4 images)</label>
                <div class="file-upload">
                    <input type="file" name="gallery[]" accept="image/jpeg,image/png,image/webp" multiple id="galleryImages" onchange="previewGallery(this)" data-max-files="4">
                    <div class="upload-placeholder">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#919eab" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <span>Click to upload gallery images</span>
                        <span class="file-hint">Select up to 4 images</span>
                    </div>
                </div>
                <div id="galleryPreview" class="gallery-preview"></div>
            </div>
        </div>
        <div class="step-actions">
            <button type="button" class="btn-prev" onclick="prevStep()">← Previous</button>
            <button type="button" class="btn-next" onclick="nextStep()">Next Step →</button>
        </div>
    </div>

    <!-- Step 3: Description & Details -->
    <div class="step-panel" data-step="3">
        <div class="form-section">
            <h3>Description & Details</h3>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="5" class="rich-textarea"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Materials</label>
                    <input type="text" name="materials" value="<?= htmlspecialchars($old['materials'] ?? '') ?>" placeholder="POP Clay, Mirror Work, Natural Colors">
                </div>
                <div class="form-group">
                    <label>Dimensions</label>
                    <input type="text" name="dimensions" value="<?= htmlspecialchars($old['dimensions'] ?? '') ?>" placeholder='12" x 12" x 1"'>
                </div>
                <div class="form-group">
                    <label>Weight</label>
                    <input type="text" name="weight" value="<?= htmlspecialchars($old['weight'] ?? '') ?>" placeholder="1.2 kg">
                </div>
            </div>
            <div class="form-group">
                <label>Care Instructions</label>
                <textarea name="care_instructions" rows="3"><?= htmlspecialchars($old['care_instructions'] ?? '') ?></textarea>
            </div>
        </div>
        <div class="step-actions">
            <button type="button" class="btn-prev" onclick="prevStep()">← Previous</button>
            <button type="button" class="btn-next" onclick="nextStep()">Next Step →</button>
        </div>
    </div>

    <!-- Step 4: Sizes & Colors -->
    <div class="step-panel" data-step="4">
        <div class="form-section">
            <h3>Size Options</h3>
            <p class="section-desc">Add available sizes for this product.</p>
            <div id="sizesContainer">
                <div class="dynamic-row size-row">
                    <input type="text" name="sizes[0][label]" placeholder="Label (e.g. Small)">
                    <input type="text" name="sizes[0][dimension]" placeholder='Dimension (e.g. 6" - 8")'>
                    <input type="number" name="sizes[0][multiplier]" step="0.1" min="0" placeholder="Price Multiplier" value="1.0">
                    <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()" style="display:none">✕</button>
                </div>
            </div>
            <button type="button" class="btn-add-row" onclick="addSizeRow()">+ Add Size</button>
        </div>
        <div class="form-section" style="margin-top:24px">
            <h3>Color Options</h3>
            <p class="section-desc">Add available color variations.</p>
            <div id="colorsContainer">
                <div class="dynamic-row color-row">
                    <input type="text" name="colors[0][name]" placeholder="Color name (e.g. Natural White)">
                    <input type="color" name="colors[0][hex]" value="#F5F0E8">
                    <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()" style="display:none">✕</button>
                </div>
            </div>
            <button type="button" class="btn-add-row" onclick="addColorRow()">+ Add Color</button>
        </div>
        <div class="step-actions">
            <button type="button" class="btn-prev" onclick="prevStep()">← Previous</button>
            <button type="button" class="btn-next" onclick="nextStep()">Next Step →</button>
        </div>
    </div>

    <!-- Step 5: Additional Info + Submit -->
    <div class="step-panel" data-step="5">
        <div class="form-section">
            <h3>Additional Information</h3>
            <p class="section-desc">Add custom key-value details (e.g. Handcrafted: Yes).</p>
            <div id="infoContainer">
                <div class="dynamic-row info-row">
                    <input type="text" name="additional_info[0][key]" placeholder="Key (e.g. Handcrafted)">
                    <input type="text" name="additional_info[0][value]" placeholder="Value (e.g. Yes)">
                    <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()" style="display:none">✕</button>
                </div>
            </div>
            <button type="button" class="btn-add-row" onclick="addInfoRow()">+ Add Info</button>
        </div>
        <div class="step-actions">
            <button type="button" class="btn-prev" onclick="prevStep()">← Previous</button>
            <button type="submit" class="btn-next">Create Product</button>
        </div>
    </div>
</form>

<script>
let currentStep = 1;
const totalSteps = 5;
let sizeIndex = 1, colorIndex = 1, infoIndex = 1;

function updateSteps() {
    for (let i = 1; i <= totalSteps; i++) {
        const panel = document.querySelector(`.step-panel[data-step="${i}"]`);
        const indicator = document.querySelector(`.step-item[data-step="${i}"]`);
        panel.classList.toggle('active', i === currentStep);
        indicator.classList.toggle('active', i === currentStep);
        if (i < currentStep) {
            indicator.classList.add('completed');
        } else {
            indicator.classList.remove('completed');
        }
        const connector = document.querySelector(`.step-connector[data-connector="${i}"]`);
        if (connector) {
            connector.classList.toggle('completed', i < currentStep);
        }
    }
}

function nextStep() {
    if (currentStep < totalSteps) {
        currentStep++;
        updateSteps();
        document.querySelector('.step-panel.active').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateSteps();
        document.querySelector('.step-panel.active').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function addSizeRow() {
    const container = document.getElementById('sizesContainer');
    const row = document.createElement('div');
    row.className = 'dynamic-row size-row';
    row.innerHTML = `
        <input type="text" name="sizes[${sizeIndex}][label]" placeholder="Label (e.g. Small)">
        <input type="text" name="sizes[${sizeIndex}][dimension]" placeholder='Dimension (e.g. 6" - 8")'>
        <input type="number" name="sizes[${sizeIndex}][multiplier]" step="0.1" min="0" placeholder="Price Multiplier" value="1.0">
        <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()">✕</button>
    `;
    container.appendChild(row);
    sizeIndex++;
}

function addColorRow() {
    const container = document.getElementById('colorsContainer');
    const row = document.createElement('div');
    row.className = 'dynamic-row color-row';
    row.innerHTML = `
        <input type="text" name="colors[${colorIndex}][name]" placeholder="Color name (e.g. Natural White)">
        <input type="color" name="colors[${colorIndex}][hex]" value="#F5F0E8">
        <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()">✕</button>
    `;
    container.appendChild(row);
    colorIndex++;
}

function addInfoRow() {
    const container = document.getElementById('infoContainer');
    const row = document.createElement('div');
    row.className = 'dynamic-row info-row';
    row.innerHTML = `
        <input type="text" name="additional_info[${infoIndex}][key]" placeholder="Key (e.g. Handcrafted)">
        <input type="text" name="additional_info[${infoIndex}][value]" placeholder="Value (e.g. Yes)">
        <button type="button" class="btn-remove-row" onclick="this.parentElement.remove()">✕</button>
    `;
    container.appendChild(row);
    infoIndex++;
}

function previewMainImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('mainImagePreview');
            preview.innerHTML = `<img src="${e.target.result}" class="preview-img">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewGallery(input) {
    const container = document.getElementById('galleryPreview');
    container.innerHTML = '';
    if (input.files) {
        const maxFiles = parseInt(input.getAttribute('data-max-files') || '4', 10);
        if (input.files.length > maxFiles) {
            alert(`Please select no more than ${maxFiles} gallery images.`);
            input.value = '';
            return;
        }
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
