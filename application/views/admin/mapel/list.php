<div class="container-fluid row">
	<div class="col-lg-12">
		<table class="table table-striped table-bordered" id="table_mapel">
			<thead>
				<th>No</th>
				<th>Mata Pelajaran</th>
				<th>Aksi</th>
			</thead>
			<tbody>
				<?php $no=0; foreach($mapel as $mpl) {?>
					<tr>
						<td width="5%"><?= $no+=1; ?></td>
						<td><?= $mpl->nama_mapel ?></td>
						<td>
							<button class="btn btn-sm btn-success buat_soal" type="button" id="<?= md5($mpl->id_mapel) ?>"><i class="fas fa-plus"></i> Buat Soal</button>
							<button class="btn btn-sm btn-warning buat_tugas" type="button" id="<?= md5($mpl->id_mapel) ?>"><i class="fas fa-tasks"></i> Buat Tugas</button>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#table_mapel').DataTable();
	});

	$(document).on('click', '.buat_soal', function() {
		window.location.href = '<?= site_url("Kelas/add_soal/") ?>'+$(this).attr('id');
	});

	$(document).on('click', '.buat_tugas', function() {
		window.location.href = '<?= site_url("Kelas/add_tugas/") ?>'+$(this).attr('id');
	});
</script>

