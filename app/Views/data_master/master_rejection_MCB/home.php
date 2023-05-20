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
						<div class="col-5 col-xl-5">
							<div class="box">
								<div class="box-header with-border">
									<h4 class="box-title">Data Master Reject</h4>
                                    &nbsp;
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_jenis">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="data_reject_utama" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<th>Jenis Reject</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data_reject_utama_mcb as $d_reject_utama) : ?>
												<tr>
                                                    <td><?=$d_reject_utama['jenis_reject']?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm edit-btn" data-id="<?=$d_reject_utama['id_reject_utama']?>" data-name="<?=$d_reject_utama['jenis_reject']?>">Edit</a>
                                                        <a href="<?=base_url()?>reject_mcb/delete_reject_utama/<?=$d_reject_utama['id_reject_utama']?>/<?=$d_reject_utama['jenis_reject']?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

                        <div class="col-7 col-xl-7">
                            <div class="box">
								<div class="box-header with-border">
									<h4 class="box-title">Data Master Detail Rejection</h4>
                                    &nbsp;
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_kategori"><i class="fa fa-plus" aria-hidden="true"></i></button>
								</div>
								<div class="box-body">
									<div class="table-responsive">
										<table id="data_reject" class="table table-bordered table-striped" style="width:100%">
											<thead>
												<tr>
													<th>Jenis Reject</th>
                                                    <th>Kategori Reject</th>
													<th>Dashboard</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($data_reject as $d_reject) : ?>
												<tr>
                                                    <td><?=$d_reject['jenis_reject']?></td>
                                                    <td><?=$d_reject['kategori_reject']?></td>
													<td>
														<?php 
														if ($d_reject['dashboard'] == 'reject') {
															echo 'Reject';
														} elseif ($d_reject['dashboard'] == 'adj') {
															echo 'Adjustment';
														} else {
															echo '';
														}
														?>
													</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-sm edit-btn-kategori" data-id="<?=$d_reject['id_reject']?>" data-jenis="<?=$d_reject['jenis_reject']?>" data-kategori="<?=$d_reject['kategori_reject']?>" data-dashboard="<?=$d_reject['dashboard']?>">Edit</a>
                                                        <a href="<?=base_url()?>reject_mcb/delete_reject/<?=$d_reject['id_reject']?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm">Delete</a>
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

<!-- Modal Tambah Jenis Reject -->
<div class="modal fade modal_tambah_jenis" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Tambah LHP Produksi 2</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?=base_url()?>reject_mcb/add_reject_utama" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="Jenis Reject">Jenis Reject</label>
						<div id="form_jenis_reject_utama">
							<select class="form-select mb-2" id="jenis_reject_utama" name="jenis_reject_utama">
								<option value="">Pilih Jenis Reject</option>
								<?php foreach($data_reject_utama as $d_reject_utama) : ?>
								<option value="<?=$d_reject_utama['jenis_reject']?>"><?=$d_reject_utama['jenis_reject']?></option>
								<?php endforeach; ?>
							</select>
							<button type="button" class="btn btn-sm btn-primary" name="value_btn" value="add" onclick="add_data()">Tambah Data</button>
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

<!-- Modal Edit Jenis Reject -->
<div class="modal fade modal_edit_jenis" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Edit Master Rejection</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?=base_url()?>reject_mcb/update_reject_utama" method="post">
				<div class="modal-body">
                    <input type="hidden" name="edit_id_reject_utama" id="edit_id_reject_utama">
					<input type="hidden" class="form-control" id="edit_reject_utama" name="edit_reject_utama">
					<div class="form-group">
                        <label for="Jenis Reject">Jenis Reject</label>
                        <input type="text" class="form-control" id="edit_jenis_reject_utama" name="edit_jenis_reject_utama" placeholder="Jenis Reject">
                    </div>
				</div>
				<div class="modal-footer" style="float: right;">
					<!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->
					<input type="submit" class="btn btn-primary float-end" value="Edit">
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Tambah Kategori Reject -->
<div class="modal fade modal_tambah_kategori" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Tambah LHP Produksi 2</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?=base_url()?>reject_mcb/add_reject" method="post">
				<div class="modal-body">
					<div class="form-group">
                        <label for="jenis_reject">Jenis Reject</label>
                        <select class="form-select" id="jenis_reject" name="jenis_reject">
                            <option value="">Pilih Jenis Reject</option>
                            <?php foreach($data_reject_utama as $d_reject_utama) : ?>
                            <option value="<?=$d_reject_utama['jenis_reject']?>"><?=$d_reject_utama['jenis_reject']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kategori_reject">Kategori Reject</label>
                        <input type="text" class="form-control" id="kategori_reject" name="kategori_reject" placeholder="Kategori Reject">
                    </div>
					<div class="form-group">
                        <label for="dashboard">Dashboard</label>
						<select class="form-select" id="dashboard" name="dashboard">
							<option value="" selected disabled>Pilih Dashboard</option>
							<option value="reject">Reject</option>
							<option value="adj">Adjustment</option>
						</select>
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

