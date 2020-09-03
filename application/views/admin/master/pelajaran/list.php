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
			<div class="card card-primary card-outline">
				<div id="user_action">
					<div class="card-header">Tambah Mata Pelajaran
						<div class="card-tools">
							<button type="button" class="btn btn-tool" ><i onclick="location.reload();" class="fas fa-plus"></i>
							</button>
						</div>
					</div>
					<form id="form_mapel">
						<div class="card-body">
							<div class="form-group">
								<label>Nama Mapel</label>
								<input type="hidden" name="id" value="">
								<input type="text" name="mapel" class="form-control form-control-sm">
							</div>
							<div class="form-group">
								<label>Strata Kelas</label><br>
								<div class="row">
									<?php foreach($strata as $str => $s) : ?>
									<div class="col-lg-3">
										<div class="icheck-primary d-inline level">
											<input type="checkbox" id="<?= $s['id'] ?>"  name="strata[]" value="<?= $s['id'] ?>">
											<label for="<?= $s['id'] ?>">
												<?= $s['nama'] ?>
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
				</div>
			</div>			
		</div>

		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Daftar Mata Pelajaran</h3>
							<div class="card-tools">
								<form class="form-inline ml-3" action="<?= site_url('master/pelajaran') ?>" method="GET">
									<div class="input-group input-group-sm">
										<input class="form-control form-control-navbar" type="text" name="search" placeholder="Search" aria-label="Search">
										<div class="input-group-append">
											<button class="btn btn-navbar" type="submit">
												<i class="fas fa-search"></i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="card-body p-0">
							<ul class="nav nav-pills flex-column" id="mata_pelajaran">
								<?php foreach ($pelajaran as $p) { ?>
									<li class="nav-item">
										<div class="row">
											<div class="col-xs-8" onclick="populate_mapel(<?= $p->id; ?>);">
												<a href="#" class="nav-link">
													<i class="far fa-address-book"></i>  <?= $p->nama; ?>
												</a>
											</div>
											<div class="col-xs-4 right" style="margin: 10px; padding-right: 30px;">
												<a href="#" class="badge bg-danger float-right" onclick="conf(<?= $p->id; ?>)"><i class="fas fa-trash-alt"></i> Hapus</a>
											</div>
										</div>
									</li>			
								<?php } ?>
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

	</div>
</div>

<script>
	$(document).ready(function() {
		// $('#mata_pelajaran').load('<?= site_url("master/daftar_pelajaran/")?>');
	});

	function populate_mapel(id)
	{
		$('#user_action').load('<?= site_url("master/populate_mapel/")?>'+id);
	}

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
			url: '<?= site_url("Master/hapus/master_mata_pelajaran/") ?>' + id,
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
