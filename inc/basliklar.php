<?php
$url = $_SERVER['REQUEST_URI'];
$pageName = basename($url);
switch ($pageName) {
    case 'index.php':
        $pageTitle = 'Anasayfa';
        break;
    case 'adduser.php':
        $pageTitle = 'Kullanıcı Ekle';
        break;
    case 'ayarlar.php':
        $pageTitle = 'Sayfa Yönetimi';
        break;
    case 'ekipekle.php':
        $pageTitle = 'Ekibimiz Ekle';
        break;
    case 'ekibimiz.php':
        $pageTitle = 'Ekip Listesi';
        break;
    case 'iletisim.php':
        $pageTitle = 'İletişim Düzenle';
        break;
    case 'kategori.php':
        $pageTitle = 'Kategori Listesi';
        break;
    case 'kategoriduzenle.php':
        $pageTitle = 'Kategori Düzenle';
        break;
    case 'sosyalmedya.php':
        $pageTitle = 'Sosyal Medya Ayarları';
        break;
    case 'urun.php':
        $pageTitle = 'Ürün Listesi';
        break;
    case 'urunekle.php':
        $pageTitle = 'Ürün Ekle';
        break;
    case 'urunduzenle.php':
        $pageTitle = 'Ürün Düzenle';
        break;
    case 'useredit.php':
        $pageTitle = 'Kullanıcı Düzenle';
        break;
}
?>