<body>
    <!-- Sidenav -->

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show" data-target="#table-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                             </a>
                        </li>


                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <i class="ni ni-circle-08"></i>
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold"><?= $bag['nama']; ?></span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>

                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url(); ?>login/logout" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-0">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Kepegawaian</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Penggajian Pegawai</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                    <!-- Card stats -->

                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--5">
            <div class="row">
                <div class="col">
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h2 class="mb-0">Data Penggajian Pegawai Villa Kancil </b></h2>
                        </div>
                        <!-- Search form -->

                        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Search" type="text">
                                </div>
                            </div>
                            <button type="button" class="close" data-action="search-close" data-target="#table-search-main" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </form>
                        
                        <div class="card-header border-0">
                            
                           Validasi Penggajian Dilakukan Setiap <b>Tanggal 25 </b>setiap Bulannya
                        </div>
                        <div><?= $this->session->flashdata('message'); ?></div>
                        <br>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <form action="<?= base_url(); ?>kepegawaian/validasigaji" method="post">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">NO</th>
                                            <th scope="col" class="sort" data-sort="name">NIP</th>
                                            <th scope="col" class="sort" data-sort="name">Nama Pegawai</th>
                                            <th scope="col" class="sort" data-sort="name">Jabatan</th>
                                            <th scope="col" class="sort" data-sort="name">Gaji Pokok</th>
                                            <th scope="col" class="sort" data-sort="name">Terlambat</th>
                                            <th scope="col" class="sort" data-sort="name">Pulang Awal</th>
                                            <th scope="col" class="sort" data-sort="name">Terlambat & PL awal</th>
                                            <th scope="col" class="sort" data-sort="name">Alpa</th>
                                            <th scope="col" class="sort" data-sort="name">Tidak Presensi Pulang</th>
                                            <th scope="col" class="sort" data-sort="name">Terlambat & Tidak Presensi Pulang</th>
                                            <th scope="col" class="sort" data-sort="name">Potongan</th>
                                            <th scope="col" class="sort" data-sort="name">Total Gaji</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php $start++;

                                        $i = 1;
                                        ?>
                                        <?php foreach ($gaji as $b) : ?>
                                            <tr>

                                                <td>
                                                    <?= $start++; ?>
                                                </td>

                                                <td>
                                                    <?= $b['nip']; ?>
                                                    <input type="hidden" name="nip[<?= $i; ?>]" value="<?= $b['nip']; ?>">
                                                    <input type="hidden" name="tanggal[<?= $i; ?>]" value="<?= date('Y-m-d'); ?>">
                                                </td>

                                                <td>
                                                    <?= $b['nama']; ?>
                                                </td>

                                                <td>
                                                    <?= $b['nama_jabatan']; ?>

                                                </td>

                                                <td>
                                                    Rp.<?= $b['gaji'];?>
                                                    <input type="hidden" name="total_gaji[<?=$i;?>]" id="" value="<?=$b['gaji']-($b['potongan']*30000);?>">
                                                </td>
                                                
                                                    <input type="hidden" name="hadir[<?=$i;?>]" id="" value="<?=$b['hadir'];?>">
                                                
                                                <td>
                                                    <?= $b['terlambat'];?>
                                                    <input type="hidden" name="terlambat[<?=$i;?>]" id="" value="<?=$b['terlambat'];?>">
                                                </td>
                                                <td>
                                                    <?= $b['pulang_awal'];?>
                                                    <input type="hidden" name="pulang_awal[<?=$i;?>]" id="" value="<?=$b['pulang_awal'];?>">
                                                </td>
                                                <td>
                                                    <?= $b['terlambat_pulang_awal'];?>
                                                    <input type="hidden" name="terlambat_pulang_awal[<?=$i;?>]" id="" value="<?=$b['terlambat_pulang_awal'];?>">
                                                </td>
                                                <td>
                                                    <?= $b['alpa'];?>
                                                    <input type="hidden" name="alpa[<?=$i;?>]" id="" value="<?=$b['alpa'];?>">
                                                </td>
                                                <td>
                                                    <?= $b['pulang_belum'];?>
                                                    <input type="hidden" name="presensi_belum[<?=$i;?>]" id="" value="<?=$b['pulang_belum'];?>">
                                                </td>
                                                <td>
                                                    <?= $b['terlambat_pulang_belum'];?>
                                                    <input type="hidden" name="terlambat_presensi_belum[<?=$i;?>]" id="" value="<?=$b['terlambat_pulang_belum'];?>">
                                                </td>
                                                <td>
                                                Rp. <?=$b['potongan']*30000;?>
                                                <input type="hidden" name="potongan[<?=$i;?>]" id="" value="<?=$b['potongan'];?>">
                                                </td>
                                                <td>
                                                Rp. <?=$b['gaji']-($b['potongan']*30000);?>
                                                
                                                </td>

                                                <td>

                                                    <select name="status_gaji[<?= $i; ?>]" class="form form-control">
                                                        <option value="validkep">Accept</option>

                                                    </select>
                                                </td>
                                                <?php $i++; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <?php 
                                            if(date('d')=="28"){
                                                if($valid<1){
                                                ?>
                                                <td><input type="submit" class="btn btn-success" value="Simpan"></td>
                                                <?php
                                                }else{

                                                }
                                            }else{

                                            }
                                            ?>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <br><br><br>
                        </div>
                        <!-- Card footer -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>