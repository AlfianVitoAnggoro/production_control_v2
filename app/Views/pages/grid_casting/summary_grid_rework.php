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
									<h4 class="box-title">Summary Grid Rework</h4>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="data_grid" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<th>Tanggal</th>
													<th>Mesin</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data_rework as $dr): ?>
													<tr>
														<td>Mesin <?= $dr['id_machine'] ?></td>
														<td><?= date('d-m-Y', strtotime($dr['tanggal'])) ?></td>
														<td><?= $dr['total'] ?></td>
													</tr>
												<?php endforeach; ?>
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
		$('#data_grid').DataTable({
			"responsive": true,
			"autoWidth": false,
			"order": []
		});
	});
  </script>
  <?= $this->endSection(); ?>