<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepegawaian extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('k_model');
    $this->load->model('pegawai_model');
    $this->load->model('kepegawaian_model');
    $this->load->library('form_validation');
  }  

  public function index()
  {
    $data['jum_abs'] = $this->kepegawaian_model->jum_abs();
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['jumlah'] = $this->kepegawaian_model->jum_peg();
    $this->load->view('header/header');
    $this->load->view('header/navkepegawaian', $data);
    $this->load->view('kepegawaian/index', $data);
    $this->load->view('header/footer');
  }

  public function data_pegawai()
  {
    $this->load->library('pagination');
    $config['base_url'] = "http://localhost/sipeg/kepegawaian/data_pegawai";
    $config['total_rows'] = $this->kepegawaian_model->jum_peg();
    $config['per_page'] = 5;

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

    $data['jum_abs'] = $this->kepegawaian_model->jum_abs();
    $data['start'] = $this->uri->segment(3);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['pegawai'] = $this->kepegawaian_model->data_peg($config['per_page'], $data['start']);
    $data['jumlah'] = $this->kepegawaian_model->jum_peg();
    $this->load->view('header/header');
    $this->load->view('header/navkepegawaian', $data);
    $this->load->view('kepegawaian/datapegawai', $data);
    $this->load->view('header/footer');
  }

  public function tambahpegawai()
  {
    $dariDB = $this->kepegawaian_model->cekKodeNip();

    
    $nipSekarang = $dariDB+1;
    $data['nip'] = $nipSekarang;
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['jb'] = $this->kepegawaian_model->jab();
    $data['log'] = $this->kepegawaian_model->getlog();
    $this->form_validation->set_rules('nip', 'NIP', 'required');
    $this->form_validation->set_rules('nama', 'NAMA', 'required');
    $this->form_validation->set_rules('jabatan', 'JABATAN', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('header/header');
      $this->load->view('header/navkepegawaian');
      $this->load->view('kepegawaian/tambah', $data);
      $this->load->view('header/footer');
    } else {
      $this->kepegawaian_model->tambah_peg();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data Berhasil Ditambahkan
      </div>');
      redirect('kepegawaian/data_pegawai');
    }
  }

  public function editpegawai($id)
  {
    $data['idpeg'] = $this->kepegawaian_model->getPegawaiById($id);
    $data['idlog'] = $this->kepegawaian_model->getLoginById($id);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['jb'] = $this->kepegawaian_model->jab();

    $this->form_validation->set_rules('nip', 'NIP', 'required');
    $this->form_validation->set_rules('nama', 'NAMA', 'required');
    $this->form_validation->set_rules('jabatan', 'JABATAN', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');


    if ($this->form_validation->run() == false) {
      $this->load->view('header/header');
      $this->load->view('header/navkepegawaian');
      $this->load->view('kepegawaian/edit', $data);
      $this->load->view('header/footer');
    } else {
      $this->kepegawaian_model->edit_peg();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data Berhasil Diubah
      </div>');
      redirect('kepegawaian/data_pegawai');
    }
  }

  public function hapuspegawai($id)
  {
    $this->kepegawaian_model->hapus_peg($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data Berhasil Dihapus
      </div>');
    redirect('kepegawaian/data_pegawai');
  }


  public function data_akun()
  {
    $this->load->library('pagination');
    $config['base_url'] = "http://localhost/sipeg/kepegawaian/data_akun";
    $config['total_rows'] = $this->kepegawaian_model->jum_log();
    $config['per_page'] = 5;

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

    $data['jum_abs'] = $this->kepegawaian_model->jum_abs();
    $data['start'] = $this->uri->segment(3);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['login'] = $this->kepegawaian_model->data_log($config['per_page'], $data['start']);
    $data['jumlah'] = $this->kepegawaian_model->jum_peg();
    $this->load->view('header/header');
    $this->load->view('header/navkepegawaian', $data);
    $this->load->view('kepegawaian/dataakun', $data);
    $this->load->view('header/footer');
  }

  public function editakun($id)
  {

    $data['idlog'] = $this->kepegawaian_model->getLoginById($id);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();


    $this->form_validation->set_rules('nip', 'NIP', 'required');
    $this->form_validation->set_rules('password', 'PASSWORD', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('header/header');
      $this->load->view('header/navkepegawaian');
      $this->load->view('kepegawaian/editakun', $data);
      $this->load->view('header/footer');
    } else {
      $this->kepegawaian_model->edit_akun($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data Akun Berhasil Diubah
      </div>');
      redirect('kepegawaian/data_akun');
    }
  }

  public function cuti()
  {
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['cuti'] = $this->kepegawaian_model->getCuti();
    $data['start'] = $this->uri->segment(3);
    $data['acc'] = $this->kepegawaian_model->getCutiAcc();
    $this->load->view('header/header');
    $this->load->view('header/navkepegawaian', $data);
    $this->load->view('kepegawaian/kepcuti', $data);
    $this->load->view('header/footer');
  }

  public function validasicuti($id)
  {
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['cuti'] = $this->pegawai_model->getCutiById($id);
    
    $this->form_validation->set_rules('tanggal_mulai', 'Mulai', 'required');
    $this->form_validation->set_rules('tanggal_selesai', 'Selesai', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('header/header');
      $this->load->view('header/navkepegawaian', $data);
      $this->load->view('kepegawaian/validasicuti', $data);
      $this->load->view('header/footer');
      
    } else {
      $status_pengajuan = $this->input->post('status_pengajuan');
      $tanggal_mulai = $this->input->post('tanggal_mulai');
      $tanggal_selesai = $this->input->post('tanggal_selesai');
      $nip = $this->input->post('nipu');
      $i = 5;
      if ($status_pengajuan == "acc") {
         
          
        

      $this->kepegawaian_model->validasi_cuti_acc($id, $nip, $status_pengajuan);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Data Cuti Berhasil DiSetujui
      </div>');
      redirect('kepegawaian/cuti');
    }else{
      $this->kepegawaian_model->validasi_cuti($id, $status_pengajuan);  
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Data Cuti Berhasil Ditolak
      </div>');
      redirect('kepegawaian/cuti');

      }

      
    }
  }

  public function datagaji()
  {
    $this->load->library('pagination');
    $config['base_url'] = "http://localhost/sipeg/kepegawaian/datagaji";
    $config['total_rows'] = $this->kepegawaian_model->getGaj();
    $config['per_page'] = 30;

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


    $data['start'] = $this->uri->segment(3);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['gaji'] = $this->kepegawaian_model->getGaji($config['per_page'], $data['start']);
    $data['valid'] = $this->kepegawaian_model->getGajiBulanIni();

    $this->load->view('header/header');
    $this->load->view('header/navkepegawaian', $data);
    $this->load->view('kepegawaian/gaji', $data);
    $this->load->view('header/footer');
  }
  public function validasigaji()
  {

    $a = $this->input->post('nip[]');
    $c = $this->input->post('potongan[]');
    $d = $this->input->post('total_gaji[]');
    $e = $this->input->post('status_gaji[]');
    $f = $this->input->post('tanggal[]');
    $g = $this->input->post('hadir[]');
    $h = $this->input->post('terlambat[]');
    $j = $this->input->post('pulang_awal[]');
    $k = $this->input->post('terlambat_pulang_awal[]');
    $l = $this->input->post('alpa[]');
    $m = $this->input->post('presensi_belum[]');
    $n = $this->input->post('terlambat_presensi_belum[]');
    $i = 1;
    foreach ($a as $status) {

      $data[] = [
        'tanggal' => $f[$i],
        'nip' => $status,
        'potongan' => $c[$i],
        'total_gaji' => $d[$i],
        'status_gaji' => $e[$i],
        'hadir' => $g[$i],
        'terlambat' => $h[$i],
        'pulang_awal' => $j[$i],
        'terlambat_pulang_awal' => $k[$i],
        'presensi_belum' => $m[$i],
        'terlambat_presensi_belum' => $n[$i],
        'alpa' => $l[$i]
      ];
      $i++;
    }
    $this->kepegawaian_model->validasi_gaji($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Data Penggajian Berhasil Disimpan
      </div>');
    redirect('kepegawaian/datagaji');
  }

  public function absensi_pegawai()
  {
    $this->load->library('pagination');
    $config['base_url'] = "http://localhost/sipeg/kepegawaian/absensi_pegawai";
    $config['total_rows'] = $this->kepegawaian_model->jum_peg();
    $config['per_page'] = 5;

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

    $data['jum_abs'] = $this->kepegawaian_model->jum_abs();
    $data['start'] = $this->uri->segment(3);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['pegawai'] = $this->kepegawaian_model->data_peg($config['per_page'], $data['start']);
    $data['jumlah'] = $this->kepegawaian_model->jum_peg();
    $this->load->view('header/header');
    $this->load->view('header/navkepegawaian', $data);
    $this->load->view('kepegawaian/dataabsenpegawai', $data);
    $this->load->view('header/footer');
  }

  public function detailabsen($nip){
    $data['nip'] = $nip;
    $config['per_page'] = 28;
    $data['start'] = $this->uri->segment(4);
	if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Data Absensi Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'laporan/cetak?nip='.$data['nip'].'&filter=1&tanggal='.$tgl;
                $total_rows = $this->kepegawaian_model->view_date_rows($nip, $tgl);
                $transaks = $this->kepegawaian_model->view_by_date($nip, $tgl, $config['per_page'], $data['start']); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Absensi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $total_rows = $this->kepegawaian_model->view_month_rows($nip, $bulan,$tahun);
                $url_cetak = 'laporan/cetak?nip='.$data['nip'].'&filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaks = $this->kepegawaian_model->view_by_month($nip, $bulan, $tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Absensi Tahun '.$tahun;
                $total_rows = $this->kepegawaian_model->view_year_rows($nip, $tahun);
                $url_cetak = 'laporan/cetak?nip='.$data['nip'].'&filter=3&tahun='.$tahun;
                $transaks = $this->kepegawaian_model->view_by_year($nip, $tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Absensi';
            $url_cetak = 'kepegawaian/cetak/'.$nip;
            $total_rows = $this->kepegawaian_model->view_all_rows($nip);
            $transaks = $this->kepegawaian_model->view_all($nip, $config['per_page'], $data['start']); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/sipeg/index.php/kepegawaian/detailabsen/'.$nip;
        $config['total_rows'] = $total_rows;
        $config['num_links'] = 2;
        $config['prefix'] = '/';
        $config['per_page'] = 28;
        
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
    $data['start'] = $this->uri->segment(4);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['url_cetak'] = base_url($url_cetak);
    $data['transaksi'] = $transaks;
    $data['option_tahun'] = $this->kepegawaian_model->option_tahun();
    $this->load->view('header/header_lap', $data);
    $this->load->view('header/navkepegawaian', $data);
    $this->load->view('kepegawaian/detailabsensi', $data);
    
  }


  public function cetak($nip){
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            $nip = $_GET['nip'];
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Data Presensi NIP '.$nip.' Tanggal '.date('d-m-y', strtotime($tgl));
                $transaksi = $this->kepegawaian_model->view_by_date_print($nip,$tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Presensi '.$nip.' Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->kepegawaian_model->view_by_month_print($nip, $bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Presensi '.$nip.' Tahun '.$tahun;
                $transaksi = $this->kepegawaian_model->view_by_year_print($nip, $tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Presensi NIP '.$nip;
            $transaksi = $this->kepegawaian_model->view_all_print($nip); // Panggil fungsi view_all yang ada di TransaksiModel
        }

        $data['nip'] = $nip;
        $data['ket'] = $ket;
        $data['transaksi'] = $transaksi;
        
        ob_start();
        
        $this->load->view('kepegawaian/absensiprint', $data);
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
<td width="40%" align="right"><img src="assets/img/brand/villakancil.png" width="200px" /></td>
<td width="100%" align="center"><h1>Laporan Presensi Pegawai</h1><br><h1>Villa Kancil Kampoeng Sunda</h1></td>
</tr>
</table><hr class="line-block"><br>';

        $pdf->SetHTMLHeader($header);
        $pdf->showImageErrors = true;
        $pdf->WriteHTML($html);
        $pdf->Output('Laporan Absensi.pdf', 'D');
    }

  public function bagian(){
    $this->load->library('pagination');
    $config['base_url'] = "http://localhost/sipeg/kepegawaian/bagian";
    $config['total_rows'] = $this->kepegawaian_model->jum_bag();
    $config['per_page'] = 5;

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

    
    $data['start'] = $this->uri->segment(3);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['jabatan'] = $this->kepegawaian_model->data_jab($config['per_page'], $data['start']);
    $data['jumlah'] = $this->kepegawaian_model->jum_peg();
    $this->load->view('header/header');
    $this->load->view('header/navkepegawaian', $data);
    $this->load->view('kepegawaian/datajabatan', $data);
    $this->load->view('header/footer');
  }

  public function editjabatan($id){
    $data['idlog'] = $this->kepegawaian_model->getJabatanById($id);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();


    $this->form_validation->set_rules('gaji', 'Gaji', 'required');
    $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('header/header');
      $this->load->view('header/navkepegawaian');
      $this->load->view('kepegawaian/editjabatan', $data);
      $this->load->view('header/footer');
    } else {
      $this->kepegawaian_model->edit_jabatan($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data Jabatan Berhasil Diubah
      </div>');
      redirect('kepegawaian/bagian');
    }
  }

  public function laporan(){
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();

    $this->load->view('header/header');
    $this->load->view('header/navkepegawaian',$data);
    $this->load->view('kepegawaian/laporan',$data);
    $this->load->view('header/footer');
  }

  public function slipgaji(){
    $this->load->library('pagination');
    $config['base_url'] = "http://localhost/sipeg/kepegawaian/slipgaji";
    $config['total_rows'] = $this->kepegawaian_model->jum_peg();
    $config['per_page'] = 5;

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

    
    $data['start'] = $this->uri->segment(3);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['pegawai'] = $this->kepegawaian_model->data_peg($config['per_page'], $data['start']);
    $data['jumlah'] = $this->kepegawaian_model->jum_peg();
    $this->load->view('header/header');
    $this->load->view('header/navkepegawaian', $data);
    $this->load->view('kepegawaian/dataslipgaji', $data);
    $this->load->view('header/footer');
  }

  public function detailslip($nip){
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['gaji'] = $this->kepegawaian_model->getTanggalGaji($nip);
    $data['jab'] = $this->pegawai_model->getPegawaiById($nip);
    $data['slip'] = $this->pegawai_model->getSlip($nip);
    $this->load->view('header/header');
    $this->load->view('header/navkepegawaian', $data);
    $this->load->view('kepegawaian/slipgaji', $data);
    $this->load->view('header/footer');
  }

  public function cetakslip($nip){
    $bulan = date('m');
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['jab'] = $this->pegawai_model->getPegawaiById($nip);
    $data['gaji'] = $this->kepegawaian_model->getTanggalGaji($nip);
    $data['slip'] = $this->pegawai_model->getSlip($nip);

    
    
    ob_start();
        
        $this->load->view('kepegawaian/cetakslip', $data);
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
<td width="40%" align="right"><img src="assets/img/brand/villakancil.png" width="200px" /></td>
<td width="100%" align="center"><h1>Slip Gaji Pegawai</h1><br><h1>Villa Kancil Kampoeng Sunda</h1></td>
</tr>
</table><hr class="line-block"><br>';

        $pdf->SetHTMLHeader($header);
        $pdf->showImageErrors = true;
        $pdf->WriteHTML($html);
        $pdf->Output('Slip Gaji.pdf', 'D');
    


  }

  
  
  public function presensi()
  {
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    
    $this->form_validation->set_rules('nama','NIP','required',['required'=>'NIP tidak terdaftar']);

    if ($this->form_validation->run()==false) {
      $data['abs'] = $this->k_model->hasilabsen();
      $data['absensi'] = $this->k_model->tampilabsen();
    
      $this->load->view('header/header_lap', $data);
    $this->load->view('header/navkepegawaian');
    $this->load->view('kepegawaian/presensi',$data);
    
    }else{
      $aktif = 'aktif';
      $nip = $this->input->post('nip');
      $data['cek'] = $this->kepegawaian_model->getCek($nip);
      $status = $this->input->post('id_status');
      if($data['cek']==0){
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
          NIP '.$nip.' Sedang Cuti
          </div>');
          redirect('kepegawaian/presensi');
      }else{
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');
        
        $now = date('Y-m-d');

        if(date('Y-m-d',strtotime($tanggal_mulai))==$now){
          
          $tanggal_setelah_mulai = date ("Y-m-d", strtotime("+1 day", strtotime($tanggal_mulai)));//looping tambah 1 date
          while (strtotime($tanggal_setelah_mulai) <= strtotime($tanggal_selesai)) {
            $dating[]=[
              'nip' => $nip,
              'tanggal' => $tanggal_setelah_mulai,
              'id_status' => $status
            ];

          $tanggal_setelah_mulai = date ("Y-m-d", strtotime("+1 day", strtotime($tanggal_setelah_mulai)));//looping tambah 1 date
         }
         $this->kepegawaian_model->insertPresensi($dating);
         $this->kepegawaian_model->updatePresensi($nip,$status);
        }else{
          while (strtotime($tanggal_mulai) <= strtotime($tanggal_selesai)) {
            $dating[]=[
              'nip' => $nip,
              'tanggal' => $tanggal_mulai,
              'id_status' => $status
            ];

          $tanggal_mulai = date ("Y-m-d", strtotime("+1 day", strtotime($tanggal_mulai)));//looping tambah 1 date
         }
         $this->kepegawaian_model->insertPresensi($dating);
        }
        
        
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
        Presensi Berhasil Disimpan
        </div>');
        redirect('kepegawaian/presensi');
      }
        
      
    
    }
  }

  public function tambahbagian(){
    $dariDB = $this->kepegawaian_model->cekKodeJabatan();
 
    $nourut = substr($dariDB,2,2);
    $kodeJabatanSekarang = $nourut+1;
    $data['kode_jabatan'] = $kodeJabatanSekarang;
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['jb'] = $this->kepegawaian_model->jab();
    $data['log'] = $this->kepegawaian_model->getlog();
    
    $this->form_validation->set_rules('nama_jabatan', 'NAMA JABATAN', 'required');
    $this->form_validation->set_rules('gaji', 'GAJI', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('header/header');
      $this->load->view('header/navkepegawaian');
      $this->load->view('kepegawaian/tambahbagian', $data);
      $this->load->view('header/footer');
    } else {
      $this->kepegawaian_model->tambahbagian();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data Berhasil Ditambahkan
      </div>');
      redirect('kepegawaian/bagian');
    }
  }

  public function editpresensi($id)
  {
    $data['idpeg'] = $this->kepegawaian_model->getAbsenById($id);
    $data['idlog'] = $this->kepegawaian_model->getLoginById($id);
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    


    $this->form_validation->set_rules('id_status', 'Status', 'required');


    if ($this->form_validation->run() == false) {
      $this->load->view('header/header');
      $this->load->view('header/navkepegawaian');
      $this->load->view('kepegawaian/editpresensi', $data);
      $this->load->view('header/footer');
    } else {
      $this->kepegawaian_model->edit_presensi($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Data Berhasil Diubah
      </div>');
      redirect('kepegawaian/absensi_pegawai');
    }
  }

}

