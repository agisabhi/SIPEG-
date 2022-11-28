<?php

class Pemilik_model extends CI_Model
{
    public function getGaji($limit, $offset)
    {
        $bln = date('m');
        $valid = 'validkep';
        $this->db->select('gaji.no_slip');
        $this->db->select('gaji.nip');
        $this->db->select('pegawai.nama');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('total_gaji');
        $this->db->select('status_gaji');
        $this->db->from('gaji');
        $this->db->join('pegawai', 'gaji.nip=pegawai.nip');
        $this->db->join('jabatan', 'jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('status_gaji', $valid);
        $this->db->where('month(tanggal)', $bln);



        return $this->db->get('')->result_array();
    }

    public function jum_log()
    {
        return $this->db->get('gaji')->num_rows();
    }
    public function validasi_gaji($where, $data)
    {
        $this->db->where($where);
        $this->db->update('gaji', $data);
    }
}
