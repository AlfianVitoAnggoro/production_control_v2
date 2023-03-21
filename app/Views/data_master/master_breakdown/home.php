<?=$this->extend ('layout\template');?>

<?=$this->section ('content');?>

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
									<h4 class="box-title">Data Master Breakdown</h4>
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_lhp">
										Tambah Data
									</button>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="data_lhp2" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<th>Jenis Breakdown</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data as $d) : ?>
												<tr>
													<td><?=$d['jenis_breakdown']?></td>
													<td>
														<a href="<?=base_url()?>lhp/detail_lhp/<?=$lhp['id_lhp_2']?>" class="btn btn-primary btn-sm">Detail</a>
                                                    </td>
												</tr>
												<?php endforeach; ?>
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

