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
									<h4 class="box-title">Data Label Produksi Casting Yang Belum Terintegrasi Dengan Rak</h4>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="data_rak" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<th>ID</th>
													<th>Item</th>
													<th>Qty</th>
													<th>Mesin</th>
													<th>Jam</th>
													<th>Entry Date</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data as $item) { ?>
												<tr>
													<td><?=$item['T$NOTE']?></td>
													<td><?=$item['T$ITEM']?></td>
													<td><?=$item['T$ACTQ']?></td>
													<td><?=$item['T$MACH']?></td>
													<td><?=date('H:i',strtotime($item['TANGGAL']))?></td>
													<td><?=date('d-m-Y', strtotime($item['TANGGAL']))?></td>
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