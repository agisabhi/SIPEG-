<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="<?= base_url(); ?>pegawai">
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
                        <a class="nav-link" href="<?= base_url(); ?>pegawai">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>pegawai/cuti" class="nav-link">
                            <i class="ni ni-planet text-orange"></i>
                            <span class="nav-link-text">Pengajuan Cuti</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url(); ?>pegawai/profil" class="nav-link">
                            <i class="ni ni-single-02 text-blue"></i>
                            <span class="nav-link-text">Profil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url();?>pegawai/slipgaji">
                            <i class="ni ni-single-02 text-green"></i>
                            <span class="nav-link-text">Slip Gaji</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url();?>pegawai/rekappresensi">
                            <i class="ni ni-single-02 text-blue"></i>
                            <span class="nav-link-text">Rekap Presensi</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</nav>