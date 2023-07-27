<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="box">
						<div class="box-header with-border">
							<h4 class="box-title">Data Label Produksi Yang Belum Terintegrasi Dengan Rak</h4>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs customtab2" role="tablist">
								<li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#casting" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Casting</span></a> </li>
								<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#pasting" role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span class="hidden-xs-down">Pasting</span></a> </li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane active" id="casting" role="tabpanel">
									<div class="p-15">
										<div class="table-responsive">
											<table id="data_rak_casting" class="table table-bordered table-striped" style="width:100%">
												<thead>
													<tr>
														<th>ID</th>
														<th>Item</th>
														<th>Qty</th>
														<th>Mesin</th>
														<th>Jam</th>
														<th>Entry Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($data_casting as $item) { 
														$this->M_RakManagement = new \App\Models\M_RakManagement();
														$cek = $this->M_RakManagement->get_data_tr_casting($item['T$NOTE']);
													?>
													<tr>
														<td><?=$item['T$NOTE']?></td>
														<td><?=$item['T$ITEM']?></td>
														<td><?=$item['T$ACTQ']?></td>
														<td><?=$item['T$MACH']?></td>
														<td><?=date('H:i',strtotime($item['TANGGAL']))?></td>
														<td><?=date('d-m-Y', strtotime($item['TANGGAL']))?></td>
														<?php if(empty($cek)) { ?>
															<td></td>
														<?php } else { ?>
															<td>WTA</td>
														<?php } ?>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="pasting" role="tabpanel">
									<div class="p-15">
										<div class="table-responsive">
											<table id="data_rak_pasting" class="table table-bordered table-striped" style="width:100%">
												<thead>
													<tr>
														<th>ID</th>
														<th>Item</th>
														<th>Qty</th>
														<th>Jam</th>
														<th>Entry Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($data_pasting as $item2) { 
														$this->M_RakManagement = new \App\Models\M_RakManagement();
														$cek2 = $this->M_RakManagement->get_data_tr_pasting($item2['T$NOTE']);
													?>
													<tr>
														<td><?=$item2['T$NOTE']?></td>
														<td><?=$item2['T$ITEM']?></td>
														<td><?=$item2['T$ACTQ']?></td>
														<td><?=date('H:i',strtotime($item2['TANGGAL']))?></td>
														<td><?=date('d-m-Y', strtotime($item2['TANGGAL']))?></td>
														<?php if(empty($cek2)) { ?>
															<td></td>
														<?php } else { ?>
															<td>WTA</td>
														<?php } ?>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
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
		$('#data_rak_casting').DataTable({
			"responsive": true,
			"autoWidth": false,
			"order": []
		});
		$('#data_rak_pasting').DataTable({
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