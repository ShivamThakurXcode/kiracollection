<?php
include_once 'data/blogs.php';

// Get categories with counts
$categories = [];
foreach ($blogs as $blog) {
  if (!isset($categories[$blog['category']])) {
    $categories[$blog['category']] = 0;
  }
  $categories[$blog['category']]++;
}

// Get recent posts (latest 3)
$recent_posts = array_slice($blogs, 0, 3);

// Get popular tags from all blogs
$all_tags = [];
foreach ($blogs as $blog) {
  foreach ($blog['tags'] as $tag) {
    if (!isset($all_tags[$tag])) {
      $all_tags[$tag] = 0;
    }
    $all_tags[$tag]++;
  }
}
arsort($all_tags);
$popular_tags = array_slice(array_keys($all_tags), 0, 8);
?>
<!-- ========== Blog Sidebar Section Start ========== -->
<!-- ========== Blog Sidebar Section End ========== -->

<script>
  function filterByCategory(category) {
    window.location.href = 'blog.php?category=' + category;
  }

  function filterByTag(tag) {
    // Tag filtering could be implemented here
    console.log('Filter by tag:', tag);
    // For now, you could redirect to blog page with tag parameter
    // window.location.href = 'blog.php?tag=' + tag;
  }

  function searchBlogs(query) {
    if (query.trim()) {
      window.location.href = 'blog.php?search=' + encodeURIComponent(query);
    }
  }
</script>