<?php
defined('BASEPATH') or exit('No direct script access allowed');
class LaporanGaji_model extends CI_Model {

  public function view_by_month($month, $year, $limit, $offset){
  	$valid = 'validpemilik';
    $this->db->select('gaji.nip');
        $this->db->select('gaji.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('total_gaji');
        $this->db->select('status_gaji');
        $this->db->from('gaji');
        $this->db->join('pegawai','gaji.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        $this->db->where('status_gaji', $valid); // Tambahkan where tahun
        
    return $this->db->get('', $limit, $offset)->result_array(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
  
  public function view_by_month_print($month, $year){
    $valid = 'validpemilik';
    $this->db->select('gaji.nip');
    $this->db->select('gaji.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('total_gaji');
        $this->db->select('status_gaji');
        $this->db->from('gaji');
        $this->db->join('pegawai','gaji.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        $this->db->where('status_gaji', $valid); // Tambahkan where tahun
        
    return $this->db->get()->result_array(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
  public function view_month_rows($month,$year){
    $valid = 'validpemilik';
    $this->db->select('gaji.nip');
        $this->db->select('gaji.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('total_gaji');
        $this->db->from('gaji');
        $this->db->join('pegawai','gaji.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        $this->db->where('status_gaji', $valid); // Tambahkan where tahun
        
    return $this->db->get()->num_rows();
  }

  public function view_year_rows($year){
    $valid = 'validpemilik';
    $this->db->select('gaji.nip');
    $this->db->select('gaji.tanggal');
    $this->db->select('status_gaji');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('total_gaji');
        $this->db->from('gaji');
        $this->db->join('pegawai','gaji.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        $this->db->where('status_gaji', $valid); // Tambahkan where tahun

        
    return $this->db->get()->num_rows();
  }

  public function view_by_year($year,$limit,$offset){
    $valid = 'validpemilik';
  		$this->db->select('gaji.nip');
        $this->db->select('gaji.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('total_gaji');
        $this->db->select('status_gaji');
        $this->db->from('gaji');
        $this->db->join('pegawai','gaji.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        $this->db->where('status_gaji', $valid); // Tambahkan where tahun
        
    return $this->db->get('',$limit, $offset)->result_array(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
  }

  public function view_by_year_print($year){
      $valid = 'validpemilik';
      $this->db->select('gaji.nip');
      $this->db->select('gaji.tanggal');
      $this->db->select('pegawai.nama');
      $this->db->select('status_gaji');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->select('total_gaji');
      $this->db->from('gaji');
      $this->db->join('pegawai','gaji.nip=pegawai.nip');
      $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
      $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
      $this->db->where('status_gaji', $valid); // Tambahkan where tahun
      
  return $this->db->get()->result_array(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
}
    
  public function view_all($limit, $offset){
    $valid = 'validpemilik';
    $this->db->select('gaji.nip');
    $this->db->select('gaji.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('total_gaji');
        $this->db->from('gaji');
        $this->db->join('pegawai','gaji.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('status_gaji', $valid); // Tambahkan where tahun
    return $this->db->get('',$limit, $offset)->result_array(); // Tampilkan semua data transaksi
  }

  public function view_all_print(){
    $valid = 'validpemilik';
    $this->db->select('gaji.nip');
        $this->db->select('gaji.tanggal');
      $this->db->select('pegawai.nama');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->select('total_gaji');
      $this->db->from('gaji');
      $this->db->join('pegawai','gaji.nip=pegawai.nip');
      $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
      $this->db->where('status_gaji', $valid); // Tambahkan where tahun
  return $this->db->get()->result_array(); // Tampilkan semua data transaksi
}

  public function view_all_rows(){
    $valid = 'validpemilik';
    $this->db->select('gaji.nip');
        $this->db->select('gaji.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('total_gaji');
        $this->db->from('gaji');
        $this->db->join('pegawai','gaji.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('status_gaji', $valid); // Tambahkan where tahun
    return $this->db->get()->num_rows();
  }
    
    public function option_tahun(){
    	
        $this->db->select('YEAR(tanggal) AS tahun'); // Ambil Tahun dari field tgl
        $this->db->from('gaji'); // select ke tabel transaksi
        $this->db->order_by('YEAR(tanggal)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal)'); // Group berdasarkan tahun pada field tgl
        
        return $this->db->get()->result_array(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
}