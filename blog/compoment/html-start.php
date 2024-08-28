<?php 
//varsayılan hata mesajlarının raporlanması ve ayarlanması error_reporting() ile yapılır
error_reporting(0);//Tüm hata mesajları gizlenir
error_reporting(E_ALL);//Tüm hata mesajları gösterilir
error_reporting(-1);//Tüm hata mesajları gösterilir
error_reporting(E_ERROR | E_WARNING | E_PARSE);//Belirtilen hata mesajları gösterilir

// ini_set('display_error', 0);
include('includes/baglan.php');
include('includes/function.php');

$facebook='facebook.com';
$settings['facebook']= $facebook;
$settings = ayarlarGetir($conn);
$date=date("Ymdhis");
// error_reporting(0);
?>


<!DOCTYPE html>
<html lang="tr-TR">

<?php include('head.php') ?>

<body>