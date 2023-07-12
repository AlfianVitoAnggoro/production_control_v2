<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian Produksi</title>

	<!-- Icons -->
	<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
	<link rel="shortcut icon" href="<?= base_url(). 'assets/images/favicons/favicon.png'?>">
	<link rel="icon" type="image/png" sizes="192x192" href="<?= base_url() . 'assets/images/favicons/favicon-192x192.png'?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() . 'assets/images/favicons/apple-touch-icon-180x180.png'?>">
	<!-- END Icons -->

    <!-- Vendors Style-->
	<link rel="stylesheet" href="<?=base_url()?>assets/template/main/css/vendors_css.css">
	  
    <!-- Style-->  
    <link rel="stylesheet" href="<?=base_url()?>assets/template/main/css/style.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/template/main/css/skin_color.css">
	
	<!-- Highcharts -->
	<script src="<?= base_url() . 'assets/js/highcharts/highcharts.js'?>"></script>
	<script src="<?= base_url() . 'assets/js/highcharts/modules/series-label.js'?>"></script>
	<script src="<?= base_url() . 'assets/js/highcharts/modules/exporting.js'?>"></script>
	<script src="<?= base_url() . 'assets/js/highcharts/modules/export-data.js'?>"></script>
	<script src="<?= base_url() . 'assets/js/highcharts/modules/accessibility.js'?>"></script>

	<style>
		@font-face {
			font-family: azonix;
			src: url("<?= base_url()?>fonts/azonix.otf") format("opentype");
		}

		.judul_dashboard {
			/* font-family: azonix; */
			font-size: 45px;
			color: #fff;
			font-weight:600;
			letter-spacing: 4px;	
		}

		.sub_judul_dashboard {
			/* font-family: azonix; */
			font-size: 37px;
			color: #fff;
			font-weight:500;	
		}

		input {
			color-scheme: dark;
		}

		body {
			background-image: url("<?= base_url()?>assets/images/bg-dashboard-qc.jpg");
			/* background-color: #cccccc; */
			background-size: cover;
		}

		.main-header {
			background-color: transparent !important;
			background: transparent !important;
			border-color: transparent !important;
		}

		.btn-nav {
			font-size: 18px;
			font-weight: 600;
		}

		.modal {
			overflow-y:auto;
		}

	</style>
</head>
<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">
    <header class="main-header">
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <div class="app-menu">
                <ul class="header-megamenu nav">
                    <!-- <li class="btn-group nav-item d-md-none">
                    <a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button">
                        <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                    </a>
                </li>
                <li class="btn-group nav-item d-none d-xl-inline-block">
                    <a href="contact_app_chat.html" class="waves-effect waves-light nav-link svg-bt-icon" title="Chat">
                        <i class="icon-Chat"><span class="path1"></span><span class="path2"></span></i>
                    </a>
                </li>
                <li class="btn-group nav-item d-none d-xl-inline-block">
                    <a href="mailbox.html" class="waves-effect waves-light nav-link svg-bt-icon" title="Mailbox">
                        <i class="icon-Mailbox"><span class="path1"></span><span class="path2"></span></i>
                    </a>
                </li>
                <li class="btn-group nav-item d-none d-xl-inline-block">
                    <a href="extra_taskboard.html" class="waves-effect waves-light nav-link svg-bt-icon" title="Taskboard">
                        <i class="icon-Clipboard-check"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    </a>
                </li> -->
                </ul>
            </div>

            <div style="margin-left:-250px; text-align:center; margin-top:-5px;">
                <h1 class="judul_dashboard">REJECTION DASHBOARD</h1>
                <!-- <br> -->
                <span class="sub_judul_dashboard">ASSEMBLING AMB</span>
            </div>

            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                    <!-- <li class="btn-group nav-item d-lg-inline-flex d-none">
                    <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen" title="Full Screen">
                        <i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
                    </a>
                </li>	   -->
                    <!-- <li class="btn-group d-lg-inline-flex d-none">
                    <div class="app-menu">
                        <div class="search-bx mx-5">
                            <form>
                                <div class="input-group">
                                <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn" type="submit" id="button-addon3"><i class="ti-search"></i></button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </li> -->
                    <!-- Notifications -->
                    <!-- <li class="dropdown notifications-menu">
                <a href="#" class="waves-effect waves-light dropdown-toggle" data-bs-toggle="dropdown" title="Notifications">
                <i class="icon-Notifications"><span class="path1"></span><span class="path2"></span></i>
                </a>
                <ul class="dropdown-menu animated bounceIn">

                <li class="header">
                    <div class="p-20">
                        <div class="flexbox">
                            <div>
                                <h4 class="mb-0 mt-0">Notifications</h4>
                            </div>
                            <div>
                                <a href="#" class="text-danger">Clear All</a>
                            </div>
                        </div>
                    </div>
                </li> -->

                    <!-- <li> -->
                    <!-- inner menu: contains the actual data -->
                    <!-- <ul class="menu sm-scrol">
                    <li>
                        <a href="#">
                        <i class="fa fa-users text-info"></i> Curabitur id eros quis nunc suscipit blandit.
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-warning text-warning"></i> Duis malesuada justo eu sapien elementum, in semper diam posuere.
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-users text-danger"></i> Donec at nisi sit amet tortor commodo porttitor pretium a erat.
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-shopping-cart text-success"></i> In gravida mauris et nisi
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-user text-danger"></i> Praesent eu lacus in libero dictum fermentum.
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-user text-primary"></i> Nunc fringilla lorem 
                        </a>
                    </li>
                    <li>
                        <a href="#">
                        <i class="fa fa-user text-success"></i> Nullam euismod dolor ut quam interdum, at scelerisque ipsum imperdiet.
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="footer">
                    <a href="#">View all</a>
                </li>
                </ul>
            </li>	 -->

                    <!-- User Account-->
                    <!-- <li class="dropdown user user-menu">
                        <a href="#" class="waves-effect waves-light dropdown-toggle" data-bs-toggle="dropdown" title="User">
                            <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                        </a>
                        <ul class="dropdown-menu animated flipInX">
                            <li class="user-body"> -->
                                <!-- <a class="dropdown-item" href="#"><i class="ti-user text-muted me-2"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="ti-wallet text-muted me-2"></i> My Wallet</a>
                    <a class="dropdown-item" href="#"><i class="ti-settings text-muted me-2"></i> Settings</a> -->
                                <!-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url() ?>logout"><i class="ti-lock text-muted me-2"></i> Logout</a>
                            </li>
                        </ul>
                    </li> -->

                    <!-- Control Sidebar Toggle Button -->
                    <!-- <li>
                <a href="#" data-toggle="control-sidebar" title="Setting" class="waves-effect waves-light">
                    <i class="icon-Settings"><span class="path1"></span><span class="path2"></span></i>
                </a>
            </li> -->

                </ul>
            </div>
        </nav>
    </header>
<!-- Content Wrapper. Contains page content -->
<?php
    date_default_timezone_set('Asia/Jakarta');
    $current_date = idate('m', strtotime($bulan));
    if ($current_date != 12) {
        $previous_date = $current_date - 1;
    } else {
        $previous_date = 12;
    }

    if ($child_filter != null AND $child_filter != 0 AND $baby_filter == 'average') {
        $type_chart = 'line';
    } else {
        $type_chart = 'column';
    }

    $data = $data_reject_by_date;
    $merged = array();
    foreach ($data as $item) {
        $name = $item["name"];
        if (!isset($merged[$name])) {
            $merged[$name] = array("name" => $name, "data" => array($item["data"]));
        } else {
            array_push($merged[$name]["data"], $item["data"]);
        }
    }
    $result = array_values($merged);

    $data_daily_persentase = $data_reject_by_date_persentase;
    $merged_daily_persentase = array();
    foreach ($data_daily_persentase as $item) {
        $name = $item["name"];
        if (!isset($merged_daily_persentase[$name])) {
            $merged_daily_persentase[$name] = array("name" => $name, "data" => array($item["data"]));
        } else {
            array_push($merged_daily_persentase[$name]["data"], $item["data"]);
        }
    }
    $result_daily_reject_persentase = array_values($merged_daily_persentase);

    $adj_reject = array(0.52, 0.51, 0.48, 0.44);

    for ($i = 0; $i < 4; $i++) {
        $data_average_reject_by_month[$i] = $adj_reject[$i];
    }
?>

