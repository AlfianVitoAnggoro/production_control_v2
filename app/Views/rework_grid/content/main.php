<?= $this->extend('rework_grid/layout/template') ?>
<?= $this->section('content') ?>

<div class="container">
  <div class="row">
    <!-- Start of Form Input Data -->
    <div class="col">
      <div class="text-center mt-3">
        <h3>Form Input Data</h3>
      </div>
      <!-- Start of Form -->
      <form action="<?=base_url()?>grid_rework/save" method="post">
        <?= csrf_field() ?>
        <div class="row row-cols-1 row-cols-md-3 mt-2 g-4">
          <?php for ($i = $start; $i <= $end; $i++) { ?>

            <!-- Start of Machine 1 Input Field -->
            <div class="col">
              <div class="card h-85">
                <div class="card-body">
                  <h5 class="card-title text-center">MC <?= intval($i) ?></h5>
                  <input type="hidden" value="<?= intval($i) ?>" class="form-control" name="id_machine[]" placeholder="Input Here" aria-label="Input <?= intval($i) ?>">
                  <input type="text" class="form-control" name="jumlah[]" placeholder="Input Here" aria-label="Input <?= intval($i) ?>">
                  <div class="text-center mt-3">
                    <button type="submit" class="btn btn-info">Kirim</button>
                  </div>
                </div>
              </div>
              <table class="table table-bordered table-hover mt-2 mb-5">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Tanggal</th>
                    <th class="text-center" scope="col">Jumlah</th>
                    <th class="text-center" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($machine as $mc) { ?>
                    <?php if ($mc['id_machine'] === intval($i)) { ?>
                      <tr>
                        <input type="hidden" name="id" value="<?= $mc['id'] ?>">
                        <input type="hidden" name="idmc" value="<?= $mc['id_machine'] ?>">
                        <td class="text-center"><?= date('d-m-Y H:i', strtotime($mc['created_at'])) ?></td>
                        <td class="text-center"><?= $mc['jumlah'] ?></td>
                        <td>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="edit(<?= $mc['id'] ?>, <?= $mc['id_machine'] ?>, <?= $mc['jumlah'] ?>)">
                            EDIT
                          </button>
                          <button type="button" class="btn btn-danger ml-2" data-bs-toggle="modal" data-bs-target="#static" onclick="del(<?= $mc['id'] ?>, <?= $mc['id_machine'] ?>, <?= $mc['jumlah'] ?>)">DEL</button>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>
        </div>

      </form>

      <div class="d-grid gap-2 col-3 mt-5 mx-auto">
        <a class="btn btn-primary" href="<?=base_url()?>grid_rework/" style="font-size:18px" type="button">Kembali</a>
      </div>

      <form action="<?=base_url()?>grid_rework/edit" method="post">
        <?= csrf_field() ?>
        <?php for ($i = $start; $i <= $end; $i++) { ?>
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
            </div>
          </div>

        <?php } ?>
      </form>

      <form action="<?=base_url()?>grid_rework/delete" method="post">
        <?= csrf_field() ?>
        <?php for ($i = $start; $i <= $end; $i++) { ?>
          <div class="modal fade" id="static" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body" id="delete">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
              </div>
            </div>
          </div>

        <?php } ?>
      </form>
      <!-- End of Machine $i Input Field -->

      <!-- Start of Machine 2 Input Field -->

      <!--  -->
      <!-- End of Machine 3 Input Field -->
    </div>
    <!-- End of Form -->
  </div>
  <!-- End of Form Input Data -->
</div>
</div>

<script>
  function edit(id, id_machine, jumlah) {
    const data = document.querySelector('#edit');
    data.innerHTML = `
      <input type="hidden" name="start" value="<?= $start ?>">
      <input type="hidden" name="end" value="<?= $end ?>">
      <input type="hidden" name="id" value="${id}">
      <input type="hidden" name="idmc" value="${id_machine}">
      <input type="text" class="form-control" name="jumlah" placeholder="Input Here" value="${jumlah}">
      `;
  }

  function del(id, id_machine, jumlah) {
    const data = document.querySelector('#delete');
    data.innerHTML = `
    <input type="hidden" name="start" value="<?= $start ?>">
      <input type="hidden" name="end" value="<?= $end ?>">
      <input type="hidden" name="id" value="${id}">
      <p>Yakin ingin hapus?</p>
    `;
  }
</script>

<?= $this->endSection() ?>