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
                                <h6 class="heading-small text-muted mb-4">Ubah Data Jabatan</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Kode Jabatan</label>
                                                <input type="number" id="input-username" class="form-control" placeholder="NIP" name="nip" value="<?= $idlog['kode_jabatan']; ?>" readonly>
                                                <small class="from-text text-danger"><?= form_error('nip'); ?></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Nama Jabatan</label>
                                                <input type="text" id="input-email" class="form-control" placeholder="Nama Jabatan" name="nama_jabatan" value="<?= $idlog['nama_jabatan']; ?>" required>
                                                <small class="from-text text-danger"><?= form_error('nama_jabatan'); ?></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Gaji</label>
                                                <input type="text" id="input-email" class="form-control" placeholder="Gaji" name="gaji" value="<?= $idlog['gaji']; ?>" required>
                                                <small class="from-text text-danger"><?= form_error('gaji'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success my-4">Ubah</button>
                                            <a href="<?=base_url();?>kepegawaian/bagian" class="btn btn-danger">Kembali</a>
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