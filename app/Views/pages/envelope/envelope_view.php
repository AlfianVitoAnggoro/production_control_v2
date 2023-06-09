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
                                    <h4 class="box-title">Laporan Envelope</h4>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_envelope">
                                        Tambah Envelope
                                    </button>
                                </div>
                                <div class="box-body">
                                    <!-- <a href="/envelope/download" class="btn btn-danger mb-2">Download</a> -->
                                    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target=".modal_download_envelope">
                                        Download
                                    </button>
                                    <div class="table-responsive">
                                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <!-- <th>No</th> -->
                                                    <th style="width: 150px;">Date</th>
                                                    <th>Shift</th>
                                                    <th>Line</th>
                                                    <th>Team</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_envelope">
                                                <?php
                                                $isExist = [];
                                                $number = 0;
                                                ?>
                                                <?php foreach ($envelope as $envl) : ?>
                                                    <?php
                                                    if (!array_key_exists($envl['id'], $isExist)) :
                                                        $isExist[$envl['id']] = $envl['id'];
                                                        $number++;
                                                    ?>
                                                        <tr>
                                                            <!-- <th><?= $number ?></th> -->
                                                            <td style="width: 150px;"><?= date('Y-m-d', strtotime($envl['date'])) ?></td>
                                                            <td><?= $envl['shift'] ?></td>
                                                            <td><?= $envl['line'] ?></td>
                                                            <td><?= $envl['team'] ?></td>
                                                            <td>
                                                                <div>
                                                                    <?php
                                                                    if (trim($envl['status']) === 'approved') :
                                                                    ?>
                                                                        <span class="badge bg-success">Approved</span>
                                                                    <?php elseif (trim($envl['status']) === 'pending') : ?>
                                                                        <span class="badge bg-warning">Pending</span>
                                                                    <?php elseif (trim($envl['status']) === 'rejected') : ?>
                                                                        <span class="badge bg-danger">Rejected</span>
                                                                    <?php endif ?>

                                                                </div>
                                                            </td>
                                                            <?php if ($session['level'] === 1) : ?>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <a href="<?=base_url()?>envelope/detail_envelope/<?= trim($envl['id']) ?>" class="btn btn-primary btn-sm">Detail</a>
                                                                        &nbsp
                                                                        <form action="<?php base_url() ?>envelope/detail_envelope/delete" method="POST">
                                                                            <input type="hidden" name="id_envelope" id="id_envelope" value="<?= trim($envl['id']) ?>">
                                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin?')">Hapus</button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            <?php else : ?>
                                                                <td>
                                                                    <div>
                                                                        <a href="<?=base_url()?>envelope/add_envelope/<?= trim($envl['id']) ?>" class="btn btn-primary">Detail</a>
                                                                    </div>
                                                                </td>
                                                            <?php endif ?>
                                                        </tr>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
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

<div class="modal fade modal_tambah_envelope" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah LHP Produksi 2</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url()?>envelope/save" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="line" class="form-label">Line</label>
                                <select class="form-control" id="line" name="line" required>
                                    <option selected value="" disabled>-- Pilih Line --</option>
                                    <?php
                                    for ($j = 1; $j <= 7; $j++) { ?>
                                        <option value="<?= $j ?>"><?= $j ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-control" id="shift" name="shift" required>
                                    <option selected value="" disabled>-- Pilih Shift --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="team" class="form-label">Team</label>
                                <div>
                                    <select class="form-control" id="team" name="team" required>
                                        <option selected value="" disabled>-- Pilih Team --</option>
                                        <?php
                                        foreach ($team as $t) {
                                        ?>
                                            <option value="<?= trim($t['team']) ?>"><?= trim($t['team']) ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
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

<div class="modal fade modal_download_envelope" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Download Envelope</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <a href="/envelope/download" class="btn btn-danger mb-2">Download</a> -->
            <form action="<?=base_url()?>envelope/download" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-2">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="col mb-2">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                        <!-- <div class="col mb-2">
                            <label for="month" class="form-label">Bulan</label>
                            <input type="month" class="form-control" id="month" name="month" required>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer" style="float: right;">
                    <input type="submit" class="btn btn-primary float-end" value="Download">
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
        // $('#example5').DataTable({
		// 	"responsive": true,
		// 	"autoWidth": false,
		// 	"order": []
		// });
        $('#example5').DataTable({
			"order": [],
			initComplete: function () {
				this.api()
					.columns()
					.every(function () {
						var column = this;
						var select = $('<select class="form-select"><option value=""></option></select>')
							.appendTo($(column.footer()).empty())
							.on('change', function () {
								var val = $.fn.dataTable.util.escapeRegex($(this).val());
	
								column.search(val ? '^' + val + '$' : '', true, false).draw();
							});
	
						column
							.data()
							.unique()
							.sort()
							.each(function (d, j) {
								select.append('<option value="' + d + '">' + d + '</option>');
							});
					});
			},
		});
		$('.modal .select2').select2({
   		 dropdownParent: $('.modal')
		});
    });
</script>
<?= $this->endSection(); ?>