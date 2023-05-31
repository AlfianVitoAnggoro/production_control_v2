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
									<h4 class="box-title">Laporan Harian Wide Strip</h4>
                                    &nbsp;
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_lhp">
										Tambah LHP
									</button>
								</div>
								<div class="box-body">
									<input type="month" name="month" id="month" class="form-control my-2" onchange="monthFilter()" value="<?= $current_month ?>" style="width: 200px">
									<div class="table-responsive">
										<table id="data_grid" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<!-- <th>No Doc</th> -->
													<th>Tanggal</th>
													<th>Shift</th>
													<th>Kasubsie</th>
													<th>Grup</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data_lhp_wide_strip as $lhp) : 
													if($current_month === substr(trim($lhp['tanggal_produksi']), 0, 7)) {
												?>
												<tr>
													<td><?=$lhp['tanggal_produksi']?></td>
													<td><?=$lhp['shift']?></td>
													<td><?=$lhp['kasubsie']?></td>
													<td><?=$lhp['grup']?></td>
													<td>
														<?php if(trim($lhp['status'] === 'approved')) : ?>
															<span class="badge bg-success">Approved</span>
														<?php elseif(trim($lhp['status'] === 'waiting')) : ?>
															<span class="badge bg-warning">Waiting</span>
														<?php elseif(trim($lhp['status'] === 'rejected')) : ?>
															<span class="badge bg-danger">Rejected</span>
														<?php endif ?>
													</td>
													<td>
														<a href="<?=base_url()?>wide_strip/detail_lhp/<?=$lhp['id_lhp_ws']?>" class="btn btn-primary btn-sm">Detail</a>
														<a href="<?=base_url()?>wide_strip/hapus_lhp/<?=$lhp['id_lhp_ws']?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
													</td>
												</tr>
												<?php }
												endforeach; ?>
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

<div class="modal fade modal_tambah_lhp" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Tambah LHP Wide Strip</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?=base_url()?>wide_strip/add_lhp" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-3">
							<div class="form-group">
								<label class="form-label">Tanggal Produksi</label>
								<input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi" min="<?=$previous_date ?>" required>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label class="form-label">Shift</label>
								<select class="form-select" id="shift" name="shift" required>
									<option selected disabled>-- Pilih Data --</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label class="form-label">Kasubsie</label>
								<select class="form-control select2" id="kasubsie" name="kasubsie" style="width: 100%;" required>
									<option selected disabled>-- Pilih Data --</option>
									<?php foreach($data_grup_wide_strip as $grup) : ?>
										<option value="<?=$grup['kasubsie']?>"><?=$grup['kasubsie']?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label class="form-label">Grup</label>
								<select class="form-control select2" id="grup" name="grup" style="width: 100%;" required>
									<option selected disabled>-- Pilih Data --</option>
									<?php foreach($data_grup_wide_strip as $grup) : ?>
										<option value="<?=$grup['nama_grup']?>"><?=$grup['nama_grup']?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<div class="form-group">
								<label class="form-label">Type</label>
								<select class="form-control select2" id="type_grid" name="type_grid" style="width: 100%;" required>
									<option selected disabled>-- Pilih Data --</option>
									<?php foreach ($data_type_grid as $d_type_grid) { ?>
                  	<option value="<?= $d_type_grid['id_grid'] ?>"><?= $d_type_grid['type_grid'] ?></option>
                  <?php } ?>
								</select>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label class="form-label">MP</label>
								<input type="text" class="form-control" id="mp" name="mp" maxlength='2' required>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label class="form-label">Absen</label>
								<input type="text" class="form-control" id="absen" name="absen" maxlength='2'>
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label class="form-label">Cuti</label>
								<input type="text" class="form-control" id="cuti" name="cuti" maxlength='2'>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<label class="form-label">Operator 1</label>
								<input type="text" class="form-control" id="operator_name_1" name="operator_name_1">
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label class="form-label">Operator 2</label>
								<input type="text" class="form-control" id="operator_name_2" name="operator_name_2">
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label class="form-label">Operator 3</label>
								<input type="text" class="form-control" id="operator_name_3" name="operator_name_3">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="float: right;">
					<!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->
					<input type="submit" class="btn btn-primary float-end" value="Tambah">
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


  <?= $this->endSection(); ?>

  <?= $this->section('script'); ?>
  <script>
	$(document).ready(function() {
		$('#data_grid').DataTable({
			"responsive": true,
			"autoWidth": false,
			"order": []
		});
		$('.modal .select2').select2({
            dropdownParent: $('.modal')
        });
	});

	function monthFilter() {
		const monthElement = document.querySelector('#month');
		const tbodyElement = document.querySelector('tbody');
		tbodyElement.innerHTML = '';
		<?php foreach($data_lhp_wide_strip as $lhp) : ?>
			if(monthElement.value.substr(0, 7) === "<?= substr(trim($lhp['tanggal_produksi']), 0, 7)?>") {
				tbodyElement.innerHTML += `
					<tr>
						<td><?=$lhp['tanggal_produksi']?></td>
						<td><?=$lhp['shift']?></td>
						<td><?=$lhp['kasubsie']?></td>
						<td><?=$lhp['grup']?></td>
						<td>
							<?php if(trim($lhp['status'] === 'approved')) : ?>
								<span class="badge bg-success">Approved</span>
							<?php elseif(trim($lhp['status'] === 'waiting')) : ?>
								<span class="badge bg-warning">Waiting</span>
							<?php elseif(trim($lhp['status'] === 'rejected')) : ?>
								<span class="badge bg-danger">Rejected</span>
							<?php endif ?>
						</td>
						<td>
							<a href="<?=base_url()?>wide_strip/detail_lhp/<?=$lhp['id_lhp_ws']?>" class="btn btn-primary btn-sm">Detail</a>
							<a href="<?=base_url()?>wide_strip/hapus_lhp/<?=$lhp['id_lhp_ws']?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
						</td>
					</tr>
				`;
			}
		<?php endforeach; ?>
	}
  </script>
  <?= $this->endSection(); ?>