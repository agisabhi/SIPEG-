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
                <h1 class="display-2 text-white">Presensi Pegawai</h1>
            </div>

        </div>
        <div class="container-fluid mt--9">
            <div class="row">
                <div class="col-xl-8 order-xl-1">
                    <div class="card">

                        <div class="card-body">
                        <div><?= $this->session->flashdata('flash'); ?></div>
                        
                            <form method="post" action="">
                                <h6 class="heading-small text-muted mb-4">Form Presensi Pegawai</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Nomor Induk Pegawai</label>
                                                <input type="text" list="data_ma" id="nip" class="form-control" name="nip" onchange="return auto()"required>
                                                <small class="from-text text-danger"><?= form_error('nip'); ?></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Nama Lengkap</label>
                                                <input type="text" id="nama" class="form-control" name="nama" required readonly>
                                                <small class="from-text text-danger"><?= form_error('nama'); ?></small>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Tanggal Mulai</label><br>
                                                <input type="text" id="depart" class="form-control date" name="tanggal_mulai" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-first-name">Tanggal Selesai</label><br>
                                                <input type="text" id="return" class="form-control date2" name="tanggal_selesai"  required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-last-name">Status Kehadiran</label>
                                                <small class="from-text text-danger"><?= form_error('alamat'); ?></small>
                                                <select name="id_status" id="cuti" class="form-control" required>
                                                <option value="">Pilih Alasan</option>
                                                <option value="7">Izin</option>
                                                <option value="8">Sakit</option>
                                                </select>
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
                                
                                <datalist id="data_ma">
            <?php
            foreach ($absensi->result() as $b) {
                echo "<option value='$b->nip'>$b->nama</option>";
            }
            ?>

        </datalist>
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="  crossorigin="anonymous"></script>
        
        <script src="<?=base_url();?>assets/moment/moment.js"></script>

        <script type="text/javascript">
           $(document).ready(function() {

var minDate = new Date();
$("#depart").datepicker({
    showAnim: 'drop',
    numberOfMonth: 1,
    minDate: minDate,
    dateFormat: 'dd-mm-yy',
    onClose: function(selectedDate) {
        $("#return").datepicker("option", "minDate", selectedDate);
    }
});




$("#return").datepicker({
    showAnim: 'drop',
    numberOfMonth: 2,
    minDate: minDate,
    dateFormat: 'dd-mm-yy',
    onClose: function(selectedDate) {
        $("#depart").datepicker("option", "maxDate", selectedDate);
    }
});

});

            function auto() {
                var nip = document.getElementById('nip').value;
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/absen/cari",
                    data: '&nip=' + nip,
                    success: function(data) {
                        var hasil = JSON.parse(data);

                        $.each(hasil, function(key, val) {

                            document.getElementById('nip').value = val.nip;
                            document.getElementById('nama').value = val.nama;




                        });
                    }
                });

            }

            
        </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
