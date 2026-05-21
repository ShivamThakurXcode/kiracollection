<?php
session_start();
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$db = getDB();

// Ensure meta columns exist
try {
    $db->query("SELECT meta_title FROM blogs LIMIT 1");
} catch (PDOException $e) {
    $db->exec("ALTER TABLE blogs ADD COLUMN meta_title VARCHAR(255) DEFAULT '' AFTER content");
    $db->exec("ALTER TABLE blogs ADD COLUMN meta_description TEXT DEFAULT NULL AFTER meta_title");
}

$errors = [];
$old = $_POST;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $title = sanitize($_POST['title'] ?? '');
        if (empty($title)) $errors[] = 'Blog title is required.';

        $slug = sanitize($_POST['slug'] ?? '');
        if (empty($slug)) $slug = slugify($title);
        if (empty($slug)) $errors[] = 'Could not generate slug.';

        // Check unique slug
        $check = $db->prepare("SELECT COUNT(*) FROM blogs WHERE slug = ?");
        $check->execute([$slug]);
        if ($check->fetchColumn() > 0) {
            $slug .= '-' . time();
        }

        $category = sanitize($_POST['category'] ?? 'Lippan Art');
        $excerpt = $_POST['excerpt'] ?? '';
        $content = $_POST['content'] ?? '';
        $author = sanitize($_POST['author'] ?? 'KiraCollection');
        $date = sanitize($_POST['date'] ?? date('d M Y'));
        $metaTitle = sanitize($_POST['meta_title'] ?? '');
        $metaDescription = sanitize($_POST['meta_description'] ?? '');

        // Image
        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = uploadImage($_FILES['image'], __DIR__ . '/../uploads/blogs', 'blog_');
            $image = 'uploads/blogs/' . basename($imagePath);
        }

        if (empty($errors)) {
            $db->beginTransaction();

            $maxId = $db->query("SELECT MAX(id) FROM blogs")->fetchColumn();
            $newId = ($maxId ? $maxId + 1 : 13);

            $stmt = $db->prepare("
                INSERT INTO blogs (id, title, slug, category, image, excerpt, content, meta_title, meta_description, author, date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([$newId, $title, $slug, $category, $image, $excerpt, $content, $metaTitle, $metaDescription, $author, $date]);

            // Tags
            if (isset($_POST['tags']) && is_array($_POST['tags'])) {
                $tagStmt = $db->prepare("INSERT INTO blog_tags (blog_id, tag) VALUES (?, ?)");
                foreach ($_POST['tags'] as $tag) {
                    $tag = sanitize($tag);
                    if (!empty($tag)) {
                        $tagStmt->execute([$newId, $tag]);
                    }
                }
            }

            $db->commit();

            require_once __DIR__ . '/includes/sync.php';
            syncBlogs();

            $_SESSION['flash'] = 'Blog post created successfully!';
            header('Location: blogs.php');
            exit;
        }
    } catch (Exception $e) {
        if ($db->inTransaction()) $db->rollBack();
        $errors[] = 'Error: ' . $e->getMessage();
    }
}
?>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<div class="page-header">
    <div>
        <h2>Add New Blog</h2>
        <p>Create a new blog post</p>
    </div>
    <a href="blogs.php" class="btn-secondary">← Back to Blogs</a>
</div>

