<?php 	
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Siswa.xls");
?>


<table border="1" style="width:100%;font-size:13px;">
	<thead>
		<tr style="font-weight: bold">
			<th style="width:38px;">#</th>
			<th>Nama</th>
			<th>NISN</th>
			<th>NIPD</th>
			<th>NIK</th>
			<th>SKHUN</th>
			<th>Tempat Tanggal lahir</th>
			<th>Jenis Kelamin</th>
			<th>Agama</th>
			<th>Telepon</th>
			<th>No Hp</th>
			<th>Email</th>
			<th>Akta Lahir</th>
			<th>Kebutuhan Khusus</th>
			<th>Anak-ke</th>
			<th>Alamat</th>
			<th>Nama Ayah</th>
			<th>Nama Ibu</th>
			<th>Nama Wali</th>
			<th>NIK Ayah</th>
			<th>NIK Ibu</th>
			<th>NIK Wali</th>
			<th>Pekerjaan Ayah</th>
			<th>Pekerjaan Ibu</th>
			<th>Pekerjaan Wali</th>
			<th>Tanggal Lahir Ayah</th>
			<th>Tanggal Lahir Ibu</th>
			<th>Tanggal Lahir Wali</th>
			<th>Pendidikan Ayah</th>
			<th>Pendidikan Ibu</th>
			<th>Pendidikan Wali</th>
			<th>Penghasilan Ayah</th>
			<th>Penghasilan Ibu</th>
			<th>Penghasilan Wali</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=0; foreach($siswa as $sis => $s) :?>
		<tr>
			<td><?= $no+=1; ?></td>
			<td><?= $s['nama'] ?></td>
			<td><?= $s['nisn'] ?></td>
			<td><?= $s['nipd'] ?></td>
			<td><?= $s['nik'] ?></td>
			<td><?= $s['skhun'] ?></td>
			<td><?= $s['tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($s['tanggal_lahir'])) ?></td>
			<td><?php if($s['jk'] == 1 ) { echo "Laki-laki"; } else { echo "Perempuan"; } ?></td>
			<td><?= $this->lib->pencarian('master_agama', $s['agama']) ?></td>
			<td><?= $s['telepon'] ?></td>
			<td><?= $s['hp'] ?></td>
			<td><?= $s['email'] ?></td>
			<td><?= $s['akta_lahir'] ?></td>
			<td><?= $s['kebutuhan_khusus'] ?></td>
			<td><?= $s['anak_ke'] ?></td>
			<td><?= $s['alamat'] ?></td>
			<td><?= $s['ayah'] ?></td>
			<td><?= $s['ibu'] ?></td>
			<td><?= $s['wali'] ?></td>
			<td><?= $s['nik_ayah'] ?></td>
			<td><?= $s['nik_ibu'] ?></td>
			<td><?= $s['nik_wali'] ?></td>
			<td><?= $this->lib->pencarian('master_kerja', $s['kerja_ayah']) ?></td>
			<td><?= $this->lib->pencarian('master_kerja', $s['kerja_ibu']) ?></td>
			<td><?php if($s['kerja_wali'] != '' || $s['kerja_wali'] != 0) { echo $this->lib->pencarian('master_kerja', $s['kerja_wali']); } ?></td>
			<td><?= date('d-m-Y', strtotime($s['lahir_ayah'])) ?></td>
			<td><?= date('d-m-Y', strtotime($s['lahir_ibu'])) ?></td>
			<td><?php if($s['lahir_wali'] != '' || $s['lahir_wali'] != 0) { date('d-m-Y', strtotime($s['lahir_wali'])); } ?></td>
			<td><?= $this->lib->pencarian('master_pendidikan', $s['pendidikan_ayah']) ?></td>
			<td><?= $this->lib->pencarian('master_pendidikan', $s['pendidikan_ibu']) ?></td>
			<td><?php if($s['pendidikan_wali'] != '' || $s['pendidikan_wali'] != 0) { echo $this->lib->pencarian('master_pendidikan', $s['pendidikan_wali']); } ?></td>
			<td><?= $this->lib->pencarian('master_penghasilan', $s['penghasilan_ayah']) ?></td>
			<td><?= $this->lib->pencarian('master_penghasilan', $s['penghasilan_ibu']) ?></td>
			<td><?php if($s['penghasilan_wali'] != '' || $s['penghasilan_wali'] != 0) { echo $this->lib->pencarian('master_penghasilan', $s['penghasilan_wali']); } ?></td>
		</tr>
	<?php endforeach;?>
	</tbody>
</table>
