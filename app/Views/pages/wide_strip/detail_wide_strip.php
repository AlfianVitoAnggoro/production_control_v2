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
                        <!-- <a href="<?= base_url() ?>grid/detail_lhp_grid_print_view/<?= $id_lhp ?>" target="_blank" class="btn btn-danger">Print</a> -->
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
                                    <div class="col-6">
                                        <h4>Material In</h4>
                                        <br>
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
                                                    Item
                                                    <input type="text" class="form-control" name="item_material_in" id="item_material_in" readonly>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" onclick="add_material_in()">Add</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <h4>Material In MLR</h4>
                                        <br>
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    Type
                                                    <input type="text" class="form-control" name="material_in_mlr" id="material_in_mlr">
                                                </td>
                                                <td>
                                                    QTY
                                                    <input type="text" class="form-control" name="qty_material_in_mlr" id="qty_material_in_mlr">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" onclick="add_material_in_mlr()">Add</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table id="data" class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Barcode</th>
                                                        <th>QTY</th>
                                                        <th>Item</th>
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
                                                            <input type="text" class="form-control" id="item_material_in_<?= $number ?>" value="<?= $d_ct['item_material_in'] ?>" readonly>
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
                                    <div class="col-6">
                                        <div class="table-responsive">
                                            <table id="data_material_mlr" class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>QTY</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_material_in_mlr">
                                                <?php $number = 0;
                                                foreach ($data_material_in_mlr as $d_mlr) { ?>
                                                    <tr class="material_in_mlr">
                                                        <td>
                                                            <input type="text" class="form-control" id="material_in_mlr_<?= $number ?>" value="<?= $d_mlr['type'] ?>" readonly>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="qty_material_in_mlr_<?= $number ?>" value="<?= $d_mlr['qty'] ?>" readonly>
                                                                <span class="input-group-text">Kg</span>
                                                            </div>
                                                            <input type="hidden" class="form-control" id="id_material_in_mlr_<?= $number ?>" value="<?= $d_mlr['id'] ?>" readonly>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="delete_material_in_mlr(this, <?= $number ?>)">Delete</button>
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
                            <div class="box-header">
                                <h4>Level Melting Pot</h4>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table id="data" class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Melting Pot</th>
                                                        <th>Awal Shift (Kg)</th>
                                                        <th>Akhir Shift (Kg)</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="data_level_melting_pot">
                                                    <tr>
                                                        <td>
                                                            1
                                                            <input type="hidden" class="form-control" name="no[]" id="no_0" value="<?= $data_level_melting_pot[0]['no']  ?? 1?>">
                                                            <input type="hidden" class="form-control" name="id_level_melting_pot[]" id="id_level_melting_pot_0" value="<?= $data_level_melting_pot[0]['id']  ?? ''?>">
                                                        </td>
                                                        <td>
                                                            Positif (CH5)
                                                            <input type="hidden" class="form-control" name="melting_pot[]" id="keterangan_0" value="<?= $data_level_melting_pot[0]['keterangan']  ?? 'Positif (CH5)' ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="awal_shift[]" id="awal_shift_0" value="<?= $data_level_melting_pot[0]['awal_shift']  ?? ''?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="akhir_shift[]" id="akhir_shift_0" value="<?= $data_level_melting_pot[0]['akhir_shift'] ?? '' ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            2
                                                            <input type="hidden" class="form-control" name="no[]" id="no_1" value="<?= $data_level_melting_pot[1]['no']  ?? 2?>">
                                                            <input type="hidden" class="form-control" name="id_level_melting_pot[]" id="id_level_melting_pot_1" value="<?= $data_level_melting_pot[1]['id']  ?? ''?>">
                                                        </td>
                                                        <td>
                                                            Negatif (CH4)
                                                            <input type="hidden" class="form-control" name="melting_pot[]" id="keterangan_1" value="<?= $data_level_melting_pot[1]['keterangan']  ?? 'Negatif (CH5)' ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="awal_shift[]" id="awal_shift_1" value="<?= $data_level_melting_pot[1]['awal_shift']  ?? ''?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="akhir_shift[]" id="akhir_shift_1" value="<?= $data_level_melting_pot[1]['akhir_shift'] ?? '' ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            3
                                                            <input type="hidden" class="form-control" name="no[]" id="no_2" value="<?= $data_level_melting_pot[2]['no']  ?? 3?>">
                                                            <input type="hidden" class="form-control" name="id_level_melting_pot[]" id="id_level_melting_pot_2" value="<?= $data_level_melting_pot[2]['id']  ?? ''?>">
                                                        </td>
                                                        <td>
                                                            Scrap Positif
                                                            <input type="hidden" class="form-control" name="melting_pot[]" id="keterangan_0" value="<?= $data_level_melting_pot[0]['keterangan']  ?? 'Scrap Positif' ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="awal_shift[]" id="awal_shift_2" value="<?= $data_level_melting_pot[2]['awal_shift']  ?? ''?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="akhir_shift[]" id="akhir_shift_2" value="<?= $data_level_melting_pot[2]['akhir_shift'] ?? '' ?>">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            4
                                                            <input type="hidden" class="form-control" name="no[]" id="no_3" value="<?= $data_level_melting_pot[3]['no']  ?? 4?>">
                                                            <input type="hidden" class="form-control" name="id_level_melting_pot[]" id="id_level_melting_pot_3" value="<?= $data_level_melting_pot[3]['id']  ?? ''?>">
                                                        </td>
                                                        <td>
                                                            Scrap Negatif
                                                            <input type="hidden" class="form-control" name="melting_pot[]" id="keterangan_3" value="<?= $data_level_melting_pot[3]['keterangan']  ?? 'Scrap Negatif' ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="awal_shift[]" id="awal_shift_3" value="<?= $data_level_melting_pot[3]['awal_shift']  ?? ''?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="akhir_shift[]" id="akhir_shift_3" value="<?= $data_level_melting_pot[3]['akhir_shift'] ?? '' ?>">
                                                        </td>
                                                    </tr>
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
                                    <table id="hourly_report" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <!-- <th>#</th> -->
                                                <th>Jam Start</th>
                                                <th>Jam End</th>
                                                <th>Menit Terpakai</th>
                                                <th>Coil Code</th>
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
                                                                <td style="display:none">
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
                                                                <td style="display:none">
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
                                                                <td style="display:none">
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
                                                                    <select name="coil_code[]" id="coil_code_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" class="form-select select2 coil_code" style="width: 300px">
                                                                        <option value="">-- Pilih Coil --</option>
                                                                        <?php
                                                                        foreach ($data_coil_code as $d_coil_code) {
                                                                        ?>
                                                                            <option value="<?= str_replace(' ', '', $d_coil_code['coil_code']) ?>" <?= $d_coil_code['coil_code'] == $data_detail_lhp[$i]['coil_code'] ? 'selected' : '' ?>><?= $d_coil_code['coil_code'] ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <!-- <input type="hidden" name="batch[]" id="batch_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>" value="<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>"> -->
                                                                    <input type="hidden" name="batch[]" id="batch_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>" value="">
                                                                    <input type="hidden" name="id_detail_lhp_wide_strip[]" id="id_detail_lhp_wide_strip_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['id_detail_lhp_wide_strip'] ?>">
                                                                </td>
                                                                <td>
                                                                    <select name="type_wist[]" id="type_wist_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" onchange="get_ct(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>,<?= $number ?>)" class="form-select select2" style="width: 300px">
                                                                        <option value="">-- Pilih Type Wist --</option>
                                                                        <option value="WIST NEG" <?= 'WIST NEG' == $data_detail_lhp[$i]['type_wist'] ? 'selected' : '' ?>>WIST NEG</option>
                                                                        <option value="WIST POS" <?= 'WIST POS' == $data_detail_lhp[$i]['type_wist'] ? 'selected' : '' ?>>WIST POS</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="ct[]" id="ct_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['ct'] ?>" style="width: 75px" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control" name="plan[]" id="plan_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['plan_ws'] ?>" style="width: 100px" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control" name="actual[]" id="actual_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" onkeyup="update_total_stop(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)" value="<?= $data_detail_lhp[$i]['actual'] ?>" style="width: 100px">
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control" name="total_stop[]" id="total_stop_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" value="<?= $data_detail_lhp[$i]['total_stop'] ?>" style="width: 75px" readonly>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-sm btn-primary" id="add_breakdown_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" onclick="add_breakdown(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>, <?= $data_detail_lhp[$i]['id_detail_lhp_wide_strip'] !== NULL ? $data_detail_lhp[$i]['id_detail_lhp_wide_strip'] : '' ?>)">Add</button>
                                                                </td>
                                                                <!-- <td>
                                                                    <button type="button" class="btn btn-sm btn-primary" id="add_reject_<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>_<?= $number ?>" onclick="add_reject(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>, <?= $number ?>)">Add</button>
                                                                </td> -->
                                                            </tr>
                                            <?php } 
                                            if (count($data_detail_lhp) <= count($jam_start)) {
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
                                                            <select name="coil_code[]" id="coil_code_<?= $i ?>_0" class="form-select select2" style="width: 300px">
                                                                <option value="">-- Pilih Coil --</option>
                                                                <?php foreach ($data_coil_code as $d_coil_code) { ?>
                                                                    <option value="<?= str_replace(' ', '', $d_coil_code['coil_code']) ?>"><?= $d_coil_code['coil_code'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <!-- <input type="hidden" name="batch[]" id="batch_<?=$i?>" value="<?=$i?>"> -->
                                                            <input type="hidden" name="batch[]" id="batch_<?=$i?>" value="">
                                                            <input type="hidden" name="id_detail_lhp_wide_strip[]" id="id_detail_lhp_wide_strip_<?= $i ?>_0" value="">
                                                        </td>
                                                        <td>
                                                            <select name="type_wist[]" id="type_wist_<?= $i ?>_0" onchange="get_ct(<?= $data_detail_lhp[$i]['batch'] !== NULL ? $data_detail_lhp[$i]['batch'] : $i ?>,0)" class="form-select select2" style="width: 300px">
                                                                <option value="">-- Pilih Type Wist --</option>
                                                                <option value="WIST NEG">WIST NEG</option>
                                                                <option value="WIST POS">WIST POS</option>
                                                            </select>
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
                                                            <input type="number" class="form-control" name="total_stop[]" id="total_stop_<?= $i ?>_0" style="width: 75px" readonly>
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
                                                <td style="text-align: right;"><input type="text" class="form-control" name="total_total_stop" id="" value="<?= $data_lhp[0]['total_stop'] ?>" style="width: 75px" readonly></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4>Output Product</h4>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Coil Code</th>
                                                <th>Type</th>
                                                <th>Winder</th>
                                                <th>Panjang</th>
                                                <th>Tebal</th>
                                                <th>Bending</th>
                                                <th>Lebar</th>
                                                <th>Hasil Timbangan</th>
                                                <th>Berat</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                        <?php $model = new App\Models\M_WideStrip();
                                            $index_output_product = 0;
                                            foreach($output_product as $d_output_product){
                                            $data_output_product = $model->get_data_output_product($id_lhp, $d_output_product['coil_code'], $d_output_product['type_wist']);
                                            if(count($data_output_product) > 0) {
                                        ?>
                                            <tr class="<?= $data_output_product[0]['coil_code'] ?>">
                                                <td><?= $index_output_product + 1 ?></td>
                                                <td>
                                                    <input type="text" class="form-control" name="coil_code_output_product[]" id="coil_code_output_product_<?= $index_output_product ?>" value ="<?= $data_output_product[0]['coil_code'] ?>" readonly>
                                                    <input type="hidden" class="form-control" name="id_output_product[]" id="id_output_product_<?= $index_output_product ?>" value ="<?= $data_output_product[0]['id_log'] ?>">
                                                </td>
                                                <td><input type="text" class="form-control" name="type_wist_output_product[]" id="type_wist_output_product_<?= $index_output_product ?>" value ="<?= $data_output_product[0]['type'] ?>" readonly></td>
                                                <td>
                                                    <select class="form-select" name="winder_output_product[]" id="winder_output_product_<?= $index_output_product ?>" style="width: 150px;">
                                                        <option value="">--Pilih Winder--</option>
                                                        <option value="1" <?= $data_output_product[0]['winder'] === 1 ? 'selected' : '' ?>>1</option>
                                                        <option value="2" <?= $data_output_product[0]['winder'] === 2 ? 'selected' : '' ?>>2</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="panjang_output_product[]" id="panjang_output_product_<?= $index_output_product ?>" value ="<?= $data_output_product[0]['panjang'] ?>" readonly></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <input type="number" class="form-control" name="tebal_r_output_product[]" id="tebal_r_output_product_<?= $index_output_product ?>" value ="<?= $data_output_product[0]['tebal_r'] ?>" placeholder="R">
                                                        <input type="number" class="form-control" name="tebal_l_output_product[]" id="tebal_l_output_product_<?= $index_output_product ?>" value ="<?= $data_output_product[0]['tebal_l'] ?>" placeholder="L">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="bending_output_product[]" id="bending_output_product_<?= $index_output_product ?>" value="<?= $data_output_product[0]['bending'] ?>">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="lebar_output_product[]" id="lebar_output_product_<?= $index_output_product ?>" value="<?= $data_output_product[0]['lebar'] ?>">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="hasil_timbangan_output_product[]" id="hasil_timbangan_output_product_<?= $index_output_product ?>" value="<?= $data_output_product[0]['hasil_timbangan'] ?>">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="berat_output_product[]" id="berat_output_product_<?= $index_output_product ?>" value="<?= $data_output_product[0]['berat'] ?>" readonly>
                                                </td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr class="<?= $d_output_product['coil_code'] ?>">
                                                <td><?= $index_output_product + 1 ?></td>
                                                <td>
                                                    <input type="text" class="form-control" name="coil_code_output_product[]" id="coil_code_output_product_<?= $index_output_product ?>" value ="<?= $d_output_product['coil_code'] ?>" readonly>
                                                    <input type="hidden" class="form-control" name="id_output_product[]" id="id_output_product_<?= $index_output_product ?>" value ="">
                                                </td>
                                                <td><input type="text" class="form-control" name="type_wist_output_product[]" id="type_wist_output_product_<?= $index_output_product ?>" value ="<?= $d_output_product['type_wist'] ?>" readonly></td>
                                                <td>
                                                    <select class="form-select" name="winder_output_product[]" id="winder_output_product_<?= $index_output_product ?>" style="width: 150px;">
                                                        <option value="" selected>--Pilih Winder--</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="panjang_output_product[]" id="panjang_output_product_<?= $index_output_product ?>" value ="<?= $d_output_product['actual'] ?>" readonly></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <input type="number" class="form-control" name="tebal_r_output_product[]" id="tebal_r_output_product_<?= $index_output_product ?>" placeholder="R">
                                                        <input type="number" class="form-control" name="tebal_l_output_product[]" id="tebal_l_output_product_<?= $index_output_product ?>" placeholder="L">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="bending_output_product[]" id="bending_output_product_<?= $index_output_product ?>">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="lebar_output_product[]" id="lebar_output_product_<?= $index_output_product ?>">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="hasil_timbangan_output_product[]" id="hasil_timbangan_output_product_<?= $index_output_product ?>">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="berat_output_product[]" id="berat_output_product_<?= $index_output_product ?>" readonly>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php $index_output_product++; } ?>
                                        </tbody>
                                    </table>
                                </div>
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
                                                <th>Coil Code</th>
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
                                                <tr class="row_line_stop">
                                                    <td>
                                                        <input type="time" class="form-control" name="start_breakdown[]" id="start_breakdown_<?= $index_breakdown ?>" value="<?= date("H:i", strtotime($d_breakdown['jam_start'])) ?>" style="width: 100px;">
                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control" name="stop_breakdown[]" id="stop_breakdown_<?= $index_breakdown ?>" value="<?= date("H:i", strtotime($d_breakdown['jam_end'])) ?>" style="width: 100px;">
                                                    </td>
                                                    <td>
                                                        <input type="hidden" class="form-control" name="id_breakdown[]" id="id_breakdown_<?= $index_breakdown ?>" value="<?= $d_breakdown['id_breakdown_ws'] ?>">
                                                        <input type="hidden" class="form-control" name="id_detail_lhp_breakdown[]" id="id_detail_lhp_breakdown_<?= $index_breakdown ?>" value="<?= $d_breakdown['id_detail_lhp_ws'] ?>">
                                                        <input type="text" class="form-control" name="coil_code_line_stop[]" id="coil_code_line_stop_<?= $index_breakdown ?>" value="<?= $d_breakdown['coil_code'] ?>" style="width: 150px" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="type_line_stop[]" id="type_line_stop_<?= $index_breakdown ?>" value="<?= $d_breakdown['type'] ?>" style="width: 150px" readonly>
                                                    </td>
                                                    <td>
                                                        <select class="form-control select2" name="kategori_line_stop[]" id="kategori_line_stop_<?= $index_breakdown ?>" onchange="get_jenis_line_stop(<?= $index_breakdown ?>)" style="width: 200px">
                                                            <option value="">Pilih Kategori Line Stop</option>
                                                            <?php foreach ($data_line_stop_ws as $d_kategori_line_stop) { ?>
                                                                <option value="<?= $d_kategori_line_stop['kategori_line_stop'] ?>" <?= $d_kategori_line_stop['kategori_line_stop'] == $d_breakdown['kategori_line_stop'] ? 'selected' : '' ?>><?= $d_kategori_line_stop['kategori_line_stop'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control select2" id="jenis_line_stop_<?= $index_breakdown ?>" name="jenis_line_stop[]" style="width: 200px;">
                                                            <option selected disabled>-- Pilih Jenis Line Stop --</option>
                                                            <?php $data_jenis_line_stop = $model->getListJenisLineStopWS($d_breakdown['kategori_line_stop']);
                                                                foreach ($data_jenis_line_stop as $d_jenis_line_stop) {
                                                            ?>
                                                                    <option value="<?= $d_jenis_line_stop['jenis_line_stop'] ?>" <?= $d_jenis_line_stop['jenis_line_stop'] == $d_breakdown['jenis_line_stop'] ? 'selected' : '' ?>><?= $d_jenis_line_stop['jenis_line_stop'] ?></option>
                                                            <?php } ?>
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
                                            
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="box-footer" style="text-align: center;">
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
                                                        
                                                        <input type="hidden" class="form-control" name="id_log_detail_record_rak[]" id="id_log_detail_record_rak_<?= $number ?>" value="<?= $d_rak['id_log'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="qty_rak[]" id="qty_rak_<?= $number ?>" value="<?= $d_rak['qty'] ?>" readonly>
                                                    </td>
                                                    <td>
                                                        
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
                            </td> -->
                            <!-- <td>
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
    // <?php //if ($session <= 2) { ?>
    //     const approvedElement = document.querySelector('#approved');
    //     approvedElement.removeAttribute('disabled');
    // <?php //} ?>
    // <?php //if ($session <= 4) { ?>
    //     const completedElement = document.querySelector('#completed');
    //     completedElement.removeAttribute('disabled');
    // <?php //} ?>

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

    // function add_breakdown() {
    //     let data_line_stop = <?= json_encode($data_line_stop_ws) ?>;
    //     let row = document.querySelectorAll('.row_line_stop').length;
    //     $('#tbody_data_line_stop').append(`
    //         <tr class="row_line_stop">
    //             <td>
    //                 <select name="urutan_produksi_breakdown[]" id="urutan_produksi_breakdown_ws_${row}" class="form-select select2" style="width: 150px">
    //                     <option value="">-- Pilih Urutan --</option>
    //                     <option value="1">1</option>
    //                     <option value="2">2</option>
    //                     <option value="3">3</option>
    //                     <option value="4">4</option>
    //                     <option value="5">5</option>
    //                     <option value="6">6</option>
    //                     <option value="7">7</option>
    //                     <option value="8">8</option>
    //                     <option value="9">9</option>
    //                     <option value="10">10</option>
    //                     <option value="11">11</option>
    //                     <option value="12">12</option>
    //                 </select>
    //                 <input type="hidden" name="id_detail_lhp_ws_breakdown[]">
    //             </td>
    //             <td>
    //                 <select class="form-control select2" name="kategori_breakdown_ws[]" id="kategori_breakdown_ws_${row}" onchange="get_jenis_line_stop(${row})" style="width: 200px">
	// 					<option value="">Pilih Kategori Line Stop</option>
	// 					${data_line_stop.map((item) => {
	// 						return `<option value="${item.kategori_line_stop}">${item.kategori_line_stop}</option>`;
	// 					}).join('')}
	// 				</select>
    //             <td>
	// 				<select class="form-control select2" id="jenis_breakdown_ws_${row}" name="jenis_breakdown_ws[]" style="width: 200px;">
    //                     <option selected disabled>-- Pilih Jenis Line Stop --</option>
    //                 </select>
	// 			</td>
	// 			</td>
    //             <td>
    //                 <input type="text" class="form-control" name="uraian_breakdown_ws[]" id="uraian_breakdown_ws_${row}" class="form-control" style="width: 300px">
    //             </td>
    //             <td>
    //                 <input type="text" class="form-control" name="total_menit_breakdown_ws[]" id="total_menit_breakdown_ws_${row}" class="form-control" style="width: 75px">
    //             </td>
    //             <td>
    //                 <button type="button" class="btn btn-danger" onclick="delete_breakdown(this)">Delete</button>
    //             </td>
    //         </tr>
    //     `);

    //     $('.select2').select2();
    // }

    function get_jenis_line_stop(i) {
        let kategori_line_stop = $('#kategori_line_stop_' + i).val();
        $.ajax({
            url: '<?= base_url() ?>wide_strip/get_jenis_line_stop',
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

    function delete_breakdown(i) {
        let tbody = document.getElementById('tbody_data_line_stop');
        tbody.deleteRow(i);
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
                <option value="">-- Pilih Coil --</option>
                <?php
                foreach ($data_coil_code as $d_coil_code) {
                ?>
                    <option value="<?= $d_coil_code['id'] ?>"><?= $d_coil_code['coil_code'] ?></option>
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
                    $('#item_material_in').val(data[0].item);
                }
            }
        })
    }

    function add_material_in() {
        let id_lhp = document.querySelector('#id_lhp').value;
        let material_in = document.querySelector('#material_in').value;
        let qty_material_in = document.querySelector('#qty_material_in').value;
        let item_material_in = document.querySelector('#item_material_in').value;
        let baris = document.querySelectorAll('.material_in').length;
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>wide_strip/material_in',
            type: 'POST',
            data: {
                id_lhp: id_lhp,
                material_in: material_in,
                qty_material_in: qty_material_in,
                item_material_in: item_material_in,
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
                                <input type="text" class="form-control" id="item_material_in_${baris}" value="${item_material_in}" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_material_in(this, ${baris})">Delete</button>
                            </td>
                        </tr>
                    `);
                    $('#material_in').val('');
                    $('#qty_material_in').val('');
                    $('#item_material_in').val('');
                    $('#loading-modal').modal('hide');
                    $('#material_in').focus();
                }
            }
        })
    }

    function add_material_in_mlr() {
        let id_lhp = document.querySelector('#id_lhp').value;
        let material_in_mlr = document.querySelector('#material_in_mlr').value;
        let qty_material_in_mlr = document.querySelector('#qty_material_in_mlr').value;
        let baris = document.querySelectorAll('.material_in_mlr').length;
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>wide_strip/material_in_mlr',
            type: 'POST',
            data: {
                id_lhp: id_lhp,
                material_in_mlr: material_in_mlr,
                qty_material_in_mlr: qty_material_in_mlr,
            },
            dataType: 'json',
            success: function(data) {
                if(data > 0) {
                    $('#tbody_material_in_mlr').append(`
                        <tr class="material_in_mlr">
                            <td>
                                <input type="text" class="form-control" id="material_in_mlr_${baris}" value="${material_in_mlr}" readonly>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="qty_material_in_mlr_${baris}" value="${qty_material_in_mlr}" readonly>
                                    <span class="input-group-text">Kg</span>
                                </div>
                                <input type="hidden" class="form-control" id="id_material_in_mlr_${baris}" value="${data}" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_material_in_mlr(this, ${baris})">Delete</button>
                            </td>
                        </tr>
                    `);
                    $('#material_in_mlr').val('');
                    $('#qty_material_in_mlr').val('');
                    $('#loading-modal').modal('hide');
                    $('#material_in_mlr').focus();
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

    function delete_material_in_mlr(e, baris) {
        let id_material_in = $('#id_material_in_mlr_' + baris).val();
        $('#loading-modal').modal('show');
        $.ajax({
            url: '<?= base_url() ?>wide_strip/delete_material_in_mlr',
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

    let numbersDeleted = [];
    function getNumbers(i) {
        if(numbersDeleted[i] === undefined)
            numbersDeleted[i] = 0;
        return numbersDeleted[i];
    }

    function deletedRow(i) {
        if(numbersDeleted[i] !== undefined)
        numbersDeleted[i] = numbersDeleted[i] + 1;
        else
        numbersDeleted[i] = 1;
        return numbersDeleted[i];
    }

    function add_rows_batch(i) {
        let rowDeleted = getNumbers(i);
        let data_coil_code = <?php echo json_encode($data_coil_code); ?>;
        let tbodyElement = document.getElementById('tbody_hourly_report');
        console.log({rowDeleted, data_coil_code, tbodyElement})

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
        lastRow = tbodyElement.insertRow(lastRow);
        lastRow.classList.add('row_' + i);
        lastRow.innerHTML = `
        <td><button type="button" class="btn btn-sm btn-danger" onclick="delete_rows(this, ${i})">Remove</button></td>
        <td><input type="time" class="form-control" name="start[]" id="start_${i}_${batchNumber}" value="${jam_stop}" onkeyup="hitung_menit_terpakai(${i}, ${batchNumber})" style="width: 100px;"></td>
        <td><input type="time" class="form-control" name="stop[]" id="stop_${i}_${batchNumber}" value="${jam_start}" onkeyup="hitung_menit_terpakai(${i}, ${batchNumber})" style="width: 100px;"></td>
        <td><input type="number" class="form-control" name="menit_terpakai[]" id="menit_terpakai_${i}_${batchNumber}" onkeyup="update_plan(${i}, ${batchNumber})" value="" style="width: 100px"></td>
        <td>
            <select name="coil_code[]" id="coil_code_${i}_${batchNumber}" class="form-select select2 coil_code"
                onchange="get_plan(${i}, ${batchNumber})" style="width: 300px">
                <option value="">-- Pilih Coil --</option>
                ${data_coil_code.map((item) => `<option value="${item.coil_code}">${item.coil_code}</option>`)}
            </select>
            <input type="hidden" name="batch[]" id="batch_${i}" value="">
            <input type="hidden" name="id_detail_lhp_wide_strip[]" id="id_detail_lhp_wide_strip_${i}" value="">
        </td>
        <td>
            <select name="type_wist[]" id="type_wist_${i}_${batchNumber}" onchange="get_ct(${i},${batchNumber})" class="form-select select2" style="width: 300px">
                <option selected value="">-- Pilih Type Wist --</option>
                <option value="WIST NEG">WIST NEG</option>
                <option value="WIST POS">WIST POS</option>
            </select>
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
            <input type="number" class="form-control" name="total_stop[]" id="total_stop_${i}_${batchNumber}" value="" style="width: 75px" readonly>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-primary" id="add_breakdown_${i}_${batchNumber}" onclick="add_breakdown(${i}, '')">Add</button>
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

    function get_plan(i, j) {
        let menit_terpakai = $('#menit_terpakai_' + i + '_' + j).val();
        let coil_code = $('#coil_code_' + i + '_' + j).val();
        console.log({menit_terpakai, coil_code})
        <?php foreach ($data_coil_code as $dtg) { ?>
        if (coil_code.toString() == "<?= str_replace(' ', '', trim($dtg['coil_code'])) ?>") {
            $('#ct_' + i + '_' + j).val('');
            $('#plan_' + i + '_' + j).val('')
        }
        <?php } ?>
    }

    function update_plan(i, j) {
        let menit_terpakai = $('#menit_terpakai_' + i + '_' + j).val() * 60;
        let ct = $('#ct_' + i + '_' + j).val();
        let plan = Math.floor(menit_terpakai / ct);
        $('#plan_' + i + '_' + j).val(plan);

        // update_total_stop(i, j);
    }

    function update_total_stop(i, j) {
        let menit_terpakai = $('#menit_terpakai_' + i + '_' + j).val();
        let ct = $('#ct_' + i + '_' + j).val();
        let actual = $('#actual_' + i + '_' + j).val();
        let plan = Math.floor(menit_terpakai / ct);
        // console.log({menit_terpakai, ct, actual, plan})
        get_total_line_stop(i, j);
    }

    function add_breakdown(i, j, id_detail_lhp) {
        let mesin_pasting = $('#mesin_pasting').val();
        let data_line_stop = <?= json_encode($data_line_stop_ws); ?>;

        var start_breakdown = $('#start_' + i + '_' + j).val();
        var stop_breakdown = $('#stop_' + i + '_' + j).val();
        var coil_code = $('#coil_code_' + i + '_' + j).val();
        var type = $('#type_wist_' + i + '_' + j).val();
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
                        <input type="hidden" class="form-control" name="id_detail_lhp_breakdown[]" id="id_detail_lhp_breakdown_${row}" value="${id_detail_lhp}">
                        <input type="text" class="form-control" name="coil_code_line_stop[]" id="coil_code_line_stop_${row}" value="${coil_code}" style="width: 150px" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="type_line_stop[]" id="type_line_stop_${row}" value="${type}" style="width: 150px" readonly>
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

    function delete_rows_db(e, i, j) {
        let id_detail_lhp_wide_strip = $('#id_detail_lhp_wide_strip_' + i).val();
        $.ajax({
        url: '<?= base_url() ?>wide_strip/delete_rows',
        type: 'POST',
        data: {
            id_detail_lhp_wide_strip: id_detail_lhp_wide_strip
        },
        dataType: 'json',
        success: function(data) {
            // if(data === 'Success')
            deletedRow(j);
            $(e).parent().parent().remove();
            // else
            // alert('Data Gagal Dihapus');
            // var tbody = document.getElementById('tbody');
            // tbody.deleteRow(i);
        }
        })
    }

    function delete_rows(e, i) {
        deletedRow(i);
        $(e).parent().parent().remove();
    }

    function get_ct(i,j)
    {
        var type_wist = $('#type_wist_'+i+'_'+j).val();
        var plan;
        if (type_wist == 'WIST NEG') {
            $('#ct_'+i+'_'+j).val('0.53');
            plan = parseFloat(parseInt($('#menit_terpakai_'+i+'_'+j).val()) * 60) * parseFloat(0.53);
        } else if (type_wist == 'WIST POS') {
            $('#ct_'+i+'_'+j).val('0.42');
            plan = parseFloat(parseInt($('#menit_terpakai_'+i+'_'+j).val()) * 60) * parseFloat(0.42);
        }

        $('#plan_'+i+'_'+j).val(plan);
        $('#total_stop_'+i+'_'+j).val($('#menit_terpakai_'+i+'_'+j).val());
    }

    function get_total_line_stop(i,j)
    {
        var actual = $('#actual_'+i+'_'+j).val();
        var ct = $('#ct_'+i+'_'+j).val();

        var total_stop = parseInt($('#menit_terpakai_'+i+'_'+j).val()) - parseInt(parseInt(parseInt(actual) / parseFloat(ct)) / 60);
        $('#total_stop_'+i+'_'+j).val(total_stop);
    }
</script>
<?= $this->endSection(); ?>