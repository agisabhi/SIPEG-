<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
 
  public function __construct()
  {
    parent::__construct();
    $this->load->model('pegawai_model');
    $this->load->model('kepegawaian_model');
    $this->load->library('form_validation');
  }
 
  public function index()
  {
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $this->load->view('header/header');
    $this->load->view('header/navpegawai');
    $this->load->view('pegawai/index', $data);
    $this->load->view('header/footer');
  }

  public function cuti()
  {
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['cuti'] = $this->pegawai_model->getCuti($data['peg']['nip']);
    $data['status']=$this->db->get_where('pegawai',['nip' => $this->session->userdata['nip']])->row_array();
    $data['start'] = $this->uri->segment(3);
    $data['status'] = $this->pegawai_model->getStatus($data['peg']['nip']);
    $this->load->view('header/header');
    $this->load->view('header/navpegawai', $data);
    $this->load->view('pegawai/cuti', $data);
    $this->load->view('header/footer');
  }
  
  public function tambahcuti()
  {
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['cuti'] = $this->pegawai_model->getCuti($data['peg']['nip']);
    
    $this->form_validation->set_rules('tanggal_mulai', 'NIP', 'required');
    $this->form_validation->set_rules('tanggal_selesai', 'PASSWORD', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('header/header_lap');
      $this->load->view('header/navpegawai', $data);
      $this->load->view('pegawai/tambahcuti', $data);
      
    } else {
      $this->pegawai_model->tambah_cuti();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data Cuti Berhasil Diajukan
      </div>');
      redirect('pegawai/cuti');
    }
  }
  
  public function rekappresensi(){
    $data['nip'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $nip = $this->session->userdata['nip'];
    $config['per_page'] = 28;
    $data['start'] = $this->uri->segment(4);
	if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                
                $ket = 'Data Absensi Tanggal '.date('d-m-y', strtotime($tgl));
                $url_cetak = 'laporan/cetak?nip='.$data['nip']['nip'].'&filter=1&tanggal='.$tgl;
                $total_rows = $this->kepegawaian_model->view_date_rows($nip, $tgl);
                $transaks = $this->kepegawaian_model->view_by_date($nip, $tgl, $config['per_page'], $data['start']); // Panggil fungsi view_by_date yang ada di TransaksiModel
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                
                $ket = 'Data Absensi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $total_rows = $this->kepegawaian_model->view_month_rows($nip, $bulan,$tahun);
                $url_cetak = 'laporan/cetak?nip='.$data['nip']['nip'].'&filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaks = $this->kepegawaian_model->view_by_month($nip, $bulan, $tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                
                $ket = 'Data Absensi Tahun '.$tahun;
                $total_rows = $this->kepegawaian_model->view_year_rows($nip, $tahun);
                $url_cetak = 'laporan/cetak?nip='.$data['nip']['nip'].'&filter=3&tahun='.$tahun;
                $transaks = $this->kepegawaian_model->view_by_year($nip, $tahun, $config['per_page'], $data['start']); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Absensi';
            $url_cetak = 'kepegawaian/cetak/'.$nip;
            $total_rows = $this->kepegawaian_model->view_all_rows($nip);
            $transaks = $this->kepegawaian_model->view_all($nip, $config['per_page'], $data['start']); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/sipeg/index.php/pegawai/rekappresensi';
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
    $this->load->view('header/navpegawai', $data);
    $this->load->view('pegawai/detailabsensi', $data);
  }
  public function editcuti($id)
  {
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['cuti'] = $this->pegawai_model->getCutiById($id);
    
    $this->form_validation->set_rules('tanggal_mulai', 'Mulai', 'required');
    $this->form_validation->set_rules('tanggal_selesai', 'Selesai', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('header/header_lap');
      $this->load->view('header/navpegawai', $data);
      $this->load->view('pegawai/editcuti', $data);
      
    } else {
      $this->pegawai_model->edit_cuti($id);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Data Cuti Berhasil Diajukan
      </div>');
      redirect('pegawai/cuti');
    }
  }

  
  public function hapuscuti($id)
  {
    $this->pegawai_model->hapus_cuti($id);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    Data Cuti Berhasil Dihapus
    </div>');
    redirect('pegawai/cuti');
  }
  
  public function slipgaji(){
    $dua = 2;
    $tiga = 3;
    $bln = date('m');
    $enam = 6;
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['slip'] = $this->pegawai_model->getSlip($data['peg']['nip']);
    $data['gaji'] = $this->kepegawaian_model->getTanggalGaji($data['peg']['nip']);
    $data['jab'] = $this->pegawai_model->getPegawaiById($data['peg']['nip']);
    $this->load->view('header/header');
    $this->load->view('header/navpegawai', $data);
    $this->load->view('pegawai/slipgaji', $data);
    $this->load->view('header/footer');

  }

  public function cetak(){
    $bulan = date('m');
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['jab'] = $this->pegawai_model->getPegawaiById($data['peg']['nip']);
    $data['gaji'] = $this->db->get_where('gaji', ['nip' => $this->session->userdata['nip'],'month(tanggal)'=>$bulan])->row_array();
    if($data['gaji']['month(tanggal)']=="01"){
      $data['gaji']="Januari";
    }if($data['gaji']['month(tanggal)']=="02"){
      $data['gaji']="Februari";
    }if($data['gaji']['month(tanggal)']=="03"){
      $data['gaji']="Maret";
    }if($data['gaji']['month(tanggal)']=="04"){
      $data['gaji']="April";
    }if($data['gaji']['month(tanggal)']=="05"){
      $data['gaji']="Mei";
    }if($data['gaji']['month(tanggal)']=="06"){
      $data['gaji']="Juni";
    }if($data['gaji']['month(tanggal)']=="07"){
      $data['gaji']="Januari";
    }if($data['gaji']['month(tanggal)']=="10"){
      $data['gaji']="Oktober";
    }if($data['gaji']['month(tanggal)']=="09"){
      $data['gaji']="September";
    }if($data['gaji']['month(tanggal)']=="08"){
      $data['gaji']="Agustus";
    }if($data['gaji']['month(tanggal)']=="11"){
      $data['gaji']="November";
    }else{
      $data['gaji']="Desember";
    }
    $data['slip'] = $this->pegawai_model->getSlip($data['peg']['nip']);
    
    ob_start();
        
        $this->load->view('pegawai/cetak', $data);
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

  public function profil(){
    $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['profil'] = $this->pegawai_model->getPegawaiById($data['peg']['nip']);
    $this->load->view('header/header');
    $this->load->view('header/navpegawai', $data);
    $this->load->view('pegawai/profil', $data);
    $this->load->view('header/footer');
  }

  public function editprofil($nip){
   $data['peg'] = $this->db->get_where('pegawai', ['nip' => $this->session->userdata['nip']])->row_array();
    $data['idpeg'] = $this->pegawai_model->getPegawaiById($nip);
    $data['jb'] = $this->kepegawaian_model->jab();

    $this->form_validation->set_rules('nip', 'NIP', 'required');
    $this->form_validation->set_rules('nama', 'NAMA', 'required');
    
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');

    if ($this->form_validation->run() == false) {
    $this->load->view('header/header');
    $this->load->view('header/navpegawai', $data);
    $this->load->view('pegawai/editprofil', $data);
    $this->load->view('header/footer'); 
  }else{

    if (isset($_POST['submit'])) {
      $file_foto = $this->input->post('file_foto');

      if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {

        $config['upload_path'] = './assets/foto';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 2086;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('foto')) {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Foto Pegawai harus PNG/JPG atau maks ukuran 2 MB
          </div>');
          redirect('pegawai/profil');
        } else {
          $foto = $this->upload->data('file_name');
        }
        $this->pegawai_model->edit_profil($nip,$foto);
        if (file_exists('./assets/foto' . $file_foto)) {
          unlink('./assets/foto' . $file_foto);
        }
      } else {
        $this->pegawai_model->edit_profil($nip,$file_foto);
      }
    }

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Data Berhasil Diubah
      </div>');
      redirect('pegawai/profil');
  }

  }
  public function printcuti($id){
    
    $data['cuti'] = $this->pegawai_model->getCutiPrint($id);
    
    ob_start();
        
        $this->load->view('pegawai/printcuti',$data);
        $html = ob_get_contents();
        ob_end_clean();
        
        require 'vendor/autoload.php'; // Load plugin html2pdfnya
        $pdf = new \Mpdf\Mpdf([
	'mode' => 'c',
	'orientation' => 'P',
	'margin_left' => 32,
	'margin_right' => 25,
	'margin_top' => 43,
	'margin_bottom' => 47,
	'margin_header' => 10,
	'margin_footer' => 10,
    'format' => 'A4'
]);
$header = '
<table width="100%"><tr>
<td width="33%" align="right"><img src="assets/img/brand/villakancil.png" width="200px" /></td>
<td width="100%" align="center"><h1>Surat Keterangan Cuti Pegawai<br>Villa Kancil Kampoeng Sunda</h1></td>
</tr>
</table><hr class="line-block"><br>';

        $pdf->SetHTMLHeader($header);
        $pdf->showImageErrors = true;
        $pdf->WriteHTML($html);
        $pdf->Output('Surat Keterangan Cuti.pdf', 'D');


  }
}
