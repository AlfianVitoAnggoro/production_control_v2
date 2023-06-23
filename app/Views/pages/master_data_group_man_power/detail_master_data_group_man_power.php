<?= $this->extend('template/layout'); ?>
<?= $this->section('style') ?>
<style>
</style>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<?php //$mesin = ['Hoist', 'Plate Cutting', 'Envelope', 'Mearing', 'COS', 'Punch Hole', 'PW', 'HSM', 'AUTO PB', 'ALT & datacode', 'Dry Sealer Packing', 'Klem Battery', 'BAAN']; 
?>
<?php $line = [1, 2, 3, 4, 5, 6, 7, 'WET A', 'WET F', 'MCB']; ?>
<?php $color = ['', '#ff0000', '#ffff00', '#0000ff', '#00aa00']; ?>
<?php $value = ['', '25%', '50%', '75%', '100%']; ?>
<?php $group_mp = ['', 'A', 'B', 'C']; ?>
<?php if (strcasecmp($data_group_man_power[0]['sub_bagian'], 'amb-1') === 0) {
  $line_val = [1, 2, 3];
} else if (strcasecmp($data_group_man_power[0]['sub_bagian'], 'amb-2') === 0) {
  $line_val = [4, 5, 6, 7];
} else if (strcasecmp($data_group_man_power[0]['sub_bagian'], 'wet-a') === 0) {
  $line_val = [8];
} else if (strcasecmp($data_group_man_power[0]['sub_bagian'], 'wet-f') === 0) {
  $line_val = [9];
} else if (strcasecmp($data_group_man_power[0]['sub_bagian'], 'mcb') === 0) {
  $line_val = [10];
} ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <form action="<?= base_url() ?>master_group_man_power/detail_group_man_power/edit" method="post">
        <div class="row">
          <div class="col-xl-12 col-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 style="font-size: 32px">Detail Group Man Power</h3>
              </div>
              <div class="box-body">
                <h3 style="font-size: 30px">
                  <?= $data_group_man_power[0]['sub_bagian'] ?>
                </h3>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center"></th>
                        <th class="text-center">A</th>
                        <th class="text-center">B</th>
                        <th class="text-center">C</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $model = new App\Models\M_MasterGroupManPower();
                      $indirect = $model->get_data_master_mesin_indirect_sub_bagian(strtolower(str_replace('-', '_', $data_group_man_power[0]['sub_bagian'])));
                      $index_mesin = 0;
                      foreach ($indirect as $ind) { ?>
                        <tr>
                          <th style="font-size: 20px">
                            <?= $ind['mesin'] ?>
                            <input type="hidden" class="form-control" name="mesin_indirect[]" value="<?= $ind['mesin'] ?>">
                          </th>
                          <?php for ($i = 1; $i <= 3; $i++) { ?>
                            <td>
                              <div class="d-flex align-items-center justify-content-center">
                                <select style="width: 400px" name="nama_indirect_<?= $i ?>[]" id="nama_indirect_<?= $i ?>_<?= $index_mesin ?>" class="form-select select2">
                                  <option value="" selected>-- Pilih Man Power --</option>
                                  <?php if (strpos($ind['mesin'], 'Kasubsie') === 0)
                                    $data_man_power = $model->get_data_master_man_power_kasubsie();
                                  else
                                    $data_man_power = $model->get_data_master_man_power();
                                  ?>
                                  <?php //$data_man_power= $model->get_data_master_man_power($data_group_man_power[0]['line'], $ind['mesin']);
                                  foreach ($data_man_power as $d_mp) { ?>
                                    <option value="<?= $d_mp['id_man_power'] ?>" <?= (count($data_detail_group_man_power_indirect) > 0) ? ((array_key_exists($group_mp[$i], $data_detail_group_man_power_indirect)) ? ((array_key_exists($ind['mesin'], $data_detail_group_man_power_indirect[$group_mp[$i]])) ? (($data_detail_group_man_power_indirect[$group_mp[$i]][$ind['mesin']]['nama'] == $d_mp['id_man_power']) ? 'selected' : '') : '') : '') : '' ?>><?= $d_mp['nama'] ?></option>
                                  <?php } ?>
                                </select>
                                <input type="hidden" class="form-control" name="id_detail_group_man_power_indirect_<?= $i ?>[]" id="id_detail_group_man_power_indirect_<?= $i ?>_<?= $index_mesin ?>" value="<?= $data_detail_group_man_power_indirect[$group_mp[$i]][$ind['mesin']]['id_detail_group'] ?? '' ?>">
                                <input type="hidden" class="form-control" name="group_mp_indirect_<?= $i ?>[]" value="<?= $group_mp[$i] ?>">
                                <input type="hidden" class="form-control" name="sub_bagian" value="<?= $data_group_man_power[0]['sub_bagian'] ?>">
                              </div>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php $index_mesin++;
                      } ?>
                    </tbody>
                  </table>
                </div>
                <!-- <div class="row">
                  <div class="col">
                    <div class="table-responsive">
                      <table id="" class="table">
                        <tbody class="form_group_man_power">
                          <tr>
                            <th style="font-size: 20px">Line</th>
                            <td>
                              <input type="text" class="form-control" value="<?= "" //$line[$data_group_man_power[0]['line'] - 1] 
                                                                              ?>" style="width: 250px;" readonly>
                              <input type="hidden" class="form-control" name="line" value="<?= "" //$data_group_man_power[0]['line'] 
                                                                                            ?>">
                              <input type="hidden" class="form-control" name="id_group" id="id_group" value="<?= $data_group_man_power[0]['id_group'] ?>">
                            </td>
                          </tr>
                          <tr>
                            <th style="font-size: 20px">Group</th>
                            <td>
                              <input type="text" class="form-control" name="group_mp" value="<?= "" //$data_group_man_power[0]['group_mp'] 
                                                                                              ?>" style="width: 250px;" readonly>
                            </td>
                          </tr>
                          <tr>
                            <th style="font-size: 20px">Bulan</th>
                            <td>
                              <input type="month" class="form-control" name="bulan" value="<?= "" //date('Y-m', strtotime($data_group_man_power[0]['bulan'])) 
                                                                                            ?>" style="width: 250px;" readonly>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-xl-12 col-12">
            <div class="box">
              <div class="box-header with-border">
                <h4>Skill</h4>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="" class="table">
                    <tbody>
                      <tr>
                        <th>Line</th>
                        <td><input type="text" class="form-control" name="line" value="" style="width: 250px;"></td>
                      </tr>
                      <tr>
                        <th>Mesin</th>
                        <td><input type="text" class="form-control" name="mesin" value="" style="width: 250px;"></td>
                      </tr>
                      <tr>
                        <th>Skill</th>
                        <td>
                          <button type="button" class="btn btn-outline-danger" value="1" id="skill_1_1_1" onclick="choose_skill(1, 1, 1)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ff3f3f"></button>
                          <button type="button" class="btn btn-outline-warning" value="2" id="skill_1_1_2" onclick="choose_skill(1, 1, 2)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ff9920"></button>
                          <button type="button" class="btn btn-outline-primary" value="3" id="skill_1_1_3" onclick="choose_skill(1, 1, 3)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #0052cc"></button>
                          <button type="button" class="btn btn-outline-success" value="4" id="skill_1_1_4" onclick="choose_skill(1, 1, 4)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #04a08b"></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-xl-12 col-12">
            <div class="box">
              <?php $index_lv = 0;
              foreach ($line_val as $lv) { ?>
                <div class="box-header with-border">
                  <div>
                    <h4><?= ($lv > 7) ? $line[$lv - 1] : 'Line ' . $lv ?></h4>
                    <!-- <div class="form-group" style="font-size: 20px">
                    <label class="form-label fw-bold">Line</label>
                    <input type="text" class="form-control" value="<?= "" //$line[$data_group_man_power[0]['line'] - 1] 
                                                                    ?>" style="width: 200px" readonly>
                  </div> -->
                    <input type="hidden" class="form-control" name="line[]" value="<?= $lv ?>">
                    <input type="hidden" class="form-control" name="id_group" id="id_group" value="<?= $data_group_man_power[0]['id_group'] ?>">
                  </div>
                  <h4 style="font-size: 28px">Position</h4>
                </div>
                <div class="box-body">
                  <!-- <select name="choose_shift" class="form-select" id="choose_shift" onchange="check_shift()" style="width: 200px;">
                  <option value="">-- Pilih Shift --</option>
                  <option value="">All</option>
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select> -->
                  <div class="table-responsive">
                    <table id="table_group_man_power" class="table">
                      <thead>
                        <tr>
                          <th></th>
                          <th class="text-center">A</th>
                          <th class="text-center">B</th>
                          <th class="text-center">C</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $mesin = $model->get_data_master_mesin($lv) //$data_group_man_power[0]['line']);
                        // if($data_group_man_power[0]['line'] === 1) {
                        //   $mesin = ['PIC Line', 'Plate Cutting', 'Envelope', 'Mearing 1', 'Mearing 2', 'Mearing 3', 'Loading', 'Unloading', 'PW', 'HSM/APB', 'ALT/Packing'];
                        // } else if($data_group_man_power[0]['line'] <= 3) {
                        //   $mesin = ['PIC Line', 'Plate Cutting', 'Envelope', 'Mearing 1', 'Mearing 2', 'Mearing 3', 'Loading', 'PW/Punch', 'HSM/APB', 'ALT/Packing'];
                        // } else if($data_group_man_power[0]['line'] === 4) {
                        //   $mesin = ['PIC Line', 'Plate Cutting', 'Envelope 1', 'Envelope 2', 'Mearing 1', 'Mearing 2', 'Mearing 3', 'COS', 'PW & Supply Komponen', 'HSM', 'Pole Burning', 'Packing'];
                        // } else if($data_group_man_power[0]['line'] <= 6) {
                        //   $mesin = ['PIC Line', 'Plate Cutting', 'Envelope 1', 'Envelope 2', 'COS', 'HSM', 'Packing'];
                        // } else if($data_group_man_power[0]['line'] === 7) {
                        //   $mesin = ['PIC Line', 'Plate Cutting', 'Envelope', 'Mearing', 'Mearing & Burning 1', 'Burning 1', 'Inserting & Mearing (Big Type)', 'PW + Punch Hole + (Dandori PW)', 'HSM + (Dandori PH, Polarity, Short Test & HSM)', 'Pole Burning + Packing + (Dandori IRT, Short Test, Laser, ALT)', 'Packing'];
                        // } else if($data_group_man_power[0]['line'] === 8) {
                        //   $mesin = ['Acid Filling', 'Loading', 'Unloading', 'Levelling - HSM - ALT', 'Packing 1', 'Packing 2'];
                        // } else if($data_group_man_power[0]['line'] === 9) {
                        //   $mesin = ['Acid Filling', 'Loading', 'Unloading', 'Levelling - HSM - ALT', 'Packing 1', 'Packing 2', 'Clamping'];
                        // } else if($data_group_man_power[0]['line'] === 10) {
                        //   $mesin = [];
                        // }
                        ?>
                        <?php foreach ($mesin as $msn) { ?>
                          <tr>
                            <th style="font-size: 20px">
                              <?= $msn['mesin'] ?>
                              <input type="hidden" class="form-control" name="mesin_<?= $index_lv ?>[]" value="<?= $msn['mesin'] ?>">
                            </th>
                            <?php for ($i = 1; $i <= 3; $i++) { ?>
                              <td>
                                <div class="d-flex align-items-center justify-content-center">
                                  <select style="width: 400px" name="nama_<?= $index_lv ?>_<?= $i ?>[]" id="nama_<?= $index_lv ?>_<?= $i ?>_<?= $index_mesin ?>" class="form-select select2">
                                    <option value="" selected>-- Pilih Man Power --</option>
                                    <?php $data_man_power = $model->get_data_master_man_power();
                                    foreach ($data_man_power as $d_mp) { ?>
                                      <option value="<?= $d_mp['id_man_power'] ?>" <?= (count($data_detail_group_man_power) > 0) ? ((array_key_exists($lv, $data_detail_group_man_power)) ? ((array_key_exists($group_mp[$i], $data_detail_group_man_power[$lv])) ? ((array_key_exists($msn['mesin'], $data_detail_group_man_power[$lv][$group_mp[$i]])) ? (($data_detail_group_man_power[$lv][$group_mp[$i]][$msn['mesin']]['nama'] == $d_mp['id_man_power']) ? 'selected' : '') : '') : '') : '') : '' ?>><?= $d_mp['nama'] ?></option>
                                    <?php } ?>
                                  </select>
                                  <input type="hidden" class="form-control" name="id_detail_group_man_power_<?= $index_lv ?>_<?= $i ?>[]" id="id_detail_group_man_power_<?= $index_lv ?>_<?= $i ?>_<?= $index_mesin ?>" value="<?= $data_detail_group_man_power[$lv][$group_mp[$i]][$msn['mesin']]['id_detail_group'] ?? '' ?>">
                                  <input type="hidden" class="form-control" name="group_mp_<?= $index_lv ?>_<?= $i ?>[]" value="<?= $group_mp[$i] ?>">
                                  <!-- <input type="text" class="form-control" name="nama[]" value="" style="width: 250px;"> -->
                                  <?php //$bg_color = '' 
                                  ?>
                                  <?php //$skill_value = '' 
                                  ?>
                                  <?php //foreach ($data_man_power as $d_mp) { 
                                  ?>
                                  <?php //if(count($data_detail_group_man_power) > 0 && array_key_exists($i, $data_detail_group_man_power) && array_key_exists($msn['mesin'], $data_detail_group_man_power)) {
                                  //   if ($data_detail_group_man_power[$msn['mesin']]['nama'] == $d_mp['id_man_power']) {
                                  //     $bg_color = $color[$d_mp['skill']];
                                  //     $skill_value = $value[$d_mp['skill']];
                                  //   }
                                  //  } 
                                  ?>
                                  <?php //} 
                                  ?>
                                  <!-- <div class="p-0 d-flex justify-content-center align-items-center" id="skill_value_<?= $index_mesin ?>" style="width: 34px; height: 34px; border-radius: 50%; background-color: <?= "" //$bg_color 
                                                                                                                                                                                                                      ?>"><?= "" //$skill_value 
                                                                                                                                                                                                                          ?></div> -->
                                </div>
                              </td>
                            <?php } ?>
                          </tr>
                        <?php $index_mesin++;
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php $index_lv++;
              } ?>
            </div>
          </div>
        </div>
        <div class=" text-center my-2 button">
          <button type="submit" class="btn btn-primary">Save</button>
          <!-- <button type="button" class="btn btn-danger" onclick="confirmation()">Master Save</button> -->
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
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>
<script>
  function confirmation() {
    let confirmationValue = confirm('Apakah Anda Yakin?');
    if (confirmationValue) {
      let mesin = [];
      temp_mesin = document.getElementsByName('mesin[]');
      temp_mesin.forEach(tempVal => {
        mesin.push(tempVal.value);
      });
      let nama_1 = [];
      let nama_2 = [];
      let nama_3 = [];
      let id_detail_group_man_power_1 = [];
      let id_detail_group_man_power_2 = [];
      let id_detail_group_man_power_3 = [];
      let group_1 = [];
      let group_2 = [];
      let group_3 = [];
      <?php for ($index = 1; $index <= 3; $index++) { ?>
        temp_nama_<?= $index ?> = document.getElementsByName('nama_<?= $index ?>[]');
        temp_nama_<?= $index ?>.forEach(tempVal => {
          nama_<?= $index ?>.push(tempVal.value);
        });
        temp_id_detail_group_man_power_<?= $index ?> = document.getElementsByName('id_detail_group_man_power_<?= $index ?>[]');
        temp_id_detail_group_man_power_<?= $index ?>.forEach(tempVal => {
          id_detail_group_man_power_<?= $index ?>.push(tempVal.value);
        });
        temp_group_<?= $index ?> = document.getElementsByName('group_mp_<?= $index ?>[]');
        temp_group_<?= $index ?>.forEach(tempVal => {
          group_<?= $index ?>.push(tempVal.value);
        });
      <?php } ?>
      $.ajax({
        url: '<?= base_url() ?>master_group_man_power/detail_group_man_power/edit',
        type: 'POST',
        data: {
          nama_1: nama_1,
          nama_2: nama_2,
          nama_3: nama_3,
          id_detail_group_man_power_1: id_detail_group_man_power_1,
          id_detail_group_man_power_2: id_detail_group_man_power_2,
          id_detail_group_man_power_3: id_detail_group_man_power_3,
          group_1: group_1,
          group_2: group_2,
          group_3: group_3,
        },
        dataType: 'json',
        success: function(data) {
          console.log(data);
        }
      });
    } else {
      console.log('YAHH')
    }
  }
</script>
<?= $this->endSection(); ?>