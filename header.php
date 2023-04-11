<?php
include "inc/basliklar.php";
error_reporting(0);
include("vt.php");
session_start();
date_default_timezone_set('Europe/Istanbul');
if (!(isset($_SESSION["oturum"]) && $_SESSION["oturum"] == "6789")) {
    header("location:login.php");
}
if (!(isset($_SESSION["verify"]) && $_SESSION["verify"] == "4567")) {
    header("location:login.php");
}
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <title><?= $pageTitle ?> | Fayu Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Fayu Yönetim Paneli" name="description" />
    <meta content="Fatih Yüzügüldü" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- plugin css -->
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAvesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>
<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                       <!-- LOGO -->
                 <div class="navbar-brand-box">
                    <a href="index.php" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="40">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="" height="40">
                        </span>
                    </a>

                    <a href="index.php" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="40">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="40">
                        </span>
                    </a>
                </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="mdi mdi-menu"></i>
                    </button>


                </div>

                <div class="d-flex">
                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="mdi mdi-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-7.jpg"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1"><?= $_SESSION["Username"] ?></span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="adduser.php"><i class="mdi mdi-account-circle-outline font-size-16 align-middle me-1"></i> Kullanıcı Ekle</a>
                            <a class="dropdown-item d-block" href="useredit.php?id=<?= $_SESSION["id"]?>" ><i class="mdi mdi-cog-outline font-size-16 align-middle me-1"></i> Ayarlar</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="logout.php"><i class="mdi mdi-power font-size-16 align-middle me-1 text-danger"></i> Çıkış Yap</a>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="mdi mdi-cog-outline font-size-20"></i>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">


                <div class="user-sidebar text-center">
                    <div class="dropdown">
                        <div class="user-img">
                            <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle">
                            <span class="avatar-online bg-success"></span>
                        </div>
                        <div class="user-info">
                            <h5 class="mt-3 font-size-16 text-white"><?= $_SESSION["Isim"] ?></h5>
                            <span class="font-size-13 text-white-50"><?= $_SESSION["Username"] ?></span>
                        </div>
                    </div>
                </div>



                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="index.php" class="waves-effect">
                                <i class="dripicons-home"></i>
                                <span>Anasayfa</span>
                            </a>
                        </li>


                        <li class="menu-title">Sayfa Ayarları</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-toggles"></i>
                                <span>Ürün Yönetimi</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="urun.php">Ürün Listesi</a></li>
                                <li><a href="urunekle.php">Ürün Ekle</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-basket"></i>
                                <span>Kategori Yönetimi</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="kategori.php">Kategori Listesi</a></li>
                                <li><a href="kategoriekle.php">Kategori Ekle</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-map"></i>
                                <span>Ekip Yönetimi</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="ekibimiz.php">Ekip Listesi</a></li>
                                <li><a href="ekipekle.php">Ekip Ekle</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Genel Ayarlar</li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-device-desktop"></i>
                                <span>Site Yönetimi</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="adduser.php">Kullanıcı Ekle</a></li>
                                <li><a href="useredit.php?id=<?= $_SESSION["id"] ?>">Admin Düzenle</a></li>
                            </ul>
                        </li>

               

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-user-group"></i>
                                <span>Kullanıcı Ayarları</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="adduser.php">Kullanıcı Ekle</a></li>
                                <li><a href="useredit.php?id=<?= $_SESSION["id"] ?>">Admin Düzenle</a></li>
                            </ul>
                        </li>

                        <li>
                            <a style="color: red;" href="logout.php" class="waves-effect">
                                <i style="color: red;" class="dripicons-power"></i>
                                <span>Çıkış Yap</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->