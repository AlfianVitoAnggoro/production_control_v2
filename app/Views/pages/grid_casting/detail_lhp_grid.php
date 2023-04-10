<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?php 
// var_dump($data_detail_breakdown);die;
$mh = [8, 7.5, 6.5];
?>
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<form action="<?=base_url()?>grid/update_lhp" method="post">
				<input type="hidden" name="id_lhp" id="id_lhp" value="<?=$id_lhp?>">
				<div class="box">
					<div class="box-header with-border">
						<h4>Detail Laporan Harian Produksi</h4>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">Tanggal Produksi</label>
									<input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi" value="<?=$data_lhp[0]['date_production']?>" readonly>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">Line</label>
									<input type="text" class="form-control" name="line" id="line" value="<?=$data_lhp[0]['line']?>" readonly>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">Shift</label>
									<input type="text" class="form-control" name="shift" id="shift" value="<?=$data_lhp[0]['shift']?>" readonly>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">Kasubsie</label>
									<input type="text" class="form-control" id="grup" name="grup" value="<?=$data_lhp[0]['kasubsie']?>" readonly>
								</div>
							</div>
						</div>
						<div class="row">
                            <div class="col-3">
								<div class="form-group">
									<label class="form-label">Grup</label>
									<input type="text" class="form-control" id="grup" name="grup" value="<?=$data_lhp[0]['grup']?>" readonly>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">MP</label>
									<input type="number" class="form-control" id="mp" name="mp" value="<?=$data_lhp[0]['mp']?>" readonly>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">Absen</label>
									<input type="number" class="form-control" id="absen" name="absen" value="<?=$data_lhp[0]['absen']?>" readonly>
								</div>
							</div>
							<div class="col-3">
								<div class="form-group">
									<label class="form-label">Cuti</label>
									<input type="number" class="form-control" id="cuti" name="cuti" value="<?=$data_lhp[0]['cuti']?>" readonly>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-12 col-12">
						<div class="box">
							<div class="box-body">
								<div class="table-responsive">
									<table id="" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>Nama Mesin</th>
												<th>Nama Operator</th>
												<th>Type Grid</th>
												<th>JKS (Panel)</th>
												<th>Aktual (Panel)</th>
                                                <th>Persentase (%)</th>
                                                <!-- <th>Jumlah Rak</th> -->
                                                <!-- <th>Detail Rak</th> -->
                                                <th>MH</th>
                                                <th>Productivity (Panel/MH)</th>
                                                <!-- <th>Action</th> -->
											</tr>
										</thead>
										<tbody id="tbody">
											<?php
                                                $model = new App\Models\M_Grid();

                                                foreach ($data_mesin as $d_mesin) {
                                                    $data_detail_lhp = $model->get_detail_lhp_by_id($id_lhp, $d_mesin['nama_mesin']);
                                                    if(!empty($data_detail_lhp)){
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <input type="hidden" name="id_detail_lhp_grid[]" value="<?=$data_detail_lhp[0]['id']?>">
                                                                <input type="hidden" name="no_machine[]" id="no_machine_<?=$d_mesin['nama_mesin']?>" value="<?=$d_mesin['nama_mesin']?>" readonly>
                                                                MC <?=$d_mesin['nama_mesin']?>
                                                                <input type="hidden" name="type_mesin[]" id="type_mesin_<?=$d_mesin['nama_mesin']?>" value="<?=$d_mesin['type_mesin']?>">
                                                            </td>
                                                            <td>
                                                                <select name="nama_operator[]" id="nama_operator_<?=$d_mesin['nama_mesin']?>" class="form-select select2" style="width: 200px">
                                                                    <option value="">-- Pilih Operator --</option>
                                                                    <?php
                                                                        foreach ($data_operator as $d_operator) {
                                                                            ?>
                                                                            <option value="<?=$d_operator['seluruh_anggota']?>" <?php if($d_operator['seluruh_anggota'] == $data_detail_lhp[0]['operator_name']){echo "selected";} ?>><?=$d_operator['seluruh_anggota']?></option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select name="type_grid[]" id="type_grid_<?=$d_mesin['nama_mesin']?>" class="form-select select2" onchange="get_jks(<?=$d_mesin['nama_mesin']?>)" style="width: 200px">
                                                                    <option value="">-- Pilih Type Grid --</option>
                                                                    <?php
                                                                        foreach ($data_type_grid as $d_type_grid) {
                                                                            ?>
                                                                            <option value="<?=$d_type_grid['id_grid']?>" <?php if($d_type_grid['id_grid'] == $data_detail_lhp[0]['type_grid']){echo "selected";} ?>><?=$d_type_grid['type_grid']?></option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="jks[]" id="jks_<?=$d_mesin['nama_mesin']?>" class="form-control" value="<?=$data_detail_lhp[0]['jks']?>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="aktual[]" id="aktual_<?=$d_mesin['nama_mesin']?>" class="form-control" value="<?=$data_detail_lhp[0]['actual']?>" onkeyup="count_persentase(<?=$d_mesin['nama_mesin']?>)"> 
                                                            </td>
                                                            <td>
                                                                <input type="number" name="persentase[]" id="persentase_<?=$d_mesin['nama_mesin']?>" class="form-control" value="<?=number_format($data_detail_lhp[0]['persentase'])?>" readonly>
                                                            </td>
                                                            <!-- <td>
                                                                <input type="text" name="rak[]" id="jumlah_rak_<?=$d_mesin['nama_mesin']?>" class="form-control" value="" style="width: 75px" readonly>
                                                            </td> -->
                                                            <!-- <td>
                                                                <a href="#" class="btn btn-info btn-sm detail-btn" data-id_lhp="<?=$id_lhp?>" data-id_detail_lhp="<?=$data_detail_lhp[0]['id']?>">Detail</a>
                                                            </td> -->
                                                            <td>
                                                                <input type="text" name="mh[]" id="mh_<?=$d_mesin['nama_mesin']?>" class="form-control" value="<?= $data_detail_lhp[0]['mh'] === "" ? $data_detail_lhp[0]['mh'] : $mh[$data_lhp[0]['shift']-1]; ?>" style="width: 75px" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="productivity[]" id="productivity_<?=$d_mesin['nama_mesin']?>" class="form-control" value="<?=$data_detail_lhp[0]['productivity']?>" readonly>
                                                            </td>
                                                            <!-- <td>
                                                                <button type="button" class="btn btn-sm btn-primary" onclick="add_breakdown(<?=$d_mesin['nama_mesin']?>)">Add</button>
                                                            </td> -->
                                                        </tr>
                                                        <?php
                                                    } else {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <input type="hidden" name="id_detail_lhp_grid[]" id="id_detail_lhp_grid_<?=$d_mesin['nama_mesin']?>" value="">
                                                            <input type="hidden" name="no_machine[]" id="no_machine_<?=$d_mesin['nama_mesin']?>" value="<?=$d_mesin['nama_mesin']?>" readonly>
                                                            MC <?=$d_mesin['nama_mesin']?>
                                                            <input type="hidden" name="type_mesin[]" id="type_mesin_<?=$d_mesin['nama_mesin']?>" value="<?=$d_mesin['type_mesin']?>">
                                                        </td>
                                                        <td>
                                                            <select name="nama_operator[]" id="nama_operator_<?=$d_mesin['nama_mesin']?>" class="form-select select2" style="width: 200px">
                                                                <option value="">-- Pilih Operator --</option>
                                                                <?php
                                                                    $pic_grup_mesin = $model->get_pic_grup_mesin($d_mesin['nama_mesin'], $data_lhp[0]['grup']);
                                                                    foreach ($data_operator as $d_operator) {
                                                                        ?>
                                                                        <option value="<?=$d_operator['seluruh_anggota']?>" <?php if($d_operator['seluruh_anggota'] == $pic_grup_mesin[0]['pic']){echo "selected";} ?>><?=$d_operator['seluruh_anggota']?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="type_grid[]" id="type_grid_<?=$d_mesin['nama_mesin']?>" class="form-select select2" onchange="get_jks(<?=$d_mesin['nama_mesin']?>)" style="width: 200px">
                                                                <option value="">-- Pilih Type Grid --</option>
                                                                <?php
                                                                    foreach ($data_type_grid as $d_type_grid) {
                                                                        ?>
                                                                        <option value="<?=$d_type_grid['id_grid']?>"><?=$d_type_grid['type_grid']?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td><input type="text" class="form-control" name="jks[]" id="jks_<?=$d_mesin['nama_mesin']?>" readonly></td>
                                                        <td><input type="text" class="form-control" name="aktual[]" id="aktual_<?=$d_mesin['nama_mesin']?>" onkeyup="count_persentase(<?=$d_mesin['nama_mesin']?>)"></td>
                                                        <td><input type="text" class="form-control" name="persentase[]" id="persentase_<?=$d_mesin['nama_mesin']?>" readonly></td>
                                                        <td><input type="text" class="form-control" name="rak[]" id="rak_<?=$d_mesin['nama_mesin']?>" style="width: 75px"></td>
                                                        <td><input type="text" class="form-control" name="mh[]" id="mh_<?=$d_mesin['nama_mesin']?>" value="<?= $mh[$data_lhp[0]['shift']-1]; ?>" style="width: 75px" readonly></td>
                                                        <td><input type="text" class="form-control" name="productivity[]" id="productivity_<?=$d_mesin['nama_mesin']?>" readonly></td>
                                                    </tr>
                                            <?php
                                                    }
                                                }
                                            ?>
										</tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"><h3>Total</h3></td>
                                                <td style="text-align: right;"><input type="text" class="form-control" name="total_jks" id="" value="<?=str_replace(',', '.', number_format($data_lhp[0]['total_jks']))?>" readonly></td>
                                                <td style="text-align: right;"><input type="text" class="form-control" name="total_actual" id="" value="<?=str_replace(',', '.', number_format($data_lhp[0]['total_aktual']))?>" readonly></td>
                                                <td style="text-align: right;"><input type="text" class="form-control" name="total_presentase" id="" value="<?= $retVal = (!empty($data_lhp[0]['total_aktual'])) ? number_format(($data_lhp[0]['total_aktual']/$data_lhp[0]['total_jks'])*100) : 0 ;?>" readonly></td>
                                                <td style="text-align: right;"><input type="text" class="form-control" name="total_mh" id="" value="<?= $retVal = (!empty($data_lhp[0]['total_mh'])) ? $data_lhp[0]['total_mh'] : 0 ;?>" style="width: 75px" readonly></td>
                                                <td style="text-align: right;"><input type="text" class="form-control" name="total_productivity" id="" value="<?= $retVal = (!empty($data_lhp[0]['total_productivity'])) ? str_replace(',', '.', number_format($data_lhp[0]['total_productivity'])) : 0 ;?>" readonly></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
									</table>
								</div>
								
							</div>
							<!-- <div class="box-footer" style="text-align: center;"> -->
                                <!-- <input type="submit" class="btn btn-success" value="Save"> -->
							<!-- </div> -->
						</div>				
					</div>
				</div>

                <div class="row">
					<div class="col-xl-12 col-12">
						<div class="box">
                            <div class="box-header">
                                <button type="button" class="btn btn-primary" onclick="get_data_andon()">Refresh Andon</button>
                            </div>
							<div class="box-body">
								<div class="table-responsive">
									<table id="data_andon" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>Nama Mesin</th>
												<th>Permasalahan</th>
												<th>Tujuan</th>
                                                <th>Total Menit</th>
											</tr>
										</thead>
										<tbody id="tbody_data_andon">
											<?php
                                                foreach ($data_andon as $d_andon) {
                                                    ?>
                                                    <tr>
                                                        <td>MC <?=$d_andon['no_machine']?></td>
                                                        <td><?=$d_andon['permasalahan']?></td>
                                                        <td><?=$d_andon['tujuan']?></td>
                                                        <td><?=$d_andon['total_menit']?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
										</tbody>
									</table>
								</div>
								
							</div>
							<div class="box-footer" style="text-align: center;">
								<!-- <input type="submit" class="btn btn-success" value="Save"> -->
							</div>
						</div>				
					</div>
				</div>

                <div class="row">
					<div class="col-xl-12 col-12">
						<div class="box">
                            <div class="box-header">
                                <button type="button" class="btn btn-primary" onclick="add_breakdown()">Add</button>
                            </div>
							<div class="box-body">
								<div class="table-responsive">
									<table id="data_line_stop" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>Nama Mesin</th>
												<!-- <th>Jenis Line Stop</th> -->
												<!-- <th>Kategori Line Stop</th> -->
                                                <th>Uraian Line Stop</th>
                                                <th>Total Menit</th>
                                                <th>Action</th>
											</tr>
										</thead>
										<tbody id="tbody_data_line_stop">
											<?php
                                                foreach ($data_breakdown as $d_breakdown) { ?>
                                                    <tr>
                                                        <td>
                                                            <select name="nama_mesin_breakdown[]" class="form-select select2" style="width: 150px">
                                                                <option value="">-- Pilih Mesin --</option>
                                                                <?php
                                                                    foreach ($data_mesin as $d_mesin) { ?>
                                                                        <option value="<?=$d_mesin['nama_mesin']?>" <?php if($d_mesin['nama_mesin'] == $d_breakdown['no_machine']) { echo "selected"; } ?>>MC <?=$d_mesin['nama_mesin']?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                            <input type="hidden" name="id_detail_lhp_grid_breakdown[]" value="<?=$d_breakdown['id_breakdown_grid']?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="uraian_breakdown_grid[]" id="uraian_breakdown_grid_<?=$d_breakdown['no_machine']?>" value="<?=$d_breakdown['uraian_breakdown']?>" style="width: 300px">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="total_menit_breakdown_grid[]" id="total_menit_breakdown_grid_<?=$d_breakdown['no_machine']?>" class="form-control" value="<?=$d_breakdown['total_menit']?>" style="width: 75px">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="delete_breakdown(this)">Delete</button>
                                                        </td>
                                                    </tr>                                                    
                                            <?php
                                                }
                                            ?>
										</tbody>
									</table>
								</div>
								
							</div>
							<div class="box-footer" style="text-align: center;">
								<!-- <input type="submit" class="btn btn-success" value="Save"> -->
							</div>
						</div>				
					</div>
				</div>

                <div class="row">
					<div class="col-xl-12 col-12">
						<div class="box">
                            <div class="box-header">
                                <h4>Detail Rak</h4>
                                <br>
                                <table class="table">
                                    <tr>
                                        <td>
                                           Barcode  <input type="text" class="form-control" name="start_barcode" id="start_barcode" onchange="get_qty_rak()" class="form-control">
                                        </td>
                                        <td>
                                            Qty <input type="text" class="form-control" name="start_qty" id="start_qty" class="form-control" readonly>
                                        </td>
                                        <td>
                                            QR Code Rak<input type="text" class="form-control" name="start_rak" id="start_rak" class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="add_rak()">Add</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
							<div class="box-body">
								<div class="table-responsive">
									<table id="data_line_stop" class="table table-striped mb-0">
										<thead>
											<tr>
												<th>Barcode</th>
                                                <th>QTY</th>
                                                <th>ID Rak</th>
                                                <th>Action</th>
											</tr>
										</thead>
										<tbody id="tbody_data_rak">
											<?php foreach ($data_all_rak as $d_rak) { ?>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control" name="barcode_rak[]" id="barcode_rak_<?=$d_rak['id']?>" value="<?=$d_rak['barcode']?>" readonly>
                                                        <input type="hidden" class="form-control" name="id_rak_barcode[]" id="id_rak_barcode_<?=$d_rak['id']?>" value="<?=$d_rak['id']?>" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="qty_rak[]" id="qty_rak_<?=$d_rak['id']?>" value="<?=$d_rak['qty']?>" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="id_rak[]" id="id_rak_<?=$d_rak['id']?>" value="<?=$d_rak['id_rak']?>" readonly>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" onclick="delete__detail_rak(this)">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
										</tbody>
									</table>
								</div>
								
							</div>
							<div class="box-footer" style="text-align: center;">
								<!-- <input type="submit" class="btn btn-success" value="Save"> -->
							</div>
						</div>				
					</div>
				</div>

				<div class="row">
					<div class="col-4"></div>
					<div class="col-4" style="text-align:center;"><input type="submit" class="btn btn-success" value="Save"></div>
					<div class="col-4"></div>
				</div>
                <div class="d-flex justify-content-end" style="margin-right: 50px">
                    <table class="table table-bordered" style="width: 400px;">
                        <thead>
                            <th class="text-center">Disetujui</th>
                            <th class="text-center">Dibuat</th>
                        </thead>
                        <tbody>
                            <td>
                                <div class="form-check text-center p-0">
                                    <?php if ($data_lhp[0]['status'] !== 'approved') { ?>
                                        <button type="submit" class="btn btn-outline-primary" name="approved" value="approved" onclick="return confirm('Apakah Anda Yakin?')" disabled>✔</button>
                                    <?php } else { ?>
                                        <button class="btn btn-primary" disabled>✔</button>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-check text-center p-0">
                                    <?php if ($data_lhp[0]['status'] !== 'completed' && $data_lhp[0]['status'] !== 'approved') { ?>
                                        <button type="submit" class="btn btn-outline-primary" name="completed" value="approved" onclick="return confirm('Apakah Anda Yakin?')" disabled>✔</button>
                                    <?php } else { ?>
                                        <button class="btn btn-primary" disabled>✔</button>
                                    <?php } ?>
                                </div>
                            </td>
                        </tbody>
                        <tfoot>
                            <th class="text-center">KASIE</th>
                            <th class="text-center">GL/ KSS</th>
                        </tfoot>
                    </table>
                </div>
			</form>
		</section>
		<!-- /.content -->
	  </div>
	</div>
	<!-- /.content-wrapper -->

    <!-- Modal -->
    <div class="modal fade modal_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Tambah Rak</h4>
                    <!-- <button type="button" class="btn btn-primary" onclick="add_detail_rak()"><i class="fa fa-plus"></i></button> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?=base_url()?>grid/add_rak" method="post">
                    <input type="hidden" name="detail_rak_id_lhp" id="detail_rak_id_lhp">
                    <input type="hidden" name="detail_rak_id_detail_lhp" id="detail_rak_id_detail_lhp">

                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Qty</th>
                                        <th>Rak</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody id="tbody_rak">
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="barcode[]" id="barcode_1" onchange="get_qty_rak(1)" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="qty[]" id="qty_1" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="id_rak[]" id="id_rak_1" class="form-control">
                                        </td>
                                        <!-- <td>
                                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
                                        </td> -->
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="barcode[]" id="barcode_2" onchange="get_qty_rak(2)" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="qty[]" id="qty_2" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="id_rak[]" id="id_rak_2" class="form-control">
                                        </td>
                                        <!-- <td>
                                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
                                        </td> -->
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="barcode[]" id="barcode_3" onchange="get_qty_rak(3)" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="qty[]" id="qty_3" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="id_rak[]" id="id_rak_3" class="form-control">
                                        </td>
                                        <!-- <td>
                                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
                                        </td> -->
                                    </tr>
                                </tbody>

                            </table>
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

    <!-- Modal Scan -->
    <!-- <div class="modal fade modal_scan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Tambah Rak</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="qr-reader" style="width:500px"></div>
                    <div id="qr-reader-results"></div>
                </div>
            </div>
        </div>>
    </div> -->
    <!-- /.modal -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        let baris = <?= count($data_mesin) ?>;
        for(let i = 1; i <= baris; i++) {
            var jks = $('#jks_'+i).val();
            var aktual = $('#aktual_'+i).val();
            var productivity = $('#productivity_'+i).val();
            var mh = $('#mh_'+i).val();
            
            var persentase = (aktual/jks)*100;

            if (jks === '' || jks === null && (aktual === '' || aktual === null)) {
                persentase = 0;
            }

            
            var productivity = (aktual/mh)

            $('#persentase_'+i).val(persentase.toFixed(0));
            $('#productivity_'+i).val(productivity.toFixed(0));
        }

        $('input[type="number"]').each(function() {
			if ($(this).val() == 0) {
			$(this).val('');
			}
		});
    });

</script>

<script>
    $(document).ready(function() {
        $('.detail-btn').on('click', function() {
				// Get data attributes from button
				var id_lhp = $(this).data('id_lhp');
				var id_detail_lhp = $(this).data('id_detail_lhp');

                // Set data attributes to modal
                $('#detail_rak_id_lhp').val(id_lhp);
                $('#detail_rak_id_detail_lhp').val(id_detail_lhp);
                $('.modal_detail').modal('show');
        });
    })
    <?php if($session <= 2) { ?>
        const approvedElement = document.querySelector('#approved');
        approvedElement.removeAttribute('disabled');
    <?php } ?>
    <?php if($session <= 4) { ?>
        const completedElement = document.querySelector('#completed');
        completedElement.removeAttribute('disabled');
    <?php } ?>
	function get_jks(i) {
        var type_grid = $('#type_grid_'+i).val();
        var type_mesin = $('#type_mesin_'+i).val();
        var shift = $('#shift').val();

        $.ajax({
            url: '<?=base_url()?>grid/get_jks',
			type: 'POST',
			data: {
                type_grid: type_grid,
                type_mesin: type_mesin,
                shift: shift
            },
			dataType: 'json',
            success: function(data) {
                $('#jks_'+i).val(data[0].jks);
            }
        })
    }

    function count_persentase(i) {
        var jks = $('#jks_'+i).val();
        var aktual = $('#aktual_'+i).val();
        var productivity = $('#productivity_'+i).val();
        var mh = $('#mh_'+i).val();

        var persentase = (aktual/jks)*100;
        var productivity = (aktual/mh)

        $('#persentase_'+i).val(persentase.toFixed(0));
        $('#productivity_'+i).val(productivity.toFixed(0));
    }

    function get_data_andon() {
        var shift = $('#shift').val();
        var tanggal = $('#tanggal_produksi').val();

        $.ajax({
            url: '<?=base_url()?>grid/get_data_andon',
            type: 'POST',
            data: {
                shift: shift,
                tanggal: tanggal
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.length > 0) {
                    var html = '';
                    var no = 1;
                    for (var i = 0; i < data.length; i++) {
                        html += `<tr>
                                    <td>
                                        ${data[i].nama_mesin}
                                        <input type="hidden" name="no_machine_andon[]" value="${data[i].nama_mesin.substring(3)}">
                                        <input type="hidden" name="tiket_andon[]" value="${data[i].id_ticket}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="permasalahan_andon[]" id="permasalahan_${no}" class="form-control" value="${data[i].permasalahan.substring(8)}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="tujuan_andon[]" id="tujuan_${no}" class="form-control" value="${data[i].tujuan}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="total_menit_andon[]" id="total_menit_${no}" class="form-control" value="${data[i].total_min}">
                                    </td>
                                </tr>`;
                        no++;
                    }
                    $('#tbody_data_andon').html(html);
                } else {
                    alert('Tidak Ada Andon');
                }
            }
        })
    }

    function add_breakdown() {
        var data_mesin = <?=json_encode($data_mesin)?>;
        $('#tbody_data_line_stop').append(`
            <tr>
                <td>
                    <select name="nama_mesin_breakdown[]" id="nama_mesin" class="form-select select2" style="width: 150px">
                        <option value="">-- Pilih Mesin --</option>
                        ${data_mesin.map((item) => {
                            return `<option value="${item.nama_mesin}">MC ${item.nama_mesin}</option>`
                        })}
                    </select>
                    <input type="hidden" name="id_detail_lhp_grid_breakdown[]">
                </td>
                <td>
                    <input type="text" class="form-control" name="uraian_breakdown_grid[]" id="uraian_breakdown_grid" class="form-control" style="width: 300px">
                </td>
                <td>
                    <input type="text" class="form-control" name="total_menit_breakdown_grid[]" id="total_menit_breakdown_grid" class="form-control" style="width: 75px">
                </td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="delete_breakdown(this)">Delete</button>
                </td>
            </tr>
        `);

        $('.select2').select2();
    }

    function delete_breakdown(e) {
        $(e).parent().parent().remove();
    }

    function get_qty_rak() {
        var barcode = $('#start_barcode').val();

        $.ajax({
            url: '<?=base_url()?>grid/get_qty_rak',
            type: 'POST',
            data: {
                barcode: barcode
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#start_qty').val(data[0].QTY);
                $('#start_rak').focus();
            }
        })
    }

    function add_rak() {
        var barcode = $('#start_barcode').val();
        var qty = $('#start_qty').val();
        var rak = $('#start_rak').val();



        $('#tbody_data_rak').append(`
            <tr>
                <td>
                    <input type="text" class="form-control" name="barcode_rak[]" id="" class="form-control" value="${barcode}">
                    <input type="hidden" class="form-control" name="id_rak_barcode[]" id="" class="form-control" value="">
                </td>
                <td>
                    <input type="text" class="form-control" name="qty_rak[]" id="" class="form-control" value="${qty}">
                </td>
                <td>
                    <input type="text" class="form-control" name="id_rak[]" id="" class="form-control" value="${rak}">
                </td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
                </td>
            </tr>
        `);

        $('#start_barcode').val('');
        $('#start_qty').val('');
        $('#start_rak').val('');
    }


    // function get_qty_rak(i) {
    //     // var id_lhp = $('#detail_rak_id_lhp').val();
    //     // var id_detail_lhp = $('#detail_rak_id_detail_lhp').val();

    //     var barcode = $('#barcode_'+i).val();

    //     $.ajax({
    //         url: '<?=base_url()?>grid/get_qty_rak',
    //         type: 'POST',
    //         data: {
    //             barcode: barcode
    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //             console.log(data);
    //             $('#qty_'+i).val(data[0].QTY);
    //             // if (data.length > 0) {
    //             //     var html = '';
    //             //     var no = 1;
    //             //     for (var i = 0; i < data.length; i++) {
    //             //         html += `<tr>
    //             //                     <td>
    //             //                         <input type="text" class="form-control" name="barcode[]" id="" class="form-control" value="${data[i].barcode}">
    //             //                     </td>
    //             //                     <td>
    //             //                         <input type="text" class="form-control" name="qty[]" id="" class="form-control" value="${data[i].qty}">
    //             //                     </td>
    //             //                     <td>
    //             //                         <input type="text" class="form-control" name="id_rak[]" id="" class="form-control" value="${data[i].id_rak}">
    //             //                     </td>
    //             //                     <td>
    //             //                         <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
    //             //                     </td>
    //             //                 </tr>`;
    //             //         no++;
    //             //     }
    //             //     $('#tbody_rak').html(html);
    //             // } else {
    //             //     alert('Tidak Ada Rak');
    //             // }
    //         }
    //     })
    // }

    function add_detail_rak() {
        $('#tbody_rak').append(`
            <tr>
                <td>
                    <input type="text" class="form-control" name="barcode[]" id="" class="form-control" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="qty[]" id="" class="form-control" readonly>
                </td>
                <td>
                    <input type="text" class="form-control" name="id_rak[]" id="" class="form-control" readonly>
                </td>
                
            </tr>
        `);

        // <td>
        //     <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
        // </td>
    }

    function delete_detail_rak(e) {
        $(e).parent().parent().remove();
    }

    function scan() {
        $('.modal_scan').modal('show');
    }
</script>
<?= $this->endSection(); ?>