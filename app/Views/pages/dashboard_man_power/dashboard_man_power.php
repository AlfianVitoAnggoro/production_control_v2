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
<?php $lineAct = ['', 1, 2, 3, 4, 5, 6, 7, 'A', 'F', 'MCB']; ?>
<!-- Content Wrapper. Contains page content -->
<div class="container-full">
  <!-- Main content -->
  <section class="content p-0">
    <!-- <div class="">
      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" name="tanggal" id="tanggal" class="form-control">
    </div> -->
    <div class="row m-0">
      <div class="col-2 px-1">
        <div class="row m-0" style="height: 18vh;">
          <div class="col p-0">
            <div class="pe-1">
              <div class="box mb-2" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; height: 100%">
                <div class="fx-card-item">
                  <div class="fx-card-content">
                    <div class="d-flex justify-content-center align-items-center" style="border-radius: 5px 5px 0px 0px">
                      <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px">KADEPT</h4>
                    </div>
                  </div>
                  <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 140px">
                    <img src="<?= base_url() ?>uploads/1100.jpg" alt="" style="max-width: 100%; height: 140px" id="foto_kadept">
                  </div>
                  <div class="d-flex fx-card-footer px-1 py-1" style="height: 35px;">
                    <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                      <h5 class="m-0" style="font-size: 10px" id="npk_kadept">1100</h5>
                      <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;">Wisnu Rahayudi</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php if (strtolower($sub_bagian) === 'amb-1') { ?>
            <div class="col p-0">
              <div class="ps-1">
                <div class="box mb-2" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; height: 100%">
                  <div class="fx-card-item">
                    <div class="fx-card-content">
                      <div class="d-flex justify-content-center align-items-center" style="border-radius: 5px 5px 0px 0px">
                        <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px">KASIE</h4>
                      </div>
                    </div>
                    <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 140px">
                      <img src="<?= base_url() ?>uploads/3012.jpg" alt="" style="max-width: 100%; height: 140px" id="foto_kasie">
                    </div>
                    <div class="d-flex fx-card-footer px-1 py-1" style="height: 35px;">
                      <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                        <h5 class="m-0" style="font-size: 10px" id="npk_kasie">3012</h5>
                        <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;">Akhmad Mardhani</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } else if (strtolower($sub_bagian) === 'amb-2') { ?>
            <div class="col p-0">
              <div class="ps-1">
                <div class="box mb-2" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; height: 100%">
                  <div class="fx-card-item">
                    <div class="fx-card-content">
                      <div class="d-flex justify-content-center align-items-center" style="border-radius: 5px 5px 0px 0px">
                        <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px">Kasie</h4>
                      </div>
                    </div>
                    <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 140px">
                      <img src="<?= base_url() ?>uploads/kadept.jpg" alt="" style="max-width: 100%; height: 140px" id="foto_kadept">
                    </div>
                    <div class="d-flex fx-card-footer px-1 py-1" style="height: 35px;">
                      <div class="d-flex justify-content-between align-items-center" style="width: 100%;">
                        <h5 class="m-0" style="font-size: 10px" id="npk_kasie">1100</h5>
                        <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;">Novian Andika</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="row m-0 mb-2" style="height: calc(100% - 26vh - 7px)">
          <div class="col p-0" style="height: 100%">
            <figure class="highcharts-figure" style="height: 100%; border-radius: 5px;">
              <div id="horizontal_bar" style="height: 100%; border-radius: 5px;"></div>
            </figure>
          </div>
        </div>
        <div class="row m-0 pb-2" style="height: calc(8vh - 5px)">
          <div class="col p-0 bg-white" style="height: 100%">
            <h1 class="text-center m-0" style="font-size: 2vh">Skill Map</h1>
            <div class="row m-0 bg-white pb-2 d-flex justify-content-center align-items-center">
              <div class="d-flex justify-content-center align-items-center col p-0">
                <div class="d-flex justify-content-center align-items-center" style="background-color: #000000; width: calc(4vh + 10px); height: calc(4vh + 10px); border-radius: 50%; border: 0.1px solid black; font-size: 1vh; color: white">0%</div>
              </div>
              <div class="d-flex justify-content-center align-items-center col p-0">
                <div class="d-flex justify-content-center align-items-center" style="background-color: #ff0000; width: calc(4vh + 10px); height: calc(4vh + 10px); border-radius: 50%; border: 0.1px solid black; font-size: 1vh; color: white">25%</div>
              </div>
              <div class="d-flex justify-content-center align-items-center col p-0">
                <div class="d-flex justify-content-center align-items-center" style="background-color: #ffff00; width: calc(4vh + 10px); height: calc(4vh + 10px); border-radius: 50%; border: 0.1px solid black; font-size: 1vh; color: black">50%</div>
              </div>
              <div class="d-flex justify-content-center align-items-center col p-0">
                <div class="d-flex justify-content-center align-items-center" style="background-color: #0000ff; width: calc(4vh + 10px); height: calc(4vh + 10px); border-radius: 50%; border: 0.1px solid black; font-size: 1vh; color: white">75%</div>
              </div>
              <div class="d-flex justify-content-center align-items-center col p-0">
                <div class="d-flex justify-content-center align-items-center" style="background-color: #00aa00; width: calc(4vh + 10px); height: calc(4vh + 10px); border-radius: 50%; border: 0.1px solid black; font-size: 1vh; color: white">100%</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-10 ps-0">
        <?php for ($i = 0; $i < count($line); $i++) { ?>
          <?php $model = new App\Models\M_DashboardManPower();
          $data_mesin = $model->get_data_mesin($line[$i]);
          $sum_mesin[$line[$i]] = count($data_mesin);
          ?>

          <!-- <div class="d-flex justify-content-between" style="margin-right: 23px">
        <div class="d-flex" style="margin-left: 20px"> -->
          <div class="row m-0" style="height: 18vh;">
            <div class="col p-0">
              <div class="d-flex" style="width: 100%">
                <div class="d-flex justify-content-center align-items-center flex-column mb-2 mx-1" style="border-radius: 5px; background-color: #22A699; color: white; width: 100px">
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
                <div class="row row-cols-xl-10 m-0" style="width: calc(100% - 107px);">
                  <?php $index_mesin = 0;
                  foreach ($data_mesin as $msn) { ?>
                    <?php if (count($detail_record_man_power) > 0) {
                      // dd($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])]['Unloading COS']['nama']) 
                    ?>
                      <div class="col p-0 px-1">
                        <div class="mx-1">
                          <div class="box mb-2 card_box" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; background-image: <?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? (($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['status'] !== '') ? 'repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)' : '') : '') : '') : '') : '' ?>; background-color: <?= (((count($detail_record_mesin) > 0) ? ((array_key_exists($line[$i], $detail_record_mesin)) ? ((array_key_exists(array_key_first($detail_record_mesin[$line[$i]]), $detail_record_mesin[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_mesin[$line[$i]][array_key_first($detail_record_mesin[$line[$i]])])) ? ($detail_record_mesin[$line[$i]][array_key_first($detail_record_mesin[$line[$i]])][$msn['mesin']]['status_mesin']) : '') : '') : '') : '') !== 'Non-Aktif') ? ((count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? (($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['nama'] === '') ? '#9BA4B5' : '') : '#9BA4B5') : '#9BA4B5') : '#9BA4B5') : '#9BA4B5') : '#89375F' ?>" id="card_<?= $line[$i] ?>_<?= $index_mesin ?>">
                            <div class="fx-card-item">
                              <div class="fx-card-content">
                                <div class="d-flex justify-content-center align-items-start" style="border-radius: 5px 5px 0px 0px">
                                  <!-- <div class="d-flex justify-content-center align-items-center" style="background-color: <?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists($group, $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][$group])) ? ($color[$detail_record_man_power[$line[$i]][$group][$msn['mesin']]['skill']]) : '') : '') : '') : '' ?>; border-radius: 5px 5px 0px 0px"> -->
                                  <div style="width: 12%">
                                    <h4 class="mb-0 text-center p-1 fw-bold" style="font-size: 10px">&nbsp;</h4>
                                  </div>
                                  <div style="width: 76%">
                                    <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px" name="mesin_<?= $line[$i] ?>[]" id="mesin_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= $msn['mesin'] ?></h4>
                                  </div>
                                  <div style="width: 12%;" class="d-flex justify-content-end p-1">
                                    <div style="background-color: <?= $color[$msn['min_skill']] ?>; width: auto; height: auto; flex-grow: 1; aspect-ratio: 1/1; border-radius: 50%; border: 0.1px solid black" id="min_skill_color_<?= $line[$i] ?>_<?= $index_mesin ?>"></div>
                                  </div>
                                  <input type="hidden" name="nama_mp_<?= $line[$i] ?>[]" id="nama_mp_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['nama']) : '') : '') : '') : '' ?>">
                                  <input type="hidden" name="requirement_<?= $line[$i] ?>[]" id="requirement_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= $msn['requirement'] ?>">
                                  <input type="hidden" name="min_skill_<?= $line[$i] ?>[]" id="min_skill_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= $msn['min_skill'] ?>">
                                  <input type="hidden" name="status_mp_<?= $line[$i] ?>[]" id="status_mp_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['status']) : '') : '') : '') : '' ?>">
                                  <input type="hidden" name="status_mesin_<?= $line[$i] ?>[]" id="status_mesin_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= ((count($detail_record_mesin) > 0) ? ((array_key_exists($line[$i], $detail_record_mesin)) ? ((array_key_exists(array_key_first($detail_record_mesin[$line[$i]]), $detail_record_mesin[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_mesin[$line[$i]][array_key_first($detail_record_mesin[$line[$i]])])) ? ($detail_record_mesin[$line[$i]][array_key_first($detail_record_mesin[$line[$i]])][$msn['mesin']]['status_mesin']) : '') : '') : '') : '') ?>">
                                  <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                                </div>
                                <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]])) ? ($detail_record_man_power[$line[$i]][$msn['mesin']]['nama']) : 'NO MP') : 'NO MP') : 'NO MP' 
                                                                                  ?></h5> -->
                              </div>
                              <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 100%" id="picture_format_<?= $line[$i] ?>_<?= $index_mesin ?>">
                                <?php if (((count($detail_record_mesin) > 0) ? ((array_key_exists($line[$i], $detail_record_mesin)) ? ((array_key_exists(array_key_first($detail_record_mesin[$line[$i]]), $detail_record_mesin[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_mesin[$line[$i]][array_key_first($detail_record_mesin[$line[$i]])])) ? ($detail_record_mesin[$line[$i]][array_key_first($detail_record_mesin[$line[$i]])][$msn['mesin']]['status_mesin']) : '') : '') : '') : '') !== 'Non-Aktif') { ?>
                                  <img src="<?= base_url() ?>uploads/<?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['foto']) : '') : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 140px" id="foto_<?= $line[$i] ?>_<?= $index_mesin ?>">
                                <?php } else { ?>
                                  <img class="d-none" id="foto_<?= $line[$i] ?>_<?= $index_mesin ?>">
                                  <div class="m-0" style="font-size: 93.335px; color: white; background-image: repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)">&nbsp;</div>
                                <?php } ?>
                              </div>
                              <div class=" fx-card-footer px-1 py-1" id="footer_format_<?= $line[$i] ?>_<?= $index_mesin ?>">
                                <?php if (((count($detail_record_mesin) > 0) ? ((array_key_exists($line[$i], $detail_record_mesin)) ? ((array_key_exists(array_key_first($detail_record_mesin[$line[$i]]), $detail_record_mesin[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_mesin[$line[$i]][array_key_first($detail_record_mesin[$line[$i]])])) ? ($detail_record_mesin[$line[$i]][array_key_first($detail_record_mesin[$line[$i]])][$msn['mesin']]['status_mesin']) : '') : '') : '') : '') !== 'Non-Aktif') { ?>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-0" style="font-size: 10px" id="npk_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= sprintf('%04d', (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['npk']) : '') : '') : '') : '') ?></h5>
                                    <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;"><?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['nama']) : '') : '') : '') : '' ?></h5>
                                    <div style="border: 0.1px solid black; background-color: <?= (count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? ($color[$detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['skill']]) : '') : '') : '') : '' ?>; border-radius: 50%; width: 10px; height: 10px" id="skill_<?= $line[$i] ?>_<?= $index_mesin ?>"></div>
                                  </div>
                                <?php } else { ?>
                                  <div class="d-flex justify-content-between align-items-center" style="height: 12px">
                                    <h5 class="m-0" style="font-size: 10px" id="npk_<?= $line[$i] ?>_<?= $index_mesin ?>"></h5>
                                    <div style="border-radius: 50%; width: 10px; height: 10px" id="skill_<?= $line[$i] ?>_<?= $index_mesin ?>"></div>
                                  </div>
                                <?php } ?>
                                <!-- <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0" style="font-size: 10px">Min Skill</h5>
                          </div> -->
                                <?php if (((count($detail_record_mesin) > 0) ? ((array_key_exists($line[$i], $detail_record_mesin)) ? ((array_key_exists(array_key_first($detail_record_mesin[$line[$i]]), $detail_record_mesin[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_mesin[$line[$i]][array_key_first($detail_record_mesin[$line[$i]])])) ? ($detail_record_mesin[$line[$i]][array_key_first($detail_record_mesin[$line[$i]])][$msn['mesin']]['status_mesin']) : '') : '') : '') : '') !== 'Non-Aktif') { ?>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <!-- <h5 class="m-0" style="font-size: 10px">Status</h5> -->
                                    <h5 class="m-0" style="font-size: 10px; color: <?= ($msn['min_skill']  <= ((count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['skill'] : 0) : 0) : 0) : 0))  ? '#00aa00' : '#ff0000' ?>" id="status_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= ((count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['skill'] : 0) : 0) : 0) : 0) ? (($msn['min_skill']  <= ((count($detail_record_man_power) > 0) ? ((array_key_exists($line[$i], $detail_record_man_power)) ? ((array_key_exists(array_key_first($detail_record_man_power[$line[$i]]), $detail_record_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])])) ? $detail_record_man_power[$line[$i]][array_key_first($detail_record_man_power[$line[$i]])][$msn['mesin']]['skill'] : 0) : 0) : 0) : 0)) ? 'OK' : 'Kontrol') : 'Kosong' ?></h5>
                                    <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('<?= $line[$i] ?>', <?= $index_mesin ?>)">Edit</button>
                                  </div>
                                <?php } else { ?>
                                  <div class="d-flex justify-content-between align-items-center" style="height: 15.1px">
                                    <!-- <h5 class="m-0" style="font-size: 10px">Status</h5> -->
                                    <h5 class="m-0" style="font-size: 10px;" id="status_<?= $line[$i] ?>_<?= $index_mesin ?>"></h5>
                                    <!-- <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('<?= $line[$i] ?>', <?= $index_mesin ?>)">Edit</button> -->
                                  </div>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } else { ?>
                      <div class="col p-0">
                        <div class="px-1">
                          <div class="box mb-2 card_box" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; background-color: <?= ($data_group_mesin[$line[$i]][$group][$msn['mesin']]['status'] !== 'Non-Aktif') ? ((count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? (($data_group_man_power[$line[$i]][$group][$msn['mesin']]['nama'] === '') ? '#9BA4B5' : '') : '#9BA4B5') : '#9BA4B5') : '#9BA4B5') : '#9BA4B5') : '#89375F' ?>" id="card_<?= $line[$i] ?>_<?= $index_mesin ?>">
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
                                    <div style="background-color: <?= $color[$msn['min_skill']] ?>; width: auto; height: auto; flex-grow: 1; aspect-ratio: 1/1; border-radius: 50%; border: 0.1px solid black" id="min_skill_color_<?= $line[$i] ?>_<?= $index_mesin ?>"></div>
                                  </div>
                                  <input type="hidden" name="nama_mp_<?= $line[$i] ?>[]" id="nama_mp_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= (count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? $data_group_man_power[$line[$i]][$group][$msn['mesin']]['nama'] : '') : '') : '') : '' ?>">
                                  <input type="hidden" name="requirement_<?= $line[$i] ?>[]" id="requirement_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= $msn['requirement'] ?>">
                                  <input type="hidden" name="min_skill_<?= $line[$i] ?>[]" id="min_skill_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= $msn['min_skill'] ?>">
                                  <input type="hidden" name="status_mp_<?= $line[$i] ?>[]" id="status_mp_<?= $line[$i] ?>_<?= $index_mesin ?>" value="">
                                  <input type="hidden" name="status_mesin_<?= $line[$i] ?>[]" id="status_mesin_<?= $line[$i] ?>_<?= $index_mesin ?>" value="<?= $data_group_mesin[$line[$i]][$group][$msn['mesin']]['status'] ?>">
                                  <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                                </div>
                                <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]])) ? ($data_group_man_power[$line[$i]][$msn['mesin']]['nama']) : 'NO MP') : 'NO MP') : 'NO MP' 
                                                                                  ?></h5> -->
                              </div>
                              <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 100%" id="picture_format_<?= $line[$i] ?>_<?= $index_mesin ?>">
                                <?php if ($data_group_mesin[$line[$i]][$group][$msn['mesin']]['status'] !== 'Non-Aktif') { ?>
                                  <img src="<?= base_url() ?>uploads/<?= (count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? $data_group_man_power[$line[$i]][$group][$msn['mesin']]['foto'] : '') : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 140px" id="foto_<?= $line[$i] ?>_<?= $index_mesin ?>">
                                <?php } else { ?>
                                  <img class="d-none" id="foto_<?= $line[$i] ?>_<?= $index_mesin ?>">
                                  <div class="m-0" style="font-size: 93.335px; color: white; background-image: repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)">&nbsp;</div>
                                <?php } ?>
                              </div>
                              <div class="fx-card-footer px-1 py-1" id="footer_format_<?= $line[$i] ?>_<?= $index_mesin ?>">
                                <?php if ($data_group_mesin[$line[$i]][$group][$msn['mesin']]['status'] !== 'Non-Aktif') { ?>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-0" style="font-size: 10px" id="npk_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= sprintf('%04d', (count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? $data_group_man_power[$line[$i]][$group][$msn['mesin']]['npk'] : '') : '') : '') : '') ?></h5>
                                    <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;"><?= (count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? $data_group_man_power[$line[$i]][$group][$msn['mesin']]['nama'] : '') : '') : '') : '' ?></h5>
                                    <div style="border: 0.1px solid black; background-color: <?= (count($data_group_man_power) > 0) ? ((array_key_exists($line[$i], $data_group_man_power)) ? ((array_key_exists($group, $data_group_man_power[$line[$i]])) ? ((array_key_exists($msn['mesin'], $data_group_man_power[$line[$i]][$group])) ? ($color[$data_group_man_power[$line[$i]][$group][$msn['mesin']]['skill']]) : '') : '') : '') : '' ?>; border-radius: 50%; width: 10px; height: 10px" id="skill_<?= $line[$i] ?>_<?= $index_mesin ?>"></div>
                                  </div>
                                <?php } else { ?>
                                  <div class="d-flex justify-content-between align-items-center" style="height: 12px">
                                    <h5 class="m-0" style="font-size: 10px" id="npk_<?= $line[$i] ?>_<?= $index_mesin ?>"></h5>
                                    <div style="border-radius: 50%; width: 10px; height: 10px" id="skill_<?= $line[$i] ?>_<?= $index_mesin ?>"></div>
                                  </div>
                                <?php } ?>
                                <!-- <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0" style="font-size: 10px">Min Skill</h5>
                          </div> -->
                                <?php if ($data_group_mesin[$line[$i]][$group][$msn['mesin']]['status'] !== 'Non-Aktif') { ?>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <!-- <h5 class="m-0" style="font-size: 10px">Status</h5> -->
                                    <h5 class="m-0" style="font-size: 10px; color: <?= ($msn['min_skill']  <= ($data_group_man_power[$line[$i]][$group][$msn['mesin']]['skill'] ?? 0)) ? '#00aa00' : '#ff0000' ?>" id="status_<?= $line[$i] ?>_<?= $index_mesin ?>"><?= ($data_group_man_power[$line[$i]][$group][$msn['mesin']]['skill'] ?? 0) ? (($msn['min_skill']  <= ($data_group_man_power[$line[$i]][$group][$msn['mesin']]['skill'] ?? 0)) ? 'OK' : 'Kontrol') : 'Kosong' ?></h5>
                                    <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('<?= $line[$i] ?>', <?= $index_mesin ?>)">Edit</button>
                                  </div>
                                <?php } else { ?>
                                  <div class="d-flex justify-content-between align-items-center" style="height: 15.1px">
                                    <!-- <h5 class="m-0" style="font-size: 10px">Status</h5> -->
                                    <h5 class="m-0" style="font-size: 10px;" id="status_<?= $line[$i] ?>_<?= $index_mesin ?>"></h5>
                                    <!-- <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('<?= $line[$i] ?>', <?= $index_mesin ?>)">Edit</button> -->
                                  </div>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  <?php $index_mesin++;
                  } ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php $data_indirect = $model->get_data_indirect(str_replace('-', '_', $sub_bagian)) ?>
        <div class="row m-0" style="height: 18vh;">
          <div class="col p-0">
            <!-- <div class="row">
          <div class="col"> -->
            <div class="d-flex" style="width: 100%; height: calc(100% - 8px)">
              <div class="d-flex justify-content-center align-items-center flex-column mx-1" style="width: 100px; border-radius: 5px; background: #F86F03; color: white">
                <?php $word_indirect = str_split('INDIRECT');
                foreach ($word_indirect as $wi) { ?>
                  <h4 class="fw-bold m-0" style="font-size: 16px"><?= $wi ?></h4>
                <?php } ?>
              </div>
              <div class="row row-cols-xl-10 m-0" style="width: calc(100% - 107px); background-color: #F86F03; border-radius: 5px;">
                <!-- <div class="col" style="width: 100px">
                
              </div> -->
                <?php $index_indirect = 0;
                foreach ($data_indirect as $di) { ?>
                  <?php "" //if(strpos($di['mesin'], 'Kasubsie') === 0 || strpos($di['mesin'], 'Improvement') === 0) { 
                  ?>
                  <?php if (strpos($di['mesin'], 'Kasubsie') === 0) { ?>
                    <?php if (count($detail_record_man_power_indirect_all) > 0) { ?>
                      <div class="col p-0">
                        <div class="d-flex justify-content-center align-items-top">
                          <h4 style="font-size: 16px; color: white" class="m-0">Group</h4>
                          <select name="group_indirect[]" id="group_indirect_<?= $index_indirect ?>" class="form-select p-0 ps-5 ms-1" style="height: 20px; font-size: 12px; width: 50px" onchange="changeGroupIndirect('indirect', '<?= $sub_bagian ?>', <?= $index_indirect ?>)">
                            <option value="A" <?= count($detail_record_man_power_kasubsie) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_first($detail_record_man_power_kasubsie[$di['mesin']]) === 'A') ? 'selected' : '') : '') : '' ?>>A</option>
                            <option value="B" <?= count($detail_record_man_power_kasubsie) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_first($detail_record_man_power_kasubsie[$di['mesin']]) === 'B') ? 'selected' : '') : '') : '' ?>>B</option>
                            <option value="C" <?= count($detail_record_man_power_kasubsie) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_first($detail_record_man_power_kasubsie[$di['mesin']]) === 'C') ? 'selected' : '') : '') : '' ?>>C</option>
                          </select>
                        </div>
                        <div class="px-1">
                          <div class="box card_box" style="margin-bottom: 8px; box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; background-image: <?= (count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_exists(array_key_first($detail_record_man_power_kasubsie[$di['mesin']]), $detail_record_man_power_kasubsie[$di['mesin']])) ? (($detail_record_man_power_kasubsie[$di['mesin']][array_key_first($detail_record_man_power_kasubsie[$di['mesin']])]['status'] !== '') ? 'repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)' : '') : '') : '') : '' ?>; background-color: <?= (((count($detail_record_mesin_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_mesin_indirect)) ? ((array_key_exists(array_key_first($detail_record_mesin_indirect[$di['mesin']]), $detail_record_mesin_indirect[$di['mesin']])) ? ($detail_record_mesin_indirect[$di['mesin']][array_key_first($detail_record_mesin_indirect[$di['mesin']])]['status_mesin']) : '') : '') : '') !== 'Non-Aktif') ? ((count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_exists(array_key_first($detail_record_man_power_kasubsie[$di['mesin']]), $detail_record_man_power_kasubsie[$di['mesin']])) ? (($detail_record_man_power_kasubsie[$di['mesin']][array_key_first($detail_record_man_power_kasubsie[$di['mesin']])]['nama'] === '') ? '#9BA4B5' : '') : '#9BA4B5') : '#9BA4B5') : '#9BA4B5') : '#89375F' ?>;" id="card_indirect_<?= $index_indirect ?>">
                            <div class="fx-card-item">
                              <div class="fx-card-content">
                                <div class="d-flex justify-content-center align-items-center" style="background-color: <?= "" //(count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ($color[$detail_record_man_power_kasubsie[$di['mesin']]['skill']]) : '') : '' 
                                                                                                                        ?>; border-radius: 5px 5px 0px 0px">
                                  <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px" id="mesin_indirect_<?= $index_indirect ?>"><?= $di['mesin'] ?></h4>
                                  <input type="hidden" name="nama_mp_indirect[]" id="nama_mp_indirect_<?= $index_indirect ?>" value="<?= (count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_exists(array_key_first($detail_record_man_power_kasubsie[$di['mesin']]), $detail_record_man_power_kasubsie[$di['mesin']])) ? ($detail_record_man_power_kasubsie[$di['mesin']][array_key_first($detail_record_man_power_kasubsie[$di['mesin']])]['nama']) : '') : '') : '' ?>">
                                  <input type="hidden" name="status_mp_indirect[]" id="status_mp_indirect_<?= $index_indirect ?>" value="<?= (count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_exists(array_key_first($detail_record_man_power_kasubsie[$di['mesin']]), $detail_record_man_power_kasubsie[$di['mesin']])) ? ($detail_record_man_power_kasubsie[$di['mesin']][array_key_first($detail_record_man_power_kasubsie[$di['mesin']])]['status']) : '') : '') : '' ?>">
                                  <input type="hidden" name="status_mesin_indirect[]" id="status_mesin_indirect_<?= $index_indirect ?>" value="<?= ((count($detail_record_mesin_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_mesin_indirect)) ? ((array_key_exists(array_key_first($detail_record_mesin_indirect[$di['mesin']]), $detail_record_mesin_indirect[$di['mesin']])) ? ($detail_record_mesin_indirect[$di['mesin']][array_key_first($detail_record_mesin_indirect[$di['mesin']])]['status_mesin']) : '') : '') : '') ?>">
                                  <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                                </div>
                                <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ($detail_record_man_power_kasubsie[$di['mesin']]['nama']) : 'NO MP') : 'NO MP' 
                                                                                  ?></h5> -->
                              </div>
                              <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 100%" id="picture_format_indirect_<?= $index_indirect ?>">
                                <?php if (((count($detail_record_mesin_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_mesin_indirect)) ? ((array_key_exists(array_key_first($detail_record_mesin_indirect[$di['mesin']]), $detail_record_mesin_indirect[$di['mesin']])) ? ($detail_record_mesin_indirect[$di['mesin']][array_key_first($detail_record_mesin_indirect[$di['mesin']])]['status_mesin']) : '') : '') : '') !== 'Non-Aktif') { ?>
                                  <img src="<?= base_url() ?>uploads/<?= (count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_exists(array_key_first($detail_record_man_power_kasubsie[$di['mesin']]), $detail_record_man_power_kasubsie[$di['mesin']])) ? ($detail_record_man_power_kasubsie[$di['mesin']][array_key_first($detail_record_man_power_kasubsie[$di['mesin']])]['foto']) : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 140px" id="foto_indirect_<?= $index_indirect ?>">
                                <?php } else { ?>
                                  <img class="d-none" id="foto_indirect_<?= $index_indirect ?>">
                                  <div class="m-0" style="font-size: 93.335px; color: white; background-image: repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)">&nbsp;</div>
                                <?php } ?>
                              </div>
                              <?php if (((count($detail_record_mesin_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_mesin_indirect)) ? ((array_key_exists(array_key_first($detail_record_mesin_indirect[$di['mesin']]), $detail_record_mesin_indirect[$di['mesin']])) ? ($detail_record_mesin_indirect[$di['mesin']][array_key_first($detail_record_mesin_indirect[$di['mesin']])]['status_mesin']) : '') : '') : '') !== 'Non-Aktif') { ?>
                                <div class="fx-card-footer px-1 py-1 d-flex justify-content-between align-items-center" id="footer_format_indirect_<?= $index_indirect ?>">
                                  <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_exists(array_key_first($detail_record_man_power_kasubsie[$di['mesin']]), $detail_record_man_power_kasubsie[$di['mesin']])) ? ($detail_record_man_power_kasubsie[$di['mesin']][array_key_first($detail_record_man_power_kasubsie[$di['mesin']])]['npk']) : '') : '') : '') ?></h5>
                                  <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;"><?= (count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ((array_key_exists(array_key_first($detail_record_man_power_kasubsie[$di['mesin']]), $detail_record_man_power_kasubsie[$di['mesin']])) ? ($detail_record_man_power_kasubsie[$di['mesin']][array_key_first($detail_record_man_power_kasubsie[$di['mesin']])]['nama']) : '') : '') : '' ?></h5>
                                  <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button>
                                  <!-- <div style="background-color: <?= "" //(count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ($color[$detail_record_man_power_kasubsie[$di['mesin']]['skill']]) : '') : '' 
                                                                      ?>; border-radius: 50%; width: 24px; height: 24px"></div> -->
                                </div>
                              <?php } else { ?>
                                <div class="fx-card-footer px-1 py-1 d-flex justify-content-between align-items-center" style="height: 22.1px;" id="footer_format_indirect_<?= $index_indirect ?>">
                                  <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"></h5>
                                  <!-- <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button> -->
                                  <!-- <div style="background-color: <?= "" //(count($detail_record_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_kasubsie)) ? ($color[$detail_record_man_power_kasubsie[$di['mesin']]['skill']]) : '') : '' 
                                                                      ?>; border-radius: 50%; width: 24px; height: 24px"></div> -->
                                </div>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php $index_indirect++;
                    } else { ?>
                      <div class="col p-0">
                        <div class="d-flex justify-content-center align-items-top">
                          <h4 style="font-size: 16px; color: white" class="m-0">Group</h4>
                          <select name="group_indirect[]" id="group_indirect_<?= $index_indirect ?>" class="form-select p-0 ps-5 ms-1" style="height: 20px; font-size: 12px; width: 50px" onchange="changeGroupIndirect('indirect', '<?= $sub_bagian ?>', <?= $index_indirect ?>)">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                          </select>
                        </div>
                        <div class="px-1">
                          <div class="box card_box" style="margin-bottom: 8px; box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; background-color: <?= ($data_group_mesin_indirect[$group][$di['mesin']]['status'] !== 'Non-Aktif') ? ((count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($group, $data_group_man_power_kasubsie)) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie[$group])) ? (($data_group_man_power_kasubsie[$group][$di['mesin']]['nama'] === '') ? '#9BA4B5' : '') : '#9BA4B5') : '#9BA4B5') : '#9BA4B5') : '#89375F' ?>" id="card_indirect_<?= $index_indirect ?>">
                            <div class="fx-card-item">
                              <div class="fx-card-content">
                                <div class="d-flex justify-content-center align-items-center" style="background-color: <?= "" //(count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie)) ? ($color[$data_group_man_power_kasubsie[$di['mesin']]['skill']]) : '') : '' 
                                                                                                                        ?>; border-radius: 5px 5px 0px 0px">
                                  <h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px" id="mesin_indirect_<?= $index_indirect ?>"><?= $di['mesin'] ?></h4>
                                  <input type="hidden" name="nama_mp_indirect[]" id="nama_mp_indirect_<?= $index_indirect ?>" value="<?= (count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($group, $data_group_man_power_kasubsie)) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie[$group])) ? ($data_group_man_power_kasubsie[$group][$di['mesin']]['nama']) : '') : '') : '' ?>">
                                  <input type="hidden" name="status_mp_indirect[]" id="status_mp_indirect_<?= $index_indirect ?>" value="">
                                  <input type="hidden" name="status_mesin_indirect[]" id="status_mesin_indirect_<?= $index_indirect ?>" value="<?= $data_group_mesin_indirect[$group][$di['mesin']]['status'] ?>">
                                  <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                                </div>
                                <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie)) ? ($data_group_man_power_kasubsie[$di['mesin']]['nama']) : 'NO MP') : 'NO MP' 
                                                                                  ?></h5> -->
                              </div>
                              <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 100%" id="picture_format_indirect_<?= $index_indirect ?>">
                                <?php if ($data_group_mesin_indirect[$group][$di['mesin']]['status'] !== 'Non-Aktif') { ?>
                                  <img src="<?= base_url() ?>uploads/<?= (count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($group, $data_group_man_power_kasubsie)) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie[$group])) ? ($data_group_man_power_kasubsie[$group][$di['mesin']]['foto']) : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 140px" id="foto_indirect_<?= $index_indirect ?>">
                                <?php } else { ?>
                                  <img class="d-none" id="foto_indirect_<?= $index_indirect ?>">
                                  <div class="m-0" style="font-size: 93.335px; color: white; background-image: repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)">&nbsp;</div>
                                <?php } ?>
                              </div>
                              <?php if ($data_group_mesin_indirect[$group][$di['mesin']]['status'] !== 'Non-Aktif') { ?>
                                <div class="fx-card-footer px-1 py-1 d-flex justify-content-between align-items-center" id="footer_format_indirect_<?= $index_indirect ?>">
                                  <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($group, $data_group_man_power_kasubsie)) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie[$group])) ? ($data_group_man_power_kasubsie[$group][$di['mesin']]['npk']) : '') : '') : '') ?></h5>
                                  <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;"><?= (count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($group, $data_group_man_power_kasubsie)) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie[$group])) ? ($data_group_man_power_kasubsie[$group][$di['mesin']]['nama']) : '') : '') : '' ?></h5>
                                  <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button>
                                  <!-- <div style="background-color: <?= "" //(count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie)) ? ($color[$data_group_man_power_kasubsie[$di['mesin']]['skill']]) : '') : '' 
                                                                      ?>; border-radius: 50%; width: 24px; height: 24px"></div> -->
                                </div>
                              <?php } else { ?>
                                <div class="fx-card-footer px-1 py-1 d-flex justify-content-between align-items-center" style="height: 22.1px" id="footer_format_indirect_<?= $index_indirect ?>">
                                  <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"></h5>
                                  <!-- <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button> -->
                                  <!-- <div style="background-color: <?= "" //(count($data_group_man_power_kasubsie) > 0) ? ((array_key_exists($di['mesin'], $data_group_man_power_kasubsie)) ? ($color[$data_group_man_power_kasubsie[$di['mesin']]['skill']]) : '') : '' 
                                                                      ?>; border-radius: 50%; width: 24px; height: 24px"></div> -->
                                </div>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php $index_indirect++;
                    }
                  } else { ?>
                    <?php if (count($detail_record_man_power_indirect_all) > 0) { ?>
                      <div class="col p-0">
                        <div class="d-flex justify-content-center align-items-top">
                          <h4 style="font-size: 16px; color: white" class="m-0">Group</h4>
                          <select name="group_indirect[]" id="group_indirect_<?= $index_indirect ?>" class="form-select p-0 ps-5 ms-1" style="height: 20px; font-size: 12px; width: 50px" onchange="changeGroupIndirect('indirect', '<?= $sub_bagian ?>', <?= $index_indirect ?>)">
                            <option value="A" <?= count($detail_record_man_power_indirect) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_first($detail_record_man_power_indirect[$di['mesin']]) === 'A') ? 'selected' : '') : '') : '' ?>>A</option>
                            <option value="B" <?= count($detail_record_man_power_indirect) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_first($detail_record_man_power_indirect[$di['mesin']]) === 'B') ? 'selected' : '') : '') : '' ?>>B</option>
                            <option value="C" <?= count($detail_record_man_power_indirect) > 0 ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_first($detail_record_man_power_indirect[$di['mesin']]) === 'C') ? 'selected' : '') : '') : '' ?>>C</option>
                          </select>
                        </div>
                        <div class="px-1">
                          <div class="box card_box" style="margin-bottom: 8px; box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; background-image: <?= (count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? (($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['status'] !== '') ? 'repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)' : '') : '') : '') : '' ?>; background-color: <?= (((count($detail_record_mesin_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_mesin_indirect)) ? ((array_key_exists(array_key_first($detail_record_mesin_indirect[$di['mesin']]), $detail_record_mesin_indirect[$di['mesin']])) ? ($detail_record_mesin_indirect[$di['mesin']][array_key_first($detail_record_mesin_indirect[$di['mesin']])]['status_mesin']) : '') : '') : '') !== 'Non-Aktif') ? ((count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? (($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['nama'] === '') ? '#9BA4B5' : '') : '#9BA4B5') : '#9BA4B5') : '#9BA4B5') : '#89375F' ?>" id="card_indirect_<?= $index_indirect ?>">
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
                                  <input type="hidden" name="requirement_indirect[]" id="requirement_indirect_<?= $index_indirect ?>" value="<?= $di['requirement'] ?>">
                                  <input type="hidden" name="status_mp_indirect[]" id="status_mp_indirect_<?= $index_indirect ?>" value="<?= (count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? ($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['status']) : '') : '') : '' ?>">
                                  <input type="hidden" name="status_mesin_indirect[]" id="status_mesin_indirect_<?= $index_indirect ?>" value="<?= ((count($detail_record_mesin_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_mesin_indirect)) ? ((array_key_exists(array_key_first($detail_record_mesin_indirect[$di['mesin']]), $detail_record_mesin_indirect[$di['mesin']])) ? ($detail_record_mesin_indirect[$di['mesin']][array_key_first($detail_record_mesin_indirect[$di['mesin']])]['status_mesin']) : '') : '') : '') ?>">

                                  <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                                </div>
                                <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ($detail_record_man_power_indirect[$di['mesin']]['nama']) : 'NO MP') : 'NO MP' 
                                                                                  ?></h5> -->
                              </div>
                              <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 100%" id="picture_format_indirect_<?= $index_indirect ?>">
                                <?php if (((count($detail_record_mesin_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_mesin_indirect)) ? ((array_key_exists(array_key_first($detail_record_mesin_indirect[$di['mesin']]), $detail_record_mesin_indirect[$di['mesin']])) ? ($detail_record_mesin_indirect[$di['mesin']][array_key_first($detail_record_mesin_indirect[$di['mesin']])]['status_mesin']) : '') : '') : '') !== 'Non-Aktif') { ?>
                                  <img src="<?= base_url() ?>uploads/<?= (count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? ($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['foto']) : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 140px" id="foto_indirect_<?= $index_indirect ?>">
                                <?php } else { ?>
                                  <img class="d-none" id="foto_indirect_<?= $index_indirect ?>">
                                  <div class="m-0" style="font-size: 93.335px; color: white; background-image: repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)">&nbsp;</div>
                                <?php } ?>
                              </div>
                              <div class="fx-card-footer px-1 py-1" id="footer_format_indirect_<?= $index_indirect ?>">
                                <!-- <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? ($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['npk']) : '') : '') : '') ?></h5>
                            <div style="background-color: <?= "" //(count($detail_record_man_power_indirect) > 0) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect), $detail_record_man_power_indirect)) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect[array_key_first($detail_record_man_power_indirect)])) ? ($color[$detail_record_man_power_indirect[array_key_first($detail_record_man_power_indirect)][$di['mesin']]['skill']]) : '') : '') : '' 
                                                          ?>; border-radius: 50%; width: 10px; height: 10px" id="skill_indirect_<?= $index_indirect ?>"></div>
                          </div> -->
                                <!-- <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0" style="font-size: 10px">Min Skill</h5>
                          </div> -->
                                <?php if (((count($detail_record_mesin_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_mesin_indirect)) ? ((array_key_exists(array_key_first($detail_record_mesin_indirect[$di['mesin']]), $detail_record_mesin_indirect[$di['mesin']])) ? ($detail_record_mesin_indirect[$di['mesin']][array_key_first($detail_record_mesin_indirect[$di['mesin']])]['status_mesin']) : '') : '') : '') !== 'Non-Aktif') { ?>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? ($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['npk']) : '') : '') : '') ?></h5>
                                    <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;"><?= (count($detail_record_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $detail_record_man_power_indirect)) ? ((array_key_exists(array_key_first($detail_record_man_power_indirect[$di['mesin']]), $detail_record_man_power_indirect[$di['mesin']])) ? ($detail_record_man_power_indirect[$di['mesin']][array_key_first($detail_record_man_power_indirect[$di['mesin']])]['nama']) : '') : '') : '' ?></h5>
                                    <!-- <h5 class="m-0" style="font-size: 10px; color: <?= "" //($di['min_skill']  <= ($detail_record_man_power_indirect[array_key_first($detail_record_man_power_indirect)][$di['mesin']]['skill'] ?? 0)) ? '#00aa00' : '#ff0000' 
                                                                                        ?>" id="status_indirect_<?= $index_indirect ?>"><?= "" //($di['min_skill']  <= ($detail_record_man_power_indirect[array_key_first($detail_record_man_power_indirect)][$di['mesin']]['skill'] ?? 0)) ? 'OK' : 'Kontrol' 
                                                                                                                                        ?></h5> -->
                                    <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button>
                                  </div>
                                <?php } else { ?>
                                  <div class="d-flex justify-content-between align-items-center" style="height: 15.1px;">
                                    <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"></h5>
                                    <!-- <h5 class="m-0" style="font-size: 10px; color: <?= "" //($di['min_skill']  <= ($detail_record_man_power_indirect[array_key_first($detail_record_man_power_indirect)][$di['mesin']]['skill'] ?? 0)) ? '#00aa00' : '#ff0000' 
                                                                                        ?>" id="status_indirect_<?= $index_indirect ?>"><?= "" //($di['min_skill']  <= ($detail_record_man_power_indirect[array_key_first($detail_record_man_power_indirect)][$di['mesin']]['skill'] ?? 0)) ? 'OK' : 'Kontrol' 
                                                                                                                                        ?></h5> -->
                                    <!-- <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button> -->
                                  </div>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php $index_indirect++;
                    } else { ?>
                      <div class="col p-0">
                        <div class="d-flex justify-content-center align-items-top">
                          <h4 style="font-size: 16px; color: white" class="m-0">Group</h4>
                          <select name="group_indirect[]" id="group_indirect_<?= $index_indirect ?>" class="form-select p-0 ps-5 ms-1" style="height: 20px; font-size: 12px; width: 50px" onchange="changeGroupIndirect('indirect', '<?= $sub_bagian ?>', <?= $index_indirect ?>)">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                          </select>
                        </div>
                        <div class="px-1">
                          <div class="box card_box" style="margin-bottom: 8px; box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; background-color: <?= ($data_group_mesin_indirect[$group][$di['mesin']]['status'] !== 'Non-Aktif') ? ((count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? (($data_group_man_power_indirect[$group][$di['mesin']]['nama'] === '') ? '#9BA4B5' : '') : '#9BA4B5') : '#9BA4B5') : '#9BA4B5') : '#89375F' ?>" id="card_indirect_<?= $index_indirect ?>">
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
                                  <input type="hidden" name="requirement_indirect[]" id="requirement_indirect_<?= $index_indirect ?>" value="<?= $di['requirement'] ?>">
                                  <input type="hidden" name="status_mp_indirect[]" id="status_mp_indirect_<?= $index_indirect ?>" value="">
                                  <input type="hidden" name="status_mesin_indirect[]" id="status_mesin_indirect_<?= $index_indirect ?>" value="<?= $data_group_mesin_indirect[$group][$di['mesin']]['status'] ?>">

                                  <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                                </div>
                                <!-- <h5 class="box-title mb-0 text-center py-2"><?= "" //(count($data_group_man_power_indirect) > 0) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect)) ? ($data_group_man_power_indirect[$di['mesin']]['nama']) : 'NO MP') : 'NO MP' 
                                                                                  ?></h5> -->
                              </div>
                              <div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 100%" id="picture_format_indirect_<?= $index_indirect ?>">
                                <?php if ($data_group_mesin_indirect[$group][$di['mesin']]['status'] !== 'Non-Aktif') { ?>
                                  <img src="<?= base_url() ?>uploads/<?= (count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? ($data_group_man_power_indirect[$group][$di['mesin']]['foto']) : '') : '') : '' ?>" alt="" style="max-width: 100%; height: 140px" id="foto_indirect_<?= $index_indirect ?>">
                                <?php } else { ?>
                                  <img class="d-none" id="foto_indirect_<?= $index_indirect ?>">
                                  <div class="m-0" style="font-size: 93.335px; color: white; background-image: repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)">&nbsp;</div>
                                <?php } ?>
                              </div>
                              <div class="fx-card-footer px-1 py-1" id="footer_format_indirect_<?= $index_indirect ?>">
                                <!-- <div class="d-flex justify-content-between align-items-center">
          <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? ($data_group_man_power_indirect[$group][$di['mesin']]['npk']) : '') : '') : '') ?></h5>
          <div style="background-color: <?= "" //(count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? ($color[$data_group_man_power_indirect[$group][$di['mesin']]['skill']]) : '') : '') : '' 
                                        ?>; border-radius: 50%; width: 10px; height: 10px" id="skill_indirect_<?= $index_indirect ?>"></div>
        </div> -->
                                <!-- <div class="d-flex justify-content-between align-items-center">
          <h5 class="m-0" style="font-size: 10px">Min Skill</h5>
        </div> -->
                                <?php if ($data_group_mesin_indirect[$group][$di['mesin']]['status'] !== 'Non-Aktif') { ?>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"><?= sprintf('%04d', (count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? ($data_group_man_power_indirect[$group][$di['mesin']]['npk']) : '') : '') : '') ?></h5>
                                    <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;"><?= (count($data_group_man_power_indirect) > 0) ? ((array_key_exists($group, $data_group_man_power_indirect)) ? ((array_key_exists($di['mesin'], $data_group_man_power_indirect[$group])) ? ($data_group_man_power_indirect[$group][$di['mesin']]['nama']) : '') : '') : '' ?></h5>
                                    <!-- <h5 class="m-0" style="font-size: 10px; color: <?= "" //($di['min_skill']  <= ($data_group_man_power_indirect[$group][$di['mesin']]['skill'] ?? 0)) ? '#00aa00' : '#ff0000' 
                                                                                        ?>" id="status_indirect_<?= $index_indirect ?>"><?= "" //($di['min_skill']  <= ($data_group_man_power_indirect[$group][$di['mesin']]['skill'] ?? 0)) ? 'OK' : 'Kontrol' 
                                                                                                                                        ?></h5> -->
                                    <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button>
                                  </div>
                                <?php } else { ?>
                                  <div class="d-flex justify-content-between align-items-center" style="height: 15.1px">
                                    <h5 class="m-0" style="font-size: 10px" id="npk_indirect_<?= $index_indirect ?>"></h5>
                                    <!-- <h5 class="m-0" style="font-size: 10px; color: <?= "" //($di['min_skill']  <= ($data_group_man_power_indirect[$group][$di['mesin']]['skill'] ?? 0)) ? '#00aa00' : '#ff0000' 
                                                                                        ?>" id="status_indirect_<?= $index_indirect ?>"><?= "" //($di['min_skill']  <= ($data_group_man_power_indirect[$group][$di['mesin']]['skill'] ?? 0)) ? 'OK' : 'Kontrol' 
                                                                                                                                        ?></h5> -->
                                    <!-- <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('indirect', <?= $index_indirect ?>)">Edit</button> -->
                                  </div>
                                <?php } ?>
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
            <!-- </div>
        </div> -->
          </div>
        </div>
      </div>
    </div>
    <div class="row m-0" style="height: calc(18vh - 7px);">
      <a href="<?= base_url() ?>dashboard_cuti" class="d-flex justify-content-center align-items-center flex-column mx-1 mb-2" style="width: 100px; border-radius: 5px; background: red; color: white; cursor: pointer">
        <?php $word_absen = str_split('ABSENTEISM');
        foreach ($word_absen as $wa) { ?>
          <h4 class="fw-bold m-0" style="font-size: 16px"><?= $wa ?></h4>
        <?php } ?>
      </a>
      <?php for ($i = 0; $i < count($line); $i++) { ?>
        <div class="col mb-2">
          <table class="table bg-white" style="height: 100%; border-radius: 5px">
            <thead>
              <tr>
                <th style="font-size: 12px" class="py-1 px-0 text-center">Line <?= $line[$i] ?></th>
                <th style="font-size: 12px" class="py-1 px-0 text-center">Nama</th>
                <th style="font-size: 12px" class="py-1 px-0 text-center">NPK</th>
                <th style="font-size: 12px" class="py-1 px-0 text-center">Keterangan</th>
              </tr>
            </thead>
            <tbody id="data_mp_tidak_hadir_<?= $line[$i] ?>">
              <?php if (array_key_exists($line[$i], $data_mp_tidak_hadir) ? count($data_mp_tidak_hadir[$line[$i]]) : 0) {
                $temp_index_add = 0;
                foreach ($data_mp_tidak_hadir[$line[$i]] as $dmth) { ?>
                  <tr id="add_mp_tidak_masuk_<?= $line[$i] ?>_<?= $temp_index_add ?>" style="border-bottom: <?= $temp_index_add === 2 ? 'transparent' : '' ?>;" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('<?= $line[$i] ?>', <?= $temp_index_add ?>)">
                    <td class="p-0" colspan="2" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">
                      <?= $dmth['nama'] ?>
                      <input type="hidden" name="nama_mp_tidak_hadir_<?= $line[$i] ?>[]" value="<?= $dmth['id_man_power'] ?>">
                      <input type="hidden" name="id_cuti_mp_tidak_hadir_<?= $line[$i] ?>[]" id="id_cuti_mp_tidak_hadir_<?= $line[$i] ?>_<?= $temp_index_add ?>" value="<?= $dmth['id_cuti'] ?>">
                    </td>
                    <td class="p-0 text-center"><?= sprintf('%04d', $dmth['npk']) ?></td>
                    <td class="p-0 text-center" name="keterangan_mp_tidak_hadir_<?= $line[$i] ?>[]"><?= $dmth['keterangan'] ?></td>
                  </tr>
                  <?php $temp_index_add++;
                }
                if ($temp_index_add < 3) {
                  for ($index_add = $temp_index_add; $index_add < 3; $index_add++) { ?>
                    <tr id="add_mp_tidak_masuk_<?= $line[$i] ?>_<?= $index_add ?>" style="border-bottom: <?= $index_add === 2 ? 'transparent' : '' ?>;">
                      <td colspan="4" class="text-center p-0">
                        <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_<?= $line[$i] ?>_<?= $index_add ?>" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('<?= $line[$i] ?>',<?= $index_add ?>)">Add</button>
                      </td>
                    </tr>
                <?php }
                } ?>
                <?php } else {
                for ($index_add = 0; $index_add < 3; $index_add++) { ?>
                  <tr id="add_mp_tidak_masuk_<?= $line[$i] ?>_<?= $index_add ?>" style="border-bottom: <?= $index_add === 2 ? 'transparent' : '' ?>;">
                    <td colspan="4" class="text-center p-0">
                      <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_<?= $line[$i] ?>_<?= $index_add ?>" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('<?= $line[$i] ?>',<?= $index_add ?>)">Add</button>
                    </td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      <?php } ?>
      <div class="col mb-2">
        <table class="table bg-white" style="height: 100%; border-radius: 5px">
          <thead>
            <tr>
              <th style="font-size: 12px" class="py-1 px-0 text-center">Indirect</th>
              <th style="font-size: 12px" class="py-1 px-0 text-center">Nama</th>
              <th style="font-size: 12px" class="py-1 px-0 text-center">NPK</th>
              <th style="font-size: 12px" class="py-1 px-0 text-center">Keterangan</th>
            </tr>
          </thead>
          <tbody id="data_mp_tidak_hadir_indirect">
            <?php if (count($data_mp_tidak_hadir_indirect) > 0) {
              $temp_index_add = 0;
              foreach ($data_mp_tidak_hadir_indirect as $dmth) { ?>
                <tr id="add_mp_tidak_masuk_indirect_<?= $temp_index_add ?>" style="border-bottom: <?= $temp_index_add === 2 ? 'transparent' : '' ?>;" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('indirect', <?= $temp_index_add ?>)">
                  <td class="p-0" colspan="2" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">
                    <?= $dmth['nama'] ?>
                    <input type="hidden" name="nama_mp_tidak_hadir_indirect[]" value="<?= $dmth['id_man_power'] ?>">
                    <input type="hidden" name="id_cuti_mp_tidak_hadir_indirect[]" id="id_cuti_mp_tidak_hadir_indirect_<?= $temp_index_add ?>" value="<?= $dmth['id_cuti'] ?>">
                  </td>
                  <td class="p-0 text-center"><?= sprintf('%04d', $dmth['npk']) ?></td>
                  <td class="p-0 text-center" name="keterangan_mp_tidak_hadir_indirect[]"><?= $dmth['keterangan'] ?></td>
                </tr>
                <?php $temp_index_add++;
              }
              if ($temp_index_add < 3) {
                for ($index_add = $temp_index_add; $index_add < 3; $index_add++) { ?>
                  <tr id="add_mp_tidak_masuk_indirect_<?= $index_add ?>" style="border-bottom: <?= $index_add === 2 ? 'transparent' : '' ?>;">
                    <td colspan="4" class="text-center p-0">
                      <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_indirect_<?= $index_add ?>" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('indirect',<?= $index_add ?>)">Add</button>
                    </td>
                  </tr>
              <?php }
              } ?>
              <?php } else {
              for ($index_add = 0; $index_add < 3; $index_add++) { ?>
                <tr id="add_mp_tidak_masuk_indirect_<?= $index_add ?>" style="border-bottom: <?= $index_add === 2 ? 'transparent' : '' ?>;">
                  <td colspan="4" class="text-center p-0">
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

<div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; top: 0;">
  <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-body" style="border-radius: 2.5px">
      <div class="d-flex align-items-center">
        <i class="fa fa-check me-3" aria-hidden="true"></i>
        <h5 class="message-body m-0"></h5>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
  let colorSkill = ['#000000', '#ff0000', '#ffff00', '#0000ff', '#00aa00'];

  function showToast(message, bgcolor, color) {
    $('.message-body').text(message);
    $('.toast-body').css('background-color', bgcolor);
    $('.toast-body').css('color', color);

    $('.toast').toast('show');
  }
  var blinkval;
  var compareblinkval;

  function blink(cardElement) {
    let colors = ["#FFEA20", "white"];
    let currentColorIndex = 0;
    blinkval = setInterval(function() {
      cardElement.style.backgroundColor = colors[currentColorIndex];
      currentColorIndex = (currentColorIndex + 1) % colors.length;
    }, 1000);
  }

  function compareblink(cardCompareElement) {
    let colors = ["green", "white"];
    let currentColorIndex = 0;
    compareblinkval = setInterval(function() {
      cardCompareElement.style.backgroundColor = colors[currentColorIndex];
      currentColorIndex = (currentColorIndex + 1) % colors.length;
    }, 1000);
  }

  $(document).ready(() => {
    let cardElement = '';
    let status_mp_indirectElement = document.getElementsByName('status_mp_indirect[]');
    let card_boxElement = document.querySelectorAll('.card_box');
    let getIdElement = '';
    let npkValue = '';
    let getCompareIdElement = '';
    let npkCompareValue = '';
    let line = <?= json_encode($line) ?>;
    let status_mp_lineElement = '';
    line.forEach((ln) => {
      status_mp_lineElement = document.getElementsByName(`status_mp_${ln}[]`);
      status_mp_lineElement.forEach((smpl) => {
        if (smpl.value.toLowerCase() === 'pengganti') {
          cardElement = smpl.parentNode.parentNode.parentNode.parentNode;
          getIdElement = smpl.id.split('_').slice(-2);
          npkValue = document.querySelector(`#npk_${getIdElement[0]}_${getIdElement[1]}`).textContent;
          card_boxElement.forEach((compare) => {
            cardCompareElement = compare;
            getCompareIdElement = compare.id.split('_').slice(-2);
            npkCompareValue = document.querySelector(`#npk_${getCompareIdElement[0]}_${getCompareIdElement[1]}`).textContent;
            if (npkValue == npkCompareValue) {
              compareblink(cardCompareElement);
            }
          });
          blink(cardElement);
        }
      });
    });
    status_mp_indirectElement.forEach((smpi) => {
      if (smpi.value.toLowerCase() === 'pengganti') {
        cardElement = smpi.parentNode.parentNode.parentNode.parentNode;
        getIdElement = smpi.id.split('_').slice(-2);
        npkValue = document.querySelector(`#npk_${getIdElement[0]}_${getIdElement[1]}`).textContent;
        card_boxElement.forEach((compare) => {
          cardCompareElement = compare;
          getCompareIdElement = compare.id.split('_').slice(-2);
          npkCompareValue = document.querySelector(`#npk_${getCompareIdElement[0]}_${getCompareIdElement[1]}`).textContent;
          if (npkValue == npkCompareValue) {
            compareblink(cardCompareElement);
          }
        });
        blink(cardElement);
      }
    });
    line.forEach(ln => {
      getCuti(ln, '<?= $sub_bagian ?>');
    });
    getCuti('indirect', '<?= $sub_bagian ?>');
  });

  function changeShift(sub_bagian) {
    let shift = document.querySelector('#shift').value;
    let date = document.querySelector('#date').value;
    $('#loading-modal').modal('show');
    window.location.href = `<?= base_url() . 'dashboard_man_power/' . $sub_bagian ?>/${date}/${shift}`
  }

  function getCuti(line, sub_bagian) {
    let date = <?= json_encode($date) ?>;
    console.log(date);
    let group_exist = [];
    if (line == 'indirect') {
      let data_indirect = <?= json_encode($data_indirect) ?>;
      for (let index = 0; index < data_indirect.length; index++) {
        groupElement = document.querySelector(`#group_${line}_${index}`).value;
        if (!group_exist.includes(groupElement)) {
          group_exist.push(groupElement);
        }
      }
    } else {
      group_exist.push(document.querySelector(`#group_${line}`).value);
    }
    $.ajax({
      url: '<?= base_url() ?>dashboard_man_power/getCutiByGroup',
      type: 'POST',
      data: {
        group_mp: group_exist,
        line: line,
        sub_bagian: sub_bagian,
        date: date,
      },
      dataType: 'json',
      success: function(data) {
        let count = 0;
        if (data.length > 0) {
          if (data.length <= 3) {
            for (let index_add = 0; index_add < 3; index_add++) {
              let cutiElement = document.querySelector(`#id_cuti_mp_tidak_hadir_${line}_${index_add}`);
              if (cutiElement == null) {
                if (count < data.length) {
                  console.log(document.querySelector(`#add_mp_tidak_masuk_${line}_${index_add}`));
                  document.querySelector(`#add_mp_tidak_masuk_${line}_${index_add}`).innerHTML = `
                    <td class="p-0" colspan="2" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">${data[count].nama}</td>
                    <td class="p-0 text-center">${String(data[count].npk).padStart(4, '0')}</td>
                    <td class="p-0 text-center">${data[count].kategori}</td>
                  `;
                  let status_mp_by_line = document.getElementsByName(`status_mp_${line}[]`);
                  status_mp_by_line.forEach(smbl => {
                    let getIdElement = smbl.id.split('_').slice(-2);
                    let npkElementValue = document.querySelector(`#npk_${getIdElement[0]}_${getIdElement[1]}`).textContent;
                    if (npkElementValue == String(data[count].npk).padStart(4, '0')) {
                      man_power_cuti(getIdElement[0], getIdElement[1]);
                    }
                  });
                  count++;
                } else {
                  console.log(data.length);
                  document.querySelector(`#add_mp_tidak_masuk_${line}_${index_add}`).innerHTML = `
                    <td colspan="4" class="text-center p-0">
                      <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_${line}_${index_add}" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('${line}',${index_add})">Add</button>
                    </td>
                  `;
                }
              }
            }
          } else {
            for (let index_add = 0; index_add < data.length; index_add++) {
              let cutiElement = document.querySelector(`#id_cuti_mp_tidak_hadir_${line}_${index_add}`);
              if (index_add < 3) {
                if (cutiElement == null) {
                  console.log(document.querySelector(`#add_mp_tidak_masuk_${line}_${index_add}`));
                  document.querySelector(`#add_mp_tidak_masuk_${line}_${index_add}`).innerHTML = `
                    <td class="p-0" colspan="2" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">${data[index_add].nama}</td>
                    <td class="p-0 text-center">${String(data[index_add].npk).padStart(4, '0')}</td>
                    <td class="p-0 text-center">${data[index_add].kategori}</td>
                  `;
                }
              } else {
                cutiElement = document.querySelector(`#data_mp_tidak_hadir_${line}`);
                console.log(cutiElement);
                cutiElement.innerHTML += `
                  <tr id="add_mp_tidak_masuk_${line}_${index_add}" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('indirect', ${index_add})">
                    <td class="p-0" colspan="2" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">${data[index_add].nama}</td>
                    <td class="p-0 text-center">${String(data[index_add].npk).padStart(4, '0')}</td>
                    <td class="p-0 text-center">${data[index_add].kategori}</td>
                  </tr>
                `;
              }
              let status_mp_by_line = document.getElementsByName(`status_mp_${line}[]`);
              status_mp_by_line.forEach(smbl => {
                let getIdElement = smbl.id.split('_').slice(-2);
                let npkElementValue = document.querySelector(`#npk_${getIdElement[0]}_${getIdElement[1]}`).textContent;
                if (npkElementValue == String(data[index_add].npk).padStart(4, '0')) {
                  man_power_cuti(getIdElement[0], getIdElement[1]);
                }
              });
            }
          }
        } else {
          for (let index_add = 0; index_add < 3; index_add++) {
            let cutiElement = document.querySelector(`#id_cuti_mp_tidak_hadir_${line}_${index_add}`);
            if (cutiElement == null) {
              document.querySelector(`#add_mp_tidak_masuk_${line}_${index_add}`).innerHTML = `
                <td colspan="4" class="text-center p-0">
                  <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_${line}_${index_add}" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir('${line}',${index_add})">Add</button>
                </td>
              `;
            }
          }
        }
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
          // document.querySelector(`#foto_${line}_${index_mesin}`).src = '<?= base_url() ?>uploads/' + data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['foto'] ?? '';
          // document.querySelector(`#npk_${line}_${index_mesin}`).innerHTML = String(data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['npk'] ?? '').padStart(4, '0');
          document.querySelector(`#picture_format_${line}_${index_mesin}`).innerHTML = `
            <img src="${'<?= base_url() ?>uploads/' + data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['foto'] ?? ''}" alt="" style="max-width: 100%; height: 140px" id="foto_${line}_${index_mesin}">
          `;
          document.querySelector(`#footer_format_${line}_${index_mesin}`).innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="m-0" style="font-size: 10px" id="npk_${line}_${index_mesin}">${String(data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['npk'] ?? '').padStart(4, '0')}</h5>
              <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;">${data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['nama'] ?? ''}</h5>
              <div style="border: 0.1px solid black; background-color: ${data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill'] ? colorSkill[data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill']] : 'transparent'}; border-radius: 50%; width: 10px; height: 10px" id="skill_${line}_${index_mesin}"></div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="m-0" style="font-size: 10px; color: ${(msn.min_skill <= (data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill'] ?? 0)) ? '#00aa00' : '#ff0000'}" id="status_${line}_${index_mesin}">${(data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill'] ?? 0) ? ((msn.min_skill <= (data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill'] ?? 0)) ? 'OK' : 'Kontrol') : 'Kosong'}</h5>
              <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('${line}', ${index_mesin})">Edit</button>
            </div>
          `;
          // skill = document.querySelector(`#skill_${line}_${index_mesin}`);
          // skill.style.backgroundColor = (data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill']) ? colorSkill[data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill']] : 'transparent';
          // status = document.querySelector(`#status_${line}_${index_mesin}`);
          // status.innerHTML = (data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill'] ?? 0) ? ((msn.min_skill <= (data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill'] ?? 0)) ? 'OK' : 'Kontrol') : 'Kosong';
          // status.style.color = (msn.min_skill <= (data?.data_group_man_power?.[line]?.[groupElement.value]?.[msn.mesin]?.['skill'] ?? 0)) ? '#00aa00' : '#ff0000';
          index_mesin++;
        });
        getCuti(line, sub_bagian);
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
          // document.querySelector(`#npk_${line}_${index}`).innerHTML = String(data?.data_group_man_power_kasubsie?.[mesin]?.[groupElement.value]?.['npk'] ?? '').padStart(4, '0');
          document.querySelector(`#footer_format_${line}_${index}`).innerHTML = `
            <h5 class="m-0" style="font-size: 10px" id="npk_${line}_${index}">${String(data?.data_group_man_power_kasubsie?.[mesin]?.[groupElement.value]?.['npk'] ?? '').padStart(4, '0')}</h5>
            <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;">${data?.data_group_man_power_kasubsie?.[mesin]?.[groupElement.value]?.['nama'] ?? ''}</h5>
            <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('${line}', ${index})">Edit</button>
          `;
        } else {
          document.querySelector(`#nama_mp_${line}_${index}`).value = data?.data_group_man_power_indirect?.[mesin]?.[groupElement.value]?.['nama'] ?? '';
          document.querySelector(`#foto_${line}_${index}`).src = '<?= base_url() ?>uploads/' + data?.data_group_man_power_indirect?.[mesin]?.[groupElement.value]?.['foto'] ?? '';
          document.querySelector(`#npk_${line}_${index}`).innerHTML = String(data?.data_group_man_power_indirect?.[mesin]?.[groupElement.value]?.['npk'] ?? '').padStart(4, '0');
          document.querySelector(`#footer_format_${line}_${index}`).innerHTML = `
            <h5 class="m-0" style="font-size: 10px" id="npk_${line}_${index}">${String(data?.data_group_man_power_indirect?.[mesin]?.[groupElement.value]?.['npk'] ?? '').padStart(4, '0')}</h5>
            <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;">${data?.data_group_man_power_indirect?.[mesin]?.[groupElement.value]?.['nama'] ?? ''}</h5>
            <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('${line}', ${index})">Edit</button>
          `;
        }
        getCuti(line, '<?= $sub_bagian ?>');
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
        console.log(edit_man_power);
        if (edit_man_power.value !== '') {
          document.querySelector(`#card_${line}_${index}`).style.backgroundImage = 'repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(0,0,0,0.1) 10px, rgba(0,0,0,0.1) 10px)';
          document.querySelector(`#card_${line}_${index}`).style.backgroundColor = '';
        } else {
          document.querySelector(`#card_${line}_${index}`).style.backgroundImage = '';
          document.querySelector(`#card_${line}_${index}`).style.backgroundColor = '#9BA4B5';
        }
        document.querySelector(`#nama_mp_${line}_${index}`).value = data?.[0]?.['nama'] ?? '';
        document.querySelector(`#status_mp_${line}_${index}`).value = 'pengganti';
        document.querySelector(`#foto_${line}_${index}`).src = '<?= base_url() ?>uploads/' + data?.[0]?.['foto'] ?? '';
        // document.querySelector(`#npk_${line}_${index}`).innerHTML = String(data?.[0]?.['npk'] ?? '').padStart(4, '0');
        if (line !== 'indirect') {
          document.querySelector(`#footer_format_${line}_${index}`).innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="m-0" style="font-size: 10px" id="npk_${line}_${index}">${String(data?.[0]?.['npk'] ?? '').padStart(4, '0')}</h5>
              <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;">${data?.[0]?.['nama'] ?? ''}</h5>
              <div style="border: 0.1px solid black; background-color: ${data?.[0]?.['skill'] ? colorSkill[data?.[0]?.['skill']] : 'transparent'}; border-radius: 50%; width: 10px; height: 10px" id="skill_${line}_${index}"></div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="m-0" style="font-size: 10px; color: ${(min_skill_form.value <= (data?.[0]?.['skill'] ?? 0)) ? '#00aa00' : '#ff0000'}" id="status_${line}_${index}">${(data?.[0]?.['skill'] ?? 0) ? ((min_skill_form.value <= (data?.[0]?.['skill'] ?? 0)) ? 'OK' : 'Kontrol') : 'Kosong'}</h5>
              <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('${line}', ${index})">Edit</button>
            </div>
          `;
          // let skill = document.querySelector(`#skill_${line}_${index}`);
          // skill.style.backgroundColor = (data?.[0]?.['skill']) ? colorSkill[data?.[0]?.['skill']] : 'transparent';
          // let status = document.querySelector(`#status_${line}_${index}`);
          // status.innerHTML = (data?.[0]?.['skill'] ?? 0) ? ((min_skill_form.value <= (data?.[0]?.['skill'] ?? 0)) ? 'OK' : 'Kontrol') : 'Kosong';
          // status.style.color = (min_skill_form.value <= (data?.[0]?.['skill'] ?? 0)) ? '#00aa00' : '#ff0000';
        } else {
          if (data?.[0]?.['status'] == undefined) {
            document.querySelector(`#footer_format_${line}_${index}`).innerHTML = `
              <h5 class="m-0" style="font-size: 10px" id="npk_${line}_${index}">${String(data?.[0]?.['npk'] ?? '').padStart(4, '0')}</h5>
              <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;">${data?.[0]?.['nama'] ?? ''}</h5>
              <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('${line}', ${index})">Edit</button>
            `;
          } else {
            document.querySelector(`#footer_format_${line}_${index}`).innerHTML = `
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="m-0" style="font-size: 10px" id="npk_${line}_${index}">${String(data?.[0]?.['npk'] ?? '').padStart(4, '0')}</h5>
                <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;">${data?.[0]?.['nama'] ?? ''}</h5>
                <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('${line}', ${index})">Edit</button>
              </div>
            `;
          }
        }
      }
    })
  }

  function man_power_cuti(line, index) {
    document.querySelector(`#card_${line}_${index}`).style.backgroundImage = '';
    document.querySelector(`#card_${line}_${index}`).style.backgroundColor = '#9BA4B5';
    document.querySelector(`#nama_mp_${line}_${index}`).value = ''
    document.querySelector(`#status_mp_${line}_${index}`).value = '';
    document.querySelector(`#foto_${line}_${index}`).src = '';
    if (line !== 'indirect') {
      document.querySelector(`#footer_format_${line}_${index}`).innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="m-0" style="font-size: 10px" id="npk_${line}_${index}">${String('').padStart(4, '0')}</h5>
              <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;"></h5>
              <div style="border: 0.1px solid black; background-color: transparent; border-radius: 50%; width: 10px; height: 10px" id="skill_${line}_${index}"></div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="m-0" style="font-size: 10px; color: #ff0000" id="status_${line}_${index}">Kosong</h5>
              <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('${line}', ${index})">Edit</button>
            </div>
          `;
    } else {
      if (document.querySelector(`#status_mp_${line}_${index}`) == undefined) {
        document.querySelector(`#footer_format_${line}_${index}`).innerHTML = `
              <h5 class="m-0" style="font-size: 10px" id="npk_${line}_${index}">${String('').padStart(4, '0')}</h5>
              <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;"></h5>
              <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('${line}', ${index})">Edit</button>
            `;
      } else {
        document.querySelector(`#footer_format_${line}_${index}`).innerHTML = `
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="m-0" style="font-size: 10px" id="npk_${line}_${index}">${String('').padStart(4, '0')}</h5>
                <h5 class="m-0" style="font-size: 10px; white-space: nowrap; max-width: 100%; overflow: hidden; text-overflow: ellipsis;"></h5>
                <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower('${line}', ${index})">Edit</button>
              </div>
            `;
      }
    }
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
            <td class="p-0" colspan="2" style="white-space: nowrap; max-width: 140px; overflow: hidden; text-overflow: ellipsis;">
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
        <td colspan="4" class="text-center p-0">
          <button type="button" class="btn btn-sm p-1 btn-primary" style="font-size: 8px" id="add_${line}_${index}" data-bs-toggle="modal" data-bs-target=".modal_add_mp_tidak_hadir" onclick="btn_add_mp_tidak_hadir(${line},${index})">Add</button>
        </td>
      `;
    }
  }

  function save_record_man_power() {
    $('#loading-modal').modal('show');
    let date = document.querySelector('#date').value;
    let sum_line = <?= json_encode($line) ?>;
    let sub_bagian = <?= json_encode($sub_bagian) ?>;
    let sum_mesin = 0;
    let shift = document.querySelector('#shift').value;
    let group_mp = document.getElementsByName('group[]');
    let group_indirect_mp = document.getElementsByName('group_indirect[]');
    let groupLineVal = [];
    let groupIndirectVal = [];
    let status_mpLineVal = [];
    let status_mesinLineVal = [];
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
    // let npk_indirect = document.getElementsByName('npk_indirect[]');
    let npkIndirectVal = [];
    let status_mpIndirectVal = [];
    let status_mesinIndirectVal = [];

    group_mp.forEach(group => {
      groupLineVal.push(group.value);
    });
    let index_group_indirect_mp = 0;
    group_indirect_mp.forEach(group => {
      groupIndirectVal.push(group.value);
      nama_mesinIndirectVal.push(document.getElementById(`mesin_indirect_${index_group_indirect_mp}`).textContent);
      npkIndirectVal.push(document.getElementById(`npk_indirect_${index_group_indirect_mp}`).textContent);
      status_mpIndirectVal.push(document.getElementById(`status_mp_indirect_${index_group_indirect_mp}`).value);
      status_mesinIndirectVal.push(document.getElementById(`status_mesin_indirect_${index_group_indirect_mp}`).value);
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
        if (status_mpLineVal.hasOwnProperty(`${line_index}`)) {
          status_mpLineVal[`${line_index}`].push(document.querySelector(`#status_mp_${line_index}_${mesin_index}`).value);
        } else {
          status_mpLineVal[`${line_index}`] = [document.querySelector(`#status_mp_${line_index}_${mesin_index}`).value];
        }
        if (status_mesinLineVal.hasOwnProperty(`${line_index}`)) {
          status_mesinLineVal[`${line_index}`].push(document.querySelector(`#status_mesin_${line_index}_${mesin_index}`).value);
        } else {
          status_mesinLineVal[`${line_index}`] = [document.querySelector(`#status_mesin_${line_index}_${mesin_index}`).value];
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
        status_mp: status_mpLineVal,
        status_mesin: status_mesinLineVal,
        line: sum_line,
        nama_mp_tidak_hadir: nama_mp_tidak_hadirVal,
        keterangan_mp_tidak_hadir: keterangan_mp_tidak_hadirVal,
        id_cuti_mp_tidak_hadir: id_cuti_mp_tidak_hadirVal,
        group_mp_indirect: groupIndirectVal,
        nama_mesin_indirect: nama_mesinIndirectVal,
        npk_indirect: npkIndirectVal,
        status_mp_indirect: status_mpIndirectVal,
        status_mesin_indirect: status_mesinIndirectVal,
        nama_mp_tidak_hadir_indirect: nama_mp_tidak_hadir_indirectVal,
        keterangan_mp_tidak_hadir_indirect: keterangan_mp_tidak_hadir_indirectVal,
        id_cuti_mp_tidak_hadir_indirect: id_cuti_mp_tidak_hadir_indirectVal,
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        // window.location.href = '<?= base_url() ?>dashboard_man_power/' + sub_bagian;
        showToast('Data berhasil disimpan.', '#38E54D', 'black');
        // if(data === 'SUCESS') {
        //   window.alert('Save Henkaten Man Power Success');
        // }
        $('#loading-modal').modal('hide');
      },
      error: function(xhr, status, error) {
        showToast('Data gagal disimpan', 'red', 'white');
      }
    });
  }
