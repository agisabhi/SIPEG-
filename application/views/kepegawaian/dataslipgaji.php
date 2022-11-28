<body>
    <!-- Sidenav -->

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center ml-md-auto ">
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
        <div class="header pb-6 d-flex align-items-center" style="min-height: 200px; background-image: url(<?= base_url(); ?>/assets/img/theme/villakancil.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-6"></span>
        
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-0">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Absensi Pegawai</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                    <!-- Card stats -->
                    
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col">
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h2 class="mb-0">Data Slip Gaji Pegawai Villa Kancil</h2>
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
                        <div><?= $this->session->flashdata('message'); ?></div>
                        <br>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">NO</th>
                                        <th scope="col" class="sort" data-sort="name">NIP</th>
                                        <th scope="col" class="sort" data-sort="budget">Nama</th>
                                        <th scope="col" class="sort" data-sort="status">Bagian</th>
                                        <th scope="col">Alamat</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php $start++; ?>
                                    <?php foreach ($pegawai as $a) : ?>
                                        <tr>

                                            <td>
                                                <?= $start++; ?>
                                            </td>

                                            <td>
                                                <?= $a['nip']; ?>
                                            </td>

                                            <td>
                                                <?= $a['nama']; ?>
                                            </td>

                                            <td>
                                                <?= $a['nama_jabatan']; ?>
                                            </td>

                                            <td>
                                                <?= $a['alamat']; ?>
                                            </td>

                                            <td>
                                                <a href="<?= base_url(); ?>kepegawaian/detailslip/<?= $a['nip'] ?>" class="btn btn-primary btn-sm"><i class="ni ni-active-40">Detail</i></a>

                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Card footer -->
                        <?= $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>