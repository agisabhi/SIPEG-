<body>
    <div class="main-content" id="panel">
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
        <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../assets/img/theme/img-1-1000x600.jpg); background-size: cover; background-position: center top;">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Ubah Data Pegawai</h1>
            </div>

        </div>
        <div class="container-fluid mt--9">
            <div class="row">
                <div class="col-xl-8 order-xl-1">
                    <div class="card">

                        <div class="card-body">
                            <form method="post" action="">
                                <h6 class="heading-small text-muted mb-4">Ubah Biodata Pegawai</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nomor Induk Pegawai</label>
                                                <input type="text" id="input-username" class="form-control" placeholder="NIP" name="nip" value="<?=$idpeg['nip']; ?>" required readonly>
                                                <small class="from-text text-danger"><?= form_error('nip'); ?></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Nama Lengkap</label>
                                                <input type="text" id="input-email" class="form-control" placeholder="nama" name="nama" value="<?= $idpeg['nama']; ?>" required>
                                                <small class="from-text text-danger"><?= form_error('nama'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Bagian</label><br>
                                                <select name="jabatan" class="form-control">
                                                    <?php foreach ($jb as $j) : ?>
                            <?php if($idpeg['kode_jabatan']==$j['kode_jabatan']):?>
<option value="<?= $j['kode_jabatan']; ?>" selected><?= $j['nama_jabatan']; ?></option>
                                    <?php else: ?>
    <option value="<?= $j['kode_jabatan']; ?>"><?= $j['nama_jabatan']; ?>
                                                            
                                                        </option>
                                                    <?php endif;?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Jenis Kelamin</label><br>
                                                <select name="jenis_kelamin" class="form-control">
                                                    
                            <?php if($idpeg['jenis_kelamin']=='L'):?>
<option value="L" selected>Laki-laki</option>
<option value="P" >Perempuan</option>
                                    <?php else: ?>
                                        <option value="P" selected>Perempuan</option>
                                        <option value="L" >Laki-laki</option>
                                                            
                                                        </option>
                                                    <?php endif;?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Status Perkawinan</label><br>
                                                <select name="status_perkawinan" class="form-control">
                                                    
                            <?php if($idpeg['status_perkawinan']=='menikah'):?>
<option value="menikah" selected>Menikah</option>
<option value="belum menikah" >Belum Menikah</option>
                                    <?php else: ?>
                                        <option value="menikah" >Menikah</option>
                                        <option value="belum_menikah" selected>Belum Menikah</option>
                                                            
                                                        </option>
                                                    <?php endif;?>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name">Alamat</label>
                                                <small class="from-text text-danger"><?= form_error('alamat'); ?></small>
                                                <input type="text" id="input-last-name" class="form-control" name="alamat" value="<?= $idpeg['alamat']; ?>" required></input>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name">Status</label>
                                                <small class="from-text text-danger"><?= form_error('alamat'); ?></small>
                                                <select name="status" required class="form form-control">
                                                    <?php if($idpeg['status']=='aktif'):?>
                                                    <option value="aktif" selected>Aktif</option>
                                                    <option value="cuti" >Cuti</option>
                                                    <?php elseif($idpeg['status']=='cuti'):?>
                                                    <option value="cuti" selected>Cuti</option>
                                                    <option value="aktif">Aktif</option>
                                                    <?php else: ?>
                                                    <option value="" selected>Pilih Status</option>    
                                                    <option value="cuti" >Cuti</option>
                                                    <option value="aktif">Aktif</option>
                                                <?php endif;?>
                                                </select>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success my-4">Ubah</button>
                                                <a href="<?=base_url();?>kepegawaian/data_pegawai" class="btn btn-danger">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <!-- Address -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>