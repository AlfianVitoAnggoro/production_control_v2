<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan Harian Produksi</title>

	<!-- Icons -->
	<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
	<link rel="shortcut icon" href="<?= base_url() . 'assets/images/favicons/favicon.png' ?>">
	<link rel="icon" type="image/png" sizes="192x192" href="<?= base_url() . 'assets/images/favicons/favicon-192x192.png' ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() . 'assets/images/favicons/apple-touch-icon-180x180.png' ?>">
	<!-- END Icons -->

	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/main/css/vendors_css.css">

	<!-- Style-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/main/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/main/css/skin_color.css">

	<!-- Highcharts -->
	<script src="<?= base_url() . 'assets/js/highcharts/highcharts.js' ?>"></script>
	<script src="<?= base_url() . 'assets/js/highcharts/modules/series-label.js' ?>"></script>
	<script src="<?= base_url() . 'assets/js/highcharts/modules/exporting.js' ?>"></script>
	<script src="<?= base_url() . 'assets/js/highcharts/modules/export-data.js' ?>"></script>
	<script src="<?= base_url() . 'assets/js/highcharts/modules/accessibility.js' ?>"></script>

	<style>
		@font-face {
			font-family: abseoluteempire;
			src: url("<?= base_url() ?>fonts/aAbsoluteEmpire.otf") format("opentype");
			/* src: url("<?= base_url() ?>fonts/Aesthetic Romance.ttf") format("opentype"); */
		}

		.judul_dashboard {
			font-family: abseoluteempire;
			font-size: 60px;
			color: #000;
			font-weight: 600;
		}

		.sub_judul_dashboard {
			/* font-family: azonix; */
			font-size: 28px;
			color: #fff;
			font-weight: 500;
		}

		body {
			/* background-image: url("<?= base_url() ?>assets/images/background_henkaten.jpg"); */
			background-image: url("<?= base_url() ?>assets/images/1.jpg");
			/* background-image: url("<?= base_url() ?>assets/images/dashboardhenkaten.jpg"); */
			background-color: #0C134F;
			background-size: cover;
			<?php
			// $uri = current_url(true);
			// if ($uri->getSegment(3) == 'amb-1') {
			// 	echo 'background-size: cover;';
			// }
			?>
		}

		@font-face {
			font-family: azonix;
			src: url("<?= base_url() ?>fonts/azonix.otf") format("opentype");
		}
	</style>
