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
?>

<div class="content-wrapper" style="margin-left:0; margin-top:50px;">
	<div class="container-full">
		<!-- Main content -->
		<section class="content">
            <div class="row">
                <div class="box bg-transparent">
                    <div class="box-body" style="display:flex">
                        <div class="col-2">
                            <form action="<?=base_url()?>dashboard/rejectCutting" method="POST">
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
                                <div class="col-4">
                                    <div id="year_to_date_chart" style="height:250px;"></div>
                                    <!-- <div style="text-align: center;margin-top: 60px;">
                                        <a href="<?=base_url()?>dashboard/assy" class="waves-effect waves-light btn btn-outline btn-rounded btn-primary btn-lg btn-nav">Efficiency</a>
                                    </div> -->
                                </div>
                                <div class="col-4">
                                    <div id="previous_month_chart" style="height:250px;"></div>
                                    <!-- <div style="text-align: center;margin-top: 60px;">
                                        <button class="waves-effect waves-light btn btn-outline btn-rounded btn-warning btn-lg btn-nav">Line Stop</button>
                                    </div> -->
                                </div>
                                <!-- <div class="col-3">
                                    <div id="previous_month_chart" style="height:250px;"></div>
                                </div> -->
                                <div class="col-4">
                                    <div id="current_month_chart" style="height:250px;"></div>
                                    <!-- <div style="text-align: center;margin-top: 60px;">
                                    <button class="waves-effect waves-light btn btn-outline btn-rounded btn-success btn-lg btn-nav">Overtime</button>
                                    </div> -->
                                </div>
                                <!-- <div class="col-3" style="display:flex;text-align:center;flex-direction: column;align-items: center;flex-wrap: nowrap;justify-content: space-around;">
                                    <a href="<?=base_url()?>dashboard/assy" class="waves-effect waves-light btn btn-outline btn-rounded btn-primary btn-nav">Efficiency</a>
                                    <button class="waves-effect waves-light btn btn-outline btn-rounded btn-warning btn-nav">Line Stop</button>
                                    <button class="waves-effect waves-light btn btn-outline btn-rounded btn-success btn-nav">Overtime</button>
                                </div> -->
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
                <div id="detail_pareto_jenis_reject_internal"></div>
                <div id="detail_pareto_jenis_reject_eksternal"></div>
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

    // PIE CHART Previous Month
    var previous_month_chart = echarts.init(document.getElementById('previous_month_chart'));
    previous_month_chart.setOption(
        {
            title: {
                text: '<?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1])?>%',
                subtext: '<?=date('F', mktime(0, 0, 0, $previous_date, 10))?> Rejection',
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
                            value: <?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1])?> * 100,
                            name: 'Monday',
                            itemStyle: {
                                color: 'red'
                            }
                        },
                        {
                            value: 100 - (<?=json_encode($data_reject_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1])?> * 100),
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
                                url: '<?= base_url('dashboard/rejectCutting/get_detail_rejection') ?>',
                                type: 'POST',
                                data: {
                                    date: date,
                                    line: line
                                },
                                dataType: 'JSON',
                                success: function(data) {
                                    console.log(data);
                                    var data_jenis_reject_internal = data['data_jenis_reject_internal'];
                                    var arr_jenis_reject_internal = [];
                                    var arr_qty_jenis_reject_internal = [];
                                    var sortedKeys = Object.keys(data_jenis_reject_internal[0]).sort((a, b) => data_jenis_reject_internal[0][b] - data_jenis_reject_internal[0][a]);
                                    var data_data_jenis_reject_internal = {};
                                    sortedKeys.forEach(key => {
                                        data_data_jenis_reject_internal[key] = data_jenis_reject_internal[0][key];
                                    });
                                    for (let [key, value] of Object.entries(data_data_jenis_reject_internal)) {
                                        arr_jenis_reject_internal.push(key.replace('_', ' ').toUpperCase());
                                        arr_qty_jenis_reject_internal.push(value);
                                    }
                                    $('#detail_pareto_jenis_reject_internal').html(`<figure class="highcharts-figure">
                                                                                            <div id="chart_pareto_jenis_reject_internal"></div>
                                                                                        </figure>
                                                                                    `);
                                    Highcharts.chart('chart_pareto_jenis_reject_internal', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: `Detail Rejection Internal (${date})`,
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_jenis_reject_internal,
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
                                                data: arr_qty_jenis_reject_internal,
                                                color:'yellow',

                                            }]
                                    });

                                    var data_jenis_reject_eksternal = data['data_jenis_reject_eksternal'];
                                    var arr_jenis_reject_eksternal = [];
                                    var arr_qty_jenis_reject_eksternal = [];
                                    var sortedKeys = Object.keys(data_jenis_reject_eksternal[0]).sort((a, b) => data_jenis_reject_eksternal[0][b] - data_jenis_reject_eksternal[0][a]);
                                    var data_data_jenis_reject_eksternal = {};
                                    sortedKeys.forEach(key => {
                                        data_data_jenis_reject_eksternal[key] = data_jenis_reject_eksternal[0][key];
                                    });
                                    for (let [key, value] of Object.entries(data_data_jenis_reject_eksternal)) {
                                        arr_jenis_reject_eksternal.push(key.replace('_', ' ').toUpperCase());
                                        arr_qty_jenis_reject_eksternal.push(value);
                                    }
                                    $('#detail_pareto_jenis_reject_eksternal').html(`<figure class="highcharts-figure">
                                                                                            <div id="chart_pareto_jenis_reject_eksternal"></div>
                                                                                        </figure>
                                                                                    `);
                                    Highcharts.chart('chart_pareto_jenis_reject_eksternal', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: `Detail Rejection Eksternal (${date})`,
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_jenis_reject_eksternal,
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
                                                data: arr_qty_jenis_reject_eksternal,
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
                                url: "<?= base_url('dashboard/rejectCutting/get_detail_rejection') ?>",
                                type: "post",
                                data: {
                                    date: date,
                                    line: line
                                },
                                dataType: "json",
                                success: function(data) {
                                    console.log(data);
                                    var data_jenis_reject_internal = data['data_jenis_reject_internal_by_month'];
                                    var arr_jenis_reject_internal = [];
                                    var arr_qty_jenis_reject_internal = [];
                                    var sortedKeys = Object.keys(data_jenis_reject_internal[0]).sort((a, b) => data_jenis_reject_internal[0][b] - data_jenis_reject_internal[0][a]);
                                    var data_data_jenis_reject_internal = {};
                                    sortedKeys.forEach(key => {
                                        data_data_jenis_reject_internal[key] = data_jenis_reject_internal[0][key];
                                    });
                                    for (let [key, value] of Object.entries(data_data_jenis_reject_internal)) {
                                        arr_jenis_reject_internal.push(key.replace('_', ' ').toUpperCase());
                                        arr_qty_jenis_reject_internal.push(value);
                                    }
                                    $('#detail_pareto_jenis_reject_internal').html(`<figure class="highcharts-figure">
                                                                                            <div id="chart_pareto_jenis_reject_internal"></div>
                                                                                        </figure>
                                                                                    `);
                                    Highcharts.chart('chart_pareto_jenis_reject_internal', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: 'Detail Jenis Rejection Internal',
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_jenis_reject_internal,
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
                                                data: arr_qty_jenis_reject_internal,
                                                color:'yellow',

                                            }]
                                    });
                                    var data_jenis_reject_eksternal = data['data_jenis_reject_eksternal_by_month'];
                                    var arr_jenis_reject_eksternal = [];
                                    var arr_qty_jenis_reject_eksternal = [];
                                    var sortedKeys = Object.keys(data_jenis_reject_eksternal[0]).sort((a, b) => data_jenis_reject_eksternal[0][b] - data_jenis_reject_eksternal[0][a]);
                                    var data_data_jenis_reject_eksternal = {};
                                    sortedKeys.forEach(key => {
                                        data_data_jenis_reject_eksternal[key] = data_jenis_reject_eksternal[0][key];
                                    });
                                    for (let [key, value] of Object.entries(data_data_jenis_reject_eksternal)) {
                                        arr_jenis_reject_eksternal.push(key.replace('_', ' ').toUpperCase());
                                        arr_qty_jenis_reject_eksternal.push(value);
                                    }
                                    $('#detail_pareto_jenis_reject_eksternal').html(`<figure class="highcharts-figure">
                                                                                            <div id="chart_pareto_jenis_reject_eksternal"></div>
                                                                                        </figure>
                                                                                    `);
                                    Highcharts.chart('chart_pareto_jenis_reject_eksternal', {
                                        chart: {
                                                backgroundColor: 'transparent',
                                                type: 'column'
                                            },
                                            exporting: {
                                                enabled: false
                                            },
                                            title: {
                                                text: 'Detail Jenis Rejection Eksternal',
                                                style: {
                                                    color: '#ffffff',
                                                    fontSize: '20px'
                                                }
                                            },
                                            xAxis: {
                                                categories: arr_jenis_reject_eksternal,
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
                                                data: arr_qty_jenis_reject_eksternal,
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
                }
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
</script>
<?= $this->endSection(); ?>