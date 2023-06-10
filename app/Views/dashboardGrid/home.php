<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-12" style="text-align:center;">
          <h1>Production 1 Dashboard</h1>
          <br>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <br>
        </div>
      </div>

      <div class="row" style="text-align:center;">
        <div class="col-6">
          <a href="<?= base_url() ?>dashboardGrid/grid" target="_blank">
            <span class="fa-stack fa-lg fa-5x" style="color: #000000">
              <i class="fa fa-square-o fa-stack-2x"></i>
              <i class="fa fa-bar-chart fa-stack-1x" aria-hidden="true"></i>
            </span>
            <br>
            <h3>Grid Casting</h3>
          </a>
        </div>
        <div class="col-6">
          <a href="<?= base_url() ?>dashboardPasting/pasting" target="_blank">
            <span class="fa-stack fa-lg fa-5x" style="color: #000000">
              <i class="fa fa-square-o fa-stack-2x"></i>
              <i class="fa fa-clipboard fa-stack-1x" aria-hidden="true"></i>
            </span>
            <br>
            <h3>Pasting</h3>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <br>
          <br>
        </div>
      </div>
      <div class="row" style="text-align:center;">
        <div class="col-6">
          <a href="http://10.19.16.30/views/DataTebalWideStrip/Dashboard1" target="_blank">
            <span class="fa-stack fa-lg fa-5x" style="color: #000000">
              <i class="fa fa-square-o fa-stack-2x"></i>
              <i class="fa fa-window-maximize fa-stack-1x" aria-hidden="true"></i>
            </span>
            <br>
            <h3>Tebal Wide Strip</h3>
          </a>
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
</script>
<?= $this->endSection(); ?>