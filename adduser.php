<?php
include("vt.php");
session_start();
if (!(isset($_SESSION["oturum"]) && $_SESSION["oturum"] == "6789")) {
    header("location:login.php");
}
if (!(isset($_SESSION["verify"]) && $_SESSION["verify"] == "4567")) {
    header("location:login.php");
}
echo "&nbsp;";
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <title>Kullanıcı Ekle | Fayu Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Fayu Yönetim Paneli" name="description" />
    <meta content="Fatih Yüzügüldü" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>


<body class="authentication-bg bg-primary">
    <div class="home-center">
        <div class="home-desc-center">

            <div class="container">

                <div class="home-btn"><a href="index.php" class="text-white router-link-active"><i
                            class="fas fa-home h2"></i></a></div>


                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="px-2 py-3">


                                    <div class="text-center">
                                        <a href="index.php">
                                            <img src="assets/images/logo-dark.png" height="60" alt="logo">
                                        </a>

                                        <h5 class="text-primary mb-2 mt-4">Kullanıcı Ekle</h5>
                                        <p class="text-muted">Yönetim Paneliniz için Kullanıcı Ekleyin.</p>
                                    </div>

                                    <?php
                                    if ($_POST) {
                                        $emailc = $_POST["txtEmail"];
                                        $sorgu = $baglanti->prepare("SELECT COUNT(*) as sayi FROM users WHERE Email = '$emailc'");
                                        $sorgu->execute();
                                        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
                                        if ($sonuc["sayi"] > 0) {
                                            echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                            echo "<script> Swal.fire({title:'Hata!', text:'".$_POST["txtEmail"]." zaten var!', icon:'error', confirmButtonText:'Kapat'})</script>";

                                        }
                                        else {
                                            $passw = hash("sha256", "56" . $_POST["txtPass"] . "23");
                                            $guncelleSorgu = $baglanti->prepare("INSERT INTO users set Email=:Email, Isim=:Isim, Username=:Username, Pass=:Pass");
                                            $guncelle = $guncelleSorgu->execute([
                                                'Email' => $_POST["txtEmail"],
                                                'Isim' => $_POST["txtIsim"],
                                                'Pass' => $passw,
                                                'Username' => $_POST["txtUsername"],
                                            ]);
                                            if ($guncelle) {
                                                echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                                echo "<script> Swal.fire({title:'Başarılı!', text:'".$_POST["txtEmail"]." Email Kaydı Başarıyla Gerçekleştirildi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='index.php'}})</script>";
                                            }
                                        }
                                    }
                                    ?>
                                    <form class="form-horizontal" method="post" action="">
                                        <div class="mb-3">
                                            <label for="username">İsim Soyisim</label>
                                            <input type="text" class="form-control" value="<?= @$_POST["txtIsim"] ?>" id="Isim" name="txtIsim" placeholder="İsim Soyisim" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="useremail">Email</label>
                                            <input type="email" class="form-control" id="useremail" value="<?= @$_POST["txtEmail"] ?>" name="txtEmail" placeholder="Email Adresi Girin" required>
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="username">Kullanıcı Adı</label>
                                            <input type="text" class="form-control" id="username" value="<?= @$_POST["txtUsername"] ?>" name="txtUsername" placeholder="Kullanıcı Adı Girin" required>
                                        </div>
                
                                        <div class="mb-3">
                                            <label for="userpassword">Şifre</label>
                                            <input type="password" class="form-control" id="userpassword" name="txtPass" placeholder="Şifre Girin" required>
                                        </div>
                    
                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Kullanıcı Ekle</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center text-white">
                            <p>  <a href="index.php" class="fw-bold text-white"> Anasayfaya Dön </a> </p>
                            <p>© <script>document.write(new Date().getFullYear())</script> Developer by <i class="mdi mdi-heart text-danger"></i> Fatih Yüzügüldü </p>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <!-- End Log In page -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>