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
							<h3 class="card-title">Daftar Strata</h3>
						</div>
						<div class="card-body p-0">
							<ul class="nav nav-pills flex-column">
								<?php foreach($strata as $str => $s) : if($s['id_parent'] == 0) { ?>
									<li class="nav-item active">
										<div class="row">
											<div class="col-xs-8">
												<a href="#" onclick="populate_user();" class="nav-link">
													<label>
														<i class="fas fa-university"></i>  <?= $s['nama'] ?>
													</label>
												</a>	
											</div>
											<div class="col-xs-4 right" style="margin: 10px; padding-right: 30px;">
												<a href="#" class="badge bg-danger float-right" onclick="conf(<?= $s['id'] ?>)"><i class="fas fa-trash-alt"></i> Hapus</a>
											</div>
										</div>
									</li>
								<?php } endforeach;?>
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
		<div class="col-lg-4">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Sub Strata</h3>
						</div>
						<div class="card-body p-0">
							<ul class="nav nav-pills flex-column">
								<?php foreach($strata as $str => $s) :  if($s['id_parent'] != 0) { ?>
									<li class="nav-item active">
										<div class="row">
											<div class="col-xs-8">
												<a href="#" onclick="populate_user();" class="nav-link">
													<label>
														<i class="fas fa-university"></i>  <?= $s['nama'] ?>
													</label>
												</a>	
											</div>
											<div class="col-xs-4 right" style="margin: 10px; padding-right: 30px;">
												<a href="#" class="badge bg-danger float-right" onclick="conf(<?= $s['id'] ?>)"><i class="fas fa-trash-alt"></i> Hapus</a>
											</div>
										</div>
									</li>
								<?php } endforeach;?>
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
		<div class="col-lg-4">
			<div class="card card-primary card-outline">
				<div class="card-header">
					<h3 class="card-title">Tambah Strata</h3>
				</div>
				<form id="form_strata">
					<div class="card-body">
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" class="form-control form-control-sm" placeholder="Isikan nama strata">
						</div>
						<div class="form-group">
							<label>Sub Strata </label>
							<select class="form-control form-control-sm" name="sub" >
								<option value="0">-- Utama --</option>
								<?php foreach($strata as $str => $s) : if($s['id_parent'] == 0) { ?>
									<option value="<?= $s['id'] ?>"><?= $s['nama'] ?></option>
								<?php } endforeach;?>
							</select> 
						</div>
					</div>
					<div class="card-footer">
						<div class="float-right">
							<button type="submit" class="btn btn-sm btn-success"><i class="far fa-check-circle"></i> Simpan</button>
						</div>						
						<label id="text_alert"></label>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

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
			url: '<?= site_url("Master/hapus/master_strata/") ?>' + id,
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

	$('#form_strata').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: '<?= site_url("Master/create_strata") ?>',
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
