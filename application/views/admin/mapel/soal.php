<table class="table" id="daftarSoalMapel">
	<thead>
		<th width="5%"></th>
		<th></th>
		<th width="10%"></th>
	</thead>
	<tbody>

	</tbody>
</table>

<script>
	$(document).ready(function() {
		var hash_id = "<?= $hash_id; ?>";
		$('#daftarSoalMapel').DataTable({ 

			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {
				"url": "<?php echo site_url('Kelas/listPertanyaan/')?>"+ hash_id,
				"type": "POST"
			},

		});
	});	
</script>
