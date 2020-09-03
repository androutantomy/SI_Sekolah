<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lib {

	function pencarian($table, $id) 
	{
		$CI =& get_instance();
		$cari = $CI->db->get_where($table, array('id' => $id))->row();
		$hasil = $cari->nama;

		return $hasil;
	}

	function jumlah_siswa($id)
	{
		$CI =& get_instance();
		return $CI->db->get_where('relasi_siswa_kelas', array('id_kelas' => $id))->num_rows();
	}

	function kelas_active($mulai, $selesai) 
	{
		$jamm = date('H', strtotime(date('Y-m-d')));
		$jam = "";
		$bg = "";

		switch ($jamm) {
			case 7:
			$jam = 1;
			break;				
			case 8:
			$jam = 2;
			break;
			case 9:
			$jam = 3;
			break;
			case 10:
			$jam = 4;
			break;
			case 11:
			$jam = 5;
			break;
			case 12:
			$jam = 6;
			break;
			case 13:
			$jam = 7;
			break;
		}

		if($jam == $mulai) {
			$bg = "bg-success";
		} elseif($jam == $selesai) {
			$bg = "bg-success";
		} else {
			$bg = "";
		}

		echo $bg;
	}

	function seluruh_siswa()
	{
		$CI =& get_instance();
		$siswa = $CI->db->get('master_siswa');
		return $CI->db->count_all_results();
	}

	function randomColor()
	{
		$rand_color = '#' . substr(md5(mt_rand()), 0, 6);

		return $rand_color;
	}

	function daftarKelasSiswa()
	{
		$CI =& get_instance();
		$idUser = $CI->session->userdata('id');
		$getSiswa = $CI->db->get_where('master_siswa', array('id_user' => $idUser))->row();
		$idSiswa = $getSiswa->id;

		$getKelasSiswa = $CI->db->get_where('relasi_siswa_kelas', array('id_siswa' => $idSiswa))->row();
		$kelasSiswa = $getKelasSiswa->id_kelas;
		// sesuai hari

		$hari = date('N', strtotime(date('Y-m-d')));
		$getJadwalKelas = $CI->db->query('SELECT a.*, b.nama as nama_mapel FROM master_jadwal_mapel a JOIN master_mata_pelajaran b ON a.id_mapel = b.id JOIN tahun_ajaran c ON a.id_semester = c.id WHERE a.id_kelas = '.$kelasSiswa.' AND c.is_active = 1 AND a.hari = '.$hari.' ORDER BY a.hari ASC, a.jam_mulai ASC ')->result_array();
		$table = '<table class="table table-bordered">';
		$table .= '<thead>';
		$table .= '<th colspan=11><center>Jam Pelajaran</center></th>';
		$table .= '<tr>';
		for($i = 1; $i <= 11; $i++) {
			$table .= '<td width=10px;>';
			$table .= $i;
			$table .= '</td>';
		}
		$table .= '</tr>';
		$listMapel = [];

		$color = 'white';
		foreach($getJadwalKelas as $jad => $j) {
			$table .= '<tr>';
			for($i = 1; $i <= 11; $i++) {
				if(!in_array($j['nama_mapel'], $listMapel)) { 
					$listMapel['mapel'] = $j['nama_mapel']; 
					$listMapel['warna'] = $this->randomColor(); 
				} 
				foreach ($listMapel as $v) { if(in_array($j['nama_mapel'], $listMapel)) { $color = $listMapel['warna']; } else { $color = 'white'; } }
				$table .= ($i >= $j['jam_mulai'] && $i <= $j['jam_selesai']) ? '<td bgcolor="'. $color .'" width=40px>' : '<td width=40px>';
				$tanda = ($i >= $j['jam_mulai'] && $i <= $j['jam_selesai']) ? '<marquee scrolldelay="300" style="background-color:'. $color .'; width:100%;  " width="100%">'. $j['nama_mapel'] .'</marquee>' : '';
				$table .= $tanda;
				$table .= '</td>';
				$color = 'white';
			}
			$table .= '</tr>';
		}	
		$table .= '</table>';
		
		return $table;
	}
}
