<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?php 
// var_dump($data_detail_breakdown);die;
date_default_timezone_set('Asia/Jakarta');
$datetime_now = date('Y-m-d H:i:s');

if ($data_lhp[0]['shift'] == 1) {
	$jam_selesai = "16:30:00";
} elseif ($data_lhp[0]['shift'] == 2) {
	$jam_selesai = "00:30:00";
} elseif ($data_lhp[0]['shift'] == 3) {
	$jam_selesai = "07:30:00";
}

if (date('Y-m-d H:i:s', strtotime($data_lhp[0]['tanggal_produksi'].' '.$jam_selesai)) < $datetime_now) {
	$readonly = "readonly";
	$disabled = "disabled";
} else {
	$readonly = "";
	$disabled = "";
}

if (session()->get('level') == 1 && (session()->get('departemen') == 'quality' || session()->get('departemen') == 'produksi2')) {
	$readonly = "";
	$disabled = "";
}

?>
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<form action="<?=base_url()?>wet_loading_new/update_lhp" method="post">
				<input type="hidden" name="id_lhp" id="id_lhp" value="<?=$id_lhp?>">
				<div class="box">
					<div class="box-header with-border">
						<h4>Detail Laporan Harian Produksi</h4>
					</div>
					<div class="box-body" style="padding-top:5px; padding-bottom:0px;">
						<div class="row">
							<div class="col-6">
								<div class="row">
									<div class="col-4">
										<div class="form-group">
											<label class="form-label">Tanggal Produksi</label>
											<input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi" value="<?=$data_lhp[0]['tanggal_produksi']?>">
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label class="form-label">PIC</label>
											<select class="form-control select2" id="grup" name="grup" style="width: 100%;">
												<option selected disabled>-- Pilih Data --</option>
												<?php 
													foreach ($data_all_grup as $key => $value) {
														?>
															<option value="<?=$value['id_pic']?>" <?php if($value['id_pic'] == $data_lhp[0]['grup']){echo "selected";} ?>><?=$value['nama_pic']?></option>
														<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label class="form-label">MP</label>
											<input type="number" class="form-control" id="mp" name="mp" value="<?=$data_lhp[0]['mp']?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-4">
										<div class="form-group">
											<label class="form-label">Shift</label>
											<select class="form-select" id="shift" name="shift">
												<option selected disabled>-- Pilih Data --</option>
												<option value="1" <?php if($data_lhp[0]['shift'] == 1){echo "selected";} ?>>Shift 1</option>
												<option value="2" <?php if($data_lhp[0]['shift'] == 2){echo "selected";} ?>>Shift 2</option>
												<option value="3" <?php if($data_lhp[0]['shift'] == 3){echo "selected";} ?>>Shift 3</option>
											</select>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label class="form-label">Line</label>
											<select class="form-select" id="line" name="line" style="width: 100%;">
												<option selected disabled>-- Pilih Data --</option>
												<?php 
													foreach ($data_all_line as $key => $value) {
														?>
															<option value="<?=$value['id_line']?>" <?php if($value['id_line'] == $data_lhp[0]['line']){echo "selected";} ?>><?=$value['nama_line']?></option>
														<?php
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label class="form-label">Kasubsie</label>
											<select class="form-control select2" id="kasubsie" name="kasubsie" style="width: 100%;">
												<option selected disabled>-- Pilih Data --</option>
												<option value="Yusuf Slamet Pelita" <?php if($data_lhp[0]['kasubsie'] == "Yusuf Slamet Pelita"){echo "selected";} ?>>Yusuf Slamet Pelita</option>
												<option value="Edi Suwito" <?php if($data_lhp[0]['kasubsie'] == "Edi Suwito"){echo "selected";} ?>>Edi Suwito</option>
												<option value="Masruri" <?php if($data_lhp[0]['kasubsie'] == "Masruri"){echo "selected";} ?>>Masruri</option>
												<option value="Parwadi"  <?php if($data_lhp[0]['kasubsie'] == "Parwadi"){echo "selected";} ?>>Parwadi</option>
												<option value="Iim Arwisman" <?php if($data_lhp[0]['kasubsie'] == "Iim Arwisman"){echo "selected";} ?>>Iim Arwisman</option>
												<option value="Dika Pratama" <?php if($data_lhp[0]['kasubsie'] == "Dika Pratama"){echo "selected";} ?>>Dika Pratama</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="col-2" style="display:flex; justify-content:space-evenly;flex-direction: column;">
								<table id="" class="table" style="width:300px; font-size: 18px;">
									<thead>
										<tr>
											<th>MH</th>
											<th>:</th>
											<th><span id="mh"></span></th>
										</tr>
										<tr>
											<th>Unit / MH</th>
											<th>:</th>
											<th><span id="unit_mh"></span></th>
										</tr>
										<tr>
											<th>Efficiency</th>
											<th>:</th>
											<th><?= $eff = (!empty($data_lhp[0]['total_aktual']) && !empty($data_lhp[0]['total_plan'])) ? number_format((float) ($data_lhp[0]['total_aktual'] / $data_lhp[0]['total_plan']) * 100, 2, '.', '').' %' : '' ;?></th>
										</tr>
									</thead>
								</table>
							</div>
							<div class="col-2"></div>
							<div class="col-2" style="text-align:center;display:flex; justify-content:space-evenly; flex-direction:column-reverse;"><input type="submit" class="btn btn-success" id="submit-btn" value="Save"></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-12 col-12">
						<div class="box">
							<div class="box-header">
								<h4 class="box-title">Scan Label Produksi</h4>
							</div>
							<div class="box-body">
								<table class="table">
									<tr>
										<td>
											<input type="text" class="form-control" id="input_barcode" name="input_barcode" onchange="getPartNo()" autofocus>
											<input type="hidden" name="input_wo" id="input_wo">
											<input type="hidden" name="input_part" id="input_part">
											<input type="hidden" name="input_ct" id="input_ct">
											<input type="hidden" name="input_durasi" id="input_durasi">
											<input type="hidden" name="input_actual" id="input_actual">
										</td>
										<!-- <td><button type="button" class="btn btn-primary" onclick="add_item()">Add</button></td> -->
									</tr>
								</table>

								<table class="table" id="table_list_wo" style="display:none">
									<thead>
										<tr>
											<th>WO Charging</th>
											<th>Part Number</th>
											<th>Qty</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="data_list_wo">
										
									</tbody>
								</table>
							</div>		
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-12 col-12">
						<div class="box">
							<div class="box-body">
								<div class="table-responsive">
									<table id="data_item" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>Jam Start</th>
												<th>Jam End</th>
												<th>Menit Terpakai</th>
												<th>No WO</th>
												<th>Part Number</th>
												<th>CT</th>
												<th>Plan Cap</th>
												<th>Actual</th>
												<!-- <th>Estimasi Finish</th> -->
												<th>Menit Line Stop</th>
												<th>Pending</th>
												<th>Line Stop</th>
												<th>Reject</th>
											</tr>
										</thead>
										<tbody id="tbody_data_item">
											<?php $i = 0; foreach($data_detail_lhp as $d_detail_lhp) { ?>
												<tr class="item">
													<td>
														<input type="time" class="form-control" name="start[]" id="start_<?=$i?>" class="form-control" value="<?=date('H:i', strtotime($d_detail_lhp['jam_start']))?>" style="width:100px;" readonly>
													</td>
													<td>
														<?php if(!empty($d_detail_lhp['jam_end'])) { ?> 
															<input type="time" class="form-control" name="stop[]" id="stop_<?=$i?>" class="form-control" value="<?=date('H:i', strtotime($d_detail_lhp['jam_end']))?>" style="width:100px;" readonly>
														<?php } else { ?>
															<div id="stop_section_<?=$i?>">
																<button class="btn btn-danger" onclick="time_stop(<?=$i?>)">Stop</button>
															</div>
														<?php } ?>
													</td>
													<td>
														<?php if(!empty($d_detail_lhp['menit_terpakai'])) { ?> 
															<input type="text" class="form-control" name="menit_terpakai[]" id="menit_terpakai_<?=$i?>" class="form-control" value="<?=$d_detail_lhp['menit_terpakai']?>" style="width:100px;">
														<?php } else { ?>
															<div id="menit_terpakai_section_<?=$i?>">
																<input type="text" class="form-control" name="menit_terpakai[]" id="menit_terpakai_<?=$i?>" class="form-control" value="" style="width:100px;">
															</div>
														<?php } ?>
													</td>
													<td>
														<input type="text" class="form-control" name="no_wo[]" id="no_wo_<?=$i?>" class="form-control" value="<?=$d_detail_lhp['no_wo']?>" style="width:200px;" readonly>
														<input type="hidden" name="batch[]" id="batch_<?=$i?>" value="">
														<input type="hidden" name="id_detail_lhp[]" id="id_detail_lhp_<?=$i?>" value="<?=$d_detail_lhp['id_detail_lhp_wet_loading']?>">
													</td>
													<td>
														<input type="text" class="form-control" name="type_battery[]" id="type_battery_<?=$i?>" class="form-control" value="<?=$d_detail_lhp['type_battery']?>" style="width:250px;" readonly>
													</td>
													<td>
														<input type="text" class="form-control" name="ct[]" id="ct_<?=$i?>" class="form-control" value="<?=$d_detail_lhp['ct']?>" readonly>
													</td>
													<td>
														<?php if(!empty($d_detail_lhp['plan_cap'])) { ?> 
															<input type="text" class="form-control" name="plan_cap[]" id="plan_cap_<?=$i?>" class="form-control" value="<?=$d_detail_lhp['plan_cap']?>" readonly>
														<?php } else { ?>
															<div id="plan_cap_section_<?=$i?>">
																<input type="text" class="form-control" name="plan_cap[]" id="plan_cap_<?=$i?>" class="form-control" value="" readonly>
															</div>
														<?php } ?>
													</td>
													<td>
														<input type="text" class="form-control" name="actual[]" id="actual_<?=$i?>" class="form-control" value="<?=$d_detail_lhp['actual']?>">
													</td>
													<td>
														<?php if(!empty($d_detail_lhp['total_menit_breakdown'])) { ?> 
															<input type="text" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_<?=$i?>" class="form-control" value="<?=$d_detail_lhp['total_menit_breakdown']?>" readonly>
														<?php } else { ?>
															<div id="total_menit_breakdown_section_<?=$i?>">
																<input type="text" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_<?=$i?>" class="form-control" value="" readonly>
															</div>
														<?php } ?>
													</td>
													<td>
														<button type="button"class="btn btn-sm btn-primary" id="add_pending_<?=$i?>" onclick="add_pending(<?=$i?>)">Add</button>
													</td>
													<td>
														<button type="button"class="btn btn-sm btn-primary" id="add_breakdown_<?=$i?>" onclick="add_breakdown(<?=$i?>)">Add</button>
													</td>
													<td>
														<button type="button"class="btn btn-sm btn-primary" id="add_reject_<?=$i?>" onclick="add_reject(<?=$i?>)">Add</button>
													</td>
												</tr>
											<?php $i++; } ?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="6"></td>
												<td><h3>Total</h3></td>
												<td style="text-align: right;"><input type="text" class="form-control" name="total_actual" id="" value="<?=$data_lhp[0]['total_aktual']?>" style="width: 75px" readonly></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
								</div>
								
							</div>
						</div>				
					</div>
				</div>

				<!-- Detail Pending -->
				<div class="row" id="pending_section">
					<div class="col-xl-12 col-12">
						<div class="box">
							<div class="box-header with-border">
								<h4>Detail Pending</h4>
							</div>
							<div class="box-body">
								<div class="table-responsive">
									<table id="" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>No WO</th>
												<th>Type Battery</th>
												<th>Jenis Pending</th>
												<th>Kategori Pending</th>
												<th>Qty</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="tbody_pending">
											<?php
												$index_pending = 0;
												$this->M_WET_Loading_new = new App\Models\M_WET_Loading_new;
												foreach ($data_detail_pending as $d_detail_pending) { ?>
												<tr>
													<td>
														<input type="text" class="form-control" name="no_wo_pending[]" id="no_wo_pending_<?=$index_pending?>" value="<?=$d_detail_pending['no_wo']?>" style="width: 250px" readonly>
													</td>
													<td>
														<input type="text" class="form-control" name="type_battery_pending[]" id="type_battery_pending_<?=$index_pending?>" value="<?=$d_detail_pending['type_battery']?>" style="width: 250px" readonly>
														<input type="hidden" name="id_pending[]" id="id_pending_<?=$index_pending?>" value="<?=$d_detail_pending['id_pending_wet_loading']?>">
													</td>
													<td>
														<select class="form-control select2" name="jenis_pending[]" id="jenis_pending_<?=$index_pending?>" onchange="get_kategori_pending(<?=$index_pending?>)" style="width: 200px" required>
															<option value="" disabled>Pilih Jenis pending</option>
															<?php 
																foreach ($data_pending as $d_jenis_pending) { ?>
																	<option value="<?=$d_jenis_pending['jenis_pending']?>" <?php if($d_jenis_pending['jenis_pending'] == $d_detail_pending['jenis_pending']){echo "selected";} ?>><?=$d_jenis_pending['jenis_pending']?></option>
															<?php 
															}
															?>
														</select>
													</td>
													<td>
														<select class="form-control select2" id="kategori_pending_<?=$index_pending?>" name="kategori_pending[]" style="width: 250px;" required>
															<option selected disabled>-- Pilih Kategori Pending --</option>
															<?php
															$data_kategori_pending = $this->M_WET_Loading_new->getKategoriPending($d_detail_pending['jenis_pending']);
															foreach ($data_kategori_pending as $d_kategori_pending) { ?>
																<option value="<?=$d_kategori_pending['kategori_pending']?>" <?php if($d_kategori_pending['kategori_pending'] == $d_detail_pending['kategori_pending']){echo "selected";} ?>><?=$d_kategori_pending['kategori_pending']?></option>
															<?php
																}
															?>
														</select>
													</td>
													<td>
														<input type="text" class="form-control" name="qty_pending[]" id="qty_pending_<?=$index_pending?>" value="<?=$d_detail_pending['qty_pending']?>" style="width: 100px" required>
													</td>
													<td>
														<a type="button" class="btn btn-danger" href="<?=base_url()?>wet_loading_new/delete_pending/<?=$d_detail_pending['id_pending_wet_loading']?>/<?=$id_lhp?>" onclick="return confirm('Apakah anda yakin?')" <?=(!empty($disabled)) ? 'style="pointer-events: none;"' : ''?>><i class="fa fa-trash"></i></a>	
													</td>
												</tr>
												<?php
													$index_pending++;
												}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="3"></th>
												<td><h3>Total</h3></td>
                        						<td style="text-align: right;"><input type="text" class="form-control" name="total_pending" id="total_pending" value="<?=$total_pending[0]['total_pending']?>" style="width: 100px" readonly></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="box-footer" style="text-align: center;">
							</div>
						</div>				
					</div>
				</div>

				<!-- Detail Line Stop -->
				<div class="row" id="ls_section">
					<div class="col-xl-12 col-12">
						<div class="box">
							<div class="box-header with-border">
								<h4>Detail Line Stop</h4>
							</div>
							<div class="box-body">
								<div class="table-responsive">
									<table id="" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>Jam Start</th>
												<th>Jam Stop</th>
												<th>No WO</th>
												<th>Type Battery</th>
												<th>Line Stop Jenis</th>
												<th>Line Stop Proses</th>
												<th>Line Stop Uraian</th>
												<th>Line Stop Minute</th>
												<th>Line Stop Action</th>
											</tr>
										</thead>
										<tbody id="tbody_line_stop">
											<?php 
												$model = new App\Models\M_Data();
												$index_breakdown = 0;
												foreach ($data_detail_breakdown as $d_detail_breakdown) { ?>
												<tr>
													<td>
														<input type="time" class="form-control" name="start_breakdown[]" id="start_breakdown_<?=$index_breakdown?>" value="<?=date("H:i", strtotime($d_detail_breakdown['jam_start']))?>" style="width: 100px;">
													</td>
													<td>
														<input type="time" class="form-control" name="stop_breakdown[]" id="stop_breakdown_<?=$index_breakdown?>" value="<?=date("H:i", strtotime($d_detail_breakdown['jam_end']))?>" style="width: 100px;">
													</td>
													<td>
														<input type="text" class="form-control" name="no_wo_breakdown[]" id="no_wo_breakdown_<?=$index_breakdown?>" value="<?=$d_detail_breakdown['no_wo']?>" style="width: 225px">
													</td>
													<td>
														<input type="text" class="form-control" name="type_battery_breakdown[]" id="type_battery_breakdown_<?=$index_breakdown?>" value="<?=$d_detail_breakdown['type_battery']?>" style="width: 225px">
														<input type="hidden" class="form-control" name="id_breakdown[]" id="id_breakdown_<?=$index_breakdown?>" value="<?=$d_detail_breakdown['id_breakdown_wet_loading']?>" style="width: 250px">
													</td>
													<td>
														<select class="form-control select2" name="jenis_breakdown[]" id="jenis_breakdown_<?=$index_breakdown?>" onchange="get_proses_breakdown(<?=$index_breakdown?>)" style="width: 200px">
															<option value="">Pilih Jenis Line Stop</option>
															<?php 
																foreach ($data_breakdown as $d_jenis_breakdown) { ?>
																	<option value="<?=$d_jenis_breakdown['jenis_breakdown']?>" <?php if($d_jenis_breakdown['jenis_breakdown'] == $d_detail_breakdown['jenis_breakdown']){echo "selected";} ?>><?=$d_jenis_breakdown['jenis_breakdown']?></option>
															<?php 
															}
															?>
														</select>
													</td>
													<td>
														<select class="form-control select2" id="proses_breakdown_<?=$index_breakdown?>" name="proses_breakdown[]" style="width: 250px;">
															<option selected disabled>-- Pilih Proses Line Stop --</option>
															<?php
															$data_proses_breakdown = $model->getProsesBreakdown($d_detail_breakdown['jenis_breakdown']);
															$andon_proses = true;
															foreach ($data_proses_breakdown as $d_proses_breakdown) {
																$selected = ($d_proses_breakdown['proses_breakdown'] == $d_detail_breakdown['proses_breakdown']) ? 'selected' : '' ;
																if ($selected != '') {
																	$andon_proses = false;
																}
																?>
																<option value="<?=$d_proses_breakdown['proses_breakdown']?>" <?=$selected?>><?=$d_proses_breakdown['proses_breakdown']?></option>
															<?php
															}

															if ($andon_proses) { ?>
																<option value="<?=$d_detail_breakdown['proses_breakdown']?>" selected><?=$d_detail_breakdown['proses_breakdown']?></option>
															<?php 
															}
															?>
														</select>
													</td>
													<td>
														<textarea class="form-control" name="uraian_breakdown[]" id="uraian_breakdown_<?=$index_breakdown?>" cols="20" rows="1" style="width: 200px;"><?=$d_detail_breakdown['uraian_breakdown']?></textarea>
													</td>
													<td>
														<input type="text" class="form-control" name="menit_breakdown[]" id="menit_breakdown_<?=$index_breakdown?>" value="<?=$d_detail_breakdown['menit_breakdown']?>" style="width: 100px" required>
													</td>
													<td>
														<a type="button" class="btn btn-danger" href="<?=base_url()?>wet_loading_new/delete_line_stop/<?=$d_detail_breakdown['id_breakdown_wet_loading']?>/<?=$id_lhp?>" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash"></i></a>
													</td>
												</tr>

											<?php
												$index_breakdown++;
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="6"></th>
												<td><h3>Total</h3></td>
                        						<td style="text-align: right;"><input type="text" class="form-control" name="total_menit_breakdown_aktual" id="total_menit_breakdown_aktual" value="<?=$total_menit_breakdown[0]['total_menit']?>" style="width: 100px" readonly></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="box-footer" style="text-align: center;">
							</div>
						</div>				
					</div>
				</div>

				<!-- Detail Reject -->
				<div class="row" id="reject_section">
					<div class="col-xl-12 col-12">
						<div class="box">
							<div class="box-header with-border">
								<h4>Detail Reject</h4>
							</div>
							<div class="box-body">
								<div class="table-responsive">
									<table id="" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>No WO</th>
												<th>Type Battery</th>
												<th>Reject Jenis</th>
												<th>Reject Kategori</th>
												<th>Reject QTY</th>
												<th>Analisa Problem</th>
												<th>Reject Action</th>
											</tr>
										</thead>
										<tbody id="tbody_reject">
											<?php
												$index_reject = 0;
												foreach ($data_detail_reject as $d_detail_reject) { ?>
												<tr>
													<td>
														<input type="text" class="form-control" name="no_wo_reject[]" id="no_wo_reject_<?=$index_reject?>" value="<?=$d_detail_reject['no_wo']?>" style="width: 250px" readonly>
													</td>
													<td>
														<input type="text" class="form-control" name="type_battery_reject[]" id="type_battery_reject_<?=$index_reject?>" value="<?=$d_detail_reject['type_battery']?>" style="width: 250px" readonly>
														<input type="hidden" name="id_reject[]" id="id_reject_<?=$index_reject?>" value="<?=$d_detail_reject['id_reject_wet_loading']?>">
													</td>
													<td>
														<select class="form-control select2" name="jenis_reject[]" id="jenis_reject_<?=$index_reject?>" onchange="get_kategori_reject(<?=$index_reject?>)" style="width: 200px" required>
															<option value="">Pilih Jenis Reject</option>
															<?php 
																foreach ($data_reject as $d_jenis_reject) { ?>
																	<option value="<?=$d_jenis_reject['jenis_reject']?>" <?php if($d_jenis_reject['jenis_reject'] == $d_detail_reject['jenis_reject']){echo "selected";} ?>><?=$d_jenis_reject['jenis_reject']?></option>
															<?php 
															}
															?>
														</select>
													</td>
													<td>
														<select class="form-control select2" id="kategori_reject_<?=$index_reject?>" name="kategori_reject[]" style="width: 250px;" required>
															<option selected disabled>-- Pilih Kategori Reject --</option>
															<?php
															$data_kategori_reject = $model->getKategoriReject($d_detail_reject['jenis_reject']);
															foreach ($data_kategori_reject as $d_kategori_reject) { ?>
																<option value="<?=$d_kategori_reject['kategori_reject']?>" <?php if($d_kategori_reject['kategori_reject'] == $d_detail_reject['kategori_reject']){echo "selected";} ?>><?=$d_kategori_reject['kategori_reject']?></option>
															<?php
																}
															?>
														</select>
													</td>
													<td>
														<input type="text" class="form-control" name="qty_reject[]" id="qty_reject_<?=$index_reject?>" value="<?=$d_detail_reject['qty_reject']?>" style="width: 100px" <?=$readonly?> required>
													</td>
													<td>
														<textarea class="form-control" name="remark_reject[]" id="remark_reject_<?=$index_reject?>" cols="20" rows="1" style="width: 200px;"><?=$d_detail_reject['remark_reject']?></textarea>
													</td>
													<td>
														<a type="button" class="btn btn-danger" href="<?=base_url()?>wet_loading_new/delete_reject/<?=$d_detail_reject['id_reject_wet_loading']?>/<?=$id_lhp?>" onclick="return confirm('Apakah anda yakin?')" <?=(!empty($disabled)) ? 'style="pointer-events: none;"' : ''?>><i class="fa fa-trash"></i></a>	
													</td>
												</tr>
												<?php
													$index_reject++;
												}
												?>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="3"></th>
												<td><h3>Total</h3></td>
                        						<td style="text-align: right;"><input type="text" class="form-control" name="total_reject" id="total_reject" value="<?=$data_lhp[0]['total_reject']?>" style="width: 100px" readonly></td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="box-footer" style="text-align: center;">
								<!-- <input type="submit" class="btn btn-success" value="Save"> -->
							</div>
						</div>				
					</div>
				</div>

				<div class="row">
					<div class="col-4"></div>
					<div class="col-4" style="text-align:center;"><input type="submit" class="btn btn-success" id="submit-btn" value="Save"></div>
					<div class="col-4"></div>
				</div>
			</form>
		</section>
		<!-- /.content -->
	  </div>
	</div>
	<!-- /.content-wrapper -->

<!-- Modal Data Andon-->
<div class="modal fade" id="modal_data_andon" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg" style="max-width: 1500px;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Data Andon</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="data_andon" class="table table-bordered table-striped" style="width:100%">
						<thead>
							<tr>
								<th>ID Ticket</th>
								<th>Permasalahan</th>
								<th>Shift</th>
								<th>Line</th>
								<th>Pelapor</th>
								<th>Waktu</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="tbody_andon">

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger text-start" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- MODAL LOADING-->
<div class="modal" id="loading-modal" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content" style="background-color:rgba(0, 0, 0, 0.01);">
			<div class="modal-body text-center">
				<div class="spinner-border text-light" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
				<h5 class="mt-2 text-light">Loading...</h5>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
	var total_row;
	$(document).ready(function() {
		var tbody = document.getElementById('tbody');
		total_row = tbody.rows.length - 1;

		$('#data_andon').DataTable();

		hitung_mh();

		$('input[type="number"]').each(function() {
			if ($(this).val() == 0) {
			$(this).val('');
			}
		});

		$(window).keydown(function(event){
			if(event.keyCode == 13) {
			event.preventDefault();
			return false;
			}
		});

		$('#input_barcode').focus();
	});


  	function getPartNo() {
		var barcode = $('#input_barcode').val();
		$('#loading-modal').modal('show');
		$.ajax({
			url: '<?=base_url()?>wet_loading_new/get_part_number',
			type: 'POST',
			data: {barcode: barcode},
			dataType: 'json',
			success: function(data) {
				if (data.length > 0 ) {
					// console.log(data);
					var part_number_assy = data[0].ITEM;
					$('#input_wo').val(data[0].NO_WO);
					$('#input_part').val(data[0].ITEM);
					$('#input_actual').val(data[0].QTY);

					$.ajax({
						url: '<?=base_url()?>wet_loading_new/get_part_number_charging',
						type: 'POST',
						data: {
							part_number: data[0].ITEM,
						},
						dataType: 'json',
						success: function(data) {
							console.log(data);
							if (data.length > 0) {
								$.ajax({
									url: '<?=base_url()?>wet_loading_new/get_wo_charging',
									type: 'POST',
									data: {
										part_number: data[0].part_number,
									},
									dataType: 'json',
									success: function(data) {
										if (data.length > 0) {
											// console.log(data);

											$.ajax({
												url: '<?=base_url()?>wet_loading_new/get_ct_part_number',
												type: 'POST',
												data: {
													part_number: data[0].part_number, 
													line: $('#line').val()
												},
												dataType: 'json',
												success: function(data_ct) {
													console.log(data_ct);
													$('#input_ct').val(data_ct[0].cycle_time);

													$.ajax({
														url: '<?=base_url()?>wet_loading_new/get_durasi_charging',
														type: 'POST',
														data: {
															part_number: part_number_assy, 
															line: $('#line option:selected').text()
														},
														dataType: 'json',
														success: function(data_durasi) {
															if (data_durasi.length > 0) {
																console.log(data_durasi);
																$('#input_durasi').val(data_durasi[0].duration);

																add_item(data[0].no_wo, data[0].part_number, data[0].qty);
																$('#loading-modal').modal('hide');
															} else {
																$('#loading-modal').modal('hide');
																$('#input_barcode').val('');
																$('#input_barcode').focus();
																alert('Durasi Charging tidak ditemukan, silahkan hubungi IT');
															}
														}
													});
												}
											});
										} else {
											$('#loading-modal').modal('hide');
											$('#input_barcode').val('');
											$('#input_barcode').focus();
											alert('WO tidak ditemukan');
										}
									}
								});
							} else {
								$('#loading-modal').modal('hide');
								$('#input_barcode').val('');
								$('#input_barcode').focus();
								alert('Part Number Charging tidak ditemukan');
							}							
						}
					});
				} else {
					$('#loading-modal').modal('hide');
					$('#input_barcode').val('');
					$('#input_barcode').focus();
					alert('Data label tidak ditemukan');
				}
			}
		});
	}

	function presentase_actual(i) {
		var plan_cap = $('#plan_cap_'+i).val();
		var actual = $('#actual_'+i).val();
		var presentase = (actual / plan_cap) * 100;

		var ct = $('#ct_'+i).val();
		var total_minute = (actual * ct) / 60;
		var efficiency_time = total_minute.toFixed(0);
		$('#efficiency_time_'+i).val(efficiency_time);

		
		var total_menit_breakdown = $('#menit_terpakai_'+i).val() - efficiency_time;
		$('#total_menit_breakdown_'+i).val(total_menit_breakdown);
	}

	function add_breakdown(i) {
		var data_breakdown = <?= json_encode($data_breakdown); ?>;

		var start_breakdown = $('#start_'+i).val();
		var stop_breakdown = $('#stop_'+i).val();

		var no_wo_breakdown = $('#no_wo_'+i).val();
		var type_battery_breakdown = $('#type_battery_'+i).val();

		var menit_breakdown = $('#total_menit_breakdown_'+i).val();

		var tbody = document.getElementById('tbody_line_stop');

		var j = tbody.rows.length;


		$('#tbody_line_stop').append(`
			<tr>
				<td>
					<input type="time" class="form-control" name="start_breakdown[]" id="start_breakdown_${j}" value="${start_breakdown}" style="width: 100px;">
				</td>
				<td>
					<input type="time" class="form-control" name="stop_breakdown[]" id="stop_breakdown_${j}" value="${stop_breakdown}" style="width: 100px;">
				</td>
				<td>
					<input type="text" class="form-control" name="no_wo_breakdown[]" id="no_wo_breakdown_${j}" value="${no_wo_breakdown}" style="width: 125px" readonly>
				</td>
        		<td>
					<input type="text" class="form-control" name="type_battery_breakdown[]" id="type_battery_breakdown_${j}" value="${type_battery_breakdown}" style="width: 125px" readonly>
					<input type="hidden" class="form-control" name="id_breakdown[]" id="id_breakdown_${j}" value="" style="width: 100px">
				</td>
				<td>
					<select class="form-control select2" name="jenis_breakdown[]" id="jenis_breakdown_${j}" onchange="get_proses_breakdown(${j})" style="width: 200px" required>
						<option value="">Pilih Jenis Line Stop</option>
						${data_breakdown.map((item) => {
							return `<option value="${item.jenis_breakdown}">${item.jenis_breakdown}</option>`;
						}).join('')}
					</select>
				</td>
				<td>
					<select class="form-control select2" id="proses_breakdown_${j}" name="proses_breakdown[]" style="width: 200px;" required>
						<option selected disabled>-- Pilih Proses Line Stop --</option>
					</select>
				</td>
				<td>
					<textarea class="form-control" name="uraian_breakdown[]" id="uraian_breakdown_${j}" cols="20" rows="1" style="width: 200px;"></textarea>
				</td>
				<td>
					<input type="text" class="form-control" name="menit_breakdown[]" id="menit_breakdown_${j}" value="" style="width: 100px" required>
				</td>
				<td>
					<button type="button" class="btn btn-danger" onclick="delete_breakdown(${j})"><i class="fa fa-trash"></i></button>	
				</td>
			</tr>
		`);

		$('.select2').select2();

		$('html, body').animate({
			scrollTop: $('#ls_section').offset().top
		}, 500);
	
	}

	function add_reject(i) {
		var data_reject = <?= json_encode($data_reject); ?>;

		var no_wo_reject = $('#no_wo_'+i).val();
		var type_battery_reject = $('#type_battery_'+i).val();

		var tbody = document.getElementById('tbody_reject');

		var j = tbody.rows.length;

		$('#tbody_reject').append(`
			<tr>
				<td>
					<input type="text" class="form-control" name="no_wo_reject[]" id="no_wo_reject_${j}" value="${no_wo_reject}" style="width: 150px" readonly>
				</td>
				<td>
					<input type="text" class="form-control" name="type_battery_reject[]" id="type_battery_reject_${j}" value="${type_battery_reject}" style="width: 250px" readonly>
					<input type="hidden" class="form-control" name="id_reject[]" id="id_reject_${j}" value="" style="width: 100px">
				</td>
				<td>
					<select class="form-control select2" id="jenis_reject_${j}" name="jenis_reject[]" onchange="get_kategori_reject(${j})" style="width: 200px;" required>
						<option selected disabled>-- Pilih Jenis Reject --</option>
						${data_reject.map((item) => {
							return `<option value="${item.jenis_reject}">${item.jenis_reject}</option>`;
						}).join('')}
					</select>
				</td>
				<td>
					<select class="form-control select2" id="kategori_reject_${j}" name="kategori_reject[]" style="width: 250px;" required>
						<option selected disabled>-- Pilih Kategori Reject --</option>
					</select>
				</td>
				<td>
					<input type="number" class="form-control" name="qty_reject[]" id="qty_reject_${j}" style="width: 100px" required>
				</td>
				<td>
					<textarea class="form-control" name="remark_reject[]" id="remark_reject_${j}" cols="20" rows="1" style="width: 250px;"></textarea>
				</td>
				<td>
					<button type="button" class="btn btn-danger" onclick="delete_reject(${j})"><i class="fa fa-trash"></i></button>
				</td>
			</tr>
		`);
		$('.select2').select2();

		$('html, body').animate({
			scrollTop: $('#reject_section').offset().top
		}, 500);
	}

	function get_proses_breakdown(i) {
		var jenis_breakdown = $('#jenis_breakdown_'+i).val();

		if (jenis_breakdown == 'ANDON') {
			get_data_andon(i);
		} else {
			$.ajax({
				url: '<?=base_url()?>lhp/get_proses_breakdown',
				type: 'POST',
				data: {jenis_breakdown: jenis_breakdown},
				dataType: 'json',
				success: function(data) {
					$('#proses_breakdown_'+i).html(`
						<option selected disabled>-- Pilih Proses Line Stop --</option>
						${data.map((item) => `<option value="${item.proses_breakdown}">${item.proses_breakdown}</option>`)}
					`);
					$('#uraian_breakdown_'+i).val('');
					// $('#menit_breakdown_'+i).val('');
				}
			});
		}
	}

	function get_kategori_reject(i) {
		var jenis_reject = $('#jenis_reject_'+i).val();

		$.ajax({
			url: '<?=base_url()?>lhp/get_kategori_reject',
			type: 'POST',
			data: {jenis_reject: jenis_reject},
			dataType: 'json',
			success: function(data) {
				$('#kategori_reject_'+i).html(`
					<option selected disabled>-- Pilih Kategori Reject --</option>
					${data.map((item) => `<option value="${item.kategori_reject}">${item.kategori_reject}</option>`)}
				`);
				$('#remark_reject_'+i).val('');
			}
		});
	}

	function get_data_andon(j) {
		var tanggal_produksi = $('#tanggal_produksi').val();
		var line = <?=$data_lhp[0]['line']?>;

		if (line == 8) {
			line = 11;
		} else if (line == 9) {
			line = 12;
		}

		var shift = $('#shift').val();

		$.ajax({
			url: '<?=base_url()?>lhp/get_data_andon',
			type: 'POST',
			data: {tanggal_produksi: tanggal_produksi, line: line, shift: shift},
			dataType: 'json',
			success: function(data) {
				$('#tbody_andon').html('');
				data.forEach((item, i) => {
					$('#tbody_andon').append(`
						<tr>
							<td>${item.id_ticket}</td>
							<td>${item.permasalahan}</td>
							<td>${item.shift}</td>
							<td>${item.id_line == 11 ? 'WET A' : 'WET F'}</td>
							<td>${item.pelapor}</td>
							<td>${item.created_at}</td>
							<td><button class="btn btn-primary btn-sm" onclick="pilih_andon(${item.id_ticket}, ${j})">Pilih</button></td>
						</tr>
					`);
				});
			}
		})
		$('#modal_data_andon').modal('show');
	}

	function pilih_andon(id_ticket, i) {
		$.ajax({
			url: '<?=base_url()?>lhp/pilih_andon',
			type: 'POST',
			data: {id_ticket: id_ticket},
			dataType: 'json',
			success: function(data) {
				$('#proses_breakdown_'+i).html(`
					${data.map((item) => `<option value="${item.id_ticket}-${item.tujuan}-${item.nama_mesin}" selected>${item.id_ticket}-${item.tujuan}-${item.nama_mesin}</option>`)}
				`);

				$('#uraian_breakdown_'+i).val(data[0].permasalahan);
				$('#menit_breakdown_'+i).val(data[0].total_min_reduce);

			}
		});
		$('#modal_data_andon').modal('hide');
	}

	function delete_rows(i) {
		var tbody = document.getElementById('tbody');
		tbody.deleteRow(i);
	}

	function delete_breakdown(i) {
		var tbody = document.getElementById('tbody_line_stop');
		tbody.deleteRow(i);
	}

	function delete_reject(i) {
		var tbody = document.getElementById('tbody_reject');
		tbody.deleteRow(i);
	}

	function update_plan(i) {
		var menit_terpakai = $('#menit_terpakai_'+i).val() * 60;
		var ct = $('#ct_'+i).val();
		var plan_cap = Math.floor(menit_terpakai / ct);
		$('#plan_cap_'+i).val(plan_cap);

		presentase_actual(i);
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

	// function time_stop(i) {
	// 	var date = new Date();
	// 	var currentTime = date.toLocaleString().substring(11,16);
	// 	$('#stop_section_'+i).html(`
	// 		<input type="time" class="form-control" name="stop_${i}" id="stop_${i}" value="${currentTime}" style="width: 100px;">
	// 	`);
	// }

	function add_pending(i) {
		var data_pending = <?= json_encode($data_pending); ?>;

		var no_wo = $('#no_wo_'+i).val();
		var type_battery_pending = $('#type_battery_'+i).val();

		var tbody = document.getElementById('tbody_pending');

		var j = tbody.rows.length;

		$('#tbody_pending').append(`
			<tr>
				<td>
					<input type="text" class="form-control" name="no_wo_pending[]" id="no_wo_pending_${j}" value="${no_wo}" style="width: 125px" readonly>
				</td>
				<td>
					<input type="text" class="form-control" name="type_battery_pending[]" id="type_battery_pending_${j}" value="${type_battery_pending}" style="width: 125px" readonly>
					<input type="hidden" class="form-control" name="id_pending[]" id="id_pending_${j}" value="" style="width: 100px">
				</td>
				<td>
					<select class="form-control select2" name="jenis_pending[]" id="jenis_pending_${j}" onchange="get_kategori_pending(${j})" style="width: 200px" required>
						<option value="">Pilih Jenis Pending</option>
						${data_pending.map((item) => {
							return `<option value="${item.jenis_pending}">${item.jenis_pending}</option>`;
						}).join('')}
					</select>
				</td>
				<td>
					<select class="form-control select2" id="kategori_pending_${j}" name="kategori_pending[]" style="width: 250px;" required>
						<option selected disabled>-- Pilih Kategori Pending --</option>
					</select>
				</td>
				<td>
					<input type="text" class="form-control" name="qty_pending[]" id="qty_pending_${j}" style="width: 100px" required>
				</td>
				<td>
					<button type="button" class="btn btn-danger" onclick="delete_pending(${j})"><i class="fa fa-trash"></i></button>	
				</td>
			</tr>
		`);

		$('.select2').select2();

		$('html, body').animate({
			scrollTop: $('#pending_section').offset().top
		}, 500);
	
	}

	function get_kategori_pending(i) {
		var jenis_pending = $('#jenis_pending_'+i).val();

		$.ajax({
			url: '<?=base_url()?>wet_finishing/get_kategori_pending',
			type: 'POST',
			data: {jenis_pending: jenis_pending},
			dataType: 'json',
			success: function(data) {
				$('#kategori_pending_'+i).html(`
					<option selected disabled>-- Pilih Kategori Pending --</option>
					${data.map((item) => `<option value="${item.kategori_pending}">${item.kategori_pending}</option>`)}
				`);
			}
		});
	}

	function delete_pending(i) {
		var tbody = document.getElementById('tbody_pending');
		tbody.deleteRow(i);
	}

	// function add_item() {
	// 	let no_wo = $('#input_wo').val();
	// 	let part_number = $('#input_part').val();
	// 	let ct = $('#input_ct').val();
	// 	let qty = $('#input_actual').val();

	// 	let baris = document.querySelectorAll('.item').length;

	// 	const d = new Date();
	// 	let time = d.getHours() + ':' + (d.getMinutes()<10?'0':'') + d.getMinutes();

	// 	let time_stop = '';

	// 	let plan_cap = 0;
	// 	let total_menit_breakdown = 0;

	// 	var found = false;
	// 	var i = 0;
	// 	$('#data_item tbody tr').each(function() {
	// 		$(this).find('td').each(function() {
	// 		var cellText = $('#no_wo_'+i).val();
	// 		console.log(cellText);
	// 		if (cellText.includes(no_wo)) {
	// 			found = true;
	// 			return false; // Break out of inner loop
	// 		}
	// 		});

	// 		if (found) {
	// 			alert('Label Sudah Di Input !!!');
				
	// 			return false; // Break out of outer loop
	// 		}
	// 		i++;
	// 	});

	// 	if (!found) {
	// 		if (baris != 0) {
	// 			baris_temp = baris - 1;
	// 			$('#stop_section_'+baris_temp).html(`
	// 				<input type="time" class="form-control" name="stop_${baris_temp}" id="stop_${baris_temp}" value="${time}" readonly>
	// 			`)

	// 			const minutesDifference = getTimeDifferenceInMinutes($('#start_'+baris_temp).val(), $('#stop_'+baris_temp).val());
	// 			$('#menit_terpakai_section_'+baris_temp).html(`
	// 				<input type="text" class="form-control" name="menit_terpakai[]" id="menit_terpakai_${baris_temp}" class="form-control" value="${minutesDifference}" readonly>
	// 			`);

	// 			plan_cap = Math.ceil((parseInt(minutesDifference) * 60) / parseFloat(ct));
	// 			$('#plan_cap_section_'+baris_temp).html(`
	// 				<input type="text" class="form-control" name="plan_cap[]" id="plan_cap_${baris_temp}" class="form-control" value="${plan_cap}" readonly>
	// 			`);

	// 			total_menit_breakdown = parseInt(minutesDifference) - Math.ceil((parseInt(qty) * parseFloat(minutesDifference)) / 60);
	// 			$('#total_menit_breakdown_section_'+baris_temp).html(`
	// 				<input type="text" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_${baris_temp}" class="form-control" value="${total_menit_breakdown}" readonly>
	// 			`);
	// 		}

	// 		$('#tbody_data_item').append(`
	// 			<tr class="item">
	// 				<td>
	// 					<input type="time" class="form-control" name="start[]" id="start_${baris}" class="form-control" value="${time}" readonly>
	// 				</td>
	// 				<td>
	// 					<div id="stop_section_${baris}">
	// 						<button class="btn btn-danger" onclick="time_stop(${baris})">Stop</button>
	// 					</div>
	// 				</td>
	// 				<td>
	// 					<div id="menit_terpakai_section_${baris}">
	// 						<input type="text" class="form-control" name="menit_terpakai[]" id="menit_terpakai_${baris}" class="form-control" value="" readonly>
	// 					</div>
	// 				</td>
	// 				<td>
	// 					<input type="text" class="form-control" name="no_wo[]" id="no_wo_${baris}" class="form-control" value="${no_wo}" style="width:200px;" readonly>
	// 				</td>
	// 				<td>
	// 					<input type="text" class="form-control" name="type_battery[]" id="type_battery_${baris}" class="form-control" value="${part_number}" style="width:250px;" readonly>
	// 				</td>
	// 				<td>
	// 					<input type="text" class="form-control" name="ct[]" id="ct_${baris}" class="form-control" value="${ct}" readonly>
	// 				</td>
	// 				<td>
	// 					<div id="plan_cap_section_${baris}">
	// 						<input type="text" class="form-control" name="plan_cap[]" id="plan_cap_${baris}" class="form-control" value="" readonly>
	// 					</div>
	// 				</td>
	// 				<td>
	// 					<input type="text" class="form-control" name="actual[]" id="actual_${baris}" class="form-control" value="${qty}">
	// 				</td>
	// 				<td>
	// 					<div id="total_menit_breakdown_section_${baris}">
	// 						<input type="text" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_${baris}" class="form-control" value="" readonly>
	// 					</div>
	// 				</td>
	// 				<td>
	// 					<button type="button"class="btn btn-sm btn-primary" id="add_pending_${baris}" onclick="add_pending(${baris})">Add</button>
	// 				</td>
	// 				<td>
	// 					<button type="button"class="btn btn-sm btn-primary" id="add_breakdown_${baris}" onclick="add_breakdown(${baris})">Add</button>
	// 				</td>
	// 				<td>
	// 					<button type="button"class="btn btn-sm btn-primary" id="add_reject_${baris}" onclick="add_reject(${baris})">Add</button>
	// 				</td>
	// 			</tr>
	// 		`);

	// 		$('#input_barcode').val('');
	// 		$('#input_wo').val('');
	// 		$('#input_part').val('');
	// 		$('#input_ct').val('');
	// 		$('#input_actual').val('');
	// 	}
	// }

	// function add_item(index) {
	// 	let no_wo = $('#wo_'+index).val();
	// 	let type_battery = $('#part_number_'+index).val();
	// 	let ct = $('#input_ct').val();
	// 	let durasi = $('#input_durasi').val();
	// 	let qty = $('#qty_'+index).val();

	// 	// Get the current datetime
	// 	var now = new Date();

	// 	// Define the number of hours to add (in this case, stored in a variable)
	// 	var hoursToAdd = parseFloat(durasi) + 1;

	// 	// Calculate the number of minutes to add based on the decimal hours
	// 	var minutesToAdd = Math.floor((hoursToAdd % 1) * 60);

	// 	// Add the whole hours to the current datetime
	// 	now.setHours(now.getHours() + Math.floor(hoursToAdd));

	// 	// Add the remaining minutes to the current datetime
	// 	now.setMinutes(now.getMinutes() + minutesToAdd);

	// 	// Format the datetime as "d-m-Y H:i:s"
	// 	var formattedDatetime =
	// 	('0' + now.getDate()).slice(-2) +
	// 	'-' +
	// 	('0' + (now.getMonth() + 1)).slice(-2) +
	// 	'-' +
	// 	now.getFullYear() +
	// 	' ' +
	// 	('0' + now.getHours()).slice(-2) +
	// 	':' +
	// 	('0' + now.getMinutes()).slice(-2);

	// 	// Output the formatted datetime
	// 	console.log(formattedDatetime);

	// 	let baris = document.querySelectorAll('.item').length;

	// 	$('#tbody_data_item').append(`
	// 		<tr class="item">
	// 			<td>
					
	// 			</td>
	// 			<td>
					
	// 			</td>
	// 			<td>
					
	// 			</td>
	// 			<td>
	// 				<input type="text" class="form-control" name="no_wo[]" id="no_wo_${baris}" class="form-control" value="${no_wo}" style="width:150px;" readonly>
	// 				<input type="hidden" name="batch[]" id="batch_${baris}" value="">
	// 				<input type="hidden" name="id_detail_lhp[]" id="id_detail_lhp_${baris}" value="">
	// 			</td>
	// 			<td>
	// 				<input type="text" class="form-control" name="type_battery[]" id="type_battery_${baris}" class="form-control" value="${type_battery}" style="width:225px;" readonly>
	// 			</td>
	// 			<td>
	// 				<input type="text" class="form-control" name="ct[]" id="ct_${baris}" class="form-control" value="${ct}" style="width:70px;"  readonly>
	// 			</td>
	// 			<td>
					
	// 			</td>
	// 			<td>
	// 				<input type="text" class="form-control" name="actual[]" id="actual_${baris}" class="form-control" style="width:70px;" value="${qty}">
	// 			</td>
	// 			<td>
	// 				<input type="text" class="form-control" name="estimasi_finish[]" id="estimasi_finish_${baris}" class="form-control" value="${formattedDatetime}">
	// 			</td>
	// 			<td>
					
	// 			</td>
	// 			<td>
	// 				<button type="button"class="btn btn-sm btn-primary" id="add_pending_${baris}" onclick="add_pending(${baris})">Add</button>
	// 			</td>
	// 			<td>
	// 				<button type="button"class="btn btn-sm btn-primary" id="add_breakdown_${baris}" onclick="add_breakdown(${baris})">Add</button>
	// 			</td>
	// 			<td>
	// 				<button type="button"class="btn btn-sm btn-primary" id="add_reject_${baris}" onclick="add_reject(${baris})">Add</button>
	// 			</td>
	// 		</tr>
	// 	`);

	// 	// var tbody = document.getElementById('table_list_wo');
	// 	// tbody.deleteRow(index+1);

	// 	// $('#input_barcode').val('');
	// 	// $('#input_wo').val('');
	// 	// $('#input_part').val('');
	// 	// $('#input_ct').val('');
	// 	// $('#input_actual').val('');
	// }

	function add_item(no_wo, type_battery, qty) {
		const id_lhp = window.location.href.split('/').pop();
		const line = $('#line').val();

		$.ajax({
			url: '<?=base_url()?>wet_loading_new/update_status_list_loading_wo',
			type: 'POST',
			data: {
				no_wo: no_wo
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
			}
		});

		let ct = $('#input_ct').val();
		let durasi = $('#input_durasi').val();

		// Get the current datetime
		var now = new Date();

		// Define the number of hours to add (in this case, stored in a variable)
		var hoursToAdd = parseFloat(durasi) + 1;

		// Calculate the number of minutes to add based on the decimal hours
		var minutesToAdd = Math.floor((hoursToAdd % 1) * 60);

		// Add the whole hours to the current datetime
		now.setHours(now.getHours() + Math.floor(hoursToAdd));

		// Add the remaining minutes to the current datetime
		now.setMinutes(now.getMinutes() + minutesToAdd);

		// Format the datetime as "d-m-Y H:i:s"
		var formattedDatetime =
		('0' + now.getDate()).slice(-2) +
		'-' +
		('0' + (now.getMonth() + 1)).slice(-2) +
		'-' +
		now.getFullYear() +
		' ' +
		('0' + now.getHours()).slice(-2) +
		':' +
		('0' + now.getMinutes()).slice(-2);

		// Output the formatted datetime
		console.log(formattedDatetime);

		let baris = document.querySelectorAll('.item').length;

		const d = new Date();
		let time = (d.getHours()<10?'0':'') + d.getHours() + ':' + (d.getMinutes()<10?'0':'') + d.getMinutes();

		let time_stop = '';

		let plan_cap = 0;
		let total_menit_breakdown = 0;

		var found = false;
		var i = 0;
		$('#data_item tbody tr').each(function() {
			$(this).find('td').each(function() {
			var cellText = $('#no_wo_'+i).val();
			console.log(cellText);
			if (cellText.includes(no_wo)) {
				found = true;
				return false; // Break out of inner loop
			}
			});

			if (found) {
				alert('Label Sudah Di Input !!!');
				
				return false; // Break out of outer loop
			}
			i++;
		});

		if (baris != 0) {
			baris_temp = baris - 1;
			$('#stop_section_'+baris_temp).html(`
				<input type="time" class="form-control" name="stop[]" id="stop_${baris_temp}" value="${time}" readonly>
			`)

			const minutesDifference = getTimeDifferenceInMinutes($('#start_'+baris_temp).val(), $('#stop_'+baris_temp).val());
			$('#menit_terpakai_section_'+baris_temp).html(`
				<input type="text" class="form-control" name="menit_terpakai[]" id="menit_terpakai_${baris_temp}" class="form-control" value="${minutesDifference}">
			`);

			plan_cap = Math.ceil((parseInt(minutesDifference) * 60) / parseFloat(ct));
			$('#plan_cap_section_'+baris_temp).html(`
				<input type="text" class="form-control" name="plan_cap[]" id="plan_cap_${baris_temp}" class="form-control" value="${plan_cap}" readonly>
			`);

			total_menit_breakdown = parseInt(minutesDifference) - Math.ceil((parseInt(qty) * parseFloat(minutesDifference)) / 60);
			$('#total_menit_breakdown_section_'+baris_temp).html(`
				<input type="text" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_${baris_temp}" class="form-control" value="${total_menit_breakdown}" readonly>
			`);
		}

		$('#tbody_data_item').append(`
			<tr class="item">
				<td>
					<input type="time" class="form-control" name="start[]" id="start_${baris}" class="form-control" value="${time}" readonly>
				</td>
				<td>
					<div id="stop_section_${baris}">
						<button class="btn btn-danger" onclick="time_stop(${baris})">Stop</button>
					</div>
				</td>
				<td>
					<div id="menit_terpakai_section_${baris}">
						<input type="text" class="form-control" name="menit_terpakai[]" id="menit_terpakai_${baris}" class="form-control" value="">
					</div>
				</td>
				<td>
					<input type="text" class="form-control" name="no_wo[]" id="no_wo_${baris}" class="form-control" value="${no_wo}" style="width:150px;" readonly>
					<input type="hidden" name="batch[]" id="batch_${baris}" value="">
					<input type="hidden" name="id_detail_lhp[]" id="id_detail_lhp_${baris}" value="">
					<input type="hidden" class="form-control" name="estimasi_finish[]" id="estimasi_finish_${baris}" class="form-control" value="${formattedDatetime}">
				</td>
				<td>
					<input type="text" class="form-control" name="type_battery[]" id="type_battery_${baris}" class="form-control" value="${type_battery}" style="width:225px;" readonly>
				</td>
				<td>
					<input type="text" class="form-control" name="ct[]" id="ct_${baris}" class="form-control" value="${ct}" style="width:70px;"  readonly>
				</td>
				<td>
					<div id="plan_cap_section_${baris}">
						<input type="text" class="form-control" name="plan_cap[]" id="plan_cap_${baris}" class="form-control" value="" readonly>
					</div>
				</td>
				<td>
					<input type="text" class="form-control" name="actual[]" id="actual_${baris}" class="form-control" style="width:70px;" value="${qty}">
				</td>
				<td>
					<div id="total_menit_breakdown_section_${baris}">
						<input type="text" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_${baris}" class="form-control" value="" readonly>
					</div>
				</td>
				<td>
					<button type="button"class="btn btn-sm btn-primary" id="add_pending_${baris}" onclick="add_pending(${baris})">Add</button>
				</td>
				<td>
					<button type="button"class="btn btn-sm btn-primary" id="add_breakdown_${baris}" onclick="add_breakdown(${baris})">Add</button>
				</td>
				<td>
					<button type="button"class="btn btn-sm btn-primary" id="add_reject_${baris}" onclick="add_reject(${baris})">Add</button>
				</td>
			</tr>
		`);

		$.ajax({
			url: '<?=base_url()?>supply_charging/add_data_supply_charging',
			type: 'POST',
			data: {
				id_lhp: id_lhp,
				no_wo: no_wo,
				part_number: type_battery,
				estimasi_finish: formattedDatetime,
				tujuan: line,
				qty: qty
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
				$('#submit-btn').click();
			}
		});

		// var tbody = document.getElementById('table_list_wo');
		// tbody.deleteRow(index+1);

		$('#input_barcode').val('');
		$('#input_wo').val('');
		$('#input_part').val('');
		$('#input_ct').val('');
		$('#input_actual').val('');
	}

	function time_stop(i) {
		let d = new Date();
		let time = (d.getHours()<10?'0':'') + d.getHours() + ':' + (d.getMinutes()<10?'0':'') + d.getMinutes();

		$('#stop_section_'+i).html(`
			<input type="time" class="form-control" name="stop[]" id="stop_${i}" value="${time}" readonly>
		`)

		const minutesDifference = getTimeDifferenceInMinutes($('#start_'+i).val(), $('#stop_'+i).val());
		$('#menit_terpakai_section_'+i).html(`
			<input type="text" class="form-control" name="menit_terpakai[]" id="menit_terpakai_${i}" class="form-control" value="${minutesDifference}">
		`);

		let plan_cap = Math.ceil((parseInt(minutesDifference) * 60) / parseFloat($('#ct_'+i).val()));
		$('#plan_cap_section_'+i).html(`
			<input type="text" class="form-control" name="plan_cap[]" id="plan_cap_${i}" class="form-control" value="${plan_cap}" readonly>
		`);

		let total_menit_breakdown = parseInt(minutesDifference) - Math.ceil((parseInt($('#actual_'+i).val()) * parseFloat($('#ct_'+i).val())) / 60);
		$('#total_menit_breakdown_section_'+i).html(`
			<input type="text" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_${i}" class="form-control" value="${total_menit_breakdown}" readonly>
		`);
	}

	// Function to calculate the time difference in minutes
	function getTimeDifferenceInMinutes(startTime, endTime) {
		// Parse the time strings into Date objects
		const start = new Date();
		const end = new Date();
		
		// Set the hours and minutes for the start time
		const [startHours, startMinutes] = startTime.split(':');
		start.setHours(startHours);
		start.setMinutes(startMinutes);

		// Set the hours and minutes for the end time
		const [endHours, endMinutes] = endTime.split(':');
		end.setHours(endHours);
		end.setMinutes(endMinutes);

		// Calculate the time difference in milliseconds
		const timeDiff = end - start;

		// Convert milliseconds to minutes
		const minutesDiff = Math.floor(timeDiff / (1000 * 60));

		return minutesDiff;
	}

</script>
<?= $this->endSection(); ?>