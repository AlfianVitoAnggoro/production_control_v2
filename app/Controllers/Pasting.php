<?php

namespace App\Controllers;

use App\Models\M_Pasting;

class Pasting extends BaseController
{
  public function __construct()
  {
    $this->M_Pasting = new M_Pasting();
    $this->session = \Config\Services::session();

    if ($this->session->get('is_login')) {
      return redirect()->to('login');
    }
  }

  public function pasting_view()
  {
    $model = new M_Pasting();
    $data['data_pasting'] = $model->get_all_lhp_pasting();
    $data['data_mesin_pasting'] = $model->get_mesin_pasting();
    $data['data_grup'] = $model->get_grup();
    $data['data_grup_pasting'] = $model->get_grup_pasting();
    return view('pages/pasting/pasting_view', $data);
  }

  public function pasting_add_view()
  {
    return view('pages/pasting/add_pasting');
  }

  public function add_pasting()
  {
    $tanggal_produksi = $this->request->getPost('tanggal_produksi');
    $mesin_pasting = $this->request->getPost('mesin_pasting');
    $shift = $this->request->getPost('shift');
    $grup = $this->request->getPost('grup');
    $mp = $this->request->getPost('mp');
    $absen = $this->request->getPost('absen');
    $cuti = $this->request->getPost('cuti');
    $kasubsie = $this->request->getPost('kasubsie');

    $model = new M_Pasting();
    $data_mesin_pasting = $model->get_data_mesin_pasting($mesin_pasting);
    // $data_grup = $model->get_data_grup_pic($grup);

    $data = [
      'tanggal_produksi' => $tanggal_produksi,
      'id_mesin_pasting' => $mesin_pasting,
      'mesin_pasting' => $data_mesin_pasting[0]['nama_mesin_pasting'],
      'shift' => $shift,
      'id_pic' => $grup,
      // 'grup' => $data_grup[0]['nama_pic'],
      'mp' => $mp,
      'absen' => $absen,
      'cuti' => $cuti,
      'kasubsie' => $kasubsie
    ];

    $data_pasting = [
      'tanggal_produksi' => $tanggal_produksi,
      'mesin_pasting' => $mesin_pasting,
      'shift' => $shift,
      'grup' => $grup,
      'mp' => $mp,
      'absen' => $absen,
      'cuti' => $cuti,
      'kasubsie' => $kasubsie
    ];

    // $data['data_wo'] = $model->getDataWO($tanggal_produksi, $mesin_pasting);
    // $data['data_wo'] = [];
    // $data['data_breakdown'] = $model->getListBreakdown();
    // var_dump($data['data_breakdown']); die;

    $cek = $model->cek_lhp($tanggal_produksi, $mesin_pasting, $shift, $grup);
    if (count($cek) > 0) {
      $id_lhp_pasting = $cek[0]['id_lhp_pasting'];
      return redirect()->to(base_url('pasting/detail_pasting/' . $id_lhp_pasting));
    } else {

      $save_data = $model->save_pasting($data_pasting);
      // var_dump($data); die;

      return redirect()->to(base_url('pasting/detail_pasting/' . $save_data));
    }
  }

  public function delete_pasting($id)
  {
    $id = $this->request->getPost('id');

    $model = new M_Pasting();

    $delete = $model->delete_lhp($id);

    if ($delete > 0) {
      $this->pasting_view();
    }
  }

  public function getPartNo()
  {
    $no_wo = $this->request->getPost('no_wo');

    $model = new M_Pasting();
    echo json_encode($model->getPartNo($no_wo));
  }

  // public function getCT()
  // {
  //   $part_no = $this->request->getPost('part_number');
  //   // Split the string into an array using "-"
  //   $arr = explode("-", $part_no);

  //   // Remove the first two elements from the array
  //   $arr = array_slice($arr, 2);

  //   // Join the remaining elements back into a string using "-"
  //   $part_no = implode("-", $arr);

  //   $model = new M_Pasting();
  //   echo json_encode($model->getCT($part_no));
  // }

