<?= $this->extend('template/layout'); ?>
<?= $this->section('style') ?>
  <style>
  </style>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-full">
    <!-- Main content -->
    <section class="content">
      <form action="<?= base_url() ?>master_man_power_kasubsie/detail_man_power/edit" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-xl-12 col-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 style="font-size: 32px">Detail Man Power Kasubsie</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-4 bg-light d-flex justify-content-center align-items-center mx-3 p-0" id="image" style="border-radius: 20px; width: 300px; height: 400px;">
                    <?php if (!empty($data_man_power[0]['foto'])) { ?>
                      <img src="<?= base_url() ?>uploads/<?= $data_man_power[0]['foto'] ?>" style="border-radius: 20px; width: 300px; height: 400px;" alt="">
                    <?php } else { ?>
                      <img src="<?= base_url() ?>uploads/default_user.png" style="border-radius: 20px; opacity: 60%" alt="">
                    <?php } ?>
                  </div>
                  <div class="col">
                    <div class="table-responsive">
                      <table id="" class="table">
                        <tbody class="form_man_power">
                          <tr>
                            <th style="font-size: 20px">Nama</th>
                            <td>
                              <input type="text" class="form-control" style="font-size: 20px" name="nama" value="<?= $data_man_power[0]['nama']; ?>" style="width: 250px;">
                              <input type="hidden" class="form-control" name="id_man_power" id="id_man_power" value="<?= $data_man_power[0]['id_man_power']; ?>">
                            </td>
                          </tr>
                          <tr>
                            <th style="font-size: 20px">NPK</th>
                            <td>
                              <input type="text" class="form-control" style="font-size: 20px" name="npk" value="<?= sprintf('%04d', $data_man_power[0]['npk']); ?>" style="width: 250px;">
                            </td>
                          </tr>
                          <tr>
                            <th style="font-size: 20px">Foto</th>
                            <td><input type="file" class="form-control" style="font-size: 20px" name="foto" id="foto" accept="image/*" style="width: 250px;"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class=" text-center my-2 button">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
</script>
<script>
  const foto = document.getElementById('foto');
  const preview = document.getElementById('image');

  foto.addEventListener('change', function() {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.addEventListener('load', function() {
        // const image = new Image();
        // image.src = ;

        preview.innerHTML = `<img src="${reader.result}" style="border-radius: 20px; width: 300px; height: 400px;" alt="">`;
        // preview.innerHTML = '';
        // preview.appendChild(image);
      });

      reader.readAsDataURL(file);
    } else {
      preview.innerHTML = '<img src="<?= base_url() ?>uploads/default_user.png" style="border-radius: 20px; opacity: 60%" alt="">';
    }
  });
</script>
<?= $this->endSection(); ?>