<header style="background-color: transparent">
	<!-- <header class="main-header" style="background-color: transparent"> -->
	<!-- &nbsp; -->
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top d-flex justify-content-between align-items-center p-0">
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
		<?php
		$uri = current_url(true);
		if ($uri->getSegment(2) == 'dashboard_cuti') { ?>
			<!-- <h1 class="judul_dashboard text-center m-0" style="color: white">DASHBOARD CUTI PRODUCTION 2</h1> -->
		<?php } else if (strpos($uri->getSegment(2), 'form') === 0) { ?>
			<h1 class="judul_dashboard text-center m-0" style="color: white">&nbsp;</h1>
		<?php } else { ?>
			<h1 class="judul_dashboard text-center m-0" style="color: white">FORM CUTI PRODUCTION 2</h1>
		<?php } ?>
	</nav>
</header>