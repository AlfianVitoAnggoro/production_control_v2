<?= $this->extend('template/layout'); ?>
<?= $this->section('style'); ?>
<style>
  .br-1 {
    border-right: 1px solid black
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<?php $jenis_cuti = ['Cuti Besar', 'Cuti Perkawinan', 'Cuti Melahirkan / Keguguran', 'Cuti Kematian', 'Cuti Haid', 'Cuti Lain-lain', 'Rawat Inap / Opname'] ?>
<?php
if ($data_mp_cuti[0]['level_account'] === 1)
  $level = 'Kadept';
else if ($data_mp_cuti[0]['level_account'] === 2)
  $level = 'Kasie';
else if ($data_mp_cuti[0]['level_account'] === 3)
  $level = 'Kasubsie';
else if ($data_mp_cuti[0]['level_account'] === 'hrd')
  $level = 'HRD';
else
  $level = '';
?>

<div class="content-wrapper">
  <div class="container">
    <div class="d-flex justify-content-end mb-3">
      <a href="<?= base_url() ?>cuti/detail_cuti_besar/<?= $id_cuti ?>/print" class="btn btn-sm btn-danger">Print</a>
    </div>
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
          <!-- tepatnya<br> -->
          <!-- Tanggal <span class="fw-bold"><?= date('j F Y', strtotime($data_mp_cuti[0]['tanggal_masa_kerja'])) ?></span> <br> -->
          maka dengan ini saya mengajukan :
          <div class="d-flex">
            <div class="d-flex justify-content-center align-items-center" style="border: 1px solid black; width: 20px; height: 20px"><?= $data_mp_cuti[0]['jenis'] == 'Pengambilan Cuti Besar' ? '<i class="fa fa-check"></i>' : '' ?></div>
            &nbsp;
            Pengambilan cuti besar selama&nbsp;<span class="fw-bold"><?= ($data_mp_cuti[0]['jumlah_hari'] != 0) ? $data_mp_cuti[0]['jumlah_hari'] : '...' ?></span>&nbsp;hari terhitung tanggal&nbsp;<span class="fw-bold"><?= (($data_mp_cuti[0]['start_date'] ?? '') != '') ? date('j F Y', strtotime($data_mp_cuti[0]['start_date'])) : '...' ?></span>&nbsp;s/d&nbsp;<span class="fw-bold"><?= (($data_mp_cuti[0]['end_date'] ?? '') != '') ? date('j F Y', strtotime($data_mp_cuti[0]['end_date'])) : '...' ?></span>
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
                <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kadiv'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kadiv'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kadiv'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kadiv']) ?></div>
                <div style="font-size: 10px;"><?= str_replace(' ', '', preg_replace('/\b(\w)\w*\b/', '$1', strtoupper($data_mp_cuti[0]['nama_kadiv']))) ?></div>
                <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_kadiv'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kadiv'])) : '' ?></div>
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
    <div class="">
      <div class="d-flex justify-content-between">
        <span style="font-size: 12px;">Edisi ke : 1, Revisi : 0</span>
        <span style="font-size: 12px;">Form-HRD-PSN-40 (Permohonan cuti besar dan pengambilan uang cuti besar) ✔</span>
      </div>
    </div>
    <h4 class="fw-bold">Lampiran</h4>
    <?php foreach ($data_lampiran as $dt_lmp) { ?>
      <div class="mb-2">
        <img src="<?= base_url() ?>uploads/lampiran_cuti/<?= $dt_lmp['lampiran'] ?>" style="max-width: 400px;">
      </div>
    <?php } ?>
  </div>
</div>

