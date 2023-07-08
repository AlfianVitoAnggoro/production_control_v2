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
                  <h4 class="box-title">Check Data Rack</h4>
                </div>
                <div class="row mt-3">
                  <div class="col-2 col-xl-2">
                    <div class="box-header with-border">
                      <h4 class="box-title">QR Code</h4>
                      <input type="text" class="form-control" placeholder="Input QR-Code" id="qr" required>
                      <button id="add-button" type="button" form="rack-form" class="btn btn-primary mt-3">Add</button>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <form id="rack-form" action="<?= base_url() ?>input_data_rack" method="post">
                      <table id="data_rak" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                          <tr>
                            <th>No Rack</th>
                            <th>ID</th>
                            <th>Item</th>
                            <th>QTY</th>
                            <th>Entry Date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                      </table>
                      <input type="text" id="rack" hidden>
                    </form>
                    <button type="submit" form="rack-form" class="btn btn-success">Submit</button>
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

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    $('#data_rak').DataTable({
      "responsive": true,
      "autoWidth": false,
      "order": []
    });
    $('.modal .select2').select2({
      dropdownParent: $('.modal')
    });

    // testFecth();
  });
</script>

<script type="text/javascript">
  const input = document.getElementById('qr');
  const submitButton = document.getElementById('submit-button');
  const formData = new FormData();
  const dataRack = <?= json_encode($datas) ?>;

  // fungsi untuk mengisi data ke dalam tabel
  function updateTableData(data) {
    const tableBody = document.getElementById('table-body');
    tableBody.innerHTML = '';

    let check = false;

    dataRack.forEach(function(itemRack) {
      data.forEach(function(itemData) {
        if (itemRack.pn_qr === itemData.pn_qr) {
          check = true;
        }
      });
    });

    if (check == true) {
      dataRack.forEach(function(row) {
        if (input.value == row.pn_qr) {
          const newRow = document.createElement('tr');

          const rack = document.getElementById('rack');
          rack.setAttribute('value', row.pn_qr)
          rack.setAttribute('name', 'rack')
          const pn_qrCell = document.createElement('td');
          const pn_qrInput = document.createElement('input');
          pn_qrInput.setAttribute('type', 'text');
          pn_qrInput.setAttribute('class', 'form-control');
          pn_qrInput.setAttribute('name', 'pn_qr[]');
          pn_qrInput.setAttribute('value', row.pn_qr);
          pn_qrCell.appendChild(pn_qrInput);
          newRow.appendChild(pn_qrCell);

          const barcodeCell = document.createElement('td');
          const barcodeInput = document.createElement('input');
          barcodeInput.setAttribute('type', 'text');
          barcodeInput.setAttribute('class', 'form-control');
          barcodeInput.setAttribute('name', 'barcode[]');
          barcodeInput.setAttribute('id', 'barcode');
          barcodeInput.setAttribute('value', row.barcode);
          barcodeCell.appendChild(barcodeInput);
          newRow.appendChild(barcodeCell);

          const itemCell = document.createElement('td');
          const itemInput = document.createElement('input');
          itemInput.setAttribute('type', 'text');
          itemInput.setAttribute('class', 'form-control');
          itemInput.setAttribute('name', 'item[]');
          itemInput.setAttribute('value', row.item);
          itemCell.appendChild(itemInput);
          newRow.appendChild(itemCell);

          const qtyCell = document.createElement('td');
          const qtyInput = document.createElement('input');
          qtyInput.setAttribute('type', 'text');
          qtyInput.setAttribute('class', 'form-control');
          qtyInput.setAttribute('name', 'qty[]');
          qtyInput.setAttribute('value', row.qty);
          qtyCell.appendChild(qtyInput);
          newRow.appendChild(qtyCell);

          const entryDateCell = document.createElement('td');
          const entryDateInput = document.createElement('input');
          entryDateInput.setAttribute('type', 'text');
          entryDateInput.setAttribute('class', 'form-control');
          entryDateInput.setAttribute('name', 'entry_date[]');
          entryDateInput.setAttribute('value', row.entry_date);
          entryDateCell.appendChild(entryDateInput);
          newRow.appendChild(entryDateCell);

          // Tambahkan aksi yang sesuai di sini
          const actionCell = document.createElement('td');
          const deleteButton = document.createElement('button');
          deleteButton.setAttribute('type', 'button');
          deleteButton.setAttribute('class', 'btn btn-danger');
          deleteButton.innerHTML = 'Delete';
          deleteButton.addEventListener('click', function() {
            // Hapus baris saat tombol "Delete" diklik
            tableBody.removeChild(newRow);
            rowData = rowData.filter(function(data) {
              return data.pn_qr !== pn_qrInput.value;
            });
          });
          actionCell.appendChild(deleteButton);
          newRow.appendChild(actionCell);

          tableBody.appendChild(newRow);

          // Menambahkan data ke FormData
          formData.append('pn_qr[]', row.pn_qr);
          formData.append('item[]', row.item);
          formData.append('barcode[]', row.barcode);
          formData.append('qty[]', row.qty);
          formData.append('entry_date[]', row.entry_date);
        }
      });
    } else {
      data.forEach(function(row) {
        const newRow = document.createElement('tr');

        const pn_qrCell = document.createElement('td');
        const pn_qrInput = document.createElement('input');
        pn_qrInput.setAttribute('type', 'text');
        pn_qrInput.setAttribute('class', 'form-control');
        pn_qrInput.setAttribute('name', 'pn_qr[]');
        pn_qrInput.setAttribute('value', row.pn_qr);
        pn_qrCell.appendChild(pn_qrInput);
        newRow.appendChild(pn_qrCell);

        const barcodeCell = document.createElement('td');
        const barcodeInput = document.createElement('input');
        barcodeInput.setAttribute('type', 'text');
        barcodeInput.setAttribute('class', 'form-control');
        barcodeInput.setAttribute('name', 'barcode[]');
        barcodeInput.setAttribute('id', 'barcode');
        barcodeInput.setAttribute('value', row.barcode);
        barcodeCell.appendChild(barcodeInput);
        newRow.appendChild(barcodeCell);

        const itemCell = document.createElement('td');
        const itemInput = document.createElement('input');
        itemInput.setAttribute('type', 'text');
        itemInput.setAttribute('class', 'form-control');
        itemInput.setAttribute('name', 'item[]');
        itemInput.setAttribute('value', row.item);
        itemCell.appendChild(itemInput);
        newRow.appendChild(itemCell);

        const qtyCell = document.createElement('td');
        const qtyInput = document.createElement('input');
        qtyInput.setAttribute('type', 'text');
        qtyInput.setAttribute('class', 'form-control');
        qtyInput.setAttribute('name', 'qty[]');
        qtyInput.setAttribute('value', row.qty);
        qtyCell.appendChild(qtyInput);
        newRow.appendChild(qtyCell);

        const entryDateCell = document.createElement('td');
        const entryDateInput = document.createElement('input');
        entryDateInput.setAttribute('type', 'text');
        entryDateInput.setAttribute('class', 'form-control');
        entryDateInput.setAttribute('name', 'entry_date[]');
        entryDateInput.setAttribute('value', row.entry_date);
        entryDateCell.appendChild(entryDateInput);
        newRow.appendChild(entryDateCell);

        // Tambahkan aksi yang sesuai di sini
        const actionCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.setAttribute('type', 'button');
        deleteButton.setAttribute('class', 'btn btn-danger');
        deleteButton.innerHTML = 'Delete';
        deleteButton.addEventListener('click', function() {
          // Hapus baris saat tombol "Delete" diklik
          tableBody.removeChild(newRow);
          rowData = rowData.filter(function(data) {
            return data.pn_qr !== pn_qrInput.value;
          });
        });
        actionCell.appendChild(deleteButton);
        newRow.appendChild(actionCell);

        tableBody.appendChild(newRow);

        // Menambahkan data ke FormData
        formData.append('pn_qr[]', row.pn_qr);
        formData.append('item[]', row.item);
        formData.append('barcode[]', row.barcode);
        formData.append('qty[]', row.qty);
        formData.append('entry_date[]', row.entry_date);
      });
    }
  }

  // fungsi untuk menangani respons dari permintaan GET
  function handleResponse() {
    if (this.readyState === 4 && this.status === 200) {
      const data = JSON.parse(this.responseText);
      if (data.length === 0) {
        alert("Data kosong");
      } else {

        updateTableData(data);
      }
    } else if (this.readyState === 4) {
      alert("Tidak ada koneksi");
    }
  }

  // fungsi untuk mengirimkan permintaan GET
  function sendGetRequest(url) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = handleResponse;
    xhr.send();
  }

  // event listener untuk input
  input.addEventListener('change', function(event) {
    const content = event.target.value;
    const url = "http://portal3.incoe.astra.co.id/production_control_v2/api/get_detail_rak/" + content;
    sendGetRequest(url);
  });


  // event listener untuk tombol submit
  submitButton.addEventListener('click', function(event) {
    event.preventDefault();

    const formData = new FormData();

    // Menambahkan data dari setiap baris ke objek FormData
    rowData.forEach(function(data, index) {
      formData.append(`pn_qr_${index}`, data.pn_qr);
      formData.append(`item_${index}`, data.item);
      formData.append(`barcode_${index}`, data.barcode);
      formData.append(`qty_${index}`, data.qty);
      formData.append(`entry_date_${index}`, data.entry_date);
    });

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'base_url()/input_data_rack', true);
    xhr.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        alert('Data berhasil dikirim');
      } else if (this.readyState === 4) {
        alert('Terjadi kesalahan saat mengirim data');
      }
    };
    xhr.send(formData);
  });
