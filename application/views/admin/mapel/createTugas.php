<div class="container-fluid row">
	<div class="col-lg-6" style="height: 600px;">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<h3 class="card-title">Tambah Soal</h3>
			</div>
			<form id="simpan_soal">
				<div class="card-body" style="margin: 0px;">					
					<table class="table" id="daftarSoalMapel">
						<thead>
							<th width="15%"></th>
							<th></th>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
				<div class="card-footer">
					<div class="float-right" id="button">
						<button type="submit" id="submit" class="btn btn-success btn-sm"><i class="far fa-check-circle"></i> Simpan</button>
					</div>
					<button type="button" id="reset" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i> Reset</button>
					<label id="text_alert"></label>
				</div>
			</form>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<h3 class="card-title">Daftar Pertanyaan</h3>
			</div>
			<div class="card-body" style="margin: 0px;">					
				
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		var hash_id = "<?= $hash_id; ?>";
		$('#daftarSoalMapel').DataTable({ 

			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {
				"url": "<?php echo site_url('Kelas/listPertanyaanTugas/')?>"+ hash_id,
				"type": "POST"
			},

		});
	});
</script>
