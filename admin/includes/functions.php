<?php
function sanitize($input)
{
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

function slugify($text)
{
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
}

function uploadImage($file, $targetDir, $prefix = '')
{
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return '';
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception('Only JPG, PNG, WebP, and GIF files are allowed.');
    }

    $maxSize = 5 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        throw new Exception('File size must be less than 5MB.');
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = $prefix . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $targetPath = rtrim($targetDir, '/') . '/' . $filename;

    if (!is_dir(dirname($targetPath))) {
        mkdir(dirname($targetPath), 0755, true);
    }

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        throw new Exception('Failed to upload file.');
    }

    return $targetPath;
}

function getProductSections()
{
    return [
        'homeFourPicksProducts' => 'Home Four Picks Slider',
        'topRateProducts' => 'Top Rate Products',
        'topItemsProducts' => 'Top Items Products',
        'categoryPromoProducts' => 'Category Promo Products',
        'mostLovedProducts' => 'Most Loved Products',
        'productsSectionProducts' => 'Products Section',
        'limitedTimeProducts' => 'Limited Time Products',
        'favouriteCategoryProducts' => 'Favourite Category Products',
    ];
}

function getBlogCategories()
{
    return ['Lippan Art', 'Mandala Art'];
}

function getBlogCategoryColors()
{
    return ['warning', 'success', 'primary', 'info'];
}

function getProductCategories()
{
    return ['Lippan Art', 'Mandala Art', 'Wall Decor', 'Mirror Art', 'Home Decor'];
}

function getDiscountBadges()
{
    return ['', 'BESTSELLER', 'SALES', 'NEW', 'POPULAR', 'PREMIUM', 'HOT', 'TRENDING', 'FLASH', 'DEAL'];
}

function getPopularTags()
{
    return ['Traditional Art', 'Mandala', 'Home Decor', 'DIY', 'Spirituality', 'Interior Design', 'Artisan Stories', 'Meditation'];
}

function calculateReadingTime($content)
{
    $words = str_word_count(strip_tags($content));
    $minutes = ceil($words / 200);
    return $minutes . ' min read';
}

function formatDate($date)
{
    return date('d M Y', strtotime($date));
}
