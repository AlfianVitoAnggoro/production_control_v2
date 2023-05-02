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
													<th>Area</th>
													<th>Jenis Rak</th>
													<th>Current Position</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data_rak_management as $drm) : 
												?>
												<tr>
													<td><?=$drm['pn_qr']?></td>
													<td><?=$drm['area']?></td>
													<td><?=$drm['jenis_rak']?></td>
													<td><?=$drm['current_position']?></td>
													<td>
														<?php if($drm['status'] == '1') : ?>
															<span class="badge badge-secondary">Isi</span>
														<?php else : ?>
															<span class="badge badge-success">Kosong</span>
														<?php endif; ?>
													</td>
													<td>
														<a href="<?=base_url()?>rak_management/detail_rak_management/<?=$drm['pn_qr']?>" class="btn btn-primary btn-sm">Detail</a>
														<!-- <a href="<?=base_url()?>rak_management/hapus_lhp/<?=$drm['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</a> -->
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