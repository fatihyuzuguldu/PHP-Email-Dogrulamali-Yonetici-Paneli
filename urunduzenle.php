<?php
include "header.php";
$idc = $_GET["id"];
$sorgu = $baglanti->prepare("SELECT COUNT(*) as sayi FROM urunler WHERE id ='$idc'");
$sorgu->execute();
$sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
if ($sonuc["sayi"] == 0) {
    header("Location: index.php");
}
else {
    $sorgu=$baglanti->prepare("select * from urunler where id=:id");
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
                                <h4>Ürün</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Ürün Düzenle</li>
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

                                        $SeoTitle = $_POST["UrunIsim"];
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
                                        $klasor = "images/urunler/";
                                        $resim_tmp = $_FILES['UrunResim']['tmp_name'];
                                                if ($_FILES["UrunResim"]["type"] == "image/gif" || $_FILES["UrunResim"]["type"] == "image/png" || $_FILES["UrunResim"]["type"] == "image/jpg" || $_FILES["UrunResim"]["type"] == "image/jpeg") {
                                                    $sorgu=$baglanti->prepare("select * from urunler where id=:id");
                                                    $sorgu->bindParam(':id', $idc, PDO::PARAM_STR);
                                                    $sorgu->execute();
                                                    $ayar_kaydi=$sorgu->fetch(PDO::FETCH_ASSOC);
                                                    if ($ayar_kaydi['UrunResim'] != "resim-yok") {
                                                        unlink("images/urunler/" . $ayar_kaydi['UrunResim']);
                                                    }
                                                    $random = rand(0, 995959999);
                                                    $UrunResim = $random . "-" . $seo . "." . substr($_FILES['UrunResim']['name'], -3);
                                                    move_uploaded_file($_FILES['UrunResim']['tmp_name'], $klasor . "/" . $UrunResim);
                                                    $date = date('Y-m-d H:i:s');
                                                    $guncelleSorgu = $baglanti->prepare("UPDATE urunler set UrunAciklama=:UrunAciklama, UrunFiyat=:UrunFiyat, UrunGuncellemeTarihi=:UrunGuncellemeTarihi, UrunSeo=:UrunSeo, UrunOnAciklama=:UrunOnAciklama, UrunKategoriId=:UrunKategoriId, UrunResim=:UrunResim, UrunIsim=:UrunIsim, UrunSira=:UrunSira where id=:id");
                                                    $guncelleSorgu->bindParam(':id', $idc, PDO::PARAM_STR);
                                                    $guncelle = $guncelleSorgu->execute([
                                                        'UrunIsim' => $_POST["UrunIsim"],
                                                        'UrunSira' => $_POST["UrunSira"],
                                                        'UrunKategoriId' => $_POST["UrunKategoriId"],
                                                        'UrunOnAciklama' => $_POST["UrunOnAciklama"],
                                                        'UrunFiyat' => $_POST["UrunFiyat"],
                                                        'UrunAciklama' => $_POST["UrunAciklama"],
                                                        'UrunGuncellemeTarihi' => $date,
                                                        'UrunSeo' => $seo,
                                                        'UrunResim' => $UrunResim,
                                                        'id' => $idc

                                                    ]);
                                                    echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                                    echo "<script> Swal.fire({title:'Başarılı!', text:'Bilgileriniz Güncellendi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='urun.php'}})</script>";

                                                }
                                    }
                                    ?>
                                    <h4 class="header-title">Site Yönetimi</h4>
                                    <p class="card-title-desc">Lütfen boş alan bırakmayın.</p>
                                    <form method="post" enctype="multipart/form-data" >
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Ürün İsim</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="text" name="UrunIsim" value="<?= $sonuc["UrunIsim"] ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Sıra / Ürün Durum</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="number" id="example-number-input" name="UrunSira" value="<?= $sonuc["UrunSira"] ?>" required>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="checkbox" id="switch3" switch="bool" checked />
                                            <label for="switch3" data-on-label="Aktif" data-off-label="Kapalı"></label>
                                        </div>
                                    </div>
                                        <div class="row mb-3">
                                            <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Fiyat</label>
                                            <div class="col-sm-5">
                                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-btn input-group-prepend"></span><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend"><span class="input-group-text">₺</span></span><input id="demo2" type="text" value="<?= $sonuc["UrunFiyat"] ?>" name="UrunFiyat" class="form-control" required><span class="input-group-btn input-group-append"></span></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Ön Açıklama</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" type="text" name="UrunOnAciklama" value="<?= $sonuc["UrunOnAciklama"] ?>" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Kategori</label>
                                            <div class="col-sm-5">

                                                <select  name="UrunKategoriId" class="form-select" aria-label="Default select example" required>
                                                    <?php
                                                    $sorgu = $baglanti->query("select * from kategori;", PDO::FETCH_ASSOC);
                                                    if ($sorgu->rowCount()) {
                                                        foreach ($sorgu as $kats) {
                                                            ?>
                                                            <option value="<?= $kats["id"] ?>"><?= $kats["KategoriAd"] ?></option>
                                                        <?php }
                                                    } ?>
                                                </select>

                                            </div>
                                        </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Resim</label>
                                        <div class="col-sm-5">
                                            <input name="UrunResim" type="file" class="form-control" id="formFile" required>
                                        </div>
                                        <div class="col-sm-5">
                                            <img src="images/urunler/<?= $sonuc["UrunResim"] ?>"  width="60">
                                        </div>

                                    </div>
                                        <div class="row mb-3">
                                            <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Açıklama</label>
                                            <div class="col-sm-5">
                                            <textarea id="textarea" name="UrunAciklama" class="form-control" maxlength="500" rows="3" placeholder="This textarea has a limit of 225 chars."><?= $sonuc["UrunAciklama"] ?></textarea>
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