<?php
session_start();
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$db = getDB();
$id = (int)($_GET['id'] ?? 0);

if (!$id) {
    header('Location: blogs.php');
    exit;
}

$blog = $db->prepare("SELECT * FROM blogs WHERE id = ?");
$blog->execute([$id]);
$blog = $blog->fetch();

if (!$blog) {
    header('Location: blogs.php');
    exit;
}

// Get tags
$tagStmt = $db->prepare("SELECT tag FROM blog_tags WHERE blog_id = ?");
$tagStmt->execute([$id]);
$existingTags = $tagStmt->fetchAll(PDO::FETCH_COLUMN);

$errors = [];

// Ensure meta columns exist
try {
    $db->query("SELECT meta_title FROM blogs LIMIT 1");
} catch (PDOException $e) {
    $db->exec("ALTER TABLE blogs ADD COLUMN meta_title VARCHAR(255) DEFAULT '' AFTER content");
    $db->exec("ALTER TABLE blogs ADD COLUMN meta_description TEXT DEFAULT NULL AFTER meta_title");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $title = sanitize($_POST['title'] ?? '');
        if (empty($title)) $errors[] = 'Blog title is required.';

        $slug = sanitize($_POST['slug'] ?? '');
        if (empty($slug)) $slug = slugify($title);

        // Check unique slug (excluding current)
        $check = $db->prepare("SELECT COUNT(*) FROM blogs WHERE slug = ? AND id != ?");
        $check->execute([$slug, $id]);
        if ($check->fetchColumn() > 0) {
            $slug .= '-' . $id;
        }

        $category = sanitize($_POST['category'] ?? 'Lippan Art');
        $excerpt = $_POST['excerpt'] ?? '';
        $content = $_POST['content'] ?? '';
        $author = sanitize($_POST['author'] ?? 'KiraCollection');
        $date = sanitize($_POST['date'] ?? date('d M Y'));
        $metaTitle = sanitize($_POST['meta_title'] ?? '');
        $metaDescription = sanitize($_POST['meta_description'] ?? '');

        $image = $blog['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imgPath = uploadImage($_FILES['image'], __DIR__ . '/../uploads/blogs', 'blog_');
            $image = 'uploads/blogs/' . basename($imgPath);
        }

        if (empty($errors)) {
            $db->beginTransaction();

            $stmt = $db->prepare("
                UPDATE blogs SET title=?, slug=?, category=?, image=?, excerpt=?, content=?, meta_title=?, meta_description=?, author=?, date=?
                WHERE id=?
            ");
            $stmt->execute([$title, $slug, $category, $image, $excerpt, $content, $metaTitle, $metaDescription, $author, $date, $id]);

            // Replace tags
            $db->exec("DELETE FROM blog_tags WHERE blog_id = $id");
            if (isset($_POST['tags']) && is_array($_POST['tags'])) {
                $tagStmt = $db->prepare("INSERT INTO blog_tags (blog_id, tag) VALUES (?, ?)");
                foreach ($_POST['tags'] as $tag) {
                    $tag = sanitize($tag);
                    if (!empty($tag)) {
                        $tagStmt->execute([$id, $tag]);
                    }
                }
            }

            $db->commit();

            require_once __DIR__ . '/includes/sync.php';
            syncBlogs();

            $_SESSION['flash'] = 'Blog post updated successfully!';
            header('Location: blogs.php');
            exit;
        }
    } catch (Exception $e) {
        if ($db->inTransaction()) $db->rollBack();
        $errors[] = 'Error: ' . $e->getMessage();
    }
}

$flash = $_SESSION['flash'] ?? '';
unset($_SESSION['flash']);
require_once __DIR__ . '/partials/header.php';
?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<div class="page-header">
    <div>
        <h2>Edit Blog</h2>
        <p>#<?= $id ?> — <?= htmlspecialchars($blog['title']) ?></p>
    </div>
    <a href="blogs.php" class="btn-secondary">← Back to Blogs</a>
</div>

<?php if ($flash): ?>
    <div class="flash-message flash-success"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>
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
                <input type="text" name="title" value="<?= htmlspecialchars($_POST['title'] ?? $blog['title']) ?>" required>
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" name="slug" value="<?= htmlspecialchars($_POST['slug'] ?? $blog['slug']) ?>">
            </div>
            <div class="form-group">
                <label>Excerpt</label>
                <textarea name="excerpt" rows="3"><?= htmlspecialchars($_POST['excerpt'] ?? $blog['excerpt']) ?></textarea>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" id="summernote"><?= htmlspecialchars($_POST['content'] ?? $blog['content']) ?></textarea>
            </div>
        </div>

        <div class="form-section">
            <h3>Meta & Settings</h3>
            <div class="form-group">
                <label>Category</label>
                <select name="category">
                    <?php foreach (getBlogCategories() as $cat): ?>
                        <option value="<?= $cat ?>" <?= ($_POST['category'] ?? $blog['category']) === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Current Image</label>
                <?php if ($blog['image']): ?>
                    <div class="current-image"><img src="../<?= htmlspecialchars($blog['image']) ?>" alt="" onerror="this.style.display='none'"></div>
                <?php endif; ?>
                <div class="file-upload">
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" id="blogImage" onchange="previewSingle(this, 'blogImagePreview')">
                    <div class="upload-placeholder" id="blogImagePreview"><span>Click to replace image</span></div>
                </div>
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" value="<?= htmlspecialchars($_POST['author'] ?? $blog['author']) ?>">
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="text" name="date" value="<?= htmlspecialchars($_POST['date'] ?? $blog['date']) ?>">
            </div>
            <div class="form-group">
                <label>Meta Title</label>
                <input type="text" name="meta_title" value="<?= htmlspecialchars($_POST['meta_title'] ?? ($blog['meta_title'] ?? '')) ?>" placeholder="SEO meta title (optional)">
                <div class="form-hint">Recommended: 50-60 characters for optimal SEO</div>
            </div>
            <div class="form-group">
                <label>Meta Description</label>
                <textarea name="meta_description" rows="3" placeholder="SEO meta description (optional)"><?= htmlspecialchars($_POST['meta_description'] ?? ($blog['meta_description'] ?? '')) ?></textarea>
                <div class="form-hint">Recommended: 150-160 characters for optimal SEO</div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <h3>Tags</h3>
        <div class="tag-input-wrapper">
            <div id="tagsContainer" class="tags-container">
                <?php
                $currentTags = isset($_POST['tags']) ? $_POST['tags'] : $existingTags;
                foreach ($currentTags as $tag):
                    if (!empty($tag)):
                ?>
                    <span class="tag-chip"><?= htmlspecialchars($tag) ?><button type="button" class="tag-remove" onclick="this.parentElement.remove()">✕</button><input type="hidden" name="tags[]" value="<?= htmlspecialchars($tag) ?>"></span>
                <?php endif; endforeach; ?>
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
        <button type="submit" class="btn-primary">Update Blog Post</button>
        <a href="blogs.php" class="btn-secondary">Cancel</a>
    </div>
</form>

<script>
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
