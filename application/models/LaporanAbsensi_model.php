<?php
defined('BASEPATH') or exit('No direct script access allowed');
class LaporanAbsensi_model extends CI_Model {
  public function view_by_date($date, $limit, $offset){
        $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('tanggal', $date); // Tambahkan where tanggal nya
        
    return $this->db->get('',$limit,$offset)->result_array();// Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
  }

  public function view_by_date_print($date){
    $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('absensi.tanggal', $date); // Tambahkan where tanggal nya
        $this->db->order_by('absensi.tanggal');
        return $this->db->get()->result_array();
  }

  public function view_date_rows($date){
    $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('DATE(absensi.tanggal)', $date); // Tambahkan where tanggal nya

        return $this->db->get()->num_rows();
  }

  public function view_by_month($month, $year, $limit, $offset){
  		$this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get('', $limit, $offset)->result_array(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
  
  public function view_by_month_print($month, $year){
  		$this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        $this->db->order_by('absensi.tanggal');
        
    return $this->db->get()->result_array(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
  }
  public function view_month_rows($month,$year){
    $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('MONTH(tanggal)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get()->num_rows();
  }

  public function view_year_rows($year){
    $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get()->num_rows();
  }

  public function view_by_year($year,$limit,$offset){
  		$this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
        
    return $this->db->get('',$limit, $offset)->result_array(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
  }

  public function view_by_year_print($year){
    $this->db->select('absensi.nip');
      $this->db->select('absensi.tanggal');
      $this->db->select('pegawai.nama');
      $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->from('absensi');
      $this->db->join('pegawai','absensi.nip=pegawai.nip');
      $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
      $this->db->order_by('absensi.tanggal');
      $this->db->where('YEAR(tanggal)', $year); // Tambahkan where tahun
      
  return $this->db->get()->result_array(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
}
    
  public function view_all($limit, $offset){
  		$this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
    return $this->db->get('',$limit, $offset)->result_array(); // Tampilkan semua data transaksi
  }

  public function view_all_print(){
    $this->db->select('absensi.nip');
      $this->db->select('absensi.tanggal');
      $this->db->select('pegawai.nama');
      $this->db->select('waktu_masuk');
        $this->db->select('waktu_keluar');
        $this->db->select('id_status');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->from('absensi');
      $this->db->join('pegawai','absensi.nip=pegawai.nip');
      $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
      $this->db->order_by('absensi.tanggal');
  return $this->db->get()->result_array(); // Tampilkan semua data transaksi
}

  public function view_all_rows(){
    $this->db->select('absensi.nip');
        $this->db->select('absensi.tanggal');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->from('absensi');
        $this->db->join('pegawai','absensi.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
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

    public function view_bagian_rows($bagian){
      $this->db->select('nip');
      $this->db->select('nama');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->select('status');
      $this->db->from('pegawai');
      $this->db->join('jabatan','pegawai.kode_jabatan=jabatan.kode_jabatan');
      $this->db->where('pegawai.kode_jabatan',$bagian);

      return $this->db->get()->num_rows();
    }
    
    public function view_by_bagian($bagian,$limit,$offset){
      $this->db->select('nip');
      $this->db->select('nama');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->select('status');
      $this->db->from('pegawai');
      $this->db->join('jabatan','pegawai.kode_jabatan=jabatan.kode_jabatan');
      $this->db->where('pegawai.kode_jabatan',$bagian);
      
      return $this->db->get('',$limit,$offset)->result_array();
    }
    public function view_by_bagian_print($bagian){
      $this->db->select('nip');
      $this->db->select('nama');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->select('status');
      $this->db->from('pegawai');
      $this->db->join('jabatan','pegawai.kode_jabatan=jabatan.kode_jabatan');
      $this->db->where('pegawai.kode_jabatan',$bagian);
      
      return $this->db->get()->result_array();
    }
    public function view_pegawai_rows(){
      $this->db->select('nip');
      $this->db->select('nama');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->select('status');
      $this->db->from('pegawai');
      $this->db->join('jabatan','pegawai.kode_jabatan=jabatan.kode_jabatan');

      return $this->db->get()->num_rows();
    }
    public function view_all_pegawai($limit, $offset){
      $this->db->select('nip');
      $this->db->select('nama');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->select('status');
      $this->db->from('pegawai');
      $this->db->join('jabatan','pegawai.kode_jabatan=jabatan.kode_jabatan');

      return $this->db->get('',$limit,$offset)->result_array();
    }
    public function view_all_pegawai_print(){
      $this->db->select('nip');
      $this->db->select('nama');
      $this->db->select('jabatan.nama_jabatan');
      $this->db->select('status');
      $this->db->from('pegawai');
      $this->db->join('jabatan','pegawai.kode_jabatan=jabatan.kode_jabatan');

      return $this->db->get()->result_array();
    }

    
}