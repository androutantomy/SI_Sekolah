<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if($this->session->userdata('active') == null) {
			redirect('Admin/login');
		}
	}	
	
	public function index()
	{
		$data['judul'] = 'Dashboard';
		$data['aktif'] = 'dashboard';
		$data['subview'] = 'admin/dashboard';
		$this->load->view('admin/layout/layout', $data);
	}

}
