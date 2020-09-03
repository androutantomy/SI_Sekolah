
<div class="card card-primary card-outline">
	<div class="card-header">
		<h3 class="card-title">Buat User Baru</h3>
	</div>
	<form id="form_user">
		<div class="card-body" style="margin: 1px;">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input type="text" id="nama_lengkap" value="<?= $user['fullname'] ?>" name="nama_lengkap" class="form-control form-control-sm">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Username</label>
						<input type="text" id="username" value="<?= $user['username'] ?>" name="username" class="form-control form-control-sm">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" id="email" name="email" value="<?= $user['email'] ?>" class="form-control form-control-sm">
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>Password *<small> Kosongkan jika tidak mengubah password</small> </label>
						<input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="form-control form-control-sm">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>Konfirmasi Password </label>
						<input type="hidden" name="id" value="<?= $user['id'] ?>" id="id">
						<input type="password" name="re-password" placeholder="Kosongkan jika tidak ingin mengubah password" class="form-control form-control-sm">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Pilih Level User</label><br>
				<div class="row">
					<?php foreach($level as $lvl => $l) :?>
						<div class="col-lg-3">
							<div class="icheck-primary d-inline level">
								<input type="checkbox" id="<?= $l['id'] ?>" <?php if(in_array($l['id'], $user['data_level'])) { echo "checked"; } ?> name="level[]" value="<?= $l['id']; ?>">
								<label for="<?= $l['id'] ?>">
									<?= $l['level']; ?>
								</label>
							</div>
						</div>
					<?php endforeach;?>
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
</div>

<script>
	$('#form_user').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: '<?= site_url("Master/create_user") ?>',
			type: 'POST',
			data: new FormData(this),
			dataType: 'json',
			contentType: false,
			cache: false,
			processData: false,
			success: function(response) {
				if (response.s == 'sukses') {
					swal.fire("Berhasil", response.m, "success");
					setTimeout(function() {
						location.reload();
						$('button[type=reset]').trigger('click');
					}, 2000);
				} else {
					$('#text_alert').show();
					$('#text_alert').html('<i class="fas fa-times"></i> '+ response.m);
					$('#text_alert').attr('style', 'color:red;');
				}
			},
		});
	});
</script>
