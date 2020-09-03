<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">			
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Daftar Siswa</h3>
					<div class="card-tools">
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped" id="table_siswa" style="font-size: 13px;">
						<thead>
							<th>#</th>
							<th>NISN</th>
							<th>Nama</th>
							<th>Tempat, Tanggal Lahir</th>
							<th>Jenis Kelamin</th>
							<th>Agama</th>
							<th>No HP</th>
							<th>Alamat</th>
							<th>Aksi</th>
						</thead>
						<tbody>
							<tr>
								<?php $no=0; foreach($siswa as $sis => $s) : ?>
									<td><?= $no+=1; ?></td>
									<td><?= $s['nisn']; ?></td>
									<td><?= $s['nama']; ?></td>
									<td><?= $s['tempat_lahir'] ?>, <?= date('d-m-Y', strtotime($s['tanggal_lahir'])); ?></td>
									<td><?php if($s['jk'] == 1) { echo "Laki - Laki"; } else { echo "Perempuan"; }; ?></td>
									<td><?= $this->lib->pencarian('master_agama', $s['agama']); ?></td>
									<td><?= $s['hp']; ?></td>
									<td><?= $s['alamat']; ?></td>
									<td>
										<a href='#' class='btn btn-sm btn-danger conf' title='Hapus Siswa' role='button' id='<?= $s["id_relasi"] ?>'><i class='fas fa-trash-alt'></i></a>
									</td>
								<?php endforeach; ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '.conf', function() {
		Swal.fire({
			type: 'error',
			title: 'Yakin hapus data?',
			text: "Data yang sudah dihapus tidak dapat dikembalikan ",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal',
			confirmButtonText: 'Ya, hapus data!',
			showLoaderOnConfirm: true,
		}).then((result) => {
			if (result.value) {
				hapus_siswa($(this).attr('id'));
			}
		})
	});

	function hapus_siswa(id) {
		var fd = new FormData();
		fd.append('id', id);
		$.ajax({
			url: '<?= site_url("Master/hapus/relasi_siswa_kelas/") ?>'+id,
			type: 'POST',
			data: fd,
			dataType: 'json',
			contentType: false,
			cache: false,
			processData: false,
			success: function(response) {
				if (response.s == 'sukses') {
					Swal.fire({
						type: 'success',
						title: 'Berhasil',
						text: response.m,
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Oke'
					}).then((result) => {
						if (result.value) {
							location.reload();
						}
					})
				} else {
					swal.fire("Ops, ada kesalahan", response.m, "error");
				}
			},
		});
	}
</script>
