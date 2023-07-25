<?= $this->extend('template/layout'); ?>
<?= $this->section('style'); ?>
<style>
  button:disabled {
    color: initial;
    background-color: initial;
    border-color: initial;
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<?php $line = [0, 1, 2, 3, 4, 5, 6, 7, 'WET-A', 'WET-F', 'MCB']; ?>
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
                          <!-- <th>Shift</th> -->
                          <th>Nama</th>
                          <th>Keterangan</th>
                          <th>Kasubsie</th>
                          <th>Kasie</th>
                          <th>Kadept</th>
                          <th>Kadiv</th>
                          <th>HRD</th>
                          <th>Detail</th>
                        </tr>
                      </thead>
                      <tbody id="table_cuti">
                        <?php $index = 0;
                        foreach ($data_mp_cuti as $dmc) { ?>
                          <tr>
                            <td><?= strtoupper($dmc['sub_bagian']) ?></td>
                            <td><?= $dmc['tanggal'] ?></td>
                            <td><?= ($dmc['line'] == 'indirect' || $dmc['line'] == '') ? 'Indirect' : $line[$dmc['line']] ?></td>
                            <td><?= $dmc['nama_mp'] ?></td>
                            <td><?= $dmc['kategori'] ?></td>
                            <td style="width: 100px; background-color: <?= $dmc['status_kasubsie'] === 'approved' ? 'limegreen' : ($dmc['status_kasubsie'] === 'rejected' ? 'red' : '') ?>">
                              <div class="d-flex justify-content-center align-items-center">
                                <form action="<?= base_url() ?>cuti/approve_<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>" method="post">
                                  <input type="hidden" name="id_cuti" value="<?= $dmc['id_cuti'] ?>">
                                  <input type="hidden" name="level" value="kasubsie">
                                  <input type="hidden" name="status_old" id="status_kasubsie_<?= $index ?>" value="<?= $dmc['status_kasubsie'] ?>">
                                  <button type="submit" class="btn btn-sm" id="approved_kasubsie_<?= $index ?>" style="background-color: blue; color: white" disabled><i class="fa fa-check"></i></button>
                                </form>
                                <button type="button" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target=".modal_reject" onclick="sendLevel('kasubsie', <?= $dmc['id_cuti'] ?>, '<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>')" id="rejected_kasubsie_<?= $index ?>" style="background-color: orange; color: white" disabled><i class="fa fa-times"></i></button>
                              </div>
                            </td>
                            <td style="width: 100px; background-color: <?= $dmc['status_kasie'] === 'approved' ? 'limegreen' : ($dmc['status_kasie'] === 'rejected' ? 'red' : '') ?>">
                              <div class="d-flex justify-content-center align-items-center">
                                <form action="<?= base_url() ?>cuti/approve_<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>" method="post">
                                  <input type="hidden" name="id_cuti" value="<?= $dmc['id_cuti'] ?>">
                                  <input type="hidden" name="level" value="kasie">
                                  <input type="hidden" name="status_old" id="status_kasie_<?= $index ?>" value="<?= $dmc['status_kasie'] ?>">
                                  <button type="submit" class="btn btn-sm" id="approved_kasie_<?= $index ?>" style="background-color: blue; color: white" disabled><i class="fa fa-check"></i></button>
                                </form>
                                <button type="button" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target=".modal_reject" onclick="sendLevel('kasie', <?= $dmc['id_cuti'] ?>, '<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>')" id="rejected_kasie_<?= $index ?>" style="background-color: orange; color: white" disabled><i class="fa fa-times"></i></button>
                              </div>
                            </td>
                            <td style="width: 100px; background-color: <?= $dmc['status_kadept'] === 'approved' ? 'limegreen' : ($dmc['status_kadept'] === 'rejected' ? 'red' : '') ?>">
                              <div class="d-flex justify-content-center align-items-center">
                                <form action="<?= base_url() ?>cuti/approve_<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>" method="post">
                                  <input type="hidden" name="id_cuti" value="<?= $dmc['id_cuti'] ?>">
                                  <input type="hidden" name="level" value="kadept">
                                  <input type="hidden" name="status_old" id="status_kadept_<?= $index ?>" value="<?= $dmc['status_kadept'] ?>">
                                  <button type="submit" class="btn btn-sm <?= $dmc['status_kadept'] === 'approved' ? '' : 'btn-primary' ?>" id="approved_kadept_<?= $index ?>" style="background-color: blue; color: white" disabled><i class="fa fa-check"></i></button>
                                </form>
                                <button type="button" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target=".modal_reject" onclick="sendLevel('kadept', <?= $dmc['id_cuti'] ?>, '<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>')" id="rejected_kadept_<?= $index ?>" style="background-color: orange; color: white" disabled><i class="fa fa-times"></i></button>
                              </div>
                            </td>
                            <td style="width: 100px; background-color: <?= $dmc['status_kadiv'] === 'approved' ? 'limegreen' : ($dmc['status_kadiv'] === 'rejected' ? 'red' : '') ?>">
                              <div class="d-flex justify-content-center align-items-center">
                                <form action="<?= base_url() ?>cuti/approve_<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>" method="post">
                                  <input type="hidden" name="id_cuti" value="<?= $dmc['id_cuti'] ?>">
                                  <input type="hidden" name="level" value="kadiv">
                                  <input type="hidden" name="status_old" id="status_kadiv_<?= $index ?>" value="<?= $dmc['status_kadiv'] ?>">
                                  <button type="submit" class="btn btn-sm" id="approved_kadiv_<?= $index ?>" style="background-color: blue; color: white" disabled><i class="fa fa-check"></i></button>
                                </form>
                                <button type="button" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target=".modal_reject" onclick="sendLevel('kadiv', <?= $dmc['id_cuti'] ?>, '<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>')" id="rejected_kadiv_<?= $index ?>" style="background-color: orange; color: white" disabled><i class="fa fa-times"></i></button>
                              </div>
                            </td>
                            <td style="width: 100px; background-color: <?= $dmc['status_hrd'] === 'approved' ? 'limegreen' : ($dmc['status_hrd'] === 'rejected' ? 'red' : '') ?>">
                              <div class="d-flex justify-content-center align-items-center">
                                <form action="<?= base_url() ?>cuti/approve_<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>" method="post">
                                  <input type="hidden" name="id_cuti" value="<?= $dmc['id_cuti'] ?>">
                                  <input type="hidden" name="level" value="hrd">
                                  <input type="hidden" name="status_old" id="status_hrd_<?= $index ?>" value="<?= $dmc['status_hrd'] ?>">
                                  <button type="submit" class="btn btn-sm" id="approved_hrd_<?= $index ?>" style="background-color: blue; color: white" disabled><i class="fa fa-check"></i></button>
                                </form>
                                <button type="button" class="btn btn-sm me-1" data-bs-toggle="modal" data-bs-target=".modal_reject" onclick="sendLevel('hrd', <?= $dmc['id_cuti'] ?>, '<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>')" id="rejected_hrd_<?= $index ?>" style="background-color: orange; color: white" disabled><i class="fa fa-times"></i></button>
                              </div>
                            </td>
                            <td><a href="<?= base_url() ?>cuti/detail_<?= strtolower(str_replace(' ', '_', $dmc['kategori'])) ?>/<?= $dmc['id_cuti'] ?>" class="btn btn-sm btn-primary">Detail</a></td>
                          </tr>
                        <?php $index++;
                        } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Sub Bagian</th>
                          <th>Tanggal</th>
                          <th>Line</th>
                          <!-- <th>Shift</th> -->
                          <th>Nama</th>
                          <th>Keterangan</th>
                          <th>Kasubsie</th>
                          <th>Kasie</th>
                          <th>Kadept</th>
                          <th>Kadiv</th>
                          <th>HRD</th>
                          <th>Detail</th>
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

<div class="modal fade modal_reject" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" id="form_reject">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">Note Reject</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group col">
              <label for="note_reject">Note Reject</label>
              <input type="text" class="form-control" id="note_reject" name="note_reject">
              <input type="hidden" name="id_cuti_modal" id="id_cuti_modal">
              <input type="hidden" name="level_modal" id="level_modal">
            </div>
          </div>
        </div>
        <div class="modal-footer" style="float: right;">
          <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" value="Close">
          <button type="submit" class="btn btn-primary float-end">Kirim</button>
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
<script>
  for (let index = 0; index < <?= count($data_mp_cuti) ?>; index++) {
    const approved_kadiv = document.querySelector('#approved_kadiv_' + index);
    const approved_kadept = document.querySelector('#approved_kadept_' + index);
    const approved_kasie = document.querySelector('#approved_kasie_' + index);
    const approved_kasubsie = document.querySelector('#approved_kasubsie_' + index);
    const approved_hrd = document.querySelector('#approved_hrd_' + index);
    const rejected_kadiv = document.querySelector('#rejected_kadiv_' + index);
    const rejected_kadept = document.querySelector('#rejected_kadept_' + index);
    const rejected_kasie = document.querySelector('#rejected_kasie_' + index);
    const rejected_kasubsie = document.querySelector('#rejected_kasubsie_' + index);
    const rejected_hrd = document.querySelector('#rejected_hrd_' + index);
    const status_kadiv = document.querySelector('#status_kadiv_' + index);
    const status_kadept = document.querySelector('#status_kadept_' + index);
    const status_kasie = document.querySelector('#status_kasie_' + index);
    const status_kasubsie = document.querySelector('#status_kasubsie_' + index);
    const status_hrd = document.querySelector('#status_hrd_' + index);
    <?php if (strtolower($departement_account) === 'hrd') { ?>
      if (status_hrd.value === 'approved') {
        rejected_hrd.removeAttribute('disabled');
      } else if (status_hrd.value === 'pending') {
        approved_hrd.removeAttribute('disabled');
        rejected_hrd.removeAttribute('disabled');
      }
      if (status_hrd.value === 'approved') {
        approved_hrd.setAttribute('disabled', '');
      }
    <?php } ?>
    <?php if ((strtolower($departement_account) === 'produksi2' || strtolower($departement_account) == '') && $level_account < 3) { ?>
      if (status_kadiv.value === 'approved') {
        rejected_kadiv.removeAttribute('disabled');
      } else if (status_kadiv.value === 'pending') {
        approved_kadiv.removeAttribute('disabled');
        rejected_kadiv.removeAttribute('disabled');
      }
      if (status_kadiv.value === 'rejected' || status_kadept.value === 'rejected' || status_kasie.value === 'rejected' || status_kasubsie.value === 'rejected') {
        approved_kadiv.removeAttribute('disabled');
        rejected_kadiv.setAttribute('disabled', '');
      }
      if (status_kadiv.value === 'approved') {
        approved_kadiv.setAttribute('disabled', '');
      }
    <?php } ?>
    <?php if ((strtolower($departement_account) === 'produksi2' || strtolower($departement_account) == '') && $level_account < 4) { ?>
      if (status_kadept.value === 'approved') {
        rejected_kadept.removeAttribute('disabled');
      } else if (status_kadept.value === 'pending') {
        rejected_kadept.removeAttribute('disabled');
        approved_kadept.removeAttribute('disabled');
      }
      if (status_kadiv.value === 'rejected' || status_kadept.value === 'rejected' || status_kasie.value === 'rejected' || status_kasubsie.value === 'rejected') {
        approved_kadept.removeAttribute('disabled');
        rejected_kadept.setAttribute('disabled', '');
      }
      if (status_kadept.value === 'approved') {
        approved_kadept.setAttribute('disabled', '');
      }
    <?php } ?>
    <?php if ((strtolower($departement_account) === 'produksi2' || strtolower($departement_account) == '') && $level_account < 5) { ?>
      if (status_kasie.value === 'approved') {
        rejected_kasie.removeAttribute('disabled');
      } else if (status_kasie.value === 'pending') {
        approved_kasie.removeAttribute('disabled');
        rejected_kasie.removeAttribute('disabled');
      }
      if (status_kadiv.value === 'rejected' || status_kadept.value === 'rejected' || status_kasie.value === 'rejected' || status_kasubsie.value === 'rejected') {
        approved_kasie.removeAttribute('disabled');
        rejected_kasie.setAttribute('disabled', '');
      }
      if (status_kasie.value === 'approved') {
        approved_kasie.setAttribute('disabled', '');
      }
    <?php } ?>
    <?php if ((strtolower($departement_account) === 'produksi2' || strtolower($departement_account) == '') && $level_account < 6) { ?>
      if (status_kasubsie.value === 'approved') {
        rejected_kasubsie.removeAttribute('disabled');
      } else if (status_kasubsie.value === 'pending') {
        approved_kasubsie.removeAttribute('disabled');
        rejected_kasubsie.removeAttribute('disabled');
      }
      if (status_kadiv.value === 'rejected' || status_kadept.value === 'rejected' || status_kasie.value === 'rejected' || status_kasubsie.value === 'rejected') {
        approved_kasubsie.removeAttribute('disabled');
        rejected_kasubsie.setAttribute('disabled', '');
      }
      if (status_kasubsie.value === 'approved') {
        approved_kasubsie.setAttribute('disabled', '');
      }
    <?php } ?>
  }

  function sendLevel(level, id_cuti, kategori) {
    document.querySelector('#level_modal').value = level;
    document.querySelector('#id_cuti_modal').value = id_cuti;
    document.querySelector('#form_reject').setAttribute('action', '<?= base_url() ?>cuti/reject_' + kategori);
  }
</script>
<?= $this->endSection(); ?>