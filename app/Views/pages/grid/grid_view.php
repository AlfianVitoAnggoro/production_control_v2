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
                                <div class=" d-flex justify-content-between">
                                    <h4 class="box-title">Laporan Harian Grid Casting PT CBI</h4>
                                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-default">
                                        Tambah LHP
                                    </button> -->
                                </div>
                                <!-- <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No Doc</th>
                                                    <th>Tanggal</th>
                                                    <th>Shift</th>
                                                    <th>Line</th>
                                                    <th>Part Number</th>
                                                    <th>Efficiency</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>System Architect</td>
                                                    <td>Edinburgh</td>
                                                    <td>61</td>
                                                    <td>2011/04/25</td>
                                                    <td>$320,800</td>
                                                </tr>
                                                <tr>
                                                    <td>Garrett Winters</td>
                                                    <td>Accountant</td>
                                                    <td>Tokyo</td>
                                                    <td>63</td>
                                                    <td>2011/07/25</td>
                                                    <td>$170,750</td>
                                                </tr>
                                                <tr>
                                                    <td>Ashton Cox</td>
                                                    <td>Junior Technical Author</td>
                                                    <td>San Francisco</td>
                                                    <td>66</td>
                                                    <td>2009/01/12</td>
                                                    <td>$86,000</td>
                                                </tr>
                                                <tr>
                                                    <td>Cedric Kelly</td>
                                                    <td>Senior Javascript Developer</td>
                                                    <td>Edinburgh</td>
                                                    <td>22</td>
                                                    <td>2012/03/29</td>
                                                    <td>$433,060</td>
                                                </tr>
                                        </table>
                                    </div>
                                </div> -->

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="box-header with-border">
                                            <!-- <div class="text-center">
                    <h2 align="center">FORM REPORTING PRODUCTION</h2>
                    <h3 class="box-title">Form Pelaporan Produksi PT. Century Batteries Indonesia</h3>
                </div> -->
                                        </div>
                                        <div class="col-md-12">
                                            <div id="notif"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="box box-solid">
                                                <form action="/form/post" method="post" id="SimpanData">
                                                    <?= csrf_field(); ?>
                                                    <div class="box-body">
                                                        <!-- <blockquote>
                                <p><b>Keterangan!!</b></p>
                                <small><cite title="Source Title">Inputan Yang Ditanda Bintang Merah (<span style="color: red;">*</span>) Harus Di Isi !!</cite></small>
                            </blockquote> -->
                                                        <br>
                                                        <table class="table table-bordered" id="tableLoop">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">#</th>
                                                                    <th class="text-center">Tgl Produksi</th>
                                                                    <th class="text-center">No Mesin</th>
                                                                    <th class="text-center col-2">Nama Operator</th>
                                                                    <th class="text-center col-2">Type Grid</th>
                                                                    <th class="text-center">JKS</th>
                                                                    <th class="text-center">Plan WO</th>
                                                                    <th class="text-center">Aktual</th>
                                                                    <th class="text-center">Section</th>
                                                                    <th class="text-center"><button class="btn btn-success btn-block" id="BarisBaru"><i class="fa fa-plus"></i> Baris Baru</button></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
                                                    <div class="box-footer">
                                                        <div class="form-group d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary    "><i class="fa fa-check"></i> Simpan</button>
                                                            <button type="reset" class="btn btn-default">Batal</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
<!-- modal Area -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Laporan Harian Produksi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url() ?>lhp/add_lhp" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Tanggal Produksi</label>
                                <input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Line</label>
                                <select class="form-select" id="line" name="line">
                                    <option selected disabled>-- Pilih Data --</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Shift</label>
                                <select class="form-select" id="shift" name="shift">
                                    <option selected disabled>-- Pilih Data --</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->
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