  public function get_jenis_line_stop()
  {
    $mesin_pasting = $this->request->getPost('mesin_pasting');
    $kategori_line_stop = $this->request->getPost('kategori_line_stop');
    $model = new M_Pasting();
    if($mesin_pasting <= 3) {
      echo json_encode($model->getListJenisLineStopCasting($kategori_line_stop));
    } else {
      echo json_encode($model->getListJenisLineStopPunching($kategori_line_stop));
    }

  }

  public function get_kategori_reject()
  {
    $jenis_reject_pasting = $this->request->getPost('jenis_reject_pasting');

    $model = new M_Pasting();
    echo json_encode($model->getKategoriReject($jenis_reject_pasting));
  }

  // public function save_pasting()
  // {
  //     // var_dump($this->request->getPost('jenis_line_stop')); die;
  //     $data_pasting = [
  //         'tanggal_produksi' => $this->request->getPost('tanggal_produksi'),
  //         'mesin_pasting' => $this->request->getPost('id_mesin_pasting'),
  //         'shift' => $this->request->getPost('shift'),
  //         'grup' => $this->request->getPost('id_pic'),
  //         'mp' => $this->request->getPost('mp'),
  //         'absen' => $this->request->getPost('absen'),
  //         'cuti' => $this->request->getPost('cuti')
  //     ];

  //     // var_dump($data_pasting); die;

  //     $model = new M_Pasting();

  //     $save_data = $model->save_pasting($data_pasting);

  //     if ($save_data != '') {
  //         $total_data = count($this->request->getPost('part_number'));
  //         for ($i = 0; $i < $total_data; $i++) {
  //             if ($this->request->getPost('part_number')[$i] != '') {
  //                 $data_detail_pasting = [
  //                     'id_lhp_pasting' => $save_data,
  //                     'batch' => $this->request->getPost('batch')[$i],
  //                     'jam_start' => $this->request->getPost('start')[$i],
  //                     'jam_end' => $this->request->getPost('stop')[$i],
  //                     'menit_terpakai' => $this->request->getPost('menit_terpakai')[$i],
  //                     'no_wo' => $this->request->getPost('no_wo')[$i],
  //                     'type_battery' => $this->request->getPost('part_number')[$i],
  //                     'ct' => $this->request->getPost('ct')[$i],
  //                     'plan_cap' => $this->request->getPost('plan_cap')[$i],
  //                     'actual' => $this->request->getPost('actual')[$i],
  //                     'act_vs_plan' => $this->request->getPost('act_vs_plan')[$i],
  //                     'efficiency_time' => $this->request->getPost('efficiency_time')[$i],
  //                     'total_menit_breakdown' => $this->request->getPost('total_menit_breakdown')[$i]
  //                 ];
  //                 $save_detail = $model->save_detail_pasting($data_detail_pasting);

  //                 if ($save_detail != '') {
  //                     $index_jenis_line_stop = $this->request->getPost('index_jenis_line_stop')[$i];

  //                     if ($this->request->getPost('jenis_line_stop') != null) {
  //                     $total_breakdown = count($this->request->getPost('jenis_line_stop')[$index_jenis_line_stop]);
  //                         for ($j = 0; $j < $total_breakdown; $j++) {
  //                             if ($this->request->getPost('jenis_line_stop')[$index_jenis_line_stop][$j] != '') {

  //                                 if ($this->request->getPost('jenis_line_stop')[$index_jenis_line_stop][$j] == 'ANDON') {
  //                                     $string_ticket = $this->request->getPost('kategori_line_stop')[$index_jenis_line_stop][$j];
  //                                     $arr = explode("-", $string_ticket);
  //                                     $ticket = $arr[0];
  //                                     $kategori_line_stop = $string_ticket;
  //                                 } else {
  //                                     $ticket = '';
  //                                     $kategori_line_stop = $this->request->getPost('kategori_line_stop')[$index_jenis_line_stop][$j];
  //                                 }

