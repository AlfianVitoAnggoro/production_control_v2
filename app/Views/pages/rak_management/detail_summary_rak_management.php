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
									<h4 class="box-title">Laporan Manajemen Rak</h4>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="data_rak" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<th>PN QR</th>
													<th>Barcode</th>
													<th>Qty</th>
													<th>WH From</th>
													<th>WH To</th>
													<th>Supply Time</th>
													<th>Close Time</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data_record_rak as $drr) :
                        if($drr['pn_qr'] === $id_rak) {
												?>
												<tr>
													<td><?=$drr['pn_qr']?></td>
													<td><?=$drr['barcode']?></td>
													<td><?=$drr['qty']?></td>
													<td><?=$drr['wh_from']?></td>
													<td><?=$drr['wh_to']?></td>
													<td><?=$drr['supply_time']?></td>
													<td><?=$drr['close_time']?></td>
													<td><?=$drr['status']?></td>
												</tr>
												<?php } endforeach; ?>
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