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
                                <div class=" d-flex justify-content-center mt-30">

                                    <h4 class="box-title">Laporan Harian Grid Casting PT CBI</h4>
                                </div>
                                <!-- <div class="box"> -->

                                <div class="box-body">
                                    <!-- <div class="position-sticky">
                                        <div id="notif" class=" w-450 top-5 start-100"></div>
                                    </div> -->

                                    <div class="box-header with-border">
                                        <div class="col-md-12 w-50">
                                            <div id="notif" class="fixed-top mt-35"></div>
                                        </div>
                                    </div>
                                    <form action="/grid/post_lhp_grid" method="post" id="SimpanLhp">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-4 w-300">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Produksi</label>
                                                    <input type="date" class="form-control" id="tanggal_produksi" name="date_production">
                                                </div>
                                            </div>
                                            <div class="col-4 w-400">
                                                <div class="form-group">
                                                    <label class="form-label">Line</label>
                                                    <select class="form-control select2 line" data-placeholder="-- Pilih Line --" data-allow-clear="true" name="line" id="line">
                                                        <option disabled selected>-- Pilih Line --</option>
                                                        <option value="Grid Casting">Grid Casting</option>
                                                        <option value="Grid Punching">Grid Punching</option>
                                                        <!-- <option value="3">3</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4 w-400">
                                                <div class="form-group">
                                                    <label class="form-label">Shift</label>
                                                    <select class="form-control select2 shift" data-placeholder="-- Pilih Shift --" data-allow-clear="true" name="shift" id="shift">
                                                        <option disabled selected>-- Pilih Shift --</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Grup</label>
                                                    <input type="text" class="form-control" id="grup" name="grup">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">MP</label>
                                                    <input type="number" class="form-control" id="mp" name="mp">
                                                </div>
                                            </div>
                                            <div class="col-3">
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
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <!-- <div class="form-group"> -->
                                                <button type="submit" class="btn btn-primary w-150"><i class="fa fa-check"></i> Simpan</button>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </form>

                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="box-header with-border">
                                            </div>


                                            <div class="col-md-12">
                                                <div class="box box-solid">
                                                    <form action="/grid/post_detail_grid" method="post" id="SimpanData">
                                                        <?= csrf_field(); ?>
                                                        <!-- <input type="text" id="id2" readonly> -->
                                                        <div class="box-body">

                                                            <br>
                                                            <table class="table table-bordered" id="tableLoop">

                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center w-150">Nomor Mesin</th>
                                                                        <!-- <th class="text-center">Type Mesin</th> -->
                                                                        <th class="text-center">Nama Operator</th>
                                                                        <th class="text-center w-150">Type Grid</th>
                                                                        <th class="text-center">JKS (Panel)</th>
                                                                        <!-- <th class="text-center">Plan WO</th> -->
                                                                        <th class="text-center">Aktual (Panel)</th>
                                                                        <!-- <th class="text-center">Kode rak</th> -->
                                                                        <th class="text-center">Andon</th>
                                                                        <th class="text-center">Problem</th>
                                                                        <!-- <th class="text-center">Kode rak</th> -->
                                                                        <!-- <th class="text-center" style="display: none;">ID LHP GRID</th> -->
                                                                        <!-- <th class="text-center">Section</th> -->
                                                                        <!-- <th class="text-center"><button class="btn btn-success btn-block" id="BarisBaru"><i class="fa fa-plus"></i> Baris Baru</button></th> -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                        <div class="box-footer">
                                                            <div class="form-group d-flex justify-content-end">
                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                                                                <button type="reset" class="btn btn-default">Batal</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->
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
        $('#example5').DataTable();
    });

    $(document).ready(function() {
        for (B = 1; B <= 24; B++) {
            Barisbaru();
        }
        // $('#BarisBaru').click(function(e) {
        //     e.preventDefault();
        //     Barisbaru();
        // });

        $("tableLoop tbody").find('input[type=text]').filter(':visible:first').focus();
    });

    function Barisbaru() {
        $(document).ready(function() {
            $("[data-toggle='tooltip']").tooltip();
        });
        var Nomor = $("#tableLoop tbody tr").length + 1;
        var Baris = '<tr>';

        Baris += '<td>';
        Baris += '<input type="text" name="no_machine[]" value="MC ' + Nomor + '"  class="form-control no_machine text-center w-150" readonly ><input type="hidden" name="id_lhp_grid[]"  class="form-control id_lhp_grid text-center"';
        Baris += '</td>';

        Baris += '<td>';
        Baris += '<input type="text" name="operator_name[]" class="form-control operator_name w-full" placeholder="Operator Name..." >';
        Baris += '</td>';

        Baris += '<td>';
        Baris += '<select class="form-control select2 type_grid w-150" data-placeholder="-- Pilih Grid --" data-allow-clear="true" name="type_grid[]" id="type_grid' + Nomor + '"></select>';
        Baris += '</td>';

        Baris += '<td>';
        Baris += '<input type="number" step="any" min="0" name="jks[]" class="form-control jks" placeholder="JKS..." >';
        Baris += '</td>';

        Baris += '<td>';
        Baris += '<input type="number" step="any" min="0" name="actual[]" class="form-control actual" placeholder="Actual..." >';
        Baris += '</td>';

        // Baris += '<td>';
        // Baris += '<input type="text" name="kode_rak[]" class="form-control kode_rak w-full" placeholder="Kode rak..." >';
        // Baris += '</td>';

        Baris += '<td>';
        // Baris += '<input type="text" name="kode_rak[]" class="form-control kode_rak w-full" placeholder="Kode rak..." >';
        Baris += '</td>';

        Baris += '<td>';
        // Baris += '<input type="text" name="kode_rak[]" class="form-control kode_rak w-full" placeholder="Kode rak..." >';
        Baris += '</td>';



        // Baris += '<td>';
        // Baris += '<input type="number" name="id_lhp_grid[]"  class="form-control id_lhp_grid text-center" hidden';
        // Baris += '</td>';

        Baris += '</tr>';

        $("#tableLoop tbody").append(Baris);

        $("#tableLoop tbody tr").each(function() {
            $(this).find('td:nth-child(1) input').focus();
        });

        FormSelectGrid(Nomor);
        // FormSelectJks(Nomor);

    }


    // $(document).on('click', '#HapusBaris', function(e) {
    //     e.preventDefault();
    //     var Nomor = 1;
    //     $(this).parent().parent().remove();
    //     $('tableLoop tbody tr').each(function() {
    //         $(this).find('td:nth-child(1)').html(Nomor);
    //         Nomor++;
    //     });
    // });

    $(document).ready(function() {
        $('#SimpanLhp').submit(function(e) {
            e.preventDefault();
            lhpgrid();
        });
    });

    function lhpgrid() {
        $.ajax({
            url: $("#SimpanLhp").attr('action'),
            type: 'post',
            cache: false,
            dataType: "json",
            data: $("#SimpanLhp").serialize(),
            success: function(data) {
                if (data.success == true) {

                    $('#SimpanLhp :input').prop('disabled', true);
                    // $('#SimpanLhp')[0].reset();
                    $('.id_lhp_grid').val(data.id_lhp_grid);
                    // $('#notif').fadeIn(10000, function() {
                    //     $("#notif").html(data.notif).fadeOut(10000).delay(8000);
                    // });
                    $('#notif').html(data.notif)
                } else {
                    $('#notif').html('<div class="alert alert-danger sticky-top">Tanggal Gagal Disimpan<button type="button" class="close mx-20 button-danger" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">❌</span></button></div>')
                    // alert(data);
                    console.log(data);
                    console.table(data);
                }
            },
            error: function(error) {
                // alert(error);
                console.log(error);
                console.table(error);
            }
        });
    }

    $(document).ready(function() {
        $('#SimpanData').submit(function(e) {
            e.preventDefault();
            biodata();
        });
    });

    function biodata() {
        $.ajax({
            url: $("#SimpanData").attr('action'),
            type: 'post',
            cache: false,
            dataType: "json",
            data: $("#SimpanData").serialize(),
            success: function(data) {
                // console.log(data);
                if (data.success == true) {

                    $('#SimpanData :input').prop('disabled', true);
                    // $('#SimpanData')[0].reset();
                    // $('.type_grid').val(null).trigger('change');
                    $('#notif').html(data.notif)
                } else {
                    $('#notif').html('<div class="alert alert-danger sticky-top">Data Gagal Disimpan<button type="button" class="close mx-20 button-danger" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">❌</span></button></div>')
                    console.log(data);
                    console.table(data);
                }
            },
            error: function(error) {
                alert(error);
                console.log(error);
                console.table(error);
            }
        });
    }


    function FormSelectGrid(Nomor) {
        var output = [];
        output.push('<option value="">-- Pilih --</option>');
        $.getJSON('/fetch_grid', function(data) {
            $.each(data, function(key, val) {
                output.push('<option value="' + val.id_grid + '">' + val.type_grid + '</option>');
            });
            $('#type_grid' + Nomor).html(output.join(''));
        });
    }

    function FormSelectJks(Nomor) {
        var output = [];
        output.push('<option value="">-- Pilih --</option>');
        $.getJSON('/fetch_jks', function(data) {
            $.each(data, function(key, val) {
                output.push('<option value="' + val.id + '">' + val.type_mesin + '</option>');
            });
            $('#type_mesin' + Nomor).html(output.join(''));
        });
    }
</script>
<?= $this->endSection(); ?>