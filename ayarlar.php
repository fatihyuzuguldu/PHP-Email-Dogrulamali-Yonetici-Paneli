<?php include "header.php"; ?>
    <div class="main-content">

        <div class="page-content">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Site Yönetimi</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Site Ayarları</li>
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
                                    $idc = "52d77346-a083-42a4-87f0-9bf7943b6126";
                                    $sorgu=$baglanti->prepare("select * from ayarlar where id=:id");
                                    $sorgu->bindParam(':id', $idc, PDO::PARAM_STR);
                                    $sorgu->execute();
                                    $sonuc=$sorgu->fetch(PDO::FETCH_ASSOC);
                                    if ($_POST) {
                                        $SiteTitle = $_POST["SiteTitle"];
                                        function seflink($string)
                                        {
                                            $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
                                            $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
                                            $string = strtolower(str_replace($find, $replace, $string));
                                            $string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
                                            $string = trim(preg_replace('/\s+/', ' ', $string));
                                            $string = str_replace(' ', '-', $string);
                                            return $string;
                                        }

                                        $seo = seflink($SiteTitle);
                                        $klasor = "images/";
                                        $resim_tmp = $_FILES['logo']['tmp_name'];
                                            if (empty($resim_tmp)) {
                                                $guncelleSorgu = $baglanti->prepare("UPDATE ayarlar set SiteTitle=:SiteTitle, SiteDescription=:SiteDescription, SiteKeyword=:SiteKeyword, SiteMeta=:SiteMeta, SiteAuthor=:SiteAuthor, SiteCopyright=:SiteCopyright");
                                               $guncelle = $guncelleSorgu->execute([
                                                    'SiteTitle' => $_POST["SiteTitle"],
                                                    'SiteDescription' => $_POST["SiteDescription"],
                                                    'SiteKeyword' => $_POST["SiteKeyword"],
                                                    'SiteMeta' => $_POST["SiteMeta"],
                                                    'SiteAuthor' => $_POST["SiteAuthor"],
                                                    'SiteCopyright' => $_POST["SiteCopyright"],
                                                ]);
                                                echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                                echo "<script> Swal.fire({title:'Başarılı!', text:'Bilgileriniz Güncellendi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='ayarlar.php'}})</script>";

                                            } else {
                                                if ($_FILES["logo"]["type"] == "image/gif" || $_FILES["logo"]["type"] == "image/png" || $_FILES["logo"]["type"] == "image/jpg" || $_FILES["logo"]["type"] == "image/jpeg") {
                                                    $ayar_kaydi = $baglanti->query("SELECT * FROM ayarlar WHERE id ='$idc'")->fetch(PDO::FETCH_ASSOC);
                                                    if ($ayar_kaydi['logo'] != "resim-yok") {
                                                        unlink("images/" . $ayar_kaydi['logo']);
                                                    }
                                                    $random = rand(0, 995959999);
                                                    $logo = $random . "-" . $seo . "." . substr($_FILES['logo']['name'], -3);
                                                    move_uploaded_file($_FILES['logo']['tmp_name'], $klasor . "/" . $logo);
                                                    $guncelleSorgu = $baglanti->prepare("UPDATE ayarlar set logo=:logo, SiteTitle=:SiteTitle, SiteDescription=:SiteDescription, SiteKeyword=:SiteKeyword, SiteMeta=:SiteMeta, SiteAuthor=:SiteAuthor, SiteFavicon=:SiteFavicon, SiteCopyright=:SiteCopyright");
                                                    $guncelle = $guncelleSorgu->execute([
                                                        'SiteTitle' => $_POST["SiteTitle"],
                                                        'SiteDescription' => $_POST["SiteDescription"],
                                                        'SiteKeyword' => $_POST["SiteKeyword"],
                                                        'SiteMeta' => $_POST["SiteMeta"],
                                                        'SiteAuthor' => $_POST["SiteAuthor"],
                                                        'SiteCopyright' => $_POST["SiteCopyright"],
                                                        'logo' => $logo,
                                                        'SiteFavicon' => $logo,

                                                    ]);
                                                    echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                                    echo "<script> Swal.fire({title:'Başarılı!', text:'Bilgileriniz Güncellendi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='ayarlar.php'}})</script>";

                                                }
                                            }
                                    }
                                    ?>
                                    <h4 class="header-title">Site Yönetimi</h4>
                                    <p class="card-title-desc">Lütfen boş alan bırakmayın.</p>
                                    <form method="post" enctype="multipart/form-data" >
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Site Title</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="SiteTitle" value="<?= $sonuc["SiteTitle"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Site Description</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="SiteDescription" value="<?= $sonuc["SiteDescription"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Site Keyword</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="SiteKeyword" value="<?= $sonuc["SiteKeyword"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Site Meta</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="SiteMeta" value="<?= $sonuc["SiteMeta"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Site Author</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="SiteAuthor" value="<?= $sonuc["SiteAuthor"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Site Copyright</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="SiteCopyright" value="<?= $sonuc["SiteCopyright"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Site Logo</label>
                                        <div class="col-sm-5">
                                            <input name="logo" type="file" class="form-control" id="formFile">
                                        </div>
                                        <div class="col-sm-5">
                                            <img src="images/<?=$sonuc['logo']?>" width="100">
                                        </div>
                                    </div>
                                        <div class="row mb-3">
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