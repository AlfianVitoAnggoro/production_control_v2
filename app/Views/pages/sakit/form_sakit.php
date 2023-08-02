<?= $this->extend('template/form_cuti/layout'); ?>
<?= $this->section('style'); ?>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>

<div class="container">
  <section class="content">
    <?php
    // if (session()->has('failed')) {
    //   echo '<div class="bg-danger text-center">' . session()->getFlashdata('failed') . '</div>';
    // } 
    ?>
    <h4 class="fw-bold">PT. Century Batteries Indonesia</h4>
    <h3 class="text-center text-decoration-underline fw-bold">PERMOHONAN IZIN SAKIT</h3>
    <h5>Bersama ini saya,</h5>
    <form action="<?= base_url() ?>form_sakit/save" method="POST" enctype="multipart/form-data">
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
        <input type="text" class="form-control" id="bagian" name="bagian" readonly>
        <!-- <select class="form-select select2" name="bagian" id="bagian" style="width: 100%" onchange="data_mp()">
          <option value="">-- Pilih Bagian / Seksi --</option>
          <option value="AMB-1">AMB-1</option>
          <option value="AMB-2">AMB-2</option>
          <option value="WET-A">WET-A</option>
          <option value="WET-F">WET-F</option>
          <option value="MCB">MCB</option>
        </select> -->
      </div>
      <div class="form-group">
        <label for="tanggal">Tanggal Pengajuan</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>" readonly>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="jenis">Jenis</label>
          <input type="text" class="form-control" name="jenis" id="jenis" value="Sakit" readonly>
          <!-- <select id="jenis" class="form-select select2" name="jenis" style="width: 100%;">
            <option value="" selected>-- Pilih Jenis --</option>
            <option value="Sakit" selected>Sakit</option>
          </select> -->
        </div>
        <div class="form-group col-md-3">
          <label for="waktu_rencana">Waktu Direncanakan</label>
          <div id="multiple_date" style="width: 100%;">
            <input type="date" class="form-control mb-2" id="waktu_rencana_0" name="waktu_rencana[]" onchange="update_min_date(0)">
          </div>
          <button type="button" class="btn btn-sm btn-primary" id="btn_add_waktu_rencana" onclick="add_waktu_rencana()">+</button>
        </div>
        <div class="form-group col-md-3">
          <label for="keterangan">Keterangan</label>
          <input type="text" class="form-control" id="keterangan" name="keterangan">
        </div>
      </div>
      <div class="form-group">
        <label for="lampiran">Lampiran</label>
        <div id="multiple_file" style="width: 100%">
          <input type="file" class="form-control mb-2" id="lampiran" name="lampiran[]" multiple accept="image/*">
          <!-- <input type="file" class="form-control mb-2" id="lampiran" name="lampiran[]"> -->
        </div>
        <button type="button" class="btn btn-sm btn-primary" id="btn_add_lampiran" onclick="add_lampiran()">+</button>
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
  $(document).ready(
    <?php if (session()->has('empty')) { ?> window.alert('<?= session()->getFlashdata('empty') ?>') <?php } ?> <?php if (session()->has('failed')) { ?> window.alert('<?= session()->getFlashdata('failed') ?>') <?php } ?>
  );

  function data_mp() {
    let nama = document.querySelector('#nama');
    $('#loading-modal').modal('show');
    if (nama.value !== '') {
      $.ajax({
        url: '<?= base_url() ?>form_sakit/get_data_mp',
        type: 'POST',
        data: {
          nama: nama.value
        },
        dataType: 'JSON',
        success: function(data) {
          document.querySelector('#npk').value = String(data?.[0]?.npk).padStart(4, '0');
          document.querySelector('#line').value = data?.[0]?.line;
          document.querySelector('#group_mp').value = data?.[0]?.group_mp;
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

  function add_waktu_rencana() {
    let multiple_dateElement = document.querySelector('#multiple_date');
    let waktu_rencanaElement = document.getElementsByName('waktu_rencana[]');
    let last_waktu_rencana_value = waktu_rencanaElement[waktu_rencanaElement.length - 1].value;
    if (last_waktu_rencana_value == '')
      return window.alert('Isi tanggal terlebih dahulu');
    let formatted_date = new Date(last_waktu_rencana_value);
    formatted_date.setDate(formatted_date.getDate() + 1);
    let newDateInput = document.createElement('input');
    newDateInput.setAttribute('type', 'date');
    newDateInput.setAttribute('class', 'form-control mb-2');
    newDateInput.setAttribute('name', 'waktu_rencana[]');
    newDateInput.setAttribute('id', `waktu_rencana_${waktu_rencanaElement.length}`);
    newDateInput.setAttribute('onchange', `update_min_date(${waktu_rencanaElement.length})`);
    newDateInput.setAttribute('min', formatted_date.toISOString().slice(0, 10));
    multiple_dateElement.appendChild(newDateInput);
  }

  function update_min_date(index) {
    let waktu_rencanaElement = document.querySelector('#waktu_rencana_' + index);
    let countWaktu_rencanaAfterElement = document.getElementsByName('waktu_rencana[]').length;
    console.log(countWaktu_rencanaAfterElement);
    for (let i = index; i < countWaktu_rencanaAfterElement - 1; i++) {
      let waktu_rencanaAfterElement = document.querySelector('#waktu_rencana_' + (i + 1));
      if (waktu_rencanaAfterElement != null) {
        if (i == index) {
          let formatted_date = new Date(waktu_rencanaElement.value);
          formatted_date.setDate(formatted_date.getDate() + 1);
          waktu_rencanaAfterElement.setAttribute('min', formatted_date.toISOString().slice(0, 10));
        }
        if (waktu_rencanaElement.value >= waktu_rencanaAfterElement.value)
          waktu_rencanaAfterElement.value = '';
      }
    }
  }

  function add_lampiran() {
    let multiple_fileElement = document.querySelector('#multiple_file');
    let newMultiple_fileElementInput = document.createElement('input');
    newMultiple_fileElementInput.setAttribute('type', 'file');
    newMultiple_fileElementInput.setAttribute('class', 'form-control mb-2');
    newMultiple_fileElementInput.setAttribute('name', 'lampiran[]');
    multiple_fileElement.appendChild(newMultiple_fileElementInput);
    // multiple_fileElement.innerHTML += '<input type="file" class="form-control mb-2" id="lampiran" name="lampiran[]">';
  }
</script>
<?= $this->endSection(); ?>