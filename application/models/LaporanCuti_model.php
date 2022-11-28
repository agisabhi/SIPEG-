<?php
defined('BASEPATH') or exit('No direct script access allowed');
class LaporanCuti_model extends CI_Model {

  public function view_by_month($jenis, $month, $year, $limit, $offset){
  	
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('alasan');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('MONTH(tanggal_mulai)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal_mulai)', $year); // Tambahkan where tahun
        $this->db->where('alasan', $jenis); // Tambahkan where tahun
        
    return $this->db->get('', $limit, $offset)->result_array(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
  
  public function view_by_month_print($jenis,$month, $year){
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('alasan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('MONTH(tanggal_mulai)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal_mulai)', $year); // Tambahkan where tahun
        $this->db->where('alasan', $jenis); // Tambahkan where tahun
        
    return $this->db->get()->result_array(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
  public function view_month_rows($jenis,$month,$year){
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('MONTH(tanggal_mulai)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal_mulai)', $year); // Tambahkan where tahun
        $this->db->where('alasan', $jenis); // Tambahkan where tahun
        
    return $this->db->get()->num_rows();
  }

  public function view_year_rows($jenis, $year){
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('YEAR(tanggal_mulai)', $year); // Tambahkan where tahun
        $this->db->where('alasan', $jenis); // Tambahkan where tahun

        
    return $this->db->get()->num_rows();
  }

  public function view_by_year($jenis, $year,$limit,$offset){
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('alasan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('YEAR(tanggal_mulai)', $year); // Tambahkan where tahun
        $this->db->where('alasan', $jenis); // Tambahkan where tahun
        
    return $this->db->get('',$limit, $offset)->result_array(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
  }

  public function view_by_year_print($jenis, $year){
      $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('alasan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('YEAR(tanggal_mulai)', $year); // Tambahkan where tahun
        $this->db->where('alasan', $jenis); // Tambahkan where tahun
      
  return $this->db->get()->result_array(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
}
    
  public function view_all( $limit, $offset){
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('alasan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        return $this->db->get()->result_array(); // Tampilkan semua data transaksi
  }

  public function view_all_print(){
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('alasan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        
  return $this->db->get()->result_array(); // Tampilkan semua data transaksi
}

  public function view_all_rows(){
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        
    return $this->db->get()->num_rows();
  }
  public function view_menikah_rows($jenis){
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('alasan',$jenis);
         
    return $this->db->get()->num_rows();
  }
  public function view_by_menikah($jenis){
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('alasan');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('alasan',$jenis);
        
    return $this->db->get()->result_array();
  }
  public function view_by_menikah_print($jenis){
    $this->db->select('cuti.nip');
        $this->db->select('cuti.tanggal_mulai');
        $this->db->select('cuti.tanggal_selesai');
        $this->db->select('pegawai.nama');
        $this->db->select('alasan');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('alasan',$jenis);
        
    return $this->db->get()->result_array();
  }
    
    public function option_tahun(){
    	
        $this->db->select('YEAR(tanggal_mulai) AS tahun'); // Ambil Tahun dari field tgl
        $this->db->from('cuti'); // select ke tabel transaksi
        $this->db->order_by('YEAR(tanggal_mulai)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal_mulai)'); // Group berdasarkan tahun pada field tgl
        
        return $this->db->get()->result_array(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }
}