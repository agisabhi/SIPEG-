<body class="bg-default">
    <!-- Navbar -->
    <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="dashboard.html">
                <img src="assets/img/brand/villakancil.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="dashboard.html">
                                <img src="../assets/img/brand/blue.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>absen" class="nav-link">
                            <span class="nav-link-inner--text">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>login" class="nav-link">
                            <span class="nav-link-inner--text">Login</span>
                        </a>
                    </li>

                </ul>
                <hr class="d-lg-none" />
                <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://www.facebook.com/villa.soenda" target="_blank" data-toggle="tooltip" data-original-title="Like us on Facebook">
                            <i class="fab fa-facebook-square"></i>
                            <span class="nav-link-inner--text d-lg-none">Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://www.instagram.com/villakancil/?hl=en" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
                            <i class="fab fa-instagram"></i>
                            <span class="nav-link-inner--text d-lg-none">Instagram</span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-4">
                            <h1 class="text-white">Selamat Datang!</h1>
                            <p class="text-lead text-white">Silahkan Melakukan Presensi Untuk Pegawai Villa Kancil</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">

                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <h2>Presensi Pegawai <br>Tanggal <?= date("d-m-Y"); ?></h2><br><br>
                                
                            </div>
                            
                            <div><?= $this->session->flashdata('flash'); ?></div>
                            <form role="form" method="post" action="<?=base_url();?>absen/tambah">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                        </div>
                                        
                                        <select name="pilihan" required class="form form-control">
                                            <option value=""><b>Pilih Datang/Pulang </b></option>
                                            <option value="datang">Datang</option>
                                            <option value="pulang">Pulang</option>
                                        </select>
                                        <br>
                                        
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                        </div>
                                        <input class="form-control" list="data_ma" placeholder="Masukkan NIP" type="text" id="nip" name="nip" onchange="return auto()"required>
                                        <br>
                                        <?=form_error('nama','<small class="text-danger pl-3">','</small>');?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nama Pegawai" id="nama" name="nama" type="text" readonly>

                                    </div>
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">Presensi</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="text-white mb-0">Data Absensi</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort" data-sort="no">No</th>
                                    <th scope="col" class="sort" data-sort="nip">NIP</th>
                                    <th scope="col" class="sort" data-sort="nama">Nama Pegawai</th>
                                    <th scope="col">Waktu Datang</th>
                                    <th scope="col">Waktu Pulang</th>
                                    <th scope="col">Status Absen</th>
                                    


                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $no = 1; ?>
                                <?php foreach ($abs as $a) : ?>
                                    <tr>
                                        <td class="no">
                                            <?= $no++; ?>
                                        </td>
                                        <td class="budget">
                                            <?= $a['nip']; ?>
                                        </td>
                                        <td>
                                            <?= $a['nama']; ?>
                                        </td>

                                        <td>
                                            <?= $a['waktu_masuk']; ?><br>
                                            <?php if($a['waktu_masuk']>'08:00:00'){
?><span class="badge badge-danger">Terlambat</span><?php
                                            }else{
?><span class="bagse badge-success">Hadir</span> <?php
                                            } ?>
                                        </td>
                                        <td>
                                            <?= $a['waktu_keluar']; ?><br><?php if(empty($a['waktu_keluar'])){

                                            }
                                            else if(($a['waktu_keluar'])<'17:00:00'){
?><span class="badge badge-danger">Pulang Awal</span><?php
                                            }else{
?><span class="bagse badge-success">Pulang Tepat</span> <?php
                                            } ?>
                                        </td>
                                        <td>
                                        <?php
                                        if ($a['id_status']==1) {
                                            ?> <span class="badge badge-success">Hadir</span> <?php
                                        }else if($a['id_status']==2){
                                            ?> <span class="badge badge-danger">Telat Masuk</span> <?php
                                        }
                                        else if($a['id_status']==3){
                                            ?> <span class="badge badge-danger">Pulang Awal</span> <?php
                                        }else if($a['id_status']==4){
                                            ?> <span class="badge badge-danger">TELAT</span> <?php
                                        }
                                        ?>
                                        
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <datalist id="data_ma">
            <?php
            foreach ($absensi->result() as $b) {
                echo "<option value='$b->nip'>$b->nama</option>";
            }
            ?>

        </datalist>
        <script src="<?php echo base_url(); ?>assets/ajax.js"></script>


        <script>
            function auto() {
                var nip = document.getElementById('nip').value;
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/absen/cari",
                    data: '&nip=' + nip,
                    success: function(data) {
                        var hasil = JSON.parse(data);

                        $.each(hasil, function(key, val) {

                            document.getElementById('nip').value = val.nip;
                            document.getElementById('nama').value = val.nama;




                        });
                    }
                });

            }
        </script>
    </div>