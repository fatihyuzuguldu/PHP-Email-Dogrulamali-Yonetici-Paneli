<?php include "header.php"; ?>
    <div class="main-content">

        <div class="page-content">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Ekibimiz</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Ekibimiz Ekle</li>
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

                                        $SeoTitle = $_POST["TeamName"];
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
                                        $klasor = "images/ourteams/";
                                        $resim_tmp = $_FILES['TeamImage']['tmp_name'];
                                                if ($_FILES["TeamImage"]["type"] == "image/gif" || $_FILES["TeamImage"]["type"] == "image/png" || $_FILES["TeamImage"]["type"] == "image/jpg" || $_FILES["TeamImage"]["type"] == "image/jpeg") {
                                                    $ayar_kaydi = $baglanti->query("SELECT * FROM ourteams ")->fetch(PDO::FETCH_ASSOC);
                                                    if ($ayar_kaydi['TeamImage'] != "resim-yok") {
                                                        unlink("images/ourteams/" . $ayar_kaydi['TeamImage']);
                                                    }
                                                    $random = rand(0, 995959999);
                                                    $TeamImage = $random . "-" . $seo . "." . substr($_FILES['TeamImage']['name'], -3);
                                                    move_uploaded_file($_FILES['TeamImage']['tmp_name'], $klasor . "/" . $TeamImage);
                                                    $guncelleSorgu = $baglanti->prepare("Insert Into ourteams set TeamImage=:TeamImage, TeamName=:TeamName, TeamDescription=:TeamDescription, TeamRow=:TeamRow");
                                                    $guncelle = $guncelleSorgu->execute([
                                                        'TeamName' => $_POST["TeamName"],
                                                        'TeamDescription' => $_POST["TeamDescription"],
                                                        'TeamRow' => $_POST["TeamRow"],
                                                        'TeamImage' => $TeamImage
                                                    ]);
                                                    echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                                    echo "<script> Swal.fire({title:'Başarılı!', text:'Bilgileriniz Güncellendi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='ekibimiz.php'}})</script>";

                                                }
                                    }
                                    ?>
                                    <h4 class="header-title">Site Yönetimi</h4>
                                    <p class="card-title-desc">Lütfen boş alan bırakmayın.</p>
                                    <form method="post" enctype="multipart/form-data" >
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Team Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="TeamName" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Team Description</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="TeamDescription" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Team Row</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="TeamRow" value="1" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-search-input" class="col-sm-2 col-form-label">Site TeamImage</label>
                                        <div class="col-sm-5">
                                            <input name="TeamImage" type="file" class="form-control" id="formFile" required>
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