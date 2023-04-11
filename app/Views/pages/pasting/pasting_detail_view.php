<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?php
// var_dump($data_detail_breakdown);die;
$shift
?>
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <form action="<?= base_url() ?>pasting/update_pasting" method="post">
        <input type="hidden" name="id_lhp_pasting" id="id_lhp_pasting" value="<?= $id_lhp_pasting ?>">
        <div class="box">
          <div class="box-header with-border">
            <h4>Detail Laporan Harian Produksi</h4>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Tanggal Produksi</label>
                  <input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi" value="<?= $data_lhp_pasting[0]['tanggal_produksi'] ?>">
                </div>
              </div>
              <div class="col-3">
                <!-- <div class="form-group">
									<label class="form-label">Line</label>
									<input type="hidden" class="form-control" name="mesin_pasting" id="mesin_pasting" value="<?= $data_lhp_pasting[0]['mesin_pasting'] ?>">
									<input type="text" class="form-control" name="nama_mesin_pasting" id="nama_mesin_pasting" value="<?= $data_mesin_pasting[0]['nama_mesin_pasting'] ?>">
								</div> -->
                <div class="form-group">
                  <label class="form-label">Mesin</label>
                  <select class="form-select" id="mesin_pasting" name="mesin_pasting">
                    <option selected disabled>-- Pilih Data --</option>
                    <?php
                    foreach ($data_all_machine as $key => $value) {
                    ?>
                      <option value="<?= $value['id_mesin_pasting'] ?>" <?php if ($value['id_mesin_pasting'] == $data_lhp_pasting[0]['mesin_pasting']) {
                                                                          echo "selected";
                                                                        } ?>>Mesin <?= $value['nama_mesin_pasting'] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Shift</label>
                  <!-- <input type="text" class="form-control" name="shift" id="shift" value="<?= $data_lhp_pasting[0]['shift'] ?>"> -->
                  <select class="form-select" id="shift" name="shift">
                    <option selected disabled>-- Pilih Data --</option>
                    <option value="1" <?php if ($data_lhp_pasting[0]['shift'] == 1) {
                                        echo "selected";
                                      } ?>>Shift 1</option>
                    <option value="2" <?php if ($data_lhp_pasting[0]['shift'] == 2) {
                                        echo "selected";
                                      } ?>>Shift 2</option>
                    <option value="3" <?php if ($data_lhp_pasting[0]['shift'] == 3) {
                                        echo "selected";
                                      } ?>>Shift 3</option>
                  </select>
                </div>
              </div>
              <!-- <div class="col-3">
								<div class="form-group">
									<label class="form-label">Kasubsie</label>
									<input type="text" class="form-control" name="kasubsie" id="kasubsie" value="<?= $data_lhp_pasting[0]['kasubsie'] ?>" readonly>
								</div>
							</div> -->
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Kasubsie</label>
                  <!-- <input type="text" class="form-control" name="kasubsie" id="kasubsie" value="<?= $data_lhp_pasting[0]['kasubsie'] ?>"> -->
                  <select class="form-select" id="kasubsie" name="kasubsie">
                    <option selected disabled>-- Pilih Data --</option>
                      <option value="<?= "Yanto A"?>" <?php if ($data_lhp_pasting[0]['kasubsie'] == "Yanto A") {
                                                          echo "selected";
                                                        } ?>><?= "Yanto A"?></option>
                      <option value="<?= "Ade Suryana"?>" <?php if ($data_lhp_pasting[0]['kasubsie'] == "Ade Suryana") {
                                                          echo "selected";
                                                        } ?>><?= "Ade Suryana"?></option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Grup</label>
                  <!-- <input type="hidden" class="form-control" id="grup" name="grup" value="<?= $data_lhp_pasting[0]['grup'] ?>">
									<input type="text" class="form-control" name="nama_pic" id="nama_pic" value="<?= ""//$data_grup[0]['nama_pic'] ?>"> -->

                  <select class="form-select" id="grup" name="grup">
                    <option selected disabled>-- Pilih Data --</option>
                    <?php foreach($data_grup_pasting as $grup) : ?>
                      <option value="<?= $grup['nama_grup']?>" <?php if ($data_lhp_pasting[0]['grup'] === $grup['nama_grup']) {
                                                          echo "selected";
                                                        } ?>><?= $grup['nama_grup']?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">MP</label>
                  <input type="number" class="form-control" id="mp" name="mp" value="<?= $data_lhp_pasting[0]['mp'] ?>">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Absen</label>
                  <input type="number" class="form-control" id="absen" name="absen" value="<?= $data_lhp_pasting[0]['absen'] ?>">
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Cuti</label>
                  <input type="number" class="form-control" id="cuti" name="cuti" value="<?= $data_lhp_pasting[0]['cuti'] ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
					<div class="col-xl-12 col-12">
						<div class="box">
              <div class="box-header">
                <h4>Detail Rak Masuk</h4>
                <br>
                <table class="table">
                  <tr>
                    <td>
                      Barcode  <input type="text" class="form-control" name="start_barcode" id="start_barcode" onchange="get_qty_rak()" class="form-control">
                    </td>
                    <td>
                      Qty <input type="text" class="form-control" name="start_qty" id="start_qty" class="form-control" readonly>
                    </td>
                    <td>
                      QR Code Rak<input type="text" class="form-control" name="start_rak" id="start_rak" class="form-control">
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary" onclick="add_rak_in()">Add</button>
                    </td>
                  </tr>
                </table>
              </div>
							<div class="box-body">
								<div class="table-responsive">
									<table id="data_line_stop" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>Barcode</th>
                        <th>QTY</th>
                        <th>ID Rak</th>
                        <th>Action</th>
											</tr>
										</thead>
										<tbody id="tbody_data_rak">
											<?php $number=0; foreach ($data_all_rak_in as $d_rak) { ?>
                        <tr class="rak_in">
                          <td>
                            <input type="text" class="form-control" name="barcode_rak[]" id="barcode_rak_<?=$number?>" value="<?=$d_rak['barcode']?>" readonly>
                            <input type="hidden" class="form-control" name="id_rak_barcode[]" id="id_rak_barcode_<?=$number?>" value="<?=$d_rak['id']?>" readonly>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="qty_rak[]" id="qty_rak_<?=$number?>" value="<?=$d_rak['qty']?>" readonly>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="id_rak[]" id="id_rak_<?=$number?>" value="<?=$d_rak['id_rak']?>" readonly>
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak_in(this, <?=$number?>)">Delete</button>
                          </td>
                        </tr>
                      <?php
                          $number+=1;
                        }
                      ?>
										</tbody>
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
          <div class="col-xl-12 col-12">
            <div class="box">
              <div class="box-body">
                <div class="table-responsive">
                  <table id="" class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <!-- <th>#</th> -->
                        <!-- <th>Jam</th>
												<th>Menit Tersedia</th>
												<th>Menit Aktual</th> -->
                        <th>Jam Start</th>
                        <th>Jam End</th>
                        <th>Menit Terpakai</th>
                        <!-- <th>No WO</th> -->
                        <!-- <th>Type Battery</th> -->
                        <th>Type</th>
                        <th>CT</th>
                        <!-- <th>Plan Cap</th> -->
                        <th>JKS</th>
                        <th>Actual</th>
                        <!-- <th>Act vs Plan (%)</th>
												<th>Efficiency Time (menit)</th> -->
                        <th>Presentase (%)</th>
                        <th>Line Stop</th>
                        <th>Reject</th>
                      </tr>
                    </thead>
                    <tbody id="tbody">
                      <?php
                      if ($data_lhp_pasting[0]['shift'] == '1') {
                        $jam_start = ['07.30', '08.50', '09.50', '11.00', '12.00 ', '14.00', '15.00', '16.15'];
                        $jam_end = ['08.50', '09.50', '11.00', '12.00', '14.00', '15.00', '16.15', '16.30'];
                        $menit_tersedia = ['80', '60', '70', '60', '120', '60', '75', '15'];
                        $menit_aktual = [70, 60, 60, 60, 60, 60, 60, 10];

                        // $jam_start = ['07.30', '08.00', '09.00', '10.00', '11.00 ', '12.00', '13.00', '14.00', '15.00', '16.00'];
                        // $jam_end = ['08.00', '09.00', '10.00', '11.00 ', '12.00', '13.00', '14.00', '15.00', '16.00', '16.30'];
                        // // $menit_tersedia = ['80', '60', '70', '60', '120', '60', '75', '15'];
                        // $menit_aktual = ['20', '60', '60', '50', '60', '0', '60', '60', '45', '25'];
                      } elseif ($data_lhp_pasting[0]['shift'] == '2') {
                        $jam_start = ['16.30', '17.50', '19.35', '20.35', '21.35', '22.45', '23.45'];
                        $jam_end = ['17.50', '19.35', '20.35', '21.35', '22.45', '23.45', '00.30'];
                        $menit_tersedia = ['80', '105', '60', '60', '70', '60', '45'];
                        $menit_aktual = [70, 60, 60, 60, 60, 60, 40];

                        // $jam_start = ['16.30', '17.50', '19.35', '20.35', '21.35', '22.45', '23.45'];
                        // $jam_end = ['17.50', '19.35', '20.35', '21.35', '22.45', '23.45', '00.30'];
                        // $menit_tersedia = ['80', '105', '60', '60', '70', '60', '45'];
                        // $menit_aktual = ['70', '60', '60', '60', '60', '60', '40'];
                      } elseif ($data_lhp_pasting[0]['shift'] == '3') {
                        $jam_start = ['00.30', '01.50', '02.50', '03.50', '05.20', '06.20'];
                        $jam_end = ['01.50', '02.50', '03.50', '05.20', '06.20', '07.30'];
                        $menit_tersedia = ['80', '60', '60', '90', '60', '70'];
                        $menit_aktual = ['70', '60', '60', '60', '60', '60'];
                      }

                      // $temp_batch = '';
                      for ($i = 0; $i < count($data_detail_lhp); $i++) {
                        // if ($i > 0) {
                        //   $j = $i - 1;
                        //   $temp_batch = $data_detail_lhp[$j]['batch'];
                        // }
                      ?>
                        <tr>
                          <?php //if ($data_detail_lhp[$i]['batch'] != $temp_batch) { 
                          ?>
                          <!-- <td>
                              <button type="button" class="btn btn-sm btn-primary" onclick="add_rows_batch(<?= $i ?>)">
                                Add
                              </button>
                            </td> -->
                          <!-- <td>
																<span style="display:block; width: 100px;"><?= "" //$jam_start[$data_detail_lhp[$i]['batch'] - 1] 
                                                                            ?> - <?= "" //$jam_end[$data_detail_lhp[$i]['batch'] - 1] 
                                                                                  ?></span>
															</td>
															<td><?= "" //$menit_tersedia[$data_detail_lhp[$i]['batch'] - 1] 
                                  ?></td>
															<td><?= "" //$menit_aktual[$data_detail_lhp[$i]['batch'] - 1] 
                                  ?></td> -->
                          <!-- <td>
                              <div id="start_section_<?= $i ?>">
                                <input type="time" class="form-control" name="start[]" id="start_<?= $i ?>" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_start'])) ?>" style="width: 100px;">
                              </div>
                            </td>
                            <td>
                              <div id="stop_section_<?= $i ?>">
                                <input type="time" class="form-control" name="stop[]" id="stop_<?= $i ?>" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_end'])) ?>" style="width: 100px;">
                              </div>
                            </td> -->
                          <?php
                          //} else { 
                          ?>
                          <!-- <td><button type="button" class="btn btn-sm btn-danger" onclick="delete_rows(<?= $i ?>)">Remove</button></td> -->
                          <td>
                            <div id="start_section_<?= $i ?>">
                              <input type="time" class="form-control" name="start[]" id="start_<?= $i ?>" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_start'])) ?>" style="width: 100px;">
                            </div>
                          </td>
                          <td>
                            <div id="stop_section_<?= $i ?>">
                              <input type="time" class="form-control" name="stop[]" id="stop_<?= $i ?>" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_end'])) ?>" style="width: 100px;">
                            </div>
                          </td>
                          <?php
                          //}
                          ?>

                          <td>
                            <input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_<?= $i ?>" value="<?= $data_detail_lhp[$i]['menit_terpakai'] ?>" onkeyup="update_plan(<?= $i ?>)" style="width: 100px">
                          </td>
                          <!-- <td>
                            <select class="form-control select2" id="no_wo_<?= $i ?>" name="no_wo[]" onchange="getPartNo(<?= $i ?>)" style="width: 200px;">
                              <option selected disabled>-- Pilih No WO --</option>
                              <?php
                              $cek_wo = true;
                              // foreach ($data_wo as $dw) {
                              //   $selected = ($dw['PDNO'] == $data_detail_lhp[$i]['no_wo']) ? 'selected' : '';
                              //   $cek_wo = ($dw['PDNO'] == $data_detail_lhp[$i]['no_wo']) ? false : true;
                              ?>

                              <option value="<?= "" //$dw['PDNO'] 
                                              ?>" <?= "" //$selected 
                                                  ?>><?= "" //$dw['PDNO'] 
                                                      ?></option>
                              <?php
                              // }

                              if ($cek_wo) { ?>
                                <option value="<?= "" //$data_detail_lhp[$i]['no_wo'] 
                                                ?>" selected><?= "" //$data_detail_lhp[$i]['no_wo'] 
                                                              ?></option>
                              <?php
                              }
                              ?>
                              <option value="-">-</option>
                            </select>
                            <input type="hidden" name="batch[]" id="batch_<?= $i ?>" value="<?= "" //$data_detail_lhp[$i]['batch'] 
                                                                                            ?>">
                            <input type="hidden" name="id_detail_pasting[]" id="id_detail_pasting_<?= $i ?>" value="<?= "" //$data_detail_lhp[$i]['id_detail_pasting'] 
                                                                                                                    ?>">
                          </td> -->
                          <!-- <td>
                            <input type="text" class="form-control" name="part_number[]" id="part_number_<?= $i ?>" value="<?= $data_detail_lhp[$i]['type_grid'] ?>" style="width: 250px" readonly>
                          </td> -->
                          <td>
                            <select name="type_grid[]" id="type_grid_<?= $i ?>" class="form-select select2" onchange="get_jks(<?= $i ?>)" style="width: 300px">
                              <option value="">-- Pilih Type --</option>
                              <?php
                              foreach ($data_type_grid as $d_type_grid) {
                              ?>
                                <option value="<?= str_replace(' ', '', $d_type_grid['type_grid']) ?>" <?php if ($d_type_grid['type_grid'] == $data_detail_lhp[$i]['type_grid']) {
                                                                                                          echo "selected";
                                                                                                        } ?>><?= $d_type_grid['type_grid'] ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <input type="hidden" name="id_detail_lhp_pasting[]" id="id_detail_lhp_pasting_<?= $i ?>" value="<?= $data_detail_lhp[$i]['id_detail_lhp_pasting'] ?>">
                          </td>
                          <td>
                            <input type="text" class="form-control" name="ct[]" id="ct_<?= $i ?>" value="<?= $data_detail_lhp[$i]['ct'] ?>" style="width: 75px" readonly>
                          </td>
                          <!-- <td>
                            <input type="number" class="form-control" name="plan_cap[]" id="plan_cap_<?= $i ?>" value="<?= "" // $data_detail_lhp[$i]['plan_cap'] 
                                                                                                                        ?>" style="width: 75px" readonly>
                          </td> -->
                          <td>
                            <input type="number" class="form-control" name="jks[]" id="jks_<?= $i ?>" value="<?= $data_detail_lhp[$i]['jks'] ?>" style="width: 100px" readonly>
                          </td>
                          <td>
                            <input type="number" class="form-control" name="actual[]" id="actual_<?= $i ?>" onkeyup="presentase_actual(<?= $i ?>)" value="<?= $data_detail_lhp[$i]['actual'] ?>" style="width: 100px">
                          </td>
                          <!-- <td>
															<input type="text" class="form-control" size="4" name="act_vs_plan[]" id="act_vs_plan_<?= $i ?>" value="<?= $data_detail_lhp[$i]['act_vs_jks'] ?>" style="width: 75px" readonly>
														</td>
														<td>
															<input type="number" class="form-control" name="efficiency_time[]" id="efficiency_time_<?= $i ?>" value="<?= $data_detail_lhp[$i]['efficiency_time'] ?>" style="width: 75px" readonly>
														</td> -->
                          <!-- <td>
                            <input type="number" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_<?= $i ?>" value="<?= $data_detail_lhp[$i]['total_menit_breakdown'] ?>" style="width: 75px" readonly>
                          </td> -->
                          <td>
                            <input type="number" class="form-control" name="presentase[]" id="presentase_<?= $i ?>" value="<?= number_format($data_detail_lhp[$i]['act_vs_jks'], 3) ?>" style="width: 75px" readonly>
                          </td>
                          <td>
                            <button type="button" class="btn btn-sm btn-primary" id="add_breakdown_<?= $i ?>" onclick="add_breakdown(<?= $i ?>)">Add</button>
                          </td>
                          <td>
                            <button type="button" class="btn btn-sm btn-primary" id="add_reject_<?= $i ?>" onclick="add_reject(<?= $i ?>)">Add</button>
                          </td>
                        </tr>
                        <?php
                      }
                      if (count($data_detail_lhp) < 8) {
                        for ($i = count($data_detail_lhp); $i < count($jam_start); $i++) {
                          $j = $i; ?>
                          <tr>
                            <!-- <td>
                              <button type="button" class="btn btn-sm btn-primary" onclick="add_rows_batch(<?= $i ?>)">
                                Add
                              </button>
                            </td> -->
                            <!-- <td>
																<span style="display:block; width: 100px;"><?= $jam_start[$j] ?> - <?= $jam_end[$j] ?></span>
															</td>
															<td><?= $menit_tersedia[$j] ?></td>
															<td><?= $menit_aktual[$j] ?></td> -->
                            <td>
                              <div id="start_section_<?= $i ?>">
                                <input type="time" class="form-control" name="start[]" id="start_<?= $i ?>" value="<?= date('H:i', strtotime(str_replace('.', ':', $jam_start[$j]))) ?>" style="width: 100px;">
                              </div>
                            </td>
                            <td>
                              <div id="stop_section_<?= $i ?>">
                                <input type="time" class="form-control" name="stop[]" id="stop_<?= $i ?>" value="<?= date('H:i', strtotime(str_replace('.', ':', $jam_end[$j]))) ?>" style="width: 100px;">
                              </div>
                            </td>
                            <td>
                              <input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_<?= $i ?>" value="<?= $menit_aktual[$j] ?>" onkeyup="update_plan(<?= $i ?>)" style="width: 100px">
                            </td>
                            <!-- <td>
                              <select class="form-control select2" id="no_wo_<?= $i ?>" name="no_wo[]" onchange="getPartNo(<?= $i ?>)" style="width: 200px;">
                                <option selected disabled>-- Pilih No WO --</option>
                                <?php
                                // foreach ($data_wo as $dw) { 
                                ?>
                                <option value="<?= "" //$dw['PDNO'] 
                                                ?>"><?= "" //$dw['PDNO'] 
                                                    ?></option>
                                <?php
                                // }
                                ?>
                                <option value="-">-</option>
                              </select>
                              <input type="hidden" name="id_detail_pasting[]" id="id_detail_pasting_<?= $i ?>" value="">
                            </td> -->
                            <!-- <td>
                              <input type="text" class="form-control" name="part_number[]" id="part_number_<?= $i ?>" style="width: 250px" readonly>
                            </td> -->
                            <td>
                              <select name="type_grid[]" id="type_grid_<?= $i ?>" class="form-select select2" onchange="get_jks(<?= $i ?>)" style="width: 300px">
                                <option value="">-- Pilih Type --</option>
                                <?php
                                foreach ($data_type_grid as $d_type_grid) {
                                ?>
                                  <option value="<?= str_replace(' ', '', $d_type_grid['type_grid']) ?>"><?= $d_type_grid['type_grid'] ?></option>
                                <?php
                                }
                                ?>
                              </select>
                              <input type="hidden" name="id_detail_lhp_pasting[]" id="id_detail_lhp_pasting_<?= $i ?>" value="">
                            </td>
                            <td>
                              <input type="text" class="form-control" name="ct[]" id="ct_<?= $i ?>" style="width: 75px" readonly>
                            </td>
                            <!-- <td>
                              <input type="number" class="form-control" name="plan_cap[]" id="plan_cap_<?= $i ?>" style="width: 75px" readonly>
                            </td> -->
                            <td>
                              <input type="number" class="form-control" name="jks[]" id="jks_<?= $i ?>" style="width: 100px" readonly>
                            </td>
                            <td>
                              <input type="number" class="form-control" name="actual[]" id="actual_<?= $i ?>" onkeyup="presentase_actual(<?= $i ?>)" style="width: 100px">
                            </td>
                            <!-- <td>
																<input type="text" class="form-control" size="4" name="act_vs_plan[]" id="act_vs_plan_<?= $i ?>" style="width: 75px" readonly>
															</td>
															<td>
																<input type="number" class="form-control" name="efficiency_time[]" id="efficiency_time_<?= $i ?>" style="width: 75px" readonly>
															</td> -->
                            <!-- <td>
                              <input type="number" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_<?= $i ?>" style="width: 75px" readonly>
                            </td> -->
                            <td>
                              <input type="number" class="form-control" name="presentase[]" id="presentase_<?= $i ?>" style="width: 75px" readonly>
                            </td>
                            <td>
                              <button type="button" class="btn btn-sm btn-primary" id="add_breakdown_<?= $i ?>" onclick="add_breakdown(<?= $i ?>)">Add</button>
                            </td>
                            <td>
                              <button type="button" class="btn btn-sm btn-primary" id="add_reject_<?= $i ?>" onclick="add_reject(<?= $i ?>)">Add</button>
                            </td>
                          </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="5" class="text-end">
                          <h3>Total</h3>
                        </td>
                        <td style="text-align: right;"><input type="text" class="form-control" name="total_jks" id="" value="<?= $data_lhp_pasting[0]['total_jks'] ?>" style="width: 100px" readonly></td>
                        <td style="text-align: right;"><input type="text" class="form-control" name="total_actual" id="" value="<?= $data_lhp_pasting[0]['total_aktual'] ?>" style="width: 100px" readonly></td>
                        <td style="text-align: right;"><input type="text" class="form-control" name="total_presentase" id="" value="<?= number_format($data_lhp_pasting[0]['total_act_vs_jks'], 3) ?>" style="width: 75px" readonly></td>
                        <td></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>

              </div>
              <!-- <div class="box-footer">
                <input type="submit" class="btn btn-success" value="Save">
                <table id="" class="table" style="width:300px; font-size: 18px;">
                  <thead>
                    <tr>
                      <th>MH</th>
                      <th>:</th>
                      <th><span id="mh"></span></th>
                    </tr>
                    <tr>
                      <th>Efficiency</th>
                      <th>:</th>
                      <th><?= $retVal = (!empty($data_lhp_pasting[0]['total_aktual']) && !empty($data_lhp_pasting[0]['total_jks'])) ? number_format((float) ($data_lhp_pasting[0]['total_aktual'] / $data_lhp_pasting[0]['total_jks']) * 100, 2, '.', '') : ''; ?> %</th>
                    </tr>
                    <tr>
											<th>Total Line Stop</th>
											<th>:</th>
											<th><?= $data_lhp_pasting[0]['total_line_stop'] ?> Menit</th>
										</tr>
                  </thead>
                </table>
              </div> -->
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
                        <!-- <th>No WO</th>
                        <th>Type Battery</th> -->
                        <th>Type</th>
                        <th>Kategori Line Stop</th>
                        <th>Jenis Line Stop</th>
                        <th>Uraian Line Stop</th>
                        <th>Line Stop Minute</th>
                        <th>Line Stop Action</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_line_stop">
                      <?php
                      $model = new App\Models\M_Pasting();
                      $index_breakdown = 0;
                      foreach ($data_detail_breakdown as $d_detail_breakdown) { ?>
                        <tr>
                          <td>
                            <input type="time" class="form-control" name="start_breakdown[]" id="start_breakdown_<?= $index_breakdown ?>" value="<?= date("H:i", strtotime($d_detail_breakdown['jam_start'])) ?>" style="width: 100px;">
                          </td>
                          <td>
                            <input type="time" class="form-control" name="stop_breakdown[]" id="stop_breakdown_<?= $index_breakdown ?>" value="<?= date("H:i", strtotime($d_detail_breakdown['jam_end'])) ?>" style="width: 100px;">
                          </td>
                          <!-- <td>
                            <input type="text" class="form-control" name="no_wo_breakdown[]" id="no_wo_breakdown_<?= $index_breakdown ?>" value="<?= ""//$d_detail_breakdown['no_wo'] ?>" style="width: 125px">
                          </td> -->
                          <td>
                            <input type="hidden" class="form-control" name="id_breakdown[]" id="id_breakdown_<?= $index_breakdown ?>" value="<?= $d_detail_breakdown['id_breakdown'] ?>" style="width: 250px">
                            <input type="text" class="form-control" name="type_grid_line_stop[]" id="type_grid_line_stop_<?= $index_breakdown ?>" value="<?= $d_detail_breakdown['type_grid'] ?>" style="width: 225px" readonly>
                          </td>
                          <td>
                            <select class="form-control select2" name="kategori_line_stop[]" id="kategori_line_stop_<?= $index_breakdown ?>" onchange="get_jenis_line_stop(<?= $index_breakdown ?>)" style="width: 200px">
                              <option value="">Pilih Kategori Line Stop</option>
                              <?php
                              if($data_lhp_pasting[0]['mesin_pasting'] <= 3) {
                                foreach ($data_line_stop_casting as $d_kategori_line_stop) { ?>
                                  <option value="<?= $d_kategori_line_stop['kategori_line_stop'] ?>" <?php if ($d_kategori_line_stop['kategori_line_stop'] == $d_detail_breakdown['kategori_line_stop']) {
                                                                                                  echo "selected";
                                                                                                } ?>><?= $d_kategori_line_stop['kategori_line_stop'] ?></option>
                                <?php
                                }
                              } else {
                                foreach ($data_line_stop_punching as $d_kategori_line_stop) { ?>
                                  <option value="<?= $d_kategori_line_stop['kategori_line_stop'] ?>" <?php if ($d_kategori_line_stop['kategori_line_stop'] == $d_detail_breakdown['kategori_line_stop']) {
                                                                                                  echo "selected";
                                                                                                } ?>><?= $d_kategori_line_stop['kategori_line_stop'] ?></option>
                                <?php
                              }
                              }
                              ?>
                            </select>
                          </td>
                          <td>
                            <select class="form-control select2" id="jenis_line_stop_<?= $index_breakdown ?>" name="jenis_line_stop[]" style="width: 200px;">
                              <option selected disabled>-- Pilih Jenis Line Stop --</option>
                              <?php
                              if($data_lhp_pasting[0]['mesin_pasting'] <= 3) {
                                $data_jenis_line_stop = $model->getListJenisLineStopCasting($d_detail_breakdown['kategori_line_stop']);
                                $andon_proses = true;
                                foreach ($data_jenis_line_stop as $d_jenis_line_stop) {
                                  $selected = ($d_jenis_line_stop['jenis_line_stop'] == $d_detail_breakdown['jenis_line_stop']) ? 'selected' : '';
                                  if ($selected != '') {
                                    $andon_proses = false;
                                  }
                                ?>
                                  <option value="<?= $d_jenis_line_stop['jenis_line_stop'] ?>" <?= $selected ?>><?= $d_jenis_line_stop['jenis_line_stop'] ?></option>
                                  <?php
                                }
                              } else {
                                $data_jenis_line_stop = $model->getListJenisLineStopPunching($d_detail_breakdown['kategori_line_stop']);
                                foreach ($data_jenis_line_stop as $d_jenis_line_stop) {
                                  $selected = ($d_jenis_line_stop['jenis_line_stop'] == $d_detail_breakdown['jenis_line_stop']) ? 'selected' : '';
                                  if ($selected != '') {
                                    $andon_proses = false;
                                  }
                                ?>
                                  <option value="<?= $d_jenis_line_stop['jenis_line_stop'] ?>" <?= $selected ?>><?= $d_jenis_line_stop['jenis_line_stop'] ?></option>
                                <?php
                                }
                              }

                              if ($andon_proses) { ?>
                                <option value="<?= $d_detail_breakdown['jenis_line_stop'] ?>" selected><?= $d_detail_breakdown['jenis_line_stop'] ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </td>
                          <td>
                            <textarea class="form-control" name="uraian_line_stop[]" id="uraian_line_stop_<?= $index_breakdown ?>" cols="20" rows="1" style="width: 200px;"><?= $d_detail_breakdown['uraian_line_stop'] ?></textarea>
                          </td>
                          <td>
                            <input type="number" class="form-control" name="menit_breakdown[]" id="menit_breakdown_<?= $index_breakdown ?>" value="<?= $d_detail_breakdown['menit_breakdown'] ?>" style="width: 75px">
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger" onclick="delete_breakdown(<?= $index_breakdown ?>)"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>

                      <?php
                        $index_breakdown++;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="box-footer" style="text-align: center;">
                <!-- <input type="submit" class="btn btn-success" value="Save"> -->
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
                        <!-- <th>Jam Start</th>
												<th>Jam Stop</th> -->
                        <th>Type</th>
                        <th>Reject QTY</th>
                        <th>Reject Jenis</th>
                        <th>Reject Kategori</th>
                        <th>Reject Remark</th>
                        <th>Reject Action</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_reject">
                      <?php
                      $index_reject = 0;
                      foreach ($data_detail_reject as $d_detail_reject) { ?>
                        <tr>
                          <!-- <td>
                            <input type="text" class="form-control" name="no_wo_reject[]" id="no_wo_reject_<?= $index_reject ?>" value="<?= "" //$d_detail_reject['no_wo'] 
                                                                                                                                        ?>" style="width: 200px">
                          </td> -->
                          <td>
                            <input type="hidden" name="id_reject_pasting[]" id="id_reject_pasting_<?= $index_reject ?>" value="<?= $d_detail_reject['id_reject_pasting'] ?>">
                            <input type="text" class="form-control" name="type_grid_reject[]" id="type_grid_reject_<?= $index_reject ?>" value="<?= $d_detail_reject['type_grid'] ?>" style="width: 250px" readonly>
                          </td>
                          <td>
                            <input type="number" class="form-control" name="qty_reject[]" id="qty_reject_<?= $index_reject ?>" value="<?= $d_detail_reject['qty_reject'] ?>" style="width: 75px">
                          </td>
                          <td>
                            <select class="form-control select2" name="jenis_reject_pasting[]" id="jenis_reject_pasting_<?= $index_reject ?>" onchange="get_kategori_reject(<?= $index_reject ?>)" style="width: 200px">
                              <option value="">Pilih Kategori Reject</option>
                              <?php
                              foreach ($data_reject_pasting as $d_jenis_reject) { ?>
                                <option value="<?= $d_jenis_reject['jenis_reject_pasting'] ?>" <?php if ($d_jenis_reject['jenis_reject_pasting'] == $d_detail_reject['jenis_reject_pasting']) {
                                                                                                  echo "selected";
                                                                                                } ?>><?= $d_jenis_reject['jenis_reject_pasting'] ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </td>
                          <td>
                            <select class="form-control select2" id="kategori_reject_pasting_<?= $index_reject ?>" name="kategori_reject_pasting[]" style="width: 250px;">
                              <option selected disabled>-- Pilih Jenis Reject --</option>
                              <?php
                              $data_kategori_reject = $model->getKategoriReject($d_detail_reject['jenis_reject_pasting']);
                              foreach ($data_kategori_reject as $d_kategori_reject) { ?>
                                <option value="<?= $d_kategori_reject['kategori_reject_pasting'] ?>" <?php if ($d_kategori_reject['kategori_reject_pasting'] == $d_detail_reject['kategori_reject_pasting']) {
                                                                                                        echo "selected";
                                                                                                      } ?>><?= $d_kategori_reject['kategori_reject_pasting'] ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </td>
                          <td>
                            <textarea class="form-control" name="remark_reject[]" id="remark_reject_<?= $index_reject ?>" cols="20" rows="1" style="width: 250px;"><?= $d_detail_reject['remark_reject'] ?></textarea>
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger" onclick="delete_reject(<?= $index_reject ?>)"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>
                      <?php
                        $index_reject++;
                      }
                      ?>
                    </tbody>
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
          <div class="col-xl-12 col-12">
            <div class="box">
              <div class="box-header">
                <h4>Detail Rak Keluar</h4>
                <br>
                <table class="table">
                  <tr>
                    <td>
                      Barcode  <input type="text" class="form-control" name="start_barcode_out" id="start_barcode_out" onchange="//get_qty_rak_out()" class="form-control">
                    </td>
                    <td>
                      Qty <input type="text" class="form-control" name="start_qty_out" id="start_qty_out" class="form-control" readonly>
                    </td>
                    <td>
                      QR Code Rak<input type="text" class="form-control" name="start_rak_out" id="start_rak_out" class="form-control">
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary" onclick="add_rak_out()">Add</button>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="data_line_stop" class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th>Barcode</th>
                        <th>QTY</th>
                        <th>ID Rak</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_data_rak_out">
                      <?php $no = 0; foreach ($data_all_rak_out as $d_rak) { ?>
                        <tr class="rak_out">
                          <td>
                            <input type="text" class="form-control" name="barcode_rak_out[]" id="barcode_rak_out_<?=$no?>" value="<?=$d_rak['barcode']?>" readonly>
                            <input type="hidden" class="form-control" name="id_rak_barcode_out[]" id="id_rak_barcode_out_<?=$no?>" value="<?=$d_rak['id']?>" readonly>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="qty_rak_out[]" id="qty_rak_out_<?=$no?>" value="<?=$d_rak['qty']?>" readonly>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="id_rak_out[]" id="id_rak_out_<?=$no?>" value="<?=$d_rak['id_rak']?>" readonly>
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak_out(this, <?= $no ?>)">Delete</button>
                          </td>
                        </tr>
                      <?php $no += 1;
                        }
                      ?>
                    </tbody>
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
					<div class="col-xl-12 col-12">
						<div class="box">
              <div class="box-header">
                  <button type="button" class="btn btn-primary" onclick="get_data_andon()">Refresh Andon</button>
              </div>
							<div class="box-body">
								<div class="table-responsive">
									<table id="data_andon" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>Nama Mesin</th>
												<th>Permasalahan</th>
												<th>Tujuan</th>
                        <th>Total Menit</th>
											</tr>
										</thead>
										<tbody id="tbody_data_andon">
                      <?php
                        foreach ($data_andon as $d_andon) {
                            ?>
                            <tr>
                                <td>MC <?=$d_andon['no_machine']?></td>
                                <td><?=$d_andon['permasalahan']?></td>
                                <td><?=$d_andon['tujuan']?></td>
                                <td><?=$d_andon['total_menit']?></td>
                            </tr>
                            <?php
                        }
                      ?>
										</tbody>
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
          <div class="col-4" style="text-align:center;"><input type="submit" class="btn btn-success" value="Save"></div>
          <div class="col-4"></div>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  var total_row;
  $(document).ready(function() {
    var tbody = document.getElementById('tbody');
    total_row = tbody.rows.length - 1;

    // $('#data_andon').DataTable();

    hitung_mh();

    $('input[type="number"]').each(function() {
      if ($(this).val() == 0) {
        $(this).val('');
      }
    });
  });

  function get_data_andon() {
        var shift = $('#shift').val();
        var tanggal = $('#tanggal_produksi').val();
        var mesin = $('#mesin_pasting').val();

        $.ajax({
            url: '<?=base_url()?>pasting/get_data_andon',
            type: 'POST',
            data: {
                shift: shift,
                tanggal: tanggal,
                mesin: mesin
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.length > 0) {
                    var html = '';
                    var no = 1;
                    for (var i = 0; i < data.length; i++) {
                        html += `<tr>
                                    <td>
                                        ${data[i].nama_mesin}
                                        <input type="hidden" name="no_machine_andon[]" value="${data[i].nama_mesin.substring(3)}">
                                        <input type="hidden" name="tiket_andon[]" value="${data[i].id_ticket}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="permasalahan_andon[]" id="permasalahan_${no}" class="form-control" value="${data[i].permasalahan.substring(8)}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="tujuan_andon[]" id="tujuan_${no}" class="form-control" value="${data[i].tujuan}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="total_menit_andon[]" id="total_menit_${no}" class="form-control" value="${data[i].total_min}">
                                    </td>
                                </tr>`;
                        no++;
                    }
                    $('#tbody_data_andon').html(html);
                } else {
                    alert('Tidak Ada Andon');
                }
            }
        })
    }

  function get_jks(i) {
    let menit_terpakai = $('#menit_terpakai_' + i).val();
    let type_grid = $('#type_grid_' + i).val();
    console.log(type_grid);
    <?php foreach ($data_type_grid as $dtg) { ?>
      if (type_grid.toString() == "<?= str_replace(' ', '', trim($dtg['type_grid'])) ?>") {
        $('#ct_' + i).val(<?= trim($dtg['ct']) ?>);
        console.log(<?= floatval($dtg['ct']) ?>)
        $('#jks_' + i).val(Math.floor((menit_terpakai * 60) / <?= floatval(trim($dtg['ct'])) ?>))
      }
    <?php } ?>
  }

  function hitung_mh() {
    var total_menit = <?= array_sum($menit_aktual) ?>;
    var mp = <?= $data_lhp_pasting[0]['mp'] ?>;
    // var absen = <?= $data_lhp_pasting[0]['absen'] ?>;
    // var cuti = <?= $data_lhp_pasting[0]['cuti'] ?>;
    var mh = (total_menit * mp) / 60;
    // var mh  = (total_menit * (mp-absen-cuti)) / 60;

    $('#mh').text(mh.toFixed(2));
  }

  function getPartNo(i) {
    var no_wo = $('#no_wo_' + i).val();
    $('#total_menit_breakdown_' + i).val($('#menit_terpakai_' + i).val());
    $.ajax({
      url: '<?= base_url() ?>pasting/getPartNo',
      type: 'POST',
      data: {
        no_wo: no_wo
      },
      dataType: 'json',
      success: function(data) {
        $('#part_number_' + i).val(data[0].MITM.trim());
        $('#plan_cap_' + i).val(data[0].QTY);

        $.ajax({
          url: '<?= base_url() ?>pasting/getCT',
          type: 'POST',
          data: {
            part_number: data[0].MITM.trim()
          },
          dataType: 'json',
          success: function(data) {
            $('#ct_' + i).val(data[0].first_cycle_time);
            var plan_cap = ($('#menit_terpakai_' + i).val() * 60) / data[0].first_cycle_time;
            $('#plan_cap_' + i).val(plan_cap.toFixed(0));
          }
        });
      }
    });
  }

  function presentase_actual(i) {
    var jks = $('#jks_' + i).val();
    var actual = $('#actual_' + i).val();
    var presentase = (actual / jks) * 100;
    $('#presentase_' + i).val(presentase.toFixed(2));
  }

  // function presentase_actual(i) {
  //   var plan_cap = $('#plan_cap_' + i).val();
  //   var actual = $('#actual_' + i).val();
  //   var presentase = (actual / plan_cap) * 100;
  //   // $('#act_vs_plan_'+i).val(presentase.toFixed(2));

  //   var ct = $('#ct_' + i).val();
  //   var total_minute = (actual * ct) / 60;
  //   var efficiency_time = total_minute.toFixed(0);
  //   $('#efficiency_time_' + i).val(efficiency_time);


  //   var total_menit_breakdown = $('#menit_terpakai_' + i).val() - efficiency_time;
  //   $('#total_menit_breakdown_' + i).val(total_menit_breakdown);
  // }

  function add_breakdown(i) {
    var mesin_pasting = $('#mesin_pasting').val();
    let data_line_stop;
    if(mesin_pasting <= 3) {
      data_line_stop = <?= json_encode($data_line_stop_casting); ?>;
    } else {
      data_line_stop = <?= json_encode($data_line_stop_punching); ?>;
    }

    var start_breakdown = $('#start_' + i).val();
    var stop_breakdown = $('#stop_' + i).val();
    var type_grid = $('#type_grid_' + i).val();
    // var no_wo_breakdown = $('#no_wo_' + i).val();


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
          <input type="hidden" class="form-control" name="id_breakdown[]" id="id_breakdown_${j}" value="" style="width: 250px">
          <input type="text" class="form-control" name="type_grid_line_stop[]" id="type_grid_line_stop_${j}" value="${type_grid}" style="width: 225px" readonly>
        </td>
				<td>
					<select class="form-control select2" name="kategori_line_stop[]" id="kategori_line_stop_${j}" onchange="get_jenis_line_stop(${j})" style="width: 200px">
						<option value="">Pilih Kategori Line Stop</option>
						${data_line_stop.map((item) => {
							return `<option value="${item.kategori_line_stop}">${item.kategori_line_stop}</option>`;
						}).join('')}
					</select>
				</td>
				<td>
					<select class="form-control select2" id="jenis_line_stop_${j}" name="jenis_line_stop[]" style="width: 200px;">
						<option selected disabled>-- Pilih Jenis Line Stop --</option>
					</select>
				</td>
				<td>
					<textarea class="form-control" name="uraian_line_stop[]" id="uraian_line_stop_${j}" cols="20" rows="1" style="width: 200px;"></textarea>
				</td>
				<td>
					<input type="number" class="form-control" name="menit_breakdown[]" id="menit_breakdown_${j}" style="width: 75px">
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
    var data_reject_pasting = <?= json_encode($data_reject_pasting); ?>;

    var start_reject = $('#start_' + i).val();
    var stop_reject = $('#stop_' + i).val();
    var no_wo_reject = $('#no_wo_' + i).val();
    var type_grid_reject = $('#type_grid_' + i).val();


    var tbody = document.getElementById('tbody_reject');

    var j = tbody.rows.length;

    $('#tbody_reject').append(`
			<tr>
				<td>
          <input type="hidden" class="form-control" name="id_reject_pasting[]" id="id_reject_pasting_${j}" value="" style="width: 100px">
					<input type="text" class="form-control" name="type_grid_reject[]" id="type_grid_reject_${j}" value="${type_grid_reject}" style="width: 250px" readonly>
				</td>
				<td>
					<input type="number" class="form-control" name="qty_reject[]" id="qty_reject_${j}" style="width: 75px">
				</td>
				<td>
					<select class="form-control select2" id="jenis_reject_pasting_${j}" name="jenis_reject_pasting[]" onchange="get_kategori_reject(${j})" style="width: 200px;">
						<option selected disabled>-- Pilih Kategori Reject --</option>
						${data_reject_pasting.map((item) => {
							return `<option value="${item.jenis_reject_pasting}">${item.jenis_reject_pasting}</option>`;
						}).join('')}
					</select>
				</td>
				<td>
					<select class="form-control select2" id="kategori_reject_pasting_${j}" name="kategori_reject_pasting[]" style="width: 250px;">
						<option selected disabled>-- Pilih Jenis Reject --</option>
					</select>
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

    // <td>
    // 	<input type="time" class="form-control" name="start_reject[]" id="start_reject_${j}" value="${start_reject}" style="width: 100px;">
    // </td>
    // <td>
    // 	<input type="time" class="form-control" name="stop_reject[]" id="stop_reject_${j}" value="${stop_reject}" style="width: 100px;">
    // </td>
  }

  function get_jenis_line_stop(i) {
    var mesin_pasting = $('#mesin_pasting').val();
    var kategori_line_stop = $('#kategori_line_stop_' + i).val();
    // if (i == 0) {
    // 	i = '00';
    // }

    if (kategori_line_stop == 'ANDON') {
      get_data_andon(i);
    } else {
      $.ajax({
        url: '<?= base_url() ?>pasting/get_jenis_line_stop',
        type: 'POST',
        data: {
          kategori_line_stop: kategori_line_stop,
          mesin_pasting: mesin_pasting
        },
        dataType: 'json',
        success: function(data) {
          console.log(data)
          $('#jenis_line_stop_' + i).html(`
						<option selected disabled>-- Pilih Jenis Line Stop --</option>
						${data.map((item) => `<option value="${item.jenis_line_stop}">${item.jenis_line_stop}</option>`)}
					`);
          $('#uraian_line_stop_' + i).val('');
          $('#menit_breakdown_' + i).val('');
        }
      });
    }
  }

  function get_kategori_reject(i) {
    var jenis_reject_pasting = $('#jenis_reject_pasting_' + i).val();

    $.ajax({
      url: '<?= base_url() ?>pasting/get_kategori_reject',
      type: 'POST',
      data: {
        jenis_reject_pasting: jenis_reject_pasting
      },
      dataType: 'json',
      success: function(data) {
        $('#kategori_reject_pasting_' + i).html(`
					<option selected disabled>-- Pilih Jenis Reject --</option>
					${data.map((item) => `<option value="${item.kategori_reject_pasting}">${item.kategori_reject_pasting}</option>`)}
				`);
        $('#remark_reject_' + i).val('');
      }
    });
  }

  // function get_data_andon(j) {
  //   var tanggal_produksi = $('#tanggal_produksi').val();
  //   var mesin_pasting = <?= $data_lhp_pasting[0]['mesin_pasting'] ?>;
  //   $.ajax({
  //     url: '<?= base_url() ?>pasting/get_data_andon',
  //     type: 'POST',
  //     data: {
  //       tanggal_produksi: tanggal_produksi,
  //       mesin_pasting: mesin_pasting
  //     },
  //     dataType: 'json',
  //     success: function(data) {
  //       $('#tbody_andon').html('');
  //       data.forEach((item, i) => {
  //         $('#tbody_andon').append(`
	// 					<tr>
	// 						<td>${item.id_ticket}</td>
	// 						<td>${item.permasalahan}</td>
	// 						<td>${item.shift}</td>
	// 						<td>${item.id_mesin_pasting}</td>
	// 						<td>${item.pelapor}</td>
	// 						<td>${item.created_at}</td>
	// 						<td><button class="btn btn-primary btn-sm" onclick="pilih_andon(${item.id_ticket}, ${j})">Pilih</button></td>
	// 					</tr>
	// 				`);
  //       });
  //     }
  //   })
  //   $('#modal_data_andon').modal('show');
  // }

  function pilih_andon(id_ticket, i) {
    $.ajax({
      url: '<?= base_url() ?>pasting/pilih_andon',
      type: 'POST',
      data: {
        id_ticket: id_ticket
      },
      dataType: 'json',
      success: function(data) {
        $('#jenis_line_stop_' + i).html(`
					${data.map((item) => `<option value="${item.id_ticket}-${item.tujuan}-${item.nama_mesin}" selected>${item.id_ticket}-${item.tujuan}-${item.nama_mesin}</option>`)}
				`);

        $('#uraian_line_stop_' + i).val(data[0].permasalahan);
        $('#menit_breakdown_' + i).val(data[0].total_min_reduce);

      }
    });
    $('#modal_data_andon').modal('hide');
  }

  // function add_rows_batch(i) {
  //   // var data_wo = <?php //echo json_encode($data_wo); 
                        //                     
                        ?>;
  //   var data_line_stop = <?php ""//echo json_encode($data_line_stop); ?>;

  //   var tbody = document.getElementById('tbody'),
  //     row, k;

  //   // ambil jam trakhir di row selanjutnya
  //   var k = i + 1;

  //   var jam_start = $('#start_' + k).val();
  //   var jam_stop = $('#stop_' + i).val();

  //   // Ambil total jumlah row untuk mengetahui row mana yang akan di tambahkan
  //   var count_row = tbody.rows.length;
  //   var j = (count_row - total_row) + i;

  //   // uniqid untuk id kategori_line_stop dan jenis_line_stop
  //   var k = count_row * 2;

  //   row = tbody.insertRow(j);
  //   row.innerHTML = `
  // 		<tr>
  // 			<td><button type="button" class="btn btn-sm btn-danger" onclick="delete_rows(${j})">Remove</button></td>
  // 			<td><input type="time" class="form-control" name="start[]" id="start_(${j})" value="${jam_stop}" style="width: 100px;"></td>
  // 			<td><input type="time" class="form-control" name="stop[]" id="stop_(${j})" value="${jam_start}" style="width: 100px;"></td>
  // 			<!--

  // 			<td></td>
  // 			<td></td>
  // 			<td></td>


  // 			-->
  // 			<td>
  // 				<input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_${k}" onkeyup="update_plan(${k})" value="" style="width: 75px">
  // 			</td>
  // 			<td>
  // 				<select class="form-control select2" id="no_wo_${k}" name="no_wo[]" onchange="getPartNo(${k})" style="width: 200px;">
  // 					<option selected disabled>-- Pilih No WO --</option>
  // 					${data_wo.map((item) => `<option value="${item.PDNO}">${item.PDNO}</option>`)}
  // 					<option value="-">-</option>
  // 				</select>
  // 				<input type="hidden" name="batch[]" id="batch_${k}" value="${i == 0 ? i+1 : i}">
  // 			</td>
  // 			<td>
  // 				<input type="text" class="form-control" name="part_number[]" id="part_number_${k}" style="width: 250px" readonly>
  // 			</td>
  // 			<td>
  // 				<input type="text" class="form-control" size="4" name="ct[]" id="ct_${k}" style="width: 75px" readonly>
  // 			</td>
  // 			<td>
  // 				<input type="number" class="form-control" name="plan_cap[]" id="plan_cap_${k}" style="width: 75px" readonly>
  // 			</td>
  // 			<td>
  // 				<input type="number" class="form-control" name="actual[]" id="actual_${k}" onkeyup="presentase_actual(${k})" style="width: 75px">
  // 			</td>
  // 			<td>
  // 				<input type="number" class="form-control" name="total_menit_breakdown[]" id="total_menit_breakdown_${k}" style="width: 75px" readonly>
  // 			</td>
  // 			<td>
  // 				<button type="button"class="btn btn-sm btn-primary" id="add_breakdown_${k}" onclick="add_breakdown(${k})">Add</button>
  // 			</td>
  // 			<td>
  // 				<button type="button"class="btn btn-sm btn-primary" id="add_reject_${k}" onclick="add_reject(${k})">Add</button>
  // 			</td>
  // 		</tr>
  // 	`;

  //   $('.select2').select2();

  //   // <td>
  //   // 	<input type="text" class="form-control" size="4" name="act_vs_plan[]" id="act_vs_plan_${k}" style="width: 75px" readonly>
  //   // </td>
  //   // <td>
  //   // 	<input type="number" class="form-control" name="efficiency_time[]" id="efficiency_time_${k}" style="width: 75px" readonly>
  //   // </td>
  // }

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
    var menit_terpakai = $('#menit_terpakai_' + i).val() * 60;
    var ct = $('#ct_' + i).val();
    var plan_cap = Math.floor(menit_terpakai / ct);
    $('#plan_cap_' + i).val(plan_cap);

    presentase_actual(i);
  }

  function time_start(i) {
    var date = new Date();
    var currentTime = date.toLocaleString().substring(11, 16);
    $('#start_section_' + i).html(`
			<input type="time" class="form-control" name="start_${i}" id="start_${i}" value="${currentTime}" style="width: 100px;">
		`);

    $('#stop_section_' + i).html(`
			<button class="btn btn-danger" onclick="time_stop(${i})">Stop</button>
		`);
  }

  function time_stop(i) {
    var date = new Date();
    var currentTime = date.toLocaleString().substring(11, 16);
    $('#stop_section_' + i).html(`
			<input type="time" class="form-control" name="stop_${i}" id="stop_${i}" value="${currentTime}" style="width: 100px;">
		`);
  }

  function add_rak_in() {
        let id_lhp_pasting = $('#id_lhp_pasting').val();
        let barcode = $('#start_barcode').val();
        let qty = $('#start_qty').val();
        let rak = $('#start_rak').val();
        let baris = document.querySelectorAll('.rak_in').length;
        $.ajax({
            url: '<?=base_url()?>pasting/add_rak_in',
            type: 'POST',
            data: {
                id_lhp_pasting: id_lhp_pasting,
                barcode: barcode,
                qty: qty,
                rak: rak
            },
            dataType: 'json',
            success: function(data) {
                // console.log(data)
                // window.location.reload();
                $('#tbody_data_rak').append(`
                    <tr class="rak_in">
                        <td>
                            <input type="text" class="form-control" name="barcode_rak[]" id="barcode_rak_${baris}" class="form-control" value="${barcode}">
                            <input type="hidden" class="form-control" name="id_rak_barcode[]" id="id_rak_barcode_${baris}" class="form-control" value="${data}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="qty_rak[]" id="qty_rak_${baris}" class="form-control" value="${qty}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="id_rak[]" id="id_rak_${baris}" class="form-control" value="${rak}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak_in(this, ${baris})">Delete</button>
                        </td>
                    </tr>
                `);

                $('#start_barcode').val('');
                $('#start_qty').val('');
                $('#start_rak').val('');
            }
        });
    }

    function delete_detail_rak_in(e, baris) {
        var barcode = $('#id_rak_barcode_' + baris).val();
        $.ajax({
            url: '<?=base_url()?>pasting/delete_rak',
            type: 'POST',
            data: {
                barcode: barcode
            },
            dataType: 'json',
            success: function(data) {
                $(e).parent().parent().remove();
            }
        });
    }

    function get_qty_rak() {
        var barcode = $('#start_barcode').val();

        $.ajax({
            url: '<?=base_url()?>pasting/get_qty_rak',
            type: 'POST',
            data: {
                barcode: barcode
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#start_qty').val(data[0].qty);
                $('#start_rak').focus();
            }
        })
    }

    function add_rak_out() {
        let id_lhp_pasting = $('#id_lhp_pasting').val();
        let barcode = $('#start_barcode_out').val();
        let qty = $('#start_qty_out').val();
        let rak = $('#start_rak_out').val();
        let baris = document.querySelectorAll('.rak_out').length;
        $.ajax({
            url: '<?=base_url()?>pasting/add_rak_out',
            type: 'POST',
            data: {
                id_lhp_pasting: id_lhp_pasting,
                barcode: barcode,
                qty: qty,
                rak: rak
            },
            dataType: 'json',
            success: function(data) {
                // window.location.reload();
                $('#tbody_data_rak_out').append(`
                    <tr class="rak_out">
                        <td>
                            <input type="text" class="form-control" name="barcode_rak_out[]" id="barcode_rak_out_${baris}" class="form-control" value="${barcode}">
                            <input type="hidden" class="form-control" name="id_rak_barcode_out[]" id="id_rak_barcode_out_${baris}" class="form-control" value="${data}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="qty_rak_out[]" id="qty_rak_out_${baris}" class="form-control" value="${qty}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="id_rak_out[]" id="id_rak_out_${baris}" class="form-control" value="${rak}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak_out(this, ${baris})">Delete</button>
                        </td>
                    </tr>
                `);
            
                $('#start_barcode_out').val('');
                $('#start_qty_out').val('');
                $('#start_rak_out').val('');
            }
        });
      }
    
    function delete_detail_rak_out(e, baris) {
      let id_barcode_out = $('#id_rak_barcode_out_' + baris).val();
      $.ajax({
          url: '<?=base_url()?>pasting/delete_rak_out',
          type: 'POST',
          data: {
              id_barcode_out: id_barcode_out
          },
          dataType: 'json',
          success: function(data) {
              $(e).parent().parent().remove();
          }
      });
    }
</script>
<?= $this->endSection(); ?>