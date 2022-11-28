<?php

class K_model extends CI_Model
{

	public function tampilabsen()
	{
		return $this->db->get('pegawai');
	}

	function cari($id)
	{
		$aktif = 'aktif';
		$query = $this->db->get_where('pegawai', array('nip' => $id));
		return $query;
	}

	function cariabsenmasuk($nip){
		$waktu = NULL;
		$tanggal = date('Y-m-d');
		$this->db->select('tanggal');
		$this->db->select('nip');
		$this->db->select('waktu_masuk');
		$this->db->from('absensi');
		$this->db->where('nip',$nip);
		$this->db->where('tanggal',$tanggal);
		$this->db->where('waktu_masuk !=',$waktu);

		return $this->db->get()->num_rows();
		
	}
	function absenmasuk($nip){
		$tanggal = date('Y-m-d');
		return $this->db->get_where('absensi', array('nip' => $nip,'tanggal'=>$tanggal, 'waktu_masuk !='=>NULL))->num_rows();
		
	}

	function cariabsenpulang($nip){
		$tanggal = date('Y-m-d');
		return $this->db->get_where('absensi', array('nip' => $nip,'tanggal'=>$tanggal, 'waktu_keluar='=>NULL))->num_rows();
		
	}
	public function getNip(){
		$status='aktif';
		$this->db->select('nip');
		$this->db->from('pegawai');
		$this->db->where('status',$status);

		return $this->db->get()->result_array();

	}
	public function getNipCuti(){
		$status='cuti';
		$this->db->select('nip');
		$this->db->from('pegawai');
		$this->db->where('status',$status);

		return $this->db->get()->result_array();

	}

	public function cariNip(){
		$t = 7;
		$d = 8;
		$tanggal = date('Y-m-d');
		$bln = date('m');

		$this->db->select('*');
		$this->db->from('absensi');
		$this->db->where('tanggal',$tanggal);
		$this->db->where('id_status !=',$t);
		$this->db->or_where('id_status !=',$d);
		$this->db->where('tanggal',$tanggal);
		
		return $this->db->get()->num_rows();
	}


	public function defaultAbsen($nip){
		$waktu = date('H:i:s');

		if($waktu>"00:00:01"){
			$this->db->insert_batch('absensi',$nip);
		}
	}
	public function defaultAbsenCuti($data){
		$waktu = date('H:i:s');

		if($waktu>"00:00:01"){
			$this->db->insert_batch('absensi',$data);
		}
	}
	public function getNipCutiRows(){
		$cuti='cuti';
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where('status',$cuti);
		return $this->db->get()->num_rows();
	}

	function tambahabsen()
	{
		$nip = $this->input->post('nip', true);

		$tanggal = date('Y-m-d');
		date_default_timezone_set('Asia/Jakarta');
		$waktu = date('H:i:s');
		if($waktu>'08:00:00'){

			$status_absen =10;
			//10 adalah Terlambat dan Belum Presensi Pulang
		}else{ 
			$status_absen = 9;
			//9 adalah Tepat Waktu Namun Belum Presensi Pulang
		}

		$data = [
			"waktu_masuk" => $waktu,
			"id_status" => $status_absen

		];

		$this->db->where('nip', $nip);
		$this->db->update('absensi', $data);
	}

	public function cekCuti(){
		$date = date('Y-m-d');
		$kemarin = date("Y-m-d", strtotime("-1 day", strtotime($date)));
		$acc = 'acc';
		$this->db->select('*');
		$this->db->from('cuti');
		$this->db->where('tanggal_mulai',$date);
		$this->db->or_where('tanggal_selesai',$kemarin);
		$this->db->where('status_pengajuan',$acc);

		return $this->db->get()->result_array();
	}

	public function cuti_selesai($nip,$data){

		$this->db->set('status',$data);
		$this->db->where('nip',$nip);
		$this->db->update('pegawai'	);
	}
	
	function tambahpulang()
	{
		$nip = $this->input->post('nip', true);

		$tanggal = date('Y-m-d');
		date_default_timezone_set('Asia/Jakarta');
		$waktu = date('H:i:s');
			$tanggal = date('Y-m-d');
	$this->db->select('waktu_masuk');
	$this->db->select('tanggal');
	$this->db->select('nip');
	$this->db->from('absensi');
	$this->db->where('tanggal',$tanggal);
	$this->db->where('nip',$nip);
$hasil = $this->db->get()->result_array();
		
		foreach ($hasil as $key ) {
			
			if($waktu<'17:00:00' && $key['waktu_masuk']>'08:00:00'){
				
				$status_absen = 4;
			}else if($waktu<'17:00:00' && $key['waktu_masuk']<'08:00:00'){
				$status_absen = 3;
			}else if($waktu>'17:00:00' && $key['waktu_masuk']>'08:00:00'){
				$status_absen = 2;
			}else{
				$status_absen = 1;
			}
		}

		$data = [
			"waktu_keluar" => $waktu,
			"id_status" => $status_absen

		];


		$this->db->where('nip', $nip);
		$this->db->where('tanggal', $tanggal);
		$this->db->update('absensi', $data);
	}

public function cek(){
	$nip='190';
	$tanggal = date('Y-m-d');
	$this->db->select('waktu_masuk');
	$this->db->select('tanggal');
	$this->db->select('nip');
	$this->db->from('absensi');
	$this->db->where('tanggal',$tanggal);
	$this->db->where('nip',$nip);

		return $this->db->get()->result_array();
}

	function hasilabsen()
	{
		$s = '9';
		$sp = '10';
		$now = date('Y-m-d');
		$this->db->select('absensi.nip');
		$this->db->select('pegawai.nama');
		$this->db->select('waktu_masuk');
		$this->db->select('waktu_keluar');
		$this->db->select('tanggal');
		$this->db->select('id_status');
		$this->db->from('absensi');
		$this->db->join('pegawai', 'absensi.nip=pegawai.nip');
		$this->db->where('id_status between 1 and 5');
		$this->db->where('tanggal', $now);
		$this->db->or_where('id_status',$s);
		$this->db->where('tanggal', $now);
		$this->db->or_where('id_status',$sp);
		$this->db->where('tanggal', $now);

		return $this->db->get()->result_array();
	}
}
