<?php

require 'function.php';
if (isset($_POST["save"])) {
    if (add($_POST) > 0) {
        echo "<script> 
                alert('Data berhasil ditambahkan!');
            </script>";
        header("Location: edit.php");
        exit;
    } else {
        echo mysqli_error($conn);
    }
}

?>

<html>

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/logo.png">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Wasabi | Data Mata Kuliah</title>
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
                <h1 class="navbar-brand"> Data Mata Kuliah </h1>
                <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8" style="margin: 0 auto;">
                            <div class="card">
                                <div class="card-body">
                                    <form name="form" method="post" autocomplete="off">
                                        <div class="info">
                                            <div class="judul text-center">
                                                <h4>Informasi Umum</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 pr-1">
                                                    <div class="form-group">
                                                        <label>Semester</label>
                                                        <input id="smt" name="smt" required type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pl-1">
                                                    <div class="form-group">
                                                        <label>SKS</label>
                                                        <input id="sks" name="sks" required type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 pr-3">
                                                    <div class="form-group">
                                                        <label>Mata Kuliah</label>
                                                        <input id="nama_mk" name="nama_mk" required type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nilai">
                                            <div class="judul text-center">
                                                <h4>Nilai Komponen</h4>
                                            </div>
                                            <div class="SET row input_field">
                                                <div class="col-md-7 pr-1">
                                                    <div class="form-group">
                                                        <label>Komponen Penilaian</label>
                                                        <input id="komp-1" name="komp-1" required type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pl-1">
                                                    <div class="form-group">
                                                        <label>Bobot</label>
                                                        <input id="bob-1" name="bob-1" required type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pl-1">
                                                    <div class="form-group">
                                                        <label>Nilai</label>
                                                        <input id="nil-1" name="nil-1" required type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-1 pl-1">
                                                    <label style="color:white;">d</label>
                                                    <a href="#" class="DEL form-control cross">x</a>
                                                </div>
                                            </div>
                                            <div id="setB"></div>
                                        </div>
                                        <button type="submit" class="btn btn-wd klik pull-right" id="save" name="save">Simpan</button>
                                        <button id="ADD" class="ADD btn btn-wd klik pull-right">Tambah</button>
                                        <div class="clearfix"></div>
                                    </form>
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
                    <button type="button" class="btn btn-link btn-simple">Yakin</button>
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
    <script>
        let num = 2;
        //ADD button
        $('#ADD').on('click', function(e) {
            var str = `<div class='SET row input_field'> <div class='col-md-7 pr-1'> <div class='form-group'> <label>Komponen Penilaian</label> <input id='komp-${num}' name='komp-${num}' required type='text' class='form-control'> </div> </div> <div class='col-md-2 pl-1'> <div class='form-group'> <label>Bobot</label> <input id='bob-${num}' name='bob-${num}' required type='text' class='form-control'> </div> </div> <div class='col-md-2 pl-1'> <div class='form-group'> <label>Nilai</label> <input id='nil-${num}' name='nil-${num}' required type='text' class='form-control'> </div> </div> <div class='col-md-1 pl-1'> <label style='color:white;'>d</label> <a href='#' class='DEL form-control cross'>x</a> </div> </div>`;
            $('#setB').append(str);
            $('.DEL').on('click', DEL);
            num++;
        }); 
        //DEL button
        $('.DEL').on('click', DEL);
        function DEL(e) {
            var parent = $(this).closest('.SET').remove();
        }
    </script>
</body>

    </html>