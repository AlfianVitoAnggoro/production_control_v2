<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
    <div class="content-wrapper">
	    <div class="container-full">
            <section class="content">
                <div class="row" style="display:block">
                    <a href="https://portal2.incoe.astra.co.id/e-wip/order_plate/activity_supply" class="btn btn-success">Portal E-WIP</a>
                    <br>
                    <br>
                    <br>
                    <div class="col-6">
                        <h4 class="box-title">List Rak Tersedia</h4>
                        <table id="table_rak_tersedia" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>PN QR</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Tanggal Produksi</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_interlock_aging as $row) : ?>
                                    <tr>
                                        <td><?= $row['pn_qr']; ?></td>
                                        <td><?= $row['item']; ?></td>
                                        <td><?= $row['qty']; ?></td>
                                        <td><?= $row['entry_date']; ?></td>
                                        <!-- <td>
                                            <a href="#" class="btn btn-primary btn-xs move-row"><i class="fa fa-plus"></i></a>
                                        </td> -->
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6"  style="display:none">
                        <h4 class="box-title">List Rak Akan Agging</h4>
                        <table id="table_rak_tersimpan" class="table table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>PN QR</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Tanggal Produksi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="col-xl-12 col-12">
                        <div class="box">
                            <div class="box-header">
                                <h4>Input QR Rak Aging Mesin <?=$mesin?></h4>
                                <br>
                                <table class="table">
                                    <tr>
                                        <td>
                                            Qr Rak<input type="text" class="form-control" name="qr_rak" id="qr_rak" onchange="scanQr()" class="form-control">
                                        </td>
                                        <td>
                                            Item <input type="text" class="form-control" name="item" id="item" class="form-control" readonly>
                                        </td>
                                        <td>
                                            Qty <input type="text" class="form-control" name="qty" id="qty" class="form-control" readonly>
                                        </td>
                                        <td>
                                            Tanggal Produksi <input type="text" class="form-control" name="tanggal_produksi" id="tanggal_produksi" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="add_rak()">Add</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <form action="<?=base_url()?>interlock_aging/add_rak" method="post">
                                        <table id="data_rak" class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>QR Rak</th>
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                    <th>Tanggal Produksi</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_data_rak">
                                                <?php 
                                                if (!empty($data_rak_at_aging)) {
                                                    $i = 0;
                                                    foreach ($data_rak_at_aging as $d_rak_at_aging) { ?>
                                                    <tr class="rak">
                                                        <td>
                                                            <input type="hidden" name="nama_mesin[]" value="<?=($mesin == 'B') ? 'Mesin Aging B' : 'Mesin Aging E' ?>">
                                                            <input type="hidden" name="id[]" value="<?=$d_rak_at_aging['id']?>">
                                                            <input type="text" class="form-control" name="qr_code_rak[]" id="qr_rak_<?=$i?>" class="form-control" value="<?=$d_rak_at_aging['pn_qr']?>" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="item_rak[]" id="item_<?=$i?>" class="form-control" value="<?=$d_rak_at_aging['item']?>" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="qty_rak[]" id="qty_<?=$i?>" class="form-control" value="<?=$d_rak_at_aging['qty']?>" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="tanggal_produksi_rak[]" id="tanggal_produksi_<?=$i?>" class="form-control" value="<?=$d_rak_at_aging['tanggal_produksi']?>" readonly>
                                                        </td>
                                                        <td>
                                                            <a href="<?=base_url()?>interlock_aging/delete_rak_aging/<?=$d_rak_at_aging['id']?>/<?=$mesin?>" class="btn btn-danger">Delete</button>
                                                        </td>
                                                    </tr>
                                                 <?php 
                                                 $i++;
                                                    }
                                                }
                                                    
                                                ?>
                                            </tbody>
                                        </table>
                                        <br>
                                        <br>
                                        <div style="text-align:center;">
                                            <a href="<?=base_url()?>interlock_aging/" class="btn btn-secondary">Kembali</a>
                                            &nbsp;&nbsp;
                                            <?php if (count($data_rak_at_aging) < 12) { ?>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            <?php } else { ?>
                                                <a href="<?=base_url()?>interlock_aging/update_rak_aging/<?=$mesin?>" class="btn btn-danger">Bongkar</a>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="box-footer" style="text-align: center;">
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
    <script>
        $(document).ready(function() {
            $('#table_rak_tersedia').DataTable({
            "pageLength": 5
            });
            
        });

        function scanQr() {
            document.addEventListener('keyup', function(event) {
                if (event.keyCode == 9) {
                    get_qty_rak();
                }
            });
        }

        function get_qty_rak() {
            var qr_rak = $('#qr_rak').val();
            $('#loading-modal').modal('show');
            $.ajax({
                url: '<?= base_url() ?>interlock_aging/get_qty_rak',
                type: 'POST',
                data: {
                    qr_rak: qr_rak
                },
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        $('#item').val(data[0].item);
                        $('#qty').val(data[0].qty);
                        // $('#tanggal_produksi').val(data[0].entry_date);
                        $('#loading-modal').modal('hide');
                    } else {
                        alert('Data Tidak Ditemukan');
                        $('#loading-modal').modal('hide');
                    }
                }
            });
        }

        function add_rak() {
            let qr_rak = $('#qr_rak').val();
            let item = $('#item').val();
            let qty = $('#qty').val();
            let tanggal_produksi = $('#tanggal_produksi').val();

            let baris = document.querySelectorAll('.rak').length;

            var searchTerm = $('#start_barcode').val();
            var found = false;
            var i = 0;
            $('#data_rak tbody tr').each(function() {
                $(this).find('td').each(function() {
                var cellText = $('#qr_rak_'+i).val();
                console.log(cellText);
                if (cellText.includes(searchTerm)) {
                    found = true;
                    return false; // Break out of inner loop
                }
                });

                if (found) {
                    alert('Rak Sudah Di Input !!!');
                    $('#qr_rak').val('');
                    $('#item').val('');
                    $('#qty').val('');
                    $('#tanggal_produksi').val('');
                    $('#qr_rak').focus();

                    return false; // Break out of outer loop
                }
                i++;
            });

            if (!found) {
                if (baris < 12) {
                    $('#tbody_data_rak').append(`
                        <tr class="rak">
                            <td>
                                <input type="hidden" name="nama_mesin[]" value="<?=($mesin == 'B') ? 'Mesin Aging B' : 'Mesin Aging E' ?>">
                                <input type="hidden" name="id[]" value="">
                                <input type="text" class="form-control" name="qr_code_rak[]" id="qr_rak_${baris}" class="form-control" value="${qr_rak}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="item_rak[]" id="item_${baris}" class="form-control" value="${item}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="qty_rak[]" id="qty_${baris}" class="form-control" value="${qty}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="tanggal_produksi_rak[]" id="tanggal_produksi_${baris}" class="form-control" value="${tanggal_produksi}" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
                            </td>
                        </tr>
                    `);

                    $('#qr_rak').val('');
                    $('#item').val('');
                    $('#qty').val('');
                    $('#tanggal_produksi').val('');
                    $('#qr_rak').focus();
                } else {
                    alert('Maksimal 12 Rak !!!');
                    $('#qr_rak').val('');
                    $('#item').val('');
                    $('#qty').val('');
                    $('#tanggal_produksi').val('');
                    $('#qr_rak').focus();
                }
            }
    }

    function delete_detail_rak(e) {
        $(e).parent().parent().remove();            
    }
    </script>
<?= $this->endSection(); ?>