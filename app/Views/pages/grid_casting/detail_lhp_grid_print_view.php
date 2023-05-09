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
      <form action="<?= base_url() ?>grid/update_lhp" method="post">
        <input type="hidden" name="id_lhp" id="id_lhp" value="<?= $id_lhp ?>">
        <div class="box">
          <div class="box-header with-border">
            <div class="d-flex justify-content-between">
            <h4>Detail Laporan Grid Casting</h4>
            <h4>Signed by : <?= $data_lhp[0]['kasubsie'] ?></h4>
            </div>
            <!-- <button class="btn btn-danger" onclick="print()">Print</button> -->
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Tanggal Produksi : </label>
                  <span><?= date('j F Y', strtotime($data_lhp[0]['date_production'])) ?>
                  </span>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Line : </label>
                  <span><?= $data_lhp[0]['line'] ?></span>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Shift : </label>
                  <span><?= $data_lhp[0]['shift'] ?></span>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Kasubsie : </label>
                  <span><?= $data_lhp[0]['kasubsie'] ?></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Grup : </label>
                  <span><?= $data_lhp[0]['grup'] ?></span>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">MP : </label>
                  <span><?= $data_lhp[0]['mp'] ?></span>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Absen : </label>
                  <span><?= $data_lhp[0]['absen'] ?></span>
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label class="form-label">Cuti : </label>
                  <span><?= $data_lhp[0]['cuti'] ?></span>
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
                        if (!empty($data_detail_lhp)) {
                      ?>
                          <tr>
                            <td>
                              <input type="hidden" name="id_detail_lhp_grid[]" value="<?= $data_detail_lhp[0]['id'] ?>">
                              <input type="hidden" name="no_machine[]" id="no_machine_<?= $d_mesin['nama_mesin'] ?>" value="<?= $d_mesin['nama_mesin'] ?>" readonly>
                              MC <?= $d_mesin['nama_mesin'] ?>
                              <input type="hidden" name="type_mesin[]" id="type_mesin_<?= $d_mesin['nama_mesin'] ?>" value="<?= $d_mesin['type_mesin'] ?>">
                            </td>
                            <td>
                              <?= $data_detail_lhp[0]['operator_name'] ?>
                            </td>
                            <td>
                              <?= $data_detail_lhp[0]['type_grid'] ?>
                            </td>
                            <td>
                              <?= $data_detail_lhp[0]['jks'] ?>
                            </td>
                            <td>
                              <?= $data_detail_lhp[0]['actual'] ?>
                            </td>
                            <td>
                              <?= number_format($data_detail_lhp[0]['persentase']) ?>
                            </td>
                            <!-- <td>
                                                                <input type="text" name="rak[]" id="jumlah_rak_<?= $d_mesin['nama_mesin'] ?>" class="form-control" value="" style="width: 75px" readonly>
                                                            </td> -->
                            <!-- <td>
                                                                <a href="#" class="btn btn-info btn-sm detail-btn" data-id_lhp="<?= $id_lhp ?>" data-id_detail_lhp="<?= $data_detail_lhp[0]['id'] ?>">Detail</a>
                                                            </td> -->
                            <td>
                              <?= $data_detail_lhp[0]['mh'] === "" ? $data_detail_lhp[0]['mh'] : $mh[$data_lhp[0]['shift'] - 1]; ?>
                            </td>
                            <td>
                              <?= $data_detail_lhp[0]['productivity'] ?>
                            </td>
                            <!-- <td>
                                                                <button type="button" class="btn btn-sm btn-primary" onclick="add_breakdown(<?= $d_mesin['nama_mesin'] ?>)">Add</button>
                                                            </td> -->
                          </tr>
                        <?php
                        } else {
                        ?>
                          <tr>
                            <td>
                              <input type="hidden" name="id_detail_lhp_grid[]" id="id_detail_lhp_grid_<?= $d_mesin['nama_mesin'] ?>" value="">
                              <input type="hidden" name="no_machine[]" id="no_machine_<?= $d_mesin['nama_mesin'] ?>" value="<?= $d_mesin['nama_mesin'] ?>" readonly>
                              MC <?= $d_mesin['nama_mesin'] ?>
                              <input type="hidden" name="type_mesin[]" id="type_mesin_<?= $d_mesin['nama_mesin'] ?>" value="<?= $d_mesin['type_mesin'] ?>">
                            </td>
                            <td>
                              <?php
                              $pic_grup_mesin = $model->get_pic_grup_mesin($d_mesin['nama_mesin'], $data_lhp[0]['grup']);
                              $pic_grup_mesin[0]['pic']
                              ?>
                            </td>
                            <td>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3">
                          <h3>Total</h3>
                        </td>
                        <td style="text-align: right;"><?= str_replace(',', '.', number_format($data_lhp[0]['total_jks'])) ?></td>
                        <td style="text-align: right;"><?= str_replace(',', '.', number_format($data_lhp[0]['total_aktual'])) ?></td>
                        <td style="text-align: right;"><?= $retVal = (!empty($data_lhp[0]['total_aktual'])) ? number_format(($data_lhp[0]['total_aktual'] / $data_lhp[0]['total_jks']) * 100) : 0; ?></td>
                        <td style="text-align: right;"><?= $retVal = (!empty($data_lhp[0]['total_mh'])) ? $data_lhp[0]['total_mh'] : 0; ?></td>
                        <td style="text-align: right;"><?= $retVal = (!empty($data_lhp[0]['total_productivity'])) ? str_replace(',', '.', number_format($data_lhp[0]['total_productivity'])) : 0; ?></td>
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

        <!-- <div class="row">
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
                          <td>MC <?= $d_andon['no_machine'] ?></td>
                          <td><?= $d_andon['permasalahan'] ?></td>
                          <td><?= $d_andon['tujuan'] ?></td>
                          <td><?= $d_andon['total_menit'] ?></td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>

              </div>
              <div class="box-footer" style="text-align: center;">
                <input type="submit" class="btn btn-success" value="Save">
              </div>
            </div>
          </div>
        </div> -->

        <!-- <div class="row">
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
                        <th>Jenis Line Stop</th>
                        <th>Kategori Line Stop</th>
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
                            <?= $d_breakdown['no_machine'] ?>
                            <input type="hidden" name="id_detail_lhp_grid_breakdown[]" value="<?= $d_breakdown['id_breakdown_grid'] ?>">
                          </td>
                          <td>
                            <?= $d_breakdown['uraian_breakdown'] ?>
                          </td>
                          <td>
                            <?= $d_breakdown['total_menit'] ?>
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
                <input type="submit" class="btn btn-success" value="Save">
              </div>
            </div>
          </div>
        </div> -->

        <!-- <div class="row">
          <div class="col-xl-12 col-12">
            <div class="box">
              <div class="box-header">
                <h4>Detail Rak</h4>
                <br>
                <table class="table">
                  <tr>
                    <td>
                      Barcode <input type="text" class="form-control" name="start_barcode" id="start_barcode" onchange="scanQr()" class="form-control">
                    </td>
                    <td>
                      Qty <input type="text" class="form-control" name="start_qty" id="start_qty" class="form-control" readonly>
                      <div class="qty"></div>
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
                      <?php $number = 0;
                      foreach ($data_record_rak as $d_rak) { ?>
                        <tr class="rak">
                          <td>
                            <?= $d_rak['barcode'] ?>
                            <input type="hidden" class="form-control" name="id_rak_barcode[]" id="id_rak_barcode_<?= $number ?>" value="<?= "" //$d_rak['id'] 
                                                                                                                                        ?>" readonly>
                            <input type="hidden" class="form-control" name="id_log_detail_record_rak[]" id="id_log_detail_record_rak_<?= $number ?>" value="<?= $d_rak['id_log'] ?>" readonly>
                          </td>
                          <td>
                            <?= $d_rak['qty'] ?>
                          </td>
                          <td>
                            <input type="text" class="form-control" name="id_rak[]" id="id_rak_<?= $number ?>" value="<?= "" //$d_rak['id_rak'] 
                                                                                                                      ?>" readonly>
                            <?= $d_rak['pn_qr'] ?>
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this, <?= $number ?>)">Delete</button>
                          </td>
                        </tr>
                      <?php $number += 1;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>

              </div>
              <div class="box-footer" style="text-align: center;">
                <input type="submit" class="btn btn-success" value="Save">
              </div>
            </div>
          </div>
        </div> -->

        <!-- <div class="row">
          <div class="col-4"></div>
          <div class="col-4" style="text-align:center;"><input type="submit" class="btn btn-success" value="Save"></div>
          <div class="col-4"></div>
        </div> -->
        <!-- <div class="d-flex justify-content-end" style="margin-right: 50px">
          <table class="table table-bordered" style="width: 400px;">
            <thead>
              <th class="text-center">Disetujui</th>
              <th class="text-center">Dibuat</th>
            </thead>
            <tbody>
              <td>
                <div class="form-check text-center p-0">
                  <?php if ($data_lhp[0]['status'] !== 'approved') { ?>
                    <button type="submit" class="btn btn-outline-primary" id="approved" name="approved" value="approved" onclick="return confirm('Apakah Anda Yakin?')" disabled>✔</button>
                  <?php } else { ?>
                    <button class="btn btn-primary" disabled>✔</button>
                  <?php } ?>
                </div>
              </td>
              <td>
                <div class="form-check text-center p-0">
                  <?php if ($data_lhp[0]['status'] !== 'completed' && $data_lhp[0]['status'] !== 'approved') { ?>
                    <button type="submit" class="btn btn-outline-primary" id="completed" name="completed" value="completed" onclick="return confirm('Apakah Anda Yakin?')" disabled>✔</button>
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
        </div> -->
      </form>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    let baris = <?= count($data_mesin) ?>;
    for (let i = 1; i <= baris; i++) {
      var jks = $('#jks_' + i).val();
      var aktual = $('#aktual_' + i).val();
      var productivity = $('#productivity_' + i).val();
      var mh = $('#mh_' + i).val();

      var persentase = (aktual / jks) * 100;

      if (jks === '' || jks === null && (aktual === '' || aktual === null)) {
        persentase = 0;
      }


      var productivity = (aktual / mh)

      $('#persentase_' + i).val(persentase.toFixed(0));
      $('#productivity_' + i).val(productivity.toFixed(0));
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
    // $('.detail-btn').on('click', function() {
    //   // Get data attributes from button
    //   var id_lhp = $(this).data('id_lhp');
    //   var id_detail_lhp = $(this).data('id_detail_lhp');

    //   // Set data attributes to modal
    //   $('#detail_rak_id_lhp').val(id_lhp);
    //   $('#detail_rak_id_detail_lhp').val(id_detail_lhp);
    //   $('.modal_detail').modal('show');
    // });
    window.print();
  })
  <?php if ($session <= 2) { ?>
    // const approvedElement = document.querySelector('#approved');
    // approvedElement.removeAttribute('disabled');
  <?php } ?>
  <?php if ($session <= 4) { ?>
    // const completedElement = document.querySelector('#completed');
    // completedElement.removeAttribute('disabled');
  <?php } ?>

  // function get_jks(i) {
  //   var type_grid = $('#type_grid_' + i).val();
  //   var type_mesin = $('#type_mesin_' + i).val();
  //   var shift = $('#shift').val();

  //   $.ajax({
  //     url: '<?= base_url() ?>grid/get_jks',
  //     type: 'POST',
  //     data: {
  //       type_grid: type_grid,
  //       type_mesin: type_mesin,
  //       shift: shift
  //     },
  //     dataType: 'json',
  //     success: function(data) {
  //       $('#jks_' + i).val(data[0].jks);
  //     }
  //   })
  // }

  // function count_persentase(i) {
  //   var jks = $('#jks_' + i).val();
  //   var aktual = $('#aktual_' + i).val();
  //   var productivity = $('#productivity_' + i).val();
  //   var mh = $('#mh_' + i).val();

  //   var persentase = (aktual / jks) * 100;
  //   var productivity = (aktual / mh)

  //   $('#persentase_' + i).val(persentase.toFixed(0));
  //   $('#productivity_' + i).val(productivity.toFixed(0));
  // }

  // function get_data_andon() {
  //   var shift = $('#shift').val();
  //   var tanggal = $('#tanggal_produksi').val();

  //   $.ajax({
  //     url: '<?= base_url() ?>grid/get_data_andon',
  //     type: 'POST',
  //     data: {
  //       shift: shift,
  //       tanggal: tanggal
  //     },
  //     dataType: 'json',
  //     success: function(data) {
  //       console.log(data);
  //       if (data.length > 0) {
  //         var html = '';
  //         var no = 1;
  //         for (var i = 0; i < data.length; i++) {
  //           html += `<tr>
  //                                   <td>
  //                                       ${data[i].nama_mesin}
  //                                       <input type="hidden" name="no_machine_andon[]" value="${data[i].nama_mesin.substring(3)}">
  //                                       <input type="hidden" name="tiket_andon[]" value="${data[i].id_ticket}">
  //                                   </td>
  //                                   <td>
  //                                       <input type="text" class="form-control" name="permasalahan_andon[]" id="permasalahan_${no}" class="form-control" value="${data[i].permasalahan.substring(8)}">
  //                                   </td>
  //                                   <td>
  //                                       <input type="text" class="form-control" name="tujuan_andon[]" id="tujuan_${no}" class="form-control" value="${data[i].tujuan}">
  //                                   </td>
  //                                   <td>
  //                                       <input type="text" class="form-control" name="total_menit_andon[]" id="total_menit_${no}" class="form-control" value="${data[i].total_min}">
  //                                   </td>
  //                               </tr>`;
  //           no++;
  //         }
  //         $('#tbody_data_andon').html(html);
  //       } else {
  //         alert('Tidak Ada Andon');
  //       }
  //     }
  //   })
  // }

  // function add_breakdown() {
  //   var data_mesin = <?= json_encode($data_mesin) ?>;
  //   $('#tbody_data_line_stop').append(`
  //           <tr>
  //               <td>
  //                   <select name="nama_mesin_breakdown[]" id="nama_mesin" class="form-select select2" style="width: 150px">
  //                       <option value="">-- Pilih Mesin --</option>
  //                       ${data_mesin.map((item) => {
  //                           return `<option value="${item.nama_mesin}">MC ${item.nama_mesin}</option>`
  //                       })}
  //                   </select>
  //                   <input type="hidden" name="id_detail_lhp_grid_breakdown[]">
  //               </td>
  //               <td>
  //                   <input type="text" class="form-control" name="uraian_breakdown_grid[]" id="uraian_breakdown_grid" class="form-control" style="width: 300px">
  //               </td>
  //               <td>
  //                   <input type="text" class="form-control" name="total_menit_breakdown_grid[]" id="total_menit_breakdown_grid" class="form-control" style="width: 75px">
  //               </td>
  //               <td>
  //                   <button type="button" class="btn btn-danger" onclick="delete_breakdown(this)">Delete</button>
  //               </td>
  //           </tr>
  //       `);

  //   $('.select2').select2();
  // }

  // function delete_breakdown(e) {
  //   $(e).parent().parent().remove();
  // }

  // function scanQr() {
  //   var barcode = $("#start_barcode").val();

  //   document.addEventListener('keyup', function(event) {
  //     if (event.keyCode == 9) {
  //       get_qty_rak();
  //     }
  //   });
  // }

  // function get_qty_rak() {
  //   var barcode = $('#start_barcode').val();
  //   $('#loading-modal').modal('show');
  //   $.ajax({
  //     url: '<?= base_url() ?>grid/get_qty_rak',
  //     type: 'POST',
  //     data: {
  //       barcode: barcode
  //     },
  //     dataType: 'json',
  //     success: function(data) {
  //       if (data.length > 0) {
  //         document.querySelector('.qty').innerHTML = '';
  //         $('.qty').append(`
  //                       <input type="hidden" class="form-control" name="item" id="item" class="form-control" value="${data[0]['t$item'].trim()}">
  //                       <input type="hidden" class="form-control" name="dsca" id="dsca" class="form-control" value="${data[0]['t$dsca']}">
  //                       <input type="hidden" class="form-control" name="cuni" id="cuni" class="form-control" value="${data[0]['t$cuni']}">
  //                       <input type="hidden" class="form-control" name="endt" id="endt" class="form-control" value="${data[0]['t$endt']}">
  //                       <input type="hidden" class="form-control" name="orno" id="orno" class="form-control" value="${data[0]['t$orno']}">
  //                       <input type="hidden" class="form-control" name="mach" id="mach" class="form-control" value="${data[0]['t$mach']}">
  //                   `);
  //         $('#start_qty').val(data[0].t$actq);
  //         $('#loading-modal').modal('hide');
  //         $('#start_rak').focus();
  //       } else {
  //         alert('Data Tidak Ditemukan');
  //         $('#loading-modal').modal('hide');
  //       }
  //     }
  //   });
  // }

  // function add_rak() {
  //   let id_lhp = $('#id_lhp').val();
  //   let barcode = $('#start_barcode').val();
  //   let qty = $('#start_qty').val();
  //   let rak = $('#start_rak').val();
  //   let item = $('#item').val();
  //   let descrp = $('#dsca').val();
  //   let satuan = $('#cuni').val();
  //   let mesin = $('#mach').val();
  //   let entry_date = $('#endt').val();
  //   let no_wo = $('#orno').val();
  //   let baris = document.querySelectorAll('.rak').length;
  //   $('#loading-modal').modal('show');
  //   // $.ajax({
  //   //     url: '<?= base_url() ?>grid/add_detail_record_rak',
  //   //     type: 'POST',
  //   //     data: {
  //   //         pn_qr: rak,
  //   //         barcode: barcode,
  //   //         qty: qty,
  //   //         wh_from: 'K-CAS',
  //   //         wh_to: 'K-PAS'
  //   //     },
  //   //     dataType: 'json',
  //   //     success: function(data) {
  //   //     }
  //   // });
  //   $.ajax({
  //     url: '<?= base_url() ?>grid/add_rak',
  //     type: 'POST',
  //     data: {
  //       id_lhp: id_lhp,
  //       barcode: barcode,
  //       qty: qty,
  //       rak: rak,
  //       wh_from: 'K-CAS',
  //       wh_to: 'K-PAS',
  //       item: item,
  //       descrp: descrp,
  //       satuan: satuan,
  //       mesin: mesin,
  //       entry_date: entry_date,
  //       no_wo: no_wo,
  //     },
  //     dataType: 'json',
  //     success: function(data) {
  //       console.log(data)
  //       $('#tbody_data_rak').append(`
  //                   <tr class="rak">
  //                       <td>
  //                           <input type="text" class="form-control" name="barcode_rak[]" id="barcode_rak_${baris}" class="form-control" value="${barcode}">
  //                           <input type="hidden" class="form-control" name="id_log_detail_record_rak[]" id="id_log_detail_record_rak_${baris}" class="form-control" value="${data['id_log_detail_record_rak']}">
  //                       </td>
  //                       <td>
  //                           <input type="text" class="form-control" name="qty_rak[]" id="qty_rak_${baris}" class="form-control" value="${qty}">
  //                       </td>
  //                       <td>
  //                           <input type="text" class="form-control" name="id_rak[]" id="id_rak_${baris}" class="form-control" value="${rak}">
  //                       </td>
  //                       <td>
  //                           <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this, ${baris})">Delete</button>
  //                       </td>
  //                   </tr>
  //               `);

  //       $('#start_barcode').val('');
  //       $('#start_qty').val('');
  //       $('#start_rak').val('');
  //       $('#loading-modal').modal('hide');
  //     }
  //   });
  // }


  // // function get_qty_rak(i) {
  // //     // var id_lhp = $('#detail_rak_id_lhp').val();
  // //     // var id_detail_lhp = $('#detail_rak_id_detail_lhp').val();

  // //     var barcode = $('#barcode_'+i).val();

  // //     $.ajax({
  // //         url: '<?= base_url() ?>grid/get_qty_rak',
  // //         type: 'POST',
  // //         data: {
  // //             barcode: barcode
  // //         },
  // //         dataType: 'json',
  // //         success: function(data) {
  // //             console.log(data);
  // //             $('#qty_'+i).val(data[0].QTY);
  // //             // if (data.length > 0) {
  // //             //     var html = '';
  // //             //     var no = 1;
  // //             //     for (var i = 0; i < data.length; i++) {
  // //             //         html += `<tr>
  // //             //                     <td>
  // //             //                         <input type="text" class="form-control" name="barcode[]" id="" class="form-control" value="${data[i].barcode}">
  // //             //                     </td>
  // //             //                     <td>
  // //             //                         <input type="text" class="form-control" name="qty[]" id="" class="form-control" value="${data[i].qty}">
  // //             //                     </td>
  // //             //                     <td>
  // //             //                         <input type="text" class="form-control" name="id_rak[]" id="" class="form-control" value="${data[i].id_rak}">
  // //             //                     </td>
  // //             //                     <td>
  // //             //                         <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
  // //             //                     </td>
  // //             //                 </tr>`;
  // //             //         no++;
  // //             //     }
  // //             //     $('#tbody_rak').html(html);
  // //             // } else {
  // //             //     alert('Tidak Ada Rak');
  // //             // }
  // //         }
  // //     })
  // // }

  // function add_detail_rak() {
  //   $('#tbody_rak').append(`
  //           <tr>
  //               <td>
  //                   <input type="text" class="form-control" name="barcode[]" id="" class="form-control" readonly>
  //               </td>
  //               <td>
  //                   <input type="text" class="form-control" name="qty[]" id="" class="form-control" readonly>
  //               </td>
  //               <td>
  //                   <input type="text" class="form-control" name="id_rak[]" id="" class="form-control" readonly>
  //               </td>

  //           </tr>
  //       `);

  //   // <td>
  //   //     <button type="button" class="btn btn-danger" onclick="delete_detail_rak(this)">Delete</button>
  //   // </td>
  // }

  // function delete_detail_rak(e, baris) {
  //   // let id_barcode = $('#id_rak_barcode_' + baris).val();
  //   let id_rak = $('#id_rak_' + baris).val();
  //   let id_log_detail_record_rak = $('#id_log_detail_record_rak_' + baris).val();
  //   let barcode_rak = $('#barcode_rak_' + baris).val();
  //   $('#loading-modal').modal('show');
  //   $.ajax({
  //     url: '<?= base_url() ?>grid/delete_rak',
  //     type: 'POST',
  //     data: {
  //       // id_barcode: id_barcode,
  //       id_rak: id_rak,
  //       id_log_detail_record_rak: id_log_detail_record_rak,
  //       barcode_rak: barcode_rak
  //     },
  //     dataType: 'json',
  //     success: function(data) {
  //       console.log(data)
  //       $(e).parent().parent().remove();
  //       $('#loading-modal').modal('hide');
  //     }
  //   });
  // }

  // function scan() {
  //   $('.modal_scan').modal('show');
  // }
</script>
<?= $this->endSection(); ?>