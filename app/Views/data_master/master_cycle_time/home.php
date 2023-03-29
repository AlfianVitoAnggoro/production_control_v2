<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
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
									<h4 class="box-title">Data Master Cycle Time</h4>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="data_ct" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<th>Part Number</th>
													<th>Cycle Time</th>
													<th>Lot Size</th>
													<th>Model</th>
													<th>Series</th>
													<th>Type</th>
													<th>Brand</th>
													<th>Plate</th>
                                                    <th>Separator</th>
                                                    <th>Spacer</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data_cycle_time as $d_cycle_time) : ?>
												<tr>
													<td><?=$d_cycle_time['part_number']?></td>
                                                    <td><?=$d_cycle_time['first_cycle_time']?></td>
                                                    <td><?=$d_cycle_time['lot_size']?></td>
                                                    <td><?=$d_cycle_time['model']?></td>
                                                    <td><?=$d_cycle_time['series']?></td>
                                                    <td><?=$d_cycle_time['type']?></td>
                                                    <td><?=$d_cycle_time['brand']?></td>
                                                    <td><?=$d_cycle_time['plate']?></td>
                                                    <td><?=$d_cycle_time['separator']?></td>
                                                    <td><?=$d_cycle_time['spacer']?></td>
													<td>
														<!-- <a href="<?=base_url()?>cycle_time/edit_ct/<?=$d_cycle_time['id']?>" class="btn btn-primary btn-sm">Edit</a> -->
														<a href="#" class="btn btn-primary btn-sm">Edit</a>
													</td>
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
		$('#data_ct').DataTable({
			"order": []
		});
	});
  </script>
  <?= $this->endSection(); ?>