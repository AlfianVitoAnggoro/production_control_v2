<?= $this->extend('template/dashboard/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left:0;">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
            <div style="margin-top:150px; margin-left:50px;">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-6" style="margin:auto">
                                <div class="row">
                                    <div class="col-12 mb-15" style="display: grid;">
                                        <a href="<?=base_url()?>dashboard/assy" target="_blank" class="btn btn-primary btn-lg btn-main-dashboard">AMB</a >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-15" style="display: grid;">
                                        <a href="<?=base_url()?>dashboard/assy/amb1" target="_blank" class="btn btn-secondary btn-sub-dashboard">AMB 1</a>
                                    </div>
                                    <div class="col-6 mb-15" style="display: grid;">
                                        <a href="<?=base_url()?>dashboard/assy/amb2" class="btn btn-secondary btn-sub-dashboard">AMB 2</a >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6" style="margin:auto">
                                <div class="row">
                                    <div class="col-12 mb-15" style="display: grid;">
                                        <a  class="btn btn-warning btn-lg btn-main-dashboard">WET</a >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-15" style="display: grid;">
                                        <a  class="btn btn-secondary btn-sub-dashboard">WET A</a >
                                    </div>
                                    <div class="col-6 mb-15" style="display: grid;">
                                        <a  class="btn btn-secondary btn-sub-dashboard">WET F</a >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6" style="margin:auto">
                                <div class="row">
                                    <div class="col-12 mb-0" style="display: grid;">
                                        <a  class="btn btn-info btn-lg btn-main-dashboard">MCB</a >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6" style="margin-left:-100px;">
                        <div class="row">
                            <div class="col-6" style="text-align:center">
                                <img src="<?=base_url()?>assets/images/icon-dashboard-produksi2/realtime_performance.png" alt="" style="width: 30%;">
                                <br>
                                <h3>Realtime Performance</h3>
                            </div>
                            <div class="col-6"  style="text-align:center">
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
                        <div class="row">
                            <div class="col-6" style="text-align:center">
                                <img src="<?=base_url()?>assets/images/icon-dashboard-produksi2/parameter_data.jpg" alt="" style="width: 30%;">
                                <br>
                                <h3>Parameter Data</h3>
                            </div>
                            <div class="col-6" style="text-align:center">
                                <img src="<?=base_url()?>assets/images/icon-dashboard-produksi2/pica.png" alt="" style="width: 30%;">
                                <br>
                                <h3>PICA</h3>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script></script>
<?= $this->endSection(); ?>