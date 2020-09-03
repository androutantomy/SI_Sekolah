<div class="container-fluid row">
	<div class="col-lg-12 row">
		<div class="col-lg-6">
			<div id="img"></div><img src="<?= ($data_user->profile != '') ? base_url($data_user->profile) : base_url('assets/images/person_2.jpg') ?>" alt="user profile" width="200px" height="200px"> <br>
			<div class="form-group">
				<label>Foto Profil</label>
				<input type="file" name="profile" id="profile" class="form-control form-control-sm" value="<?= ($data_user->profile != '') ? base_url($data_user->profile) : ''; ?>">
			</div>
		</div>
		<div class="col-lg-6 card card-body">
			<form id="xyz">
				<div class="form-group">
					<label>Nama Lengkap</label>
					<input type="text" name="fullname" class="form-control form-control-sm" placeholder="Isikan Nama Lengkap" value="<?= $data_user->fullname ?>">
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control form-control-sm" placeholder="Isikan Username" value="<?= $data_user->username ?>">
				</div>
				<div class="form-group">
					<label>Level</label>
					<div class="row" id="daftarLevel"></div>
				</div>
				<div class="form-group">
					<label>Strata</label>
					<select name="strata" id="strata" class="form-control form-control-sm"></select>
				</div>
				<div id="text_alert"></div>
				<button class="btn btn-sm btn-success float-right" id="submit"><i class="far fa-check-circle"></i>	Simpan</button>
			</form>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	var url = "<?= site_url('Akun/listStrata/').$data_user->strata; ?>";
	$('#strata').load(url);

	var url = "<?= site_url('Akun/listLevel/') ?>";
	$('#daftarLevel').load(url);
});

$('#profile').on('change', (function() {
	$.ajax({
			url: '<?= site_url('Akun/updateProfile') ?>',
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
							$('#text_alert').hide();
							window.location.href = '<?= site_url("Akun") ?>';
						}
					})
				} else {
					$('#text_alert').show();
					$('#text_alert').html('<i class="fas fa-times"></i> ' + response.m);
					$('#text_alert').attr('style', 'color:red;');
				}
			},
		});
}));

$('#xyz').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: '<?= site_url('Akun/updateAkun') ?>',
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
							$('#text_alert').hide();
							window.location.href = '<?= site_url("Akun") ?>';
						}
					})
				} else {
					$('#text_alert').show();
					$('#text_alert').html('<i class="fas fa-times"></i> ' + response.m);
					$('#text_alert').attr('style', 'color:red;');
				}
			},
		});
	});
</script>
