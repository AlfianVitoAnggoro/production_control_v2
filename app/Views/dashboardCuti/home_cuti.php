<?= $this->extend('template/form_cuti/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row row-cols-1" style="margin-bottom: 100px">
        <div class="col mb-2">
          <!-- <button type="button" class="btn fw-bold btn-info" style="max-width: 600px; height: 200px; font-size: 40px" id="amb_0" onclick="clickpart('amb')">Cuti</button> -->
          <a href="<?= base_url() ?>form_cuti" target="_blank" class="btn fw-bold btn-info d-flex justify-content-center align-items-center" style="max-width: 600px; height: 200px; font-size: 40px">Cuti</a>
          <div id="amb" class="d-none">
            <div class="my-2">
              <a href="<?= base_url() ?>form_cuti" target="_blank" class="btn fw-bold btn-info d-flex justify-content-center align-items-center" style="max-width: 600px; height: 200px; font-size: 40px">Cuti</a>
              <!-- <button type="button" class="btn fw-bold btn-info" style="max-width: 600px; height: 200px; font-size: 40px">AMB-1</button> -->
            </div>
          </div>
        </div>
        <div class="col mb-2">
          <a href="<?= base_url() ?>form_cuti_besar" target="_blank" class="btn fw-bold btn-primary d-flex justify-content-center align-items-center" style="max-width: 600px; height: 200px; font-size: 40px">Cuti Besar</a>
        </div>
        <div class="col mb-2">
          <a href="<?= base_url() ?>form_izin" target="_blank" class="btn fw-bold d-flex justify-content-center align-items-center" style="max-width: 600px; height: 200px; font-size: 40px; background-color: orange; color: white">Izin</a>
        </div>
        <div class="col mb-2">
          <a href="<?= base_url() ?>form_izin_sakit" target="_blank" class="btn fw-bold btn-danger d-flex justify-content-center align-items-center" style="max-width: 600px; height: 200px; font-size: 40px">Izin/ Sakit</a>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
  let listPart = ['amb'];

  function clickpart(part) {
    let bagian = document.querySelector('#' + part);
    let button = document.querySelector('#' + part + '_0');
    console.log(bagian);
    listPart.forEach(lp => {
      temp = document.querySelector('#' + lp);
      temp_button = document.querySelector('#' + lp + '_0');
      temp.classList.add('d-none');
      temp_button.setAttribute('onclick', `clickpart('${lp}')`);
    });
    bagian.classList.remove('d-none');
    button.setAttribute('onclick', `unclickpart('${part}')`);
  }

  function unclickpart(part) {
    let bagian = document.querySelector('#' + part);
    let button = document.querySelector('#' + part + '_0');
    console.log(bagian);
    // listPart.forEach(lp => {
    //   document.querySelector('#' + lp).classList.add('d-none');
    // });
    bagian.classList.add('d-none');
    button.setAttribute('onclick', `clickpart('${part}')`);
  }
</script>
<?= $this->endSection(); ?>