  //                                 $data_breakdown = [
  //                                     'id_detail_lhp_pasting' => $save_detail,
  //                                     'no_wo' => $this->request->getPost('no_wo')[$i],
  //                                     'jenis_line_stop' => $this->request->getPost('jenis_line_stop')[$index_jenis_line_stop][$j],
  //                                     'tiket_andon' => $ticket,
  //                                     'kategori_line_stop' => $kategori_line_stop,
  //                                     'uraian_breakdown' => $this->request->getPost('uraian_breakdown')[$index_jenis_line_stop][$j],
  //                                     'menit_breakdown' => $this->request->getPost('menit_breakdown')[$index_jenis_line_stop][$j]
  //                                 ];
  //                                 $model->save_detail_breakdown($data_breakdown);
  //                             }
  //                         }
  //                     }

  //                     if (!empty($this->request->getPost('jenis_reject_pasting')[$index_jenis_line_stop])) {

  //                         $total_rejection = count($this->request->getPost('jenis_reject_pasting')[$index_jenis_line_stop]);

  //                         for ($j = 0; $j < $total_rejection; $j++) {
  //                             // print_r($this->request->getPost('jenis_line_stop')[$index_jenis_line_stop][$j]);
  //                             if ($this->request->getPost('jenis_reject_pasting')[$index_jenis_line_stop][$j] != '') {

  //                                 $id_reject_pasting = $this->request->getPost('id_reject_pasting')[$index_jenis_line_stop][$j];

  //                                 $data_reject = [
  //                                     'id_detail_lhp_pasting' => $save_detail,
  //                                     'no_wo' => $this->request->getPost('no_wo')[$i],
  //                                     'qty_reject' => $this->request->getPost('reject_qty')[$index_jenis_line_stop][$j],
  //                                     'jenis_reject_pasting' => $this->request->getPost('jenis_reject_pasting')[$index_jenis_line_stop][$j],
  //                                     'remark_reject' => $this->request->getPost('remark_reject')[$index_jenis_line_stop][$j]
  //                                 ];
  //                                 // var_dump ($data_reject);
  //                                 $model->save_detail_reject($data_reject);                                    
  //                             }
  //                         }
  //                     }
  //                 }
  //             }
  //         };
  //     }

  //     return redirect()->to(base_url('pasting/detail_pasting/'.$save_data));
  // }

  public function detail_pasting($id)
  {
    $model = new M_Pasting();
    $data['id_lhp_pasting'] = $id;
    $data['data_lhp_pasting'] = $model->get_pasting_by_id($id);
    $data['data_detail_lhp'] = $model->get_detail_pasting_by_id($id);
    $data['data_detail_breakdown'] = $model->get_detail_breakdown_by_id($id);
    $data['data_detail_reject'] = $model->get_detail_reject_by_id($id);
    $data['data_type_grid'] = $model->get_data_type_grid();
    $data['data_grup_pasting'] = $model->get_grup_pasting();

    $data['data_mesin_pasting'] = $model->get_data_mesin_pasting($data['data_lhp_pasting'][0]['mesin_pasting']);
    // $data['data_grup'] = $model->get_data_grup_pic($data['data_lhp_pasting'][0]['grup']);

    $data['data_all_machine'] = $model->get_mesin_pasting();
    $data['data_all_grup'] = $model->get_grup();

    // $data['data_wo'] = $model->getDataWO($data['data_lhp_pasting'][0]['tanggal_produksi'], $data['data_lhp_pasting'][0]['mesin_pasting']);
    // $data['data_wo'] = [];

    // $data['data_breakdown'] = $model->getListBreakdown();
    $data['data_line_stop_casting'] = $model->getListKategoriLineStopCasting();
    $data['data_line_stop_punching'] = $model->getListKategoriLineStopPunching();
    $data['data_reject_pasting'] = $model->getListReject();

    return view('pages/pasting/pasting_detail_view', $data);
  }

