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
    if ($mesin_pasting <= 3) {
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
    $data['data_andon'] = $model->get_data_andon_by_id($id);

    $data['data_mesin_pasting'] = $model->get_data_mesin_pasting($data['data_lhp_pasting'][0]['mesin_pasting']);
    // $data['data_grup'] = $model->get_data_grup_pic($data['data_lhp_pasting'][0]['grup']);

    $data['data_all_machine'] = $model->get_mesin_pasting();
    $data['data_all_grup'] = $model->get_grup();
    // $data['data_all_rak_in'] = $model->get_data_rak_in_by_id($id);
    $data['data_record_rak_in'] = $model->get_data_detail_record_rak_by_id_rak_in($id, 'K-CAS');
    // $data['data_all_rak_out'] = $model->get_data_rak_out_by_id($id);
    $data['data_record_rak_out'] = $model->get_data_detail_record_rak_by_id_rak_out($id, 'K-PAS');

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
    $total_andon = 0;
    $array_batch = [];
    if ($update_data > 0) {
      $total_data = count($this->request->getPost('batch'));
      for ($i = 0; $i < $total_data; $i++) {
        // if ($this->request->getPost('id_detail_lhp_pasting')[$i] != '') {
        if(array_key_exists($i, $this->request->getPost('id_detail_lhp_pasting'))) {
          $array_batch[$this->request->getPost('batch')[$i]][] = $this->request->getPost('batch')[$i];
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
        } else {
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

          $add_detail = $model->add_detail_pasting($data_detail_pasting);
        }
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
        if ($this->request->getPost('jenis_line_stop') !== NULL && array_key_exists($i, $this->request->getPost('jenis_line_stop'))) {
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
          if ($id_breakdown !== "") {
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
        if (!array_key_exists($ddls['id_breakdown'], $breakdownExist)) {
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
        if ($this->request->getPost('kategori_reject_pasting') !== NULL && array_key_exists($i, $this->request->getPost('kategori_reject_pasting'))) {
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
        if (!array_key_exists($ddrp['id_reject_pasting'], $rejectPastingExist)) {
          $this->M_Pasting->delete_detail_reject_pasting_by_id_reject_pasting($ddrp['id_reject_pasting']);
        }
      }
    } else {
      $this->M_Pasting->delete_detail_reject_pasting_by_id_lhp($id_lhp_pasting);
    }

    $total_data_andon = $this->request->getPost('no_machine_andon');
    if (!empty($total_data_andon)) {
      $this->M_Pasting->delete_detail_andon($id_lhp);
      for ($i = 0; $i < count($total_data_andon); $i++) {

        $data_andon = [
          'id_lhp_grid' => $id_lhp,
          'no_machine' => $this->request->getPost('no_machine_andon')[$i],
          'tiket_andon' => $this->request->getPost('tiket_andon')[$i],
          'permasalahan' => $this->request->getPost('permasalahan_andon')[$i],
          'tujuan' => $this->request->getPost('tujuan_andon')[$i],
          'total_menit' => $this->request->getPost('total_menit_andon')[$i],
        ];

        $save_data_andon = $this->M_Pasting->save_detail_andon($data_andon);

        $total_andon += $this->request->getPost('total_menit_andon')[$i];
      }
    }

    $data_detail = [
      'total_jks' => $total_jks,
      'total_aktual' => $total_actual,
      'total_line_stop' => $total_line_stop,
      'total_reject' => $total_reject,
      'total_act_vs_jks' => $total_act_vs_jks,
      'total_menit_andon' => $total_andon
    ];

    $model->update_pasting($id_lhp_pasting, $data_detail);

    // $barcode_in = $this->request->getPost('barcode_rak');
    // $qty_in = $this->request->getPost('qty_rak');
    // $id_rak_in = $this->request->getPost('id_rak');
    // $id_rak_barcode_in = $this->request->getPost('id_rak_barcode');

    // if(!empty($barcode_in)) {
    //   for ($i=0; $i < count($barcode_in); $i++) { 
    //     $data_rak_in = [
    //       'id_lhp_pasting' => $id_lhp_pasting,
    //       'barcode' => $barcode_in[$i],
    //       'qty' => $qty_in[$i],
    //       'id_rak' => $id_rak_in[$i]
    //     ];

    //     $this->M_Pasting->add_rak($id_rak_barcode_in[$i], $data_rak_in);
    //   }
    // }

    // $barcode_out = $this->request->getPost('barcode_rak_out');
    // $qty_out = $this->request->getPost('qty_rak_out');
    // $id_rak_out = $this->request->getPost('id_rak_out');
    // $id_rak_barcode_out = $this->request->getPost('id_rak_barcode_out');

    // if(!empty($barcode_out)) {
    //   for ($i=0; $i < count($barcode_out); $i++) { 
    //     $data_rak_out = [
    //       'id_lhp_pasting' => $id_lhp_pasting,
    //       'barcode' => $barcode_out[$i],
    //       'qty' => $qty_out[$i],
    //       'id_rak' => $id_rak_out[$i]
    //     ];

    //     $this->M_Pasting->add_rak_out($id_rak_barcode_out[$i], $data_rak_out);
    //   }
    // }

    return redirect()->to(base_url('pasting/detail_pasting/' . $id_lhp_pasting));
  }

  // public function get_data_andon()
  // {
  //   $tanggal_produksi = $this->request->getPost('tanggal_produksi');
  //   $mesin_pasting = $this->request->getPost('mesin_pasting');

  //   $model = new M_Pasting();
  //   $data = $model->get_data_andon($tanggal_produksi, $mesin_pasting);
  //   echo json_encode($data);
  // }

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

  public function get_qty_rak()
  {
    $barcode = $this->request->getPost('barcode');
    $query = $this->M_Pasting->get_qty_rak($barcode);
    echo json_encode($query);
  }

  public function add_rak_in()
  {
    // $id_rak_barcode_in = "";
    $id_lhp_pasting = $this->request->getPost('id_lhp_pasting');
    // $barcode = $this->request->getPost('barcode');
    // $qty = $this->request->getPost('qty');
    $id_rak = $this->request->getPost('rak');
    date_default_timezone_set("Asia/Jakarta");
    $date = date('Y-m-d  H:i:s');
    $cek_detail_record_rak = $this->M_Pasting->cek_detail_record_rak($id_rak);
    if (count($cek_detail_record_rak) > 0) {
      // $data = [
      //   'id_lhp_pasting' => $id_lhp_pasting,
      //   'barcode' => $barcode,
      //   'qty' => $qty,
      //   'id_rak' => $id_rak,
      // ];
      $data_detail_record_rak = [
        'id_lhp_wh_end' => $id_lhp_pasting,
        'close_time' => $date,
        'status' => 'close'
      ];
      $data_master_rak = [
        'current_position' => 'K-PAS',
        'status' => 0,
        'updated_at' => $date
      ];
      if ($id_rak !== "") {
        // $id_rak_barcode_in = $this->M_Pasting->add_rak($id_rak_barcode_in, $data);
        $id_log_detail_record_rak_in = $this->M_Pasting->update_detail_record_rak($id_rak, $data_detail_record_rak);
        $update_data_master_rak = $this->M_Pasting->update_data_master_rak($id_rak, $data_master_rak);
        // $cek_data_master_rak = $this->M_Pasting->cek_data_master_rak($id_rak, 'open');
      }
      $data_id = [
        // 'id_rak_barcode_in' => $id_rak_barcode_in,
        'data_record_rak' => $cek_detail_record_rak,
        'id_log_detail_record_rak_in' => $id_log_detail_record_rak_in,
        'update_data_master_rak' => $update_data_master_rak,
        // 'cek_data_master_rak' => $cek_data_master_rak
      ];
      echo json_encode($data_id);
    } else {
      echo json_encode("Gagal");
    }
  }

  public function add_rak_out()
  {
    // $id_rak_barcode_out = "";
    $id_lhp_pasting = $this->request->getPost('id_lhp_pasting');
    $barcode = $this->request->getPost('barcode');
    $qty = $this->request->getPost('qty');
    $id_rak = $this->request->getPost('rak');
    $item = $this->request->getPost('item');
    $descrp = $this->request->getPost('descrp');
    $satuan = $this->request->getPost('satuan');
    $mesin = $this->request->getPost('mesin');
    $entry_date = $this->request->getPost('entry_date');
    $no_wo = $this->request->getPost('no_wo');
    $wh_from = 'K-PAS';
    $wh_to = 'K-FOR / ASSY';
    date_default_timezone_set("Asia/Jakarta");
    $date = date('Y-m-d  H:i:s');
    $cek_detail_record_rak = $this->M_Pasting->cek_detail_record_rak($id_rak, $barcode);
    if ($cek_detail_record_rak !== null) {
      // $data = [
      //   'id_lhp_pasting' => $id_lhp_pasting,
      //   'barcode' => $barcode,
      //   'qty' => $qty,
      //   'id_rak' => $id_rak,
      // ];
      $data_detail_record_rak = [
        'id_lhp_wh_start' => $id_lhp_pasting,
        'pn_qr' => $id_rak,
        'barcode' => $barcode,
        'qty' => $qty,
        'wh_from' => $wh_from,
        'wh_to' => $wh_to,
        'supply_time' => $date,
        'status' => 'open'
      ];
      $data_master_rak = [
        'current_position' => $wh_to,
        'status' => 1,
        'updated_at' => $date
      ];
      $data_detail_barcode_rak = [
        'barcode' => $barcode,
        'item' => $item,
        'descrp' => $descrp,
        'satuan' => $satuan,
        'qty' => $qty,
        'mesin' => $mesin,
        'entry_date' => $entry_date,
        'no_wo' => $no_wo,
      ];
      $id_log_detail_record_rak_out = "";
      $update_data_master_rak = "";
      $id_detail_barcode_rak = "";
      if (/*$barcode !== "" && */$id_rak !== "") {
        // $id_rak_barcode_out = $this->M_Pasting->add_rak_out($id_rak_barcode_out, $data);
        $id_log_detail_record_rak_out = $this->M_Pasting->add_detail_record_rak($data_detail_record_rak);
        $update_data_master_rak = $this->M_Pasting->update_data_master_rak($id_rak, $data_master_rak);
        $id_detail_barcode_rak = $this->M_Pasting->add_detail_barcode_rak($data_detail_barcode_rak);
      }
      $data_id = [
        // 'id_rak_barcode_out' => $id_rak_barcode_out,
        'id_log_detail_record_rak_out' => $id_log_detail_record_rak_out,
        'update_data_master_rak' => $update_data_master_rak,
        'id_detail_barcode_rak' => $id_detail_barcode_rak,
      ];
      echo json_encode($data_id);
    } else {
      echo json_encode("Gagal");
    }
  }

  public function delete_rak()
  {
    // $id_rak_barcode = $this->request->getPost('id_rak_barcode');
    // $id_log_detail_record_rak = $this->request->getPost('id_log_detail_record_rak');
    $pn_qr = $this->request->getPost('pn_qr');
    date_default_timezone_set("Asia/Jakarta");
    $date = date('Y-m-d  H:i:s');
    $data_detail_record_rak = [
      'id_lhp_wh_end' => NULL,
      'close_time' => NULL,
      'status' => 'open'
    ];
    $data_master_rak = [
      'current_position' => 'K-CAS',
      'status' => 1,
      'updated_at' => $date
    ];
    $update_detail_record_rak = $this->M_Pasting->update_detail_record_rak($pn_qr, $data_detail_record_rak);
    $update_data_master_rak = $this->M_Pasting->update_data_master_rak($pn_qr, $data_master_rak);
    // $cek_data_master_rak = $this->M_Pasting->cek_data_master_rak($pn_qr, $barcode, 'open');
    // $query = $this->M_Pasting->delete_rak($id_rak_barcode);
    $data = [
      'update_detail_record_rak' => $update_detail_record_rak,
      'update_data_master_rak' => $update_data_master_rak,
      // 'cek_data_master_rak' => $cek_data_master_rak,
      // 'query' => $query,
    ];
    echo json_encode($data);
    // echo json_encode($query);
  }

  public function delete_rak_out()
  {
    // $id_rak_barcode_out = $this->request->getPost('id_rak_barcode_out');
    $id_rak = $this->request->getPost('id_rak');
    $id_log_detail_record_rak_out = $this->request->getPost('id_log_detail_record_rak_out');
    $barcode = $this->request->getPost('barcode_rak_out');
    date_default_timezone_set("Asia/Jakarta");
    $date = date('Y-m-d  H:i:s');
    $data_master_rak = [
      'current_position' => NULL,
      'status' => NULL,
      'updated_at' => $date
    ];
    $update_detail_record_rak = $this->M_Pasting->delete_detail_record_rak_by_id($id_log_detail_record_rak_out);
    $update_data_master_rak = $this->M_Pasting->update_data_master_rak($id_rak, $data_master_rak);
    $delete_detail_barcode_rak = $this->M_Pasting->delete_detail_barcode_rak($barcode);
    // $query = $this->M_Pasting->delete_rak_out($id_rak_barcode_out);
    $data = [
      'update_detail_record_rak' => $update_detail_record_rak,
      'update_data_master_rak' => $update_data_master_rak,
      'delete_detail_barcode_rak' => $delete_detail_barcode_rak,
      // 'query' => $query,
    ];
    echo json_encode($data);
  }
  public function get_data_andon()
  {
    $shift = $this->request->getPost('shift');
    $tanggal = $this->request->getPost('tanggal');
    $mesin = $this->request->getPost('mesin_pasting');

    $model = new M_Pasting();

    $query = $model->get_data_andon($shift, $tanggal, $mesin);
    echo json_encode($query);
  }

  public function delete_rows() {
    $id_detail_lhp_pasting = $this->request->getPost('id_detail_lhp_pasting');
    $query = $this->M_Pasting->delete_rows($id_detail_lhp_pasting);
    echo json_encode($id_detail_lhp_pasting);
  }
}