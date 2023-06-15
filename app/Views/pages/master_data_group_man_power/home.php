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
                  <h4 class="box-title">Data Master Group Man Power</h4>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_man_power">
                    Tambah Data
                  </button>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="data_group_man_power" class="table table-bordered table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>Line</th>
                          <!-- <th>Group</th> -->
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data_group_man_power as $d_mp) : ?>
                          <tr>
                            <td><?= $d_mp['line'] ?></td>
                            <td>
                              <div class="d-flex">
                                <a href="<?= base_url() ?>master_group_man_power/detail_group_man_power/<?= $d_mp['id_group'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                &nbsp
                                <form action="<?= base_url() ?>master_group_man_power/detail_group_man_power/delete" method="POST">
                                  <input type="hidden" name="id_group_man_power" value="<?= $d_mp['id_group'] ?>">
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                </form>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
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
<div class="modal fade modal_tambah_man_power" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Tambah Group Man Power</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url() ?>master_group_man_power/add_group_man_power" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label class="form-label">Line</label>
                <!-- <input type="number" class="form-control" id="line" name="line"> -->
                <select name="line" class="form-select" id="line">
                  <option value="" selected>-- Pilih Line --</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">WET A</option> // WET A = 8
                  <option value="9">WET F</option> // WET F = 9
                  <option value="10">MCB</option> // MCB = 10
                </select>
              </div>
            </div>
            <!-- <div class="col-6">
              <div class="form-group">
                <label class="form-label">Group</label>
                <input type="text" class="form-control" id="group_mp" name="group_mp">
              </div>
            </div> -->
          </div>
        </div>
        <div class="modal-footer" style="float: right;">
          <input type="submit" class="btn btn-primary float-end" value="Tambah">
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    $('#data_group_man_power').DataTable({
      "order": []
    });
  });
  $('.select2').select2();
</script>
<?= $this->endSection(); ?>