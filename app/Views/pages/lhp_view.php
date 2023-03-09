<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xl-12 col-12">
					<!-- <div class="box bg-primary-light">
						<div class="box-body d-flex px-0">
							<div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md" style="background-position: right bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-1.svg)">
								<div class="row">
									<div class="col-12 col-xl-12">
										<h2>Welcome back, <strong>John!</strong></h2>

										<p class="text-dark my-10 fs-16">
											Your students complated <strong class="text-warning">80%</strong> of the tasks.
										</p>
										<p class="text-dark my-10 fs-16">
											Progress is <strong class="text-warning">very good!</strong>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="box">
								<div class="box-header with-border">
									<h4 class="box-title">Laporan Harian Produksi</h4>
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-default">
										Tambah LHP
									</button>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="example5" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<th>No Doc</th>
													<th>Tanggal</th>
													<th>Shift</th>
													<th>Line</th>
													<th>Part Number</th>
													<th>Efficiency</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Tiger Nixon</td>
													<td>System Architect</td>
													<td>Edinburgh</td>
													<td>61</td>
													<td>2011/04/25</td>
													<td>$320,800</td>
												</tr>
												<tr>
													<td>Garrett Winters</td>
													<td>Accountant</td>
													<td>Tokyo</td>
													<td>63</td>
													<td>2011/07/25</td>
													<td>$170,750</td>
												</tr>
												<tr>
													<td>Ashton Cox</td>
													<td>Junior Technical Author</td>
													<td>San Francisco</td>
													<td>66</td>
													<td>2009/01/12</td>
													<td>$86,000</td>
												</tr>
												<tr>
													<td>Cedric Kelly</td>
													<td>Senior Javascript Developer</td>
													<td>Edinburgh</td>
													<td>22</td>
													<td>2012/03/29</td>
													<td>$433,060</td>
												</tr>
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
  <!-- modal Area -->              
  <div class="modal fade" id="modal-default">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Tambah Laporan Harian Produksi</h4>
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
								<option>1</option>
								<option>2</option>
								<option>3</option>
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
				</div>
			</div>
			<div class="modal-footer">
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
		$('#example5').DataTable();
	});
  </script>
  <?= $this->endSection(); ?>