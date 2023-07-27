<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?php
// var_dump($summary_detail_note);die;
// echo $summary_detail_note[0]['loss_over']; die;
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
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Kasubsie</label>
                  <select class="form-select" id="kasubsie" name="kasubsie">
                    <option selected disabled>-- Pilih Data --</option>
                    <option value="<?= "Yanto A" ?>" <?php if ($data_lhp_pasting[0]['kasubsie'] == "Yanto A") {
                                                        echo "selected";
                                                      } ?>><?= "Yanto A" ?></option>
                    <option value="<?= "Ade Suryana" ?>" <?php if ($data_lhp_pasting[0]['kasubsie'] == "Ade Suryana") {
                                                            echo "selected";
                                                          } ?>><?= "Ade Suryana" ?></option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Grup</label>

                  <select class="form-select" id="grup" name="grup">
                    <option selected disabled>-- Pilih Data --</option>
                    <?php foreach ($data_grup_pasting as $grup) : ?>
                      <option value="<?= $grup['nama_grup'] ?>" <?php if ($data_lhp_pasting[0]['grup'] === $grup['nama_grup']) {
                                                                  echo "selected";
                                                                } ?>><?= $grup['nama_grup'] ?></option>
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
                <h4>Detail Rak Kosong</h4>
                <br>
                <table class="table">
                  <tr>
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
                      <?php $number = 0;
                      foreach ($data_record_rak_in as $d_rak) { ?>
                        <tr class="rak_in">
                          <td>
                            <input type="text" class="form-control" name="barcode_rak[]" id="barcode_rak_<?= $number ?>" value="<?= $d_rak['barcode'] ?>" readonly>
                            <input type="hidden" class="form-control" name="id_log_detail_record_rak[]" id="id_log_detail_record_rak_<?= $number ?>" value="<?= $d_rak['id_log'] ?>" readonly>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="qty_rak[]" id="qty_rak_<?= $number ?>" value="<?= $d_rak['qty'] ?>" readonly>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="id_rak[]" id="id_rak_<?= $number ?>" value="<?= $d_rak['pn_qr'] ?>" readonly>
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak_in(this, <?= $number ?>)">Delete</button>
                          </td>
                        </tr>
                      <?php
                        $number += 1;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="box-footer" style="text-align: center;">
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
                        <th>Jam Start</th>
                        <th>Jam End</th>
                        <th>Menit Terpakai</th>
                        <th>Type</th>
                        <th>CT</th>
                        <th>JKS</th>
                        <th>Actual</th>
                        <th>Presentase (%)</th>
                        <th>Line Stop</th>
                        <th>Reject</th>
                      </tr>
                    </thead>
                    <tbody id="tbody">
                      <?php
                      if ($data_lhp_pasting[0]['shift'] == 1) {
                        $jam_start = ['07.30', '08.50', '09.50', '11.00', '12.00 ', '14.00', '15.00', '16.15'];
                        $jam_end = ['08.50', '09.50', '11.00', '12.00', '14.00', '15.00', '16.15', '16.30'];
                        $menit_tersedia = ['80', '60', '70', '60', '120', '60', '75', '15'];
                        $menit_aktual = [70, 60, 60, 60, 60, 60, 60, 10];
                      } elseif ($data_lhp_pasting[0]['shift'] == 2) {
                        $jam_start = ['16.30', '17.50', '19.35', '20.35', '21.35', '22.45', '23.45'];
                        $jam_end = ['17.50', '19.35', '20.35', '21.35', '22.45', '23.45', '00.30'];
                        $menit_tersedia = ['80', '105', '60', '60', '70', '60', '45'];
                        $menit_aktual = [70, 60, 60, 60, 60, 60, 40];
                      } elseif ($data_lhp_pasting[0]['shift'] == 3) {
                        $jam_start = ['00.30', '01.50', '02.50', '03.50', '05.20', '06.20'];
                        $jam_end = ['01.50', '02.50', '03.50', '05.20', '06.20', '07.30'];
                        $menit_tersedia = ['80', '60', '60', '90', '60', '70'];
                        $menit_aktual = [70, 60, 60, 60, 60, 60];
                      }

                      $temp_batch = '';
                      $number = 0;
                      for ($i = 0; $i < count($data_detail_lhp); $i++) {
                        if ($i > 0) {
                          $j = $i - 1;
                          $temp_batch = $data_detail_lhp[$j]['batch'];
                        }
                      ?>
                          <?php if ($data_detail_lhp[$i]['batch'] !== NULL) {
                            if ($data_detail_lhp[$i]['batch'] != $temp_batch) { $number = 0; ?>
                        <tr class="row_<?= $data_detail_lhp[$i]['batch'] ?>">
                            <td>
                              <button type="button" class="btn btn-sm btn-primary button_add_rows_batch_<?= $data_detail_lhp[$i]['batch'] ?>" onclick="add_rows_batch(<?= $data_detail_lhp[$i]['batch'] ?>)">
                                Add
                              </button>
                            </td>
                            <td>
                              <div id="start_section_<?= $data_detail_lhp[$i]['batch'] ?>">
                                <input type="time" class="form-control" name="start[]" id="start_<?= $data_detail_lhp[$i]['batch'] ?>_0" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_start'])) ?>" onkeyup="hitung_menit_terpakai(<?= $data_detail_lhp[$i]['batch'] ?>, 0)" style="width: 100px;">
                              </div>
                            </td>
                            <td>
                              <div id="stop_section_<?= $data_detail_lhp[$i]['batch'] ?>">
                                <input type="time" class="form-control" name="stop[]" id="stop_<?= $data_detail_lhp[$i]['batch'] ?>_0" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_end'])) ?>" onkeyup="hitung_menit_terpakai(<?= $data_detail_lhp[$i]['batch'] ?>, 0)" style="width: 100px;">
                              </div>
                            </td>
                          <?php } else { $number++ ?>
                        <tr class="row_<?= $data_detail_lhp[$i]['batch'] ?>">
                            <td>
                              <button type="button" class="btn btn-sm btn-danger" onclick="delete_rows_db(this, <?= $i ?>, <?= $data_detail_lhp[$i]['batch'] ?>)">Remove</button>
                            </td>
                            <td>
                              <div id="start_section_<?= $data_detail_lhp[$i]['batch'] ?>">
                                <input type="time" class="form-control" name="start[]" id="start_<?= $data_detail_lhp[$i]['batch'] ?>_<?= $number ?>" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_start'])) ?>" onkeyup="hitung_menit_terpakai(<?= $data_detail_lhp[$i]['batch'] ?>, <?= $number ?>)" style="width: 100px;">
                              </div>
                            </td>
                            <td>
                              <div id="stop_section_<?= $data_detail_lhp[$i]['batch'] ?>">
                                <input type="time" class="form-control" name="stop[]" id="stop_<?= $data_detail_lhp[$i]['batch'] ?>_<?= $number ?>" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_end'])) ?>" onkeyup="hitung_menit_terpakai(<?= $data_detail_lhp[$i]['batch'] ?>, <?= $number ?>)" style="width: 100px;">
                              </div>
                            </td>
                          <?php } } else { ?>
                        <tr class="row_<?= $i ?>">
                            <td>
                              <button type="button" class="btn btn-sm btn-primary" onclick="add_rows_batch(<?= $i ?>)">
                                Add
                              </button>
                            </td>
                            <td>
                              <div id="start_section_<?= $i ?>">
                                <input type="time" class="form-control" name="start[]" id="start_<?= $i ?>_0" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_start'])) ?>" onkeyup="hitung_menit_terpakai(<?= $i ?>, 0)" style="width: 100px;">
                              </div>
                            </td>
                            <td>
                              <div id="stop_section_<?= $i ?>">
                                <input type="time" class="form-control" name="stop[]" id="stop_<?= $i ?>_0" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_end'])) ?>" onkeyup="hitung_menit_terpakai(<?= $i ?>, 0)" style="width: 100px;">
                              </div>
                            </td>
                          <?php } ?>
                          <td>
                            <input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['menit_terpakai'] ?>" onkeyup="update_jks(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)" style="width: 100px">
                          </td>
                          <td>
                            <select name="type_grid[]" id="type_grid_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" class="form-select select2 type_grid" onchange="get_jks(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)" style="width: 300px">
                              <option value="">-- Pilih Type --</option>
                              <?php
                              foreach ($data_type_grid as $d_type_grid) {
                              ?>
                                <option value="<?= $d_type_grid['type_grid'] ?>" <?php if ($d_type_grid['type_grid'] == $data_detail_lhp[$i]['type_grid']) {
                                                                                                          echo "selected";
                                                                                                        } ?>><?= $d_type_grid['type_grid'] ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <input type="hidden" name="batch[]" id="batch_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>" value="<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>">
                            <input type="hidden" name="id_detail_lhp_pasting[]" id="id_detail_lhp_pasting_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['id_detail_lhp_pasting'] ?>">
                          </td>
                          <td>
                            <input type="text" class="form-control" name="ct[]" id="ct_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['ct'] ?>" style="width: 75px" readonly>
                          </td>
                          <td>
                            <input type="number" class="form-control" name="jks[]" id="jks_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['jks'] ?>" style="width: 100px" readonly>
                          </td>
                          <td>
                            <input type="number" class="form-control" name="actual[]" id="actual_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" onkeyup="presentase_actual(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)" value="<?= $data_detail_lhp[$i]['actual'] ?>" style="width: 100px">
                          </td>
                          <td>
                            <input type="number" class="form-control" name="presentase[]" id="presentase_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= number_format($data_detail_lhp[$i]['act_vs_jks'], 3) ?>" style="width: 75px" readonly>
                          </td>
                          <td>
                            <button type="button" class="btn btn-sm btn-primary" id="add_breakdown_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" onclick="add_breakdown(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)">Add</button>
                          </td>
                          <td>
                            <button type="button" class="btn btn-sm btn-primary" id="add_reject_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" onclick="add_reject(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)">Add</button>
                          </td>
                        </tr>
                        <?php
                      }
                      if (count($data_detail_lhp) <= count($jam_start)) {
                        for ($i = count($data_detail_lhp); $i < count($jam_start); $i++) { ?>
                          <tr class="row_<?= $i ?>">
                            <td>
                              <button type="button" class="btn btn-sm btn-primary" onclick="add_rows_batch(<?= $i ?>)">
                                Add
                              </button>
                            </td>
                            <td>
                              <div id="start_section_<?= $i ?>">
                                <input type="time" class="form-control" name="start[]" id="start_<?= $i ?>_0" value="<?= date('H:i', strtotime(str_replace('.', ':', $jam_start[$i]))) ?>" onkeyup="hitung_menit_terpakai(<?= $i ?>, 0)" style="width: 100px;">
                              </div>
                            </td>
                            <td>
                              <div id="stop_section_<?= $i ?>">
                                <input type="time" class="form-control" name="stop[]" id="stop_<?= $i ?>_0" value="<?= date('H:i', strtotime(str_replace('.', ':', $jam_end[$i]))) ?>" onkeyup="hitung_menit_terpakai(<?= $i ?>, 0)" style="width: 100px;">
                              </div>
                            </td>
                            <td>
                              <input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_<?= $i ?>_0" value="<?= $menit_aktual[$i] ?>" onkeyup="update_jks(<?= $i ?>, 0)" style="width: 100px">
                            </td>
                            <td>
                              <select name="type_grid[]" id="type_grid_<?= $i ?>_0" class="form-select select2" onchange="get_jks(<?= $i ?>, 0)" style="width: 300px">
                                <option value="">-- Pilih Type --</option>
                                <?php
                                foreach ($data_type_grid as $d_type_grid) {
                                ?>
                                  <option value="<?= str_replace(' ', '', $d_type_grid['type_grid']) ?>"><?= $d_type_grid['type_grid'] ?></option>
                                <?php
                                }
                                ?>
                              </select>
                              <input type="hidden" name="batch[]" id="batch_<?=$i?>" value="<?=$i?>">
                              <input type="hidden" name="id_detail_lhp_pasting[]" id="id_detail_lhp_pasting_<?= $i ?>_0" value="">
                            </td>
                            <td>
                              <input type="text" class="form-control" name="ct[]" id="ct_<?= $i ?>_0" style="width: 75px" readonly>
                            </td>
                            <td>
                              <input type="number" class="form-control" name="jks[]" id="jks_<?= $i ?>_0" style="width: 100px" readonly>
                            </td>
                            <td>
                              <input type="number" class="form-control" name="actual[]" id="actual_<?= $i ?>_0" onkeyup="presentase_actual(<?= $i ?>, 0)" style="width: 100px">
                            </td>
                            <td>
                              <input type="number" class="form-control" name="presentase[]" id="presentase_<?= $i ?>_0" style="width: 75px" readonly>
                            </td>
                            <td>
                              <button type="button" class="btn btn-sm btn-primary" id="add_breakdown_<?= $i ?>_0" onclick="add_breakdown(<?= $i ?>, 0)">Add</button>
                            </td>
                            <td>
                              <button type="button" class="btn btn-sm btn-primary" id="add_reject_<?= $i ?>_0" onclick="add_reject(<?= $i ?>, 0)">Add</button>
                            </td>
                          </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="6" class="text-end">
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
            </div>
          </div>
        </div>

        <!-- SUMMARY TOTAL PERTYPE -->
        <div class="row">
          <div class="col-xl-12 col-12">
            <div class="box">
              <div class="box-header with-border">
                <h4>Summary Total Per Type</h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th>Type</th>
                        <th>Total</th>
                        <th>Loss / Over</th>
                        <th>Catatan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody >
                      <?php $index_summary_note = 0; foreach($summary_total_aktual_per_type as $d_summary_total_aktual_per_type){ ?>
                        <tr class="<?= str_replace(" ","",$d_summary_total_aktual_per_type['type_grid']) ?>">
                          <td><?= $d_summary_total_aktual_per_type['type_grid'] ?></td>
                          <td><?= $d_summary_total_aktual_per_type['actual'] ?></td>
                          <!-- <td> -->
                            <?php 
                            // foreach($summary_detail_note as $sdn){
                              // $keys = array_keys($summary_detail_note);
                              $cek_type = false;
                              for ($i = 0; $i < count($summary_detail_note); $i++) {
                                if ($summary_detail_note[$i]["type_grid"] == $d_summary_total_aktual_per_type['type_grid']) {
                                  $cek_type = true;
                                  break;
                                }
                              }
                              if($cek_type) { ?>
                                <td>
                                  <?php if (!empty($summary_detail_note[$index_summary_note]['loss_over'])) { ?>
                                    <?= $summary_detail_note[$index_summary_note]['loss_over'] ?>
                                    <input type="hidden" class="form-control" name="loss_over_value" id="loss_over_<?= $index_summary_note ?>" value="<?= $summary_detail_note[$index_summary_note]['loss_over'] ?>">
                                  <?php } else { ?>
                                    <input type="hidden" class="form-control" name="loss_over_value" id="loss_over_<?= $index_summary_note ?>" value="">
                                  <?php } ?>
                                </td>
                                <td>
                                <?php if (!empty($summary_detail_note[$index_summary_note]['loss_over'])) { ?>
                                  <?= $summary_detail_note[$index_summary_note]['note']?>
                                  <input type="hidden" class="form-control" name="note_value" id="note_<?= $index_summary_note ?>" value="<?= $summary_detail_note[$index_summary_note]['note'] ?>">
                                  <input type="hidden" class="form-control" name="id_summary" id="id_summary_<?= $index_summary_note ?>" value="<?= $summary_detail_note[$index_summary_note]['id_summary_note'] ?>">
                                  <?php } else { ?>
                                    <input type="hidden" class="form-control" name="note_value" id="note_<?= $index_summary_note ?>" value="">
                                  <input type="hidden" class="form-control" name="id_summary" id="id_summary_<?= $index_summary_note ?>" value="<?= $summary_detail_note[$index_summary_note]['id_summary_note'] ?>">
                                  <?php } ?>
                                </td>
                            <?php } else {
                                echo ''; ?>
                                <td><input type="hidden" class="form-control" name="id_summary" id="id_summary_<?= $index_summary_note ?>" value=""></td>
                                <td>
                                  <input type="hidden" class="form-control" name="note_value" id="note_<?= $index_summary_note ?>" value="">
                                  <input type="hidden" class="form-control" name="loss_over_value" id="loss_over_<?= $index_summary_note ?>" value="">
                                </td>
                            <?php }
                            // }
                            if(count($summary_detail_note) == 0) {
                                echo ''; ?>
                                <td><input type="hidden" class="form-control" name="id_summary" id="id_summary_<?= $index_summary_note ?>" value=""></td>
                                <td>
                                  <input type="hidden" class="form-control" name="note_value" id="note_<?= $index_summary_note ?>" value="">
                                  <input type="hidden" class="form-control" name="loss_over_value" id="loss_over_<?= $index_summary_note ?>" value="">
                                </td>
                            <?php }
                            ?>
                          <!-- </td> -->
                          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_note_pasting" onclick="add_note('<?= $d_summary_total_aktual_per_type['type_grid'] ?>', <?= $d_summary_total_aktual_per_type['actual'] ?>, <?= $id_lhp_pasting ?>, <?= $index_summary_note ?>)">
                            Add
                          </button></td>
                        </tr>
                      <?php $index_summary_note++; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END OF SUMMARY -->

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
                          <td>
                            <input type="hidden" class="form-control" name="id_breakdown[]" id="id_breakdown_<?= $index_breakdown ?>" value="<?= $d_detail_breakdown['id_breakdown'] ?>" style="width: 250px">
                            <input type="text" class="form-control" name="type_grid_line_stop[]" id="type_grid_line_stop_<?= $index_breakdown ?>" value="<?= $d_detail_breakdown['type_grid'] ?>" style="width: 225px" readonly>
                          </td>
                          <td>
                            <select class="form-control select2" name="kategori_line_stop[]" id="kategori_line_stop_<?= $index_breakdown ?>" onchange="get_jenis_line_stop(<?= $index_breakdown ?>)" style="width: 200px">
                              <option value="">Pilih Kategori Line Stop</option>
                              <?php
                              if ($data_lhp_pasting[0]['mesin_pasting'] <= 3) {
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
                              $andon_proses = true;
                              if ($data_lhp_pasting[0]['mesin_pasting'] <= 3) {
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
                <h4>Detail Rak Isi</h4>
                <br>
                <table class="table">
                  <tr>
                    <td>
                      Barcode <input type="text" class="form-control" name="start_barcode_out" id="start_barcode_out" onchange="get_qty_rak_out()" class="form-control">
                    </td>
                    <td>
                      Qty <input type="text" class="form-control" name="start_qty_out" id="start_qty_out" class="form-control" readonly>
                      <div class="qty"></div>
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
                  <table id="data_rak_isi" class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th>Barcode</th>
                        <th>QTY</th>
                        <th>ID Rak</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_data_rak_out">
                      <?php $no = 0;
                      foreach ($data_record_rak_out as $d_rak) { ?>
                        <tr class="rak_out">
                          <td>
                            <input type="text" class="form-control" name="barcode_rak_out[]" id="barcode_rak_out_<?= $no ?>" value="<?= $d_rak['barcode'] ?>" readonly>
                            <input type="hidden" class="form-control" name="id_log_detail_record_rak_out[]" id="id_log_detail_record_rak_out_<?= $no ?>" value="<?= $d_rak['id_log'] ?>" readonly>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="qty_rak_out[]" id="qty_rak_out_<?= $no ?>" value="<?= $d_rak['qty'] ?>" readonly>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="id_rak_out[]" id="id_rak_out_<?= $no ?>" value="<?= $d_rak['pn_qr'] ?>" readonly>
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
                          <td>MC <?= $d_andon['no_machine'] ?></td>
                          <td><?= $d_andon['permasalahan'] ?></td>
                          <td><?= $d_andon['tujuan'] ?></td>
                          <td><?= $d_andon['total_menit'] ?></td>
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
          <div class="col-4" style="text-align:center;"><input type="submit" class="btn btn-success" value="Save" id="btn_submit"></div>
          <div class="col-4"></div>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->
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

<div class="modal fade modal_tambah_note_pasting" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Tambah Catatan</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row" id="note_pasting">
        </div>
      </div>
      <div class="modal-footer" style="float: right;" id="add_note_pasting">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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

    // function clickButton() {
    //   $('#btn_submit').click();
    // }
    // setInterval(clickButton, 3600000); // SEJAM
  });

  function get_data_andon() {
    var shift = $('#shift').val();
    var tanggal = $('#tanggal_produksi').val();
    var mesin = $('#mesin_pasting').val();

    $.ajax({
      url: '<?= base_url() ?>pasting/get_data_andon',
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

  function get_jks(i, j) {
    let menit_terpakai = $('#menit_terpakai_' + i + '_' + j).val();
    let type_grid = $('#type_grid_' + i + '_' + j).val();
    console.log(type_grid);
    <?php foreach ($data_type_grid as $dtg) { ?>
      // if (type_grid.toString() == "<?= str_replace(' ', '', trim($dtg['type_grid'])) ?>") {
      if (type_grid.toString() == "<?= $dtg['type_grid'] ?>") {
        $('#ct_' + i + '_' + j).val(<?= trim($dtg['ct']) ?>);
        console.log(<?= floatval($dtg['ct']) ?>)
        $('#jks_' + i + '_' + j).val(Math.floor((menit_terpakai * 60) / <?= floatval(trim($dtg['ct'])) ?>))
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

  function presentase_actual(i, j) {
    var jks = $('#jks_' + i + '_' + j).val();
    var actual = $('#actual_' + i + '_' + j).val();
    var presentase = (actual / jks) * 100;
    $('#presentase_' + i + '_' + j).val(presentase.toFixed(2));
  }

  function add_breakdown(i, j) {
    var mesin_pasting = $('#mesin_pasting').val();
    let data_line_stop;
    if (mesin_pasting <= 3) {
      data_line_stop = <?= json_encode($data_line_stop_casting); ?>;
    } else {
      data_line_stop = <?= json_encode($data_line_stop_punching); ?>;
    }

    var start_breakdown = $('#start_' + i + '_' + j).val();
    var stop_breakdown = $('#stop_' + i + '_' + j).val();
    var type_grid = $('#type_grid_' + i + '_' + j).val();
    // var no_wo_breakdown = $('#no_wo_' + i).val();


    var tbody = document.getElementById('tbody_line_stop');

    var row = tbody.rows.length;


    $('#tbody_line_stop').append(`
			<tr>
				<td>
					<input type="time" class="form-control" name="start_breakdown[]" id="start_breakdown_${row}" value="${start_breakdown}" style="width: 100px;">
				</td>
				<td>
					<input type="time" class="form-control" name="stop_breakdown[]" id="stop_breakdown_${row}" value="${stop_breakdown}" style="width: 100px;">
				</td>
        <td>
          <input type="hidden" class="form-control" name="id_breakdown[]" id="id_breakdown_${row}" value="" style="width: 250px">
          <input type="text" class="form-control" name="type_grid_line_stop[]" id="type_grid_line_stop_${row}" value="${type_grid}" style="width: 225px" readonly>
        </td>
				<td>
					<select class="form-control select2" name="kategori_line_stop[]" id="kategori_line_stop_${row}" onchange="get_jenis_line_stop(${row})" style="width: 200px">
						<option value="">Pilih Kategori Line Stop</option>
						${data_line_stop.map((item) => {
							return `<option value="${item.kategori_line_stop}">${item.kategori_line_stop}</option>`;
						}).join('')}
					</select>
				</td>
				<td>
					<select class="form-control select2" id="jenis_line_stop_${row}" name="jenis_line_stop[]" style="width: 200px;">
						<option selected disabled>-- Pilih Jenis Line Stop --</option>
					</select>
				</td>
				<td>
					<textarea class="form-control" name="uraian_line_stop[]" id="uraian_line_stop_${row}" cols="20" rows="1" style="width: 200px;"></textarea>
				</td>
				<td>
					<input type="number" class="form-control" name="menit_breakdown[]" id="menit_breakdown_${row}" style="width: 75px">
				</td>
				<td>
					<button type="button" class="btn btn-danger" onclick="delete_breakdown(${row})"><i class="fa fa-trash"></i></button>	
				</td>
			</tr>
		`);

    $('.select2').select2();

    $('html, body').animate({
      scrollTop: $('#ls_section').offset().top
    }, 500);

  }

  function add_reject(i, j) {
    var data_reject_pasting = <?= json_encode($data_reject_pasting); ?>;

    var start_reject = $('#start_' + i + '_' + j).val();
    var stop_reject = $('#stop_' + i + '_' + j).val();
    // var no_wo_reject = $('#no_wo_' + i).val();
    var type_grid_reject = $('#type_grid_' + i + '_' + j).val();


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

  let numbers = [];
  function getNumbers(i) {
    if(numbers[i] === undefined)
      numbers[i] = 0;
    return numbers[i];
  }

  function rowDeleted(i) {
    if(numbers[i] !== undefined)
      numbers[i] = numbers[i] + 1;
    else
      numbers[i] = 1;
    return numbers[i];
  }

  function add_rows_batch(i) {
    let rowDeleted = getNumbers(i);
    let data_type_grid = <?php echo json_encode($data_type_grid); ?>;
    let tbodyElement = document.getElementById('tbody');

    let batchElement = document.querySelectorAll('#batch_' + i);
    batchElement = batchElement.length;
    let row = document.querySelectorAll('.row_' + i);
    let lastRow = row[row.length-1];
    let k = i + 1;
    let jam_start = $('#start_' + k + '_0').val();
    let jam_stop = $('#stop_' + i + '_0').val();
    let batchNumber = batchElement + rowDeleted;
    if(batchElement > 1) {
      jam_stop = $('#stop_' + i + '_' + (batchNumber - 1)).val();
    }
    lastRow = lastRow.rowIndex;
    // let totalRow = tbodyElement.rows.length;
    // let addRowAfter = lastRow + batchElement - 1;
    lastRow = tbodyElement.insertRow(lastRow);
    lastRow.classList.add('row_' + i);
		lastRow.innerHTML = `
      <td><button type="button" class="btn btn-sm btn-danger" onclick="delete_rows(this, ${i})">Remove</button></td>
      <td><input type="time" class="form-control" name="start[]" id="start_${i}_${batchNumber}" value="${jam_stop}" onkeyup="hitung_menit_terpakai(${i}, ${batchNumber})" style="width: 100px;"></td>
      <td><input type="time" class="form-control" name="stop[]" id="stop_${i}_${batchNumber}" value="${jam_start}" onkeyup="hitung_menit_terpakai(${i}, ${batchNumber})" style="width: 100px;"></td>
      <td><input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_${i}_${batchNumber}" onkeyup="update_jks(${i}, ${batchNumber})" value="" style="width: 100px"></td>
      <td>
          <select name="type_grid[]" id="type_grid_${i}_${batchNumber}" class="form-select select2 type_grid"
              onchange="get_jks(${i}, ${batchNumber})" style="width: 300px">
              <option value="">-- Pilih Type --</option>
              ${data_type_grid.map((item) => `<option value="${item.type_grid}">${item.type_grid}</option>`)}
          </select>
          <input type="hidden" name="batch[]" id="batch_${i}" value="${i}">
          <input type="hidden" name="id_detail_lhp_pasting[]" id="id_detail_lhp_pasting_${i}" value="">
      </td>
      <td>
          <input type="text" class="form-control" name="ct[]" id="ct_${i}_${batchNumber}" value="" style="width: 75px" readonly>
      </td>
      <td>
          <input type="number" class="form-control" name="jks[]" id="jks_${i}_${batchNumber}" value="" style="width: 100px" readonly>
      </td>
      <td>
          <input type="number" class="form-control" name="actual[]" id="actual_${i}_${batchNumber}" onkeyup="presentase_actual(${i}, ${batchNumber})" value="" style="width: 100px">
      </td>
      <td>
          <input type="number" class="form-control" name="presentase[]" id="presentase_${i}_${batchNumber}" value="" style="width: 75px" readonly>
      </td>
      <td>
          <button type="button" class="btn btn-sm btn-primary" id="add_breakdown_${i}_${batchNumber}" onclick="add_breakdown(${i})">Add</button>
      </td>
      <td>
          <button type="button" class="btn btn-sm btn-primary" id="add_reject_${i}_${batchNumber}" onclick="add_reject(${i})">Add</button>
      </td>
		`;

		$('.select2').select2();
    let hours = jam_start.split(':')[0] - jam_stop.split(':')[0];
    let minutes = jam_start.split(':')[1] - jam_stop.split(':')[1];
    if(minutes < 0) {
      hours--;
      minutes = 60 + minutes;
    }
    if(hours < 0) {
      hours = 24 + hours;
    }
    let menit_terpakai = hours * 60 + minutes;
    $('#menit_terpakai_' + i + '_' + batchNumber).val(menit_terpakai);
  }

  function delete_rows_db(e, i, j) {
    let id_detail_lhp_pasting = $('#id_detail_lhp_pasting_' + i).val();
    $.ajax({
      url: '<?= base_url() ?>pasting/delete_rows',
      type: 'POST',
      data: {
        id_detail_lhp_pasting: id_detail_lhp_pasting
      },
      dataType: 'json',
      success: function(data) {
        // if(data === 'Success')
          rowDeleted(j);
          $(e).parent().parent().remove();
        // else
          // alert('Data Gagal Dihapus');
        // var tbody = document.getElementById('tbody');
        // tbody.deleteRow(i);
      }
    })
  }

  function delete_rows(e, i) {
    // var tbody = document.getElementById('tbody');
    // tbody.deleteRow(e);
    rowDeleted(i);
    $(e).parent().parent().remove();
  }

  function delete_breakdown(i) {
    var tbody = document.getElementById('tbody_line_stop');
    tbody.deleteRow(i);
  }

  function delete_reject(i) {
    var tbody = document.getElementById('tbody_reject');
    tbody.deleteRow(i);
  }

  function update_jks(i, j) {
    var menit_terpakai = $('#menit_terpakai_' + i + '_' + j).val() * 60;
    var ct = $('#ct_' + i + '_' + j).val();
    var jks = Math.floor(menit_terpakai / ct);
    $('#jks_' + i + '_' + j).val(jks);

    presentase_actual(i, j);
  }

  function hitung_menit_terpakai(i, j) {
    let start = $('#start_' + i + '_' + j).val();
    let stop = $('#stop_' + i + '_' + j).val();

    let hours = stop.split(':')[0] - start.split(':')[0];
    let minutes = stop.split(':')[1] - start.split(':')[1];
    if(minutes < 0) {
      hours--;
      minutes = 60 + minutes;
    }
    if(hours < 0) {
      hours = 24 + hours;
    }
    let menit_terpakai = hours * 60 + minutes;
    $('#menit_terpakai_' + i + '_' + j).val(menit_terpakai);

    update_jks(i, j);
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
    // let barcode = $('#start_barcode').val();
    // let qty = $('#start_qty').val();
    let rak = $('#start_rak').val();
    // let baris = document.querySelectorAll('.rak_in').length;
    $('#loading-modal').modal('show');
    $.ajax({
      url: '<?= base_url() ?>pasting/add_rak_in',
      type: 'POST',
      data: {
        id_lhp_pasting: id_lhp_pasting,
        // barcode: barcode,
        // qty: qty,
        rak: rak
      },
      dataType: 'json',
      success: function(data) {
        console.log(data)
        // window.location.reload();
        if (data === 'Gagal') {
          alert('Data Tidak Ditemukan');
          $('#start_rak').val('');
          $('#loading-modal').modal('hide');
          $('#start_rak').focus();
        } else {
          let no = 0;
          data['data_record_rak'].forEach(drr => {
            $('#tbody_data_rak').append(`
                <tr class="rak_in">
                    <td>
                        <input type="text" class="form-control" name="barcode_rak[]" id="barcode_rak_${no}" class="form-control" value="${drr['barcode']}">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="qty_rak[]" id="qty_rak_${no}" class="form-control" value="${drr['qty']}">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="id_rak[]" id="id_rak_${no}" class="form-control" value="${rak}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="delete_detail_rak_in(this, ${no})">Delete</button>
                    </td>
                </tr>
            `);
            no++;
          });

          // $('#start_barcode').val('');
          // $('#start_qty').val('');
          $('#start_rak').val('');
          $('#loading-modal').modal('hide');
        }
      }
    });
  }

  function delete_detail_rak_in(e, baris) {
    // let id_rak_barcode = $('#id_rak_barcode_' + baris).val();
    // let id_log_detail_record_rak = $('#id_log_detail_record_rak_' + baris).val();
    let pn_qr = $('#id_rak_' + baris).val();
    let id_rakElement = [];
    // let barcode = $('#barcode_rak_' + baris).val();
    let jumlah_baris = document.querySelectorAll('.rak_in').length;
    $('#loading-modal').modal('show');
    $.ajax({
      url: '<?= base_url() ?>pasting/delete_rak',
      type: 'POST',
      data: {
        // id_rak_barcode: id_rak_barcode,
        // id_log_detail_record_rak: id_log_detail_record_rak,
        pn_qr: pn_qr,
        // barcode: barcode,
      },
      dataType: 'json',
      success: function(data) {
        console.log(data)
        for (let i = 0; i < jumlah_baris; i++) {
          id_rakElement = $('#id_rak_' + i).val();
          if (id_rakElement === pn_qr) {
            $('#id_rak_' + i).parent().parent().remove();
          }
        }
        $('#loading-modal').modal('hide');
      }
    });
  }

  function get_qty_rak() {
    let barcode = $('#start_barcode').val();
    $('#loading-modal').modal('show');
    $.ajax({
      url: '<?= base_url() ?>pasting/get_qty_rak',
      type: 'POST',
      data: {
        barcode: barcode
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        if (data.length > 0) {
          $('#start_qty').val(data[0].t$actq);
          $('#loading-modal').modal('hide');
          $('#start_rak').focus();
        } else {
          alert('Data Tidak Ditemukan');
          $('#loading-modal').modal('hide');
        }
      }
    })
  }

  function get_qty_rak_out() {
    let barcode = $('#start_barcode_out').val();
    $('#loading-modal').modal('show');
    $.ajax({
      url: '<?= base_url() ?>pasting/get_qty_rak',
      type: 'POST',
      data: {
        barcode: barcode
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        if (data.length > 0) {
          document.querySelector('.qty').innerHTML = '';
          $('.qty').append(`
              <input type="hidden" class="form-control" name="item" id="item" class="form-control" value="${data[0]['T$ITEM'].trim()}">
              <input type="hidden" class="form-control" name="dsca" id="dsca" class="form-control" value="${data[0]['T$DSCA']}">
              <input type="hidden" class="form-control" name="cuni" id="cuni" class="form-control" value="${data[0]['T$CUNI']}">
              <input type="hidden" class="form-control" name="endt" id="endt" class="form-control" value="${data[0]['T$ENDT']}">
              <input type="hidden" class="form-control" name="orno" id="orno" class="form-control" value="${data[0]['T$ORNO']}">
              <input type="hidden" class="form-control" name="mach" id="mach" class="form-control" value="${data[0]['T$MACH']}">
          `);
          $('#start_qty_out').val(data[0].T$ACTQ);
          $('#loading-modal').modal('hide');
          $('#start_rak_out').focus();
        } else {
          alert('Data Tidak Ditemukan');
          $('#loading-modal').modal('hide');
        }
      }
    })
  }

  function add_rak_out() {
    $('#loading-modal').modal('show');
    let id_lhp_pasting = $('#id_lhp_pasting').val();
    let barcode = $('#start_barcode_out').val();
    let qty = $('#start_qty_out').val();
    let rak = $('#start_rak_out').val();
    let item = $('#item').val();
    let descrp = $('#dsca').val();
    let satuan = $('#cuni').val();
    let mesin = $('#mach').val();
    let entry_date = $('#endt').val();
    let no_wo = $('#orno').val();
    let baris = document.querySelectorAll('.rak_out').length;

    let cek_rak = false;

    $.ajax({
      url: '<?= base_url() ?>rak_management/cek_rak',
      type: 'POST',
      data: {
        rak: rak
      },
      dataType: 'json',
      success: function(data) {
        if (data.length > 0) {
          
          var searchTerm = $('#start_barcode_out').val();
          var found = false;
          var i = 0;
          
          $('#data_rak_isi tbody tr').each(function() {
              $(this).find('td').each(function() {
              var cellText = $('#barcode_rak_out_'+i).val();
              // console.log(cellText);
              if (cellText.includes(searchTerm)) {
                  found = true;
                  return false; // Break out of inner loop
              }
              });

              if (found) {
                  alert('Barcode Sudah Di Scan !!!');
                  $('#start_barcode_out').val('');
                  $('#start_qty_out').val('');
                  $('#start_rak_out').val('');
                  $('#start_barcode_out').focus();

                  return false; // Break out of outer loop
              }
              i++;
          });

          if (!found) {
              $.ajax({
                url: '<?= base_url() ?>grid/cek_rak',
                type: 'POST',
                data: {
                    barcode: barcode,
                    rak: rak
                },
                dataType: 'json',
                success: function(data) {
                  if (data.length === 0) {
                    $.ajax({
                      url: '<?= base_url() ?>pasting/add_rak_out',
                      type: 'POST',
                      data: {
                        id_lhp_pasting: id_lhp_pasting,
                        barcode: barcode,
                        qty: qty,
                        rak: rak,
                        item: item,
                        descrp: descrp,
                        satuan: satuan,
                        mesin: mesin,
                        entry_date: entry_date,
                        no_wo: no_wo,
                      },
                      dataType: 'json',
                      success: function(data) {
                        if (data === 'Gagal') {
                          $('#loading-modal').modal('hide');
                          alert('Data Tidak Ditemukan');
                        } else if(data['id_log_detail_record_rak_out'] === "") {
                          $('#start_barcode_out').val('');
                          $('#start_qty_out').val('');
                          $('#start_rak_out').val('');
                          $('#loading-modal').modal('hide');
                        } else {
                          // window.location.reload();
                          $('#tbody_data_rak_out').append(`
                              <tr class="rak_out">
                                  <td>
                                      <input type="text" class="form-control" name="barcode_rak_out[]" id="barcode_rak_out_${baris}" class="form-control" value="${barcode}" readonly>
                                      <input type="hidden" class="form-control" name="id_log_detail_record_rak_out[]" id="id_log_detail_record_rak_out_${baris}" class="form-control" value="${data['id_log_detail_record_rak_out']}">
                                  </td>
                                  <td>
                                      <input type="text" class="form-control" name="qty_rak_out[]" id="qty_rak_out_${baris}" class="form-control" value="${qty}" readonly>
                                  </td>
                                  <td>
                                      <input type="text" class="form-control" name="id_rak_out[]" id="id_rak_out_${baris}" class="form-control" value="${rak}" readonly>
                                  </td>
                                  <td>
                                      <button type="button" class="btn btn-danger" onclick="delete_detail_rak_out(this, ${baris})">Delete</button>
                                  </td>
                              </tr>
                          `);

                          $('#start_barcode_out').val('');
                          $('#start_qty_out').val('');
                          $('#start_rak_out').val('');
                          $('#loading-modal').modal('hide');
                        }
                      },
                      error: function(jqXHR, textStatus, errorThrown) {
                        alert('Barcode Sudah Di Scan !!!');
                        $('#start_barcode_out').val('');
                        $('#start_qty_out').val('');
                        $('#start_rak_out').val('');
                        $('#loading-modal').modal('hide');
                        $('#start_barcode_out').focus();
                      }
                    });
                  } else {
                      alert('Barcode Sudah Di Scan !!!');
                      $('#start_barcode_out').val('');
                      $('#start_qty_out').val('');
                      $('#start_rak_out').val('');
                      $('#loading-modal').modal('hide');
                      $('#start_barcode_out').focus();
                  }
                }
              });
          }
        } else {
          alert('Rak tidak ditemukan, Silahkan lakukan Scan Rak kembali');
          $('#start_rak_out').val('');
          $('#start_rak_out').focus();
          $('#loading-modal').modal('hide');
        }
      }
    });

    // $('#loading-modal').modal('show');
    // $.ajax({
    //   url: '<?= base_url() ?>pasting/add_rak_out',
    //   type: 'POST',
    //   data: {
    //     id_lhp_pasting: id_lhp_pasting,
    //     barcode: barcode,
    //     qty: qty,
    //     rak: rak,
    //     item: item,
    //     descrp: descrp,
    //     satuan: satuan,
    //     mesin: mesin,
    //     entry_date: entry_date,
    //     no_wo: no_wo,
    //   },
    //   dataType: 'json',
    //   success: function(data) {
    //     if (data === 'Gagal') {
    //       $('#loading-modal').modal('hide');
    //       alert('Data Tidak Ditemukan');
    //     } else if(data['id_log_detail_record_rak_out'] === "") {
    //       $('#start_barcode_out').val('');
    //       $('#start_qty_out').val('');
    //       $('#start_rak_out').val('');
    //       $('#loading-modal').modal('hide');
    //     } else {
    //       // window.location.reload();
    //       $('#tbody_data_rak_out').append(`
    //           <tr class="rak_out">
    //               <td>
    //                   <input type="text" class="form-control" name="barcode_rak_out[]" id="barcode_rak_out_${baris}" class="form-control" value="${barcode}" readonly>
    //                   <input type="hidden" class="form-control" name="id_log_detail_record_rak_out[]" id="id_log_detail_record_rak_out_${baris}" class="form-control" value="${data['id_log_detail_record_rak_out']}">
    //               </td>
    //               <td>
    //                   <input type="text" class="form-control" name="qty_rak_out[]" id="qty_rak_out_${baris}" class="form-control" value="${qty}" readonly>
    //               </td>
    //               <td>
    //                   <input type="text" class="form-control" name="id_rak_out[]" id="id_rak_out_${baris}" class="form-control" value="${rak}" readonly>
    //               </td>
    //               <td>
    //                   <button type="button" class="btn btn-danger" onclick="delete_detail_rak_out(this, ${baris})">Delete</button>
    //               </td>
    //           </tr>
    //       `);

    //       $('#start_barcode_out').val('');
    //       $('#start_qty_out').val('');
    //       $('#start_rak_out').val('');
    //       $('#loading-modal').modal('hide');
    //     }
    //   }
    // });
  }

  function delete_detail_rak_out(e, baris) {
    // let id_rak_barcode_out = $('#id_rak_barcode_out_' + baris).val();
    let id_rak = $('#id_rak_out_' + baris).val();
    let id_log_detail_record_rak_out = $('#id_log_detail_record_rak_out_' + baris).val();
    let barcode_rak_out = $('#barcode_rak_out_' + baris).val();
    $('#loading-modal').modal('show');
    $.ajax({
      url: '<?= base_url() ?>pasting/delete_rak_out',
      type: 'POST',
      data: {
        // id_rak_barcode_out: id_rak_barcode_out,
        id_rak: id_rak,
        id_log_detail_record_rak_out: id_log_detail_record_rak_out,
        barcode_rak_out: barcode_rak_out,
      },
      dataType: 'json',
      success: function(data) {
        console.log(data)
        $(e).parent().parent().remove();
        $('#loading-modal').modal('hide');
      }
    });
  }

  function add_note(type_grid, actual, id_lhp_pasting, index) {
    let note_pastingElement = document.querySelector('#note_pasting');
    let id_summary_note = document.querySelector('#id_summary_' + index).value;
    let loss_over_value = document.querySelector('#loss_over_' + index).value;
    let note_value = document.querySelector('#note_' + index).value;
    note_pastingElement.innerHTML = `
      <input type="hidden" name="id_lhp_pasting_note" id="id_lhp_pasting_note" value="${id_lhp_pasting}">
      <input type="hidden" name="actual_note" id="actual_note" value="${actual}">
      <input type="hidden" name="type_grid_note" id="type_grid_note" value="${type_grid}">
      <input type="hidden" name="id_summary_note" id="id_summary_note" value="${id_summary_note}">
      <input type="hidden" name="index" id="index" value="${index}">
      <div class="mb-3">
        <label for="loss_over" class="form-label">Loss / Over</label>
        <input type="number" class="form-control" id="loss_over" name="loss_over" value="${loss_over_value}">
      </div>
      <div class="mb-3">
        <label for="text_note" class="form-label">Note</label>
        <textarea class="form-control" id="text_note" rows="3">${note_value}</textarea>
      </div>
    `;
    let add_note_pastingElement = document.querySelector('#add_note_pasting');
    add_note_pastingElement.innerHTML = `
      <button type="button" class="btn btn-primary float-end" onclick="add_note_pasting()" data-bs-dismiss="modal">Tambah</button>
    `;
  }

  function add_note_pasting() {
    let id_lhp_pasting_note = $('#id_lhp_pasting_note').val();
    let actual_note = $('#actual_note').val();
    let type_grid_note = $('#type_grid_note').val();
    let text_note = $('#text_note').val();
    let loss_over = $('#loss_over').val();
    let id_summary_note = $('#id_summary_note').val();
    let index = $('#index').val();
    console.log({id_lhp_pasting_note, actual_note, type_grid_note, text_note});
    $.ajax({
      url: '<?= base_url() ?>pasting/add_note_pasting',
      type: 'POST',
      data: {
        id_lhp_pasting_note: id_lhp_pasting_note,
        type_grid_note: type_grid_note,
        text_note: text_note,
        loss_over: loss_over,
        id_summary_note: id_summary_note,
      },
      dataType: 'json',
      success: function(data) {
        console.log(data)
        document.querySelector('.' + type_grid_note.replace(" ", "")).innerHTML = `
          <td>${type_grid_note}</td>
          <td>${actual_note}</td>
          <td>
            ${loss_over}
          </td>
          <td>
            ${text_note}
            <input type="hidden" class="form-control" name="id_summary" id="id_summary_${index}" value="${data}">
          </td>
          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_note_pasting" onclick="add_note(${type_grid_note}, ${actual_note}, ${text_note}, ${index})">
            Add
          </button></td>
        `;
      }
    });
  }
</script>
<?= $this->endSection(); ?>