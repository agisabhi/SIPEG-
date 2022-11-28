<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="<?= base_url(); ?>assets/img/brand/villakancil.png" class="navbar-brand-img" alt="...">
            </a>
        </div> 
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <hr class="my-1">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>pemilik">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>pemilik/gaji" class="nav-link">
                            <i class="ni ni-planet text-orange"></i>
                            <span class="nav-link-text">Validasi Gaji</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>pemilik/absensi_pegawai">
                            <i class="ni ni-badge text-blue"></i>
                            <span class="nav-link-text">Data Presensi Pegawai</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>pemilik/slipgaji">
                            <i class="ni ni-book-bookmark text-blue"></i>
                            <span class="nav-link-text">Data Slip Gaji</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url();?>pemilik/laporan">
                            <i class="ni ni-single-02 text-green"></i>
                            <span class="nav-link-text">Laporan</span>
                        </a>
                    </li>                
                </ul>
            </div>
        </div>
    </div>
</nav>