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
                  <div class="d-flex justify-content-between">
                    <div>
                      <h4 class="box-title">Data Master Man Power</h4>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".modal_tambah_man_power">
                        Tambah Data
                      </button>
                      <?php if (session()->get('level') < 6) { ?>
                        <a href="<?= base_url() ?>master_man_power/save_all_mp" class="btn btn-danger ms-2">Save All Skill</a>
                      <?php } ?>
                    </div>
                    <div>
                      <div class="d-flex">
                        <a class="btn btn-primary d-none" id="edit_man_power" href="#">Edit</a>
                        <!-- <form action="<?= base_url() ?>master_man_power/detail_man_power/delete" method="POST">
                          <button type="submit" class="btn btn-danger ms-2 d-none" id="hapus_man_power" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                        </form> -->
                        <button class="btn btn-danger ms-2 d-none" id="hapus_man_power" onclick="hapusManPower()">Hapus</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="data_man_power" class="table table-bordered table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th class="text-center fs-5">Nama</th>
                          <th class="text-center fs-5">NPK</th>
                          <!-- <th>Line</th>
                          <th>Mesin</th>
                          <th>Skill</th> -->
                          <th class="text-center fs-5">Foto</th>
                          <th class="text-center fs-5">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $index_data_man_power = 0;
                        foreach ($data_man_power as $d_mp) : ?>
                          <tr>
                            <td class="fs-5 text-center"><?= $d_mp['nama'] ?></td>
                            <td class="fs-5 text-center" id="npk_<?= $index_data_man_power ?>"><?= sprintf('%04d', $d_mp['npk']) ?></td>
                            <!-- <td></td>
                            <td></td>
                            <td></td> -->
                            <td class="text-center"><img src="<?= base_url() ?>uploads/<?= $d_mp['foto'] ?>" alt="" style="height: 200px"></td>
                            <td>
                              <div class="d-flex justify-content-center">
                                <!-- <a href="<?= base_url() ?>master_man_power/detail_man_power/<?= $d_mp['id_man_power'] ?>" class="btn btn-primary" style="width: 150px">Edit</a>
                                &nbsp
                                <form action="<?= base_url() ?>master_man_power/detail_man_power/delete" method="POST">
                                  <input type="hidden" name="id_man_power" value="<?= $d_mp['id_man_power'] ?>">
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')" style="width: 150px">Hapus</button>
                                </form> -->
                                <button type="button" class="btn btn-outline-dark" id="checked_man_power_<?= $index_data_man_power ?>" style="border-color: #212529" onclick="checkedManPower(<?= $d_mp['id_man_power'] ?>, <?= $index_data_man_power ?>)">✔</button>
                              </div>
                            </td>
                          </tr>
                        <?php $index_data_man_power++;
                        endforeach; ?>
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
<div class="modal fade modal_tambah_man_power" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Tambah Man Power</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url() ?>master_man_power/add_man_power" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label class="form-label">NPK</label>
                <input type="text" class="form-control" id="npk" name="npk">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="float: right;">
          <input type="submit" class="btn btn-primary float-end" value="Tambah">
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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

<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
  $(document).ready(
    <?php if (session()->has('success')) { ?> window.alert('<?= session()->getFlashdata('success') ?>') <?php } ?> <?php if (session()->has('failed')) { ?> window.alert('<?= session()->getFlashdata('failed') ?>') <?php } ?>
  );
  $(document).ready(function() {
    $('#data_man_power').DataTable({
      "order": []
    });
  });

  let checkedId = [];
  let checkedNpk = [];

  function checkedManPower(id_man_power, index) {
    let editManPowerElement = document.querySelector('#edit_man_power');
    let hapusManPowerElement = document.querySelector('#hapus_man_power');
    let checked_man_powerELement = document.querySelector('#checked_man_power_' + index);
    let npkElement = document.querySelector('#npk_' + index);

    console.log({
      editManPowerElement,
      hapusManPowerElement,
      checked_man_powerELement
    })

    if (checkedId.length > 0) {
      editManPowerElement.classList.add('d-none');
      editManPowerElement.setAttribute('href', '#');
    } else {
      editManPowerElement.classList.remove('d-none');
      hapusManPowerElement.classList.remove('d-none');
    }

    checkedId.push(id_man_power);
    checkedNpk.push(npkElement.textContent);

    if (checkedId.length === 1) {
      editManPowerElement.setAttribute('href', `<?= base_url() ?>master_man_power/detail_man_power/${checkedId[0]}`);
    }

    checked_man_powerELement.setAttribute('onclick', `uncheckedManPower(${id_man_power}, ${index})`);
    checked_man_powerELement.style.backgroundColor = '#212529';
    checked_man_powerELement.style.color = '#FFFFFF';
  }

  function uncheckedManPower(id_man_power, index) {
    let editManPowerElement = document.querySelector('#edit_man_power');
    let hapusManPowerElement = document.querySelector('#hapus_man_power');
    let checked_man_powerELement = document.querySelector('#checked_man_power_' + index);
    let npkELement = document.querySelector('#npk_' + index);
    checkedId = checkedId.filter(function(checked) {
      return checked !== id_man_power;
    });
    checkedNpk = checkedNpk.filter(function(checked) {
      return checked !== npkELement.textContent;
    });

    if (checkedId.length > 1) {
      editManPowerElement.classList.add('d-none');
      // checkedId.push(id_man_power);

    } else if (checkedId.length === 1) {
      editManPowerElement.classList.remove('d-none');
      editManPowerElement.setAttribute('href', `<?= base_url() ?>master_man_power/detail_man_power/${checkedId[0]}`);
    } else {
      editManPowerElement.classList.add('d-none');
      hapusManPowerElement.classList.add('d-none');
      // checkedId.push(id_man_power);
    }
    checked_man_powerELement.setAttribute('onclick', `checkedManPower(${id_man_power}, ${index})`);
    checked_man_powerELement.style.backgroundColor = 'transparent';
    checked_man_powerELement.style.color = '#212529';
  }

  function hapusManPower() {
    $('#loading-modal').modal('show');
    console.log(checkedNpk);
    $.ajax({
      url: '<?= base_url() ?>master_man_power/detail_man_power/delete',
      type: 'POST',
      data: {
        checkedId: checkedId,
        checkedNpk: checkedNpk,
      },
      dataType: 'json',
      success: function(data) {
        checkedId = [];
        checkedNpk = [];
        console.log(data);
        window.location.href = "<?= base_url() ?>master_man_power";
        $('#loading-modal').modal('hide');
      }
    });
  }
</script>
<?= $this->endSection(); ?>