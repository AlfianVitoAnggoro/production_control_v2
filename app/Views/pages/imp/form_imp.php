<?= $this->extend('template/form_cuti/layout'); ?>
<?= $this->section('style'); ?>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>

<div class="container">
  <section class="content">
    <h3 class="fw-bold text-center">PT. CENTURY BATTERIES INDONESIA</h3>
    <h4 class="text-center fw-bold">IJIN MENINGGALKAN PEKERJAAN</h4>
    <h5>Bersama ini saya,</h5>
    <form action="<?= base_url() ?>form_cuti/save" method="POST">
      <div class="form-group">
        <label for="nama">Nama</label>
        <select class="form-select select2" name="nama" id="nama" style="width: 100%" onchange="data_mp()">
          <option value="">-- Pilih Nama --</option>
          <?php foreach ($data_mp as $d_mp) { ?>
            <option value="<?= $d_mp['id_man_power'] ?>"><?= $d_mp['nama'] ?></option>
          <?php } ?>
        </select>
        <input type="hidden" name="npk" id="npk" class="form-control">
      </div>
      <div class="form-group">
        <label for="bagian">Bagian / Seksi</label>
        <select class="form-select select2" name="bagian" id="bagian" style="width: 100%">
          <option value="">-- Pilih Bagian / Seksi --</option>
          <option value="AMB-1">AMB-1</option>
          <option value="AMB-2">AMB-2</option>
          <option value="WET-A">WET-A</option>
          <option value="WET-F">WET-F</option>
          <option value="MCB">MCB</option>
        </select>
      </div>
      <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>">
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="berangkat_jam">Berangkat Jam</label>
          <input type="time" class="form-control" id="berangkat_jam" name="berangkat_jam">
        </div>
        <div class="form-group col-md-6">
          <label for="rencana_kembali">Rencana Kembali</label>
          <input type="time" class="form-control" id="rencana_kembali" name="rencana_kembali">
        </div>
      </div>
      <div class="row">
        <div class="form-group col">
          <label for="keperluan">Keperluan*</label>
          <select id="keperluan" class="form-select select2" name="keperluan" style="width: 100%;" onchange="changeKeperluan()">
            <option value="" selected>-- Pilih Keperluan --</option>
            <option value="Pribadi">Pribadi</option>
            <option value="Ijin Tidak Bekerja">Ijin Tidak Bekerja</option>
          </select>
          <span>Ket: (*) Diisi oleh Foreman / Kasie</span>
        </div>
        <div class="form-group" id="keterangan"></div>
        <div class="form-group" id="keterangan_lengkap"></div>
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
        url: '<?= base_url() ?>cuti/get_data_mp',
        type: 'POST',
        data: {
          nama: nama.value
        },
        dataType: 'JSON',
        success: function(data) {
          document.querySelector('#npk').value = String(data?.[0]?.npk).padStart(4, '0');
          $('#loading-modal').modal('hide');
        }
      })
    } else {
      document.querySelector('#npk').value = '';
      $('#loading-modal').modal('hide');
    }
  }

  function changeKeperluan() {
    let keperluan = document.querySelector('#keperluan');
    let keterangan = document.querySelector('#keterangan');
    if (keperluan.value === 'Pribadi') {
      keterangan.innerHTML = `
        <label for="keterangan_value">Keterangan</label>
        <input type="text" name="keterangan_value" id="keterangan_value" class="form-control">
      `;
      keterangan.classList.add('col');
    } else if (keperluan.value === 'Ijin Tidak Bekerja') {
      keterangan.innerHTML = `
        <label for="keterangan_value">Keterangan</label>
        <select name="keterangan_value" id="keterangan_value" class="form-select" onchange="changeKeterangan()">
          <option value="Keluarga Opname">Keluarga Opname</option>
          <option value="Keluarga Meninggal Dunia">Keluarga Meninggal Dunia</option>
          <option value="Istri pekerja melahirkan atau keguguran kandungan">Istri pekerja melahirkan atau keguguran kandungan</option>
          <option value="Musibah / Bencana Alam">Musibah / Bencana Alam</option>
          <option value="Sakit Menular">Sakit Menular</option>
        </select>
      `;
      keterangan.classList.add('col');
    } else {
      keterangan.innerHTML = '';
      keterangan.classList.remove('col');
    }
  }

  function changeKeterangan() {
    let keterangan = document.querySelector('#keterangan_value');
    let keterangan_lengkap = document.querySelector('#keterangan_lengkap');
    if (keterangan.value === 'Musibah / Bencana Alam' || keterangan.value === 'Sakit Menular') {
      keterangan_lengkap.innerHTML = `
        <label for="keterangan_lengkap_value">Keterangan</label>
        <input type="text" name="keterangan_lengkap_value" id="keterangan_lengkap_value" class="form-control">
      `;
      keterangan_lengkap.classList.add('col');
    } else {
      keterangan_lengkap.innerHTML = '';
      keterangan_lengkap.classList.remove('col');
    }
  }
</script>
<?= $this->endSection(); ?>