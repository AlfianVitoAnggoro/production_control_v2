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
    td,
    h5 {
      font-size: 12px;
    }

    body,
    html {
      margin: 0;
      /* Menghilangkan margin pada body dan html */
      padding: 5px;
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

    /* Contoh: sembunyikan elemen navigasi dan footer saat mencetak */
    header,
    footer {
      display: none;
    }
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<?php $jenis_cuti = ['Cuti Besar', 'Cuti Perkawinan', 'Cuti Melahirkan / Keguguran', 'Cuti Kematian', 'Cuti Haid', 'Cuti Lain-lain', 'Rawat Inap / Opname'] ?>
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
  <div class="container" style="max-width: 50%;">
    <section class="content" style="border: 1px solid black;">
      <div class="container">
        <h4 class="fw-bold">PT. Century Batteries Indonesia</h4>
        <h5>Jl. Mitra Raya Selatan 1 Blok E Kav. 17-18</h5>
        <h5>Kawasan Industri Mitra Karawang (KIM)</h5>
        <h4 class="text-center fw-bold">PERMOHONAN CUTI BESAR</h4>
        <h4 class="text-center fw-bold">DAN</h4>
        <h4 class="text-center text-decoration-underline fw-bold">PENGAMBILAN UANG CUTI BESAR</h4>
        <table class="table" style="border-color: transparent; width: 80%">
          <tbody>
            <tr>
              <th class="py-1 px-0" colspan="3">Yang bertanda tangan di bawah ini :</th>
            </tr>
            <tr>
              <th class="py-1" style="width: 20px"></th>
              <th class="py-1 pe-0">
                <div class="d-flex justify-content-between">
                  <span>Nama</span>
                  <span>:</span>
                </div>
              </th>
              <th class="py-1" style="border-bottom: 1px solid black"><?= $data_mp_cuti[0]['nama'] ?></th>
            </tr>
            <tr>
              <th class="py-1" style="width: 20px"></th>
              <th class="py-1 pe-0">
                <div class="d-flex justify-content-between">
                  <span>NPK</span>
                  <span>:</span>
                </div>
              </th>
              <th class="py-1" style="border-bottom: 1px solid black;"><?= sprintf('%04d', $data_mp_cuti[0]['npk']) ?></th>
            </tr>
            <tr>
              <th class="py-1" style="width: 20px"></th>
              <th class="py-1 pe-0">
                <div class="d-flex justify-content-between">
                  <span>Seksi / Bagian</span>
                  <span>:</span>
                </div>
              </th>
              <th class="py-1" style="border-bottom: 1px solid black;"><?= strtoupper($data_mp_cuti[0]['sub_bagian']) ?></th>
            </tr>
          </tbody>
        </table>
        <div>
          Sehubungan dengan masa kerja yang telah genap <span class="fw-bold"><?= $data_mp_cuti[0]['masa_kerja'] ?></span> tahun,
          <!-- tepatnya<br>
          Tanggal <span class="fw-bold"><?= date('j F Y', strtotime($data_mp_cuti[0]['tanggal_masa_kerja'])) ?></span> <br> -->
          maka dengan ini saya mengajukan :
          <div class="d-flex">
            <div class="d-flex justify-content-center align-items-center" style="border: 1px solid black; width: 20px; height: 20px"><?= $data_mp_cuti[0]['jenis'] == 'Pengambilan Cuti Besar' ? '<i class="fa fa-check"></i>' : '' ?></div>
            &nbsp;
            Pengambilan cuti besar selama&nbsp;<span class="fw-bold"><?= ($data_mp_cuti[0]['jumlah_hari'] != 0) ? $data_mp_cuti[0]['jumlah_hari'] : '...' ?></span>&nbsp;hari terhitung tanggal&nbsp;<span class="fw-bold"><?= ($data_mp_cuti[0]['start_date'] ?? '') != '' ? date('j F Y', strtotime($data_mp_cuti[0]['start_date'])) : '...' ?></span>&nbsp;s/d&nbsp;<span class="fw-bold"><?= ($data_mp_cuti[0]['end_date'] ?? '') != '' ? date('j F Y', strtotime($data_mp_cuti[0]['end_date'])) : '...' ?></span>
          </div>
          <div class="d-flex">
            <div class="d-flex justify-content-center align-items-center" style="border: 1px solid black; width: 20px; height: 20px"><?= $data_mp_cuti[0]['jenis'] == 'Pengambilan Uang Cuti Besar' ? '<i class="fa fa-check"></i>' : '' ?></div>
            &nbsp;
            Pengambilan uang cuti besar
          </div>
        </div>
        <div>
          Selama menjalankan cuti tersebut saya akan bertempat tinggal di :
          <table class="table" style="border-color: transparent;">
            <tbody>
              <tr>
                <td class="p-0" style=" width: 100px;">
                  <div class="d-flex justify-content-between">
                    <span>Alamat</span>
                    <span>: &nbsp;</span>
                  </div>
                </td>
                <td class="p-0" style="border-bottom: 1px solid black;"><?= $data_mp_cuti[0]['alamat'] ?></td>
              </tr>
              <tr>
                <td class="p-0" style=" width: 100px;">
                  <div class="d-flex justify-content-between">
                    <span>No. telpon</span>
                    <span>: &nbsp;</span>
                  </div>
                </td>
                <td class="p-0" style="border-bottom: 1px solid black;"><?= $data_mp_cuti[0]['telp'] ?></td>
              </tr>
              <tr>
                <td class="px-0" colspan="3">Demikianlah permohonan saya</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-end">
          <table class="table" style="width: 200px; border-color: transparent">
            <tbody>
              <tr>
                <td class="p-0" style="font-size: 12px;" colspan="2">Karawang,&nbsp;<?= date('j F Y', strtotime($data_mp_cuti[0]['tanggal_buat'])) ?></td>
              </tr>
              <tr>
                <td class="p-0" style="font-size: 12px;" colspan="2">Pemohon</td>
              </tr>
              <tr>
                <th class="py-1 text-center" rowspan="2">
                  <div style="font-size: 10px; background-color: green; color: white">Created</div>
                  <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created'])) : '' ?></div>
                </th>
              </tr>
              <tr>
                <td></td>
              </tr>
              <tr>
                <td class="p-0" style="font-size: 12px;" colspan="2"><?= $data_mp_cuti[0]['nama'] ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <table class="table border border-dark">
          <thead>
            <tr>
              <th class="py-0 text-center br-1">Mengetahui</th>
              <th class="py-0 text-center" colspan="4">Menyetujui</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th class="py-0 text-center br-1">Personalia</th>
              <th class="py-0 text-center br-1">Kadiv</th>
              <th class="py-0 text-center br-1">Kadept</th>
              <th class="py-0 text-center br-1">Kasie</th>
              <th class="py-0 text-center">Kasubsie</th>
            </tr>
            <tr>
              <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
                <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_hrd'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_hrd'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_hrd'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_hrd']) ?></div>
                <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama_hrd']))) ?></div>
                <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_hrd'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_hrd'])) : '' ?></div>
              </th>
              <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
                <?php if ($data_mp_cuti[0]['status_kadiv'] != 'pending') { ?>
                  <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kadiv'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kadiv'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kadiv'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kadiv']) ?></div>
                  <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama_kadiv']))) ?></div>
                  <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_kadiv'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kadiv'])) : '' ?></div>
                <?php } ?>
              </th>
              <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
                <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kadept'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kadept'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kadept'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kadept']) ?></div>
                <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama_kadept']))) ?></div>
                <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_kadept'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kadept'])) : '' ?></div>
              </th>
              <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
                <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kasie'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kasie'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kasie'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kasie']) ?></div>
                <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama_kasie']))) ?></div>
                <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_kasie'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kasie'])) : '' ?></div>
              </th>
              <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
                <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kasubsie'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kasubsie'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kasubsie'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kasubsie']) ?></div>
                <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama_kasubsie']))) ?></div>
                <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_kasubsie'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kasubsie'])) : '' ?></div>
              </th>
            </tr>
            <tr></tr>
            <tr>
              <td class="py-0 br-1">&nbsp;</td>
              <td class="py-0 br-1">&nbsp;</td>
              <td class="py-0 br-1">&nbsp;</td>
              <td class="py-0 br-1">&nbsp;</td>
              <td class="py-0 br-1">&nbsp;</td>
            </tr>
          </tbody>
        </table>
        <div style="font-size: 12px;">
          Note : Kolom Persetujuan Kadiv wajib diisi bagi karyawan yang mengambil cuti mendadak
        </div>
      </div>
    </section>
    <div class="content p-0">
      <div class="d-flex justify-content-between">
        <span style="font-size: 8px;">Edisi ke : 1, Revisi : 0</span>
        <span style="font-size: 8px;">Form-HRD-PSN-40 (Permohonan cuti besar dan pengambilan uang cuti besar) ✔</span>
      </div>
    </div>
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