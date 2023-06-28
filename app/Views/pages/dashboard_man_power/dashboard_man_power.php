<?= $this->extend('template/dashboardmanpower/layout'); ?>

<?= $this->section('content'); ?>
<?php $color = ['#000000', '#ff0000', '#ffff00', '#0000ff', '#00aa00']; ?>
<?php if (strcasecmp($sub_bagian, 'amb-1') === 0)
  $line = [1, 2, 3];
else if (strcasecmp($sub_bagian, 'amb-2') === 0)
  $line = [4, 5, 6, 7];
else if (strcasecmp($sub_bagian, 'wet') === 0)
  $line = [8, 9];
else if (strcasecmp($sub_bagian, 'mcb') === 0)
  $line = [10];
?>
<?php $group = 'A' ?>
<?php $lineAct = ['', 1, 2, 3, 4, 5, 6, 7, 'WET A', 'WET F', 'MCB'] ?>
<!-- Content Wrapper. Contains page content -->
<div class="container-full">
  <!-- Main content -->
  <section class="content p-0">
    <!-- <div class="">
      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" name="tanggal" id="tanggal" class="form-control">
    </div> -->
    <?php for ($i = 0; $i < count($line); $i++) { ?>
      <?php $model = new App\Models\M_DashboardManPower();
      $data_mesin = $model->get_data_mesin($line[$i]);
      ?>
      <div class="d-flex justify-content-between" style="margin-right: 23px">
        <div class="d-flex" style="margin-left: 20px">
          <div class="d-flex justify-content-center align-items-center flex-column mx-1 mb-2" style="background-color: #213363; color: white; width: 100px">
            <h4 class="fw-bold" style="font-size: 16px">Line</h4>
            <?= "" //($line[$i] <= 7) ? 'Line ' . $lineAct[$line[$i]] : $lineAct[$line[$i]] 
            ?>
            <h1 class="m-2 fw-bold"><?= $lineAct[$line[$i]] ?></h1>
            <div class="d-flex align-items-top px-2">
              <h4 style="font-size: 14px; color: white" class="m-0">Group</h4>
              <!-- <input type="text" class="form-control" name="group[]" id="group_<?= $line[$i] ?>" style="height: 20px"> -->
            </div>
            <select name="group[]" id="group_<?= $line[$i] ?>" class="form-select p-0 ps-5 ms-1" style="height: 20px; font-size: 12px; width: 50px" onchange="changeGroup('<?= $line[$i] ?>', '<?= $sub_bagian ?>')">
              <option value="A" <?= count($detail_record_man_power) > 0 ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_first($detail_record_man_power[$line[$i]]) === 'A') ? 'selected' : '') : '') : '' ?>>A</option>
              <option value="B" <?= count($detail_record_man_power) > 0 ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_first($detail_record_man_power[$line[$i]]) === 'B') ? 'selected' : '') : '') : '' ?>>B</option>
              <option value="C" <?= count($detail_record_man_power) > 0 ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_first($detail_record_man_power[$line[$i]]) === 'C') ? 'selected' : '') : '') : '' ?>>C</option>
            </select>
          </div>
          <!-- <div class="col" style="width: 100px">
              
            </div> -->
          <?php $index_mesin = 0;
          foreach ($data_mesin as $msn) { ?>
            <?php if (count($detail_record_man_power) > 0) { ?>
              <!-- <div class="col"> -->
              <div class="box mb-2 mx-1" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; width: 140px; background-color: <?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? (($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['nama'] === '') ? '#850000' : '') : '#850000') : '#850000') : '#850000') : '#850000' ?>" id="card_<?= $line[$i] ?>_<?= $index_mesin ?>">
                <div class="fx-card-item">
                  <div class="fx-card-content">
                    <div class="d-flex justify-content-center align-items-center" style="border-radius: 5px 5px 0px 0px">
                      <!-- <div class="d-flex justify-content-center align-items-center" style="background-color: <?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists($group, $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][$group])) ? ($color[$detail_record_man_power[$line[$i]][$group][$msn['mesin']]['skill']]) : '') : '') : '') : '' ?>; border-radius: 5px 5px 0px 0px"> -->
                      <div style="width: 12%">
                        <h4 class="mb-0 text-center p-1 fw-bold" style="font-size: 10px">&nbsp;</h4>
                      </div>
                      <div style="width: 76%">
                        <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px" name="mesin_<?= $line[$i] ?>[]" id="mesin_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= $msn['mesin'] ?></h4>
                      </div>
                      <div style="width: 12%;" class="d-flex justify-content-end p-1">
                        <div style="background-color: <?= $color[$msn['min_skill']] ?>; border-radius: 50%; width: 10px; height: 10px; border: 0.1px solid black" id="min_skill_color_<?= $line[$i] ?>_<?= $index_mesin ?>"></div>
                      </div>
                      <input type="hidden" name="nama_mp_<?= $line[$i] ?>[]" id="nama_mp_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['nama']) : '') : '') : '') : '' ?>">
                      <input type="hidden" name="requirement_<?= $line[$i] ?>[]" id="requirement_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= $msn['requirement'] ?>">
                      <input type="hidden" name="min_skill_<?= $line[$i] ?>[]" id="min_skill_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= $msn['min_skill'] ?>">
                      <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                    </div>
                    <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]])) ? ($detail_record_man_power[$line[$i]][$msn['mesin']]['nama']) : 'NO MP') : 'NO MP') : 'NO MP' 
                                                                      ?></h5> -->
                  </div>
                  <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 125px">
                    <img src="<?= base_url() ?>uploads/<?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['foto']) : '') : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 125px" id="foto_<?= $line[$i] ?>_<?= $index_mesin ?>">
                  </div>
                  <div class="fx-card-footer px-3 py-1">
                    <div class="d-flex justify-content-between align-items-center">
                      <h5 class="m-0" style="font-size: 10px" id="npk_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= sprintf('%04d', (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['npk']) : '') : '') : '') : '') ?></h5>
                      <div style="border: 0.1px solid black; background-color: <?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($color[$detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['skill']]) : '') : '') : '') : '' ?>; border-radius: 50%; width: 10px; height: 10px" id="skill_<?= $line[$i] ?>_<?= $index_mesin ?>"></div>
                    </div>
                    <!-- <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-0" style="font-size: 10px">Min Skill</h5>
                      </div> -->
                    <div class="d-flex justify-content-between align-items-center">
                      <!-- <h5 class="m-0" style="font-size: 10px">Status</h5> -->
                      <h5 class="m-0" style="font-size: 10px; color: <?= ($msn['min_skill']  <= ((count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($color[$detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['skill']]) : '') : '') : '') : '')) ? '#00aa00' : '#ff0000' ?>" id="status_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= ($msn['min_skill']  <= ((count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($color[$detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['skill']]) : '') : '') : '') : '')) ? 'OK' : 'Kontrol' ?></h5>
                      <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('<?= $line[$i] ?>', <?= $index_mesin ?>)">Edit</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- </div> -->
            <?php } else { ?>
              <!-- <div class="col"> -->
              <div class="box mb-2 mx-1" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; width: 140px" id="card_<?= $line[$i] ?>_<?= $index_mesin ?>">
                <div class="fx-card-item">
                  <div class="fx-card-content">
                    <div class="d-flex justify-content-center align-items-center" style="border-radius: 5px 5px 0px 0px">
                      <!-- <div class="d-flex justify-content-center align-items-center" style="background-color: <?= (count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? ($color[$data_group_man_power[$line[$i]][$group][$msn['mesin']]['skill']]) : '') : '') : '') : '' ?>; border-radius: 5px 5px 0px 0px"> -->
                      <div style="width: 12%">
                        <h4 class="mb-0 text-center p-1 fw-bold" style="font-size: 10px">&nbsp;</h4>
                      </div>
                      <div style="width: 76%">
                        <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px" name="mesin_<?= $line[$i] ?>[]" id="mesin_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= $msn['mesin'] ?></h4>
                      </div>
                      <div style="width: 12%;" class="d-flex justify-content-end p-1">
                        <div style="background-color: <?= $color[$msn['min_skill']] ?>; border-radius: 50%; width: 10px; height: 10px; border: 0.1px solid black" id="min_skill_color_<?= $line[$i] ?>_<?= $index_mesin ?>"></div>
                      </div>
                      <input type="hidden" name="nama_mp_<?= $line[$i] ?>[]" id="nama_mp_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= (count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? ($data_group_man_power[$line[$i]][$group][$msn['mesin']]['nama']) : '') : '') : '') : '' ?>">
                      <input type="hidden" name="requirement_<?= $line[$i] ?>[]" id="requirement_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= $msn['requirement'] ?>">
                      <input type="hidden" name="min_skill_<?= $line[$i] ?>[]" id="min_skill_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= $msn['min_skill'] ?>">
                      <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                    </div>
                    <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]])) ? ($data_group_man_power[$line[$i]][$msn['mesin']]['nama']) : 'NO MP') : 'NO MP') : 'NO MP' 
                                                                      ?></h5> -->
                  </div>
                  <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 125px">
                    <img src="<?= base_url() ?>uploads/<?= (count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? ($data_group_man_power[$line[$i]][$group][$msn['mesin']]['foto']) : '') : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 125px" id="foto_<?= $line[$i] ?>_<?= $index_mesin ?>">
                  </div>
                  <div class="fx-card-footer px-3 py-1">
                    <div class="d-flex justify-content-between align-items-center">
                      <h5 class="m-0" style="font-size: 10px" id="npk_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= sprintf('%04d', (count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? ($data_group_man_power[$line[$i]][$group][$msn['mesin']]['npk']) : '') : '') : '') : '') ?></h5>
                      <div style="border: 0.1px solid black; background-color: <?= (count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? ($color[$data_group_man_power[$line[$i]][$group][$msn['mesin']]['skill']]) : '') : '') : '') : '' ?>; border-radius: 50%; width: 10px; height: 10px" id="skill_<?= $line[$i] ?>_<?= $index_mesin ?>"></div>
                    </div>
                    <!-- <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-0" style="font-size: 10px">Min Skill</h5>
                      </div> -->
                    <div class="d-flex justify-content-between align-items-center">
                      <!-- <h5 class="m-0" style="font-size: 10px">Status</h5> -->
                      <h5 class="m-0" style="font-size: 10px; color: <?= ($msn['min_skill']  <= ($data_group_man_power[$line[$i]][$group][$msn['mesin']]['skill'] ?? 0)) ? '#00aa00' : '#ff0000' ?>" id="status_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= ($msn['min_skill']  <= ($data_group_man_power[$line[$i]][$group][$msn['mesin']]['skill'] ?? 0)) ? 'OK' : 'Kontrol' ?></h5>
                      <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('<?= $line[$i] ?>', <?= $index_mesin ?>)">Edit</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- </div> -->
            <?php } ?>
          <?php $index_mesin++;
          } ?>
        </div>
        <div class="mb-2">
          <table class="table bg-white" style="height: 100%; width: 300px; border-radius: 5px">
            <thead>
              <tr>
                <th style="font-size: 12px" class="py-1 px-0 text-center">Nama</th>
                <th style="font-size: 12px" class="py-1 px-0 text-center">NPK</th>
                <th style="font-size: 12px" class="py-1 px-0 text-center">Keterangan</th>
              </tr>
            </thead>
            <tbody id="data_mp_tidak_hadir_<?= $line[$i] ?>">
              <?php if (array_key_exists($line[$i], $data_mp_tidak_hadir) ? count($data_mp_tidak_hadir[$line[$i]]) : 0) {
                $temp_index_add = 0;
                foreach ($data_mp_tidak_hadir[$line[$i]] as $dmth) { ?>
                  <tr id="add_mp_tidak_masuk_<?= $line[$i] ?>_<?= $temp_index_add ?>" style="border-bottom: <?= $temp_index_add === 5 ? 'transparent' : '' ?>;" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('<?= $line[$i] ?>', <?= $temp_index_add ?>)">
                    <td class="p-0" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">
                      <?= $dmth['nama'] ?>
                      <input type="hidden" name="nama_mp_tidak_hadir_<?= $line[$i] ?>[]" value="<?= $dmth['id_man_power'] ?>">
                      <input type="hidden" name="id_cuti_mp_tidak_hadir_<?= $line[$i] ?>[]" id="id_cuti_mp_tidak_hadir_<?= $line[$i] ?>_<?= $temp_index_add ?>" value="<?= $dmth['id_cuti'] ?>">
                    </td>
                    <td class="p-0 text-center"><?= sprintf('%04d', $dmth['npk']) ?></td>
                    <td class="p-0 text-center" name="keterangan_mp_tidak_hadir_<?= $line[$i] ?>[]"><?= $dmth['keterangan'] ?></td>
                  </tr>
                  <?php $temp_index_add++;
                }
                if ($temp_index_add < 6) {
                  for ($index_add = $temp_index_add; $index_add < 6; $index_add++) { ?>
                    <tr id="add_mp_tidak_masuk_<?= $line[$i] ?>_<?= $index_add ?>" style="border-bottom: <?= $index_add === 5 ? 'transparent' : '' ?>;">
                      <td colspan="3" class="text-center p-0">
                        <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_<?= $line[$i] ?>_<?= $index_add ?>" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('<?= $line[$i] ?>',<?= $index_add ?>)">Add</button>
                      </td>
                    </tr>
                <?php }
                } ?>
                <?php } else {
                for ($index_add = 0; $index_add < 6; $index_add++) { ?>
                  <tr id="add_mp_tidak_masuk_<?= $line[$i] ?>_<?= $index_add ?>" style="border-bottom: <?= $index_add === 5 ? 'transparent' : '' ?>;">
                    <td colspan="3" class="text-center p-0">
                      <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_<?= $line[$i] ?>_<?= $index_add ?>" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('<?= $line[$i] ?>',<?= $index_add ?>)">Add</button>
                    </td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php } ?>
    <?php $data_indirect = $model->get_data_indirect(str_replace('-', '_', $sub_bagian)) ?>
    <div class="d-flex justify-content-between" style="margin-right: 23px">
      <div class="row">
        <div class="col">
          <div class="d-flex" style="margin-left: 20px">
            <div class="d-flex justify-content-center align-items-center flex-column mx-1 mb-2" style="width: 100px; background: #1F8A70; color: white">
              <?php $word_indirect = str_split('INDIRECT');
              foreach ($word_indirect as $wi) { ?>
                <h4 class="fw-bold m-0" style="font-size: 16px"><?= $wi ?></h4>
              <?php } ?>
            </div>
            <!-- <div class="row row-cols-<?= "" //(count($data_indirect) >= 12) ? ceil(count($data_indirect)/2) : count($data_indirect) 
                                          ?> d-flex justify-content-center"> -->
            <!-- <div class="col" style="width: 100px">
              
            </div> -->
            <?php $index_indirect = 0;
            foreach ($data_indirect as $di) { ?>
              <?php "" //if(strpos($di['mesin'], 'Kasubsie') === 0 || strpos($di['mesin'], 'Improvement') === 0) { 
              ?>
              <?php if (strpos($di['mesin'], 'Kasubsie') === 0) { ?>
                <?php if (count($detail_record_man_power_kasubsie) > 0) { ?>
                  <div>
                    <div class="d-flex justify-content-center align-items-top">
                      <h4 style="font-size: 16px; color: white" class="m-0">Group</h4>
                      <select name="group_indirect[]" id="group_indirect_<?= $index_indirect ?>" class="form-select p-0 ps-5 ms-1" style="height: 20px; font-size: 12px; width: 50px" onchange="changeGroupIndirect('indirect', '<?= $sub_bagian ?>', <?= $index_indirect ?>)">
                        <option value="A" <?= count($detail_record_man_power_kasubsie) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_first($detail_record_man_power_kasubsie[$di['mesin']]) === 'A') ? 'selected' : '') : '') : '' ?>>A</option>
                        <option value="B" <?= count($detail_record_man_power_kasubsie) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_first($detail_record_man_power_kasubsie[$di['mesin']]) === 'B') ? 'selected' : '') : '') : '' ?>>B</option>
                        <option value="C" <?= count($detail_record_man_power_kasubsie) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_first($detail_record_man_power_kasubsie[$di['mesin']]) === 'C') ? 'selected' : '') : '') : '' ?>>C</option>
                      </select>
                    </div>
                    <div class="box mb-2 mx-1" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; width: 140px" id="card_indirect_<?= $index_indirect ?>">
                      <div class="fx-card-item">
                        <div class="fx-card-content">
                          <div class="d-flex justify-content-center align-items-center" style="background-color: <?= "" //(count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ($color[$detail_record_man_power_kasubsie[$di['mesin']]['skill']]) : '') : '' 
                                                                                                                  ?>; border-radius: 5px 5px 0px 0px">
                            <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px" id="mesin_indirect_<?= $index_indirect ?>"><?= $di['mesin'] ?></h4>
                            <input type="hidden" name="nama_mp_indirect[]" id="nama_mp_indirect_<?= $index_indirect ?>" value="<?= (count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_exists(array_key_first($detail_record_man_power_kasubsie[$di['mesin']]), $detail_record_man_power_kasubsie[$di['mesin']])) ? ($detail_record_man_power_kasubsie[$di['mesin']][array_key_first($detail_record_man_power_kasubsie[$di['mesin']])]['nama']) : '') : '') : '' ?>">
                            <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                          </div>
                          <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ($detail_record_man_power_kasubsie[$di['mesin']]['nama']) : 'NO MP') : 'NO MP' 
                                                                            ?></h5> -->
                        </div>
                        <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 125px">
                          <img src="<?= base_url() ?>uploads/<?= (count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_exists(array_key_first($detail_record_man_power_kasubsie[$di['mesin']]), $detail_record_man_power_kasubsie[$di['mesin']])) ? ($detail_record_man_power_kasubsie[$di['mesin']][array_key_first($detail_record_man_power_kasubsie[$di['mesin']])]['foto']) : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 125px" id="foto_indirect_<?= $index_indirect ?>">
                        </div>
                        <div class="fx-card-footer px-3 py-2 d-flex justify-content-between align-items-center">
                          <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_exists(array_key_first($detail_record_man_power_kasubsie[$di['mesin']]), $detail_record_man_power_kasubsie[$di['mesin']])) ? ($detail_record_man_power_kasubsie[$di['mesin']][array_key_first($detail_record_man_power_kasubsie[$di['mesin']])]['npk']) : '') : '') : '') ?></h5>
                          <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button>
                          <!-- <div style="background-color: <?= "" //(count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ($color[$detail_record_man_power_kasubsie[$di['mesin']]['skill']]) : '') : '' 
                                                              ?>; border-radius: 50%; width: 24px; height: 24px"></div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                <?php $index_indirect++;
                } else { ?>
                  <div>
                    <div class="d-flex justify-content-center align-items-top">
                      <h4 style="font-size: 16px; color: white" class="m-0">Group</h4>
                      <select name="group_indirect[]" id="group_indirect_<?= $index_indirect ?>" class="form-select p-0 ps-5 ms-1" style="height: 20px; font-size: 12px; width: 50px" onchange="changeGroupIndirect('indirect', '<?= $sub_bagian ?>', <?= $index_indirect ?>)">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                      </select>
                    </div>
                    <div class="box mb-2 mx-1" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; width: 140px" id="card_indirect_<?= $index_indirect ?>">
                      <div class="fx-card-item">
                        <div class="fx-card-content">
                          <div class="d-flex justify-content-center align-items-center" style="background-color: <?= "" //(count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie)) ? ($color[$data_group_man_power_kasubsie[$di['mesin']]['skill']]) : '') : '' 
                                                                                                                  ?>; border-radius: 5px 5px 0px 0px">
                            <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px" id="mesin_indirect_<?= $index_indirect ?>"><?= $di['mesin'] ?></h4>
                            <input type="hidden" name="nama_mp_indirect[]" id="nama_mp_indirect_<?= $index_indirect ?>" value="<?= (count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($group, $data_group_man_power_kasubsie)) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie[$group])) ? ($data_group_man_power_kasubsie[$group][$di['mesin']]['nama']) : '') : '') : '' ?>">
                            <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                          </div>
                          <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie)) ? ($data_group_man_power_kasubsie[$di['mesin']]['nama']) : 'NO MP') : 'NO MP' 
                                                                            ?></h5> -->
                        </div>
                        <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 125px">
                          <img src="<?= base_url() ?>uploads/<?= (count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($group, $data_group_man_power_kasubsie)) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie[$group])) ? ($data_group_man_power_kasubsie[$group][$di['mesin']]['foto']) : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 125px" id="foto_indirect_<?= $index_indirect ?>">
                        </div>
                        <div class="fx-card-footer px-3 py-2 d-flex justify-content-between align-items-center">
                          <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($group, $data_group_man_power_kasubsie)) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie[$group])) ? ($data_group_man_power_kasubsie[$group][$di['mesin']]['npk']) : '') : '') : '') ?></h5>
                          <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button>
                          <!-- <div style="background-color: <?= "" //(count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie)) ? ($color[$data_group_man_power_kasubsie[$di['mesin']]['skill']]) : '') : '' 
                                                              ?>; border-radius: 50%; width: 24px; height: 24px"></div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                <?php $index_indirect++;
                }
              } else { ?>
                <?php if (count($detail_record_man_power_indirect) > 0) { ?>
                  <div>
                    <div class="d-flex justify-content-center align-items-top">
                      <h4 style="font-size: 16px; color: white" class="m-0">Group</h4>
                      <select name="group_indirect[]" id="group_indirect_<?= $index_indirect ?>" class="form-select p-0 ps-5 ms-1" style="height: 20px; font-size: 12px; width: 50px" onchange="changeGroupIndirect('indirect', '<?= $sub_bagian ?>', <?= $index_indirect ?>)">
                        <option value="A" <?= count($detail_record_man_power_indirect) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_first($detail_record_man_power_indirect[$di['mesin']]) === 'A') ? 'selected' : '') : '') : '' ?>>A</option>
                        <option value="B" <?= count($detail_record_man_power_indirect) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_first($detail_record_man_power_indirect[$di['mesin']]) === 'B') ? 'selected' : '') : '') : '' ?>>B</option>
                        <option value="C" <?= count($detail_record_man_power_indirect) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_first($detail_record_man_power_indirect[$di['mesin']]) === 'C') ? 'selected' : '') : '') : '' ?>>C</option>
                      </select>
                    </div>
                    <div class="box mb-2 mx-1" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; width: 140px" id="card_indirect_<?= $index_indirect ?>">
                      <div class="fx-card-item">
                        <div class="fx-card-content">
                          <div class="d-flex justify-content-center align-items-center" style="border-radius: 5px 5px 0px 0px">
                            <!-- <div class="d-flex justify-content-center align-items-center" style="background-color: <?= "" //(count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ($color[$detail_record_man_power_indirect[$di['mesin']]['skill']]) : '') : '' 
                                                                                                                        ?>; border-radius: 5px 5px 0px 0px"> -->
                            <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px" id="mesin_indirect_<?= $index_indirect ?>"><?= $di['mesin'] ?></h4>
                            <?php if ($di['requirement'] !== 'Tidak Baca') { ?>
                              <div style="background-color: <?= $color[$di['min_skill'] ?? 0] ?>; border-radius: 50%; width: 10px; height: 10px; border: 0.1px solid black" id="min_skill_color_indirect_<?= $index_indirect ?>"></div>
                            <?php } ?>
                            <input type="hidden" name="nama_mp_indirect[]" id="nama_mp_indirect_<?= $index_indirect ?>" value="<?= (count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? ($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['nama']) : '') : '') : '' ?>">

                            <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                          </div>
                          <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ($detail_record_man_power_indirect[$di['mesin']]['nama']) : 'NO MP') : 'NO MP' 
                                                                            ?></h5> -->
                        </div>
                        <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 125px">
                          <img src="<?= base_url() ?>uploads/<?= (count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? ($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['foto']) : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 125px" id="foto_indirect_<?= $index_indirect ?>">
                        </div>
                        <div class="fx-card-footer px-3 py-2">
                          <!-- <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? ($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['npk']) : '') : '') : '') ?></h5>
                        <div style="background-color: <?= "" //(count($detail_record_man_power_indirect) > 0) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect), $detail_record_man_power_indirect)) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect[array_key_first($detail_record_man_power_indirect)])) ? ($color[$detail_record_man_power_indirect[array_key_first($detail_record_man_power_indirect)][$di['mesin']]['skill']]) : '') : '') : '' 
                                                      ?>; border-radius: 50%; width: 10px; height: 10px" id="skill_indirect_<?= $index_indirect ?>"></div>
                      </div> -->
                          <!-- <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-0" style="font-size: 10px">Min Skill</h5>
                      </div> -->
                          <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? ($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['npk']) : '') : '') : '') ?></h5>
                            <!-- <h5 class="m-0" style="font-size: 10px; color: <?= "" //($di['min_skill']  <= ($detail_record_man_power_indirect[array_key_first($detail_record_man_power_indirect)][$di['mesin']]['skill'] ?? 0)) ? '#00aa00' : '#ff0000' 
                                                                                ?>" id="status_indirect_<?= $index_indirect ?>"><?= "" //($di['min_skill']  <= ($detail_record_man_power_indirect[array_key_first($detail_record_man_power_indirect)][$di['mesin']]['skill'] ?? 0)) ? 'OK' : 'Kontrol' 
                                                                                                                                ?></h5> -->
                            <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php $index_indirect++;
                } else { ?>
                  <div>
                    <div class="d-flex justify-content-center align-items-top">
                      <h4 style="font-size: 16px; color: white" class="m-0">Group</h4>
                      <select name="group_indirect[]" id="group_indirect_<?= $index_indirect ?>" class="form-select p-0 ps-5 ms-1" style="height: 20px; font-size: 12px; width: 50px" onchange="changeGroupIndirect('indirect', '<?= $sub_bagian ?>', <?= $index_indirect ?>)">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                      </select>
                    </div>
                    <div class="box mb-2 mx-1" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; width: 140px" id="card_indirect_<?= $index_indirect ?>">
                      <div class="fx-card-item">
                        <div class="fx-card-content">
                          <div class="d-flex justify-content-center align-items-center" style="border-radius: 5px 5px 0px 0px">
                            <!-- <div class="d-flex justify-content-center align-items-center" style="background-color: <?= "" //(count($data_group_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect)) ? ($color[$data_group_man_power_indirect[$di['mesin']]['skill']]) : '') : '' 
                                                                                                                        ?>; border-radius: 5px 5px 0px 0px"> -->
                            <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px" id="mesin_indirect_<?= $index_indirect ?>"><?= $di['mesin'] ?></h4>
                            <?php if ($di['requirement'] !== 'Tidak Baca') { ?>
                              <div style="background-color: <?= $color[$di['min_skill'] ?? 0] ?>; border-radius: 50%; width: 10px; height: 10px; border: 0.1px solid black" id="min_skill_color_indirect_<?= $index_indirect ?>"></div>
                            <?php } ?>
                            <input type="hidden" name="nama_mp_indirect[]" id="nama_mp_indirect_<?= $index_indirect ?>" value="<?= (count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? ($data_group_man_power_indirect[$group][$di['mesin']]['nama']) : '') : '') : '' ?>">

                            <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                          </div>
                          <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($data_group_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect)) ? ($data_group_man_power_indirect[$di['mesin']]['nama']) : 'NO MP') : 'NO MP' 
                                                                            ?></h5> -->
                        </div>
                        <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 125px">
                          <img src="<?= base_url() ?>uploads/<?= (count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? ($data_group_man_power_indirect[$group][$di['mesin']]['foto']) : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 125px" id="foto_indirect_<?= $index_indirect ?>">
                        </div>
                        <div class="fx-card-footer px-3 py-2">
                          <!-- <div class="d-flex justify-content-between align-items-center">
      <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? ($data_group_man_power_indirect[$group][$di['mesin']]['npk']) : '') : '') : '') ?></h5>
      <div style="background-color: <?= "" //(count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? ($color[$data_group_man_power_indirect[$group][$di['mesin']]['skill']]) : '') : '') : '' 
                                    ?>; border-radius: 50%; width: 10px; height: 10px" id="skill_indirect_<?= $index_indirect ?>"></div>
    </div> -->
                          <!-- <div class="d-flex justify-content-between align-items-center">
      <h5 class="m-0" style="font-size: 10px">Min Skill</h5>
    </div> -->
                          <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? ($data_group_man_power_indirect[$group][$di['mesin']]['npk']) : '') : '') : '') ?></h5>
                            <!-- <h5 class="m-0" style="font-size: 10px; color: <?= "" //($di['min_skill']  <= ($data_group_man_power_indirect[$group][$di['mesin']]['skill'] ?? 0)) ? '#00aa00' : '#ff0000' 
                                                                                ?>" id="status_indirect_<?= $index_indirect ?>"><?= "" //($di['min_skill']  <= ($data_group_man_power_indirect[$group][$di['mesin']]['skill'] ?? 0)) ? 'OK' : 'Kontrol' 
                                                                                                                                ?></h5> -->
                            <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php $index_indirect++;
                }
              } ?>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="mb-2">
        <table class="table bg-white" style="height: 100%; width: 300px; border-radius: 5px">
          <thead>
            <tr>
              <th style="font-size: 12px" class="py-1 px-0 text-center">Nama</th>
              <th style="font-size: 12px" class="py-1 px-0 text-center">NPK</th>
              <th style="font-size: 12px" class="py-1 px-0 text-center">Keterangan</th>
            </tr>
          </thead>
          <tbody id="data_mp_tidak_hadir_indirect">
            <?php if (count($data_mp_tidak_hadir_indirect) > 0) {
              $temp_index_add = 0;
              foreach ($data_mp_tidak_hadir_indirect as $dmth) { ?>
                <tr id="add_mp_tidak_masuk_indirect_<?= $temp_index_add ?>" style="border-bottom: <?= $temp_index_add === 5 ? 'transparent' : '' ?>;" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('indirect', <?= $temp_index_add ?>)">
                  <td class="p-0" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">
                    <?= $dmth['nama'] ?>
                    <input type="hidden" name="nama_mp_tidak_hadir_indirect[]" value="<?= $dmth['id_man_power'] ?>">
                    <input type="hidden" name="id_cuti_mp_tidak_hadir_indirect[]" id="id_cuti_mp_tidak_hadir_indirect_<?= $temp_index_add ?>" value="<?= $dmth['id_cuti'] ?>">
                  </td>
                  <td class="p-0 text-center"><?= sprintf('%04d', $dmth['npk']) ?></td>
                  <td class="p-0 text-center" name="keterangan_mp_tidak_hadir_indirect[]"><?= $dmth['keterangan'] ?></td>
                </tr>
                <?php $temp_index_add++;
              }
              if ($temp_index_add < 6) {
                for ($index_add = $temp_index_add; $index_add < 6; $index_add++) { ?>
                  <tr id="add_mp_tidak_masuk_indirect_<?= $index_add ?>" style="border-bottom: <?= $index_add === 5 ? 'transparent' : '' ?>;">
                    <td colspan="3" class="text-center p-0">
                      <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_indirect_<?= $index_add ?>" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('indirect',<?= $index_add ?>)">Add</button>
                    </td>
                  </tr>
              <?php }
              } ?>
              <?php } else {
              for ($index_add = 0; $index_add < 6; $index_add++) { ?>
                <tr id="add_mp_tidak_masuk_indirect_<?= $index_add ?>" style="border-bottom: <?= $index_add === 5 ? 'transparent' : '' ?>;">
                  <td colspan="3" class="text-center p-0">
                    <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_indirect_<?= $index_add ?>" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('indirect',<?= $index_add ?>)">Add</button>
                  </td>
                </tr>
              <?php } ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade modal_edit_group_man_power" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Edit Group Man Power</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col" id="form_edit_group_man_power">
          </div>
        </div>
      </div>
      <div class="modal-footer" style="float: right;">
        <input type="button" class="btn btn-primary float-end" id="button_edit_group_man_power" value="Edit" data-bs-dismiss="modal">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade modal_add_mp_tidak_hadir" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Add Man Power Tidak Hadir</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col" id="form_add_mp_tidak_hadir">
          </div>
        </div>
      </div>
      <div class="modal-footer" style="float: right;">
        <input type="button" class="btn btn-primary float-end" id="button_add_mp_tidak_hadir" value="Add" data-bs-dismiss="modal">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
  let colorSkill = ['#000000', '#ff0000', '#ffff00', '#0000ff', '#00aa00'];

  function changeShift(sub_bagian) {
    let line = <?= json_encode($line) ?>;
    let shift = document.querySelector('#shift');
    let date = document.querySelector('#date');
    $('#loading-modal').modal('show');
    $.ajax({
      url: '<?= base_url() ?>dashboard_man_power/changeShift',
      type: 'POST',
      data: {
        sub_bagian: sub_bagian,
        date: date.value,
        shift: shift.value,
        line: line,
      },
      dataType: 'json',
      success: function(data) {
        let skill = '';
        let status = '';
        if (Object.keys(data.detail_record_man_power).length > 0) {
          line.forEach(ln => {
            let index_mesin = 0;
            data?.data_mesin?.[ln].forEach(msn => {
              // console.log(Object.keys(data.detail_record_man_power?.[ln])[0]);
              document.querySelector(`#group_${ln}`).value = Object.keys(data.detail_record_man_power?.[ln])[0];
              document.querySelector(`#nama_mp_${ln}_${index_mesin}`).value = data?.detail_record_man_power?.[ln]?.[Object.keys(data.detail_record_man_power?.[ln])[0]]?.[msn.mesin]?.['nama'] ?? '';
              document.querySelector(`#foto_${ln}_${index_mesin}`).src = '<?= base_url() ?>uploads/' + data?.detail_record_man_power?.[ln]?.[Object.keys(data.detail_record_man_power?.[ln])[0]]?.[msn.mesin]?.['foto'] ?? '';
              document.querySelector(`#npk_${ln}_${index_mesin}`).innerHTML = String(data?.detail_record_man_power?.[ln]?.[Object.keys(data.detail_record_man_power?.[ln])[0]]?.[msn.mesin]?.['npk'] ?? '').padStart(4, '0');
              skill = document.querySelector(`#skill_${ln}_${index_mesin}`);
              skill.style.backgroundColor = (data?.detail_record_man_power?.[ln]?.[Object.keys(data.detail_record_man_power?.[ln])[0]]?.[msn.mesin]?.['skill']) ? colorSkill[data?.detail_record_man_power?.[ln]?.[Object.keys(data.detail_record_man_power?.[ln])[0]]?.[msn.mesin]?.['skill']] : 'transparent';
              status = document.querySelector(`#status_${ln}_${index_mesin}`);
              status.innerHTML = (msn.min_skill <= (data?.detail_record_man_power?.[ln]?.[Object.keys(data.detail_record_man_power?.[ln])[0]]?.[msn.mesin]?.['skill'] ?? 0)) ? 'OK' : 'Kontrol';
              status.style.color = (msn.min_skill <= (data?.detail_record_man_power?.[ln]?.[Object.keys(data.detail_record_man_power?.[ln])[0]]?.[msn.mesin]?.['skill'] ?? 0)) ? '#00aa00' : '#ff0000';
              index_mesin++;
            });
            let temp_index_add = 0;
            document.querySelector(`#data_mp_tidak_hadir_${ln}`).innerHTML = '';
            if (data?.data_mp_tidak_hadir.hasOwnProperty(ln)) {
              data?.data_mp_tidak_hadir?.[ln].forEach(dmth => {
                document.querySelector(`#data_mp_tidak_hadir_${ln}`).innerHTML += `
                <tr id="add_mp_tidak_masuk_${ln}_${temp_index_add}" style="border-bottom: ${temp_index_add === 5 ? 'transparent' : ''};" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('${ln}', ${temp_index_add})">
                  <td class="p-0" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">
                    ${dmth['nama']}
                    <input type="hidden" name="nama_mp_tidak_hadir_${ln}[]" value="${dmth['id_man_power']}">
                    <input type="hidden" name="id_cuti_mp_tidak_hadir_${ln}[]" id="id_cuti_mp_tidak_hadir_${ln}_${temp_index_add}" value="${dmth['id_cuti']}">
                  </td>
                  <td class="p-0 text-center">${String(dmth['npk']).padStart(4, '0')}</td>
                  <td class="p-0 text-center" name="keterangan_mp_tidak_hadir_${ln}[]">${dmth['keterangan']}</td>
                </tr>
              `;
                temp_index_add++;
              });
            }
            if (temp_index_add < 6) {
              for (let index_add = temp_index_add; index_add < 6; index_add++) {
                document.querySelector(`#data_mp_tidak_hadir_${ln}`).innerHTML += `
                  <tr id="add_mp_tidak_masuk_${ln}_${index_add}" style="border-bottom: ${index_add === 5 ? 'transparent' : ''};">
                    <td colspan="3" class="text-center p-0">
                      <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_${ln}_${index_add}" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('${ln}',${index_add})">Add</button>
                    </td>
                  </tr>
                `;
              }
            }
            let temp_index_add_indirect = 0;
            document.querySelector('#data_mp_tidak_hadir_indirect').innerHTML = ``;
            if (data?.data_mp_tidak_hadir_indirect.length > 0) {
              data?.data_mp_tidak_hadir_indirect.forEach(dmthi => {
                document.querySelector('#data_mp_tidak_hadir_indirect').innerHTML += `
                  <tr id="add_mp_tidak_masuk_indirect_${temp_index_add_indirect}" style="border-bottom: ${temp_index_add === 5 ? 'transparent' : ''};" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('indirect', ${temp_index_add_indirect})">
                    <td class="p-0" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">
                      ${dmthi['nama']}
                      <input type="hidden" name="nama_mp_tidak_hadir_indirect[]" value="${dmthi['id_man_power']}">
                      <input type="hidden" name="id_cuti_mp_tidak_hadir_indirect[]" id="id_cuti_mp_tidak_hadir_indirect_${temp_index_add_indirect}" value="${dmthi['id_cuti']}">
                    </td>
                    <td class="p-0 text-center">${String(dmthi['npk']).padStart(4, '0')}</td>
                    <td class="p-0 text-center" name="keterangan_mp_tidak_hadir_indirect[]">${dmthi['keterangan']}</td>
                  </tr>
                `;
              });
            }
            if (temp_index_add_indirect < 6) {
              for (let index_add = temp_index_add_indirect; index_add < 6; index_add++) {
                document.querySelector('#data_mp_tidak_hadir_indirect').innerHTML += `
                  <tr id="add_mp_tidak_masuk_indirect_${index_add}" style="border-bottom: ${index_add === 5 ? 'transparent' : ''};">
                    <td colspan="3" class="text-center p-0">
                      <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_indirect_${index_add}" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('indirect',${index_add})">Add</button>
                    </td>
                  </tr>
                `;
              }
            }
          });
          let index = 0;
          data?.data_indirect.forEach(di => {
            if (di.mesin.includes('Kasubsie')) {
              document.querySelector(`#nama_mp_indirect_${index}`).value = data?.detail_record_man_power_kasubsie?.[di.mesin]?.[Object.keys(data?.detail_record_man_power_indirect?.[di.mesin])[0]]?.['nama'] ?? '';
              document.querySelector(`#foto_indirect_${index}`).src = '<?= base_url() ?>uploads/' + data?.detail_record_man_power_kasubsie?.[di.mesin]?.[Object.keys(data?.detail_record_man_power_indirect?.[di.mesin])[0]]?.['foto'] ?? '';
              document.querySelector(`#npk_indirect_${index}`).innerHTML = String(data?.detail_record_man_power_kasubsie?.[di.mesin]?.[Object.keys(data?.detail_record_man_power_indirect?.[di.mesin])[0]]?.['npk'] ?? '').padStart(4, '0');
              index++;
            } else {
              document.querySelector(`#nama_mp_indirect_${index}`).value = data?.detail_record_man_power_indirect?.[di.mesin]?.[Object.keys(data?.detail_record_man_power_indirect?.[di.mesin])[0]]?.['nama'] ?? '';
              document.querySelector(`#foto_indirect_${index}`).src = '<?= base_url() ?>uploads/' + data?.detail_record_man_power_indirect?.[di.mesin]?.[Object.keys(data?.detail_record_man_power_indirect?.[di.mesin])[0]]?.['foto'] ?? '';
              document.querySelector(`#npk_indirect_${index}`).innerHTML = String(data?.detail_record_man_power_indirect?.[di.mesin]?.[Object.keys(data?.detail_record_man_power_indirect?.[di.mesin])[0]]?.['npk'] ?? '').padStart(4, '0');
              index++;
            }
          });
        } else {
          line.forEach(ln => {
            let index_mesin = 0;
            data?.data_mesin?.[ln].forEach(msn => {
              // console.log(Object.keys(data.data_group_man_power?.[ln])[0]);
              document.querySelector(`#group_${ln}`).value = Object.keys(data.data_group_man_power?.[ln])[0];
              document.querySelector(`#nama_mp_${ln}_${index_mesin}`).value = data?.data_group_man_power?.[ln]?.[Object.keys(data.data_group_man_power?.[ln])[0]]?.[msn.mesin]?.['nama'] ?? '';
              document.querySelector(`#foto_${ln}_${index_mesin}`).src = '<?= base_url() ?>uploads/' + data?.data_group_man_power?.[ln]?.[Object.keys(data.data_group_man_power?.[ln])[0]]?.[msn.mesin]?.['foto'] ?? '';
              document.querySelector(`#npk_${ln}_${index_mesin}`).innerHTML = String(data?.data_group_man_power?.[ln]?.[Object.keys(data.data_group_man_power?.[ln])[0]]?.[msn.mesin]?.['npk'] ?? '').padStart(4, '0');
              skill = document.querySelector(`#skill_${ln}_${index_mesin}`);
              skill.style.backgroundColor = (data?.data_group_man_power?.[ln]?.[Object.keys(data.data_group_man_power?.[ln])[0]]?.[msn.mesin]?.['skill']) ? colorSkill[data?.data_group_man_power?.[ln]?.[Object.keys(data.data_group_man_power?.[ln])[0]]?.[msn.mesin]?.['skill']] : 'transparent';
              status = document.querySelector(`#status_${ln}_${index_mesin}`);
              status.innerHTML = (msn.min_skill <= (data?.data_group_man_power?.[ln]?.[Object.keys(data.data_group_man_power?.[ln])[0]]?.[msn.mesin]?.['skill'] ?? 0)) ? 'OK' : 'Kontrol';
              status.style.color = (msn.min_skill <= (data?.data_group_man_power?.[ln]?.[Object.keys(data.data_group_man_power?.[ln])[0]]?.[msn.mesin]?.['skill'] ?? 0)) ? '#00aa00' : '#ff0000';
              index_mesin++;
            });
            document.querySelector(`#data_mp_tidak_hadir_${ln}`).innerHTML = ``;
            for (let index_add = 0; index_add < 6; index_add++) {
              document.querySelector(`#data_mp_tidak_hadir_${ln}`).innerHTML += `
                <tr id="add_mp_tidak_masuk_${ln}_${index_add}" style="border-bottom: ${index_add === 5 ? 'transparent' : ''};">
                  <td colspan="3" class="text-center p-0">
                    <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_${ln}_${index_add}" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('${ln}',${index_add})">Add</button>
                  </td>
                </tr>
              `;
            }
          });
          let index = 0;
          data?.data_indirect.forEach(di => {
            if (di.mesin.includes('Kasubsie')) {
              document.querySelector(`#nama_mp_indirect_${index}`).value = data?.data_group_man_power_kasubsie?.[di.mesin]?.[Object.keys(data?.detail_record_man_power_indirect?.[di.mesin])[0]]?.['nama'] ?? '';
              document.querySelector(`#foto_indirect_${index}`).src = '<?= base_url() ?>uploads/' + data?.data_group_man_power_kasubsie?.[di.mesin]?.[Object.keys(data?.detail_record_man_power_indirect?.[di.mesin])[0]]?.['foto'] ?? '';
              document.querySelector(`#npk_indirect_${index}`).innerHTML = String(data?.data_group_man_power_kasubsie?.[di.mesin]?.[Object.keys(data?.detail_record_man_power_indirect?.[di.mesin])[0]]?.['npk'] ?? '').padStart(4, '0');
              index++;
            } else {
              document.querySelector(`#nama_mp_indirect_${index}`).value = data?.data_group_man_power_indirect?.[di.mesin]?.[Object.keys(data?.data_group_man_power_indirect?.[di.mesin])[0]]?.['nama'] ?? '';
              document.querySelector(`#foto_indirect_${index}`).src = '<?= base_url() ?>uploads/' + data?.data_group_man_power_indirect?.[di.mesin]?.[Object.keys(data?.data_group_man_power_indirect?.[di.mesin])[0]]?.['foto'] ?? '';
              document.querySelector(`#npk_indirect_${index}`).innerHTML = String(data?.data_group_man_power_indirect?.[di.mesin]?.[Object.keys(data?.data_group_man_power_indirect?.[di.mesin])[0]]?.['npk'] ?? '').padStart(4, '0');
              index++;
            }
          });
          document.querySelector('#data_mp_tidak_hadir_indirect').innerHTML = ``;
          for (let index_add = 0; index_add < 6; index_add++) {
            document.querySelector(`#data_mp_tidak_hadir_indirect`).innerHTML += `
              <tr id="add_mp_tidak_masuk_indirect_${index_add}" style="border-bottom: ${index_add === 5 ? 'transparent' : ''};">
                <td colspan="3" class="text-center p-0">
                  <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_indirect_${index_add}" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('indirect',${index_add})">Add</button>
                </td>
              </tr>
            `;
          }
        }
        $('#loading-modal').modal('hide');
      }
    });
  }

  function changeGroup(line, sub_bagian) {
    let groupElement = document.querySelector('#group_' + line);
    $.ajax({
      url: '<?= base_url() ?>dashboard_man_power/changeGroup',
      type: 'POST',
      data: {
        group_mp: groupElement.value,
        line: line,
        sub_bagian: sub_bagian
      },
      dataType: 'json',
      success: function(data) {
        let index_mesin = 0;
        let skill = '';
        let status = '';
        data.data_mesin.forEach(msn => {
          document.querySelector(`#nama_mp_${line}_${index_mesin}`).value = data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['nama'] ?? '';
          document.querySelector(`#foto_${line}_${index_mesin}`).src = '<?= base_url() ?>uploads/' + data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['foto'] ?? '';
          document.querySelector(`#npk_${line}_${index_mesin}`).innerHTML = String(data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['npk'] ?? '').padStart(4, '0');
          skill = document.querySelector(`#skill_${line}_${index_mesin}`);
          skill.style.backgroundColor = (data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill']) ? colorSkill[data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill']] : 'transparent';
          status = document.querySelector(`#status_${line}_${index_mesin}`);
          status.innerHTML = (msn.min_skill <= (data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill'] ?? 0)) ? 'OK' : 'Kontrol';
          status.style.color = (msn.min_skill <= (data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill'] ?? 0)) ? '#00aa00' : '#ff0000';
          index_mesin++;
        });
      }
    });
  }

  function changeGroupIndirect(line, sub_bagian, index) {
    let groupElement = document.querySelector('#group_' + line + '_' + index);
    let mesin = document.querySelector('#mesin_' + line + '_' + index).textContent;
    $.ajax({
      url: '<?= base_url() ?>dashboard_man_power/changeGroup',
      type: 'POST',
      data: {
        group_mp: groupElement.value,
        line: line,
        sub_bagian: sub_bagian,
        mesin: mesin
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        let skill = '';
        let status = '';
        if (mesin.includes('Kasubsie')) {
          document.querySelector(`#nama_mp_${line}_${index}`).value = data?.data_group_man_power_kasubsie?.[mesin]?.[groupElement.value]?.['nama'] ?? '';
          document.querySelector(`#foto_${line}_${index}`).src = '<?= base_url() ?>uploads/' + data?.data_group_man_power_kasubsie?.[mesin]?.[groupElement.value]?.['foto'] ?? '';
          document.querySelector(`#npk_${line}_${index}`).innerHTML = String(data?.data_group_man_power_kasubsie?.[mesin]?.[groupElement.value]?.['npk'] ?? '').padStart(4, '0');
        } else {
          document.querySelector(`#nama_mp_${line}_${index}`).value = data?.data_group_man_power_indirect?.[mesin]?.[groupElement.value]?.['nama'] ?? '';
          document.querySelector(`#foto_${line}_${index}`).src = '<?= base_url() ?>uploads/' + data?.data_group_man_power_indirect?.[mesin]?.[groupElement.value]?.['foto'] ?? '';
          document.querySelector(`#npk_${line}_${index}`).innerHTML = String(data?.data_group_man_power_indirect?.[mesin]?.[groupElement.value]?.['npk'] ?? '').padStart(4, '0');
        }
      }
    });
  }

  let all_data_man_power_kasubsie = <?= json_encode($model->get_data_master_man_power_kasubsie()) ?>;
  let all_data_man_power = <?= json_encode($model->get_data_master_man_power()) ?>;
  let deck_data_group_man_power = <?= json_encode($data_group_man_power) ?>;

  function editGroupManPower(line, index) {
    let mesin = document.querySelector(`#mesin_${line}_${index}`);
    let requirement = document.querySelector(`#requirement_${line}_${index}`);
    let min_skill = document.querySelector(`#min_skill_${line}_${index}`);
    let man_power = getManPower(line, index);
    let formEditElement = document.querySelector('#form_edit_group_man_power');
    formEditElement.innerHTML = `
    <div class="form-group">
      <label class="form-label" id="mesin_form">${mesin?.textContent}</label>
      <div class="input-group">
        <select style="width: 100%" name="edit_man_power" class="form-control select2" id="edit_man_power">
          <option value="" selected>-- Pilih Man Power --</option>
          ${man_power}
        </select>
      </div>
    </div>
    <input type="hidden" id="requirement_form" value="${requirement?.value}">
    <input type="hidden" id="min_skill_form" value="${min_skill?.value}">
    `;
    $(".select2").select2({
      dropdownParent: $(".modal_edit_group_man_power")
    });
    let button_edit_group_man_power = document.querySelector('#button_edit_group_man_power');
    button_edit_group_man_power.setAttribute('onclick', `edit_group_man_power('${line}', ${index})`);
  }

  function getManPower(line, index) {
    let npk = document.querySelector(`#npk_${line}_${index}`);
    let mesin = document.querySelector(`#mesin_${line}_${index}`);
    let data_man_power = '';
    if (mesin.textContent.includes('Kasubsie')) {
      all_data_man_power_kasubsie.forEach(admp => {
        data_man_power += `
          <option value="${admp.id_man_power}" ${(parseInt(npk.textContent) == admp.npk) ? 'selected' : ''}>${admp.nama}</option>
        `;
      });
    } else {
      all_data_man_power.forEach(admp => {
        data_man_power += `
          <option value="${admp.id_man_power}" ${(parseInt(npk.textContent) == admp.npk) ? 'selected' : ''}>${admp.nama}</option>
        `;
      });
    }
    return data_man_power;
  }

  function edit_group_man_power(line, index) {
    let edit_man_power = document.querySelector('#edit_man_power');
    let requirement = document.querySelector('#requirement_form');
    let min_skill = document.querySelector('#min_skill_form');
    $.ajax({
      url: '<?= base_url() ?>dashboard_man_power/get_detail_man_power',
      type: 'POST',
      data: {
        edit_man_power: edit_man_power.value,
        requirement: requirement.value,
      },
      dataType: 'json',
      success: function(data) {
        // if (data_group_man_power[])
        console.log(document.querySelector(`#card_${line}_${index}`));
        document.querySelector(`#card_${line}_${index}`).style.backgroundImage = 'repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)';
        document.querySelector(`#nama_mp_${line}_${index}`).value = data?.[0]?.['nama'] ?? '';
        document.querySelector(`#foto_${line}_${index}`).src = '<?= base_url() ?>uploads/' + data?.[0]?.['foto'] ?? '';
        document.querySelector(`#npk_${line}_${index}`).innerHTML = String(data?.[0]?.['npk'] ?? '').padStart(4, '0');
        if (line !== 'indirect') {
          let skill = document.querySelector(`#skill_${line}_${index}`);
          skill.style.backgroundColor = (data?.[0]?.['skill']) ? colorSkill[data?.[0]?.['skill']] : 'transparent';
          let status = document.querySelector(`#status_${line}_${index}`);
          status.innerHTML = (min_skill_form.value <= (data?.[0]?.['skill'] ?? 0)) ? 'OK' : 'Kontrol';
          status.style.color = (min_skill_form.value <= (data?.[0]?.['skill'] ?? 0)) ? '#00aa00' : '#ff0000';
        }
      }
    })
  }

  function btn_add_mp_tidak_hadir(line, index) {
    const keterangan = ['Cuti', 'Dinas Luar', 'Dispensasi', 'Izin', 'Mangkir', 'Opname', 'Sakit', 'Lain-lain'];
    let keterangan_opt = '';
    keterangan.forEach(ket => {
      keterangan_opt += `<option value="${ket}">${ket}</option>`;
    });
    let man_power = getManPowerAll();
    let formAddElement = document.querySelector('#form_add_mp_tidak_hadir');
    formAddElement.innerHTML = '';
    formAddElement.innerHTML = `
    <div class="form-group">
      <label class="form-label">Nama</label>
      <div class="input-group">
        <select style="width: 100%" name="nama_man_power" class="form-control select2" id="nama_man_power">
          <option value="" selected>-- Pilih Man Power --</option>
          ${man_power}
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Keterangan</label>
      <div class="input-group">
        <select style="width: 100%" name="keterangan_man_power" class="form-control select2" id="keterangan_man_power">
          <option value="" selected>-- Pilih Keterangan --</option>
          ${keterangan_opt}
        </select>
      </div>
    </div>
    `;
    $(".select2").select2({
      dropdownParent: $(".modal_add_mp_tidak_hadir")
    });
    let button_add_mp_tidak_hadir = document.querySelector('#button_add_mp_tidak_hadir');
    button_add_mp_tidak_hadir.setAttribute('onclick', `add_man_power_tidak_hadir('${line}', ${index})`);
  }

  function getManPowerAll() {
    let data_man_power = '';
    all_data_man_power.forEach(admp => {
      data_man_power += `
        <option value="${admp.id_man_power}">${admp.nama}</option>
      `;
    });
    return data_man_power;
  }

  function add_man_power_tidak_hadir(line, index) {
    let nama_man_power = document.querySelector('#nama_man_power');
    let keterangan_man_power = document.querySelector('#keterangan_man_power');
    let id_cuti_mp_tidak_hadir = document.querySelector(`#id_cuti_mp_tidak_hadir_${line}_${index}`);
    let add_mp_tidak_masukElement = document.querySelector(`#add_mp_tidak_masuk_${line}_${index}`);
    if (nama_man_power.value !== '') {
      $.ajax({
        url: '<?= base_url() ?>dashboard_man_power/get_data_detail_man_power',
        type: 'POST',
        data: {
          nama_man_power: nama_man_power.value,
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
          add_mp_tidak_masukElement.innerHTML = `
            <td class="p-0" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">
              ${data?.[0]?.nama}
              <input type="hidden" name="nama_mp_tidak_hadir_${line}[]" value="${data?.[0]?.id_man_power}">
              <input type="hidden" name="id_cuti_mp_tidak_hadir_${line}[]" value="${id_cuti_mp_tidak_hadir?.value ?? ''}">
            </td>
            <td class="p-0 text-center">${String(data?.[0]?.npk).padStart(4, '0')}</td>
            <td class="p-0 text-center" name="keterangan_mp_tidak_hadir_${line}[]">${keterangan_man_power.value}</td>
          `;
          add_mp_tidak_masukElement.setAttribute('data-bs-toggle', 'modal');
          add_mp_tidak_masukElement.setAttribute('data-bs-target', '.modal_add_mp_tidak_hadir');
          add_mp_tidak_masukElement.setAttribute('onclick', `btn_add_mp_tidak_hadir('${line}', ${index})`);
        }
      });
    } else {
      add_mp_tidak_masukElement.removeAttribute('data-bs-toggle');
      add_mp_tidak_masukElement.removeAttribute('data-bs-target');
      add_mp_tidak_masukElement.removeAttribute('onclick');
      add_mp_tidak_masukElement.innerHTML = `
        <td colspan="3" class="text-center p-0">
          <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_${line}_${index}" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir(${line},${index})">Add</button>
        </td>
      `;
    }
  }

  function save_record_man_power() {
    $('#loading-modal').modal('show');
    let date = <?= json_encode(date('Y-m-d')) ?>;
    let sum_line = <?= json_encode($line) ?>;
    let sub_bagian = <?= json_encode($sub_bagian) ?>;
    let sum_mesin = 0;
    let shift = document.querySelector('#shift').value;
    let group_mp = document.getElementsByName('group[]');
    let group_indirect_mp = document.getElementsByName('group_indirect[]');
    let groupLineVal = [];
    let groupIndirectVal = [];
    let nama_mesinVal = [];
    let npkVal = [];
    let nama_mp_tidak_hadir = '';
    let nama_mp_tidak_hadir_indirect = document.getElementsByName('nama_mp_tidak_hadir_indirect[]');
    let keterangan_mp_tidak_hadir = '';
    let keterangan_mp_tidak_hadir_indirect = document.getElementsByName('keterangan_mp_tidak_hadir_indirect[]');
    let id_cuti_mp_tidak_hadir = '';
    let id_cuti_mp_tidak_hadir_indirect = document.getElementsByName('id_cuti_mp_tidak_hadir_indirect[]');
    let nama_mp_tidak_hadirVal = [];
    let nama_mp_tidak_hadir_indirectVal = [];
    let keterangan_mp_tidak_hadirVal = [];
    let keterangan_mp_tidak_hadir_indirectVal = [];
    let id_cuti_mp_tidak_hadirVal = [];
    let id_cuti_mp_tidak_hadir_indirectVal = [];
    let nama_mesin_indirect = '';
    let nama_mesinIndirectVal = [];
    let npk_indirect = document.getElementsByName('npk_indirect[]');
    let npkIndirectVal = [];

    group_mp.forEach(group => {
      groupLineVal.push(group.value);
    });
    let index_group_indirect_mp = 0;
    group_indirect_mp.forEach(group => {
      groupIndirectVal.push(group.value);
      nama_mesinIndirectVal.push(document.getElementById(`mesin_indirect_${index_group_indirect_mp}`).textContent);
      npkIndirectVal.push(document.getElementById(`npk_indirect_${index_group_indirect_mp}`).textContent);
      index_group_indirect_mp++;
    });
    sum_line.forEach(line_index => {
      sum_mesin = document.getElementsByName(`mesin_${line_index}[]`);
      for (let mesin_index = 0; mesin_index < sum_mesin.length; mesin_index++) {
        if (nama_mesinVal.hasOwnProperty(`${line_index}`)) {
          nama_mesinVal[`${line_index}`].push(document.querySelector(`#mesin_${line_index}_${mesin_index}`).textContent);
        } else {
          nama_mesinVal[`${line_index}`] = [document.querySelector(`#mesin_${line_index}_${mesin_index}`).textContent];
        }
        if (npkVal.hasOwnProperty(`${line_index}`)) {
          npkVal[`${line_index}`].push(document.querySelector(`#npk_${line_index}_${mesin_index}`).textContent);
        } else {
          npkVal[`${line_index}`] = [document.querySelector(`#npk_${line_index}_${mesin_index}`).textContent];
        }
      }
      nama_mp_tidak_hadir = document.getElementsByName(`nama_mp_tidak_hadir_${line_index}[]`);
      nama_mp_tidak_hadirVal[`${line_index}`] = [];
      nama_mp_tidak_hadir.forEach(nmth => {
        nama_mp_tidak_hadirVal[`${line_index}`].push(nmth.value);
      });
      keterangan_mp_tidak_hadir = document.getElementsByName(`keterangan_mp_tidak_hadir_${line_index}[]`);
      keterangan_mp_tidak_hadirVal[`${line_index}`] = [];
      keterangan_mp_tidak_hadir.forEach(kmth => {
        keterangan_mp_tidak_hadirVal[`${line_index}`].push(kmth.textContent);
      });
      id_cuti_mp_tidak_hadir = document.getElementsByName(`id_cuti_mp_tidak_hadir_${line_index}[]`);
      id_cuti_mp_tidak_hadirVal[`${line_index}`] = [];
      id_cuti_mp_tidak_hadir.forEach(icmth => {
        id_cuti_mp_tidak_hadirVal[`${line_index}`].push(icmth.value);
      });
    });
    nama_mp_tidak_hadir_indirect.forEach(nmthi => {
      nama_mp_tidak_hadir_indirectVal.push(nmthi.value);
    });
    keterangan_mp_tidak_hadir_indirect.forEach(kmthi => {
      keterangan_mp_tidak_hadir_indirectVal.push(kmthi.textContent);
    });
    id_cuti_mp_tidak_hadir_indirect.forEach(icmthi => {
      id_cuti_mp_tidak_hadir_indirectVal.push(icmthi.value);
    });
    $.ajax({
      url: '<?= base_url() ?>dashboard_man_power/save_record_man_power',
      type: 'POST',
      data: {
        date: date,
        shift: shift,
        sub_bagian: sub_bagian,
        group_mp: groupLineVal,
        nama_mesin: nama_mesinVal,
        npk: npkVal,
        line: sum_line,
        nama_mp_tidak_hadir: nama_mp_tidak_hadirVal,
        keterangan_mp_tidak_hadir: keterangan_mp_tidak_hadirVal,
        id_cuti_mp_tidak_hadir: id_cuti_mp_tidak_hadirVal,
        group_mp_indirect: groupIndirectVal,
        nama_mesin_indirect: nama_mesinIndirectVal,
        npk_indirect: npkIndirectVal,
        nama_mp_tidak_hadir_indirect: nama_mp_tidak_hadir_indirectVal,
        keterangan_mp_tidak_hadir_indirect: keterangan_mp_tidak_hadir_indirectVal,
        id_cuti_mp_tidak_hadir_indirect: id_cuti_mp_tidak_hadir_indirectVal,
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        window.location.href = '<?= base_url() ?>dashboard_man_power/' + sub_bagian;
        $('#loading-modal').modal('hide');
      }
    });
  }
</script>
<?= $this->endSection(); ?>