</script>

<script type="text/javascript">
  let rowData = []; // Menyimpan data baris

  // fungsi untuk mengisi data ke dalam tabel
  function addDataBarcode(data) {
    const tableBody = document.getElementById('table-body');
    const newRow = document.createElement('tr');

    const pn_qrCell = document.createElement('td');
    const pn_qrInput = document.createElement('input');
    pn_qrInput.setAttribute('type', 'text');
    pn_qrInput.setAttribute('class', 'form-control');
    pn_qrInput.setAttribute('name', 'pn_qr[]');
    pn_qrCell.appendChild(pn_qrInput);
    newRow.appendChild(pn_qrCell);

    const barcodeCell = document.createElement('td');
    const barcodeInput = document.createElement('input');
    barcodeInput.setAttribute('type', 'text');
    barcodeInput.setAttribute('class', 'form-control');
    barcodeInput.setAttribute('name', 'barcode[]');
    barcodeInput.setAttribute('id', 'barcode');
    barcodeInput.addEventListener('change', function(event) {
      const content = event.target.value;
      const url = "http://portal3.incoe.astra.co.id/production_control_v2/api/get_detail_barcode/" + content;
      sendGetDataBarcode(url, barcodeInput);
    });
    barcodeCell.appendChild(barcodeInput);
    newRow.appendChild(barcodeCell);

    const itemCell = document.createElement('td');
    const itemInput = document.createElement('input');
    itemInput.setAttribute('type', 'text');
    itemInput.setAttribute('class', 'form-control');
    itemInput.setAttribute('name', 'item[]');
    itemCell.appendChild(itemInput);
    newRow.appendChild(itemCell);

    const qtyCell = document.createElement('td');
    const qtyInput = document.createElement('input');
    qtyInput.setAttribute('type', 'text');
    qtyInput.setAttribute('class', 'form-control');
    qtyInput.setAttribute('name', 'qty[]');
    qtyCell.appendChild(qtyInput);
    newRow.appendChild(qtyCell);

    const entryDateCell = document.createElement('td');
    const entryDateInput = document.createElement('input');
    entryDateInput.setAttribute('type', 'text');
    entryDateInput.setAttribute('class', 'form-control');
    entryDateInput.setAttribute('name', 'entry_date[]');
    entryDateCell.appendChild(entryDateInput);
    newRow.appendChild(entryDateCell);

    const actionCell = document.createElement('td');
    const deleteButton = document.createElement('button');
    deleteButton.setAttribute('type', 'button');
    deleteButton.setAttribute('class', 'btn btn-danger');
    deleteButton.innerHTML = 'Delete';
    deleteButton.addEventListener('click', function() {
      // Hapus baris saat tombol "Delete" diklik
      tableBody.removeChild(newRow);
      rowData = rowData.filter(function(data) {
        return data.pn_qr !== pn_qrInput.value;
      });
    });
    actionCell.appendChild(deleteButton);
    newRow.appendChild(actionCell);

    tableBody.appendChild(newRow);

    // Tambahkan data baru ke dalam variabel rowData
    rowData.push({
      pn_qr: pn_qrInput.value,
      item: itemInput.value,
      barcode: barcodeInput.value,
      qty: qtyInput.value,
      entry_date: entryDateInput.value
    });

    // Reset nilai input
    pn_qrInput.value = '';
    itemInput.value = '';
    barcodeInput.value = '';
    qtyInput.value = '';
    entryDateInput.value = '';
  }

  // Fungsi untuk menambahkan input baru saat tombol "Add" diklik
  function addRowInput() {
    addDataBarcode([]);
  }

  // Event listener untuk tombol "Add"
  const addButton = document.getElementById('add-button');
  addButton.addEventListener('click', addRowInput);

  // fungsi untuk menangani respons dari permintaan GET
  function response(barcodeInput) {
    if (this.readyState === 4 && this.status === 200) {
      const data = JSON.parse(this.responseText);
      if (data.length === 0) {
        alert("Data kosong");
      } else {
        barcodeInput.parentNode.nextElementSibling.firstChild.value = data[0].ITEM;
        barcodeInput.parentNode.nextElementSibling.nextElementSibling.firstChild.value = data[0].QTY;
        barcodeInput.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.firstChild.value = data[0].ENTRY_DATE;
      }
    } else if (this.readyState === 4) {
      alert("Tidak ada koneksi");
    }
  }

  // fungsi untuk mengirimkan permintaan GET
  function sendGetDataBarcode(url, barcodeInput) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = response.bind(xhr, barcodeInput);
    xhr.send();
  }
</script>

<!-- <script>
  function testFecth() {
    // Memindahkan fokus ke elemen berikutnya
    $.ajax({
      url: "http://portal3.incoe.astra.co.id/production_control_v2/api/get_detail_rak/RPP001",
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        console.log(data);
      }
    })
  }
</script> -->

<?= $this->endSection(); ?>