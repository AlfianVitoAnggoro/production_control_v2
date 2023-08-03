<?php
// Array dengan nama hari dalam bahasa Indonesia
$namaHariIndonesia = array(
	'Sunday'    => 'Minggu',
	'Monday'    => 'Senin',
	'Tuesday'   => 'Selasa',
	'Wednesday' => 'Rabu',
	'Thursday'  => 'Kamis',
	'Friday'    => 'Jumat',
	'Saturday'  => 'Sabtu'
);
?>
<header style="background-color: transparent">
	<!-- <header class="main-header" style="background-color: transparent"> -->
	<!-- &nbsp; -->
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top d-flex justify-content-between align-items-center p-0" style="height: 10vh;">
		<!-- Sidebar toggle button-->
		<!-- <div class="app-menu">
			<ul class="header-megamenu nav">
				<li class="btn-group nav-item d-md-none">
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
			</li>
			</ul>
		</div> -->
		<!-- <div style="margin-left:-250px; text-align:center; margin-top:-25px;"> -->
		<div style="width: 70%;">
			<h1 class="judul_dashboard text-center m-0" style="color: white">
				<?php if (strtoupper($sub_bagian) === 'AMB-1' || strtoupper($sub_bagian) === 'AMB-2') { ?>
					MAN POWER HENKATEN BOARD ASSY <?= strtoupper($sub_bagian) ?>
				<?php } else if (strtoupper($sub_bagian) === 'WET') { ?>
					MAN POWER HENKATEN BOARD <?= strtoupper($sub_bagian) ?> BATTERY
				<?php } else if (strtoupper($sub_bagian) === 'MCB') { ?>
					MAN POWER HENKATEN BOARD <?= strtoupper($sub_bagian) ?>
				<?php } ?>
			</h1>
		</div>
		<div style="width: 30%; color: white; padding-right: 20px" class="justify-content-end align-items-center d-flex">
			<a href="<?= base_url() ?>dashboard_man_power/<?= $sub_bagian ?>/<?= $date ?>/<?= $shift ?>/reset" class="btn btn-danger me-2" style="font-size: 30px">Reset</a>
			<h1 class="text-center m-0 pe-2 fw-bold" style="font-size: 30px"><?= strtoupper($namaHariIndonesia[date('l', strtotime($date))]) ?></h1>
			<input type="date" name="date" id="date" class="form-control" value="<?= $date ?>" style="width: 250px; margin-right: 10px; font-size: 24px" onchange="changeShift('<?= $sub_bagian ?>')">
			<h1 class="text-center m-0 pe-2 fw-bold" style="font-size: 30px">SHIFT</h1>
			<select name="shift" id="shift" class="form-select p-0 ps-5 me-3" style="width: 70px; font-size: 30px" onchange="changeShift('<?= $sub_bagian ?>')">
				<option value="1" <?= $shift == 1 ? 'selected' : '' ?>>1</option>
				<option value="2" <?= $shift == 2 ? 'selected' : '' ?>>2</option>
				<option value="3" <?= $shift == 3 ? 'selected' : '' ?>>3</option>
			</select>
			<form action="<?= base_url() ?>dashboard_man_power/save_record_man_power" method="post">
				<button type="button" class="btn btn-success p-1" style="font-size: 30px" id="btn_save_record_man_power" onclick="save_record_man_power()" title="save"><i class="fa fa-2x fa-fw fa-save"></i></button>
				<input type="hidden" name="sub_bagian" value="<?= $sub_bagian ?>">
			</form>
		</div>
	</nav>
</header>