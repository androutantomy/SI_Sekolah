<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_login');
	}


	public function index()
	{
		$data['judul'] = 'Profile';
		$data['aktif'] = 'dashboard';
		$data['subview'] = 'admin/user/profile';
		$data['data_user'] = $this->db->get_where('user', array('id' => $this->session->userdata('id')))->row();
		
		$this->load->view('admin/layout/layout', $data);
	}

	function listStrata($strata = null)
	{
		$option = "<option value=''>-- Pilih --</option>";
		$get = $this->db->get_where('master_strata', array('id_parent' => 0))->result_array();
		foreach($get as $get => $g) {
			($g['id'] == $strata) ? $selected = 'selected' : $selected = '';
			$option .= "<option value='". $g['id'] ."' $selected >". $g['nama'] ."</option>";
		}

		echo $option;
	}

	function listLevel()
	{
		$level = $this->session->userdata('level');
		$exp = explode('[', $level);
		$list = array();

		foreach($exp as $x) :
			$rep = str_replace(']', '', $x);
			array_push($list, $rep);
		endforeach;

		$option = "";
		$get = $this->db->get('user_level')->result_array();
		if( in_array(1, $list) ) {
			foreach($get as $gt => $g):
				$checked = (in_array($g['id'], $list)) ? 'checked' : '';
				$option .= "<div class='col-md-3 icheck-primary d-inline'><input name='level[]' type='checkbox' id='". $g['id'] ."' value='". $g['id'] ."' $checked><label class='form-check-label' for='". $g['id'] ."'>". $g['level'] ."</label></div>";
			endforeach;
		}

		echo $option; 
	}

	function updateAkun()
	{
		$post = $this->input->post();
		$daftar = '';

		$data = [
			'username' 		=> $post['username'],
			'fullname'		=> $post['fullname'],
			'strata'		=> $post['strata'],
		];

		foreach($post['level'] as $lvl) :
			$daftar .= '['.$lvl.']'; 
		endforeach;

		$data['level'] = $daftar;

		$update = $this->db->where('id', $this->session->userdata('id'))->update('user', $data);
		if($update){
			$json = ['s' => 'sukses', 'm' => 'Berhasil update data'];
		} else {
			$json = ['s' => 'gagal', 'm' => 'Gagal update data'];
		}

		echo json_encode($json);
	}
}

