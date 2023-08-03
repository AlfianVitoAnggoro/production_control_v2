<aside class="main-sidebar">
	<!-- sidebar-->
	<section class="sidebar position-relative">
		<div class="multinav">
			<div class="multinav-scroll" style="height: 100%;">
				<!-- sidebar menu-->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">Menu</li>
					<?php if (session()->get('departemen') == 'produksi2' or session()->get('departemen') == '' and session()->get('level') != 5) { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Dashboard</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url() ?>dashboardGrid"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Produksi 1</a></li>
								<li><a href="<?= base_url() ?>dashboard"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Produksi 2</a></li>
							</ul>
						</li>
					<?php } ?>

					<?php if (session()->get('departemen') == 'produksi1' or session()->get('departemen') == 'isd' or session()->get('departemen') == 'quality' or session()->get('departemen') == NULL) { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Laporan Produksi 1</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url() ?>grid"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Grid Casting</a></li>
								<li><a href="<?= base_url() ?>grid_rework/" target="_blank"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Grid Rework</a></li>
								<li><a href="<?= base_url() ?>grid/get_summary_rework"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Summary Grid Casting Rework</a></li>
								<li><a href="<?= base_url() ?>wide_strip"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Wide Strip</a></li>
								<li><a href="<?= base_url() ?>punching"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Grid Punching</a></li>
								<li><a href="<?= base_url() ?>pasting"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pasting</a></li>
								<li class="treeview">
									<a href="#">
										<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Formation
										<span class="pull-right-container">
											<i class="fa fa-angle-right pull-right"></i>
										</span>
									</a>
									<ul class="treeview-menu">
										<li><a href="<?= base_url() ?>formation_loading/"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Loading</a></li>
										<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Unloading</a></li>
										<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>IGO</a></li>
									</ul>
								</li>
								<li><a href="<?= base_url() ?>interlock_aging"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Aging</a></li>
								<li><a href="<?= base_url() ?>rak_management/monitoring_barcode_casting"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Monitoring Integrasi Rak dan Label</a></li>
								<li><a href="<?= base_url() ?>monitoring_aging"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Monitoring Aging</a></li>
								<li><a href="<?= base_url() ?>monitoring_curing" target="_blank"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Monitoring Curing</a></li>
								<li><a href="<?= base_url() ?>monitoring_curing_qc"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Monitoring Curing QC</a></li>
							</ul>
						</li>
					<?php } ?>

					<?php if (session()->get('departemen') == 'produksi2' or session()->get('departemen') == 'isd' or session()->get('departemen') == 'quality' or session()->get('departemen') == NULL) { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Laporan Produksi 2</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<?php if (session()->get('seksi') == 'plate_cutting' or session()->get('seksi') == 'envelope' or session()->get('seksi') == NULL) { ?>
									<li><a href="<?= base_url() ?>platecutting"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Plate Cutting</a></li>
								<?php } ?>
								<?php if (session()->get('seksi') == 'envelope' or session()->get('seksi') == 'plate_cutting' or session()->get('seksi') == NULL) { ?>
									<li><a href="<?= base_url() ?>envelope"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Envelope</a></li>
								<?php } ?>
								<?php if (session()->get('seksi') == 'amb' or session()->get('seksi') == NULL) { ?>
									<li><a href="<?= base_url() ?>lhp"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Assy</a></li>
								<?php } ?>
								<?php if (session()->get('seksi') == 'saw_repair' or session()->get('seksi') == NULL) { ?>
									<li><a href="<?= base_url() ?>saw_repair"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>SAW Repair</a></li>
								<?php } ?>
								<?php if (session()->get('seksi') == 'amb' or session()->get('seksi') == NULL) { ?>
									<li><a href="<?= base_url() ?>cos"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>COS</a></li>
								<?php } ?>
								<?php if (session()->get('seksi') == 'amb' or session()->get('seksi') == NULL) { ?>
									<li><a href="<?= base_url() ?>timbangan_reject"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Laporan Timbangan Reject</a></li>
								<?php } ?>
								<?php if (session()->get('seksi') == 'envelope' or session()->get('seksi') == 'plate_cutting' or session()->get('seksi') == 'amb' or session()->get('seksi') == NULL) { ?>
									<li><a href="<?= base_url() ?>saw"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>SAW</a></li>
								<?php } ?>
								<?php if (session()->get('seksi') == 'amb' or session()->get('seksi') == NULL) { ?>
									<li><a href="<?= base_url() ?>mcb"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>MCB</a></li>
								<?php } ?>
								<?php if (session()->get('seksi') == 'amb' or session()->get('seksi') == 'wet' or session()->get('seksi') == NULL) { ?>
									<li><a href="<?= base_url() ?>wet_loading_new/list_loading/"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Loading</a></li>
									<li><a href="<?= base_url() ?>wet_loading_new/"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>WET Loading</a></li>
									<!-- <li><a href="<?= base_url() ?>wet_loading/"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>WET Loading</a></li> -->
									<li><a href="<?= base_url() ?>wet_finishing/"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>WET Finishing</a></li>
								<?php } ?>
								<?php if (session()->get('departemen') == 'isd' or session()->get('departemen') == NULL) { ?>
									<li><a href="<?= base_url() ?>wet_charging/"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>WET Charging</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } ?>
					<?php if (session()->get('departemen') == 'produksi2' or session()->get('departemen') == '' and session()->get('level') == 1) { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Data Master</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url() ?>cycle_time"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Cycle Time</a></li>
								<li><a href="<?= base_url() ?>line_stop"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Line Stop</a></li>
								<li><a href="<?= base_url() ?>line_stop_mcb"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Line Stop MCB</a></li>
								<li><a href="<?= base_url() ?>line_stop_wet"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Line Stop WET</a></li>
								<li><a href="<?= base_url() ?>reject"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Rejection</a></li>
								<li><a href="<?= base_url() ?>reject_mcb"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Rejection MCB</a></li>
								<li><a href="<?= base_url() ?>reject_wet"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Rejection WET</a></li>
								<!-- <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Run Time</a></li> -->
							</ul>
						</li>
					<?php } ?>
					<?php if (session()->get('departemen') == 'produksi2' or session()->get('departemen') == '' and session()->get('level') == 1) { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Data Master Man Power</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url() ?>master_man_power"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Man Power</a></li>
								<?php if (session()->get('departemen') == 'produksi2' or session()->get('departemen') == '' and session()->get('level') < 5) { ?>
									<li><a href="<?= base_url() ?>master_man_power_management"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Management</a></li>
								<?php } ?>
								<li><a href="<?= base_url() ?>master_man_power_kasubsie"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Kasubsie</a></li>
								<li><a href="<?= base_url() ?>master_man_power_gmt"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master GMT</a></li>
								<li><a href="<?= base_url() ?>master_group_man_power"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Group Man Power</a></li>
							</ul>
						</li>
					<?php } ?>
					<?php if (session()->get('departemen') == 'produksi2' or session()->get('departemen') == 'hrd' or session()->get('departemen') == '' and session()->get('level') == 1) { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Data Cuti</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url() ?>cuti"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>List Cuti</a></li>
								<li><a href="<?= base_url() ?>home_absen"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Form Cuti</a></li>
							</ul>
						</li>
					<?php } ?>

					<?php if (session()->get('departemen') == 'isd' or session()->get('username') == 'admin') { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Manajemen Rak</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?= base_url() ?>rak_management"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Rak</a></li>
								<li><a href="<?= base_url() ?>check_data"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>STO Rack</a></li>
							</ul>
						</li>
					<?php } ?>

					<?php if (session()->get('departemen') == NULL) { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>PPC</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Planning</a></li>
							</ul>
						</li>
					<?php } ?>

					<?php if (session()->get('departemen') == NULL or session()->get('departemen') == 'ppic' or session()->get('departemen') == 'isd') { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>WAREHOUSE</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Incoming</a></li>
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Rack FG</a></li>
								<<<<<<< HEAD <li><a href="<?= base_url() ?>supply_charging"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Supply Charging</a>
						</li>
						=======
						<li><a href="<?= base_url() ?>supply_charging/list_supply"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Supply Charging</a></li>
						>>>>>>> 1c19f7746bc4bf203e9850cf201cc620c2eb17fc
				</ul>
				</li>
			<?php } ?>

			<?php if (session()->get('departemen') == NULL) { ?>
				<li class="treeview">
					<a href="#">
						<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
						<span>EHS</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-right pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>MLR</a></li>
					</ul>
				</li>

				<li class="treeview">
					<a href="#">
						<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
						<span>QA</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-right pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Produksi 1</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Monitoring Curing</a></li>
							</ul>
						</li>

						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Produksi 2</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<!-- <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Monitoring Curing</a></li> -->
							</ul>
						</li>

						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Lab</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<!-- <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Monitoring Curing</a></li> -->
							</ul>
						</li>
					</ul>
				</li>
			<?php } ?>
			</ul>
			</div>
		</div>
	</section>
	<!-- <div class="sidebar-footer">
		<a href="javascript:void(0)" class="link" data-bs-toggle="tooltip" title="Settings"><span class="icon-Settings-2"></span></a>
		<a href="mailbox.html" class="link" data-bs-toggle="tooltip" title="Email"><span class="icon-Mail"></span></a>
		<a href="javascript:void(0)" class="link" data-bs-toggle="tooltip" title="Logout"><span class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></span></a>
	</div> -->
</aside>