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
                                    <h4 class="box-title">Laporan Timbangan Reject</h4>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_timbangan_reject">
                                        Tambah Laporan Timbangan Reject
                                    </button>
                                </div>
                                <div class="box-body">
                                    <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target=".modal_download_timbangan_reject">
                                        Download
                                    </button>
                                    <div class="table-responsive">
                                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_timbangan_reject">
                                                <?php
                                                    $number = 0;
                                                    foreach ($data_timbangan_reject as $dtr) :
                                                ?>
                                                <tr>
                                                    <th><?= $number = $number+1 ?></th>
                                                    <td><?= $dtr['tanggal'] ?></td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="<?=base_url()?>timbangan_reject/detail_timbangan_reject/<?= $dtr['id_lhp_timbangan_reject'] ?>" class="btn btn-primary btn-sm">Detail</a>
                                                            &nbsp
                                                            <form action="<?php base_url() ?>timbangan_reject/detail_timbangan_reject/delete" method="POST">
                                                                <input type="hidden" name="id" id="id" value="<?= $dtr['id_lhp_timbangan_reject'] ?>">
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin?')">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </td>
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

<div class="modal fade modal_tambah_timbangan_reject" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Laporan Timbangan Reject</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url()?>timbangan_reject/save" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" required>
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

<div class="modal fade modal_download_timbangan_reject" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Download Laporan Timbagan Reject</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- <a href="/timbangan_reject/download" class="btn btn-danger mb-2">Download</a> -->
            <form action="<?=base_url()?>timbangan_reject/download" method="post">
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