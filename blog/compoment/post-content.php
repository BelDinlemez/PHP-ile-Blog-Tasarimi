<?php
include('includes/baglan.php');
if (isset($_GET['post'])) {
    $blog_slug = $_GET['post'];
} else {
    header('Location: index.php');
    exit;
}
$OkunduArttir = PostViews($conn, $blog_slug);
$blogDetay = blogDetayGetir($conn, $blog_slug);

$date = tarihDonustur($blog["date"]);
?>

<!-- Post Content-->
<?php if (!empty($blogDetay)): ?>
    <?php $blog = $blogDetay[0]; ?>      
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="d-flex justify-content-between">
                    <p class="m-0"><?php echo $date; ?> </p>
                    <p class="m-0">Okundu:<?php echo $blog['views']; ?></p>
                    </div>
                    <h2 class="section-heading"><?php echo $blog['blog_title']; ?></h2>
                    <p><?php echo $blog['content']; ?></p>
                </div>
            </div>
        </div>
    </article>
<?php else: ?>
    <p>Üzgünüz, bu yazı bulunamadı.</p>
<?php endif; ?>