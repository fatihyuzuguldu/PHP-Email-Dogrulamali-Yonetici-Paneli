<?php include "header.php"; ?>
    <div class="main-content">

        <div class="page-content">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Ürün Ekle</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Ürün Ekle</li>
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
                                    if ($_POST) {
                                        $SeoTitle = $_POST["UrunIsim"];
                                        $date = date('Y-m-d H:i:s');
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
                                                    $ayar_kaydi = $baglanti->query("SELECT * FROM urunler ")->fetch(PDO::FETCH_ASSOC);
                                                    if ($ayar_kaydi['UrunResim'] != "resim-yok") {
                                                        unlink("images/urunler/" . $ayar_kaydi['UrunResim']);
                                                    }
                                                    $random = rand(0, 995959999);
                                                    $UrunResim = $random . "-" . $seo . "." . substr($_FILES['UrunResim']['name'], -3);
                                                    move_uploaded_file($_FILES['UrunResim']['tmp_name'], $klasor . "/" . $UrunResim);
                                                    $guncelleSorgu = $baglanti->prepare("Insert Into urunler set UrunAciklama=:UrunAciklama, UrunFiyat=:UrunFiyat, UrunOnAciklama=:UrunOnAciklama, UrunIsim=:UrunIsim, UrunEklenmeTarihi=:UrunEklenmeTarihi, UrunSira=:UrunSira, UrunResim=:UrunResim, UrunSeo=:UrunSeo, UrunKategoriId=:UrunKategoriId");
                                                    $guncelle = $guncelleSorgu->execute([
                                                        'UrunIsim' => $_POST["UrunIsim"],
                                                        'UrunOnAciklama' => $_POST["UrunOnAciklama"],
                                                        'UrunFiyat' => $_POST["UrunFiyat"],
                                                        'UrunAciklama' => $_POST["UrunAciklama"],
                                                        'UrunEklenmeTarihi' => $date,
                                                        'UrunSira' => $_POST["UrunSira"],
                                                        'UrunKategoriId' => $_POST["UrunKategoriId"],
                                                        'UrunResim' => $UrunResim,
                                                        'UrunSeo' =>$seo
                                                        ]);
                                                    echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                                    echo "<script> Swal.fire({title:'Başarılı!', text:'Ürün Eklendi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='urun.php'}})</script>";
                                                }
                                    }
                                    ?>
                                    <h4 class="header-title">Kategori Ekle</h4>
                                    <p class="card-title-desc">Lütfen boş alan bırakmayın.</p>
                                    <form method="post" enctype="multipart/form-data" >
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Ürün Isim</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="UrunIsim" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Sıra</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="UrunSira" value="1" required>
                                        </div>
                                    </div>
                                        <div class="row mb-3">
                                            <label for="example-search-input" class="col-sm-2 col-form-label">Urun Kategori</label>
                                            <div class="col-sm-10">

                                                <select  name="UrunKategoriId" class="form-select" aria-label="Default select example" required>
                                                    <?php
                                                    $sorgu = $baglanti->query("select * from kategori;", PDO::FETCH_ASSOC);
                                                    if ($sorgu->rowCount()) {
                                                        foreach ($sorgu as $sonuc) {
                                                            ?>
                                                    <option value="<?= $sonuc["id"] ?>"><?= $sonuc["KategoriAd"] ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Ön Açıklama</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="UrunOnAciklama" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Fiyat</label>
                                            <div class="col-sm-10">
                                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-btn input-group-prepend"></span><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend"><span class="input-group-text">₺</span></span><input id="demo2" type="text" value="0" name="UrunFiyat" class="form-control" required><span class="input-group-btn input-group-append"></span></div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Açıklama</label>
                                            <div class="col-sm-10">
                                                <textarea name="UrunAciklama" id="textarea" class="form-control" maxlength="500" rows="3"></textarea>
                                            </div>
                                        </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Ürün Resim</label>
                                        <div class="col-sm-5">
                                            <input name="UrunResim" type="file" class="form-control" id="formFile" required>
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