<div class="modal fade modal_reject" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?= base_url() ?>cuti/reject_cuti" method="POST">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">Note Reject</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group col">
              <label for="note_reject">Note Reject</label>
              <input type="text" class="form-control" id="note_reject" name="note_reject">
              <input type="hidden" name="id_cuti" id="id_cuti" value="<?= $id_cuti ?>">
              <input type="hidden" name="level_modal" id="level_modal">
            </div>
          </div>
        </div>
        <div class="modal-footer" style="float: right;">
          <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" value="Close">
          <button type="submit" class="btn btn-primary float-end">Kirim</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
  const approved_kadiv = document.querySelector('#approved_kadiv');
  const approved_kadept = document.querySelector('#approved_kadept');
  const approved_kasie = document.querySelector('#approved_kasie');
  const approved_kasubsie = document.querySelector('#approved_kasubsie');
  const rejected_kadiv = document.querySelector('#rejected_kadiv');
  const rejected_kadept = document.querySelector('#rejected_kadept');
  const rejected_kasie = document.querySelector('#rejected_kasie');
  const rejected_kasubsie = document.querySelector('#rejected_kasubsie');
  const status_kadiv = document.querySelector('#status_kadiv');
  const status_kadept = document.querySelector('#status_kadept');
  const status_kasie = document.querySelector('#status_kasie');
  const status_kasubsie = document.querySelector('#status_kasubsie');
  const id_cuti = <?= json_encode($id_cuti) ?>;
  <?php if ($level_account < 3) { ?>
    if (status_kadiv.value === 'approved') {
      rejected_kadiv.removeAttribute('disabled');
    } else if (status_kadiv.value === 'pending') {
      approved_kadiv.removeAttribute('disabled');
      rejected_kadiv.removeAttribute('disabled');
    }
    if (status_kadiv.value === 'rejected' || status_kadept.value === 'rejected' || status_kasie.value === 'rejected' || status_kasubsie.value === 'rejected') {
      approved_kadiv.removeAttribute('disabled');
      rejected_kadiv.setAttribute('disabled', '');
    }
    if (status_kadiv.value === 'approved') {
      approved_kadiv.setAttribute('disabled', '');
    }
  <?php } ?>
  <?php if ($level_account < 4) { ?>
    if (status_kadept.value === 'approved') {
      rejected_kadept.removeAttribute('disabled');
    } else if (status_kadept.value === 'pending') {
      rejected_kadept.removeAttribute('disabled');
      approved_kadept.removeAttribute('disabled');
    }
    if (status_kadiv.value === 'rejected' || status_kadept.value === 'rejected' || status_kasie.value === 'rejected' || status_kasubsie.value === 'rejected') {
      approved_kadept.removeAttribute('disabled');
      rejected_kadept.setAttribute('disabled', '');
    }
    if (status_kadept.value === 'approved') {
      approved_kadept.setAttribute('disabled', '');
    }
  <?php } ?>
  <?php if ($level_account < 5) { ?>
    if (status_kasie.value === 'approved') {
      rejected_kasie.removeAttribute('disabled');
    } else if (status_kasie.value === 'pending') {
      approved_kasie.removeAttribute('disabled');
      rejected_kasie.removeAttribute('disabled');
    }
    if (status_kadiv.value === 'rejected' || status_kadept.value === 'rejected' || status_kasie.value === 'rejected' || status_kasubsie.value === 'rejected') {
      approved_kasie.removeAttribute('disabled');
      rejected_kasie.setAttribute('disabled', '');
    }
    if (status_kasie.value === 'approved') {
      approved_kasie.setAttribute('disabled', '');
    }
  <?php } ?>
  <?php if ($level_account < 6) { ?>
    if (status_kasubsie.value === 'approved') {
      rejected_kasubsie.removeAttribute('disabled');
    } else if (status_kasubsie.value === 'pending') {
      approved_kasubsie.removeAttribute('disabled');
      rejected_kasubsie.removeAttribute('disabled');
    }
    if (status_kadiv.value === 'rejected' || status_kadept.value === 'rejected' || status_kasie.value === 'rejected' || status_kasubsie.value === 'rejected') {
      approved_kasubsie.removeAttribute('disabled');
      rejected_kasubsie.setAttribute('disabled', '');
    }
    if (status_kasubsie.value === 'approved') {
      approved_kasubsie.setAttribute('disabled', '');
    }
  <?php } ?>
  // approved_kadiv.addEventListener('click', () => {
  //   // $.ajax({
  //   //   url: '<?= base_url() ?>cuti/approve_cuti',
  //   //   type: 'POST',
  //   //   dataType: 'json',
  //   //   data: {
  //   //     id_cuti: id_cuti,
  //   //     status_old: status_kadiv.value
  //   //   },
  //   //   success: function(data) {
  //   //     console.log(data);
  //   //     window.alert('Approved');
  //   //     approved_kadiv.classList.remove('btn-primary');
  //   //     approved_kadiv.classList.add('btn-success');
  //   //     approved_kadiv.setAttribute('disabled', '');
  //   //     rejected_kadiv.classList.remove('btn-danger');
  //   //     rejected_kadiv.classList.add('btn-primary');
  //   //     // status_kadiv.value = 'approved';
  //   //   }
  //   // })
  // });
  // approved_kadept.addEventListener('click', () => {
  //   // $.ajax({
  //   //   url: '<?= base_url() ?>cuti/approve_cuti',
  //   //   type: 'POST',
  //   //   dataType: 'json',
  //   //   data: {
  //   //     id_cuti: id_cuti,
  //   //     status_old: status_kadept.value
  //   //   },
  //   //   success: function(data) {
  //   //     console.log(data);
  //   //     // window.alert('Approved');
  //   //     window.location.reload();
  //   //     approved_kadept.classList.remove('btn-primary');
  //   //     approved_kadept.classList.add('btn-success');
  //   //     approved_kadept.setAttribute('disabled', '');
  //   //     rejected_kadept.classList.remove('btn-danger');
  //   //     rejected_kadept.classList.add('btn-primary');
  //   //     // status_kadept.value = 'approved';
  //   //   }
  //   // })
  // });
  // approved_kasie.addEventListener('click', () => {
  //   // approved_kasie.classList.remove('btn-primary');
  //   // approved_kasie.classList.add('btn-success');
  //   // rejected_kasie.classList.remove('btn-danger');
  //   // rejected_kasie.classList.add('btn-primary');
  //   // // status_kasie.value = 'approved';
  // });
  // approved_kasubsie.addEventListener('click', () => {
  //   // approved_kasubsie.classList.remove('btn-primary');
  //   // approved_kasubsie.classList.add('btn-success');
  //   // rejected_kasubsie.classList.remove('btn-danger');
  //   // rejected_kasubsie.classList.add('btn-primary');
  //   // // status_kasubsie.value = 'approved';
  // });
  // rejected_kadiv.addEventListener('click', () => {
  //   rejected_kadiv.classList.remove('btn-primary');
  //   rejected_kadiv.classList.add('btn-danger');
  //   approved_kadiv.classList.remove('btn-success');
  //   approved_kadiv.classList.add('btn-primary');
  //   // status_kadiv.value = 'rejected';
  // });
  // rejected_kadept.addEventListener('click', () => {
  //   rejected_kadept.classList.remove('btn-primary');
  //   rejected_kadept.classList.add('btn-danger');
  //   approved_kadept.classList.remove('btn-success');
  //   approved_kadept.classList.add('btn-primary');
  //   // status_kadept.value = 'rejected';
  // });
  // rejected_kasie.addEventListener('click', () => {
  //   rejected_kasie.classList.remove('btn-primary');
  //   rejected_kasie.classList.add('btn-danger');
  //   approved_kasie.classList.remove('btn-success');
  //   approved_kasie.classList.add('btn-primary');
  //   // status_kasie.value = 'rejected';
  // });
  // rejected_kasubsie.addEventListener('click', () => {
  //   rejected_kasubsie.classList.remove('btn-primary');
  //   rejected_kasubsie.classList.add('btn-danger');
  //   approved_kasubsie.classList.remove('btn-success');
  //   approved_kasubsie.classList.add('btn-primary');
  //   // status_kasubsie.value = 'rejected';
  // });

  function sendLevel(level) {
    document.querySelector('#level_modal').value = level;
  }
</script>
<?= $this->endSection(); ?>