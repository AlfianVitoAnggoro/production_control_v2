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
                                    <option value="1">Efficiency</option>
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
                                <select class="form-select" name="baby_filter" id="baby_filter" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px; display:none;">
                                    <?php if ($child_filter == 0) { ?>
                                        <option value="average" <?= ($baby_filter == 'average') ? 'selected':''?>>By Average</option>
                                    <?php } else { ?>
                                        <option value="average" <?= ($baby_filter == 'average') ? 'selected':''?>>By Average</option>
                                        <option value="shift" <?= ($baby_filter == 'shift') ? 'selected':''?>>By Shift</option>
                                        <option value="grup" <?= ($baby_filter == 'grup') ? 'selected':''?>>By Grup</option>
                                        <option value="kasubsie" <?= ($baby_filter == 'kasubsie') ? 'selected':''?>>By Kasubsie</option>
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
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div id="year_to_date_chart" style="height:250px;"></div>
                                </div>
                                <div class="col-3">
                                    <div id="target_chart" style="height:250px;"></div>
                                </div>
                                <!-- <div class="col-3">
                                    <div id="previous_month_chart" style="height:250px;"></div>
                                </div> -->
                                <div class="col-3">
                                    <div id="current_month_chart" style="height:250px;"></div>
                                </div>
                                <div class="col-3" style="display:flex;text-align:center;flex-direction: column;align-items: center;flex-wrap: nowrap;justify-content: space-around;">
                                    <a href="<?=base_url()?>dashboard/assy" class="btn btn-danger btn-nav">Efficiency</a>
                                    <button class="btn btn-info btn-nav">Line Stop</button>
                                    <button class="btn btn-success btn-nav">Overtime</button>
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

			<div class="row" id="efficiency-wrapper">
				<div class="col-xl-8 col-12">
					<div class="box bg-transparent">
						<div class="box-body">
                            <figure class="highcharts-figure">
                                <div id="main_chart"></div>
                            </figure>
						</div>
					</div>										
				</div>
				<div class="col-xl-4 col-12">
					<div class="box bg-transparent">
						<div class="box-body">							
							<!-- <div class="box no-shadow mb-0">
								<div class="box-body px-0 pt-0"> -->
                                    <figure class="highcharts-figure">
                                        <div id="side_chart"></div>
                                    </figure>
								<!-- </div>
							</div>							 -->
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
                <div id="detail_pareto_kategori_reject"></div>
                <div id="detail_pareto_type_battery"></div>
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
        setTimeout(function () { location.reload(1); }, 60*60*1000);
    });

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
                    radius: ['75%', '90%'],
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
                    radius: ['75%', '90%'],
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
    //             subtext: '<?=date('F', mktime(0, 0, 0, $previous_date, 10))?> Efficiency',
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
                    radius: ['75%', '90%'],
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
                                color: 'cyan'
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
            
        },
        exporting: {
            enabled: false
        },
        title: {
            text: 'Monthly Rejection (%)',
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
            text: 'Monthly Jenis Rejection (Unit)',
            style: {
                color: '#ffffff',
                fontSize: '20px'
            }
        },
        xAxis: {
            categories: <?php echo json_encode($data_jenis_reject_by_month); ?>,
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
                text: 'Unit'
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
            data: <?php echo json_encode($data_total_reject_by_month); ?>,
            color:'yellow',

        }]
    });

    // Highcharts.chart('side_chart', {
    //     chart: {
    //         type: 'pie',
    //         backgroundColor: '#0c1a32',
    //     },
    //     exporting: {
    //         enabled: false
    //     },
    //     title: {
    //         text: 'Monthly Rejection',
    //         align: 'center',
    //         style: {
    //             color: '#ffffff',
    //             fontSize: '20px',
    //             fontWeight: 'bold'
    //         }
    //     },
    //     tooltip: {
    //         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    //     },
    //     accessibility: {
    //         point: {
    //             valueSuffix: '%'
    //         }
    //     },
    //     plotOptions: {
    //         pie: {
    //             allowPointSelect: true,
    //             cursor: 'pointer',
    //             dataLabels: {
    //                 enabled: true,
    //                 format: '<b>{point.name}</b>: {point.percentage:.1f} %'
    //             }
    //         }
    //     },
    //     series: [{
    //         name: 'Rejection',
    //         colorByPoint: true,
    //         data: 
    //     }]
    // });

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
            text: 'Daily Rejection',
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
        // legend: {
        //     align: 'right',
        //     x: -30,
        //     verticalAlign: 'top',
        //     y: 25,
        //     floating: true,
        //     backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        //     borderColor: '#CCC',
        //     borderWidth: 1,
        //     shadow: false
        // },
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
                            url: "<?= base_url('dashboard/reject/get_detail_rejection_by_jenis'); ?>",
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
                                                text: 'Pcs'
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
                                            // name: 'Tokyo',
                                            data: arr_qty_kategori_reject,
                                            color:'yellow',

                                        }]
                                });
                                $('.modal').modal('show');
                            }
                        });
                    }
                }
            }
        },
        colors: ['yellow', 'red', 'cyan', 'azure', 'LawnGreen', 'orange', 'blue'],
        series: <?php echo json_encode($result); ?>,
    });
</script>
<?= $this->endSection(); ?>