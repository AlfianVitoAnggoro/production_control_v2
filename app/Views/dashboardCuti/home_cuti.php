<?= $this->extend('template/form_cuti/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<!-- <div class="content-wrapper"> -->
<div class="container-full">
  <!-- Main content -->
  <h1 class="text-center fw-bold" style="font-size: 6vw; color: black">CUTI ONLINE</h1>
  <section class="content">
    <div class="row row-cols-2">
      <div class="col mb-2 p-0 mx-auto" style="max-width: 60vw;">
        <div class="px-2">
          <a href="<?= base_url() ?>form_cuti" class="btn fw-bold d-flex justify-content-center align-items-center" style="background-image: url(<?= base_url() ?>assets/images/background_cuti.jpg); background-size: cover; background-position: center; color: black; max-width: 60vw; height: 30vh; font-size: 6vw">Cuti</a>
        </div>
      </div>
      <div class="col mb-2 p-0 mx-auto" style="max-width: 60vw;">
        <div class="px-2">
          <a href="<?= base_url() ?>form_cuti_besar" class="btn fw-bold d-flex justify-content-center align-items-center" style="background-image: url(<?= base_url() ?>assets/images/background_cuti_besar.jpg); background-size: cover; background-position: center; color: black; max-width: 60vw; height: 30vh; font-size: 6vw">Cuti Besar</a>
        </div>
      </div>
      <div class="col mb-2 p-0 mx-auto" style="max-width: 60vw;">
        <div class="px-2">
          <a href="<?= base_url() ?>form_izin" class="btn fw-bold d-flex justify-content-center align-items-center" style="background-image: url(<?= base_url() ?>assets/images/background_izin.png); background-size: cover; background-position: center; color: black; max-width: 60vw; height: 30vh; font-size: 6vw;">Izin</a>
        </div>
      </div>
      <div class="col mb-2 p-0 mx-auto" style="max-width: 60vw;">
        <div class="px-2">
          <a href="<?= base_url() ?>form_sakit" class="btn fw-bold d-flex justify-content-center align-items-center" style="background-image: url(<?= base_url() ?>assets/images/background_sakit.png); background-size: cover; background-position: center; color: black; max-width: 60vw; height: 30vh; font-size: 6vw">Sakit</a>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- </div> -->
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
    bagian.classList.add('d-none');
    button.setAttribute('onclick', `clickpart('${part}')`);
  }
</script>
<?= $this->endSection(); ?>