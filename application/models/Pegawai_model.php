<?php

class Pegawai_model extends CI_Model
{
    public function getCutiPrint($id){
        $this->db->select('cuti.id_cuti');
        $this->db->select('cuti.nip');
        $this->db->select('pegawai.nama');
        $this->db->select('tanggal_mulai');
        $this->db->select('tanggal_selesai');
        $this->db->select('alasan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->where('id_cuti',$id);

        return $this->db->get()->row_array();
    }
    public function getCuti($nip)
    {
        return $this->db->get_where('cuti', ['nip' => $nip])->result_array();
    }

    public function getCutiById($id){
        $this->db->select('cuti.id_cuti');
        $this->db->select('cuti.nip');
        $this->db->select('pegawai.nama');
        $this->db->select('tanggal_mulai');
        $this->db->select('tanggal_selesai');
        $this->db->select('alasan');
        $this->db->from('cuti');
        $this->db->join('pegawai','cuti.nip=pegawai.nip');
        $this->db->where('id_cuti',$id);

        return $this->db->get()->result_array();
    }

    public function tambah_cuti()
    {
        $cuti = [
            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'nip' => $this->input->post('nip'),
            'alasan' => $this->input->post('alasan'),
            'status_pengajuan' => 'belum'
        ];
        $this->db->insert('cuti', $cuti);
    }

    public function edit_cuti($id){
        $belum = 'belum';
        $cuti = [
            'tanggal_mulai' => $this->input->post('tanggal_mulai'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
            'nip' => $this->input->post('nip'),
            'alasan' => $this->input->post('alasan'),
            'status_pengajuan' => $belum
            
        ];
        $this->db->where('id_cuti',$id);
        $this->db->update('cuti',$cuti);

    }

    public function hapus_cuti($id)
    {
        $this->db->where('id_cuti', $id);
        $this->db->delete('cuti');
    }

    public function getSlip($nip){
        $h=date('d');
        if($h<=25){

        
        $dl=25;
        $d=date('Y-m-'.$dl);
        $kemarin= date('Y-m-d', strtotime("-1 month", strtotime($d)));
        $depan = date('Y-m-d', strtotime("+1 day", strtotime($kemarin)));

        $valid = 'validpemilik';
        $this->db->select('gaji.tanggal');
        $this->db->select('gaji.nip');
        $this->db->select('pegawai.nama');
        $this->db->select('pegawai.foto');
        $this->db->select('pegawai.alamat');
        $this->db->select('potongan');
        $this->db->select('hadir');
        $this->db->select('terlambat');
        $this->db->select('alpa');
        $this->db->select('pulang_awal');
        $this->db->select('terlambat_pulang_awal');
        $this->db->select('total_gaji');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('jabatan.gaji');
        $this->db->select('status_gaji');
        $this->db->select('presensi_belum');
        $this->db->select('terlambat_presensi_belum');
        $this->db->from('gaji');
        $this->db->join('pegawai','gaji.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('gaji.nip',$nip);
        $this->db->where('status_gaji',$valid);
        $this->db->where('tanggal >=',$depan);
        $this->db->where('tanggal <=',$d);
        return $this->db->get()->result_array();
    }else{
        $dl=26;
        $d=date('Y-m-'.$dl);
        $kemarin= date('Y-m-d', strtotime("+1 month", strtotime($d)));
        $depan = date('Y-m-d', strtotime("-1 day", strtotime($kemarin)));

        $valid = 'validpemilik';
        $this->db->select('gaji.tanggal');
        $this->db->select('gaji.nip');
        $this->db->select('pegawai.nama');
        $this->db->select('pegawai.foto');
        $this->db->select('pegawai.alamat');
        $this->db->select('potongan');
        $this->db->select('hadir');
        $this->db->select('terlambat');
        $this->db->select('alpa');
        $this->db->select('pulang_awal');
        $this->db->select('terlambat_pulang_awal');
        $this->db->select('total_gaji');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('jabatan.gaji');
        $this->db->select('status_gaji');
        $this->db->select('presensi_belum');
        $this->db->select('terlambat_presensi_belum');
        $this->db->from('gaji');
        $this->db->join('pegawai','gaji.nip=pegawai.nip');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->where('gaji.nip',$nip);
        $this->db->where('status_gaji',$valid);
        $this->db->where('tanggal >=',$d);
        $this->db->where('tanggal <=',$depan);
        return $this->db->get()->result_array();
    }

    }

    public function getStatus($nip){
        $status = 'cuti';
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->where('nip',$nip);
        $this->db->where('status',$status);
        return $this->db->get()->num_rows();

    }

    public function hadir($nip){
        $satu =1;
        $dua =2;
        $tiga =3;
        $empat =4;
        $tanggal = date('m');
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('month(tanggal)',$tanggal);
        $this->db->where('nip',$nip);
        $this->db->where('id_status between 1 and 4');
        return $this->db->get()->num_rows();
    }

    public function getPegawaiById($nip){
        $this->db->select('pegawai.nip');
        $this->db->select('pegawai.kode_jabatan');
        $this->db->select('foto');
        $this->db->select('jenis_kelamin');
        $this->db->select('status_perkawinan');
        $this->db->select('nama');
        $this->db->select('password');
        $this->db->select('alamat');
        $this->db->select('jabatan.nama_jabatan');
        $this->db->select('jabatan.gaji');
        $this->db->from('pegawai');
        $this->db->join('jabatan','jabatan.kode_jabatan=pegawai.kode_jabatan');
        $this->db->join('login','login.nip=pegawai.nip');
        $this->db->where('pegawai.nip',$nip);

        return $this->db->get()->result_array();

    }

    public function edit_profil($nip,$foto){
        $nama = $this->input->post('nama');

        $alamat = $this->input->post('alamat');
        $fot = $foto;
        $pass = $this->input->post('password');

        $data = [
            'nip' => $nip,
            'nama' => $nama,
            'alamat' => $alamat,
           
            'foto' => $fot
        ];

        $akun = [
            'password' => $pass
        ];

        $this->db->where('nip',$nip);
        $this->db->update('pegawai',$data);

        $this->db->where('nip',$nip);
        $this->db->update('login',$akun);
    }
}
