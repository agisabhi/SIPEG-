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
                                        <span class="mb-0 text-sm  font-weight-bold"><?= $pem['nama']; ?></span>
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
                        <div><?= $this->session->flashdata('message'); ?></div>
                        <br>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <form action="<?= base_url(); ?>pemilik/validasigaji" method="post">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">NO</th>
                                            <th scope="col" class="sort" data-sort="name">NIP</th>
                                            <th scope="col" class="sort" data-sort="name">Nama Pegawai</th>
                                            <th scope="col" class="sort" data-sort="name">Jabatan</th>
                                            <th scope="col" class="sort" data-sort="name">Total Gaji</th>
                                            <th scope="col" class="sort" data-sort="name">Status Gaji</th>
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

                                                </td>

                                                <td>
                                                    <?= $b['nama']; ?>
                                                </td>

                                                <td>
                                                    <?= $b['nama_jabatan']; ?>

                                                </td>

                                                <td>
                                                    Rp.<?= $b['total_gaji']; ?>

                                                </td>

                                                <td>
                                                    <?php
                                                    if ($b['status_gaji'] == 'validpemilik') {
                                                    ?> <span class="badge badge-success">ACC</span>
                                                    <?php
                                                    } else {
                                                    ?> <span class="badge badge-warning">Perlu Acc</span><?php
                                                                                                        } ?>

                                                </td>



                                                <input type="hidden" name="no_slip[<?= $i; ?>]" value="<?= $b['no_slip']; ?>">


                                                <td>

                                                    <select name="status_gaji[<?= $i; ?>]" class="form form-control">
                                                        <option value="validpemilik">Accept</option>

                                                    </select>
                                                </td>
                                                <?php $i++; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php if($i>1){
                                            ?><tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><input type="submit" class="btn btn-success" value="Simpan"></td>
                                        </tr> <?php
                                        }?>
                                        
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