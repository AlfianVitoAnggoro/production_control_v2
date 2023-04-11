<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">

            <div class="row">
                <div class="col-12" style="text-align:center;">
                    <h1>Production 2 Dashboard</h1>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <br>
                </div>
            </div>

            <div class="row" style="text-align:center;">
				<div class="col-4">
                    <img src="<?=base_url()?>assets/images/icon-dashboard-produksi2/realtime_performance.png" alt="" style="width: 30%;">
                    <br>
                    <h3>Realtime Performance</h3>
                </div>
                <div class="col-4">
                    <a href="<?=base_url()?>dashboard/assy" target="_blank">
                        <img src="<?=base_url()?>assets/images/icon-dashboard-produksi2/daily_report.jpg" alt="" style="width: 30%;">
                        <br>
                        <br>
                        <br>
                        <h3>Daily Report</h3>
                    </a>
                </div>
                <div class="col-4">
                    <img src="<?=base_url()?>assets/images/icon-dashboard-produksi2/henkaten_man_power.png" alt="" style="width: 30%;">
                    <br>
                    <h3>Henkaten Man Power</h3>
                </div>
			</div>

            <div class="row">
                <div class="col-12">
                    <br>
                    <br>
                </div>
            </div>

            <div class="row" style="text-align:center;">
                <div class="col-2">
                    
                </div>
                <div class="col-4">
                    <img src="<?=base_url()?>assets/images/icon-dashboard-produksi2/parameter_data.jpg" alt="" style="width: 30%;">
                    <br>
                    <h3>Parameter Data</h3>
                </div>
                <div class="col-4">
                    <img src="<?=base_url()?>assets/images/icon-dashboard-produksi2/pica.png" alt="" style="width: 30%;">
                    <br>
                    <h3>PICA</h3>
                </div>
                <div class="col-2">
                    
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