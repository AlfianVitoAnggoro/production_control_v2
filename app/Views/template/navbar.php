<aside class="main-sidebar">
	<!-- sidebar-->
	<section class="sidebar position-relative">
		<div class="multinav">
			<div class="multinav-scroll" style="height: 100%;">
				<!-- sidebar menu-->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">Menu</li>
					<?php if (session()->get('level') != 5) { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Dashboard</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Produksi 1</a></li>
								<li><a href="<?=base_url()?>dashboard"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Produksi 2</a></li>
							</ul>
						</li>
					<?php } ?>
					
					<?php if (session()->get('departemen') == 'produksi1' OR session()->get('departemen') == 'isd' OR session()->get('departemen') == 'quality' OR session()->get('departemen') == NULL) { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Laporan Produksi 1</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?=base_url()?>grid"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Grid</a></li>
								<li><a href="<?=base_url()?>grid/get_summary_rework"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Summary Grid Rework</a></li>
								<li><a href="<?=base_url()?>pasting"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Pasting</a></li>
							</ul>
						</li>
					<?php } ?>

					<?php if (session()->get('departemen') == 'produksi2' OR session()->get('departemen') == 'isd' OR session()->get('departemen') == 'quality' OR session()->get('departemen') == NULL) { ?>
					<li class="treeview">
						<a href="#">
							<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
							<span>Laporan Produksi 2</span>
							<span class="pull-right-container">
							<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<?php if (session()->get('seksi') == 'plate_cutting' OR session()->get('seksi') == 'envelope' OR session()->get('seksi') == NULL) { ?>
								<li><a href="<?=base_url()?>platecutting"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Plate Cutting</a></li>
							<?php } ?>
							<?php if (session()->get('seksi') == 'envelope' OR session()->get('seksi') == 'plate_cutting' OR session()->get('seksi') == NULL) { ?>
								<li><a href="<?=base_url()?>envelope"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Envelope</a></li>
							<?php } ?>
							<?php if (session()->get('seksi') == 'amb' OR session()->get('seksi') == NULL) { ?>
								<li><a href="<?=base_url()?>lhp"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Assy</a></li>
							<?php } ?>
							<?php if (session()->get('seksi') == 'saw_repair' OR session()->get('seksi') == NULL) { ?>
								<li><a href="<?=base_url()?>saw_repair"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>SAW Repair</a></li>
							<?php } ?>
						</ul>
					</li>
					<?php } ?>
					<?php if (session()->get('level') == 1) { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Data Master</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?=base_url()?>cycle_time"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Cycle Time</a></li>
								<li><a href="<?=base_url()?>line_stop"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Line Stop</a></li>
								<li><a href="<?=base_url()?>reject"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Rejection</a></li>
								<!-- <li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Master Run Time</a></li> -->
							</ul>
						</li>
					<?php } ?>

					<?php if (session()->get('departement') == 'isd' OR session()->get('username') == 'admin') { ?>
						<li class="treeview">
							<a href="#">
								<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
								<span>Manajemen Rak</span>
								<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?=base_url()?>rak_management"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Data Rak</a></li>
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