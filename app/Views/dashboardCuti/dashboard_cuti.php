<?= $this->extend('template/form_cuti/layout') ?>
<?= $this->section('style') ?>
<style>
  .month {
    font-size: 50px;
  }

  .day {
    border: 1px solid #ccc;
    height: 140px;
    font-size: 50px;
  }

  .day_exists {
    cursor: pointer;
  }

  .dayOfWeek {
    border: 1px solid #ccc;
    font-size: 50px;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .today {
    background-color: orange;
    color: #fff;
  }

  .week {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
  }

  .weekend {
    background-color: #ff0000;
    color: #fff;
  }

  .number {
    padding: 10px;
    width: 80px;
    border-right: 1px solid black;
  }

  @media screen and (max-width: 768px) {
    .month {
      font-size: 4vw;
    }

    .day {
      border: 1px solid #ccc;
      height: calc(90vh * (1/7));
      font-size: 4vw;
    }

    .p-0.col {
      display: none;
    }

    #judul {
      font-size: 6vw;
    }

    .number {
      padding: 10px;
      width: 100%;
      border-right: 0px;
    }

    .dayOfWeek {
      border: 1px solid #ccc;
      font-size: 4vw;
      height: 100px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #prevMonthBtn,
    #nextMonthBtn,
    #backBtn {
      font-size: 2vw;
      padding: 10px;
    }
  }

  @media screen and (min-width: 769px) and (max-width: 1676px) {
    .month {
      font-size: 4vh;
    }

    .day {
      border: 1px solid #ccc;
      height: calc(90vh * (1/7));
      font-size: 4vh;
    }

    .p-0.col {
      display: none;
    }

    #judul {
      font-size: 4vh;
    }

    .number {
      padding: 10px;
      width: 100%;
      border-right: 0px;
    }

    .dayOfWeek {
      border: 1px solid #ccc;
      font-size: 4vh;
      height: 100px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #prevMonthBtn,
    #nextMonthBtn,
    #backBtn {
      font-size: 2vh;
      padding: 10px;
    }
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-full">
  <!-- Main content -->
  <section class="content">
    <button type="button" class="btn btn-primary" onclick="return window.history.back()" id="backBtn">Back</button>
    <div class="row">
      <div class="col">
        <div class="d-flex justify-content-between align-items-center">
          <h2 class="text-center" id="judul">Calendar</h2>
          <div class="text-center">
            <button id="prevMonthBtn" class="btn btn-primary mr-2">Sebelumnya</button>
            <button id="nextMonthBtn" class="btn btn-primary">Berikutnya</button>
          </div>
        </div>
        <div id="calendarElement" class="row" style="overflow: auto"></div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade modal_mp_tidak_hadir" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center">Nama</th>
                <th class="text-center">Bagian</th>
                <th class="text-center">Line</th>
                <th class="text-center">Group</th>
                <th class="text-center">Kategori</th>
                <th class="text-center">Jenis</th>
                <th class="text-center">Kasubsie</th>
                <th class="text-center">Kasie</th>
                <th class="text-center">Kadept</th>
                <th class="text-center">Kadiv</th>
                <th class="text-center">HRD</th>
              </tr>
            </thead>
            <tbody id="mp_tidak_hadir"></tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer" style="float: right;">
        <div class="d-flex">
          <div class="d-flex align-items-center me-2">
            <div class="me-2" style="background-color: green; height: 10px; width: 10px; border-radius: 50%; border: 1px solid black"></div>
            <div>Approved</div>
          </div>
          <div class="d-flex align-items-center me-2">
            <div class="me-2" style="background-color: red; height: 10px; width: 10px; border-radius: 50%; border: 1px solid black"></div>
            <div>Rejected</div>
          </div>
          <div class="d-flex align-items-center me-2">
            <div class="me-2" style="height: 10px; width: 10px; border-radius: 50%; border: 1px solid black"></div>
            <div>Pending</div>
          </div>
        </div>
        <?php if (session()->get('level') < 6) { ?>
          <a href="<?= base_url() ?>cuti" class="btn btn-primary float-start" id="list_cuti">List Cuti</a>
        <?php } ?>
        <input type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal" aria-label="Close" value="Close">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
  $(document).ready(
    <?php if (session()->has('success')) { ?> window.alert('<?= session()->getFlashdata('success') ?>') <?php } ?> <?php if (session()->has('failed')) { ?> window.alert('<?= session()->getFlashdata('failed') ?>') <?php } ?>
  );
  let line = ['', 1, 2, 3, 4, 5, 6, 7, 'WET-A', 'WET-F', 'MCB'];

  function createCalendar(year, month) {
    var calendarElement = document.getElementById('calendarElement');
    calendarElement.innerHTML = '';

    var date = new Date(year, month, 1);
    var firstDay = date.getDay();
    var daysInMonth = new Date(year, month + 1, 0).getDate();
    var currentDate = new Date();

    var header = document.createElement('h2');
    header.classList.add('text-center', 'fw-bold', 'month');
    header.textContent = date.toLocaleString('default', {
      month: 'long',
      year: 'numeric'
    });
    calendarElement.appendChild(header);

    var daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

    var weekdays = document.createElement('div');
    weekdays.classList.add('week');

    for (var i = 0; i < 7; i++) {
      var dayOfWeek = document.createElement('div');
      dayOfWeek.classList.add('text-center', 'fw-bold', 'dayOfWeek');
      dayOfWeek.textContent = daysOfWeek[i];
      weekdays.appendChild(dayOfWeek);
      if (i === 5 || i === 6) {
        dayOfWeek.classList.add('weekend');
      }
    }

    calendarElement.appendChild(weekdays);

    var currentRow = document.createElement('div');
    currentRow.classList.add('week');

    for (var j = 0; j < firstDay - 1; j++) {
      var emptyCell = document.createElement('div');
      emptyCell.classList.add('day');
      if (j === 5) {
        emptyCell.classList.add('weekend');
      }
      currentRow.appendChild(emptyCell);
    }

    for (var k = 1; k <= daysInMonth; k++) {
      if (date.getDay() === 0 && k == 1) {
        for (var j = 0; j < 6; j++) {
          var emptyCell = document.createElement('div');
          emptyCell.classList.add('day');
          if (j === 5) {
            emptyCell.classList.add('weekend');
          }
          currentRow.appendChild(emptyCell);
        }
        var dayCell = document.createElement('div');
        dayCell.classList.add('day', 'day_exists', 'd-flex', 'fw-bold');
        dayCell.setAttribute('data-bs-toggle', 'modal');
        dayCell.setAttribute('data-bs-target', '.modal_mp_tidak_hadir');
        dayCell.setAttribute('onclick', `showMPTidakHadir(${year}, ${month + 1}, ${k})`);
        var dateCell = document.createElement('div');
        dateCell.textContent = k;
        dateCell.classList.add('number');
        // dateCell.style.padding = '10px';
        // dateCell.style.width = '80px';
        // dateCell.style.borderRight = '1px solid black';
        var mpcutiCell = document.createElement('div');
        mpcutiCell.classList.add('m-0', 'p-1', 'row', 'row-cols-1', `date-${year}-${String(month + 1).padStart(2, '0')}-${String(k).padStart(2, '0')}`);
        // mpcutiCell.style.height = 'fit-content';
        mpcutiCell.style.width = 'calc(100% - 80px)';
        dayCell.appendChild(dateCell);
        dayCell.appendChild(mpcutiCell);
        if (year === currentDate.getFullYear() && month === currentDate.getMonth() && k === currentDate.getDate()) {
          dayCell.classList.add('today');
        }
        if (date.getDay() === 0 || date.getDay() === 6) {
          dayCell.classList.add('weekend');
        }
        currentRow.appendChild(dayCell);

        if (currentRow.children.length === 7) {
          calendarElement.appendChild(currentRow);
          currentRow = document.createElement('div');
          currentRow.classList.add('week');
        }
        date.setDate(date.getDate() + 1);
        if (k === daysInMonth && currentRow.children.length < 7 && currentRow.children.length > 0) {
          do {
            var emptyCell = document.createElement('div');
            emptyCell.classList.add('day');
            if (currentRow.children.length === 6 || currentRow.children.length === 5) {
              emptyCell.classList.add('weekend');
            }
            currentRow.appendChild(emptyCell);
          } while (currentRow.children.length < 7);
        }
      } else {
        var dayCell = document.createElement('div');
        dayCell.classList.add('day', 'day_exists', 'd-flex', 'fw-bold');
        dayCell.setAttribute('data-bs-toggle', 'modal');
        dayCell.setAttribute('data-bs-target', '.modal_mp_tidak_hadir');
        dayCell.setAttribute('onclick', `showMPTidakHadir(${year}, ${month + 1}, ${k})`);
        var dateCell = document.createElement('div');
        dateCell.textContent = k;
        dateCell.classList.add('number');
        // dateCell.style.padding = '10px';
        // dateCell.style.width = '80px';
        // dateCell.style.borderRight = '1px solid black';
        var mpcutiCell = document.createElement('div');
        mpcutiCell.classList.add('m-0', 'p-1', 'row', 'row-cols-1', `date-${year}-${String(month + 1).padStart(2, '0')}-${String(k).padStart(2, '0')}`);
        // mpcutiCell.style.height = 'fit-content';
        mpcutiCell.style.width = 'calc(100% - 80px)';
        dayCell.appendChild(dateCell);
        dayCell.appendChild(mpcutiCell);
        if (year === currentDate.getFullYear() && month === currentDate.getMonth() && k === currentDate.getDate()) {
          dayCell.classList.add('today');
        }
        if (date.getDay() === 0 || date.getDay() === 6) {
          dayCell.classList.add('weekend');
        }
        currentRow.appendChild(dayCell);

        if (currentRow.children.length === 7) {
          calendarElement.appendChild(currentRow);
          currentRow = document.createElement('div');
          currentRow.classList.add('week');
        }
        date.setDate(date.getDate() + 1);
        if (k === daysInMonth && currentRow.children.length < 7 && currentRow.children.length > 0) {
          do {
            var emptyCell = document.createElement('div');
            emptyCell.classList.add('day');
            if (currentRow.children.length === 6 || currentRow.children.length === 5) {
              emptyCell.classList.add('weekend');
            }
            currentRow.appendChild(emptyCell);
          } while (currentRow.children.length < 7);
        }
      }
    }

    if (currentRow.children.length > 0) {
      calendarElement.appendChild(currentRow);
    }
  }

  // Contoh penggunaan
  var currentYear = new Date().getFullYear();
  var currentMonth = new Date().getMonth();
  createCalendar(currentYear, currentMonth);
  $(document).ready(() => {
    getRecordCutiByMonth(currentYear, currentMonth);
  });

  function goToPreviousMonth() {
    currentMonth--;
    if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    }
    createCalendar(currentYear, currentMonth);
    $(document).ready(() => {
      getRecordCutiByMonth(currentYear, currentMonth);
    });
  }

  function goToNextMonth() {
    currentMonth++;
    if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    }
    createCalendar(currentYear, currentMonth);
    $(document).ready(() => {
      getRecordCutiByMonth(currentYear, currentMonth);
    });
  }

  document.getElementById('prevMonthBtn').addEventListener('click', goToPreviousMonth);
  document.getElementById('nextMonthBtn').addEventListener('click', goToNextMonth);

  function getRecordCutiByMonth(currentYear, currentMonth) {
    $.ajax({
      url: '<?= base_url() ?>dashboard_cuti/get_record_cuti_by_month',
      type: 'POST',
      data: {
        month: currentMonth + 1,
        year: currentYear,
      },
      dataType: 'json',
      success: function(data) {
        let dateElement = '';
        // dateTodayElement.innerHTML = '';
        // dateElement.innerHTML = '';
        Object.keys(data?.detail_cuti).forEach(dc_tgl => {
          dateTodayElement = document.querySelector(`.today .date-<?= date('Y-m-d') ?>`);
          dateElement = document.querySelector(`.date-${dc_tgl}`);
          Object.keys(data?.detail_cuti[dc_tgl]).forEach(dc_jenis => {
            if (dc_tgl === '<?= date('Y-m-d') ?>') {
              dateTodayElement.innerHTML += `
                <div class="p-0 col" style="color: white; font-size: 20px; height: fit-content">${dc_jenis} : ${Object.keys(data?.detail_cuti[dc_tgl][dc_jenis]).length}</div>
              `;
            } else {
              dateElement.innerHTML += `
                <div class="p-0 col" style="color: red; font-size: 20px; height: fit-content">${dc_jenis} : ${Object.keys(data?.detail_cuti[dc_tgl][dc_jenis]).length}</div>
              `;
            }
          });
        });
      }
    });
  }

  function ucwords(str) {
    return str.toLowerCase().replace(/(^|\s)\S/g, function(firstLetter) {
      return firstLetter.toUpperCase();
    });
  }

  function showMPTidakHadir(year, month, day) {
    $.ajax({
      url: '<?= base_url() ?>dashboard_cuti/get_record_cuti_by_day',
      type: 'POST',
      data: {
        month: month,
        year: year,
        day: day,
      },
      dataType: 'json',
      success: function(data) {
        let date = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        let status_kasubsie = '';
        document.querySelector('#mp_tidak_hadir').innerHTML = '';
        document.querySelector('.modal-title').textContent = `Tanggal ${day}-${month}-${year}`;
        data?.data_cuti.forEach(dc => {
          if (dc.status_kasubsie == 'rejected')
            status_kasubsie = 'red';
          else if (dc.status_kasubsie == 'approved')
            status_kasubsie = 'green';
          else
            status_kasubsie = 'white';
          if (dc.status_kasie == 'rejected')
            status_kasie = 'red';
          else if (dc.status_kasie == 'approved')
            status_kasie = 'green';
          else
            status_kasie = 'white';
          if (dc.status_kadept == 'rejected')
            status_kadept = 'red';
          else if (dc.status_kadept == 'approved')
            status_kadept = 'green';
          else
            status_kadept = 'white';
          if (dc.status_kadiv == 'rejected')
            status_kadiv = 'red';
          else if (dc.status_kadiv == 'approved')
            status_kadiv = 'green';
          else
            status_kadiv = 'white';
          if (dc.status_hrd == 'rejected')
            status_hrd = 'red';
          else if (dc.status_hrd == 'approved')
            status_hrd = 'green';
          else
            status_hrd = 'white';
          document.querySelector('#mp_tidak_hadir').innerHTML += `
            <tr>
              <td>${dc.nama}</td>
              <td>${dc.sub_bagian}</td>
              <td>${dc.line != 'indirect' ? line[dc.line] : dc.line.toUpperCase()}</td>
              <td>${dc.group_mp}</td>
              <td>${dc.kategori}</td>
              <td>${ucwords(dc.jenis)}</td>
              <td><div class="d-flex justify-content-center"><div style="border: 1px solid black; border-radius: 50%; height: 23px; width: 23px; background-color: ${status_kasubsie}">&nbsp;</div></div></td>
              <td><div class="d-flex justify-content-center"><div style="border: 1px solid black; border-radius: 50%; height: 23px; width: 23px; background-color: ${status_kasie}">&nbsp;</div></div></td>
              <td><div class="d-flex justify-content-center"><div style="border: 1px solid black; border-radius: 50%; height: 23px; width: 23px; background-color: ${status_kadept}">&nbsp;</div></div></td>
              <td><div class="d-flex justify-content-center"><div style="border: 1px solid black; border-radius: 50%; height: 23px; width: 23px; background-color: ${status_kadiv}">&nbsp;</div></div></td>
              <td><div class="d-flex justify-content-center"><div style="border: 1px solid black; border-radius: 50%; height: 23px; width: 23px; background-color: ${status_hrd}">&nbsp;</div></div></td>
            </tr>
          `;
        });
      }
    });
  }
</script>
<?= $this->endSection() ?>