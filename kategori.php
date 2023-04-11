<?php include "header.php"; ?>

    <div class="main-content">

        <div class="page-content">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Kategori Listesi</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Kategori Listesi</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-end d-none d-sm-block">
                                <a href="kategoriekle.php" class="btn btn-success">Kategori Ekle</a>
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

                                    <h4 class="header-title">Kategori Yönetimi</h4>
                                    <?php
                                    if ($_GET){
                                        $sid = $_GET['id'];
                                        $guncelleSorgu = $baglanti->prepare("UPDATE kategori set KategoriDurum=:KategoriDurum where id=:id");
                                        $guncelleSorgu->bindParam(':id', $sid, PDO::PARAM_STR);
                                        $guncelle = $guncelleSorgu->execute([
                                            'KategoriDurum' => "2",
                                            'id' => $sid
                                        ]);
                                        echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                        echo "<script> Swal.fire({title:'Başarılı!', text:'Kategori Gizlendi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='kategori.php'}})</script>";
                                    }
                                    ?>
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Resim</th>
                                            <th>Kategori Adı</th>
                                            <th>Kategori Durumu</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                         $sorgu = $baglanti->query("select * from kategori order by KategoriSira asc ;", PDO::FETCH_ASSOC);
                                         if ($sorgu->rowCount()) {
                                             foreach ($sorgu as $sonuc) {
                                                            ?>
                                        <tr>
                                            <td style="text-align: center;"><img style="max-width: 50px;" src="images/kategori/<?= $sonuc["KategoriResim"] ?>"></td>
                                            <td><?= $sonuc["KategoriAd"] ?></td>
                                            <td><?php if($sonuc['KategoriDurum'] == 1){ echo "Aktif";} else{echo "Devre Dışı";} ?></td>
                                            <td style="text-align: center;"><a href="kategori.php?id=<?= $sonuc["id"] ?>"><i class="fa-sharp fa-solid fa-circle-xmark fa-2xl" style=" color: #c20000;"></i> </a>
                                                <a href="kategoriduzenle.php?id=<?= $sonuc["id"] ?>"><i class="fa-solid fa-pen-to-square fa-2xl" style="color: #0b8802;"></i> </a></td>

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