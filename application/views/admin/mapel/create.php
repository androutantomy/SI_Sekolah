<div class="container-fluid row">
	<div class="col-lg-6">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<h3 class="card-title">Tambah Soal</h3>
			</div>
			<form id="simpan_soal">
				<div class="card-body" style="margin: 0px;">					
					<div class="form-group">
						<label>Jenis Soal</label>
						<select class="form-control form-control-sm" name="type" id="type">
							<option value="1">Pilihan Ganda</option>
							<option value="2" selected>Isian</option>
						</select>
					</div>
					<div class="form-group">
						<label>Soal</label>
						<input type="hidden" name="id_soal" id="id_soal">
						<input type="hidden" name="mapel" id="mapel" value="<?= $hash_id; ?>">
						<textarea name="nama" id="nama" class="form-control form-control-sm soal textarea" placeholder="Isikan Pertanyaan" rows="5"></textarea>
					</div>
					<div class="form-group">
						<div class='form-group' id="ganda">
							<div class='input-group mb-1 input-group-sm ganda'><div class='input-group-prepend'><span class='input-group-text'><input type="hidden" name="id_jawaban_a" id="id_jawaban_a" value=""><input type="radio" name="jawaban" id="a" value="a">A</span></div><input name='pilihan_1' class='form-control form-control-sm soal' id='pilihan_1' placeholder='Isikan pilihan'></div>
							<div class='input-group mb-1 input-group-sm ganda'><div class='input-group-prepend'><span class='input-group-text'><input type="hidden" name="id_jawaban_b" id="id_jawaban_b" value=""><input type="radio" name="jawaban" id="b" value="b">B</span></div><input name='pilihan_2' class='form-control form-control-sm soal' id='pilihan_2' placeholder='Isikan pilihan'></div>
							<div class='input-group mb-1 input-group-sm ganda'><div class='input-group-prepend'><span class='input-group-text'><input type="hidden" name="id_jawaban_c" id="id_jawaban_c" value=""><input type="radio" name="jawaban" id="c" value="c">C</span></div><input name='pilihan_3' class='form-control form-control-sm soal' id='pilihan_3' placeholder='Isikan pilihan'></div>
							<div class='input-group mb-1 input-group-sm ganda'><div class='input-group-prepend'><span class='input-group-text'><input type="hidden" name="id_jawaban_d" id="id_jawaban_d" value=""><input type="radio" name="jawaban" id="d" value="d">D</span></div><input name='pilihan_4' class='form-control form-control-sm soal' id='pilihan_4' placeholder='Isikan pilihan'></div>
							<div class='input-group mb-1 input-group-sm'><div class='input-group-prepend'><span class='input-group-text'><input type="hidden" name="id_jawaban_e" id="id_jawaban_e" value=""><input type="radio" name="jawaban" id="e" value="e">E</span></div><input name='pilihan_5' class='form-control form-control-sm soal' id='pilihan_5' placeholder='Isikan pilihan'></div>
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

	<div class="col-lg-6">
		<div class="card card-primary card-outline">
			<div class="card-header">
				<h3 class="card-title">Daftar Pertanyaan</h3>
			</div>
			<div class="card-body" style="margin: 0px;">		
				<table class="table" id="daftarSoalMapel">
					<thead>
						<th width="5%"></th>
						<th></th>
						<th width="10%"></th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		daftarSoalMapel();
	});
	
	$(function () {
		$('.textarea').summernote({
			height : 300,
		})
	})

	$('#ganda').hide();
	$('#type').on('change', function() {

		if($(this).val() == 1) {
			$('#ganda').show();
			$('.ganda').attr('required', 'required');
		} else {
			$('#ganda').hide();
		}
	});

	$('#reset').on('click', function() {
		$('.soal').val('');
		$('.textarea').summernote('reset');
		$('#ganda').hide();
	})

	$('#simpan_soal').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: '<?= site_url('Kelas/simpanSoal') ?>',
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
							$('#reset').trigger("click");
							$('.textarea').summernote('reset');
							$('#ganda').hide();
							$('.ganda').removeAttr('required');
							location.reload();
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

	function daftarSoalMapel()
	{
		var hash_id = "<?= $hash_id; ?>";
		$('#daftarSoalMapel').DataTable({ 

			"processing": true, 
			"serverSide": true, 
			"order": [], 

			"ajax": {
				"url": "<?php echo site_url('Kelas/listPertanyaan/')?>"+ hash_id,
				"type": "POST"
			},

		});
	}

	$(document).on('click', '.edit', function() {
		var id = $(this).attr('id');
		$.ajax({    
			type: "GET",
			url: "<?= site_url('Kelas/ambilDataTugas/') ?>" + id,     
			dataType: "json",            
			success: function(response){    				
				fetchDataEdit(response);
			}

		});
	});

	$(document).on('click', '.hapus', function() {
		var id = $(this).attr('id');
		Swal.fire({
			title: 'Yakin Hapus Soal?',
			text: "Soal tidak dapat dikembalikan jika sudah dihapus!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({    
					type: "GET",
					url: "<?= site_url('Kelas/hapusDataSoal/') ?>" + id,     
					dataType: "json",            
					success: function(response){    				
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
									$('#reset').trigger("click");
									$('.textarea').summernote('reset');
									$('#ganda').hide();
									$('.ganda').removeAttr('required');
									location.reload();
								}
							})
						} else {
							$('#text_alert').show();
							$('#text_alert').html('<i class="fas fa-times"></i> ' + response.m);
							$('#text_alert').attr('style', 'color:red;');
						}
					}

				})
			}
		})
	});

	function fetchDataEdit(d)
	{
		var id_soal = d.id;
		var id_mapel = d.id_mapel;
		var nama = d.nama;
		var type = d.type;
		var jawaban = d.jawaban;
		$('#'+jawaban).attr('checked', 'checked');

		if(type == '1') {
			$('#type').val(type);
			$('#type').trigger("change");
			$.ajax({    
				type: "GET",
				url: "<?= site_url('Kelas/ambilDataTugasGanda/') ?>" + id_soal,     
				dataType: "json",            
				success: function(r){  	
					var no = 1;			 	
					var aa = 65;				
					$.each(r, function(i, e) {
						$('#pilihan_'+no).val(e.teks);
						var char = charUp(aa);
						$('#id_jawaban_'+char.toLowerCase()).val(e.id);
						no++;
						aa++;
					});	
				}
			}); 
		}

		$('#id_soal').val(id_soal);
		$('#mapel').val(id_mapel);
		$(".textarea").summernote("code", nama);
		$('#submit').html('<i class="far fa-check-circle"></i> Edit');
	}

	function charUp(char)
	{
		return String.fromCharCode(char);
	}
</script>
