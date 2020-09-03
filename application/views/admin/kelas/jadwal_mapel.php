<style type="text/css">
	div.right {
		position: absolute;
		right: 1px;
		width: 400px;
		height: 115px;
	}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">Kelas Hari ini</h3>
				</div>
				<div class="card-body p-2 form-group" style="margin: 0px;">
					<?php foreach($jadwal as $u ):?>
						<div class="row" >
							<div class="col-lg-8">
								<label><i class="fas fa-user"></i> <?= $u->nama_guru ?> - <?= $u->nama_mapel ?> [<?= $u->nama; ?>]</label><br>
							</div>
							<div class="col-lg-4">
								<span style="color: black;" class="float-right btn btn-sm btn-success">  Jam Mengajar <span class="badge <?php $this->lib->kelas_active($u->jam_mulai, $u->jam_selesai)?>"> <?= $u->jam_mulai ?> - <?= $u->jam_selesai ?> </span> </span>
								<button class="btn btn-sm btn-warning" type="button"> Edit Jadwal</button>
							</div>
						</div>
						<hr>
					<?php endforeach; ?>
					<li class="nav-item">
						<?= $this->pagination->create_links(); ?>
					</li>					
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card card-success card-outline">
				<div class="card-header">
					<h3 class="card-title">Semua Kelas</h3>
				</div>
				<div class="card-body p-2 form-group" style="margin: 0px;">
					<table id="tableAll">
						
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-4">			
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Tambah Mata Pelajaran</h3>
					<div class="card-tools">
					</div>
				</div>
				<form id="tambah_jadwal">
					<div class="card-body">
						<div class="form-group">
							<label>Kelas</label>
							<select class="form-control form-control-sm" id="id_kelas" name="id_kelas">
								<option value="">-- Pilih --</option>
								<?php foreach($kelas as $kls => $k) :?>
									<option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="form-group">
							<label>Mata Pelajaran</label>
							<select class="form-control form-control-sm" id="id_mapel" name="id_mapel">
								<option value="">-- Pilih --</option>
							</select>
						</div>
						<div class="form-group">
							<label>Pengajar</label>
							<select class="form-control form-control-sm" id="id_guru" name="id_guru">
								<option value="">-- Pilih --</option>
								<?php foreach($guru as $kls => $k) :?>
									<option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label>Tahun Ajaran</label>
								<select class="form-control form-control-sm" id="id_semester" name="id_semester">
									<option value="">-- Pilih --</option>
									<?php foreach($tahun_ajaran as $kls => $k) :?>
										<option value="<?= $k['id'] ?>" <?php if($k['is_active'] == 1) { echo "selected"; }?>><?= $k['nama'] ?></option>
									<?php endforeach;?>
								</select>
							</div>
							<div class="col-sm-6">
								<label>Hari</label>
								<select class="form-control form-control-sm" id="hari" name="hari">
									<option value="">-- Pilih --</option>
									<option value="1">Senin</option>
									<option value="2">Selasa</option>
									<option value="3">Rabu</option>
									<option value="4">Kamis</option>
									<option value="5">Jumat</option>
									<option value="6">Sabtu</option>
									<option value="7">Minggu</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label>Jam Mulai</label>
								<select class="form-control form-control-sm" id="jam_mulai" name="jam_mulai">
									<option value="">-- Pilih --</option>
									<?php for($i=1; $i<=7; $i++) { ?>
										<option value="<?= $i; ?>"><?= $i; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-sm-6">
								<label>Jam Selesai</label>
								<select class="form-control form-control-sm" id="jam_selesai" name="jam_selesai">
									<option value="">-- Pilih --</option>
									<?php for($i=1; $i<=7; $i++) { ?>
										<option value="<?= $i; ?>"><?= $i; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="float-right" id="button">
							<button type="submit" id="submit" class="btn btn-success btn-sm"><i class="far fa-check-circle"></i> Simpan</button>
						</div>
						<button type="reset" id="reset" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i> Reset</button>
						<label id="text_alert"></label>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$('#tambah_jadwal').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: '<?= site_url("Kelas/add_jadwal") ?>',
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

	$('#id_kelas').on('change', function() {
		var fd = new FormData();
		fd.append('id_kelas', $('#id_kelas').val());

		$.ajax({
			url: '<?= site_url("Kelas/list_kelas_mapel") ?>',
			type: 'POST',
			data: fd,
			dataType: 'json',
			contentType: false,	
			cache: false,
			processData: false,
			success: function(response) {
				if (response.s == 'sukses') {
					$('#id_mapel').html(response.d);
				} else {
					$('#text_alert').show();
					$('#text_alert').html('<i class="fas fa-times"></i> '+ response.m);
					$('#text_alert').attr('style', 'color:red;');
				}
			},
		});
	});
</script>
