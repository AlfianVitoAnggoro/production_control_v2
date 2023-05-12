<?php

namespace App\Controllers;

use App\Models\M_Saw;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Saw extends BaseController
{
  public function __construct()
  {
    $this->M_Saw = new M_Saw();
    $this->session = \Config\Services::session();

    if ($this->session->get('is_login')) {
      return redirect()->to('login');
    }
  }

  public function saw_view()
  {
    $model = new M_Saw();
    $data['data_saw'] = $model->get_all_lhp_saw();
    $data['data_team'] = $model->get_team();
    return view('pages/saw/saw_view', $data);
  }

  // public function saw_add_view()
  // {
  //   return view('pages/saw/add_saw');
  // }

  public function save()
  {
    // $id = $this->request->getPost('id');
    $date = $this->request->getPost('date');
    $saw = $this->request->getPost('saw');
    $shift = $this->request->getPost('shift');
    $team = $this->request->getPost('team');
    $model = new M_Saw();
    $cek = $model->cek_lhp($date, $saw, $shift, $team);
    if(count($cek) > 0) {
      $id_lhp_saw = $cek[0]['id_lhp_saw'];
      return redirect()->to(base_url('saw/detail_saw/' . $id_lhp_saw));
    } else {
      $data_lhp_saw = array(
        'tanggal_produksi' => $date,
        'saw' => $saw,
        'shift' => $shift,
        'team' => $team,
      );
      $save_data = $model->save_saw($data_lhp_saw);
      return redirect()->to(base_url('saw/detail_saw/' . $save_data));
    }
  }

  function edit() {
    $id = $this->request->getPost('id');
    $id_detail_saw = $this->request->getPost('id_detail_saw');
    $date = $this->request->getPost('date');
    $saw = $this->request->getPost('saw');
    $shift = $this->request->getPost('shift');
    $team = $this->request->getPost('team');
    $no_wo = $this->request->getPost('no_wo');
    $type_battery = $this->request->getPost('type_battery');
    $hasil = $this->request->getPost('hasil');
    $kejepit = $this->request->getPost('kejepit');
    $ketarik = $this->request->getPost('ketarik');
    $terbakar = $this->request->getPost('terbakar');
    $rontok = $this->request->getPost('rontok');
    $id_detail_lhp_saw_Exist = [];
    $model = new M_Saw();
    $all_id_detail_lhp_saw = $model->get_id_detail_lhp_saw_by_id_lhp_saw($id);
    $data_lhp_saw = array(
      'tanggal_produksi' => $date,
      'saw' => $saw,
      'shift' => $shift,
      'team' => $team,
    );
    $update_data = $model->update_lhp_saw($id, $data_lhp_saw);
    if(($no_wo !== NULL ? count($no_wo) : 0)) {
      for($i = 0; $i < ($id_detail_saw !== NULL ? count($id_detail_saw) : 0); $i++) {
          if($id_detail_saw[$i] !== "") {
            $id_detail_lhp_saw_Exist[$id_detail_saw[$i]] = $id_detail_saw[$i];
          }
          $data_detail_lhp_saw = array(
            'id_lhp_saw' => $id,
            'no_wo' => $no_wo[$i] !== NULL ? $no_wo[$i] : 0,
            'type_battery' => $type_battery[$i] !== NULL ? $type_battery[$i] : 0,
            'hasil' => $hasil[$i] !== NULL ? $hasil[$i] : 0,
            'kejepit' => $kejepit[$i] !== NULL ? $kejepit[$i] : 0,
            'ketarik' => $ketarik[$i] !== NULL ? $ketarik[$i] : 0,
            'terbakar' => $terbakar[$i] !== NULL ? $terbakar[$i] : 0,
            'rontok' => $rontok[$i] !== NULL ? $rontok[$i] : 0,
          );
          $update_data = $model->update_detail_lhp_saw($id_detail_saw[$i], $data_detail_lhp_saw);
      }
    }
    if(count($all_id_detail_lhp_saw) > 0) {
      foreach ($all_id_detail_lhp_saw as $ids) {
        if(!array_key_exists($ids['id_detail_lhp_saw'], $id_detail_lhp_saw_Exist)) {
          $model->delete_detail_lhp_saw($ids['id_detail_lhp_saw']);
        }
      }
    }
    return redirect()->to(base_url('saw/detail_saw/' . $id));
  }

  // public function delete_saw($id)
  // {
  //   $id = $this->request->getPost('id_lhp_saw');

  //   $model = new M_Saw();

  //   $delete = $model->delete_lhp($id);

  //   if ($delete > 0) {
  //     $this->saw_view();
  //   }
  // }

  public function getPartNo()
  {
      $no_wo = $this->request->getPost('no_wo');
      $model = new M_Saw();
      echo json_encode($model->getPartNo($no_wo));
      // echo json_encode($no_wo);
  }

  public function detail_saw($id)
  {
    $model = new M_Saw();
    $data['data_lhp_saw'] = $model->get_lhp_saw_by_id($id);
    $data['data_detail_lhp_saw'] = $model->get_detail_lhp_saw_by_id($id);
    $data['data_team'] = $model->get_team();
    $data['data_wo'] = $model->getDataWO($data['data_lhp_saw'][0]['tanggal_produksi'], $data['data_lhp_saw'][0]['saw']);
    return view('pages/saw/saw_detail_view', $data);
  }

  public function update_saw()
  {
    return redirect()->to(base_url('saw/detail_saw/' . $id_lhp_saw));
  }

  public function delete_saw()
  {
    $id_lhp_saw = $this->request->getPost('id');
    $model = new M_Saw();
    $model->delete_saw($id_lhp_saw);

    return redirect()->to(base_url('saw'));
  }

  public function download()
  {
    $date = $this->request->getPost('date');
    $start_date = $this->request->getPost('start_date');
    $end_date = $this->request->getPost('end_date');
    $model = new M_Saw();
    $data_saw = $model->get_all_lhp_saw_by_date($start_date, $end_date);
    // $data_saw = $model->get_all_lhp_saw_by_month($date);
    $data_detail_lhp_saw = [];
    if($data_saw !== NULL) {
        foreach ($data_saw as $ds) {
          $temp = $model->get_all_detail_lhp_saw_by_id_lhp_saw($ds['id_lhp_saw']);
          if($temp !== NULL) {
            foreach ($temp as $t) {
              array_push($data_detail_lhp_saw, $t);
            }
          }
        }
        $dates = array_column($data_saw, "tanggal_produksi");
        $saws = array_column($data_saw, "saw");
        $shift = array_column($data_saw, "shift");
        array_multisort($dates, SORT_ASC, $shift, SORT_ASC, $saws, SORT_ASC,  $data_saw);
    }
    // Membuat objek Spreadsheet baru
    $spreadsheet = new Spreadsheet();

    // Menambahkan data ke worksheet
    $sheet = $spreadsheet->getActiveSheet();
    $data = array(
        array('Date', 'Shift', 'SAW', 'Team', 'NO WO', 'Type Battery', 'Hasil', 'Kejepit', 'Ketarik', 'Terbakar', 'Rontok'),
    );
    $isExist = [];
    if($data_saw !== NULL) {
        foreach ($data_saw as $ds) {
            foreach ($data_detail_lhp_saw as $ddls) {
                if ($ds['id_lhp_saw'] === $ddls['id_lhp_saw']) {
                    $data[] = array($ds['tanggal_produksi'], $ds['shift'], $ds['saw'], $ds['team'], $ddls['no_wo'], $ddls['type_battery'], $ddls['hasil'], $ddls['kejepit'], $ddls['ketarik'], $ddls['terbakar'], $ddls['rontok']);
                };
            }
        }
    }

    // Memasukkan data array ke dalam worksheet
    $sheet->fromArray($data);


    // Mengatur header respons HTTP
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="data.xlsx"');
    header('Cache-Control: max-age=0');

    ob_end_clean();
    // Membuat objek Writer untuk menulis spreadsheet ke output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
  }
}
