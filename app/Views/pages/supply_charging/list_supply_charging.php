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
                                                <option value="all" <?=($sesi == 'all') ? 'selected':''?>>All</option>
                                                <option value="2" <?=($sesi == '2') ? 'selected':''?>>08.00 - 09.00</option>
                                                <option value="3" <?=($sesi == '3') ? 'selected':''?>>10.00 - 11.00</option>
                                                <option value="4" <?=($sesi == '4') ? 'selected':''?>>13.00 - 14.00</option>
                                                <option value="5" <?=($sesi == '5') ? 'selected':''?>>15.00 - 16.00</option>
                                                <option value="6" <?=($sesi == '6') ? 'selected':''?>>17.00 - 18.00</option>
                                                <option value="7" <?=($sesi == '7') ? 'selected':''?>>20.00 - 21.00</option>
                                                <option value="8" <?=($sesi == '8') ? 'selected':''?>>22.00 - 23.00</option>
                                                <option value="9" <?=($sesi == '9') ? 'selected':''?>>01.00 - 02.00</option>
                                                <option value="10" <?=($sesi == '10') ? 'selected':''?>>03.00 - 04.00</option>
                                                <option value="1" <?=($sesi == '1') ? 'selected':''?>>05.00 - 06.00</option>
                                            </select>
                                            &emsp;
                                            <select class="form-select" name="filter_line" id="filter_line" style="width: 250px;">
                                                <option value="all" <?=($line == 'all') ? 'selected':''?>>All</option>
                                                <option value="8" <?=($line == '8') ? 'selected':''?>>WET A</option>
                                                <option value="9" <?=($line == '9') ? 'selected':''?>>WET F</option>
                                            </select>
                                            &emsp;
                                            <button class="btn btn-primary" onclick="filter()">Filter</button>
                                            &nbsp;
                                            <button class="btn btn-secondary" onclick="clear_filter()">Clear</button>
                                        </div>
                                    </div>
								</div>
								<div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="table_supply">
                                            <thead>
                                                <tr>
                                                    <th>Estimated Finishing</th>
                                                    <th>No WO</th>
                                                    <th>Part Number</th>
                                                    <th>Lokasi</th>
                                                    <th>Qty</th>                                                    
                                                    <th>Item</th>
                                                    <!-- <th>Prepare Component</th> -->
                                                    <th>Supply Component</th>
                                                    <th>Status Supply</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $this->M_SupplyCharging = new App\Models\M_SupplyCharging; 
                                                    foreach($data_loading as $item) { 
                                                        $detail_component = $this->M_SupplyCharging->get_component_by_wo($item['no_wo']);
                                                        $array_component = array_values(array_filter($detail_component, function ($value) {
                                                            return !(strpos($value["PART_COMPONENT"], "PF") !== false || strpos($value["PART_COMPONENT"], "PALLET") !== false || strpos($value["PART_COMPONENT"], "ASSU") !== false || strpos($value["PART_COMPONENT"], "VECA") !== false);
                                                        }));                                                        
                                                    ?>
                                                    <tr>
                                                        <td rowspan="<?=count($array_component)?>"><?=date('d-m-Y H:i', strtotime($item['estimasi_finish']))?></td>
                                                        <td rowspan="<?=count($array_component)?>"><?=$item['no_wo']?></td>
                                                        <td rowspan="<?=count($array_component)?>"><?=$item['part_number']?></td>
                                                        <td rowspan="<?=count($array_component)?>"><?=($item['tujuan'] == '8') ? 'WET A' : 'WET F'?></td>
                                                        
                                                        
                                                        <td><?=$array_component[0]['QTY']?></td>
                                                        <td><?=$array_component[0]['PART_COMPONENT']?></td>
                                                        <!-- <td>
                                                            <?php $status_prepare = $this->M_SupplyCharging->get_status_prepare_component($item['no_wo'], $array_component[0]['PART_COMPONENT']); ?>
                                                            <input type="checkbox" id="status_<?=$item['no_wo']?>_<?=$array_component[0]['PART_COMPONENT']?>" name="status[]" value="1" <?=(!empty($status_prepare[0]['prepare_at'])) ? 'checked':''?> onclick="prepare_item('<?=$item['no_wo']?>', '<?=$array_component[0]['PART_COMPONENT']?>', <?=$array_component[0]['QTY']?>)"><label for="status_<?=$item['no_wo']?>_<?=$array_component[0]['PART_COMPONENT']?>"></label>
                                                        </td> -->
                                                        <td>
                                                            <?php $status_supply = $this->M_SupplyCharging->get_status_prepare_component($item['no_wo'], $array_component[0]['PART_COMPONENT']); ?>
                                                            <input type="checkbox" id="status_supply_<?=$item['no_wo']?>_<?=$array_component[0]['PART_COMPONENT']?>" name="status_supply[]" value="1" <?=(!empty($status_supply[0]['supply_at'])) ? 'checked':''?> onclick="supply_item('<?=$item['no_wo']?>', '<?=$array_component[0]['PART_COMPONENT']?>', <?=$array_component[0]['QTY']?>)"><label for="status_supply_<?=$item['no_wo']?>_<?=$array_component[0]['PART_COMPONENT']?>"></label>
                                                            <div id="section_supply_<?=$item['no_wo']?>_<?=$array_component[0]['PART_COMPONENT']?>" style="display:contents">
                                                                <?php if (!empty($status_supply[0]['supply_at'])) { 
                                                                    echo date('H:i', strtotime($status_supply[0]['supply_at']));
                                                                    } ?>
                                                            </div>
                                                            <!-- <button class="btn btn-primary">Scan</button> -->
                                                        </td>
                                                        <td rowspan="<?=count($array_component)?>">
                                                            <!-- <button class="btn btn-primary" onclick="get_detail_component('<?=$item['no_wo']?>')">Detail</button> -->
                                                            <?php
                                                                $detail_component = $this->M_SupplyCharging->get_detail_supply_charging($item['no_wo']);
                                                            ?>
                                                                <input type="hidden" id="jumlah_component_<?=$item['no_wo']?>" value="<?=count($array_component)?>">
                                                                <input type="hidden" id="jumlah_supply_<?=$item['no_wo']?>" value="<?=count($detail_component)?>">
                                                                <div id="section_status_supply_<?=$item['no_wo']?>">
                                                                    <?php 
                                                                    $status_supply = $this->M_SupplyCharging->get_data_loading_by_wo($item['no_wo']); 
                                                                    if ($status_supply[0]['status'] == 'open') { ?>
                                                                        <span class="badge badge-xl badge-danger">Not Complete</span>
                                                                    <?php } else { ?>
                                                                        <span class="badge badge-xl badge-success">Complete</span>
                                                                    <?php } ?>
                                                                </div>
                                                        </td>
                                                    </tr>
                                                        <?php for ($i=1; $i < count($array_component); $i++) { ?>
                                                            <tr>
                                                                <td><?=$array_component[$i]['QTY']?></td>
                                                                <td><?=$array_component[$i]['PART_COMPONENT']?></td>
                                                                <!-- <td>
                                                                    <?php $status_prepare = $this->M_SupplyCharging->get_status_prepare_component($item['no_wo'], $array_component[$i]['PART_COMPONENT']); ?>
                                                                    <input type="checkbox" id="status_<?=$item['no_wo']?>_<?=$array_component[$i]['PART_COMPONENT']?>" name="status[]" value="1" <?=(!empty($status_prepare[0]['prepare_at'])) ? 'checked':''?> onclick="prepare_item('<?=$item['no_wo']?>', '<?=$array_component[$i]['PART_COMPONENT']?>', <?=$array_component[$i]['QTY']?>)"><label for="status_<?=$item['no_wo']?>_<?=$array_component[$i]['PART_COMPONENT']?>"></label>
                                                                    <div id="section_<?=$item['no_wo']?>_<?=$array_component[$i]['PART_COMPONENT']?>" style="display:contents">
                                                                        <?php if (!empty($status_prepare[0]['prepare_at'])) { 
                                                                            echo date('H:i', strtotime($status_prepare[0]['prepare_at']));
                                                                         } ?>
                                                                    </div>
                                                                </td> -->
                                                                <td>
                                                                    <?php $status_supply = $this->M_SupplyCharging->get_status_prepare_component($item['no_wo'], $array_component[$i]['PART_COMPONENT']); ?>
                                                                    <input type="checkbox" id="status_supply_<?=$item['no_wo']?>_<?=$array_component[$i]['PART_COMPONENT']?>" name="status_supply[]" value="1" <?=(!empty($status_supply[0]['supply_at'])) ? 'checked':''?> onclick="supply_item('<?=$item['no_wo']?>', '<?=$array_component[$i]['PART_COMPONENT']?>', <?=$array_component[$i]['QTY']?>)"><label for="status_supply_<?=$item['no_wo']?>_<?=$array_component[$i]['PART_COMPONENT']?>"></label>
                                                                    <div id="section_supply_<?=$item['no_wo']?>_<?=$array_component[$i]['PART_COMPONENT']?>" style="display:contents">
                                                                        <?php if (!empty($status_supply[0]['supply_at'])) { 
                                                                            echo date('H:i', strtotime($status_supply[0]['supply_at']));
                                                                         } ?>
                                                                    </div>
                                                                    <!-- <button class="btn btn-primary">Scan</button> -->
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
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

    <!-- MODAL LOADING-->
    <div class="modal" id="loading-modal" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color:rgba(0, 0, 0, 0.01);">
                <div class="modal-body text-center">
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5 class="mt-2 text-light">Loading...</h5>
                </div>
            </div>
        </div>
    </div>
  <!-- /.content-wrapper -->
  <?= $this->endSection(); ?>

  <?= $this->section('script'); ?>
  <script>
    $(document).ready(function() {
        $('#table_supply').DataTable();
    });

    // function get_detail_component(no_wo) {
    //     $.ajax({
    //         url: '<?=base_url()?>/supply_charging/get_component_by_wo',
    //         type: 'POST',
    //         data: {
    //             no_wo: no_wo
    //         },
    //         dataType: 'JSON',
    //         success: function(data) {
    //             console.log(data);
    //             var html = '';
    //             for (var i = 0; i < data.length; i++) {
    //                 html += '<tr>';
    //                 html += `<td>${data[i].PART_COMPONENT} <input type="hidden" name="part_component[]" value="${data[i].PART_COMPONENT}"> <input type="hidden" name="no_wo[]" value="${no_wo}"> </td>`;
    //                 html += `<td>${data[i].QTY} <input type="hidden" name="qty[]" value="${data[i].QTY}"> </td>`;
    //                 html += `<td><input type="checkbox" id="status_${data[i].PART_COMPONENT}" name="status[]" value="1" ${(data[i].status !== 'undefined' && data[i].status == '1') ? 'checked' : ''}> <label for="status_${data[i].PART_COMPONENT}"></label></td>`;
    //                 html += '</tr>';
    //             }
    //             $('#detail_component').html(html);
    //             $('#main_modal').modal('show');
    //         }
    //     });
    // }

    function prepare_item(no_wo, item, qty){
        var isChecked = $(`#status_${no_wo}_${item}`).prop("checked");
        console.log(isChecked);
        console.log(no_wo);
        console.log(item);
        console.log(qty);

        // Create a new Date object
        const now = new Date();

        // Get the current hours and minutes
        const hours = now.getHours();
        const minutes = now.getMinutes();

        // Format the hours and minutes with leading zeros if necessary
        const formattedHours = hours < 10 ? `0${hours}` : hours;
        const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;

        // Combine hours and minutes into a string in "HH:mm" format
        const timeNow = `${formattedHours}:${formattedMinutes}`;

        $('#loading-modal').modal('show');
        if (isChecked) {
            $.ajax({
                url: '<?=base_url()?>supply_charging/check_prepare_item',
                type: 'POST',
                data: {
                    no_wo: no_wo,
                    item: item,
                    qty: qty
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#loading-modal').modal('hide');
                    $(`#section_${no_wo}_${item}`).html(`
                        ${timeNow}
                    `);
                }
            });
        } else {
            $.ajax({
                url: '<?=base_url()?>supply_charging/uncheck_prepare_item',
                type: 'POST',
                data: {
                    no_wo: no_wo,
                    item: item
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#loading-modal').modal('hide');
                    $(`#section_${no_wo}_${item}`).html(``);
                }
            });
        }
    }

    function supply_item(no_wo, item, qty){
        var isChecked = $(`#status_supply_${no_wo}_${item}`).prop("checked");
        var jumlah_supply = $(`#jumlah_supply_${no_wo}`).val();
        console.log(isChecked);
        console.log(no_wo);
        console.log(item);
        console.log(qty);

        // Create a new Date object
        const now = new Date();

        // Get the current hours and minutes
        const hours = now.getHours();
        const minutes = now.getMinutes();

        // Format the hours and minutes with leading zeros if necessary
        const formattedHours = hours < 10 ? `0${hours}` : hours;
        const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;

        // Combine hours and minutes into a string in "HH:mm" format
        const timeNow = `${formattedHours}:${formattedMinutes}`;

        $('#loading-modal').modal('show');
        if (isChecked) {
            $.ajax({
                url: '<?=base_url()?>supply_charging/check_supply_item',
                type: 'POST',
                data: {
                    no_wo: no_wo,
                    item: item,
                    qty: qty
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#loading-modal').modal('hide');
                    $(`#section_supply_${no_wo}_${item}`).html(`
                        ${timeNow}
                    `);
                    $(`#jumlah_supply_${no_wo}`).val(parseInt(jumlah_supply) + 1);

                    if (parseInt(jumlah_supply) + 1 == $(`#jumlah_component_${no_wo}`).val()) {
                        $.ajax({
                            url: '<?=base_url()?>supply_charging/update_status_supply',
                            type: 'POST',
                            data: {
                                no_wo: no_wo,
                                status: 'close'
                            },
                            dataType: 'JSON',
                            success: function(data) {
                                $(`#section_status_supply_${no_wo}`).html('<span class="badge badge-xl badge-success">Complete</span>');
                            }
                        });
                    }
                }
            });
        } else {
            $.ajax({
                url: '<?=base_url()?>supply_charging/uncheck_supply_item',
                type: 'POST',
                data: {
                    no_wo: no_wo,
                    item: item
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#loading-modal').modal('hide');
                    $(`#section_supply_${no_wo}_${item}`).html(``);

                    $(`#jumlah_supply_${no_wo}`).val(parseInt(jumlah_supply) - 1);
                    
                    
                    $.ajax({
                        url: '<?=base_url()?>supply_charging/update_status_supply',
                        type: 'POST',
                        data: {
                            no_wo: no_wo,
                            status: 'open'
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            $(`#section_status_supply_${no_wo}`).html('<span class="badge badge-xl badge-danger">Not Complete</span>');
                        }
                    });
                }
            });
        }
    }

    function filter()
    {
        var date = $('#filter_tanggal').val();
        var sesi = $('#filter_sesi').val();
        var line = $('#filter_line').val();

        console.log(date);
        console.log(sesi);
        console.log(line);

        window.location.href = `<?=base_url()?>supply_charging/list_supply/${date}/${sesi}/${line}`;
    }

    function clear_filter()
    {
        window.location.href = `<?=base_url()?>supply_charging/list_supply`;
    }
  </script>
  <?= $this->endSection(); ?>