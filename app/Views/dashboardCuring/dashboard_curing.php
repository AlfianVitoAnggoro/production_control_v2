<?= $this->extend('template/dashboardMonitoringCuring/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?php date_default_timezone_set('Asia/Jakarta');
$current_hour = date("Y-m-d H:i:s.u");
?>

<div class="content-wrapper" style="margin-left:0;">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box bg-transparent">
          <div class="box-body" style="display:flex">
            <div class="col">
              <h1 class="text-center fw-bold">Curing Gedung B</h1>
              <div class="row row-cols-5">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="col">
                  <h3 class="text-center fw-bold">Curing <?= $i ?></h3>
                  <div class="border border-dark p-3" id="curing_B_<?= $i ?>" style="border-radius: 10px;">
                    <h5 class="text-center">Start : <?= array_key_exists('Curing ' . $i, $data_curing_B) ? ($data_curing_B['Curing '. $i]['start'] !== NULL ? date("Y-m-d H:i", strtotime($data_curing_B['Curing '. $i]['start'])) : '') : '' ?></h5>
                    <h5 class="text-center">Plan : <?= array_key_exists('Curing ' . $i, $data_curing_B) ? ($data_curing_B['Curing '. $i]['plan'] !== NULL ? date("Y-m-d H:i", strtotime($data_curing_B['Curing '. $i]['plan'])) : '') : '' ?></h5>
                    <h5 class="text-center">Status : 
                      <?php
                      if(array_key_exists('Curing ' . $i, $data_curing_B)) {
                        if($data_curing_B['Curing '. $i]['act'] === NULL) {
                          if($current_hour < date("Y-m-d H:i:s", strtotime($data_curing_B['Curing '. $i]['plan'])))
                            echo '<span id="status_B_' . $i . '">Proses</span>';
                          else if($current_hour >= date("Y-m-d H:i:s", strtotime($data_curing_B['Curing '. $i]['plan'])))
                            echo '<span id="status_B_' . $i . '">Menunggu dikeluarkan</span>';
                          else
                            echo '<span id="status_B_' . $i . '">Kosong</span>';
                        } else {
                          echo '<span id="status_B_' . $i . '">Kosong</span>';
                        }
                      } else {
                        echo '<span id="status_B_' . $i . '">Kosong</span>';
                      }
                      ?>
                    </h5>
                  </div>
                </div>
              <?php } ?>
              </div>
              <h1 class="text-center fw-bold">Curing Gedung E</h1>
              <div class="row row-cols-5">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="col">
                  <h3 class="text-center fw-bold">Curing <?= $i ?></h3>
                  <div class="border border-dark p-3" id="curing_E_<?= $i ?>" style="border-radius: 10px;">
                    <h5 class="text-center">Start : <?= array_key_exists('Curing ' . $i, $data_curing_E) ? ($data_curing_E['Curing '. $i]['start'] !== NULL ? date("Y-m-d H:i", strtotime($data_curing_E['Curing '. $i]['start'])) : '') : '' ?></h5>
                    <h5 class="text-center">Plan : <?= array_key_exists('Curing ' . $i, $data_curing_E) ? ($data_curing_E['Curing '. $i]['plan'] !== NULL ? date("Y-m-d H:i", strtotime($data_curing_E['Curing '. $i]['plan'])) : '') : '' ?></h5>
                    <h5 class="text-center">Status : 
                      <?php
                      if(array_key_exists('Curing ' . $i, $data_curing_E)) {
                        if($data_curing_E['Curing '. $i]['act'] === NULL) {
                          if($current_hour < date("Y-m-d H:i:s", strtotime($data_curing_E['Curing '. $i]['plan'])))
                            echo '<span id="status_E_' . $i . '">Proses</span></span>';
                          else if($current_hour >= date("Y-m-d H:i:s", strtotime($data_curing_E['Curing '. $i]['plan'])))
                            echo '<span id="status_E_' . $i . '">Menunggu dikeluarkan</span>';
                          else
                            echo '<span id="status_E_' . $i . '">Kosong</span>';
                        } else {
                          echo '<span id="status_E_' . $i . '">Kosong</span>';
                        }
                      } else {
                        echo '<span id="status_E_' . $i . '">Kosong</span>';
                      }
                      ?>
                    </h5>
                  </div>
                </div>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->
<?= $this->endSection();
?>

<?= $this->section('script'); ?>
<script>
  function blink(gedung, index) {
    var curing = document.getElementById("curing_" + gedung + '_' + index);
    console.log(curing);
    var colors = ["yellow", "white"];
    var currentColorIndex = 0;

    setInterval(function() {
      curing.style.backgroundColor = colors[currentColorIndex];
      currentColorIndex = (currentColorIndex + 1) % colors.length;
    }, 3000); // Ubah angka ini untuk mengatur kecepatan kedipan (dalam milidetik)
  }

  for(let j = 1; j <= 5; j++) {
    let statusB = document.getElementById('status_B_' + j).innerText;
    if(statusB === 'Menunggu dikeluarkan')
      blink('B', j);
    let statusE = document.getElementById('status_E_' + j).innerText;
    if(statusE === 'Menunggu dikeluarkan')
      blink('E', j);
    console.log({statusB, statusE});
  }
</script>
<?= $this->endSection(); ?>