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
    $model = new M_MasterManPowerGMT();
    $foto = $this->request->getFile('foto');
    $namaFile = '';
    if ($foto && $foto->isValid()) {
      $namaFile = $foto->getName();
      $ukuran = $foto->getSize();
      $tipe = $foto->getExtension();
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

    return redirect()->to(base_url('master_man_power_gmt/detail_man_power/' . $id_man_power));
  }

  public function delete_data_man_power()
  {
    $checkedId = $this->request->getPost('checkedId');
    $model = new M_MasterManPowerGMT();
    foreach ($checkedId as $id) {
      $model->delete_data_master_man_power_gmt($id);
    }

    return json_encode('success');
  }
}
