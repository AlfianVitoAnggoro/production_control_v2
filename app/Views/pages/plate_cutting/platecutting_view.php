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
                                                    <th colspan="7"></th>
                                                    <th colspan="10" class="text-center">Jumlah NG (Panel)</th>
                                                    <th colspan="10" class="text-center">Jumlah NG (Kilogram)</th>
                                                    <th colspan="5" class="text-center"></th>
                                                </tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Line</th>
                                                    <th>Shift</th>
                                                    <th>Team</th>
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
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table_platecutting">
                                                <?php
                                                $isExist = [];
                                                $number = 0;
                                                ?>
                                                <?php foreach ($platecutting as $pc) : ?>
                                                    <?php
                                                    $number++;
                                                    if (!array_key_exists($pc['id'], $isExist)) :
                                                        $isExist[$pc['id']] = $pc['id'];
                                                    ?>
                                                        <tr>
                                                            <th><?= $number ?></th>
                                                            <td><?= $pc['date'] ?></td>
                                                            <td><?= $pc['line'] ?></td>
                                                            <td><?= $pc['shift'] ?></td>
                                                            <td><?= $pc['team'] ?></td>
                                                            <td style="width: 125px;">
                                                                <div class="plate-section" style="width: 125px;">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['plate'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="hasil_produksi_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['hasil_produksi'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="terpotong_panel_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['terpotong_panel'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="tersangkut_panel_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['tersangkut_panel'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="overbrush_panel_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['overbrush_panel'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="rontok_panel_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['rontok_panel'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="lug_patah_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['lug_patah_panel'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="patah_kaki_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['patah_kaki_panel'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="patah_frame_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['patah_frame_panel'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="bolong_panel_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['bolong_panel'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="bending_panel_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['bending_panel'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="lengket_terpotong_panel_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['lengket_terpotong_panel'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="terpotong_kg_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['terpotong_kg'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="tersangkut_kg_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['tersangkut_kg'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="overbrush_kg_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['overbrush_kg'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="rontok_kg_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['rontok_kg'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="lug_patah_kg_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['lug_patah_kg'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="patah_kaki_kg_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['patah_kaki_kg'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="patah_frame_kg_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['patah_frame_kg'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="bolong_kg_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['bolong_kg'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="bending_kg_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['bending_kg'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="lengket_terpotong_kg_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['lengket_terpotong_kg'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="persentase_reject_internal_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['persentase_reject_internal'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="persentase_reject_eksternal_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['persentase_reject_eksternal'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="persentase_reject_akumulatif_section">
                                                                    <?php foreach ($plateinput as $pi) : ?>
                                                                        <?php if (trim($pc['id']) === trim($pi['id_platecutting'])) : ?>
                                                                            <?= $pi['persentase_reject_akumulatif'] ?>
                                                                            <br>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <?php
                                                                    foreach ($plateinput as $pi) :
                                                                        if ($pc['id'] === $pi['id_platecutting']) :
                                                                            if (trim($pc['status']) === 'approved') :
                                                                    ?>
                                                                                <span class="badge bg-success">Approved</span>
                                                                            <?php break;
                                                                            elseif (trim($pc['status']) === 'pending') : ?>
                                                                                <span class="badge bg-warning">Pending</span>
                                                                            <?php break;
                                                                            elseif (trim($pc['status']) === 'rejected') : ?>
                                                                                <span class="badge bg-danger">Rejected</span>
                                                                            <?php break;
                                                                            endif ?>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </div>
                                                            </td>
                                                            <?php if ($session === 'atasan') : ?>
                                                                <td>
                                                                    <div>
                                                                        <?php
                                                                        foreach ($plateinput as $pi) :
                                                                            if ($pc['id'] === $pi['id_platecutting']) :
                                                                                if (trim($pc['status']) === 'pending') :
                                                                        ?>
                                                                                    <a href="/lhp/platecutting/detail_platecutting/<?= trim($pc['id']) ?>" class="btn btn-primary">Detail</a>
                                                                                <?php break;
                                                                                endif ?>
                                                                            <?php endif ?>
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