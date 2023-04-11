<?php include "header.php"; ?>
    <div class="main-content">

    <div class="page-content">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title">
                            <h4>İletişim Ayarları</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                <li class="breadcrumb-item active">İletişim Ayarları</li>
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
                                $idc = "c158822e-d6a5-11ed-a862-244bfe7ca436";
                                $sorgu = $baglanti->prepare("select * from contacts where id=:id");
                                $sorgu->bindParam(':id', $idc, PDO::PARAM_STR);
                                $sorgu->execute();
                                $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
                                if ($_POST) {
                                    $guncelleSorgu = $baglanti->prepare("UPDATE contacts set Telefon1=:Telefon1, Telefon2=:Telefon2, Email1=:Email1, Email2=:Email2, Adres1=:Adres1, Whatsapp=:Whatsapp, Adres2=:Adres2, GoogleMaps=:GoogleMaps");
                                    $guncelle = $guncelleSorgu->execute([
                                        'Telefon1' => $_POST["Telefon1"],
                                        'Telefon2' => $_POST["Telefon2"],
                                        'Email1' => $_POST["Email1"],
                                        'Email2' => $_POST["Email2"],
                                        'Adres1' => $_POST["Adres1"],
                                        'Whatsapp' => $_POST["Whatsapp"],
                                        'Adres2' => $_POST["Adres2"],
                                        'GoogleMaps' => $_POST["GoogleMaps"],

                                    ]);
                                    echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                    echo "<script> Swal.fire({title:'Başarılı!', text:'Bilgileriniz Güncellendi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='iletisim.php'}})</script>";

                                }
                                ?>
                                <h4 class="header-title">İletişim Ayarları</h4>
                                <p class="card-title-desc">İletişim Bilgilerinizi Giriniz </p>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-solid fa-phone"></i>
                                                <label class="mb-1">Telefon 1</label>
                                                <input type="text" class="form-control" maxlength="11" name="Telefon1" id="defaultconfig" value="<?= $sonuc["Telefon1"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;"  class="fa-solid fa-envelope"></i>
                                                <label class="mb-1">Email 1</label>
                                                <input type="text" class="form-control" maxlength="50" name="Email1" id="defaultconfig" value="<?= $sonuc["Email1"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-whatsapp"></i>
                                                <label class="mb-1">Whatsapp</label>
                                                <input type="text" class="form-control" maxlength="11" name="Whatsapp" id="defaultconfig" value="<?= $sonuc["Whatsapp"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-sharp fa-solid fa-location-dot"></i>
                                                <label class="mb-1">Adres 1</label>
                                                <textarea id="textarea" class="form-control" name="Adres1" maxlength="250" rows="3" ><?= $sonuc["Adres1"] ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-solid fa-phone"></i>
                                                <label class="mb-1">Telefon 2</label>
                                                <input type="text" class="form-control" maxlength="11" name="Telefon2" id="defaultconfig" value="<?= $sonuc["Telefon2"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;"  class="fa-solid fa-envelope"></i>
                                                <label class="mb-1">Email 2</label>
                                                <input type="text" class="form-control" maxlength="50" name="Email2" id="defaultconfig" value="<?= $sonuc["Email2"] ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-brands fa-dribbble-square"></i>
                                                <label class="mb-1">Google Maps Link</label>
                                                <input type="text" class="form-control" maxlength="250" name="GoogleMaps" id="defaultconfig" value="<?php echo htmlspecialchars($sonuc['GoogleMaps']); ?>">
                                            </div>
                                            <div class="mt-3">
                                                <i style="font-size: 20px;" class="fa-sharp fa-solid fa-location-dot"></i>
                                                <label class="mb-1">Adres 2</label>
                                                <textarea id="textarea" class="form-control" name="Adres2" maxlength="250" rows="3" ><?= $sonuc["Adres2"] ?></textarea>
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