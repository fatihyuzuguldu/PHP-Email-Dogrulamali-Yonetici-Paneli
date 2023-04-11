<?php include "header.php"; ?>

    <div class="main-content">

        <div class="page-content">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Ürün Listesi</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Ürün Listesi</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-end d-none d-sm-block">
                                <a href="urunekle.php" class="btn btn-success">Ürün Ekle</a>
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

                                    <h4 class="header-title">Ürün Yönetimi</h4>
                                    <?php
                                    if ($_GET){
                                        if ($baglanti->query("DELETE FROM urunler WHERE id =".(int)$_GET['id'])){
                                            echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                            echo "<script> Swal.fire({title:'Başarılı!', text:'Ürün Silindi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='urun.php'}})</script>";
                                        }
                                    }
                                    ?>
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Resim</th>
                                            <th>Ürün Adı</th>
                                            <th>Ön Açıklama</th>
                                            <th>Durumu</th>
                                            <th>Kategori</th>
                                            <th>Fiyat</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                         $sorgu = $baglanti->query("select * from urunler order by UrunSira asc ;", PDO::FETCH_ASSOC);
                                         if ($sorgu->rowCount()) {
                                             foreach ($sorgu as $sonuc) {
                                                            ?>
                                        <tr>

                                            <td style="text-align: center;"><img style="max-width: 50px;" src="images/urunler/<?= $sonuc["UrunResim"] ?>"></td>
                                            <td><?= $sonuc["UrunIsim"] ?></td>
                                            <td><?= $sonuc["UrunOnAciklama"] ?></td>
                                            <td><?php $did = $sonuc["UrunKategoriId"]; $sorgu=$baglanti->prepare("select * from kategori where id='$did'");$sorgu->execute();$kategor=$sorgu->fetch(PDO::FETCH_ASSOC); if($sonuc['UrunDurum'] & $kategor["KategoriDurum"] == 1){ echo "Aktif";} else{echo "Devre Dışı";} ?></td>
                                            <td><?php  echo $kategor['KategoriAd'] ?></td>
                                            <td><?php $fiyat = filter_var( $sonuc["UrunFiyat"] , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); echo $fiyat;?> TL</td>
                                            <td style="text-align: center;"><a href="urun.php?id=<?= $sonuc["id"] ?>"><i class="fa-sharp fa-solid fa-circle-xmark fa-2xl" style=" color: #c20000;"></i> </a>
                                                <a href="urunduzenle.php?id=<?= $sonuc["id"] ?>"><i class="fa-solid fa-pen-to-square fa-2xl" style="color: #0b8802;"></i> </a></td>

                                        </tr>

                                        </tbody>
                                        <?php }
                                        } ?>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                </div>


            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->




<?php include "footer.php"; ?>