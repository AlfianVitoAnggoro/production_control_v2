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
                            <h4>Detail Envelope</h4>
                        </div>
                        <div class="box-body">
                            <form action="/envelope/save" method="post">
                                <div class="row">
                                    <input type="hidden" name="id_envelope" value="<?= $envelope['id']; ?>">
                                    <div class="col">
                                        <label for="date" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="date" name="date" value="<?= $envelope['date'] ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="line" class="form-label">Line</label>
                                        <select class="form-control" id="line" name="line" required>
                                            <option value="" disabled>-- Pilih Line --</option>
                                            <?php
                                            for ($j = 1; $j <= 7; $j++) {
                                                if ($envelope['line'] === $j) { ?>
                                                    <option selected value="<?= $j ?>"><?= $j ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $j ?>"><?= $j ?></option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="shift" class="form-label">Shift</label>
                                        <select class="form-control" id="shift" name="shift" required>
                                            <option value="" disabled>-- Pilih Shift --</option>
                                            <?php
                                            for ($j = 1; $j <= 3; $j++) {
                                                if ($envelope['shift'] === $j) { ?>
                                                    <option selected value="<?= $j ?>"><?= $j ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $j ?>"><?= $j ?></option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="team" class="form-label">Team</label>
                                        <select class="form-control" id="team" name="team" required>
                                            <option value="" disabled>-- Pilih Team --</option>
                                            <?php
                                            foreach ($team as $t) {
                                                if ($envelope['team'] === $t['team']) { ?>
                                                    <option selected value="<?= $envelope['team'] ?>"><?= $envelope['team'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $t['team'] ?>"><?= $t['team'] ?></option>
                                            <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <h1>Envelope</h1>
                                <div>
                                    <button type="button" class="btn btn-primary" id="add_form" onclick="add_envelope()">Add</button>
                                    <button type="button" class="btn btn-danger" id="delete_form" onclick="delete_envelope()">Delete</button>
                                </div>
                                <div class="table-responsive">
                                    <table id="" class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th colspan="4"></th>
                                                <th colspan="7" class="text-center">Jumlah NG (Pcs)</th>
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
                                        </thead>
                                        <tbody class="form_envelope">
                                            <!-- <tr class="form" id="form_0">
                                                <td>1</td>
                                                <td style="width:200px;">
                                                    <select class="form-control select2 plate" id="plate_0" onchange="panel(0)" name="plate[]" style="width: 200px;" required>
                                                        <option selected value="" disabled>-- Pilih Plate --</option>
                                                        <?php
                                                        $plate_pos = array_filter($plate, function ($p) {
                                                            return strpos($p['plate'], 'POS') !== false;
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
                                                    <input type="text" class="form-control" name="hasil_produksi[]" id="hasil_produksi_0" onkeyup="panel(0)" style="width: 100px" required>
                                                </td>
                                                <td style="width: 200px;">
                                                    <select class="form-control select2" id="separator_0" onchange="panel(0)" name="separator[]" style="width: 200px;" required>
                                                        <option selected value="" disabled>-- Pilih Separator --</option>
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
                                                    <input type="text" class="form-control" name="melintir_bending[]" id="melintir_bending_0" value="0" onkeyup="panel(0)" style="width: 75px">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="terpotong[]" id="terpotong_0" value="0" onkeyup="panel(0)" style="width: 75px">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="rontok[]" id="rontok_0" value="0" onkeyup="panel(0)" style="width: 75px">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="tersangkut[]" id="tersangkut_0" value="0" onkeyup="panel(0)" style="width: 75px">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="persentase_reject_akumulatif[]" id="persentase_reject_akumulatif_0" value="0 %" style="width: 100px" readonly>
                                                </td>
                                            </tr> -->
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
                if ($('#plate_' + baris + '_pos').val() === "<?= trim($p['plate']) ?>") {
                    melintir_bending = (melintir_bending / <?= $p['berat'] ?>) * (110 / 100);
                    terpotong = (terpotong / <?= $p['berat'] ?>) * (110 / 100);
                    rontok = (rontok / <?= $p['berat'] ?>) * (110 / 100);
                    tersangkut = (tersangkut / <?= $p['berat'] ?>) * (110 / 100);
                }
            <?php endforeach ?>
        }
        $('#melintir_bending_' + baris).val(Math.ceil(melintir_bending));
        $('#terpotong_' + baris).val(Math.ceil(terpotong));
        $('#rontok_' + baris).val(Math.ceil(rontok));
        $('#tersangkut_' + baris).val(Math.ceil(tersangkut));
        $('#persentase_reject_akumulatif_' + baris).val((100 * (Math.ceil(melintir_bending) + Math.ceil(terpotong) + Math.ceil(tersangkut) + Math.ceil(rontok)) / $('#hasil_produksi_' + baris).val()).toPrecision(3) + ' %');
    }

    function data_envelope() {
        let baris = 0;
        <?php for ($i = 0; $i < count($envelopeinput); $i++) { ?>
            baris = document.querySelectorAll('.form').length;
            $('.form_envelope').append(`
			<tr class="form" id="form_${baris}">
                <input type="hidden" name="id_envelopeinput[]" value="<?= $envelopeinput[$i]['id']; ?>">
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
                            <?php if (trim($envelopeinput[$i]['plate']) === trim($plt['plate'])) : ?>
                                <option value="<?= trim($envelopeinput[$i]['plate']) ?>" selected><?= trim($envelopeinput[$i]['plate']) ?></option>
                            <?php else : ?>
                                <option value="<?= trim($plt['plate']) ?>"><?= trim($plt['plate']) ?></option>
                            <?php endif ?>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" name="hasil_produksi[]" id="hasil_produksi_${baris}" onkeyup="panel(${baris})" value="<?= trim($envelopeinput[$i]['hasil_produksi']) ?>" style="width: 100px">
                </td>
                <td>
                    <select class="form-control select2" id="separator_${baris}" onchange="panel(${baris})" name="separator[]" style="width: 200px;">
                        <option value="">-- Pilih Separator --</option>
                        <?php
                        foreach ($separator as $spr) {
                        ?>
                            <?php if ($envelopeinput[$i]['separator'] === $spr['separator']) : ?>
                                <option value="<?= trim($envelopeinput[$i]['separator']) ?>" selected><?= trim($envelopeinput[$i]['separator']) ?></option>
                            <?php else : ?>
                                <option value="<?= trim($spr['separator']) ?>"><?= trim($spr['separator']) ?></option>
                            <?php endif ?>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" name="melintir_bending[]" id="melintir_bending_${baris}" value="<?= trim($envelopeinput[$i]['melintir_bending']) ?>" onkeyup="panel(${baris})" style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="terpotong[]" id="terpotong_${baris}" value="<?= trim($envelopeinput[$i]['terpotong']) ?>" onkeyup="panel(${baris})" style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="rontok[]" id="rontok_${baris}" value="<?= trim($envelopeinput[$i]['rontok']) ?>" onkeyup="panel(${baris})" style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="tersangkut[]" id="tersangkut_${baris}" value="<?= trim($envelopeinput[$i]['tersangkut']) ?>" onkeyup="panel(${baris})" style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="persentase_reject_akumulatif[]" id="persentase_reject_akumulatif_${baris}" value="<?= trim($envelopeinput[$i]['persentase_reject_akumulatif']) ?>" style="width: 100px" readonly>
                </td>
            </tr>
		`);
            $('.select2').select2();
        <?php } ?>
    }
    data_envelope();

    function add_envelope() {
        const baris = document.querySelectorAll('.form').length;
        $('.form_envelope').append(`
			<tr class="form" id="form_${baris}">
                <input type="hidden" name="id_envelopeinput[]" value="">
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
                    <input type="text" class="form-control" name="melintir_bending[]" id="melintir_bending_${baris}" value="0" onkeyup="panel(${baris})" style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="terpotong[]" id="terpotong_${baris}" value="0" onkeyup="panel(${baris})" style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="rontok[]" id="rontok_${baris}" value="0" onkeyup="panel(${baris})" style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="tersangkut[]" id="tersangkut_${baris}" value="0" onkeyup="panel(${baris})" style="width: 75px">
                </td>
                <td>
                    <input type="text" class="form-control" name="persentase_reject_akumulatif[]" id="persentase_reject_akumulatif_${baris}" value="0 %" style="width: 100px" readonly>
                </td>
            </tr>
		`);
        $('.select2').select2();
    }

    function delete_envelope() {
        const baris = document.querySelectorAll('.form');
        const element = document.getElementById('form_' + (baris.length - 1));
        element.parentNode.removeChild(element);
    }
</script>
<?= $this->endSection(); ?>