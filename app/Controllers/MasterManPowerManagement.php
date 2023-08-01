<?php

namespace App\Controllers;

use App\Models\M_MasterManPowerManagement;

class MasterManPowerManagement extends BaseController
{
  public function __construct()
  {
    $this->M_MasterManPowerManagement = new M_MasterManPowerManagement();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_man_power'] = $this->M_MasterManPowerManagement->get_data_master_man_power_management();
    return view('pages/master_data_man_power_management/home', $data);
  }

  public function add_man_power()
  {
    $nama = $this->request->getPost('nama');
    $npk = $this->request->getPost('npk');
    $status = $this->request->getPost('status');
    $cek_npk_man_power = $this->M_MasterManPowerManagement->get_data_man_power_management($npk);
    if (count($cek_npk_man_power) > 0)
      return redirect()->to(base_url('master_man_power_management/detail_man_power/' . $cek_npk_man_power[0]['id_man_power']));
    else {
      $data_man_power = [
        'nama' => $nama,
        'npk' => $npk,
        'status' => $status
      ];
      $save_data = $this->M_MasterManPowerManagement->save_data_man_power($data_man_power);
      return redirect()->to(base_url('master_man_power_management/detail_man_power/' . $save_data));
    }
  }

  public function detail_man_power($id_man_power)
  {
    $data['data_man_power'] = $this->M_MasterManPowerManagement->get_data_master_man_power_management_by_id($id_man_power);
    $data['detail_data_man_power_line'] = $this->M_MasterManPowerManagement->get_detail_data_master_man_power_management_by_id_and_line($id_man_power, 1);

    return view('pages/master_data_man_power_management/detail_master_data_man_power_management', $data);
  }

  public function update_data_man_power()
  {
    $id_man_power = $this->request->getPost('id_man_power');
    $nama = $this->request->getPost('nama');
    $npk = $this->request->getPost('npk');
    $model = new M_MasterManPowerManagement();
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

    return redirect()->to(base_url('master_man_power_management/detail_man_power/' . $id_man_power));
  }

  public function delete_data_man_power()
  {
    $checkedId = $this->request->getPost('checkedId');
    $checkedNpk = $this->request->getPost('checkedNpk');
    $model = new M_MasterManPowerManagement();
    for ($i = 0; $i < count($checkedId); $i++) {
      $files = glob(FCPATH . 'uploads\\' . $checkedNpk[$i] . '.*'); // Ganti "file_name.txt" dengan nama file yang ingin dihapus
      if (count($files) > 0) {
        foreach ($files as $file_path) {
          if (is_file($file_path)) {
            unlink($file_path);
          }
        }
      }
      $model->delete_data_master_man_power_management($checkedId[$i]);
    }
    // foreach ($checkedId as $id) {
    //   $model->delete_data_master_man_power_management($id);
    // }

    return json_encode('success');
  }
}
