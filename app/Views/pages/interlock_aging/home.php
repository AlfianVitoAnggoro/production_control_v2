<?= $this->extend('template/layout'); ?>

<?= $this->section('content'); ?>
    <div class="content-wrapper">
	    <div class="container-full">
            <section class="content">
                <div class="row">
                    <div class="col-4">

                    </div>
                    <div class="col-4" style="text-align:center;">
                        <a href="https://portal2.incoe.astra.co.id/e-wip/order_plate/activity_supply" class="btn btn-success">Portal E-WIP</a>
                    </div>
                    <div class="col-4">
                        
                    </div>
                </div>
                <br>
                
                <div class="row">
                    <div class="col-6" style="text-align:center;">
                        <a href="<?=base_url()?>interlock_aging/list_aging/B" class="btn btn-lg btn-primary">Mesin Aging B</a>
                    </div>
                    <div class="col-6" style="text-align:center;">
                        <a href="<?=base_url()?>interlock_aging/list_aging/E" class="btn btn-lg btn-primary">Mesin Aging E</a>
                    </div>
                </div>

            </section>
        </div>
    </div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
    <script>
        $(document).ready(function() {
            
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
                        $('#tanggal_produksi').val(data[0].entry_date);
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
                var cellText = $('#qr_rak'+i).val();
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
                $.ajax({
                    url: '<?= base_url() ?>interlock_aging/add_rak',
                    type: 'POST',
                    data: {
                        qr_rak: qr_rak,
                        item: item,
                        qty: qty,
                        tanggal_produksi: tanggal_produksi
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        
                        $('#tbody_data_rak').append(`
                            <tr class="rak">
                                <td>
                                    <input type="text" class="form-control" name="qr_rak[]" id="qr_rak_${baris}" class="form-control" value="${qr_rak}" readonly>
                                    <input type="hidden" class="form-control" name="id[]" id="id_${baris}" class="form-control" value="${data['id']}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="item[]" id="item_${baris}" class="form-control" value="${item}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="qty[]" id="qty_${baris}" class="form-control" value="${qty}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="tanggal_produksi[]" id="tanggal_produksi_${baris}" class="form-control" value="${tanggal_produksi}" readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this, ${baris})">Delete</button>
                                </td>
                            </tr>
                        `);
        
                        $('#start_barcode').val('');
                        $('#start_qty').val('');
                        $('#start_rak').val('');
                        $('#loading-modal').modal('hide');
                        
                    }
                });
            }
    }
    </script>
<?= $this->endSection(); ?>