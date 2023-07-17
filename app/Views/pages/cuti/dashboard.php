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
                  <h4 class="box-title">Laporan Cuti Prouksi 2</h4>
                </div>
                <div class="box-body">
                  <!-- <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target=".modal_print_cuti">
                    Print
                  </button> -->
                  <div class="table-responsive">
                    <table id="example5" class="table table-bordered table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>Sub Bagian</th>
                          <th>Tanggal</th>
                          <th>Line</th>
                          <th>Shift</th>
                          <th>Nama</th>
                          <th>Keterangan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="table_cuti">
                        <?php foreach ($data_mp_cuti as $dmc) { ?>
                          <tr>
                            <td><?= strtoupper($dmc['sub_bagian']) ?></td>
                            <td><?= $dmc['tanggal'] ?></td>
                            <td><?= $dmc['line'] ?></td>
                            <td><?= $dmc['shift'] ?></td>
                            <td><?= $dmc['nama_mp'] ?></td>
                            <td><?= $dmc['keterangan'] ?></td>
                            <td><a href="<?= base_url() ?>cuti/detail_cuti/<?= $dmc['id_cuti'] ?>" class="btn btn-sm btn-primary">Detail</a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Date</th>
                          <th>Shift</th>
                          <th>Line</th>
                          <th>Team</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                      </tfoot>
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

<div class="modal fade modal_print_cuti" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Download PLate Cutting</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- <a href="/cos/download" class="btn btn-danger mb-2">Download</a> -->
      <form action="<?= base_url() ?>cuti/download" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col mb-2">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>
          </div>
        </div>
        <div class="modal-footer" style="float: right;">
          <input type="submit" class="btn btn-primary float-end" value="Print">
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
    $('#example5').DataTable({
      "order": [],
      initComplete: function() {
        this.api()
          .columns()
          .every(function() {
            var column = this;
            var select = $('<select class="form-select"><option value=""></option></select>')
              .appendTo($(column.footer()).empty())
              .on('change', function() {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
              });
          });
      },
    });
  });
</script>
<?= $this->endSection(); ?>