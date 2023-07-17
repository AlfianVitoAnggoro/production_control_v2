<?= $this->extend('template/form_cuti/layout'); ?>
<?= $this->section('style'); ?>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<?php $jenis_cuti = ['Cuti Tahunan', 'Cuti Perkawinan', 'Cuti Melahirkan / Keguguran', 'Cuti Kematian', 'Cuti Haid', 'Cuti Lain-lain', 'Rawat Inap / Opname', 'Tidak bisa hadir karena'] ?>

<div class="container">
  <section class="content">
    <h4 class="fw-bold">PT. Century Batteries Indonesia</h4>
    <h3 class="text-center text-decoration-underline fw-bold">PERMOHONAN CUTI</h3>
    <div class="table-responsive">
      <table class="table" style="border-color: transparent">
        <tbody>
          <tr>
            <th class="py-1 px-0" colspan="6">Bersama ini saya,</th>
          </tr>
          <tr>
            <th class="py-1" style="width: 30%"></th>
            <th class="py-1" style="width: 150px">Nama</th>
            <th class="py-1 d-flex align-items-center">:&nbsp;
              <select class="form-select select2" name="nama" id="nama" style="width: 450px">
                <option value="">-- Pilih Nama --</option>
                <?php foreach ($data_mp as $d_mp) { ?>
                  <option value="<?= $d_mp['id_man_power'] ?>"><?= $d_mp['nama'] ?></option>
                <?php } ?>
              </select>
            </th>
            <th class="py-1">NPK</th>
            <th class="py-1">
              <input type="text" class="form-control" name="npk" id="npk" readonly>
            </th>
          </tr>
          <tr>
            <th class="py-1" style="width: 30%"></th>
            <th class="py-1" style="width: 150px">Bagian/ Seksi</th>
            <th class="py-1 d-flex align-items-center" colspan="3">:&nbsp;
              <input type="text" class="form-control" name="bagian" id="bagian" style="width: 450px">
            </th>
          </tr>
          <tr>
            <th class="py-1" style="width: 30%"></th>
            <th class="py-1" style="width: 150px">Tanggal</th>
            <th class="py-1 d-flex align-items-center" colspan="3">:&nbsp;
              <input type="date" class="form-control" name="tanggal" id="tanggal" style="width: 450px">
            </th>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="table-responsive">
      <table class="table border border-dark">
        <thead>
          <th class="py-1"></th>
          <th class="py-1 text-center" colspan="2">JENIS</th>
          <th class="py-1 text-center" colspan="2">WAKTU DIRENCANAKAN</th>
          <th class="py-1 text-center">KETERANGAN</th>
        </thead>
        <tbody>
          <?php $index_cuti = 0;
          foreach ($jenis_cuti as $jc) { ?>
            <tr>
              <th class="py-1" style="width: 100px"></th>
              <th class="py-1" style="width: 200px;" colspan="2"><?= $jc ?></th>
              <td class="py-1" colspan="2">
                <input type="date" class="form-control" name="tanggal_cuti[]" id="tanggal_cuti_<?= $index_cuti ?>">
              </td>
              <td class="py-1">
                <input type="text" class="form-control" name="keterangan[]" id="keterangan_<?= $index_cuti ?>">
              </td>
            </tr>
          <?php $index_cuti++;
          } ?>
          <tr>
            <td class="py-1" rowspan="4"></td>
          </tr>
          <?php for ($i = 0; $i < 3; $i++) { ?>
            <tr>
              <td class="py-1" style="height: 29px;" colspan="2"></td>
              <td class="py-1" style="height: 29px;" colspan="2"></td>
              <td class="py-1" style="height: 29px;"></td>
            </tr>
          <?php } ?>
          <tr>
            <th class="py-1" colspan="2">Cuti yang sudah digunakan</th>
            <th class="py-1">: </th>
            <th class="py-1 text-center" colspan="2">Personalia</th>
            <th class="py-1 text-center">Admin Seksi</th>
          </tr>
          <tr>
            <th class="py-1" colspan="2">Sisa Cuti</th>
            <th class="py-1">: </th>
            <th class="py-1" rowspan="2" colspan="2"></th>
            <th class="py-1" rowspan="2"></th>
          </tr>
          <tr>
            <th class="py-1" colspan="2">Tanggal Cuti Terakhir</th>
            <th class="py-1">: </th>
          </tr>
          <tr>
            <th class="py-1 text-center" style="width: 100px;">Personalia</th>
            <th class="py-1 text-center" style="width: 100px;">Kadiv</th>
            <th class="py-1 text-center" style="width: 100px;">Kadept</th>
            <th class="py-1 text-center" style="width: 100px;">Kasie</th>
            <th class="py-1 text-center" style="width: 100px;">Kasubsie</th>
            <th class="py-1 text-center" style="width: 100px;">Pemohon</th>
          </tr>
          <tr>
            <th class="py-1" style="height: 58px;" rowspan="2"></th>
            <th class="py-1" style="height: 58px;" rowspan="2"></th>
            <th class="py-1" style="height: 58px;" rowspan="2"></th>
            <th class="py-1" style="height: 58px;" rowspan="2"></th>
            <th class="py-1" style="height: 58px;" rowspan="2"></th>
            <th class="py-1" style="height: 58px;" rowspan="2"></th>
          </tr>
          <tr></tr>
          <tr>
            <td class="py-1">Note : </td>
            <td class="py-1" colspan="5">Sebelum karyawan meminta persetujuan dari atasan, mohon untuk cek<br>saldo cuti ke bagian Personalia dan telah ditandatangani oleh Personalia</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td class="py-1" colspan="3">Edisi ke : 1, Revisi: 1</td>
            <td class="py-1 text-end" colspan="3">Form-HRD-PSN-39 (Permohonan cuti)</td>
          </tr>
        </tfoot>
      </table>
    </div>
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
  $(document).ready(
    $('.select2').select2()
  );
</script>
<?= $this->endSection(); ?>