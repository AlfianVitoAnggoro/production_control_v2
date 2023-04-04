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
                  <h4 class="box-title">Data Master Reject Pasting</h4>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_reject_pasting">
                    Tambah Data
                  </button>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="data_reject_pasting" class="table table-bordered table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>Jenis Reject Pasting</th>
                          <th>Kategori Reject Pasting</th>
                          <!-- <th>Status</th> -->
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data_reject_pasting as $d) : ?>
                          <tr>
                            <td><?= $d['jenis_reject_pasting'] ?></td>
                            <td><?= $d['kategori_reject_pasting'] ?></td>
                            <!-- <td>
                              <div>
                                <?php
                                ""//if (trim($d['status']) === 'approved') :
                                ?>
                                  <span class="badge bg-success">Approved</span>
                                <?php ""//elseif (trim($d['status']) === 'waiting') : ?>
                                  <span class="badge bg-warning">Waiting</span>
                                <?php ""//elseif (trim($d['status']) === 'rejected') : ?>
                                  <span class="badge bg-danger">Rejected</span>
                                <?php ""//endif ?>
                              </div>
                            </td> -->
                            <td>
                              <div class="d-flex">
                                <a href="<?= base_url() ?>reject_pasting/detail_reject_pasting/<?= $d['id_reject_pasting'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                &nbsp
                                <form action="<?= base_url() ?>reject_pasting/detail_reject_pasting/delete" method="POST">
                                  <input type="hidden" name="id_reject_pasting" value="<?= $d['id_reject_pasting'] ?>">
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
<div class="modal fade modal_tambah_reject_pasting" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Tambah Reject Pasting</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url() ?>reject_pasting/add_reject_pasting" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Jenis Reject Pasting</label>
                <div class="jenis_reject_pasting">
                  <select name="jenis_reject_pasting[]" id="jenis_reject_pasting" class="form-select">
                    <option value="">Pilih Jenis Reject Pasting</option>
                    <?php foreach ($data_jenis_reject_pasting as $d_jenis_reject_pasting) { ?>
                      <option value="<?= $d_jenis_reject_pasting['jenis_reject_pasting'] ?>"><?= $d_jenis_reject_pasting['jenis_reject_pasting'] ?></option>
                    <?php } ?>
                  </select>
                  <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_jenis_reject_pasting()">Tambah Data</button>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Kategori Reject Pasting</label>
                <input type="text" class="form-control" id="kategori_reject_pasting" name="kategori_reject_pasting">
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
    $('#data_reject_pasting').DataTable({
      "order": []
    });
  });

  function add_jenis_reject_pasting() {
    let jenis_reject_pastingElement = document.querySelector('.jenis_reject_pasting');
    jenis_reject_pastingElement.innerHTML = `
      <input type="text" class="form-control" id="jenis_reject_pasting" name="jenis_reject_pasting">
      <button type="button" class="btn btn-danger p-1 mt-1" onclick="batal_jenis_reject_pasting()">Batal</button>
    `
  }
  
  function batal_jenis_reject_pasting() {
    let jenis_reject_pastingElement = document.querySelector('.jenis_reject_pasting');
    jenis_reject_pastingElement.innerHTML = `
      <select name="jenis_reject_pasting[]" id="jenis_reject_pasting" class="form-select">
        <option value="">Pilih jenis_reject_pasting</option>
        <?php foreach ($data_jenis_reject_pasting as $d_jenis_reject_pasting) { ?>
          <option value="<?= $d_jenis_reject_pasting['jenis_reject_pasting'] ?>"><?= $d_jenis_reject_pasting['jenis_reject_pasting'] ?></option>
        <?php } ?>
      </select>
      <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_jenis_reject_pasting()">Tambah Data</button>
    `;
  }
</script>
<?= $this->endSection(); ?>