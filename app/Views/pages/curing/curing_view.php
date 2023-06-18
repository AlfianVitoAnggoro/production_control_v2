<?= $this->extend('template/dashboardCuring/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left:0;">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box bg-transparent">
          <div class="box-body" style="display:flex">
            <div class="col">
              <h1 class="text-center fw-bold">Gedung B</h1>
              <div class="row row-cols-5">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="col">
                  <h3 class="text-center fw-bold">Curing <?= $i ?></h3>
                  <input type="hidden" name="id_curing_B_<?= $i ?>" id="id_curing_B_<?= $i ?>" value="<?= array_key_exists('Curing ' . $i, $data_curing_B) ? ($data_curing_B['Curing '. $i]['act'] === NULL ? $data_curing_B['Curing ' . $i]['id_curing'] : '') : '' ?>">
                  <div class="border border-dark p-3 d-flex justify-content-center align-items-center flex-column" style="border-radius: 10px; height: 20vh;">
                    <button type="button" class="btn btn-info mb-2" style="font-size: 24px;" id="start_B_<?= $i ?>" onclick="add_start('Curing <?= $i ?>', 'B', <?= $i ?>)" <?= array_key_exists('Curing ' . $i, $data_curing_B) ? ($data_curing_B['Curing '. $i]['act'] === NULL ? 'disabled' : '') : '' ?>>Start</button>
                    <button type="button" class="btn btn-danger" style="font-size: 24px;" id="stop_B_<?= $i ?>" onclick="add_stop('Curing <?= $i ?>', 'B', <?= $i ?>)" <?= array_key_exists('Curing ' . $i, $data_curing_B) ? ($data_curing_B['Curing '. $i]['act'] !== NULL ? 'disabled' : '') : 'disabled' ?>>Stop</button>
                  </div>
                </div>
              <?php } ?>
              </div>
              <h1 class="text-center fw-bold">Gedung E</h1>
              <div class="row row-cols-5">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
                <div class="col">
                  <h3 class="text-center fw-bold">Curing <?= $i ?></h3>
                  <input type="hidden" name="id_curing_E_<?= $i ?>" id="id_curing_E_<?= $i ?>" value="<?= array_key_exists('Curing ' . $i, $data_curing_E) ? ($data_curing_E['Curing '. $i]['act'] === NULL ? $data_curing_E['Curing ' . $i]['id_curing'] : '') : '' ?>">
                  <div class="border border-dark p-3 d-flex justify-content-center align-items-center flex-column" style="border-radius: 10px; height: 20vh;">
                    <button type="button" class="btn btn-info mb-2" style="font-size: 24px;" id="start_E_<?= $i ?>" onclick="add_start('Curing <?= $i ?>', 'E', <?= $i ?>)" <?= array_key_exists('Curing ' . $i, $data_curing_E) ? ($data_curing_E['Curing '. $i]['act'] === NULL ? 'disabled' : '') : '' ?>>Start</button>
                    <button type="button" class="btn btn-danger" style="font-size: 24px;" id="stop_E_<?= $i ?>" onclick="add_stop('Curing <?= $i ?>', 'E', <?= $i ?>)" <?= array_key_exists('Curing ' . $i, $data_curing_E) ? ($data_curing_E['Curing '. $i]['act'] !== NULL ? 'disabled' : '') : 'disabled' ?>>Stop</button>
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


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    $('#data_curing').DataTable({
      order: []
    });
  });

  function add_start(mesin, gedung, index) {
    let id_curing = $('#id_curing_' + gedung + '_' + index).val();
    console.log(id_curing);
    let start = 'start';
    $.ajax({
      url: '<?= base_url() ?>curing/update_curing',
      type: 'POST',
      data: {
        id_curing: id_curing,
        mesin: mesin,
        start: start,
        gedung: gedung,
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        document.querySelector('#start_' + gedung + '_' + index).setAttribute('disabled', '');
        document.querySelector('#stop_' + gedung + '_' + index).removeAttribute('disabled');
        if(id_curing === '')
          $('#id_curing_' + gedung + '_' + index).val(data);
        else
          $('#id_curing_' + gedung + '_' + index).val(id_curing);
      }
    });
  }

  function add_stop(mesin, gedung, index) {
    let id_curing = $('#id_curing_' + gedung + '_' + index).val();
    console.log(id_curing);
    let stop = 'stop';
    $.ajax({
      url: '<?= base_url() ?>curing/update_curing',
      type: 'POST',
      data: {
        id_curing: id_curing,
        mesin: mesin,
        stop: stop,
        gedung: gedung,
      },
      dataType: 'json',
      success: function(data) {
        console.log(data);
        document.querySelector('#stop_' + gedung + '_' + index).setAttribute('disabled', '');
        document.querySelector('#start_' + gedung + '_' + index).removeAttribute('disabled');
        $('#id_curing_' + gedung + '_' + index).val('');
      }
    });
  }
</script>
<?= $this->endSection(); ?>