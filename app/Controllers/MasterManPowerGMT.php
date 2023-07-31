<?php

namespace App\Controllers;

use App\Models\M_MasterManPowerGMT;

class MasterManPowerGMT extends BaseController
{
  public function __construct()
  {
    $this->M_MasterManPowerGMT = new M_MasterManPowerGMT();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_man_power'] = $this->M_MasterManPowerGMT->get_data_master_man_power_gmt();
    return view('pages/master_data_man_power_gmt/home', $data);
  }

  public function add_man_power()
  {
    $nama = $this->request->getPost('nama');
    $npk = $this->request->getPost('npk');
    $cek_npk_man_power = $this->M_MasterManPowerGMT->get_data_man_power_gmt($npk);
    if (count($cek_npk_man_power) > 0)
      return redirect()->to(base_url('master_man_power_gmt/detail_man_power/' . $cek_npk_man_power[0]['id_man_power']));
    else {
      $data_man_power = [
        'nama' => $nama,
        'npk' => $npk,
        'status' => 'gmt',
      ];
      $save_data = $this->M_MasterManPowerGMT->save_data_man_power($data_man_power);
      return redirect()->to(base_url('master_man_power_gmt/detail_man_power/' . $save_data));
    }
  }

  public function detail_man_power($id_man_power)
  {
    $data['data_man_power'] = $this->M_MasterManPowerGMT->get_data_master_man_power_gmt_by_id($id_man_power);
    $data['detail_data_man_power_line'] = $this->M_MasterManPowerGMT->get_detail_data_master_man_power_gmt_by_id_and_line($id_man_power, 1);

    return view('pages/master_data_man_power_gmt/detail_master_data_man_power_gmt', $data);
  }

  public function update_data_man_power()
  {
    $id_man_power = $this->request->getPost('id_man_power');
    $nama = $this->request->getPost('nama');
    $npk = $this->request->getPost('npk');
    $line = $this->request->getPost('line');
    $mesin = $this->request->getPost('mesin');
    $skill = $this->request->getPost('skill');
    $model = new M_MasterManPowerGMT();
    $foto = $this->request->getFile('foto');
    $namaFile = '';
    if ($foto && $foto->isValid()) {
      $namaFile = $foto->getName();
      $ukuran = $foto->getSize();
      $tipe = $foto->getExtension();
      $namaFile = $npk . '.' . $tipe;
      $files = glob(FCPATH . 'uploads\\' . $npk . '.*'); // Ganti "file_name.txt" dengan nama file yang ingin dihapus
      if (count($files) > 0) {
        foreach ($files as $file_path) {
          if (is_file($file_path)) {
            unlink($file_path);
          }
        }
      }
      $foto->move(ROOTPATH . 'public/uploads', $namaFile);
      $data_man_power = [
        'nama' => $nama,
        'npk' => $npk,
        'foto' => $namaFile,
      ];
    } else {
      $data_man_power = [
        'nama' => $nama,
        'npk' => $npk,
      ];
    }
    $model->update_data_man_power($id_man_power, $data_man_power);
    for ($i = 0; $i < count($line); $i++) {
      $id_detail_man_power = $this->request->getPost('id_detail_man_power')[$i] ?? '';
      $data_detail_man_power = [
        'id_man_power' => $id_man_power,
        'npk' => $npk,
        'line' => $line[$i],
        'mesin' => $mesin[$i],
        'skill' => $skill[$i],
      ];
      $model->update_detail_data_man_power($id_detail_man_power, $data_detail_man_power);
    }

    return redirect()->to(base_url('master_man_power_gmt/detail_man_power/' . $id_man_power));
  }

  public function delete_data_man_power()
  {
    $checkedId = $this->request->getPost('checkedId');
    $checkedNpk = $this->request->getPost('checkedNpk');
    $model = new M_MasterManPowerGMT();
    // if(count($checkedId) > 0) {
    for ($i = 0; $i < count($checkedId); $i++) {
      $files = glob(FCPATH . 'uploads\\' . $checkedNpk[$i] . '.*'); // Ganti "file_name.txt" dengan nama file yang ingin dihapus
      if (count($files) > 0) {
        foreach ($files as $file_path) {
          if (is_file($file_path)) {
            unlink($file_path);
          }
        }
      }
      $model->delete_data_master_man_power_gmt($checkedId[$i]);
    }
    // } else {
    //   $model->delete_data_master_man_power($checkedId);
    // }

    return json_encode('success');
  }

  public function get_data_master_man_power()
  {
    $id_man_power = $this->request->getPost('id_man_power');
    $choose_lineVal = $this->request->getPost('choose_lineVal');
    $model = new M_MasterManPowerGMT();
    $data_mesin = [];

    $data_detail_data_master_man_power = $model->get_detail_data_master_man_power_gmt_by_id_and_line($id_man_power, $choose_lineVal);
    if ($choose_lineVal !== '')
      $data_mesin = $model->get_data_skill_by_line($choose_lineVal);
    $data = [
      'data_detail_data_master_man_power' => $data_detail_data_master_man_power,
      'data_mesin' => $data_mesin,
    ];
    return json_encode($data);
  }
}
