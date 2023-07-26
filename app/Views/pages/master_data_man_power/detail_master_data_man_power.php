<?= $this->extend('template/layout'); ?>
<?= $this->section('style') ?>
<style>
  :hover {
    color: var(--hover-color);
    background-color: var(--hover-background-color);
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<?php $mesin = ['PIC Line', 'Plate Cutting', 'Envelope', 'Mearing', 'COS', 'SAW', 'PW', 'HSM', 'Pole Burning', 'Packing']; ?>
<?php $line = [1, 2, 3, 4, 5, 6, 7, 'WET A', 'WET F', 'MCB', 'Non Line']; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <form action="<?= base_url() ?>master_man_power/detail_man_power/edit" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-xl-12 col-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 style="font-size: 32px">Detail Man Power</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-4 bg-light d-flex justify-content-center align-items-center mx-3 p-0" id="image" style="border-radius: 20px; width: 300px; height: 400px;">
                    <?php if (!empty($data_man_power[0]['foto'])) { ?>
                      <img src="<?= base_url() ?>uploads/<?= $data_man_power[0]['foto'] ?>" style="border-radius: 20px; width: 300px; height: 400px;" alt="">
                    <?php } else { ?>
                      <img src="<?= base_url() ?>uploads/default_user.png" style="border-radius: 20px; opacity: 60%" alt="">
                    <?php } ?>
                  </div>
                  <div class="col">
                    <div class="table-responsive">
                      <table id="" class="table">
                        <tbody class="form_man_power">
                          <tr>
                            <th style="font-size: 20px">Nama</th>
                            <td>
                              <input type="text" class="form-control" style="font-size: 20px" name="nama" value="<?= $data_man_power[0]['nama']; ?>" style="width: 250px;">
                              <input type="hidden" class="form-control" name="id_man_power" id="id_man_power" value="<?= $data_man_power[0]['id_man_power']; ?>">
                            </td>
                          </tr>
                          <tr>
                            <th style="font-size: 20px">NPK</th>
                            <td>
                              <input type="text" class="form-control" style="font-size: 20px" name="npk" value="<?= sprintf('%04d', $data_man_power[0]['npk']); ?>" style="width: 250px;">
                            </td>
                          </tr>
                          <tr>
                            <th style="font-size: 20px">Foto</th>
                            <td><input type="file" class="form-control" style="font-size: 20px" name="foto" id="foto" accept="image/*" style="width: 250px;"></td>
                          </tr>
                          <!-- <tr>
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
                          </tr> -->
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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
              <div class="box-header with-border">
                <h4 style="font-size: 28px">Skill</h4>
              </div>
              <div class="box-body">
                <select style="font-size: 20px; width: 200px" name="choose_line" class="form-select" id="choose_line" onchange="check_line()">
                  <option value="" disabled>-- Pilih Line --</option>
                  <option value="">All</option>
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">WET A</option> // WET A = 8
                  <option value="9">WET F</option> // WET F = 9
                  <option value="10">MCB</option> // MCB = 10
                  <option value="11">Non Line</option> // NON LINE = 11
                </select>
                <div class="table-responsive">
                  <table id="table_data_skill" class="table">
                    <thead id="thead_data_skill">
                      <tr>
                        <th style="font-size: 20px">Line</th>
                        <th style="font-size: 20px">Mesin</th>
                        <th style="font-size: 20px">Skill</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_data_skill">
                      <?php if (!empty($detail_data_man_power_line)) {
                        $index_data_skill = 0;
                        foreach ($detail_data_man_power_line as $d_dmp) { ?>
                          <tr class="data_skill">
                            <td style="font-size: 20px"><?= $d_dmp['line'] ?>
                              <input type="hidden" class="form-control" name="line[]" value="<?= $d_dmp['line'] ?>">
                              <input type="hidden" class="form-control" name="id_detail_man_power[]" value="<?= $d_dmp['id_detail_man_power'] ?>">
                            </td>
                            <td style="font-size: 20px"><?= $d_dmp['mesin'] ?><input type="hidden" class="form-control" name="mesin[]" value="<?= $d_dmp['mesin'] ?>"></td>
                            <td>
                              <input type="hidden" class="form-control" name="skill[]" id="skill_1_<?= $index_data_skill ?>" value="<?= $d_dmp['skill'] ?>">
                              <button type="button" class="btn p-0" value="0" id="skill_<?= $d_dmp['line'] ?>_<?= $index_data_skill ?>_0" onclick="choose_skill(<?= $d_dmp['line'] ?>, <?= $index_data_skill ?>, 0)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #000000; background-color: <?= $d_dmp['skill'] === 0 ? '#000000' : '' ?>; color: <?= $d_dmp['skill'] === 0 ? '#ffffff' : '' ?>; --hover-background-color: #000000; --hover-color: #ffffff">0%</button>
                              <button type="button" class="btn p-0" value="1" id="skill_<?= $d_dmp['line'] ?>_<?= $index_data_skill ?>_1" onclick="choose_skill(<?= $d_dmp['line'] ?>, <?= $index_data_skill ?>, 1)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ff0000; background-color: <?= $d_dmp['skill'] === 1 ? '#ff0000' : '' ?>; color: <?= $d_dmp['skill'] === 1 ? '#ffffff' : '' ?>; --hover-background-color: #ff0000; --hover-color: #ffffff">25%</button>
                              <button type="button" class="btn p-0" value="2" id="skill_<?= $d_dmp['line'] ?>_<?= $index_data_skill ?>_2" onclick="choose_skill(<?= $d_dmp['line'] ?>, <?= $index_data_skill ?>, 2)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ffff00; background-color: <?= $d_dmp['skill'] === 2 ? '#ffff00' : '' ?>; color: <?= $d_dmp['skill'] === 2 ? '#000000' : '' ?>; --hover-background-color: #ffff00; --hover-color: #000000">50%</button>
                              <button type="button" class="btn p-0" value="3" id="skill_<?= $d_dmp['line'] ?>_<?= $index_data_skill ?>_3" onclick="choose_skill(<?= $d_dmp['line'] ?>, <?= $index_data_skill ?>, 3)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #0000ff; background-color: <?= $d_dmp['skill'] === 3 ? '#0000ff' : '' ?>; color: <?= $d_dmp['skill'] === 3 ? '#ffffff' : '' ?>; --hover-background-color: #0000ff; --hover-color: #ffffff">75%</button>
                              <button type="button" class="btn p-0" value="4" id="skill_<?= $d_dmp['line'] ?>_<?= $index_data_skill ?>_4" onclick="choose_skill(<?= $d_dmp['line'] ?>, <?= $index_data_skill ?>, 4)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #00aa00; background-color: <?= $d_dmp['skill'] === 4 ? '#00aa00' : '' ?>; color: <?= $d_dmp['skill'] === 4 ? '#ffffff' : '' ?>; --hover-background-color: #00aa00; --hover-color: #ffffff">100%</button>
                              <button type="button" class="btn btn-sm btn-danger ms-3 p-2" id="skill_<?= $d_dmp['line'] ?>_<?= $index_data_skill ?>_5" onclick="delete_skill(<?= $d_dmp['line'] ?>, <?= $index_data_skill ?>, 5)"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
                            </td>
                          </tr>
                        <?php $index_data_skill++;
                        }
                      } else { ?>
                        <?php for ($i = 0; $i < count($mesin); $i++) { ?>
                          <tr class="data_skill">
                            <td style="font-size: 20px">1
                              <input type="hidden" class="form-control" name="line[]" value="1">
                              <input type="hidden" class="form-control" name="id_detail_man_power[]" value="">
                            </td>
                            <td style="font-size: 20px"><?= $mesin[$i] ?><input type="hidden" class="form-control" name="mesin[]" value="<?= $mesin[$i] ?>"></td>
                            <td>
                              <input type="hidden" class="form-control" name="skill[]" id="skill_1_<?= $i ?>" value="1">
                              <button type="button" class="btn p-0" value="0" id="skill_1_<?= $i ?>_0" onclick="choose_skill(1, <?= $i ?>, 0)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #000000; --hover-background-color: #000000; --hover-color: #ffffff">0%</button>
                              <button type="button" class="btn p-0" value="1" id="skill_1_<?= $i ?>_1" onclick="choose_skill(1, <?= $i ?>, 1)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ff0000; background-color: #ff0000; color: #ffffff; --hover-background-color: #ff0000; --hover-color: #ffffff">25%</button>
                              <button type="button" class="btn p-0" value="2" id="skill_1_<?= $i ?>_2" onclick="choose_skill(1, <?= $i ?>, 2)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ffff00; --hover-background-color: #ffff00; --hover-color: #000000">50%</button>
                              <button type="button" class="btn p-0" value="3" id="skill_1_<?= $i ?>_3" onclick="choose_skill(1, <?= $i ?>, 3)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #0000ff; --hover-background-color: #0000ff; --hover-color: #ffffff">75%</button>
                              <button type="button" class="btn p-0" value="4" id="skill_1_<?= $i ?>_4" onclick="choose_skill(1, <?= $i ?>, 4)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #00aa00; --hover-background-color: #00aa00; --hover-color: #ffffff">100%</button>
                              <button type="button" class="btn btn-sm btn-danger ms-3 p-2" id="skill_1_<?= $i ?>_5" onclick="delete_skill(1, <?= $i ?>, 5)"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
                            </td>
                          </tr>
                        <?php } ?>
                      <?php } ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class=" text-center my-2 button">
          <button type="submit" class="btn btn-primary">Save</button>
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
  function choose_skill(line, no, i) {
    // let classColor = ['', 'danger', 'warning', 'primary', 'success'];
    let color = ['#000000', '#ff0000', '#ffff00', '#0000ff', '#00aa00'];
    let skillValElement = document.querySelector('#skill_' + line + '_' + no);
    let skillELement = document.querySelector('#skill_' + line + '_' + no + '_' + i);
    let tempElement = '';
    console.log({
      skillValElement,
      skillELement
    })
    for (let j = 0; j <= 4; j++) {
      if (i !== j) {
        tempElement = document.querySelector('#skill_' + line + '_' + no + '_' + j);
        tempElement.style.backgroundColor = null;
        tempElement.style.color = '#000000';
        // tempElement.classList.remove('btn-' + classColor[j]);
      } else {
        if (i === 2)
          skillELement.style.color = '#000000';
        else
          skillELement.style.color = '#ffffff';

        skillELement.style.backgroundColor = color[i];
        // skillELement.classList.add('btn-' + classColor[i]);
        skillValElement.value = skillELement.value;
      }
    }
  }

  function delete_skill(line, no, i) {
    // let classColor = ['', 'danger', 'warning', 'primary', 'success'];
    let skillValElement = document.querySelector('#skill_' + line + '_' + no);
    let tempElement = '';
    for (let j = 1; j <= 4; j++) {
      tempElement = document.querySelector('#skill_' + line + '_' + no + '_' + j);
      tempElement.style.backgroundColor = null;
      // tempElement.classList.remove('btn-' + classColor[j]);
      skillValElement.value = '';
    }
  }

  function check_line() {
    let id_man_power = document.querySelector('#id_man_power').value;
    let choose_lineVal = document.querySelector('#choose_line').value;
    let tempIndex = 0;
    $.ajax({
      url: '<?= base_url() ?>master_man_power/get_data_master_man_power',
      type: 'POST',
      data: {
        id_man_power: id_man_power,
        choose_lineVal: choose_lineVal
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        let newData = data['data_detail_data_master_man_power'].reduce((result, obj) => {
          let newObj = [];
          // newObj.push(obj);
          newObj[obj.mesin] = obj;
          if (result[obj.line]) {
            result[obj.line][obj.mesin] = obj;
          } else {
            result[obj.line] = newObj;
          }
          return result;
        }, []);

        console.log(newData);

        let tbody_data_skillElement = document.querySelector('#tbody_data_skill');
        let thead_data_skillElement = document.querySelector('#thead_data_skill');
        // let baris = document.querySelectorAll('.data_skill').length;
        let line = <?= json_encode($line) ?>;
        let mesin = [];
        if (1 <= choose_lineVal && choose_lineVal <= 7)
          mesin = <?= json_encode($mesin) ?>;
        // else if(4 <= choose_lineVal && choose_lineVal <= 7)
        //   mesin = ['Plate Cutting', 'Envelope', 'Mearing', 'Burning', 'COS', 'PW & Supply Komponen', 'Inserting & Mearing', 'Auto Cover', 'HSM', 'Pole Burning', 'Finish & Packing', 'PIC Line', 'INFOR', 'Clamping', 'Alat Angkat Angkut', 'Plate Cutting Loading', 'Recycle', 'SAW Repair', 'Supply Komponen'];
        else if (choose_lineVal == 10)
          mesin = ['PIC Line', 'Plate Cutting', 'AGM', 'COS', 'TERE', 'HSM', 'Packing', 'Acid Botol'];
        else if (choose_lineVal >= 8 && choose_lineVal <= 9)
          mesin = ['PIC Line', 'Acid Filling', 'Loading', 'Unloading', 'Levelling', 'HSM', 'Packing'];
        else
          mesin = ['Loading Cutting', 'Potong Battery', 'SAW Repair', 'Alat Angkat Angkut', 'Clamp Battery', 'Supply Komponen', 'Printing', 'Repair Battery', 'INFOR'];
        tbody_data_skillElement.innerHTML = '';
        if (data.length > 0) {
          if (choose_lineVal !== '') {
            thead_data_skillElement.innerHTML = `
              <thead id="thead_data_skill">
                <tr>
                  <th style="font-size: 20px">Line</th>
                  <th style="font-size: 20px">Mesin</th>
                  <th style="font-size: 20px">Skill</th>
                </tr>
              </thead>
            `;
            for (let index = 0; index < mesin.length; index++) {
              tbody_data_skillElement.innerHTML += `
                <tr class="data_skill">
                  <td style="font-size: 20px">
                    ${line[choose_lineVal - 1]}
                    <input type="hidden" class="form-control" name="line[]" value="${choose_lineVal}">
                    <input type="hidden" class="form-control" name="id_detail_man_power[]" value="${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].id_detail_man_power !== '') ? newData[choose_lineVal][mesin[index]].id_detail_man_power : '') : ''}">
                  </td>
                  <td style="font-size: 20px">${mesin[index]}<input type="hidden" class="form-control" name="mesin[]" value="${mesin[index]}"></td>
                  <td>
                    <input type="hidden" class="form-control" name="skill[]" id="skill_${choose_lineVal}_${index}" value="${newData?.[choose_lineVal]?.[mesin[index]]?.skill}">
                    <button type="button" class="btn p-0" value="0" id="skill_${choose_lineVal}_${index}_0" onclick="choose_skill(${choose_lineVal}, ${index}, 0)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #000000; background-color: ${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].skill === 0) ? '#000000' : '') : ''}; color: ${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].skill === 0) ? '#ffffff' : '') : ''}; --hover-background-color: #000000; --hover-color: #ffffff">0%</button>
                    <button type="button" class="btn p-0" value="1" id="skill_${choose_lineVal}_${index}_1" onclick="choose_skill(${choose_lineVal}, ${index}, 1)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ff0000; background-color: ${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].skill === 1) ? '#ff0000' : '') : '#ff0000'}; color: ${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].skill === 1) ? '#ffffff' : '') : '#ffffff'}; --hover-background-color: #ff0000; --hover-color: #ffffff">25%</button>
                    <button type="button" class="btn p-0" value="2" id="skill_${choose_lineVal}_${index}_2" onclick="choose_skill(${choose_lineVal}, ${index}, 2)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ffff00; background-color: ${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].skill === 2) ? '#ffff00' : '') : ''}; color: ${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].skill === 2) ? '#000000' : '') : ''}; --hover-background-color: #ffff00; --hover-color: #000000">50%</button>
                    <button type="button" class="btn p-0" value="3" id="skill_${choose_lineVal}_${index}_3" onclick="choose_skill(${choose_lineVal}, ${index}, 3)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #0000ff; background-color: ${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].skill === 3) ? '#0000ff' : '') : ''}; color: ${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].skill === 3) ? '#ffffff' : '') : ''}; --hover-background-color: #0000ff; --hover-color: #ffffff">75%</button>
                    <button type="button" class="btn p-0" value="4" id="skill_${choose_lineVal}_${index}_4" onclick="choose_skill(${choose_lineVal}, ${index}, 4)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #00aa00; background-color: ${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].skill === 4) ? '#00aa00' : '') : ''}; color: ${(newData[choose_lineVal].hasOwnProperty(mesin[index])) ? ((newData[choose_lineVal][mesin[index]].skill === 4) ? '#ffffff' : '') : ''}; --hover-background-color: #00aa00; --hover-color: #ffffff">100%</button>
                    <button type="button" class="btn btn-sm btn-danger ms-3 p-2" id="skill_${choose_lineVal}_${index}_5" onclick="delete_skill(${choose_lineVal}, ${index}, 5)"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
                  </td>
                </tr>
              `;
            }
          } else {
            let table_data_skillElement = document.querySelector('#table_data_skill');
            table_data_skillElement.innerHTML = `
              <thead id="thead_data_skill">
                <tr>
                  <th style="font-size: 20px">Line</th>
                  <th style="font-size: 20px">Mesin</th>
                  <th style="font-size: 20px">Skill</th>
                  <th class="border"></th>
                  <th style="font-size: 20px">Line</th>
                  <th style="font-size: 20px">Mesin</th>
                  <th style="font-size: 20px">Skill</th>
                </tr>
              </thead>
              <tbody id="tbody_data_skill">
              <?php for ($j = 0; $j < count($line); $j++) {
                if ($j >= 0 && $j <= 6)
                  $mesin = ['PIC Line', 'Plate Cutting', 'Envelope', 'Mearing', 'COS', 'SAW', 'PW', 'HSM', 'Pole Burning', 'Packing'];
                // else if($j >= 3 && $j <= 6)
                //   $mesin = ['Plate Cutting', 'Envelope', 'Mearing', 'Burning', 'COS', 'PW & Supply Komponen', 'Inserting & Mearing', 'Auto Cover', 'HSM', 'Pole Burning', 'Finish & Packing', 'PIC Line', 'INFOR', 'Clamping', 'Alat Angkat Angkut', 'Plate Cutting Loading', 'Recycle', 'SAW Repair', 'Supply Komponen'];
                else if ($j === 9)
                  $mesin = ['PIC Line', 'Plate Cutting', 'AGM', 'COS', 'TERE', 'HSM', 'Packing', 'Acid Botol'];
                else if ($j >= 7 && $j <= 8)
                  $mesin = ['PIC Line', 'Acid Filling', 'Loading', 'Unloading', 'Levelling', 'HSM', 'Packing'];
                else
                  $mesin = ['Loading Cutting', 'Potong Battery', 'SAW Repair', 'Alat Angkat Angkut', 'Clamp Battery', 'Supply Komponen', 'Printing', 'Repair Battery', 'INFOR'];
              ?>
                <?php for ($i = 0; $i < count($mesin); $i++) { ?>
                <tr class="data_skill">
                  <td style="font-size: 20px" class="fw-bold">
                    <?= $line[$j] ?>
                    <input type="hidden" class="form-control" name="line[]" value="<?= $j + 1 ?>">
                    <input type="hidden" class="form-control" name="id_detail_man_power[]" value="${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].id_detail_man_power !== '') ? newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].id_detail_man_power : '') : '') : ''}">
                  </td>
                  <td style="font-size: 20px"><?= $mesin[$i] ?><input type="hidden" class="form-control" name="mesin[]" value="<?= $mesin[$i] ?>"></td>
                  <td>
                    <input type="hidden" class="form-control" name="skill[]" id="skill_<?= $j ?>_<?= $i ?>" value="${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill !== '') ? newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill : '') : 1) : 1}">
                    <button type="button" class="btn p-0" value="0" id="skill_<?= $j ?>_<?= $i ?>_0" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 0)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #000000; background-color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 0) ? '#000000' : '') : '') : ''}; color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 0) ? '#ffffff' : '') : '') : ''}; --hover-background-color: #000000; --hover-color: #ffffff">0%</button>
                    <button type="button" class="btn p-0" value="1" id="skill_<?= $j ?>_<?= $i ?>_1" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 1)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ff0000; background-color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 1) ? '#ff0000' : '') : '#ff0000') : '#ff0000'}; color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 1) ? '#ffffff' : '') : '#ffffff') : '#ffffff'}; --hover-background-color: #ff0000; --hover-color: #ffffff">25%</button>
                    <button type="button" class="btn p-0" value="2" id="skill_<?= $j ?>_<?= $i ?>_2" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 2)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ffff00; background-color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 2) ? '#ffff00' : '') : '') : ''}; color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 2) ? '#000000' : '') : '') : ''}; --hover-background-color: #ffff00; --hover-color: #000000">50%</button>
                    <button type="button" class="btn p-0" value="3" id="skill_<?= $j ?>_<?= $i ?>_3" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 3)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #0000ff; background-color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 3) ? '#0000ff' : '') : '') : ''}; color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 3) ? '#ffffff' : '') : '') : ''}; --hover-background-color: #0000ff; --hover-color: #ffffff">75%</button>
                    <button type="button" class="btn p-0" value="4" id="skill_<?= $j ?>_<?= $i ?>_4" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 4)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #00aa00; background-color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 4) ? '#00aa00' : '') : '') : ''}; color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 4) ? '#ffffff' : '') : '') : ''}; --hover-background-color: #00aa00; --hover-color: #ffffff">100%</button>
                    <button type="button" class="btn btn-sm btn-danger ms-3 p-2" id="skill_<?= $j ?>_<?= $i ?>_5" onclick="delete_skill(<?= $j ?>, <?= $i ?>, 5)"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
                  </td>
                  <td class="border"></td>
                  <?php if ($j == 2 || $j == 6 || $j == 8 || $j == 9) {
                    continue;
                  } else { ?>
                    <?php $j = $j + 1; ?>
                    <?php if ($j < count($line)) { ?>
                    <?php
                      if ($j >= 0 && $j <= 6)
                        $mesin = ['PIC Line', 'Plate Cutting', 'Envelope', 'Mearing', 'COS', 'SAW', 'PW', 'HSM', 'Pole Burning', 'Packing'];
                      // else if($j >= 3 && $j <= 6)
                      //   $mesin = ['Plate Cutting', 'Envelope', 'Mearing', 'Burning', 'COS', 'PW & Supply Komponen', 'Inserting & Mearing', 'Auto Cover', 'HSM', 'Pole Burning', 'Finish & Packing', 'PIC Line', 'INFOR', 'Clamping', 'Alat Angkat Angkut', 'Plate Cutting Loading', 'Recycle', 'SAW Repair', 'Supply Komponen'];
                      else if ($j === 9)
                        $mesin = ['PIC Line', 'Plate Cutting', 'AGM', 'COS', 'TERE', 'HSM', 'Packing', 'Acid Botol'];
                      else if ($j >= 7 && $j <= 8)
                        $mesin = ['PIC Line', 'Acid Filling', 'Loading', 'Unloading', 'Levelling', 'HSM', 'Packing'];
                      else
                        $mesin = ['Loading Cutting', 'Potong Battery', 'SAW Repair', 'Alat Angkat Angkut', 'Clamp Battery', 'Supply Komponen', 'Printing', 'Repair Battery', 'INFOR'];
                    ?>
                    <td style="font-size: 20px" class="fw-bold">
                      <?= $line[$j] ?>
                      <input type="hidden" class="form-control" name="line[]" value="<?= $j + 1 ?>">
                      <input type="hidden" class="form-control" name="id_detail_man_power[]" value="${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].id_detail_man_power !== '') ? newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].id_detail_man_power : '') : '') : ''}">
                    </td>
                    <td style="font-size: 20px"><?= $mesin[$i] ?><input type="hidden" class="form-control" name="mesin[]" value="<?= $mesin[$i] ?>"></td>
                    <td>
                      <input type="hidden" class="form-control" name="skill[]" id="skill_<?= $j ?>_<?= $i ?>" value="${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill !== '') ? newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill : '') : 1) : 1}">
                      <button type="button" class="btn p-0" value="0" id="skill_<?= $j ?>_<?= $i ?>_0" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 0)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #000000; background-color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 0) ? '#000000' : '') : '') : ''}; color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 0) ? '#ffffff' : '') : '') : ''}; --hover-background-color: #000000; --hover-color: #ffffff">0%</button>
                      <button type="button" class="btn p-0" value="1" id="skill_<?= $j ?>_<?= $i ?>_1" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 1)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ff0000; background-color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 1) ? '#ff0000' : '') : '#ff0000') : '#ff0000'}; color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 1) ? '#ffffff' : '') : '#ffffff') : '#ffffff'}; --hover-background-color: #ff0000; --hover-color: #ffffff">25%</button>
                      <button type="button" class="btn p-0" value="2" id="skill_<?= $j ?>_<?= $i ?>_2" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 2)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ffff00; background-color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 2) ? '#ffff00' : '') : '') : ''}; color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 2) ? '#000000' : '') : '') : ''}; --hover-background-color: #ffff00; --hover-color: #000000">50%</button>
                      <button type="button" class="btn p-0" value="3" id="skill_<?= $j ?>_<?= $i ?>_3" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 3)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #0000ff; background-color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 3) ? '#0000ff' : '') : '') : ''}; color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 3) ? '#ffffff' : '') : '') : ''}; --hover-background-color: #0000ff; --hover-color: #ffffff">75%</button>
                      <button type="button" class="btn p-0" value="4" id="skill_<?= $j ?>_<?= $i ?>_4" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 4)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #00aa00; background-color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 4) ? '#00aa00' : '') : '') : ''}; color: ${(newData.hasOwnProperty(<?= $j + 1 ?>)) ? ((newData[<?= $j + 1 ?>].hasOwnProperty('<?= $mesin[$i] ?>')) ? ((newData[<?= $j + 1 ?>]['<?= $mesin[$i] ?>'].skill === 4) ? '#ffffff' : '') : '') : ''}; --hover-background-color: #00aa00; --hover-color: #ffffff">100%</button>
                      <button type="button" class="btn btn-sm btn-danger ms-3 p-2" id="skill_<?= $j ?>_<?= $i ?>_5" onclick="delete_skill(<?= $j ?>, <?= $i ?>, 5)"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
                    </td>
                    <?php } ?>
                    <?php } ?>
                    <?php $j = $j - 1; ?>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="3" style="border-bottom: solid 1px black"></td>
                  <td class="border"></td>
                  <td colspan="3" style="border-bottom: solid 1px black"></td>
                </tr>
                <?php if ($j == 2 || $j == 6 || $j == 8 || $j == 9) {
                  continue;
                } else {
                  $j = $j + 1;
                } ?>
              <?php } ?>
              </tbody>
            `;
          }
        } else {
          if (choose_lineVal !== '') {
            thead_data_skillElement.innerHTML = `
              <thead id="thead_data_skill">
                <tr>
                  <th style="font-size: 20px">Line</th>
                  <th style="font-size: 20px">Mesin</th>
                  <th style="font-size: 20px">Skill</th>
                </tr>
              </thead>
            `;
            for (let index = 0; index < mesin.length; index++) {
              tbody_data_skillElement.innerHTML += `
                <tr class="data_skill">
                  <td style="font-size: 20px">
                    ${line[choose_lineVal - 1]}
                    <input type="hidden" class="form-control" name="line[]" value="${choose_lineVal}">
                    <input type="hidden" class="form-control" name="id_detail_man_power[]" value="">
                  </td>
                  <td style="font-size: 20px">${mesin[index]}<input type="hidden" class="form-control" name="mesin[]" value="${mesin[index]}"></td>
                  <td>
                    <input type="hidden" class="form-control" name="skill[]" id="skill_${choose_lineVal}_${index}" value="1">
                    <button type="button" class="btn p-0" value="0" id="skill_${choose_lineVal}_${index}_0" onclick="choose_skill(${choose_lineVal}, ${index}, 0)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #000000; --hover-background-color: #000000; --hover-color: #ffffff">0%</button>
                    <button type="button" class="btn p-0" value="1" id="skill_${choose_lineVal}_${index}_1" onclick="choose_skill(${choose_lineVal}, ${index}, 1)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ff0000; background-color: #ff0000; color: #ffffff; --hover-background-color: #ff0000; --hover-color: #ffffff">25%</button>
                    <button type="button" class="btn p-0" value="2" id="skill_${choose_lineVal}_${index}_2" onclick="choose_skill(${choose_lineVal}, ${index}, 2)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ffff00; --hover-background-color: #ffff00; --hover-color: #000000">50%</button>
                    <button type="button" class="btn p-0" value="3" id="skill_${choose_lineVal}_${index}_3" onclick="choose_skill(${choose_lineVal}, ${index}, 3)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #0000ff; --hover-background-color: #0000ff; --hover-color: #ffffff">75%</button>
                    <button type="button" class="btn p-0" value="4" id="skill_${choose_lineVal}_${index}_4" onclick="choose_skill(${choose_lineVal}, ${index}, 4)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #00aa00; --hover-background-color: #00aa00; --hover-color: #ffffff">100%</button>
                    <button type="button" class="btn btn-sm btn-danger ms-3 p-2" id="skill_${choose_lineVal}_${index}_5" onclick="delete_skill(${choose_lineVal}, ${index}, 5)"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
                  </td>
                </tr>
              `;
            }
          } else {
            let table_data_skillElement = document.querySelector('#table_data_skill');
            table_data_skillElement.innerHTML = `
              <thead id="thead_data_skill">
                <tr>
                  <th style="font-size: 20px">Line</th>
                  <th style="font-size: 20px">Mesin</th>
                  <th style="font-size: 20px">Skill</th>
                  <th class="border"></th>
                  <th style="font-size: 20px">Line</th>
                  <th style="font-size: 20px">Mesin</th>
                  <th style="font-size: 20px">Skill</th>
                </tr>
              </thead>
              <tbody id="tbody_data_skill">
              <?php for ($j = 0; $j < count($line); $j++) {
                if ($j >= 0 && $j <= 6)
                  $mesin = ['PIC Line', 'Plate Cutting', 'Envelope', 'Mearing', 'COS', 'SAW', 'PW', 'HSM', 'Pole Burning', 'Packing'];
                // else if($j >= 3 && $j <= 6)
                //   $mesin = ['Plate Cutting', 'Envelope', 'Mearing', 'Burning', 'COS', 'PW & Supply Komponen', 'Inserting & Mearing', 'Auto Cover', 'HSM', 'Pole Burning', 'Finish & Packing', 'PIC Line', 'INFOR', 'Clamping', 'Alat Angkat Angkut', 'Plate Cutting Loading', 'Recycle', 'SAW Repair', 'Supply Komponen'];
                else if ($j === 9)
                  $mesin = ['PIC Line', 'Plate Cutting', 'AGM', 'COS', 'TERE', 'HSM', 'Packing', 'Acid Botol'];
                else if ($j >= 7 && $j <= 8)
                  $mesin = ['PIC Line', 'Acid Filling', 'Loading', 'Unloading', 'Levelling', 'HSM', 'Packing'];
                else
                  $mesin = ['Loading Cutting', 'Potong Battery', 'SAW Repair', 'Alat Angkat Angkut', 'Clamp Battery', 'Supply Komponen', 'Printing', 'Repair Battery', 'INFOR'];
              ?>
                <?php for ($i = 0; $i < count($mesin); $i++) { ?>
                <tr class="data_skill">
                  <td style="font-size: 20px" class="fw-bold">
                    <?= $line[$j] ?>
                    <input type="hidden" class="form-control" name="line[]" value="<?= $j + 1 ?>">
                    <input type="hidden" class="form-control" name="id_detail_man_power[]" value="">
                  </td>
                  <td style="font-size: 20px"><?= $mesin[$i] ?><input type="hidden" class="form-control" name="mesin[]" value="<?= $mesin[$i] ?>"></td>
                  <td>
                    <input type="hidden" class="form-control" name="skill[]" id="skill_<?= $j ?>_<?= $i ?>" value="1">
                    <button type="button" class="btn p-0" value="0" id="skill_<?= $j ?>_<?= $i ?>_0" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 0)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #000000; --hover-background-color: #000000; --hover-color: #ffffff">0%</button>
                    <button type="button" class="btn p-0" value="1" id="skill_<?= $j ?>_<?= $i ?>_1" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 1)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ff0000; background-color: #ff0000; color: #ffffff; --hover-background-color: #ff0000; --hover-color: #ffffff">25%</button>
                    <button type="button" class="btn p-0" value="2" id="skill_<?= $j ?>_<?= $i ?>_2" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 2)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ffff00; --hover-background-color: #ffff00; --hover-color: #000000">50%</button>
                    <button type="button" class="btn p-0" value="3" id="skill_<?= $j ?>_<?= $i ?>_3" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 3)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #0000ff; --hover-background-color: #0000ff; --hover-color: #ffffff">75%</button>
                    <button type="button" class="btn p-0" value="4" id="skill_<?= $j ?>_<?= $i ?>_4" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 4)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #00aa00; --hover-background-color: #00aa00; --hover-color: #ffffff">100%</button>
                    <button type="button" class="btn btn-sm btn-danger ms-3 p-2" id="skill_<?= $j ?>_<?= $i ?>_5" onclick="delete_skill(<?= $j ?>, <?= $i ?>, 5)"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
                  </td>
                  <td class="border"></td>
                  <?php if ($j == 2 || $j == 6 || $j == 8 || $j == 9) {
                    continue;
                  } else { ?>
                  <?php $j = $j + 1; ?>
                  <?php if ($j < count($line)) { ?>
                  <?php
                      if ($j >= 0 && $j <= 6)
                        $mesin = ['PIC Line', 'Plate Cutting', 'Envelope', 'Mearing', 'COS', 'SAW', 'PW', 'HSM', 'Pole Burning', 'Packing'];
                      // else if($j >= 3 && $j <= 6)
                      //   $mesin = ['Plate Cutting', 'Envelope', 'Mearing', 'Burning', 'COS', 'PW & Supply Komponen', 'Inserting & Mearing', 'Auto Cover', 'HSM', 'Pole Burning', 'Finish & Packing', 'PIC Line', 'INFOR', 'Clamping', 'Alat Angkat Angkut', 'Plate Cutting Loading', 'Recycle', 'SAW Repair', 'Supply Komponen'];
                      else if ($j === 9)
                        $mesin = ['PIC Line', 'Plate Cutting', 'AGM', 'COS', 'TERE', 'HSM', 'Packing', 'Acid Botol'];
                      else if ($j >= 7 && $j <= 8)
                        $mesin = ['PIC Line', 'Acid Filling', 'Loading', 'Unloading', 'Levelling', 'HSM', 'Packing'];
                      else
                        $mesin = ['Loading Cutting', 'Potong Battery', 'SAW Repair', 'Alat Angkat Angkut', 'Clamp Battery', 'Supply Komponen', 'Printing', 'Repair Battery', 'INFOR'];
                  ?>
                  <td style="font-size: 20px" class="fw-bold">
                    <?= $line[$j] ?>
                    <input type="hidden" class="form-control" name="line[]" value="<?= $j + 1 ?>">
                    <input type="hidden" class="form-control" name="id_detail_man_power[]" value="">
                  </td>
                  <td style="font-size: 20px"><?= $mesin[$i] ?><input type="hidden" class="form-control" name="mesin[]" value="<?= $mesin[$i] ?>"></td>
                  <td style="font-size: 20px">
                    <input type="hidden" class="form-control" name="skill[]" id="skill_<?= $j ?>_<?= $i ?>" value="1">
                    <button type="button" class="btn p-0" value="0" id="skill_<?= $j ?>_<?= $i ?>_0" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 0)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #000000; --hover-background-color: #000000; --hover-color: #ffffff">0%</button>
                    <button type="button" class="btn p-0" value="1" id="skill_<?= $j ?>_<?= $i ?>_1" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 1)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ff0000; background-color: #ff0000; color: #ffffff; --hover-background-color: #ff0000; --hover-color: #ffffff">25%</button>
                    <button type="button" class="btn p-0" value="2" id="skill_<?= $j ?>_<?= $i ?>_2" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 2)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #ffff00; --hover-background-color: #ffff00; --hover-color: #000000">50%</button>
                    <button type="button" class="btn p-0" value="3" id="skill_<?= $j ?>_<?= $i ?>_3" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 3)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #0000ff; --hover-background-color: #0000ff; --hover-color: #ffffff">75%</button>
                    <button type="button" class="btn p-0" value="4" id="skill_<?= $j ?>_<?= $i ?>_4" onclick="choose_skill(<?= $j ?>, <?= $i ?>, 4)" style="width: 50px; height: 50px; border-radius: 25px; border-color: #00aa00; --hover-background-color: #00aa00; --hover-color: #ffffff">100%</button>
                    <button type="button" class="btn btn-sm btn-danger ms-3 p-2" id="skill_<?= $j ?>_<?= $i ?>_5" onclick="delete_skill(<?= $j ?>, <?= $i ?>, 5)"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></button>
                  </td>
                  <?php } ?>
                  <?php } ?>
                  <?php $j = $j - 1; ?>
                </tr>
                <?php } ?>
                <tr>
                  <td colspan="3" style="border-bottom: solid 1px black"></td>
                  <td class="border"></td>
                  <td colspan="3" style="border-bottom: solid 1px black"></td>
                </tr>
                <?php if ($j == 2 || $j == 6 || $j == 8 || $j == 9) {
                  continue;
                } else {
                  $j = $j + 1;
                } ?>
              <?php } ?>
              </tbody>
            `;
          }
        }
      }
    })
  }
</script>
<script>
  const foto = document.getElementById('foto');
  const preview = document.getElementById('image');

  foto.addEventListener('change', function() {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.addEventListener('load', function() {
        // const image = new Image();
        // image.src = ;

        preview.innerHTML = `<img src="${reader.result}" style="border-radius: 20px; width: 300px; height: 400px;" alt="">`;
        // preview.innerHTML = '';
        // preview.appendChild(image);
      });

      reader.readAsDataURL(file);
    } else {
      preview.innerHTML = '<img src="<?= base_url() ?>uploads/default_user.png" style="border-radius: 20px; opacity: 60%" alt="">';
    }
  });
</script>
<?= $this->endSection(); ?>