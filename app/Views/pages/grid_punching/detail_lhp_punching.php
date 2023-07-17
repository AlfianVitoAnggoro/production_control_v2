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
            <form action="<?= base_url() ?>punching/update_lhp" method="post">
                <input type="hidden" name="id_lhp" id="id_lhp" value="<?= $id_lhp ?>">
                <div class="box">
                    <div class="box-header with-border">
                        <h4>Detail Laporan Harian Produksi</h4>
                        <!-- <a href="<?= base_url() ?>punching/detail_lhp_punching_print_view/<?= $id_lhp ?>" target="_blank" class="btn btn-danger">Print</a> -->
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Produksi</label>
                                    <input type="text" class="form-control" id="tanggal_produksi" name="tanggal_produksi" value="<?= $data_lhp[0]['date_production'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Line</label>
                                    <input type="text" class="form-control" name="line" id="line" value="<?= $data_lhp[0]['line'] ?>" readonly>
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
                                    <input type="text" class="form-control" id="grup" name="grup" value="<?= $data_lhp[0]['kasubsie'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label class="form-label">Grup</label>
                                    <input type="text" class="form-control" id="grup" name="grup" value="<?= $data_lhp[0]['grup'] ?>" readonly>
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
                                <h4>Input Wide Strip</h4>
                                <br>
                                <table class="table">
                                    <tr>
                                        <td>
                                            Scan QR Coil<input type="text" class="form-control" name="scan_qr_wide_strip" id="scan_qr_wide_strip" onchange="scanQrWideStrip()" class="form-control">
                                            <input type="hidden" class="form-control" name="id_coil_wide_strip" id="id_coil_wide_strip" class="form-control" value="" readonly>
                                        </td>
                                        <td>
                                            Type<input type="text" class="form-control" name="type_wide_strip" id="type_wide_strip" class="form-control" readonly>
                                        </td>
                                        <td>
                                            Berat<input type="text" class="form-control" name="berat_wide_strip" id="berat_wide_strip" class="form-control" readonly>
                                        </td>
                                        <td>
                                            Panjang<input type="text" class="form-control" name="panjang_wide_strip" id="panjang_wide_strip" class="form-control" readonly>
                                        </td>
                                        <td>
                                            Prod Time<input type="text" class="form-control" name="prod_time_wide_strip" id="prod_time_wide_strip" class="form-control" readonly>
                                        </td>
                                        <td>
                                            Winder<input type="text" class="form-control" name="winder_wide_strip" id="winder_wide_strip" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="add_wide_strip()">Add</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Scan QR Coil</th>
                                                <th>Type</th>
                                                <th>Berat</th>
                                                <th>Panjang</th>
                                                <th>Prod Time</th>
                                                <th>Winder</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_wide_strip">
                                            <?php $index_wide_strip = 0; foreach ($data_input_wide_strip as $d_iws) { ?>
                                            <tr class="input_wide_strip">
                                                <td>
                                                    <input type="text" class="form-control" id="scan_qr_<?= $index_wide_strip ?>" name="scan_qr" value="<?= $d_iws['coil_code'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="type_<?= $index_wide_strip ?>" name="type" value="<?= $d_iws['type'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="berat_<?= $index_wide_strip ?>" name="berat" value="<?= $d_iws['berat'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="panjang_<?= $index_wide_strip ?>" name="panjang" value="<?= $d_iws['panjang'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="prod_time_<?= $index_wide_strip ?>" name="prod_time" value="<?= $d_iws['prod_time'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="winder_<?= $index_wide_strip ?>" name="winder" value="<?= $d_iws['winder'] ?>" readonly>
                                                </td>
                                            </tr>
                                            <?php $index_wide_strip++; } ?>
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
                <!-- <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header">
                                <h4>Detail Rak Kosong</h4>
                                <br>
                                <table class="table">
                                    <tr>
                                        <td>
                                            Barcode <input type="text" class="form-control" name="start_barcode_0" id="start_barcode_0" onchange="scanQr(0)" class="form-control">
                                        </td>
                                        <td>
                                            Qty <input type="text" class="form-control" name="start_qty_0" id="start_qty_0" class="form-control" readonly>
                                            <div class="qty_0"></div>
                                        </td>
                                        <td>
                                            QR Code Rak<input type="text" class="form-control" name="start_rak_0" id="start_rak_0" class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="add_rak_in(0)">Add</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="data_line_stop_0" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Barcode</th>
                                                <th>QTY</th>
                                                <th>ID Rak</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_data_rak_0">
                                            <?php $number = 0;
                                            foreach ($data_record_rak_in as $d_rak) { ?>
                                                <tr class="rak_0">
                                                    <td>
                                                        <input type="text" class="form-control" name="barcode_rak_0[]" id="barcode_rak_0_<?= $number ?>" value="<?= $d_rak['barcode'] ?>" readonly>
                                                        <input type="hidden" class="form-control" name="id_log_detail_record_rak_0[]" id="id_log_detail_record_rak_0_<?= $number ?>" value="<?= $d_rak['id_log'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="qty_rak_0[]" id="qty_rak_0_<?= $number ?>" value="<?= $d_rak['qty'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="id_rak_0[]" id="id_rak_0_<?= $number ?>" value="<?= $d_rak['pn_qr'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this, 0, <?= $number ?>)">Delete</button>
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
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="hourly_report" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Jam Start</th>
                                                <th>Jam End</th>
                                                <th>Menit Terpakai</th>
                                                <th>Type</th>
                                                <th>CT</th>
                                                <th>Plan</th>
                                                <th>Actual (m)</th>
                                                <th>Total Stop</th>
                                                <th>Line Stop</th>
                                                <!-- <th>Reject</th> -->
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_hourly_report">
                                            <?php
                                                if ($data_lhp[0]['shift'] == 1) {
                                                    $jam_start = ['07.30', '08.50', '09.50', '11.00', '12.00 ', '14.00', '15.00', '16.15'];
                                                    $jam_end = ['08.50', '09.50', '11.00', '12.00', '14.00', '15.00', '16.15', '16.30'];
                                                    $menit_tersedia = ['80', '60', '70', '60', '120', '60', '75', '15'];
                                                    $menit_aktual = [70, 60, 60, 60, 60, 60, 60, 10];
                                                } elseif ($data_lhp[0]['shift'] == 2) {
                                                    $jam_start = ['16.30', '17.50', '19.35', '20.35', '21.35', '22.45', '23.45'];
                                                    $jam_end = ['17.50', '19.35', '20.35', '21.35', '22.45', '23.45', '00.30'];
                                                    $menit_tersedia = ['80', '105', '60', '60', '70', '60', '45'];
                                                    $menit_aktual = [70, 60, 60, 60, 60, 60, 40];
                                                } elseif ($data_lhp[0]['shift'] == 3) {
                                                    $jam_start = ['00.30', '01.50', '02.50', '03.50', '05.20', '06.20'];
                                                    $jam_end = ['01.50', '02.50', '03.50', '05.20', '06.20', '07.30'];
                                                    $menit_tersedia = ['80', '60', '60', '90', '60', '70'];
                                                    $menit_aktual = [70, 60, 60, 60, 60, 60];
                                                }

                                                $temp_batch = '';
                                                $number = 0;
                                                for($i = 0; $i < count($data_detail_lhp); $i++) {
                                                    if($i > 0) {
                                                        $j = $i - 1;
                                                        $temp_batch = $data_detail_lhp[$j]['batch'];
                                                    }
                                                    if ($data_detail_lhp[$i]['batch'] !== NULL) {
                                                        if ($data_detail_lhp[$i]['batch'] != $temp_batch) {
                                                            $number = 0;
                                            ?>
                                                            <tr class="row_<?= $data_detail_lhp[$i]['batch'] ?>">
                                                                <td>
                                                                    <button type="button" class="btn btn-sm btn-primary" onclick="add_rows_batch(<?= $data_detail_lhp[$i]['batch'] ?>)">
                                                                        Add
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <div id="start_section_<?= $data_detail_lhp[$i]['batch'] ?>">
                                                                        <input type="time" class="form-control" name="start[]" id="start_<?= $data_detail_lhp[$i]['batch'] ?>_0" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_start'])) ?>" onkeyup="hitung_menit_terpakai(<?= $data_detail_lhp[$i]['batch'] ?>, 0)" style="width: 100px;">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="stop_section_<?= $data_detail_lhp[$i]['batch'] ?>">
                                                                        <input type="time" class="form-control" name="stop[]" id="stop_<?= $data_detail_lhp[$i]['batch'] ?>_0" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_end'])) ?>" onkeyup="hitung_menit_terpakai(<?= $data_detail_lhp[$i]['batch'] ?>, 0)" style="width: 100px;">
                                                                    </div>
                                                                </td>
                                            <?php } else { $number++ ?>
                                                            <tr class="row_<?= $data_detail_lhp[$i]['batch'] ?>">
                                                                <td>
                                                                    <button type="button" class="btn btn-sm btn-danger" onclick="delete_rows_db(this, <?= $i ?>, <?= $data_detail_lhp[$i]['batch'] ?>)">Remove</button>
                                                                </td>
                                                                <td>
                                                                    <div id="start_section_<?= $data_detail_lhp[$i]['batch'] ?>">
                                                                        <input type="time" class="form-control" name="start[]" id="start_<?= $data_detail_lhp[$i]['batch'] ?>_<?= $number ?>" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_start'])) ?>" onkeyup="hitung_menit_terpakai(<?= $data_detail_lhp[$i]['batch'] ?>, <?= $number ?>)" style="width: 100px;">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="stop_section_<?= $data_detail_lhp[$i]['batch'] ?>">
                                                                        <input type="time" class="form-control" name="stop[]" id="stop_<?= $data_detail_lhp[$i]['batch'] ?>_<?= $number ?>" value="<?= date("H:i", strtotime($data_detail_lhp[$i]['jam_end'])) ?>" onkeyup="hitung_menit_terpakai(<?= $data_detail_lhp[$i]['batch'] ?>, <?= $number ?>)" style="width: 100px;">
                                                                    </div>
                                                                </td>
                                            <?php } } else { ?>
                                                            <tr class="row_<?= $i ?>">
                                                                <td>
                                                                    <button type="button" class="btn btn-sm btn-primary" onclick="add_rows_batch(<?= $i ?>)">
                                                                        Add
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <div id="start_section_<?= $i ?>">
                                                                        <input type="time" class="form-control" name="start[]" id="start_<?= $i ?>_0" value="<?= date("H:i", $jam_start[$i]) ?>" onkeyup="hitung_menit_terpakai(<?= $i ?>, 0)" style="width: 100px;">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                <div id="stop_section_<?= $i ?>">
                                                                    <input type="time" class="form-control" name="stop[]" id="stop_<?= $i ?>_0" value="<?= date("H:i", $jam_end[$i]) ?>" onkeyup="hitung_menit_terpakai(<?= $i ?>, 0)" style="width: 100px;">
                                                                </div>
                                                                </td>
                                            <?php } ?>
                                                                <td>
                                                                    <input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['menit_terpakai'] ?>" onkeyup="update_plan(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)" style="width: 100px">
                                                                </td>
                                                                <td>
                                                                    <select name="type_grid[]" id="type_grid_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" class="form-select select2 type_grid" onchange="get_plan(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)" style="width: 300px">
                                                                        <option value="">-- Pilih type --</option>
                                                                        <?php
                                                                        foreach ($data_type_grid as $d_type_grid) {
                                                                        ?>
                                                                            <option value="<?= str_replace(' ', '', $d_type_grid['type_grid']) ?>" <?= $d_type_grid['type_grid'] == $data_detail_lhp[$i]['type_grid'] ? 'selected' : '' ?>><?= $d_type_grid['type_grid'] ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <input type="hidden" name="batch[]" id="batch_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>" value="<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>">
                                                                    <input type="hidden" name="id_detail_lhp_punching[]" id="id_detail_lhp_punching_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['id_detail_lhp_punching'] ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="ct[]" id="ct_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['ct'] ?>" style="width: 75px" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control" name="plan[]" id="plan_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['plan_punching'] ?>" style="width: 100px" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control" name="actual[]" id="actual_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" onkeyup="update_total_stop(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)" value="<?= $data_detail_lhp[$i]['actual'] ?>" style="width: 100px">
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control" name="total_stop[]" id="total_stop_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['total_stop'] ?>" style="width: 100px" readonly>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-sm btn-primary" id="add_breakdown_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" onclick="add_breakdown(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>, <?= $data_detail_lhp[$i]['id_detail_lhp_punching'] !== NULL ? $data_detail_lhp[$i]['id_detail_lhp_punching'] : '' ?>)">Add</button>
                                                                </td>
                                                                <!-- <td>
                                                                    <button type="button" class="btn btn-sm btn-primary" id="add_reject_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" onclick="add_reject(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)">Add</button>
                                                                </td> -->
                                                            </tr>
                                            <?php } 
                                            if (count($data_detail_lhp) < count($jam_start)) {
                                                for ($i = count($data_detail_lhp); $i < count($jam_start); $i++) { ?>
                                                    <tr class="row_<?= $i ?>">
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-primary" onclick="add_rows_batch(<?= $i ?>)">Add</button>
                                                        </td>
                                                        <td>
                                                            <div id="start_section_<?= $i ?>">
                                                                <input type="time" class="form-control" name="start[]" id="start_<?= $i ?>_0" value="<?= date('H:i', strtotime(str_replace('.', ':', $jam_start[$i]))) ?>" onkeyup="hitung_menit_terpakai(<?= $i ?>, 0)" style="width: 100px;">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="stop_section_<?= $i ?>">
                                                                <input type="time" class="form-control" name="stop[]" id="stop_<?= $i ?>_0" value="<?= date('H:i', strtotime(str_replace('.', ':', $jam_end[$i]))) ?>" onkeyup="hitung_menit_terpakai(<?= $i ?>, 0)" style="width: 100px;">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_<?= $i ?>_0" value="<?= $menit_aktual[$i] ?>" onkeyup="update_plan(<?= $i ?>, 0)" style="width: 100px">
                                                        </td>
                                                        <td>
                                                            <select name="type_grid[]" id="type_grid_<?= $i ?>_0" class="form-select select2" onchange="get_plan(<?= $i ?>, 0)" style="width: 300px">
                                                                <option value="">-- Pilih Type --</option>
                                                                <?php foreach ($data_type_grid as $d_type_grid) { ?>
                                                                    <option value="<?= str_replace(' ', '', $d_type_grid['type_grid']) ?>"><?= $d_type_grid['type_grid'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <input type="hidden" name="batch[]" id="batch_<?=$i?>" value="<?=$i?>">
                                                            <input type="hidden" name="id_detail_lhp_punching[]" id="id_detail_lhp_punching_<?= $i ?>_0" value="">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="ct[]" id="ct_<?= $i ?>_0" style="width: 75px" readonly>
                                                        </td>
                                                        <!-- <td>
                                                        <input type="number" class="form-control" name="plan_cap[]" id="plan_cap_<?= $i ?>" style="width: 75px" readonly>
                                                        </td> -->
                                                        <td>
                                                            <input type="number" class="form-control" name="plan[]" id="plan_<?= $i ?>_0" style="width: 100px" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="actual[]" id="actual_<?= $i ?>_0" onkeyup="update_total_stop(<?= $i ?>, 0)" style="width: 100px">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="total_stop[]" id="total_stop_<?= $i ?>_0" style="width: 100px" readonly>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-primary" id="add_breakdown_<?= $i ?>_0" onclick="add_breakdown(<?= $i ?>, 0, '')">Add</button>
                                                        </td>
                                                        <!-- <td>
                                                            <button type="button" class="btn btn-sm btn-primary" id="add_reject_<?= $i ?>_0" onclick="add_reject(<?= $i ?>, 0)">Add</button>
                                                        </td> -->
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" class="text-end">
                                                    <h3>Total</h3>
                                                </td>
                                                <td style="text-align: right;"><input type="text" class="form-control" name="total_plan" id="" value="<?= $data_lhp[0]['total_plan'] ?>" style="width: 100px" readonly></td>
                                                <td style="text-align: right;"><input type="text" class="form-control" name="total_actual" id="" value="<?= $data_lhp[0]['total_aktual'] ?>" style="width: 100px" readonly></td>
                                                <td style="text-align: right;"><input type="text" class="form-control" name="total_total_stop" id="" value="<?= $data_lhp[0]['total_stop'] ?>" style="width: 100px" readonly></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
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
                                            <?php
                                            //foreach ($data_andon as $d_andon) {
                                            ?>
                                                <tr>
                                                    <td>MC <?= ""//$d_andon['no_machine'] ?></td>
                                                    <td><?= ""//$d_andon['permasalahan'] ?></td>
                                                    <td><?= ""//$d_andon['tujuan'] ?></td>
                                                    <td><?= ""//$d_andon['total_menit'] ?></td>
                                                </tr>
                                            <?php
                                            //}
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="box-footer" style="text-align: center;">
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header">
                                <h4>Output Product</h4>
                                <br>
                                <table class="table">
                                    <tr>
                                        <td>
                                            Scan QR Coil Punching<input type="text" class="form-control" name="scan_qr_output_product" id="scan_qr_output_product" onchange="scanQrCoilPunching()" class="form-control">
                                            <input type="hidden" class="form-control" name="id_coil_output_product" id="id_coil_output_product" class="form-control" value="" readonly>
                                        </td>
                                        <td>
                                            Scan QR Coil Product<input type="text" class="form-control" name="scan_qr_product_output_product" id="scan_qr_product_output_product" onchange="scanQrOutputProduct()" class="form-control">
                                        </td>
                                        <td>
                                            Type<input type="text" class="form-control" name="type_output_product" id="type_output_product" class="form-control" readonly>
                                        </td>
                                        <td>
                                            QTY<input type="text" class="form-control" name="qty_output_product" id="qty_output_product" class="form-control" readonly>
                                            <div class="qty"></div>
                                            <div class="data_coil_code"></div>
                                        </td>
                                        <!-- <td>
                                            Prod Time<input type="text" class="form-control" name="prod_time_output_product" id="prod_time_output_product" class="form-control" readonly>
                                        </td> -->
                                        <td>
                                            Berat<input type="text" class="form-control" name="berat_output_product" id="berat_output_product" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="add_output_product()">Add</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Scan QR Punching</th>
                                                <th>Scan QR Product</th>
                                                <th>Type</th>
                                                <th>Qty</th>
                                                <th>Berat</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_data_output_product">
                                            <?php foreach ($data_output_product as $d_op) { ?>
                                            <tr class="output_product">
                                                <td>
                                                    <input type="text" class="form-control" id="scan_qr_data_output_product" name="scan_qr_data_output_product" value="<?= $d_op['barcode'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="scan_qr_product_data_output_product" name="scan_qr_product_data_output_product" value="<?= $d_op['coil_code'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="type_product_data_output_product" name="type_product_data_output_product" value="<?= $d_op['item'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="qty_data_output_product" name="qty_data_output_product" value="<?= $d_op['qty'] ?>" readonly>
                                                    <!-- <input type="hidden" class="form-control" id="prod_time_data_output_product" name="prod_time_data_output_product" value="<?= $d_op['prod_time'] ?>" readonly> -->
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="berat_data_output_product" name="berat_data_output_product" value="<?= $d_op['berat'] ?>" readonly>
                                                </td>
                                            </tr>
                                            <?php } ?>
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
                                <h4>Summary Output Product</h4>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Total</th>
                                                <th>Catatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_summary_output_product">
                                            <?php $model = new App\Models\M_Punching();
                                            $index_summary_note = 0;
                                            foreach ($summary_output_product as $d_sop) { ?>
                                            <tr class="<?= $d_sop['type_grid'] ?>">
                                                <td><?= $d_sop['type_grid'] ?></td>
                                                <td><?= $d_sop['actual'] ?></td>
                                                <td>
                                                    <?php $data_summary_note = $model->get_summary_note($id_lhp, $d_sop['type_grid']);
                                                    if(!empty($data_summary_note)) {
                                                    ?>
                                                        <?= $data_summary_note[0]['note'] ?>
                                                        <input type="hidden" class="form-control" name="id_summary" id="id_summary_<?= $index_summary_note ?>" value="<?= $data_summary_note[0]['id_detail_lhp_punching_note'] ?>">
                                                    <?php } else { ?>
                                                        <input type="hidden" class="form-control" name="id_summary" id="id_summary_<?= $index_summary_note ?>" value="">
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_note_punching" onclick="add_note('<?= $d_sop['type_grid'] ?>', <?= $d_sop['actual'] ?>, <?= $id_lhp ?>, <?= $index_summary_note ?>)">
                                                        Add
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php $index_summary_note++; } ?>
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
                                <h4>Wide Strip Sisa</h4>
                                <br>
                                <table class="table">
                                    <tr>
                                        <td>
                                            Scan QR Coil<input type="text" class="form-control" name="scan_qr_wide_strip_sisa" id="scan_qr_wide_strip_sisa" onchange="scanQrWideStripSisa()" class="form-control">
                                            <input type="hidden" class="form-control" name="id_coil_wide_strip_sisa" id="id_coil_wide_strip_sisa" class="form-control">
                                        </td>
                                        <td>
                                            Type<input type="text" class="form-control" name="type_wide_strip_sisa" id="type_wide_strip_sisa" class="form-control" readonly>
                                            <div class="data_data_wide_strip_sisa"></div>
                                        </td>
                                        <td>
                                            Berat<input type="text" class="form-control" name="berat_wide_strip_sisa" id="berat_wide_strip_sisa" class="form-control">
                                        </td>
                                        <td>
                                            Panjang<input type="text" class="form-control" name="panjang_wide_strip_sisa" id="panjang_wide_strip_sisa" class="form-control">
                                        </td>
                                        <td>
                                            Prod Time<input type="text" class="form-control" name="prod_time_wide_strip_sisa" id="prod_time_wide_strip_sisa" class="form-control" readonly>
                                        </td>
                                        <td>
                                            Winder<input type="text" class="form-control" name="winder_wide_strip_sisa" id="winder_wide_strip_sisa" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="add_wide_strip_sisa()">Add</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Scan QR Coil</th>
                                                <th>Type</th>
                                                <th>Berat</th>
                                                <th>Panjang</th>
                                                <th>Prod Time</th>
                                                <th>Winder</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_data_wide_strip_sisa">
                                            <?php $index_wide_strip_sisa = 0; foreach ($data_wide_strip_sisa as $d_wss) { ?>
                                            <tr class="wide_strip_sisa">
                                                <td>
                                                    <input type="text" class="form-control" id="scan_qr_data_wide_strip_sisa_<?= $index_wide_strip_sisa ?>" name="scan_qr_data_wide_strip_sisa" value="<?= $d_wss['coil_code'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="type_data_wide_strip_sisa_<?= $index_wide_strip_sisa ?>" name="type_data_wide_strip_sisa" value="<?= $d_wss['type'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="berat_data_wide_strip_sisa_<?= $index_wide_strip_sisa ?>" name="berat_data_wide_strip_sisa" value="<?= $d_wss['berat'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="panjang_data_wide_strip_sisa_<?= $index_wide_strip_sisa ?>" name="panjang_data_wide_strip_sisa" value="<?= $d_wss['panjang'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="prod_time_data_wide_strip_sisa_<?= $index_wide_strip_sisa ?>" name="prod_time_data_wide_strip_sisa" value="<?= $d_wss['prod_time'] ?>" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="winder_data_wide_strip_sisa_<?= $index_wide_strip_sisa ?>" name="winder_data_wide_strip_sisa" value="<?= $d_wss['winder'] ?>" readonly>
                                                </td>
                                            </tr>
                                            <?php $index_wide_strip_sisa++; } ?>
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

                <div class="row" id="ls_section">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header">
                                <h4>Detail Line Stop</h4>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="data_line_stop" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>Jam Start</th>
                                                <th>Jam Stop</th>
                                                <th>Type</th>
                                                <th>Kategori Line Stop</th>
                                                <th>Jenis Line Stop</th>
                                                <th>Uraian Line Stop</th>
                                                <th>Line Stop Minute</th>
                                                <th>Line Stop Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_data_line_stop">
                                            <?php $index_breakdown = 0;
                                            foreach ($data_breakdown as $d_breakdown) { ?>
                                                <tr>
                                                    <td>
                                                        <input type="time" class="form-control" name="start_breakdown[]" id="start_breakdown_<?= $index_breakdown ?>" value="<?= date("H:i", strtotime($d_breakdown['jam_start'])) ?>" style="width: 100px;">
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control" name="stop_breakdown[]" id="stop_breakdown_<?= $index_breakdown ?>" value="<?= date("H:i", strtotime($d_breakdown['jam_end'])) ?>" style="width: 100px;">
                                                    </td>
                                                    <td>
                                                        <input type="hidden" class="form-control" name="id_breakdown[]" id="id_breakdown_<?= $index_breakdown ?>" value="<?= $d_breakdown['id_breakdown_punching'] ?>">
                                                        <input type="hidden" class="form-control" name="id_detail_lhp_punching_breakdown[]" id="id_detail_lhp_punching_breakdown_<?= $index_breakdown ?>" value="<?= $d_breakdown['id_detail_lhp_punching'] ?>">
                                                        <input type="text" class="form-control" name="type_grid_line_stop[]" id="type_grid_line_stop_<?= $index_breakdown ?>" value="<?= $d_breakdown['type_grid'] ?>" style="width: 225px" readonly>
                                                    </td>
                                                    <td>
                                                        <select class="form-control select2" name="kategori_line_stop[]" id="kategori_line_stop_<?= $index_breakdown ?>" onchange="get_jenis_line_stop(<?= $index_breakdown ?>)" style="width: 200px">
                                                        <option value="">Pilih Kategori Line Stop</option>
                                                        <?php
                                                            foreach ($data_line_stop_punching as $d_kategori_line_stop) { ?>
                                                            <option value="<?= $d_kategori_line_stop['kategori_line_stop'] ?>" <?= $d_kategori_line_stop['kategori_line_stop'] == $d_breakdown['kategori_line_stop'] ? 'selected' : '' ?>><?= $d_kategori_line_stop['kategori_line_stop'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control select2" id="jenis_line_stop_<?= $index_breakdown ?>" name="jenis_line_stop[]" style="width: 200px;">
                                                        <option selected disabled>-- Pilih Jenis Line Stop --</option>
                                                        <?php
                                                            $data_jenis_line_stop = $model->getListJenisLineStopPunching($d_breakdown['kategori_line_stop']);
                                                            foreach ($data_jenis_line_stop as $d_jenis_line_stop) {
                                                            ?>
                                                                <option value="<?= $d_jenis_line_stop['jenis_line_stop'] ?>" <?= ($d_jenis_line_stop['jenis_line_stop'] == $d_breakdown['jenis_line_stop']) ? 'selected' : '' ?>><?= $d_jenis_line_stop['jenis_line_stop'] ?></option>
                                                            <?php
                                                            }
                                                        ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="uraian_line_stop[]" id="uraian_line_stop_<?= $index_breakdown ?>" cols="20" rows="1" style="width: 200px;"><?= $d_breakdown['uraian_line_stop'] ?></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="menit_breakdown[]" id="menit_breakdown_<?= $index_breakdown ?>" value="<?= $d_breakdown['menit_breakdown'] ?>" style="width: 75px">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" onclick="delete_breakdown(<?= $index_breakdown ?>)"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            <?php
                                            $index_breakdown++;
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

                <!-- <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header">
                                <h4>Detail Rak Isi</h4>
                                <br>
                                <table class="table">
                                    <tr>
                                        <td>
                                            Barcode <input type="text" class="form-control" name="start_barcode_1" id="start_barcode_1" onchange="scanQr(1)" class="form-control">
                                        </td>
                                        <td>
                                            Qty <input type="text" class="form-control" name="start_qty_1" id="start_qty_1" class="form-control" readonly>
                                            <div class="qty_1"></div>
                                        </td>
                                        <td>
                                            QR Code Rak<input type="text" class="form-control" name="start_rak_1" id="start_rak_1" class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="add_rak_out(1)">Add</button>
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
                                        <tbody id="tbody_data_rak_1">
                                            <?php $number = 0;
                                            foreach ($data_record_rak_out as $d_rak) { ?>
                                                <tr class="rak_1">
                                                    <td>
                                                        <input type="text" class="form-control" name="barcode_rak_1[]" id="barcode_rak_1_<?= $number ?>" value="<?= $d_rak['barcode'] ?>" readonly>
                                                        <input type="hidden" class="form-control" name="id_log_detail_record_rak_1[]" id="id_log_detail_record_rak_1_<?= $number ?>" value="<?= $d_rak['id_log'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="qty_rak_1[]" id="qty_rak_1_<?= $number ?>" value="<?= $d_rak['qty'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="id_rak_1[]" id="id_rak_1_<?= $number ?>" value="<?= $d_rak['pn_qr'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" onclick="delete_detail_rak_out(this, 1, <?= $number ?>)">Delete</button>
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
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4" style="text-align:center;"><input type="submit" class="btn btn-success" value="Save"></div>
                    <div class="col-4"></div>
                </div>
                <!-- <div class="d-flex justify-content-end" style="margin-right: 50px">
                    <table class="table table-bordered" style="width: 400px;">
                        <thead>
                            <th class="text-center">Disetujui</th>
                            <th class="text-center">Dibuat</th>
                        </thead>
                        <tbody>
                            <td>
                                <div class="form-check text-center p-0">
                                    <?php ""//if ($data_lhp[0]['status'] !== 'approved') { ?>
                                        <button type="submit" class="btn btn-outline-primary" id="approved" name="approved" value="approved" onclick="return confirm('Apakah Anda Yakin?')" disabled>✔</button>
                                    <?php ""//} else { ?>
                                        <button class="btn btn-primary" disabled>✔</button>
                                    <?php ""//} ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-check text-center p-0">
                                    <?php ""//if ($data_lhp[0]['status'] !== 'completed' && $data_lhp[0]['status'] !== 'approved') { ?>
                                        <button type="submit" class="btn btn-outline-primary" id="completed" name="completed" value="completed" onclick="return confirm('Apakah Anda Yakin?')" disabled>✔</button>
                                    <?php ""//} else { ?>
                                        <button class="btn btn-primary" disabled>✔</button>
                                    <?php ""//} ?>
                                </div>
                            </td>
                        </tbody>
                        <tfoot>
                            <th class="text-center">KASIE</th>
                            <th class="text-center">GL/ KSS</th>
                        </tfoot>
                    </table>
                </div> -->
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
            <form action="<?= base_url() ?>punching/add_rak" method="post">
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
<div class="modal fade modal_tambah_note_punching" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Tambah Note</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row" id="note_punching">
        </div>
      </div>
      <div class="modal-footer" style="float: right;" id="add_note_punching">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
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
    // <?php //if ($session <= 2) { ?>
    //     const approvedElement = document.querySelector('#approved');
    //     approvedElement.removeAttribute('disabled');
    // <?php //} ?>
    // <?php //if ($session <= 4) { ?>
    //     const completedElement = document.querySelector('#completed');
    //     completedElement.removeAttribute('disabled');
    // <?php //} ?>

    // function get_jks(i) {
    //     var type_grid = $('#type_grid_' + i).val();
    //     var shift = $('#shift').val();
    //     $.ajax({
    //         url: '<?= base_url() ?>punching/get_jks',
    //         type: 'POST',
    //         data: {
    //             type_grid: type_grid,
    //             shift: shift
    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //             console.log(data);
    //             $('#plan_punching_' + i).val(data[0].jks);
    //         }
    //     })
    // }

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
            url: '<?= base_url() ?>punching/get_data_andon',
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

    function get_jenis_line_stop(i) {
        let kategori_line_stop = $('#kategori_line_stop_' + i).val();
        $.ajax({
            url: '<?= base_url() ?>punching/get_jenis_line_stop',
            type: 'POST',
            data: {
                kategori_line_stop: kategori_line_stop
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#jenis_line_stop_' + i).html(`
                    <option selected disabled>-- Pilih Jenis Line Stop --</option>
                    ${data.map((item) => `<option value="${item.jenis_line_stop}">${item.jenis_line_stop}</option>`)}
                `);
                $('#uraian_line_stop_' + i).val('');
                $('#menit_breakdown_' + i).val('');
            }
        });
    }

    // function add_breakdown() {
    //     var data_line_stop = <?= json_encode($data_line_stop_punching) ?>;
    //     let row = document.querySelectorAll('.row_line_stop').length;
    //     $('#tbody_data_line_stop').append(`
    //         <tr class="row_line_stop">
    //             <td>
    //                 <select class="form-control select2" name="kategori_breakdown_punching[]" id="kategori_breakdown_punching_${row}" onchange="get_jenis_line_stop(${row})" style="width: 200px">
	// 					<option value="">Pilih Kategori Line Stop</option>
	// 					${data_line_stop.map((item) => {
	// 						return `<option value="${item.kategori_line_stop}">${item.kategori_line_stop}</option>`;
	// 					}).join('')}
	// 				</select>
    //                 <input type="hidden" name="id_detail_lhp_punching_breakdown[]" id="id_detail_lhp_punching_breakdown_${row}" value="">
    //             <td>
	// 				<select class="form-control select2" id="jenis_breakdown_punching_${row}" name="jenis_breakdown_punching[]" style="width: 200px;">
    //                     <option selected disabled>-- Pilih Jenis Line Stop --</option>
    //                 </select>
	// 			</td>
    //             <td>
    //                 <input type="text" class="form-control" name="uraian_breakdown_punching[]" id="uraian_breakdown_punching_${row}" class="form-control" style="width: 300px">
    //             </td>
    //             <td>
    //                 <input type="text" class="form-control" name="total_menit_breakdown_punching[]" id="total_menit_breakdown_punching_${row}" class="form-control" style="width: 75px">
    //             </td>
    //             <td>
    //                 <button type="button" class="btn btn-danger" onclick="delete_breakdown(this)">Delete</button>
    //             </td>
    //         </tr>
    //     `);

    //     $('.select2').select2();
    // }

    // function delete_breakdown(e) {
    //     $(e).parent().parent().remove();
    // }

    function scanQr(i) {
        var barcode = $("#start_barcode_" + i).val();

        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                get_qty_rak(i);
            }
        });
    }

    function get_qty_rak(i) {
        var barcode = $('#start_barcode_' + i).val();
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>punching/get_qty_rak',
            type: 'POST',
            data: {
                barcode: barcode
            },
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    document.querySelector('.qty_' + i).innerHTML = '';
                    $('.qty_' + i).append(`
                        <input type="hidden" class="form-control" name="item_${i}" id="item_${i}" class="form-control" value="${data[0]['T$ITEM'].trim()}">
                        <input type="hidden" class="form-control" name="dsca_${i}" id="dsca_${i}" class="form-control" value="${data[0]['T$DSCA']}">
                        <input type="hidden" class="form-control" name="cuni_${i}" id="cuni_${i}" class="form-control" value="${data[0]['T$CUNI']}">
                        <input type="hidden" class="form-control" name="endt_${i}" id="endt_${i}" class="form-control" value="${data[0]['T$ENDT']}">
                        <input type="hidden" class="form-control" name="orno_${i}" id="orno_${i}" class="form-control" value="${data[0]['T$ORNO']}">
                        <input type="hidden" class="form-control" name="mach_${i}" id="mach_${i}" class="form-control" value="${data[0]['T$MACH']}">
                    `);
                    $('#start_qty_' + i).val(data[0].T$ACTQ);
                    $('#loading-modal').modal('hide');
                    $('#start_rak_' + i).focus();
                } else {
                    alert('Data Tidak Ditemukan');
                    $('#loading-modal').modal('hide');
                }
            }
        });
    }

    function add_rak_in(i) {
        let id_lhp = $('#id_lhp').val();
        let barcode = $('#start_barcode_' + i).val();
        let qty = $('#start_qty_' + i).val();
        let rak = $('#start_rak_' + i).val();
        let item = $('#item_' + i).val();
        let descrp = $('#dsca_' + i).val();
        let satuan = $('#cuni_' + i).val();
        let mesin = $('#mach_' + i).val();
        let entry_date = $('#endt_' + i).val();
        let no_wo = $('#orno_' + i).val();
        let baris = document.querySelectorAll('.rak_' + i).length;
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
            url: '<?= base_url() ?>punching/add_rak_in',
            type: 'POST',
            data: {
                id_lhp: id_lhp,
                barcode: barcode,
                qty: qty,
                rak: rak,
                wh_from: 'K-PUN',
                wh_to: 'K-PUN',
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
                if(data === 'Gagal' || data['id_log_detail_record_rak'] === '') {
                    $('#start_barcode_' + i).val('');
                    $('#start_qty_' + i).val('');
                    $('#start_rak_' + i).val('');
                    $('#loading-modal').modal('hide');
                } else {
                    $('#tbody_data_rak_' + i).append(`
                        <tr class="rak_${i}">
                            <td>
                                <input type="text" class="form-control" name="barcode_rak_${i}[]" id="barcode_rak_${i}_${baris}" class="form-control" value="${barcode}" readonly>
                                <input type="hidden" class="form-control" name="id_log_detail_record_rak_${i}[]" id="id_log_detail_record_rak_${i}_${baris}" class="form-control" value="${data['id_log_detail_record_rak']}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="qty_rak_${i}[]" id="qty_rak_${i}_${baris}" class="form-control" value="${qty}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="id_rak_${i}[]" id="id_rak_${i}_${baris}" class="form-control" value="${rak}" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this, ${i}, ${baris})">Delete</button>
                            </td>
                        </tr>
                    `);
    
                    $('#start_barcode_' + i).val('');
                    $('#start_qty_' + i).val('');
                    $('#start_rak_' + i).val('');
                    $('#loading-modal').modal('hide');
                }
            }
        });
    }

    function add_rak_out(i) {
        let id_lhp = $('#id_lhp').val();
        let barcode = $('#start_barcode_' + i).val();
        let qty = $('#start_qty_' + i).val();
        let rak = $('#start_rak_' + i).val();
        let item = $('#item_' + i).val();
        let descrp = $('#dsca_' + i).val();
        let satuan = $('#cuni_' + i).val();
        let mesin = $('#mach_' + i).val();
        let entry_date = $('#endt_' + i).val();
        let no_wo = $('#orno_' + i).val();
        let baris = document.querySelectorAll('.rak_' + i).length;
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
            url: '<?= base_url() ?>punching/add_rak_out',
            type: 'POST',
            data: {
                id_lhp: id_lhp,
                barcode: barcode,
                qty: qty,
                rak: rak,
                wh_from: 'K-PUN',
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
                    $('#start_barcode_' + i).val('');
                    $('#start_qty_' + i).val('');
                    $('#start_rak_' + i).val('');
                    $('#loading-modal').modal('hide');
                } else {
                    $('#tbody_data_rak_' + i).append(`
                        <tr class="rak_${i}">
                            <td>
                                <input type="text" class="form-control" name="barcode_rak_${i}[]" id="barcode_rak_${i}_${baris}" class="form-control" value="${barcode}" readonly>
                                <input type="hidden" class="form-control" name="id_log_detail_record_rak_${i}[]" id="id_log_detail_record_rak_${i}_${baris}" class="form-control" value="${data['id_log_detail_record_rak']}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="qty_rak_${i}[]" id="qty_rak_${i}_${baris}" class="form-control" value="${qty}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="id_rak_${i}[]" id="id_rak_${i}_${baris}" class="form-control" value="${rak}" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_detail_rak_out(this, ${i}, ${baris})">Delete</button>
                            </td>
                        </tr>
                    `);
    
                    $('#start_barcode_' + i).val('');
                    $('#start_qty_' + i).val('');
                    $('#start_rak_' + i).val('');
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

    function delete_detail_rak(e, i, baris) {
        // let id_barcode = $('#id_rak_barcode_' + baris).val();
        let id_rak = $('#id_rak_' + i + '_' + baris).val();
        let id_log_detail_record_rak = $('#id_log_detail_record_rak_' + i + '_' + baris).val();
        let barcode_rak = $('#barcode_rak_' + i + '_' + baris).val();
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>punching/delete_rak',
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

    function delete_detail_rak_out(e, i, baris) {
        // let id_barcode = $('#id_rak_barcode_' + baris).val();
        let id_rak = $('#id_rak_' + i + '_' + baris).val();
        let id_log_detail_record_rak = $('#id_log_detail_record_rak_' + i + '_' + baris).val();
        let barcode_rak = $('#barcode_rak_' + i + '_' + baris).val();
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>punching/delete_rak_out',
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

    // function material_in_conveyor_barat() {
    //     document.addEventListener('keyup', function(event) {
    //         // event.preventDefault();
    //         if (event.keyCode === 9) {
    //             qty_material_in('barat');
    //         }
    //     });
    // }

    // function material_in_conveyor_timur() {
    //     document.addEventListener('keyup', function(event) {
    //         // event.preventDefault();
    //         if (event.keyCode === 9) {
    //             qty_material_in('timur');
    //         }
    //     });
    // }

    // function qty_material_in(conveyor) {
    //     let material_in = document.querySelector('#conveyor_' + conveyor).value;
    //     // Memindahkan fokus ke elemen berikutnya
    //     $.ajax({
    //         url: '<?= base_url() ?>punching/qty_material_in',
    //         type: 'POST',
    //         data: {
    //             material_in: material_in,
    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //             if(data.length > 0) {
    //                 $('#qty_conveyor_' + conveyor).val(data[0].QTY);
    //             }
    //         }
    //     })
    // }

    // function add_material_in(conveyor) {
    //     let id_lhp = document.querySelector('#id_lhp').value;
    //     let material_in = document.querySelector('#qty_conveyor_' + conveyor).value;
    //     let baris = document.querySelectorAll('.material_in_conveyor_' + conveyor).length;
    //     $('#loading-modal').modal('show');
    //     $.ajax({
    //         url: '<?= base_url() ?>punching/material_in',
    //         type: 'POST',
    //         data: {
    //             id_lhp: id_lhp,
    //             material_in: material_in,
    //             conveyor: conveyor,
    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //             if(data > 0) {
    //                 $('#tbody_material_in_conveyor_' + conveyor).append(`
    //                     <tr class="material_in_conveyor_${conveyor}">
    //                         <td>
    //                             <div class="input-group">
    //                                 <input type="text" class="form-control" id="material_in_timur_${baris}" value="${material_in}" readonly>
    //                                 <span class="input-group-text">Kg</span>
    //                             </div>
    //                             <input type="hidden" class="form-control" id="id_material_in_timur_${baris}" value="${data}" readonly>
    //                         </td>
    //                         <td>
    //                             <button type="button" class="btn btn-danger" onclick="delete_material_in(this, 'timur', ${baris})">Delete</button>
    //                         </td>
    //                     </tr>
    //                 `);
    //                 $('#conveyor_' + conveyor).val('');
    //                 $('#loading-modal').modal('hide');
    //                 $('#conveyor_' + conveyor).focus();
    //             }
    //         }
    //     })
    // }

    // function delete_material_in(e, conveyor, baris) {
    //     let id_material_in = $('#id_material_in_' + conveyor + '_' + baris).val();
    //     $('#loading-modal').modal('show');
    //     $.ajax({
    //         url: '<?= base_url() ?>punching/delete_material_in',
    //         type: 'POST',
    //         data: {
    //             id_material_in: id_material_in,
    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //             $(e).parent().parent().remove();
    //             $('#loading-modal').modal('hide');
    //         }
    //     });
    // }

    function scanQrWideStrip() {
        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                get_data_coil();
            }
        });
    }

    function get_data_coil() {
        var barcode = $('#scan_qr_wide_strip').val();
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>punching/get_data_coil',
            type: 'POST',
            data: {
                barcode: barcode
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                if (data.length > 0) {
                    $('#id_coil_wide_strip').val(data[0].id_log);
                    $('#type_wide_strip').val(data[0].type);
                    $('#berat_wide_strip').val(data[0].berat);
                    $('#panjang_wide_strip').val(data[0].panjang);
                    $('#prod_time_wide_strip').val(data[0].prod_time);
                    $('#winder_wide_strip').val(data[0].winder);
                    $('#loading-modal').modal('hide');
                } else {
                    alert('Data Tidak Ditemukan');
                    $('#loading-modal').modal('hide');
                }
            }
        });
    }

    function add_wide_strip() {
        let id_lhp_punching = $('#id_lhp').val();
        let barcode = $('#scan_qr_wide_strip').val();
        let id_log = $('#id_coil_wide_strip').val();
        let type = $('#type_wide_strip').val();
        let berat = $('#berat_wide_strip').val();
        let panjang = $('#panjang_wide_strip').val();
        let prod_time = $('#prod_time_wide_strip').val();
        let winder = $('#winder_wide_strip').val();
        let baris = document.querySelectorAll('.input_wide_strip').length;
        $('#loading-modal').modal('show');
        $.ajax({
        url: '<?= base_url() ?>punching/add_wide_strip',
        type: 'POST',
        data: {
            id_lhp_punching: id_lhp_punching,
            barcode: barcode,
            type: type,
            berat: berat,
            panjang: panjang,
            prod_time: prod_time,
            winder: winder,
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data === 'Gagal') {
                $('#loading-modal').modal('hide');
                alert('Data Tidak Ditemukan');
            } else {
            $('#tbody_wide_strip').append(`
                <tr class="input_wide_strip">
                    <td>
                        <input type="text" class="form-control" id="scan_qr_${baris}" name="scan_qr" value="${barcode}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="type_${baris}" name="type" value="${type}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="berat_${baris}" name="berat" value="${berat}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="panjang_${baris}" name="panjang" value="${panjang}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="prod_time_${baris}" name="prod_time" value="${prod_time}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="winder_${baris}" name="winder" value="${winder}" readonly>
                    </td>
                </tr>
            `);

            $('#scan_qr_wide_strip').val('');
            $('#id_coil_wide_strip').val('');
            $('#type_wide_strip').val('');
            $('#berat_wide_strip').val('');
            $('#panjang_wide_strip').val('');
            $('#prod_time_wide_strip').val('');
            $('#winder_wide_strip').val('');
            $('#loading-modal').modal('hide');
            }
        }
        });
    }

    function scanQrOutputProduct() {
        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                get_data_coil_output_product();
            }
        });
    }

    function get_data_coil_output_product() {
        var barcode = $('#scan_qr_product_output_product').val();
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>punching/get_data_coil_output_product',
            type: 'POST',
            data: {
                barcode: barcode
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                if (data.length > 0) {
                    document.querySelector('.data_coil_code').innerHTML = '';
                    $('.data_coil_code').append(`
                        <input type="hidden" name="type_data_coil_code" id="type_data_coil_code" class="form-control" value="${data[0]['type']}">
                        <input type="hidden" name="winder_data_coil_code" id="winder_data_coil_code" class="form-control" value="${data[0]['winder']}">
                        <input type="hidden" name="panjang_data_coil_code" id="panjang_data_coil_code" class="form-control" value="${data[0]['panjang']}">
                        <input type="hidden" name="tebal_r_data_coil_code" id="tebal_r_data_coil_code" class="form-control" value="${data[0]['tebal_r']}">
                        <input type="hidden" name="tebal_l_data_coil_code" id="tebal_l_data_coil_code" class="form-control" value="${data[0]['tebal_l']}">
                        <input type="hidden" name="bending_data_coil_code" id="bending_data_coil_code" class="form-control" value="${data[0]['bending']}">
                        <input type="hidden" name="lebar_data_coil_code" id="lebar_data_coil_code" class="form-control" value="${data[0]['lebar']}">
                        <input type="hidden" name="hasil_timbangan_data_coil_code" id="hasil_timbangan_data_coil_code" class="form-control" value="${data[0]['hasil_timbangan']}">
                        <input type="hidden" name="prod_time_data_coil_code" id="prod_time_data_coil_code" class="form-control" value="${data[0]['prod_time']}">
                    `);
                    // $('#id_coil_data_output_product').val(data[0].id_log);
                    $('#berat_output_product').val(data[0].berat);
                    $('#loading-modal').modal('hide');
                } else {
                    alert('Data Tidak Ditemukan');
                    $('#loading-modal').modal('hide');
                }
            }
        });
    }

    function scanQrCoilPunching() {
        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                get_qty_rak();
            }
        });
    }

    function get_qty_rak() {
        var barcode = $('#scan_qr_output_product').val();
        console.log(barcode)
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>punching/get_qty_rak',
            type: 'POST',
            data: {
                barcode: barcode
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
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
                    $('#type_output_product').val(data[0]['T$ITEM'].trim());
                    $('#qty_output_product').val(data[0].T$ACTQ);
                    $('#loading-modal').modal('hide');
                    $('#scan_qr_product_output_product').focus();
                } else {
                    alert('Data Tidak Ditemukan');
                    $('#loading-modal').modal('hide');
                }
            }
        });
    }

    function add_output_product() {
        let id_lhp_punching = $('#id_lhp').val();
        let barcode = $('#scan_qr_output_product').val();
        let coil_code = $('#scan_qr_product_output_product').val();
        let id_log = $('#id_coil_output_product').val();
        let type = $('#type_output_product').val();
        let qty = $('#qty_output_product').val();
        let berat = $('#berat_output_product').val();
        // let prod_time = $('#prod_time_output_product').val();
        console.log({id_lhp_punching, barcode, coil_code, id_log, type, qty, berat})

        let type_data_coil_code = $('#type_data_coil_code').val();
        let winder_data_coil_code = $('#winder_data_coil_code').val();
        let panjang_data_coil_code = $('#panjang_data_coil_code').val();
        let tebal_r_data_coil_code = $('#tebal_r_data_coil_code').val();
        let tebal_l_data_coil_code = $('#tebal_l_data_coil_code').val();
        let bending_data_coil_code = $('#bending_data_coil_code').val();
        let lebar_data_coil_code = $('#lebar_data_coil_code').val();
        let hasil_timbangan_data_coil_code = $('#hasil_timbangan_data_coil_code').val();
        let prod_time_data_coil_code = $('#prod_time_data_coil_code').val();
        
        let item = $('#item').val();
        let descrp = $('#dsca').val();
        let satuan = $('#cuni').val();
        let mesin = $('#mach').val();
        let entry_date = $('#endt').val();
        let no_wo = $('#orno').val();
        let baris = document.querySelectorAll('.output_product').length;
        $('#loading-modal').modal('show');
        $.ajax({
        url: '<?= base_url() ?>punching/add_output_product',
        type: 'POST',
        data: {
            id_lhp_punching: id_lhp_punching,
            barcode: barcode,
            coil_code: coil_code,
            type: type,
            qty: qty,
            berat: berat,
            // prod_time: prod_time,
            item: item,
            descrp: descrp,
            satuan: satuan,
            mesin: mesin,
            entry_date: entry_date,
            no_wo: no_wo,
            type_data_coil_code: type_data_coil_code,
            winder_data_coil_code: winder_data_coil_code,
            panjang_data_coil_code: panjang_data_coil_code,
            tebal_r_data_coil_code: tebal_r_data_coil_code,
            tebal_l_data_coil_code: tebal_l_data_coil_code,
            bending_data_coil_code: bending_data_coil_code,
            lebar_data_coil_code: lebar_data_coil_code,
            hasil_timbangan_data_coil_code: hasil_timbangan_data_coil_code,
            prod_time_data_coil_code: prod_time_data_coil_code,
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data === 'Gagal') {
                $('#loading-modal').modal('hide');
                alert('Data Tidak Ditemukan');
            } else {
            $('#tbody_data_output_product').append(`
                <tr class="output_product">
                    <td>
                        <input type="text" class="form-control" id="scan_qr_data_output_product_${baris}" name="scan_qr_data_output_product" value="${barcode}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="scan_qr_product_data_output_product_${baris}" name="scan_qr_product_data_output_product" value="${coil_code}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="type_product_data_output_product_${baris}" name="type_product_data_output_product" value="${type}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="qty_data_output_product_${baris}" name="qty_data_output_product" value="${qty}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="berat_data_output_product_${baris}" name="berat_data_output_product" value="${berat}" readonly>
                    </td>
                </tr>
            `);

            $('#scan_qr_wide_strip').val('');
            $('#id_coil_wide_strip').val('');
            $('#type_wide_strip').val('');
            $('#berat_wide_strip').val('');
            $('#panjang_wide_strip').val('');
            $('#prod_time_wide_strip').val('');
            $('#winder_wide_strip').val('');
            $('#loading-modal').modal('hide');
            }
        }
        });
    }

    function scanQrWideStripSisa() {
        document.addEventListener('keyup', function(event) {
            if (event.keyCode == 9) {
                get_data_coil_sisa();
            }
        });
    }

    function get_data_coil_sisa() {
        var barcode = $('#scan_qr_wide_strip_sisa').val();
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>punching/get_data_coil_output_product',
            type: 'POST',
            data: {
                barcode: barcode
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                if (data.length > 0) {
                    document.querySelector('.data_data_wide_strip_sisa').innerHTML = '';
                    $('.data_data_wide_strip_sisa').append(`
                        <input type="hidden" name="type_data_data_wide_strip_sisa" id="type_data_data_wide_strip_sisa" class="form-control" value="${data[0]['type']}">
                        <input type="hidden" name="winder_data_data_wide_strip_sisa" id="winder_data_data_wide_strip_sisa" class="form-control" value="${data[0]['winder']}">
                        <input type="hidden" name="panjang_data_data_wide_strip_sisa" id="panjang_data_data_wide_strip_sisa" class="form-control" value="${data[0]['panjang']}">
                        <input type="hidden" name="tebal_r_data_data_wide_strip_sisa" id="tebal_r_data_data_wide_strip_sisa" class="form-control" value="${data[0]['tebal_r']}">
                        <input type="hidden" name="tebal_l_data_data_wide_strip_sisa" id="tebal_l_data_data_wide_strip_sisa" class="form-control" value="${data[0]['tebal_l']}">
                        <input type="hidden" name="bending_data_data_wide_strip_sisa" id="bending_data_data_wide_strip_sisa" class="form-control" value="${data[0]['bending']}">
                        <input type="hidden" name="lebar_data_data_wide_strip_sisa" id="lebar_data_data_wide_strip_sisa" class="form-control" value="${data[0]['lebar']}">
                        <input type="hidden" name="hasil_timbangan_data_data_wide_strip_sisa" id="hasil_timbangan_data_data_wide_strip_sisa" class="form-control" value="${data[0]['hasil_timbangan']}">
                        <input type="hidden" name="prod_time_data_data_wide_strip_sisa" id="prod_time_data_data_wide_strip_sisa" class="form-control" value="${data[0]['prod_time']}">
                        <input type="hidden" name="berat_data_data_wide_strip_sisa" id="berat_data_data_wide_strip_sisa" class="form-control" value="${data[0]['berat']}">
                    `);
                    $('#id_coil_wide_strip_sisa').val(data[0].id_log);
                    $('#type_wide_strip_sisa').val(data[0].type);
                    $('#prod_time_wide_strip_sisa').val(data[0].prod_time);
                    $('#winder_wide_strip_sisa').val(data[0].winder);
                    $('#loading-modal').modal('hide');
                } else {
                    alert('Data Tidak Ditemukan');
                    $('#loading-modal').modal('hide');
                }
            }
        });
    }

    function add_wide_strip_sisa() {
        let id_lhp_punching = $('#id_lhp').val();
        let barcode = $('#scan_qr_wide_strip_sisa').val();
        let id_log = $('#id_coil_wide_strip_sisa').val();
        let type = $('#type_wide_strip_sisa').val();
        let berat = $('#berat_wide_strip_sisa').val();
        let panjang = $('#panjang_wide_strip_sisa').val();
        let prod_time = $('#prod_time_wide_strip_sisa').val();
        let winder = $('#winder_wide_strip_sisa').val();

        let type_data_data_wide_strip_sisa = $('#type_data_data_wide_strip_sisa').val();
        let winder_data_data_wide_strip_sisa = $('#winder_data_data_wide_strip_sisa').val();
        let panjang_data_data_wide_strip_sisa = $('#panjang_data_data_wide_strip_sisa').val();
        let tebal_r_data_data_wide_strip_sisa = $('#tebal_r_data_data_wide_strip_sisa').val();
        let tebal_l_data_data_wide_strip_sisa = $('#tebal_l_data_data_wide_strip_sisa').val();
        let bending_data_data_wide_strip_sisa = $('#bending_data_data_wide_strip_sisa').val();
        let lebar_data_data_wide_strip_sisa = $('#lebar_data_data_wide_strip_sisa').val();
        let hasil_timbangan_data_data_wide_strip_sisa = $('#hasil_timbangan_data_data_wide_strip_sisa').val();
        // let prod_time_data_data_wide_strip_sisa = $('#prod_time_data_data_wide_strip_sisa').val();
        let berat_data_data_wide_strip_sisa = $('#berat_data_data_wide_strip_sisa').val();

        let baris = document.querySelectorAll('.wide_strip_sisa').length;
        $('#loading-modal').modal('show');
        $.ajax({
        url: '<?= base_url() ?>punching/add_wide_strip_sisa',
        type: 'POST',
        data: {
            id_lhp_punching: id_lhp_punching,
            barcode: barcode,
            type: type,
            berat: berat,
            panjang: panjang,
            prod_time: prod_time,
            winder: winder,
            type_data_data_wide_strip_sisa: type_data_data_wide_strip_sisa,
            winder_data_data_wide_strip_sisa: winder_data_data_wide_strip_sisa,
            panjang_data_data_wide_strip_sisa: panjang_data_data_wide_strip_sisa,
            tebal_r_data_data_wide_strip_sisa: tebal_r_data_data_wide_strip_sisa,
            tebal_l_data_data_wide_strip_sisa: tebal_l_data_data_wide_strip_sisa,
            bending_data_data_wide_strip_sisa: bending_data_data_wide_strip_sisa,
            lebar_data_data_wide_strip_sisa: lebar_data_data_wide_strip_sisa,
            hasil_timbangan_data_data_wide_strip_sisa: hasil_timbangan_data_data_wide_strip_sisa,
            // prod_time_data_data_wide_strip_sisa: prod_time_data_data_wide_strip_sisa,
            berat_data_data_wide_strip_sisa: berat_data_data_wide_strip_sisa,
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if (data === 'Gagal') {
                $('#loading-modal').modal('hide');
                alert('Data Tidak Ditemukan');
            } else {
            $('#tbody_data_wide_strip_sisa').append(`
                <tr class="wide_strip_sisa">
                    <td>
                        <input type="text" class="form-control" id="scan_qr_data_wide_strip_sisa_${baris}" name="scan_qr_data_wide_strip_sisa" value="${barcode}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="type_data_wide_strip_sisa_${baris}" name="type_data_wide_strip_sisa" value="${type}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="berat_data_wide_strip_sisa_${baris}" name="berat_data_wide_strip_sisa" value="${berat}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="panjang_data_wide_strip_sisa_${baris}" name="panjang_data_wide_strip_sisa" value="${panjang}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="prod_time_data_wide_strip_sisa_${baris}" name="prod_time_data_wide_strip_sisa" value="${prod_time}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="winder_data_wide_strip_sisa_${baris}" name="winder_data_wide_strip_sisa" value="${winder}" readonly>
                    </td>
                </tr>
            `);

            $('#scan_qr_wide_strip').val('');
            $('#id_coil_wide_strip').val('');
            $('#type_wide_strip').val('');
            $('#berat_wide_strip').val('');
            $('#panjang_wide_strip').val('');
            $('#prod_time_wide_strip').val('');
            $('#winder_wide_strip').val('');
            $('#loading-modal').modal('hide');
            }
        }
        });
    }

    var numbers = [];
    console.log(numbers);
    function getNumbers(i) {
        if(numbers[i] === undefined) numbers[i] = 0;
        return numbers[i];
    }

    function rowDeleted(i) {
        if(numbers[i] !== undefined)
            numbers[i] = numbers[i] + 1;
        else
            numbers[i] = 1;
        return numbers[i];
    }

    function add_rows_batch(i) {
        let rowDeleted = getNumbers(i);
        let data_type_grid = <?php echo json_encode($data_type_grid); ?>;
        let tbodyElement = document.getElementById('tbody_hourly_report');

        let batchElement = document.querySelectorAll('#batch_' + i);
        batchElement = batchElement.length;
        let row = document.querySelectorAll('.row_' + i);
        let lastRow = row[row.length-1];
        let k = i + 1;
        let jam_start = $('#start_' + k + '_0').val();
        let jam_stop = $('#stop_' + i + '_0').val();
        let batchNumber = batchElement + rowDeleted;
        if(batchElement > 1) {
        jam_stop = $('#stop_' + i + '_' + (batchNumber - 1)).val();
        }
        lastRow = lastRow.rowIndex;
        // let totalRow = tbodyElement.rows.length;
        // let addRowAfter = lastRow + batchElement - 1;
        lastRow = tbodyElement.insertRow(lastRow);
        lastRow.classList.add('row_' + i);
            lastRow.innerHTML = `
        <td><button type="button" class="btn btn-sm btn-danger" onclick="delete_rows(this, ${i})">Remove</button></td>
        <td><input type="time" class="form-control" name="start[]" id="start_${i}_${batchNumber}" value="${jam_stop}" onkeyup="hitung_menit_terpakai(${i}, ${batchNumber})" style="width: 100px;"></td>
        <td><input type="time" class="form-control" name="stop[]" id="stop_${i}_${batchNumber}" value="${jam_start}" onkeyup="hitung_menit_terpakai(${i}, ${batchNumber})" style="width: 100px;"></td>
        <td><input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_${i}_${batchNumber}" onkeyup="update_plan(${i}, ${batchNumber})" value="" style="width: 100px"></td>
        <td>
            <select name="type_grid[]" id="type_grid_${i}_${batchNumber}" class="form-select select2 type_grid"
                onchange="get_plan(${i}, ${batchNumber})" style="width: 300px">
                <option value="">-- Pilih Type --</option>
                ${data_type_grid.map((item) => `<option value="${item.type_grid}">${item.type_grid}</option>`)}
            </select>
            <input type="hidden" name="batch[]" id="batch_${i}" value="${i}">
            <input type="hidden" name="id_detail_lhp_punching[]" id="id_detail_lhp_punching_${i}" value="">
        </td>
        <td>
            <input type="text" class="form-control" name="ct[]" id="ct_${i}_${batchNumber}" value="" style="width: 75px" readonly>
        </td>
        <td>
            <input type="number" class="form-control" name="plan[]" id="plan_${i}_${batchNumber}" value="" style="width: 100px" readonly>
        </td>
        <td>
            <input type="number" class="form-control" name="actual[]" id="actual_${i}_${batchNumber}" onkeyup="update_total_stop(${i}, ${batchNumber})" value="" style="width: 100px">
        </td>
        <td>
            <input type="number" class="form-control" name="total_stop[]" id="total_stop_${i}_${batchNumber}" value="" style="width: 100px" readonly>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-primary" id="add_breakdown_${i}_${batchNumber}" onclick="add_breakdown(${i})">Add</button>
        </td>
            `;

            $('.select2').select2();
        let hours = jam_start.split(':')[0] - jam_stop.split(':')[0];
        let minutes = jam_start.split(':')[1] - jam_stop.split(':')[1];
        if(minutes < 0) {
        hours--;
        minutes = 60 + minutes;
        }
        if(hours < 0) {
        hours = 24 + hours;
        }
        let menit_terpakai = hours * 60 + minutes;
        $('#menit_terpakai_' + i + '_' + batchNumber).val(menit_terpakai);
    }

    function get_plan(i, j) {
        let menit_terpakai = $('#menit_terpakai_' + i + '_' + j).val();
        let type_grid = $('#type_grid_' + i + '_' + j).val();
        console.log(type_grid);
        <?php foreach ($data_type_grid as $dtg) { ?>
        if (type_grid.toString() == "<?= str_replace(' ', '', trim($dtg['type_grid'])) ?>") {
            $('#ct_' + i + '_' + j).val(<?= trim($dtg['ct']) ?>);
            console.log(<?= floatval($dtg['ct']) ?>)
            $('#plan_' + i + '_' + j).val(Math.floor((menit_terpakai * 60) / <?= floatval(trim($dtg['ct'])) ?>))
        }
        <?php } ?>
        update_total_stop(i, j);
    }

    function update_plan(i, j) {
        var menit_terpakai = $('#menit_terpakai_' + i + '_' + j).val() * 60;
        var ct = $('#ct_' + i + '_' + j).val();
        var plan = Math.floor(menit_terpakai / ct);
        $('#plan_' + i + '_' + j).val(plan);

        update_total_stop(i, j);
    }

    function update_total_stop(i, j) {
        let menit_terpakai = $('#menit_terpakai_' + i + '_' + j).val();
        let ct = $('#ct_' + i + '_' + j).val();
        let actual = $('#actual_' + i + '_' + j).val();
        let plan = $('#plan_' + i + '_' + j).val();
        let total_stop = Math.floor(menit_terpakai - (plan - actual*(ct*60)));
        $('#total_stop_' + i + '_' + j).val(total_stop);
        console.log({menit_terpakai, ct, actual, plan})
    }

    function hitung_menit_terpakai(i, j) {
        let start = $('#start_' + i + '_' + j).val();
        let stop = $('#stop_' + i + '_' + j).val();

        let hours = stop.split(':')[0] - start.split(':')[0];
        let minutes = stop.split(':')[1] - start.split(':')[1];
        if(minutes < 0) {
        hours--;
        minutes = 60 + minutes;
        }
        if(hours < 0) {
        hours = 24 + hours;
        }
        let menit_terpakai = hours * 60 + minutes;
        $('#menit_terpakai_' + i + '_' + j).val(menit_terpakai);

        update_plan(i, j);
    }

    function delete_rows_db(e, i, j) {
        let id_detail_lhp_punching = $('#id_detail_lhp_punching_' + i + '_' + j).val();
        console.log(id_detail_lhp_punching)
        $.ajax({
        url: '<?= base_url() ?>punching/delete_rows',
        type: 'POST',
        data: {
            id_detail_lhp_punching: id_detail_lhp_punching
        },
        dataType: 'json',
        success: function(data) {
            rowDeleted(j);
            $(e).parent().parent().remove();
        }
        })
    }

    function delete_rows(e, i) {
        rowDeleted(i);
        $(e).parent().parent().remove();
    }

    function add_breakdown(i, j) {
        let data_line_stop = <?= json_encode($data_line_stop_punching); ?>;

        var start_breakdown = $('#start_' + i + '_' + j).val();
        var stop_breakdown = $('#stop_' + i + '_' + j).val();
        var type_grid = $('#type_grid_' + i + '_' + j).val();
        var id_detail_lhp_punching = $('#id_detail_lhp_punching_' + i + '_' + j).val();
        // var no_wo_breakdown = $('#no_wo_' + i).val();


        var tbody = document.getElementById('tbody_data_line_stop');

        var row = tbody.rows.length;


        $('#tbody_data_line_stop').append(`
                <tr>
                    <td>
                        <input type="time" class="form-control" name="start_breakdown[]" id="start_breakdown_${row}" value="${start_breakdown}" style="width: 100px;">
                    </td>
                    <td>
                        <input type="time" class="form-control" name="stop_breakdown[]" id="stop_breakdown_${row}" value="${stop_breakdown}" style="width: 100px;">
                    </td>
                    <td>
                        <input type="hidden" class="form-control" name="id_breakdown[]" id="id_breakdown_${row}" value="">
                        <input type="hidden" class="form-control" name="id_detail_lhp_punching_breakdown[]" id="id_detail_lhp_punching_breakdown_${row}" value="${id_detail_lhp_punching}">
                        <input type="text" class="form-control" name="type_grid_line_stop[]" id="type_grid_line_stop_${row}" value="${type_grid}" style="width: 225px" readonly>
                    </td>
                    <td>
                        <select class="form-control select2" name="kategori_line_stop[]" id="kategori_line_stop_${row}" onchange="get_jenis_line_stop(${row})" style="width: 200px">
                            <option value="">Pilih Kategori Line Stop</option>
                            ${data_line_stop.map((item) => {
                                return `<option value="${item.kategori_line_stop}">${item.kategori_line_stop}</option>`;
                            }).join('')}
                        </select>
                    </td>
                    <td>
                        <select class="form-control select2" id="jenis_line_stop_${row}" name="jenis_line_stop[]" style="width: 200px;">
                            <option selected disabled>-- Pilih Jenis Line Stop --</option>
                        </select>
                    </td>
                    <td>
                        <textarea class="form-control" name="uraian_line_stop[]" id="uraian_line_stop_${row}" cols="20" rows="1" style="width: 200px;"></textarea>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="menit_breakdown[]" id="menit_breakdown_${row}" style="width: 75px">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="delete_breakdown(${row})"><i class="fa fa-trash"></i></button>	
                    </td>
                </tr>
            `);

        $('.select2').select2();

        $('html, body').animate({
            scrollTop: $('#ls_section').offset().top
        }, 500);
    }

    function delete_breakdown(i) {
        let tbody = document.getElementById('tbody_data_line_stop');
        tbody.deleteRow(i);
    }

    function add_note(type_grid, actual, id_lhp_punching, index) {
        let note_punchingElement = document.querySelector('#note_punching');
        let id_summary_note = document.querySelector('#id_summary_' + index).value;
        note_punchingElement.innerHTML = `
        <input type="hidden" name="id_lhp_punching_note" id="id_lhp_punching_note" value="${id_lhp_punching}">
        <input type="hidden" name="actual_note" id="actual_note" value="${actual}">
        <input type="hidden" name="type_grid_note" id="type_grid_note" value="${type_grid}">
        <input type="hidden" name="id_summary_note" id="id_summary_note" value="${id_summary_note}">
        <input type="hidden" name="index" id="index" value="${index}">
        <div class="mb-3">
            <label for="text_note" class="form-label">Note</label>
            <textarea class="form-control" id="text_note" rows="3"></textarea>
        </div>
        `;
        let add_note_punchingElement = document.querySelector('#add_note_punching');
        add_note_punchingElement.innerHTML = `
        <button type="button" class="btn btn-primary float-end" onclick="add_note_punching()" data-bs-dismiss="modal">Tambah</button>
        `;
    }

    function add_note_punching() {
        let id_lhp_punching_note = $('#id_lhp_punching_note').val();
        let actual_note = $('#actual_note').val();
        let type_grid_note = $('#type_grid_note').val();
        let text_note = $('#text_note').val();
        let id_summary_note = $('#id_summary_note').val();
        let index = $('#index').val();
        console.log({id_lhp_punching_note, actual_note, type_grid_note, text_note});
        $.ajax({
        url: '<?= base_url() ?>punching/add_note_punching',
        type: 'POST',
        data: {
            id_lhp_punching_note: id_lhp_punching_note,
            type_grid_note: type_grid_note,
            text_note: text_note,
            id_summary_note: id_summary_note,
        },
        dataType: 'json',
        success: function(data) {
            document.querySelector('.' + type_grid_note).innerHTML = `
            <td>${type_grid_note}</td>
            <td>${actual_note}</td>
            <td>
                ${text_note}
                <input type="hidden" class="form-control" name="id_summary" id="id_summary_${index}" value="${data}">
            </td>
            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_note_punching" onclick="add_note(${type_grid_note}, ${actual_note}, ${text_note}, ${index})">
                Add
            </button></td>
            `;
        }
        });
    }
</script>
<?= $this->endSection(); ?>