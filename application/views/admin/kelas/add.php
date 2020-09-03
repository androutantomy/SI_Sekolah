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
					<form id="form_kelas">
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
							</thead>
							<tbody>

							</tbody>
						</table><br><br>
						<input type="hidden" name="id" value="<?= $kelas['id'] ?>"><label id="text_alert"></label>
						<button class="btn btn-sm btn-success float-right" type="submit" value="Simpan">Tempatkan dalam kelas <?= $kelas['nama'] ?></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		table = $('#table_siswa').DataTable({ 

			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {
				"url": "<?php echo site_url('Kelas/list_siswa')?>",
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

	$('#form_kelas').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: '<?= site_url('Kelas/asign') ?>',
			type: 'POST',
			data: new FormData(this),
			dataType: 'json',
			contentType: false,
			cache: false,
			processData: false,
			success: function(response) {
				if (response.s == 'sukses') {
					Swal.fire({
						title: 'Berhasil',
						text: response.m,
						type: 'success',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Oke'
					}).then((result) => {
						if (result.value) {
							$('#text_alert').hide();
							window.location.href = '<?= site_url("kelas") ?>';
						}
					})
				} else {
					$('#text_alert').show();
					$('#text_alert').html('<i class="fas fa-times"></i> ' + response.m);
					$('#text_alert').attr('style', 'color:red;');
				}
			},
		});
	});
</script>
