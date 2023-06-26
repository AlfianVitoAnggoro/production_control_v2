<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="d-flex justify-content-around" style="width: 100%">
        <div>
          <button type="button" class="btn fw-bold btn-info" style="width: 400px; height: 200px; font-size: 40px" id="amb_0" onclick="clickpart('amb')">AMB</button>
          <div id="amb" class="d-none">
            <div class="my-2">
              <a href="<?= base_url() ?>dashboard_man_power/AMB-1" class="btn fw-bold btn-info d-flex justify-content-center align-items-center" style="width: 400px; height: 200px; font-size: 40px">AMB-1</a>
              <!-- <button type="button" class="btn fw-bold btn-info" style="width: 400px; height: 200px; font-size: 40px">AMB-1</button> -->
            </div>
            <div class="my-2">
              <a href="<?= base_url() ?>dashboard_man_power/AMB-2" class="btn fw-bold btn-info d-flex justify-content-center align-items-center" style="width: 400px; height: 200px; font-size: 40px">AMB-2</a>
              <!-- <button type="button" class="btn fw-bold btn-info" style="width: 400px; height: 200px; font-size: 40px">AMB-2</button> -->
            </div>
          </div>
        </div>
        <div>
          <a href="<?= base_url() ?>dashboard_man_power/WET" class="btn fw-bold btn-primary d-flex justify-content-center align-items-center" style="width: 400px; height: 200px; font-size: 40px">WET</a>
          <!-- <button type="button" class="btn fw-bold btn-primary" style="width: 400px; height: 200px; font-size: 40px" id="wet_0" onclick="clickpart('wet')">WET</button> -->
          <!-- <div id="wet" class="d-none">
            <div class="my-2">
              <a href="<?= base_url() ?>dashboard_man_power/WET-1" class="btn fw-bold btn-primary d-flex justify-content-center align-items-center" style="width: 400px; height: 200px; font-size: 40px">WET-1</a>
              <button type="button" class="btn fw-bold btn-primary" style="width: 400px; height: 200px; font-size: 40px">WET-1</button>
            </div>
            <div class="my-2">
              <a href="<?= base_url() ?>dashboard_man_power/WET-2" class="btn fw-bold btn-primary d-flex justify-content-center align-items-center" style="width: 400px; height: 200px; font-size: 40px">WET-2</a>
              <button type="button" class="btn fw-bold btn-primary" style="width: 400px; height: 200px; font-size: 40px">WET-2</button>
            </div>
          </div> -->
        </div>
        <div>
          <a href="<?= base_url() ?>dashboard_man_power/MCB" class="btn fw-bold btn-danger d-flex justify-content-center align-items-center" style="width: 400px; height: 200px; font-size: 40px">MCB</a>
          <!-- <button type="button" class="btn fw-bold btn-danger" style="width: 400px; height: 200px; font-size: 40px" id="mcb_0" onclick="clickpart('mcb')">MCB</button> -->
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