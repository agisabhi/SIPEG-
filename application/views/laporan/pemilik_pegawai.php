<body>
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

        <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
    <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">

                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h2 class="mb-0">Data Pegawai Villa Kancil</h2>
                        </div>
    
    <form method="get" action="">
        <label>Pilih Divisi</label><br>
        <select name="filter" id="filter" name="filter" required>
            <option value="">Pilih</option>
            <?php foreach($jab as $j):?>
            <option value="<?=$j['kode_jabatan'];?>"><?=$j['nama_jabatan'];?></option>
            <?php endforeach;?>
        </select>
        <br /><br />
        <div id="form-tanggal">
            <label>Tanggal</label><br>
            <input type="text" name="tanggal" class="input-tanggal" />
            <br /><br />
        </div>
        <div id="form-bulan">
            <label>Bulan</label><br>
            <select name="bulan">
                <option value="">Pilih</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <br /><br />
        </div>
        <div id="form-tahun">
            <label>Tahun</label><br>
            <select name="tahun">
                <option value="">Pilih</option>
                <?php
                foreach($option_tahun as $data) : ?> 
                    <option value="<?=$data['tahun'];?>"><?=$data['tahun'];?></option>;
                <?php endforeach; ?>
                ?>
            </select>
            <br /><br />
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan</button>
        <a href="<?php echo base_url('laporan_pemilik/pegawai'); ?>" class="btn btn-default">Reset Filter</a>
        <a href="<?php echo base_url('pemilik/laporan'); ?>" class="btn btn-danger">Kembali</a>
    </form>
    <hr />
    
    
    <div>
        <a href="<?php echo $url_cetak; ?>" class="btn btn-success">CETAK PDF</a>
    </div>
    <br>
    <b><?php echo $ket; ?></b><br>
    <table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>NAMA</th>
            <th>Divisi</th>
            
        </tr>
    </thead>
    <?php
    if( ! empty($transaksi)){
      $no = 1;
      $start++;
      foreach($transaksi as $data) :?>
           
            
        <tbody class="list">
            <tr>
                <td><?=$start++;?></td>
                <td><?=$data['nip'];?></td>
                <td><?=$data['nama'];?></td>
                <td><?=$data['nama_jabatan'];?></td>
                
            </tr>
        </tbody>
        <?php $no++;?>
      <?php endforeach; ?>
    <?php
        }
    ?>
    </table>
    <?= $this->pagination->create_links(); ?>
    <script src="<?=base_url(); ?>assets/jquery-ui/jquery-ui.min.js"></script> <!-- Load file plugin js jquery-ui -->
    <script type="text/javascript">
    $(document).ready(function(){ // Ketika halaman selesai di load
        $('.input-tanggal').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });
        $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
        
    })
    </script> 
</div>
</div>
</div>
</div>
</div>