<?php if (!empty($errors)): ?>
    <div class="flash-message flash-error">
        <?php foreach ($errors as $err): ?><div><?= htmlspecialchars($err) ?></div><?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="admin-form">
    <div class="form-grid">
        <div class="form-section">
            <h3>Blog Content</h3>
            <div class="form-group">
                <label>Title <span class="required">*</span></label>
                <input type="text" name="title" value="<?= htmlspecialchars($old['title'] ?? '') ?>" required placeholder="Enter blog title" onblur="autoSlug(this)">
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" value="<?= htmlspecialchars($old['slug'] ?? '') ?>" placeholder="Auto-generated from title" id="slugField">
            </div>
            <div class="form-group">
                <label>Excerpt</label>
                <textarea name="excerpt" rows="3" placeholder="Brief summary of the blog post"><?= htmlspecialchars($old['excerpt'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label>Content <span class="required">*</span></label>
                <textarea name="content" id="summernote"><?= htmlspecialchars($old['content'] ?? '') ?></textarea>
            </div>
        </div>

        <div class="form-section">
            <h3>Meta & Settings</h3>
            <div class="form-group">
                <label>Category</label>
                <select name="category">
                    <?php foreach (getBlogCategories() as $cat): ?>
                        <option value="<?= $cat ?>" <?= ($old['category'] ?? '') === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Blog Image</label>
                <div class="file-upload">
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" id="blogImage" onchange="previewSingle(this, 'blogImagePreview')">
                    <div class="upload-placeholder" id="blogImagePreview">
                        <span>Click to upload blog image</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" value="<?= htmlspecialchars($old['author'] ?? 'KiraCollection') ?>">
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="text" name="date" value="<?= htmlspecialchars($old['date'] ?? date('d M Y')) ?>" placeholder="e.g. 09 Feb 2027">
            </div>
            <div class="form-group">
                <label>Meta Title</label>
                <input type="text" name="meta_title" value="<?= htmlspecialchars($old['meta_title'] ?? '') ?>" placeholder="SEO meta title (optional)">
                <div class="form-hint">Recommended: 50-60 characters for optimal SEO</div>
            </div>
            <div class="form-group">
                <label>Meta Description</label>
                <textarea name="meta_description" rows="3" placeholder="SEO meta description (optional)"><?= htmlspecialchars($old['meta_description'] ?? '') ?></textarea>
                <div class="form-hint">Recommended: 150-160 characters for optimal SEO</div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <h3>Tags</h3>
        <p class="section-desc">Type a tag and press Enter or click "Add Tag"</p>
        <div class="tag-input-wrapper">
            <div id="tagsContainer" class="tags-container">
                <?php if (!empty($old['tags'])): ?>
                    <?php foreach ($old['tags'] as $tag): ?>
                        <?php if (!empty($tag)): ?>
                            <span class="tag-chip"><?= htmlspecialchars($tag) ?><button type="button" class="tag-remove" onclick="this.parentElement.remove()">✕</button><input type="hidden" name="tags[]" value="<?= htmlspecialchars($tag) ?>"></span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="tag-input-line">
                <input type="text" id="tagInput" placeholder="Type a tag and press Enter" onkeydown="if(event.key==='Enter'){event.preventDefault();addTag();}">
                <button type="button" class="btn-add-tag" onclick="addTag()">Add</button>
            </div>
        </div>
        <div class="popular-tags">
            <span>Popular:</span>
            <?php foreach (getPopularTags() as $tag): ?>
                <button type="button" class="popular-tag" onclick="addSpecificTag('<?= htmlspecialchars($tag, ENT_QUOTES) ?>')"><?= htmlspecialchars($tag) ?></button>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Create Blog Post</button>
        <a href="blogs.php" class="btn-secondary">Cancel</a>
    </div>
</form>

<script>
function autoSlug(input) {
    const slugField = document.getElementById('slugField');
    if (!slugField.value) {
        slugField.value = input.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    }
}

function previewSingle(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).innerHTML = `<img src="${e.target.result}" class="preview-img">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function addTag() {
    const input = document.getElementById('tagInput');
    const tag = input.value.trim();
    if (!tag) return;
    addSpecificTag(tag);
    input.value = '';
}

function addSpecificTag(tag) {
    const container = document.getElementById('tagsContainer');
    // Check duplicate
    const existing = container.querySelectorAll('input[type="hidden"]');
    for (let el of existing) {
        if (el.value.toLowerCase() === tag.toLowerCase()) return;
    }
    const chip = document.createElement('span');
    chip.className = 'tag-chip';
    chip.innerHTML = `${tag}<button type="button" class="tag-remove" onclick="this.parentElement.remove()">✕</button><input type="hidden" name="tags[]" value="${tag}">`;
    container.appendChild(chip);
}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
    $('#summernote').summernote({
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'italic', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});
</script>
<?php require_once __DIR__ . '/partials/footer.php'; ?>
