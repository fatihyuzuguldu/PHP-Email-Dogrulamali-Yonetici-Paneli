<?php include "header.php"; ?>
    <div class="main-content">

        <div class="page-content">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Kategori Ekle</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Kategori Ekle</li>
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
                                        $SeoTitle = $_POST["KategoriAd"];
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
                                        $klasor = "images/kategori/";
                                        $resim_tmp = $_FILES['KategoriResim']['tmp_name'];
                                                if ($_FILES["KategoriResim"]["type"] == "image/gif" || $_FILES["KategoriResim"]["type"] == "image/png" || $_FILES["KategoriResim"]["type"] == "image/jpg" || $_FILES["KategoriResim"]["type"] == "image/jpeg") {
                                                    $ayar_kaydi = $baglanti->query("SELECT * FROM kategori ")->fetch(PDO::FETCH_ASSOC);
                                                    if ($ayar_kaydi['KategoriResim'] != "resim-yok") {
                                                        unlink("images/kategori/" . $ayar_kaydi['KategoriResim']);
                                                    }
                                                    $random = rand(0, 995959999);
                                                    $KategoriResim = $random . "-" . $seo . "." . substr($_FILES['KategoriResim']['name'], -3);
                                                    move_uploaded_file($_FILES['KategoriResim']['tmp_name'], $klasor . "/" . $KategoriResim);
                                                    $guncelleSorgu = $baglanti->prepare("Insert Into kategori set KategoriAd=:KategoriAd, KategoriEklenme=:KategoriEklenme, KategoriSira=:KategoriSira, KategoriResim=:KategoriResim, KategoriSeo=:KategoriSeo");
                                                    $guncelle = $guncelleSorgu->execute([
                                                        'KategoriAd' => $_POST["KategoriAd"],
                                                        'KategoriEklenme' => $date,
                                                        'KategoriSira' => $_POST["KategoriSira"],
                                                        'KategoriResim' => $KategoriResim,
                                                        'KategoriSeo' =>$seo
                                                        ]);
                                                    echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                                    echo "<script> Swal.fire({title:'Başarılı!', text:'Kategori Eklendi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='kategori.php'}})</script>";
                                                }
                                    }
                                    ?>
                                    <h4 class="header-title">Kategori Ekle</h4>
                                    <p class="card-title-desc">Lütfen boş alan bırakmayın.</p>
                                    <form method="post" enctype="multipart/form-data" >
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Kategori Ad</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="KategoriAd" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Kategori Sıra</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="KategoriSira" value="1" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Kategori Resim</label>
                                        <div class="col-sm-5">
                                            <input name="KategoriResim" type="file" class="form-control" id="formFile" required>
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