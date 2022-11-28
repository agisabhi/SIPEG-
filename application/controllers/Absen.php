<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('k_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $id=6; //6 artinya tidak hadir
    $cutiid = 11;//11 artinya sedang cuti
    $tanggal = date('Y-m-d');
    $hari = date('l',strtotime($tanggal));
    $data['abs'] = $this->k_model->hasilabsen();
		$data['cek'] = $this->k_model->cariNip();
    $nip = $this->k_model->getNip();
    $nipcuti = $this->k_model->getNipCuti();
    $data['nipcuticek'] = $this->k_model->getNipCutiRows();
    $data['absensi'] = $this->k_model->tampilabsen();
    $data['abse'] = $this->k_model->cek();
    $cuti = $this->k_model->cekCuti();

    foreach ($cuti as $c) {
      $data['tanggal_selesai'] = date("Y-m-d", strtotime("+1 day", strtotime($c['tanggal_selesai'])));
      $mulai_cuti = "cuti";
      $selesai_cuti = "aktif";
      if ($c['tanggal_mulai']==$tanggal) {

          $this->k_model->cuti_selesai($c['nip'],$mulai_cuti);
      }else if($data['tanggal_selesai']==$tanggal){
          $this->k_model->cuti_selesai($c['nip'],$selesai_cuti);
      }
    }
    
    if($data['cek']=="0"){
      if ($hari=='Friday') {
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            Hari Jumat Libur
          </div>');
    redirect($_SERVER['HTTP_REFERER']);
      }else{
        if($data['nipcuticek']>=1){

          foreach ($nipcuti as $nc ) {
            $datum[] = [ 
              'nip'=>$nc['nip'],
              'id_status' =>$cutiid,
              'tanggal' => $tanggal
            ];
          }
          $this->k_model->defaultAbsenCuti($datum);
        }

        foreach ($nip as $n ) {
          $datu[] = [ 
            'nip'=>$n['nip'],
            'id_status' =>$id,
            'tanggal' => $tanggal
          ];
        }
        $this->k_model->defaultAbsen($datu);
        
      }
    }

    
    
    $this->load->view('header/header');
    $this->load->view('absensi',$data);
    $this->load->view('header/footer');
  }
 
  public function cari()
  {
    $nip = $_GET['nip'];
    $cari = $this->k_model->cari($nip)->result();
    echo json_encode($cari);
  }

  public function tambah()
  {
    
    $this->form_validation->set_rules('nama','NIP','required',['required'=>'NIP tidak terdaftar']);

    if ($this->form_validation->run()==false) {
      $data['abs'] = $this->k_model->hasilabsen();
      $data['absensi'] = $this->k_model->tampilabsen();
    
    $this->load->view('header/header');
    $this->load->view('absensi',$data);
    $this->load->view('header/footer');
    }else{
      $aktif = 'aktif';
      $nip = $this->input->post('nip');
      $cek = $this->db->get_where('pegawai',['nip'=>$nip,'status'=>$aktif])->num_rows();
      $status = $this->input->post('pilihan');
      $datang = $this->k_model->cariabsenmasuk($nip);
      $pulang = $this->k_model->cariabsenpulang($nip);
      if ($cek==0) {
        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
            NIP '.$nip.' Sedang Cuti
          </div>');
    redirect($_SERVER['HTTP_REFERER']);
      }else{

        if ($status=="datang" && $datang==0) {
          $this->k_model->tambahabsen();
          $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
          Presensi Datang Berhasil
          </div>');
          redirect($_SERVER['HTTP_REFERER']);
        }else if ($status=="pulang" && $pulang=="1") {
          $this->k_model->tambahpulang();
          $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">
          Presensi Pulang Berhasil
          </div>');
          redirect($_SERVER['HTTP_REFERER']);
        }else if ($status=="pulang" && $pulang=="0") {
        
          $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
          Anda Belum Presensi Datang
          </div>');
          redirect($_SERVER['HTTP_REFERER']);
        }else if ($status=="datang" && $datang=="1") {
          
          $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">
          Anda Sudah Presensi Datang
          </div>');
          redirect($_SERVER['HTTP_REFERER']);
        }
        
      }
      
    
    }
  }
}
