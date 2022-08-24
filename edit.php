<?php

require 'function.php';
$data = query("SELECT kd_mk, nama_mk, round(sum(nil*(bob/100))) as nilai FROM `mk` group by nama_mk order by nama_mk");
$filter = query("SELECT smt, max(nil) FROM `mk` group by smt order by smt");

if (isset($_POST["filter"])) {
    $data = filter($_POST["filt"]);
}

?>

<html>

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/logo.png">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Wasabi | Perbarui Data</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/main.css?v=2.0.0 " rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/bg.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="index.php" class="simple-text ini-judul" style="text-transform: none; font-size: 50px;">
                        Wasabi
                    </a>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-grid-1x2"></i>
                            <p>Nilai Komponen</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rekap.php">
                            <i class="bi bi-pie-chart"></i>
                            <p>Rekapitulasi</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="edit.php">
                            <i class="bi bi-clipboard-plus"></i>
                            <p>Perbarui Data</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg" color-on-scroll="500">
                <h1 class="navbar-brand"> Perbarui Data </h1>
                <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
            </nav>
            <!-- End Navbar -->
            <!-- Welcome -->
            <style>
                .content-0 {
                    display: none;
                } 
                .content-0 .card { 
                    margin-top: 20px;
                    border: 5px dashed rgba(0,0,0,0.2);
                }
                .content-0 p,h1 {
                    margin: 0px;
                    padding: 3px;
                }
                .content-0 .isi {
                    padding: 120px 0px;
                }
            </style>
            <div class="content-0" id="content-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card text-center tes">
                                <div class="isi">
                                    <p>Selamat datang di</p>
                                    <h1 class="ini-judul">Wasabi</h1>
                                    <p style="margin-bottom: 15px;">Saat ini data masih kosong, silahkan tambah data baru.</p>
                                    <a class="btn btn-wd klik" href="add.php" style="margin: 0px;">Tambah</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Welcome -->
            <?php 
                if ($data == null) {
                    echo "<style>.content { display: none; } .content-0 { display: block; }</style>";
                }
            ?>
            <div class="content">
                <div class="container-fluid">
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 pr-1">
                                    <select id="filt" name="filt" type="text" class="form-control">
                                        <option value="0">Pilih Semester</option>
                                        <?php 
                                            foreach ($filter as $key ) {
                                                echo "<option value=".$key['smt'].">Semester ".$key['smt']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <button style="cursor: pointer;" id="filter" name="filter" type="submit" class="btn btn-wd klik">Proses</button>
                            </div>
                        </div>
                    </form>
                    <div class="row" style="margin-bottom: 20px;">
                        <a class="btn btn-wd klik" href="add.php">
                            Tambah
                        </a>
                    </div>
                    <div class="row sembunyi">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <?php  
                                        if (isset($_POST["filter"]) == false || $_POST["filt"] == 0) {
                                            echo "<h4 class='card-title'>Semua Semester</h4>";
                                        } else {
                                            echo "<h4 class='card-title'>Semester ".$_POST['filt']."</h4>";
                                        }
                                    ?>
                                </div>
                                <div class="tombol">
                                    <a class="btn btn-wd klik" href="#" data-toggle="modal" data-target="#delete">
                                        Hapus
                                    </a>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <th>No.</th>
                                            <th>Mata Kuliah</th>
                                            <th>Nilai</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody class="action">
                                            <tr>
                                            <?php $i = 1; ?>
                                            <?php foreach ($data as $row) : ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?= $row["nama_mk"]; ?></td>
                                                    <td><?= $row["nilai"]; ?></td>
                                                    <td>
                                                        <a href="update.php?kd=<?= $row["kd_mk"]; ?>"><i class="bi bi-pencil-square"> Perbarui</i></a> |
                                                        <a href="#" data-toggle="modal" data-target="#delete<?php echo $i ?>"><i class="bi bi-trash"> Hapus</i></a>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade modal-mini modal-primary" id="delete<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header justify-content-center">
                                                                <div class="modal-profile">
                                                                    <i class="bi bi-x"></i>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <p>Apakah anda yakin ingin menghapus data?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="delete.php?kd=<?= $row["kd_mk"]; ?>" class="btn btn-link btn-simple">Yakin</a>
                                                                <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Batal</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <div class="text-center container">
                    <div class="social-links">
                        <a href="mailto:faizalamri15@gmail.com"><i class="bi bi-envelope"></i></a>
                        <a href="https://www.instagram.com/faizamr_/"><i class="bi bi-instagram"></i></a>
                        <a href="https://github.com/lazyaff"><i class="bi bi-github"></i></a>
                        <a href="https://www.linkedin.com/mwlite/in/faizal-amri-47a2541ba"><i class="bi bi-linkedin"></i></a>
                    </div>
                    <div class="copyright">
                        &copy; 
                        <script>document.write(new Date().getFullYear()) </script> 
                        All rights reserved | <a href="https://github.com/lazyaff">lazyaf</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modal-mini modal-primary" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <div class="modal-profile">
                        <i class="bi bi-x"></i>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <p>Apakah anda yakin ingin menghapus data?</p>
                </div>
                <div class="modal-footer">
                    <?php  
                        if (isset($_POST["filter"]) == false || $_POST["filt"] == 0) {
                            echo "<a href='delete.php?kd=0' class='btn btn-link btn-simple'>Yakin</a>";
                        } else {
                            echo "<a href='delete.php?kd=".$_POST['filt']."' class='btn btn-link btn-simple'>Yakin</a>";
                        }
                    ?>
                    <button type="button" class="btn btn-link btn-simple" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!--   JS Files   -->
    <script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>