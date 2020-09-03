<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if($this->session->userdata('active') == null) {
			redirect('Admin/login');
		}
		$this->load->model('M_kelas');
		$this->load->model('M_tugas');
		$this->load->model('M_siswa_kelas');
		$this->load->model('M_siswaPer_kelas');
		$this->load->library('pagination');
	}	

	function index()
	{
		$data['judul'] = 'Admin - Kelola Kelas';
		$data['aktif'] = 'kelas';
		$data['subview'] = 'admin/kelas/index';
		$this->load->view('admin/layout/layout', $data);
	}

	function ajax_list()
	{
		$list = $this->M_kelas->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nama;
			$row[] = $this->lib->jumlah_siswa($field->id);
			$datahm = "";
			$datahm	= $datahm . " <a href='#' class='btn btn-sm btn-success tambah' title='Tambah Siswa' role='button' id='" . md5($field->id) . "'><i class='fa fa-plus'></i></a>";
			$datahm	= $datahm . " <a href='#' class='btn btn-sm btn-warning siswa' title='Daftar Siswa' role='button' id='" . md5($field->id) . "'><i class='fa fa-user-cog'></i></a>";
			// $datahm	= $datahm . " <a href='#' class='btn btn-sm btn-danger conf' title='Hapus Siswa' role='button' id='" . md5($field->id) . "'><i class='fas fa-trash-alt'></i></a>";
			$row[] = $datahm;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_kelas->count_all(),
			"recordsFiltered" => $this->M_kelas->count_filtered(),
			"data" => $data,
		);
        //output dalam format JSON
		echo json_encode($output);
	}

	function tambah($id)
	{
		$data['judul'] = 'Admin - Kelola Kelas';
		$data['aktif'] = 'kelas';
		$data['subview'] = 'admin/kelas/add';
		$kelas = $this->db->get_where('master_strata', array('md5(id)' => $id))->row();
		$data['kelas'] = $info = array('nama' => $kelas->nama, 'id' => $kelas->id);
		$this->load->view('admin/layout/layout', $data);
	}
	
	function list_siswa()
	{
		$list = $this->M_siswa_kelas->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '<input type="checkbox" id="'. $no .'" name="pilih[]" value="'. $field->id .'">';
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
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_siswa_kelas->count_all(),
			"recordsFiltered" => $this->M_siswa_kelas->count_filtered(),
			"data" => $data,
		);
        //output dalam format JSON
		echo json_encode($output);

	}

	function asign()
	{
		$post = $this->input->post();

		if(!isset($post['pilih'])) {
			$json = array( 's' => 'gagal', 'm' => 'Pilih siswa dahulu' );
			echo json_encode($json);
			exit;
		}

		$jml = count($post['pilih']);

		for($i=0; $i<$jml; $i++) {
			$data = array('id_siswa' => $post['pilih'][$i], 'id_kelas' => $post['id'] );
			$this->db->insert('relasi_siswa_kelas', $data);
		}

		$json = array( 's' => 'sukses', 'm' => 'Berhasil memasukan '.$jml.' siswa' );

		echo json_encode($json);
	}

	function kelas_siswa($id)
	{
		$data['judul'] = 'Admin - Kelola Kelas';
		$data['aktif'] = 'kelas';
		$data['subview'] = 'admin/kelas/list';
		$data['siswa'] = $this->db->select('relasi_siswa_kelas.*, relasi_siswa_kelas.id id_relasi, master_siswa.*')
		->join('master_siswa', 'master_siswa.id = relasi_siswa_kelas.id_siswa')
		->get_where('relasi_siswa_kelas', array('md5(id_kelas)' => $id))->result_array();
		$this->load->view('admin/layout/layout', $data);
	}

	function hapus_siswa()
	{
		$post = $this->input->post();

		$hapus = $this->db->where('md5(id_siswa)', $post['id'])->delete('relasi_siswa_kelas');

		if($hapus) {
			$json = array('s' => 'sukses', 'm' => 'Berhasil hapus');
		} else {

		}
	}

	function jadwal_mapel()
	{
		$data['judul'] = 'Admin - Kelola Kelas';
		$data['aktif'] = 'siswa_mapel';
		$data['subview'] = 'admin/kelas/jadwal_mapel';
		$data['kelas']	= $this->db->get_where('master_strata', array('id_parent <>' => 0))->result_array();
		$data['guru']	= $this->db->get('master_guru')->result_array();
		$data['tahun_ajaran']	= $this->db->get('tahun_ajaran')->result_array();
		$data['mapel']	= $this->db->get('master_mata_pelajaran')->result_array();

		$jumlah_data = $this->M_siswa_kelas->jumlah_kelas(date('N'));
		$config['base_url'] = base_url().'Kelas/jadwal_mapel/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 10;
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

		$data['jadwal'] = $this->M_siswa_kelas->data_siswa_kelas('master_jadwal_mapel', $config['per_page'], $from);
		$this->load->view('admin/layout/layout', $data);
	}

	function add_jadwal()
	{
		$post = $this->input->post();

		$arr = array(
			'id_kelas' => 'kelas', 'id_mapel' => 'Mata Pelajaran', 'id_guru' => 'pengajar', 
			'id_semester' => 'semester', 'hari' => 'hari', 'jam_mulai' => 'jam mulai', 
			'jam_selesai' => 'jam selesai', 

		);

		$data = array();

		$kelas_guru = $this->db->where('hari', $post['hari'])
		->where('jam_mulai >=', $post['jam_mulai'])
		->where('jam_selesai <=', $post['jam_selesai'])
		->where('id_guru', $post['id_guru'])
		->where('id_kelas', $post['id_kelas'])
		->get('master_jadwal_mapel')->num_rows();

		foreach ($arr as $key => $v) {
			if($key == 'jam_selesai') {
				if($post['jam_mulai'] > $post['jam_selesai']) {
					$json = array('s' => 'gagal', 'm' => 'Inputan jam tidak relevan');
					echo json_encode($json);
					exit;
				} elseif($kelas_guru >= 1) {
					$json = array('s' => 'gagal', 'm' => 'Jadwal Jam mengajar bentrok');
					echo json_encode($json);
					exit;
				} else {
					$data[$key] = $post[$key];
				}
			} elseif($post[$key] == '') {
				$json = array('s' => 'gagal', 'm' => 'Isikan '.$v.' terlebih dahulu');
				echo json_encode($json);
				exit;
			} else {
				$data[$key] = $post[$key];
			}
		}

		$insert = $this->db->insert('master_jadwal_mapel', $data);
		if($insert) {
			$json = array('s' => 'sukses', 'm' => 'Berhasil simpan data');
		} else {
			$json = array('s' => 'gagal', 'm' => 'Gagal simpan data');
		}

		echo json_encode($json);
	}

	function list_kelas_mapel()
	{
		$post = $this->input->post();

		$ambil = $this->db->get_where('master_strata', array('id' => $post['id_kelas']))->row();

		$mapel = $this->db->select('*')->like('strata', $ambil->id_parent)->get('master_mata_pelajaran')->result_array();
		$option = "";
		if(count($mapel) <= 0) {
			$option .= "<option value=''>Belum ada mapel untuk strata ini</option>";
		} else {
			$option = "<option value=''>-- Pilih --</option>";
			foreach ($mapel as $key => $v) {
				$option .= "<option value='". $v['id'] ."'>". $v['nama'] ."</option>";
			}
		}

		$json = ['s' => 'sukses', 'd' => $option];

		echo json_encode($json);
	}

	function kelola_soal()
	{
		$data['judul'] = 'Mata Pelajaran - Kelola Soal';
		$data['aktif'] = 'soal';
		$data['subview'] = 'admin/mapel/list';

		if($this->session->userdata('id_guru') != null) {
			$jumlah_data = $this->db->join('master_mata_pelajaran', 'master_mata_pelajaran.id = master_jadwal_mapel.id_mapel')
			->where('master_jadwal_mapel.id_guru', $this->session->userdata('id_guru'))
			->group_by('master_jadwal_mapel.id_mapel')
			->get('master_jadwal_mapel')->num_rows();
		} else {
			$jumlah_data = $this->db->join('master_mata_pelajaran', 'master_mata_pelajaran.id = master_jadwal_mapel.id_mapel')
			->group_by('master_jadwal_mapel.id_mapel')
			->get('master_jadwal_mapel')->num_rows();
		}

		$config['base_url'] = base_url().'Kelas/kelola_soal/';
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

		$data['mapel'] = $this->M_siswa_kelas->data_kelas_guru('master_jadwal_mapel', $config['per_page'], $from);
		$this->pagination->initialize($config);	

		$this->load->view('admin/layout/layout', $data);
	}

	function add_soal($hash_id)
	{
		$data['hash_id'] = $hash_id;
		$data['judul'] = 'Mapel - Kelola Soal';
		$data['aktif'] = 'soal';
		$data['subview'] = 'admin/mapel/create';
		$this->load->view('admin/layout/layout', $data);
	}

	function simpanSoal()
	{
		$post = $this->input->post();

		($post['id_soal'] == '') ? $id_mapel = $post['mapel'] : $id_mapel = md5($post['mapel']);
		$getDataMapel = $this->db->get_where('master_mata_pelajaran', array('md5(id)' => $id_mapel))->row();
		$getTahunAjaran = $this->db->get_where('tahun_ajaran', array('is_active' => 1))->row(); 
		
		if($post['type'] == 2) {
			$data = [
				'id_mapel'	=> $getDataMapel->id,
				'nama'		=> $post['nama'],
				'type'		=> $post['type'],
				'tahun_ajaran' => $getTahunAjaran->id,
			];
			if($post['id_soal'] == '') {
				$addSoal = $this->db->insert('master_soal', $data);
			} else {
				$addSoal = $this->db->where('id', $post['id_soal'])->update('master_soal', $data);
			}
		} elseif($post['type'] == 1) {
			if(!isset($post['jawaban'])) {
				$json['s'] = 'gagal';
				$json['m'] = 'Pilih Jawaban soal terlebih dahulu';

				echo json_encode($json);
				exit;
			} else {
				$pilihan = [];
				$data = [
					'id_mapel'	=> $getDataMapel->id,
					'nama'		=> $post['nama'],
					'type'		=> $post['type'],
					'jawaban'	=> $post['jawaban'],
					'tahun_ajaran' => $getTahunAjaran->id,
				];

				if($post['id_soal'] == '') {
					$addSoal = $this->db->insert('master_soal', $data);
					$insert_id = $this->db->insert_id();
				} else {					
					$addSoal = $this->db->where('id', $post['id_soal'])->update('master_soal', $data);
					$insert_id = $post['id_soal'];
				}

				$a = "a";
				for($i = 1; $i <= 5; $i++) {
					if($post['id_soal'] == '') {
						isset($post['pilihan_'.$i]) ? $this->db->set('id_soal', $insert_id)->set('pilihan', $a)->set('teks', $post['pilihan_'.$i])->insert('master_jawaban') : '';
					} else {
						if(isset($post['pilihan_'.$i]) && $post['id_jawaban_'.$a] != '') { 
							$this->db->set('pilihan', $a)->set('teks', $post['pilihan_'.$i])->where('id', $post['id_jawaban_'.$a])->update('master_jawaban');
						} elseif(isset($post['pilihan_'.$i]) && $post['id_jawaban_'.$a] == '') {
							$this->db->set('id_soal', $insert_id)->set('pilihan', $a)->set('teks', $post['pilihan_'.$i])->insert('master_jawaban');
						}
					} 
					$a++;
				}
			}
		}

		if($addSoal) {
			$json['s'] = 'sukses';
			$json['m'] = 'Berhasil Simpan Soal';
		}

		echo json_encode($json);

	}

	function add_tugas($hash_id)
	{
		$data['hash_id'] = $hash_id;
		$data['judul'] = 'Mapel - Kelola Soal';
		$data['aktif'] = 'soal';
		$data['subview'] = 'admin/mapel/createTugas';
		$this->load->view('admin/layout/layout', $data);
	}

	function listPertanyaan($hash_id)
	{
		$list = $this->M_tugas->get_datatables($hash_id);
		$data = array();
		$no = $_POST['start'];

		$dataMapel = $this->M_tugas->get_datatables($hash_id);
		foreach($list as $v) {
			$no++;
			$daftar = [];
			$daftar[] = $no;
			$nama = $v->nama;
			if($v->type == 1) {
				$nama .= '<div class="row">';
				$getPilihanGanda = $this->db->get_where('master_jawaban', array('id_soal' => $v->id))->result_array();
				foreach ($getPilihanGanda as $key => $val) {	
					$nama .= '<div class="col-md-10">'.strtoupper($val['pilihan']) .'. '. $val['teks'].'</div>';
				}
				$nama .= '</div>';
			}
			$button = '<button class="btn btn-sm btn-warning edit" id="'. md5($v->id) .'"><i class="fas fa-pencil-alt"></i></button>';
			$button .= '<button class="btn btn-sm btn-danger hapus" id="'. md5($v->id) .'"><i class="fas fa-trash-alt"></i></button>';
			$daftar[] = $nama;
			$daftar[] = $button;
			$data[] = $daftar;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_tugas->count_all($hash_id),
			"recordsFiltered" => $this->M_tugas->count_filtered($hash_id),
			"data" => $data,
		);
        //output dalam format JSON
		echo json_encode($output);
	}

	function ambilDataTugas($id)
	{
		$getData = $this->db->get_where('master_soal', array('md5(id)' => $id))->row();
		echo json_encode($getData);
	}

	function ambilDataTugasGanda($id)
	{
		$getData = $this->db->get_where('master_jawaban', array('id_soal' => $id))->result_array();
		echo json_encode($getData);
	}

	function hapusDataSoal($id)
	{
		$this->db->where('md5(id_soal)', $id)->delete('master_jawaban');
		$delData = $this->db->where('md5(id)', $id)->delete('master_soal');

		if($delData) {
			$json['s'] = 'sukses';
			$json['m'] = 'Berhasil Hapus Soal';
		}

		echo json_encode($json);
	}

	function listPertanyaanTugas($hash_id)
	{
		$list = $this->M_tugas->get_datatables($hash_id);
		$data = array();
		$no = $_POST['start'];

		$dataMapel = $this->M_tugas->get_datatables($hash_id);
		foreach($list as $v) {
			$no++;
			$daftar = [];
			$button = '<input type="checkbox" id="'. $no .'" name="pilih[]" value="'. $v->id .'">';
			$daftar[] = $button;
			$nama = $v->nama;
			$daftar[] = $nama;
			$data[] = $daftar;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->M_tugas->count_all($hash_id),
			"recordsFiltered" => $this->M_tugas->count_filtered($hash_id),
			"data" => $data,
		);
        //output dalam format JSON
		echo json_encode($output);
	}
}
