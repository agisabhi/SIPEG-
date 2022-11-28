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
        <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(<?= base_url(); ?>/assets/img/theme/img-1-1000x600.jpg); background-size: cover; background-position: center top;">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Pengajuan Cuti Pegawai</h1>
            </div>

        </div>
        <div class="container-fluid mt--9">
            <div class="row">
                <div class="col-xl-8 order-xl-1">
                    <div class="card">

                        <div class="card-body">
                            <form method="post" action="" id="form">
                                <h6 class="heading-small text-muted mb-4">Form pengajuan cuti</h6>
                                <div class="pl-lg-4">
                                    <div class="row"> 
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nomor Induk Pegawai</label>
                                                <input type="text" id="input-username" class="form-control" value="<?= $peg['nip']; ?>" name="nip" required readonly>
                                                <small class="from-text text-danger"><?= form_error('nip'); ?></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Nama Lengkap</label>
                                                <input type="text" id="input-email" class="form-control" value="<?= $peg['nama']; ?>" name="nama" required readonly>
                                                <small class="from-text text-danger"><?= form_error('nama'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name">Alasan Cuti</label>
                                                <small class="from-text text-danger"><?= form_error('alamat'); ?></small>
                                                <select name="alasan" class="form-control" required>
                                                <option value="">Pilih Alasan</option>
                                                <?php
                                                if($peg['jenis_kelamin']=='L'){
                                                ?>
                                                <option value="Menikah">Menikah</option>
                                                <?php
                                                }else if($peg['jenis_kelamin']=='P' && $peg['status_perkawinan']=='belum_menikah'){
                                                ?>
                                                <option value="Menikah">Menikah</option>
                                                <?php 
                                                }else{
                                                
                                                ?>
                                                <option value="Melahirkan">Melahirkan</option>
                                                <option value="Menikah">Menikah</option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Tanggal Mulai</label><br>
                                                <input type="text" id="tgl_mulai" class="form-control date" name="tanggal_mulai" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Tanggal Selesai</label><br>
                                                <input type="text" id="tgl_akhir" class="form-control date" name="tanggal_selesai" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary my-4">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <!-- Address -->
                                
                                <script src="<?=base_url();?>assets/moment/moment.js"></script>
                                
  <script src="<?=base_url();?>assets/moment/jquery-ui.js"></script>
  
                                <script type="text/javascript">

   $(function(){
     $(".date").datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        useCurrent: false,
        minDate: moment().add('d', 7).toDate(),
        
        
    });
     
      $('select[name=alasan]').on('change', function(){
        var a = $("select[name=alasan] option:selected").val();
        
    
        if(a=="Menikah"){
    $("#tgl_mulai").change(function(selected) {

        dateFormat: 'yy-mm-dd';
        $("#tgl_akhir").val(moment($("#tgl_mulai").val()).add(7,'d').format('YYYY-MM-DD'));
        });
        }else if(a=="Melahirkan"){

        $("#tgl_mulai").change(function(selected) {

        dateFormat: 'yy-mm-dd';
        $("#tgl_akhir").val(moment($("#tgl_mulai").val()).add(3,'M').format('YYYY-MM-DD'));
        });
        }
    
    });
 });
</script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