<div class="content-wrapper" style="margin-left:0; margin-top:50px;">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
            <div class="row">
                <div class="box bg-transparent">
                    <div class="box-body" style="display:flex">
                        <div class="col-2">
                            <form action="<?=base_url()?>dashboard/reject_qc" method="POST">
                                <select class="form-select" name="jenis_dashboard" id="jenis_dashboard" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px; display:none;">
                                    <option value="1">Rejection</option>
                                    <option value="2">Unit / MH</option>
                                </select>
                                &nbsp;
                                <select class="form-select" name="parent_filter" id="parent_filter" style="display:none">
                                    <option value="line" <?= ($parent_filter == 'line') ? 'selected':''?>>Line</option>
                                </select>
                                &nbsp;
                                <select class="form-select" name="child_filter" id="child_filter" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px;">
                                    <option value="0" <?= ($child_filter == '0') ? 'selected':''?>>All</option>
                                    <?php for ($i=1; $i <= 7 ; $i++) { ?>
                                        <option value="<?=$i?>" <?= ($child_filter == $i) ? 'selected':''?>>Line <?=$i?></option>
                                    <?php } ?>
                                </select>
                                &nbsp;
                                <select class="form-select" name="baby_filter" id="baby_filter" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px;">
                                    <?php if ($child_filter == 0) { ?>
                                        <option value="average" <?= ($baby_filter == 'average') ? 'selected':''?>>By Average</option>
                                        <option value="line" <?= ($baby_filter == 'line') ? 'selected':''?>>By Line</option>
                                    <?php } else { ?>
                                        <option value="average" <?= ($baby_filter == 'average') ? 'selected':''?>>By Average</option>
                                        <!-- <option value="shift" <?= ($baby_filter == 'shift') ? 'selected':''?>>By Shift</option>
                                        <option value="grup" <?= ($baby_filter == 'grup') ? 'selected':''?>>By Grup</option>
                                        <option value="kasubsie" <?= ($baby_filter == 'kasubsie') ? 'selected':''?>>By Kasubsie</option> -->
                                    <?php } ?>
                                </select>
                                &nbsp;
                                <input type="date" class="form-control" name="bulan" id="bulan" value="<?= $bulan ?>" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px;">
                                &nbsp;
                                <div style="display: flex; flex-direction: column;" >
                                    <button class="btn btn-sm btn-success" style="font-size: 20px;font-weight: 900;width: 250px;"> Filter </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-2" style="display:flex; margin-top:35px;">
                            <div class="col-6">
                                <div id="year_to_date_chart" style="height:250px;"></div>
                            </div>
                            <!-- <div class="col-3">
                                <div id="target_chart" style="height:250px;"></div>
                            </div> -->
                            <!-- <div class="col-3">
                                <div id="previous_month_chart" style="height:250px;"></div>
                            </div> -->
                            <div class="col-6">
                                <div id="current_month_chart" style="height:250px;"></div>
                            </div>
                            <!-- <div class="col-3" style="display:flex;text-align:center;flex-direction: column;align-items: center;flex-wrap: nowrap;justify-content: space-around;">
                                <a href="<?=base_url()?>dashboard/assy" class="btn btn-danger btn-nav">Efficiency</a>
                                <button class="btn btn-info btn-nav">Line Stop</button>
                                <button class="btn btn-success btn-nav">Overtime</button>
                            </div> -->
                        </div>
                        <div class="col-4">
                            <div class="box bg-transparent">
                                <div class="box-body">
                                    <figure class="highcharts-figure">
                                        <div id="average_month_chart"></div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="box bg-transparent">
                                <div class="box-body">
                                    <figure class="highcharts-figure">
                                        <div id="pareto_reject"></div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($baby_filter == 'average') { ?>
                <!-- CHART AVG DAILY REJECTION DAN AVG MONTHLY REJECTION ALL ASSY (%) -->
                <div class="row">
                    <div class="col-xl-8 col-12">
                        <div class="box bg-transparent">
                            <div class="box-body">
                                <figure class="highcharts-figure">
                                    <div id="average_daily_chart"></div>
                                </figure>
                            </div>
                        </div>										
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="box bg-transparent">
                            <div class="box-body">
                                <figure class="highcharts-figure">
                                    <div id="pareto_reject_date"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else if ($baby_filter == 'line') { ?>
                <!-- CHART AVG DAILY REJECTION DAN AVG MONTHLY REJECTION SHOW PER LINE (%) -->
                <div class="row">
                    <div class="col-xl-8 col-12">
                        <div class="box bg-transparent">
                            <div class="box-body">
                                <figure class="highcharts-figure">
                                    <div id="average_daily_chart_by_line"></div>
                                </figure>
                            </div>
                        </div>										
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="box bg-transparent">
                            <div class="box-body">
                                <figure class="highcharts-figure">
                                    <div id="average_month_chart_by_line"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>

            <!-- CHART DAILY REJECTION DAN MONTHLY JENIS REJECTION (%) -->
            <div class="row" style="display:none">
				<div class="col-xl-12 col-12">
					<div class="box bg-transparent">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="daily_rejection_persentase_chart"></div>
                            </figure>
						</div>
					</div>										
				</div>
				<div class="col-xl-4 col-12" style="display:none">
					<div class="box bg-transparent">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="monthly_rejection_persentase_chart"></div>
                            </figure>
						</div>
					</div>
				</div>
			</div>

            <!-- CHART DAILY REJECTION DAN MONTHLY JENIS REJECTION (PCS) -->
			<div class="row" id="efficiency-wrapper" style="display:none">
				<div class="col-xl-12 col-12">
					<div class="box bg-transparent">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="main_chart"></div>
                            </figure>
						</div>
					</div>										
				</div>
				<div class="col-xl-4 col-12" style="display:none">
					<div class="box bg-transparent">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="side_chart"></div>
                            </figure>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->

<!-- MODAL -->
<div class="modal fade" id="main_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width:120%;">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Rejection</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="detail_pareto_jenis_reject"></div>
                <div id="detail_pareto_kategori_reject"></div>
                <div id="detail_pareto_type_battery"></div>
                <div id="detail_pareto_grup_shift"></div>
            </div>
            <div class="modal-footer" style="float: right;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- SUB MODAL -->
<div class="modal fade" id="sub_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width:120%;">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Rejection</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="sub_detail_pareto_jenis_reject"></div>
                <div id="sub_detail_pareto_kategori_reject"></div>
                <div id="sub_detail_pareto_type_battery"></div>
                <div id="sub_detail_pareto_grup_shift"></div>
            </div>
            <div class="modal-footer" style="float: right;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
          <a href="<?=base_url()?>dashboard" data-bs-toggle="tooltip" data-bs-placement="left" title="Home" class="waves-effect waves-light btn btn-success btn-flat mb-5 btn-sm">
              <span class="icon-Money"><span class="path1"></span><span class="path2"></span></span>
          </a>
          <a href="https://themeforest.net/user/multipurposethemes/portfolio" data-bs-toggle="tooltip" data-bs-placement="left" title="Portfolio" class="waves-effect waves-light btn btn-danger btn-flat mb-5 btn-sm" target="_blank">
              <span class="icon-Image"></span>
          </a>
      </div> -->
      <!-- Sidebar -->	
      
      
      
      <!-- Vendor JS -->
      <script src="<?=base_url()?>assets/template/main/js/vendors.min.js"></script>
      <script src="<?=base_url()?>assets/template/main/js/pages/chat-popup.js"></script>
      <script src="<?=base_url()?>assets/template/assets/icons/feather-icons/feather.min.js"></script>
  
      <script src="<?=base_url()?>assets/template/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
      <script src="<?=base_url()?>assets/template/assets/vendor_components/moment/min/moment.min.js"></script>
      
      <!-- EduAdmin App -->
      <script src="<?=base_url()?>assets/template/main/js/template.js"></script>
      <script src="<?=base_url()?>assets/template/main/js/pages/dashboard.js"></script>
      <script src="<?=base_url()?>assets/template/main/js/pages/calendar.js"></script>
      <!-- <script src="<?=base_url()?>assets/template/main/js/pages/data-table.js"></script> -->
      <script src="<?=base_url()?>assets/template/main/js/pages/advanced-form-element.js"></script>
      <script src="<?=base_url()?>assets/template/assets/vendor_components/echarts/dist/echarts-en.min.js"></script>
      <!-- <script src="<?=base_url()?>js/pages/echart-pie-doghnut.js"></script> -->
 
    <script>
        $(document).ready(function() {
            $('#child_filter').change(function() {
                var selectedValue = $(this).val();
                populateSecondarySelect(selectedValue);
            });

            setTimeout(function () { location.reload(1); }, 60*60*1000);
        });

        function populateSecondarySelect(selectedValue) {
            $('#baby_filter').empty();
            
            if (selectedValue == '0') {
                $('#baby_filter').append($('<option>', {
                    value: 'average',
                    text: 'By Average'
                }));

                $('#baby_filter').append($('<option>', {
                    value: 'line',
                    text: 'By Line'
                }));
            } else {
                $('#baby_filter').append($('<option>', {
                    value: 'average',
                    text: 'By Average'
                }));
                
                // $('#baby_filter').append($('<option>', {
                //     value: 'shift',
                //     text: 'By Shift'
                // }));

                // $('#baby_filter').append($('<option>', {
                //     value: 'grup',
                //     text: 'By Grup'
                // }));

                // $('#baby_filter').append($('<option>', {
                //     value: 'kasubsie',
                //     text: 'By Kasubsie'
                // }));
            }
        }

        // PIE CHART YEAR TO GET
        var year_to_date_chart = echarts.init(document.getElementById('year_to_date_chart'));
        year_to_date_chart.setOption(
            {
                title: {
                    text: '<?=json_encode($data_all_year)?>%',
                    subtext: 'Year To Date',
                    x: 'center',
                    y: 'center',
                    itemGap: 5,
                    textStyle: {
                        color: '#ffffff',
                        fontSize: 30,
                        fontWeight: '700'
                    },
                    subtextStyle: {
                        color: '#ffffff',
                        fontSize: 15,
                        fontWeight: 'normal'
                    }

                },           
                series: [
                    {
                        name: '1',
                        type: 'pie',
                        clockWise: false,
                        radius: ['75%', '90%'],
                        silent: true,
                        itemStyle: {
                            normal: {
                                label: {show: false},
                                labelLine: {show: false}
                            }
                        },
                        data: [
                            {
                                value: <?=json_encode($data_all_year)?> * 100,
                                name: 'Monday',
                                itemStyle: {
                                    color: 'blue'
                                }
                            },
                            {
                                value: 100 - (<?=json_encode($data_all_year)?> * 100),
                                name: 'invisible',
                                itemStyle: {
                                    color: 'grey'
                                }
                            }
                        ]
                    },
                ]
            }
        );

        // PIE CHART TARGET
        // var target_chart = echarts.init(document.getElementById('target_chart'));
        // target_chart.setOption(
        //     {
        //         title: {
        //             text: '0.4%',
        //             subtext: 'Batas Rejection',
        //             x: 'center',
        //             y: 'center',
        //             itemGap: 5,
        //             textStyle: {
        //                 color: '#ffffff',
        //                 fontSize: 30,
        //                 fontWeight: '700'
        //             },
        //             subtextStyle: {
        //                 color: '#ffffff',
        //                 fontSize: 15,
        //                 fontWeight: 'normal'
        //             }

        //         },           
        //         series: [
        //             {
        //                 name: '1',
        //                 type: 'pie',
        //                 clockWise: false,
        //                 radius: ['75%', '90%'],
        //                 silent: true,
        //                 itemStyle: {
        //                     normal: {
        //                         label: {show: false},
        //                         labelLine: {show: false}
        //                     }
        //                 },
        //                 data: [
        //                     {
        //                         value: 40,
        //                         name: 'Monday',
        //                         itemStyle: {
        //                             color: 'red'
        //                         }
        //                     },
        //                     {
        //                         value: 60,
        //                         name: 'invisible',
        //                         itemStyle: {
        //                             color: 'grey'
        //                         }
        //                     }
        //                 ]
        //             },
        //         ]
        //     }
        // );

        // PIE CHART Previous Month
        // var previous_month_chart = echarts.init(document.getElementById('previous_month_chart'));
        // previous_month_chart.setOption(
        //     {
        //         title: {
        //             text: '<?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1])?>%',
        //             subtext: '<?=date('F', mktime(0, 0, 0, $previous_date, 10))?> Rejection',
        //             x: 'center',
        //             y: 'center',
        //             itemGap: 5,
        //             textStyle: {
        //                 color: '#ffffff',
        //                 fontSize: 30,
        //                 fontWeight: '700'
        //             },
        //             subtextStyle: {
        //                 color: '#ffffff',
        //                 fontSize: 15,
        //                 fontWeight: 'normal'
        //             }

        //         },           
        //         series: [
        //             {
        //                 name: '1',
        //                 type: 'pie',
        //                 clockWise: false,
        //                 radius: ['75%', '90%'],
        //                 silent: true,
        //                 itemStyle: {
        //                     normal: {
        //                         label: {show: false},
        //                         labelLine: {show: false}
        //                     }
        //                 },
        //                 data: [
        //                     {
        //                         value: <?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1])?> * 100,
        //                         name: 'Monday',
        //                         itemStyle: {
        //                             color: 'red'
        //                         }
        //                     },
        //                     {
        //                         value: 100 - (<?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1])?> * 100),
        //                         name: 'invisible',
        //                         itemStyle: {
        //                             color: 'grey'
        //                         }
        //                     }
        //                 ]
        //             },
        //         ]
        //     }
        // );

        // PIE CHART Current Month
        var current_month_chart = echarts.init(document.getElementById('current_month_chart'));
        current_month_chart.setOption(
            {
                title: {
                    text: '<?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $current_date, 10)) - 1])?>%',
                    subtext: '<?=date('F', mktime(0, 0, 0, $current_date, 10))?> Rejection',
                    x: 'center',
                    y: 'center',
                    itemGap: 5,
                    textStyle: {
                        color: '#ffffff',
                        fontSize: 30,
                        fontWeight: '700'
                    },
                    subtextStyle: {
                        color: '#ffffff',
                        fontSize: 15,
                        fontWeight: 'normal'
                    }

                },           
                series: [
                    {
                        name: '1',
                        type: 'pie',
                        clockWise: false,
                        radius: ['75%', '90%'],
                        silent: true,
                        itemStyle: {
                            normal: {
                                label: {show: false},
                                labelLine: {show: false}
                            }
                        },
                        data: [
                            {
                                value: <?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $current_date, 10)) - 1])?> * 100,
                                name: 'Monday',
                                itemStyle: {
                                    color: 'cyan'
                                }
                            },
                            {
                                value: 100 - (<?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $current_date, 10)) - 1])?> * 100),
                                name: 'invisible',
                                itemStyle: {
                                    color: 'grey'
                                }
                            }
                        ]
                    },
                ]
            }
        );

        // DATA PARETO REJECT BY LINE DAILY
        Highcharts.chart('pareto_reject_date', {
            chart: {
                backgroundColor: 'transparent',
                type: 'column',
                // backgroundColor: '#0c1a32',
                
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Daily Rejection <?=date('d M Y', strtotime($bulan))?> (%)',
                style: {
                    color: '#ffffff',
                    fontSize: '20px'
                }
            },
            xAxis: {
                categories: <?php echo json_encode($data_reject_by_line_by_date); ?>,
                crosshair: true,
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '%'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        formatter: function(){
                            return (this.y!=0)?this.y:"";
                        },
                        style: {
                            color: '#ffffff',
                            textOutline: 0,
                            fontSize: 14
                        },
                    },
                    // pointWidth: 30,
                }
            },
            legend: {
                    enabled: false
                },

            series: [{
                // name: 'All Line',
                data: <?php echo json_encode($data_total_reject_by_line_by_date); ?>,
                color:'yellow',

            },
            {
                type: 'spline',
                name: 'Target',
                data: [0.4, 0.4,0.4,0.4,0.4,0.4,0.4],
                color:'red',
            }]
        });

        // DATA PARETO REJECT BY LINE MONTHLY
        Highcharts.chart('pareto_reject', {
            chart: {
                backgroundColor: 'transparent',
                type: 'column',
                // backgroundColor: '#0c1a32',
                
            },
            exporting: {
                enabled: false
            },
            title: {
                text: '<?=date('F', strtotime($bulan))?> Rejection (%)',
                style: {
                    color: '#ffffff',
                    fontSize: '20px'
                }
            },
            xAxis: {
                categories: <?php echo json_encode($data_reject_by_line); ?>,
                crosshair: true,
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '%'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        formatter: function(){
                            return (this.y!=0)?this.y:"";
                        },
                        style: {
                            color: '#ffffff',
                            textOutline: 0,
                            fontSize: 14
                        },
                    },
                    // pointWidth: 30,
                }
            },
            legend: {
                    enabled: false
                },

            series: [{
                // name: 'All Line',
                data: <?php echo json_encode($data_total_reject_by_line); ?>,
                color:'yellow',

            },
            {
                type: 'spline',
                name: 'Target',
                data: [0.4, 0.4,0.4,0.4,0.4,0.4,0.4],
                color:'red',
            }]
        });

        // GENERATE X AXIS DATE
        <?php
            $dates = array();
            $target_by_date = array();
            $target_by_month = array();

            date_default_timezone_set('Asia/Jakarta');
            $start = date('Y-m-01');
            $now = date('Y-m-d');

            $current_month = date('Y-m');
            if ($bulan != null OR $bulan != $current_month) {
                $start = date('Y-m-01', strtotime($bulan));
                $now = date('Y-m-t', strtotime($bulan));
            }

            while (strtotime($start) <= strtotime($now)) {
                array_push($dates, date("d", strtotime($start)));
                array_push($target_by_date, 0.4);
                $start = date ("Y-m-d", strtotime("+1 day", strtotime($start)));
            }

            for ($i=0; $i < 12; $i++) { 
                array_push($target_by_month, 0.4);
            }
        ?>

        // VALIDASI FILTER

        <?php if($baby_filter == 'average') { ?>
            Highcharts.chart('average_daily_chart', {
                chart: {
                    type: 'column',
                    // backgroundColor: '#12213c',
                    // backgroundColor: '#0c1a32',
                    backgroundColor: 'transparent',
                    // type: '<?=$type_chart?>'
                },

                exporting: {
                    enabled: false
                },

                title: {
                    text: 'Daily Rejection <?=($child_filter == 0) ? 'All Line' : 'Line '.$child_filter?>',
                    align: 'center',
                    style: {
                        color: '#ffffff',
                        fontSize: '20px'
                    }
                },

                subtitle: {
                    text: 'Source: Laporan Harian Produksi',
                    align: 'center',
                    style: {
                        color: '#ffffff',
                        fontSize: '15px'
                    }
                },

                yAxis: [{
                    title: {
                        text: 'Pcs'
                    },
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    },
                    opposite: true
                },{
                    title: {
                        text: '%'
                    },
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    }
                }],

                xAxis: {
                    categories: <?php echo json_encode($dates); ?>,
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    }
                },

                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal',
                    itemStyle: {
                        color: '#ffffff'
                    }
                },

                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true,
                            formatter: function(){
                                return (this.y!=0)?this.y:"";
                            },
                            style: {
                                color: '#ffffff',
                                textOutline: 0,
                                fontSize: 14
                            },
                        },
                        events: {
                            click : function(e) {
                                var date = $('#bulan').val().slice(0, -3)+ '-' + e.point.category;
                                // var date = $('#bulan').val() + '-' + e.point.category;
                                var line = <?= $child_filter ?>;
                                $.ajax({
                                    url: '<?= base_url('dashboard/reject_qc/get_detail_rejection') ?>',
                                    type: 'POST',
                                    data: {
                                        date: date,
                                        line: line
                                    },
                                    dataType: 'JSON',
                                    success: function(data) {
                                        console.log(data);
                                        var data_jenis_reject = data['data_jenis_reject'];
                                        var i;
                                        var arr_jenis_reject = [];
                                        var arr_qty_jenis_reject = [];
                                        var arr_qty_jenis_reject_pcs = [];
                                        for (i = 0; i < data_jenis_reject.length; i++) {
                                            arr_jenis_reject.push(data_jenis_reject[i].jenis_reject);
                                            arr_qty_jenis_reject.push(parseFloat(((data_jenis_reject[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                            arr_qty_jenis_reject_pcs.push(parseInt(((data_jenis_reject[i].qty))));
                                        }
                                        console.log(arr_qty_jenis_reject);
                                        $('#detail_pareto_jenis_reject').html(`<figure class="highcharts-figure">
                                                                                                <div id="chart_pareto_jenis_reject"></div>
                                                                                            </figure>
                                                                                        `);
                                        Highcharts.chart('chart_pareto_jenis_reject', {
                                            chart: {
                                                    backgroundColor: 'transparent',
                                                    type: 'column'
                                                },
                                                exporting: {
                                                    enabled: false
                                                },
                                                title: {
                                                    text: `Detail Rejection (${date})`,
                                                    style: {
                                                        color: '#ffffff',
                                                        fontSize: '20px'
                                                    }
                                                },
                                                xAxis: {
                                                    categories: arr_jenis_reject,
                                                    crosshair: true,
                                                    labels: {
                                                        style: {
                                                            color: '#ffffff'
                                                        }
                                                    }
                                                },
                                                yAxis: [{
                                                    min: 0,
                                                    title: {
                                                        text: 'Pcs'
                                                    },
                                                    opposite: true,
                                                },{
                                                    min: 0,
                                                    title: {
                                                        text: '%'
                                                    }
                                                }],
                                                plotOptions: {
                                                    column: {
                                                        pointPadding: 0.2,
                                                        borderWidth: 0,
                                                        dataLabels: {
                                                            enabled: true,
                                                            style: {
                                                                color: '#ffffff',
                                                                textOutline: 0,
                                                                fontSize: 14
                                                            },
                                                        },
                                                        events: {
                                                            click: function(event) {
                                                                var jenis_reject = event.point.category;

                                                                $.ajax({
                                                                    url: "<?= base_url('dashboard/reject_qc/get_detail_rejection'); ?>",
                                                                    type: "POST",
                                                                    data: {
                                                                        date: date,
                                                                        line: line,
                                                                        jenis_reject: jenis_reject
                                                                    },
                                                                    dataType: "json",
                                                                    success: function(data) {
                                                                        console.log(data);
                                                                        var data_reject_by_jenis_reject = data['data_reject_by_jenis_reject'];
                                                                        var i;
                                                                        var arr_kategori_reject = [];
                                                                        var arr_qty_kategori_reject = [];
                                                                        var arr_qty_kategori_reject_pcs = [];
                                                                        for (i = 0; i < data_reject_by_jenis_reject.length; i++) {
                                                                            arr_kategori_reject.push(data_reject_by_jenis_reject[i].kategori_reject);
                                                                            arr_qty_kategori_reject.push(parseFloat(((data_reject_by_jenis_reject[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                            arr_qty_kategori_reject_pcs.push(parseFloat(((data_reject_by_jenis_reject[i].qty))));
                                                                            
                                                                        }
                                                                        $('#sub_detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_detail_pareto_ketegori_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_detail_pareto_ketegori_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail '+jenis_reject+' Rejection',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_kategori_reject,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: [{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    },
                                                                                    opposite: true
                                                                                },{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: '%'
                                                                                    }
                                                                                }],
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                            enabled: true,
                                                                                            style: {
                                                                                                color: '#ffffff',
                                                                                                textOutline: 0,
                                                                                                fontSize: 14
                                                                                            },
                                                                                        },
                                                                                        events: {
                                                                                            click: function(event) {
                                                                                                $('#sub_modal').modal('show');
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                tooltip: {
                                                                                    shared: true,
                                                                                },
                                                                                series: [{
                                                                                    name: 'Persentasi',
                                                                                    type: 'column',
                                                                                    data: arr_qty_kategori_reject,
                                                                                    color:'yellow',
                                                                                    yAxis: 1,
                                                                                },{
                                                                                    name: 'Pcs',
                                                                                    type: 'spline',
                                                                                    data: arr_qty_kategori_reject_pcs,
                                                                                    color:'red',
                                                                                }]
                                                                        });

                                                                        var data_reject_by_type_battery = data['data_reject_by_type_battery'];
                                                                        var i;
                                                                        var arr_type_battery = [];
                                                                        var arr_qty_type_battery = [];
                                                                        var arr_qty_type_battery_pcs = [];
                                                                        for (i = 0; i < data_reject_by_type_battery.length; i++) {
                                                                            arr_type_battery.push(data_reject_by_type_battery[i].type_battery);
                                                                            arr_qty_type_battery.push(parseFloat(((data_reject_by_type_battery[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                            arr_qty_type_battery_pcs.push(parseInt(((data_reject_by_type_battery[i].qty))));                                                                            
                                                                        }
                                                                        $('#sub_detail_pareto_type_battery').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_detail_pareto_battery_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_detail_pareto_battery_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail Type Battery Rejection',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_type_battery,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: [{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    },
                                                                                    opposite: true
                                                                                },{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: '%'
                                                                                    }
                                                                                }],
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    },
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                tooltip: {
                                                                                    shared: true,
                                                                                },
                                                                                series: [{
                                                                                    name: 'Persentasi',
                                                                                    type: 'column',
                                                                                    data: arr_qty_type_battery,
                                                                                    color:'yellow',
                                                                                    yAxis: 1,
                                                                                },{
                                                                                    name: 'Pcs',
                                                                                    type: 'spline',
                                                                                    data: arr_qty_type_battery_pcs,
                                                                                    color:'red',
                                                                                }]
                                                                        });

                                                                        var data_reject_by_grup = data['data_reject_by_grup'];
                                                                        var i;
                                                                        var arr_grup = [];
                                                                        var arr_qty_grup = [];
                                                                        var arr_qty_grup_pcs = [];
                                                                        for (i = 0; i < data_reject_by_grup.length; i++) {
                                                                            arr_grup.push(data_reject_by_grup[i].nama_pic+' ('+data_reject_by_grup[i].shift+')');
                                                                            arr_qty_grup.push(parseFloat(((data_reject_by_grup[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                            arr_qty_grup_pcs.push(parseInt(((data_reject_by_grup[i].qty))));
                                                                            
                                                                        }
                                                                        $('#sub_detail_pareto_grup_shift').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_detail_grup_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_detail_grup_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail Grup Rejection',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_grup,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: [{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    },
                                                                                    opposite: true
                                                                                },{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: '%'
                                                                                    }
                                                                                }],
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    },
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                tooltip: {
                                                                                    shared: true,
                                                                                },
                                                                                series: [{
                                                                                    name: 'Persentasi',
                                                                                    type: 'column',
                                                                                    data: arr_qty_grup,
                                                                                    color:'yellow',
                                                                                    yAxis: 1,
                                                                                },{
                                                                                    name: 'Pcs',
                                                                                    type: 'spline',
                                                                                    data: arr_qty_grup_pcs,
                                                                                    color:'red',
                                                                                }]
                                                                        });

                                                                        $('#sub_modal').modal('show');
                                                                    }
                                                                });
                                                            }
                                                        }
                                                    }
                                                },
                                                legend: {
                                                    enabled: false
                                                },
                                                tooltip: {
                                                    shared: true,
                                                },
                                                series: [{
                                                    name: 'Persentasi',
                                                    type: 'column',
                                                    data: arr_qty_jenis_reject,
                                                    color:'yellow',
                                                    yAxis: 1,
                                                },{
                                                    name: 'Pcs',
                                                    type: 'spline',
                                                    data: arr_qty_jenis_reject_pcs,
                                                    color:'red',
                                                }]
                                        });

                                        var data_kategori_reject = data['data_all_detail_kategori_rejection_by_date'];
                                        var i;
                                        var arr_kategori_reject = [];
                                        var arr_qty_kategori_reject = [];
                                        var arr_qty_kategori_reject_pcs = [];
                                        for (i = 0; i < data_kategori_reject.length; i++) {
                                            arr_kategori_reject.push(data_kategori_reject[i].kategori_reject);
                                            arr_qty_kategori_reject.push(parseFloat(((data_kategori_reject[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                            arr_qty_kategori_reject_pcs.push(parseInt(((data_kategori_reject[i].qty))));
                                        }
                                        $('#detail_pareto_kategori_reject').html(`<figure class="highcharts-figure">
                                                                                        <div id="chart_pareto_kategori_reject"></div>
                                                                                    </figure>
                                                                                `);
                                        Highcharts.chart('chart_pareto_kategori_reject', {
                                            chart: {
                                                    backgroundColor: 'transparent',
                                                    type: 'column'
                                                },
                                                exporting: {
                                                    enabled: false
                                                },
                                                title: {
                                                    text: `Detail Ketegori Rejection (${date})`,
                                                    style: {
                                                        color: '#ffffff',
                                                        fontSize: '20px'
                                                    }
                                                },
                                                xAxis: {
                                                    categories: arr_kategori_reject,
                                                    crosshair: true,
                                                    labels: {
                                                        style: {
                                                            color: '#ffffff'
                                                        }
                                                    }
                                                },
                                                yAxis: [{
                                                    min: 0,
                                                    title: {
                                                        text: 'Pcs'
                                                    },
                                                    opposite: true
                                                },{
                                                    min: 0,
                                                    title: {
                                                        text: '%'
                                                    }
                                                }],
                                                plotOptions: {
                                                    column: {
                                                        pointPadding: 0.2,
                                                        borderWidth: 0,
                                                        dataLabels: {
                                                            enabled: true,
                                                            style: {
                                                                color: '#ffffff',
                                                                textOutline: 0,
                                                                fontSize: 14
                                                            },
                                                        },
                                                    }
                                                },
                                                legend: {
                                                    enabled: false
                                                },
                                                tooltip: {
                                                    shared: true,
                                                },
                                                series: [{
                                                    name: 'Persentasi',
                                                    type: 'column',
                                                    data: arr_qty_kategori_reject,
                                                    color:'yellow',
                                                    yAxis: 1,

                                                },{
                                                    name: 'Pcs',
                                                    type: 'spline',
                                                    data: arr_qty_kategori_reject_pcs,
                                                    color:'red',
                                                }]
                                        });

                                        var data_battery_reject = data['data_all_detail_battery_rejection_by_date'];
                                        var i;
                                        var arr_battery_reject = [];
                                        var arr_qty_battery_reject = [];
                                        var arr_qty_battery_reject_pcs = [];
                                        for (i = 0; i < data_battery_reject.length; i++) {
                                            arr_battery_reject.push(data_battery_reject[i].type_battery);
                                            arr_qty_battery_reject.push(parseFloat(((data_battery_reject[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                            arr_qty_battery_reject_pcs.push(parseInt(((data_battery_reject[i].qty))));
                                            
                                        }
                                        $('#detail_pareto_type_battery').html(`<figure class="highcharts-figure">
                                                                                        <div id="chart_pareto_battery_reject"></div>
                                                                                    </figure>
                                                                                `);
                                        Highcharts.chart('chart_pareto_battery_reject', {
                                            chart: {
                                                    backgroundColor: 'transparent',
                                                    type: 'column'
                                                },
                                                exporting: {
                                                    enabled: false
                                                },
                                                title: {
                                                    text: `Detail Type Battery Rejection (${date})`,
                                                    style: {
                                                        color: '#ffffff',
                                                        fontSize: '20px'
                                                    }
                                                },
                                                xAxis: {
                                                    categories: arr_battery_reject,
                                                    crosshair: true,
                                                    labels: {
                                                        style: {
                                                            color: '#ffffff'
                                                        }
                                                    }
                                                },
                                                yAxis: [{
                                                    min: 0,
                                                    title: {
                                                        text: 'Pcs'
                                                    },
                                                    opposite: true
                                                },{
                                                    min: 0,
                                                    title: {
                                                        text: '%'
                                                    }
                                                }],
                                                plotOptions: {
                                                    column: {
                                                        pointPadding: 0.2,
                                                        borderWidth: 0,
                                                        dataLabels: {
                                                            enabled: true,
                                                            style: {
                                                                color: '#ffffff',
                                                                textOutline: 0,
                                                                fontSize: 14
                                                            },
                                                        },
                                                        events : {
                                                            click: function(event) {
                                                                var type_battery = event.point.category;

                                                                $.ajax({
                                                                    url: "<?= base_url('dashboard/reject_qc/get_detail_rejection'); ?>",
                                                                    type: "POST",
                                                                    data: {
                                                                        date: date,
                                                                        line: line,
                                                                        type_battery: type_battery
                                                                    },
                                                                    dataType: "json",
                                                                    success: function(data) {
                                                                        console.log(data);
                                                                        var data_jenis_reject_by_type_battery = data['data_jenis_reject_by_type_battery'];
                                                                        var i;
                                                                        var arr_jenis_reject_battery = [];
                                                                        var arr_qty_jenis_reject_battery = [];
                                                                        var arr_qty_jenis_reject_battery_pcs = [];
                                                                        for (i = 0; i < data_jenis_reject_by_type_battery.length; i++) {
                                                                            arr_jenis_reject_battery.push(data_jenis_reject_by_type_battery[i].jenis_reject);
                                                                            arr_qty_jenis_reject_battery.push(parseFloat(((data_jenis_reject_by_type_battery[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                            arr_qty_jenis_reject_battery_pcs.push(parseInt(((data_jenis_reject_by_type_battery[i].qty))));
                                                                        }

                                                                        $('#sub_detail_pareto_jenis_reject').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_detail_pareto_jenis_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_detail_pareto_jenis_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail Rejection',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_jenis_reject_battery,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: [{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    },
                                                                                    opposite: true
                                                                                },{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: '%'
                                                                                    }
                                                                                }],
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                            enabled: true,
                                                                                            style: {
                                                                                                color: '#ffffff',
                                                                                                textOutline: 0,
                                                                                                fontSize: 14
                                                                                            },
                                                                                        }
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                tooltip: {
                                                                                    shared: true,
                                                                                },
                                                                                series: [{
                                                                                    name: 'Persentasi',
                                                                                    type: 'column',
                                                                                    data: arr_qty_jenis_reject_battery,
                                                                                    color:'yellow',
                                                                                    yAxis: 1,

                                                                                },{
                                                                                    name: 'Pcs',
                                                                                    type: 'spline',
                                                                                    data: arr_qty_jenis_reject_battery_pcs,
                                                                                    color:'red',
                                                                                }]
                                                                        });

                                                                        var data_kategori_reject_by_type_battery = data['data_kategori_reject_by_type_battery'];
                                                                        var i;
                                                                        var arr_kategori_reject_battery = [];
                                                                        var arr_qty_kategori_reject_battery = [];
                                                                        var arr_qty_kategori_reject_battery_pcs = [];
                                                                        for (i = 0; i < data_kategori_reject_by_type_battery.length; i++) {
                                                                            arr_kategori_reject_battery.push(data_kategori_reject_by_type_battery[i].kategori_reject);
                                                                            arr_qty_kategori_reject_battery.push(parseFloat(((data_kategori_reject_by_type_battery[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                            arr_qty_kategori_reject_battery_pcs.push(parseInt(((data_kategori_reject_by_type_battery[i].qty))));
                                                                        }

                                                                        $('#sub_detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_detail_pareto_kategori_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_detail_pareto_kategori_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail Kategori Rejection',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_kategori_reject_battery,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: [{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    },
                                                                                    opposite: true
                                                                                },{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: '%'
                                                                                    }
                                                                                }],
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                            enabled: true,
                                                                                            style: {
                                                                                                color: '#ffffff',
                                                                                                textOutline: 0,
                                                                                                fontSize: 14
                                                                                            },
                                                                                        }
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                tooltip: {
                                                                                    shared: true,
                                                                                },
                                                                                series: [{
                                                                                    name: 'Persentasi',
                                                                                    type: 'column',
                                                                                    data: arr_qty_kategori_reject_battery,
                                                                                    color:'yellow',
                                                                                    yAxis: 1,
                                                                                },{
                                                                                    name: 'Pcs',
                                                                                    type: 'spline',
                                                                                    data: arr_qty_kategori_reject_battery_pcs,
                                                                                    color:'red',
                                                                                }]
                                                                        });

                                                                        

                                                                        $('#sub_detail_pareto_type_battery').html(``);

                                                                        var data_grup_reject_by_type_battery = data['data_grup_reject_by_type_battery'];
                                                                        var i;
                                                                        var arr_grup_reject_battery = [];
                                                                        var arr_qty_grup_reject_battery = [];
                                                                        var arr_qty_grup_reject_battery_pcs = [];
                                                                        for (i = 0; i < data_grup_reject_by_type_battery.length; i++) {
                                                                            arr_grup_reject_battery.push(data_grup_reject_by_type_battery[i].nama_pic+' ('+data_grup_reject_by_type_battery[i].shift+')');
                                                                            arr_qty_grup_reject_battery.push(parseFloat(((data_grup_reject_by_type_battery[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                            arr_qty_grup_reject_battery_pcs.push(parseInt(((data_grup_reject_by_type_battery[i].qty))));
                                                                        }

                                                                        $('#sub_detail_pareto_grup_shift').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_detail_pareto_grup_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_detail_pareto_grup_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail Grup Shift Rejection',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_grup_reject_battery,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: [{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    },
                                                                                    opposite: true
                                                                                },{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: '%'
                                                                                    }
                                                                                }],
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                            enabled: true,
                                                                                            style: {
                                                                                                color: '#ffffff',
                                                                                                textOutline: 0,
                                                                                                fontSize: 14
                                                                                            },
                                                                                        }
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                tooltip: {
                                                                                    shared: true,
                                                                                },
                                                                                series: [{
                                                                                    name: 'Persentasi',
                                                                                    type: 'column',
                                                                                    data: arr_qty_grup_reject_battery,
                                                                                    color:'yellow',
                                                                                    yAxis: 1,
                                                                                },{
                                                                                    name: 'Pcs',
                                                                                    type: 'spline',
                                                                                    data: arr_qty_grup_reject_battery_pcs,
                                                                                    color:'red',
                                                                                }]
                                                                        });

                                                                        
                                                                        $('#sub_modal').modal('show');
                                                                    }
                                                                })
                                                            }
                                                        }

                                                    }
                                                },
                                                legend: {
                                                    enabled: false
                                                },
                                                tooltip: {
                                                    shared: true,
                                                },
                                                series: [{
                                                    name: 'Persentasi',
                                                    type: 'column',
                                                    data: arr_qty_battery_reject,
                                                    color:'yellow',
                                                    yAxis: 1,
                                                },{
                                                    name: 'Pcs',
                                                    type: 'spline',
                                                    data: arr_qty_battery_reject_pcs,
                                                    color:'red',
                                                }]
                                        });

                                        var data_grup_reject = data['data_all_detail_grup_rejection_by_date'];
                                        var i;
                                        var arr_grup_reject = [];
                                        var arr_qty_grup_reject = [];
                                        var arr_qty_grup_reject_pcs = [];
                                        for (i = 0; i < data_grup_reject.length; i++) {
                                            arr_grup_reject.push(data_grup_reject[i].nama_pic+' ('+data_grup_reject[i].shift+')');
                                            arr_qty_grup_reject.push(parseFloat(((data_grup_reject[i].total_reject / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                            arr_qty_grup_reject_pcs.push(parseInt(((data_grup_reject[i].total_reject))));
                                            
                                        }
                                        $('#detail_pareto_grup_shift').html(`<figure class="highcharts-figure">
                                                                                        <div id="chart_pareto_grup_reject"></div>
                                                                                    </figure>
                                                                                `);
                                        Highcharts.chart('chart_pareto_grup_reject', {
                                            chart: {
                                                    backgroundColor: 'transparent',
                                                    type: 'column'
                                                },
                                                exporting: {
                                                    enabled: false
                                                },
                                                title: {
                                                    text: `Detail Grup Rejection (${date})`,
                                                    style: {
                                                        color: '#ffffff',
                                                        fontSize: '20px'
                                                    }
                                                },
                                                xAxis: {
                                                    categories: arr_grup_reject,
                                                    crosshair: true,
                                                    labels: {
                                                        style: {
                                                            color: '#ffffff'
                                                        }
                                                    }
                                                },
                                                yAxis: [{
                                                    min: 0,
                                                    title: {
                                                        text: 'Pcs'
                                                    },
                                                    opposite: true
                                                },{
                                                    min: 0,
                                                    title: {
                                                        text: '%'
                                                    }
                                                }],
                                                plotOptions: {
                                                    column: {
                                                        pointPadding: 0.2,
                                                        borderWidth: 0,
                                                        dataLabels: {
                                                            enabled: true,
                                                            style: {
                                                                color: '#ffffff',
                                                                textOutline: 0,
                                                                fontSize: 14
                                                            },
                                                        },
                                                        events : {
                                                            click: function(event) {
                                                                var group = event.point.category;
                                                                var regex = /^(.*?)\s*\((\d+)\)$/;
                                                                var matches = group.match(regex);

                                                                if (matches) {
                                                                    var name = matches[1].trim();
                                                                    var shift = matches[2];
                                                                } else {
                                                                    console.log('Invalid format');
                                                                }

                                                                $.ajax({
                                                                    url: "<?= base_url('dashboard/reject_qc/get_detail_rejection'); ?>",
                                                                    type: "POST",
                                                                    data: {
                                                                        date: date,
                                                                        line: line,
                                                                        grup: name,
                                                                        shift: shift
                                                                    },
                                                                    dataType: "json",
                                                                    success: function(data) {
                                                                        console.log(data);
                                                                        var data_detail_reject_by_grup = data['data_jenis_reject_by_grup_shift'];
                                                                        var i;
                                                                        var arr_jenis_reject = [];
                                                                        var arr_qty_jenis_reject = [];
                                                                        var arr_qty_jenis_reject_pcs = [];
                                                                        for (i = 0; i < data_detail_reject_by_grup.length; i++) {
                                                                            arr_jenis_reject.push(data_detail_reject_by_grup[i].jenis_reject);
                                                                            arr_qty_jenis_reject.push(parseFloat(((data_detail_reject_by_grup[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                            arr_qty_jenis_reject_pcs.push(parseInt(((data_detail_reject_by_grup[i].qty))));
                                                                            
                                                                        }

                                                                        $('#sub_detail_pareto_jenis_reject').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_detail_pareto_jenis_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_detail_pareto_jenis_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail Rejection',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_jenis_reject,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: [{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    },
                                                                                    opposite: true
                                                                                },{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: '%'
                                                                                    }
                                                                                }],
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                            enabled: true,
                                                                                            style: {
                                                                                                color: '#ffffff',
                                                                                                textOutline: 0,
                                                                                                fontSize: 14
                                                                                            },
                                                                                        },
                                                                                        events: {
                                                                                            click: function(event) {
                                                                                                $('#sub_modal').modal('show');
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                tooltip: {
                                                                                    shared: true,
                                                                                },
                                                                                series: [{
                                                                                    name: 'Persentasi',
                                                                                    type: 'column',
                                                                                    data: arr_qty_jenis_reject,
                                                                                    color:'yellow',
                                                                                    yAxis: 1,
                                                                                },{
                                                                                    name: 'Pcs',
                                                                                    type: 'spline',
                                                                                    data: arr_qty_jenis_reject_pcs,
                                                                                    color:'red',
                                                                                }]
                                                                        });

                                                                        var data_kategori_reject_by_grup = data['data_kategori_reject_by_grup_shift'];
                                                                        var i;
                                                                        var arr_kategori_reject = [];
                                                                        var arr_qty_kategori_reject = [];
                                                                        var arr_qty_kategori_reject_pcs = [];
                                                                        for (i = 0; i < data_kategori_reject_by_grup.length; i++) {
                                                                            arr_kategori_reject.push(data_kategori_reject_by_grup[i].kategori_reject);
                                                                            arr_qty_kategori_reject.push(parseFloat(((data_kategori_reject_by_grup[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                            arr_qty_kategori_reject_pcs.push(parseInt(((data_kategori_reject_by_grup[i].qty))));
                                                                        }

                                                                        $('#sub_detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_detail_pareto_kategori_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_detail_pareto_kategori_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail Kategori Rejection',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_kategori_reject,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: [{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    },
                                                                                    opposite: true
                                                                                },{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: '%'
                                                                                    }
                                                                                }],
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                            enabled: true,
                                                                                            style: {
                                                                                                color: '#ffffff',
                                                                                                textOutline: 0,
                                                                                                fontSize: 14
                                                                                            },
                                                                                        },
                                                                                        events: {
                                                                                            click: function(event) {
                                                                                                $('#sub_modal').modal('show');
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                tooltip: {
                                                                                    shared: true,
                                                                                },
                                                                                series: [{
                                                                                    name: 'Persentasi',
                                                                                    type: 'column',
                                                                                    data: arr_qty_kategori_reject,
                                                                                    color:'yellow',
                                                                                    yAxis: 1,
                                                                                },{
                                                                                    name: 'Pcs',
                                                                                    type: 'spline',
                                                                                    data: arr_qty_kategori_reject_pcs,
                                                                                    color:'red',
                                                                                }]
                                                                        });

                                                                        var data_battery_reject_by_grup = data['data_battery_reject_by_grup_shift'];
                                                                        var i;
                                                                        var arr_battery_reject = [];
                                                                        var arr_qty_battery_reject = [];
                                                                        var arr_qty_battery_reject_pcs = [];
                                                                        for (i = 0; i < data_battery_reject_by_grup.length; i++) {
                                                                            arr_battery_reject.push(data_battery_reject_by_grup[i].type_battery);
                                                                            arr_qty_battery_reject.push(parseFloat(((data_battery_reject_by_grup[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                            arr_qty_battery_reject_pcs.push(parseInt(((data_battery_reject_by_grup[i].qty))));
                                                                            
                                                                        }

                                                                        $('#sub_detail_pareto_type_battery').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_detail_pareto_battery_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_detail_pareto_battery_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail Type Battery',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_battery_reject,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: [{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    },
                                                                                    opposite: true
                                                                                },{
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: '%'
                                                                                    }
                                                                                }],
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                            enabled: true,
                                                                                            style: {
                                                                                                color: '#ffffff',
                                                                                                textOutline: 0,
                                                                                                fontSize: 14
                                                                                            },
                                                                                        },
                                                                                        events: {
                                                                                            click: function(event) {
                                                                                                $('#sub_modal').modal('show');
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                tooltip: {
                                                                                    shared: true,
                                                                                },
                                                                                series: [{
                                                                                    name: 'Persentasi',
                                                                                    type: 'column',
                                                                                    data: arr_qty_battery_reject,
                                                                                    color:'yellow',
                                                                                    yAxis: 1,
                                                                                },{
                                                                                    name: 'Pcs',
                                                                                    type: 'spline',
                                                                                    data: arr_qty_battery_reject_pcs,
                                                                                    color:'red',
                                                                                }]
                                                                        });

                                                                        $('#sub_detail_pareto_grup_shift').html(``);

                                                                        $('#sub_modal').modal('show');
                                                                    }
                                                                })
                                                            }
                                                        }
                                                    }
                                                },
                                                legend: {
                                                    enabled: false
                                                },
                                                tooltip: {
                                                    shared: true,
                                                },
                                                series: [{
                                                    name: 'Persentasi',
                                                    type: 'column',
                                                    data: arr_qty_grup_reject,
                                                    color:'yellow',
                                                    yAxis: 1,
                                                },{
                                                    name: 'Pcs',
                                                    type: 'spline',
                                                    data: arr_qty_grup_reject_pcs,
                                                    color:'red',
                                                }]
                                        });

                                        $('#main_modal').modal('show');
                                    }
                                })
                            }
                        }
                    }
                },
                colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
                tooltip: {
                    shared: true,
                },
                
                series: [{
                    // name: '<?=($child_filter == 0) ? 'All Line':'Line '.$child_filter?>',
                    name: 'Persentasi',
                    type: 'column',
                    data: <?= json_encode($data_average_reject_by_date_all_line); ?>,
                    yAxis: 1,
                },
                {
                    name: 'Pcs',
                    type: 'spline',
                    data: <?= json_encode($data_average_reject_by_date_all_line_pcs); ?>,
                    color: 'green'
                },
                {
                type: 'spline',
                name: 'Target',
                data: <?=json_encode($target_by_date)?>,
                color:'red',
                yAxis: 1,
            }
                ],

                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });

            Highcharts.chart('average_month_chart', {
                chart: {
                    backgroundColor: 'transparent',
                    // type: '<?=$type_chart?>'
                    type: 'column',
                    // backgroundColor: '#0c1a32',
                    
                },
                exporting: {
                    enabled: false
                },
                title: {
                    text: 'Monthly Rejection',
                    style: {
                        color: '#ffffff',
                        fontSize: '20px'
                    }
                },
                xAxis: {
                    categories: [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr',
                        'May',
                        'Jun',
                        'Jul',
                        'Aug',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec'
                    ],
                    crosshair: true,
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    }
                },
                yAxis: [
                //     {
                //     min: 0,
                //     title: {
                //         text: 'Pcs'
                //     },
                //     opposite: true
                // },
                {
                    min: 0,
                    title: {
                        text: '%'
                    }
                }],
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            formatter: function(){
                                return (this.y!=0)?this.y:"";
                            },
                            style: {
                                color: '#ffffff',
                                textOutline: 0,
                                fontSize: 14
                            },
                        },
                        events: {
                            click: function(e) {
                                var date = '01-'+e.point.category+'-<?=date('Y')?>';
                                var line = <?=$child_filter?>;
                                // alert(date);
                                $.ajax({
                                    url: "<?= base_url('dashboard/reject_qc/get_detail_rejection') ?>",
                                    type: "post",
                                    data: {
                                        date: date,
                                        line: line
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        console.log(data);
                                        var data_jenis_reject = data['data_jenis_reject_by_month'];
                                        var i;
                                        var arr_jenis_reject = [];
                                        var arr_qty_jenis_reject = [];
                                        for (i = 0; i < data_jenis_reject.length; i++) {
                                            arr_jenis_reject.push(data_jenis_reject[i].jenis_reject);
                                            arr_qty_jenis_reject.push(data_jenis_reject[i].qty);
                                        }
                                        $('#detail_pareto_jenis_reject').html(`<figure class="highcharts-figure">
                                                                                                <div id="chart_pareto_jenis_reject"></div>
                                                                                            </figure>
                                                                                        `);
                                        Highcharts.chart('chart_pareto_jenis_reject', {
                                            chart: {
                                                    backgroundColor: 'transparent',
                                                    type: 'column'
                                                },
                                                exporting: {
                                                    enabled: false
                                                },
                                                title: {
                                                    text: 'Detail Jenis Rejection',
                                                    style: {
                                                        color: '#ffffff',
                                                        fontSize: '20px'
                                                    }
                                                },
                                                xAxis: {
                                                    categories: arr_jenis_reject,
                                                    crosshair: true,
                                                    labels: {
                                                        style: {
                                                            color: '#ffffff'
                                                        }
                                                    }
                                                },
                                                yAxis: {
                                                    min: 0,
                                                    title: {
                                                        text: 'Pcs'
                                                    }
                                                },
                                                plotOptions: {
                                                    column: {
                                                        pointPadding: 0.2,
                                                        borderWidth: 0,
                                                        dataLabels: {
                                                            enabled: true,
                                                            style: {
                                                                color: '#ffffff',
                                                                textOutline: 0,
                                                                fontSize: 14
                                                            },
                                                        },
                                                        events: {
                                                            click: function(event) {
                                                                var jenis_reject = event.point.category;
                                                                $.ajax({
                                                                    url: "<?= base_url('dashboard/reject_qc/get_detail_rejection'); ?>",
                                                                    type: "POST",
                                                                    data: {
                                                                        date: date,
                                                                        line: line,
                                                                        jenis_reject: jenis_reject
                                                                    },
                                                                    dataType: "json",
                                                                    success: function(data) {
                                                                        console.log(data);
                                                                        var data_reject_by_jenis_reject = data['data_reject_by_jenis_reject_by_month'];
                                                                        var i;
                                                                        var arr_kategori_reject = [];
                                                                        var arr_qty_kategori_reject = [];
                                                                        for (i = 0; i < data_reject_by_jenis_reject.length; i++) {
                                                                            arr_kategori_reject.push(data_reject_by_jenis_reject[i].kategori_reject);
                                                                            arr_qty_kategori_reject.push(data_reject_by_jenis_reject[i].qty);
                                                                        }
                                                                        $('#sub_detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_pareto_ketegori_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_pareto_ketegori_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail '+jenis_reject+' Rejection',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_kategori_reject,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: {
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    }
                                                                                },
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                            enabled: true,
                                                                                            style: {
                                                                                                color: '#ffffff',
                                                                                                textOutline: 0,
                                                                                                fontSize: 14
                                                                                            },
                                                                                        },
                                                                                        events: {
                                                                                            click: function(event) {
                                                                                                $('#sub_modal').modal('show');
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                series: [{
                                                                                    name: 'Total',
                                                                                    data: arr_qty_kategori_reject,
                                                                                    color:'yellow',

                                                                                }]
                                                                        });

                                                                        var data_reject_by_type_battery = data['data_reject_by_type_battery_by_month'];
                                                                        var i;
                                                                        var arr_type_battery = [];
                                                                        var arr_qty_type_battery = [];
                                                                        for (i = 0; i < data_reject_by_type_battery.length; i++) {
                                                                            arr_type_battery.push(data_reject_by_type_battery[i].type_battery);
                                                                            arr_qty_type_battery.push(data_reject_by_type_battery[i].qty);
                                                                        }
                                                                        $('#sub_detail_pareto_type_battery').html(`  <figure class="highcharts-figure">
                                                                                                                        <div id="chart_pareto_battery_reject"></div>
                                                                                                                    </figure>`
                                                                                                                );
                                                                        Highcharts.chart('chart_pareto_battery_reject', {
                                                                            chart: {
                                                                                    backgroundColor: 'transparent',
                                                                                    type: 'column'
                                                                                },
                                                                                exporting: {
                                                                                    enabled: false
                                                                                },
                                                                                title: {
                                                                                    text: 'Detail Type Battery Rejection',
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        fontSize: '20px'
                                                                                    }
                                                                                },
                                                                                xAxis: {
                                                                                    categories: arr_type_battery,
                                                                                    crosshair: true,
                                                                                    labels: {
                                                                                        style: {
                                                                                            color: '#ffffff'
                                                                                        }
                                                                                    }
                                                                                },
                                                                                yAxis: {
                                                                                    min: 0,
                                                                                    title: {
                                                                                        text: 'Pcs'
                                                                                    }
                                                                                },
                                                                                plotOptions: {
                                                                                    column: {
                                                                                        pointPadding: 0.2,
                                                                                        borderWidth: 0,
                                                                                        dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    },
                                                                                    }
                                                                                },
                                                                                legend: {
                                                                                    enabled: false
                                                                                },
                                                                                series: [{
                                                                                    name: 'Total',
                                                                                    data: arr_qty_type_battery,
                                                                                    color:'yellow',

                                                                                }]
                                                                        });
                                                                        $('#sub_modal').modal('show');
                                                                    }
                                                                });
                                                            }
                                                        }
                                                    }
                                                },
                                                legend: {
                                                    enabled: false
                                                },
                                                series: [{
                                                    name: 'Total',
                                                    data: arr_qty_jenis_reject,
                                                    color:'yellow',

                                                }]
                                        });
                                        $('#detail_pareto_kategori_reject').html(``);
                                        $('#detail_pareto_type_battery').html(``);
                                        $('#detail_pareto_grup_shift').html(``);
                                        $('#main_modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                },
                legend: {
                    <?php if (($parent_filter == 'line' OR $parent_filter == null) AND ($child_filter == null OR $child_filter == 0) AND $baby_filter == 'line') { ?>
                        align: 'center',
                        verticalAlign: 'bottom',
                        layout: 'horizontal',
                        itemStyle: {
                            color: '#ffffff'
                        }
                    <?php } else { ?>
                        enabled: false
                    <?php } ?>
                    },
                colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],

                series: [{
                    // name: '<?=($child_filter == 0) ? 'All Line':'Line '.$child_filter?>',
                    name: 'Persentasi',
                    type: 'column',                    
                    data: <?= json_encode($data_average_reject_by_month); ?>,
                    color:'yellow',
                    // yAxis: 1,
                },
                // {
                //     name: 'Pcs',
                //     type: 'spline',
                //     data: <?= json_encode($data_average_reject_by_month_pcs); ?>,
                //     color:'green',
                // },
                {
                type: 'spline',
                name: 'Target',
                data: <?=json_encode($target_by_month)?>,
                color:'red',
                // yAxis: 1,
            }
                ],
            });
        <?php } elseif ($baby_filter == 'line') { ?>
            Highcharts.chart('average_daily_chart_by_line', {
                chart: {
                    // type: 'column',
                    // backgroundColor: '#12213c',
                    // backgroundColor: '#0c1a32',
                    backgroundColor: 'transparent',
                    type: 'line'
                },
        
                exporting: {
                    enabled: false
                },
        
                title: {
                    text: 'Daily Rejection <?=($child_filter == 0) ? 'All Line' : 'Line '.$child_filter?>',
                    align: 'center',
                    style: {
                        color: '#ffffff',
                        fontSize: '20px'
                    }
                },
        
                subtitle: {
                    text: 'Source: Laporan Harian Produksi',
                    align: 'center',
                    style: {
                        color: '#ffffff',
                        fontSize: '15px'
                    }
                },
        
                yAxis: {
                    title: {
                        text: '%'
                    },
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    }
                },
        
                xAxis: {
                    categories: <?php echo json_encode($dates); ?>,
                    labels: {
                        style: {
                            color: '#ffffff'
                        },
                    }
                },
        
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal',
                    itemStyle: {
                        color: '#ffffff'
                    }
                },
        
                plotOptions: {
                    column: {
                        dataLabels: {
                            enabled: true,
                            formatter: function(){
                                return (this.y!=0)?this.y:"";
                            },
                            style: {
                                color: '#ffffff',
                                textOutline: 0,
                                fontSize: 14
                            },
                        },
                        // pointWidth: 30,
                    }
                },
                colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
                
                series: [
                    {
                            name: 'Line 1',
                            data: <?php echo json_encode($data_reject_line_1); ?>
                        },
                        {
                            name: 'Line 2',
                            data: <?php echo json_encode($data_reject_line_2); ?>
                        },
                        {
                            name: 'Line 3',
                            data: <?php echo json_encode($data_reject_line_3); ?>
                        },
                        {
                            name: 'Line 4',
                            data: <?php echo json_encode($data_reject_line_4); ?>
                        },
                        {
                            name: 'Line 5',
                            data: <?php echo json_encode($data_reject_line_5); ?>
                        },
                        {
                            name: 'Line 6',
                            data: <?php echo json_encode($data_reject_line_6); ?>
                        },
                        {
                            name: 'Line 7',
                            data: <?php echo json_encode($data_reject_line_7); ?>
                        }
                ],
        
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
        
            Highcharts.chart('average_month_chart_by_line', {
                chart: {
                    backgroundColor: 'transparent',
                    type: 'line'
                    // type: 'column',
                    // backgroundColor: '#0c1a32',
                    
                },
                exporting: {
                    enabled: false
                },
                title: {
                    text: 'Monthly Rejection',
                    style: {
                        color: '#ffffff',
                        fontSize: '20px'
                    }
                },
                xAxis: {
                    categories: [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr',
                        'May',
                        'Jun',
                        'Jul',
                        'Aug',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec'
                    ],
                    crosshair: true,
                    labels: {
                        style: {
                            color: '#ffffff'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '%'
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            formatter: function(){
                                return (this.y!=0)?this.y:"";
                            },
                            style: {
                                color: '#ffffff',
                                textOutline: 0,
                                fontSize: 14
                            },
                        },
                        // pointWidth: 30,
                    }
                },
                legend: {
                        align: 'center',
                        verticalAlign: 'bottom',
                        layout: 'horizontal',
                        itemStyle: {
                            color: '#ffffff'
                        }
                    },
                colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
        
                series: [
                    {
                        name: 'Line 1',
                        data: <?php echo json_encode($data_reject_by_month_line_1); ?>,
                    },
                    {
                        name: 'Line 2',
                        data: <?php echo json_encode($data_reject_by_month_line_2); ?>,
                    },
                    {
                        name: 'Line 3',
                        data: <?php echo json_encode($data_reject_by_month_line_3); ?>,
                    },
                    {
                        name: 'Line 4',
                        data: <?php echo json_encode($data_reject_by_month_line_4); ?>,
                    },
                    {
                        name: 'Line 5',
                        data: <?php echo json_encode($data_reject_by_month_line_5); ?>,
                    },
                    {
                        name: 'Line 6',
                        data: <?php echo json_encode($data_reject_by_month_line_6); ?>,
                    },
                    {
                        name: 'Line 7',
                        data: <?php echo json_encode($data_reject_by_month_line_7); ?>,
                    }
                ]
            });
        <?php    }   ?>

        Highcharts.chart('side_chart', {
            chart: {
                type: 'column',
                // backgroundColor: '#0c1a32',
                backgroundColor: 'transparent',
                
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Monthly Rejection (Unit)',
                style: {
                    color: '#ffffff',
                    fontSize: '20px'
                }
            },
            xAxis: {
                // categories: <?php echo json_encode($data_jenis_reject_by_month); ?>,
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true,
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Unit'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        formatter: function(){
                            return (this.y!=0)?this.y:"";
                        },
                        style: {
                            color: '#ffffff',
                            textOutline: 0,
                            fontSize: 14
                        },
                    },
                    // pointWidth: 30,
                }
            },
            legend: {
                    enabled: false
                },

            series: [{
                // name: 'All Line',
                // data: <?php echo json_encode($data_total_reject_by_month); ?>,
                data: <?php echo json_encode($data_qty_reject_by_month  ); ?>,
                color:'yellow',

            }]
        });

        Highcharts.chart('main_chart', {
            chart: {
                type: 'column',
                // backgroundColor: '#0c1a32',
                backgroundColor: 'transparent',
            },
            exporting: {
                enabled: false
            },

            title: {
                text: 'Daily Rejection <?=($child_filter == 0) ? 'All Line' : 'Line '.$child_filter?>',
                align: 'center',
                style: {
                    color: '#ffffff',
                    fontSize: '20px',
                    fontWeight: 'bold'
                }
            },

            subtitle: {
                text: 'Source: Laporan Harian Produksi',
                align: 'center',
                style: {
                    color: '#ffffff',
                    fontSize: '15px'
                }
            },

            xAxis: {
                categories: <?= json_encode($dates); ?>,
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Unit'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    },
                    formatter: function(){
                        return (this.y!=0)?this.y:"";
                    }
                },
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                }
            },
            legend: {
                align: 'center',
                verticalAlign: 'bottom',
                layout: 'horizontal',
                itemStyle: {
                    color: '#ffffff'
                }
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        formatter: function(){
                            return (this.y!=0)?this.y:"";
                        }
                    },
                    // events: {
                    //     click: function(event) {
                    //         var date = $('#bulan').val()+'-'+event.point.category;
                    //         var line = <?=$child_filter?>;
                    //         var jenis_reject = this.name;

                    //         $.ajax({
                    //             url: "<?= base_url('dashboard/reject/get_detail_rejection'); ?>",
                    //             type: "POST",
                    //             data: {
                    //                 date: date,
                    //                 line: line,
                    //                 jenis_reject: jenis_reject
                    //             },
                    //             dataType: "json",
                    //             success: function(data) {
                    //                 console.log(data);
                    //                 var data_reject_by_jenis_reject = data['data_reject_by_jenis_reject'];
                    //                 var i;
                    //                 var arr_kategori_reject = [];
                    //                 var arr_qty_kategori_reject = [];
                    //                 for (i = 0; i < data_reject_by_jenis_reject.length; i++) {
                    //                     arr_kategori_reject.push(data_reject_by_jenis_reject[i].kategori_reject);
                    //                     arr_qty_kategori_reject.push(data_reject_by_jenis_reject[i].qty);
                    //                 }
                    //                 $('#detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                    //                                                                 <div id="chart_pareto_ketegori_reject"></div>
                    //                                                             </figure>`
                    //                                                         );
                    //                 Highcharts.chart('chart_pareto_ketegori_reject', {
                    //                     chart: {
                    //                             backgroundColor: 'transparent',
                    //                             type: 'column'
                    //                         },
                    //                         exporting: {
                    //                             enabled: false
                    //                         },
                    //                         title: {
                    //                             text: 'Detail '+jenis_reject+' Rejection',
                    //                             style: {
                    //                                 color: '#ffffff',
                    //                                 fontSize: '20px'
                    //                             }
                    //                         },
                    //                         xAxis: {
                    //                             categories: arr_kategori_reject,
                    //                             crosshair: true,
                    //                             labels: {
                    //                                 style: {
                    //                                     color: '#ffffff'
                    //                                 }
                    //                             }
                    //                         },
                    //                         yAxis: {
                    //                             min: 0,
                    //                             title: {
                    //                                 text: 'Pcs'
                    //                             }
                    //                         },
                    //                         plotOptions: {
                    //                             column: {
                    //                                 pointPadding: 0.2,
                    //                                 borderWidth: 0,
                    //                                 dataLabels: {
                    //                                     enabled: true,
                    //                                     style: {
                    //                                         color: '#ffffff',
                    //                                         textOutline: 0,
                    //                                         fontSize: 14
                    //                                     },
                    //                                 },
                    //                                 events: {
                    //                                     click: function(event) {
                    //                                         $('#sub_modal').modal('show');
                    //                                     }
                    //                                 }
                    //                             }
                    //                         },
                    //                         legend: {
                    //                             enabled: false
                    //                         },
                    //                         series: [{
                    //                             name: 'Total',
                    //                             data: arr_qty_kategori_reject,
                    //                             color:'yellow',

                    //                         }]
                    //                 });

                    //                 var data_reject_by_type_battery = data['data_reject_by_type_battery'];
                    //                 var i;
                    //                 var arr_type_battery = [];
                    //                 var arr_qty_type_battery = [];
                    //                 for (i = 0; i < data_reject_by_type_battery.length; i++) {
                    //                     arr_type_battery.push(data_reject_by_type_battery[i].type_battery);
                    //                     arr_qty_type_battery.push(data_reject_by_type_battery[i].qty);
                    //                 }
                    //                 $('#detail_pareto_type_battery').html(`  <figure class="highcharts-figure">
                    //                                                                 <div id="chart_pareto_battery_reject"></div>
                    //                                                             </figure>`
                    //                                                         );
                    //                 Highcharts.chart('chart_pareto_battery_reject', {
                    //                     chart: {
                    //                             backgroundColor: 'transparent',
                    //                             type: 'column'
                    //                         },
                    //                         exporting: {
                    //                             enabled: false
                    //                         },
                    //                         title: {
                    //                             text: 'Detail Type Battery Rejection',
                    //                             style: {
                    //                                 color: '#ffffff',
                    //                                 fontSize: '20px'
                    //                             }
                    //                         },
                    //                         xAxis: {
                    //                             categories: arr_type_battery,
                    //                             crosshair: true,
                    //                             labels: {
                    //                                 style: {
                    //                                     color: '#ffffff'
                    //                                 }
                    //                             }
                    //                         },
                    //                         yAxis: {
                    //                             min: 0,
                    //                             title: {
                    //                                 text: 'Pcs'
                    //                             }
                    //                         },
                    //                         plotOptions: {
                    //                             column: {
                    //                                 pointPadding: 0.2,
                    //                                 borderWidth: 0,
                    //                                 dataLabels: {
                    //                                 enabled: true,
                    //                                 style: {
                    //                                     color: '#ffffff',
                    //                                     textOutline: 0,
                    //                                     fontSize: 14
                    //                                 },
                    //                             },
                    //                             }
                    //                         },
                    //                         legend: {
                    //                             enabled: false
                    //                         },
                    //                         series: [{
                    //                             name: 'Total',
                    //                             data: arr_qty_type_battery,
                    //                             color:'yellow',

                    //                         }]
                    //                 });
                    //                 $('#main_modal').modal('show');
                    //             }
                    //         });
                    //     }
                    // }
                }
            },
            colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
            series: <?php echo json_encode($result); ?>,
        });

        Highcharts.chart('daily_rejection_persentase_chart', {
            chart: {
                type: 'column',
                backgroundColor: 'transparent',
            },
            exporting: {
                enabled: false
            },

            title: {
                text: 'Daily Rejection <?=($child_filter == 0) ? 'All Line' : 'Line '.$child_filter?>',
                align: 'center',
                style: {
                    color: '#ffffff',
                    fontSize: '20px',
                }
            },

            subtitle: {
                text: 'Source: Laporan Harian Produksi',
                align: 'center',
                style: {
                    color: '#ffffff',
                    fontSize: '15px'
                }
            },

            xAxis: {
                categories: <?= json_encode($dates); ?>,
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Unit'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    },
                    formatter: function(){
                        return (this.y!=0)?this.y:"";
                    }
                },
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                }
            },
            legend: {
                align: 'center',
                verticalAlign: 'bottom',
                layout: 'horizontal',
                itemStyle: {
                    color: '#ffffff'
                }
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        formatter: function(){
                            return (this.y!=0)?this.y:"";
                        }
                    },
                    events: {
                        click: function(event) {
                            var date = $('#bulan').val()+'-'+event.point.category;
                            var line = <?=$child_filter?>;
                            var jenis_reject = this.name;

                            $.ajax({
                                url: "<?= base_url('dashboard/reject_qc/get_detail_rejection'); ?>",
                                type: "POST",
                                data: {
                                    date: date,
                                    line: line,
                                    jenis_reject: jenis_reject
                                },
                                dataType: "json",
                                success: function(data) {
                                    console.log(data);
                                    var data_reject_by_jenis_reject = data['data_reject_by_jenis_reject'];
                                    var i;
                                    var arr_kategori_reject = [];
                                    var arr_qty_kategori_reject = [];
                                    for (i = 0; i < data_reject_by_jenis_reject.length; i++) {
                                        arr_kategori_reject.push(data_reject_by_jenis_reject[i].kategori_reject);
                                        arr_qty_kategori_reject.push(data_reject_by_jenis_reject[i].qty);
                                    }
                                    $('#detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                                                                                    <div id="chart_pareto_ketegori_reject"></div>
                                                                                </figure>`
                                                                            );
                                    Highcharts.chart('chart_pareto_ketegori_reject', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: 'Detail '+jenis_reject+' Rejection',
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_kategori_reject,
                                                crosshair: true,
                                                labels: {
                                                    style: {
                                                        color: '#ffffff'
                                                    }
                                                }
                                            },
                                            yAxis: {
                                                min: 0,
                                                title: {
                                                    text: 'Pcs'
                                                }
                                            },
                                            plotOptions: {
                                                column: {
                                                    pointPadding: 0.2,
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                    enabled: true,
                                                    style: {
                                                        color: '#ffffff',
                                                        textOutline: 0,
                                                        fontSize: 14
                                                    },
                                                },
                                                }
                                            },
                                            legend: {
                                                enabled: false
                                            },
                                            series: [{
                                                name: 'Total',
                                                data: arr_qty_kategori_reject,
                                                color:'yellow',

                                            }]
                                    });

                                    var data_reject_by_type_battery = data['data_reject_by_type_battery'];
                                    var i;
                                    var arr_type_battery = [];
                                    var arr_qty_type_battery = [];
                                    for (i = 0; i < data_reject_by_type_battery.length; i++) {
                                        arr_type_battery.push(data_reject_by_type_battery[i].type_battery);
                                        arr_qty_type_battery.push(data_reject_by_type_battery[i].qty);
                                    }
                                    $('#detail_pareto_type_battery').html(`  <figure class="highcharts-figure">
                                                                                    <div id="chart_pareto_battery_reject"></div>
                                                                                </figure>`
                                                                            );
                                    Highcharts.chart('chart_pareto_battery_reject', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: 'Detail Type Battery Rejection',
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_type_battery,
                                                crosshair: true,
                                                labels: {
                                                    style: {
                                                        color: '#ffffff'
                                                    }
                                                }
                                            },
                                            yAxis: {
                                                min: 0,
                                                title: {
                                                    text: 'Pcs'
                                                }
                                            },
                                            plotOptions: {
                                                column: {
                                                    pointPadding: 0.2,
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                    enabled: true,
                                                    style: {
                                                        color: '#ffffff',
                                                        textOutline: 0,
                                                        fontSize: 14
                                                    },
                                                },
                                                }
                                            },
                                            legend: {
                                                enabled: false
                                            },
                                            series: [{
                                                name: 'Total',
                                                data: arr_qty_type_battery,
                                                color:'yellow',

                                            }]
                                    });
                                    $('#main_modal').modal('show');
                                }
                            });
                        }
                    }
                }
            },
            colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
            series: <?php echo json_encode($result_daily_reject_persentase); ?>,
        });

        Highcharts.chart('monthly_rejection_persentase_chart', {
            chart: {
                type: 'column',
                // backgroundColor: '#0c1a32',
                backgroundColor: 'transparent',
                
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Monthly Jenis Rejection (%)',
                style: {
                    color: '#ffffff',
                    fontSize: '20px'
                }
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true,
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Unit'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        formatter: function(){
                            return (this.y!=0)?this.y:"";
                        },
                        style: {
                            color: '#ffffff',
                            textOutline: 0,
                            fontSize: 14
                        },
                    },
                }
            },
            legend: {
                    enabled: false
                },

            series: [{
                // name: 'All Line',
                data: <?php echo json_encode($data_qty_reject_by_month); ?>,
                color:'yellow',

            }]
        });
    </script>
</body>
</html>