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
			<div class="row">
				<div class="col-xl-12 col-12">
					<div class="box">
						<div class="box-header with-border">
							<h4>Detail LHP</h4>
						</div>
						<div class="box-body">
							<div class="table-responsive">
								<table id="" class="table table-striped mb-0" style="width:100%">
									<thead>
										<tr>
											<th style="width:15%">Jam</th>
											<th>Menit Tersedia</th>
											<th>Menit Aktual</th>
											<th style="width:35%">No WO</th>
											<th>Type Battery</th>
											<th>CT</th>
											<th>Plan Cap</th>
											<th>Actual</th>
											<th>Act vs Cap</th>
											<th>Breakdown Jenis</th>
											<th>Breakdown Proses</th>
											<th>Breakdown Uraian</th>
											<th>Breakdown Minute</th>
											<th>Breakdown Action</th>
											<th>Reject QTY</th>
											<th>Reject Jenis</th>
											<th>Reject Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$jam = ['07.30 - 08.50', '08.50 - 09.50', '09.50 - 11.00', '11.00 - 12.00', '12.00 - 14.00', '14.00 - 15.00', '15.00 - 16.15', '16.15 - 16.30'];
											$jam2 = ['07.30 - 08.50', '08.50 - 09.50', '09.50 - 11.00', '11.00 - 12.00', '12.00 - 14.00', '14.00 - 15.00', '15.00 - 16.15', '16.15 - 16.30'];
											$menit_tersedia = ['80', '60', '70', '60', '120', '60', '75', '15'];
											$menit_aktual = ['70', '60', '60', '60', '60', '60', '60', '10'];

											for ($i=0; $i < count($jam); $i++) { ?>
												<tr>
													<td> <span class="text-wrap"><?=$jam[$i]?></span></td>
													<td><?=$menit_tersedia[$i]?></td>
													<td><?=$menit_aktual[$i]?></td>
													<td>
														<select class="form-control select2" id="no_wo_<?=$i?>" name="no_wo_<?=$i?>" onchange="getPartNo(<?=$i?>)">
															<option selected disabled>-- Pilih No WO --</option>
															<?php
																foreach ($data_wo as $dw) { ?>
																	<option value="<?=$dw['PDNO']?>"><?=$dw['PDNO']?></option>
															<?php
																}
															?>
														</select>
													</td>
													<td>
														<input type="text" name="part_number_<?=$i?>" id="part_number_<?=$i?>">
													</td>
													<td>
														<input type="text" size="4" name="ct_<?=$i?>" id="ct_<?=$i?>">
													</td>
													<td>
														<input type="number" name="plan_cap_<?=$i?>" id="plan_cap_<?=$i?>" style="width: 50px">
													</td>
													<td>
														<input type="number" name="actual_<?=$i?>" id="actual_<?=$i?>" onkeyup="presentase_actual(<?=$i?>)" style="width: 50px">
													</td>
													<td>
														<input type="text" size="4" name="act_vs_cap_<?=$i?>" id="act_vs_cap_<?=$i?>">
													</td>
													<td>
														<div id="jenis_breakdown_section">
															<select class="form-control select2" id="jenis_breakdown_<?=$i?>" name="jenis_breakdown_<?=$i?>">
																<option selected disabled>-- Pilih Jenis Breakdown --</option>
																<?php
																	foreach ($data_breakdown as $d_breakdown) { ?>
																		<option value="<?=$d_breakdown['jenis_breakdown']?>"><?=$d_breakdown['jenis_breakdown']?></option>
																<?php 
																	}
																?>
															</select>
														</div>
													</td>
													<td>
														<div id="proses_breakdown_section">
															<select class="form-control select2" id="proses_breakdown_<?=$i?>" name="proses_breakdown_<?=$i?>">
																<option selected disabled>-- Pilih Proses Breakdown --</option>
															</select>
														</div>
													</td>
													<td>
														<div id="uraian_breakdown_section">
															<textarea name="uraian_breakdown_<?=$i?>" id="" cols="20" rows="2"></textarea>
														</div>
													</td>
													<td>
														<div id="breakdown_minute_section">
															<input type="number" name="breakdown_minute_<?=$i?>" id="breakdown_minute_<?=$i?>" style="width: 50px">
														</div>
													</td>
													<td>
														<button class="btn btn-primary" id="add_breakdown" onclick="add_breakdown(<?=$i?>)">Add</button>
														<!-- <button class="btn btn-danger" id="remove_breakdown" onclick="remove_breakdown(<?=$i?>)">Remove</button> -->
													</td>
													<td>
														<div id="reject_qty_section">
															<input type="number" name="reject_qty_<?=$i?>" id="reject_qty_<?=$i?>" style="width: 50px">
														</div>
													</td>
													<td>
														<div id="jenis_reject_section">
															<select class="form-control select2" id="jenis_reject_<?=$i?>" name="jenis_reject_<?=$i?>">
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
														<button class="btn btn-primary" id="add_reject" onclick="add_reject(<?=$i?>)">Add</button>
													</td>
												</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>				
				</div>
			</div>	
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
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
		$('#act_vs_cap_'+i).val(presentase.toFixed(2));
	}

	function add_breakdown(i) {
		$('#jenis_breakdown_section').append(`
			<select class="form-control select2" id="jenis_breakdown_${i}" name="jenis_breakdown_${i}">
				<option selected disabled>-- Pilih Jenis Breakdown --</option>
			</select>
		`);
		$('#proses_breakdown_section').append(`
			<select class="form-control select2" id="proses_breakdown_${i}" name="proses_breakdown_${i}">
				<option selected disabled>-- Pilih Proses Breakdown --</option>
			</select>
		`);
		$('#uraian_breakdown_section').append(`
			<textarea name="uraian_breakdown_${i}" id="" cols="20" rows="2"></textarea>
		`);
		$('#breakdown_minute_section').append(`
			<input type="number" name="breakdown_minute_${i}" id="breakdown_minute_${i}" style="width: 50px">
		`);
	}

	function add_reject(i) {
		$('#reject_qty_section').append(`
			<input type="number" name="reject_qty_${i}" id="reject_qty_${i}" style="width: 50px">
		`);
		$('#jenis_reject_section').append(`
			<select class="form-control select2" id="jenis_reject_${i}" name="jenis_reject_${i}">
				<option selected disabled>-- Pilih Jenis Reject --</option>
			</select>
		`);
	}


</script>
<?= $this->endSection(); ?>