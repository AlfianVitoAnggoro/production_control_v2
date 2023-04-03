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
                  <h4 class="box-title">Data Master Line Stop</h4>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_line_stop">
                    Tambah Data
                  </button>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="data_line_stop" class="table table-bordered table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>Jenis Line Stop</th>
                          <th>Proses Line Stop</th>
                          <th>Dept In Charge</th>
                          <th>Perhitungan</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data_breakdown as $d) : ?>
                          <tr>
                            <td><?= $d['jenis_breakdown'] ?></td>
                            <td><?= $d['proses_breakdown'] ?></td>
                            <td><?= $d['dept_in_charge'] ?></td>
                            <td><?= $d['perhitungan'] ?></td>
                            <td>
                              <div>
                                <?php
                                if (trim($d['status']) === 'approved') :
                                ?>
                                  <span class="badge bg-success">Approved</span>
                                <?php elseif (trim($d['status']) === 'pending') : ?>
                                  <span class="badge bg-warning">Pending</span>
                                <?php elseif (trim($d['status']) === 'rejected') : ?>
                                  <span class="badge bg-danger">Rejected</span>
                                <?php endif ?>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex">
                                <a href="<?= base_url() ?>line_stop/detail_line_stop/<?= $d['id_breakdown'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                &nbsp
                                <form action="<?= base_url() ?>line_stop/detail_line_stop/delete" method="POST">
                                  <input type="hidden" name="id_breakdown" value="<?= $d['id_breakdown'] ?>">
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
<div class="modal fade modal_tambah_line_stop" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Tambah Line Stop</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url() ?>line_stop/add_line_stop" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Jenis Line Stop</label>
                <input type="text" class="form-control" id="jenis_breakdown" name="jenis_breakdown">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Proses Line Stop</label>
                <input type="text" class="form-control" id="proses_breakdown" name="proses_breakdown">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Dept In Charge</label>
                <input type="text" class="form-control" id="dept_in_charge" name="dept_in_charge">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Perhitungan</label>
                <input type="text" class="form-control" id="perhitungan" name="perhitungan">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="float: right;">
          <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->
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
    $('#data_line_stop').DataTable({
      "order": []
    });
  });
</script>
<?= $this->endSection(); ?>