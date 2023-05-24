<?= $this->extend('template/dashboard/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?php
    date_default_timezone_set('Asia/Jakarta');
    $current_date = idate('m', strtotime($bulan));
    if ($current_date != 12) {
        $previous_date = $current_date - 1;
    } else {
        $previous_date = 12;
    }

    if ($child_filter != null AND $child_filter != 0 AND $baby_filter == 'average') {
        $type_chart = 'line';
    } else {
        $type_chart = 'column';
    }

    $data = $data_reject_by_date;
    $merged = array();
    foreach ($data as $item) {
        $name = $item["name"];
        if (!isset($merged[$name])) {
            $merged[$name] = array("name" => $name, "data" => array($item["data"]));
        } else {
            array_push($merged[$name]["data"], $item["data"]);
        }
    }
    $result = array_values($merged);

    $data_daily_persentase = $data_reject_by_date_persentase;
    $merged_daily_persentase = array();
    foreach ($data_daily_persentase as $item) {
        $name = $item["name"];
        if (!isset($merged_daily_persentase[$name])) {
            $merged_daily_persentase[$name] = array("name" => $name, "data" => array($item["data"]));
        } else {
            array_push($merged_daily_persentase[$name]["data"], $item["data"]);
        }
    }
    $result_daily_reject_persentase = array_values($merged_daily_persentase);

    // REMOVE SETTING PERSENTASE
    foreach ($result_daily_reject_persentase as $key => $item) {
        if ($item["name"] === "SETTING ") {
            unset($result_daily_reject_persentase[$key]);
            break;
        }
    }

    $result_daily_reject_persentase_without_setting = array_values($result_daily_reject_persentase);

    // REMOVE SETTING QTY
    foreach ($result as $key => $item) {
        if ($item["name"] === "SETTING ") {
            unset($result[$key]);
            break;
        }
    }

    $result_without_setting = array_values($result);
    
?>

<div class="content-wrapper" style="margin-left:0; margin-top:50px;">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
            <div class="row">
                <div class="box bg-transparent">
                    <div class="box-body" style="display:flex">
                        <div class="col-2">
                            <form action="<?=base_url()?>dashboard/reject" method="POST">
                                <select class="form-select" name="jenis_dashboard" id="jenis_dashboard" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px; display:none;">
                                    <option value="1">Rejection</option>
                                    <option value="2">Unit / MH</option>
                                </select>
                                &nbsp;
                                <select class="form-select" name="parent_filter" id="parent_filter" style="display:none">
                                    <option value="line" <?= ($parent_filter == 'line') ? 'selected':''?>>Line</option>
                                </select>
                                &nbsp;
                                <select class="form-select" name="child_filter" id="child_filter" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px;">
                                    <option value="0" <?= ($child_filter == '0') ? 'selected':''?>>All</option>
                                    <?php for ($i=1; $i <= 7 ; $i++) { ?>
                                        <option value="<?=$i?>" <?= ($child_filter == $i) ? 'selected':''?>>Line <?=$i?></option>
                                    <?php } ?>
                                </select>
                                &nbsp;
                                <select class="form-select" name="baby_filter" id="baby_filter" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px;">
                                    <?php if ($child_filter == 0) { ?>
                                        <option value="average" <?= ($baby_filter == 'average') ? 'selected':''?>>By Average</option>
                                        <option value="line" <?= ($baby_filter == 'line') ? 'selected':''?>>By Line</option>
                                    <?php } else { ?>
                                        <option value="average" <?= ($baby_filter == 'average') ? 'selected':''?>>By Average</option>
                                        <!-- <option value="shift" <?= ($baby_filter == 'shift') ? 'selected':''?>>By Shift</option>
                                        <option value="grup" <?= ($baby_filter == 'grup') ? 'selected':''?>>By Grup</option>
                                        <option value="kasubsie" <?= ($baby_filter == 'kasubsie') ? 'selected':''?>>By Kasubsie</option> -->
                                    <?php } ?>
                                </select>
                                &nbsp;
                                <input type="month" class="form-control" name="bulan" id="bulan" value="<?= $bulan ?>" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px;">
                                &nbsp;
                                <div style="display: flex; flex-direction: column;" >
                                    <button class="btn btn-sm btn-success" style="font-size: 20px;font-weight: 900;width: 250px;"> Filter </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6" style="display:flex; margin-top:35px;">
                                <div class="col-3">
                                    <div id="year_to_date_chart" style="height:250px;"></div>
                                    <!-- <div style="text-align: center;margin-top: 60px;">
                                        <a href="<?=base_url()?>dashboard/assy" class="waves-effect waves-light btn btn-outline btn-rounded btn-primary btn-lg btn-nav">Efficiency</a>
                                    </div> -->
                                </div>
                                <div class="col-3">
                                    <div id="target_chart" style="height:250px;"></div>
                                    <!-- <div style="text-align: center;margin-top: 60px;">
                                        <a href="<?=base_url()?>dashboard/line_stop" class="waves-effect waves-light btn btn-outline btn-rounded btn-warning btn-lg btn-nav">Line Stop</a>
                                    </div> -->
                                </div>
                                <!-- <div class="col-3">
                                    <div id="previous_month_chart" style="height:250px;"></div>
                                </div> -->
                                <div class="col-3">
                                    <div id="current_month_chart" style="height:250px;"></div>
                                    <!-- <div style="text-align: center;margin-top: 60px;">
                                        <button class="waves-effect waves-light btn btn-outline btn-rounded btn-success btn-lg btn-nav">Overtime</button>
                                    </div> -->
                                </div>
                                <div class="col-3" style="display:flex;text-align:center;flex-direction: column;align-items: center;flex-wrap: nowrap;justify-content: space-around;">
                                <a href="<?=base_url()?>dashboard/assy" class="waves-effect waves-light btn btn-outline btn-rounded btn-primary btn-lg btn-nav">Efficiency</a>
                                    <a href="<?=base_url()?>dashboard/line_stop" class="waves-effect waves-light btn btn-outline btn-rounded btn-warning btn-lg btn-nav">Line Stop</a>
                                    <button class="waves-effect waves-light btn btn-outline btn-rounded btn-success btn-lg btn-nav">Overtime</button>
                                </div>
                            </div>
                        <div class="col-4">
                            <div class="box bg-transparent">
                                <div class="box-body">
                                    <figure class="highcharts-figure">
                                        <div id="pareto_reject"></div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($baby_filter == 'average') { ?>
                <!-- CHART AVG DAILY REJECTION DAN AVG MONTHLY REJECTION ALL ASSY (%) -->
                <div class="row">
                    <div class="col-xl-8 col-12">
                        <div class="box bg-transparent">
                            <div class="box-body">
                                <figure class="highcharts-figure">
                                    <div id="average_daily_chart"></div>
                                </figure>
                            </div>
                        </div>										
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="box bg-transparent">
                            <div class="box-body">
                                <figure class="highcharts-figure">
                                    <div id="average_month_chart"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else if ($baby_filter == 'line') { ?>
                <!-- CHART AVG DAILY REJECTION DAN AVG MONTHLY REJECTION SHOW PER LINE (%) -->
                <div class="row">
                    <div class="col-xl-8 col-12">
                        <div class="box bg-transparent">
                            <div class="box-body">
                                <figure class="highcharts-figure">
                                    <div id="average_daily_chart_by_line"></div>
                                </figure>
                            </div>
                        </div>										
                    </div>
                    <div class="col-xl-4 col-12">
                        <div class="box bg-transparent">
                            <div class="box-body">
                                <figure class="highcharts-figure">
                                    <div id="average_month_chart_by_line"></div>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>

            <!-- CHART DAILY REJECTION DAN MONTHLY JENIS REJECTION (%) -->
            <div class="row">
				<div class="col-xl-12 col-12">
					<div class="box bg-transparent">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="daily_rejection_persentase_chart"></div>
                            </figure>
						</div>
					</div>										
				</div>
				<div class="col-xl-4 col-12" style="display:none">
					<div class="box bg-transparent">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="monthly_rejection_persentase_chart"></div>
                            </figure>
						</div>
					</div>
				</div>
			</div>

            <!-- CHART DAILY REJECTION DAN MONTHLY JENIS REJECTION (PCS) -->
			<div class="row" id="efficiency-wrapper">
				<div class="col-xl-12 col-12">
					<div class="box bg-transparent">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="main_chart"></div>
                            </figure>
						</div>
					</div>										
				</div>
				<div class="col-xl-4 col-12" style="display:none">
					<div class="box bg-transparent">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="side_chart"></div>
                            </figure>
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
<div class="modal fade" id="main_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width:120%;">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Rejection</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="detail_pareto_jenis_reject"></div>
                <div id="detail_pareto_kategori_reject"></div>
                <div id="detail_pareto_type_battery"></div>
                <div id="detail_pareto_grup_shift"></div>
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

<!-- SUB MODAL -->
<div class="modal fade" id="sub_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width:120%;">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Rejection</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="sub_detail_pareto_jenis_reject"></div>
                <div id="sub_detail_pareto_kategori_reject"></div>
                <div id="sub_detail_pareto_type_battery"></div>
                <div id="sub_detail_pareto_grup_shift"></div>
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
        $('#child_filter').change(function() {
            var selectedValue = $(this).val();
            populateSecondarySelect(selectedValue);
        });

        setTimeout(function () { location.reload(1); }, 60*60*1000);
    });

    function populateSecondarySelect(selectedValue) {
        $('#baby_filter').empty();
        
        if (selectedValue == '0') {
            $('#baby_filter').append($('<option>', {
                value: 'average',
                text: 'By Average'
            }));

            $('#baby_filter').append($('<option>', {
                value: 'line',
                text: 'By Line'
            }));
        } else {
            $('#baby_filter').append($('<option>', {
                value: 'average',
                text: 'By Average'
            }));
            
            // $('#baby_filter').append($('<option>', {
            //     value: 'shift',
            //     text: 'By Shift'
            // }));

            // $('#baby_filter').append($('<option>', {
            //     value: 'grup',
            //     text: 'By Grup'
            // }));

            // $('#baby_filter').append($('<option>', {
            //     value: 'kasubsie',
            //     text: 'By Kasubsie'
            // }));
        }
    }

    // PIE CHART YEAR TO GET
    var year_to_date_chart = echarts.init(document.getElementById('year_to_date_chart'));
    year_to_date_chart.setOption(
        {
            title: {
                text: '<?=json_encode($data_all_year)?>%',
                subtext: 'Year To Date',
                x: 'center',
                y: 'center',
                itemGap: 5,
                textStyle: {
                    color: '#ffffff',
                    fontSize: 30,
                    fontWeight: '700'
                },
                subtextStyle: {
                    color: '#ffffff',
                    fontSize: 15,
                    fontWeight: 'normal'
                }

            },           
            series: [
                {
                    name: '1',
                    type: 'pie',
                    clockWise: false,
                    radius: ['63%', '90%'],
                    silent: true,
                    itemStyle: {
                        normal: {
                            label: {show: false},
                            labelLine: {show: false}
                        }
                    },
                    data: [
                        {
                            value: <?=json_encode($data_all_year)?> * 100,
                            name: 'Monday',
                            itemStyle: {
                                color: 'blue'
                            }
                        },
                        {
                            value: 100 - (<?=json_encode($data_all_year)?> * 100),
                            name: 'invisible',
                            itemStyle: {
                                color: 'grey'
                            }
                        }
                    ]
                },
            ]
        }
    );

    // PIE CHART TARGET
    var target_chart = echarts.init(document.getElementById('target_chart'));
    target_chart.setOption(
        {
            title: {
                text: '0.4%',
                subtext: 'Batas Rejection',
                x: 'center',
                y: 'center',
                itemGap: 5,
                textStyle: {
                    color: '#ffffff',
                    fontSize: 30,
                    fontWeight: '700'
                },
                subtextStyle: {
                    color: '#ffffff',
                    fontSize: 15,
                    fontWeight: 'normal'
                }

            },           
            series: [
                {
                    name: '1',
                    type: 'pie',
                    clockWise: false,
                    radius: ['63%', '90%'],
                    silent: true,
                    itemStyle: {
                        normal: {
                            label: {show: false},
                            labelLine: {show: false}
                        }
                    },
                    data: [
                        {
                            value: 40,
                            name: 'Monday',
                            itemStyle: {
                                color: 'red'
                            }
                        },
                        {
                            value: 60,
                            name: 'invisible',
                            itemStyle: {
                                color: 'grey'
                            }
                        }
                    ]
                },
            ]
        }
    );

    // PIE CHART Previous Month
    // var previous_month_chart = echarts.init(document.getElementById('previous_month_chart'));
    // previous_month_chart.setOption(
    //     {
    //         title: {
    //             text: '<?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1])?>%',
    //             subtext: '<?=date('F', mktime(0, 0, 0, $previous_date, 10))?> Rejection',
    //             x: 'center',
    //             y: 'center',
    //             itemGap: 5,
    //             textStyle: {
    //                 color: '#ffffff',
    //                 fontSize: 30,
    //                 fontWeight: '700'
    //             },
    //             subtextStyle: {
    //                 color: '#ffffff',
    //                 fontSize: 15,
    //                 fontWeight: 'normal'
    //             }

    //         },           
    //         series: [
    //             {
    //                 name: '1',
    //                 type: 'pie',
    //                 clockWise: false,
    //                 radius: ['75%', '90%'],
    //                 silent: true,
    //                 itemStyle: {
    //                     normal: {
    //                         label: {show: false},
    //                         labelLine: {show: false}
    //                     }
    //                 },
    //                 data: [
    //                     {
    //                         value: <?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1])?> * 100,
    //                         name: 'Monday',
    //                         itemStyle: {
    //                             color: 'red'
    //                         }
    //                     },
    //                     {
    //                         value: 100 - (<?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1])?> * 100),
    //                         name: 'invisible',
    //                         itemStyle: {
    //                             color: 'grey'
    //                         }
    //                     }
    //                 ]
    //             },
    //         ]
    //     }
    // );

    // PIE CHART Current Month
    var current_month_chart = echarts.init(document.getElementById('current_month_chart'));
    current_month_chart.setOption(
        {
            title: {
                text: '<?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $current_date, 10)) - 1])?>%',
                subtext: '<?=date('F', mktime(0, 0, 0, $current_date, 10))?> Rejection',
                x: 'center',
                y: 'center',
                itemGap: 5,
                textStyle: {
                    color: '#ffffff',
                    fontSize: 30,
                    fontWeight: '700'
                },
                subtextStyle: {
                    color: '#ffffff',
                    fontSize: 15,
                    fontWeight: 'normal'
                }

            },           
            series: [
                {
                    name: '1',
                    type: 'pie',
                    clockWise: false,
                    radius: ['63%', '90%'],
                    silent: true,
                    itemStyle: {
                        normal: {
                            label: {show: false},
                            labelLine: {show: false}
                        }
                    },
                    data: [
                        {
                            value: <?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $current_date, 10)) - 1])?> * 100,
                            name: 'Monday',
                            itemStyle: {
                                color: 'orange'
                            }
                        },
                        {
                            value: 100 - (<?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $current_date, 10)) - 1])?> * 100),
                            name: 'invisible',
                            itemStyle: {
                                color: 'grey'
                            }
                        }
                    ]
                },
            ]
        }
    );

    Highcharts.chart('pareto_reject', {
        chart: {
            backgroundColor: 'transparent',
            type: 'column',
            // backgroundColor: '#0c1a32',
            height:250
            
        },
        exporting: {
            enabled: false
        },
        title: {
            text: '<?=date('F', strtotime($bulan))?> Rejection (%)',
            style: {
                color: '#ffffff',
                fontSize: '20px'
            }
        },
        xAxis: {
            categories: <?php echo json_encode($data_reject_by_line); ?>,
            crosshair: true,
            labels: {
                style: {
                    color: '#ffffff'
                }
            }
        },
        yAxis: {
            min: 0,
            max: 0.8,
            title: {
                text: '%'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    formatter: function(){
                        return (this.y!=0)?this.y:"";
                    },
                    style: {
                        color: '#ffffff',
                        textOutline: 0,
                        fontSize: 14
                    },
                },
                // pointWidth: 30,
            }
        },
        legend: {
                enabled: false
            },

        series: [{
            // name: 'All Line',
            data: <?php echo json_encode($data_total_reject_by_line); ?>,
            color:'yellow',

        },
        {
            type: 'spline',
            name: 'Target',
            data: [0.4, 0.4,0.4,0.4,0.4,0.4,0.4],
            color:'red',
        }]
    });

    // GENERATE X AXIS DATE
    <?php
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
            array_push($dates, date("d", strtotime($start)));
            $start = date ("Y-m-d", strtotime("+1 day", strtotime($start)));
        }
    ?>

    // VALIDASI FILTER

    <?php if($baby_filter == 'average') { ?>
        Highcharts.chart('average_daily_chart', {
            chart: {
                type: 'column',
                // backgroundColor: '#12213c',
                // backgroundColor: '#0c1a32',
                backgroundColor: 'transparent',
                // type: '<?=$type_chart?>'
            },

            exporting: {
                enabled: false
            },

            title: {
                text: 'Daily Rejection <?=($child_filter == 0) ? 'All Line' : 'Line '.$child_filter?>',
                align: 'center',
                style: {
                    color: '#ffffff',
                    fontSize: '20px'
                }
            },

            subtitle: {
                text: 'Source: Laporan Harian Produksi',
                align: 'center',
                style: {
                    color: '#ffffff',
                    fontSize: '15px'
                }
            },

            yAxis: {
                title: {
                    text: '%'
                },
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                }
            },

            xAxis: {
                categories: <?php echo json_encode($dates); ?>,
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                }
            },

            legend: {
                align: 'center',
                verticalAlign: 'bottom',
                layout: 'horizontal',
                itemStyle: {
                    color: '#ffffff'
                }
            },

            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        formatter: function(){
                            return (this.y!=0)?this.y:"";
                        },
                        style: {
                            color: '#ffffff',
                            textOutline: 0,
                            fontSize: 14
                        },
                    },
                    events: {
                        click : function(e) {
                            var date = $('#bulan').val() + '-' + e.point.category;
                            var line = <?= $child_filter ?>;
                            $.ajax({
                                url: '<?= base_url('dashboard/reject/get_detail_rejection') ?>',
                                type: 'POST',
                                data: {
                                    date: date,
                                    line: line
                                },
                                dataType: 'JSON',
                                success: function(data) {
                                    console.log(data);
                                    var data_jenis_reject = data['data_jenis_reject'];
                                    var i;
                                    var arr_jenis_reject = [];
                                    var arr_qty_jenis_reject = [];
                                    for (i = 0; i < data_jenis_reject.length; i++) {
                                        arr_jenis_reject.push(data_jenis_reject[i].jenis_reject);
                                        arr_qty_jenis_reject.push(parseFloat(((data_jenis_reject[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                    }
                                    console.log(arr_qty_jenis_reject);
                                    $('#detail_pareto_jenis_reject').html(`<figure class="highcharts-figure">
                                                                                            <div id="chart_pareto_jenis_reject"></div>
                                                                                        </figure>
                                                                                    `);
                                    Highcharts.chart('chart_pareto_jenis_reject', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: `Detail Rejection (${date})`,
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_jenis_reject,
                                                crosshair: true,
                                                labels: {
                                                    style: {
                                                        color: '#ffffff'
                                                    }
                                                }
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
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                        enabled: true,
                                                        style: {
                                                            color: '#ffffff',
                                                            textOutline: 0,
                                                            fontSize: 14
                                                        },
                                                    },
                                                    events: {
                                                        click: function(event) {
                                                            var jenis_reject = event.point.category;

                                                            $.ajax({
                                                                url: "<?= base_url('dashboard/reject/get_detail_rejection'); ?>",
                                                                type: "POST",
                                                                data: {
                                                                    date: date,
                                                                    line: line,
                                                                    jenis_reject: jenis_reject
                                                                },
                                                                dataType: "json",
                                                                success: function(data) {
                                                                    console.log(data);
                                                                    var data_reject_by_jenis_reject = data['data_reject_by_jenis_reject'];
                                                                    var i;
                                                                    var arr_kategori_reject = [];
                                                                    var arr_qty_kategori_reject = [];
                                                                    for (i = 0; i < data_reject_by_jenis_reject.length; i++) {
                                                                        arr_kategori_reject.push(data_reject_by_jenis_reject[i].kategori_reject);
                                                                        arr_qty_kategori_reject.push(parseFloat(((data_reject_by_jenis_reject[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                        
                                                                    }
                                                                    $('#sub_detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_detail_pareto_ketegori_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_detail_pareto_ketegori_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail '+jenis_reject+' Rejection',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_kategori_reject,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    },
                                                                                    events: {
                                                                                        click: function(event) {
                                                                                            $('#sub_modal').modal('show');
                                                                                        }
                                                                                    }
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_kategori_reject,
                                                                                color:'yellow',

                                                                            }]
                                                                    });

                                                                    var data_reject_by_type_battery = data['data_reject_by_type_battery'];
                                                                    var i;
                                                                    var arr_type_battery = [];
                                                                    var arr_qty_type_battery = [];
                                                                    for (i = 0; i < data_reject_by_type_battery.length; i++) {
                                                                        arr_type_battery.push(data_reject_by_type_battery[i].type_battery);
                                                                        arr_qty_type_battery.push(parseFloat(((data_reject_by_type_battery[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                        
                                                                    }
                                                                    $('#sub_detail_pareto_type_battery').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_detail_pareto_battery_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_detail_pareto_battery_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail Type Battery Rejection',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_type_battery,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                    enabled: true,
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        textOutline: 0,
                                                                                        fontSize: 14
                                                                                    },
                                                                                },
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_type_battery,
                                                                                color:'yellow',

                                                                            }]
                                                                    });

                                                                    var data_reject_by_grup = data['data_reject_by_grup'];
                                                                    var i;
                                                                    var arr_grup = [];
                                                                    var arr_qty_grup = [];
                                                                    for (i = 0; i < data_reject_by_grup.length; i++) {
                                                                        arr_grup.push(data_reject_by_grup[i].nama_pic+' ('+data_reject_by_grup[i].shift+')');
                                                                        arr_qty_grup.push(parseFloat(((data_reject_by_grup[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                        
                                                                    }
                                                                    $('#sub_detail_pareto_grup_shift').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_detail_grup_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_detail_grup_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail Grup Rejection',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_grup,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                    enabled: true,
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        textOutline: 0,
                                                                                        fontSize: 14
                                                                                    },
                                                                                },
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_grup,
                                                                                color:'yellow',

                                                                            }]
                                                                    });

                                                                    $('#sub_modal').modal('show');
                                                                }
                                                            });
                                                        }
                                                    }
                                                }
                                            },
                                            legend: {
                                                enabled: false
                                            },
                                            series: [{
                                                name: 'Total',
                                                data: arr_qty_jenis_reject,
                                                color:'yellow',

                                            }]
                                    });

                                    var data_kategori_reject = data['data_all_detail_kategori_rejection_by_date'];
                                    var i;
                                    var arr_kategori_reject = [];
                                    var arr_qty_kategori_reject = [];
                                    for (i = 0; i < data_kategori_reject.length; i++) {
                                        arr_kategori_reject.push(data_kategori_reject[i].kategori_reject);
                                        arr_qty_kategori_reject.push(parseFloat(((data_kategori_reject[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                    }
                                    $('#detail_pareto_kategori_reject').html(`<figure class="highcharts-figure">
                                                                                    <div id="chart_pareto_kategori_reject"></div>
                                                                                </figure>
                                                                            `);
                                    Highcharts.chart('chart_pareto_kategori_reject', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: `Detail Ketegori Rejection (${date})`,
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_kategori_reject,
                                                crosshair: true,
                                                labels: {
                                                    style: {
                                                        color: '#ffffff'
                                                    }
                                                }
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
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                        enabled: true,
                                                        style: {
                                                            color: '#ffffff',
                                                            textOutline: 0,
                                                            fontSize: 14
                                                        },
                                                    },
                                                }
                                            },
                                            legend: {
                                                enabled: false
                                            },
                                            series: [{
                                                name: 'Total',
                                                data: arr_qty_kategori_reject,
                                                color:'yellow',

                                            }]
                                    });

                                    var data_battery_reject = data['data_all_detail_battery_rejection_by_date'];
                                    var i;
                                    var arr_battery_reject = [];
                                    var arr_qty_battery_reject = [];
                                    for (i = 0; i < data_battery_reject.length; i++) {
                                        arr_battery_reject.push(data_battery_reject[i].type_battery);
                                        arr_qty_battery_reject.push(parseFloat(((data_battery_reject[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                        
                                    }
                                    $('#detail_pareto_type_battery').html(`<figure class="highcharts-figure">
                                                                                    <div id="chart_pareto_battery_reject"></div>
                                                                                </figure>
                                                                            `);
                                    Highcharts.chart('chart_pareto_battery_reject', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: `Detail Type Battery Rejection (${date})`,
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_battery_reject,
                                                crosshair: true,
                                                labels: {
                                                    style: {
                                                        color: '#ffffff'
                                                    }
                                                }
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
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                        enabled: true,
                                                        style: {
                                                            color: '#ffffff',
                                                            textOutline: 0,
                                                            fontSize: 14
                                                        },
                                                    },
                                                    events : {
                                                        click: function(event) {
                                                            var type_battery = event.point.category;

                                                            $.ajax({
                                                                url: "<?= base_url('dashboard/reject/get_detail_rejection'); ?>",
                                                                type: "POST",
                                                                data: {
                                                                    date: date,
                                                                    line: line,
                                                                    type_battery: type_battery
                                                                },
                                                                dataType: "json",
                                                                success: function(data) {
                                                                    console.log(data);
                                                                    var data_jenis_reject_by_type_battery = data['data_jenis_reject_by_type_battery'];
                                                                    var i;
                                                                    var arr_jenis_reject_battery = [];
                                                                    var arr_qty_jenis_reject_battery = [];
                                                                    for (i = 0; i < data_jenis_reject_by_type_battery.length; i++) {
                                                                        arr_jenis_reject_battery.push(data_jenis_reject_by_type_battery[i].jenis_reject);
                                                                        arr_qty_jenis_reject_battery.push(parseFloat(((data_jenis_reject_by_type_battery[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                    }

                                                                    $('#sub_detail_pareto_jenis_reject').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_detail_pareto_jenis_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_detail_pareto_jenis_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail Rejection',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_jenis_reject_battery,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    }
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_jenis_reject_battery,
                                                                                color:'yellow',

                                                                            }]
                                                                    });

                                                                    var data_kategori_reject_by_type_battery = data['data_kategori_reject_by_type_battery'];
                                                                    var i;
                                                                    var arr_kategori_reject_battery = [];
                                                                    var arr_qty_kategori_reject_battery = [];
                                                                    for (i = 0; i < data_kategori_reject_by_type_battery.length; i++) {
                                                                        arr_kategori_reject_battery.push(data_kategori_reject_by_type_battery[i].kategori_reject);
                                                                        arr_qty_kategori_reject_battery.push(parseFloat(((data_kategori_reject_by_type_battery[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                    }

                                                                    $('#sub_detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_detail_pareto_kategori_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_detail_pareto_kategori_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail Kategori Rejection',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_kategori_reject_battery,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    }
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_kategori_reject_battery,
                                                                                color:'yellow',

                                                                            }]
                                                                    });

                                                                    

                                                                    $('#sub_detail_pareto_type_battery').html(``);

                                                                    var data_grup_reject_by_type_battery = data['data_grup_reject_by_type_battery'];
                                                                    var i;
                                                                    var arr_grup_reject_battery = [];
                                                                    var arr_qty_grup_reject_battery = [];
                                                                    for (i = 0; i < data_grup_reject_by_type_battery.length; i++) {
                                                                        arr_grup_reject_battery.push(data_grup_reject_by_type_battery[i].nama_pic+' ('+data_grup_reject_by_type_battery[i].shift+')');
                                                                        arr_qty_grup_reject_battery.push(parseFloat(((data_grup_reject_by_type_battery[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                    }

                                                                    $('#sub_detail_pareto_grup_shift').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_detail_pareto_grup_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_detail_pareto_grup_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail Grup Shift Rejection',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_grup_reject_battery,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    }
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_grup_reject_battery,
                                                                                color:'yellow',

                                                                            }]
                                                                    });

                                                                    
                                                                    $('#sub_modal').modal('show');
                                                                }
                                                            })
                                                        }
                                                    }

                                                }
                                            },
                                            legend: {
                                                enabled: false
                                            },
                                            series: [{
                                                name: 'Total',
                                                data: arr_qty_battery_reject,
                                                color:'yellow',

                                            }]
                                    });

                                    var data_grup_reject = data['data_all_detail_grup_rejection_by_date'];
                                    var i;
                                    var arr_grup_reject = [];
                                    var arr_qty_grup_reject = [];
                                    for (i = 0; i < data_grup_reject.length; i++) {
                                        arr_grup_reject.push(data_grup_reject[i].nama_pic+' ('+data_grup_reject[i].shift+')');
                                        arr_qty_grup_reject.push(parseFloat(((data_grup_reject[i].total_reject / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                        
                                    }
                                    $('#detail_pareto_grup_shift').html(`<figure class="highcharts-figure">
                                                                                    <div id="chart_pareto_grup_reject"></div>
                                                                                </figure>
                                                                            `);
                                    Highcharts.chart('chart_pareto_grup_reject', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: `Detail Grup Rejection (${date})`,
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_grup_reject,
                                                crosshair: true,
                                                labels: {
                                                    style: {
                                                        color: '#ffffff'
                                                    }
                                                }
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
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                        enabled: true,
                                                        style: {
                                                            color: '#ffffff',
                                                            textOutline: 0,
                                                            fontSize: 14
                                                        },
                                                    },
                                                    events : {
                                                        click: function(event) {
                                                            var group = event.point.category;
                                                            var regex = /^(.*?)\s*\((\d+)\)$/;
                                                            var matches = group.match(regex);

                                                            if (matches) {
                                                                var name = matches[1].trim();
                                                                var shift = matches[2];
                                                            } else {
                                                                console.log('Invalid format');
                                                            }

                                                            $.ajax({
                                                                url: "<?= base_url('dashboard/reject/get_detail_rejection'); ?>",
                                                                type: "POST",
                                                                data: {
                                                                    date: date,
                                                                    line: line,
                                                                    grup: name,
                                                                    shift: shift
                                                                },
                                                                dataType: "json",
                                                                success: function(data) {
                                                                    console.log(data);
                                                                    var data_detail_reject_by_grup = data['data_jenis_reject_by_grup_shift'];
                                                                    var i;
                                                                    var arr_jenis_reject = [];
                                                                    var arr_qty_jenis_reject = [];
                                                                    for (i = 0; i < data_detail_reject_by_grup.length; i++) {
                                                                        arr_jenis_reject.push(data_detail_reject_by_grup[i].jenis_reject);
                                                                        arr_qty_jenis_reject.push(parseFloat(((data_detail_reject_by_grup[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                        
                                                                    }

                                                                    $('#sub_detail_pareto_jenis_reject').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_detail_pareto_jenis_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_detail_pareto_jenis_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail Rejection',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_jenis_reject,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    },
                                                                                    events: {
                                                                                        click: function(event) {
                                                                                            $('#sub_modal').modal('show');
                                                                                        }
                                                                                    }
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_jenis_reject,
                                                                                color:'yellow',

                                                                            }]
                                                                    });

                                                                    var data_kategori_reject_by_grup = data['data_kategori_reject_by_grup_shift'];
                                                                    var i;
                                                                    var arr_kategori_reject = [];
                                                                    var arr_qty_kategori_reject = [];
                                                                    for (i = 0; i < data_kategori_reject_by_grup.length; i++) {
                                                                        arr_kategori_reject.push(data_kategori_reject_by_grup[i].kategori_reject);
                                                                        arr_qty_kategori_reject.push(parseFloat(((data_kategori_reject_by_grup[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                        
                                                                    }

                                                                    $('#sub_detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_detail_pareto_kategori_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_detail_pareto_kategori_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail Kategori Rejection',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_kategori_reject,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    },
                                                                                    events: {
                                                                                        click: function(event) {
                                                                                            $('#sub_modal').modal('show');
                                                                                        }
                                                                                    }
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_kategori_reject,
                                                                                color:'yellow',

                                                                            }]
                                                                    });

                                                                    var data_battery_reject_by_grup = data['data_battery_reject_by_grup_shift'];
                                                                    var i;
                                                                    var arr_battery_reject = [];
                                                                    var arr_qty_battery_reject = [];
                                                                    for (i = 0; i < data_battery_reject_by_grup.length; i++) {
                                                                        arr_battery_reject.push(data_battery_reject_by_grup[i].type_battery);
                                                                        arr_qty_battery_reject.push(parseFloat(((data_battery_reject_by_grup[i].qty / data['total_aktual_by_date'][0]['total_aktual']) * 100).toFixed(2)));
                                                                        
                                                                    }

                                                                    $('#sub_detail_pareto_type_battery').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_detail_pareto_battery_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_detail_pareto_battery_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail Type Battery',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_battery_reject,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    },
                                                                                    events: {
                                                                                        click: function(event) {
                                                                                            $('#sub_modal').modal('show');
                                                                                        }
                                                                                    }
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_battery_reject,
                                                                                color:'yellow',

                                                                            }]
                                                                    });

                                                                    $('#sub_detail_pareto_grup_shift').html(``);

                                                                    $('#sub_modal').modal('show');
                                                                }
                                                            })
                                                        }
                                                    }
                                                }
                                            },
                                            legend: {
                                                enabled: false
                                            },
                                            series: [{
                                                name: 'Total',
                                                data: arr_qty_grup_reject,
                                                color:'yellow',

                                            }]
                                    });

                                    $('#main_modal').modal('show');
                                }
                            })
                        }
                    }
                }
            },
            colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
            
            series: [{
                name: 'All Line',
                data: <?= json_encode($data_average_reject_by_date_all_line); ?>
            }
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

        Highcharts.chart('average_month_chart', {
            chart: {
                backgroundColor: 'transparent',
                // type: '<?=$type_chart?>'
                type: 'column',
                // backgroundColor: '#0c1a32',
                
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Monthly Rejection',
                style: {
                    color: '#ffffff',
                    fontSize: '20px'
                }
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
                crosshair: true,
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                }
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
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        formatter: function(){
                            return (this.y!=0)?this.y:"";
                        },
                        style: {
                            color: '#ffffff',
                            textOutline: 0,
                            fontSize: 14
                        },
                    },
                    events: {
                        click: function(e) {
                            var date = '01-'+e.point.category+'-<?=date('Y')?>';
                            var line = <?=$child_filter?>;
                            // alert(date);
                            $.ajax({
                                url: "<?= base_url('dashboard/reject/get_detail_rejection') ?>",
                                type: "post",
                                data: {
                                    date: date,
                                    line: line
                                },
                                dataType: "json",
                                success: function(data) {
                                    console.log(data);
                                    var data_jenis_reject = data['data_jenis_reject_by_month'];
                                    var i;
                                    var arr_jenis_reject = [];
                                    var arr_qty_jenis_reject = [];
                                    for (i = 0; i < data_jenis_reject.length; i++) {
                                        arr_jenis_reject.push(data_jenis_reject[i].jenis_reject);
                                        arr_qty_jenis_reject.push(data_jenis_reject[i].qty);
                                    }
                                    $('#detail_pareto_jenis_reject').html(`<figure class="highcharts-figure">
                                                                                            <div id="chart_pareto_jenis_reject"></div>
                                                                                        </figure>
                                                                                    `);
                                    Highcharts.chart('chart_pareto_jenis_reject', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: 'Detail Jenis Rejection',
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_jenis_reject,
                                                crosshair: true,
                                                labels: {
                                                    style: {
                                                        color: '#ffffff'
                                                    }
                                                }
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
                                                    borderWidth: 0,
                                                    dataLabels: {
                                                        enabled: true,
                                                        style: {
                                                            color: '#ffffff',
                                                            textOutline: 0,
                                                            fontSize: 14
                                                        },
                                                    },
                                                    events: {
                                                        click: function(event) {
                                                            var jenis_reject = event.point.category;
                                                            $.ajax({
                                                                url: "<?= base_url('dashboard/reject/get_detail_rejection'); ?>",
                                                                type: "POST",
                                                                data: {
                                                                    date: date,
                                                                    line: line,
                                                                    jenis_reject: jenis_reject
                                                                },
                                                                dataType: "json",
                                                                success: function(data) {
                                                                    console.log(data);
                                                                    var data_reject_by_jenis_reject = data['data_reject_by_jenis_reject_by_month'];
                                                                    var i;
                                                                    var arr_kategori_reject = [];
                                                                    var arr_qty_kategori_reject = [];
                                                                    for (i = 0; i < data_reject_by_jenis_reject.length; i++) {
                                                                        arr_kategori_reject.push(data_reject_by_jenis_reject[i].kategori_reject);
                                                                        arr_qty_kategori_reject.push(data_reject_by_jenis_reject[i].qty);
                                                                    }
                                                                    $('#sub_detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_pareto_ketegori_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_pareto_ketegori_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail '+jenis_reject+' Rejection',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_kategori_reject,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                        enabled: true,
                                                                                        style: {
                                                                                            color: '#ffffff',
                                                                                            textOutline: 0,
                                                                                            fontSize: 14
                                                                                        },
                                                                                    },
                                                                                    events: {
                                                                                        click: function(event) {
                                                                                            $('#sub_modal').modal('show');
                                                                                        }
                                                                                    }
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_kategori_reject,
                                                                                color:'yellow',

                                                                            }]
                                                                    });

                                                                    var data_reject_by_type_battery = data['data_reject_by_type_battery_by_month'];
                                                                    var i;
                                                                    var arr_type_battery = [];
                                                                    var arr_qty_type_battery = [];
                                                                    for (i = 0; i < data_reject_by_type_battery.length; i++) {
                                                                        arr_type_battery.push(data_reject_by_type_battery[i].type_battery);
                                                                        arr_qty_type_battery.push(data_reject_by_type_battery[i].qty);
                                                                    }
                                                                    $('#sub_detail_pareto_type_battery').html(`  <figure class="highcharts-figure">
                                                                                                                    <div id="chart_pareto_battery_reject"></div>
                                                                                                                </figure>`
                                                                                                            );
                                                                    Highcharts.chart('chart_pareto_battery_reject', {
                                                                        chart: {
                                                                                backgroundColor: 'transparent',
                                                                                type: 'column'
                                                                            },
                                                                            exporting: {
                                                                                enabled: false
                                                                            },
                                                                            title: {
                                                                                text: 'Detail Type Battery Rejection',
                                                                                style: {
                                                                                    color: '#ffffff',
                                                                                    fontSize: '20px'
                                                                                }
                                                                            },
                                                                            xAxis: {
                                                                                categories: arr_type_battery,
                                                                                crosshair: true,
                                                                                labels: {
                                                                                    style: {
                                                                                        color: '#ffffff'
                                                                                    }
                                                                                }
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
                                                                                    borderWidth: 0,
                                                                                    dataLabels: {
                                                                                    enabled: true,
                                                                                    style: {
                                                                                        color: '#ffffff',
                                                                                        textOutline: 0,
                                                                                        fontSize: 14
                                                                                    },
                                                                                },
                                                                                }
                                                                            },
                                                                            legend: {
                                                                                enabled: false
                                                                            },
                                                                            series: [{
                                                                                name: 'Total',
                                                                                data: arr_qty_type_battery,
                                                                                color:'yellow',

                                                                            }]
                                                                    });
                                                                    $('#sub_detail_pareto_grup_shift').html(``);

                                                                    $('#sub_modal').modal('show');
                                                                }
                                                            });
                                                        }
                                                    }
                                                }
                                            },
                                            legend: {
                                                enabled: false
                                            },
                                            series: [{
                                                name: 'Total',
                                                data: arr_qty_jenis_reject,
                                                color:'yellow',

                                            }]
                                    });
                                    $('#detail_pareto_kategori_reject').html(``);
                                    $('#detail_pareto_type_battery').html(``);
                                    $('#detail_pareto_grup_shift').html(``);
                                    $('#main_modal').modal('show');
                                }
                            });
                        }
                    }
                }
            },
            legend: {
                <?php if (($parent_filter == 'line' OR $parent_filter == null) AND ($child_filter == null OR $child_filter == 0) AND $baby_filter == 'line') { ?>
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal',
                    itemStyle: {
                        color: '#ffffff'
                    }
                <?php } else { ?>
                    enabled: false
                <?php } ?>
                },
            colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],

            series: [{
                name: 'All Line',
                data: <?= json_encode($data_average_reject_by_month); ?>
            }
            ],
        });
    <?php } elseif ($baby_filter == 'line') { ?>
        Highcharts.chart('average_daily_chart_by_line', {
            chart: {
                // type: 'column',
                // backgroundColor: '#12213c',
                // backgroundColor: '#0c1a32',
                backgroundColor: 'transparent',
                type: 'line'
            },
    
            exporting: {
                enabled: false
            },
    
            title: {
                text: 'Daily Rejection <?=($child_filter == 0) ? 'All Line' : 'Line '.$child_filter?>',
                align: 'center',
                style: {
                    color: '#ffffff',
                    fontSize: '20px'
                }
            },
    
            subtitle: {
                text: 'Source: Laporan Harian Produksi',
                align: 'center',
                style: {
                    color: '#ffffff',
                    fontSize: '15px'
                }
            },
    
            yAxis: {
                title: {
                    text: '%'
                },
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                },
                min: 0,
            },
    
            xAxis: {
                categories: <?php echo json_encode($dates); ?>,
                labels: {
                    style: {
                        color: '#ffffff'
                    },
                }
            },
    
            legend: {
                align: 'center',
                verticalAlign: 'bottom',
                layout: 'horizontal',
                itemStyle: {
                    color: '#ffffff'
                }
            },
    
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true,
                        formatter: function(){
                            return (this.y!=0)?this.y:"";
                        },
                        style: {
                            color: '#ffffff',
                            textOutline: 0,
                            fontSize: 14
                        },
                    },
                    // pointWidth: 30,
                }
            },
            colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
            
            series: [
                {
                        name: 'Line 1',
                        data: <?php echo json_encode($data_reject_line_1); ?>
                    },
                    {
                        name: 'Line 2',
                        data: <?php echo json_encode($data_reject_line_2); ?>
                    },
                    {
                        name: 'Line 3',
                        data: <?php echo json_encode($data_reject_line_3); ?>
                    },
                    {
                        name: 'Line 4',
                        data: <?php echo json_encode($data_reject_line_4); ?>
                    },
                    {
                        name: 'Line 5',
                        data: <?php echo json_encode($data_reject_line_5); ?>
                    },
                    {
                        name: 'Line 6',
                        data: <?php echo json_encode($data_reject_line_6); ?>
                    },
                    {
                        name: 'Line 7',
                        data: <?php echo json_encode($data_reject_line_7); ?>
                    }
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
    
        Highcharts.chart('average_month_chart_by_line', {
            chart: {
                backgroundColor: 'transparent',
                type: 'line'
                // type: 'column',
                // backgroundColor: '#0c1a32',
                
            },
            exporting: {
                enabled: false
            },
            title: {
                text: 'Monthly Rejection',
                style: {
                    color: '#ffffff',
                    fontSize: '20px'
                }
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
                crosshair: true,
                labels: {
                    style: {
                        color: '#ffffff'
                    }
                }
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
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        formatter: function(){
                            return (this.y!=0)?this.y:"";
                        },
                        style: {
                            color: '#ffffff',
                            textOutline: 0,
                            fontSize: 14
                        },
                    },
                    // pointWidth: 30,
                }
            },
            legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal',
                    itemStyle: {
                        color: '#ffffff'
                    }
                },
            colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
    
            series: [
                {
                    name: 'Line 1',
                    data: <?php echo json_encode($data_reject_by_month_line_1); ?>,
                },
                {
                    name: 'Line 2',
                    data: <?php echo json_encode($data_reject_by_month_line_2); ?>,
                },
                {
                    name: 'Line 3',
                    data: <?php echo json_encode($data_reject_by_month_line_3); ?>,
                },
                {
                    name: 'Line 4',
                    data: <?php echo json_encode($data_reject_by_month_line_4); ?>,
                },
                {
                    name: 'Line 5',
                    data: <?php echo json_encode($data_reject_by_month_line_5); ?>,
                },
                {
                    name: 'Line 6',
                    data: <?php echo json_encode($data_reject_by_month_line_6); ?>,
                },
                {
                    name: 'Line 7',
                    data: <?php echo json_encode($data_reject_by_month_line_7); ?>,
                }
            ]
        });
    <?php    }   ?>

    Highcharts.chart('side_chart', {
        chart: {
            type: 'column',
            // backgroundColor: '#0c1a32',
            backgroundColor: 'transparent',
            
        },
        exporting: {
            enabled: false
        },
        title: {
            text: 'Monthly Rejection (Unit)',
            style: {
                color: '#ffffff',
                fontSize: '20px'
            }
        },
        xAxis: {
            // categories: <?php echo json_encode($data_jenis_reject_by_month); ?>,
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
            crosshair: true,
            labels: {
                style: {
                    color: '#ffffff'
                }
            }
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
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    formatter: function(){
                        return (this.y!=0)?this.y:"";
                    },
                    style: {
                        color: '#ffffff',
                        textOutline: 0,
                        fontSize: 14
                    },
                },
                // pointWidth: 30,
            }
        },
        legend: {
                enabled: false
            },

        series: [{
            // name: 'All Line',
            // data: <?php echo json_encode($data_total_reject_by_month); ?>,
            data: <?php echo json_encode($data_qty_reject_by_month  ); ?>,
            color:'yellow',

        }]
    });

    Highcharts.chart('main_chart', {
        chart: {
            type: 'column',
            // backgroundColor: '#0c1a32',
            backgroundColor: 'transparent',
        },
        exporting: {
            enabled: false
        },

        title: {
            text: 'Daily Rejection <?=($child_filter == 0) ? 'All Line' : 'Line '.$child_filter?>',
            align: 'center',
            style: {
                color: '#ffffff',
                fontSize: '20px',
                fontWeight: 'bold'
            }
        },

        subtitle: {
            text: 'Source: Laporan Harian Produksi',
            align: 'center',
            style: {
                color: '#ffffff',
                fontSize: '15px'
            }
        },

        xAxis: {
            categories: <?= json_encode($dates); ?>,
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Unit'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                },
                formatter: function(){
                    return (this.y!=0)?this.y:"";
                }
            },
            labels: {
                style: {
                    color: '#ffffff'
                }
            }
        },
        legend: {
            align: 'center',
            verticalAlign: 'bottom',
            layout: 'horizontal',
            itemStyle: {
                color: '#ffffff'
            }
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    formatter: function(){
                        return (this.y!=0)?this.y:"";
                    }
                },
                // events: {
                //     click: function(event) {
                //         var date = $('#bulan').val()+'-'+event.point.category;
                //         var line = <?=$child_filter?>;
                //         var jenis_reject = this.name;

                //         $.ajax({
                //             url: "<?= base_url('dashboard/reject/get_detail_rejection'); ?>",
                //             type: "POST",
                //             data: {
                //                 date: date,
                //                 line: line,
                //                 jenis_reject: jenis_reject
                //             },
                //             dataType: "json",
                //             success: function(data) {
                //                 console.log(data);
                //                 var data_reject_by_jenis_reject = data['data_reject_by_jenis_reject'];
                //                 var i;
                //                 var arr_kategori_reject = [];
                //                 var arr_qty_kategori_reject = [];
                //                 for (i = 0; i < data_reject_by_jenis_reject.length; i++) {
                //                     arr_kategori_reject.push(data_reject_by_jenis_reject[i].kategori_reject);
                //                     arr_qty_kategori_reject.push(data_reject_by_jenis_reject[i].qty);
                //                 }
                //                 $('#detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                //                                                                 <div id="chart_pareto_ketegori_reject"></div>
                //                                                             </figure>`
                //                                                         );
                //                 Highcharts.chart('chart_pareto_ketegori_reject', {
                //                     chart: {
                //                             backgroundColor: 'transparent',
                //                             type: 'column'
                //                         },
                //                         exporting: {
                //                             enabled: false
                //                         },
                //                         title: {
                //                             text: 'Detail '+jenis_reject+' Rejection',
                //                             style: {
                //                                 color: '#ffffff',
                //                                 fontSize: '20px'
                //                             }
                //                         },
                //                         xAxis: {
                //                             categories: arr_kategori_reject,
                //                             crosshair: true,
                //                             labels: {
                //                                 style: {
                //                                     color: '#ffffff'
                //                                 }
                //                             }
                //                         },
                //                         yAxis: {
                //                             min: 0,
                //                             title: {
                //                                 text: 'Pcs'
                //                             }
                //                         },
                //                         plotOptions: {
                //                             column: {
                //                                 pointPadding: 0.2,
                //                                 borderWidth: 0,
                //                                 dataLabels: {
                //                                     enabled: true,
                //                                     style: {
                //                                         color: '#ffffff',
                //                                         textOutline: 0,
                //                                         fontSize: 14
                //                                     },
                //                                 },
                //                                 events: {
                //                                     click: function(event) {
                //                                         $('#sub_modal').modal('show');
                //                                     }
                //                                 }
                //                             }
                //                         },
                //                         legend: {
                //                             enabled: false
                //                         },
                //                         series: [{
                //                             name: 'Total',
                //                             data: arr_qty_kategori_reject,
                //                             color:'yellow',

                //                         }]
                //                 });

                //                 var data_reject_by_type_battery = data['data_reject_by_type_battery'];
                //                 var i;
                //                 var arr_type_battery = [];
                //                 var arr_qty_type_battery = [];
                //                 for (i = 0; i < data_reject_by_type_battery.length; i++) {
                //                     arr_type_battery.push(data_reject_by_type_battery[i].type_battery);
                //                     arr_qty_type_battery.push(data_reject_by_type_battery[i].qty);
                //                 }
                //                 $('#detail_pareto_type_battery').html(`  <figure class="highcharts-figure">
                //                                                                 <div id="chart_pareto_battery_reject"></div>
                //                                                             </figure>`
                //                                                         );
                //                 Highcharts.chart('chart_pareto_battery_reject', {
                //                     chart: {
                //                             backgroundColor: 'transparent',
                //                             type: 'column'
                //                         },
                //                         exporting: {
                //                             enabled: false
                //                         },
                //                         title: {
                //                             text: 'Detail Type Battery Rejection',
                //                             style: {
                //                                 color: '#ffffff',
                //                                 fontSize: '20px'
                //                             }
                //                         },
                //                         xAxis: {
                //                             categories: arr_type_battery,
                //                             crosshair: true,
                //                             labels: {
                //                                 style: {
                //                                     color: '#ffffff'
                //                                 }
                //                             }
                //                         },
                //                         yAxis: {
                //                             min: 0,
                //                             title: {
                //                                 text: 'Pcs'
                //                             }
                //                         },
                //                         plotOptions: {
                //                             column: {
                //                                 pointPadding: 0.2,
                //                                 borderWidth: 0,
                //                                 dataLabels: {
                //                                 enabled: true,
                //                                 style: {
                //                                     color: '#ffffff',
                //                                     textOutline: 0,
                //                                     fontSize: 14
                //                                 },
                //                             },
                //                             }
                //                         },
                //                         legend: {
                //                             enabled: false
                //                         },
                //                         series: [{
                //                             name: 'Total',
                //                             data: arr_qty_type_battery,
                //                             color:'yellow',

                //                         }]
                //                 });
                //                 $('#main_modal').modal('show');
                //             }
                //         });
                //     }
                // }
            }
        },
        colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
        series: <?php echo json_encode($result_without_setting); ?>,
    });

    Highcharts.chart('daily_rejection_persentase_chart', {
        chart: {
            type: 'column',
            backgroundColor: 'transparent',
        },
        exporting: {
            enabled: false
        },

        title: {
            text: 'Daily Rejection <?=($child_filter == 0) ? 'All Line' : 'Line '.$child_filter?>',
            align: 'center',
            style: {
                color: '#ffffff',
                fontSize: '20px',
            }
        },

        subtitle: {
            text: 'Source: Laporan Harian Produksi',
            align: 'center',
            style: {
                color: '#ffffff',
                fontSize: '15px'
            }
        },

        xAxis: {
            categories: <?= json_encode($dates); ?>,
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Unit'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                },
                formatter: function(){
                    return (this.y!=0)?this.y:"";
                }
            },
            labels: {
                style: {
                    color: '#ffffff'
                }
            }
        },
        legend: {
            align: 'center',
            verticalAlign: 'bottom',
            layout: 'horizontal',
            itemStyle: {
                color: '#ffffff'
            }
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                    formatter: function(){
                        return (this.y!=0)?this.y:"";
                    }
                },
                events: {
                    click: function(event) {
                        var date = $('#bulan').val()+'-'+event.point.category;
                        var line = <?=$child_filter?>;
                        var jenis_reject = this.name;

                        $.ajax({
                            url: "<?= base_url('dashboard/reject/get_detail_rejection'); ?>",
                            type: "POST",
                            data: {
                                date: date,
                                line: line,
                                jenis_reject: jenis_reject
                            },
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                var data_reject_by_jenis_reject = data['data_reject_by_jenis_reject'];
                                var i;
                                var arr_kategori_reject = [];
                                var arr_qty_kategori_reject = [];
                                for (i = 0; i < data_reject_by_jenis_reject.length; i++) {
                                    arr_kategori_reject.push(data_reject_by_jenis_reject[i].kategori_reject);
                                    arr_qty_kategori_reject.push(data_reject_by_jenis_reject[i].qty);
                                }
                                $('#detail_pareto_kategori_reject').html(`  <figure class="highcharts-figure">
                                                                                <div id="chart_pareto_ketegori_reject"></div>
                                                                            </figure>`
                                                                        );
                                Highcharts.chart('chart_pareto_ketegori_reject', {
                                    chart: {
                                            backgroundColor: 'transparent',
                                            type: 'column'
                                        },
                                        exporting: {
                                            enabled: false
                                        },
                                        title: {
                                            text: 'Detail '+jenis_reject+' Rejection',
                                            style: {
                                                color: '#ffffff',
                                                fontSize: '20px'
                                            }
                                        },
                                        xAxis: {
                                            categories: arr_kategori_reject,
                                            crosshair: true,
                                            labels: {
                                                style: {
                                                    color: '#ffffff'
                                                }
                                            }
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
                                                borderWidth: 0,
                                                dataLabels: {
                                                enabled: true,
                                                style: {
                                                    color: '#ffffff',
                                                    textOutline: 0,
                                                    fontSize: 14
                                                },
                                            },
                                            }
                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        series: [{
                                            name: 'Total',
                                            data: arr_qty_kategori_reject,
                                            color:'yellow',

                                        }]
                                });

                                var data_reject_by_type_battery = data['data_reject_by_type_battery'];
                                var i;
                                var arr_type_battery = [];
                                var arr_qty_type_battery = [];
                                for (i = 0; i < data_reject_by_type_battery.length; i++) {
                                    arr_type_battery.push(data_reject_by_type_battery[i].type_battery);
                                    arr_qty_type_battery.push(data_reject_by_type_battery[i].qty);
                                }
                                $('#detail_pareto_type_battery').html(`  <figure class="highcharts-figure">
                                                                                <div id="chart_pareto_battery_reject"></div>
                                                                            </figure>`
                                                                        );
                                Highcharts.chart('chart_pareto_battery_reject', {
                                    chart: {
                                            backgroundColor: 'transparent',
                                            type: 'column'
                                        },
                                        exporting: {
                                            enabled: false
                                        },
                                        title: {
                                            text: 'Detail Type Battery Rejection',
                                            style: {
                                                color: '#ffffff',
                                                fontSize: '20px'
                                            }
                                        },
                                        xAxis: {
                                            categories: arr_type_battery,
                                            crosshair: true,
                                            labels: {
                                                style: {
                                                    color: '#ffffff'
                                                }
                                            }
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
                                                borderWidth: 0,
                                                dataLabels: {
                                                enabled: true,
                                                style: {
                                                    color: '#ffffff',
                                                    textOutline: 0,
                                                    fontSize: 14
                                                },
                                            },
                                            }
                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        series: [{
                                            name: 'Total',
                                            data: arr_qty_type_battery,
                                            color:'yellow',

                                        }]
                                });
                                $('#main_modal').modal('show');
                            }
                        });
                    }
                }
            }
        },
        colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
        series: <?php echo json_encode($result_daily_reject_persentase_without_setting); ?>,
    });

    Highcharts.chart('monthly_rejection_persentase_chart', {
        chart: {
            type: 'column',
            // backgroundColor: '#0c1a32',
            backgroundColor: 'transparent',
            
        },
        exporting: {
            enabled: false
        },
        title: {
            text: 'Monthly Jenis Rejection (%)',
            style: {
                color: '#ffffff',
                fontSize: '20px'
            }
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
            crosshair: true,
            labels: {
                style: {
                    color: '#ffffff'
                }
            }
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
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    formatter: function(){
                        return (this.y!=0)?this.y:"";
                    },
                    style: {
                        color: '#ffffff',
                        textOutline: 0,
                        fontSize: 14
                    },
                },
            }
        },
        legend: {
                enabled: false
            },

        series: [{
            // name: 'All Line',
            data: <?php echo json_encode($data_qty_reject_by_month); ?>,
            color:'yellow',

        }]
    });
</script>
<?= $this->endSection(); ?>