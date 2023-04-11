<!doctype html>
<html lang="tr">

<head>


    <meta charset="utf-8"/>
    <title>Giriş Sayfası | Fayu Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Fayu Yönetim Paneli" name="description"/>
    <meta content="Fatih Yüzügüldü" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css"/>
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

                                    <h5 class="text-primary mb-2 mt-4">Hoşgeldin !</h5>
                                    <p class="text-muted">Yönetim Sayfasına erişmek için Giriş Yap.</p>
                                </div>
                                <?php
                                session_start();
                                include("vt.php");
                                if (isset($_SESSION["verify"]) && $_SESSION["verify"] == "4567") {
                                    header("location:verify.php");
                                } elseif (isset($_COOKIE["cerez"])) {
                                    $sorgu = $baglanti->prepare("select Email from users");
                                    $sorgu->execute();
                                    while ($sonuc = $sorgu->fetch()) {
                                        if ($_COOKIE["cerez"] == hash("sha256","aa".$Email."bb")) {
                                            $_SESSION["verify"] = "4567";
                                            $_SESSION["Email"] = $sonuc["Email"];
                                            header("location:verify.php");
                                        }

                                    }
                                }
                                if ($_POST) {
                                    $Email = $_POST["txtEmail"];
                                    $Pass = $_POST["txtPass"];

                                }
                                ?>

                                <form class="form-horizontal mt-4 pt-2" method="post" action="login.php">

                                    <div class="mb-3">
                                        <label for="email">E-Mail</label>
                                        <input type="email" class="form-control" id="username" name="txtEmail"
                                             value="<?= @$Email ?>"  placeholder="Email Girin">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userpassword">Şifre</label>
                                        <input type="password" class="form-control" id="userpassword" name="txtPass"
                                               placeholder="Şifre Girin">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="cbHatirla"
                                                   id="customControlInline">
                                            <label class="form-label" for="customControlInline">Beni Hatırla</label>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">Giriş Yap
                                        </button>
                                    </div>
                                </form>
                                <?php
                                if ($_POST) {
                                    $sorgu = $baglanti->prepare("select Pass,Username,Isim,id from users where Email=:Email");
                                    $sorgu->execute(['Email' => htmlspecialchars($Email)]);
                                    $sonuc = $sorgu->fetch();
                                    if (hash("sha256","56".$Pass."23") == $sonuc["Pass"]) {
                                        $_SESSION["verify"] = "4567";
                                        $_SESSION["Email"] = $Email;
                                        $_SESSION["Username"] = $sonuc["Username"];
                                        $_SESSION["Isim"] = $sonuc["Isim"];
                                        $_SESSION["id"] = $sonuc["id"];

                                        if (isset($_POST["cbhatirla"])) {
                                            setcookie("cerez", hash("sha256","aa" . $Email . "bb"), time() + (60 * 60 * 24));
                                        }

                                        if(!isset($_SESSION['kod']) || !isset($_POST['kod'])) {
                                            $_SESSION['kod'] = rand(111111,999999);
                                        } elseif(isset($_POST['kod'])) {
                                            //validate code
                                            if($_POST['kod'] == $_SESSION['kod']) {
                                                unset($_SESSION['kod']);

                                            }
                                        }

                                        function mailgonder()
                                        {
                                            require "inc/class.phpmailer.php"; // PHPMailer dosyamızı çağırıyoruz
                                            $mail = new PHPMailer();
                                            $mail->IsSMTP();
                                            $mail->From = "11@11.com"; //Gönderen kısmında yer alacak e-mail adresi
                                            $mail->Sender = "11@1.com"; //Gönderen mail
                                            $mail->FromName = "Fayu Verify Code"; //Gönderen kişi
                                            $mail->Host = "mail.111.com"; //SMTP server adresi
                                            $mail->SMTPAuth = true;
                                            $mail->Username = "11@11.com"; //SMTP kullanıcı adı
                                            $mail->Password = "2222"; //SMTP şifre
                                            $mail->SMTPSecure = "";
                                            $mail->Port = "587"; //Port
                                            $mail->CharSet = "utf-8";
                                            $mail->WordWrap = 50;
                                            $mail->IsHTML(true); //Mailin HTML formatında hazırlanacağını bildiriyoruz.
                                            $mail->Subject = "Doğrulama Kodunuz " .$_SESSION['kod']." ";

                                            $mail->Body = $_SESSION['kod'];
                                            $mail->AltBody = strip_tags($_SESSION['kod']);
                                            $mail->AddAddress($_SESSION["Email"]);
                                            return ($mail->Send()) ? true : false;
                                            $mail->ClearAddresses();
                                            $mail->ClearAttachments();
                                        }(mailgonder());
                                        date_default_timezone_set('Europe/Istanbul');
                                        $date = date('Y-m-d H:i:s');
                                        $guncelleSorgu = $baglanti->prepare("INSERT INTO verify set Email=:Email, Code=:Code, LastLogin=:LastLogin, User_Id=:User_Id");
                                        $guncelle = $guncelleSorgu->execute([
                                            'Email' => $_SESSION["Email"],
                                            'Code' => $_SESSION['kod'],
                                            'LastLogin' => $date,
                                            'User_Id' => $sonuc["id"],
                                        ]);
                                        header("Location: verify.php");
                                    }

                                    else{
                                        echo "Şifre Yanlış";
                                    }

                                }
                               // echo "Şifre Oluştur ", hash("sha256","56".$Pass."23");
                                ?>

                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center text-white">
                        <p>©
                            <script>document.write(new Date().getFullYear())</script>
                            <a style="color: #ffffff" href="https://fatihyuzuguldu.com">Fatih Yüzügüldü</a>
                        </p>
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