<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index()
	{
		$data['judul'] = 'Evaluasi Kegiatan';
        $data['aktif'] = 'evaluasi';
        $data['subview'] = 'website/index';
        $this->load->view('website/layout/layout', $data);
	}


}