</script>
<script>
  let sum_mp_tidak_hadir = <?= json_encode($data_mp_tidak_hadir) ?>;
  let sum_mp_tidak_hadir_indirect = <?= json_encode($data_mp_tidak_hadir_indirect) ?>;
  let sum_mesin = <?= json_encode($data_group_mesin) ?>;
  let sum_mesin_indirect = <?= json_encode($data_group_mesin_indirect) ?>;
  let mp_tidak_hadir = [];
  let mp_hadir = [];
  let temp_all_mp_tidak_hadir = [];
  let temp_all_mp_hadir = [];
  let temp_sum_mesin = '';
  let temp_sum_mesin_indirect = '';
  <?php for ($i = 0; $i < count($line); $i++) { ?>
    temp_sum_mesin = Object.entries(sum_mesin?.[<?= $line[$i] ?>]?.[Object.keys(sum_mesin?.[<?= $line[$i] ?>])[0]]).filter(element => {
      return element[1].status !== 'Non-Aktif';
    }).length;
    mp_tidak_hadir.push(parseFloat((((sum_mp_tidak_hadir?.[<?= $line[$i] ?>]?.length ?? 0) / temp_sum_mesin) * 100).toFixed(1)));
    mp_hadir.push(parseFloat((((temp_sum_mesin - (sum_mp_tidak_hadir?.[<?= $line[$i] ?>]?.length ?? 0)) / temp_sum_mesin) * 100).toFixed(1)));
    temp_all_mp_tidak_hadir.push((sum_mp_tidak_hadir?.[<?= $line[$i] ?>]?.length ?? 0));
    temp_all_mp_hadir.push(temp_sum_mesin - (sum_mp_tidak_hadir?.[<?= $line[$i] ?>]?.length ?? 0));
  <?php } ?>
  temp_sum_mesin_indirect = Object.entries(sum_mesin_indirect?.[Object.keys(sum_mesin_indirect)[0]]).filter(element => {
    return element[1].status !== 'Non-Aktif';
  }).length;
  mp_tidak_hadir.push(parseFloat((((sum_mp_tidak_hadir_indirect?.length ?? 0) / temp_sum_mesin_indirect) * 100).toFixed(1)));
  mp_hadir.push(parseFloat((((temp_sum_mesin_indirect - (sum_mp_tidak_hadir_indirect?.length ?? 0)) / temp_sum_mesin_indirect) * 100).toFixed(1)));
  temp_all_mp_tidak_hadir.push((sum_mp_tidak_hadir_indirect?.length ?? 0));
  temp_all_mp_hadir.push((temp_sum_mesin_indirect - (sum_mp_tidak_hadir_indirect?.length ?? 0)));
  mp_tidak_hadir.push(parseFloat(((eval(temp_all_mp_tidak_hadir.join('+')) / (eval(temp_all_mp_tidak_hadir.join('+')) + eval(temp_all_mp_hadir.join('+')))) * 100).toFixed(1)));
  mp_hadir.push(parseFloat(((eval(temp_all_mp_hadir.join('+')) / (eval(temp_all_mp_tidak_hadir.join('+')) + eval(temp_all_mp_hadir.join('+')))) * 100).toFixed(1)));
  let horizontal_barHighcharts = Highcharts.chart('horizontal_bar', {
    chart: {
      type: 'bar',
      backgroundColor: '#FFF9C9'
    },
    title: {
      text: 'Kehadiran',
      style: {
        fontSize: '20px',
        fontWeight: 'bold'
      }
    },
    xAxis: {
      categories: ['Line 1', 'Line 2', 'Line 3', 'Indirect', 'AMB-1'],
      labels: {
        style: {
          fontSize: '14px',
          fontWeight: 'bold'
        }
      }
    },
    yAxis: {
      min: 0,
      max: 100,
      title: {
        text: 'Percentage',
        style: {
          fontSize: '14px',
          fontWeight: 'bold',
          color: 'black'
        }
      }
    },
    legend: {
      reversed: true,
      itemStyle: {
        fontSize: '14px', // Ubah ukuran font legenda menjadi 14px
        color: '#333333' // Ubah warna font legenda menjadi #333333 (hitam)
      }
    },
    plotOptions: {
      series: {
        stacking: 'normal',
        dataLabels: {
          enabled: true,
          formatter: function() {
            if (this.series.index === 1) {
              return this.y + '%';
            } else {
              return null; // Mengembalikan null untuk menghilangkan datalabels pada series lainnya
            }
          },
          style: {
            textOutline: 'none',
            color: '#FFFFFF',
            fontSize: '14px',
            fontWeight: 'bold'
          }
        }
      }
    },
    series: [{
      name: 'Tidak Hadir',
      color: 'red',
      data: mp_tidak_hadir
    }, {
      name: 'Hadir',
      color: 'blue',
      data: mp_hadir

    }]
  });
</script>
<?= $this->endSection(); ?>