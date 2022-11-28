<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('k_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('login');
        $this->load->view('header/footer');
    }

    public function login()
    {
        $nip = $this->input->post('nip');
        $password = $this->input->post('password');

        $akun = $this->db->get_where('login', ['nip' => $nip])->row_array();
        $bio = $this->db->get_where('pegawai', ['nip' => $nip])->row_array();
        //jika nip sudah sama
        if ($akun) {
            if ($password == $akun['password']) {

                $data = [
                    'nip' => $bio['nip'],
                    'nama' => $bio['nama'],
                    'role' => $akun['role']


                ];
                $this->session->set_userdata($data);

                if ($akun['role'] == "bag") {
                    redirect('kepegawaian');
                } else if ($akun['role'] == "pegawai") {
                    redirect('pegawai');
                } else {
                    redirect('pemilik');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Password Salah 
          </div>');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Akun Tidak Terdaftar
          </div>');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nip');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('role');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Berhasil Logout
      </div>');
        redirect('login');
    }
}
