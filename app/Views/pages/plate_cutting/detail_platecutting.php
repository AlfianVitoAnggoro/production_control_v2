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
              <h4>Detail Plate Cutting</h4>
            </div>
            <div class="box-body">
              <form action="/lhp/platecutting/detail_platecutting/edit" method="post">
                <div class="row">
                  <input type="hidden" name="id_platecutting" value="<?= trim($platecutting['id']); ?>">
                  <div class="col">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="date_0" name="date" value="<?= $platecutting['date']; ?>" required readonly>
                  </div>
                  <div class="col">
                    <label for="line" class="form-label">Line</label>
                    <select class="form-control" id="line_0" name="line" required disabled>
                      <option value="" disabled>-- Pilih Line --</option>
                      <?php
                      for ($j = 1; $j <= 3; $j++) {
                        if ($platecutting['line'] === $j) { ?>
                          <option selected value="<?= $j ?>"><?= $j ?></option>
                        <?php } else { ?>
                          <option value="<?= $j ?>"><?= $j ?></option>
                      <?php }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col">
                    <label for="shift" class="form-label">Shift</label>
                    <select class="form-control" id="shift_0" name="shift" required disabled>
                      <option value="" disabled>-- Pilih Shift --</option>
                      <?php
                      for ($j = 1; $j <= 3; $j++) {
                        if ($platecutting['shift'] === $j) { ?>
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
                    <select class="form-control" id="team_0" name="team" required disabled>
                      <option value="" disabled>-- Pilih Team --</option>
                      <?php
                      foreach ($team as $t) {
                        if ($platecutting['shift'] === $t['team']) { ?>
                          <option selected value="<?= $platecutting['team'] ?>"><?= $platecutting['team'] ?></option>
                        <?php } else { ?>
                          <option value="<?= $t['team'] ?>"><?= $t['team'] ?></option>
                      <?php }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <h1>Plate Cutting</h1>
                <div class="table-responsive">
                  <table id="" class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th colspan="3"></th>
                        <th colspan="10" class="text-center">Jumlah NG (Kilogram)</th>
                        <th colspan="10" class="text-center">Jumlah NG (Panel)</th>
                        <th colspan="3"></th>
                      </tr>
                      <tr>
                        <th colspan="3"></th>
                        <th colspan="3" class="text-center bg-primary">Internal</th>
                        <th colspan="7" class="text-center bg-info">Eksternal</th>
                        <th colspan="3" class="text-center bg-primary">Internal</th>
                        <th colspan="7" class="text-center bg-info">Eksternal</th>
                        <th colspan="3"></th>
                      </tr>
                      <tr>
                        <th>No</th>
                        <th>Plate</th>
                        <th>Hasil Produksi</th>
                        <th>Terpotong</th>
                        <th>Tersangkut</th>
                        <th>Overbrush</th>
                        <th>Rontok</th>
                        <th>Lug Patah</th>
                        <th>Patah Kaki</th>
                        <th>Patah Frame</th>
                        <th>Bolong</th>
                        <th>Bending</th>
                        <th>Lengket Terpotong</th>
                        <th>Terpotong</th>
                        <th>Tersangkut</th>
                        <th>Overbrush</th>
                        <th>Rontok</th>
                        <th>Lug Patah</th>
                        <th>Patah Kaki</th>
                        <th>Patah Frame</th>
                        <th>Bolong</th>
                        <th>Bending</th>
                        <th>Lengket Terpotong</th>
                        <th>% Reject Internal</th>
                        <th>% Reject Eksternal</th>
                        <th>% Akumulatif</th>
                      </tr>
                    </thead>
                    <tbody class="form_platecutting_pos">
                    </tbody>
                  </table>
                </div>
                <div class="table-responsive">
                  <table id="" class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th colspan="3"></th>
                        <th colspan="10" class="text-center">Jumlah NG (Kilogram)</th>
                        <th colspan="10" class="text-center">Jumlah NG (Panel)</th>
                        <th colspan="3"></th>
                      </tr>
                      <tr>
                        <th colspan="3"></th>
                        <th colspan="3" class="text-center bg-primary">Internal</th>
                        <th colspan="7" class="text-center bg-info">Eksternal</th>
                        <th colspan="3" class="text-center bg-primary">Internal</th>
                        <th colspan="7" class="text-center bg-info">Eksternal</th>
                        <th colspan="3"></th>
                      </tr>
                      <tr>
                        <th>No</th>
                        <th>Plate</th>
                        <th>Hasil Produksi</th>
                        <th>Terpotong</th>
                        <th>Tersangkut</th>
                        <th>Overbrush</th>
                        <th>Rontok</th>
                        <th>Lug Patah</th>
                        <th>Patah Kaki</th>
                        <th>Patah Frame</th>
                        <th>Bolong</th>
                        <th>Bending</th>
                        <th>Lengket Terpotong</th>
                        <th>Terpotong</th>
                        <th>Tersangkut</th>
                        <th>Overbrush</th>
                        <th>Rontok</th>
                        <th>Lug Patah</th>
                        <th>Patah Kaki</th>
                        <th>Patah Frame</th>
                        <th>Bolong</th>
                        <th>Bending</th>
                        <th>Lengket Terpotong</th>
                        <th>% Reject Internal</th>
                        <th>% Reject Eksternal</th>
                        <th>% Akumulatif</th>
                      </tr>
                    </thead>
                    <tbody class="form_platecutting_neg">
                    </tbody>
                  </table>
                </div>
                <div class="text-center my-2 button">
                  <button type="button" class="btn btn-danger" onclick="reject_button()">Reject</button>
                  <button type="button" class="btn btn-warning" onclick="edit_button()">Edit</button>
                  <button type="button" class="btn btn-success" onclick="approve_button()">Approve</button>
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
  function panel_pos(baris) {
    const plate = $('#plate_' + baris + '_pos').val();
    let terpotong_panel = 0;
    let tersangkut_panel = 0;
    let overbrush_panel = 0;
    let rontok_panel = 0;
    let lug_patah_panel = 0;
    let patah_kaki_panel = 0;
    let patah_frame_panel = 0;
    let bolong_panel = 0;
    let bending_panel = 0;
    let lengket_terpotong_panel = 0;
    let terpotong_kg = $('#terpotong_kg_' + baris + '_pos').val() ? parseFloat($('#terpotong_kg_' + baris + '_pos').val()) : 0;
    let tersangkut_kg = $('#tersangkut_kg_' + baris + '_pos').val() ? parseFloat($('#tersangkut_kg_' + baris + '_pos').val()) : 0;
    let overbrush_kg = $('#overbrush_kg_' + baris + '_pos').val() ? parseFloat($('#overbrush_kg_' + baris + '_pos').val()) : 0;
    let rontok_kg = $('#rontok_kg_' + baris + '_pos').val() ? parseFloat($('#rontok_kg_' + baris + '_pos').val()) : 0;
    let lug_patah_kg = $('#lug_patah_kg_' + baris + '_pos').val() ? parseFloat($('#lug_patah_kg_' + baris + '_pos').val()) : 0;
    let patah_kaki_kg = $('#patah_kaki_kg_' + baris + '_pos').val() ? parseFloat($('#patah_kaki_kg_' + baris + '_pos').val()) : 0;
    let patah_frame_kg = $('#patah_frame_kg_' + baris + '_pos').val() ? parseFloat($('#patah_frame_kg_' + baris + '_pos').val()) : 0;
    let bolong_kg = $('#bolong_kg_' + baris + '_pos').val() ? parseFloat($('#bolong_kg_' + baris + '_pos').val()) : 0;
    let bending_kg = $('#bending_kg_' + baris + '_pos').val() ? parseFloat($('#bending_kg_' + baris + '_pos').val()) : 0;
    let lengket_terpotong_kg = $('#lengket_terpotong_kg_' + baris + '_pos').val() ? parseFloat($('#lengket_terpotong_kg_' + baris + '_pos').val()) : 0;
    if (terpotong_kg !== 0 || tersangkut_kg !== 0 || overbrush_kg !== 0 || rontok_kg !== 0 || lug_patah_kg !== 0 || patah_kaki_kg !== 0 || patah_frame_kg !== 0 || bolong_kg !== 0 || bending_kg !== 0 || lengket_terpotong_kg !== 0) {
      <?php foreach ($plate as $p) : ?>
        if ($('#plate_' + baris + '_pos').val() === "<?= trim($p['plate']) ?>") {
          terpotong_panel = (terpotong_kg / <?= $p['berat'] ?>) * (110 / 100);
          tersangkut_panel = (tersangkut_kg / <?= $p['berat'] ?>) * (110 / 100);
          overbrush_panel = (overbrush_kg / <?= $p['berat'] ?>) * (110 / 100);
          rontok_panel = (rontok_kg / <?= $p['berat'] ?>) * (110 / 100);
          lug_patah_panel = (lug_patah_kg / <?= $p['berat'] ?>) * (110 / 100);
          patah_kaki_panel = (patah_kaki_kg / <?= $p['berat'] ?>) * (110 / 100);
          patah_frame_panel = (patah_frame_kg / <?= $p['berat'] ?>) * (110 / 100);
          bolong_panel = (bolong_kg / <?= $p['berat'] ?>) * (110 / 100);
          bending_panel = (bending_kg / <?= $p['berat'] ?>) * (110 / 100);
          lengket_terpotong_panel = (lengket_terpotong_kg / <?= $p['berat'] ?>) * (110 / 100);
        }
      <?php endforeach ?>
    }
    $('#terpotong_panel_' + baris + '_pos').val(Math.ceil(terpotong_panel));
    $('#tersangkut_panel_' + baris + '_pos').val(Math.ceil(tersangkut_panel));
    $('#overbrush_panel_' + baris + '_pos').val(Math.ceil(overbrush_panel));
    $('#rontok_panel_' + baris + '_pos').val(Math.ceil(rontok_panel));
    $('#lug_patah_panel_' + baris + '_pos').val(Math.ceil(lug_patah_panel));
    $('#patah_kaki_panel_' + baris + '_pos').val(Math.ceil(patah_kaki_panel));
    $('#patah_frame_panel_' + baris + '_pos').val(Math.ceil(patah_frame_panel));
    $('#bolong_panel_' + baris + '_pos').val(Math.ceil(bolong_panel));
    $('#bending_panel_' + baris + '_pos').val(Math.ceil(bending_panel));
    $('#lengket_terpotong_panel_' + baris + '_pos').val(Math.ceil(lengket_terpotong_panel));
    $('#persentase_reject_internal_' + baris + '_pos').val((100 * (Math.ceil(terpotong_panel) + Math.ceil(tersangkut_panel) + Math.ceil(overbrush_panel)) / $('#hasil_produksi_' + baris + '_pos').val()).toPrecision(3) + '%');
    $('#persentase_reject_eksternal_' + baris + '_pos').val((100 * (Math.ceil(rontok_panel) + Math.ceil(lug_patah_panel) + Math.ceil(patah_kaki_panel) + Math.ceil(patah_frame_panel) + Math.ceil(bolong_panel) + Math.ceil(bending_panel) + Math.ceil(lengket_terpotong_panel)) / $('#hasil_produksi_' + baris + '_pos').val()).toPrecision(3) + '%');
    $('#persentase_reject_akumulatif_' + baris + '_pos').val((100 * (Math.ceil(terpotong_panel) + Math.ceil(tersangkut_panel) + Math.ceil(overbrush_panel) + Math.ceil(rontok_panel) + Math.ceil(lug_patah_panel) + Math.ceil(patah_kaki_panel) + Math.ceil(patah_frame_panel) + Math.ceil(bolong_panel) + Math.ceil(bending_panel) + Math.ceil(lengket_terpotong_panel)) / $('#hasil_produksi_' + baris + '_pos').val()).toPrecision(3) + '%');
  }

  function panel_neg(baris) {
    const plate = $('#plate_' + baris + '_neg').val();
    let terpotong_panel = 0;
    let tersangkut_panel = 0;
    let overbrush_panel = 0;
    let rontok_panel = 0;
    let lug_patah_panel = 0;
    let patah_kaki_panel = 0;
    let patah_frame_panel = 0;
    let bolong_panel = 0;
    let bending_panel = 0;
    let lengket_terpotong_panel = 0;
    let terpotong_kg = $('#terpotong_kg_' + baris + '_neg').val() ? parseFloat($('#terpotong_kg_' + baris + '_neg').val()) : 0;
    let tersangkut_kg = $('#tersangkut_kg_' + baris + '_neg').val() ? parseFloat($('#tersangkut_kg_' + baris + '_neg').val()) : 0;
    let overbrush_kg = $('#overbrush_kg_' + baris + '_neg').val() ? parseFloat($('#overbrush_kg_' + baris + '_neg').val()) : 0;
    let rontok_kg = $('#rontok_kg_' + baris + '_neg').val() ? parseFloat($('#rontok_kg_' + baris + '_neg').val()) : 0;
    let lug_patah_kg = $('#lug_patah_kg_' + baris + '_neg').val() ? parseFloat($('#lug_patah_kg_' + baris + '_neg').val()) : 0;
    let patah_kaki_kg = $('#patah_kaki_kg_' + baris + '_neg').val() ? parseFloat($('#patah_kaki_kg_' + baris + '_neg').val()) : 0;
    let patah_frame_kg = $('#patah_frame_kg_' + baris + '_neg').val() ? parseFloat($('#patah_frame_kg_' + baris + '_neg').val()) : 0;
    let bolong_kg = $('#bolong_kg_' + baris + '_neg').val() ? parseFloat($('#bolong_kg_' + baris + '_neg').val()) : 0;
    let bending_kg = $('#bending_kg_' + baris + '_neg').val() ? parseFloat($('#bending_kg_' + baris + '_neg').val()) : 0;
    let lengket_terpotong_kg = $('#lengket_terpotong_kg_' + baris + '_neg').val() ? parseFloat($('#lengket_terpotong_kg_' + baris + '_neg').val()) : 0;
    if (terpotong_kg !== 0 || tersangkut_kg !== 0 || overbrush_kg !== 0 || rontok_kg !== 0 || lug_patah_kg !== 0 || patah_kaki_kg !== 0 || patah_frame_kg !== 0 || bolong_kg !== 0 || bending_kg !== 0 || lengket_terpotong_kg !== 0) {
      <?php foreach ($plate as $p) : ?>
        if ($('#plate_' + baris + '_neg').val() === "<?= trim($p['plate']) ?>") {
          terpotong_panel = (terpotong_kg / <?= $p['berat'] ?>) * (110 / 100);
          tersangkut_panel = (tersangkut_kg / <?= $p['berat'] ?>) * (110 / 100);
          overbrush_panel = (overbrush_kg / <?= $p['berat'] ?>) * (110 / 100);
          rontok_panel = (rontok_kg / <?= $p['berat'] ?>) * (110 / 100);
          lug_patah_panel = (lug_patah_kg / <?= $p['berat'] ?>) * (110 / 100);
          patah_kaki_panel = (patah_kaki_kg / <?= $p['berat'] ?>) * (110 / 100);
          patah_frame_panel = (patah_frame_kg / <?= $p['berat'] ?>) * (110 / 100);
          bolong_panel = (bolong_kg / <?= $p['berat'] ?>) * (110 / 100);
          bending_panel = (bending_kg / <?= $p['berat'] ?>) * (110 / 100);
          lengket_terpotong_panel = (lengket_terpotong_kg / <?= $p['berat'] ?>) * (110 / 100);
        }
      <?php endforeach ?>
    }
    $('#terpotong_panel_' + baris + '_neg').val(Math.ceil(terpotong_panel));
    $('#tersangkut_panel_' + baris + '_neg').val(Math.ceil(tersangkut_panel));
    $('#overbrush_panel_' + baris + '_neg').val(Math.ceil(overbrush_panel));
    $('#rontok_panel_' + baris + '_neg').val(Math.ceil(rontok_panel));
    $('#lug_patah_panel_' + baris + '_neg').val(Math.ceil(lug_patah_panel));
    $('#patah_kaki_panel_' + baris + '_neg').val(Math.ceil(patah_kaki_panel));
    $('#patah_frame_panel_' + baris + '_neg').val(Math.ceil(patah_frame_panel));
    $('#bolong_panel_' + baris + '_neg').val(Math.ceil(bolong_panel));
    $('#bending_panel_' + baris + '_neg').val(Math.ceil(bending_panel));
    $('#lengket_terpotong_panel_' + baris + '_neg').val(Math.ceil(lengket_terpotong_panel));
    $('#persentase_reject_internal_' + baris + '_neg').val((100 * (Math.ceil(terpotong_panel) + Math.ceil(tersangkut_panel) + Math.ceil(overbrush_panel)) / $('#hasil_produksi_' + baris + '_neg').val()).toPrecision(3) + '%');
    $('#persentase_reject_eksternal_' + baris + '_neg').val((100 * (Math.ceil(rontok_panel) + Math.ceil(lug_patah_panel) + Math.ceil(patah_kaki_panel) + Math.ceil(patah_frame_panel) + Math.ceil(bolong_panel) + Math.ceil(bending_panel) + Math.ceil(lengket_terpotong_panel)) / $('#hasil_produksi_' + baris + '_neg').val()).toPrecision(3) + '%');
    $('#persentase_reject_akumulatif_' + baris + '_neg').val((100 * (Math.ceil(terpotong_panel) + Math.ceil(tersangkut_panel) + Math.ceil(overbrush_panel) + Math.ceil(rontok_panel) + Math.ceil(lug_patah_panel) + Math.ceil(patah_kaki_panel) + Math.ceil(patah_frame_panel) + Math.ceil(bolong_panel) + Math.ceil(bending_panel) + Math.ceil(lengket_terpotong_panel)) / $('#hasil_produksi_' + baris + '_neg').val()).toPrecision(3) + '%');
  }

  function add_platecutting_pos() {
    let baris = 0;
    <?php
    $plate_pos = array_filter($plateinput, function ($p_pos) {
      return strpos($p_pos['plate'], 'POS') !== false;
    });
    ?>
    <?php foreach ($plate_pos as $pp) { ?>
      baris = document.querySelectorAll('.form_pos').length;
      $('.form_platecutting_pos').append(`
			<tr class="form_pos" id="form_${baris}_pos">
          <input type="hidden" name="id_plateinput[]" value="<?= $pp['id']; ?>">
          <td>${baris + 1}</td>
          <td>
              <select class="form-control select2" id="plate_${baris}_pos" onchange="panel_pos(${baris})" name="plate_pos[]" style="width: 200px;" required disabled>
                  <option value="" disabled>-- Pilih Plate --</option>
                  <?php
                  $plate_pos = array_filter($plate, function ($p_pos) {
                    return strpos($p_pos['plate'], 'POS') !== false;
                  });
                  foreach ($plate_pos as $plt) {
                  ?>
                    <?php if (trim($pp['plate']) === trim($plt['plate'])) : ?>
                        <option value="<?= trim($pp['plate']) ?>" selected><?= trim($pp['plate']) ?></option>
                    <?php else : ?>
                        <option value="<?= trim($plt['plate']) ?>"><?= trim($plt['plate']) ?></option>
                    <?php endif ?>
                  <?php
                  }
                  ?>
              </select>
          </td>
          <td>
              <input type="text" class="form-control" name="hasil_produksi_pos[]" id="hasil_produksi_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['hasil_produksi']) ?>" style="width: 100px" required readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="terpotong_kg_pos[]" id="terpotong_kg_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['terpotong_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="tersangkut_kg_pos[]" id="tersangkut_kg_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['tersangkut_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="overbrush_kg_pos[]" id="overbrush_kg_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['overbrush_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="rontok_kg_pos[]" id="rontok_kg_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['rontok_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="lug_patah_kg_pos[]" id="lug_patah_kg_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['lug_patah_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="patah_kaki_kg_pos[]" id="patah_kaki_kg_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['patah_kaki_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="patah_frame_kg_pos[]" id="patah_frame_kg_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['patah_frame_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="bolong_kg_pos[]" id="bolong_kg_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['bolong_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="bending_kg_pos[]" id="bending_kg_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['bending_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="lengket_terpotong_kg_pos[]" id="lengket_terpotong_kg_${baris}_pos" onkeyup="panel_pos(${baris})" value="<?= trim($pp['lengket_terpotong_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="terpotong_panel_pos[]" id="terpotong_panel_${baris}_pos" value="<?= trim($pp['terpotong_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="tersangkut_panel_pos[]" id="tersangkut_panel_${baris}_pos" value="<?= trim($pp['tersangkut_panel']) ?>" style=" width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="overbrush_panel_pos[]" id="overbrush_panel_${baris}_pos" value="<?= trim($pp['overbrush_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="rontok_panel_pos[]" id="rontok_panel_${baris}_pos" value="<?= trim($pp['rontok_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="lug_patah_panel_pos[]" id="lug_patah_panel_${baris}_pos" value="<?= trim($pp['lug_patah_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="patah_kaki_panel_pos[]" id="patah_kaki_panel_${baris}_pos" value="<?= trim($pp['patah_kaki_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="patah_frame_panel_pos[]" id="patah_frame_panel_${baris}_pos" value="<?= trim($pp['patah_frame_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="bolong_panel_pos[]" id="bolong_panel_${baris}_pos" value="<?= trim($pp['bolong_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="bending_panel_pos[]" id="bending_panel_${baris}_pos" value="<?= trim($pp['bending_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="lengket_terpotong_panel_pos[]" id="lengket_terpotong_panel_${baris}_pos" value="<?= trim($pp['lengket_terpotong_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="persentase_reject_internal_pos[]" id="persentase_reject_internal_${baris}_pos" value="<?= trim($pp['persentase_reject_internal']) ?>" style="width: 100px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="persentase_reject_eksternal_pos[]" id="persentase_reject_eksternal_${baris}_pos" value="<?= trim($pp['persentase_reject_eksternal']) ?>" style="width: 100px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="persentase_reject_akumulatif_pos[]" id="persentase_reject_akumulatif_${baris}_pos" value="<?= trim($pp['persentase_reject_akumulatif']) ?>" style="width: 100px" readonly>
          </td>
      </tr>
		`);
    <?php } ?>
    $('.select2').select2();
  }
  add_platecutting_pos();

  function add_platecutting_neg() {
    let baris = 0;
    <?php
    $plate_neg = array_filter($plateinput, function ($p_neg) {
      return strpos($p_neg['plate'], 'NEG') !== false;
    });
    ?>
    <?php foreach ($plate_neg as $pn) { ?>
      baris = document.querySelectorAll('.form_neg').length;
      $('.form_platecutting_neg').append(`
			<tr class="form_neg" id="form_${baris}_neg">
          <input type="hidden" name="id_plateinput[]" value="<?= $pn['id']; ?>">
          <td>${baris + 1}</td>
          <td>
              <select class="form-control select2" id="plate_${baris}_neg" onchange="panel_neg(${baris})" name="plate_neg[]" style="width: 200px;" required disabled>
                  <option value="" disabled>-- Pilih Plate --</option>
                  <?php
                  $plate_neg = array_filter($plate, function ($p_neg) {
                    return strpos($p_neg['plate'], 'NEG') !== false;
                  });
                  foreach ($plate_neg as $plt) {
                  ?>
                    <?php if (trim($pn['plate']) === trim($plt['plate'])) : ?>
                        <option value="<?= trim($pn['plate']) ?>" selected><?= trim($pn['plate']) ?></option>
                    <?php else : ?>
                        <option value="<?= trim($plt['plate']) ?>"><?= trim($plt['plate']) ?></option>
                    <?php endif ?>
                  <?php
                  }
                  ?>
              </select>
          </td>
          <td>
              <input type="text" class="form-control" name="hasil_produksi_neg[]" id="hasil_produksi_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['hasil_produksi']) ?>" style="width: 100px" required readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="terpotong_kg_neg[]" id="terpotong_kg_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['terpotong_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="tersangkut_kg_neg[]" id="tersangkut_kg_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['tersangkut_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="overbrush_kg_neg[]" id="overbrush_kg_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['overbrush_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="rontok_kg_neg[]" id="rontok_kg_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['rontok_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="lug_patah_kg_neg[]" id="lug_patah_kg_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['lug_patah_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="patah_kaki_kg_neg[]" id="patah_kaki_kg_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['patah_kaki_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="patah_frame_kg_neg[]" id="patah_frame_kg_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['patah_frame_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="bolong_kg_neg[]" id="bolong_kg_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['bolong_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="bending_kg_neg[]" id="bending_kg_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['bending_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="lengket_terpotong_kg_neg[]" id="lengket_terpotong_kg_${baris}_neg" onkeyup="panel_neg(${baris})" value="<?= trim($pn['lengket_terpotong_kg']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="terpotong_panel_neg[]" id="terpotong_panel_${baris}_neg" value="<?= trim($pn['terpotong_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="tersangkut_panel_neg[]" id="tersangkut_panel_${baris}_neg" value="<?= trim($pn['tersangkut_panel']) ?>" style=" width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="overbrush_panel_neg[]" id="overbrush_panel_${baris}_neg" value="<?= trim($pn['overbrush_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="rontok_panel_neg[]" id="rontok_panel_${baris}_neg" value="<?= trim($pn['rontok_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="lug_patah_panel_neg[]" id="lug_patah_panel_${baris}_neg" value="<?= trim($pn['lug_patah_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="patah_kaki_panel_neg[]" id="patah_kaki_panel_${baris}_neg" value="<?= trim($pn['patah_kaki_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="patah_frame_panel_neg[]" id="patah_frame_panel_${baris}_neg" value="<?= trim($pn['patah_frame_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="bolong_panel_neg[]" id="bolong_panel_${baris}_neg" value="<?= trim($pn['bolong_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="bending_panel_neg[]" id="bending_panel_${baris}_neg" value="<?= trim($pn['bending_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="lengket_terpotong_panel_neg[]" id="lengket_terpotong_panel_${baris}_neg" value="<?= trim($pn['lengket_terpotong_panel']) ?>" style="width: 75px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="persentase_reject_internal_neg[]" id="persentase_reject_internal_${baris}_neg" value="<?= trim($pn['persentase_reject_internal']) ?>" style="width: 100px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="persentase_reject_eksternal_neg[]" id="persentase_reject_eksternal_${baris}_neg" value="<?= trim($pn['persentase_reject_eksternal']) ?>" style="width: 100px" readonly>
          </td>
          <td>
              <input type="text" class="form-control" name="persentase_reject_akumulatif_neg[]" id="persentase_reject_akumulatif_${baris}_neg" value="<?= trim($pn['persentase_reject_akumulatif']) ?>" style="width: 100px" readonly>
          </td>
      </tr>
		`);
    <?php } ?>
    $('.select2').select2();
  }
  add_platecutting_neg();

  function edit_button() {
    const barispos = document.querySelectorAll('.form_pos').length;
    for (let i = 0; i < barispos; i++) {
      $('#plate_' + i + '_pos').removeAttr('disabled');
      $('#hasil_produksi_' + i + '_pos').removeAttr('readonly');
      $('#terpotong_kg_' + i + '_pos').removeAttr('readonly');
      $('#tersangkut_kg_' + i + '_pos').removeAttr('readonly');
      $('#overbrush_kg_' + i + '_pos').removeAttr('readonly');
      $('#rontok_kg_' + i + '_pos').removeAttr('readonly');
      $('#lug_patah_kg_' + i + '_pos').removeAttr('readonly');
      $('#patah_kaki_kg_' + i + '_pos').removeAttr('readonly');
      $('#patah_frame_kg_' + i + '_pos').removeAttr('readonly');
      $('#bolong_kg_' + i + '_pos').removeAttr('readonly');
      $('#bending_kg_' + i + '_pos').removeAttr('readonly');
      $('#lengket_terpotong_kg_' + i + '_pos').removeAttr('readonly');
    }
    const barisneg = document.querySelectorAll('.form_neg').length;
    for (let i = 0; i < barisneg; i++) {
      $('#plate_' + i + '_neg').removeAttr('disabled');
      $('#hasil_produksi_' + i + '_neg').removeAttr('readonly');
      $('#terpotong_kg_' + i + '_neg').removeAttr('readonly');
      $('#tersangkut_kg_' + i + '_neg').removeAttr('readonly');
      $('#overbrush_kg_' + i + '_neg').removeAttr('readonly');
      $('#rontok_kg_' + i + '_neg').removeAttr('readonly');
      $('#lug_patah_kg_' + i + '_neg').removeAttr('readonly');
      $('#patah_kaki_kg_' + i + '_neg').removeAttr('readonly');
      $('#patah_frame_kg_' + i + '_neg').removeAttr('readonly');
      $('#bolong_kg_' + i + '_neg').removeAttr('readonly');
      $('#bending_kg_' + i + '_neg').removeAttr('readonly');
      $('#lengket_terpotong_kg_' + i + '_neg').removeAttr('readonly');
    }
    const buttonElement = document.querySelector('.button');
    buttonElement.innerHTML = '';
    buttonElement.innerHTML = `
            <button type="submit" class="btn btn-warning" name="edit" value="edit">Konfirmasi</button>
        `;
  }

  function reject_button() {
    const buttonElement = document.querySelector('.button');
    buttonElement.innerHTML = '';
    buttonElement.innerHTML = `
            <button type="submit" class="btn btn-danger" name="rejected" value="rejected">Konfirmasi</button>
        `;
  }

  function approve_button() {
    const buttonElement = document.querySelector('.button');
    buttonElement.innerHTML = '';
    buttonElement.innerHTML = `
            <button type="submit" class="btn btn-success" name="approved" value="approved">Konfirmasi</button>
        `;
  }
</script>
<?= $this->endSection(); ?>