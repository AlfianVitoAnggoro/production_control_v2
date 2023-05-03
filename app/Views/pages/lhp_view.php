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
									<h4 class="box-title">Laporan Harian Produksi</h4>
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_lhp">
										Tambah LHP
									</button>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="data_lhp2" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<!-- <th>No Doc</th> -->
													<th>Tanggal</th>
													<th>Shift</th>
													<th>Line</th>
													<th>Kasubsie</th>
													<th>Grup</th>
													<!-- <th>Efficiency (%)</th> -->
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data_lhp as $lhp) : ?>
												<tr>
													<!-- <td><?=$lhp['no_doc']?></td> -->
													<td><?=$lhp['tanggal_produksi']?></td>
													<td><?=$lhp['shift']?></td>
													<td><?=$lhp['line']?></td>
													<td><?=$lhp['kasubsie']?></td>
													<td><?=$lhp['nama_pic']?></td>
													<!-- <td><?=$retVal = (!empty($lhp['total_aktual']) && !empty($lhp['total_plan'])) ? number_format((float) ($lhp['total_aktual'] / $lhp['total_plan']) * 100, 2, '.', '') : '' ; ?></td> -->
													<td>
														<a href="<?=base_url()?>lhp/detail_lhp/<?=$lhp['id_lhp_2']?>" class="btn btn-primary btn-sm" target="_blank">Detail</a>
														<a href="<?=base_url()?>lhp/hapus_lhp/<?=$lhp['id_lhp_2']?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
													</td>
												</tr>
												<?php endforeach; ?>
											</tbody>
											<tfoot>
												<tr>
													<!-- <th>No Doc</th> -->
													<th>Tanggal</th>
													<th>Shift</th>
													<th>Line</th>
													<th>Kasubsie</th>
													<th>Grup</th>
													<!-- <th>Efficiency (%)</th> -->
													<th>Action</th>
												</tr>
											</tfoot>
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
				<h4 class="modal-title" id="myLargeModalLabel">Tambah LHP Produksi 2</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?=base_url()?>lhp/add_lhp" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<label class="form-label">Tanggal Produksi</label>
								<input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi">
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label class="form-label">Line</label>
								<select class="form-select" id="line" name="line">
									<option selected disabled>-- Pilih Data --</option>
									<?php foreach($data_line as $line) : ?>
										<option value="<?=$line['id_line']?>"><?=$line['nama_line']?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label class="form-label">Shift</label>
								<select class="form-select" id="shift" name="shift">
									<option selected disabled>-- Pilih Data --</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
								</select>
							</div>
						</div>
						<!-- <div class="col-3">
							<div class="form-group">
								<label class="form-label">Kasubsie</label>
								<select class="form-control select2" id="kasubsie" name="kasubsie" style="width: 100%;">
									<option selected disabled>-- Pilih Data --</option>
									<option value="Yusuf Slamet Pelita">Yusuf Slamet Pelita</option>
									<option value="Edi Suwito">Edi Suwito</option>
									<option value="Masruri">Masruri</option>
									<option value="Parwadi">Parwadi</option>
									<option value="Iim Arwisman">Iim Arwisman</option>
								</select>
							</div>
						</div> -->
					</div>
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<label class="form-label">Kasubsie</label>
								<select class="form-control select2" id="kasubsie" name="kasubsie" style="width: 100%;">
									<option selected disabled>-- Pilih Data --</option>
									<option value="Yusuf Slamet Pelita">Yusuf Slamet Pelita</option>
									<option value="Edi Suwito">Edi Suwito</option>
									<option value="Masruri">Masruri</option>
									<option value="Parwadi">Parwadi</option>
									<option value="Iim Arwisman">Iim Arwisman</option>
								</select>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label class="form-label">Grup</label>
								<select class="form-control select2" id="grup" name="grup" style="width: 100%;">
									<option selected disabled>-- Pilih Data --</option>
									<?php foreach($data_grup as $grup) : ?>
										<option value="<?=$grup['id_pic']?>"><?=$grup['nama_pic']?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<label class="form-label">MP</label>
								<input type="number" class="form-control" id="mp" name="mp">
							</div>
						</div>
						<!-- <div class="col-3">
							<div class="form-group">
								<label class="form-label">Absen</label>
								<input type="number" class="form-control" id="absen" name="absen">
							</div>
						</div>
						<div class="col-3">
							<div class="form-group">
								<label class="form-label">Cuti</label>
								<input type="number" class="form-control" id="cuti" name="cuti">
							</div>
						</div> -->
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
		$('#data_lhp2').DataTable({
			"order": [],
			initComplete: function () {
				this.api()
					.columns()
					.every(function () {
						var column = this;
						var select = $('<select class="form-select"><option value=""></option></select>')
							.appendTo($(column.footer()).empty())
							.on('change', function () {
								var val = $.fn.dataTable.util.escapeRegex($(this).val());
	
								column.search(val ? '^' + val + '$' : '', true, false).draw();
							});
	
						column
							.data()
							.unique()
							.sort()
							.each(function (d, j) {
								select.append('<option value="' + d + '">' + d + '</option>');
							});
					});
			},
		});
		$('.modal .select2').select2({
   		 dropdownParent: $('.modal')
		});
	});
  </script>
  <?= $this->endSection(); ?>