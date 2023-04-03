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
              <h4>Detail Envelope</h4>
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
                      <?php foreach ($data_detail_breakdown as $ddb) { ?>
                        <tr>
                          <input type="hidden" name="id_breakdown[]" value="<?= $ddb['id_breakdown']; ?>">
                          <td>
                            <input type="text" class="form-control" name="jenis_breakdown[]" id="jenis_breakdown" value="<?= trim($ddb['jenis_breakdown']) ?>">
                          </td>
                          <td>
                            <input type="text" class="form-control" name="proses_breakdown[]" id="proses_breakdown" value="<?= trim($ddb['proses_breakdown']) ?>">
                          </td>
                          <td>
                            <input type="text" class="form-control" name="dept_in_charge[]" id="dept_in_charge" value="<?= trim($ddb['dept_in_charge']) ?>">
                          </td>
                          <td>
                            <input type="text" class="form-control" name="perhitungan[]" id="perhitungan" value="<?= trim($ddb['perhitungan']) ?>">
                          </td>
                        </tr>
                      <?php } ?>
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
                          <?php if ($ddb['status'] !== 'approved') { ?>
                            <button type="submit" class="btn btn-outline-primary" name="approved" value="approved">✔</button>
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
</script>
<?= $this->endSection(); ?>