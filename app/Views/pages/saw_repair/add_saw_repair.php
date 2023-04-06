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
                            <form action="/saw_repair/save" method="post">
                                <div class="row">
                                    <input type="hidden" name="id_saw_repair" value="<?= $saw_repair['id']; ?>">
                                    <div class="col">
                                        <label for="date" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="date" name="date" value="<?= $saw_repair['date'] ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="shift" class="form-label">Shift</label>
                                        <select class="form-control" id="shift" name="shift" required>
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
                                <div>
                                    <button type="button" class="btn btn-primary" id="add_form" onclick="add_saw_repair()">Add</button>
                                    <button type="button" class="btn btn-danger" id="delete_form" onclick="delete_saw_repair()">Delete</button>
                                </div>
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead class="header_saw_repair">
                                        </thead>
                                        <tbody class="form_saw_repair">
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
        const plate = $('#plate_' + baris).val();
        let melintir_bending = $('#melintir_bending_' + baris).val() ? parseFloat($('#melintir_bending_' + baris).val()) : 0;
        let terpotong = $('#terpotong_' + baris).val() ? parseFloat($('#terpotong_' + baris).val()) : 0;
        let rontok = $('#rontok_' + baris).val() ? parseFloat($('#rontok_' + baris).val()) : 0;
        let tersangkut = $('#tersangkut_' + baris).val() ? parseFloat($('#tersangkut_' + baris).val()) : 0;
        if (melintir_bending !== 0 || terpotong !== 0 || rontok !== 0 || tersangkut !== 0) {
            <?php foreach ($plate as $p) : ?>
                if ($('#plate_' + baris).val() === "<?= trim($p['plate']) ?>") {
                    melintir_bending = (melintir_bending / <?= $p['berat'] ?>) * (110 / 100);
                    terpotong = (terpotong / <?= $p['berat'] ?>) * (110 / 100);
                    rontok = (rontok / <?= $p['berat'] ?>) * (110 / 100);
                    tersangkut = (tersangkut / <?= $p['berat'] ?>) * (110 / 100);
                }
            <?php endforeach ?>
        }
        $('#melintir_bending_panel_' + baris).val(Math.ceil(melintir_bending));
        $('#terpotong_panel_' + baris).val(Math.ceil(terpotong));
        $('#rontok_panel_' + baris).val(Math.ceil(rontok));
        $('#tersangkut_panel_' + baris).val(Math.ceil(tersangkut));
        $('#persentase_reject_akumulatif_' + baris).val((100 * (Math.ceil(melintir_bending) + Math.ceil(terpotong) + Math.ceil(tersangkut) + Math.ceil(rontok)) / $('#hasil_produksi_' + baris).val()).toPrecision(3) + ' %');
    }

    function data_saw_repair() {
        let baris = 0;
        document.querySelector('.header_saw_repair').innerHTML = '';
        $('.header_saw_repair').append(`
            <tr>
                <th colspan="4"></th>
                <th colspan="4" class="text-center">Jumlah NG (Panel)</th>
                <th></th>
            </tr>
            <tr>
                <th>No</th>
                <th>Tipe Plate</th>
                <th>Hasil Produksi</th>
                <th>Separator</th>
                <th>Melintir/ Bending</th>
                <th>Terpotong</th>
                <th>Rontok</th>
                <th>Tersangkut</th>
                <th>% Akumulatif</th>
            </tr>
        `);
        <?php for ($i = 0; $i < count($saw_repairinput); $i++) { ?>
            baris = document.querySelectorAll('.form').length;
            $('.form_saw_repair').append(`
            <tr class="form" id="form_${baris}">
                <input type="hidden" name="id_saw_repairinput[]" value="<?= $saw_repairinput[$i]['id']; ?>">
                <td>${baris + 1}</td>
                <td>
                    <select class="form-control select2" id="plate_${baris}" onchange="panel(${baris})" name="plate[]" style="width: 200px; background-color: #E8E2E2;">
                        <option value="">-- Pilih Plate --</option>
                        <?php
                        $plate_pos = array_filter($plate, function ($p) {
                            return strpos($p['plate'], 'POS') !== false;
                        });
                        foreach ($plate_pos as $plt) {
                        ?>
                            <?php if (trim($saw_repairinput[$i]['plate']) === trim($plt['plate'])) : ?>
                                <option value="<?= trim($saw_repairinput[$i]['plate']) ?>" selected><?= trim($saw_repairinput[$i]['plate']) ?></option>
                            <?php else : ?>
                                <option value="<?= trim($plt['plate']) ?>"><?= trim($plt['plate']) ?></option>
                            <?php endif ?>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" name="hasil_produksi[]" id="hasil_produksi_${baris}" onkeyup="persentase(${baris})" value="<?= trim($saw_repairinput[$i]['hasil_produksi']) ?>" style="width: 100px">
                </td>
                <td>
                    <select class="form-control select2" id="separator_${baris}" onchange="panel(${baris})" name="separator[]" style="width: 200px;">
                        <option value="">-- Pilih Separator --</option>
                        <?php
                        foreach ($separator as $spr) {
                        ?>
                            <?php if ($saw_repairinput[$i]['separator'] === $spr['separator']) : ?>
                                <option value="<?= trim($saw_repairinput[$i]['separator']) ?>" selected><?= trim($saw_repairinput[$i]['separator']) ?></option>
                            <?php else : ?>
                                <option value="<?= trim($spr['separator']) ?>"><?= trim($spr['separator']) ?></option>
                            <?php endif ?>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" name="melintir_bending_panel[]" id="melintir_bending_panel_${baris}" value="<?= trim($saw_repairinput[$i]['melintir_bending_panel']) ?>" onkeyup="persentase(${baris})"  style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="terpotong_panel[]" id="terpotong_panel_${baris}" value="<?= trim($saw_repairinput[$i]['terpotong_panel']) ?>" onkeyup="persentase(${baris})"  style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="rontok_panel[]" id="rontok_panel_${baris}" value="<?= trim($saw_repairinput[$i]['rontok_panel']) ?>" onkeyup="persentase(${baris})"  style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="tersangkut_panel[]" id="tersangkut_panel_${baris}" value="<?= trim($saw_repairinput[$i]['tersangkut_panel']) ?>" onkeyup="persentase(${baris})"  style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="persentase_reject_akumulatif[]" id="persentase_reject_akumulatif_${baris}" value="<?= trim($saw_repairinput[$i]['persentase_reject_akumulatif']) ?>" style="width: 100px" readonly>
                </td>
            </tr>
            `);
            $('.select2').select2();
        <?php } ?>
    }
    data_saw_repair();

    function add_saw_repair() {
        const baris = document.querySelectorAll('.form').length;
        $('.form_saw_repair').append(`
            <tr class="form" id="form_${baris}">
                <input type="hidden" name="id_saw_repairinput[]" value="">
                <td>${baris + 1}</td>
                <td>
                    <select class="form-control select2" id="plate_${baris}" onchange="panel(${baris})" name="plate[]" style="width: 200px;">
                        <option selected value="">-- Pilih Plate --</option>
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
                </td>
                <td>
                    <input type="text" class="form-control" name="hasil_produksi[]" id="hasil_produksi_${baris}" onkeyup="panel(${baris})" style="width: 100px">
                </td>
                <td>
                    <select class="form-control select2" id="separator_${baris}" onchange="panel(${baris})" name="separator[]" style="width: 200px;">
                        <option selected value="">-- Pilih Separator --</option>
                        <?php
                        foreach ($separator as $spr) {
                        ?>
                            <option value="<?= trim($spr['separator']) ?>"><?= trim($spr['separator']) ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" name="melintir_bending_panel[]" id="melintir_bending_panel_${baris}" value="0" style="width: 75px" onkeyup="persentase(${baris})">
                </td>
                <td>
                    <input type="text" class="form-control" name="terpotong_panel[]" id="terpotong_panel_${baris}" value="0" style="width: 75px" onkeyup="persentase(${baris})">
                </td>
                <td>
                    <input type="text" class="form-control" name="rontok_panel[]" id="rontok_panel_${baris}" value="0" style="width: 75px" onkeyup="persentase(${baris})">
                </td>
                <td>
                    <input type="text" class="form-control" name="tersangkut_panel[]" id="tersangkut_panel_${baris}" value="0" style="width: 75px" onkeyup="persentase(${baris})">
                </td>
                <td>
                    <input type="text" class="form-control" name="persentase_reject_akumulatif[]" id="persentase_reject_akumulatif_${baris}" value="0 %" style="width: 100px" readonly>
                </td>
            </tr>
        `);
        $('.select2').select2();
    }

    function delete_saw_repair() {
        const baris = document.querySelectorAll('.form');
        const element = document.getElementById('form_' + (baris.length - 1));
        element.parentNode.removeChild(element);
    }
</script>
<?= $this->endSection(); ?>