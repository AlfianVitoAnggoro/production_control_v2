<?= $this->extend('template/form_cuti/layout'); ?>
<?= $this->section('style'); ?>
<style>
  .br-1 {
    border-right: 1px solid black
  }

  @media print {
    @page {
      size: landscape;
      /* Mengatur orientasi cetak ke landscape */
    }

    h4 {
      font-size: 14px;
    }

    h3 {
      font-size: 16px;
    }

    div,
    span,
    th,
    td {
      font-size: 11px;
    }

    body,
    html {
      margin: 0;
      /* Menghilangkan margin pada body dan html */
      padding: 0;
      /* Menghilangkan padding pada body dan html */
      /* max-width: 50%; */
      height: 100vh;
      /* Menjadi tinggi karena halaman sekarang landscape */
      background-color: transparent;
    }

    header,
    footer,
    nav {
      margin: 0;
      padding: 0;
    }

    .container {
      padding: 12px;
    }

    /* Contoh: sembunyikan elemen navigasi dan footer saat mencetak */
    header,
    footer {
      display: none;
    }
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<?php $jenis_izin = ['Sakit'] ?>
<?php
if ($data_mp_cuti[0]['level_account'] == 1)
  $level = 'Kadiv';
else if ($data_mp_cuti[0]['level_account'] == 2)
  $level = 'Kadiv';
else if ($data_mp_cuti[0]['level_account'] == 3)
  $level = 'Kadept';
else if ($data_mp_cuti[0]['level_account'] == 4)
  $level = 'Kasie';
else if ($data_mp_cuti[0]['level_account'] == 5)
  $level = 'Kasubsie';
else if ($data_mp_cuti[0]['level_account'] == 'hrd')
  $level = 'HRD';
else
  $level = '';
?>

<div class="d-flex">
  <div class="container m-0" style="max-width: 50%;">
    <section class="content">
      <h4 class="fw-bold">PT. Century Batteries Indonesia</h4>
      <h3 class="text-center text-decoration-underline fw-bold">PERMOHONAN IZIN SAKIT</h3>
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
          <?php foreach ($jenis_izin as $jc) { ?>
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
            <td class="py-1 br-1" style="height: 29px;" colspan="2"><?= in_array($data_mp_cuti[0]['jenis'], $jenis_izin) ? '' : $data_mp_cuti[0]['keterangan'] ?></td>
            <td class="py-1 br-1" style="height: 29px;" colspan="2"><?= in_array($data_mp_cuti[0]['jenis'], $jenis_izin) ? '' : date('j F Y', strtotime($data_mp_cuti[0]['tanggal']))  ?></td>
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
            <th class="py-1 br-1 bb-0"></th>
            <th class="py-1 br-1 bb-0" colspan="2"></th>
            <th class="py-1 br-1 text-center" colspan="2">Personalia</th>
            <th class="py-1 text-center">Admin Seksi</th>
          </tr>
          <tr>
            <th class="py-1 br-1 bb-0"></th>
            <th class="py-1 br-1 bb-0" colspan="2"></th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2" colspan="2">
              <div style="font-size: 8px; background-color: <?= $data_mp_cuti[0]['status_hrd'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_hrd'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_hrd'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_hrd']) ?></div>
              <div style="font-size: 8px;"><?= $nama_hrd ?></div>
              <div style="font-size: 8px;"><?= $data_mp_cuti[0]['created_hrd'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_hrd'])) : '' ?></div>
            </th>
            <th class="py-1 br-1 text-center" rowspan="2"></th>
          </tr>
          <tr>
            <th class="py-1 br-1"></th>
            <th class="py-1 br-1" colspan="2"></th>
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
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 8px; background-color: <?= $data_mp_cuti[0]['status_hrd'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_hrd'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_hrd'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_hrd']) ?></div>
              <div style="font-size: 8px;"><?= $nama_hrd ?></div>
              <div style="font-size: 8px;"><?= $data_mp_cuti[0]['created_hrd'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_hrd'])) : '' ?></div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <?php if ($data_mp_cuti[0]['status_kadiv'] != 'pending') { ?>
                <div style="font-size: 8px; background-color: <?= $data_mp_cuti[0]['status_kadiv'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kadiv'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kadiv'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kadiv']) ?></div>
                <div style="font-size: 8px;"><?= $nama_kadiv ?></div>
                <div style="font-size: 8px;"><?= $data_mp_cuti[0]['created_kadiv'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kadiv'])) : '' ?></div>
              <?php } ?>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 8px; background-color: <?= $data_mp_cuti[0]['status_kadept'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kadept'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kadept'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kadept']) ?></div>
              <div style="font-size: 8px;"><?= $nama_kadept ?></div>
              <div style="font-size: 8px;"><?= $data_mp_cuti[0]['created_kadept'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kadept'])) : '' ?></div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 8px; background-color: <?= $data_mp_cuti[0]['status_kasie'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kasie'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kasie'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kasie']) ?></div>
              <div style="font-size: 8px;"><?= $nama_kasie ?></div>
              <div style="font-size: 8px;"><?= $data_mp_cuti[0]['created_kasie'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kasie'])) : '' ?></div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 8px; background-color: <?= $data_mp_cuti[0]['status_kasubsie'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kasubsie'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kasubsie'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kasubsie']) ?></div>
              <div style="font-size: 8px;"><?= $nama_kasubsie ?></div>
              <div style="font-size: 8px;"><?= $data_mp_cuti[0]['created_kasubsie'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kasubsie'])) : '' ?></div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 8px; background-color: green; color: white">Created</div>
              <div style="font-size: 8px;"><?= $nama ?></div>
              <div style="font-size: 8px;"><?= $data_mp_cuti[0]['created'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created'])) : '' ?></div>
            </th>
          </tr>
          <tr></tr>
          <tr>
            <td class="py-1" style="border-bottom: <?= $data_mp_cuti[0]['note'] !== NULL ? 'transparent' : '' ?>;">Note : </td>
            <td class="py-1" style="border-bottom: <?= $data_mp_cuti[0]['note'] !== NULL ? 'transparent' : '' ?>;" colspan="5">Sebelum karyawan meminta persetujuan dari atasan, mohon untuk cek<br>saldo cuti ke bagian Personalia dan telah ditandatangani oleh Personalia</td>
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
            <td class="py-1 text-end" colspan="3">Form-HRD-PSN-39 (Permohonan izin)</td>
          </tr>
        </tfoot>
      </table>
    </section>
  </div>
  <div class="container m-0" style="max-width: 50%;">
    <h4 class="fw-bold">Lampiran</h4>
    <div class="row row-cols-2">
      <?php foreach ($data_lampiran as $dt_lmp) { ?>
        <div class="col text-center">
          <img src="<?= base_url() ?>uploads/lampiran_cuti/<?= $dt_lmp['lampiran'] ?>" style="max-width: 90%; max-height: 23vh">
        </div>
      <?php } ?>
    </div>
  </div>
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
  $(document).ready(function() {
    window.print();
  })
</script>
<?= $this->endSection(); ?>