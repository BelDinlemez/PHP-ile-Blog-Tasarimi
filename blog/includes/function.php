<?php
include('baglan.php');
function ayarlarGetir($conn) {
    $sql_settings = "SELECT * FROM settings";
    $sonuc = mysqli_query($conn, $sql_settings);
    $settings_array = mysqli_fetch_all($sonuc, MYSQLI_ASSOC);

    return $settings_array[0]; 
}

 function kategoriGetir($conn){
    $sql_categ = "SELECT * FROM category";
    $sonuc = mysqli_query($conn, $sql_categ);
    $category_array = mysqli_fetch_all($sonuc, MYSQLI_ASSOC);

    return  $category_array;
}

function blogYaziGetir($conn, $kategori=0, $offset=0, $limit=4) {
    if ($kategori > 0) {
        $sql_blog = "SELECT blog_content.content, blog_content.blog_slug, blog_content.blog_image, blog_content.blog_title, blog_content.tiny_content, blog_content.date
                     FROM blog_content
                     JOIN categ_match ON blog_content.id = categ_match.blog_id
                     JOIN category ON categ_match.categ_id = category.id
                     WHERE category.categ_slug = '$kategori' AND blog_content.active = 1
                     ORDER BY blog_content.date DESC
                     LIMIT $offset, $limit";
    } else {
        $sql_blog = "SELECT * FROM blog_content WHERE active = 1 ORDER BY date DESC LIMIT $offset, $limit";
    }

    $sonuc = mysqli_query($conn, $sql_blog);
    return mysqli_fetch_all($sonuc, MYSQLI_ASSOC);
}



 
function tarihDonustur($date){
    
    $bolDate= explode("-", $date);
    $ay= $bolDate[1];

    switch ($ay) {
        case '01':
            $ayAdi = "Ocak";
            break;
        case '02':
            $ayAdi = "Şubat";
            break;
        case '03':
            $ayAdi = "Mart";
            break;
        case '04':
            $ayAdi = "Nisan";
            break;
        case '05':
            $ayAdi = "Mayıs";
            break;
        case '06':
            $ayAdi = "Haziran";
            break;
        case '07':
            $ayAdi = "Temmuz";
            break;
        case '08':
            $ayAdi = "Ağustos";
            break;
        case '09':
            $ayAdi = "Eylül";
            break;
        case '10':
            $ayAdi = "Ekim";
            break;
        case '11':
            $ayAdi = "Kasım";
            break;
        case '12':
            $ayAdi = "Aralık";
            break;
        default:
            $ayAdi = "Bilinmiyor";
            break;
    }
    return  $bolDate[2]." ".$ayAdi." ".$bolDate[0];
}


//<!-- details.php -->
function blogDetayGetir($conn, $blog_slug) {
    $sql_blogDetay = "SELECT * FROM blog_content WHERE blog_slug = '$blog_slug' AND active = 1  ORDER BY date DESC";
    $sonuc = mysqli_query($conn, $sql_blogDetay);
    $blogDetay_array = mysqli_fetch_all($sonuc, MYSQLI_ASSOC);
    
    return $blogDetay_array;
}

// function loadMorePosts($limit) {
//     foreach ($blogGetir as $key => $blog) {
//         if ($key < $limit) {
//             $date = tarihDonustur($blog["date"]);
//             echo "
//                 <div class='post-preview border-bottom border-3'>
//                     <a href='detail.php?post={$blog['blog_slug']}'>
//                         <h2 class='post-title'>{$blog["blog_title"]}</h2>
//                     </a>
//                     <p class='post-meta mb-2'>
//                         {$blog["tiny_content"]}
//                     </p>
//                     <p class='post-meta text-end'>
//                         {$date}
//                     </p>
//                 </div>
//             ";
//         }
//     }
// }

function PostViews($conn, $slug) {
 
    $cookie_name = "post_" . $slug;

    // Eğer cookie mevcut değilse
    if (!isset($_COOKIE[$cookie_name])) {
    
        $query = "UPDATE blog_content SET views = views + 1 WHERE blog_slug = ?";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die("Sorgu hazırlama hatası: " . $conn->error);
        }

        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $stmt->close();

        // Güncellenmiş views değerini al
        $query = "SELECT views FROM blog_content WHERE blog_slug = ?";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            die("Sorgu hazırlama hatası: " . $conn->error);
        }

        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $stmt->bind_result($views);
        $stmt->fetch();
        $stmt->close();

        // Çerezin değerini güncelle
        $cookie_value = "viewed_" . $views;

        setcookie($cookie_name, $cookie_value, time() + (30 * 24 * 60 * 60), "/");
    }
}

 ?>