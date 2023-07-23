<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<?php 
				$this->session = \Config\Services::session();
				$action_delete = false;
				if ($this->session->get('otorisasi') == 1 AND ($this->session->get('departemen') == NULL OR $this->session->get('departemen') == 'produksi2')) {
					$action_delete = true;
			?>
				<div class="row">
					<div class="col-xl-12 col-12">
						<div class="row">
							<div class="col-12 col-xl-12">
								<div class="box">
									<div class="box-header with-border">
										<h4 class="box-title">Setting List Loading</h4>
									</div>
									<form action="<?=base_url()?>wet_loading_new/list_loading/add_list_wo" method="post">
										<div class="box-body">
											<div class="form-group">
												<label class="form-label">Line</label>
												<select name="line" id="line" class="form-select" required>
													<option value="" selected disabled>Pilih Data</option>
													<option value="8">WET A</option>
													<option value="9">WET F</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Shift</label>
												<select name="shift" id="shift" class="form-select" required>
													<option value="" selected disabled>Pilih Data</option>
													<option value="1">Shift 1</option>
													<option value="2">Shift 2</option>
													<option value="3">Shift 3</option>
												</select>
											</div>
											<div class="form-group">
												<label class="form-label">Tanggal Poduksi</label>
												<input type="date" name="tanggal_produksi" id="tanggal_produksi" class="form-control" required>
											</div>
											<div class="form-group">
												<label class="form-label">No WO</label> &emsp;
												<button type="button" class="btn btn-primary btn-sm" onclick="add_wo()"><i class="fa fa-plus"></i></button>
												<div id="section_wo_main" style="margin-top:10px;">
													<div class="item_wo">
														<select name="wo[]" id="wo_0" class="form-control select2" style="width: 500px;">
															<option value="" selected disabled>Pilih Data</option>
															<?php 
																$cek_wet_a = false;
																$cek_wet_f = false;
																foreach($list_wo as $wo){ 
																	$cek_wet_a = in_array($wo['PDNO'], array_column($list_loading_wet_a, 'no_wo'));
																	$cek_wet_f = in_array($wo['PDNO'], array_column($list_loading_wet_f, 'no_wo'));
																	if (!$cek_wet_a && !$cek_wet_f) { ?>
																		<option value="<?= $wo['PDNO'].'|'.$wo['ITEM'].'|'.$wo['QTY'] ?>"><?= $wo['PDNO'].' | '.$wo['ITEM'].' | '.$wo['QTY'] ?></option>
																<?php }
																	} ?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="box-footer" style="text-align:center;">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>									
					</div>
				</div>
			<?php } ?>
			
			<div class="row">
				<div class="col-10"></div>
				<div class="col-2">
					<div class="form-group">
						<label class="form-label">Filter Tanggal</label>
						<input type="date" name="filter_tanggal" id="filter_tanggal" class="form-control" style="width: 200px;" onchange="filter_date()" value="<?=$tanggal_produksi?>">
					</div>
				</div>
			</div>
			
			<?php if ($this->session->get('username') == 'wet_a') { 
				$show_wet_a = true;
				$show_wet_f = false;
			 } else if ($this->session->get('username') == 'wet_f') { 
				$show_wet_a = false;
				$show_wet_f = true;
			 } else {
				$show_wet_a = true;
				$show_wet_f = true;
			 } ?>

			<div class="row" <?=(!$show_wet_a) ? 'style="display:none;"' : ''?>>
				<div class="col-xl-12 col-12">
					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="box">
								<div class="box-header with-border">
									<h4 class="box-title">List Loading WET A</h4>
								</div>
								<div class="box-body">
									<table class="table table-bordered table-hover" id="table_list_loading_wet_a">
										<thead>
											<tr>
												<th>No</th>
												<th>Line</th>
												<th>Shift</th>
												<!-- <th>Tanggal Produksi</th> -->
												<th>No WO</th>
												<th>Item</th>
												<th>Qty</th>
												<?=($action_delete) ? '<th>Action</th>' : ''?>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach($list_loading_wet_a as $list_a){ ?>
												<tr>
													<td><?= $no++ ?></td>
													<td>WET A</td>
													<td><?= $list_a['shift'] ?></td>
													<!-- <td><?= $list_a['tanggal_loading'] ?></td> -->
													<td><?= $list_a['no_wo'] ?></td>
													<td><?= $list_a['part_number'] ?></td>
													<td><?= $list_a['qty'] ?></td>
													<?php if ($action_delete) { ?>
														<td>
															<a href="<?= base_url() ?>wet_loading_new/list_loading/delete_list_wo/<?= $list_a['id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
														</td>
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
			</div>

			<div class="row" <?=(!$show_wet_f) ? 'style="display:none;"' : ''?>>
				<div class="col-xl-12 col-12">
					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="box">
								<div class="box-header with-border">
									<h4 class="box-title">List Loading WET F</h4>
								</div>
								<div class="box-body">
									<table class="table table-bordered table-hover" id="table_list_loading_wet_f">
										<thead>
											<tr>
												<th>No</th>
												<th>Line</th>
												<th>Shift</th>
												<!-- <th>Tanggal Produksi</th> -->
												<th>No WO</th>
												<th>Item</th>
												<th>Qty</th>
												<?=($action_delete) ? '<th>Action</th>' : ''?>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach($list_loading_wet_f as $list_f){ ?>
												<tr>
													<td><?= $no++ ?></td>
													<td>WET F</td>
													<td><?= $list_f['shift'] ?></td>
													<!-- <td><?= $list_f['tanggal_loading'] ?></td> -->
													<td><?= $list_f['no_wo'] ?></td>
													<td><?= $list_f['part_number'] ?></td>
													<td><?= $list_f['qty'] ?></td>
													<?php if ($action_delete) { ?>
														<td>
															<a href="<?= base_url() ?>wet_loading_new/list_loading/delete_list_wo/<?= $list_f['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
														</td>
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
		
	});

	function add_wo()
	{
		$('#section_wo_main').append(`
			<div class="item_wo" style="display:flex; margin-top:10px;">
				<select name="wo[]" id="" class="form-control select2" style="width: 500px;">
					<option value="" selected disabled>Pilih Data</option>
					<?php foreach($list_wo as $wo){ ?>
						<option value="<?= $wo['PDNO'].'|'.$wo['ITEM'].'|'.$wo['QTY'] ?>"><?= $wo['PDNO'].' | '.$wo['ITEM'].' | '.$wo['QTY'] ?></option>
					<?php } ?>
				</select>
				&emsp;
				<button class="btn btn-danger btn-sm" onclick="remove_wo(this)"><i class="fa fa-minus"></i></button>
			</div>
		`);
		$('.select2').select2();
	}

	function remove_wo(button)
	{
		$(button).closest('.item_wo').remove();
	}

	function filter_date()
	{
		var filter_tanggal = $('#filter_tanggal').val();
		window.location.href = "<?= base_url() ?>wet_loading_new/list_loading/"+filter_tanggal;
	}
</script>
<?= $this->endSection(); ?>