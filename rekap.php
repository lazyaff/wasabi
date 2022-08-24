<?php

require 'function.php';
$data = query("SELECT *, round(sum(nil*(bob/100))) as nilai FROM `mk` group by nama_mk order by nama_mk");
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
    <title>Wasabi | Rekapitulasi</title>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="rekap.php">
                            <i class="bi bi-pie-chart"></i>
                            <p>Rekapitulasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
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
                <h1 class="navbar-brand"> Rekapitulasi </h1>
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
                    <div class="row">
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
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-striped text-center">
                                        <thead>
                                            <th>No.</th>
                                            <th>Mata Kuliah</th>
                                            <th>SKS</th>
                                            <th>Nilai</th>
                                            <th>Nilai Huruf</th>
                                            <th>Nilai Angka</th>
                                            <th>Nilai Mutu</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $i = 1;
                                                $sum_mutu = 0; 
                                                $sum_sks = 0; 
                                            ?>
                                            <?php foreach ($data as $row) : ?>
                                                <?php 
                                                    if ($row["nilai"] >= 80) {
                                                        $n_huruf = "A";
                                                        $n_angka = 4;
                                                    } elseif ($row["nilai"] >= 76 && $row["nilai"] < 80) {
                                                        $n_huruf = "AB";
                                                        $n_angka = 3.5;
                                                    } elseif ($row["nilai"] >= 70 && $row["nilai"] < 76) {
                                                        $n_huruf = "B";
                                                        $n_angka = 3;
                                                    } elseif ($row["nilai"] >= 66 && $row["nilai"] < 70) {
                                                        $n_huruf = "BC";
                                                        $n_angka = 2.5;
                                                    } elseif ($row["nilai"] >= 60 && $row["nilai"] < 66) {
                                                        $n_huruf = "C";
                                                        $n_angka = 2;
                                                    } elseif ($row["nilai"] >= 56 && $row["nilai"] < 60) {
                                                        $n_huruf = "CD";
                                                        $n_angka = 1.5;
                                                    } elseif ($row["nilai"] >= 50 && $row["nilai"] < 56) {
                                                        $n_huruf = "D";
                                                        $n_angka = 1;
                                                    } else {
                                                        $n_huruf = "E";
                                                        $n_angka = 0.5;
                                                    }

                                                    $n_mutu = $n_angka*$row["sks"];
                                                    $sum_mutu += $n_mutu;
                                                    $sum_sks += $row["sks"];
                                                ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td style="text-align: left;"><?= $row["nama_mk"] ?></td>
                                                    <td><?= $row["sks"] ?></td>
                                                    <td><?= $row["nilai"] ?></td>
                                                    <td><?= $n_huruf ?></td>
                                                    <td><?= $n_angka ?></td>
                                                    <td><?= $n_mutu ?></td>
                                                </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="6" style="text-align: center; font-weight:bold;">Total Nilai Mutu</td>
                                                <td><?= $sum_mutu ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: center; font-weight:bold;">Total SKS</td>
                                                <td><?= $sum_sks ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: center; font-weight:bold;">
                                                    <?php  
                                                        if (isset($_POST["filter"]) == false || $_POST["filt"] == 0) {
                                                            echo "Indeks Prestasi Kumulatif";
                                                        } else {
                                                            echo "Indeks Prestasi";
                                                        }
                                                    ?>
                                                </td>
                                                <td><?= $sum_mutu/$sum_sks ?></td>
                                            </tr>
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

    <!--   JS Files   -->
    <script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
</body>


</html>