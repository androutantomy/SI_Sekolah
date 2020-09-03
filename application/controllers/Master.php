<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if($this->session->userdata('active') == null) {
			redirect('Admin/login');
		}
		$this->load->model('M_master');
		$this->load->model('M_user');
		$this->load->model('M_siswa');
		$this->load->model('M_guru');
		$this->load->library('pagination');
	}	
	
	public function index()
	{
		$data['judul'] = 'Admin - Postingan';
		$data['aktif'] = 'pelajaran';
		$data['subview'] = 'admin/postingan';
		$this->load->view('admin/layout/layout', $data);
	}

	function user()
	{
		$data['judul'] = 'Master - Master User';
		$data['aktif'] = 'user';
		$data['subview'] = 'admin/master/user';
		$data['level'] = $this->M_master->level_user();

		$jumlah_data = $this->M_user->jumlah_user();
		$config['base_url'] = base_url().'Master/user/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 9;
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div style="margin:1px;" class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);	

		$data['user'] = $this->M_user->data_user('user', $config['per_page'], $from);

		$this->load->view('admin/layout/layout', $data);
	}

	function pelajaran()
	{
		$data['judul'] = 'Master - Master Pelajaran';
		$data['aktif'] = 'pelajaran';
		$data['subview'] = 'admin/master/pelajaran/list';
		$get = $this->input->get();
		
		$jumlah_data = $this->db->get('master_mata_pelajaran')->num_rows();
		$config['base_url'] = base_url().'Master/pelajaran/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 9;
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div style="margin:1px;" class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);	

		$data['pelajaran'] = $this->M_user->data_user('master_mata_pelajaran', $config['per_page'], $from);
		$data['strata']		= $this->db->get_where('master_strata', array('id_parent' => 0))->result_array();

		$this->load->view('admin/layout/layout', $data);
	}

	function siswa()
	{
		$data['judul'] = 'Admin - Master Siswa';
		$data['aktif'] = 'siswa';
		$data['subview'] = 'admin/master/siswa/list';
		$this->load->view('admin/layout/layout', $data);
	}

	function tambah_siswa($id = "")
	{
		$data['judul'] = 'Admin - Master Siswa | Tambah Siswa';
		$data['aktif'] = 'siswa';
		$data['subview'] = 'admin/master/siswa/create';
		$data['siswa'] = $this->db->get_where('master_siswa', array('md5(id)' => $id))->row();
		$data['ortu']  = $this->db->get_where('master_orang_tua', array('md5(id_siswa)' => $id))->row();
		$data['agama'] = $this->db->get('master_agama')->result_array();
		$data['kerja'] = $this->db->get('master_kerja')->result_array();
		$data['pendidikan'] = $this->db->get('master_pendidikan')->result_array();
		$data['penghasilan'] = $this->db->get('master_penghasilan')->result_array();
		$this->load->view('admin/layout/layout', $data);
	}

	public function strata()
	{
		$data['judul'] = 'Admin - Strata';
		$data['aktif'] = 'strata';
		$data['subview'] = 'admin/master/strata/list';
		$data['strata'] = $this->db->get('master_strata')->result_array();
		$this->load->view('admin/layout/layout', $data);
	}

	function detail_siswa($id)
	{
		$data['judul'] = 'Admin - Master Siswa | Tambah Siswa';
		$data['aktif'] = 'siswa';
		$data['subview'] = 'admin/master/siswa/detail';
		$data['siswa'] = $this->db->join('master_orang_tua', 'master_orang_tua.id_siswa = master_siswa.id')->get_where('master_siswa', array('md5(master_siswa.id)' => $id))->row();
		if($data['siswa']->id_user != "") { 
			$data['user'] = $this->db->get_where('user', array('id' => $data['siswa']->id_user))->row(); 
		}
		$this->load->view('admin/layout/layout', $data);
	}

	function create_user()
	{
		$post = $this->input->post();
		// echo "<pre>"; print_r($post);exit;
		if($post['nama_lengkap'] == "") {
			$json = array('m' => 'Isikan Nama lengkap User dahulu', 's' => 'gagal');
			echo json_encode($json);
			exit;
		}
		$data['fullname'] = $post['nama_lengkap'];

		if($post['username'] == "") {
			$json = array('m' => 'Isikan Username User dahulu', 's' => 'gagal');
			echo json_encode($json);
			exit;
		}
		$data['username'] = $post['username'];

		if(!isset($post['level'])) {
			$json = array('m' => 'Silahkan pilih Level User dahulu', 's' => 'gagal');
			echo json_encode($json);
			exit;
		} elseif(isset($post['level']) && is_array($post['level'])) {
			$lvlx = "";
			foreach($post['level'] as $lvl) {
				$lvlx .= "[".$lvl."]";
			}
		} else {
			$lvlx = "[".$post['level']."]";
		}
		$data['level'] = $lvlx;

		if($post['id']  != "") {
			if($post['password'] != "") {
				if($post['password'] == "") {
					$json = array('m' => 'Isikan Password User dahulu', 's' => 'gagal');
					echo json_encode($json);
					exit;
				}
				$data['password'] = md5(sha1(md5($post['password'])));

				if($post['re-password'] != $post['password']) {
					$json = array('m' => 'Kolom Konformasi Password tidak sesuai', 's' => 'gagal');
					echo json_encode($json);
					exit;
				}
			}

			if($post['email'] == "") {
				$json = array('m' => 'Isikan Email terlebih dahulu', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
				$json = array('m' => 'Email tidak valid', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
			$data['email'] = $post['email'];
		} else {

			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL) && !isset($post['stage'])) {
				$json = array('m' => 'Email tidak valid', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
			$email = $this->db->get_where('user', array('email' => $post['email']))->num_rows();
			if($email >= 1) {
				$json = array('m' => 'Email sudah digunakan', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
			$data['email'] = $post['email'];

			if($post['password'] == "") {
				$json = array('m' => 'Isikan Password User dahulu', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
			$data['password'] = md5(sha1(md5($post['password'])));

			if($post['re-password'] != $post['password']) {
				$json = array('m' => 'Kolom Konformasi Password tidak sesuai', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
		}

		if($post['id'] != "") {
			$simpan = $this->M_user->edit_user($data, $post['id']);
		} else {
			$simpan = $this->M_user->simpan_user($data);
		}

		if($simpan) {
			$json = array('s' => 'sukses', 'm' => 'Berhasil simpan data user ');
		} else {
			$json = array('s' => 'gagal', 'm' => 'Gagal simpan data user');
		}
		echo json_encode($json);
	}

	function create_strata()
	{
		$post = $this->input->post();

		if($post['nama'] == ''){
			$json = array('s' => 'gagal', 'm' => 'Isikan Nama Strata Dahulu');
			echo json_encode($json);
			exit;
		} $data['nama'] = $post['nama'];

		$data['id_parent'] = $post['sub'];

		$simpan = $this->db->insert('master_strata', $data);
		if($simpan) {
			$json = array('s' => 'sukses', 'm' => 'Berhasil simpan data ');
		} else {
			$json = array('s' => 'gagal', 'm' => 'Gagal simpan data');
		}
		echo json_encode($json);
	}

	function add_mapel()
	{
		$post = $this->input->post();

		if($post['mapel'] == ''){
			$json = array('s' => 'gagal', 'm' => 'Isikan Nama Mata Pelajaran Dahulu');
			echo json_encode($json);
			exit;
		} $data['nama'] = $post['mapel'];

		if(!isset($post['strata'])) {
			$json = array('s' => 'gagal', 'm' => 'Isikan Strata Dahulu');
			echo json_encode($json);
			exit;
		}

		$s = "";


		foreach($post['strata'] as $str) {
			$s .= "[".$str."]";
		}

		$data['strata'] = $s;

		if($post['id'] == "") {
			$input = $this->db->insert('master_mata_pelajaran', $data);
		} else {
			$input = $this->db->where('id', $post['id'])->update('master_mata_pelajaran', $data);
		}

		if($input) { 
			$json = array('s' => 'sukses', 'm' => 'Berhasil simpan data mata pelajaran ');
		} else {
			$json = array('s' => 'gagal', 'm' => 'Gagal simpan data mata pelajaran');
		}
		echo json_encode($json);
	}

	function add_siswa()
	{
		$post = $this->input->post();

		// echo "<pre>"; print_r($post);exit;
		$required = array(
			'nama', 'nipd', 'nisn', 'skhun', 'nik', 'tempat_lahir', 'tanggal_lahir', 'gender', 'agama',
			'akta_lahir', 'anak_ke', 'alamat', 'ayah', 'ibu', 'nik_ayah', 'nik_ibu', 'pekerjaan_ayah',
			'pekerjaan_ibu', 'tgl_lahir_ayah', 'tgl_lahir_ibu', 'pendidikan_ayah', 'pendidikan_ibu',
			'penghasilan_ayah', 'penghasilan_ibu',
		);

		foreach ($post as $ps => $pst) {
			if(in_array($ps, $required)) {
				if($this->input->post($ps) == "") {
					$json = array('s' => 'gagal', 'm' => 'Pastikan anda melengkapi semua data pada kolom yang bertanda bintang (*)');
					echo json_encode($json);
					exit;
				} 
			}
		}

		if($post['gender'] == "") {
			$json = array('s' => 'gagal', 'm' => 'Lengkapi data jenis kelamin');
			echo json_encode($json);
			exit;
		} elseif(!isset($post['gender'])) {
			$json = array('s' => 'gagal', 'm' => 'Lengkapi data jenis kelamin');
			echo json_encode($json);
			exit;
		}

		$userSiswa = [
			'username'		=> $post['nisn'],
			'password'		=> md5(sha1(md5($post['nisn']))),
			'email'			=> '',
			'fullname'		=> $post['nama'],
			'level'			=> 7,
			'tangga_daftar' => date('Y-m-d'),
			'strata'		=> 1
		];

		$addUserSiswa = $this->db->insert('user', $userSiswa);
		$insert_id = $this->db->insert_id();

		$siswa = array(
			'id_user'		=> $insert_id,
			'nama' 			=> $post['nama'],
			'nisn'			=> $post['nisn'],
			'nipd'			=> $post['nipd'],
			'nik'			=> $post['nik'],
			'skhun'			=> $post['skhun'],
			'tempat_lahir'	=> $post['tempat_lahir'],
			'tanggal_lahir'	=> date('Y-m-d', strtotime($post['tanggal_lahir'])),
			'jk'			=> $post['gender'],
			'agama'			=> $post['agama'],
			'telepon'		=> $post['telp'],
			'hp'			=> $post['hp'],
			'email' 		=> $post['email'],
			'akta_lahir'	=> $post['akta_lahir'],
			'kebutuhan_khusus'	=> $post['kebutuhan'],
			'anak_ke'		=> $post['anak_ke'],
			'alamat'		=> $post['alamat'],
		);

		if($post['id'] == "") {
			$insert_siswa = $this->db->insert('master_siswa', $siswa);
			$insert_id = $this->db->insert_id();
		} else {		
			$insert_siswa = $this->db->where('id', $post['id'])->update('master_siswa', $siswa);
			$insert_id = $post['id'];
		}

		$ortu = array(
			'id_siswa' 				=> $insert_id,
			'ayah'					=> $post['ayah'],
			'ibu'					=> $post['ibu'],
			'wali'					=> $post['wali'],
			'nik_ayah'				=> $post['nik_ayah'],
			'nik_ibu'				=> $post['nik_ibu'],
			'nik_wali'				=> $post['nik_wali'],
			'kerja_ayah'			=> $post['pekerjaan_ayah'],
			'kerja_ibu'				=> $post['pekerjaan_ibu'],
			'kerja_wali'			=> $post['pekerjaan_wali'],
			'lahir_ayah'			=> date('Y-m-d', strtotime($post['tgl_lahir_ayah'])),
			'lahir_ibu'				=> date('Y-m-d', strtotime($post['tgl_lahir_ibu'])),
			'lahir_wali'			=> date('Y-m-d', strtotime($post['tgl_lahir_wali'])),
			'pendidikan_ayah'		=> $post['pendidikan_ayah'],
			'pendidikan_ibu'		=> $post['pendidikan_ibu'],
			'pendidikan_wali'		=> $post['pendidikan_wali'],
			'penghasilan_ayah'		=> $post['penghasilan_ayah'],
			'penghasilan_ibu'		=> $post['penghasilan_ibu'],
			'penghasilan_wali'		=> $post['penghasilan_wali'],
		);

		if($post['id'] == "") {
			$insert_ortu = $this->db->insert('master_orang_tua', $ortu);
		} else {
			$insert_ortu = $this->db->where('id', $post['id'])->update('master_orang_tua', $ortu);
		}

		if($insert_ortu) {
			$json = array('s' => 'sukses', 'm' => 'Berhasil simpan data siswa');
			echo json_encode($json);
			exit;
		}

	}

	function hapus_siswa() 
	{
		$post = $this->input->post();

		$hapus = $this->db->where('md5(id)', $post['id'])->delete('master_siswa');

		if($hapus){
			$this->db->where('md5(id_siswa)', $post['id'])->delete('master_orang_tua');
			$json = array('s' => 'sukses', 'm' => 'Berhasil hapus data');
		} else {
			$json = array('s' => 'error', 'm' => 'Gagal hapus data');
		}

		echo json_encode($json);
	} 

	function populate_mapel($id)
	{
		$data['mapel'] = $this->db->get_where('master_mata_pelajaran', array('id' => $id))->row();
		$rep = str_replace("[", "", $data['mapel']->strata);
		$exp = explode(']', $rep);
		$strata = array();
		foreach($exp as $e) {
			if($e != "") {
				array_push($strata, $e);
			}
		}
		$data['strata'] = $strata;
		$data['daftar'] = $this->db->get_where('master_strata', array('id_parent' => 0))->result_array();
		$this->load->view('admin/master/pelajaran/create', $data);
	}

	function populate_user($id)
	{
		$user = $this->db->get_where('user', array('id' => $id))->row();
		$rep = str_replace("[", "", $user->level);
		$exp = explode(']', $rep);
		$level = array();
		foreach($exp as $e) {
			if($e != "") {
				array_push($level, $e);
			}
		}

		$json = array(
			's'			=> 'sukses',
			'id' 		=> $user->id,
			'username'	=> $user->username,
			'email'		=> $user->email,
			'fullname'	=> $user->fullname,
			'level'		=> $level,
		);

		echo json_encode($json);
	}

	function edit($id)
	{
		$data['level'] = $this->M_master->level_user();
		$user = $this->db->get_where('user', array('id' => $id))->row();
		$rep = str_replace("[", "", $user->level);
		$exp = explode(']', $rep);
		$level = array();
		foreach($exp as $e) {
			if($e != "") {
				array_push($level, $e);
			}
		}

		$data['user'] = array(
			's'			=> 'sukses',
			'id' 		=> $user->id,
			'username'	=> $user->username,
			'email'		=> $user->email,
			'fullname'	=> $user->fullname,
			'data_level'		=> $level,
		);

		$this->load->view("admin/master/user/index", $data);
	}

	function hapus($table, $id)
	{
		$post = $this->input->post();

		$user = $this->db->where('id', $id)->delete($table);
		if($user){
			$json = array('s' => 'sukses', 'm' => 'Berhasil hapus user');
		} else {
			$json = array('s' => 'error', 'm' => 'Gagal hapus user');
		}
		echo json_encode($json);
	}

	function list_siswa()
	{
		$list = $this->M_siswa->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nisn;
			$row[] = $field->nama;
			$row[] = $field->tempat_lahir.", ". date('d-m-Y', strtotime($field->tanggal_lahir));

			if($field->jk == 1) {
				$jk = "Laki - Laki";
			} else {
				$jk = "Perempuan";
			}
			$row[] = $jk;
			$row[] = $this->lib->pencarian('master_agama', $field->agama);
			$row[] = $field->hp;
			$row[] = $field->alamat;
			$datahm = "";
			$datahm	= $datahm . " <a href='#' class='btn btn-sm btn-success detail' title='Detail Siswa' role='button' id='" . md5($field->id) . "'><i class='fa fa-user-cog'></i></a>";
			$datahm	= $datahm . " <a href='#' class='btn btn-sm btn-warning edit' title='Edit Siswa' role='button' id='" . md5($field->id) . "'><i class='fas fa-pencil-alt'></i></a>";
			$datahm	= $datahm . " <a href='#' class='btn btn-sm btn-danger conf' title='Hapus Siswa' role='button' id='" . md5($field->id) . "'><i class='fas fa-trash-alt'></i></a>";
			$row[] = $datahm;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_siswa->count_all(),
			"recordsFiltered" => $this->M_siswa->count_filtered(),
			"data" => $data,
		);
        //output dalam format JSON
		echo json_encode($output);

	}

	function check_avaliablity()
	{
		$post = $this->input->post();

		// echo "<pre>"; print_r($post);exit;
		if(isset($post['table'])) {
			$cek = $this->db->get_where($post['table'], array($post['tipe'] => $post['val']))->num_rows();
		} else {
			$cek = $this->db->get_where('master_siswa', array($post['tipe'] => $post['val']))->num_rows();
		}

		if($cek >= 1) {
			$json = array('s' => 'gagal', 'm' => $post['tipe']." sudah ada di database");
		} else {
			$json = array('s' => 'sukses');
		}

		echo json_encode($json);
	}

	function export() 
	{
		$data['siswa'] = $this->db->join('master_orang_tua', 'master_orang_tua.id_siswa = master_siswa.id')->get('master_siswa')->result_array();
		$this->load->view('admin/master/siswa/export', $data);
	}

	function guru()
	{
		$data['judul'] = 'Admin - Master Guru';
		$data['aktif'] = 'guru';
		$data['subview'] = 'admin/master/guru/list';
		$this->load->view('admin/layout/layout', $data);
	}

	function tambah_guru($id = null)
	{
		$data['judul'] = 'Admin - Master Guru';
		$data['aktif'] = 'guru';
		$data['subview'] = 'admin/master/guru/add';
		$data['agama'] = $this->db->get('master_agama')->result_array();
		$data['guru'] = $this->db->get_where('master_guru', array('md5(id)' => $id))->row();
		$this->load->view('admin/layout/layout', $data);
	}

	function add_guru()
	{
		$post = $this->input->post();

		$array = array(
			'nama' => 'nama', 'nipy' => 'nipy', 'jk' => 'jenis kelamin', 'hp' => 'no hp', 'tempat_lahir' => 'tempat lahir', 'tanggal_lahir' => 'tanggal lahir', 
			'agama' => 'agama', 'alamat' => 'alamat', 'ijazah' => 'ijazah', 'tugas_mengajar' => 'tugas'
		);

		if(!isset($post['jk'])) {
			$json = array('s' => 'gagal', 'm' => 'Pilih jenis kelamin terlebih dahulu');
			echo json_encode($json);
			exit;
		}

		foreach($array as $arr => $is) {
			if($post[$arr] == '') {
				$json = array('s' => 'gagal', 'm' => 'Isikan '. $is .' terlebih dahulu');
				echo json_encode($json);
				exit;
			} else {
				if($arr == 'tanggal_lahir') {
					$data[$arr] = date('Y-m-d', strtotime($post[$arr]));
				} else {
					$data[$arr] = $post[$arr];
				}
			}
		}

		if($post['id'] != '') {
			$simpan = $this->db->where('md5(id)')->update('master_guru', $data);
		} else {
			$simpan = $this->db->insert('master_guru', $data);
		}


		if($simpan) {
			$json = array('s' => 'sukses', 'm' => 'Berhasil simpan data');
		} else {
			$json = array('s' => 'gagal', 'm' => 'Gagal simpan data');
		}
		
		echo json_encode($json);
	}

	function list_guru()
	{
		$list = $this->M_guru->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nipy;
			$row[] = $field->nama;
			$row[] = $field->tempat_lahir.", ". date('d-m-Y', strtotime($field->tanggal_lahir));

			if($field->jk == 1) {
				$jk = "Laki - Laki";
			} else {
				$jk = "Perempuan";
			}
			$row[] = $jk;
			$row[] = $this->lib->pencarian('master_agama', $field->agama);
			$row[] = $field->hp;
			$row[] = $field->alamat;
			$datahm = "";
			$datahm	= $datahm . " <a href='#' class='btn btn-sm btn-warning edit' title='Edit Guru' role='button' id='" . md5($field->id) . "'><i class='fas fa-pencil-alt'></i></a>";
			$datahm	= $datahm . " <a href='#' class='btn btn-sm btn-danger conf' title='Hapus Guru' role='button' id='" . $field->id . "'><i class='fas fa-trash-alt'></i></a>";
			$row[] = $datahm;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_guru->count_all(),
			"recordsFiltered" => $this->M_guru->count_filtered(),
			"data" => $data,
		);
        //output dalam format JSON
		echo json_encode($output);
	}

	function export_guru()
	{
		$data['guru'] = $this->db->get('master_guru')->result_array();

		$this->load->view('admin/master/guru/export', $data);
	}

	function createUserForSiswa()
	{		
		$post = $this->input->post();
		// echo "<pre>"; print_r($post);exit;
		if($post['nama_lengkap'] == "") {
			$json = array('m' => 'Isikan Nama lengkap User dahulu', 's' => 'gagal');
			echo json_encode($json);
			exit;
		}
		$data['fullname'] = $post['nama_lengkap'];

		if($post['username'] == "") {
			$json = array('m' => 'Isikan Username User dahulu', 's' => 'gagal');
			echo json_encode($json);
			exit;
		}
		$data['username'] = $post['username'];

		if(!isset($post['level'])) {
			$json = array('m' => 'Silahkan pilih Level User dahulu', 's' => 'gagal');
			echo json_encode($json);
			exit;
		} elseif(isset($post['level']) && is_array($post['level'])) {
			$lvlx = "";
			foreach($post['level'] as $lvl) {
				$lvlx .= "[".$lvl."]";
			}
		} else {
			$lvlx = "[".$post['level']."]";
		}
		$data['level'] = $lvlx;

		if($post['id']  != "") {
			if($post['password'] != "") {
				if($post['password'] == "") {
					$json = array('m' => 'Isikan Password User dahulu', 's' => 'gagal');
					echo json_encode($json);
					exit;
				}
				$data['password'] = md5(sha1(md5($post['password'])));

				if($post['re-password'] != $post['password']) {
					$json = array('m' => 'Kolom Konformasi Password tidak sesuai', 's' => 'gagal');
					echo json_encode($json);
					exit;
				}
			}

			if($post['email'] == "") {
				$json = array('m' => 'Isikan Email terlebih dahulu', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
				$json = array('m' => 'Email tidak valid', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
			$data['email'] = $post['email'];
		} else {

			if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL) && !isset($post['stage'])) {
				$json = array('m' => 'Email tidak valid', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
			$email = $this->db->get_where('user', array('email' => $post['email']))->num_rows();
			if($email >= 1) {
				$json = array('m' => 'Email sudah digunakan', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
			$data['email'] = $post['email'];

			if($post['password'] == "") {
				$json = array('m' => 'Isikan Password User dahulu', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
			$data['password'] = md5(sha1(md5($post['password'])));

			if($post['re-password'] != $post['password']) {
				$json = array('m' => 'Kolom Konformasi Password tidak sesuai', 's' => 'gagal');
				echo json_encode($json);
				exit;
			}
		}

		if($post['id'] != "") {
			$simpan = $this->M_user->edit_user($data, $post['id']);
		} else {
			$simpan = $this->M_user->simpan_user($data);
			$insert_id = $this->db->insert_id();
			$this->db->set('id_user', $insert_id)->where('md5(id)', $post['idSiswa'])->update('master_siswa');
		}

		if($simpan) {
			$json = array('s' => 'sukses', 'm' => 'Berhasil simpan data user ');
		} else {
			$json = array('s' => 'gagal', 'm' => 'Gagal simpan data user');
		}
		echo json_encode($json);
	
	}
}
