<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemilik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pegawai_model');
        $this->load->model('pemilik_model');
        $this->load->model('kepegawaian_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['jum_abs'] = $this->kepegawaian_model->jum_abs();
        $data['jumlah'] = $this->kepegawaian_model->jum_peg();
        $data['pem'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
        $this->load->view('header/header');
        $this->load->view('header/navpemilik');
        $this->load->view('Pemilik/index', $data);
        $this->load->view('header/footer');
    }

    public function gaji()
    {
        $this->load->library('pagination');
        $config['base_url'] = "http://localhost/sipeg/pemilik/gaji";
        $config['total_rows'] = $this->pemilik_model->jum_log();
        $config['per_page'] = 50;

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
        $data['pem'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
        $data['gaji'] = $this->pemilik_model->getGaji($config['per_page'], $data['start']);

        $this->load->view('header/header');
        $this->load->view('header/navpemilik', $data);
        $this->load->view('pemilik/pemgaji', $data);
        $this->load->view('header/footer');
    }

    public function validasigaji()
    {
        $a = $this->input->post('no_slip[]');
        $b = $this->input->post('status_gaji[]');

        $i = 1;
        foreach ($b as $status) {
            if (!empty($status)) {
                $where = [
                    'no_slip' => $a[$i]

                ];
                $data = ['status_gaji' => $status];
                $this->pemilik_model->validasi_gaji($where, $data);
            }
            $i++; 
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data Validasi Pemilik Berhasil Disimpan
      </div>');
        redirect('pemilik/gaji');
    }

    public function laporan(){
    $data['bag'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();

    $this->load->view('header/header');
    $this->load->view('header/navpemilik',$data);
    $this->load->view('pemilik/laporan',$data);
    $this->load->view('header/footer');
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
    $this->load->view('header/navpemilik', $data);
    $this->load->view('pemilik/dataabsenpegawai', $data);
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
                
                $ket = 'Data Presensi Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'pemilik/cetak?nip='.$data['nip'].'&filter=1&tanggal='.$tgl;
                $total_rows = $this->kepegawaian_model->view_date_rows($nip, $tgl);
                $transaks = $this->kepegawaian_model->view_by_date($nip, $tgl, $config['per_page'], $data['start']); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Presensi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $total_rows = $this->kepegawaian_model->view_month_rows($nip, $bulan,$tahun);
                $url_cetak = 'pemilik/cetak?nip='.$data['nip'].'&filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaks = $this->kepegawaian_model->view_by_month($nip, $bulan, $tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Presensi Tahun '.$tahun;
                $total_rows = $this->kepegawaian_model->view_year_rows($nip, $tahun);
                $url_cetak = 'pemilik/cetak?nip='.$data['nip'].'&filter=3&tahun='.$tahun;
                $transaks = $this->kepegawaian_model->view_by_year($nip, $tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Presensi';
            $url_cetak = 'pemilik/cetak/'.$nip;
            $total_rows = $this->kepegawaian_model->view_all_rows($nip);
            $transaks = $this->kepegawaian_model->view_all($nip, $config['per_page'], $data['start']); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/sipeg/index.php/pemilik/detailabsen/'.$nip;
        $config['total_rows'] = $total_rows;
        $config['num_links'] = 2;
        
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
    $this->load->view('header/navpemilik', $data);
    $this->load->view('pemilik/detailabsensi', $data);
    
  }


  public function cetak(){
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
                
                $ket = 'Data Presensi NIP '.$nip.' Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $transaksi = $this->kepegawaian_model->view_by_month_print($nip, $bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Presensi NIP '.$nip.' Tahun '.$tahun;
                $transaksi = $this->kepegawaian_model->view_by_year_print($nip, $tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Presensi';
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

    public function slipgaji(){
    $this->load->library('pagination');
    $config['base_url'] = "http://localhost/sipeg/pemilik/slipgaji";
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
    $this->load->view('header/navpemilik', $data);
    $this->load->view('pemilik/dataslipgaji', $data);
    $this->load->view('header/footer');
  }

  public function detailslip($nip){
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['gaji'] = $this->kepegawaian_model->getTanggalGaji($nip);
    $data['jab'] = $this->pegawai_model->getPegawaiById($nip);
    $data['slip'] = $this->pegawai_model->getSlip($nip);
    $this->load->view('header/header');
    $this->load->view('header/navpemilik', $data);
    $this->load->view('pemilik/slipgaji', $data);
    $this->load->view('header/footer');
  }

  public function cetakslip($nip){
$data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['jab'] = $this->pegawai_model->getPegawaiById($nip);

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
}