</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

	<div class="wrapper">
		<?= $this->include('template/dashboardmanpower/header') ?>
		<?= $this->renderSection('content') ?>


		<!-- Control Sidebar -->
		<aside class="control-sidebar">

			<div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger"><i class="ion ion-close text-white" data-toggle="control-sidebar"></i></span> </div> <!-- Create the tabs -->
			<ul class="nav nav-tabs control-sidebar-tabs">
				<li class="nav-item"><a href="#control-sidebar-home-tab" data-bs-toggle="tab" class="active"><i class="mdi mdi-message-text"></i></a></li>
				<li class="nav-item"><a href="#control-sidebar-settings-tab" data-bs-toggle="tab"><i class="mdi mdi-playlist-check"></i></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Home tab content -->
				<!-- <div class="tab-pane active" id="control-sidebar-home-tab">
          <div class="flexbox">
			<a href="javascript:void(0)" class="text-grey">
				<i class="ti-more"></i>
			</a>	
			<p>Users</p>
			<a href="javascript:void(0)" class="text-end text-grey"><i class="ti-plus"></i></a>
		  </div>
		  <div class="lookup lookup-sm lookup-right d-none d-lg-block">
			<input type="text" name="s" placeholder="Search" class="w-p100">
		  </div>
          <div class="media-list media-list-hover mt-20">
			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-success" href="#">
				<img src="../images/avatar/1.jpg" alt="...">
			  </a>
			  <div class="media-body">
				<p class="fs-16">
				  <a class="hover-primary" href="#"><strong>Tyler</strong></a>
				</p>
				<p>Praesent tristique diam...</p>
				  <span>Just now</span>
			  </div>
			</div>
			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-danger" href="#">
				<img src="../images/avatar/2.jpg" alt="...">
			  </a>
			  <div class="media-body">
				<p class="fs-16">
				  <a class="hover-primary" href="#"><strong>Luke</strong></a>
				</p>
				<p>Cras tempor diam ...</p>
				  <span>33 min ago</span>
			  </div>
			</div>
			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-warning" href="#">
				<img src="../images/avatar/3.jpg" alt="...">
			  </a>
			  <div class="media-body">
				<p class="fs-16">
				  <a class="hover-primary" href="#"><strong>Evan</strong></a>
				</p>
				<p>In posuere tortor vel...</p>
				  <span>42 min ago</span>
			  </div>
			</div>
			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-primary" href="#">
				<img src="../images/avatar/4.jpg" alt="...">
			  </a>
			  <div class="media-body">
				<p class="fs-16">
				  <a class="hover-primary" href="#"><strong>Evan</strong></a>
				</p>
				<p>In posuere tortor vel...</p>
				  <span>42 min ago</span>
			  </div>
			</div>			
			
			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-success" href="#">
				<img src="../images/avatar/1.jpg" alt="...">
			  </a>
			  <div class="media-body">
				<p class="fs-16">
				  <a class="hover-primary" href="#"><strong>Tyler</strong></a>
				</p>
				<p>Praesent tristique diam...</p>
				  <span>Just now</span>
			  </div>
			</div>
			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-danger" href="#">
				<img src="../images/avatar/2.jpg" alt="...">
			  </a>
			  <div class="media-body">
				<p class="fs-16">
				  <a class="hover-primary" href="#"><strong>Luke</strong></a>
				</p>
				<p>Cras tempor diam ...</p>
				  <span>33 min ago</span>
			  </div>
			</div>
			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-warning" href="#">
				<img src="../images/avatar/3.jpg" alt="...">
			  </a>
			  <div class="media-body">
				<p class="fs-16">
				  <a class="hover-primary" href="#"><strong>Evan</strong></a>
				</p>
				<p>In posuere tortor vel...</p>
				  <span>42 min ago</span>
			  </div>
			</div>
			<div class="media py-10 px-0">
			  <a class="avatar avatar-lg status-primary" href="#">
				<img src="../images/avatar/4.jpg" alt="...">
			  </a>
			  <div class="media-body">
				<p class="fs-16">
				  <a class="hover-primary" href="#"><strong>Evan</strong></a>
				</p>
				<p>In posuere tortor vel...</p>
				  <span>42 min ago</span>
			  </div>
			</div>
			  
		  </div>
      </div> -->
				<!-- /.tab-pane -->
			</div>
		</aside>
		<!-- /.control-sidebar -->

		<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>

	</div>
	<!-- ./wrapper -->

	<!-- ./side demo panel -->
	<!-- <div class="sticky-toolbar">	    
	    <a href="<?= base_url() ?>dashboard" data-bs-toggle="tooltip" data-bs-placement="left" title="Home" class="waves-effect waves-light btn btn-success btn-flat mb-5 btn-sm">
			<span class="icon-Money"><span class="path1"></span><span class="path2"></span></span>
		</a>
	    <a href="https://themeforest.net/user/multipurposethemes/portfolio" data-bs-toggle="tooltip" data-bs-placement="left" title="Portfolio" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm" target="_blank">
			<span class="icon-Image"></span>
		</a>
	</div> -->
	<!-- Sidebar -->



	<!-- Vendor JS -->
	<script src="<?= base_url() ?>assets/template/main/js/vendors.min.js"></script>
	<script src="<?= base_url() ?>assets/template/main/js/pages/chat-popup.js"></script>
	<script src="<?= base_url() ?>assets/template/assets/icons/feather-icons/feather.min.js"></script>

	<script src="<?= base_url() ?>assets/template/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
	<script src="<?= base_url() ?>assets/template/assets/vendor_components/moment/min/moment.min.js"></script>
	<script src="<?= base_url() ?>assets/template/assets/vendor_components/fullcalendar/fullcalendar.js"></script>
	<script src="<?= base_url() ?>assets/template/assets/vendor_components/datatable/datatables.min.js"></script>
	<script src="<?= base_url() ?>assets/template/assets/vendor_components/select2/dist/js/select2.full.js"></script>

	<!-- EduAdmin App -->
	<script src="<?= base_url() ?>assets/template/main/js/template.js"></script>
	<script src="<?= base_url() ?>assets/template/main/js/pages/dashboard.js"></script>
	<script src="<?= base_url() ?>assets/template/main/js/pages/calendar.js"></script>
	<!-- <script src="<?= base_url() ?>assets/template/main/js/pages/data-table.js"></script> -->
	<script src="<?= base_url() ?>assets/template/main/js/pages/advanced-form-element.js"></script>
	<script src="<?= base_url() ?>assets/template/assets/vendor_components/echarts/dist/echarts-en.min.js"></script>
	<!-- <script src="<?= base_url() ?>js/pages/echart-pie-doghnut.js"></script> -->


	<?= $this->renderSection('script') ?>


</body>

</html>