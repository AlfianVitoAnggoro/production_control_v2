<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-12 col-12">
          <div class="row">
            <div class="col-12 col-xl-12">
              <div class="box">
                <div class="box-header with-border">
                  <h4 class="box-title">Monitoring Curing</h4>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="data_curing" class="table table-bordered table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>Mesin</th>
                          <th>Start</th>
                          <th>Plan</th>
                          <th>Act</th>
                          <th>Gedung</th>
                          <th>QC</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $index = 0; foreach ($data_curing as $curing) : ?>
                          <tr>
                            <td><?= $curing['mesin'] ?></td>
                            <td><?= $curing['start'] ?></td>
                            <td><?= $curing['plan_curing'] ?></td>
                            <td><?= $curing['act'] ?></td>
                            <td><?= $curing['gedung'] ?></td>
                            <td>
                              <div class="text-center">
                                <button type="button" class="btn <?= $curing['qc'] !== NULL ? 'btn-primary' : 'btn-outline-primary' ?>" id="qc_<?= $index ?>" name="qc_<?= $index ?>" value="<?= $curing['qc'] ?>" onclick="add_qc(<?= $index ?>)">✔</button>
                              </div>
                              <input type="hidden" name="id_curing_<?= $index ?>" id="id_curing_<?= $index ?>" value="<?= $curing['id_curing'] ?>">
                            </td>
                          </tr>
                        <?php $index++; endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
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
  function add_qc(i) {
    let id_curing = $('#id_curing_' + i).val();
    let qc = $('#qc_' + i).val();

    $.ajax({
      url: '<?= base_url() ?>monitoring_curing_qc/update_curing',
      type: 'POST',
      data: {
        id_curing: id_curing,
        qc: qc,
      },
      dataType: 'json',
      success: function(data) {
        $('#qc_' + i).val(data);
        if(data !== null) {
          document.querySelector('#qc_' + i).classList.remove("btn-outline-primary");
          document.querySelector('#qc_' + i).classList.add("btn-primary");
        } else {
          document.querySelector('#qc_' + i).classList.remove("btn-primary");
          document.querySelector('#qc_' + i).classList.add("btn-outline-primary");
        }
      }
    });
  }
</script>
<?= $this->endSection(); ?>