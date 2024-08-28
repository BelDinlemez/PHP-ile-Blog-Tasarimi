<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7" id="blog-container">
            <?php
            $kategori = isset($_GET["slug"]) ? $_GET["slug"] : "0";
            $limit = 4; 
            $blogGetir = blogYaziGetir($conn, $kategori);
            $i = 0;

            foreach ($blogGetir as $key => $blog) {
                $date = tarihDonustur($blog["date"]);
                $i++;
                if ($i <= $limit && $i > 1) {
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
            }
            ?>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 d-flex justify-content-center mb-4 mt-4">
            <button id="load-more" class="btn btn-dark text-uppercase">Daha Fazlası →</button>
        </div>
    </div>
</div>

<script>
    
$(document).ready(function() {
    var offset = 4; 
    var limit = 4;  

    $('#load-more').on('click', function() {
        var button = $(this);
        var slug = "<?php echo $kategori; ?>";

        $.ajax({
            url: 'http://belinayblog.local/includes/load-more.php',
            type: 'POST',
            data: {
                action: 'load_more_blogs',
                offset: offset,
                limit: limit,
                slug: slug
            },
            success: function(response) {
                $('#blog-container').append(response);
                offset += limit;
                // Eğer daha fazla veri yoksa butonu devre dışı bırak
                if (response.trim() === '') {
                    button.prop('disabled', true).text('Daha Fazla Yazı Yok');
                    button.addClass('bounce');

                    setTimeout(function() {
                        button.addClass('d-none'); // Opaklık sıfırlandığında butonu DOM'dan kaldır
                    }, 2000);
                }
            },
            error: function() {
                alert('Bir hata oluştu. Lütfen tekrar deneyin.');
            }
        });
    });
});
</script>