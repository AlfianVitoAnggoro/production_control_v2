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
                                    <h4 class="box-title">Laporan Saw Repair</h4>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_saw_repair">
                                        Tambah Saw Repair
                                    </button>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <!-- <th>No</th> -->
                                                    <th>Date</th>
                                                    <th>Shift</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_saw_repair">
                                                <?php
                                                $number = 0;
                                                ?>
                                                <?php foreach ($saw_repair as $sr) : ?>
                                                    <tr>
                                                        <!-- <th><?= $number ?></th> -->
                                                        <td><?= $sr['date'] ?></td>
                                                        <td><?= $sr['shift'] ?></td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="<?=base_url()?>saw_repair/add_saw_repair/<?= trim($sr['id']) ?>" class="btn btn-sm btn-primary">Detail</a>
                                                                &nbsp
                                                                <form action="<?php base_url() ?>saw_repair/detail_saw_repair/delete" method="POST">
                                                                    <input type="hidden" name="id_saw_repair" id="id_saw_repair" value="<?= trim($sr['id']) ?>">
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin?')">Hapus</button>
                                                                </form>
                                                            </div>   
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Shift</th>
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

<div class="modal fade modal_tambah_saw_repair" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah LHP Produksi 2</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url()?>saw_repair/save" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="col">
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
    });
</script>
<?= $this->endSection(); ?>