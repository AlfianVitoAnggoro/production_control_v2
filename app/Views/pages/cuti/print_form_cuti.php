<?= $this->extend('template/form_cuti/layout'); ?>
<?= $this->section('style'); ?>
<style>
  .br-1 {
    border-right: 1px solid black
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<?php $jenis_cuti = ['Cuti Tahunan', 'Cuti Perkawinan', 'Cuti Melahirkan / Keguguran', 'Cuti Kematian', 'Cuti Haid', 'Cuti Lain-lain', 'Rawat Inap / Opname'] ?>
<?php
if ($data_mp_cuti[0]['level_account'] === 1)
  $level = 'Kadept';
else if ($data_mp_cuti[0]['level_account'] === 2)
  $level = 'Kasie';
else if ($data_mp_cuti[0]['level_account'] === 3)
  $level = 'Kasubsie';
else
  $level = '';
?>

<div class="container">
  <section class="content">
    <h4 class="fw-bold">PT. Century Batteries Indonesia</h4>
    <h3 class="text-center text-decoration-underline fw-bold">PERMOHONAN CUTI</h3>
    <table class="table" style="border-color: transparent">
      <tbody>
        <tr>
          <th class="py-1 px-0" colspan="6">Bersama ini saya,</th>
        </tr>
        <tr>
          <th class="py-1" style="width: 30%"></th>
          <th class="py-1 pe-0" style="width: 150px">
            <div class="d-flex justify-content-between">
              <span>Nama</span>
              <span>:</span>
            </div>
          </th>
          <th class="py-1" style="width: 30%; border-bottom: 1px solid black"><?= $data_mp_cuti[0]['nama'] ?></th>
          <th class="py-1" style="width: 50px">NPK</th>
          <th class="py-1" style="border-bottom: 1px solid black;"><?= sprintf('%04d', $data_mp_cuti[0]['npk']) ?></th>
        </tr>
        <tr>
          <th class="py-1" style="width: 30%"></th>
          <th class="py-1 pe-0" style="width: 150px">
            <div class="d-flex justify-content-between">
              <span>Bagian/ Seksi</span>
              <span>:</span>
            </div>
          </th>
          <th class="py-1" colspan="3" style="border-bottom: 1px solid black;"><?= strtoupper($data_mp_cuti[0]['sub_bagian']) ?></th>
        </tr>
        <tr>
          <th class="py-1" style="width: 30%"></th>
          <th class="py-1 pe-0" style="width: 150px">
            <div class="d-flex justify-content-between">
              <span>Tanggal</span>
              <span>:</span>
            </div>
          </th>
          <th class="py-1" colspan="3" style="border-bottom: 1px solid black;"><?= $data_mp_cuti[0]['tanggal_buat'] !== NULL && $data_mp_cuti[0]['tanggal_buat'] !== '' ? date('j F Y', strtotime($data_mp_cuti[0]['tanggal_buat'])) : '' ?></th>
        </tr>
      </tbody>
    </table>
    <table class="table border border-dark">
      <thead class="bg-white">
        <th class="py-1 br-1"></th>
        <th class="py-1 br-1 text-center" colspan="2">JENIS</th>
        <th class="py-1 br-1 text-center" colspan="2">WAKTU DIRENCANAKAN</th>
        <th class="py-1 br-1 text-center">KETERANGAN</th>
      </thead>
      <tbody>
        <?php foreach ($jenis_cuti as $jc) { ?>
          <tr>
            <th class="py-1 br-1 text-center" style="width: 100px"><?= $data_mp_cuti[0]['jenis'] === $jc ? '<i class="fa fa-check"></i>' : '' ?></th>
            <th class="py-1 br-1" style="width: 200px;" colspan="2"><?= $jc ?></th>
            <td class="py-1 br-1 text-center" colspan="2"><?= $data_mp_cuti[0]['jenis'] === $jc ? $list_tanggal_cuti : '' ?></td>
            <td class="py-1 br-1"><?= $data_mp_cuti[0]['jenis'] === $jc ? $data_mp_cuti[0]['keterangan'] : '' ?></td>
          </tr>
        <?php } ?>
        <tr>
          <td class="py-1 br-1" rowspan="4"></td>
        </tr>
        <tr>
          <td class="py-1 br-1" style="height: 29px;" colspan="2"><?= in_array($data_mp_cuti[0]['jenis'], $jenis_cuti) ? '' : $data_mp_cuti[0]['keterangan'] ?></td>
          <td class="py-1 br-1" style="height: 29px;" colspan="2"><?= in_array($data_mp_cuti[0]['jenis'], $jenis_cuti) ? '' : date('j F Y', strtotime($data_mp_cuti[0]['tanggal']))  ?></td>
          <td class="py-1 br-1" style="height: 29px;"></td>
        </tr>
        <?php for ($i = 0; $i < 2; $i++) { ?>
          <tr>
            <td class="py-1 br-1" style="height: 29px;" colspan="2"></td>
            <td class="py-1 br-1" style="height: 29px;" colspan="2"></td>
            <td class="py-1 br-1" style="height: 29px;"></td>
          </tr>
        <?php } ?>
        <tr>
          <th class="py-1 bb-0" colspan="2">Cuti yang sudah digunakan</th>
          <th class="py-1 br-1 bb-0">: </th>
          <th class="py-1 br-1 text-center" colspan="2">Personalia</th>
          <th class="py-1 text-center">Admin Seksi</th>
        </tr>
        <tr>
          <th class="py-1 bb-0" colspan="2">Sisa Cuti</th>
          <th class="py-1 br-1 bb-0">: </th>
          <th class="py-1 br-1 text-center" rowspan="2" colspan="2"></th>
          <th class="py-1 br-1 text-center" rowspan="2"></th>
        </tr>
        <tr>
          <th class="py-1" colspan="2">Tanggal Cuti Terakhir</th>
          <th class="py-1 br-1">: </th>
        </tr>
        <tr>
          <th class="py-1 br-1 text-center" style="width: 100px;">Personalia</th>
          <th class="py-1 br-1 text-center" style="width: 100px;">Kadiv</th>
          <th class="py-1 br-1 text-center" style="width: 100px;">Kadept</th>
          <th class="py-1 br-1 text-center" style="width: 100px;">Kasie</th>
          <th class="py-1 br-1 text-center" style="width: 100px;">Kasubsie</th>
          <th class="py-1 br-1 text-center" style="width: 100px;">Pemohon</th>
        </tr>
        <tr>
          <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2"></th>
          <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
            <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kadiv'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kadiv'] == 'approved' ? 'green' : 'yellow') ?>; color: white"><?= ucfirst($data_mp_cuti[0]['status_kadiv']) ?></div>
            <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama_kadiv']))) ?></div>
            <div style="font-size: 10px;"><?= date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kadiv'])) ?></div>
          </th>
          <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
            <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kadept'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kadept'] == 'approved' ? 'green' : 'yellow') ?>; color: white"><?= ucfirst($data_mp_cuti[0]['status_kadept']) ?></div>
            <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama_kadept']))) ?></div>
            <div style="font-size: 10px;"><?= date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kadept'])) ?></div>
          </th>
          <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
            <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kasie'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kasie'] == 'approved' ? 'green' : 'yellow') ?>; color: white"><?= ucfirst($data_mp_cuti[0]['status_kasie']) ?></div>
            <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama_kasie']))) ?></div>
            <div style="font-size: 10px;"><?= date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kasie'])) ?></div>
          </th>
          <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
            <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kasubsie'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kasubsie'] == 'approved' ? 'green' : 'yellow') ?>; color: white"><?= ucfirst($data_mp_cuti[0]['status_kasubsie']) ?></div>
            <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama_kasubsie']))) ?></div>
            <div style="font-size: 10px;"><?= date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kasubsie'])) ?></div>
          </th>
          <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
            <div style="font-size: 10px; background-color: green; color: white">Created</div>
            <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama']))) ?></div>
            <div style="font-size: 10px;"><?= date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created'])) ?></div>
          </th>
        </tr>
        <tr></tr>
        <tr>
          <td class="py-1" style="border-bottom: transparent;">Note : </td>
          <td class="py-1" style="border-bottom: transparent;" colspan="5">Sebelum karyawan meminta persetujuan dari atasan, mohon untuk cek<br>saldo cuti ke bagian Personalia dan telah ditandatangani oleh Personalia</td>
        </tr>
        <?php if ($data_mp_cuti[0]['note'] !== NULL) { ?>
          <tr>
            <td class="pb-1 pt-0" style="border-top: transparent;" colspan="6">Note By <?= $level ?> : <?= $data_mp_cuti[0]['note'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <td class="py-1" colspan="3">Edisi ke : 1, Revisi: 1</td>
          <td class="py-1 text-end" colspan="3">Form-HRD-PSN-39 (Permohonan cuti)</td>
        </tr>
      </tfoot>
    </table>
  </section>
</div>


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
</script>
<?= $this->endSection(); ?>