  public function update_pasting()
  {
    // var_dump($this->request->getPost('id_breakdown'));
    // var_dump($this->request->getPost('id_detail_lhp_pasting'));

    // die;
    $id_lhp_pasting = $this->request->getPost('id_lhp_pasting');

    $data_pasting = [
      'tanggal_produksi' => $this->request->getPost('tanggal_produksi'),
      'mesin_pasting' => $this->request->getPost('mesin_pasting'),
      'shift' => $this->request->getPost('shift'),
      'kasubsie' => $this->request->getPost('kasubsie'),
      'grup' => $this->request->getPost('grup'),
      'mp' => $this->request->getPost('mp'),
      'absen' => $this->request->getPost('absen'),
      'cuti' => $this->request->getPost('cuti')
    ];

    // var_dump($data_pasting);

    $model = new M_Pasting();

    $update_data = $model->update_pasting($id_lhp_pasting, $data_pasting);
    // var_dump($update_data);

    $total_jks = 0;
    $total_actual = 0;
    $total_line_stop = 0;
    $total_detail_line_stop = 0;
    $total_reject = 0;
    $total_act_vs_jks = 0;

    if ($update_data > 0) {
      $total_data = count($this->request->getPost('id_detail_lhp_pasting'));
      for ($i = 0; $i < $total_data; $i++) {
        // if ($this->request->getPost('id_detail_lhp_pasting')[$i] != '') {
          $id_detail_lhp_pasting = $this->request->getPost('id_detail_lhp_pasting')[$i];
          $data_detail_pasting = [
            'id_lhp_pasting' => $id_lhp_pasting,
            // 'batch' => $this->request->getPost('batch')[$i],
            'jam_start' => $this->request->getPost('start')[$i],
            'jam_end' => $this->request->getPost('stop')[$i],
            'menit_terpakai' => $this->request->getPost('menit_terpakai')[$i],
            'type_grid' => $this->request->getPost('type_grid')[$i],
            'ct' => $this->request->getPost('ct')[$i],
            'jks' => $this->request->getPost('jks')[$i],
            'actual' => $this->request->getPost('actual')[$i],
            'act_vs_jks' => $this->request->getPost('presentase')[$i],
            // 'efficiency_time' => $this->request->getPost('efficiency_time')[$i],
            // 'total_menit_breakdown' => $this->request->getPost('total_menit_breakdown')[$i]
          ];

          if ($this->request->getPost('actual')[$i] != null) {
            $total_jks += $this->request->getPost('jks')[$i];
            $total_actual += $this->request->getPost('actual')[$i];
          }

          // if ($this->request->getPost('total_menit_breakdown')[$i] != null) {
          //   $total_line_stop += $this->request->getPost('total_menit_breakdown')[$i];
          // }

          $update_detail = $model->update_detail_pasting($id_detail_lhp_pasting, $data_detail_pasting);
        // }
      }
      
      if ($total_actual > 0) {
        $total_act_vs_jks += $total_actual / $total_jks * 100;
      }
    }
    // var_dump($this->request->getPost('type_grid')); die;
    $total_type_grid_line_stop = $this->request->getPost('type_grid_line_stop');
    $breakdownExist = [];
    $data_detail_line_stop = $model->get_detail_breakdown_by_id($id_lhp_pasting);
    if (!empty($total_type_grid_line_stop)) {
      for ($i = 0; $i < count($total_type_grid_line_stop); $i++) {
        if($this->request->getPost('jenis_line_stop') !== NULL && array_key_exists($i, $this->request->getPost('jenis_line_stop'))) {
          if ($this->request->getPost('jenis_line_stop')[$i] == 'ANDON') {
            $string_ticket = $this->request->getPost('kategori_line_stop')[$i];
            $arr = explode("-", $string_ticket);
            $ticket = $arr[0];
            $kategori_line_stop = $string_ticket;
          } else {
            $ticket = '';
            $kategori_line_stop = $this->request->getPost('kategori_line_stop')[$i];
          }
  
          $id_breakdown = $this->request->getPost('id_breakdown')[$i];
          if($id_breakdown !== "") {
            $breakdownExist[$id_breakdown] = $id_breakdown;
          }
          $data_detail_breakdown = [
            'id_lhp_pasting' => $id_lhp_pasting,
            'id_detail_lhp_pasting' => $id_detail_lhp_pasting,
            'jam_start' => $this->request->getPost('start_breakdown')[$i],
            'jam_end' => $this->request->getPost('stop_breakdown')[$i],
            // 'no_wo' => $this->request->getPost('type_grid')[$i],
            // 'type_battery' => $this->request->getPost('part_number_breakdown')[$i],
            'type_grid' => $this->request->getPost('type_grid_line_stop')[$i],
            'kategori_line_stop' => $this->request->getPost('kategori_line_stop')[$i],
            'jenis_line_stop' => $this->request->getPost('jenis_line_stop')[$i],
            'uraian_line_stop' => $this->request->getPost('uraian_line_stop')[$i],
            'tiket_andon' => $ticket,
            'menit_breakdown' => $this->request->getPost('menit_breakdown')[$i]
          ];
  
          $total_detail_line_stop += intval($this->request->getPost('menit_breakdown')[$i]);
  
          $model->save_detail_breakdown($id_breakdown, $data_detail_breakdown);
        }
      }
      foreach ($data_detail_line_stop as $ddls) {
        if(!array_key_exists($ddls['id_breakdown'], $breakdownExist)) {
          $this->M_Pasting->delete_detail_line_stop_by_id_breakdown($ddls['id_breakdown']);
        }
      }
    } else {
      $this->M_Pasting->delete_detail_line_stop_by_id_lhp($id_lhp_pasting);
    }

    $total_data_reject = $this->request->getPost('type_grid_reject');
    $rejectPastingExist = [];
    $data_detail_reject_pasting = $model->get_detail_reject_pasting_by_id($id_lhp_pasting);
    if (!empty($total_data_reject)) {
      for ($i = 0; $i < count($total_data_reject); $i++) {
        if($this->request->getPost('kategori_reject_pasting') !== NULL && array_key_exists($i, $this->request->getPost('kategori_reject_pasting'))) {
          $id_reject_pasting = $this->request->getPost('id_reject_pasting')[$i];
          $rejectPastingExist[$id_reject_pasting] = $id_reject_pasting;
          $data_detail_reject = [
            'id_lhp_pasting' => $id_lhp_pasting,
            'id_detail_lhp_pasting' => $id_detail_lhp_pasting,
            'type_grid' => $this->request->getPost('type_grid_reject')[$i],
            'qty_reject' => $this->request->getPost('qty_reject')[$i],
            'jenis_reject_pasting' => $this->request->getPost('jenis_reject_pasting')[$i],
            'kategori_reject_pasting' => $this->request->getPost('kategori_reject_pasting')[$i],
            'remark_reject' => $this->request->getPost('remark_reject')[$i]
          ];
  
          $total_reject += $this->request->getPost('qty_reject')[$i];
  
          $model->save_detail_reject($id_reject_pasting, $data_detail_reject);
        }
      }
      foreach ($data_detail_reject_pasting as $ddrp) {
        if(!array_key_exists($ddrp['id_reject_pasting'], $rejectPastingExist)) {
          $this->M_Pasting->delete_detail_reject_pasting_by_id_reject_pasting($ddrp['id_reject_pasting']);
        }
      }
    } else {
      $this->M_Pasting->delete_detail_reject_pasting_by_id_lhp($id_lhp_pasting);
    }

    $data_detail = [
      'total_jks' => $total_jks,
      'total_aktual' => $total_actual,
      'total_line_stop' => $total_line_stop,
      'total_reject' => $total_reject,
      'total_act_vs_jks' => $total_act_vs_jks
    ];

    $model->update_pasting($id_lhp_pasting, $data_detail);

    return redirect()->to(base_url('pasting/detail_pasting/' . $id_lhp_pasting));
  }

  public function get_data_andon()
  {
    $tanggal_produksi = $this->request->getPost('tanggal_produksi');
    $mesin_pasting = $this->request->getPost('mesin_pasting');

    $model = new M_Pasting();
    $data = $model->get_data_andon($tanggal_produksi, $mesin_pasting);
    echo json_encode($data);
  }

  public function pilih_andon()
  {
    $id_ticket = $this->request->getPost('id_ticket');

    $model = new M_Pasting();
    $data = $model->pilih_andon($id_ticket);
    echo json_encode($data);
  }

  public function hapus_pasting($id_lhp_pasting)
  {
    $model = new M_Pasting();
    $model->hapus_pasting($id_lhp_pasting);

    return redirect()->to(base_url('pasting'));
  }
}
