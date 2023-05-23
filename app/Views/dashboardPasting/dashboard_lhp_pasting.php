<?= $this->extend('template/dashboardPasting/layout'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<?= date_default_timezone_set('Asia/Jakarta'); ?>
<?php
$current_date = idate('m', strtotime($bulan));
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
      <div class="row">
        <div class="box bg-transparent">
          <div class="box-body" style="display:flex">
            <div class="col-2">
              <form action="<?= base_url() ?>dashboardPasting/pasting" method="POST">
                <select class="form-select" name="jenis_dashboard" id="jenis_dashboard" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px;">
                  <option value="1">Efficiency</option>
                  <option value="2">Unit / MH</option>
                </select>
                &nbsp;
                <input type="month" class="form-control" name="bulan" id="bulan" value="<?= $bulan ?>" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px;">
                &nbsp;
                <div style="display: flex; flex-direction: column;">
                  <button class="btn btn-sm btn-success" style="font-size: 20px;font-weight: 900;width: 250px;"> Filter </button>
                </div>
              </form>
            </div>
            <div class="col-4" style="display:flex; margin-top:35px;">
              <div class="col-6">
                <div class="col">
                  <div id="year_to_date_chart" style="height:250px;"></div>
                </div>
                <div class="col">
                  <div id="previous_month_chart" style="height:250px;"></div>
                </div>
              </div>
              <div class="col-6">
                <div class="col">
                  <div id="target_chart" style="height:250px;"></div>
                </div>
                <div class="col">
                  <div id="current_month_chart" style="height:250px;"></div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="box bg-transparent">
                <div class="box-body">
                  <div class="box no-shadow mb-0 bg-transparent">
                    <div class="box-body px-0 pt-0">
                      <figure class="highcharts-figure">
                        <div id="monthly_efficiency_chart"></div>
                      </figure>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box bg-transparent">
        <div class="box-body">
          <div class="row">
            <div class="col">
              <figure class="highcharts-figure">
                <div id="daily_efficiency_chart"></div>
              </figure>
            </div>
          </div>
        </div>
      </div>
      <div class="box bg-transparent">
        <div class="box-body">
          <div class="row" id="efficiency-wrapper">
            <div class="col-xl-8 col-12">
              <div class="box bg-transparent">
                <div class="box-body">
                  <figure class="highcharts-figure">
                    <div id="efficiency_per_group_chart"></div>
                  </figure>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-12">
              <!-- <?php foreach ($data_all_grup as $dag) { ?>
                <div class="box">
                  <div class="box-body">
                    <div class="text-center">
                      <h5>Efficiency Comparison Group <?= $dag['grup'] ?></h5>
                    </div>
                    <div class="row row-cols-2">
                      <div class="col">
                        <div id="previous_month_chart_group_<?= str_replace(' ', '_', $dag['grup']) ?>" style="height:250px;"></div>
                      </div>
                      <div class="col">
                        <div id="current_month_chart_group_<?= str_replace(' ', '_', $dag['grup']) ?>" style="height:250px;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?> -->
              <div class="box bg-transparent">
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table" style="width: 100%; margin: 0 auto; color:white; font-weight:700; font-size:18px;">
                      <thead>
                        <tr>
                          <td>#</td>
                          <td><?=date('F', mktime(0, 0, 0, $previous_date, 10))?></td>
                          <td><?=date('F', mktime(0, 0, 0, $current_date, 10))?></td>
                          <td>Status</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data_current_month_group as $dcmg => $value) { ?>
                          <tr>
                            <td><?= $dcmg ?></td>
                            <td><?= array_key_exists($dcmg, $data_previous_month_group) ? number_format($data_previous_month_group[$dcmg]['persentase'], 2) : 0 ?></td>
                            <td><?= number_format($value['persentase'], 2) ?></td>
                            <td>
                              <?php if(array_key_exists($dcmg, $data_previous_month_group)) {
                                if(number_format($data_previous_month_group[$dcmg]['persentase'], 2) < number_format($value['persentase'], 2)) {
                                  echo '<i class="fa fa-arrow-up" style="color:green"></i>';
                                } else if(number_format($data_previous_month_group[$dcmg]['persentase'], 2) > number_format($value['persentase'], 2)) {
                                  echo '<i class="fa fa-arrow-down" style="color:red"></i>';
                                } else if(number_format($data_previous_month_group[$dcmg]['persentase'], 2) == number_format($value['persentase'], 2)) {
                                  echo '<i class="fa fa-minus" style="color:yellow"></i>';
                                }
                              } else {
                                if(number_format($value['persentase'], 2) > 0) {
                                  echo '<i class="fa fa-arrow-up" style="color:green"></i>';
                                } else if(number_format($value['persentase'], 2) == 0) {
                                  echo '<i class="fa fa-minus" style="color:yellow"></i>';
                                }
                              }?>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="box bg-transparent">
        <div class="box-body">
          <div class="row" id="efficiency_comparison_group">
            <div class="col">
              <div id="efficiency_comparison_group" style="height:250px;"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="col-12">
        <div class="box">
          <div class="box-body">
            <figure class="highcharts-figure">
              <div id="efficiency_per_mp_chart"></div>
            </figure>
          </div>
        </div>
      </div> -->
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
              <td>Nama Mesin</td>
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
<?= $this->endSection();
?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {});

  // PIE CHART YEAR TO GET
  var year_to_date_chart = echarts.init(document.getElementById('year_to_date_chart'));
  year_to_date_chart.setOption({
    title: {
      text: '<?= json_encode($data_all_year) ?>%',
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
    series: [{
      name: '1',
      type: 'pie',
      clockWise: false,
      radius: ['75%', '90%'],
      itemStyle: {
        normal: {
          label: {
            show: false
          },
          labelLine: {
            show: false
          }
        }
      },
      data: [{
          value: <?= json_encode($data_all_year) ?>,
          name: 'Monday',
          itemStyle: {
            color: 'blue'
          }
        },
        {
          value: 100 - <?= json_encode($data_all_year) ?>,
          name: 'invisible',
          itemStyle: {
            color: 'grey'
          }
        }
      ]
    }, ]
  });

  // PIE CHART TARGET
  var target_chart = echarts.init(document.getElementById('target_chart'));
  target_chart.setOption({
    title: {
      text: '85%',
      subtext: 'Target 2023',
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
    series: [{
      name: '1',
      type: 'pie',
      clockWise: false,
      radius: ['75%', '90%'],
      itemStyle: {
        normal: {
          label: {
            show: false
          },
          labelLine: {
            show: false
          }
        }
      },
      data: [{
          value: 85,
          name: 'Monday',
          itemStyle: {
            color: '#ff9920'
          }
        },
        {
          value: 15,
          name: 'invisible',
          itemStyle: {
            color: 'grey'
          }
        }
      ]
    }, ]
  });

  // // PIE CHART Previous Month
  var previous_month_chart = echarts.init(document.getElementById('previous_month_chart'));
  previous_month_chart.setOption({
    title: {
      text: '<?= json_encode($data_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1]) ?>%',
      subtext: '<?= date('F', mktime(0, 0, 0, $previous_date, 10)) ?> Efficiency',
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
    series: [{
      name: '1',
      type: 'pie',
      clockWise: false,
      radius: ['75%', '90%'],
      itemStyle: {
        normal: {
          label: {
            show: false
          },
          labelLine: {
            show: false
          }
        }
      },
      data: [{
          value: <?= json_encode($data_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1]) ?>,
          name: 'Monday',
          itemStyle: {
            color: 'red'
          }
        },
        {
          value: 100 - <?= json_encode($data_all_month[date('n', mktime(0, 0, 0, $previous_date, 10)) - 1]) ?>,
          name: 'invisible',
          itemStyle: {
            color: 'grey'
          }
        }
      ]
    }, ]
  });

  // // PIE CHART Current Month
  var current_month_chart = echarts.init(document.getElementById('current_month_chart'));
  current_month_chart.setOption({
    title: {
      text: '<?= json_encode($data_all_month[date('n', mktime(0, 0, 0, $current_date, 10)) - 1]) ?>%',
      subtext: '<?= date('F', mktime(0, 0, 0, $current_date, 10)) ?> Efficiency',
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
    series: [{
      name: '1',
      type: 'pie',
      clockWise: false,
      radius: ['75%', '90%'],
      itemStyle: {
        normal: {
          label: {
            show: false
          },
          labelLine: {
            show: false
          }
        }
      },
      data: [{
          value: <?= json_encode($data_all_month[date('n', mktime(0, 0, 0, $current_date, 10)) - 1]) ?>,
          name: 'Monday',
          itemStyle: {
            color: 'cyan'
          }
        },
        {
          value: 100 - <?= json_encode($data_all_month[date('n', mktime(0, 0, 0, $current_date, 10)) - 1]) ?>,
          name: 'invisible',
          itemStyle: {
            color: 'grey'
          }
        }
      ]
    }, ]
  });

  // // // PIE CHART PREVIOUS MONTH GROUP NGADINO
  // var previous_month_chart_group_a = echarts.init(document.getElementById('previous_month_chart_group_a'));
  // previous_month_chart_group_a.setOption({
  //   title: {
  //     text: '<?= (($data_previous_month_group !== 0 && array_key_exists('Ahmad Mujib', $data_previous_month_group)) && array_key_exists('Ahmad Mujib', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['Ahmad Mujib']['persentase']), 2) : 0 ?>%',
  //     subtext: '<?= date('F', mktime(0, 0, 0, $previous_date, 10)) ?> Efficiency',
  //     x: 'center',
  //     y: 'center',
  //     itemGap: 5,
  //     textStyle: {
  //       color: '#ffffff',
  //       fontSize: 30,
  //       fontWeight: '700'
  //     },
  //     subtextStyle: {
  //       color: '#ffffff',
  //       fontSize: 15,
  //       fontWeight: 'normal'
  //     }

  //   },
  //   series: [{
  //     name: '1',
  //     type: 'pie',
  //     clockWise: false,
  //     radius: ['75%', '90%'],
  //     itemStyle: {
  //       normal: {
  //         label: {
  //           show: false
  //         },
  //         labelLine: {
  //           show: false
  //         }
  //       }
  //     },
  //     data: [{
  //         value: <?= ($data_previous_month_group !== 0 && array_key_exists('Ahmad Mujib', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['Ahmad Mujib']['persentase']), 2) : 0 ?>,
  //         name: 'Monday',
  //         itemStyle: {
  //           color: 'red'
  //         }
  //       },
  //       {
  //         value: 100 - <?= ($data_previous_month_group !== 0 && array_key_exists('Ahmad Mujib', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['Ahmad Mujib']['persentase']), 2) : 0 ?>,
  //         name: 'invisible',
  //         itemStyle: {
  //           color: 'grey'
  //         }
  //       }
  //     ]
  //   }, ]
  // });

  <?php foreach($data_all_grup as $dag) { ?>
    // // // PIE CHART CURRENT MONTH GROUP
    // var current_month_chart_group_<?= str_replace(' ', '_', $dag['grup']) ?> = echarts.init(document.getElementById('current_month_chart_group_<?= str_replace(' ', '_', $dag['grup']) ?>'));
    // current_month_chart_group_<?= str_replace(' ', '_', $dag['grup']) ?>.setOption({
    //   title: {
    //     text: '<?= (($data_current_month_group !== 0 && array_key_exists($dag['grup'], $data_current_month_group))  && array_key_exists($dag['grup'], $data_current_month_group)) ? number_format(json_encode($data_current_month_group[$dag['grup']]['persentase']), 2) : 0 ?>%',
    //     subtext: '<?= date('F', mktime(0, 0, 0, $current_date, 10)) ?> Efficiency',
    //     x: 'center',
    //     y: 'center',
    //     itemGap: 5,
    //     textStyle: {
    //       color: '#ffffff',
    //       fontSize: 30,
    //       fontWeight: '700'
    //     },
    //     subtextStyle: {
    //       color: '#ffffff',
    //       fontSize: 15,
    //       fontWeight: 'normal'
    //     }
  
    //   },
    //   series: [{
    //     name: '1',
    //     type: 'pie',
    //     clockWise: false,
    //     radius: ['75%', '90%'],
    //     itemStyle: {
    //       normal: {
    //         label: {
    //           show: false
    //         },
    //         labelLine: {
    //           show: false
    //         }
    //       }
    //     },
    //     data: [{
    //         value: <?= ($data_current_month_group !== 0 && array_key_exists($dag['grup'], $data_current_month_group))  ? number_format(json_encode($data_current_month_group[$dag['grup']]['persentase']), 2) : 0 ?>,
    //         name: 'Monday',
    //         itemStyle: {
    //           color: 'cyan'
    //         }
    //       },
    //       {
    //         value: 100 - <?= ($data_current_month_group !== 0 && array_key_exists($dag['grup'], $data_current_month_group))  ? number_format(json_encode($data_current_month_group[$dag['grup']]['persentase']), 2) : 0 ?>,
    //         name: 'invisible',
    //         itemStyle: {
    //           color: 'grey'
    //         }
    //       }
    //     ]
    //   }, ]
    // });
  <?php } ?>

  <?php foreach($data_all_grup as $dag) { ?>
  //   // // PIE CHART PREVIOUS MONTH GROUP MASTIKIN
  // var previous_month_chart_group_<?= str_replace(' ', '_', $dag['grup']) ?> = echarts.init(document.getElementById('previous_month_chart_group_<?= str_replace(' ', '_', $dag['grup']) ?>'));
  // previous_month_chart_group_<?= str_replace(' ', '_', $dag['grup']) ?>.setOption({
  //   title: {
  //     text: '<?= ($data_previous_month_group !== 0 && array_key_exists($dag['grup'], $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group[$dag['grup']]['persentase']), 2) : 0 ?>%',
  //     subtext: '<?= date('F', mktime(0, 0, 0, $previous_date, 10)) ?> Efficiency',
  //     x: 'center',
  //     y: 'center',
  //     itemGap: 5,
  //     textStyle: {
  //       color: '#ffffff',
  //       fontSize: 30,
  //       fontWeight: '700'
  //     },
  //     subtextStyle: {
  //       color: '#ffffff',
  //       fontSize: 15,
  //       fontWeight: 'normal'
  //     }

  //   },
  //   series: [{
  //     name: '1',
  //     type: 'pie',
  //     clockWise: false,
  //     radius: ['75%', '90%'],
  //     itemStyle: {
  //       normal: {
  //         label: {
  //           show: false
  //         },
  //         labelLine: {
  //           show: false
  //         }
  //       }
  //     },
  //     data: [{
  //         value: <?= ($data_previous_month_group !== 0 && array_key_exists($dag['grup'], $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group[$dag['grup']]['persentase']), 2) : 0 ?>,
  //         name: 'Monday',
  //         itemStyle: {
  //           color: 'red'
  //         }
  //       },
  //       {
  //         value: 100 - <?= ($data_previous_month_group !== 0 && array_key_exists($dag['grup'], $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group[$dag['grup']]['persentase']), 2) : 0 ?>,
  //         name: 'invisible',
  //         itemStyle: {
  //           color: 'grey'
  //         }
  //       }
  //     ]
  //   }, ]
  // });
  <?php } ?>

  // // // PIE CHART PREVIOUS MONTH GROUP MASTIKIN
  // var previous_month_chart_group_c = echarts.init(document.getElementById('previous_month_chart_group_c'));
  // previous_month_chart_group_c.setOption({
  //   title: {
  //     text: '<?= ($data_previous_month_group !== 0 && array_key_exists('Daryanto', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['Daryanto']['persentase']), 2) : 0 ?>%',
  //     subtext: '<?= date('F', mktime(0, 0, 0, $previous_date, 10)) ?> Efficiency',
  //     x: 'center',
  //     y: 'center',
  //     itemGap: 5,
  //     textStyle: {
  //       color: '#ffffff',
  //       fontSize: 30,
  //       fontWeight: '700'
  //     },
  //     subtextStyle: {
  //       color: '#ffffff',
  //       fontSize: 15,
  //       fontWeight: 'normal'
  //     }

  //   },
  //   series: [{
  //     name: '1',
  //     type: 'pie',
  //     clockWise: false,
  //     radius: ['75%', '90%'],
  //     itemStyle: {
  //       normal: {
  //         label: {
  //           show: false
  //         },
  //         labelLine: {
  //           show: false
  //         }
  //       }
  //     },
  //     data: [{
  //         value: <?= ($data_previous_month_group !== 0 && array_key_exists('Daryanto', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['Daryanto']['persentase']), 2) : 0 ?>,
  //         name: 'Monday',
  //         itemStyle: {
  //           color: 'red'
  //         }
  //       },
  //       {
  //         value: 100 - <?= ($data_previous_month_group !== 0 && array_key_exists('Daryanto', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['Daryanto']['persentase']), 2) : 0 ?>,
  //         name: 'invisible',
  //         itemStyle: {
  //           color: 'grey'
  //         }
  //       }
  //     ]
  //   }, ]
  // });

  // // // PIE CHART CURRENT MONTH GROUP NGADINO
  // var current_month_chart_group_c = echarts.init(document.getElementById('current_month_chart_group_c'));
  // current_month_chart_group_c.setOption({
  //   title: {
  //     text: '<?= ($data_current_month_group !== 0 && array_key_exists('Daryanto', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['Daryanto']['persentase']), 2) : 0 ?>%',
  //     subtext: '<?= date('F', mktime(0, 0, 0, $current_date, 10)) ?> Efficiency',
  //     x: 'center',
  //     y: 'center',
  //     itemGap: 5,
  //     textStyle: {
  //       color: '#ffffff',
  //       fontSize: 30,
  //       fontWeight: '700'
  //     },
  //     subtextStyle: {
  //       color: '#ffffff',
  //       fontSize: 15,
  //       fontWeight: 'normal'
  //     }

  //   },
  //   series: [{
  //     name: '1',
  //     type: 'pie',
  //     clockWise: false,
  //     radius: ['75%', '90%'],
  //     itemStyle: {
  //       normal: {
  //         label: {
  //           show: false
  //         },
  //         labelLine: {
  //           show: false
  //         }
  //       }
  //     },
  //     data: [{
  //         value: <?= ($data_current_month_group !== 0 && array_key_exists('Daryanto', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['Daryanto']['persentase']), 2) : 0 ?>,
  //         name: 'Monday',
  //         itemStyle: {
  //           color: 'cyan'
  //         }
  //       },
  //       {
  //         value: 100 - <?= ($data_current_month_group !== 0 && array_key_exists('Daryanto', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['Daryanto']['persentase']), 2) : 0 ?>,
  //         name: 'invisible',
  //         itemStyle: {
  //           color: 'grey'
  //         }
  //       }
  //     ]
  //   }, ]
  // });

  Highcharts.chart('monthly_efficiency_chart', {
    chart: {
      backgroundColor: 'transparent',
      zoomType: 'xy'
    },
    exporting: {
      enabled: false
    },
    title: {
      text: 'Monthly Efficiency',
      style: {
        color: '#ffffff',
        fontSize: '20px'
      }
    },
    xAxis: [{
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
    }],
    yAxis: [{
      min: 0,
      max: 100,
      title: {
        text: ''
      },
      labels: {
        format: '{value} %'
      }
    }, {
      title: {
        text: ''
      },
    }],
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0,
        dataLabels: {
          enabled: true,
        }
      },
    },
    legend: {
      enabled: false
    },

    series: [{
      name: 'Efficiency',
      type: 'column',
      data: <?php echo json_encode($data_all_month); ?>,
      color: 'yellow',
      tooltip: {
        valueSuffix: ' %'
      }
    }, {
      name: 'Target',
      type: 'line',
      data: [<?php for ($i = 0; $i < 12; $i++) {
                echo '85,';
              } ?>],
      color: 'red',
      tooltip: {
        valueSuffix: ' %'
      }
    }]
  });
  let data_current_month_group = <?= json_encode($data_current_month_group) ?>;
  sortedKeys = Object.keys(data_current_month_group).sort((a, b) => data_current_month_group[b].persentase - data_current_month_group[a].persentase);

  const sortedObjek = {};
  sortedKeys.forEach(key => {
    sortedObjek[key] = data_current_month_group[key];
  });
  let arr_grup = [];
  let arr_efficiency = [];
  console.log(sortedObjek);
  for (let [key, value] of Object.entries(sortedObjek)) {
      arr_grup.push(key.replace('_', ' ').toUpperCase());
      arr_efficiency.push(parseFloat(value.persentase.toFixed(2)));
  }
  console.log({arr_grup, arr_efficiency})
  Highcharts.chart('efficiency_comparison_group', {
    chart: {
      backgroundColor: 'transparent',
      zoomType: 'xy'
    },
    exporting: {
      enabled: false
    },
    title: {
      text: 'Efficiency Comparison Group',
      style: {
        color: '#ffffff',
        fontSize: '20px'
      }
    },
    xAxis: [{
      categories: arr_grup,
      crosshair: true
    }],
    yAxis: [{
      min: 0,
      max: 100,
      title: {
        text: ''
      },
      labels: {
        format: '{value} %'
      }
    }, {
      title: {
        text: ''
      },
    }],
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0,
        dataLabels: {
          enabled: true,
        }
      },
    },
    legend: {
      enabled: false
    },

    series: [{
      name: 'Efficiency',
      type: 'column',
      data: arr_efficiency,
      color: 'yellow',
      tooltip: {
        valueSuffix: ' %'
      }
    }, {
      name: 'Target',
      type: 'line',
      data: [<?php for ($i = 0; $i < count($data_current_month_group); $i++) {
                echo '85,';
              } ?>],
      color: 'red',
      tooltip: {
        valueSuffix: ' %'
      }
    }]
  });

  // // GENERATE DATE X AXIS DATE

  <?php
  $dates = array();

  // date_default_timezone_set('Asia/Jakarta');
  $start = date('Y-m-01');
  $now = date('Y-m-d');

  $current_month = date('Y-m');
  if ($bulan != null or $bulan != $current_month) {
    $start = date('Y-m-01', strtotime($bulan));
    $now = date('Y-m-t', strtotime($bulan));
  }

  while (strtotime($start) <= strtotime($now)) {
    array_push($dates, date('d', strtotime($start)));
    $start = date("Y-m-d", strtotime("+1 day", strtotime($start)));
  }
  ?>

  Highcharts.chart('daily_efficiency_chart', {
    chart: {
      backgroundColor: 'transparent',
      zoomType: 'xy'
    },
    exporting: {
      enabled: false
    },
    title: {
      text: 'Daily Efficiency',
      style: {
        color: '#ffffff',
        fontSize: '20px'
      }
    },
    xAxis: [{
      categories: <?= json_encode($dates) ?>,
      crosshair: true
    }],
    yAxis: [{
      min: 0,
      max: 100,
      title: {
        text: ''
      },
      labels: {
        format: '{value} %'
      }
    }, {
      title: {
        text: ''
      },
    }],
    plotOptions: {
      column: {
        // pointPadding: 0.2,
        // borderWidth: 0,
        dataLabels: {
          enabled: true,
        }
      },
    },
    legend: {
      enabled: false
    },

    series: [{
      name: 'Efficiency',
      type: 'column',
      data: <?php echo json_encode($data_all_date); ?>,
      color: 'yellow',
      tooltip: {
        valueSuffix: ' %'
      },
      point: {
        events: {
          click: function() {
            var date = $('#bulan').val() + '-' + this.category;
            $.ajax({
              url: "<?= base_url('dashboardPasting/pasting/get_data_line_stop'); ?>",
              type: "POST",
              data: {
                date: date,
              },
              dataType: "json",
              success: function(data) {
                console.log(data);
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                  html += '<tr>' +
                    '<td>Mesin ' + data[i].nama_mesin_pasting + '</td>' +
                    '<td>' + data[i].uraian_line_stop + '</td>' +
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
    }, {
      name: 'Target',
      type: 'line',
      data: [<?php for ($i = 0; $i < count($dates); $i++) {
                echo '85,';
              } ?>],
      color: 'red',
      tooltip: {
        valueSuffix: ' %'
      }
    }]
  });

  Highcharts.chart('efficiency_per_group_chart', {
    chart: {
      backgroundColor: 'transparent',
      zoomType: 'xy'
    },
    exporting: {
      enabled: false
    },
    title: {
      text: 'Efficiency Per Group',
      style: {
        color: '#ffffff',
        fontSize: '20px'
      }
    },
    xAxis: [{
      categories: <?= json_encode($dates) ?>,
      crosshair: true
    }],
    yAxis: [{
      min: 0,
      max: 100,
      title: {
        text: ''
      },
      labels: {
        format: '{value} %'
      }
    }, {
      title: {
        text: ''
      },
    }],
    // plotOptions: {
    //   line: {
    //     pointPadding: 0.2,
    //     borderWidth: 0,
    //     dataLabels: {
    //       enabled: true,
    //     }
    //   },
    // },
    legend: {
      enabled: true
    },

    series: [<?php foreach($data_all_grup as $dag) { ?>
        {
          name: '<?= $dag['grup'] ?>',
          type: 'line',
          data: [<?php if($data_all_date_group !== 0) {
                    foreach ($data_all_date_group as $d_all_date_group) {
                      if ($d_all_date_group['grup'] === $dag['grup']) {
                        echo $d_all_date_group['data'] . ',';
                      }
                    }
                  } ?>],
          // color: 'yellow',
          tooltip: {
            valueSuffix: ' %'
          }
      },
    <?php } ?>
    //   {
    //   name: 'Ahmad Mujib',
    //   type: 'line',
    //   data: [<?php //if($data_all_date_group !== 0) {
    //             foreach ($data_all_date_group as $d_all_date_group) {
    //               if ($d_all_date_group['grup'] === 'Ahmad Mujib') {
    //                 echo $d_all_date_group['data'] . ',';
    //               }
    //             }
    //           } ?>],
    //   color: 'yellow',
    //   tooltip: {
    //     valueSuffix: ' %'
    //   }
    // }, {
    //   name: 'Abdul Mujib',
    //   type: 'line',
    //   data: [<?php //if ($data_all_date_group !== 0) {
    //             foreach ($data_all_date_group as $d_all_date_group) {
    //               if ($d_all_date_group['grup'] === 'Abdul Mujib') {
    //                 echo $d_all_date_group['data'] . ',';
    //               }
    //             }
    //           } ?>],
    //   color: '#20c997',
    //   tooltip: {
    //     valueSuffix: ' %'
    //   }
    // }, {
    //   name: 'Daryanto',
    //   type: 'line',
    //   data: [<?php //if ($data_all_date_group !== 0) {
    //             foreach ($data_all_date_group as $d_all_date_group) {
    //               if ($d_all_date_group['grup'] === 'Daryanto') {
    //                 echo $d_all_date_group['data'] . ',';
    //               }
    //             }
    //           } ?>],
    //   color: '#0dcaf0',
    //   tooltip: {
    //     valueSuffix: ' %'
    //   }
    // }, {
    //   name: 'Target',
    //   type: 'line',
    //   data: [<?php //for ($i = 0; $i < count($dates); $i++) {
    //             echo '85,';
    //           } ?>],
    //   color: 'red',
    //   tooltip: {
    //     valueSuffix: ' %'
    //   }
    // }
  ]
  });
</script>
<?= $this->endSection(); ?>