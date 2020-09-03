<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_login');
	}

	function login()
	{
		$data['title'] = 'Login | Sistem Informasi Sekolah';
		if($this->session->userdata('email') != "") {
			redirect('Dashboard');
		} else {
			$this->load->view('login', $data);
		}
	}

	function proccLogin()
	{
		$post = $this->input->post();

		$json['status'] = 'gagal';
		$user = $post['username'];
		$pass = md5(sha1(md5($post['password'])));

		$cekUser = $this->M_login->cekUser($user, $pass);
		if ($cekUser->num_rows() == 1) {
			$cekPass = $cekUser->row();
			if ($cekPass->password == $pass) {
				if($cekPass->is_active == 1){
					$json['status'] = 'gagal';
					$json['keterangan'] = 'Akun Anda Sedang Aktif di perangkat lain, Logout dahulu';
				} else {
					$exp = explode(']', $cekPass->level);
					if(in_array(5, $exp)) {
						$cekGuru = $this->db->get_where('master_guru', array('id_user', $cekPass->id));
						if($cekGuru->num_rows() <= 0) {
							$json['status'] = 'gagal';
							$json['keterangan'] = 'Data anda tidak ditemukan, segera hubungi Admin';
						} else {
							$data['id_guru'] = $cekGuru->row()->id;
						}
					}

					$level = $cekPass->level;
					
					$exp = explode('[', $level);
					$list = array();

					foreach($exp as $x) :
						$rep = str_replace(']', '', $x);
						array_push($list, $rep);
					endforeach;
					$data = array(
						'id' => $cekPass->id,
						'fullname' => $cekPass->fullname,
						'email' => $cekPass->email,
						'level' => $list,
						'active' => 1,
					);
					// $this->M_login->is_active($cekPass->id);
					$this->session->set_userdata($data);
					$json['status'] = 'berhasil';
				}
			} else {
				$json['status'] = 'gagal';
				$json['keterangan'] = 'Password Salah, Periksa Kembali Inputan Anda';
			}
		} else {
			$json['status'] = 'gagal';
			$json['keterangan'] = 'Nim Salah, Periksa Kembali Inputan Anda';
		}

		echo json_encode($json);
	}

	function logout()
	{
		// $this->M_login->isnt_active($this->session->userdata('id'));
		$this->session->sess_destroy();
		redirect('Admin/login');
	}


}
