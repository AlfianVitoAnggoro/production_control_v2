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
                                    <a href="/lhp/envelope/add_envelope" class="btn btn-primary">
                                        Tambah Envelope
                                    </a>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th colspan="4"></th>
                                                    <th colspan="7" class="text-center">Jumlah NG (Pcs)</th>
                                                </tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Line</th>
                                                    <th>Shift</th>
                                                    <th style="width: 125px;">Plate</th>
                                                    <th>Hasil Produksi</th>
                                                    <th>Separator</th>
                                                    <th>Melintir/ Bending</th>
                                                    <th>Terpotong</th>
                                                    <th>Rontok</th>
                                                    <th>Tersangkut</th>
                                                    <th>% Akumulatif</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_envelope">
                                                <?php
                                                $number = 0;
                                                ?>
                                                <?php foreach ($envelope as $envl) : ?>
                                                    <?php
                                                    $number++;
                                                    ?>
                                                    <tr>
                                                        <th><?= $number ?></th>
                                                        <td><?= $envl['date'] ?></td>
                                                        <td><?= $envl['line'] ?></td>
                                                        <td><?= $envl['shift'] ?></td>
                                                        <td style="width: 125px;">
                                                            <div class="plate-section" style="width: 125px;">
                                                                <?php foreach ($envelopeinput as $ei) : ?>
                                                                    <?php if ($envl['id_envelopeinput'] === $ei['id']) : ?>
                                                                        <?= $ei['plate'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="hasil_produksi_section">
                                                                <?php foreach ($envelopeinput as $ei) : ?>
                                                                    <?php if ($envl['id_envelopeinput'] === $ei['id']) : ?>
                                                                        <?= $ei['hasil_produksi'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="separator_section">
                                                                <?php foreach ($envelopeinput as $ei) : ?>
                                                                    <?php if ($envl['id_envelopeinput'] === $ei['id']) : ?>
                                                                        <?= $ei['separator'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="melintir_bending_section">
                                                                <?php foreach ($envelopeinput as $ei) : ?>
                                                                    <?php if ($envl['id_envelopeinput'] === $ei['id']) : ?>
                                                                        <?= $ei['melintir_bending'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="terpotong_section">
                                                                <?php foreach ($envelopeinput as $ei) : ?>
                                                                    <?php if ($envl['id_envelopeinput'] === $ei['id']) : ?>
                                                                        <?= $ei['terpotong'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="rontok_section">
                                                                <?php foreach ($envelopeinput as $ei) : ?>
                                                                    <?php if ($envl['id_envelopeinput'] === $ei['id']) : ?>
                                                                        <?= $ei['rontok'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="tersangkut_section">
                                                                <?php foreach ($envelopeinput as $ei) : ?>
                                                                    <?php if ($envl['id_envelopeinput'] === $ei['id']) : ?>
                                                                        <?= $ei['tersangkut'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="persentase_reject_akumulatif_section">
                                                                <?php foreach ($envelopeinput as $ei) : ?>
                                                                    <?php if ($envl['id_envelopeinput'] === $ei['id']) : ?>
                                                                        <?= $ei['persentase_reject_akumulatif'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                    </tr>
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
</script>
<?= $this->endSection(); ?>