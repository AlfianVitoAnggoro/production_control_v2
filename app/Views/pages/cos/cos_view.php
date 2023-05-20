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
                                    <h4 class="box-title">Laporan COS</h4>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_cos">
                                        Tambah COS
                                    </button>
                                </div>
                                <div class="box-body">
                                    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target=".modal_download_cos">
                                        Download
                                    </button>
                                    <div class="table-responsive">
                                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Line</th>
                                                    <th>Shift</th>
                                                    <th>Team</th>
                                                    <!-- <th>Status</th> -->
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_cos">
                                                <?php
                                                    $number = 0;
                                                    foreach ($data_cos as $dc) :
                                                ?>
                                                <tr>
                                                    <th><?= $number = $number+1 ?></th>
                                                    <td><?= $dc['tanggal_produksi'] ?></td>
                                                    <td><?= $dc['line'] ?></td>
                                                    <td><?= $dc['shift'] ?></td>
                                                    <td><?= $dc['team'] ?></td>
                                                    <!-- <td>
                                                        <div>
                                                            <?php //if ($dc['status'] === 'approved') : ?>
                                                                <span class="badge bg-success">Approved</span>
                                                            <?php //elseif ($dc['status'] === 'pending') : ?>
                                                                <span class="badge bg-warning">Pending</span>
                                                            <?php //elseif ($dc['status'] === 'rejected') : ?>
                                                                <span class="badge bg-danger">Rejected</span>
                                                            <?php //endif ?>
                                                        </div>
                                                    </td> -->
                                                    <?php //if ($session['level'] ) : ?>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="/cos/detail_cos/<?= $dc['id_lhp_cos'] ?>" class="btn btn-primary btn-sm">Detail</a>
                                                                &nbsp
                                                                <form action="<?php base_url() ?>cos/detail_cos/delete" method="POST">
                                                                    <input type="hidden" name="id" id="id" value="<?= $dc['id_lhp_cos'] ?>">
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin?')">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    <?php //else : ?>
                                                        <!-- <td>
                                                            <div>
                                                                <a href="/cos/add_cos/<?= $dc['id_lhp_cos'] ?>" class="btn btn-primary">Detail</a>
                                                            </div>
                                                        </td> -->
                                                    <?php //endif ?>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
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

<div class="modal fade modal_tambah_cos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah COS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/cos/save" method="post">
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
                                <select class="form-select" id="line" name="line" required>
                                    <option selected value="" disabled>-- Pilih Line --</option>
                                    <?php
                                    for ($j = 1; $j <= 7; $j++) { ?>
                                        <option value="<?= $j ?>"><?= $j ?></option>
                                        <?php
                                    }
                                    ?>
                                    <option value="10">MCB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift" required>
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
                                    <select class="form-select" id="team" name="team" required>
                                        <option selected value="" disabled>-- Pilih Team --</option>
                                        <?php
                                        foreach ($data_team as $dt) {
                                        ?>
                                            <option value="<?= trim($dt['team']) ?>"><?= trim($dt['team']) ?></option>
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

<div class="modal fade modal_download_cos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Download COS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <a href="/cos/download" class="btn btn-danger mb-2">Download</a> -->
            <form action="/cos/download" method="post">
                <div class="modal-body">
                    <!-- <label for="date" class="form-label">Bulan</label>
                    <input type="month" class="form-control" id="date" name="date" value="<?= date('Y-m') ?>"> -->
                    <div class="row">
                        <div class="col mb-2">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="col mb-2">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
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
        $('#example5').DataTable();
    });
</script>
<?= $this->endSection(); ?>