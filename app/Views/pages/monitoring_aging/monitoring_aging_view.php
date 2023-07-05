<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?php
	$current_date = date('Y-m-d');
	$current_month = date('Y-m');
	$previous_date = date('Y-m-d', strtotime('-1 day', strtotime($current_date)));
?>
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xl-12 col-12">
					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="box">
								<div class="box-header with-border">
									<h4 class="box-title">Data Rak Aging</h4>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="data_rak" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<th>PN QR</th>
													<th>Item</th>
													<th>Qty</th>
													<th>Mesin</th>
													<th>Start Aging</th>
													<th>Stop Aging</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data_rak_aging as $dra) {
												?>
												<tr>
													<td><?=$dra['pn_qr']?></td>
													<td><?=$dra['item']?></td>
													<td><?=$dra['qty']?></td>
													<td><?=$dra['nama_mesin']?></td>
													<td><?=$dra['start_aging']?></td>
													<td><?=$dra['stop_aging']?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
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
  <script>
	$(document).ready(function() {
		$('#data_rak').DataTable({
			"responsive": true,
			"autoWidth": false,
			"order": []
		});
		$('.modal .select2').select2({
            dropdownParent: $('.modal')
        });
	});
  </script>
  <?= $this->endSection(); ?>