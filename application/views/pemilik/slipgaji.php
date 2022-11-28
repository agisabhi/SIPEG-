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
            <img src="<?=base_url();?>assets/img/theme/villakancil2.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              
                <div class="card-profile-image">
                  <a href="#">
                    <?php 
                    function rupiah($angka){
                      $hasil = number_format($angka,0,',','.');
                      return $hasil;
                    }
                    ?>
                    <?php foreach ($slip as $sli):?>
                    <img src="<?=base_url();?>assets/foto/<?=$sli['foto'];?>" class="rounded-circle">
                  </a>
                
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
  
<h2 align="center">Data Slip Gaji Bulan <?php
 if($gaji['tanggal']=="1"){
      $gaji['tanggal']="Januari";
    }else if($gaji['tanggal']=="2"){
      $gaji['tanggal']="Februari";
    }else if($gaji['tanggal']=="3"){
      $gaji['tanggal']="Maret";
    }else if($gaji['tanggal']=="4"){
      $gaji['tanggal']="April";
    }else if($gaji['tanggal']=="5"){
      $gaji['tanggal']="Mei";
    }else if($gaji['tanggal']=="6"){
      $gaji['tanggal']="Juni";
    }else if($gaji['tanggal']=="7"){
      $gaji['tanggal']="Juli";
    }else if($gaji['tanggal']=="10"){
      $gaji['tanggal']="Oktober";
    }else if($gaji['tanggal']=="9"){
      $gaji['tanggal']="September";
    }else if($gaji['tanggal']=="8"){
      $gaji['tanggal']="Agustus";
    }else if($gaji['tanggal']=="11"){
      $gaji['tanggal']="November";
    }else if($gaji['tanggal']=="12"){
      $gaji['tanggal']="Desember";
    }
    echo $gaji['tanggal'];
?></h2>
<?php foreach($jab as $j):?>
                <p align="left"><b>NIP        : <?=$j['nip'];?><br>
                NAMA       : <?=$j['nama'];?><br>
                Jabatan    : <?=$j['nama_jabatan'];?><br>
                Gaji Pokok : <?=rupiah($j['gaji']);?><br><br>
                </b>
</p>
                <?php endforeach;?>
    <table class="table align-items-center table-flush" align="center" border="1">
        <tr>
            <td colspan="2" align="center"><b>Rincian Gaji</b></td>
        </tr>
        <tbody class="list">
    <?php
    
        
        $no=1;
        foreach($slip as $data) :?>
           <?php $tgl = date('d-m-Y', strtotime($data['tanggal']));?>
            <tr>
                <td align="left">Status Validasi</td>
                <td align="right"><?=$data['status_gaji'];?></td>
            </tr>
            <tr>
                <td align="left">Hadir</td>
                <td align="right"><?=$data['hadir'];?></td>
            </tr>
            <tr>
                <td align="left">Alpa</td>
                <td align="right"><?=$data['alpa'];?></td>
            </tr>
            <tr>
                <td align="left">Terlambat</td>
                <td align="right"><?=$data['terlambat'];?></td>
            </tr>
            <tr>
                <td align="left">Pulang Awal</td>
                <td align="right"><?=$data['pulang_awal'];?></td>
            </tr>
            <tr>
                <td align="left">Terlambat & Pulang Awal</td>
                <td align="right"><?=$data['terlambat_pulang_awal'];?></td>
            </tr>
            <tr>
                <td align="left">Potongan</td>
                <td align="right">Rp. <?=rupiah($data['potongan']*30000);?></td>
            </tr>
            <tr>
                <td align="left">Total Gaji</td>
                <td align="right">Rp. <?=rupiah($data['total_gaji']);?></td>
            </tr>
      <?php endforeach; ?>
    <?php
        
        ?>
        </tbody>
    </table> 
       <p align="left"> <b>*Catatan</b> <br>
    Alpa                       : Rp. 60.000<br>
    Terlambat                  : Rp. 30.000<br>
    Pulang Awal                : Rp. 30.000<br>
    Terlambat & Pulang Awal    : Rp. 60.000
    <br>
    </p>
              </div>
              
              <a href="<?=base_url();?>kepegawaian/cetakslip/<?=$sli['nip'];?>" class="btn btn-primary">Download Pdf</a>
              <a href="<?=base_url();?>kepegawaian/slipgaji" class="btn btn-danger">Back</a>
                      <?php endforeach;?>
            </div>
          </div>
        </div>
        
      </div>
    </div>
</div>
</body>