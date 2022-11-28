<body>
    <div class="main-content" id="panel">
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->
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
                            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
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
                                        <span class="mb-0 text-sm  font-weight-bold"><?= $peg['nama']; ?></span>
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
<br><br><br><br>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-7 order-xl-2">
          <div class="card card-profile">
            <img src="../assets/img/theme/villakancil2.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-2 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <?php foreach ($profil as $sli):?>
                    <img src="<?=base_url();?>assets/foto/<?=$sli['foto'];?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
               
              </div>
            </div>
            <div class="card-body pt-0">
              
                <br>
              <div class="text-center">
                <h5 class="h3">
                Nama Lengkap: <?=$sli['nama']; ?><span class="font-weight-light"></span>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>Alamat: <?=$sli['alamat'];?>
                </div>

                <div class="h5 mt-1">
                  <i class="ni business_briefcase-24 mr-2"></i>Divisi: <?=$sli['nama_jabatan'];?>
                </div>
                <div class="h5 mt-1">
                  <i class="ni business_briefcase-24 mr-2"></i>Jenis Kelamin: <?php 
                  if($sli['jenis_kelamin']=="L"){
                  ?>Laki-Laki<?php
                  }else{
                    ?>Perempuan<?php
                  };?>
                </div>
                <div class="h5 mt-1">
                  <i class="ni business_briefcase-24 mr-2"></i>Status Pernikahan: <?php 
                  if($sli['status_perkawinan']=="menikah"){
                  ?>Menikah<?php
                  }else{
                    ?>Belum Menikah<?php
                  };?>
                </div>
                <div class="h5 mt-1">
                  <i class="ni business_briefcase-24 mr-2"></i>Password Account: <?=$sli['password'];?>
                </div>
                <br><br><br>
                <div>
                  <a href="<?=base_url();?>pegawai/editprofil/<?=$sli['nip'];?>" class="btn btn-primary" >Edit Profil</a>
                </div>
              </div>
                      <?php endforeach;?>
            </div>
          </div>
        </div>
        
      </div>
    </div>
</div>
</body>