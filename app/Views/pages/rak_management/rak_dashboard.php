<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>



<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-body">
              <h3>Dashboard Rak Management</h3>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-12">
          <div class="box box-inverse box-primary">
            <div class="box-header with-border">
              <h4 class="box-title"><strong>Rak Tersedia</strong></h4>
              <div class="box-tools pull-right">
                <ul class="box-controls">
                </ul>
              </div>
            </div>

            <div class="box-body">
              <h4 style="font-weight: bold;"><?= count($data_rak_management) ?> Tersedia</h4>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-12">
          <div class="box box-inverse box-success">
            <div class="box-header">
              <h4 class="box-title"><strong>Rak Terisi</strong></h4>
              <div class="box-tools pull-right">
                <ul class="box-controls">
                </ul>
              </div>
            </div>

            <div class="box-body">
              <h4 style="font-weight: bold;"><?= count($data_rak_management_status) ?> Terisi</h4>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-12">
          <div class="box box-inverse box-warning">
            <div class="box-header">
              <h4 class="box-title"><strong>Rak Kosong</strong></h4>
              <div class="box-tools pull-right">
                <ul class="box-controls">
                </ul>
              </div>
            </div>

            <div class="box-body">
              <h4 style="font-weight: bold;"><?= count($data_rak_management) - count($data_rak_management_status) ?> Kosong</h4>
            </div>
          </div>
        </div>

        
      </div>
    </section>
  </div>
</div>


<?= $this->endSection(); ?>