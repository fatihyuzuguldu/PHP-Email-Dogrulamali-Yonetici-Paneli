<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <title>E-Mail Doğrula | Fayu Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Fayu Yönetim Paneli" name="description"/>
    <meta content="Fatih Yüzügüldü" name="author"/>
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

                <div class="home-btn"><a href="../index.php" class="text-white router-link-active"><i
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
                                        <?php
                                        date_default_timezone_set('Europe/Istanbul');
                                        error_reporting(0);
                                        include("vt.php");
                                        session_start();
                                        if ($_SESSION["oturum"] == "6789"){
                                            header("location:index.php");
                                        }
                                        if (!(isset($_SESSION["verify"]) && $_SESSION["verify"] == "4567")) {
                                            header("location:login.php");
                                        }
                                        ?>
                                        <h3 class="text-primary mb-2 mt-4">E-Mail Doğrulama</h3>
                                        <h5 class="text-primary mb-2 mt-4">Hoşgeldiniz! <?= $_SESSION["Isim"] ?></h5>
                                    </div>


                                    <form class="form-horizontal" method="post">
            
                                        <div class="user-thumb text-center mb-4 mt-4">
                                            <img src="assets/images/users/avatar-7.jpg" class="rounded-circle img-thumbnail avatar-md" alt="<?= $_SESSION["Isim"] ?>">
                                        </div>
                    
            
                                        <div class="mb-3">
                                            <label for="userpassword">E-Mail Doğrulama Kodunuz: <?= $_SESSION['Email'] ?></label>
                                            <input type="number" maxlength="6" class="form-control" id="code" name="code" placeholder="Doğrulama Kodunuz">
                                        </div>
            <br>
                                        <div class="row mb-0">
                                            <div class="col-3 text-end">
                                                <a class="btn btn-danger w-md waves-effect waves-danger"  href="logout.php">Çıkış Yap</a>
                                            </div>
                                            <div class="col-9 text-end">
                                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Doğrula</button>
                                            </div>
                                        </div>
    
                                    </form>
                                    <?php
                                    if ($_POST) {

                                        if ($_SESSION["kod"] == $_POST["code"]){
                                            $_SESSION["oturum"] = "6789";
                                            $date = date('Y-m-d H:i:s');
                                            $guncelleSorgu = $baglanti->prepare("UPDATE users set LastLogin=:LastLogin, Username=:Username where id=:id");
                                            $guncelle = $guncelleSorgu->execute([
                                                'LastLogin' => $date,
                                                'Username' => "demo",
                                                'id' => $_SESSION["id"],
                                            ]);
                                            header("Location: index.php");
                                        }
                                            else {
                                                echo "Doğrulama Kodunuz Yanlış";
                                            }

                                    }

                                    ?>


                                </div>
                            </div>
                        </div>

                        <div class="mt-5 text-center text-white">
                            <p>© <script>document.write(new Date().getFullYear())</script> <a style="color: #ffffff" href="https://fatihyuzuguldu.com">Fatih Yüzügüldü</a></p>
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