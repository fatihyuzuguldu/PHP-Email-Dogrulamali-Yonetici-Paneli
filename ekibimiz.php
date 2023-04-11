<?php include "header.php"; ?>

    <div class="main-content">

        <div class="page-content">

            <!-- start page title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h4>Ekibimiz Listesi</h4>
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Anasayfa</a></li>
                                    <li class="breadcrumb-item active">Ekibimiz Listesi</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-end d-none d-sm-block">
                                <a href="ekipekle.php" class="btn btn-success">Ekip Ekle</a>
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

                                    <h4 class="header-title">Buttons example</h4>
                                    <p class="card-title-desc">The Buttons extension for DataTables
                                        provides a common set of options, API methods and styling to display
                                        buttons on a page that will interact with a DataTable. The core library
                                        provides the based framework upon which plug-ins can built.
                                    </p>
                                    <?php
                                    if ($_GET){
                                        if ($baglanti->query("DELETE FROM ourteams WHERE id =".(int)$_GET['id'])){
                                            echo '<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>';
                                            echo "<script> Swal.fire({title:'Başarılı!', text:'Ekip Üyesi Silindi', icon:'success', confirmButtonText:'Kapat'}).then((value) => {if (value.isConfirmed){window.location.href='ekibimiz.php'}})</script>";


                                        }
                                    }
                                    ?>
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Resim</th>
                                            <th>İsim</th>
                                            <th>Açıklama</th>
                                            <th></th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <?php
                                         $sorgu = $baglanti->query("select * from ourteams order by TeamRow asc;", PDO::FETCH_ASSOC);
                                         if ($sorgu->rowCount()) {
                                             foreach ($sorgu as $sonuc) {
                                                            ?>
                                        <tr>
                                            <td style="text-align: center;"><img style="max-width: 50px;" src="images/ourteams/<?= $sonuc["TeamImage"] ?>"></td>
                                            <td><?= $sonuc["TeamName"] ?></td>
                                            <td><?= $sonuc["TeamDescription"] ?></td>
                                            <td style="text-align: center;"><a href="ekibimiz.php?id=<?= $sonuc["id"] ?>"><i class="fa-sharp fa-solid fa-circle-xmark fa-2xl" style=" color: #c20000;"></i> </a> </td>

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