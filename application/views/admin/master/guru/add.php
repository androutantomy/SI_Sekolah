<style type="text/css">
	div.right {
		position: absolute;
		right: 1px;
		width: 200px;
		height: 120px;
	}


	.datepicker {
		border-radius: 0;
		padding: 0;
	}
	.datepicker-days table thead, .datepicker-days table tbody, .datepicker-days table tfoot {
		padding: 10px;
		display: list-item;
	}
	.datepicker-days table thead, .datepicker-months table thead, .datepicker-years table thead, .datepicker-decades table thead, .datepicker-centuries table thead {
		background: #3546b3;
		color: #ffffff;
		border-radius: 0;
	}
	.datepicker-days table thead tr:nth-child(2n+0) td, .datepicker-days table thead tr:nth-child(2n+0) th {
		border-radius: 3px;
	}
	.datepicker-days table thead tr:nth-child(3n+0) {
		text-transform: uppercase;
		font-weight: 300 !important;
		font-size: 12px;
		color: rgba(255, 255, 255, 0.7);
	}
	.table-condensed > tbody > tr > td, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > td, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > thead > tr > th {
		padding: 11px 13px;
	}
	.datepicker-months table thead td, .datepicker-months table thead th, .datepicker-years table thead td, .datepicker-years table thead th, .datepicker-decades table thead td, .datepicker-decades table thead th, .datepicker-centuries table thead td, .datepicker-centuries table thead th {
		border-radius: 0;
	}
	.datepicker td, .datepicker th {
		border-radius: 50%;
		padding: 0 12px;
	}
	.datepicker-days table thead, .datepicker-months table thead, .datepicker-years table thead, .datepicker-decades table thead, .datepicker-centuries table thead {
		background: #3546b3;
		color: #ffffff;
		border-radius: 0;
	}
	.datepicker table tr td.active, .datepicker table tr td.active:hover, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled:hover {
		background-image: none;
	}
	.datepicker .prev, .datepicker .next {
		color: rgba(255, 255, 255, 0.5);
		transition: 0.3s;
		width: 37px;
		height: 37px;
	}
	.datepicker .prev:hover, .datepicker .next:hover {
		background: transparent;
		color: rgba(255, 255, 255, 0.99);
		font-size: 21px;
	}
	.datepicker .datepicker-switch {
		font-size: 24px;
		font-weight: 400;
		transition: 0.3s;
	}
	.datepicker .datepicker-switch:hover {
		color: rgba(255, 255, 255, 0.7);
		background: transparent;
	}
	.datepicker table tr td span {
		border-radius: 2px;
		margin: 3%;
		width: 27%;
	}
	.datepicker table tr td span.active, .datepicker table tr td span.active:hover, .datepicker table tr td span.active.disabled, .datepicker table tr td span.active.disabled:hover {
		background-color: #3546b3;
		background-image: none;
	}
	.dropdown-menu {
		border: 1px solid rgba(0,0,0,.1);
		box-shadow: 0 6px 12px rgba(0,0,0,.175);
	}
	.datepicker-dropdown.datepicker-orient-top:before {
		border-top: 7px solid rgba(0,0,0,.1);
	} 
</style>

