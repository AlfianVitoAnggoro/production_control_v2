<?= $this->extend('template/form_cuti/layout'); ?>
<?= $this->section('style'); ?>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>

<div class="container">
  <section class="content">
    <h3 class="fw-bold">PT. CENTURY BATTERIES INDONESIA</h3>
    <h4 class="text-center fw-bold">PERMOHONAN CUTI BESAR</h4>
    <h4 class="text-center fw-bold">DAN</h4>
    <h4 class="text-center fw-bold text-decoration-underline">PENGAMBILAN UANG CUTI BESAR</h4>
    <h5>Bersama ini saya,</h5>
    <form action="<?= base_url() ?>form_cuti_besar/save" method="POST">
      <div class="form-group">
        <label for="nama">Nama</label>
        <select class="form-select select2" name="nama" id="nama" style="width: 100%" onchange="data_mp()">
          <option value="">-- Pilih Nama --</option>
          <?php foreach ($data_mp as $d_mp) { ?>
            <option value="<?= $d_mp['id_man_power'] ?>"><?= $d_mp['nama'] ?></option>
          <?php } ?>
        </select>
        <input type="hidden" name="line" id="line" class="form-control">
        <input type="hidden" name="group_mp" id="group_mp" class="form-control">
        <!-- <input type="hidden" name="npk" id="npk" class="form-control"> -->
      </div>
      <div class="form-group">
        <label for="npk">NPK</label>
        <input type="text" class="form-control" id="npk" name="npk" readonly>
      </div>
      <div class="form-group">
        <label for="bagian">Bagian / Seksi</label>
        <input type="text" class="form-control" id="bagian" name="bagian" readonly>
        <!-- <select class="form-select select2" name="bagian" id="bagian" style="width: 100%">
          <option value="">-- Pilih Bagian / Seksi --</option>
          <option value="AMB-1">AMB-1</option>
          <option value="AMB-2">AMB-2</option>
          <option value="WET-A">WET-A</option>
          <option value="WET-F">WET-F</option>
          <option value="MCB">MCB</option>
        </select> -->
      </div>
      <div class="d-flex align-items-center">
        Sehubungan dengan masa kerja yang telah genap &nbsp;
        <div class="form-group m-0">
          <!-- <label for="tanggal"></label> -->
          <input type="text" class="form-control" id="masa_kerja" name="masa_kerja">
        </div>
        &nbsp;(
        <div class="form-group m-0">
          <!-- <label for="tanggal"></label> -->
          <input type="text" class="form-control" id="masa_kerja_pelafalan" name="masa_kerja_pelafalan">
        </div>
        ) tahun, tepatnya Tanggal &nbsp;
        <div class="form-group m-0">
          <!-- <label for="tanggal">Tanggal</label> -->
          <input type="date" class="form-control" id="tanggal_masa_kerja" name="tanggal_masa_kerja">
        </div>
      </div>
      <div class="d-flex align-items-center flex-wrap my-2">
        maka dengan ini saya mengajukan : &nbsp;
        <div class="form-group m-0">
          <!-- <label for="bagian">Bagian / Seksi</label> -->
          <select class="form-select select2" name="jenis" id="jenis" style="width: 100%" onchange="changeOption()">
            <option value="">-- Pilih Pengajuan --</option>
            <option value="Pengambilan Cuti Besar">Pengambilan cuti besar</option>
            <option value="Pengambilan Uang Cuti Besar">Pengambilan uang cuti besar</option>
          </select>
        </div>
        <div class="d-flex align-items-center d-none" id="pengambilan_cuti">
          &nbsp; selama &nbsp;
          <div class="form-group m-0">
            <!-- <label for="tanggal">Tanggal</label> -->
            <input type="text" class="form-control" id="jumlah_hari" name="jumlah_hari">
          </div>
          &nbsp; hari terhitung tanggal &nbsp;
          <div class="form-group m-0">
            <input type="date" class="form-control" id="start_date" name="start_date">
          </div>
          &nbsp; s/d &nbsp;
          <div class="form-group m-0">
            <input type="date" class="form-control" id="end_date" name="end_date">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
        <!-- <input type="text" class="form-control" id="alamat" name="alamat"> -->
      </div>
      <div class="form-group">
        <label for="telp">No. Telpon</label>
        <input type="text" class="form-control" id="telp" name="telp">
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
        url: '<?= base_url() ?>form_cuti_besar/get_data_mp',
        type: 'POST',
        data: {
          nama: nama.value
        },
        dataType: 'JSON',
        success: function(data) {
          document.querySelector('#npk').value = String(data?.[0]?.npk).padStart(4, '0');
          document.querySelector('#line').value = data?.[0]?.line;
          document.querySelector('#group_mp').value = data?.[0]?.group_mp;
          document.querySelector('#bagian').value = data?.[0]?.sub_bagian;
          if (data?.[0]?.line !== undefined) {
            console.log(data?.[0]?.line)
            if (data?.[0]?.line <= 3)
              document.querySelector('#bagian').value = 'AMB-1';
            else if (data?.[0]?.line <= 7)
              document.querySelector('#bagian').value = 'AMB-2';
            else if (data?.[0]?.line <= 9)
              document.querySelector('#bagian').value = 'WET';
            else if (data?.[0]?.line <= 10)
              document.querySelector('#bagian').value = 'MCB';
          } else {
            document.querySelector('#bagian').value = data?.[0]?.sub_bagian;
          }
          $('#loading-modal').modal('hide');
        }
      })
    } else {
      document.querySelector('#npk').value = '';
      $('#loading-modal').modal('hide');
    }
  }

  function changeOption() {
    let jenisElement = document.querySelector('#jenis');
    if (jenisElement.value == 'Pengambilan Cuti Besar') {
      document.querySelector('#pengambilan_cuti').classList.remove('d-none');
    } else {
      document.querySelector('#pengambilan_cuti').classList.add('d-none');
    }
  }
</script>
<?= $this->endSection(); ?>