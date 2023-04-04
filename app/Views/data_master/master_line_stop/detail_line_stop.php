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
              <h4>Detail Line Stop</h4>
            </div>
            <div class="box-body">
              <form action="/line_stop/detail_line_stop/edit" method="post">
                <h1>Line Stop</h1>
                <div class="table-responsive">
                  <table id="" class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th>Jenis Line Stop</th>
                        <th>Proses Line Stop</th>
                        <th>Dept In Charge</th>
                        <th>Perhitungan</th>
                      </tr>
                    </thead>
                    <tbody class="form_line_stop">
                        <tr>
                          <input type="hidden" name="id_breakdown[]" value="<?= $data_detail_breakdown[0]['id_breakdown']; ?>">
                          <td>
                            <div class="jenis_breakdown">
                              <select name="jenis_breakdown[]" id="jenis_breakdown" class="form-select">
                                <option value="">Pilih Jenis Line Stop</option>
                                <?php foreach ($data_jenis_breakdown as $d_jenis_breakdown) { ?>
                                  <option value="<?= $d_jenis_breakdown['jenis_breakdown'] ?>" <?php if(trim($data_detail_breakdown[0]['jenis_breakdown']) === $d_jenis_breakdown['jenis_breakdown']) echo "selected" ?>><?= $d_jenis_breakdown['jenis_breakdown'] ?></option>
                                <?php } ?>
                              </select>
                              <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_jenis_breakdown()">Tambah Data</button>
                            </div>
                          </td>
                          <td>
                            <div>
                              <input type="text" class="form-control align-top" name="proses_breakdown[]" id="proses_breakdown" value="<?= trim($data_detail_breakdown[0]['proses_breakdown']) ?>">
                              <div class="p-1 mt-2">&nbsp</div>
                            </div>
                          </td>
                          <td>
                            <div class="dept_in_charge">
                              <select name="dept_in_charge[]" id="dept_in_charge" class="form-select">
                                <option value="">Pilih Dept In Charge</option>
                                <?php foreach ($data_dept_in_charge as $d_dept_in_charge) { ?>
                                  <option value="<?= $d_dept_in_charge['dept_in_charge'] ?>" <?php if(trim($data_detail_breakdown[0]['dept_in_charge']) === $d_dept_in_charge['dept_in_charge']) echo "selected" ?>><?= $d_dept_in_charge['dept_in_charge'] ?></option>
                                <?php } ?>
                              </select>
                              <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_dept_in_charge()">Tambah Data</button>
                            </div>
                          </td>
                          <td>
                            <div class="perhitungan">
                              <select name="perhitungan[]" id="perhitungan" class="form-select">
                                <option value="">Pilih Jenis Line Stop</option>
                                <?php foreach ($data_perhitungan as $d_perhitungan) { ?>
                                  <option value="<?= $d_perhitungan['perhitungan'] ?>" <?php if(trim($data_detail_breakdown[0]['perhitungan']) === $d_perhitungan['perhitungan']) echo "selected" ?>><?= $d_perhitungan['perhitungan'] ?></option>
                                <?php } ?>
                              </select>
                              <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_perhitungan()">Tambah Data</button>
                            </div>
                          </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <div class=" text-center my-2 button">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="d-flex justify-content-end">
                  <table class="table table-bordered" style="width: 200px;">
                    <thead>
                      <th class="text-center">Disetujui</th>
                    </thead>
                    <tbody>
                      <td>
                        <div class="form-check text-center p-0">
                          <?php if ($data_detail_breakdown[0]['status'] !== 'approved') { ?>
                            <button type="submit" class="btn btn-outline-primary" name="approved" value="approved" onclick="return confirm('Apakah Anda Yakin?')">✔</button>
                          <?php } else { ?>
                            <button class="btn btn-primary" disabled>✔</button>
                          <?php } ?>
                        </div>
                      </td>
                    </tbody>
                    <tfoot>
                      <th class="text-center">KASIE</th>
                    </tfoot>
                  </table>
                </div>
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
  
  function add_jenis_breakdown() {
    let jenis_breakdownElement = document.querySelector('.jenis_breakdown');
    jenis_breakdownElement.innerHTML = `
      <input type="text" class="form-control" id="jenis_breakdown" name="jenis_breakdown">
      <button type="button" class="btn btn-danger p-1 mt-1" onclick="batal_jenis_breakdown()">Batal</button>
    `
  }

  function add_dept_in_charge() {
    let dept_in_chargeElement = document.querySelector('.dept_in_charge');
    dept_in_chargeElement.innerHTML = `
      <input type="text" class="form-control" id="dept_in_charge" name="dept_in_charge">
      <button type="button" class="btn btn-danger p-1 mt-1" onclick="batal_dept_in_charge()">Batal</button>
    `
  }

  function add_perhitungan() {
    let perhitunganElement = document.querySelector('.perhitungan');
    perhitunganElement.innerHTML = `
      <input type="text" class="form-control" id="perhitungan" name="perhitungan">
      <button type="button" class="btn btn-danger p-1 mt-1" onclick="batal_perhitungan()">Batal</button>
    `
  }
  
  function batal_jenis_breakdown() {
    let jenis_breakdownElement = document.querySelector('.jenis_breakdown');
    jenis_breakdownElement.innerHTML = `
      <select name="jenis_breakdown[]" id="jenis_breakdown" class="form-select">
        <option value="">Pilih jenis_breakdown</option>
        <?php foreach ($data_jenis_breakdown as $d_jenis_breakdown) { ?>
          <option value="<?= $d_jenis_breakdown['jenis_breakdown'] ?>"><?= $d_jenis_breakdown['jenis_breakdown'] ?></option>
        <?php } ?>
      </select>
      <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_jenis_breakdown()">Tambah Data</button>
    `;
  }

  function batal_dept_in_charge() {
    let dept_in_chargeElement = document.querySelector('.dept_in_charge');
    dept_in_chargeElement.innerHTML = `
      <select name="dept_in_charge[]" id="dept_in_charge" class="form-select">
        <option value="">Pilih dept_in_charge</option>
        <?php foreach ($data_dept_in_charge as $d_dept_in_charge) { ?>
          <option value="<?= $d_dept_in_charge['dept_in_charge'] ?>"><?= $d_dept_in_charge['dept_in_charge'] ?></option>
        <?php } ?>
      </select>
      <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_dept_in_charge()">Tambah Data</button>
    `;
  }
  
  function batal_perhitungan() {
    let perhitunganElement = document.querySelector('.perhitungan');
    perhitunganElement.innerHTML = `
      <select name="perhitungan[]" id="perhitungan" class="form-select">
        <option value="">Pilih Perhitungan</option>
        <?php foreach ($data_perhitungan as $d_perhitungan) { ?>
          <option value="<?= $d_perhitungan['perhitungan'] ?>"><?= $d_perhitungan['perhitungan'] ?></option>
        <?php } ?>
      </select>
      <button type="button" class="btn btn-primary p-1 mt-1" onclick="add_perhitungan()">Tambah Data</button>
    `;
  }
</script>
<?= $this->endSection(); ?>