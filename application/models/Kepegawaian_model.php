<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepegawaian_model extends CI_Model
{ 
    //Tampil datapegawai
    public function data_peg($limit, $offset)
    { 
        $this->db->select('nip');
        $this->db->select('nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('alamat');
        $this->db->select('jenis_kelamin');
        $this->db->select('status_perkawinan');
        $this->db->from('pegawai');
        $this->db->join('jabatan', 'pegawai.kode_jabatan=jabatan.kode_jabatan');

        return $this->db->get('', $limit, $offset)->result_array();
    }

    //ambil data login
    public function getlog()
    {
        return $this->db->get('login')->result_array();
    }

    //lihat jumlah record pada tabel
    public function jum_peg()
    {
        $this->db->select('*');
        $this->db->from('pegawai');

        return $this->db->get()->num_rows();
    }

    public function getAbsenById($id)
    {
        $this->db->select('*');
        $this->db->select('pegawai.nama');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->where('no_absen',$id);

        return $this->db->get()->row_array();
    }

    //lihat jumlah yang absensi hari ini
    public function jum_abs()
    {
        $date = date('Y-m-d');
        $s = '9';
        $sp = '10';
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('tanggal', $date);
        $this->db->where('id_status between 1 and 5');
        $this->db->or_where('id_status',$s);
        $this->db->where('tanggal', $date);
        $this->db->or_where('id_status',$sp);
        $this->db->where('tanggal', $date);

        return $this->db->get()->num_rows();
    }

    //lihat jumlah record tabel login
    public function jum_log()
    {

        return $this->db->get('login')->num_rows();
    }

    //tampil tabel jabatan
    public function jab()
    {
        return $this->db->get('jabatan')->result_array();
    }

    //tambah data pegawai + login
    public function tambah_peg()
    {
        $date = date('Y');
        $kode_jabatan = $this->input->post('jabatan');
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $password = $this->input->post('password');
        $status_kawin = $this->input->post('status_perkawinan');
        $aktif = 'aktif';
        $role = "pegawai";

        $pegawai = [
            'nip' => $date.$kode_jabatan.$nip,
            'nama' => $nama,
            'kode_jabatan' => $kode_jabatan,
            'alamat' => $alamat,
            'status' => $aktif,
            'status_perkawinan' => $status_kawin,
            'jenis_kelamin' => $jenis_kelamin
        ];

        $login = [
            'nip'  => $date.$kode_jabatan.$nip,
            'password' => $password,
            'role' => $role
        ];
        $this->db->insert('pegawai', $pegawai);
        $this->db->insert('login', $login);
    }

    public function getTanggalGaji($nip){
        $bulan = date('m');
        $this->db->select('month(tanggal) as tanggal');
        $this->db->from('gaji');
        $this->db->where('nip',$nip);
        $this->db->where('month(tanggal)',$bulan);

        return $this->db->get()->row_array();
    }
    //ambil data pegawai berdasarkan id
    public function getPegawaiById($id)
    {
        return $this->db->get_where('pegawai', ['nip' => $id])->row_array();
    }

    //ambil data login berdasarkan id
    public function getLoginById($id)
    {
        return $this->db->get_where('login', ['id' => $id])->row_array();
    }

    //edit data pegawai
    public function edit_peg()
    {
        $editpeg = [

            'nip' => $this->input->post('nip'),
            'nama' => $this->input->post('nama'),
            'kode_jabatan' => $this->input->post('jabatan'),
            'alamat' => $this->input->post('alamat'),
            'status' => $this->input->post('status'),
            'status_perkawinan' => $this->input->post('status_perkawinan'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
        ];
        $this->db->where('nip', $this->input->post('nip'));
        $this->db->update('pegawai', $editpeg);
    }

    public function edit_presensi($id)
    {
        $editpeg = [

            'id_status' => $this->input->post('id_status')
        ];
        $this->db->where('no_absen', $id);
        $this->db->update('absensi', $editpeg);
    }

    //tampil halaman data akun
    public function data_log($limit, $offset)
    {
        $this->db->select('id');
        $this->db->select('login.nip');
        $this->db->select('pegawai.nama');
        $this->db->select('password');
        $this->db->select('role');
        $this->db->from('login');
        $this->db->join('pegawai', 'login.nip=pegawai.nip');
        return $this->db->get('', $limit, $offset)->result_array();
    }

    //edit data login
    public function edit_akun($id)
    {
        $editpeg = [

            'nip' => $this->input->post('nip'),
            'password' => $this->input->post('password'),
            'role' => 'pegawai'

        ];
        $this->db->where('id', $id);
        $this->db->update('login', $editpeg);
    }

    public function getCuti()
    {
        $sp = 'belum';
        $this->db->select('cuti.id_cuti');
        $this->db->select('cuti.nip');
        $this->db->select('nama');
        $this->db->select('tanggal_mulai');
        $this->db->select('tanggal_selesai');
        $this->db->select('alasan');
        $this->db->from('cuti');
        $this->db->join('pegawai', 'cuti.nip=pegawai.nip');
        $this->db->where('cuti.status_pengajuan', $sp);

        return $this->db->get()->result_array();
    }

    public function getCutiAcc()
    {
        $sp = 'acc';
        $this->db->select('cuti.id_cuti');
        $this->db->select('cuti.nip');
        $this->db->select('nama');
        $this->db->select('tanggal_mulai');
        $this->db->select('tanggal_selesai');
        $this->db->select('alasan');
        $this->db->select('status_pengajuan');
        $this->db->from('cuti');
        $this->db->join('pegawai', 'cuti.nip=pegawai.nip');
        $this->db->where('cuti.status_pengajuan', $sp);

        return $this->db->get()->result_array();
    }

    public function validasi_cuti($id, $status_pengajuan)
    {
        
        $data=[
            'catatan'=>$this->input->post('catatan'),
            'status_pengajuan'=>$status_pengajuan
        ];
        $this->db->where('id_cuti',$id);
        $this->db->update('cuti', $data);
        
    }

    public function getGajiBulanIni(){
        $h=date('d');
        if($h<=25){

        
        $dl=25;
        $d=date('Y-m-'.$dl);
        $kemarin= date('Y-m-d', strtotime("-1 month", strtotime($d)));
        $depan = date('Y-m-d', strtotime("+1 day", strtotime($kemarin)));

        $this->db->select('*');
        $this->db->from('gaji');
        $this->db->where('tanggal >=',$depan);
        $this->db->where('tanggal <=',$d);
        return $this->db->get()->num_rows();
    }else{
        $dl=26;
        $d=date('Y-m-'.$dl);
        $kemarin= date('Y-m-d', strtotime("+1 month", strtotime($d)));
        $depan = date('Y-m-d', strtotime("-1 day", strtotime($kemarin)));

        $this->db->select('*');
        $this->db->from('gaji');
        $this->db->where('tanggal >=',$d);
        $this->db->where('tanggal <=',$depan);
        return $this->db->get()->num_rows();
    }
    }

    public function validasi_cuti_acc($id,$nip, $status_pengajuan)
    {
        $data=[
            
            'status_pengajuan'=>$status_pengajuan
        ];
        $this->db->where('id_cuti',$id);
        $this->db->update('cuti', $data);
        
        //$status = 'cuti';
        //$data2=[
         //   'status'=>$status
        //];
        //$this->db->where('nip',$nip);
        //$this->db->update('pegawai', $data);

        
    }

    public function getGaji($limit, $offset)
    {   $dl=25;
        if($offset==''){
            $offset=1;
        }
        $h=date('d');
        if($h<=25){

        
        $dl=25;
        $d=date('Y-m-'.$dl);
        $kemarin= date('Y-m-d', strtotime("-1 month", strtotime($d)));
        $depan = date('Y-m-d', strtotime("+1 day", strtotime($kemarin)));
        $sql = "SELECT absensi.nip, tanggal, pegawai.nama, jabatan.kode_jabatan, jabatan.nama_jabatan, jabatan.gaji, sum(CASE id_status WHEN '1' THEN '0'
           WHEN '2' THEN '1'  
           WHEN '3' THEN '1'
           WHEN '4' THEN '2'
           WHEN '6' THEN '2'
           WHEN '10' THEN '2'
           WHEN '9' THEN '1'
           else '0'
          end)as potongan, sum(CASE id_status WHEN '1' THEN '1'
           WHEN '2' THEN '1'  
           WHEN '3' THEN '1'
           WHEN '4' THEN '1'
           WHEN '9' THEN '1'
           WHEN '10' THEN '1'
           WHEN '6' THEN '0' 
           else '0'
          end)as hadir, sum(CASE id_status WHEN '6' THEN '1'
           else '0'
          end)as alpa, sum(CASE id_status WHEN '2' THEN '1'
           else '0'
          end)as terlambat, sum(CASE id_status WHEN '3' THEN '1'
           else '0'
          end)as pulang_awal, sum(CASE id_status WHEN '4' THEN '1'
           else '0'
          end)as terlambat_pulang_awal,sum(CASE id_status WHEN '9' THEN '1'
           else '0'
          end)as pulang_belum, sum(CASE id_status WHEN '10' THEN '1'
           else '0'
          end)as terlambat_pulang_belum FROM `absensi` join `pegawai` on absensi.nip=pegawai.nip join jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan where tanggal between '$depan' and '$d' group by absensi.nip limit $limit offset $offset";
        }else{
            $dl=26;
        $d=date('Y-m-'.$dl);
        $kemarin= date('Y-m-d', strtotime("+1 month", strtotime($d)));
        $depan = date('Y-m-d', strtotime("+1 day", strtotime($kemarin)));
        $sql = "SELECT absensi.nip, tanggal, pegawai.nama, jabatan.kode_jabatan, jabatan.nama_jabatan, jabatan.gaji, sum(CASE id_status WHEN '1' THEN '0'
           WHEN '2' THEN '1'  
           WHEN '3' THEN '1'
           WHEN '4' THEN '2'
           WHEN '6' THEN '2'
           WHEN '10' THEN '2'
           WHEN '9' THEN '1'
           else '0'
          end)as potongan, sum(CASE id_status WHEN '1' THEN '1'
           WHEN '2' THEN '1'  
           WHEN '3' THEN '1'
           WHEN '4' THEN '1'
           WHEN '9' THEN '1'
           WHEN '10' THEN '1'
           WHEN '6' THEN '0' 
           else '0'
          end)as hadir, sum(CASE id_status WHEN '6' THEN '1'
           else '0'
          end)as alpa, sum(CASE id_status WHEN '2' THEN '1'
           else '0'
          end)as terlambat, sum(CASE id_status WHEN '3' THEN '1'
           else '0'
          end)as pulang_awal, sum(CASE id_status WHEN '4' THEN '1'
           else '0'
          end)as terlambat_pulang_awal,sum(CASE id_status WHEN '9' THEN '1'
           else '0'
          end)as pulang_belum, sum(CASE id_status WHEN '10' THEN '1'
           else '0'
          end)as terlambat_pulang_belum FROM `absensi` join `pegawai` on absensi.nip=pegawai.nip join jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan where tanggal between '$d' and '$depan' group by absensi.nip ";
        }
        
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getGaj(){
        $bln = date('m');
        $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama'); 
        $this->db->select('pegawai.kode_jabatan');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('jabatan.gaji');
        
        $this->db->from('absensi');
        $this->db->join('pegawai', 'absensi.nip=pegawai.nip');
        $this->db->join('jabatan', 'jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('MONTH(absensi.tanggal)', $bln);
        $this->db->group_by('nip');

        return $this->db->get()->num_rows();

    }
 
    public function validasi_gaji($data)
    {
        $this->db->insert_batch('gaji', $data);
    }

    public function insertPresensi($data)
    {
        $this->db->insert_batch('absensi', $data);
    }




    public function view_by_date($nip, $date, $limit, $offset){
        $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('id_status');
        $this->db->select('no_absen');
        $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.nip', $nip);
        $this->db->where('absensi.tanggal', $date); // Tambahkan where tanggal nya
        
    return $this->db->get('',$limit,$offset)->result_array();// Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
  }

  public function view_by_date_print($nip, $date){
    $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('id_status');
        $this->db->select('no_absen');
        $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.nip', $nip);
        $this->db->where('absensi.tanggal', $date); // Tambahkan where tanggal nya
        return $this->db->get()->result_array();
  }

  public function view_date_rows($nip, $date){
    $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.tanggal', $date); // Tambahkan where tanggal nya
        $this->db->where('absensi.nip', $nip);

        return $this->db->get()->num_rows();
  }

  public function view_by_month($nip, $month, $year, $limit, $offset){
  		$this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('waktu_masuk');
        $this->db->select('no_absen');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.nip', $nip);
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get('', $limit, $offset)->result_array(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
  
  public function view_by_month_print($nip, $month, $year){
  		$this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('waktu_masuk');
        $this->db->select('no_absen');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.nip', $nip);
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get()->result_array(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
  public function view_month_rows($nip, $month,$year){
    $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.nip', $nip);
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get()->num_rows();
  }

  public function view_year_rows($nip, $year){
    $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('waktu_masuk');
        $this->db->select('no_absen');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.nip', $nip);
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get()->num_rows();
  }

  public function view_by_year($nip, $year,$limit,$offset){
  		$this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('waktu_masuk');
        $this->db->select('no_absen');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.nip', $nip);
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get('',$limit, $offset)->result_array(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
  }

  public function view_by_year_print($nip, $year){
    $this->db->select('absensi.nip');
      $this->db->select('absensi.tanggal');
      $this->db->select('pegawai.nama');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->select('waktu_masuk');
      $this->db->select('no_absen');
        $this->db->select('waktu_keluar');
      $this->db->select('id_status');
      $this->db->from('absensi');
      $this->db->join('pegawai','absensi.nip=pegawai.nip');
      $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
      $this->db->where('absensi.nip', $nip);
      $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
      
  return $this->db->get()->result_array(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
}
    
  public function view_all($nip, $limit, $offset){
  		$this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('waktu_masuk');
        $this->db->select('no_absen');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.nip', $nip);
    return $this->db->get('',$limit, $offset)->result_array(); // Tampilkan semua data transaksi
  }

  public function view_all_print($nip){
    $this->db->select('absensi.nip');
      $this->db->select('absensi.tanggal');
      $this->db->select('pegawai.nama');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
      $this->db->select('id_status');
      $this->db->select('no_absen');
      $this->db->from('absensi');
      $this->db->join('pegawai','absensi.nip=pegawai.nip');
      $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
      $this->db->where('absensi.nip', $nip);
  return $this->db->get()->result_array(); // Tampilkan semua data transaksi
}

  public function view_all_rows($nip){
    $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.nip', $nip);
    return $this->db->get()->num_rows();
  }
    
    public function option_tahun(){
    	$this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('YEAR(absensi.tanggal) AS tahun'); // Ambil Tahun dari field tgl
        $this->db->from('absensi'); // select ke tabel transaksi
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->order_by('YEAR(absensi.tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(absensi.tanggal)'); // Group berdasarkan tahun pada field tgl
        
        return $this->db->get()->result_array(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

    public function jum_bag(){
        return $this->db->get('jabatan')->num_rows();
    }
    public function data_jab($limit,$offset){
        return $this->db->get('jabatan',$limit,$offset)->result_array();
    }

    public function getJabatanById($id){
        return $this->db->get_where('jabatan',['kode_jabatan'=>$id])->row_array();
    }

    public function edit_jabatan($id)
    {
        $editpeg = [

            
            'nama_jabatan' => $this->input->post('nama_jabatan'),
            'gaji' => $this->input->post('gaji')

        ];
        $this->db->where('kode_jabatan', $id);
        $this->db->update('jabatan', $editpeg);
    }

    public function getCek($nip){
        $aktif = "aktif";
     $this->db->select('*');
     $this->db->from('pegawai');
     $this->db->where('nip',$nip);
     $this->db->where('status',$aktif);
     return $this->db->get()->num_rows();
    }

    public function updatePresensi($nip,$status){

        $date = date('Y-m-d');
        $data=[
            'id_status'=>$status
        ];
        $this->db->where('nip',$nip);
        $this->db->where('tanggal',$date);
        $this->db->update('absensi',$data);
    }

    public function cekKodeJabatan(){
        $query = $this->db->query('SELECT MAX(kode_jabatan) as kode_jabatan from jabatan');
        $hasil = $query->row();
        return $hasil->kode_jabatan;
    }

    public function tambahbagian(){
        $kode_jabatan = $this->input->post('kode_jabatan');
        $nama_jabatan = $this->input->post('nama_jabatan');
        $gaji = $this->input->post('gaji');

        $data = [
            'kode_jabatan' => $kode_jabatan,
            'nama_jabatan' => $nama_jabatan,
            'gaji' => $gaji
        ];
        $this->db->insert('jabatan',$data);
    }

    public function cekKodeNip(){
        $query = $this->db->query('SELECT MAX(substr(nip,8)) as nip from pegawai');
        $hasil = $query->row();
        return $hasil->nip;
    }
}
