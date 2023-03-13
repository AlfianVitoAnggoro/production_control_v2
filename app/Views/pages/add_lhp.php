<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?php 
// var_dump($data_breakdown[0]['jenis_breakdown']); die();

?>
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<form action="<?=base_url()?>lhp/save_lhp" method="post">
				<div class="box">
					<div class="box-header with-border">
						<h4>Detail Laporan Harian Produksi</h4>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-4">
								<div class="form-group">
									<label class="form-label">Tanggal Produksi</label>
									<input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi" value="<?=$tanggal_produksi?>" readonly>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label class="form-label">Line</label>
									<input type="text" class="form-control" name="line" id="line" value="<?=$line?>" readonly>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group">
									<label class="form-label">Shift</label>
									<input type="text" class="form-control" name="shift" id="shift" value="<?=$shift?>" readonly>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">Grup</label>
									<input type="text" class="form-control" id="grup" name="grup" value="<?=$grup?>" readonly>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">MP</label>
									<input type="number" class="form-control" id="mp" name="mp" value="<?=$mp?>" readonly>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">Absen</label>
									<input type="number" class="form-control" id="absen" name="absen" value="<?=$absen?>" readonly>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">Cuti</label>
									<input type="number" class="form-control" id="cuti" name="cuti" value="<?=$cuti?>" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xl-12 col-12">
						<div class="box">
							
							<div class="box-body">
								<div class="table-responsive">
									<table id="" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>#</th>
												<th>Jam</th>
												<th>Menit Tersedia</th>
												<th>Menit Aktual</th>
												<th>Jam Start</th>
												<th>Jam End</th>
												<th>Menit Terpakai</th>
												<th>No WO</th>
												<th>Type Battery</th>
												<th>CT</th>
												<th>Plan Cap</th>
												<th>Actual</th>
												<th>Act vs Plan (%)</th>
												<th>Efficiency Time (menit)</th>
												<th>Total Menit Breakdown</th>
												<th>Breakdown Jenis</th>
												<th>Breakdown Proses</th>
												<th>Breakdown Uraian</th>
												<th>Breakdown Minute</th>
												<th>Breakdown Action</th>
												<th>Reject QTY</th>
												<th>Reject Jenis</th>
												<th>Reject Remark</th>
												<th>Reject Action</th>
											</tr>
										</thead>
										<tbody id="tbody">
											<?php 
												if ($shift == '1') {
													$jam = ['07.30 - 08.50', '08.50 - 09.50', '09.50 - 11.00', '11.00 - 12.00', '12.00 - 14.00', '14.00 - 15.00', '15.00 - 16.15', '16.15 - 16.30'];
													$menit_tersedia = ['80', '60', '70', '60', '120', '60', '75', '15'];
													$menit_aktual = ['70', '60', '60', '60', '60', '60', '60', '10'];
												} elseif ($shift == '2') {
													$jam = ['16.30 - 17.50', '17.50 - 19.35', '19.35 - 20.35', '20.35 - 21.35', '21.35 - 22.45', '22.45 - 23.45', '23.45 - 00.30'];
													$menit_tersedia = ['80', '105', '60', '60', '70', '60', '45'];
													$menit_aktual = ['70', '60', '60', '60', '60', '60', '40'];
												} elseif ($shift == '3') {
													$jam = ['00.30 - 01.50', '01.50 - 02.50', '02.50 - 03.50', '03.50 - 05.20', '05.20 - 06.20', '06.20 - 07.30'];
													$menit_tersedia = ['80', '60', '60', '90', '60', '70'];
													$menit_aktual = ['70', '60', '60', '60', '60', '60'];
												}

												for ($i=0; $i < count($jam); $i++) { ?>
													<tr>
														<td>
															<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-default">
																Add
															</button> -->
															<button type="button" class="btn btn-primary" onclick="add_rows_batch(<?=$i?>)">
																Add
															</button>
														</td>
														<td>
															<span style="display:block; width: 100px;"><?=$jam[$i]?></span>
															<!-- <br>
															<button class="btn btn-primary">Add</button> -->
														</td>
														<td><?=$menit_tersedia[$i]?></td>
														<td><?=$menit_aktual[$i]?></td>
														<td>
															<div id="start_section_<?=$i?>">
																<!-- <button class="btn btn-success" onclick="time_start(<?=$i?>)">Start</button> -->
																<input type="time" class="form-control" name="start[]" id="start_<?=$i?>" value="${currentTime}" style="width: 100px;">
															</div>
														</td>
														<td>
															<div id="stop_section_<?=$i?>">
																<input type="time" class="form-control" name="stop[]" id="stop_<?=$i?>" value="${currentTime}" style="width: 100px;">
															</div>
														</td>
														<td>
															<input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_<?=$i?>" style="width: 75px">
														</td>
														<td>
															<select class="form-control select2" id="no_wo_<?=$i?>" name="no_wo[]" onchange="getPartNo(<?=$i?>)" style="width: 200px;">
																<option selected disabled>-- Pilih No WO --</option>
																<?php
																	foreach ($data_wo as $dw) { ?>
																		<option value="<?=$dw['PDNO']?>"><?=$dw['PDNO']?></option>
																<?php
																	}
																?>
																<input type="hidden" name="batch[]" id="batch_<?=$i?>" value="<?=$i+1?>">
																<!-- <input type="text" name="urutan[]" id="urutan_<?=$i?>" value="<?=$i?>"> -->

															</select>
														</td>
														<td>
															<input type="text" class="form-control" name="part_number[]" id="part_number_<?=$i?>" style="width: 250px">
														</td>
														<td>
															<input type="text" class="form-control" size="4" name="ct[]" id="ct_<?=$i?>" style="width: 75px">
														</td>
														<td>
															<input type="number" class="form-control" name="plan_cap[]" id="plan_cap_<?=$i?>" style="width: 75px" readonly>
														</td>
														<td>
															<input type="number" class="form-control" name="actual[]" id="actual_<?=$i?>" onkeyup="presentase_actual(<?=$i?>)" style="width: 75px">
														</td>
														<td>
															<input type="text" class="form-control" size="4" name="act_vs_plan[]" id="act_vs_plan_<?=$i?>" style="width: 75px" readonly>
														</td>
														<td>
															<input type="number" class="form-control" name="efficiency_time[]" id="efficiency_time_<?=$i?>" style="width: 75px" readonly>
														</td>
														<td>
															<input type="number" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_<?=$i?>" style="width: 75px" readonly>
														</td>
														<td>
															<div id="jenis_breakdown_section_<?=$i?>">
																<select class="form-control select2 mb-1" id="jenis_breakdown_<?=$i?>" name="jenis_breakdown[<?=$i?>][]" onchange="get_proses_breakdown(<?=$i?>)" style="width: 250px;">
																	<option selected disabled>-- Pilih Jenis Breakdown --</option>
																	<?php
																		foreach ($data_breakdown as $d_breakdown) { ?>
																			<option value="<?=$d_breakdown['jenis_breakdown']?>"><?=$d_breakdown['jenis_breakdown']?></option>
																	<?php 
																		}
																	?>
																</select>
																<input type="text" name="index_jenis_breakdown[]" value="<?=$i?>">
															</div>
														</td>
														<td>
															<div id="proses_breakdown_section_<?=$i?>">
																<select class="form-control select2" id="proses_breakdown_<?=$i?>" name="proses_breakdown[<?=$i?>][]" style="width: 250px;">
																	<option selected disabled>-- Pilih Proses Breakdown --</option>
																</select>
															</div>
														</td>
														<td>
															<div id="uraian_breakdown_section_<?=$i?>">
																<textarea class="form-control" name="uraian_breakdown[<?=$i?>][]" id="uraian_breakdown_<?=$i?>" cols="20" rows="2" style="width: 200px;"></textarea>
															</div>
														</td>
														<td>
															<div id="menit_breakdown_section_<?=$i?>">
																<input type="number" class="form-control" name="menit_breakdown[<?=$i?>][]" id="menit_breakdown_<?=$i?>" style="width: 75px">
															</div>
														</td>
														<td>
															<button type="button"class="btn btn-primary" id="add_proses_breakdown" onclick="add_breakdown(<?=$i?>)">Add</button>
														</td>
														<td>
															<div id="reject_qty_section">
																<input type="number" class="form-control" name="reject_qty_<?=$i?>" id="reject_qty_<?=$i?>" style="width: 75px">
															</div>
														</td>
														<td>
															<div id="jenis_reject_section">
																<select class="form-control select2" id="jenis_reject_<?=$i?>" name="jenis_reject_<?=$i?>" style="width: 200px;">
																	<option selected disabled>-- Pilih Jenis Reject --</option>
																	<option value="POLE PATAH">POLE PATAH</option>
																	<option value="FLASHING">FLASHING</option>
																	<option value="SHORT">SHORT</option>
																	<option value="BOCOR">BOCOR</option>
																	<option value="MELTING NG / GAP">MELTING NG / GAP</option>
																	<option value="POLE KETARIK">POLE KETARIK</option>
																	<option value="BOCOR POLE">BOCOR POLE</option>
																	<option value="CACAT BAKAR">CACAT BAKAR</option>
																	<option value="CACAT COVER">CACAT COVER</option>
																	<option value="CACAT CONTAINER">CACAT CONTAINER</option>
																</select>
															</div>
														</td>
														<td>
															<div id="remark_reject_section">
																<textarea class="form-control" name="remark_reject_<?=$i?>" id="" cols="20" rows="2" style="width: 200px;"></textarea>
															</div>
														</td>
														<td>
															<button class="btn btn-primary" id="add_proses_reject" onclick="add_reject(<?=$i?>)">Add</button>
														</td>
													</tr>
											<?php
												}
											?>
										</tbody>
									</table>
								</div>
								<input type="submit" class="btn btn-primary" value="Save">
							</div>
						</div>				
					</div>
				</div>
				
				<!-- <div class="row">
					<div class="col-xl-12 col-12">
						<div class="box">
							<div class="box-header with-border">
								<h4>Detail Line Stop</h4>
							</div>
							<div class="box-body">
								<form action="" method="post">
									<div class="table-responsive">
										<table id="" class="table table-striped mb-0">
											<thead>
												<tr>
													<th>Jam</th>
													<th>No WO</th>
													<th>Type Battery</th>
													<th>Breakdown Jenis</th>
													<th>Breakdown Proses</th>
													<th>Breakdown Uraian</th>
													<th>Breakdown Minute</th>
												</tr>
											</thead>
											<tbody id="tbody_line_stop">
												
											</tbody>
										</table>
									</div>
									<input type="submit" class="btn btn-primary" value="Save">
								</form>
							</div>
						</div>				
					</div>
				</div> -->
			</form>
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- modal Area -->              
  <div class="modal fade" id="modal-default">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Tambah Laporan Harian Produksi</h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <form action="<?=base_url()?>lhp/add_lhp" method="post">
			<div class="modal-body">
				<div class="row">
					<div class="col-4">
						<div class="form-group">
							<label class="form-label">Tanggal Produksi</label>
							<input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi">
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label class="form-label">Line</label>
							<select class="form-select" id="line" name="line">
								<option selected disabled>-- Pilih Data --</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</div>
					</div>
					<div class="col-4">
					<div class="form-group">
							<label class="form-label">Shift</label>
							<select class="form-select" id="shift" name="shift">
								<option selected disabled>-- Pilih Data --</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->
				<input type="submit" class="btn btn-primary float-end" value="Tambah">
			</div>
		  </form>
		</div>
		<!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
	function getPartNo(i) {
		var no_wo = $('#no_wo_'+i).val();
		$.ajax({
			url: '<?=base_url()?>lhp/getPartNo',
			type: 'POST',
			data: {no_wo: no_wo},
			dataType: 'json',
			success: function(data) {
				$('#part_number_'+i).val(data[0].MITM.trim());
				$('#plan_cap_'+i).val(data[0].QTY);

				$.ajax({
					url: '<?=base_url()?>lhp/getCT',
					type: 'POST',
					data: {part_number: data[0].MITM.trim()},
					dataType: 'json',
					success: function(data) {
						$('#ct_'+i).val(data[0].ct);
						console.log(data);
					}
				});
			}
		});
	}

	function presentase_actual(i) {
		var plan_cap = $('#plan_cap_'+i).val();
		var actual = $('#actual_'+i).val();
		var presentase = (actual / plan_cap) * 100;
		$('#act_vs_plan_'+i).val(presentase.toFixed(2));

		var ct = $('#ct_'+i).val();
		var total_minute = (actual * ct) / 60;
		var efficiency_time = total_minute.toFixed(0);
		$('#efficiency_time_'+i).val(efficiency_time);

		
		var total_menit_breakdown = $('#menit_terpakai_'+i).val() - efficiency_time;
		$('#total_menit_breakdown_'+i).val(total_menit_breakdown);
	}

	var temp_i;
	function add_breakdown(i) {
		var a = 1;
		if (temp_i != i) {
			temp_i = i;
			a = 1;
		} else {
			a += 1; 
		}

		var b = "" + a + i

		var data_breakdown = <?php echo json_encode($data_breakdown); ?>;


		$('#jenis_breakdown_section_'+i).append(`
			<select class="form-control select2" id="jenis_breakdown_${b}" name="jenis_breakdown[${i}][]" onchange="get_proses_breakdown(${b})" style="width: 250px;">
				<option selected disabled>-- Pilih Jenis Breakdown --</option>
				${data_breakdown.map((item) => `<option value="${item.jenis_breakdown}">${item.jenis_breakdown}</option>`)}
			</select>
		`);

		$('#proses_breakdown_section_'+i).append(`
			<select class="form-control select2" id="proses_breakdown_${b}" name="proses_breakdown[${i}][]">
				<option selected disabled>-- Pilih Proses Breakdown --</option>
			</select>
		`);
		$('#uraian_breakdown_section_'+i).append(`
			<textarea class="form-control" name="uraian_breakdown[${i}][]" id="uraian_breakdown_${b}" cols="20" rows="2"></textarea>
		`);
		$('#menit_breakdown_section_'+i).append(`
			<input type="number" class="form-control" name="menit_breakdown[${i}][]" id="menit_breakdown_${b}" style="width: 75px">
		`);

		$('.select2').select2();
	}

	function add_reject(i) {
		$('#reject_qty_section').append(`
			<input type="number" name="reject_qty_${i}" id="reject_qty_${i}" style="width: 75px">
		`);
		$('#jenis_reject_section').append(`
			<select class="form-control select2" id="jenis_reject_${i}" name="jenis_reject_${i}">
				<option selected disabled>-- Pilih Jenis Reject --</option>
			</select>
		`);
		$('#remark_reject_section').append(`
			<textarea name="remark_reject_${i}" id="" cols="20" rows="2"></textarea>
		`);
	}

	function get_proses_breakdown(i) {
		var jenis_breakdown = $('#jenis_breakdown_'+i).val();
		$.ajax({
			url: '<?=base_url()?>lhp/get_proses_breakdown',
			type: 'POST',
			data: {jenis_breakdown: jenis_breakdown},
			dataType: 'json',
			success: function(data) {
				console.log(i);
				console.log(data);
				$('#proses_breakdown_'+i).html(`
					<option selected disabled>-- Pilih Proses Breakdown --</option>
					${data.map((item) => `<option value="${item.proses_breakdown}">${item.proses_breakdown}</option>`)}
				`);
			}
		});
	}

	function add_rows_batch(i) {
		var data_wo = <?php echo json_encode($data_wo); ?>;
		var data_breakdown = <?php echo json_encode($data_breakdown); ?>;

		var tbody = document.getElementById('tbody'), row, k;

		// Ambil total jumlah row untuk mengetahui row mana yang akan di tambahkan
		var count_row = tbody.rows.length;
		var j = (count_row - 7) + i;		
		var total_row = count_row + 1;

		row = tbody.insertRow(j);
		row.innerHTML = `
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>
					<div id="start_section_${total_row}">
						<!-- <button class="btn btn-success" onclick="time_start(${total_row})">Start</button> -->
						<input type="time" class="form-control" name="start[]" id="start_${i}" style="width: 100px;">
					</div>
				</td>
				<td>
					<div id="stop_section_${total_row}">
						<input type="time" class="form-control" name="stop[]" id="stop_${i}" style="width: 100px;">
					</div>
				</td>
				<td>
					<input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_${total_row}" style="width: 75px">
				</td>
				<td>
					<select class="form-control select2" id="no_wo_${total_row}" name="no_wo[]" onchange="getPartNo(${total_row})" style="width: 200px;">
						<option selected disabled>-- Pilih No WO --</option>
						${data_wo.map((item) => `<option value="${item.PDNO}">${item.PDNO}</option>`)}
					</select>
					<input type="text" name="batch[]" id="batch_${total_row}" value="${i+1}">
				</td>
				<td>
					<input type="text" class="form-control" name="part_number[]" id="part_number_${total_row}" style="width: 250px">
				</td>
				<td>
					<input type="text" class="form-control" size="4" name="ct[]" id="ct_${total_row}" style="width: 75px">
				</td>
				<td>
					<input type="number" class="form-control" name="plan_cap[]" id="plan_cap_${total_row}" style="width: 75px" readonly>
				</td>
				<td>
					<input type="number" class="form-control" name="actual[]" id="actual_${total_row}" onkeyup="presentase_actual(${total_row})" style="width: 75px">
				</td>
				<td>
					<input type="text" class="form-control" size="4" name="act_vs_plan[]" id="act_vs_plan_${total_row}" style="width: 75px" readonly>
				</td>
				<td>
					<input type="number" class="form-control" name="efficiency_time[]" id="efficiency_time_${total_row}" style="width: 75px" readonly>
				</td>
				<td>
					<input type="number" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_${total_row}" style="width: 75px" readonly>
				</td>
				<td>
					<div id="jenis_breakdown_section_${total_row}">
						<select class="form-control select2 mb-1" id="jenis_breakdown_${total_row}" name="jenis_breakdown[${total_row}][]" onchange="get_proses_breakdown(${total_row})" style="width: 250px;">
							<option selected disabled>-- Pilih Jenis Breakdown --</option>
							${data_breakdown.map((item) => `<option value="${item.jenis_breakdown}">${item.jenis_breakdown}</option>`)}							
						</select>
					</div>
					<input type="text" name="index_jenis_breakdown[]" value="${total_row}">
				</td>
				<td>
					<div id="proses_breakdown_section_${total_row}">
						<select class="form-control select2" id="proses_breakdown_${total_row}" name="proses_breakdown[${total_row}][]" style="width: 250px;">
							<option selected disabled>-- Pilih Proses Breakdown --</option>
						</select>
					</div>
				</td>
				<td>
					<div id="uraian_breakdown_section_${total_row}">
						<textarea class="form-control" name="uraian_breakdown[${total_row}][]" id="" cols="20" rows="2" style="width: 200px;"></textarea>
					</div>
				</td>
				<td>
					<div id="menit_breakdown_section_${total_row}">
						<input type="number" class="form-control" name="menit_breakdown[${total_row}][]" id="menit_breakdown_${total_row}" style="width: 75px">
					</div>
				</td>
				<td>
					<button type="button"class="btn btn-primary" id="add_proses_breakdown" onclick="add_breakdown(${total_row})">Add</button>
				</td>
				<td>
					<div id="reject_qty_section">
						<input type="number" class="form-control" name="reject_qty_${total_row}" id="reject_qty_${total_row}" style="width: 75px">
					</div>
				</td>
				<td>
					<div id="jenis_reject_section">
						<select class="form-control select2" id="jenis_reject_${total_row}" name="jenis_reject_${total_row}" style="width: 200px;">
							<option selected disabled>-- Pilih Jenis Reject --</option>
							<option value="POLE PATAH">POLE PATAH</option>
							<option value="FLASHING">FLASHING</option>
							<option value="SHORT">SHORT</option>
							<option value="BOCOR">BOCOR</option>
							<option value="MELTING NG / GAP">MELTING NG / GAP</option>
							<option value="POLE KETARIK">POLE KETARIK</option>
							<option value="BOCOR POLE">BOCOR POLE</option>
							<option value="CACAT BAKAR">CACAT BAKAR</option>
							<option value="CACAT COVER">CACAT COVER</option>
							<option value="CACAT CONTAINER">CACAT CONTAINER</option>
						</select>
					</div>
				</td>
				<td>
					<div id="remark_reject_section">
						<textarea class="form-control" name="remark_reject_${total_row}" id="" cols="20" rows="2" style="width: 200px;"></textarea>
					</div>
				</td>
				<td>
					<button class="btn btn-primary" id="add_jenis_reject" onclick="add_reject(${total_row})">Add</button>
				</td>
			</tr>
		`;

		$('.select2').select2();
	}

	function time_start(i) {
		var date = new Date();
		var currentTime = date.toLocaleString().substring(11,16);
		$('#start_section_'+i).html(`
			<input type="time" class="form-control" name="start_${i}" id="start_${i}" value="${currentTime}" style="width: 100px;">
		`);

		$('#stop_section_'+i).html(`
			<button class="btn btn-danger" onclick="time_stop(${i})">Stop</button>
		`);
	}

	function time_stop(i) {
		var date = new Date();
		var currentTime = date.toLocaleString().substring(11,16);
		$('#stop_section_'+i).html(`
			<input type="time" class="form-control" name="stop_${i}" id="stop_${i}" value="${currentTime}" style="width: 100px;">
		`);
	}

</script>
<?= $this->endSection(); ?>