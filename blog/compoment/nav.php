
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">
        <img src="<?php echo $settings['logo']?>" alt=" Logo" style="height: auto; width: auto; max-height: 100%; max-width: 100%;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <?php 
                $kategoriler = kategoriGetir($conn);


                foreach ($kategoriler as $key => $kategori) {
                    echo "<li class='nav-item'><a class='nav-link px-lg-3 py-3 py-lg-4' href='list.php?slug={$kategori["categ_slug"]}'>{$kategori["categ_name"]}</a></li>";
                }
                
                ?>
                 <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>