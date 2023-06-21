<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<?php $color = ['', '#ff0000', '#ffff00', '#0000ff', '#00aa00']; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <form action="<?= base_url() ?>dashboard_man_power/filter">
        <div class="">
          <label for="tanggal" class="form-label">Tanggal</label>
          <input type="date" name="tanggal" id="tanggal" class="form-control">
        </div>
        <h1 class="text-center">Dashboard Man Power</h1>
        <div class="row row-cols-12">
          <?php foreach ($data_group_man_power as $d_gmp) { ?>
            <div class="col">
              <div class="box" style="box-shadow: 0px 0px 10px rgba(0,0,0,0.2); border-radius: 5px">
                <div class="fx-card-item">
                  <div class="fx-card-content">
                    <div style="background-color: <?= $color[$d_gmp['skill']] ?>; border-radius: 5px 5px 0px 0px">
                      <h4 class="box-title mb-0 text-center p-1 fw-bold"><?= $d_gmp['mesin'] ?></h4>
                      <!-- <div class="bg-danger d-flex align-items-center justify-content-center p-0" style="border-radius: 50%; height: 30px; width: 30px">25%</div> -->
                    </div>
                    <!-- <h5 class="box-title mb-0"><?= $d_gmp['nama'] ?></h5> -->
                  </div>
                  <div class="fx-card-avatar pt-2">
                    <img src="<?= base_url() ?>uploads/<?= $d_gmp['foto'] ?>" alt="" style="width: 100%; border-radius: 0px 0px 5px 5px">
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
</script>
<?= $this->endSection(); ?>