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
                                    <h4 class="box-title">Laporan Rejection Plate Cutting</h4>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_platecutting">
                                        Tambah Plate Cutting
                                    </button>
                                </div>
                                <div class="box-body">
                                    <a href="/platecutting/download" class="btn btn-danger mb-2">Download</a>
                                    <div class="table-responsive">
                                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th colspan="7"></th>
                                                </tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Line</th>
                                                    <th>Shift</th>
                                                    <th>Team</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_platecutting">
                                                <?php
                                                $isExist = [];
                                                $number = 0;
                                                ?>
                                                <?php foreach ($platecutting as $pc) : ?>
                                                    <?php
                                                    $number++;
                                                    if (!array_key_exists($pc['id'], $isExist)) :
                                                        $isExist[$pc['id']] = $pc['id'];
                                                    ?>
                                                        <tr>
                                                            <th><?= $number ?></th>
                                                            <td><?= $pc['date'] ?></td>
                                                            <td><?= $pc['line'] ?></td>
                                                            <td><?= $pc['shift'] ?></td>
                                                            <td><?= $pc['team'] ?></td>
                                                            <td>
                                                                <div>
                                                                    <?php
                                                                    if (trim($pc['status']) === 'approved') :
                                                                    ?>
                                                                        <span class="badge bg-success">Approved</span>
                                                                    <?php elseif (trim($pc['status']) === 'pending') : ?>
                                                                        <span class="badge bg-warning">Pending</span>
                                                                    <?php elseif (trim($pc['status']) === 'rejected') : ?>
                                                                        <span class="badge bg-danger">Rejected</span>
                                                                    <?php endif ?>
                                                                </div>
                                                            </td>
                                                            <?php if ($session['level'] === 1) : ?>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <a href="/platecutting/detail_platecutting/<?= trim($pc['id']) ?>" class="btn btn-primary btn-sm">Detail</a>
                                                                        &nbsp
                                                                        <form action="<?php base_url() ?>platecutting/detail_platecutting/delete" method="POST">
                                                                            <input type="hidden" name="id_platecutting" id="id_platecutting" value="<?= trim($pc['id']) ?>">
                                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin?')">Hapus</button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            <?php else : ?>
                                                                <td>
                                                                    <div>
                                                                        <a href="/platecutting/add_platecutting/<?= trim($pc['id']) ?>" class="btn btn-primary">Detail</a>
                                                                    </div>
                                                                </td>
                                                            <?php endif ?>
                                                        </tr>
                                                    <?php endif ?>
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

<div class="modal fade modal_tambah_platecutting" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah LHP Produksi 2</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/platecutting/save" method="post">
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
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('#example5').DataTable();
    });
</script>
<?= $this->endSection(); ?>