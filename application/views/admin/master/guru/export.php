<?php 	
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Guru.xls");
?>


<table border="1" style="width:100%;font-size:13px;">
	<thead>
		<tr style="font-weight: bold">
			<th style="width:38px;">#</th>
			<th>NIPY</th>
			<th>Nama</th>
			<th>Tempat, Tanggal Lahir</th>
			<th>Jenis Kelamin</th>
			<th>Agama</th>
			<th>No HP</th>
			<th>Alamat</th>
			<th>No Ijazah</th>
			<th>Tugas Mengajar</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=0; foreach($guru as $sis => $s) :?>
		<tr>
			<td><?= $no+=1; ?></td>
			<td><?= $s['nipy'] ?></td>
			<td><?= $s['nama'] ?></td>
			<td><?= $s['tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($s['tanggal_lahir'])) ?></td>
			<td><?php if($s['jk'] == 1 ) { echo "Laki-laki"; } else { echo "Perempuan"; } ?></td>
			<td><?= $this->lib->pencarian('master_agama', $s['agama']) ?></td>
			<td><?= $s['hp'] ?></td>
			<td><?= $s['alamat'] ?></td>
			<td><?= $s['ijazah'] ?></td>
			<td><?= $s['tugas_mengajar'] ?></td>
		</tr>
	<?php endforeach;?>
</tbody>
</table>
