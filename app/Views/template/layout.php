<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan Harian Produksi | PT CBI</title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/main/css/vendors_css.css">

	<!-- Style-->
	<style>
		/* Works for Chrome, Safari, Edge, Opera */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		/* Works for Firefox */
		input[type="number"] {
			-moz-appearance: textfield;
		}
	</style>
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/main/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/template/main/css/skin_color.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

  <!-- Control Sidebar -->
  <aside class="control-sidebar">
	  
	<div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger"><i class="ion ion-close text-white" data-toggle="control-sidebar"></i></span> </div>  <!-- Create the tabs -->
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
		</aside>
		<!-- /.control-sidebar -->

		<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>

	</div>
	<!-- ./wrapper -->

	<!-- ./side demo panel -->
	<div class="sticky-toolbar">
		<a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Buy Now" class="waves-effect waves-light btn btn-success btn-flat mb-5 btn-sm" target="_blank">
			<span class="icon-Money"><span class="path1"></span><span class="path2"></span></span>
		</a>
		<a href="https://themeforest.net/user/multipurposethemes/portfolio" data-bs-toggle="tooltip" data-bs-placement="left" title="Portfolio" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm" target="_blank">
			<span class="icon-Image"></span>
		</a>
		<a id="chat-popup" href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="Live Chat" class="waves-effect waves-light btn btn-warning btn-flat btn-sm">
			<span class="icon-Group-chat"><span class="path1"></span><span class="path2"></span></span>
		</a>
	</div>
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



	<?= $this->renderSection('script') ?>

</body>

</html>