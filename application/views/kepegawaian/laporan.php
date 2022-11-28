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
                                    <li class="breadcrumb-item"><a href="#">Kepegawaian</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Laporan</li>
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
			<div class="row justify-content-center">
				<div class=" col ">
					<div class="card">
						<div class="card-header bg-transparent">
							<h3 class="mb-0">Laporan</h3>
						</div>
						<div class="card-body">
							<div class="row icon-examples">
								<div class="col-lg-4 col-md-9">
									<a href="<?=base_url();?>laporan" class="btn-icon-clipboard" title="Laporan Presensi">
										<div>
											<i class="ni ni-badge"></i>
											<span>Laporan Presensi</span>
											<br><br><br><br>  
										</div>
									</a>
								</div>
								<div class="col-lg-4 col-md-9">
									<a href="<?=base_url();?>laporan/gaji" class="btn-icon-clipboard" title="Laporan Gaji">
										<div>
											<i class="ni ni-book-bookmark"></i>
											<span>Laporan Gaji</span>
											<br><br><br><br>  
										</div>
									</a>
								</div>
								<div class="col-lg-4 col-md-9">
									<a href="<?=base_url();?>laporan/cuti" class="btn-icon-clipboard" title="Laporan Cuti">
										<div>
											<i class="ni ni-collection"></i>
											<span>Laporan Cuti</span>
											<br><br><br><br>  
										</div>
									</a>
								</div>
                            </div>
                            <div class="row icon-examples">
                            <div class="col-lg-4 col-md-9">
									<a href="<?=base_url();?>laporan/pegawai" class="btn-icon-clipboard" title="Laporan Pegawai">
										<div>
											<i class="ni ni-single-02"></i>
											<span>Laporan Pegawai</span>
											<br><br><br><br>  
										</div>
									</a>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>