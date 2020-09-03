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
							<th width="3%">#</th>
							<th>Kelas</th>
							<th>Jumlah Siswa</th>
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
		table = $('#table_siswa').DataTable({ 

			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {
				"url": "<?php echo site_url('Kelas/ajax_list')?>",
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

	$(document).on('click', '.siswa', function() {
		window.location.href = "<?= site_url('kelas/kelas_siswa/') ?>"+$(this).attr('id');
	});

	$(document).on('click', '.tambah', function() {
		window.location.href = "<?= site_url('kelas/tambah/') ?>"+$(this).attr('id');
	});
</script>
