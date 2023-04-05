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
                  <h4 class="box-title">Data Master Grup Grid</h4>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_grup_grid">
                    Tambah Data
                  </button>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="data_grup_grid" class="table table-bordered table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>Nama Grup</th>
                          <th>Anggota</th>
                          <th>Leader</th>
                          <th>Kasubsie</th>
                          <th>Supplyman 1</th>
                          <th>Supplyman 2</th>
                          <!-- <th>Status</th> -->
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data_grup_grid as $d) : ?>
                          <tr>
                            <td><?= $d['nama_grup'] ?></td>
                            <td><?= $d['anggota'] ?></td>
                            <td><?= $d['leader'] ?></td>
                            <td><?= $d['kasubsie'] ?></td>
                            <td><?= $d['supplyman_1'] ?></td>
                            <td><?= $d['supplyman_2'] ?></td>
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
                                <a href="<?= base_url() ?>grup_grid/detail_grup_grid/<?= $d['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                &nbsp
                                <form action="<?= base_url() ?>grup_grid/detail_grup_grid/delete" method="POST">
                                  <input type="hidden" name="id" value="<?= $d['id'] ?>">
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
<div class="modal fade modal_tambah_grup_grid" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Tambah Grup Grid</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url() ?>grup_grid/add_grup_grid" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Nama Grup</label>
                <div class="nama_grup">
                  <select name="nama_grup[]" id="nama_grup" class="form-select">
                    <option value="">Pilih Nama Grup</option>
                    <?php foreach ($data_nama_grup as $d_nama_grup) { ?>
                      <option value="<?= $d_nama_grup['nama_grup'] ?>"><?= $d_nama_grup['nama_grup'] ?></option>
                    <?php } ?>
                  </select>
                  <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_nama_grup()">Tambah Data</button>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Anggota</label>
                <input type="text" class="form-control" id="anggota" name="anggota">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Leader</label>
                <div class="leader">
                  <select name="leader[]" id="leader" class="form-select">
                    <option value="">Pilih Leader</option>
                    <?php foreach ($data_leader as $d_leader) { ?>
                      <option value="<?= $d_leader['leader'] ?>"><?= $d_leader['leader'] ?></option>
                    <?php } ?>
                  </select>
                  <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_leader()">Tambah Data</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Kasubsie</label>
                <div class="kasubsie">
                  <select name="kasubsie[]" id="kasubsie" class="form-select">
                    <option value="">Pilih Kasubsie</option>
                    <?php foreach ($data_kasubsie as $d_kasubsie) { ?>
                      <option value="<?= $d_kasubsie['kasubsie'] ?>"><?= $d_kasubsie['kasubsie'] ?></option>
                    <?php } ?>
                  </select>
                  <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_kasubsie()">Tambah Data</button>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Supplyman 1</label>
                <div class="supplyman_1">
                  <select name="supplyman_1[]" id="supplyman_1" class="form-select">
                    <option value="">Pilih Supplyman 1</option>
                    <?php foreach ($data_supplyman_1 as $d_supplyman_1) { ?>
                      <option value="<?= $d_supplyman_1['supplyman_1'] ?>"><?= $d_supplyman_1['supplyman_1'] ?></option>
                    <?php } ?>
                  </select>
                  <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_supplyman_1()">Tambah Data</button>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Supplyman 2</label>
                <div class="supplyman_2">
                  <select name="supplyman_2[]" id="supplyman_2" class="form-select">
                    <option value="">Pilih Supplyman 2</option>
                    <?php foreach ($data_supplyman_2 as $d_supplyman_2) { ?>
                      <option value="<?= $d_supplyman_2['supplyman_2'] ?>"><?= $d_supplyman_2['supplyman_2'] ?></option>
                    <?php } ?>
                  </select>
                  <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_supplyman_2()">Tambah Data</button>
                </div>
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
    $('#data_grup_grid').DataTable({
      "order": []
    });
  });

  function add_nama_grup() {
    let nama_grupElement = document.querySelector('.nama_grup');
    nama_grupElement.innerHTML = `
      <input type="text" class="form-control" id="nama_grup" name="nama_grup">
      <button type="button" class="btn btn-danger p-1 mt-1" onclick="batal_nama_grup()">Batal</button>
    `
  }
  
  function batal_nama_grup() {
    let nama_grupElement = document.querySelector('.nama_grup');
    nama_grupElement.innerHTML = `
      <select name="nama_grup[]" id="nama_grup" class="form-select">
        <option value="">Pilih nama_grup</option>
        <?php foreach ($data_nama_grup as $d_nama_grup) { ?>
          <option value="<?= $d_nama_grup['nama_grup'] ?>"><?= $d_nama_grup['nama_grup'] ?></option>
        <?php } ?>
      </select>
      <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_nama_grup()">Tambah Data</button>
    `;
  }
</script>
<?= $this->endSection(); ?>