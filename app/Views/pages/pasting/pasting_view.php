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
                  <h4 class="box-title">Laporan Harian Produksi</h4>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_pasting">
                    Tambah pasting
                  </button>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="data_pasting2" class="table table-bordered table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <!-- <th>No Doc</th> -->
                          <th>Tanggal</th>
                          <th>Shift</th>
                          <th>Mesin</th>
                          <th>Kasubsie</th>
                          <th>Grup</th>
                          <!-- <th>Efficiency (%)</th> -->
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data_pasting as $pasting) : ?>
                          <tr>
                            <!-- <td><?= $pasting['no_doc'] ?></td> -->
                            <td><?= $pasting['tanggal_produksi'] ?></td>
                            <td><?= $pasting['shift'] ?></td>
                            <td><?= $pasting['mesin_pasting'] ?></td>
                            <td><?= $pasting['kasubsie'] ?></td>
                            <td><?= $pasting['grup'] ?></td>
                            <!-- <td><?= $retVal = (!empty($pasting['total_aktual']) && !empty($pasting['total_plan'])) ? number_format((float) ($pasting['total_aktual'] / $pasting['total_plan']) * 100, 2, '.', '') : ''; ?></td> -->
                            <td>
                              <a href="<?= base_url() ?>pasting/detail_pasting/<?= $pasting['id_lhp_pasting'] ?>" class="btn btn-primary btn-sm">Detail</a>
                              <a href="<?= base_url() ?>pasting/hapus_pasting/<?= $pasting['id_lhp_pasting'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</a>
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

<div class="modal fade modal_tambah_pasting" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Tambah pasting Produksi 2</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url() ?>pasting/add_pasting" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Tanggal Produksi</label>
                <input type="date" class="form-control" id="tanggal_produksi" name="tanggal_produksi">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Mesin</label>
                <select class="form-select" id="mesin_pasting" name="mesin_pasting">
                  <option selected disabled>-- Pilih Data --</option>
                  <?php foreach ($data_mesin_pasting as $mesin_pasting) : ?>
                    <option value="<?= $mesin_pasting['id_mesin_pasting'] ?>">Mesin <?= $mesin_pasting['nama_mesin_pasting'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Shift</label>
                <select class="form-select" id="shift" name="shift">
                  <option selected disabled>-- Pilih Data --</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                </select>
              </div>
            </div>
            <!-- <div class="col-3">
							<div class="form-group">
								<label class="form-label">Kasubsie</label>
								<select class="form-control select2" id="kasubsie" name="kasubsie" style="width: 100%;">
									<option selected disabled>-- Pilih Data --</option>
									<option value="Yusuf Slamet Pelita">Yusuf Slamet Pelita</option>
									<option value="Edi Suwito">Edi Suwito</option>
									<option value="Masruri">Masruri</option>
									<option value="Parwadi">Parwadi</option>
									<option value="Iim Arwisman">Iim Arwisman</option>
								</select>
							</div>
						</div> -->
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Kasubsie</label>
                <select class="form-control select2" id="kasubsie" name="kasubsie" style="width: 100%;">
                  <option selected disabled>-- Pilih Data --</option>
                  <option value="Yanto A">Yanto A</option>
                  <option value="Ade Suryana">Ade Suryana</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label class="form-label">Grup</label>
                <select class="form-control select2" id="grup" name="grup" style="width: 100%;">
                  <option selected disabled>-- Pilih Data --</option>
                  <?php foreach($data_grup_pasting as $grup) : ?>
										<option value="<?=$grup['nama_grup']?>"><?=$grup['nama_grup']?></option>
									<?php endforeach; ?>
                </select>
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


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    $('#data_pasting2').DataTable();
    $('.modal .select2').select2({
      dropdownParent: $('.modal')
    });
  });
</script>
<?= $this->endSection(); ?>