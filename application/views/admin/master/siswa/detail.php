<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3">
			<div class="card card-primary card-outline" style="height: 480px;">
				<div class="card-body box-profile">
					<div class="text-center">
						<img class="profile-user-img img-fluid img-circle profile" id="<?= md5($siswa->id) ?>" src="<?= base_url(); ?>assets/dist/img/user4-128x128.jpg" alt="User profile picture">
					</div>

					<h3 class="profile-username text-center"><?= $siswa->nama; ?></h3>
					<ul class="list-group list-group-unbordered mb-3">
						<li class="list-group-item">
							<b>Strata</b> <a class="float-right">1,322</a>
						</li>
						<li class="list-group-item">
							<b>Kelas</b> <a class="float-right">543</a>
						</li>
						<li class="list-group-item">
							<b>Friends</b> <a class="float-right" role='button' id="<?= md5($siswa->id)?>">13,287</a>
						</li>
					</ul>

					<a href="#" class="btn btn-primary btn-block edit" role='button' id="<?= md5($siswa->id)?>"><b>Edit Data</b></a>
				</div>
			</div>
		</div>
		<div class="col-lg-3">			
			<div class="card card-primary" style="position: absolute; height: 480px;">
				<div class="card-header">
					<h3 class="card-title">Tentang <?= $siswa->nama; ?></h3>
				</div>
				<div class="card-body">
					<strong><i class="fas fa-book mr-1"></i> Tentang</strong>

					<p class="text-muted">
						Anak ke <?= $siswa->anak_ke; ?> dari pasangan bapak <?= $siswa->ayah; ?> dan ibu <?= $siswa->ibu; ?>
					</p>

					<hr>

					<strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

					<p class="text-muted"><?= $siswa->alamat; ?></p>

					<hr>

					<strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

					<p class="text-muted">
						<span class="tag tag-danger">UI Design</span>
						<span class="tag tag-success">Coding</span>
						<span class="tag tag-info">Javascript</span>
						<span class="tag tag-warning">PHP</span>
						<span class="tag tag-primary">Node.js</span>
					</p>

					<hr>

					<strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

					<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
				</div>
			</div>
		</div>
		<div class="col-lg-6" >
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Buat User</h3>
				</div>
				<div class="card-body" style="height: 435px;">
					<form id="form_user">
						<div class="card-body" style="margin: 1px;">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" id="nama_lengkap" value="<?= isset($siswa->nama)?$siswa->nama:'' ?>" name="nama_lengkap" class="form-control form-control-sm">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Username</label>
										<input type="text" id="username" value="<?= isset($user->username)?$user->username:'' ?>" name="username" class="form-control form-control-sm">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="email" name="email" value="<?= isset($user->email)?$user->email:'' ?>" class="form-control form-control-sm">
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Password </label>
										<input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" class="form-control form-control-sm">
									</div>
								</div>
								<input type="hidden" name="idSiswa" value="<?= md5($siswa->id); ?>">
								<input type="hidden" name="level" value="7">
								<input type="hidden" name="stage" value="siswaOnly">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Konfirmasi Password </label>
										<input type="hidden" name="id" value="<?= isset($user->id)?$user->id:'' ?>" id="id">
										<input type="password" name="re-password" placeholder="Kosongkan jika tidak ingin mengubah password" class="form-control form-control-sm">
									</div>
								</div>
							</div>
							<?php if(isset($user->id)) { ?><small>* Kosongkan jika tidak mengubah password</small> <?php } ?>
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
	<div id="modal_loader" class="modal" data-width="600">
		<div class="loader"></div>
	</div>
</div>

<script>

	$(document).on('click', '.edit', function() {
		window.location.href = "<?= site_url('Master/tambah_siswa/') ?>"+$(this).attr('id');
	});

	$('#profile').on('click', function() {
		
	});

	$('#form_user').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: '<?= site_url("Master/createUserForSiswa") ?>',
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
