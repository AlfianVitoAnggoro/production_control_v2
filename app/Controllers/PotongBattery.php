<?php

namespace App\Controllers;

use App\Models\M_PotongBattery;

class PotongBattery extends BaseController
{
  public function __construct()
  {
    $this->M_PotongBattery = new M_PotongBattery();
    $this->session = \Config\Services::session();

  }

  public function index()
  {
    $data['potong_battery'] = $this->M_PotongBattery->getAll();

    return view('pages/potong_battery/home', $data);
  }

  public function save_data()
  {
    $tanggal_produksi = $this->request->getPost('tanggal_produksi');
    $shift = $this->request->getPost('shift');
    $operator = $this->request->getPost('operator');

    $data = [
      'tanggal_produksi' => $tanggal_produksi,
      'shift' => $shift,
      'operator' => $operator
    ];

    $id_potong_battery = $this->M_PotongBattery->save_data($data);

    return redirect()->to(base_url('potong_battery/detail_potong_battery/' . $id_potong_battery));
  }

  public function detail_lhp_potong_battery($id)
  {
    $data['data_plate'] = $this->M_PotongBattery->get_data_plate();
    $data['data_potong_battery'] = $this->M_PotongBattery->get_data_by_id($id);

    $data['data_plate_positif'] = [];
    $data['data_plate_negatif'] = [];

    foreach($data['data_plate'] as $dp){
      if(strpos($dp['plate'], 'POS') != false){
        array_push($data['data_plate_positif'], $dp);
      }else{
        array_push($data['data_plate_negatif'], $dp);
      }
    }

    $data['data_plate_ng'] = $this->M_PotongBattery->get_data_plate_ng($id);
    $data['data_element'] = $this->M_PotongBattery->get_data_element($id);

    return view('pages/potong_battery/detail_potong_battery', $data);
  }

  public function update()
  {
    $id_lhp_potong_battery = $this->request->getPost('id_potong_battery');
    $tanggal_produksi = $this->request->getPost('tanggal_produksi');
    $shift = $this->request->getPost('shift');
    $operator = $this->request->getPost('operator');

    $data = [
      'tanggal_produksi' => $tanggal_produksi,
      'shift' => $shift,
      'operator' => $operator
    ];

    $this->M_PotongBattery->update_data($id_lhp_potong_battery, $data);
    
    $type_plate_ng = $this->request->getPost('type');
    if (!empty($type_plate_ng)) {
      for ($i=0; $i < count($type_plate_ng); $i++) {
        $id_detail_lhp_potong_battery_plate = $this->request->getPost('id_detail_lhp_potong_battery_plate')[$i]; 

        $data_plate_ng = [
          'id_lhp_potong_battery' => $id_lhp_potong_battery,
          'type' => $type_plate_ng[$i],
          'bolong' => $this->request->getPost('bolong')[$i],
          'lug_pendek' => $this->request->getPost('lug_pendek')[$i],
          'patah_frame' => $this->request->getPost('patah_frame')[$i],
          'rontok' => $this->request->getPost('rontok')[$i],
          'other' => $this->request->getPost('other')[$i],
          'total' => $this->request->getPost('total')[$i],
        ];

        $this->M_PotongBattery->update_data_plate($id_detail_lhp_potong_battery_plate, $data_plate_ng);
      }
    }

    $type_element_positif = $this->request->getPost('type_element_positif');
    if (!empty($type_element_positif)) {
      for ($i=0; $i < count($type_element_positif); $i++) {
        $id_detail_lhp_potong_battery_element = $this->request->getPost('id_detail_lhp_potong_battery_element')[$i];
        $data_element_positif = [
          'id_lhp_potong_battery' => $id_lhp_potong_battery,
          'type_positif' => $type_element_positif[$i],
          'pasangan_positif' => $this->request->getPost('pasangan_positif')[$i],
          'type_negatif' => $this->request->getPost('type_element_negatif')[$i],
          'pasangan_negatif' => $this->request->getPost('pasangan_negatif')[$i],
          'total' => $this->request->getPost('total_element')[$i],
          'keterangan' => $this->request->getPost('keterangan')[$i],
        ];
  
        $this->M_PotongBattery->update_data_element($id_detail_lhp_potong_battery_element, $data_element_positif);
      }
    }

    return redirect()->to(base_url('potong_battery/detail_potong_battery/' . $id_lhp_potong_battery));
  }
}
