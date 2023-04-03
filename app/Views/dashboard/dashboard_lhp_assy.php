<?= $this->extend('template/dashboard/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?=date_default_timezone_set('Asia/Jakarta');?>
<?php
    $current_date = idate('m');
    if ($current_date != 12) {
        $previous_date = $current_date - 1;
    } else {
        $previous_date = 12;
    }    
?>



<div class="content-wrapper" style="margin-left:0;">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
            <!-- <div class="row">
                <div class="col-12" style="text-align:center;">
                    <h1>Performance Dashboard</h1>
                    <br>
                </div>
            </div> -->
            <div class="row">
				<div class="col-12">														
					<div class="box no-shadow mb-0 bg-transparent">
						<div class="box-header no-border px-0">
							<!-- <h4 class="box-title">Current Running Courses</h4>	 -->
                            <form action="<?=base_url()?>dashboard/assy" method="POST">
                                <div class="row">
                                    <div class="col-3">
                                        <select class="form-select" name="jenis_dashboard" id="jenis_dashboard">
                                            <option value="1">Efficiency</option>
                                            <option value="2">Unit / MH</option>
                                        </select>
                                    </div>

                                    <div class="col-3" style="display:flex;">
                                        <select class="form-select" name="parent_filter" id="parent_filter">
                                            <option value="line" <?= ($parent_filter == 'line') ? 'selected':''?>>Line</option>
                                            <option value="grup" <?= ($parent_filter == 'grup') ? 'selected':''?>>Grup</option>
                                            <option value="kasubsie" <?= ($parent_filter == 'kasubsie') ? 'selected':''?>>Kasubsie</option>
                                        </select>
                                        &nbsp;
                                        <select class="form-select" name="child_filter" id="child_filter">
                                            <option value="0" <?= ($child_filter == '0') ? 'selected':''?>>All</option>
                                            <?php for ($i=1; $i <= 7 ; $i++) { ?>
                                                <option value="<?=$i?>" <?= ($child_filter == $i) ? 'selected':''?>>Line <?=$i?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-3">
                                        <input type="month" class="form-control" name="bulan" id="bulan" value="<?= $bulan ?>">
                                    </div>
                                    <div class="col-3" style="display: flex; flex-direction: column;">
                                        <button class="btn btn-sm btn-success"> Filter </button>
                                    </div>
                                </div>
                            </form>
							<!-- <ul class="box-controls pull-right d-md-flex d-none">
							  <li>
								<button class="btn btn-primary-light px-10">View All</button>
							  </li>
							</ul> -->
						</div>
					</div>
				</div>
                
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box pull-up">
						<div class="box-body">	
							<div class="bg-primary rounded">
								<h5 class="text-white text-center p-10">Year To Date</h5>
							</div>							
						</div>
                        <div class="box-body text-center">
                            <h1 class="countnm fs-50" style="margin-top: -30px;"><?=json_encode($data_all_year)?>%</h1>
                        </div>				
					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box pull-up">
						<div class="box-body">	
							<div class="bg-warning rounded">
								<h5 class="text-white text-center p-10">Target 2023</h5>
							</div>							
						</div>	
                        <div class="box-body text-center">
                            <h1 class="countnm fs-50" style="margin-top: -30px;">85%</h1>
                        </div>						
					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box pull-up">
						<div class="box-body">	
							<div class="bg-danger rounded">
								<h5 class="text-white text-center p-10">Previous Month (<?=date('F', mktime(0, 0, 0, $previous_date, 10))?>)</h5>
							</div>								
						</div>
                        <div class="box-body text-center">
                            <h1 class="countnm fs-50" style="margin-top: -30px;"><?=json_encode($data_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1])?>%</h1>
                        </div>					
					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box pull-up">
						<div class="box-body">	
							<div class="bg-info rounded">
								<h5 class="text-white text-center p-10"> Current Month (<?=date('F', mktime(0, 0, 0, $current_date, 10))?>)</h5>
							</div>						
						</div>	
                        <div class="box-body text-center">
                            <h1 class="countnm fs-50" style="margin-top: -30px;"><?=json_encode($data_all_month[date('n', mktime(0, 0, 0, $current_date, 10)) - 1])?>%</h1>
                        </div>
					</div>
				</div>
			</div>

			<div class="row" id="efficiency-wrapper">
				<div class="col-xl-8 col-12">
					<div class="box">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure>
						</div>
					</div>										
				</div>
				<div class="col-xl-4 col-12">
					<div class="box">
						<div class="box-body">							
							<div class="box no-shadow mb-0">
								<div class="box-body px-0 pt-0">
                                    <figure class="highcharts-figure">
                                        <div id="container1"></div>
                                    </figure>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>
            
            
            <div class="row" id="grup-wrapper" style="display:none">
				<div class="col-xl-8 col-12">
					<div class="box">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="chart-grup"></div>
                            </figure>
						</div>
					</div>										
				</div>
				<div class="col-xl-4 col-12">
                    <div class="box pull-up">
						<div class="box-body">	
							<div class="bg-primary rounded">
								<h5 class="text-white text-center p-10">Efficiency Grup</h5>
							</div>							
						</div>
                        <div class="box-body text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Grup</th>
                                        <th scope="col">Efficiency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>A</td>
                                        <td>80%</td>
                                    </tr>
                                    <tr>
                                        <td>B</td>
                                        <td>80%</td>
                                    </tr>
                                    <tr>
                                        <td>C</td>
                                        <td>80%</td>
                                    </tr>
                                    <tr>
                                        <td>D</td>
                                        <td>80%</td>
                                    </tr>
                            </table>
                        </div>				
					</div>
				</div>
			</div>

            <div class="row" id="kasubsie-wrapper" style="display:none">
				<div class="col-xl-8 col-12">
					<div class="box">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="chart-kss"></div>
                            </figure>
						</div>
					</div>										
				</div>
				<div class="col-xl-4 col-12">
                    <div class="box pull-up">
						<div class="box-body">	
							<div class="bg-primary rounded">
								<h5 class="text-white text-center p-10">Efficiency Kasubsie</h5>
							</div>							
						</div>
                        <div class="box-body text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Kasubsie</th>
                                        <th scope="col">Efficiency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>80%</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>80%</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>80%</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>80%</td>
                                    </tr>
                            </table>
                        </div>				
					</div>
				</div>
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  
<!-- MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="width:120%;">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Detail Line Stop</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
            <div class="modal-body">
                <table class="table" id="tbl_breakdown" width="100%">
                    <thead>
                        <tr>
                            <td>No WO</td>
                            <td>Type Battery</td>
                            <td>Jenis Line Stop</td>
                            <td>Proses Line Stop</td>
                            <td>Uraian</td>
                            <td>Total Menit</td>
                        </tr>
                    </thead>
                    <tbody id="data_breakdown">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="float: right;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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
        // $('#tbl_breakdown').DataTable();
    } );

    Highcharts.chart('container1', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Efficiency'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: '%'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'All Line',
            data: <?php echo json_encode($data_all_month); ?>

        }
    ]
    });

    // GENERATE X AXIS DATE
    <?php
        // $dates=array();

        // for($d=1; $d<=31; $d++)
        // {
        //     $time=mktime(12, 0, 0, date('m'), $d, date('Y'));
        //     if (date('m', $time)==date('m'))
        //         $dates[]=date('Y-m-d', $time);
        // }

            $dates = array();

            date_default_timezone_set('Asia/Jakarta');
            $start = date('Y-m-01');
            $now = date('Y-m-d');

            $current_month = date('Y-m');
            if ($bulan != null OR $bulan != $current_month) {
                $start = date('Y-m-01', strtotime($bulan));
                $now = date('Y-m-t', strtotime($bulan));
            }

            while (strtotime($start) <= strtotime($now)) {
                array_push($dates, $start);
                $start = date ("Y-m-d", strtotime("+1 day", strtotime($start)));
            }
    ?>

    Highcharts.chart('container', {

        title: {
            text: 'Efficiency Per Line',
            align: 'center'
        },

        yAxis: {
            title: {
                text: '%'
            },
            // categories: [20, 40, 60, 80, 100],
        },

        xAxis: {
            categories: <?= json_encode($dates); ?>
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        

        series: [
            <?php if (($parent_filter == 'line' OR $parent_filter == null)  AND ($child_filter == null OR $child_filter == 0)) { ?>
                {
                    name: 'Line 1',
                    data: <?php echo json_encode($data_line_1); ?>,
                    point: {
                        events: {
                            click: function() {
                                var date = this.category;
                                var line = 1;
                                $.ajax({
                                    url: "<?= base_url('dashboard/assy/get_data_line_stop'); ?>",
                                    type: "POST",
                                    data: {
                                        date: date,
                                        line: line
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                    '<td>' + data[i].no_wo + '</td>' +
                                                    '<td>' + data[i].type_battery + '</td>' +
                                                    '<td>' + data[i].jenis_breakdown + '</td>' +
                                                    '<td>' + data[i].proses_breakdown + '</td>' +
                                                    '<td>' + data[i].uraian_breakdown + '</td>' +
                                                    '<td>' + data[i].menit_breakdown + '</td>' +
                                                '</tr>';
                                        }
                                        $('#data_breakdown').html(html);
                                        $('.modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                },
                {
                    name: 'Line 2',
                    data: <?php echo json_encode($data_line_2); ?>,
                    point: {
                        events: {
                            click: function() {
                                var date = this.category;
                                var line = 2;
                                $.ajax({
                                    url: "<?= base_url('dashboard/assy/get_data_line_stop'); ?>",
                                    type: "POST",
                                    data: {
                                        date: date,
                                        line: line
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                        '<td>' + data[i].no_wo + '</td>' +
                                                        '<td>' + data[i].type_battery + '</td>' +
                                                        '<td>' + data[i].jenis_breakdown + '</td>' +
                                                        '<td>' + data[i].proses_breakdown + '</td>' +
                                                        '<td>' + data[i].uraian_breakdown + '</td>' +
                                                        '<td>' + data[i].menit_breakdown + '</td>' +
                                                    '</tr>';
                                        }
                                        $('#data_breakdown').html(html);
                                        $('.modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                },
                {
                    name: 'Line 3',
                    data: <?php echo json_encode($data_line_3); ?>,
                    point: {
                        events: {
                            click: function() {
                                var date = this.category;
                                var line = 3;
                                $.ajax({
                                    url: "<?= base_url('dashboard/assy/get_data_line_stop'); ?>",
                                    type: "POST",
                                    data: {
                                        date: date,
                                        line: line
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                '<td>' + data[i].no_wo + '</td>' +
                                                '<td>' + data[i].type_battery + '</td>' +
                                                '<td>' + data[i].jenis_breakdown + '</td>' +
                                                '<td>' + data[i].proses_breakdown + '</td>' +
                                                '<td>' + data[i].uraian_breakdown + '</td>' +
                                                '<td>' + data[i].menit_breakdown + '</td>' +
                                                '</tr>';
                                        }
                                        $('#data_breakdown').html(html);
                                        $('.modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                },
                {
                    name: 'Line 4',
                    data: <?php echo json_encode($data_line_4); ?>,
                    point: {
                        events: {
                            click: function() {
                                var date = this.category;
                                var line = 4;
                                $.ajax({
                                    url: "<?= base_url('dashboard/assy/get_data_line_stop'); ?>",
                                    type: "POST",
                                    data: {
                                        date: date,
                                        line: line
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                '<td>' + data[i].no_wo + '</td>' +
                                                '<td>' + data[i].type_battery + '</td>' +
                                                '<td>' + data[i].jenis_breakdown + '</td>' +
                                                '<td>' + data[i].proses_breakdown + '</td>' +
                                                '<td>' + data[i].uraian_breakdown + '</td>' +
                                                '<td>' + data[i].menit_breakdown + '</td>' +
                                                '</tr>';
                                        }
                                        $('#data_breakdown').html(html);
                                        $('.modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                },
                {
                    name: 'Line 5',
                    data: <?php echo json_encode($data_line_5); ?>,
                    point: {
                        events: {
                            click: function() {
                                var date = this.category;
                                var line = 5;
                                $.ajax({
                                    url: "<?= base_url('dashboard/assy/get_data_line_stop'); ?>",
                                    type: "POST",
                                    data: {
                                        date: date,
                                        line: line
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                '<td>' + data[i].no_wo + '</td>' +
                                                '<td>' + data[i].type_battery + '</td>' +
                                                '<td>' + data[i].jenis_breakdown + '</td>' +
                                                '<td>' + data[i].proses_breakdown + '</td>' +
                                                '<td>' + data[i].uraian_breakdown + '</td>' +
                                                '<td>' + data[i].menit_breakdown + '</td>' +
                                                '</tr>';
                                        }
                                        $('#data_breakdown').html(html);
                                        $('.modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                },
                {
                    name: 'Line 6',
                    data: <?php echo json_encode($data_line_6); ?>,
                    point: {
                        events: {
                            click: function() {
                                var date = this.category;
                                var line = 6;
                                $.ajax({
                                    url: "<?= base_url('dashboard/assy/get_data_line_stop'); ?>",
                                    type: "POST",
                                    data: {
                                        date: date,
                                        line: line
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                '<td>' + data[i].no_wo + '</td>' +
                                                '<td>' + data[i].type_battery + '</td>' +
                                                '<td>' + data[i].jenis_breakdown + '</td>' +
                                                '<td>' + data[i].proses_breakdown + '</td>' +
                                                '<td>' + data[i].uraian_breakdown + '</td>' +
                                                '<td>' + data[i].menit_breakdown + '</td>' +
                                                '</tr>';
                                        }
                                        $('#data_breakdown').html(html);
                                        $('.modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                },
                {
                    name: 'Line 7',
                    data: <?php echo json_encode($data_line_7); ?>,
                    point: {
                        events: {
                            click: function() {
                                var date = this.category;
                                var line = 7;
                                $.ajax({
                                    url: "<?= base_url('dashboard/assy/get_data_line_stop'); ?>",
                                    type: "POST",
                                    data: {
                                        date: date,
                                        line: line
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                '<td>' + data[i].no_wo + '</td>' +
                                                '<td>' + data[i].type_battery + '</td>' +
                                                '<td>' + data[i].jenis_breakdown + '</td>' +
                                                '<td>' + data[i].proses_breakdown + '</td>' +
                                                '<td>' + data[i].uraian_breakdown + '</td>' +
                                                '<td>' + data[i].menit_breakdown + '</td>' +
                                                '</tr>';
                                        }
                                        $('#data_breakdown').html(html);
                                        $('.modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                }
            <?php } ?>

            <?php if ($parent_filter == 'line' AND ($child_filter != null OR $child_filter != 0)) { ?>
                {
                    name: 'Shift 1',
                    data: <?php echo json_encode($data_line_shift_1); ?>,
                    point: {
                        events: {
                            click: function() {
                                var date = this.category;
                                var line = <?=$child_filter?>;
                                var shift = 1;
                                $.ajax({
                                    url: "<?= base_url('dashboard/assy/get_data_line_stop_by_shift'); ?>",
                                    type: "POST",
                                    data: {
                                        date: date,
                                        line: line,
                                        shift: shift
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                '<td>' + data[i].no_wo + '</td>' +
                                                '<td>' + data[i].type_battery + '</td>' +
                                                '<td>' + data[i].jenis_breakdown + '</td>' +
                                                '<td>' + data[i].proses_breakdown + '</td>' +
                                                '<td>' + data[i].uraian_breakdown + '</td>' +
                                                '<td>' + data[i].menit_breakdown + '</td>' +
                                                '</tr>';
                                        }
                                        $('#data_breakdown').html(html);
                                        $('.modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                },
                {
                    name: 'Shift 2',
                    data: <?php echo json_encode($data_line_shift_2); ?>,
                    point: {
                        events: {
                            click: function() {
                                var date = this.category;
                                var line = <?=$child_filter?>;
                                var shift = 2;
                                $.ajax({
                                    url: "<?= base_url('dashboard/assy/get_data_line_stop_by_shift'); ?>",
                                    type: "POST",
                                    data: {
                                        date: date,
                                        line: line,
                                        shift: shift
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                '<td>' + data[i].no_wo + '</td>' +
                                                '<td>' + data[i].type_battery + '</td>' +
                                                '<td>' + data[i].jenis_breakdown + '</td>' +
                                                '<td>' + data[i].proses_breakdown + '</td>' +
                                                '<td>' + data[i].uraian_breakdown + '</td>' +
                                                '<td>' + data[i].menit_breakdown + '</td>' +
                                                '</tr>';
                                        }
                                        $('#data_breakdown').html(html);
                                        $('.modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                },
                {
                    name: 'Shift 3',
                    data: <?php echo json_encode($data_line_shift_3); ?>,
                    point: {
                        events: {
                            click: function() {
                                var date = this.category;
                                var line = <?=$child_filter?>;
                                var shift = 3;
                                $.ajax({
                                    url: "<?= base_url('dashboard/assy/get_data_line_stop_by_shift'); ?>",
                                    type: "POST",
                                    data: {
                                        date: date,
                                        line: line,
                                        shift: shift
                                    },
                                    dataType: "json",
                                    success: function(data) {
                                        var html = '';
                                        var i;
                                        for (i = 0; i < data.length; i++) {
                                            html += '<tr>' +
                                                '<td>' + data[i].no_wo + '</td>' +
                                                '<td>' + data[i].type_battery + '</td>' +
                                                '<td>' + data[i].jenis_breakdown + '</td>' +
                                                '<td>' + data[i].proses_breakdown + '</td>' +
                                                '<td>' + data[i].uraian_breakdown + '</td>' +
                                                '<td>' + data[i].menit_breakdown + '</td>' +
                                                '</tr>';
                                        }
                                        $('#data_breakdown').html(html);
                                        $('.modal').modal('show');
                                    }
                                });
                            }
                        }
                    }
                },
            <?php } ?>


        ],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });

    Highcharts.chart('chart-grup', {

        title: {
            text: 'Efficiency Per Grup',
            align: 'center'
        },

        yAxis: {
            title: {
                text: '%'
            },
            // categories: [20, 40, 60, 80, 100],
        },

        xAxis: {
            categories: <?= json_encode($dates); ?>
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        series: [{
            name: 'Grup A',
            data: [43934, 48656]
        }, {
            name: 'Grup B',
            data: [24916, 37941]
        }, {
            name: 'Grup C',
            data: [11744, 30000]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });

    Highcharts.chart('chart-kss', {

        title: {
            text: 'Efficiency Per Kasubsie',
            align: 'center'
        },

        yAxis: {
            title: {
                text: '%'
            },
            // categories: [20, 40, 60, 80, 100],
        },

        xAxis: {
            categories: <?= json_encode($dates); ?>
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },



        series: [{
            name: 'Grup A',
            data: [43934, 48656, 65165, 81827, 112143, 142383,171533, 165174, 155157, 161454, 154610]
        }, {
            name: 'Grup B',
            data: [24916, 37941, 29742, 29851, 32490, 30282,38121, 36885, 33726, 34243, 31050]
        }, {
            name: 'Grup C',
            data: [11744, 30000, 16005, 19771, 20185, 24377,32147, 30912, 29243, 29213, 25663]
        }, {
            name: 'Grup D',
            data: [11164, 11218, 10077]
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });
</script>
<?= $this->endSection(); ?>