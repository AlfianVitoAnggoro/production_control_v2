<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-12 col-12">
          <div class="box">
            <div class="box-header with-border">
              <h4>Detail Reject Pasting</h4>
            </div>
            <div class="box-body">
              <form action="/reject_pasting/detail_reject_pasting/edit" method="post">
                <h1>Reject Pasting</h1>
                <div class="table-responsive">
                  <table id="" class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th>Jenis Reject Pasting</th>
                        <th>Kategori Reject Pasting</th>
                      </tr>
                    </thead>
                    <tbody class="form_reject_pasting">
                        <tr>
                          <input type="hidden" name="id_reject_pasting[]" value="<?= $data_detail_reject_pasting[0]['id_reject_pasting']; ?>">
                          <td>
                            <div class="jenis_reject_pasting">
                              <select name="jenis_reject_pasting[]" id="jenis_reject_pasting" class="form-select">
                                <option value="">Pilih Jenis Reject Pasting</option>
                                <?php foreach ($data_jenis_reject_pasting as $d_jenis_reject_pasting) { ?>
                                  <option value="<?= $d_jenis_reject_pasting['jenis_reject_pasting'] ?>" <?php if(trim($data_detail_reject_pasting[0]['jenis_reject_pasting']) === $d_jenis_reject_pasting['jenis_reject_pasting']) echo "selected" ?>><?= $d_jenis_reject_pasting['jenis_reject_pasting'] ?></option>
                                <?php } ?>
                              </select>
                              <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_jenis_reject_pasting()">Tambah Data</button>
                            </div>
                          </td>
                          <td>
                            <div>
                              <input type="text" class="form-control align-top" name="kategori_reject_pasting[]" id="kategori_reject_pasting" value="<?= trim($data_detail_reject_pasting[0]['kategori_reject_pasting']) ?>">
                              <div class="p-1 mt-2">&nbsp</div>
                            </div>
                          </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <div class=" text-center my-2 button">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <!-- <div class="d-flex justify-content-end">
                  <table class="table table-bordered" style="width: 200px;">
                    <thead>
                      <th class="text-center">Disetujui</th>
                    </thead>
                    <tbody>
                      <td>
                        <div class="form-check text-center p-0">
                          <?php ""//if ($data_detail_reject_pasting[0]['status'] !== 'approved') { ?>
                            <button type="submit" class="btn btn-outline-primary" name="approved" value="approved" onclick="return confirm('Apakah Anda Yakin?')">✔</button>
                          <?php ""//} else { ?>
                            <button class="btn btn-primary" disabled>✔</button>
                          <?php ""//} ?>
                        </div>
                      </td>
                    </tbody>
                    <tfoot>
                      <th class="text-center">KASIE</th>
                    </tfoot>
                  </table>
                </div> -->
              </form>
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
  <?php if ($session <= 3) { ?>
    const approvedElement = document.querySelector('#approved');
    approvedElement.removeAttribute('disabled');
  <?php } ?>
  
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