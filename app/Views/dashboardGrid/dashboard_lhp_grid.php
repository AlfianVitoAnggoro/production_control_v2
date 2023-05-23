<?= $this->extend('template/dashboardGrid/layout'); ?>

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
              <form action="<?= base_url() ?>dashboardGrid/grid" method="POST">
                <select class="form-select" name="jenis_dashboard" id="jenis_dashboard" style="border-width: thick;border: wh;font-size: 20px;font-weight: 900;width: 250px;">
                  <option value="1">Efficiency</option>
                  <!-- <option value="2">Unit / MH</option> -->
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

      <div class="row">
        <div class="box-body">
            <div class="col-12">
              <div class="box bg-transparent">
                <div class="box-body">
                  <figure class="highcharts-figure">
                    <div id="daily_efficiency_chart"></div>
                  </figure>
                </div>
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
                          <?php
                            $grup_a_previous = (($data_previous_month_group !== 0 && array_key_exists('GRUP A - NGADINO', $data_previous_month_group)) && array_key_exists('GRUP A - NGADINO', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP A - NGADINO']['persentase']), 2) : 0;
                            $grup_b_previous = (($data_previous_month_group !== 0 && array_key_exists('GRUP B - MASTIKIN', $data_previous_month_group)) && array_key_exists('GRUP B - MASTIKIN', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP B - MASTIKIN']['persentase']), 2) : 0;
                            $grup_c_previous = (($data_previous_month_group !== 0 && array_key_exists('GRUP C - AGUS SULISTIYO', $data_previous_month_group)) && array_key_exists('GRUP C - AGUS SULISTIYO', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP C - AGUS SULISTIYO']['persentase']), 2) : 0;

                            $grup_a_current = (($data_current_month_group !== 0 && array_key_exists('GRUP A - NGADINO', $data_current_month_group)) && array_key_exists('GRUP A - NGADINO', $data_current_month_group)) ? number_format(json_encode($data_current_month_group['GRUP A - NGADINO']['persentase']), 2) : 0;
                            $grup_b_current = (($data_current_month_group !== 0 && array_key_exists('GRUP B - MASTIKIN', $data_current_month_group)) && array_key_exists('GRUP B - MASTIKIN', $data_current_month_group)) ? number_format(json_encode($data_current_month_group['GRUP B - MASTIKIN']['persentase']), 2) : 0;
                            $grup_c_current = (($data_current_month_group !== 0 && array_key_exists('GRUP C - AGUS SULISTIYO', $data_current_month_group)) && array_key_exists('GRUP C - AGUS SULISTIYO', $data_current_month_group)) ? number_format(json_encode($data_current_month_group['GRUP C - AGUS SULISTIYO']['persentase']), 2) : 0;
                          ?>
                          <tr>
                            <td>GRUP A - NGADINO</td>
                            <td><?= $grup_a_previous ?></td>
                            <td><?= $grup_a_current ?></td>
                            <td>
                              <?php if($grup_a_current > $grup_a_previous) {
                                  echo '<i class="fa fa-arrow-up" style="color:green"></i>';
                              } else if($grup_a_current < $grup_a_previous) {
                                  echo '<i class="fa fa-arrow-down" style="color:red"></i>';
                              } else if($grup_a_current == $grup_a_previous) {
                                  echo '<i class="fa fa-minus" style="color:yellow"></i>';
                              } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>GRUP B - MASTIKIN</td>
                            <td><?= $grup_b_previous ?></td>
                            <td><?= $grup_b_current ?></td>
                            <td>
                              <?php if($grup_b_current > $grup_b_previous) {
                                  echo '<i class="fa fa-arrow-up" style="color:green"></i>';
                              } else if($grup_b_current < $grup_b_previous) {
                                  echo '<i class="fa fa-arrow-down" style="color:red"></i>';
                              } else if($grup_b_current == $grup_b_previous) {
                                  echo '<i class="fa fa-minus" style="color:yellow"></i>';
                              } ?>
                            </td>
                          </tr>
                          <tr>
                            <td>GRUP C - AGUS SULISTIYO</td>
                            <td><?= $grup_c_previous ?></td>
                            <td><?= $grup_c_current ?></td>
                            <td>
                              <?php if($grup_c_current > $grup_c_previous) {
                                  echo '<i class="fa fa-arrow-up" style="color:green"></i>';
                              } else if($grup_c_current < $grup_c_previous) {
                                  echo '<i class="fa fa-arrow-down" style="color:red"></i>';
                              } else if($grup_c_current == $grup_c_previous) {
                                  echo '<i class="fa fa-minus" style="color:yellow"></i>';
                              } ?>
                            </td>
                          </tr>
                      </tbody>
                      </table>
                  </div>
                </div>
              </div>

              <div style="display:none">
                <div class="box bg-transparent">
                  <div class="box-body">
                    <div class="text-center">
                      <h5>Efficiency Comparison Group Ngadino</h5>
                    </div>
                    <div class="row row-cols-2">
                      <div class="col">
                        <div id="previous_month_chart_group_a" style="height:250px;"></div>
                      </div>
                      <div class="col">
                        <div id="current_month_chart_group_a" style="height:250px;"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box bg-transparent">
                  <div class="box-body">
                    <div class="text-center">
                      <h5>Efficiency Comparison Group Mastikin</h5>
                    </div>
                    <div class="row row-cols-2">
                      <div class="col">
                        <div id="previous_month_chart_group_b" style="height:250px;"></div>
                      </div>
                      <div class="col">
                        <div id="current_month_chart_group_b" style="height:250px;"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box bg-transparent">
                  <div class="box-body">
                    <div class="text-center">
                      <h5>Efficiency Comparison Group Agus</h5>
                    </div>
                    <div class="row row-cols-2">
                      <div class="col">
                        <div id="previous_month_chart_group_c" style="height:250px;"></div>
                      </div>
                      <div class="col">
                        <div id="current_month_chart_group_c" style="height:250px;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="box bg-transparent">
          <div class="box-body">
            <figure class="highcharts-figure">
              <div id="productivity_per_mp_chart"></div>
            </figure>
          </div>
        </div>
      </div>

      <div class="col-12" style="display:none">
        <div class="box bg-transparent">
          <div class="box-body">
            <figure class="highcharts-figure">
              <div id="efficiency_per_mp_chart"></div>
            </figure>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->

<!-- MODAL -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="modal_ls">
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

<!-- MODAL PRODUCTIVITY MP-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" id="modal_mp">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="width:120%;">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Detail Productivity MP</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="data_productivity_mp"></div>
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

  // // PIE CHART PREVIOUS MONTH GROUP NGADINO
  var previous_month_chart_group_a = echarts.init(document.getElementById('previous_month_chart_group_a'));
  previous_month_chart_group_a.setOption({
    title: {
      text: '<?= (($data_previous_month_group !== 0 && array_key_exists('GRUP A - NGADINO', $data_previous_month_group)) && array_key_exists('GRUP A - NGADINO', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP A - NGADINO']['persentase']), 2) : 0 ?>%',
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
          value: <?= ($data_previous_month_group !== 0 && array_key_exists('GRUP A - NGADINO', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP A - NGADINO']['persentase']), 2) : 0 ?>,
          name: 'Monday',
          itemStyle: {
            color: 'red'
          }
        },
        {
          value: 100 - <?= ($data_previous_month_group !== 0 && array_key_exists('GRUP A - NGADINO', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP A - NGADINO']['persentase']), 2) : 0 ?>,
          name: 'invisible',
          itemStyle: {
            color: 'grey'
          }
        }
      ]
    }, ]
  });

  // // PIE CHART CURRENT MONTH GROUP NGADINO
  var current_month_chart_group_a = echarts.init(document.getElementById('current_month_chart_group_a'));
  current_month_chart_group_a.setOption({
    title: {
      text: '<?= (($data_current_month_group !== 0 && array_key_exists('GRUP A - NGADINO', $data_current_month_group))  && array_key_exists('GRUP A - NGADINO', $data_current_month_group)) ? number_format(json_encode($data_current_month_group['GRUP A - NGADINO']['persentase']), 2) : 0 ?>%',
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
          value: <?= ($data_current_month_group !== 0 && array_key_exists('GRUP A - NGADINO', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['GRUP A - NGADINO']['persentase']), 2) : 0 ?>,
          name: 'Monday',
          itemStyle: {
            color: 'cyan'
          }
        },
        {
          value: 100 - <?= ($data_current_month_group !== 0 && array_key_exists('GRUP A - NGADINO', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['GRUP A - NGADINO']['persentase']), 2) : 0 ?>,
          name: 'invisible',
          itemStyle: {
            color: 'grey'
          }
        }
      ]
    }, ]
  });

  // // PIE CHART PREVIOUS MONTH GROUP MASTIKIN
  var previous_month_chart_group_b = echarts.init(document.getElementById('previous_month_chart_group_b'));
  previous_month_chart_group_b.setOption({
    title: {
      text: '<?= ($data_previous_month_group !== 0 && array_key_exists('GRUP B - MASTIKIN', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP B - MASTIKIN']['persentase']), 2) : 0 ?>%',
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
          value: <?= ($data_previous_month_group !== 0 && array_key_exists('GRUP B - MASTIKIN', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP B - MASTIKIN']['persentase']), 2) : 0 ?>,
          name: 'Monday',
          itemStyle: {
            color: 'red'
          }
        },
        {
          value: 100 - <?= ($data_previous_month_group !== 0 && array_key_exists('GRUP B - MASTIKIN', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP B - MASTIKIN']['persentase']), 2) : 0 ?>,
          name: 'invisible',
          itemStyle: {
            color: 'grey'
          }
        }
      ]
    }, ]
  });

  // // PIE CHART CURRENT MONTH GROUP NGADINO
  var current_month_chart_group_b = echarts.init(document.getElementById('current_month_chart_group_b'));
  current_month_chart_group_b.setOption({
    title: {
      text: '<?= ($data_current_month_group !== 0 && array_key_exists('GRUP B - MASTIKIN', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['GRUP B - MASTIKIN']['persentase']), 2) : 0 ?>%',
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
          value: <?= ($data_current_month_group !== 0 && array_key_exists('GRUP B - MASTIKIN', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['GRUP B - MASTIKIN']['persentase']), 2) : 0 ?>,
          name: 'Monday',
          itemStyle: {
            color: 'cyan'
          }
        },
        {
          value: 100 - <?= ($data_current_month_group !== 0 && array_key_exists('GRUP B - MASTIKIN', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['GRUP B - MASTIKIN']['persentase']), 2) : 0 ?>,
          name: 'invisible',
          itemStyle: {
            color: 'grey'
          }
        }
      ]
    }, ]
  });

  // // PIE CHART PREVIOUS MONTH GROUP MASTIKIN
  var previous_month_chart_group_c = echarts.init(document.getElementById('previous_month_chart_group_c'));
  previous_month_chart_group_c.setOption({
    title: {
      text: '<?= ($data_previous_month_group !== 0 && array_key_exists('GRUP C - AGUS SULISTIYO', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP C - AGUS SULISTIYO']['persentase']), 2) : 0 ?>%',
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
          value: <?= ($data_previous_month_group !== 0 && array_key_exists('GRUP C - AGUS SULISTIYO', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP C - AGUS SULISTIYO']['persentase']), 2) : 0 ?>,
          name: 'Monday',
          itemStyle: {
            color: 'red'
          }
        },
        {
          value: 100 - <?= ($data_previous_month_group !== 0 && array_key_exists('GRUP C - AGUS SULISTIYO', $data_previous_month_group)) ? number_format(json_encode($data_previous_month_group['GRUP C - AGUS SULISTIYO']['persentase']), 2) : 0 ?>,
          name: 'invisible',
          itemStyle: {
            color: 'grey'
          }
        }
      ]
    }, ]
  });

  // // PIE CHART CURRENT MONTH GROUP NGADINO
  var current_month_chart_group_c = echarts.init(document.getElementById('current_month_chart_group_c'));
  current_month_chart_group_c.setOption({
    title: {
      text: '<?= ($data_current_month_group !== 0 && array_key_exists('GRUP C - AGUS SULISTIYO', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['GRUP C - AGUS SULISTIYO']['persentase']), 2) : 0 ?>%',
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
          value: <?= ($data_current_month_group !== 0 && array_key_exists('GRUP C - AGUS SULISTIYO', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['GRUP C - AGUS SULISTIYO']['persentase']), 2) : 0 ?>,
          name: 'Monday',
          itemStyle: {
            color: 'cyan'
          }
        },
        {
          value: 100 - <?= ($data_current_month_group !== 0 && array_key_exists('GRUP C - AGUS SULISTIYO', $data_current_month_group))  ? number_format(json_encode($data_current_month_group['GRUP C - AGUS SULISTIYO']['persentase']), 2) : 0 ?>,
          name: 'invisible',
          itemStyle: {
            color: 'grey'
          }
        }
      ]
    }, ]
  });

  Highcharts.chart('monthly_efficiency_chart', {
    chart: {
      backgroundColor: 'transparent',
      zoomType: 'xy'
    },
    exporting: {
      enabled: false
    },
    title: {
      text: '<?= date('M', strtotime($bulan)) ?> Efficiency',
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
      zoomType: 'xy',
      type: 'column'
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
      enabled: false
    },

    series: [{
      name: 'Efficiency',
      data: <?php echo json_encode($data_all_date); ?>,
      color: 'yellow',
      tooltip: {
        valueSuffix: ' %'
      },
      dataLabels: {
          enabled: true,
          formatter: function(){
                                return (this.y!=0)?this.y:"";
                            },
        },
      point: {
        events: {
          click: function() {
            var date = $('#bulan').val() + '-' + this.category;
            $.ajax({
              url: "<?= base_url('dashboardGrid/grid/get_data_line_stop'); ?>",
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
                    '<td>MC ' + data[i].no_machine + '</td>' +
                    '<td>' + data[i].uraian_breakdown + '</td>' +
                    '<td>' + data[i].total_menit + '</td>' +
                    '</tr>';
                }
                $('#data_breakdown').html(html);
                $('#modal_ls').modal('show');
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
      text: '<?= date('M', strtotime($bulan)) ?> Efficiency Per Group',
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
      min: 60,
      max: 110,
      distance: 10,
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
      enabled: true,
      align: 'center',
        verticalAlign: 'bottom',
        layout: 'horizontal',
        itemStyle: {
            color: '#ffffff'
        }
    },

    series: [{
      name: 'GRUP A - NGADINO',
      type: 'line',
      data: [<?php if ($data_all_date_group !== 0) {
                foreach ($data_all_date_group as $d_all_date_group) {
                  if ($d_all_date_group['grup'] === 'GRUP A - NGADINO') {
                    echo $d_all_date_group['data'] . ',';
                  }
                }
              } ?>],
      color: 'yellow',
      tooltip: {
        valueSuffix: ' %'
      }
    }, {
      name: 'GRUP B - MASTIKIN',
      type: 'line',
      data: [<?php if ($data_all_date_group !== 0) {
                foreach ($data_all_date_group as $d_all_date_group) {
                  if ($d_all_date_group['grup'] === 'GRUP B - MASTIKIN') {
                    echo $d_all_date_group['data'] . ',';
                  }
                }
              } ?>],
      color: '#20c997',
      tooltip: {
        valueSuffix: ' %'
      }
    }, {
      name: 'GRUP C - AGUS SULISTIYO',
      type: 'line',
      data: [<?php if ($data_all_date_group !== 0) {
                foreach ($data_all_date_group as $d_all_date_group) {
                  if ($d_all_date_group['grup'] === 'GRUP C - AGUS SULISTIYO') {
                    echo $d_all_date_group['data'] . ',';
                  }
                }
              } ?>],
      color: '#0dcaf0',
      tooltip: {
        valueSuffix: ' %'
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

  Highcharts.chart('efficiency_per_mp_chart', {
    chart: {
      backgroundColor: 'transparent',
      zoomType: 'xy'
    },
    exporting: {
      enabled: false
    },
    title: {
      text: 'Efficiency Per MP',
      style: {
        color: '#ffffff',
        fontSize: '20px'
      }
    },
    xAxis: [{
      categories: [<?php $isExist = [];
                    foreach ($data_all_mp_by_current_month as $operator_name => $value) {
                      $isExist[$operator_name] = $operator_name;
                      echo '\'' . $operator_name . '\',';
                    }
                    foreach ($data_all_mp_by_previous_month as $operator_name => $value) {
                      if (!array_key_exists($operator_name, $isExist))
                        echo '\'' . $operator_name . '\',';
                    } ?>],
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

    series: [{
      name: '<?= date('F', strtotime($bulan . '- 1 month')) ?>',
      type: 'column',
      data: [<?php foreach ($data_all_mp_by_previous_month as $d_all_mp_by_previous_month) {
                echo $d_all_mp_by_previous_month['persentase'] . ',';
              } ?>],
      color: 'yellow',
      tooltip: {
        valueSuffix: ' %'
      },
      dataLabels: {
        enabled: true,
      }
    }, {
      name: '<?= date('F', strtotime($bulan)) ?>',
      type: 'column',
      data: [<?php foreach ($data_all_mp_by_current_month as $d_all_mp_by_current_month) {
                echo $d_all_mp_by_current_month['persentase'] . ',';
              } ?>],
      color: '#20c997',
      tooltip: {
        valueSuffix: ' %'
      },
      dataLabels: {
        enabled: true,
      }
    }, {
      name: 'Target',
      type: 'line',
      data: [<?php for ($i = 0; $i < count($data_all_mp_by_current_month); $i++) {
                echo '85,';
              } ?>],
      color: 'red',
      tooltip: {
        valueSuffix: ' %'
      }
    }]
  });

  Highcharts.chart('productivity_per_mp_chart', {
    chart: {
      backgroundColor: 'transparent',
      zoomType: 'xy'
    },
    exporting: {
      enabled: false
    },
    title: {
      text: '<?= date('M', strtotime($bulan)) ?> Efficiency Per MP',
      style: {
        color: '#ffffff',
        fontSize: '20px'
      }
    },
    xAxis: [{
      categories: [<?php $isExist = [];
                    foreach ($productivity_per_mp as $operator_name => $value) {
                      $isExist[$operator_name] = $operator_name;
                      echo '\'' . $operator_name . '\',';
                    } ?>],
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

    series: [{
      name: '<?= date('F', strtotime($bulan)) ?>',
      type: 'column',
      data: [<?php foreach ($productivity_per_mp as $p_per_mp) {
                echo $p_per_mp['persentase'] . ',';
              } ?>],
      color: '#20c997',
      tooltip: {
        valueSuffix: ' %'
      },
      dataLabels: {
        enabled: true,
      },
      point: {
        events: {
          click: function() {
            get_productivity_all_month_mp(this.category);
          }
        }
      }
    },{
      name: 'Target',
      type: 'line',
      data: [<?php for ($i = 0; $i < count($productivity_per_mp); $i++) {
                echo '85,';
              } ?>],
      color: 'red',
      tooltip: {
        valueSuffix: ' %'
      }
    }]
  });

  function get_productivity_all_month_mp(operator_name) {
    $.ajax({
      url: "<?= base_url('dashboardGrid/grid/get_data_productivity_mp'); ?>",
      type: "POST",
      data: {
        operator_name: operator_name,
      },
      dataType: "json",
      success: function(data) {
        console.log(data);
        $('#modal_mp').modal('show');
        $('#data_productivity_mp').html(`<figure class="highcharts-figure">
                                                        <div id="chart_detail_productivity_mp"></div>
                                                    </figure>`);
        Highcharts.chart('chart_detail_productivity_mp', {
          chart: {
              backgroundColor: 'transparent',
              type: 'column'
          },
          exporting: {
              enabled: false
          },
          title: {
              text: 'Detail Productivity '+operator_name,
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
                  }
              }
          },
          legend: {
              enabled: false
          },
          series: [{
              // name: 'Total',
              data: data,
              color:'yellow',

          }]
        });

      }
    });
  }
</script>
<?= $this->endSection(); ?>