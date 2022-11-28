<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_pemilik extends CI_Controller{

public function __construct(){
	parent::__construct();
	$this->load->model('Kepegawaian_model');
	$this->load->model('LaporanCuti_model');
	$this->load->model('LaporanAbsensi_model');
    $this->load->model('LaporanGaji_model');
}

public function index(){
    $config['per_page'] = 10;
        $data['start'] = $this->uri->segment(3);
	if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Data Presensi Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'laporan/cetak?filter=1&tanggal='.$tgl;
                
                $total_rows = $this->LaporanAbsensi_model->view_date_rows($tgl);
                $transaks = $this->LaporanAbsensi_model->view_by_date($tgl, $config['per_page'], $data['start']); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Presensi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $total_rows = $this->LaporanAbsensi_model->view_month_rows($bulan,$tahun);
                $url_cetak = 'laporan/cetak?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaks = $this->LaporanAbsensi_model->view_by_month($bulan, $tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Presensi Tahun '.$tahun;
                $total_rows = $this->LaporanAbsensi_model->view_year_rows($tahun);
                $url_cetak = 'laporan/cetak?filter=3&tahun='.$tahun;
                $transaks = $this->LaporanAbsensi_model->view_by_year($tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Presensi';
            $url_cetak = 'laporan/cetak';
            $total_rows = $this->LaporanAbsensi_model->view_all_rows();
            $transaks = $this->LaporanAbsensi_model->view_all($config['per_page'], $data['start']); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $this->load->library('pagination');
        $config['base_url'] = "http://localhost/sipeg/laporan_pemilik/index";
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 10;
    
        //styling pagination
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
    
        $config['first_link'] = '<a class="page-link">First</a>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
    
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
    
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
    
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
    
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
    
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
    
        $config['attributes'] = array('class' => 'page-link');
    
        $this->pagination->initialize($config);
    $data['ket'] = $ket;
    $data['start'] = $this->uri->segment(3);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['url_cetak'] = base_url($url_cetak);
    $data['transaksi'] = $transaks;
    $data['option_tahun'] = $this->LaporanAbsensi_model->option_tahun();
    $this->load->view('header/header_lap', $data);
    $this->load->view('header/navpemilik', $data);
    $this->load->view('laporan/pemilik_absensi', $data);
    
  }
   
  public function cetak(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Data Absensi Tanggal '.date('d-m-y', strtotime($tgl));
                $transaksi = $this->LaporanAbsensi_model->view_by_date_print($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Absensi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->LaporanAbsensi_model->view_by_month_print($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Absensi Tahun '.$tahun;
                $transaksi = $this->LaporanAbsensi_model->view_by_year_print($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Absensi';
            $transaksi = $this->LaporanAbsensi_model->view_all_print(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['transaksi'] = $transaksi;
        
        ob_start();
        
        $this->load->view('laporan/absensiprint', $data);
        $html = ob_get_contents();
        ob_end_clean();
        
        require 'vendor/autoload.php'; // Load plugin html2pdfnya
        $pdf = new \Mpdf\Mpdf([
	'mode' => 'c',
	'orientation' => 'P',
	'margin_left' => 32,
	'margin_right' => 25,
	'margin_top' => 25,
	'margin_bottom' => 47,
	'margin_header' => 10,
	'margin_footer' => 10,
    'format' => 'A4'
]);
$header = '
<table width="100%"><tr>
<td width="33%" align="right"><img src="assets/img/brand/villakancil.png" width="200px" /></td>
<td width="100%" align="center"><h1>Laporan Absensi Pegawai<br>Villa Kancil Kampoeng Sunda</h1></td>
</tr>
</table><hr class="line-block"><br>';

        $pdf->SetHTMLHeader($header);
        $pdf->showImageErrors = true;
        $pdf->WriteHTML($html);
        $pdf->Output('Laporan Absensi.pdf', 'D');
    }
    
    public function gaji(){
        $config['per_page'] = 10;
            $data['start'] = $this->uri->segment(3);
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
                $filter = $_GET['filter']; // Ambil data filder yang dipilih user
                if($filter == '2'){ // Jika filter nya 2 (per bulan)
                    $bulan = $_GET['bulan'];
                    $tahun = $_GET['tahun'];
                    $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                    
                    $ket = 'Data Gaji Bulan '.$nama_bulan[$bulan].' '.$tahun;
                    $total_rows = $this->LaporanGaji_model->view_month_rows($bulan,$tahun);
                    $url_cetak = 'laporan/cetakgaji?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                    $transaks = $this->LaporanGaji_model->view_by_month($bulan, $tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_month yang ada di TransaksiModel
                }else{ // Jika filter nya 3 (per tahun)
                    $tahun = $_GET['tahun'];
                    
                    $ket = 'Data Gaji Tahun '.$tahun;
                    $total_rows = $this->LaporanGaji_model->view_year_rows($tahun);
                    $url_cetak = 'laporan/cetakgaji?filter=3&tahun='.$tahun;
                    $transaks = $this->LaporanGaji_model->view_by_year($tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_year yang ada di TransaksiModel
                }
            }else{ // Jika user tidak mengklik tombol tampilkan
                $ket = 'Semua Data Gaji';
                $url_cetak = 'laporan/cetakgaji';
                $total_rows = $this->LaporanGaji_model->view_all_rows();
                $transaks = $this->LaporanGaji_model->view_all($config['per_page'], $data['start']); // Panggil fungsi view_all yang ada di TransaksiModel
            }
            
            $this->load->library('pagination');
            $config['base_url'] = "http://localhost/sipeg/laporan_pemilik/gaji";
            $config['total_rows'] = $total_rows;
            $config['per_page'] = 10;
        
            //styling pagination
            $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
            $config['full_tag_close'] = '</ul></nav>';
        
            $config['first_link'] = '<a class="page-link">First</a>';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';
        
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';
        
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';
        
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';
        
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
            $config['cur_tag_close'] = '</a></li>';
        
            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';
        
            $config['attributes'] = array('class' => 'page-link');
        
            $this->pagination->initialize($config);
        $data['ket'] = $ket;
        $data['start'] = $this->uri->segment(3);
        $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
        $data['url_cetak'] = base_url($url_cetak);
        $data['transaksi'] = $transaks;
        $data['option_tahun'] = $this->LaporanGaji_model->option_tahun();
        $this->load->view('header/header_lap', $data);
        $this->load->view('header/navpemilik', $data);
        $this->load->view('laporan/pemilik_gaji', $data);
        
      }

      public function cetakgaji(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Gaji Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->LaporanGaji_model->view_by_month_print($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Gaji Tahun '.$tahun;
                $transaksi = $this->LaporanGaji_model->view_by_year_print($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Gaji';
            $transaksi = $this->LaporanGaji_model->view_all_print(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['transaksi'] = $transaksi;
        
        ob_start();
        
        $this->load->view('laporan/gajiprint', $data);
        $html = ob_get_contents();
        ob_end_clean();
        
        require 'vendor/autoload.php'; // Load plugin html2pdfnya
        $pdf = new \Mpdf\Mpdf([
	'mode' => 'c',
	'orientation' => 'P',
	'margin_left' => 32,
	'margin_right' => 25,
	'margin_top' => 47,
	'margin_bottom' => 47,
	'margin_header' => 10,
	'margin_footer' => 10,
    'format' => 'A4'
]);
$header = '
<table width="100%"><tr>
<td width="33%" align="right"><img src="assets/img/brand/villakancil.png" width="170px" /></td>
<td width="200%" align="center"><h1 align="center">Laporan Gaji Pegawai<br>Villa Kancil Kampoeng Sunda</h1></td>
</tr>
</table><hr class="line-block">';

        $pdf->SetHTMLHeader($header);
        $pdf->WriteHTML($html);
        $pdf->Output('Laporan Gaji.pdf', 'D');
    }


    public function cuti(){
        $config['per_page'] = 10;
        $data['start'] = $this->uri->segment(3);
	if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                $jenis = $_GET['jenis'];
                
                $ket = 'Data Cuti '.$jenis.' Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'laporan_pemilik/cetakcuti?jenis='.$jenis.'filter=1&tanggal='.$tgl;
                $total_rows = $this->LaporanCuti_model->view_date_rows($jenis,$tgl);
                $transaks = $this->LaporanCuti_model->view_by_date($jenis,$tgl, $config['per_page'], $data['start']); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $jenis = $_GET['jenis'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Cuti Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $total_rows = $this->LaporanCuti_model->view_month_rows($jenis,$bulan,$tahun);
                $url_cetak = 'laporan_pemilik/cetakcuti?jenis='.$jenis.'filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaks = $this->LaporanCuti_model->view_by_month($jenis, $bulan, $tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $jenis = $_GET['jenis'];
                
                $ket = 'Data Cuti '.$jenis.' Tahun '.$tahun;
                $total_rows = $this->LaporanCuti_model->view_year_rows($jenis, $tahun);
                $url_cetak = 'laporan_pemilik/cetakcuti?jenis='.$jenis.'filter=3&tahun='.$tahun;
                $transaks = $this->LaporanCuti_model->view_by_year($jenis,$tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else if(isset($_GET['jenis']) && ! empty($_GET['jenis'])){
            $jenis = $_GET['jenis'];
            if($jenis=="Menikah"){
                $jenis = $_GET['jenis'];
                
                $ket = 'Data Cuti '.$jenis;
                $total_rows = $this->LaporanCuti_model->view_menikah_rows($jenis);
                $url_cetak = 'laporan_pemilik/cetakcuti?jenis='.$jenis;
                $transaks = $this->LaporanCuti_model->view_by_menikah($jenis); 
            }else{
                $jenis = $_GET['jenis'];
                
                $ket = 'Data Cuti '.$jenis;
                $total_rows = $this->LaporanCuti_model->view_menikah_rows($jenis);
                $url_cetak = 'laporan_pemilik/cetakcuti?jenis='.$jenis;
                $transaks = $this->LaporanCuti_model->view_by_menikah($jenis);
            }
        }else{
            $ket = 'Semua Data Cuti';
            $url_cetak = 'laporan_pemilik/cetakcuti';
            
            $total_rows = $this->LaporanCuti_model->view_all_rows();
            $transaks = $this->LaporanCuti_model->view_all($config['per_page'], $data['start']); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $this->load->library('pagination');
        $config['base_url'] = "http://localhost/sipeg/laporan_pemilik/cuti";
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 10;
    
        //styling pagination
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
    
        $config['first_link'] = '<a class="page-link">First</a>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
    
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
    
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
    
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
    
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
    
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
    
        $config['attributes'] = array('class' => 'page-link');
    
        $this->pagination->initialize($config);
    $data['ket'] = $ket;
    $data['start'] = $this->uri->segment(3);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['url_cetak'] = base_url($url_cetak);
    $data['transaksi'] = $transaks;
    $data['option_tahun'] = $this->LaporanCuti_model->option_tahun();
    $this->load->view('header/header_lap', $data);
    $this->load->view('header/navpemilik', $data);
    $this->load->view('laporan/pemilik_cuti', $data);
    }

    public function cetakcuti(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $jenis = $_GET['jenis'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Cuti Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->LaporanCuti_model->view_by_month_print($jenis, $bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $jenis = $_GET['jenis'];
                
                $ket = 'Data Cuti Tahun '.$tahun;
                $transaksi = $this->LaporanCuti_model->view_by_year_print($jenis, $tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else if(isset($_GET['jenis']) && ! empty($_GET['jenis'])){
            $jenis = $_GET['jenis'];
            if($jenis=="Menikah"){
                $jenis = $_GET['jenis'];
                
                $ket = 'Data Cuti '.$jenis;
                
                
                $transaksi = $this->LaporanCuti_model->view_by_menikah_print($jenis); 
            }else{
                $jenis = $_GET['jenis'];
                
                $ket = 'Data Cuti '.$jenis;
                
                
                $transaksi = $this->LaporanCuti_model->view_by_menikah_print($jenis);
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Cuti';
            $transaksi = $this->LaporanCuti_model->view_all_print(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $data['ket'] = $ket;
        $data['transaksi'] = $transaksi;
        
        ob_start();
        
        $this->load->view('laporan/cutiprint', $data);
        $html = ob_get_contents();
        ob_end_clean();
        
        require 'vendor/autoload.php'; // Load plugin html2pdfnya
        $pdf = new \Mpdf\Mpdf([
	'mode' => 'c',
	'orientation' => 'P',
	'margin_left' => 32,
	'margin_right' => 25,
	'margin_top' => 40,
	'margin_bottom' => 47,
	'margin_header' => 10,
	'margin_footer' => 10,
    'format' => 'A4'
]);
$header = '
<table width="100%"><tr>
<td width="30%" align="right"><img src="assets/img/brand/villakancil.png" width="150px" /></td>
<td width="90%" align="center"><h1 align="center">Laporan Cuti Pegawai<br>Villa Kancil Kampoeng Sunda</h1></td>
</tr>
</table><hr class="line-block">';

        $pdf->SetHTMLHeader($header);
        $pdf->WriteHTML($html);
        $pdf->Output('Laporan Cuti.pdf', 'D');
    }

    public function pegawai(){
        $config['per_page'] = 10;
        $data['start'] = $this->uri->segment(3);
	if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            
                
                $ket = 'Data Pegawai Divisi '.$filter;
                $url_cetak = 'laporan_pemilik/cetakpegawai?filter='.$filter;
                
                $total_rows = $this->LaporanAbsensi_model->view_bagian_rows($filter);
                $transaks = $this->LaporanAbsensi_model->view_by_bagian($filter, $config['per_page'], $data['start']); // Panggil fungsi view_by_date yang ada di TransaksiModel
           
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Pegawai';
            $url_cetak = 'laporan_pemilik/cetakpegawai';
            $total_rows = $this->LaporanAbsensi_model->view_pegawai_rows();
            $transaks = $this->LaporanAbsensi_model->view_all_pegawai($config['per_page'], $data['start']); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $this->load->library('pagination');
        $config['base_url'] = "http://localhost/sipeg/laporan/pegawai";
        $config['total_rows'] = $total_rows;
        $config['per_page'] = 10;
    
        //styling pagination
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
    
        $config['first_link'] = '<a class="page-link">First</a>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
    
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
    
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
    
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
    
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
    
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
    
        $config['attributes'] = array('class' => 'page-link');
    
        $this->pagination->initialize($config);
    $data['ket'] = $ket;
    $data['start'] = $this->uri->segment(3);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['jab'] = $this->db->get('jabatan')->result_array();
    $data['url_cetak'] = base_url($url_cetak);
    $data['transaksi'] = $transaks;
    $data['option_tahun'] = $this->LaporanAbsensi_model->option_tahun();
    $this->load->view('header/header_lap', $data);
    $this->load->view('header/navpemilik', $data);
    $this->load->view('laporan/pemilik_pegawai', $data);
    }

    public function cetakpegawai(){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            
                
                $ket = 'Data Pegawai Divisi '.$filter;

                $transaks = $this->LaporanAbsensi_model->view_by_bagian_print($filter); // Panggil fungsi view_by_date yang ada di TransaksiModel
           
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Pegawai';
            
            
            $transaks = $this->LaporanAbsensi_model->view_all_pegawai_print(); // Panggil fungsi view_all yang ada di TransaksiModel
        }

        $data['ket'] = $ket;
        $data['transaksi'] = $transaks;
        
        ob_start();
        
        $this->load->view('laporan/pegawaiprint', $data);
        $html = ob_get_contents();
        ob_end_clean();
        
        require 'vendor/autoload.php'; // Load plugin html2pdfnya
        $pdf = new \Mpdf\Mpdf([
	'mode' => 'c',
	'orientation' => 'P',
	'margin_left' => 32,
	'margin_right' => 25,
	'margin_top' => 40,
	'margin_bottom' => 47,
	'margin_header' => 10,
	'margin_footer' => 10,
    'format' => 'A4'
]);
$header = '
<table width="100%"><tr>
<td width="30%" align="right"><img src="assets/img/brand/villakancil.png" width="150px" /></td>
<td width="90%" align="center"><h1 align="center">Laporan Pegawai<br>Villa Kancil Kampoeng Sunda</h1></td>
</tr>
</table><hr class="line-block">';

        $pdf->SetHTMLHeader($header);
        $pdf->WriteHTML($html);
        $pdf->Output('Laporan Pegawai.pdf', 'D');
    }
    
}
