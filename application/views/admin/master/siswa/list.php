<style type="text/css">
	div.right {
		position: absolute;
		right: 1px;
		width: 200px;
		height: 120px;
	} 
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">			
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Daftar Siswa</h3>
					<div class="card-tools">
						<div class="form-inline ml-3">
							<button class="btn btn-sm btn-primary" style="margin: 3px;">Import</button>
							<a href="<?= site_url('master/export'); ?>" role="button" target="_blank" class="btn btn-sm btn-warning">Export</a>
							<a style="margin: 3px;" href="<?= site_url('master/tambah_siswa/') ?>" role="button" class="btn btn-sm btn-success">Tambah Siswa</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped" id="table_siswa" style="font-size: 13px;">
						<thead>
							<th>No</th>
							<th>NISN</th>
							<th>Nama</th>
							<th>Tempat, Tanggal Lahir</th>
							<th>Jenis Kelamin</th>
							<th>Agama</th>
							<th>No HP</th>
							<th>Alamat</th>
							<th width="15%">Aksi</th>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		// $('#mata_pelajaran').load('<?= site_url("master/daftar_pelajaran/")?>');
		table = $('#table_siswa').DataTable({ 

			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {
				"url": "<?php echo site_url('Master/list_siswa')?>",
				"type": "POST"
			},


			"columnDefs": [
			{ 
				"targets": [ 0 ], 
				"orderable": false, 
			},
			],
		});
	});

	$(document).on('click', '.edit', function() {
		window.location.href = "<?= site_url('Master/tambah_siswa/') ?>"+$(this).attr('id');
	});

	$(document).on('click', '.detail', function() {
		window.location.href = "<?= site_url('Master/detail_siswa/') ?>"+$(this).attr('id');
	});

	$(document).on('click', '.conf', function() {
		Swal.fire({
			icon: 'error',
			title: 'Yakin hapus data?',
			text: "Data yang sudah dihapus tidak dapat dikembalikan",
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
			url: '<?= site_url("Master/hapus_siswa") ?>',
			type: 'POST',
			data: fd,
			dataType: 'json',
			contentType: false,
			cache: false,
			processData: false,
			success: function(response) {
				if (response.s == 'sukses') {
					Swal.fire({
						icon: 'success',
						title: 'Berhasil',
						text: response.m,
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Oke'
					}).then((result) => {
						if (result.value) {
							table.ajax.reload();
						}
					})
				} else {
					swal.fire("Ops, ada kesalahan", response.m, "error");
				}
			},
		});
	}
</script>
