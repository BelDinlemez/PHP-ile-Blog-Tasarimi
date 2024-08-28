<?php
include('baglan.php');
include('function.php');
// AJAX isteği ile veri çekme
if (isset($_POST['action']) && $_POST['action'] == 'load_more_blogs') {
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $limit = isset($_POST['limit']) ? intval($_POST['limit']) : 4;
    $slug = isset($_POST['slug']) ? $_POST['slug'] : '0';

    $blogGetir = blogYaziGetir($conn, $slug, $offset, $limit);

    foreach ($blogGetir as $blog) {
        $date = tarihDonustur($blog["date"]);
        echo "
            <div class='post-preview border-bottom border-3'>
                <a href='detail.php?post={$blog['blog_slug']}'>
                    <h2 class='post-title'>{$blog["blog_title"]}</h2>
                </a>
                <p class='post-meta mb-2'>
                    {$blog["tiny_content"]}
                </p>
                <p class='post-meta text-end'>
                    {$date}
                </p>
            </div>
        ";
    }

    exit;
}
?>