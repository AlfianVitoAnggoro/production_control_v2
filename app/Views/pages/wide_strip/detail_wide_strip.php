<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?php
// var_dump($data_detail_breakdown);die;
$mh = [8, 7.5, 6.5];
?>
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <form action="<?= base_url() ?>wide_strip/update_lhp" method="post">
                <input type="hidden" name="id_lhp" id="id_lhp" value="<?= $id_lhp ?>">
                <div class="box">
                    <div class="box-header with-border">
                        <h4>Detail Laporan Harian Produksi</h4>
                        <a href="<?= base_url() ?>grid/detail_lhp_grid_print_view/<?= $id_lhp ?>" target="_blank" class="btn btn-danger">Print</a>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Produksi</label>
                                    <input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi" value="<?= $data_lhp[0]['tanggal_produksi'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Shift</label>
                                    <input type="text" class="form-control" name="shift" id="shift" value="<?= $data_lhp[0]['shift'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Kasubsie</label>
                                    <input type="text" class="form-control" id="kasubsie" name="kasubsie" value="<?= $data_lhp[0]['kasubsie'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Grup</label>
                                    <input type="text" class="form-control" id="grup" name="grup" value="<?= $data_lhp[0]['grup'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Type</label>
                                    <input type="text" class="form-control" id="type_grid" name="type_grid"
                                        <?php foreach ($data_type_grid as $d_type_grid) { 
                                            if ($d_type_grid['id_grid'] == $data_lhp[0]['type_grid']) echo 'value="' . $d_type_grid['type_grid'] . '"';
                                        } ?> readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">MP</label>
                                    <input type="number" class="form-control" id="mp" name="mp" value="<?= $data_lhp[0]['mp'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Absen</label>
                                    <input type="number" class="form-control" id="absen" name="absen" value="<?= $data_lhp[0]['absen'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Cuti</label>
                                    <input type="number" class="form-control" id="cuti" name="cuti" value="<?= $data_lhp[0]['cuti'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header">
                                <div class="row">
                                    <h4>Material In</h4>
                                    <br>
                                    <div class="col">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    Barcode
                                                    <input type="text" class="form-control" name="material_in" id="material_in" onchange="barcode_material_in()">
                                                </td>
                                                <td>
                                                    QTY
                                                    <input type="text" class="form-control" name="qty_material_in" id="qty_material_in" readonly>
                                                </td>
                                                <td>
                                                    QR Rak
                                                    <input type="text" class="form-control" name="qr_rak" id="qr_rak">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" onclick="add_material_in()">Add</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table id="data" class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Barcode</th>
                                                        <th>QTY</th>
                                                        <th>QR Rak</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_material_in">
                                                <?php $number = 0;
                                                foreach ($data_material_in as $d_ct) { ?>
                                                    <tr class="material_in">
                                                        <td>
                                                            <input type="text" class="form-control" id="material_in_<?= $number ?>" value="<?= $d_ct['material_in'] ?>" readonly>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="qty_material_in_<?= $number ?>" value="<?= $d_ct['qty'] ?>" readonly>
                                                                <span class="input-group-text">Kg</span>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="id_material_in_<?= $number ?>" value="<?= $d_ct['id_material_in'] ?>" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="qr_rak_<?= $number ?>" value="<?= $d_ct['qr_rak'] ?>" readonly>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="delete_material_in(this, <?= $number ?>)">Delete</button>
                                                        </td>
                                                    </tr>
                                                <?php $number++;
                                                } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="box-footer" style="text-align: center;">
                                <input type="submit" class="btn btn-success" value="Save">
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Urutan Produksi</th>
                                                <th>Winder</th>
                                                <th>Temperatur Caster</th>
                                                <th>Bending</th>
                                                <th>Panjang</th>
                                                <th>Tebal</th>
                                                <th>Berat</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <?php for ($i=1; $i <= 12; $i++) { $j = $i -1; ?>
                                                <tr>
                                                    <th><input class="form-control" type="text" name="urutan_produksi[]" id="urutan_produksi<?=$i?>" value="<?=$i?>" readonly></th>
                                                    <th>
                                                        <select class="form-select" name="winder[]" id="winder<?=$i?>">
                                                            <option value="">--Pilih Data--</option>
                                                            <option value="1" <?= array_key_exists($j, $data_detail_lhp) ? ($data_detail_lhp[$j]['id'] === 1 ? 'selected' : '') : '' ?>>1</option>
                                                            <option value="2">2</option>
                                                        </select>
                                                        <input type="hidden" name="id_detail_lhp_wide_strip[]" id="id_detail_lhp_wide_strip<?= $i ?>" value="<?= (array_key_exists($j, $data_detail_lhp) ? $data_detail_lhp[$j]['id'] : '') ?>">
                                                    </th>
                                                    <th><input class="form-control" type="text" name="temperatur_caster[]" id="temperatur_caster<?=$i?>" value="<?= array_key_exists($j, $data_detail_lhp) ? $data_detail_lhp[$j]['temperatur_caster'] : '' ?>"></th>
                                                    <th><input class="form-control" type="text" name="bending[]" id="bending<?=$i?>" value="<?= array_key_exists($j, $data_detail_lhp) ? $data_detail_lhp[$j]['bending'] : '' ?>"></th>
                                                    <th><input class="form-control" type="text" name="panjang[]" id="panjang<?=$i?>" value="<?= array_key_exists($j, $data_detail_lhp) ? $data_detail_lhp[$j]['panjang'] : '' ?>"></th>
                                                    <th><input class="form-control" type="text" name="tebal[]" id="tebal<?=$i?>" value="<?= array_key_exists($j, $data_detail_lhp) ? $data_detail_lhp[$j]['tebal'] : '' ?>"></th>
                                                    <th><input class="form-control" type="text" name="berat[]" id="berat<?=$i?>" value="<?= array_key_exists($j, $data_detail_lhp) ? $data_detail_lhp[$j]['berat'] : '' ?>"></th>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- <div class="box-footer" style="text-align: center;"> -->
                            <!-- <input type="submit" class="btn btn-success" value="Save"> -->
                            <!-- </div> -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header">
                                <button type="button" class="btn btn-primary" onclick="get_data_andon()">Refresh Andon</button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="data_andon" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Nama Mesin</th>
                                                <th>Permasalahan</th>
                                                <th>Tujuan</th>
                                                <th>Total Menit</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_data_andon">
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="box-footer" style="text-align: center;">
                                <!-- <input type="submit" class="btn btn-success" value="Save"> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header">
                                <button type="button" class="btn btn-primary" onclick="add_breakdown()">Add</button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="data_line_stop" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Urutan Produksi</th>
                                                <th>Kategori Line Stop</th>
                                                <th>Jenis Line Stop</th>
                                                <th>Uraian Line Stop</th>
                                                <th>Total Menit</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_data_line_stop">
                                            <?php $index_breakdown = 0;
                                            foreach ($data_breakdown as $d_breakdown) { ?>
                                                <tr class="row_line_stop">
                                                    <td>
                                                        <!-- <select name="urutan_produksi_breakdown[]" class="form-select select2" style="width: 150px" disabled>
                                                            <option value="">-- Pilih Urutan --</option>
                                                            <?php
                                                            for ($i = 1; $i <= 12; $i++) { ?>
                                                                <option value="<?= $i ?>" <?php if ($i == $d_breakdown['urutan_produksi']) echo "selected"; ?>><?= $i ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select> -->
                                                        <input type="text" class="form-control" name="urutan_produksi_breakdown[]" id="urutan_produksi_breakdown_<?= $index_breakdown ?>" value="<?= $d_breakdown['urutan_produksi'] ?>" style="width: 150px" readonly>
                                                        <input type="hidden" name="id_detail_lhp_ws_breakdown[]" id="id_detail_lhp_ws_breakdown_<?= $index_breakdown ?>" value="<?= $d_breakdown['id_breakdown_ws'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="kategori_breakdown_ws[]" id="kategori_breakdown_ws_<?= $index_breakdown ?>" value="<?= $d_breakdown['kategori_breakdown'] ?>" style="width: 200px" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="jenis_breakdown_ws[]" id="jenis_breakdown_ws_<?= $index_breakdown ?>" value="<?= $d_breakdown['jenis_breakdown'] ?>" style="width: 200px" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="uraian_breakdown_ws[]" id="uraian_breakdown_ws_<?= $index_breakdown ?>" value="<?= $d_breakdown['uraian_breakdown'] ?>" style="width: 300px" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="total_menit_breakdown_ws[]" id="total_menit_breakdown_ws_<?= $index_breakdown ?>" class="form-control" value="<?= $d_breakdown['total_menit'] ?>" style="width: 75px" readonly>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" onclick="delete_breakdown(this)">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php $index_breakdown++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="box-footer" style="text-align: center;">
                                <!-- <input type="submit" class="btn btn-success" value="Save"> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header">
                                <h4>Detail Rak</h4>
                                <br>
                                <table class="table">
                                    <tr>
                                        <td>
                                            Barcode <input type="text" class="form-control" name="start_barcode" id="start_barcode" onchange="scanQr()" class="form-control">
                                        </td>
                                        <td>
                                            Qty <input type="text" class="form-control" name="start_qty" id="start_qty" class="form-control" readonly>
                                            <div class="qty"></div>
                                        </td>
                                        <td>
                                            QR Code Rak<input type="text" class="form-control" name="start_rak" id="start_rak" class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="add_rak()">Add</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="data_line_stop" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Barcode</th>
                                                <th>QTY</th>
                                                <th>ID Rak</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_data_rak">
                                            <?php $number = 0;
                                            foreach ($data_record_rak as $d_rak) { ?>
                                                <tr class="rak">
                                                    <td>
                                                        <input type="text" class="form-control" name="barcode_rak[]" id="barcode_rak_<?= $number ?>" value="<?= $d_rak['barcode'] ?>" readonly>
                                                        <!-- <input type="hidden" class="form-control" name="id_rak_barcode[]" id="id_rak_barcode_<?= $number ?>" value="<?= "" //$d_rak['id'] 
                                                                                                                                                                            ?>" readonly> -->
                                                        <input type="hidden" class="form-control" name="id_log_detail_record_rak[]" id="id_log_detail_record_rak_<?= $number ?>" value="<?= $d_rak['id_log'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="qty_rak[]" id="qty_rak_<?= $number ?>" value="<?= $d_rak['qty'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <!-- <input type="text" class="form-control" name="id_rak[]" id="id_rak_<?= $number ?>" value="<?= "" //$d_rak['id_rak'] 
                                                                                                                                                        ?>" readonly> -->
                                                        <input type="text" class="form-control" name="id_rak[]" id="id_rak_<?= $number ?>" value="<?= $d_rak['pn_qr'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this, <?= $number ?>)">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php $number += 1;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="box-footer" style="text-align: center;">
                                <!-- <input type="submit" class="btn btn-success" value="Save"> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4" style="text-align:center;"><input type="submit" class="btn btn-success" value="Save"></div>
                    <div class="col-4"></div>
                </div>
                <div class="d-flex justify-content-end" style="margin-right: 50px">
                    <table class="table table-bordered" style="width: 400px;">
                        <thead>
                            <th class="text-center">Disetujui</th>
                            <th class="text-center">Dibuat</th>
                        </thead>
                        <tbody>
                            <td>
                                <div class="form-check text-center p-0">
                                    <?php if ($data_lhp[0]['status'] !== 'approved') { ?>
                                        <button type="submit" class="btn btn-outline-primary" id="approved" name="approved" value="approved" onclick="return confirm('Apakah Anda Yakin?')" disabled>✔</button>
                                    <?php } else { ?>
                                        <button class="btn btn-primary" disabled>✔</button>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-check text-center p-0">
                                    <?php if ($data_lhp[0]['status'] !== 'completed' && $data_lhp[0]['status'] !== 'approved') { ?>
                                        <button type="submit" class="btn btn-outline-primary" id="completed" name="completed" value="completed" onclick="return confirm('Apakah Anda Yakin?')" disabled>✔</button>
                                    <?php } else { ?>
                                        <button class="btn btn-primary" disabled>✔</button>
                                    <?php } ?>
                                </div>
                            </td>
                        </tbody>
                        <tfoot>
                            <th class="text-center">KASIE</th>
                            <th class="text-center">GL/ KSS</th>
                        </tfoot>
                    </table>
                </div>
            </form>
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Rak</h4>
                <!-- <button type="button" class="btn btn-primary" onclick="add_detail_rak()"><i class="fa fa-plus"></i></button> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url() ?>grid/add_rak" method="post">
                <input type="hidden" name="detail_rak_id_lhp" id="detail_rak_id_lhp">
                <input type="hidden" name="detail_rak_id_detail_lhp" id="detail_rak_id_detail_lhp">

                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Barcode</th>
                                    <th>Qty</th>
                                    <th>Rak</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody id="tbody_rak">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="barcode[]" id="barcode_1" onchange="get_qty_rak(1)" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="qty[]" id="qty_1" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="id_rak[]" id="id_rak_1" class="form-control">
                                    </td>
                                    <!-- <td>
                                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
                                        </td> -->
                                </tr>

                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="barcode[]" id="barcode_2" onchange="get_qty_rak(2)" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="qty[]" id="qty_2" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="id_rak[]" id="id_rak_2" class="form-control">
                                    </td>
                                    <!-- <td>
                                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
                                        </td> -->
                                </tr>

                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="barcode[]" id="barcode_3" onchange="get_qty_rak(3)" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="qty[]" id="qty_3" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="id_rak[]" id="id_rak_3" class="form-control">
                                    </td>
                                    <!-- <td>
                                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
                                        </td> -->
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="modal-footer" style="float: right;">
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

<!-- Modal Scan -->
<!-- <div class="modal fade modal_scan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Tambah Rak</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="qr-reader" style="width:500px"></div>
                    <div id="qr-reader-results"></div>
                </div>
            </div>
        </div>>
    </div> -->
<!-- /.modal -->
<div class="modal" id="loading-modal" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color:rgba(0, 0, 0, 0.01);">
            <div class="modal-body text-center">
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="mt-2 text-light">Loading...</h5>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        let baris = <?= count($data_mesin) ?>;
        for (let i = 1; i <= baris; i++) {
            var jks = $('#jks_' + i).val();
            var aktual = $('#aktual_' + i).val();
            var productivity = $('#productivity_' + i).val();
            var mh = $('#mh_' + i).val();
            let nama_operator = $('#nama_operator_' + i).val();
            
            var persentase = (aktual / jks) * 100;
            
            if (jks === '' || jks === null && (aktual === '' || aktual === null)) {
                persentase = 0;
            }
            
            if(mh != 0) {
                var productivity = (aktual / mh)
            } else {
                productivity = 0
            }
            
            if(nama_operator === 'NO MP') {
                document.querySelector('#aktual_' + i).setAttribute('readonly', '');
            }

            $('#persentase_' + i).val(persentase.toFixed(0));
            $('#productivity_' + i).val(productivity.toFixed(0));
        }

        $('input[type="number"]').each(function() {
            if ($(this).val() == 0) {
                $(this).val('');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.detail-btn').on('click', function() {
            // Get data attributes from button
            var id_lhp = $(this).data('id_lhp');
            var id_detail_lhp = $(this).data('id_detail_lhp');

            // Set data attributes to modal
            $('#detail_rak_id_lhp').val(id_lhp);
            $('#detail_rak_id_detail_lhp').val(id_detail_lhp);
            $('.modal_detail').modal('show');
        });
    })
    <?php if ($session <= 2) { ?>
        const approvedElement = document.querySelector('#approved');
        approvedElement.removeAttribute('disabled');
    <?php } ?>
    <?php if ($session <= 4) { ?>
        const completedElement = document.querySelector('#completed');
        completedElement.removeAttribute('disabled');
    <?php } ?>

    function get_jks(i) {
        var type_grid = $('#type_grid_' + i).val();
        var type_mesin = $('#type_mesin_' + i).val();
        var shift = $('#shift').val();
        if(type_grid === 'MESIN OFF' || type_grid === 'NO WO') {
            $('#mh_' + i).val(0);
            $('#jks_' + i).val(0);
            $('#aktual_' + i).val(0);
            $('#persentase_' + i).val(0);
            $('#productivity_' + i).val(0);
        } else {
            $.ajax({
                url: '<?= base_url() ?>grid/get_jks',
                type: 'POST',
                data: {
                    type_grid: type_grid,
                    type_mesin: type_mesin,
                    shift: shift
                },
                dataType: 'json',
                success: function(data) {
                    $('#mh_' + i).val(<?= $mh[$data_lhp[0]['shift'] - 1] ?>);
                    $('#jks_' + i).val(data[0].jks);
                }
            })
        }

    }

    function count_persentase(i) {
        var jks = $('#jks_' + i).val();
        var aktual = $('#aktual_' + i).val();
        var productivity = $('#productivity_' + i).val();
        var mh = $('#mh_' + i).val();

        var persentase = (aktual / jks) * 100;
        var productivity = (aktual / mh)

        $('#persentase_' + i).val(persentase.toFixed(0));
        $('#productivity_' + i).val(productivity.toFixed(0));
    }

    function get_data_andon() {
        var shift = $('#shift').val();
        var tanggal = $('#tanggal_produksi').val();

        $.ajax({
            url: '<?= base_url() ?>grid/get_data_andon',
            type: 'POST',
            data: {
                shift: shift,
                tanggal: tanggal
            },
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    var html = '';
                    var no = 1;
                    for (var i = 0; i < data.length; i++) {
                        html += `<tr>
                                    <td>
                                        ${data[i].nama_mesin}
                                        <input type="hidden" name="no_machine_andon[]" value="${data[i].nama_mesin.substring(3)}">
                                        <input type="hidden" name="tiket_andon[]" value="${data[i].id_ticket}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="permasalahan_andon[]" id="permasalahan_${no}" class="form-control" value="${data[i].permasalahan.substring(8)}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="tujuan_andon[]" id="tujuan_${no}" class="form-control" value="${data[i].tujuan}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="total_menit_andon[]" id="total_menit_${no}" class="form-control" value="${data[i].total_min}">
                                    </td>
                                </tr>`;
                        no++;
                    }
                    $('#tbody_data_andon').html(html);
                } else {
                    alert('Tidak Ada Andon');
                }
            }
        })
    }

    function add_breakdown() {
        let data_line_stop = <?= json_encode($data_line_stop_ws) ?>;
        let row = document.querySelectorAll('.row_line_stop').length;
        $('#tbody_data_line_stop').append(`
            <tr class="row_line_stop">
                <td>
                    <select name="urutan_produksi_breakdown[]" id="urutan_produksi_breakdown_ws_${row}" class="form-select select2" style="width: 150px">
                        <option value="">-- Pilih Urutan --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <input type="hidden" name="id_detail_lhp_ws_breakdown[]">
                </td>
                <td>
                    <select class="form-control select2" name="kategori_breakdown_ws[]" id="kategori_breakdown_ws_${row}" onchange="get_jenis_line_stop(${row})" style="width: 200px">
						<option value="">Pilih Kategori Line Stop</option>
						${data_line_stop.map((item) => {
							return `<option value="${item.kategori_line_stop}">${item.kategori_line_stop}</option>`;
						}).join('')}
					</select>
                <td>
					<select class="form-control select2" id="jenis_breakdown_ws_${row}" name="jenis_breakdown_ws[]" style="width: 200px;">
                        <option selected disabled>-- Pilih Jenis Line Stop --</option>
                    </select>
				</td>
				</td>
                <td>
                    <input type="text" class="form-control" name="uraian_breakdown_ws[]" id="uraian_breakdown_ws_${row}" class="form-control" style="width: 300px">
                </td>
                <td>
                    <input type="text" class="form-control" name="total_menit_breakdown_ws[]" id="total_menit_breakdown_ws_${row}" class="form-control" style="width: 75px">
                </td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="delete_breakdown(this)">Delete</button>
                </td>
            </tr>
        `);

        $('.select2').select2();
    }

    function get_jenis_line_stop(i) {
        let kategori_line_stop = $('#kategori_breakdown_ws_' + i).val();
        $.ajax({
            url: '<?= base_url() ?>wide_strip/get_jenis_line_stop',
            type: 'POST',
            data: {
                kategori_line_stop: kategori_line_stop
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#jenis_breakdown_ws_' + i).html(`
                    <option selected disabled>-- Pilih Jenis Line Stop --</option>
                    ${data.map((item) => `<option value="${item.jenis_line_stop}">${item.jenis_line_stop}</option>`)}
                `);
                $('#uraian_breakdown_' + i).val('');
                $('#menit_breakdown_' + i).val('');
            }
        });
    }

    function delete_breakdown(e) {
        $(e).parent().parent().remove();
    }

    function scanQr() {
        var barcode = $("#start_barcode").val();

        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                get_qty_rak();
            }
        });
    }

    function get_qty_rak() {
        var barcode = $('#start_barcode').val();
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>grid/get_qty_rak',
            type: 'POST',
            data: {
                barcode: barcode
            },
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    document.querySelector('.qty').innerHTML = '';
                    $('.qty').append(`
                        <input type="hidden" class="form-control" name="item" id="item" class="form-control" value="${data[0]['T$ITEM'].trim()}">
                        <input type="hidden" class="form-control" name="dsca" id="dsca" class="form-control" value="${data[0]['T$DSCA']}">
                        <input type="hidden" class="form-control" name="cuni" id="cuni" class="form-control" value="${data[0]['T$CUNI']}">
                        <input type="hidden" class="form-control" name="endt" id="endt" class="form-control" value="${data[0]['T$ENDT']}">
                        <input type="hidden" class="form-control" name="orno" id="orno" class="form-control" value="${data[0]['T$ORNO']}">
                        <input type="hidden" class="form-control" name="mach" id="mach" class="form-control" value="${data[0]['T$MACH']}">
                    `);
                    $('#start_qty').val(data[0].T$ACTQ);
                    $('#loading-modal').modal('hide');
                    $('#start_rak').focus();
                } else {
                    alert('Data Tidak Ditemukan');
                    $('#loading-modal').modal('hide');
                }
            }
        });
    }

    function add_rak() {
        let id_lhp = $('#id_lhp').val();
        let barcode = $('#start_barcode').val();
        let qty = $('#start_qty').val();
        let rak = $('#start_rak').val();
        let item = $('#item').val();
        let descrp = $('#dsca').val();
        let satuan = $('#cuni').val();
        let mesin = $('#mach').val();
        let entry_date = $('#endt').val();
        let no_wo = $('#orno').val();
        let baris = document.querySelectorAll('.rak').length;
        $('#loading-modal').modal('show');
        // $.ajax({
        //     url: '<?= base_url() ?>grid/add_detail_record_rak',
        //     type: 'POST',
        //     data: {
        //         pn_qr: rak,
        //         barcode: barcode,
        //         qty: qty,
        //         wh_from: 'K-CAS',
        //         wh_to: 'K-PAS'
        //     },
        //     dataType: 'json',
        //     success: function(data) {
        //     }
        // });
        $.ajax({
            url: '<?= base_url() ?>grid/add_rak',
            type: 'POST',
            data: {
                id_lhp: id_lhp,
                barcode: barcode,
                qty: qty,
                rak: rak,
                wh_from: 'K-CAS',
                wh_to: 'K-PAS',
                item: item,
                descrp: descrp,
                satuan: satuan,
                mesin: mesin,
                entry_date: entry_date,
                no_wo: no_wo,
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                if(data['id_log_detail_record_rak'] === '') {
                    $('#start_barcode').val('');
                    $('#start_qty').val('');
                    $('#start_rak').val('');
                    $('#loading-modal').modal('hide');
                } else {
                    $('#tbody_data_rak').append(`
                        <tr class="rak">
                            <td>
                                <input type="text" class="form-control" name="barcode_rak[]" id="barcode_rak_${baris}" class="form-control" value="${barcode}" readonly>
                                <input type="hidden" class="form-control" name="id_log_detail_record_rak[]" id="id_log_detail_record_rak_${baris}" class="form-control" value="${data['id_log_detail_record_rak']}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="qty_rak[]" id="qty_rak_${baris}" class="form-control" value="${qty}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="id_rak[]" id="id_rak_${baris}" class="form-control" value="${rak}" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this, ${baris})">Delete</button>
                            </td>
                        </tr>
                    `);
    
                    $('#start_barcode').val('');
                    $('#start_qty').val('');
                    $('#start_rak').val('');
                    $('#loading-modal').modal('hide');
                }
            }
        });
    }


    // function get_qty_rak(i) {
    //     // var id_lhp = $('#detail_rak_id_lhp').val();
    //     // var id_detail_lhp = $('#detail_rak_id_detail_lhp').val();

    //     var barcode = $('#barcode_'+i).val();

    //     $.ajax({
    //         url: '<?= base_url() ?>grid/get_qty_rak',
    //         type: 'POST',
    //         data: {
    //             barcode: barcode
    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //             console.log(data);
    //             $('#qty_'+i).val(data[0].QTY);
    //             // if (data.length > 0) {
    //             //     var html = '';
    //             //     var no = 1;
    //             //     for (var i = 0; i < data.length; i++) {
    //             //         html += `<tr>
    //             //                     <td>
    //             //                         <input type="text" class="form-control" name="barcode[]" id="" class="form-control" value="${data[i].barcode}">
    //             //                     </td>
    //             //                     <td>
    //             //                         <input type="text" class="form-control" name="qty[]" id="" class="form-control" value="${data[i].qty}">
    //             //                     </td>
    //             //                     <td>
    //             //                         <input type="text" class="form-control" name="id_rak[]" id="" class="form-control" value="${data[i].id_rak}">
    //             //                     </td>
    //             //                     <td>
    //             //                         <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
    //             //                     </td>
    //             //                 </tr>`;
    //             //         no++;
    //             //     }
    //             //     $('#tbody_rak').html(html);
    //             // } else {
    //             //     alert('Tidak Ada Rak');
    //             // }
    //         }
    //     })
    // }

    function add_detail_rak() {
        $('#tbody_rak').append(`
            <tr>
                <td>
                    <input type="text" class="form-control" name="barcode[]" id="" class="form-control" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="qty[]" id="" class="form-control" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="id_rak[]" id="" class="form-control" readonly>
                </td>
                
            </tr>
        `);

        // <td>
        //     <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
        // </td>
    }

    function delete_detail_rak(e, baris) {
        // let id_barcode = $('#id_rak_barcode_' + baris).val();
        let id_rak = $('#id_rak_' + baris).val();
        let id_log_detail_record_rak = $('#id_log_detail_record_rak_' + baris).val();
        let barcode_rak = $('#barcode_rak_' + baris).val();
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>grid/delete_rak',
            type: 'POST',
            data: {
                // id_barcode: id_barcode,
                id_rak: id_rak,
                id_log_detail_record_rak: id_log_detail_record_rak,
                barcode_rak: barcode_rak
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $(e).parent().parent().remove();
                $('#loading-modal').modal('hide');
            }
        });
    }

    function scan() {
        $('.modal_scan').modal('show');
    }

    function cek_mp(i) {
        let nama_operator = $('#nama_operator_' + i).val();
        if(nama_operator === 'NO MP') {
            $('#mh_' + i).val(0);
            $('#jks_' + i).val(0);
            $('#aktual_' + i).val(0);
            $('#persentase_' + i).val(0);
            $('#productivity_' + i).val(0);
            document.querySelector('#aktual_' + i).setAttribute('readonly', '');
            document.querySelector('#type_grid_' + i).innerHTML = `
                <option value="">-- Pilih Type Grid --</option>
                <option value="MESIN OFF">MESIN OFF</option>
                <option value="NO WO">NO WO</option>
            `;
        } else {
            $('#mh_' + i).val(<?= $mh[$data_lhp[0]['shift'] - 1] ?>);
            $('#jks_' + i).val(0);
            $('#aktual_' + i).val(0);
            $('#persentase_' + i).val(0);
            document.querySelector('#aktual_' + i).removeAttribute('readonly', '');
            document.querySelector('#type_grid_' + i).innerHTML = `
                <option value="">-- Pilih Type Grid --</option>
                <?php
                foreach ($data_type_grid as $d_type_grid) {
                ?>
                    <option value="<?= $d_type_grid['id_grid'] ?>"><?= $d_type_grid['type_grid'] ?></option>
                <?php
                }
                ?>
            `;
        }
    }

    function barcode_material_in() {
        document.addEventListener('keyup', function(event) {
            // event.preventDefault();
            if (event.keyCode === 9) {
                qty_material_in();
            }
        });
    }

    function qty_material_in() {
        let material_in = document.querySelector('#material_in').value;
        console.log(material_in);
        // Memindahkan fokus ke elemen berikutnya
        $.ajax({
            url: '<?= base_url() ?>wide_strip/qty_material_in',
            type: 'POST',
            data: {
                material_in: material_in,
            },
            dataType: 'json',
            success: function(data) {
                if(data.length > 0) {
                    $('#qty_material_in').val(data[0].QTY);
                }
            }
        })
    }

    function add_material_in() {
        let id_lhp = document.querySelector('#id_lhp').value;
        let material_in = document.querySelector('#material_in').value;
        let qty_material_in = document.querySelector('#qty_material_in').value;
        let qr_rak = document.querySelector('#qr_rak').value;
        let baris = document.querySelectorAll('.material_in').length;
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>wide_strip/material_in',
            type: 'POST',
            data: {
                id_lhp: id_lhp,
                material_in: material_in,
                qty_material_in: qty_material_in,
                qr_rak: qr_rak,
            },
            dataType: 'json',
            success: function(data) {
                if(data > 0) {
                    $('#tbody_material_in').append(`
                        <tr class="material_in">
                            <td>
                                <input type="text" class="form-control" id="material_in_${baris}" value="${material_in}" readonly>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="qty_material_in_${baris}" value="${qty_material_in}" readonly>
                                    <span class="input-group-text">Kg</span>
                                </div>
                                <input type="hidden" class="form-control" id="id_material_in_${baris}" value="${data}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="qr_rak_${baris}" value="${qr_rak}" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_material_in(this, ${baris})">Delete</button>
                            </td>
                        </tr>
                    `);
                    $('#material_in').val('');
                    $('#loading-modal').modal('hide');
                    $('#material_in').focus();
                }
            }
        })
    }

    function delete_material_in(e, baris) {
        let id_material_in = $('#id_material_in_' + baris).val();
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>wide_strip/delete_material_in',
            type: 'POST',
            data: {
                id_material_in: id_material_in,
            },
            dataType: 'json',
            success: function(data) {
                $(e).parent().parent().remove();
                $('#loading-modal').modal('hide');
            }
        });
    }
</script>
<?= $this->endSection(); ?>