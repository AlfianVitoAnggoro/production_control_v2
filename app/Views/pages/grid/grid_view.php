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
                                <input type="hidden" name="id_lhp" id="id_lhp" value="">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-4 w-300">
                                                <div class="form-group">
                                                    <label class="form-label">Tanggal Produksi</label>
                                                    <input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi" value="Tanggal">
                                                </div>
                                            </div>
                                            <div class="col-4 w-400">
                                                <div class="form-group">
                                                    <label class="form-label">Line</label>
                                                    <select class="form-control select2 line" data-placeholder="Pilih Line" data-allow-clear="true" name="" id="">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4 w-400">
                                                <div class="form-group">
                                                    <label class="form-label">Shift</label>
                                                    <select class="form-control select2 shift" data-placeholder="Pilih Shift" data-allow-clear="true" name="" id="">
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
                                                    <input type="text" class="form-control" id="grup" name="grup" value="">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">MP</label>
                                                    <input type="number" class="form-control" id="mp" name="mp" value="">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Absen</label>
                                                    <input type="number" class="form-control" id="absen" name="absen" value="">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label class="form-label">Cuti</label>
                                                    <input type="number" class="form-control" id="cuti" name="cuti" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="box-header with-border">
                                                </div>
                                                <div class="col-md-12">
                                                    <div id="notif"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="box box-solid">
                                                        <form action="" method="" id="SimpanData">
                                                            <?= csrf_field(); ?>
                                                            <div class="box-body">
                                                                <br>
                                                                <table class="table table-bordered" id="tableLoop">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">Nomor Mesin</th>
                                                                            <!-- <th class="text-center">Tgl Produksi</th> -->
                                                                            <!-- <th class="text-center">No Mesin</th> -->
                                                                            <th class="text-center">Nama Operator</th>
                                                                            <th class="text-center">Type Mesin</th>
                                                                            <th class="text-center">Type Mold</th>
                                                                            <th class="text-center">JKS</th>
                                                                            <!-- <th class="text-center">Plan WO</th> -->
                                                                            <th class="text-center">Aktual</th>
                                                                            <th class="text-center">Kode Rack</th>
                                                                            <!-- <th class="text-center">Section</th> -->
                                                                            <!-- <th class="text-center"><button class="btn btn-success btn-block" id="BarisBaru"><i class="fa fa-plus"></i> Baris Baru</button></th> -->
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                            <div class="box-footer">
                                                                <div class="form-group d-flex justify-content-end">
                                                                    <button type="submit" class="btn btn-primary    "><i class="fa fa-check"></i> Simpan</button>
                                                                    <button type="reset" class="btn btn-default">Batal</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example5').DataTable();
    });

    $(document).ready(function() {
        for (B = 1; B <= 24; B++) {
            Barisbaru();
        }
        $('#BarisBaru').click(function(e) {
            e.preventDefault();
            Barisbaru();
        });

        $("tableLoop tbody").find('input[type=text]').filter(':visible:first').focus();
    });

    function Barisbaru() {
        $(document).ready(function() {
            $("[data-toggle='tooltip']").tooltip();
        });
        var Nomor = $("#tableLoop tbody tr").length + 1;
        var Baris = '<tr>';

        Baris += '<td class="text-center">' + 'MC' + ' ' + Nomor + '</td>';
        // Baris += '<td>';
        // Baris += '<input type="date" name="date_production[]" class="form-control date_production"> ';
        // Baris += '</td>';

        // Baris += '<td>';
        // Baris += '<input type="text" name="no_machine[]" class="form-control no_machine" placeholder="No Machine..." required="">';
        // Baris += '</td>';

        Baris += '<td>';
        Baris += '<input type="text" name="operator_name[]" class="form-control operator_name w-150" placeholder="Operator Name..." required="">';
        Baris += '</td>';

        // Baris += '<td>';
        // Baris += '<input type="text" name="type_grid[]" class="form-control type_grid" placeholder="Type Grid..." required="">';
        // Baris += '</td>';

        Baris += '<td>';
        Baris += '<select class="form-control select2 type_mesin w-150" data-placeholder="Pilih Type Mesin" data-allow-clear="true" name="type_mesin[]" id="type_mesin' + Nomor + '"></select>';
        Baris += '</td>';

        Baris += '<td>';
        Baris += '<select class="form-control select2 type_grid w-150" data-placeholder="Type Mold" data-allow-clear="true" name="type_grid[]" id="type_grid' + Nomor + '"></select>';
        Baris += '</td>';

        Baris += '<td>';
        Baris += '<input type="number" step="any" min="0" name="jks[]" class="form-control jks" placeholder="JKS..." required="">';
        Baris += '</td>';

        // Baris += '<td>';
        // Baris += '<input type="number" step="any" min="0" name="plan_wo[]" class="form-control plan_wo" placeholder="Plan WO..." required="">';
        // Baris += '</td>';

        Baris += '<td>';
        Baris += '<input type="number" step="any" min="0" name="actual[]" class="form-control actual" placeholder="Actual..." required="">';
        Baris += '</td>';

        Baris += '<td>';
        Baris += '<input type="text" name="kode_rack[]" class="form-control kode_rack w-150" placeholder="Kode Rack..." required="">';
        Baris += '</td>';

        // Baris += '<td>';
        // Baris += '<input type="text" name="section[]" class="form-control section" placeholder="Section..." required="">';
        // Baris += '</td>';

        // Baris += '<td class="text-center">';
        // Baris += '<a class="btn btn-sm btn-danger" title="Hapus Baris" id="HapusBaris"><i class="fa fa-times"></i></a>';
        // Baris += '</td>';

        Baris += '</tr>';

        $("#tableLoop tbody").append(Baris);

        $("#tableLoop tbody tr").each(function() {
            $(this).find('td:nth-child(2) input').focus();
        });

        FormSelect(Nomor);

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
                if (data.success == true) {
                    $('.date_production').val('');
                    $('.no_machine').val('');
                    $('.operator_name').val('');
                    $('.type_grid').val('');
                    $('.jks').val('');
                    $('.plan_wo').val('');
                    $('.actual').val('');
                    $('.section').val('');
                    $('#notif').fadeIn(800, function() {
                        $("#notif").html(data.notif).fadeOut(5000).delay(800);
                    });
                } else {
                    $('#notif').html('<div class="alert alert-danger">Data Gagal Disimpan</div>')
                    console.log(data);
                }
            },

            error: function(error) {
                alert(error);
            }

        });
    }


    function FormSelect(Nomor) {
        var output = [];
        output.push('<option value="">-- Pilih --</option>');
        $.getJSON('/form/fetch', function(data) {
            $.each(data, function(key, val) {
                output.push('<option value="' + val.id_grid + '">' + val.type_grid + '</option>');
            });
            $('#type_grid' + Nomor).html(output.join(''));
        });
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>