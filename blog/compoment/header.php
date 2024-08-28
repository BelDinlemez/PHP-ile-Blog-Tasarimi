<?php
$blog_slug = isset($_GET['post']) ? $_GET['post'] : null;
$kategori = isset($_GET["slug"]) ? $_GET["slug"] : "0";

if ($blog_slug) {
    $blogDetay = blogDetayGetir($conn, $blog_slug);
    if (!empty($blogDetay)) {
        $blog = $blogDetay[0];
        $image = $blog['blog_image'];
        $date = tarihDonustur($blog["date"]);

        echo "
            <header class='masthead' style='background-image: url(\"$image\")'>
                <div class='container position-relative px-4 px-lg-5'>
                    <div class='row gx-4 gx-lg-5 justify-content-center'>
                        <div class='col-md-10 col-lg-8 col-xl-7'>
                            <div class='site-heading'>
                                <h2 class='h1-title'>{$blog['blog_title']}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        ";
    } else {
        echo "<p>Üzgünüz, bu yazı bulunamadı.</p>";
    }
} else {
    $blogGetir = blogYaziGetir($conn, $kategori);
    if (!empty($blogGetir)) {
        $blog = $blogGetir[0];
        $image = $blog['blog_image'];
        $date = tarihDonustur($blog["date"]);

        echo "
            <header class='masthead' style='background-image: url(\"$image\")'>
                <div class='container position-relative px-4 px-lg-5'>
                    <div class='row gx-4 gx-lg-5 justify-content-center'>
                        <div class='col-md-10 col-lg-8 col-xl-7'>
                            <div class='site-heading'>
                                <a href='detail.php?post={$blog['blog_slug']}'><h1 class='h1-title'>{$blog['blog_title']}</h1></a>
                                <p class='text-start'>{$blog['tiny_content']}...</p>
                                <p class='text-start'>$date</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        ";
    } else {
        die();
        header('Location: index.php');
        exit;
    }
}
?>