<!-- Modal Edit Kategori Reject -->
<div class="modal fade modal_edit_kategori" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Tambah LHP Produksi 2</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="<?=base_url()?>reject_mcb/update_reject" method="post">
				<div class="modal-body">
					<input type="hidden" name="edit_id_ketegori_reject" id="edit_id_ketegori_reject">
					<div class="form-group">
                        <label for="Jenis Reject">Jenis Reject</label>
                        <select class="form-select" id="edit_jenis_reject" name="edit_jenis_reject">
                            <option value="">Pilih Jenis Reject</option>
                            <?php foreach($data_reject_utama as $d_reject_utama) : ?>
                            <option value="<?=$d_reject_utama['jenis_reject']?>"><?=$d_reject_utama['jenis_reject']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Jenis Reject">Kategori Reject</label>
                        <input type="text" class="form-control" id="edit_kategori_reject" name="edit_kategori_reject" placeholder="Kategori Reject">
                    </div>
					<div class="form-group">
                        <label for="dashboard">Dashboard</label>
						<select class="form-select" id="edit_dashboard" name="edit_dashboard">
							<option value="" selected disabled>Pilih Dashboard</option>
							<option value="reject">Reject</option>
							<option value="adj">Adjustment</option>
						</select>
                    </div>
				</div>
				<div class="modal-footer" style="float: right;">
					<!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->
					<input type="submit" class="btn btn-primary float-end" value="Simpan">
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
		$('#data_reject_utama').DataTable({
			"order": []
		});

        $('#data_reject').DataTable({
			"order": []
		});

        $('.modal .select2').select2({
   		 dropdownParent: $('.modal')
		});
	});

	$('.edit-btn').on('click', function() {
			// Get data attributes from button
			var id = $(this).data('id');
			var name = $(this).data('name');
			// Set data attributes to modal
			$('#edit_jenis_reject_utama').val(name);
			$('#edit_reject_utama').val(name);
			$('#edit_id_reject_utama').val(id);
			$('.modal_edit_jenis').modal('show'); 
	});

	$('.edit-btn-kategori').on('click', function() {
		// Get data attributes from button
		var id = $(this).data('id');
		var jenis = $(this).data('jenis');
		var kategori = $(this).data('kategori');
		var dashboard = $(this).data('dashboard');

		// Set data attributes to modal
		$('#edit_jenis_reject').val(jenis);
		$('#edit_kategori_reject').val(kategori);
		$('#edit_dashboard').val(dashboard);
		$('#edit_id_ketegori_reject').val(id);
		$('.modal_edit_kategori').modal('show');
	});

	function add_data() {
		const form_jenis_reject_utamaElement = document.querySelector('#form_jenis_reject_utama');
		form_jenis_reject_utamaElement.innerHTML = `
			<input type="text" class="form-control mb-2" id="jenis_reject_utama" name="jenis_reject_utama" placeholder="Jenis Reject">
			<button type="button" class="btn btn-sm btn-danger" name="value_btn" value="cancel" onclick="cancel()">Batal</button>
		`;
	}

	function cancel() {
		const form_jenis_reject_utamaElement = document.querySelector('#form_jenis_reject_utama');
		form_jenis_reject_utamaElement.innerHTML = `
			<select class="form-select mb-2" id="jenis_reject" name="jenis_reject">
					<option value="">Pilih Jenis Reject</option>
					<?php foreach($data_reject_utama as $d_reject_utama) : ?>
					<option value="<?=$d_reject_utama['jenis_reject']?>"><?=$d_reject_utama['jenis_reject']?></option>
					<?php endforeach; ?>
			</select>
			<button type="button" class="btn btn-sm btn-primary" name="value_btn" value="add" onclick="add_data()">Tambah Data</button>
		`;
	}
  </script>
  <?= $this->endSection(); ?>