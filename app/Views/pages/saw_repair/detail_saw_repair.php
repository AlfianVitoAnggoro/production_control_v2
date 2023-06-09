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
                            <h4>Detail Saw Repair</h4>
                        </div>
                        <div class="box-body">
                            <form action="<?=base_url()?>saw_repair/detail_saw_repair/edit" method="post">
                                <div class="row">
                                    <input type="hidden" name="id_saw_repair" value="<?= $saw_repair['id']; ?>">
                                    <div class="col">
                                        <label for="date" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="date" name="date" value="<?= $saw_repair['date'] ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="shift" class="form-label">Shift</label>
                                        <select class="form-select" id="shift" name="shift" required>
                                            <option value="" disabled>-- Pilih Shift --</option>
                                            <?php
                                            for ($j = 1; $j <= 3; $j++) {
                                                if ($saw_repair['shift'] === $j) { ?>
                                                    <option selected value="<?= $j ?>"><?= $j ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $j ?>"><?= $j ?></option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <h1>Saw Repair</h1>
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead class="header_saw_repair">
                                            <tr>
                                                <th>No</th>
                                                <th>Operator Saw</th>
                                                <th>Type Battery Saw</th>
                                                <th>Qty Repair</th>
                                            </tr>
                                        </thead>
                                        <tbody class="form_saw_repair">
                                        </tbody>
                                    </table>
                                </div>
                                <h1>Potong Battery</h1>
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead class="header_potong_battery">
                                            <tr>
                                                <th colspan="2"></th>
                                                <th colspan="2" style="text-align: center;">Element OK</th>
                                                <th colspan="4" style="text-align: center;">Element NG</th>
                                            </tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Operator Potong</th>
                                                <th>Type Battery Saw</th>
                                                <th>Qty Element Potong</th>
                                                <th>Type Plate Reject Potong</th>
                                                <th>Qty Plate Reject Potong Kg</th>
                                                <th>Qty Plate Reject Potong Panel</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="form_potong_battery">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center my-2">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
    function panel(baris) {
        const type_plate_reject_potong = $('#type_plate_reject_potong_' + baris).val();
        let qty_plate_reject_potong_kg = $('#qty_plate_reject_potong_kg_' + baris).val() ? parseFloat($('#qty_plate_reject_potong_kg_' + baris).val()) : 0;
        if (qty_plate_reject_potong_kg !== 0) {
            <?php foreach ($plate as $p) : ?>
                if ($('#type_plate_reject_potong_' + baris).val() === "<?= trim($p['plate']) ?>") {
                    qty_plate_reject_potong_kg = (qty_plate_reject_potong_kg / <?= $p['berat'] ?>) * (110 / 100);
                }
            <?php endforeach ?>
        }
        $('#qty_plate_reject_potong_panel_' + baris).val(Math.ceil(qty_plate_reject_potong_kg));
    }

    function data_saw_repair() {
        let baris = 0;
        <?php for ($i = 0; $i < count($saw_repair_saw); $i++) { ?>
            baris = document.querySelectorAll('.saw_repair').length;
            if(baris === 0) {
                $('.form_saw_repair').append(`
                <tr class="saw_repair" id="form_saw_repair_${baris}">
                    <input type="hidden" name="id_saw_repair_saw[]" value="<?= $saw_repair_saw[$i]['id']; ?>">
                    <td>${baris + 1}</td>
                    <td>
                        <select class="form-select" id="operator_saw" name="operator_saw">
                            <option value="" selected>-- Nama Operator --</option>
                            <option value="M. Tohar" <?php if(trim($saw_repair_saw[$i]['operator_saw']) === "M. Tohar") echo "selected"?>>M. Tohar</option>
                            <option value="Purwanta" <?php if(trim($saw_repair_saw[$i]['operator_saw']) === "Purwanta") echo "selected"?>>Purwanta</option>
                            <option value="Sarjono" <?php if(trim($saw_repair_saw[$i]['operator_saw']) === "Sarjono") echo "selected"?>>Sarjono</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" id="type_battery_saw_${baris}" name="type_battery_saw[]">
                            <option value="" selected>-- Pilih Type Battery --</option>
                            <?php foreach($type_battery as $tb) : ?>
                                <option value="<?= $tb['type_battery'] ?>" <?php if($saw_repair_saw[$i]['type_battery_saw'] === $tb['type_battery']) echo "selected" ?>><?= $tb['type_battery'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="qty_repair_saw[]" id="qty_repair_saw_${baris}" value="<?= trim($saw_repair_saw[$i]['qty_repair_saw']) ?>">
                    </td>
                </tr>
                `);
            } else {
                $('.form_saw_repair').append(`
                <tr class="saw_repair" id="form_saw_repair_${baris}">
                    <input type="hidden" name="id_saw_repair_saw[]" value="<?= $saw_repair_saw[$i]['id']; ?>">
                    <td>${baris + 1}</td>
                    <td></td>
                    <td>
                        <select class="form-select" id="type_battery_saw_${baris}" name="type_battery_saw[]">
                            <option value="" selected>-- Pilih Type Battery --</option>
                            <?php foreach($type_battery as $tb) : ?>
                                <option value="<?= $tb['type_battery'] ?>" <?php if($saw_repair_saw[$i]['type_battery_saw'] === $tb['type_battery']) echo "selected" ?>><?= $tb['type_battery'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="qty_repair_saw[]" id="qty_repair_saw_${baris}" value="<?= trim($saw_repair_saw[$i]['qty_repair_saw']) ?>">
                    </td>
                </tr>
                `);
            }
            $('.select2').select2();
        <?php } ?>
    }
    data_saw_repair();

    function data_potong_battery() {
        let baris = 0;
        <?php for ($i = 0; $i < count($saw_repair_potong); $i++) {?>
            baris = document.querySelectorAll('.potong_battery').length;
            if(baris === 0) {
                $('.form_potong_battery').append(`
                    <tr class="potong_battery" id="form_potong_battery_${baris}">
                        <input type="hidden" name="id_saw_repair_potong[]" value="<?= $saw_repair_potong[$i]['id']; ?>">
                        <td>${baris + 1}</td>
                        <td>
                            <select class="form-select" id="operator_potong" name="operator_potong">
                                <option value="" selected>-- Nama Operator --</option>
                                <option value="Eko" <?php if(trim($saw_repair_potong[$i]['operator_potong']) === "Eko") echo "selected"?>>Eko</option>
                                <option value="Ali" <?php if(trim($saw_repair_potong[$i]['operator_potong']) === "Ali") echo "selected"?>>Ali</option>
                                <option value="Sahru" <?php if(trim($saw_repair_potong[$i]['operator_potong']) === "Sahru") echo "selected"?>>Sahru</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select" id="type_battery_potong_${baris}" name="type_battery_potong[]" onchange="panel(${baris})">
                                <option value="" selected>-- Pilih Type Battery --</option>
                                <?php foreach($type_battery as $tb) : ?>
                                    <option value="<?= $tb['type_battery'] ?>" <?php if($saw_repair_potong[$i]['type_battery_potong']) echo "selected"?>><?= $tb['type_battery'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="qty_element_potong[]" id="qty_element_potong_${baris}" value="<?= trim($saw_repair_potong[$i]['qty_element_potong']) ?>">
                        </td>
                        <td>
                            <select class="form-select select2" id="type_plate_reject_potong_${baris}" name="type_plate_reject_potong[]">
                                <option value="" selected>-- Pilih Type Plate --</option>
                                <?php foreach ($plate as $plt) { ?>
                                    <option value="<?= trim($plt['plate']) ?>" <?php if (trim($saw_repair_potong[$i]['type_plate_reject_potong']) === trim($plt['plate'])) echo "selected" ?>><?= trim($plt['plate']) ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="qty_plate_reject_potong_kg[]" id="qty_plate_reject_potong_kg_${baris}" value="<?= trim($saw_repair_potong[$i]['qty_plate_reject_potong_kg']) ?>" onkeyup="panel(${baris})">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="qty_plate_reject_potong_panel[]" id="qty_plate_reject_potong_panel_${baris}" value="<?= trim($saw_repair_potong[$i]['qty_plate_reject_potong_panel']) ?>" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="keterangan_potong[]" id="keterangan_potong_${baris}" value="<?= trim($saw_repair_potong[$i]['keterangan_potong']) ?>">
                        </td>
                    </tr>
                `);
            } else {
                $('.form_potong_battery').append(`
                    <tr class="potong_battery" id="form_potong_battery_${baris}">
                        <input type="hidden" name="id_saw_repair_potong[]" value="<?= $saw_repair_potong[$i]['id']; ?>">
                        <td>${baris + 1}</td>
                        <td></td>
                        <td>
                            <select class="form-select" id="type_battery_potong_${baris}" name="type_battery_potong[]">
                                <option value="" selected>-- Pilih Type Battery --</option>
                                <?php foreach($type_battery as $tb) : ?>
                                    <option value="<?= $tb['type_battery'] ?>" <?php if($saw_repair_potong[$i]['type_battery_potong']) echo "selected"?>><?= $tb['type_battery'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="qty_element_potong[]" id="qty_element_potong_${baris}" value="<?= trim($saw_repair_potong[$i]['qty_element_potong']) ?>">
                        </td>
                        <td>
                            <select class="form-select select2" id="type_plate_reject_potong_${baris}" name="type_plate_reject_potong[]" onchange="panel(${baris})">
                                <option value="" selected>-- Pilih Type Plate --</option>
                                <?php foreach ($plate as $plt) { ?>
                                    <option value="<?= trim($plt['plate']) ?>" <?php if (trim($saw_repair_potong[$i]['type_plate_reject_potong']) === trim($plt['plate'])) echo "selected" ?>><?= trim($plt['plate']) ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="qty_plate_reject_potong_kg[]" id="qty_plate_reject_potong_kg_${baris}" value="<?= trim($saw_repair_potong[$i]['qty_plate_reject_potong_kg']) ?>" onkeyup="panel(${baris})">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="qty_plate_reject_potong_panel[]" id="qty_plate_reject_potong_panel_${baris}" value="<?= trim($saw_repair_potong[$i]['qty_plate_reject_potong_panel']) ?>" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="keterangan_potong[]" id="keterangan_potong_${baris}" value="<?= trim($saw_repair_potong[$i]['keterangan_potong']) ?>">
                        </td>
                    </tr>
                `);
            }
            $('.select2').select2();
        <?php } ?>
    }
    data_potong_battery();
</script>
<?= $this->endSection(); ?>