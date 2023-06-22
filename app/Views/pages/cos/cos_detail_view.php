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
              <h4>Detail COS</h4>
            </div>
            <div class="box-body">
              <form action="<?=base_url()?>cos/detail_cos/edit" method="post">
                <div class="row">
                  <input type="hidden" name="id" value="<?= $data_lhp_cos[0]['id_lhp_cos']; ?>">
                  <div class="col">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?= $data_lhp_cos[0]['tanggal_produksi']; ?>">
                  </div>
                  <div class="col">
                    <label for="line" class="form-label">Line</label>
                    <select class="form-select" id="line" name="line">
                      <option value="" disabled>-- Pilih Line --</option>
                      <?php
                      for ($j = 1; $j <= 7; $j++) {
                        if ($data_lhp_cos[0]['line'] === $j) { ?>
                          <option selected value="<?= $j ?>"><?= $j ?></option>
                        <?php } else { ?>
                          <option value="<?= $j ?>"><?= $j ?></option>
                      <?php }
                      }
                      ?>
                      <option value="10" <?= ($data_lhp_cos[0]['line'] == 10) ? 'selected':''?>> MCB</option>
                    </select>
                  </div>
                  <div class="col">
                    <label for="shift" class="form-label">Shift</label>
                    <select class="form-select" id="shift" name="shift">
                      <option value="" disabled>-- Pilih Shift --</option>
                      <?php
                      for ($j = 1; $j <= 3; $j++) {
                        if ($data_lhp_cos[0]['shift'] === $j) { ?>
                          <option selected value="<?= $j ?>"><?= $j ?></option>
                        <?php } else { ?>
                          <option value="<?= $j ?>"><?= $j ?></option>
                      <?php }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col">
                    <label for="team" class="form-label">Team</label>
                    <select class="form-select" id="team" name="team">
                      <option value="" disabled>-- Pilih Team --</option>
                      <?php
                      foreach ($data_team as $dt) {
                        if ($data_lhp_cos[0]['team'] === $dt['team']) { ?>
                          <option selected value="<?= $data_lhp_cos[0]['team'] ?>"><?= $data_lhp_cos[0]['team'] ?></option>
                        <?php } else { ?>
                          <option value="<?= $dt['team'] ?>"><?= $dt['team'] ?></option>
                      <?php }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <h2>COS</h2>
                <div class="d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-primary" id="add_form" onclick="add_cos()">Add</button>
                        &nbsp;
                        <button type="button" class="btn btn-danger" id="delete_form" onclick="delete_cos()">Delete</button>
                    </div>
                </div>
                <div class="table-responsive">
                  <table id="" class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th>No WO</th>
                        <th>Type Battery</th>
                        <th>Hasil</th>
                        <th>Tersangkut</th>
                        <th>Terbakar</th>
                        <th>Lug Lepas</th>
                        <th>Strap Tipis</th>
                        <th>Dross 1</th>
                        <th>Dross 2</th>
                        <th>Dross 3</th>
                        <th>Timbangan Strap 1</th>
                        <th>Timbangan Strap 2</th>
                        <th>Timbangan Strap 3</th>
                        <th>Timbangan Strap 4</th>
                      </tr>
                    </thead>
                    <tbody class="form_cos">
                    </tbody>
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
  function data_cos() {
    let baris = 0;
    <?php foreach ($data_detail_lhp_cos as $ddc) { ?>
      baris = document.querySelectorAll('.form').length;
      $('.form_cos').append(`
			<tr class="form" id="form_${baris}">
          <input type="hidden" name="id_detail_cos[]" value="<?= $ddc['id_detail_lhp_cos']; ?>">
          <td>
              <select class="form-select select2" id="no_wo_${baris}" onchange="getPartNo(${baris})" name="no_wo[]" style="width: 200px">
                  <option value="" selected disabled>-- Pilih No WO --</option>
                  <?php
                  $cek_wo = true;
                  foreach ($data_wo as $dw) {
                  ?>
                    <?php if (trim($ddc['no_wo']) === trim($dw['PDNO'])) : ?>
                        <option value="<?= trim($ddc['no_wo']) ?>" selected><?= trim($ddc['no_wo']) ?></option>
                    <?php else : ?>
                        <option value="<?= trim($dw['PDNO']) ?>"><?= trim($dw['PDNO']) ?></option>
                    <?php endif ?>
                  <?php
                  }
                  ?>
              </select>
          </td>
          <td>
              <input type="text" class="form-control" name="type_battery[]" id="type_battery_${baris}" value="<?= $ddc['type_battery'] ?>" style="width: 250px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="hasil[]" id="hasil_${baris}" value="<?= $ddc['hasil'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="tersangkut[]" id="tersangkut_${baris}" value="<?= $ddc['tersangkut'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="terbakar[]" id="terbakar_${baris}" value="<?= $ddc['terbakar'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="lug_lepas[]" id="lug_lepas_${baris}" value="<?= $ddc['lug_lepas'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="strap_tipis[]" id="strap_tipis_${baris}" value="<?= $ddc['strap_tipis'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="dross_1[]" id="dross_1_${baris}" value="<?= $ddc['dross_1'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="dross_2[]" id="dross_2_${baris}" value="<?= $ddc['dross_2'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="dross_3[]" id="dross_3_${baris}" value="<?= $ddc['dross_3'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="timbangan_strap_1[]" id="timbangan_strap_1_${baris}" value="<?= $ddc['timbangan_strap_1'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="timbangan_strap_2[]" id="timbangan_strap_2_${baris}" value="<?= $ddc['timbangan_strap_2'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="timbangan_strap_3[]" id="timbangan_strap_3_${baris}" value="<?= $ddc['timbangan_strap_3'] ?>">
          </td>
          <td>
              <input type="text" class="form-control" name="timbangan_strap_4[]" id="timbangan_strap_4_${baris}" value="<?= $ddc['timbangan_strap_4'] ?>">
          </td>
      </tr>
		`);
    <?php } ?>
    $('.select2').select2();
  }
  data_cos();

  function add_cos() {
      const baris = document.querySelectorAll('.form').length;
      $('.form_cos').append(`
          <tr class="form" id="form_${baris}">
              <input type="hidden" name="id_detail_cos[]" value="">
              <td>
                  <select class="form-select select2" id="no_wo_${baris}" onchange="getPartNo(${baris})" name="no_wo[]" style="width: 200px">
                      <option value="" selected disabled>-- Pilih No WO --</option>
                      <?php
                      $cek_wo = true;
                      foreach ($data_wo as $dw) {
                      ?>
                        <option value="<?= trim($dw['PDNO']) ?>"><?= trim($dw['PDNO']) ?></option>
                      <?php
                      }
                      ?>
                  </select>
              </td>
              <td>
                  <input type="text" class="form-control" name="type_battery[]" id="type_battery_${baris}" value="" style="width: 250px" readonly>
              </td>
              <td>
                  <input type="text" class="form-control" name="hasil[]" id="hasil_${baris}" value"">
              </td>
              <td>
                  <input type="text" class="form-control" name="tersangkut[]" id="tersangkut_${baris}" value="">
              </td>
              <td>
                  <input type="text" class="form-control" name="terbakar[]" id="terbakar_${baris}" value="">
              </td>
              <td>
                  <input type="text" class="form-control" name="lug_lepas[]" id="lug_lepas_${baris}" value="">
              </td>
              <td>
                  <input type="text" class="form-control" name="strap_tipis[]" id="strap_tipis_${baris}" value="">
              </td>
              <td>
                  <input type="text" class="form-control" name="dross_1[]" id="dross_1_${baris}" value="">
              </td>
              <td>
                  <input type="text" class="form-control" name="dross_2[]" id="dross_2_${baris}" value="">
              </td>
              <td>
                  <input type="text" class="form-control" name="dross_3[]" id="dross_3_${baris}" value="">
              </td>
              <td>
                  <input type="text" class="form-control" name="timbangan_strap_1[]" id="timbangan_strap_1_${baris}" value="">
              </td>
              <td>
                  <input type="text" class="form-control" name="timbangan_strap_2[]" id="timbangan_strap_2_${baris}" value="">
              </td>
              <td>
                  <input type="text" class="form-control" name="timbangan_strap_3[]" id="timbangan_strap_3_${baris}" value="">
              </td>
              <td>
                  <input type="text" class="form-control" name="timbangan_strap_4[]" id="timbangan_strap_4_${baris}" value="">
              </td>
          </tr>
      `);
      $('.select2').select2();
  }

  function delete_cos() {
      const baris = document.querySelectorAll('.form');
      const element = document.getElementById('form_' + (baris.length - 1));
      element.parentNode.removeChild(element);
  }

  function getPartNo(i) {
    let no_wo = $('#no_wo_' + i).val();
    console.log(no_wo);
    $.ajax({
      url: '<?= base_url() ?>cos/getPartNo',
      type: 'POST',
      data: {
        no_wo: no_wo
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        $('#type_battery_' + i).val(data[0].MITM.trim());
      }
    });
  }
</script>
<?= $this->endSection(); ?>