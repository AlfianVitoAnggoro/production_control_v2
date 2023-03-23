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
                            <form action="/lhp/envelope/detail_envelope/edit" method="post">
                                <div class="row">
                                    <input type="hidden" name="id_envelope" value="<?= trim($envelope['id']); ?>">
                                    <div class="col">
                                        <label for="date" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="date_0" name="date" value="<?= $envelope['date']; ?>" required readonly>
                                    </div>
                                    <div class="col">
                                        <label for="line" class="form-label">Line</label>
                                        <select class="form-control" id="line_0" name="line" required disabled>
                                            <option value="" disabled>-- Pilih Line --</option>
                                            <?php
                                            for ($j = 1; $j <= 3; $j++) {
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
                                        <select class="form-control" id="shift_0" name="shift" required disabled>
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
                                        <select class="form-control" id="team_0" name="team" required disabled>
                                            <option value="" disabled>-- Pilih Team --</option>
                                            <?php
                                            foreach ($team as $t) {
                                                if ($envelope['shift'] === $t['team']) { ?>
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
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center my-2 button">
                                    <?php if ($envelope['status'] === 'edit') : ?>
                                        <button type="button" class="btn btn-danger" onclick="reject_button()">Reject</button>
                                        <button type="button" class="btn btn-warning" onclick="edit_button()">Edit</button>
                                        <button type="button" class="btn btn-success" onclick="approve_button()">Approve</button>
                                    <?php else : ?>
                                        <a href="/lhp/envelope" class="btn btn-primary">Back</a>
                                    <?php endif ?>
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

    function add_envelope() {
        let baris = 0;
        <?php for ($i = 0; $i < count($envelopeinput); $i++) { ?>
            baris = document.querySelectorAll('.form').length;
            $('.form_envelope').append(`
			<tr class="form" id="form_${baris}">
                <input type="hidden" name="id[]" value="<?= $envelopeinput[$i]['id']; ?>">
                <td>${baris + 1}</td>
                <td>
                    <select class="form-control select2" id="plate_${baris}" onchange="panel(${baris})" name="plate[]" style="width: 200px;" required disabled>
                        <option value="" disabled>-- Pilih Plate --</option>
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
                    <input type="text" class="form-control" name="hasil_produksi[]" id="hasil_produksi_${baris}" onkeyup="panel(${baris})" value="<?= trim($envelopeinput[$i]['hasil_produksi']) ?>" style="width: 100px" required readonly>
                </td>
                <td>
                    <select class="form-control select2" id="separator_${baris}" onchange="panel(${baris})" name="separator[]" style="width: 200px;" required disabled>
                        <option value="" disabled>-- Pilih Separator --</option>
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
                    <input type="text" class="form-control" name="melintir_bending[]" id="melintir_bending_${baris}" value="<?= trim($envelopeinput[$i]['melintir_bending']) ?>" onkeyup="panel(${baris})" style="width: 75px" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="terpotong[]" id="terpotong_${baris}" value="<?= trim($envelopeinput[$i]['terpotong']) ?>" onkeyup="panel(${baris})" style="width: 75px" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="rontok[]" id="rontok_${baris}" value="<?= trim($envelopeinput[$i]['rontok']) ?>" onkeyup="panel(${baris})" style="width: 75px" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="tersangkut[]" id="tersangkut_${baris}" value="<?= trim($envelopeinput[$i]['tersangkut']) ?>" onkeyup="panel(${baris})" style="width: 75px" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="persentase_reject_akumulatif[]" id="persentase_reject_akumulatif_${baris}" value="<?= trim($envelopeinput[$i]['persentase_reject_akumulatif']) ?>" style="width: 100px" readonly>
                </td>
            </tr>
		`);
            $('.select2').select2();
        <?php } ?>
    }
    add_envelope();

    function edit_button() {
        const baris = document.querySelectorAll('.form').length;
        for (let i = 0; i < baris; i++) {
            $('#plate_' + i).removeAttr('disabled');
            $('#hasil_produksi_' + i).removeAttr('readonly');
            $('#separator_' + i).removeAttr('disabled');
            $('#melintir_bending_' + i).removeAttr('readonly');
            $('#terpotong_' + i).removeAttr('readonly');
            $('#rontok_' + i).removeAttr('readonly');
            $('#tersangkut_' + i).removeAttr('readonly');
        }
        const buttonElement = document.querySelector('.button');
        buttonElement.innerHTML = '';
        buttonElement.innerHTML = `
            <button type="submit" class="btn btn-warning" name="edit" value="edit">Konfirmasi</button>
        `;
    }

    function reject_button() {
        const buttonElement = document.querySelector('.button');
        buttonElement.innerHTML = '';
        buttonElement.innerHTML = `
            <button type="submit" class="btn btn-danger" name="rejected" value="rejected">Konfirmasi</button>
        `;
    }

    function approve_button() {
        const buttonElement = document.querySelector('.button');
        buttonElement.innerHTML = '';
        buttonElement.innerHTML = `
            <button type="submit" class="btn btn-success" name="approved" value="approved">Konfirmasi</button>
        `;
    }
</script>
<?= $this->endSection(); ?>