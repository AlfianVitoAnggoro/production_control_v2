<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xl-12 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4>Detail Rejection Plate Cutting</h4>
                        </div>
                        <div class="box-body">
                            <form action="/lhp/platecutting/save" method="post">
                                <h1>Plate POS</h1>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="button" class="btn btn-primary" id="add_form_pos" onclick="add_platecutting_pos()">Add</button>
                                        <button type="button" class="btn btn-danger" id="delete_form_pos" onclick="delete_platecutting_pos()">Delete</button>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th colspan="7"></th>
                                                <th colspan="10" class="text-center">Jumlah NG (Kilogram)</th>
                                                <th colspan="10" class="text-center">Jumlah NG (Panel)</th>
                                                <th colspan="3"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="7"></th>
                                                <th colspan="3" class="text-center bg-primary">Internal</th>
                                                <th colspan="7" class="text-center bg-info">Eksternal</th>
                                                <th colspan="3" class="text-center bg-primary">Internal</th>
                                                <th colspan="7" class="text-center bg-info">Eksternal</th>
                                            </tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Line</th>
                                                <th>Shift</th>
                                                <th>Plate</th>
                                                <th>Plate Action</th>
                                                <th>Hasil Produksi</th>
                                                <th>Terpotong</th>
                                                <th>Tersangkut</th>
                                                <th>Overbrush</th>
                                                <th>Rontok</th>
                                                <th>Lug Patah</th>
                                                <th>Patah Kaki</th>
                                                <th>Patah Frame</th>
                                                <th>Bolong</th>
                                                <th>Bending</th>
                                                <th>Lengket Terpotong</th>
                                                <th>Terpotong</th>
                                                <th>Tersangkut</th>
                                                <th>Overbrush</th>
                                                <th>Rontok</th>
                                                <th>Lug Patah</th>
                                                <th>Patah Kaki</th>
                                                <th>Patah Frame</th>
                                                <th>Bolong</th>
                                                <th>Bending</th>
                                                <th>Lengket Terpotong</th>
                                                <th>% Reject Internal</th>
                                                <th>% Reject Eksternal</th>
                                                <th>% Akumulatif</th>
                                            </tr>
                                        </thead>
                                        <tbody class="form_platecutting_pos">
                                            <tr class="form_pos" id="form_0_pos">
                                                <td>1</td>
                                                <td>
                                                    <input type="date" class="form-control" id="date_0_pos" name="date_pos[]" style="width: 150px" required>
                                                </td>
                                                <td>
                                                    <select class="form-control" id="line_0_pos" name="line_pos[]" style="width: 200px;" required>
                                                        <option selected disabled>-- Pilih Line --</option>
                                                        <?php
                                                        for ($j = 1; $j <= 3; $j++) { ?>
                                                            <option value="<?= $j ?>"><?= $j ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" id="shift_0_pos" name="shift_pos[]" style="width: 200px;" required>
                                                        <option selected disabled>-- Pilih Shift --</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div id="plate_section_0_pos">
                                                        <select class="form-control select2 plate_0_pos" id="plate_0_0_pos" onchange="panel_pos(0, 0)" name="plate_0_pos[]" style="width: 200px;" required>
                                                            <option selected disabled>-- Pilih Plate --</option>
                                                            <?php
                                                            $plate_pos = array_filter($plate, function ($p_pos) {
                                                                return strpos($p_pos['plate'], 'POS') !== false;
                                                            });
                                                            foreach ($plate_pos as $plt) {
                                                            ?>
                                                                <option value="<?= trim($plt['plate']) ?>"><?= trim($plt['plate']) ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" id="add_plate_0_pos" onclick="add_plate_pos(0)">Add</button>
                                                </td>
                                                <td>
                                                    <div id="hasil_produksi_section_0_pos">
                                                        <input type="text" class="form-control" name="hasil_produksi_0_pos[]" value="0" id="hasil_produksi_0_0_pos" onkeyup="panel_pos(0, 0)" style="width: 100px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="terpotong_kg_section_0_pos">
                                                        <input type="text" class="form-control" name="terpotong_kg_0_pos[]" id="terpotong_kg_0_0_pos" value="0" onkeyup="panel_pos(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="tersangkut_kg_section_0_pos">
                                                        <input type="text" class="form-control" name="tersangkut_kg_0_pos[]" id="tersangkut_kg_0_0_pos" value="0" onkeyup="panel_pos(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="overbrush_kg_section_0_pos">
                                                        <input type="text" class="form-control" name="overbrush_kg_0_pos[]" id="overbrush_kg_0_0_pos" value="0" onkeyup="panel_pos(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="rontok_kg_section_0_pos">
                                                        <input type="text" class="form-control" name="rontok_kg_0_pos[]" id="rontok_kg_0_0_pos" value="0" onkeyup="panel_pos(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="lug_patah_kg_section_0_pos">
                                                        <input type="text" class="form-control" name="lug_patah_kg_0_pos[]" id="lug_patah_kg_0_0_pos" value="0" onkeyup="panel_pos(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="patah_kaki_kg_section_0_pos">
                                                        <input type="text" class="form-control" name="patah_kaki_kg_0_pos[]" id="patah_kaki_kg_0_0_pos" value="0" onkeyup="panel_pos(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="patah_frame_kg_section_0_pos">
                                                        <input type="text" class="form-control" name="patah_frame_kg_0_pos[]" id="patah_frame_kg_0_0_pos" value="0" onkeyup="panel_pos(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="bolong_kg_section_0_pos">
                                                        <input type="text" class="form-control" name="bolong_kg_0_pos[]" id="bolong_kg_0_0_pos" value="0" onkeyup="panel_pos(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="bending_kg_section_0_pos">
                                                        <input type="text" class="form-control" name="bending_kg_0_pos[]" id="bending_kg_0_0_pos" value="0" onkeyup="panel_pos(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="lengket_terpotong_kg_section_0_pos">
                                                        <input type="text" class="form-control" name="lengket_terpotong_kg_0_pos[]" id="lengket_terpotong_kg_0_0_pos" value="0" onkeyup="panel_pos(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="terpotong_panel_section_0_pos">
                                                        <input type="text" class="form-control" name="terpotong_panel_0_pos[]" value="0" id="terpotong_panel_0_0_pos" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="tersangkut_panel_section_0_pos">
                                                        <input type="text" class="form-control" name="tersangkut_panel_0_pos[]" value="0" id="tersangkut_panel_0_0_pos" style=" width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="overbrush_panel_section_0_pos">
                                                        <input type="text" class="form-control" name="overbrush_panel_0_pos[]" value="0" id="overbrush_panel_0_0_pos" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="rontok_panel_section_0_pos">
                                                        <input type="text" class="form-control" name="rontok_panel_0_pos[]" value="0" id="rontok_panel_0_0_pos" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="lug_patah_panel_section_0_pos">
                                                        <input type="text" class="form-control" name="lug_patah_panel_0_pos[]" value="0" id="lug_patah_panel_0_0_pos" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="patah_kaki_panel_section_0_pos">
                                                        <input type="text" class="form-control" name="patah_kaki_panel_0_pos[]" value="0" id="patah_kaki_panel_0_0_pos" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="patah_frame_panel_section_0_pos">
                                                        <input type="text" class="form-control" name="patah_frame_panel_0_pos[]" value="0" id="patah_frame_panel_0_0_pos" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="bolong_panel_section_0_pos">
                                                        <input type="text" class="form-control" name="bolong_panel_0_pos[]" value="0" id="bolong_panel_0_0_pos" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="bending_panel_section_0_pos">
                                                        <input type="text" class="form-control" name="bending_panel_0_pos[]" value="0" id="bending_panel_0_0_pos" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="lengket_terpotong_panel_section_0_pos">
                                                        <input type="text" class="form-control" name="lengket_terpotong_panel_0_pos[]" value="0" id="lengket_terpotong_panel_0_0_pos" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="persentase_reject_internal_section_0_pos">
                                                        <input type="text" class="form-control" name="persentase_reject_internal_0_pos[]" value="0" id="persentase_reject_internal_0_0_pos" style="width: 100px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="persentase_reject_eksternal_section_0_pos">
                                                        <input type="text" class="form-control" name="persentase_reject_eksternal_0_pos[]" value="0" id="persentase_reject_eksternal_0_0_pos" style="width: 100px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="persentase_reject_akumulatif_section_0_pos">
                                                        <input type="text" class="form-control" name="persentase_reject_akumulatif_0_pos[]" value="0" id="persentase_reject_akumulatif_0_0_pos" style="width: 100px" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h1>Plate NEG</h1>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="button" class="btn btn-primary" id="add_form_neg" onclick="add_platecutting_neg()">Add</button>
                                        <button type="button" class="btn btn-danger" id="delete_form_neg" onclick="delete_platecutting_neg()">Delete</button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th colspan="7"></th>
                                                <th colspan="10" class="text-center">Jumlah NG (Kilogram)</th>
                                                <th colspan="10" class="text-center">Jumlah NG (Panel)</th>
                                                <th colspan="3"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="7"></th>
                                                <th colspan="3" class="text-center bg-primary">Internal</th>
                                                <th colspan="7" class="text-center bg-info">Eksternal</th>
                                                <th colspan="3" class="text-center bg-primary">Internal</th>
                                                <th colspan="7" class="text-center bg-info">Eksternal</th>
                                                <th colspan="3"></th>
                                            </tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Line</th>
                                                <th>Shift</th>
                                                <th>Plate</th>
                                                <th>Plate Action</th>
                                                <th>Hasil Produksi</th>
                                                <th>Terpotong</th>
                                                <th>Tersangkut</th>
                                                <th>Overbrush</th>
                                                <th>Rontok</th>
                                                <th>Lug Patah</th>
                                                <th>Patah Kaki</th>
                                                <th>Patah Frame</th>
                                                <th>Bolong</th>
                                                <th>Bending</th>
                                                <th>Lengket Terpotong</th>
                                                <th>Terpotong</th>
                                                <th>Tersangkut</th>
                                                <th>Overbrush</th>
                                                <th>Rontok</th>
                                                <th>Lug Patah</th>
                                                <th>Patah Kaki</th>
                                                <th>Patah Frame</th>
                                                <th>Bolong</th>
                                                <th>Bending</th>
                                                <th>Lengket Terpotong</th>
                                                <th>% Reject Internal</th>
                                                <th>% Reject Eksternal</th>
                                                <th>% Akumulatif</th>
                                            </tr>
                                        </thead>
                                        <tbody class="form_platecutting_neg">
                                            <tr class="form_neg" id="form_0_neg">
                                                <td>1</td>
                                                <td>
                                                    <input type="date" class="form-control" id="date_0_neg" name="date_neg[]" style="width: 150px" required>
                                                </td>
                                                <td>
                                                    <select class="form-control" id="line_0_neg" name="line_neg[]" style="width: 200px;" required>
                                                        <option selected disabled>-- Pilih Line --</option>
                                                        <?php
                                                        for ($j = 1; $j <= 3; $j++) { ?>
                                                            <option value="<?= $j ?>"><?= $j ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" id="shift_0_neg" name="shift_neg[]" style="width: 200px;" required>
                                                        <option selected disabled>-- Pilih Shift --</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div id="plate_section_0_neg">
                                                        <select class="form-control select2 plate_0_neg" id="plate_0_0_neg" onchange="panel_neg(0, 0)" name="plate_0_neg[]" style="width: 200px;" required>
                                                            <option selected disabled>-- Pilih Plate --</option>
                                                            <?php
                                                            $plate_neg = array_filter($plate, function ($p_neg) {
                                                                return strpos($p_neg['plate'], 'NEG') !== false;
                                                            });
                                                            foreach ($plate_neg as $plt) {
                                                            ?>
                                                                <option value="<?= trim($plt['plate']) ?>"><?= trim($plt['plate']) ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" id="add_plate_0_neg" onclick="add_plate_neg(0)">Add</button>
                                                </td>
                                                <td>
                                                    <div id="hasil_produksi_section_0_neg">
                                                        <input type="text" class="form-control" name="hasil_produksi_0_neg[]" value="0" id="hasil_produksi_0_0_neg" onkeyup="panel_neg(0, 0)" style=" width: 100px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="terpotong_kg_section_0_neg">
                                                        <input type="text" class="form-control" name="terpotong_kg_0_neg[]" id="terpotong_kg_0_0_neg" value="0" onkeyup="panel_neg(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="tersangkut_kg_section_0_neg">
                                                        <input type="text" class="form-control" name="tersangkut_kg_0_neg[]" id="tersangkut_kg_0_0_neg" value="0" onkeyup="panel_neg(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="overbrush_kg_section_0_neg">
                                                        <input type="text" class="form-control" name="overbrush_kg_0_neg[]" id="overbrush_kg_0_0_neg" value="0" onkeyup="panel_neg(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="rontok_kg_section_0_neg">
                                                        <input type="text" class="form-control" name="rontok_kg_0_neg[]" id="rontok_kg_0_0_neg" value="0" onkeyup="panel_neg(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="lug_patah_kg_section_0_neg">
                                                        <input type="text" class="form-control" name="lug_patah_kg_0_neg[]" id="lug_patah_kg_0_0_neg" value="0" onkeyup="panel_neg(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="patah_kaki_kg_section_0_neg">
                                                        <input type="text" class="form-control" name="patah_kaki_kg_0_neg[]" id="patah_kaki_kg_0_0_neg" value="0" onkeyup="panel_neg(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="patah_frame_kg_section_0_neg">
                                                        <input type="text" class="form-control" name="patah_frame_kg_0_neg[]" id="patah_frame_kg_0_0_neg" value="0" onkeyup="panel_neg(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="bolong_kg_section_0_neg">
                                                        <input type="text" class="form-control" name="bolong_kg_0_neg[]" id="bolong_kg_0_0_neg" value="0" onkeyup="panel_neg(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="bending_kg_section_0_neg">
                                                        <input type="text" class="form-control" name="bending_kg_0_neg[]" id="bending_kg_0_0_neg" value="0" onkeyup="panel_neg(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="lengket_terpotong_kg_section_0_neg">
                                                        <input type="text" class="form-control" name="lengket_terpotong_kg_0_neg[]" id="lengket_terpotong_kg_0_0_neg" value="0" onkeyup="panel_neg(0, 0)" style="width: 75px">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="terpotong_panel_section_0_neg">
                                                        <input type="text" class="form-control" name="terpotong_panel_0_neg[]" value="0" id="terpotong_panel_0_0_neg" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="tersangkut_panel_section_0_neg">
                                                        <input type="text" class="form-control" name="tersangkut_panel_0_neg[]" value="0" id="tersangkut_panel_0_0_neg" style=" width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="overbrush_panel_section_0_neg">
                                                        <input type="text" class="form-control" name="overbrush_panel_0_neg[]" value="0" id="overbrush_panel_0_0_neg" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="rontok_panel_section_0_neg">
                                                        <input type="text" class="form-control" name="rontok_panel_0_neg[]" value="0" id="rontok_panel_0_0_neg" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="lug_patah_panel_section_0_neg">
                                                        <input type="text" class="form-control" name="lug_patah_panel_0_neg[]" value="0" id="lug_patah_panel_0_0_neg" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="patah_kaki_panel_section_0_neg">
                                                        <input type="text" class="form-control" name="patah_kaki_panel_0_neg[]" value="0" id="patah_kaki_panel_0_0_neg" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="patah_frame_panel_section_0_neg">
                                                        <input type="text" class="form-control" name="patah_frame_panel_0_neg[]" value="0" id="patah_frame_panel_0_0_neg" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="bolong_panel_section_0_neg">
                                                        <input type="text" class="form-control" name="bolong_panel_0_neg[]" value="0" id="bolong_panel_0_0_neg" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="bending_panel_section_0_neg">
                                                        <input type="text" class="form-control" name="bending_panel_0_neg[]" value="0" id="bending_panel_0_0_neg" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="lengket_terpotong_panel_section_0_neg">
                                                        <input type="text" class="form-control" name="lengket_terpotong_panel_0_neg[]" value="0" id="lengket_terpotong_panel_0_0_neg" style="width: 75px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="persentase_reject_internal_section_0_neg">
                                                        <input type="text" class="form-control" name="persentase_reject_internal_0_neg[]" value="0" id="persentase_reject_internal_0_0_neg" style="width: 100px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="persentase_reject_eksternal_section_0_neg">
                                                        <input type="text" class="form-control" name="persentase_reject_eksternal_0_neg[]" value="0" id="persentase_reject_eksternal_0_0_neg" style="width: 100px" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="persentase_reject_akumulatif_section_0_neg">
                                                        <input type="text" class="form-control" name="persentase_reject_akumulatif_0_neg[]" value="0" id="persentase_reject_akumulatif_0_0_neg" style="width: 100px" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    function panel_pos(baris, jumlahplate) {
        const plate = $('#plate_' + baris + '_' + jumlahplate + '_pos').val();
        let terpotong_panel = 0;
        let tersangkut_panel = 0;
        let overbrush_panel = 0;
        let rontok_panel = 0;
        let lug_patah_panel = 0;
        let patah_kaki_panel = 0;
        let patah_frame_panel = 0;
        let bolong_panel = 0;
        let bending_panel = 0;
        let lengket_terpotong_panel = 0;
        let terpotong_kg = $('#terpotong_kg_' + baris + '_' + jumlahplate + '_pos').val() ? parseFloat($('#terpotong_kg_' + baris + '_' + jumlahplate + '_pos').val()) : 0;
        let tersangkut_kg = $('#tersangkut_kg_' + baris + '_' + jumlahplate + '_pos').val() ? parseFloat($('#tersangkut_kg_' + baris + '_' + jumlahplate + '_pos').val()) : 0;
        let overbrush_kg = $('#overbrush_kg_' + baris + '_' + jumlahplate + '_pos').val() ? parseFloat($('#overbrush_kg_' + baris + '_' + jumlahplate + '_pos').val()) : 0;
        let rontok_kg = $('#rontok_kg_' + baris + '_' + jumlahplate + '_pos').val() ? parseFloat($('#rontok_kg_' + baris + '_' + jumlahplate + '_pos').val()) : 0;
        let lug_patah_kg = $('#lug_patah_kg_' + baris + '_' + jumlahplate + '_pos').val() ? parseFloat($('#lug_patah_kg_' + baris + '_' + jumlahplate + '_pos').val()) : 0;
        let patah_kaki_kg = $('#patah_kaki_kg_' + baris + '_' + jumlahplate + '_pos').val() ? parseFloat($('#patah_kaki_kg_' + baris + '_' + jumlahplate + '_pos').val()) : 0;
        let patah_frame_kg = $('#patah_frame_kg_' + baris + '_' + jumlahplate + '_pos').val() ? parseFloat($('#patah_frame_kg_' + baris + '_' + jumlahplate + '_pos').val()) : 0;
        let bolong_kg = $('#bolong_kg_' + baris + '_' + jumlahplate + '_pos').val() ? parseFloat($('#bolong_kg_' + baris + '_' + jumlahplate + '_pos').val()) : 0;
        let bending_kg = $('#bending_kg_' + baris + '_' + jumlahplate + '_pos').val() ? parseFloat($('#bending_kg_' + baris + '_' + jumlahplate + '_pos').val()) : 0;
        let lengket_terpotong_kg = $('#lengket_terpotong_kg_' + baris + '_' + jumlahplate + '_pos').val() ? parseFloat($('#lengket_terpotong_kg_' + baris + '_' + jumlahplate + '_pos').val()) : 0;
        if (terpotong_kg !== 0 || tersangkut_kg !== 0 || overbrush_kg !== 0 || rontok_kg !== 0 || lug_patah_kg !== 0 || patah_kaki_kg !== 0 || patah_frame_kg !== 0 || bolong_kg !== 0 || bending_kg !== 0 || lengket_terpotong_kg !== 0) {
            <?php foreach ($plate as $p) : ?>
                if ($('#plate_' + baris + '_' + jumlahplate + '_pos').val() === "<?= trim($p['plate']) ?>") {
                    terpotong_panel = (terpotong_kg / <?= $p['berat'] ?>) * (110 / 100);
                    tersangkut_panel = (tersangkut_kg / <?= $p['berat'] ?>) * (110 / 100);
                    overbrush_panel = (overbrush_kg / <?= $p['berat'] ?>) * (110 / 100);
                    rontok_panel = (rontok_kg / <?= $p['berat'] ?>) * (110 / 100);
                    lug_patah_panel = (lug_patah_kg / <?= $p['berat'] ?>) * (110 / 100);
                    patah_kaki_panel = (patah_kaki_kg / <?= $p['berat'] ?>) * (110 / 100);
                    patah_frame_panel = (patah_frame_kg / <?= $p['berat'] ?>) * (110 / 100);
                    bolong_panel = (bolong_kg / <?= $p['berat'] ?>) * (110 / 100);
                    bending_panel = (bending_kg / <?= $p['berat'] ?>) * (110 / 100);
                    lengket_terpotong_panel = (lengket_terpotong_kg / <?= $p['berat'] ?>) * (110 / 100);
                }
            <?php endforeach ?>
        }
        $('#terpotong_panel_' + baris + '_' + jumlahplate + '_pos').val(Math.ceil(terpotong_panel));
        $('#tersangkut_panel_' + baris + '_' + jumlahplate + '_pos').val(Math.ceil(tersangkut_panel));
        $('#overbrush_panel_' + baris + '_' + jumlahplate + '_pos').val(Math.ceil(overbrush_panel));
        $('#rontok_panel_' + baris + '_' + jumlahplate + '_pos').val(Math.ceil(rontok_panel));
        $('#lug_patah_panel_' + baris + '_' + jumlahplate + '_pos').val(Math.ceil(lug_patah_panel));
        $('#patah_kaki_panel_' + baris + '_' + jumlahplate + '_pos').val(Math.ceil(patah_kaki_panel));
        $('#patah_frame_panel_' + baris + '_' + jumlahplate + '_pos').val(Math.ceil(patah_frame_panel));
        $('#bolong_panel_' + baris + '_' + jumlahplate + '_pos').val(Math.ceil(bolong_panel));
        $('#bending_panel_' + baris + '_' + jumlahplate + '_pos').val(Math.ceil(bending_panel));
        $('#lengket_terpotong_panel_' + baris + '_' + jumlahplate + '_pos').val(Math.ceil(lengket_terpotong_panel));
        $('#persentase_reject_internal_' + baris + '_' + jumlahplate + '_pos').val((100 * (Math.ceil(terpotong_panel) + Math.ceil(tersangkut_panel) + Math.ceil(overbrush_panel)) / $('#hasil_produksi_' + baris + '_' + jumlahplate + '_pos').val()).toPrecision(3) + '%');
        $('#persentase_reject_eksternal_' + baris + '_' + jumlahplate + '_pos').val((100 * (Math.ceil(rontok_panel) + Math.ceil(lug_patah_panel) + Math.ceil(patah_kaki_panel) + Math.ceil(patah_frame_panel) + Math.ceil(bolong_panel) + Math.ceil(bending_panel) + Math.ceil(lengket_terpotong_panel)) / $('#hasil_produksi_' + baris + '_' + jumlahplate + '_pos').val()).toPrecision(3) + '%');
        $('#persentase_reject_akumulatif_' + baris + '_' + jumlahplate + '_pos').val((100 * (Math.ceil(terpotong_panel) + Math.ceil(tersangkut_panel) + Math.ceil(overbrush_panel) + Math.ceil(rontok_panel) + Math.ceil(lug_patah_panel) + Math.ceil(patah_kaki_panel) + Math.ceil(patah_frame_panel) + Math.ceil(bolong_panel) + Math.ceil(bending_panel) + Math.ceil(lengket_terpotong_panel)) / $('#hasil_produksi_' + baris + '_' + jumlahplate + '_pos').val()).toPrecision(3) + '%');
    }

    function panel_neg(baris, jumlahplate) {
        const plate = $('#plate_' + baris + '_' + jumlahplate + '_neg').val();
        let terpotong_panel = 0;
        let tersangkut_panel = 0;
        let overbrush_panel = 0;
        let rontok_panel = 0;
        let lug_patah_panel = 0;
        let patah_kaki_panel = 0;
        let patah_frame_panel = 0;
        let bolong_panel = 0;
        let bending_panel = 0;
        let lengket_terpotong_panel = 0;
        let terpotong_kg = $('#terpotong_kg_' + baris + '_' + jumlahplate + '_neg').val() ? parseFloat($('#terpotong_kg_' + baris + '_' + jumlahplate + '_neg').val()) : 0;
        let tersangkut_kg = $('#tersangkut_kg_' + baris + '_' + jumlahplate + '_neg').val() ? parseFloat($('#tersangkut_kg_' + baris + '_' + jumlahplate + '_neg').val()) : 0;
        let overbrush_kg = $('#overbrush_kg_' + baris + '_' + jumlahplate + '_neg').val() ? parseFloat($('#overbrush_kg_' + baris + '_' + jumlahplate + '_neg').val()) : 0;
        let rontok_kg = $('#rontok_kg_' + baris + '_' + jumlahplate + '_neg').val() ? parseFloat($('#rontok_kg_' + baris + '_' + jumlahplate + '_neg').val()) : 0;
        let lug_patah_kg = $('#lug_patah_kg_' + baris + '_' + jumlahplate + '_neg').val() ? parseFloat($('#lug_patah_kg_' + baris + '_' + jumlahplate + '_neg').val()) : 0;
        let patah_kaki_kg = $('#patah_kaki_kg_' + baris + '_' + jumlahplate + '_neg').val() ? parseFloat($('#patah_kaki_kg_' + baris + '_' + jumlahplate + '_neg').val()) : 0;
        let patah_frame_kg = $('#patah_frame_kg_' + baris + '_' + jumlahplate + '_neg').val() ? parseFloat($('#patah_frame_kg_' + baris + '_' + jumlahplate + '_neg').val()) : 0;
        let bolong_kg = $('#bolong_kg_' + baris + '_' + jumlahplate + '_neg').val() ? parseFloat($('#bolong_kg_' + baris + '_' + jumlahplate + '_neg').val()) : 0;
        let bending_kg = $('#bending_kg_' + baris + '_' + jumlahplate + '_neg').val() ? parseFloat($('#bending_kg_' + baris + '_' + jumlahplate + '_neg').val()) : 0;
        let lengket_terpotong_kg = $('#lengket_terpotong_kg_' + baris + '_' + jumlahplate + '_neg').val() ? parseFloat($('#lengket_terpotong_kg_' + baris + '_' + jumlahplate + '_neg').val()) : 0;
        if (terpotong_kg !== 0 || tersangkut_kg !== 0 || overbrush_kg !== 0 || rontok_kg !== 0 || lug_patah_kg !== 0 || patah_kaki_kg !== 0 || patah_frame_kg !== 0 || bolong_kg !== 0 || bending_kg !== 0 || lengket_terpotong_kg !== 0) {
            <?php foreach ($plate as $p) : ?>
                if ($('#plate_' + baris + '_' + jumlahplate + '_neg').val() === "<?= trim($p['plate']) ?>") {
                    terpotong_panel = (terpotong_kg / <?= $p['berat'] ?>) * (110 / 100);
                    tersangkut_panel = (tersangkut_kg / <?= $p['berat'] ?>) * (110 / 100);
                    overbrush_panel = (overbrush_kg / <?= $p['berat'] ?>) * (110 / 100);
                    rontok_panel = (rontok_kg / <?= $p['berat'] ?>) * (110 / 100);
                    lug_patah_panel = (lug_patah_kg / <?= $p['berat'] ?>) * (110 / 100);
                    patah_kaki_panel = (patah_kaki_kg / <?= $p['berat'] ?>) * (110 / 100);
                    patah_frame_panel = (patah_frame_kg / <?= $p['berat'] ?>) * (110 / 100);
                    bolong_panel = (bolong_kg / <?= $p['berat'] ?>) * (110 / 100);
                    bending_panel = (bending_kg / <?= $p['berat'] ?>) * (110 / 100);
                    lengket_terpotong_panel = (lengket_terpotong_kg / <?= $p['berat'] ?>) * (110 / 100);
                }
            <?php endforeach ?>
        }
        $('#terpotong_panel_' + baris + '_' + jumlahplate + '_neg').val(Math.ceil(terpotong_panel));
        $('#tersangkut_panel_' + baris + '_' + jumlahplate + '_neg').val(Math.ceil(tersangkut_panel));
        $('#overbrush_panel_' + baris + '_' + jumlahplate + '_neg').val(Math.ceil(overbrush_panel));
        $('#rontok_panel_' + baris + '_' + jumlahplate + '_neg').val(Math.ceil(rontok_panel));
        $('#lug_patah_panel_' + baris + '_' + jumlahplate + '_neg').val(Math.ceil(lug_patah_panel));
        $('#patah_kaki_panel_' + baris + '_' + jumlahplate + '_neg').val(Math.ceil(patah_kaki_panel));
        $('#patah_frame_panel_' + baris + '_' + jumlahplate + '_neg').val(Math.ceil(patah_frame_panel));
        $('#bolong_panel_' + baris + '_' + jumlahplate + '_neg').val(Math.ceil(bolong_panel));
        $('#bending_panel_' + baris + '_' + jumlahplate + '_neg').val(Math.ceil(bending_panel));
        $('#lengket_terpotong_panel_' + baris + '_' + jumlahplate + '_neg').val(Math.ceil(lengket_terpotong_panel));
        $('#persentase_reject_internal_' + baris + '_' + jumlahplate + '_neg').val((100 * (Math.ceil(terpotong_panel) + Math.ceil(tersangkut_panel) + Math.ceil(overbrush_panel)) / $('#hasil_produksi_' + baris + '_' + jumlahplate + '_neg').val()).toPrecision(3) + '%');
        $('#persentase_reject_eksternal_' + baris + '_' + jumlahplate + '_neg').val((100 * (Math.ceil(rontok_panel) + Math.ceil(lug_patah_panel) + Math.ceil(patah_kaki_panel) + Math.ceil(patah_frame_panel) + Math.ceil(bolong_panel) + Math.ceil(bending_panel) + Math.ceil(lengket_terpotong_panel)) / $('#hasil_produksi_' + baris + '_' + jumlahplate + '_neg').val()).toPrecision(3) + '%');
        $('#persentase_reject_akumulatif_' + baris + '_' + jumlahplate + '_neg').val((100 * (Math.ceil(terpotong_panel) + Math.ceil(tersangkut_panel) + Math.ceil(overbrush_panel) + Math.ceil(rontok_panel) + Math.ceil(lug_patah_panel) + Math.ceil(patah_kaki_panel) + Math.ceil(patah_frame_panel) + Math.ceil(bolong_panel) + Math.ceil(bending_panel) + Math.ceil(lengket_terpotong_panel)) / $('#hasil_produksi_' + baris + '_' + jumlahplate + '_neg').val()).toPrecision(3) + '%');
    }

    function add_plate_pos(baris) {
        const jumlahplate = document.querySelectorAll('.plate_' + baris + '_pos').length;
        $('#plate_section_' + baris + '_pos').append(`
            <select class="form-control select2 plate_${baris}_pos" id="plate_${baris}_${jumlahplate}_pos" onchange="panel_pos(${baris}, ${jumlahplate})" name="plate_${baris}_pos[]" style="width: 200px;">
                <option selected disabled>-- Pilih Plate --</option>
                <?php
                $plate_pos = array_filter($plate, function ($p_pos) {
                    return strpos($p_pos['plate'], 'POS') !== false;
                });
                foreach ($plate_pos as $plt) { ?>
                    <option value="<?= trim($plt['plate']) ?>"><?= trim($plt['plate']) ?></option>
                <?php
                }
                ?>
            </select>
        `);
        $('#hasil_produksi_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="hasil_produksi_${baris}_pos[]" value="0" id="hasil_produksi_${baris}_${jumlahplate}_pos" onkeyup="panel_pos(${baris}, ${jumlahplate})" style="width: 100px">
        `);
        $('#terpotong_panel_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="terpotong_panel_${baris}_pos[]" value="0" id="terpotong_panel_${baris}_${jumlahplate}_pos" style="width: 75px" readonly>
        `);
        $('#tersangkut_panel_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="tersangkut_panel_${baris}_pos[]" value="0" id="tersangkut_panel_${baris}_${jumlahplate}_pos" style="width: 75px" readonly>
        `);
        $('#overbrush_panel_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="overbrush_panel_${baris}_pos[]" value="0" id="overbrush_panel_${baris}_${jumlahplate}_pos" style="width: 75px" readonly>
        `);
        $('#rontok_panel_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="rontok_panel_${baris}_pos[]" value="0" id="rontok_panel_${baris}_${jumlahplate}_pos" style="width: 75px" readonly>
        `);
        $('#lug_patah_panel_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="lug_patah_panel_${baris}_pos[]" value="0" id="lug_patah_panel_${baris}_${jumlahplate}_pos" style="width: 75px" readonly>
        `);
        $('#patah_kaki_panel_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="patah_kaki_panel_${baris}_pos[]" value="0" id="patah_kaki_panel_${baris}_${jumlahplate}_pos" style="width: 75px" readonly>
        `);
        $('#patah_frame_panel_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="patah_frame_panel_${baris}_pos[]" value="0" id="patah_frame_panel_${baris}_${jumlahplate}_pos" style="width: 75px" readonly>
        `);
        $('#bolong_panel_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="bolong_panel_${baris}_pos[]" value="0" id="bolong_panel_${baris}_${jumlahplate}_pos" style="width: 75px" readonly>
        `);
        $('#bending_panel_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="bending_panel_${baris}_pos[]" value="0" id="bending_panel_${baris}_${jumlahplate}_pos" style="width: 75px" readonly>
        `);
        $('#lengket_terpotong_panel_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="lengket_terpotong_panel_${baris}_pos[]" value="0" id="lengket_terpotong_panel_${baris}_${jumlahplate}_pos" style="width: 75px" readonly>
        `);
        $('#persentase_reject_internal_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="persentase_reject_internal_${baris}_pos[]" value="0" id="persentase_reject_internal_${baris}_${jumlahplate}_pos" style="width: 100px" readonly>
        `);
        $('#persentase_reject_eksternal_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="persentase_reject_eksternal_${baris}_pos[]" value="0" id="persentase_reject_eksternal_${baris}_${jumlahplate}_pos" style="width: 100px" readonly>
        `);
        $('#persentase_reject_akumulatif_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="persentase_reject_akumulatif_${baris}_pos[]" value="0" id="persentase_reject_akumulatif_${baris}_${jumlahplate}_pos" style="width: 100px" readonly>
        `);
        $('#terpotong_kg_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="terpotong_kg_${baris}_pos[]" id="terpotong_kg_${baris}_${jumlahplate}_pos" value="0" onkeyup="panel_pos(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#tersangkut_kg_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="tersangkut_kg_${baris}_pos[]" id="tersangkut_kg_${baris}_${jumlahplate}_pos" value="0" onkeyup="panel_pos(${baris}, ${jumlahplate})"  style="width: 75px">
        `);
        $('#overbrush_kg_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="overbrush_kg_${baris}_pos[]" id="overbrush_kg_${baris}_${jumlahplate}_pos" value="0" onkeyup="panel_pos(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#rontok_kg_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="rontok_kg_${baris}_pos[]" id="rontok_kg_${baris}_${jumlahplate}_pos" value="0" onkeyup="panel_pos(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#lug_patah_kg_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="lug_patah_kg_${baris}_pos[]" id="lug_patah_kg_${baris}_${jumlahplate}_pos" value="0" onkeyup="panel_pos(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#patah_kaki_kg_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="patah_kaki_kg_${baris}_pos[]" id="patah_kaki_kg_${baris}_${jumlahplate}_pos" value="0" onkeyup="panel_pos(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#patah_frame_kg_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="patah_frame_kg_${baris}_pos[]" id="patah_frame_kg_${baris}_${jumlahplate}_pos" value="0" onkeyup="panel_pos(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#bolong_kg_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="bolong_kg_${baris}_pos[]" id="bolong_kg_${baris}_${jumlahplate}_pos" value="0" onkeyup="panel_pos(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#bending_kg_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="bending_kg_${baris}_pos[]" id="bending_kg_${baris}_${jumlahplate}_pos" value="0" onkeyup="panel_pos(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#lengket_terpotong_kg_section_' + baris + '_pos').append(`
            <input type="text" class="form-control" name="lengket_terpotong_kg_${baris}_pos[]" id="lengket_terpotong_kg_${baris}_${jumlahplate}_pos" value="0" onkeyup="panel_pos(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('.select2').select2();
    }

    function add_plate_neg(baris) {
        const jumlahplate = document.querySelectorAll('.plate_' + baris + '_neg').length;
        $('#plate_section_' + baris + '_neg').append(`
            <select class="form-control select2 plate_${baris}_neg" id="plate_${baris}_${jumlahplate}_neg" onchange="panel_neg(${baris}, ${jumlahplate})" name="plate_${baris}_neg[]" style="width: 200px;">
                <option selected disabled>-- Pilih Plate --</option>
                <?php
                $plate_neg = array_filter($plate, function ($p_neg) {
                    return strpos($p_neg['plate'], 'NEG') !== false;
                });
                foreach ($plate_neg as $plt) { ?>
                    <option value="<?= trim($plt['plate']) ?>"><?= trim($plt['plate']) ?></option>
                <?php
                }
                ?>
            </select>
        `);
        $('#hasil_produksi_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="hasil_produksi_${baris}_neg[]" value="0" id="hasil_produksi_${baris}_${jumlahplate}_neg" onkeyup="panel_neg(${baris}, ${jumlahplate})" style="width: 100px">
        `);
        $('#terpotong_panel_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="terpotong_panel_${baris}_neg[]" value="0" id="terpotong_panel_${baris}_${jumlahplate}_neg" style="width: 75px" readonly>
        `);
        $('#tersangkut_panel_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="tersangkut_panel_${baris}_neg[]" value="0" id="tersangkut_panel_${baris}_${jumlahplate}_neg" style="width: 75px" readonly>
        `);
        $('#overbrush_panel_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="overbrush_panel_${baris}_neg[]" value="0" id="overbrush_panel_${baris}_${jumlahplate}_neg" style="width: 75px" readonly>
        `);
        $('#rontok_panel_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="rontok_panel_${baris}_neg[]" value="0" id="rontok_panel_${baris}_${jumlahplate}_neg" style="width: 75px" readonly>
        `);
        $('#lug_patah_panel_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="lug_patah_panel_${baris}_neg[]" value="0" id="lug_patah_panel_${baris}_${jumlahplate}_neg" style="width: 75px" readonly>
        `);
        $('#patah_kaki_panel_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="patah_kaki_panel_${baris}_neg[]" value="0" id="patah_kaki_panel_${baris}_${jumlahplate}_neg" style="width: 75px" readonly>
        `);
        $('#patah_frame_panel_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="patah_frame_panel_${baris}_neg[]" value="0" id="patah_frame_panel_${baris}_${jumlahplate}_neg" style="width: 75px" readonly>
        `);
        $('#bolong_panel_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="bolong_panel_${baris}_neg[]" value="0" id="bolong_panel_${baris}_${jumlahplate}_neg" style="width: 75px" readonly>
        `);
        $('#bending_panel_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="bending_panel_${baris}_neg[]" value="0" id="bending_panel_${baris}_${jumlahplate}_neg" style="width: 75px" readonly>
        `);
        $('#lengket_terpotong_panel_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="lengket_terpotong_panel_${baris}_neg[]" value="0" id="lengket_terpotong_panel_${baris}_${jumlahplate}_neg" style="width: 75px" readonly>
        `);
        $('#persentase_reject_internal_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="persentase_reject_internal_${baris}_neg[]" value="0" id="persentase_reject_internal_${baris}_${jumlahplate}_neg" style="width: 100px" readonly>
        `);
        $('#persentase_reject_eksternal_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="persentase_reject_eksternal_${baris}_neg[]" value="0" id="persentase_reject_eksternal_${baris}_${jumlahplate}_neg" style="width: 100px" readonly>
        `);
        $('#persentase_reject_akumulatif_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="persentase_reject_akumulatif_${baris}_neg[]" value="0" id="persentase_reject_akumulatif_${baris}_${jumlahplate}_neg" style="width: 100px" readonly>
        `);
        $('#terpotong_kg_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="terpotong_kg_${baris}_neg[]" id="terpotong_kg_${baris}_${jumlahplate}_neg" value="0" onkeyup="panel_neg(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#tersangkut_kg_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="tersangkut_kg_${baris}_neg[]" id="tersangkut_kg_${baris}_${jumlahplate}_neg" value="0" onkeyup="panel_neg(${baris}, ${jumlahplate})"  style="width: 75px">
        `);
        $('#overbrush_kg_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="overbrush_kg_${baris}_neg[]" id="overbrush_kg_${baris}_${jumlahplate}_neg" value="0" onkeyup="panel_neg(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#rontok_kg_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="rontok_kg_${baris}_neg[]" id="rontok_kg_${baris}_${jumlahplate}_neg" value="0" onkeyup="panel_neg(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#lug_patah_kg_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="lug_patah_kg_${baris}_neg[]" id="lug_patah_kg_${baris}_${jumlahplate}_neg" value="0" onkeyup="panel_neg(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#patah_kaki_kg_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="patah_kaki_kg_${baris}_neg[]" id="patah_kaki_kg_${baris}_${jumlahplate}_neg" value="0" onkeyup="panel_neg(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#patah_frame_kg_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="patah_frame_kg_${baris}_neg[]" id="patah_frame_kg_${baris}_${jumlahplate}_neg" value="0" onkeyup="panel_neg(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#bolong_kg_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="bolong_kg_${baris}_neg[]" id="bolong_kg_${baris}_${jumlahplate}_neg" value="0" onkeyup="panel_neg(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#bending_kg_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="bending_kg_${baris}_neg[]" id="bending_kg_${baris}_${jumlahplate}_neg" value="0" onkeyup="panel_neg(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('#lengket_terpotong_kg_section_' + baris + '_neg').append(`
            <input type="text" class="form-control" name="lengket_terpotong_kg_${baris}_neg[]" id="lengket_terpotong_kg_${baris}_${jumlahplate}_neg" value="0" onkeyup="panel_neg(${baris}, ${jumlahplate})" style="width: 75px">
        `);
        $('.select2').select2();
    }

    function add_platecutting_pos() {
        const baris = document.querySelectorAll('.form_pos').length;
        $('.form_platecutting_pos').append(`
			<tr class="form_pos" id="form_${baris}_pos">
                <td>${baris + 1}</td>
                <td>
                    <input type="date" class="form-control" id="date_${baris}_pos" name="date_pos[]" style="width: 150px" required>
                </td>
                <td>
                    <select class="form-control" id="line_${baris}_pos" name="line_pos[]" style="width: 200px;" required>
                        <option selected disabled>-- Pilih Line --</option>
                        <?php
                        for ($j = 1; $j <= 3; $j++) { ?>
                            <option value="<?= $j ?>"><?= $j ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" id="shift_${baris}_pos" name="shift_pos[]" style="width: 200px;" required>
                        <option selected disabled>-- Pilih Shift --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </td>
                <td>
                    <div id="plate_section_${baris}_pos">
                        <select class="form-control select2 plate_${baris}_pos" id="plate_${baris}_0_pos" onchange="panel_pos(${baris}, 0)" name="plate_${baris}_pos[]" style="width: 200px;" required>
                            <option selected disabled>-- Pilih Plate --</option>
                            <?php
                            $plate_pos = array_filter($plate, function ($p_pos) {
                                return strpos($p_pos['plate'], 'POS') !== false;
                            });
                            foreach ($plate_pos as $plt) {
                            ?>
                                <option value="<?= trim($plt['plate']) ?>"><?= trim($plt['plate']) ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" id="add_plate_${baris}_pos" onclick="add_plate_pos(${baris})">Add</button>
                </td>
                <td>
                    <div id="hasil_produksi_section_${baris}_pos">
                        <input type="text" class="form-control" name="hasil_produksi_${baris}_pos[]" value="0" id="hasil_produksi_${baris}_0_pos" onkeyup="panel_pos(${baris}, 0)" style="width: 100px">
                    </div>
                </td>
                <td>
                    <div id="terpotong_kg_section_${baris}_pos">
                        <input type="text" class="form-control" name="terpotong_kg_${baris}_pos[]" id="terpotong_kg_${baris}_0_pos" value="0" onkeyup="panel_pos(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="tersangkut_kg_section_${baris}_pos">
                        <input type="text" class="form-control" name="tersangkut_kg_${baris}_pos[]" id="tersangkut_kg_${baris}_0_pos" value="0" onkeyup="panel_pos(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="overbrush_kg_section_${baris}_pos">
                        <input type="text" class="form-control" name="overbrush_kg_${baris}_pos[]" id="overbrush_kg_${baris}_0_pos" value="0" onkeyup="panel_pos(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="rontok_kg_section_${baris}_pos">
                        <input type="text" class="form-control" name="rontok_kg_${baris}_pos[]" id="rontok_kg_${baris}_0_pos" value="0" onkeyup="panel_pos(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="lug_patah_kg_section_${baris}_pos">
                        <input type="text" class="form-control" name="lug_patah_kg_${baris}_pos[]" id="lug_patah_kg_${baris}_0_pos" value="0" onkeyup="panel_pos(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="patah_kaki_kg_section_${baris}_pos">
                        <input type="text" class="form-control" name="patah_kaki_kg_${baris}_pos[]" id="patah_kaki_kg_${baris}_0_pos" value="0" onkeyup="panel_pos(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="patah_frame_kg_section_${baris}_pos">
                        <input type="text" class="form-control" name="patah_frame_kg_${baris}_pos[]" id="patah_frame_kg_${baris}_0_pos" value="0" onkeyup="panel_pos(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="bolong_kg_section_${baris}_pos">
                        <input type="text" class="form-control" name="bolong_kg_${baris}_pos[]" id="bolong_kg_${baris}_0_pos" value="0" onkeyup="panel_pos(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="bending_kg_section_${baris}_pos">
                        <input type="text" class="form-control" name="bending_kg_${baris}_pos[]" id="bending_kg_${baris}_0_pos" value="0" onkeyup="panel_pos(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="lengket_terpotong_kg_section_${baris}_pos">
                        <input type="text" class="form-control" name="lengket_terpotong_kg_${baris}_pos[]" id="lengket_terpotong_kg_${baris}_0_pos" value="0" onkeyup="panel_pos(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="terpotong_panel_section_${baris}_pos">
                        <input type="text" class="form-control" name="terpotong_panel_${baris}_pos[]" value="0" id="terpotong_panel_${baris}_0_pos" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="tersangkut_panel_section_${baris}_pos">
                        <input type="text" class="form-control" name="tersangkut_panel_${baris}_pos[]" value="0" id="tersangkut_panel_${baris}_0_pos" style=" width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="overbrush_panel_section_${baris}_pos">
                        <input type="text" class="form-control" name="overbrush_panel_${baris}_pos[]" value="0" id="overbrush_panel_${baris}_0_pos" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="rontok_panel_section_${baris}_pos">
                        <input type="text" class="form-control" name="rontok_panel_${baris}_pos[]" value="0" id="rontok_panel_${baris}_0_pos" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="lug_patah_panel_section_${baris}_pos">
                        <input type="text" class="form-control" name="lug_patah_panel_${baris}_pos[]" value="0" id="lug_patah_panel_${baris}_0_pos" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="patah_kaki_panel_section_${baris}_pos">
                        <input type="text" class="form-control" name="patah_kaki_panel_${baris}_pos[]" value="0" id="patah_kaki_panel_${baris}_0_pos" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="patah_frame_panel_section_${baris}_pos">
                        <input type="text" class="form-control" name="patah_frame_panel_${baris}_pos[]" value="0" id="patah_frame_panel_${baris}_0_pos" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="bolong_panel_section_${baris}_pos">
                        <input type="text" class="form-control" name="bolong_panel_${baris}_pos[]" value="0" id="bolong_panel_${baris}_0_pos" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="bending_panel_section_${baris}_pos">
                        <input type="text" class="form-control" name="bending_panel_${baris}_pos[]" value="0" id="bending_panel_${baris}_0_pos" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="lengket_terpotong_panel_section_${baris}_pos">
                        <input type="text" class="form-control" name="lengket_terpotong_panel_${baris}_pos[]" value="0" id="lengket_terpotong_panel_${baris}_0_pos" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="persentase_reject_internal_section_${baris}_pos">
                        <input type="text" class="form-control" name="persentase_reject_internal_${baris}_pos[]" value="0" id="persentase_reject_internal_${baris}_0_pos" style="width: 100px" readonly>
                    </div>
                </td>
                <td>
                    <div id="persentase_reject_eksternal_section_${baris}_pos">
                        <input type="text" class="form-control" name="persentase_reject_eksternal_${baris}_pos[]" value="0" id="persentase_reject_eksternal_${baris}_0_pos" style="width: 100px" readonly>
                    </div>
                </td>
                <td>
                    <div id="persentase_reject_akumulatif_section_${baris}_pos">
                        <input type="text" class="form-control" name="persentase_reject_akumulatif_${baris}_pos[]" value="0" id="persentase_reject_akumulatif_${baris}_0_pos" style="width: 100px" readonly>
                    </div>
                </td>
            </tr>
		`);
        $('.select2').select2();
    }

    function add_platecutting_neg() {
        const baris = document.querySelectorAll('.form_neg').length;
        $('.form_platecutting_neg').append(`
			<tr class="form_neg" id="form_${baris}_neg">
                <td>${baris + 1}</td>
                <td>
                    <input type="date" class="form-control" id="date_${baris}_neg" name="date_neg[]" style="width: 150px" required>
                </td>
                <td>
                    <select class="form-control" id="line_${baris}_neg" name="line_neg[]" style="width: 200px;" required>
                        <option selected disabled>-- Pilih Line --</option>
                        <?php
                        for ($j = 1; $j <= 3; $j++) { ?>
                            <option value="<?= $j ?>"><?= $j ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" id="shift_${baris}_neg" name="shift_neg[]" style="width: 200px;" required>
                        <option selected disabled>-- Pilih Shift --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </td>
                <td>
                    <div id="plate_section_${baris}_neg">
                        <select class="form-control select2 plate_${baris}_neg" id="plate_${baris}_0_neg" onchange="panel_neg(${baris}, 0)" name="plate_${baris}_neg[]" style="width: 200px;" required>
                            <option selected disabled>-- Pilih Plate --</option>
                            <?php
                            $plate_neg = array_filter($plate, function ($p_neg) {
                                return strpos($p_neg['plate'], 'NEG') !== false;
                            });
                            foreach ($plate_neg as $plt) {
                            ?>
                                <option value="<?= trim($plt['plate']) ?>"><?= trim($plt['plate']) ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" id="add_plate_${baris}_neg" onclick="add_plate_neg(${baris})">Add</button>
                </td>
                <td>
                    <div id="hasil_produksi_section_${baris}_neg">
                        <input type="text" class="form-control" name="hasil_produksi_${baris}_neg[]" value="0" id="hasil_produksi_${baris}_0_neg" onkeyup="panel_neg(${baris}, 0)" style="width: 100px">
                    </div>
                </td>
                <td>
                    <div id="terpotong_kg_section_${baris}_neg">
                        <input type="text" class="form-control" name="terpotong_kg_${baris}_neg[]" id="terpotong_kg_${baris}_0_neg" value="0" onkeyup="panel_neg(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="tersangkut_kg_section_${baris}_neg">
                        <input type="text" class="form-control" name="tersangkut_kg_${baris}_neg[]" id="tersangkut_kg_${baris}_0_neg" value="0" onkeyup="panel_neg(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="overbrush_kg_section_${baris}_neg">
                        <input type="text" class="form-control" name="overbrush_kg_${baris}_neg[]" id="overbrush_kg_${baris}_0_neg" value="0" onkeyup="panel_neg(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="rontok_kg_section_${baris}_neg">
                        <input type="text" class="form-control" name="rontok_kg_${baris}_neg[]" id="rontok_kg_${baris}_0_neg" value="0" onkeyup="panel_neg(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="lug_patah_kg_section_${baris}_neg">
                        <input type="text" class="form-control" name="lug_patah_kg_${baris}_neg[]" id="lug_patah_kg_${baris}_0_neg" value="0" onkeyup="panel_neg(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="patah_kaki_kg_section_${baris}_neg">
                        <input type="text" class="form-control" name="patah_kaki_kg_${baris}_neg[]" id="patah_kaki_kg_${baris}_0_neg" value="0" onkeyup="panel_neg(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="patah_frame_kg_section_${baris}_neg">
                        <input type="text" class="form-control" name="patah_frame_kg_${baris}_neg[]" id="patah_frame_kg_${baris}_0_neg" value="0" onkeyup="panel_neg(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="bolong_kg_section_${baris}_neg">
                        <input type="text" class="form-control" name="bolong_kg_${baris}_neg[]" id="bolong_kg_${baris}_0_neg" value="0" onkeyup="panel_neg(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="bending_kg_section_${baris}_neg">
                        <input type="text" class="form-control" name="bending_kg_${baris}_neg[]" id="bending_kg_${baris}_0_neg" value="0" onkeyup="panel_neg(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="lengket_terpotong_kg_section_${baris}_neg">
                        <input type="text" class="form-control" name="lengket_terpotong_kg_${baris}_neg[]" id="lengket_terpotong_kg_${baris}_0_neg" value="0" onkeyup="panel_neg(${baris}, 0)" style="width: 75px">
                    </div>
                </td>
                <td>
                    <div id="terpotong_panel_section_${baris}_neg">
                        <input type="text" class="form-control" name="terpotong_panel_${baris}_neg[]" value="0" id="terpotong_panel_${baris}_0_neg" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="tersangkut_panel_section_${baris}_neg">
                        <input type="text" class="form-control" name="tersangkut_panel_${baris}_neg[]" value="0" id="tersangkut_panel_${baris}_0_neg" style=" width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="overbrush_panel_section_${baris}_neg">
                        <input type="text" class="form-control" name="overbrush_panel_${baris}_neg[]" value="0" id="overbrush_panel_${baris}_0_neg" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="rontok_panel_section_${baris}_neg">
                        <input type="text" class="form-control" name="rontok_panel_${baris}_neg[]" value="0" id="rontok_panel_${baris}_0_neg" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="lug_patah_panel_section_${baris}_neg">
                        <input type="text" class="form-control" name="lug_patah_panel_${baris}_neg[]" value="0" id="lug_patah_panel_${baris}_0_neg" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="patah_kaki_panel_section_${baris}_neg">
                        <input type="text" class="form-control" name="patah_kaki_panel_${baris}_neg[]" value="0" id="patah_kaki_panel_${baris}_0_neg" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="patah_frame_panel_section_${baris}_neg">
                        <input type="text" class="form-control" name="patah_frame_panel_${baris}_neg[]" value="0" id="patah_frame_panel_${baris}_0_neg" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="bolong_panel_section_${baris}_neg">
                        <input type="text" class="form-control" name="bolong_panel_${baris}_neg[]" value="0" id="bolong_panel_${baris}_0_neg" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="bending_panel_section_${baris}_neg">
                        <input type="text" class="form-control" name="bending_panel_${baris}_neg[]" value="0" id="bending_panel_${baris}_0_neg" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="lengket_terpotong_panel_section_${baris}_neg">
                        <input type="text" class="form-control" name="lengket_terpotong_panel_${baris}_neg[]" value="0" id="lengket_terpotong_panel_${baris}_0_neg" style="width: 75px" readonly>
                    </div>
                </td>
                <td>
                    <div id="persentase_reject_internal_section_${baris}_neg">
                        <input type="text" class="form-control" name="persentase_reject_internal_${baris}_neg[]" value="0" id="persentase_reject_internal_${baris}_0_neg" style="width: 100px" readonly>
                    </div>
                </td>
                <td>
                    <div id="persentase_reject_eksternal_section_${baris}_neg">
                        <input type="text" class="form-control" name="persentase_reject_eksternal_${baris}_neg[]" value="0" id="persentase_reject_eksternal_${baris}_0_neg" style="width: 100px" readonly>
                    </div>
                </td>
                <td>
                    <div id="persentase_reject_akumulatif_section_${baris}_neg">
                        <input type="text" class="form-control" name="persentase_reject_akumulatif_${baris}_neg[]" value="0" id="persentase_reject_akumulatif_${baris}_0_neg" style="width: 100px" readonly>
                    </div>
                </td>
            </tr>
		`);
        $('.select2').select2();
    }

    function delete_platecutting_pos() {
        const baris = document.querySelectorAll('.form_pos');
        const element = document.getElementById('form_' + (baris.length - 1) + '_pos');
        element.parentNode.removeChild(element);
    }

    function delete_platecutting_neg() {
        const baris = document.querySelectorAll('.form_neg');
        const element = document.getElementById('form_' + (baris.length - 1) + '_neg');
        element.parentNode.removeChild(element);
    }
</script>
<?= $this->endSection(); ?>