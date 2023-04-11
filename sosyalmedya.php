<?php include "header.php"; ?>
    <div class="main-content">

    <div class="page-content">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title">
                            <h4>Sosyal Medya Yönetimi</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item active">Sosyal Medya Ayarları</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="container-fluid">
            <div class="page-content-wrapper">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                include "vt.php";
                                $idc = "963df5fa-d46a-11ed-8a2d-244bfe7ca436";
                                $sorgu = $baglanti->prepare("select * from socialmedia where id=:id");
                                $sorgu->bindParam(':id', $idc, PDO::PARAM_STR);
                                $sorgu->execute();
                                $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
                                if ($_POST) {
                                    $guncelleSorgu = $baglanti->prepare("UPDATE socialmedia set Facebook=:Facebook, Instagram=:Instagram, Youtube=:Youtube, Twitter=:Twitter, Linkedin=:Linkedin, Whatsapp=:Whatsapp, Telegram=:Telegram, Tiktok=:Tiktok, Messenger=:Messenger, Snapchat=:Snapchat, Pinterest=:Pinterest, WebUrl=:WebUrl");
                                    $guncelle = $guncelleSorgu->execute([
                                        'Facebook' => $_POST["Facebook"],
                                        'Instagram' => $_POST["Instagram"],
                                        'Youtube' => $_POST["Youtube"],
                                        'Twitter' => $_POST["Twitter"],
                                        'Linkedin' => $_POST["Linkedin"],
                                        'Whatsapp' => $_POST["Whatsapp"],
                                        'Telegram' => $_POST["Telegram"],
                                        'Tiktok' => $_POST["Tiktok"],
                                        'Messenger' => $_POST["Messenger"],
                                        'Snapchat' => $_POST["Snapchat"],
                                        'Pinterest' => $_POST["Pinterest"],
                                        'WebUrl' => $_POST["WebUrl"],

                                    ]);
                                    echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                    echo "<script> Swal.fire({title:'Başarılı!', text:'Bilgileriniz Güncellendi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='sosyalmedya.php'}})</script>";

                                }
                                ?>
                                <h4 class="header-title">Sosyal Medya Ayarları</h4>
                                <p class="card-title-desc">Lütfen sosyal medya hesaplarını bağlantı olarak girmeyin sadece kullanıcı adınızı yazın </p>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-facebook"></i>
                                                <label class="mb-1">Facebook</label>
                                                <input type="text" class="form-control" maxlength="25" name="Facebook" id="defaultconfig" value="<?= $sonuc["Facebook"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;"  class="fa-brands fa-instagram"></i>
                                                <label class="mb-1">Instagram</label>
                                                <input type="text" class="form-control" maxlength="25" name="Instagram" id="defaultconfig" value="<?= $sonuc["Instagram"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-youtube"></i>
                                                <label class="mb-1">Youtube</label>
                                                <input type="text" class="form-control" maxlength="25" name="Youtube" id="defaultconfig" value="<?= $sonuc["Youtube"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-twitter"></i>
                                                <label class="mb-1">Twitter</label>
                                                <input type="text" class="form-control" maxlength="25" name="Twitter" id="defaultconfig" value="<?= $sonuc["Twitter"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-linkedin"></i>
                                                <label class="mb-1">Linkedin</label>
                                                <input type="text" class="form-control" maxlength="25" name="Linkedin" id="defaultconfig" value="<?= $sonuc["Linkedin"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-whatsapp"></i>
                                                <label class="mb-1">Whatsapp</label>
                                                <input type="text" class="form-control" maxlength="25" name="Whatsapp" id="defaultconfig" value="<?= $sonuc["Whatsapp"] ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-telegram"></i>
                                                <label class="mb-1">Telegram</label>
                                                <input type="text" class="form-control" maxlength="25" name="Telegram" id="defaultconfig" value="<?= $sonuc["Telegram"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-tiktok"></i>
                                                <label class="mb-1">Tiktok</label>
                                                <input type="text" class="form-control" maxlength="25" name="Tiktok" id="defaultconfig" value="<?= $sonuc["Tiktok"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-facebook-messenger"></i>
                                                <label class="mb-1">Facebook Messenger</label>
                                                <input type="text" class="form-control" maxlength="25" name="Messenger" id="defaultconfig" value="<?= $sonuc["Messenger"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-snapchat"></i>
                                                <label class="mb-1">Snapchat</label>
                                                <input type="text" class="form-control" maxlength="25" name="Snapchat" id="defaultconfig" value="<?= $sonuc["Snapchat"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-pinterest"></i>
                                                <label class="mb-1">Pinterest</label>
                                                <input type="text" class="form-control" maxlength="25" name="Pinterest" id="defaultconfig" value="<?= $sonuc["Pinterest"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-dribbble-square"></i>
                                                <label class="mb-1">Bağlantı</label>
                                                <input type="text" class="form-control" maxlength="90" name="WebUrl" id="defaultconfig" value="<?= $sonuc["WebUrl"] ?>">
                                            </div>

                                        </div>


                                    </div>
                                    <div class="mt-3"></div>
                                    <div class="mt-1">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Kaydet">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



<?php include "footer.php"; ?>