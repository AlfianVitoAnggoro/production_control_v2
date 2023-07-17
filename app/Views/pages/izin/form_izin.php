<?= $this->extend('template/form_cuti/layout'); ?>
<?= $this->section('style'); ?>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<?php $jenis_cuti = ['Sakit', 'Keperluan Keluarga', 'Lain-lain'] ?>

<div class="container">
  <section class="content">
    <h4 class="fw-bold">PT. Century Batteries Indonesia</h4>
    <h3 class="text-center text-decoration-underline fw-bold">PERMOHONAN IZIN</h3>
    <h5>Bersama ini saya,</h5>
    <form action="<?= base_url() ?>form_cuti/save" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="form-group col-md-6">
          <label for="nama">Nama</label>
          <select class="form-select select2" name="nama" id="nama" style="width: 100%" onchange="data_mp()">
            <option value="">-- Pilih Nama --</option>
            <?php foreach ($data_mp as $d_mp) { ?>
              <option value="<?= $d_mp['id_man_power'] ?>"><?= $d_mp['nama'] ?></option>
            <?php } ?>
          </select>
          <input type="hidden" name="line" id="line" class="form-control">
          <input type="hidden" name="group_mp" id="group_mp" class="form-control">
        </div>
        <div class="form-group col-md-6">
          <label for="npk">NPK</label>
          <input type="text" class="form-control" id="npk" name="npk" readonly>
        </div>
      </div>
      <div class="form-group">
        <label for="bagian">Bagian / Seksi</label>
        <select class="form-select select2" name="bagian" id="bagian" style="width: 100%" onchange="data_mp()">
          <option value="">-- Pilih Bagian / Seksi --</option>
          <option value="AMB-1">AMB-1</option>
          <option value="AMB-2">AMB-2</option>
          <option value="WET-A">WET-A</option>
          <option value="WET-F">WET-F</option>
          <option value="MCB">MCB</option>
        </select>
      </div>
      <div class="form-group">
        <label for="tanggal">Tanggal Pengajuan</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>" readonly>
      </div>
      <div class="form-group">
        <label for="lampiran">Lampiran</label>
        <input type="file" class="form-control" id="lampiran" name="lampiran" readonly>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="jenis">Jenis</label>
          <select id="jenis" class="form-select select2" name="jenis" style="width: 100%;">
            <option value="" selected>-- Pilih Jenis --</option>
            <?php foreach ($jenis_cuti as $jc) { ?>
              <option value="<?= $jc ?>"><?= $jc ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-md-3">
          <label for="waktu_rencana">Waktu Direncanakan</label>
          <div id="multiple_date" style="width: 100%;">
            <input type="date" class="form-control mb-2" id="waktu_rencana" name="waktu_rencana[]">
          </div>
          <button type="button" class="btn btn-sm btn-primary" id="btn_add_waktu_rencana" onclick="add_waktu_rencana()">+</button>
        </div>
        <div class="form-group col-md-3">
          <label for="keterangan">Keterangan</label>
          <input type="text" class="form-control" id="keterangan" name="keterangan">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
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

  function data_mp() {
    let nama = document.querySelector('#nama');
    $('#loading-modal').modal('show');
    if (nama.value !== '') {
      $.ajax({
        url: '<?= base_url() ?>form_cuti/get_data_mp',
        type: 'POST',
        data: {
          nama: nama.value
        },
        dataType: 'JSON',
        success: function(data) {
          document.querySelector('#npk').value = String(data?.[0]?.npk).padStart(4, '0');
          document.querySelector('#line').value = data?.[0]?.line;
          document.querySelector('#group_mp').value = data?.[0]?.group_mp;
          $('#loading-modal').modal('hide');
        }
      })
    } else {
      document.querySelector('#npk').value = '';
      $('#loading-modal').modal('hide');
    }
  }

  function add_waktu_rencana() {
    let multiple_dateElement = document.querySelector('#multiple_date');
    multiple_dateElement.innerHTML += `<input type="date" class="form-control mb-2" id="waktu_rencana" name="waktu_rencana[]">`;
  }
</script>
<?= $this->endSection(); ?>