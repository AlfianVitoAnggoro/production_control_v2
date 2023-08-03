<?= $this->extend('template/layout'); ?>
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

<div class="content-wrapper">
  <div class="container">
    <section class="content">
      <a href="<?= base_url() ?>cuti/detail_cuti/<?= $id_cuti ?>/print" class="btn btn-sm btn-danger float-end">Print</a>
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
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2" colspan="2">
              <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_hrd'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_hrd'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_hrd'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_hrd']) ?></div>
              <div style="font-size: 10px;"><?= $nama_hrd ?></div>
              <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_hrd'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_hrd'])) : '' ?></div>
            </th>
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
            <!-- <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_hrd'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_hrd'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_hrd'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_hrd']) ?></div>
              <div style="font-size: 10px;"><?= $nama_hrd ?></div>
              <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_hrd'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_hrd'])) : '' ?></div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-sm me-1 <?= $data_mp_cuti[0]['status_kadiv'] === 'rejected' ? 'btn-danger' : 'btn-primary' ?>" data-bs-toggle="modal" data-bs-target=".modal_reject" onclick="sendLevel('kadiv')" id="rejected_kadiv" disabled><i class="fa fa-times"></i></button>
                <form action="<?= base_url() ?>cuti/approve_cuti" method="post">
                  <input type="hidden" name="id_cuti" value="<?= $id_cuti ?>">
                  <input type="hidden" name="level" value="kadiv">
                  <input type="hidden" name="status_old" id="status_kadiv" value="<?= $data_mp_cuti[0]['status_kadiv'] ?>">
                  <button type="submit" class="btn btn-sm <?= $data_mp_cuti[0]['status_kadiv'] === 'approved' ? 'btn-success' : 'btn-primary' ?>" id="approved_kadiv" disabled><i class="fa fa-check"></i></button>
                </form>
              </div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-sm me-1 <?= $data_mp_cuti[0]['status_kadept'] === 'rejected' ? 'btn-danger' : 'btn-primary' ?>" data-bs-toggle="modal" data-bs-target=".modal_reject" onclick="sendLevel('kadept')" id="rejected_kadept" disabled><i class="fa fa-times"></i></button>
                <form action="<?= base_url() ?>cuti/approve_cuti" method="post">
                  <input type="hidden" name="id_cuti" value="<?= $id_cuti ?>">
                  <input type="hidden" name="level" value="kadept">
                  <input type="hidden" name="status_old" id="status_kadept" value="<?= $data_mp_cuti[0]['status_kadept'] ?>">
                  <button type="submit" class="btn btn-sm <?= $data_mp_cuti[0]['status_kadept'] === 'approved' ? 'btn-success' : 'btn-primary' ?>" id="approved_kadept" disabled><i class="fa fa-check"></i></button>
                </form>
              </div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-sm me-1 <?= $data_mp_cuti[0]['status_kasie'] === 'rejected' ? 'btn-danger' : 'btn-primary' ?>" data-bs-toggle="modal" data-bs-target=".modal_reject" onclick="sendLevel('kasie')" id="rejected_kasie" disabled><i class="fa fa-times"></i></button>
                <form action="<?= base_url() ?>cuti/approve_cuti" method="post">
                  <input type="hidden" name="id_cuti" value="<?= $id_cuti ?>">
                  <input type="hidden" name="level" value="kasie">
                  <input type="hidden" name="status_old" id="status_kasie" value="<?= $data_mp_cuti[0]['status_kasie'] ?>">
                  <button type="submit" class="btn btn-sm <?= $data_mp_cuti[0]['status_kasie'] === 'approved' ? 'btn-success' : 'btn-primary' ?>" id="approved_kasie" disabled><i class="fa fa-check"></i></button>
                </form>
              </div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-sm me-1 <?= $data_mp_cuti[0]['status_kasubsie'] === 'rejected' ? 'btn-danger' : 'btn-primary' ?>" data-bs-toggle="modal" data-bs-target=".modal_reject" onclick="sendLevel('kasubsie')" id="rejected_kasubsie" disabled><i class="fa fa-times"></i></button>
                <form action="<?= base_url() ?>cuti/approve_cuti" method="post">
                  <input type="hidden" name="id_cuti" value="<?= $id_cuti ?>">
                  <input type="hidden" name="level" value="kasubsie">
                  <input type="hidden" name="status_old" id="status_kasubsie" value="<?= $data_mp_cuti[0]['status_kasubsie'] ?>">
                  <button type="submit" class="btn btn-sm <?= $data_mp_cuti[0]['status_kasubsie'] === 'approved' ? 'btn-success' : 'btn-primary' ?>" id="approved_kasubsie" disabled><i class="fa fa-check"></i></button>
                </form>
              </div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 10px;" class="bg-success">Created</div>
              <div style="font-size: 10px;"><?= $nama ?></div>
              <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created'] ?></div>
            </th> -->
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_hrd'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_hrd'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_hrd'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_hrd']) ?></div>
              <div style="font-size: 10px;"><?= $nama_hrd ?></div>
              <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_hrd'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_hrd'])) : '' ?></div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <?php if ($data_mp_cuti[0]['status_kadiv'] != 'pending') { ?>
                <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kadiv'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kadiv'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kadiv'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kadiv']) ?></div>
                <div style="font-size: 10px;"><?= $nama_kadiv ?></div>
                <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_kadiv'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kadiv'])) : '' ?></div>
              <?php } ?>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kadept'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kadept'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kadept'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kadept']) ?></div>
              <div style="font-size: 10px;"><?= $nama_kadept ?></div>
              <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_kadept'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kadept'])) : '' ?></div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kasie'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kasie'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kasie'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kasie']) ?></div>
              <div style="font-size: 10px;"><?= $nama_kasie ?></div>
              <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_kasie'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kasie'])) : '' ?></div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 10px; background-color: <?= $data_mp_cuti[0]['status_kasubsie'] == 'rejected' ? 'red' : ($data_mp_cuti[0]['status_kasubsie'] == 'approved' ? 'green' : 'yellow') ?>; color: <?= $data_mp_cuti[0]['status_kasubsie'] == 'pending' ? 'black' : 'white' ?>"><?= ucfirst($data_mp_cuti[0]['status_kasubsie']) ?></div>
              <div style="font-size: 10px;"><?= $nama_kasubsie ?></div>
              <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created_kasubsie'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created_kasubsie'])) : '' ?></div>
            </th>
            <th class="py-1 br-1 text-center" style="height: 58px;" rowspan="2">
              <div style="font-size: 10px; background-color: green; color: white">Created</div>
              <div style="font-size: 10px;"><?= $nama ?></div>
              <div style="font-size: 10px;"><?= $data_mp_cuti[0]['created'] !== NULL ? date('Y-m-d H:i', strtotime($data_mp_cuti[0]['created'])) : '' ?></div>
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
            <td class="py-1 text-end" colspan="3">Form-HRD-PSN-39 (Permohonan cuti)</td>
          </tr>
        </tfoot>
      </table>
      <h4 class="fw-bold">Lampiran</h4>
      <div class="row row-cols-2">
        <?php foreach ($data_lampiran as $dt_lmp) { ?>
          <div class="col text-center">
            <img src="<?= base_url() ?>uploads/lampiran_cuti/<?= $dt_lmp['lampiran'] ?>" style="max-width: 90%;">
          </div>
        <?php } ?>
      </div>
    </section>
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