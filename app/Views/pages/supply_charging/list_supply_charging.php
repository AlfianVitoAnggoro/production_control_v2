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
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 class="box-title">Supply Component Charging</h4>
                                        </div>
                                        <div class="col-6" style="float:right; display:flex;">
                                            <input type="date" class="form-control" name="filter_tanggal" id="filter_tanggal" style="width: 200px;" value="<?=$tanggal?>">
                                            &emsp;
                                            <select class="form-select" name="filter_sesi" id="filter_sesi" style="width: 250px;">
                                                <option value="" disabled>Pilih Sesi</option>
                                                <option value="1" <?=($sesi == '1') ? 'selected':''?>>08.00 - 09.00</option>
                                                <option value="2" <?=($sesi == '2') ? 'selected':''?>>10.00 - 11.00</option>
                                                <option value="3" <?=($sesi == '3') ? 'selected':''?>>13.00 - 14.00</option>
                                                <option value="4" <?=($sesi == '4') ? 'selected':''?>>15.00 - 16.00</option>
                                                <option value="5" <?=($sesi == '5') ? 'selected':''?>>17.00 - 18.00</option>
                                                <option value="6" <?=($sesi == '6') ? 'selected':''?>>20.00 - 21.00</option>
                                                <option value="7" <?=($sesi == '7') ? 'selected':''?>>22.00 - 23.00</option>
                                                <option value="8" <?=($sesi == '8') ? 'selected':''?>>01.00 - 02.00</option>
                                                <option value="9" <?=($sesi == '9') ? 'selected':''?>>03.00 - 04.00</option>
                                                <option value="10" <?=($sesi == '10') ? 'selected':''?>>05.00 - 06.00</option>
                                            </select>
                                        </div>
                                    </div>
								</div>
								<div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table_supply">
                                            <thead>
                                                <tr>
                                                    <th>No WO</th>
                                                    <th>Estimated Finishing</th>
                                                    <th>Part Number</th>
                                                    <th>Qty</th>
                                                    <th>Lokasi</th>
                                                    <th>Prepare</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($data_loading as $item) { ?>
                                                    <tr>
                                                        <td><?=$item['no_wo']?></td>
                                                        <td><?=$item['part_number']?></td>
                                                        <td><?=$item['qty']?></td>
                                                        <td><?=($item['tujuan'] == '8') ? 'WET A' : 'WET F'?></td>
                                                        <td><?=date('Y-m-d H:i', strtotime($item['start_charging']))?></td>
                                                        <td><?=date('Y-m-d H:i', strtotime($item['estimasi_finish']))?></td>
                                                        <td></td>
                                                        <td><button class="btn btn-primary" onclick="get_detail_component('<?=$item['no_wo']?>')">Detail</button></td>
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

    <!-- MODAL -->
    <div class="modal fade" id="main_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:120%;">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Detail Component Supply</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?=base_url()?>supply_charging/add_detail_supply_charging" method="POST">
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Part Number</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="detail_component">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer" style="float: right;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  <!-- /.content-wrapper -->
  <?= $this->endSection(); ?>

  <?= $this->section('script'); ?>
  <script>
    $(document).ready(function() {
        $('#table_supply').DataTable();
    });

    function get_detail_component(no_wo) {
        $.ajax({
            url: '<?=base_url()?>/supply_charging/get_component_by_wo',
            type: 'POST',
            data: {
                no_wo: no_wo
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(data);
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    html += '<tr>';
                    html += `<td>${data[i].PART_COMPONENT} <input type="hidden" name="part_component[]" value="${data[i].PART_COMPONENT}"> <input type="hidden" name="no_wo[]" value="${no_wo}"> </td>`;
                    html += `<td>${data[i].QTY} <input type="hidden" name="qty[]" value="${data[i].QTY}"> </td>`;
                    html += `<td><input type="checkbox" id="status_${data[i].PART_COMPONENT}" name="status[]" value="1" ${(data[i].status !== 'undefined' && data[i].status == '1') ? 'checked' : ''}> <label for="status_${data[i].PART_COMPONENT}"></label></td>`;
                    html += '</tr>';
                }
                $('#detail_component').html(html);
                $('#main_modal').modal('show');
            }
        });
    }
  </script>
  <?= $this->endSection(); ?>