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
						Form Tambah Siswa <br>
						<small>Pastikan anda mengisi semua kolom yang bertanda (*)</small>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" ><i onclick="location.reload();" class="fas fa-plus"></i>
							</button>
						</div>
					</div>
					<form id="form_siswa">
						<div class="card-body">
							<div class="form-group">
								<label>Nama Lengkap *</label>
								<input type="hidden" name="id" value="<?= isset($siswa->id)?$siswa->id:'' ?>">
								<input type="text" name="nama" id="nama" class="form-control form-control-sm" placeholder="Isikan nama lengkap" value="<?= isset($siswa->nama)?$siswa->nama:'' ?>">
							</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<label>NIPD *</label>
									<input type="text" name="nipd" id="nipd" onblur="cek('nipd')" class="form-control form-control-sm" placeholder="Isikan NIPD" value="<?= isset($siswa->nipd)?$siswa->nipd:'' ?>">
									<span id="msgnipd"></span>
								</div>
								<div class="col-sm-6">
									<label>NISN *</label>
									<input type="text" name="nisn" id="nisn" onblur="cek('nisn')" class="form-control form-control-sm" placeholder="Isikan NISN" value="<?= isset($siswa->nisn)?$siswa->nisn:'' ?>">
									<span id="msgnisn"></span>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<label>NIK *</label>
									<input type="text" name="nik" id="nik" onblur="cek('nik')" class="form-control form-control-sm" placeholder="Isikan NIK" value="<?= isset($siswa->nik)?$siswa->nik:'' ?>">
									<span id="msgnik"></span>
								</div>
								<div class="col-sm-6">
									<label>SKHUN *</label>
									<input type="text" name="skhun" id="skhun" onblur="cek('skhun')" class="form-control form-control-sm" placeholder="Isikan SKHUN" value="<?= isset($siswa->skhun)?$siswa->skhun:'' ?>">
									<span id="msgskhun"></span>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<label>Tempat Lahir *</label>
									<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control form-control-sm" placeholder="Isikan tempat lahir" value="<?= isset($siswa->tempat_lahir)?$siswa->tempat_lahir:'' ?>">
								</div>
								<div class="col-sm-6">
									<label>Tanggal Lahir *</label>
									<input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control form-control-sm dateselect" placeholder="Isikan tanggal lahir" value="<?= isset($siswa->tanggal_lahir)?$siswa->tanggal_lahir:'' ?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<label>Jenis Kelamin *</label><br>
									<div class="row">
										<div class="col-sm-6">
											<div class="custom-control custom-radio">
												<input class="custom-control-input" type="radio" id="customRadio1" value="1" id="gender" name="gender" <?php if(isset($siswa->jk)) { if($siswa->jk == 1) { echo "checked"; } else {  } } ?> >
												<label for="customRadio1" class="custom-control-label">Laki - Laki</label>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="custom-control custom-radio">
												<input class="custom-control-input" type="radio" id="customRadio2" value="0" id="gender" name="gender" <?php if(isset($siswa->jk)) { if($siswa->jk == 0) { echo "checked"; } else {  } } ?> >
												<label for="customRadio2" class="custom-control-label">Perempuan</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<label>Agama *</label>
									<select class="custom-select form-control-sm" id="agama" name="agama">
										<option value="">--Pilih Agama--</option>
										<?php foreach($agama as $agm => $aa) :?>
											<option value="<?= $aa['id'] ?>" <?php if(isset($siswa->agama)) { if($siswa->agama == $aa['id']) { echo "selected"; } } ?> ><?= $aa['nama'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<label>Telepon</label>
									<input type="text" name="telp" id="telp" class="form-control form-control-sm" placeholder="Isikan telepon" value="<?= isset($siswa->telepon)?$siswa->telepon:'' ?>">
								</div>
								<div class="col-sm-6">
									<label>No HP</label>
									<input type="text" name="hp" id="hp" class="form-control form-control-sm" placeholder="Isikan No Hp" value="<?= isset($siswa->hp)?$siswa->hp:'' ?>">
								</div>
							</div>	
							<div class="form-group row">
								<div class="col-sm-6">
									<label>Email</label>
									<input type="text" name="email" id="email" class="form-control form-control-sm" placeholder="Isikan Email" value="<?= isset($siswa->email)?$siswa->email:'' ?>">
								</div>
								<div class="col-sm-6">
									<label>No Registrasi Akta Lahir *</label>
									<input type="text" id="akta_lahir" name="akta_lahir" class="form-control form-control-sm" placeholder="Isikan No registrasi akta lahir" value="<?= isset($siswa->akta_lahir)?$siswa->akta_lahir:'' ?>">
								</div>
							</div>
							<div class="form-group">
								<label>Kebutuhan Khusus</label>
								<input type="text" name="kebutuhan" id="kebutuhan" class="form-control form-control-sm" placeholder="Isikan jika punya kebutuhan khusus" value="<?= isset($siswa->kebutuhan_khusus)?$siswa->kebutuhan_khusus:'' ?>">
							</div>
							<div class="form-group">
								<label>Anak ke- *</label>
								<input type="text" name="anak_ke" id="anak_ke" class="form-control form-control-sm" placeholder="Isikan angka" value="<?= isset($siswa->anak_ke)?$siswa->anak_ke:'' ?>">
							</div><br>
							<div class="card-header">Data Orang Tua dan Alamat Siswa</div><br>
							<div class="form-group">
								<label>Alamat Lengkap *</label>
								<textarea name="alamat" id="alamat" class="form-control" cols="6" placeholder="Beserta RT dan RW"><?= isset($siswa->alamat)?$siswa->alamat:'' ?></textarea>
							</div>
							<div class="form-group">
								<label>Nama Ayah *</label>
								<input type="text" name="ayah" id="ayah" class="form-control form-control-sm" placeholder="Isikan Nama Ayah" value="<?= isset($ortu->ayah)?$ortu->ayah:'' ?>">
							</div>
							<div class="form-group">
								<label>Nama Ibu *</label>
								<input type="text" name="ibu" id="ibu" class="form-control form-control-sm" placeholder="Isikan Nama Ibu" value="<?= isset($ortu->ibu)?$ortu->ibu:'' ?>">
							</div>
							<div class="form-group">
								<label>Nama Wali</label>
								<input type="text" name="wali" id="wali" class="form-control form-control-sm" placeholder="Isikan Nama Wali" value="<?= isset($ortu->wali)?$ortu->wali:'' ?>">
							</div>
							<div class="form-group row">
								<div class="col-sm-4">
									<label>NIK Ayah *</label>
									<input type="text" name="nik_ayah" id="nik_ayah" class="form-control form-control-sm" placeholder="Isikan NIK Ayah" value="<?= isset($ortu->nik_ayah)?$ortu->nik_ayah:'' ?>">
								</div>
								<div class="col-sm-4">
									<label>NIK Ibu *</label>
									<input type="text" name="nik_ibu" id="nik_ibu" class="form-control form-control-sm" placeholder="Isikan NIK Ibu" value="<?= isset($ortu->nik_ibu)?$ortu->nik_ibu:'' ?>">
								</div>
								<div class="col-sm-4">
									<label>NIK Wali</label>
									<input type="text" name="nik_wali" id="nik_wali" class="form-control form-control-sm" placeholder="Isikan NIK Wali" value="<?= isset($ortu->nik_wali)?$ortu->nik_wali:'' ?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-4">
									<label>Pekerjaan Ayah *</label>
									<select class="custom-select form-control-sm" id="pekerjaan_ayah" name="pekerjaan_ayah">
										<option value="">--Pilih Pekerjaan--</option>
										<?php foreach($kerja as $agm => $aa) :?>
											<option value="<?= $aa['id'] ?>" <?php if(isset($ortu->kerja_ayah)) { if($ortu->kerja_ayah == $aa['id']) { echo "selected"; } } ?>><?= $aa['nama'] ?></option>
										<?php endforeach; ?>
									</select>
									<!-- <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control form-control-sm" placeholder="Isikan Pekerjaan Ayah"> -->
								</div>
								<div class="col-sm-4">
									<label>Pekerjaan Ibu *</label>
									<select class="custom-select form-control-sm" id="pekerjaan_ibu" name="pekerjaan_ibu">
										<option value="">--Pilih Pekerjaan--</option>
										<?php foreach($kerja as $agm => $aa) :?>
											<option value="<?= $aa['id'] ?>" <?php if(isset($ortu->kerja_ibu)) { if($ortu->kerja_ibu == $aa['id']) { echo "selected"; } } ?>><?= $aa['nama'] ?></option>
										<?php endforeach; ?>
									</select>
									<!-- <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control form-control-sm" placeholder="Isikan Pekerjaan Ibu"> -->
								</div>
								<div class="col-sm-4">									
									<label>Pekerjaan Wali</label>
									<select class="custom-select form-control-sm" id="pekerjaan_wali" name="pekerjaan_wali">
										<option value="">--Pilih Pekerjaan--</option>
										<?php foreach($kerja as $agm => $aa) :?>
											<option value="<?= $aa['id'] ?>"  <?php if(isset($ortu->kerja_wali)) { if($ortu->kerja_wali == $aa['id']) { echo "selected"; } } ?>><?= $aa['nama'] ?></option>
										<?php endforeach; ?>
									</select>
									<!-- <input type="text" name="pekerjaan_wali" id="pekerjaan_wali" class="form-control form-control-sm" placeholder="Isikan Pekerjaan Wali"> -->
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-4">
									<label>Tanggal Lahir Ayah *</label>
									<input type="text" name="tgl_lahir_ayah" id="tgl_lahir_ayah" class="form-control form-control-sm dateselect" placeholder="Isikan Tanggal Lahir Ayah" value="<?= isset($ortu->lahir_ayah)?date('d-m-Y', strtotime($ortu->lahir_ayah)):'' ?>">
								</div>
								<div class="col-sm-4">
									<label>Tanggal Lahir Ibu *</label>
									<input type="text" name="tgl_lahir_ibu" id="tgl_lahir_ibu" class="form-control form-control-sm dateselect" placeholder="Isikan Tanggal Lahir Ibu" value="<?= isset($ortu->lahir_ibu)?date('d-m-Y', strtotime($ortu->lahir_ibu)):'' ?>">
								</div>
								<div class="col-sm-4">
									<label>Tanggal Lahir Wali</label>
									<input type="text" name="tgl_lahir_wali" id="tgl_lahir_wali" class="form-control form-control-sm dateselect" placeholder="Isikan Tanggal Lahir Wali" value="<?= isset($ortu->lahir_wali)?date('d-m-Y', strtotime($ortu->lahir_wali)):'' ?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-4">
									<label>Pendidikan Ayah *</label>
									<select class="custom-select form-control-sm" id="pendidikan_ayah" name="pendidikan_ayah">
										<option value="">--Pilih Pendidikan--</option>
										<?php foreach($pendidikan as $agm => $aa) :?>
											<option value="<?= $aa['id'] ?>" <?php if(isset($ortu->pendidikan_ayah)) { if($ortu->pendidikan_ayah == $aa['id']) { echo "selected"; } } ?>><?= $aa['nama'] ?></option>
										<?php endforeach; ?>
									</select>
									<!-- <input type="text" name="pendidikan_ayah" id="pendidikan_ayah" class="form-control form-control-sm" placeholder="Isikan pendidikan Ayah"> -->
								</div>
								<div class="col-sm-4">
									<label>Pendidikan Ibu *</label>
									<select class="custom-select form-control-sm" id="pendidikan_ibu" name="pendidikan_ibu">
										<option value="">--Pilih Pendidikan--</option>
										<?php foreach($pendidikan as $agm => $aa) :?>
											<option value="<?= $aa['id'] ?>" <?php if(isset($ortu->pendidikan_ibu)) { if($ortu->pendidikan_ibu == $aa['id']) { echo "selected"; } } ?>><?= $aa['nama'] ?></option>
										<?php endforeach; ?>
									</select>
									<!-- <input type="text" name="pendidikan_ibu" id="pendidikan_ibu" class="form-control form-control-sm" placeholder="Isikan pendidikan Ibu"> -->
								</div>
								<div class="col-sm-4">
									<label>Pendidikan Wali</label>
									<select class="custom-select form-control-sm" id="pendidikan_wali" name="pendidikan_wali">
										<option value="">--Pilih Pendidikan--</option>
										<?php foreach($pendidikan as $agm => $aa) :?>
											<option value="<?= $aa['id'] ?>" <?php if(isset($ortu->pendidikan_wali)) { if($ortu->pendidikan_wali == $aa['id']) { echo "selected"; } } ?>><?= $aa['nama'] ?></option>
										<?php endforeach; ?>
									</select>
									<!-- <input type="text" name="pendidikan_wali" id="pendidikan_wali" class="form-control form-control-sm" placeholder="Isikan pendidikan Wali"> -->
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-4">
									<label>Penghasilan Ayah *</label>
									<select class="custom-select form-control-sm" id="penghasilan_ayah" name="penghasilan_ayah">
										<option value="">--Pilih Penghasilan--</option>
										<?php foreach($penghasilan as $agm => $aa) :?>
											<option value="<?= $aa['id'] ?>" <?php if(isset($ortu->penghasilan_ayah)) { if($ortu->penghasilan_ayah == $aa['id']) { echo "selected"; } } ?>><?= $aa['nama'] ?></option>
										<?php endforeach; ?>
									</select>
									<!-- <input type="text" name="penghasilan_ayah" id="penghasilan_ayah" class="form-control form-control-sm" placeholder="Isikan penghasilan Ayah"> -->
								</div>
								<div class="col-sm-4">
									<label>Penghasilan Ibu *</label>
									<select class="custom-select form-control-sm" id="penghasilan_ibu" name="penghasilan_ibu">
										<option value="">--Pilih Penghasilan--</option>
										<?php foreach($penghasilan as $agm => $aa) :?>
											<option value="<?= $aa['id'] ?>" <?php if(isset($ortu->penghasilan_ibu)) { if($ortu->penghasilan_ibu == $aa['id']) { echo "selected"; } } ?>><?= $aa['nama'] ?></option>
										<?php endforeach; ?>
									</select>
									<!-- <input type="text" name="penghasilan_ibu" id="penghasilan_ibu" class="form-control form-control-sm" placeholder="Isikan penghasilan Ibu"> -->
								</div>
								<div class="col-sm-4">
									<label>Penghasilan Wali</label>
									<select class="custom-select form-control-sm" id="penghasilan_wali" name="penghasilan_wali">
										<option value="">--Pilih Penghasilan--</option>
										<?php foreach($penghasilan as $agm => $aa) :?>
											<option value="<?= $aa['id'] ?>" <?php if(isset($ortu->penghasilan_wali)) { if($ortu->penghasilan_wali == $aa['id']) { echo "selected"; } } ?>><?= $aa['nama'] ?></option>
										<?php endforeach; ?>
									</select>
									<!-- <input type="text" name="penghasilan_wali" id="penghasilan_wali" class="form-control form-control-sm" placeholder="Isikan penghasilan Wali"> -->
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
		console.log(tipe)
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

	$('#form_siswa').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: '<?= site_url("Master/add_siswa") ?>',
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
							window.location.href = '<?= site_url("master/siswa") ?>';
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
