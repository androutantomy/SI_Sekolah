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
		<div class="col-lg-4">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Daftar User</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" ><i onclick="location.reload();" class="fas fa-plus"></i>
								</button>
							</div>
						</div>
						<div class="card-body p-0">
							<ul class="nav nav-pills flex-column">
								<?php foreach($user as $u ):?>
									<li class="nav-item active">
										<div class="row">
											<div class="col-xs-8">
												<a href="#" onclick="populate_user(<?= $u->id; ?>);" class="nav-link">
													<i class="fas fa-user"></i>  <?= $u->fullname; ?>
												</a>
											</div>
											<div class="col-xs-4 right" style="margin: 10px; padding-right: 30px;">
												<a href="#" class="badge bg-danger float-right" onclick="conf(<?= $u->id; ?>)"><i class="fas fa-trash-alt"></i> Hapus</a>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
								<li class="nav-item">
									<?= $this->pagination->create_links(); ?>
								</li>
							</ul>							
						</div>
						<!-- /.card-body -->
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-8">
			<div id="user_action">
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
										<input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-sm">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Username</label>
										<input type="text" id="username" name="username" class="form-control form-control-sm">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="email" name="email" class="form-control form-control-sm">
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" class="form-control form-control-sm">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Konfirmasi Password</label>
										<input type="hidden" name="id" value="" id="id">
										<input type="password" name="re-password" class="form-control form-control-sm">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Pilih Level User</label><br>
								<div class="row">
									<?php foreach($level as $lvl => $l) :?>
										<div class="col-lg-3">
											<div class="icheck-primary d-inline level">
												<input type="checkbox" id="<?= $l['id'] ?>"  name="level[]" value="<?= $l['id']; ?>">
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
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$('#text_alert').hide();
		$('button[type=reset]').trigger('click');
	});

	function conf(id)
	{
		Swal.fire({
			title: 'Yakin hapus data?',
			text: "Data yang sudah dihapus tidak dapat dikembalikan",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal',
			confirmButtonText: 'Ya, hapus data!'
		}).then((result) => {
			if (result.value) {
				hapus_data(id);
			}
		})
	}

	function hapus_data(id)
	{
		$.ajax({
			url: '<?= site_url("Master/hapus/user/") ?>' + id,
			type: 'POST',
			data: {id:id},
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
							$('button[type=reset]').trigger('click');
							$('input[name=id]').val("");
							$('#text_alert').hide();
							location.reload();
						}
					})
				} else {
					swal.fire("Ops, ada kesalahan", response.m, "error");
					$('button[type=reset]').trigger('click');
					$('input[name=id]').val("");
					$('#text_alert').hide();
				}
			},
		});
	}

	function populate_user(id) 
	{
		$('#user_action').load('<?= site_url("master/edit/") ?>'+id);
	}

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
