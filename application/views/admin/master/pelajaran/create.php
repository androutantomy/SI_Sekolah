<div class="card-header">Edit Mata Pelajaran
	<div class="card-tools">
		<button type="button" class="btn btn-tool" ><i onclick="location.reload();" class="fas fa-plus"></i>
		</button>
	</div>
</div>
<form id="form_mapel">
	<div class="card-body">
		<div class="form-group">
			<label>Nama Mapel</label>
			<input type="hidden" name="id" value="<?= $mapel->id; ?>">
			<input type="text" name="mapel" class="form-control form-control-sm" value="<?= $mapel->nama ?>">
		</div>
		<div class="form-group">
			<label>Strata Kelas</label><br>
			<div class="row">
				<?php foreach($daftar as $dft => $d) :?>
					<div class="col-lg-3">
						<div class="icheck-primary d-inline level">
							<input type="checkbox" id="<?= $d['id'] ?>" <?php if(in_array($d['id'], $strata)) { echo "checked"; } ?> name="strata[]" value="<?= $d['id'] ?>">
							<label for="<?= $d['id'] ?>">
								<?= $d['nama'] ?>
							</label>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="float-right" id="button">
			<button type="submit" class="btn btn-success btn-sm"><i class="far fa-check-circle"></i> Simpan</button>
		</div>
		<button type="reset" id="reset" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i> Reset</button>
		<label id="text_alert"></label>
	</div>
</form>

<script>
	$('#form_mapel').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: '<?= site_url("Master/add_mapel") ?>',
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
						icon: 'success',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Oke'
					}).then((result) => {
						if (result.value) {
							$('button[type=reset]').trigger('click');
							$('input[name=id]').val("");
							$('#text_alert').hide();
							location.reload();
						}
					})
				} else {
					$('#text_alert').show();
					$('#text_alert').html('<i class="fas fa-times"></i> '+ response.m);
					$('#text_alert').attr('style', 'color:red;');
				}
			},
		});
	});
</script>