<div class="container-fluid">
	<div class="row">

		<div class="col-lg-12">
			<div class="card card-primary card-outline">
				<div id="user_action">
					<div class="card-header">
						Form Tambah Guru <br>
						<small>Pastikan anda mengisi semua kolom yang bertanda (*)</small>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" ><i onclick="location.reload();" class="fas fa-plus"></i>
							</button>
						</div>
					</div>
					<form id="form_guru">
						<div class="card-body">
							<div class="form-group">
								<label>Nama Lengkap *</label>
								<input type="hidden" name="id" value="<?= isset($guru->id)?md5($guru->id):''; ?>">
								<input type="text" id="nama" name="nama" class="form-control form-control-sm" value="<?= isset($guru->nama)?$guru->nama:'' ?>" placeholder="Isikan nama lengkap">
							</div>
							<div class="form-group">
								<label>NIPY *</label>
								<input type="text" id="nipy" onblur="cek('nipy')" name="nipy" value="<?= isset($guru->nipy)?$guru->nipy:'' ?>" class="form-control form-control-sm" placeholder="Isikan NIPY ">
								<span id="msgnipy"></span>
							</div>
							<div class="form-group row">
								<div class="col-lg-6">
									<label>Jenis Kelamin *</label><br>
									<div class="row">
										<div class="col-sm-6">
											<div class="custom-control custom-radio">
												<input class="custom-control-input" type="radio" id="customRadio1" value="1" id="jk" name="jk" <?php if(isset($guru->jk)) { if($guru->jk == 1) { echo "checked"; } else {  } } ?> >
												<label for="customRadio1" class="custom-control-label">Laki - Laki</label>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="custom-control custom-radio">
												<input class="custom-control-input" type="radio" id="customRadio2" value="0" id="jk" name="jk" <?php if(isset($guru->jk)) { if($guru->jk == 0) { echo "checked"; } else {  } } ?> >
												<label for="customRadio2" class="custom-control-label">Perempuan</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<label>No Handphone *</label>
									<input type="text" name="hp" id="hp" value="<?= isset($guru->hp)?$guru->hp:'' ?>" class="form-control form-control-sm" placeholder="Isikan no handphone">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<label>Tempat Lahir *</label>
									<input type="text" name="tempat_lahir" id="tempat_lahir" value="<?= isset($guru->tempat_lahir)?$guru->tempat_lahir:'' ?>" class="form-control form-control-sm" placeholder="Isikan tempat lahir" value="<?= isset($siswa->tempat_lahir)?$siswa->tempat_lahir:'' ?>">
								</div>
								<div class="col-sm-6">
									<label>Tanggal Lahir *</label>
									<input type="text" name="tanggal_lahir" id="tanggal_lahir" value="<?= isset($guru->tanggal_lahir)?date('d-m-Y', strtotime($guru->nama)):'' ?>" class="form-control form-control-sm dateselect" placeholder="Isikan tanggal lahir" value="<?= isset($siswa->tanggal_lahir)?$siswa->tanggal_lahir:'' ?>">
								</div>
							</div>
							<div class="form-group">
								<label>Agama *</label>
								<select class="custom-select form-control-sm" id="agama" name="agama">
									<option value="">--Pilih Agama--</option>
									<?php foreach($agama as $agm => $aa) :?>
										<option value="<?= $aa['id'] ?>" <?php if(isset($guru->agama)) { if($guru->agama == $aa['id']) { echo "selected"; } } ?> ><?= $aa['nama'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Alamat Lengkap *</label>
								<textarea name="alamat" id="alamat" class="form-control" cols="6" placeholder="Beserta RT dan RW"><?= isset($guru->alamat)?$guru->alamat:'' ?></textarea>
							</div>
							<div class="form-group row">
								<div class="col-lg-6">
									<label>No Ijazah *</label>
									<input type="text" name="ijazah" onblur="cek('ijazah')" id="ijazah" value="<?= isset($guru->ijazah)?$guru->ijazah:'' ?>" class="form-control form-control-sm" placeholder="Isikan No Ijazah">
									<span id="msgijazah"></span>
								</div>
								<div class="col-lg-6">
									<label>Tugas Mengajar *</label>
									<input type="text" name="tugas_mengajar" id="tugas_mengajar" value="<?= isset($guru->tugas_mengajar)?$guru->tugas_mengajar:'' ?>" class="form-control form-control-sm" placeholder="Isikan Tugas Mengajar">
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
</div>

<script>
	$(document).ready(function() {
		$('.dateselect').datepicker({
			format: 'mm/dd/yyyy',
			autoclose: true,
		});
		// $('#mata_pelajaran').load('<?= site_url("master/daftar_pelajaran/")?>');
	});

	function cek(tipe)
	{
		var val = $('#'+tipe).val();
		var fd  = new FormData();
		fd.append('tipe', tipe);
		fd.append('val', val);
		fd.append('table', 'master_guru');


		$.ajax({
			url: '<?= site_url("master/check_avaliablity") ?>',
			type: 'post',
			data: fd,
			dataType: "json",
			contentType: false,
			processData: false,
			success: function(response) {
				if (response.s == 'sukses') {
					$('#msg'+tipe).html('<i class="far fa-check-circle"></i> Data Aman ');
					$('#msg'+tipe).attr('style', 'color: green');
					$('#submit').removeAttr('disabled');
				} else {
					$('#msg'+tipe).html('<i class="fas fa-times"></i> '+response.m);
					$('#msg'+tipe).attr('style', 'color: red');
					$('#submit').attr('disabled', 'disabled');
				}
			},
		});

	}

	$('#form_guru').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: '<?= site_url("Master/add_guru") ?>',
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
							window.location.href = '<?= site_url("master/guru") ?>';
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
