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
                                    <h4 class="box-title">Laporan Envelope</h4>
                                    <a href="/envelope/add_envelope" class="btn btn-primary">
                                        Tambah Envelope
                                    </a>
                                </div>
                                <div class="box-body">
                                    <a href="/envelope/download" class="btn btn-danger">Download</a>
                                    <div class="table-responsive">
                                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th colspan="5"></th>
                                                    <th colspan="7" class="text-center">Jumlah NG (Pcs)</th>
                                                    <th colspan="3"></th>
                                                </tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th style="width: 150px;">Date</th>
                                                    <th>Line</th>
                                                    <th>Shift</th>
                                                    <th>Team</th>
                                                    <th style="width: 125px;">Plate</th>
                                                    <th>Hasil Produksi</th>
                                                    <th>Separator</th>
                                                    <th>Melintir/ Bending</th>
                                                    <th>Terpotong</th>
                                                    <th>Rontok</th>
                                                    <th>Tersangkut</th>
                                                    <th>% Akumulatif</th>
                                                    <th>Status</th>
                                                    <?php if ($session['level'] === 1) : ?>
                                                        <th>Aksi</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody id="table_envelope">
                                                <?php
                                                $isExist = [];
                                                $number = 0;
                                                ?>
                                                <?php foreach ($envelope as $envl) : ?>
                                                    <?php
                                                    if (!array_key_exists($envl['id'], $isExist)) :
                                                        $isExist[$envl['id']] = $envl['id'];
                                                        $number++;
                                                    ?>
                                                        <tr>
                                                            <th><?= $number ?></th>
                                                            <td style="width: 150px;"><?= $envl['date'] ?></td>
                                                            <td><?= $envl['line'] ?></td>
                                                            <td><?= $envl['shift'] ?></td>
                                                            <td><?= $envl['team'] ?></td>
                                                            <td style="width: 125px;">
                                                                <div class="plate-section" style="width: 125px;">
                                                                    <?php foreach ($envelopeinput as $ei) : ?>
                                                                        <?php if ($envl['id'] === $ei['id_envelope']) : ?>
                                                                            <?= $ei['plate'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="hasil_produksi_section">
                                                                    <?php foreach ($envelopeinput as $ei) : ?>
                                                                        <?php if ($envl['id'] === $ei['id_envelope']) : ?>
                                                                            <?= $ei['hasil_produksi'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="separator_section">
                                                                    <?php foreach ($envelopeinput as $ei) : ?>
                                                                        <?php if ($envl['id'] === $ei['id_envelope']) : ?>
                                                                            <?= $ei['separator'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="melintir_bending_section">
                                                                    <?php foreach ($envelopeinput as $ei) : ?>
                                                                        <?php if ($envl['id'] === $ei['id_envelope']) : ?>
                                                                            <?= $ei['melintir_bending'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="terpotong_section">
                                                                    <?php foreach ($envelopeinput as $ei) : ?>
                                                                        <?php if ($envl['id'] === $ei['id_envelope']) : ?>
                                                                            <?= $ei['terpotong'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="rontok_section">
                                                                    <?php foreach ($envelopeinput as $ei) : ?>
                                                                        <?php if ($envl['id'] === $ei['id_envelope']) : ?>
                                                                            <?= $ei['rontok'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="tersangkut_section">
                                                                    <?php foreach ($envelopeinput as $ei) : ?>
                                                                        <?php if ($envl['id'] === $ei['id_envelope']) : ?>
                                                                            <?= $ei['tersangkut'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="persentase_reject_akumulatif_section">
                                                                    <?php foreach ($envelopeinput as $ei) : ?>
                                                                        <?php if ($envl['id'] === $ei['id_envelope']) : ?>
                                                                            <?= $ei['persentase_reject_akumulatif'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <?php foreach ($envelopeinput as $ei) :
                                                                        if ($envl['id'] === $ei['id_envelope']) :
                                                                            if (trim($envl['status']) === 'approved') :
                                                                    ?>
                                                                                <span class="badge bg-success">Approved</span>
                                                                            <?php break;
                                                                            elseif (trim($envl['status']) === 'pending') : ?>
                                                                                <span class="badge bg-warning">Pending</span>
                                                                            <?php break;
                                                                            elseif (trim($envl['status']) === 'rejected') : ?>
                                                                                <span class="badge bg-danger">Rejected</span>
                                                                            <?php break;
                                                                            endif ?>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <?php if ($session['level'] === 1) : ?>
                                                                <td>
                                                                    <div>
                                                                        <?php foreach ($envelopeinput as $ei) :
                                                                            if ($envl['id'] === $ei['id_envelope']) :
                                                                        ?>
                                                                                <a href="/envelope/detail_envelope/<?= trim($envl['id']) ?>" class="btn btn-primary">Detail</a>
                                                                            <?php break;
                                                                            endif ?>
                                                                        <?php endforeach ?>
                                                                    </div>
                                                                </td>
                                                            <?php endif ?>
                                                        </tr>
                                                    <?php endif ?>
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
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('#example5').DataTable();
    });
</script>
<?= $this->endSection(); ?>