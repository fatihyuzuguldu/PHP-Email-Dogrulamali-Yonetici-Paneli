<?php
include "header.php";
$idc = $_GET["id"];
$sorgu = $baglanti->prepare("SELECT COUNT(*) as sayi FROM kategori WHERE id ='$idc'");
$sorgu->execute();
$sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
if ($sonuc["sayi"] == 0) {
    header("Location: index.php");
}
else {
    $sorgu=$baglanti->prepare("select * from kategori where id=:id");
    $sorgu->bindParam(':id', $idc, PDO::PARAM_STR);
    $sorgu->execute();
    $sonuc=$sorgu->fetch(PDO::FETCH_ASSOC);
}

?>
    <div class="main-content">

        <div class="page-content">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Kategori</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Kategori Düzenle</li>
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
                                    if ($_POST) {

                                        $SeoTitle = $_POST["KategoriAd"];
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

                                        $seo = seflink($SeoTitle);
                                        $klasor = "images/kategori/";
                                        $resim_tmp = $_FILES['KategoriResim']['tmp_name'];
                                                if ($_FILES["KategoriResim"]["type"] == "image/gif" || $_FILES["KategoriResim"]["type"] == "image/png" || $_FILES["KategoriResim"]["type"] == "image/jpg" || $_FILES["KategoriResim"]["type"] == "image/jpeg") {
                                                    $sorgu=$baglanti->prepare("select * from kategori where id=:id");
                                                    $sorgu->bindParam(':id', $idc, PDO::PARAM_STR);
                                                    $sorgu->execute();
                                                    $ayar_kaydi=$sorgu->fetch(PDO::FETCH_ASSOC);
                                                    if ($ayar_kaydi['KategoriResim'] != "resim-yok") {
                                                        unlink("images/kategori/" . $ayar_kaydi['KategoriResim']);
                                                    }
                                                    $random = rand(0, 995959999);
                                                    $KategoriResim = $random . "-" . $seo . "." . substr($_FILES['KategoriResim']['name'], -3);
                                                    move_uploaded_file($_FILES['KategoriResim']['tmp_name'], $klasor . "/" . $KategoriResim);
                                                    $guncelleSorgu = $baglanti->prepare("UPDATE kategori set KategoriResim=:KategoriResim, KategoriAd=:KategoriAd, KategoriSira=:KategoriSira where id=:id");
                                                    $guncelleSorgu->bindParam(':id', $idc, PDO::PARAM_STR);
                                                    $guncelle = $guncelleSorgu->execute([
                                                        'KategoriAd' => $_POST["KategoriAd"],
                                                        'KategoriSira' => $_POST["KategoriSira"],
                                                        'KategoriResim' => $KategoriResim,
                                                        'id' => $idc

                                                    ]);

                                                    echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                                    echo "<script> Swal.fire({title:'Başarılı!', text:'Bilgileriniz Güncellendi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='kategori.php'}})</script>";

                                                }
                                    }
                                    ?>
                                    <h4 class="header-title">Site Yönetimi</h4>
                                    <p class="card-title-desc">Lütfen boş alan bırakmayın.</p>
                                    <form method="post" enctype="multipart/form-data" >
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Kategori Ad</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="text" name="KategoriAd" value="<?= $sonuc["KategoriAd"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Kategori Sıra / Kategori Durum</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="number" id="example-number-input" name="KategoriSira" value="<?= $sonuc["KategoriSira"] ?>" required>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="checkbox" id="switch3" switch="bool" checked />
                                            <label for="switch3" data-on-label="Aktif" data-off-label="Kapalı"></label>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Kategori Resim</label>
                                        <div class="col-sm-5">
                                            <input name="KategoriResim" type="file" class="form-control" id="formFile" required>
                                        </div>
                                        <div class="col-sm-5">
                                            <img src="images/kategori/<?= $sonuc["KategoriResim"] ?>"  width="60">
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