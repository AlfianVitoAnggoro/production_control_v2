<header style="background-color: transparent">
	<!-- <header class="main-header" style="background-color: transparent"> -->
	<!-- &nbsp; -->
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top d-flex justify-content-around align-items-center p-0">
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
		<div class="d-flex" style="margin-left: 96px">
			<div class="box mb-2 mx-1" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; width: 140px">
				<div class="fx-card-item">
					<div class="fx-card-content">
						<div class="d-flex justify-content-center align-items-center" style="border-radius: 5px 5px 0px 0px">
							<div style="width: 12%">
								<h4 class="mb-0 text-center p-1 fw-bold" style="font-size: 10px">&nbsp;</h4>
							</div>
							<div style="width: 76%">
								<h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px">KADEPT</h4>
							</div>
						</div>
					</div>
					<div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 125px">
						<img src="<?= base_url() ?>uploads/kadept.jpg" alt="" style="max-width: 100%; height: 125px" id="foto_kadept">
					</div>
					<div class="fx-card-footer px-3 py-1">
						<div class="d-flex justify-content-between align-items-center">
							<h5 class="m-0" style="font-size: 10px" id="npk_kadept">1100</h5>
							<!-- <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower()">Edit</button> -->
						</div>
						<!-- <div class="d-flex justify-content-between align-items-center">
							<h5 class="m-0" style="font-size: 10px">Min Skill</h5>
						</div> -->
					</div>
				</div>
			</div>
			<?php if ($sub_bagian === 'amb-1') { ?>
				<div class="box mb-2 mx-1" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; width: 140px">
					<div class="fx-card-item">
						<div class="fx-card-content">
							<div class="d-flex justify-content-center align-items-center" style="border-radius: 5px 5px 0px 0px">
								<div style="width: 12%">
									<h4 class="mb-0 text-center p-1 fw-bold" style="font-size: 10px">&nbsp;</h4>
								</div>
								<div style="width: 76%">
									<h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px">KASIE</h4>
								</div>
							</div>
						</div>
						<div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 125px">
							<img src="<?= base_url() ?>uploads/kadept.jpg" alt="" style="max-width: 100%; height: 125px" id="foto_kadept">
						</div>
						<div class="fx-card-footer px-3 py-1">
							<div class="d-flex justify-content-between align-items-center">
								<h5 class="m-0" style="font-size: 10px" id="npk_kadept">3012</h5>
								<!-- <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower()">Edit</button> -->
							</div>
							<!-- <div class="d-flex justify-content-between align-items-center">
							<h5 class="m-0" style="font-size: 10px">Min Skill</h5>
						</div> -->
						</div>
					</div>
				</div>
			<?php } else if ($sub_bagian === 'amb-2') { ?>
				<div class="box mb-2 mx-1" style="box-shadow: 0px 0px 5px rgba(0,0,0,0.2); border-radius: 5px; width: 140px">
					<div class="fx-card-item">
						<div class="fx-card-content">
							<div class="d-flex justify-content-center align-items-center" style="border-radius: 5px 5px 0px 0px">
								<div style="width: 12%">
									<h4 class="mb-0 text-center p-1 fw-bold" style="font-size: 10px">&nbsp;</h4>
								</div>
								<div style="width: 76%">
									<h4 class="box-title mb-0 text-center p-1 fw-bold" style="font-size: 10px">Kasie</h4>
								</div>
							</div>
						</div>
						<div class="fx-card-avatar d-flex justify-content-center align-items-center" style="height: 125px">
							<img src="<?= base_url() ?>uploads/kadept.jpg" alt="" style="max-width: 100%; height: 125px" id="foto_kadept">
						</div>
						<div class="fx-card-footer px-3 py-1">
							<div class="d-flex justify-content-between align-items-center">
								<h5 class="m-0" style="font-size: 10px" id="npk_kadept">1100</h5>
								<!-- <button type="button" class="btn btn-sm btn-warning p-0 px-1" style="font-size: 10px" data-bs-toggle="modal" data-bs-target=".modal_edit_group_man_power" onclick="editGroupManPower()">Edit</button> -->
							</div>
							<!-- <div class="d-flex justify-content-between align-items-center">
							<h5 class="m-0" style="font-size: 10px">Min Skill</h5>
						</div> -->
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div style="width: 40%">
			<h1 class="judul_dashboard text-center m-0" style="color: white">HENKATEN MAN POWER <?= strtoupper($sub_bagian) ?></h1>
		</div>
		<div style="width: 30%; color: white" class="justify-content-end align-items-center pe-3 d-flex">
			<h1 class="text-center m-0 pe-2" style="font-size: 24px"><?= date('d F Y') ?> Shift</h1>
			<select name="shift" id="shift" class="form-select p-0 ps-5 me-3" style="width: 50px; font-size: 16px">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
			</select>
			<form action="<?= base_url() ?>dashboard_man_power/save_record_man_power" method="post">
				<button type="button" class="btn btn-primary p-1" style="font-size: 12px" id="btn_save_record_man_power" onclick="save_record_man_power()">Save</button>
				<input type="hidden" name="sub_bagian" value="<?= $sub_bagian ?>">
			</form>
		</div>
	</nav>
</header>