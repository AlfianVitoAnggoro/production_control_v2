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
                                    <h4 class="box-title">Laporan Rejection Plate Cutting</h4>
                                    <a href="platecutting/add_platecutting" class="btn btn-primary">
                                        Tambah Plate Cutting
                                    </a>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th colspan="6"></th>
                                                    <th colspan="10" class="text-center">Jumlah NG (Panel)</th>
                                                    <th colspan="10" class="text-center">Jumlah NG (Kilogram)</th>
                                                    <th colspan="3" class="text-center"></th>
                                                </tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Line</th>
                                                    <th>Shift</th>
                                                    <th style="width: 125px;">Plate</th>
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
                                            <tbody id="table_platecutting">
                                                <?php
                                                $number = 0;
                                                ?>
                                                <?php foreach ($platecutting as $pc) : ?>
                                                    <?php
                                                    $number++;
                                                    ?>
                                                    <tr>
                                                        <th><?= $number ?></th>
                                                        <td><?= $pc['date'] ?></td>
                                                        <td><?= $pc['line'] ?></td>
                                                        <td><?= $pc['shift'] ?></td>
                                                        <td style="width: 125px;">
                                                            <div class="plate-section" style="width: 125px;">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['plate'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="hasil_produksi_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['hasil_produksi'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="terpotong_panel_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['terpotong_panel'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="tersangkut_panel_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['tersangkut_panel'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="overbrush_panel_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['overbrush_panel'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="rontok_panel_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['rontok_panel'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="lug_patah_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['lug_patah_panel'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="patah_kaki_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['patah_kaki_panel'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="patah_frame_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['patah_frame_panel'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="bolong_panel_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['bolong_panel'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="bending_panel_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['bending_panel'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="lengket_terpotong_panel_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['lengket_terpotong_panel'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="terpotong_kg_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['terpotong_kg'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="tersangkut_kg_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['tersangkut_kg'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="overbrush_kg_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['overbrush_kg'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="rontok_kg_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['rontok_kg'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="lug_patah_kg_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['lug_patah_kg'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="patah_kaki_kg_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['patah_kaki_kg'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="patah_frame_kg_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['patah_frame_kg'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="bolong_kg_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['bolong_kg'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="bending_kg_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['bending_kg'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="lengket_terpotong_kg_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['lengket_terpotong_kg'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="persentase_reject_internal_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['persentase_reject_internal'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="persentase_reject_eksternal_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['persentase_reject_eksternal'] ?>
                                                                        <br>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="persentase_reject_akumulatif_section">
                                                                <?php foreach ($plateinput as $pi) : ?>
                                                                    <?php if ($pc['id_plateinput'] === $pi['id']) : ?>
                                                                        <?= $pi['persentase_reject_akumulatif'] ?>
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