<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-12 col-12">
          <div class="box">
            <div class="box-header with-border">
              <h4>Detail Laporan Timbangan Reject</h4>
            </div>
            <div class="box-body">
              <form action="<?=base_url()?>timbangan_reject/detail_timbangan_reject/edit" method="post">
                <div class="row">
                  <input type="hidden" name="id" value="<?= $data_lhp_timbangan_reject[0]['id_lhp_timbangan_reject']; ?>">
                  <div class="col">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?= $data_lhp_timbangan_reject[0]['tanggal']; ?>">
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="" class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th colspan="5" class="text-center">Reject Plate</th>
                      </tr>
                      <tr>
                        <th>Shift</th>
                        <th>Ganti Can</th>
                        <th>Berat Can KG</th>
                        <th>Berat Limbah KG</th>
                        <th>Original KG</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($data_detail_lhp_timbangan_reject)) {
                        foreach ($data_detail_lhp_timbangan_reject as $ddltr) { ?>
                          <tr>
                            <input type="hidden" name="id_detail_lhp_timbangan_reject[]" value="<?= $ddltr['id_detail_lhp_timbangan_reject'] ?>">
                            <input type="hidden" name="shift_plate[]" value="<?= $ddltr['shift_plate'] ?>">
                            <td><?= $ddltr['shift_plate'] ?></td>
                            <td>
                              <?php if($ddltr['shift_plate'] > 1) { ?>
                              <div class="form-check form-check-inline p-0 m-0">
                                <input class="form-check-input" type="radio" name="status_plate_<?= $ddltr['shift_plate'] ?>" id="ganti_plate_<?= $ddltr['shift_plate'] ?>" value="ganti" <?php if($ddltr['status_plate'] === 'ganti') echo 'checked' ?> onclick="status_plate(this.value, <?= $ddltr['shift_plate'] ?>)">
                                <label class="form-check-label" for="ganti_plate_<?= $ddltr['shift_plate'] ?>">Ganti</label>
                              </div>
                              <div class="form-check form-check-inline p-0 m-0">
                                <input class="form-check-input" type="radio" name="status_plate_<?= $ddltr['shift_plate'] ?>" id="tidak_plate_<?= $ddltr['shift_plate'] ?>" value="tidak" <?php if($ddltr['status_plate'] === 'tidak') echo 'checked' ?> onclick="status_plate(this.value, <?= $ddltr['shift_plate'] ?>)">
                                <label class="form-check-label" for="tidak_plate_<?= $ddltr['shift_plate'] ?>">Tidak</label>
                              </div>
                              <?php } else { ?>
                                <input type="hidden" name="status_plate_<?= $ddltr['shift_plate'] ?>" value="ganti">
                              <?php } ?>
                            </td>
                            <td>
                              <!-- <label for="berat_can" class="form-label">Berat Can KG</label> -->
                              <input type="text" class="form-control" id="berat_can_plate_<?= $ddltr['shift_plate'] ?>" name="berat_can_plate[]" value="<?= $ddltr['berat_can_plate'] ?>" onkeyup="original_plate(<?= $ddltr['shift_plate'] ?>)">
                            </td>
                            <td>
                              <!-- <label for="berat_limbah" class="form-label">Berat Limbah KG</label> -->
                              <input type="text" class="form-control" id="berat_limbah_plate_<?= $ddltr['shift_plate'] ?>" name="berat_limbah_plate[]" value="<?= $ddltr['berat_limbah_plate'] ?>" onkeyup="original_plate(<?= $ddltr['shift_plate'] ?>)">
                            </td>
                            <td>
                              <!-- <label for="original" class="form-label">Original KG</label> -->
                              <input type="text" class="form-control" id="original_plate_<?= $ddltr['shift_plate'] ?>" name="original_plate[]" value="<?= $ddltr['original_plate'] ?>" readonly>
                            </td>
                          </tr>
                      <?php } } else { ?>
                      <?php for($i = 1; $i <= 3; $i++) { ?>
                        <tr>
                          <input type="hidden" name="id_detail_lhp_timbangan_reject[]" value="">
                          <input type="hidden" name="shift_plate[]" value="<?= $i ?>">
                          <td><?= $i ?></td>
                          <td>
                            <?php if($i > 1) { ?>
                            <div class="form-check form-check-inline p-0 m-0">
                              <input class="form-check-input" type="radio" name="status_plate_<?= $i ?>" id="ganti_plate_<?= $i ?>" value="ganti" onclick="status_plate(this.value, <?= $i ?>)">
                              <label class="form-check-label" for="ganti_plate_<?= $i ?>">Ganti</label>
                            </div>
                            <div class="form-check form-check-inline p-0 m-0">
                              <input class="form-check-input" type="radio" name="status_plate_<?= $i ?>" id="tidak_plate_<?= $i ?>" value="tidak" checked onclick="status_plate(this.value, <?= $i ?>)">
                              <label class="form-check-label" for="tidak_plate_<?= $i ?>">Tidak</label>
                            </div>
                            <?php } else { ?>
                              <input type="hidden" name="status_plate_<?= $i ?>" value="ganti">
                            <?php } ?>
                          </td>
                          <td>
                            <!-- <label for="berat_can" class="form-label">Berat Can KG</label> -->
                            <input type="text" class="form-control" id="berat_can_plate_<?= $i ?>" name="berat_can_plate[]" onkeyup="original_plate(<?= $i ?>)">
                          </td>
                          <td>
                            <!-- <label for="berat_limbah" class="form-label">Berat Limbah KG</label> -->
                            <input type="text" class="form-control" id="berat_limbah_plate_<?= $i ?>" name="berat_limbah_plate[]" onkeyup="original_plate(<?= $i ?>)">
                          </td>
                          <td>
                            <!-- <label for="original" class="form-label">Original KG</label> -->
                            <input type="text" class="form-control" id="original_plate_<?= $i ?>" name="original_plate[]" readonly>
                          </td>
                        </tr>
                      <?php } ?>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4" class="text-end fw-bold">Total</td>
                        <td>
                          <input type="text" class="form-control" id="total_plate" name="total_plate" value="<?php if($data_lhp_timbangan_reject[0]['total_plate'] !== NULL) echo $data_lhp_timbangan_reject[0]['total_plate'] ?>" readonly>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="table-responsive">
                  <table id="" class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th colspan="5" class="text-center">Reject Battery</th>
                      </tr>
                      <tr>
                        <th>Shift</th>
                        <th>Ganti Can</th>
                        <th>Berat Can KG</th>
                        <th>Berat Limbah KG</th>
                        <th>Original KG</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($data_detail_lhp_timbangan_reject)) {
                        foreach ($data_detail_lhp_timbangan_reject as $ddltr) { ?>
                          <tr>
                            <input type="hidden" name="shift_battery[]" value="<?= $ddltr['shift_battery'] ?>">
                            <td><?= $ddltr['shift_battery'] ?></td>
                            <td>
                              <?php if($ddltr['shift_battery'] > 1) { ?>
                              <div class="form-check form-check-inline p-0 m-0">
                                <input class="form-check-input" type="radio" name="status_battery_<?= $ddltr['shift_battery'] ?>" id="ganti_battery_<?= $ddltr['shift_battery'] ?>" value="ganti" <?php if($ddltr['status_battery'] === 'ganti') echo 'checked' ?> onclick="status_battery(this.value, <?= $ddltr['shift_battery'] ?>)">
                                <label class="form-check-label" for="ganti_battery_<?= $ddltr['shift_battery'] ?>">Ganti</label>
                              </div>
                              <div class="form-check form-check-inline p-0 m-0">
                                <input class="form-check-input" type="radio" name="status_battery_<?= $ddltr['shift_battery'] ?>" id="tidak_battery_<?= $ddltr['shift_battery'] ?>" value="tidak" <?php if($ddltr['status_battery'] === 'tidak') echo 'checked' ?> onclick="status_battery(this.value, <?= $ddltr['shift_battery'] ?>)">
                                <label class="form-check-label" for="tidak_battery_<?= $ddltr['shift_battery'] ?>">Tidak</label>
                              </div>
                              <?php } else { ?>
                                <input type="hidden" name="status_battery_<?= $ddltr['shift_battery'] ?>" value="ganti">
                              <?php } ?>
                            </td>
                            <td>
                              <!-- <label for="berat_can" class="form-label">Berat Can KG</label> -->
                              <input type="text" class="form-control" id="berat_can_battery_<?= $ddltr['shift_battery'] ?>" name="berat_can_battery[]" value="<?= $ddltr['berat_can_battery'] ?>" onkeyup="original_battery(<?= $ddltr['shift_battery'] ?>)">
                            </td>
                            <td>
                              <!-- <label for="berat_limbah" class="form-label">Berat Limbah KG</label> -->
                              <input type="text" class="form-control" id="berat_limbah_battery_<?= $ddltr['shift_battery'] ?>" name="berat_limbah_battery[]" value="<?= $ddltr['berat_limbah_battery'] ?>" onkeyup="original_battery(<?= $ddltr['shift_battery'] ?>)">
                            </td>
                            <td>
                              <!-- <label for="original" class="form-label">Original KG</label> -->
                              <input type="text" class="form-control" id="original_battery_<?= $ddltr['shift_battery'] ?>" name="original_battery[]" value="<?= $ddltr['original_battery'] ?>" readonly>
                            </td>
                          </tr>
                      <?php } } else { ?>
                      <?php for($i = 1; $i <= 3; $i++) { ?>
                        <tr>
                          <input type="hidden" name="shift_battery[]" value="<?= $i ?>">
                          <td><?= $i ?></td>
                          <td>
                            <?php if($i > 1) { ?>
                            <div class="form-check form-check-inline p-0 m-0">
                              <input class="form-check-input" type="radio" name="status_battery_<?= $i ?>" id="ganti_battery_<?= $i ?>" value="ganti" onclick="status_battery(this.value, <?= $i ?>)">
                              <label class="form-check-label" for="ganti_battery_<?= $i ?>">Ganti</label>
                            </div>
                            <div class="form-check form-check-inline p-0 m-0">
                              <input class="form-check-input" type="radio" name="status_battery_<?= $i ?>" id="tidak_battery_<?= $i ?>" value="tidak" checked onclick="status_battery(this.value, <?= $i ?>)">
                              <label class="form-check-label" for="tidak_battery_<?= $i ?>">Tidak</label>
                            </div>
                            <?php } else { ?>
                              <input type="hidden" name="status_battery_<?= $i ?>" value="ganti">
                            <?php } ?>
                          </td>
                          <td>
                            <!-- <label for="berat_can" class="form-label">Berat Can KG</label> -->
                            <input type="text" class="form-control" id="berat_can_battery_<?= $i ?>" name="berat_can_battery[]" onkeyup="original_battery(<?= $i ?>)">
                          </td>
                          <td>
                            <!-- <label for="berat_limbah" class="form-label">Berat Limbah KG</label> -->
                            <input type="text" class="form-control" id="berat_limbah_battery_<?= $i ?>" name="berat_limbah_battery[]" onkeyup="original_battery(<?= $i ?>)">
                          </td>
                          <td>
                            <!-- <label for="original" class="form-label">Original KG</label> -->
                            <input type="text" class="form-control" id="original_battery_<?= $i ?>" name="original_battery[]" readonly>
                          </td>
                        </tr>
                      <?php } ?>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4" class="text-end fw-bold">Total</td>
                        <td>
                          <input type="text" class="form-control" id="total_battery" name="total_battery" value="<?php if($data_lhp_timbangan_reject[0]['total_battery'] !== NULL) echo $data_lhp_timbangan_reject[0]['total_battery'] ?>" readonly>
                        </td>
                      </tr>
                    </tfoot>
                  </table>

                </div>
                <!-- <div class="text-center my-2 button">
                  <?php //if ($data_lhp_cos[0]['status'] === 'pending') : ?>
                    <button type="button" class="btn btn-danger" onclick="reject_button()">Reject</button>
                    <button type="button" class="btn btn-warning" onclick="edit_button()">Edit</button>
                    <button type="button" class="btn btn-success" onclick="approve_button()">Approve</button>
                  <?php //else : ?>
                    <a href="/platecutting" class="btn btn-primary">Back</a>
                  <?php //endif ?> -->
                  <div class="text-center my-2">
                    <button type="submit" class="btn btn-primary" id="submit-form" style="width: 200px">Save</button>
                  </div>
                </div>
              </form>
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
  let value_status_plate = ['', 'ganti', 'tidak', 'tidak'];
  let value_status_battery = ['', 'ganti', 'tidak', 'tidak'];
  function status_plate(e, i) {
    value_status_plate[i] = e;
    let status = value_status_plate[i];
    let previous_status = '';
    let berat_limbah = 0;
    let berat_can = 0;
    let original = 0;
    if(i === 1) {
      berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
      berat_can = parseFloat($('#berat_can_plate_' + i).val());
      original = berat_limbah - berat_can;
    } else if(i === 2) {
      if(status === 'tidak') {
        berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 1)).val());
        berat_can = parseFloat($('#berat_can_plate_' + (i - 1)).val());
        original = berat_limbah - berat_can;
        berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
        berat_can = parseFloat($('#berat_can_plate_' + i).val());
        original = berat_limbah - berat_can - original;
      } else {
        berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
        berat_can = parseFloat($('#berat_can_plate_' + i).val());
        original = berat_limbah - berat_can;
      }
    } else {
      if(status === 'tidak') {
        previous_status = value_status_plate[i-1];
        if(previous_status === 'tidak') {
          berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 2)).val());
          berat_can = parseFloat($('#berat_can_plate_' + (i - 2)).val());
          let temp = berat_limbah - berat_can;
          berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 1)).val());
          berat_can = parseFloat($('#berat_can_plate_' + (i - 1)).val());
          original = berat_limbah - berat_can - temp;
          berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
          berat_can = parseFloat($('#berat_can_plate_' + i).val());
          original = berat_limbah - berat_can - original - temp;
        } else {
          berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 1)).val());
          berat_can = parseFloat($('#berat_can_plate_' + (i - 1)).val());
          original = berat_limbah - berat_can - original;
          berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
          berat_can = parseFloat($('#berat_can_plate_' + i).val());
          original = berat_limbah - berat_can - original;
        }
      } else {
        berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
        berat_can = parseFloat($('#berat_can_plate_' + i).val());
        original = berat_limbah - berat_can - original;
      }
    }
    // if(status === 'tidak') {
    //   if(i > 2) {
    //     berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 2)).val());
    //     berat_can = parseFloat($('#berat_can_plate_' + (i - 2)).val());
    //     original = berat_limbah - berat_can;
    //   }
    //   if(i > 1) {
    //     previous_status = value_status_plate[i-1];
    //     if(previous_status === 'tidak') {
    //       berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 1)).val());
    //       berat_can = parseFloat($('#berat_can_plate_' + (i - 1)).val());
    //       original = berat_limbah - berat_can - original;
    //     } else {
    //       berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 1)).val());
    //       berat_can = parseFloat($('#berat_can_plate_' + (i - 1)).val());
    //       original = berat_limbah - berat_can;
    //     }
    //   }
    //   if(i > 0) {
    //     if(previous_status === 'tidak') {
    //       berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
    //       berat_can = parseFloat($('#berat_can_plate_' + i).val());
    //       original = berat_limbah - berat_can - original;
    //     } else {
    //       berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
    //       berat_can = parseFloat($('#berat_can_plate_' + i).val());
    //       original = berat_limbah - berat_can;
    //     }
    //   }
    // } else {
    //   berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
    //   berat_can = parseFloat($('#berat_can_plate_' + i).val());
    //   original = berat_limbah - berat_can;
    // }
    $('#original_plate_' + i).val(original);
    let total_plate = parseFloat($('#original_plate_1').val() == '' ? 0 : $('#original_plate_1').val()) + parseFloat($('#original_plate_2').val() == '' ? 0 : $('#original_plate_2').val()) + parseFloat($('#original_plate_3').val() == '' ? 0 : $('#original_plate_3').val());
    $('#total_plate').val(total_plate);
    return value_status_plate[i];
  }

  function status_battery(e, i) {
    value_status_battery[i] = e;
    let status = value_status_battery[i];
    let previous_status = '';
    let berat_limbah = 0;
    let berat_can = 0;
    let original = 0;
    if(i === 1) {
      berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
      berat_can = parseFloat($('#berat_can_battery_' + i).val());
      original = berat_limbah - berat_can;
    } else if(i === 2) {
      if(status === 'tidak') {
        berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 1)).val());
        berat_can = parseFloat($('#berat_can_battery_' + (i - 1)).val());
        original = berat_limbah - berat_can;
        berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
        berat_can = parseFloat($('#berat_can_battery_' + i).val());
        original = berat_limbah - berat_can - original;
      } else {
        berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
        berat_can = parseFloat($('#berat_can_battery_' + i).val());
        original = berat_limbah - berat_can;
      }
    } else {
      if(status === 'tidak') {
        previous_status = value_status_battery[i-1];
        if(previous_status === 'tidak') {
          berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 2)).val());
          berat_can = parseFloat($('#berat_can_battery_' + (i - 2)).val());
          let temp = berat_limbah - berat_can;
          berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 1)).val());
          berat_can = parseFloat($('#berat_can_battery_' + (i - 1)).val());
          original = berat_limbah - berat_can - temp;
          berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
          berat_can = parseFloat($('#berat_can_battery_' + i).val());
          original = berat_limbah - berat_can - original - temp;
        } else {
          berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 1)).val());
          berat_can = parseFloat($('#berat_can_battery_' + (i - 1)).val());
          original = berat_limbah - berat_can - original;
          berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
          berat_can = parseFloat($('#berat_can_battery_' + i).val());
          original = berat_limbah - berat_can - original;
        }
      } else {
        berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
        berat_can = parseFloat($('#berat_can_battery_' + i).val());
        original = berat_limbah - berat_can - original;
      }
    }
    // if(status === 'tidak') {
    //   if(i > 2) {
    //     berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 2)).val());
    //     berat_can = parseFloat($('#berat_can_battery_' + (i - 2)).val());
    //     original = berat_limbah - berat_can;
    //   }
    //   if(i > 1) {
    //     previous_status = value_status_battery[i-1];
    //     if(previous_status === 'tidak') {
    //       berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 1)).val());
    //       berat_can = parseFloat($('#berat_can_battery_' + (i - 1)).val());
    //       original = berat_limbah - berat_can - original;
    //     } else {
    //       berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 1)).val());
    //       berat_can = parseFloat($('#berat_can_battery_' + (i - 1)).val());
    //       original = berat_limbah - berat_can;
    //     }
    //   }
    //   if(i > 0) {
    //     if(previous_status === 'tidak') {
    //       berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
    //       berat_can = parseFloat($('#berat_can_battery_' + i).val());
    //       original = berat_limbah - berat_can - original;
    //     } else {
    //       berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
    //       berat_can = parseFloat($('#berat_can_battery_' + i).val());
    //       original = berat_limbah - berat_can;
    //     }
    //   }
    // } else {
    //   berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
    //   berat_can = parseFloat($('#berat_can_battery_' + i).val());
    //   original = berat_limbah - berat_can;
    // }
    $('#original_battery_' + i).val(original);
    let total_battery = parseFloat($('#original_battery_1').val() == '' ? 0 : $('#original_battery_1').val()) + parseFloat($('#original_battery_2').val() == '' ? 0 : $('#original_battery_2').val()) + parseFloat($('#original_battery_3').val() == '' ? 0 : $('#original_battery_3').val());
    $('#total_battery').val(total_battery);
    return value_status_battery[i];
  }

  function original_battery(i) {
    let status = value_status_battery[i];
    let previous_status = '';
    let berat_limbah = 0;
    let berat_can = 0;
    let original = 0;
    if(i === 1) {
      berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
      berat_can = parseFloat($('#berat_can_battery_' + i).val());
      original = berat_limbah - berat_can;
    } else if(i === 2) {
      if(status === 'tidak') {
        berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 1)).val());
        berat_can = parseFloat($('#berat_can_battery_' + (i - 1)).val());
        original = berat_limbah - berat_can;
        berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
        berat_can = parseFloat($('#berat_can_battery_' + i).val());
        original = berat_limbah - berat_can - original;
      } else {
        berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
        berat_can = parseFloat($('#berat_can_battery_' + i).val());
        original = berat_limbah - berat_can;
      }
    } else {
      if(status === 'tidak') {
        previous_status = value_status_battery[i-1];
        if(previous_status === 'tidak') {
          berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 2)).val());
          berat_can = parseFloat($('#berat_can_battery_' + (i - 2)).val());
          let temp = berat_limbah - berat_can;
          berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 1)).val());
          berat_can = parseFloat($('#berat_can_battery_' + (i - 1)).val());
          original = berat_limbah - berat_can - temp;
          berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
          berat_can = parseFloat($('#berat_can_battery_' + i).val());
          original = berat_limbah - berat_can - original - temp;
        } else {
          berat_limbah = parseFloat($('#berat_limbah_battery_' + (i - 1)).val());
          berat_can = parseFloat($('#berat_can_battery_' + (i - 1)).val());
          original = berat_limbah - berat_can - original;
          berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
          berat_can = parseFloat($('#berat_can_battery_' + i).val());
          original = berat_limbah - berat_can - original;
        }
      } else {
        berat_limbah = parseFloat($('#berat_limbah_battery_' + i).val());
        berat_can = parseFloat($('#berat_can_battery_' + i).val());
        original = berat_limbah - berat_can - original;
      }
    }
    $('#original_battery_' + i).val(original);
    let total_battery = parseFloat($('#original_battery_1').val() == '' ? 0 : $('#original_battery_1').val()) + parseFloat($('#original_battery_2').val() == '' ? 0 : $('#original_battery_2').val()) + parseFloat($('#original_battery_3').val() == '' ? 0 : $('#original_battery_3').val());
    $('#total_battery').val(total_battery);
  }

  function original_plate(i) {
    let status = value_status_plate[i];
    let previous_status = '';
    let berat_limbah = 0;
    let berat_can = 0;
    let original = 0;
    if(i === 1) {
      berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
      berat_can = parseFloat($('#berat_can_plate_' + i).val());
      original = berat_limbah - berat_can;
    } else if(i === 2) {
      if(status === 'tidak') {
        berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 1)).val());
        berat_can = parseFloat($('#berat_can_plate_' + (i - 1)).val());
        original = berat_limbah - berat_can;
        berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
        berat_can = parseFloat($('#berat_can_plate_' + i).val());
        original = berat_limbah - berat_can - original;
      } else {
        berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
        berat_can = parseFloat($('#berat_can_plate_' + i).val());
        original = berat_limbah - berat_can;
      }
    } else {
      if(status === 'tidak') {
        previous_status = value_status_plate[i-1];
        if(previous_status === 'tidak') {
          berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 2)).val());
          berat_can = parseFloat($('#berat_can_plate_' + (i - 2)).val());
          let temp = berat_limbah - berat_can;
          berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 1)).val());
          berat_can = parseFloat($('#berat_can_plate_' + (i - 1)).val());
          original = berat_limbah - berat_can - temp;
          berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
          berat_can = parseFloat($('#berat_can_plate_' + i).val());
          original = berat_limbah - berat_can - original - temp;
        } else {
          berat_limbah = parseFloat($('#berat_limbah_plate_' + (i - 1)).val());
          berat_can = parseFloat($('#berat_can_plate_' + (i - 1)).val());
          original = berat_limbah - berat_can - original;
          berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
          berat_can = parseFloat($('#berat_can_plate_' + i).val());
          original = berat_limbah - berat_can - original;
        }
      } else {
        berat_limbah = parseFloat($('#berat_limbah_plate_' + i).val());
        berat_can = parseFloat($('#berat_can_plate_' + i).val());
        original = berat_limbah - berat_can - original;
      }
    }
    $('#original_plate_' + i).val(original);
    let total_plate = parseFloat($('#original_plate_1').val() == '' ? 0 : $('#original_plate_1').val()) + parseFloat($('#original_plate_2').val() == '' ? 0 : $('#original_plate_2').val()) + parseFloat($('#original_plate_3').val() == '' ? 0 : $('#original_plate_3').val());
    $('#total_plate').val(total_plate);
  }
</script>
<?= $this->endSection(); ?>