<?php

namespace App\Controllers;

use App\Models\M_GrupGrid;

class GrupGrid extends BaseController
{
  public function __construct()
  {
    $this->M_GrupGrid = new M_GrupGrid();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_grup_grid'] = $this->M_GrupGrid->get_data_grup_grid();
    $data['data_nama_grup'] = $this->M_GrupGrid->get_data_nama_grup();
    return view('data_master/master_grup_grid/home', $data);
  }

  public function save()
  {
    $nama_grup = $this->request->getPost('nama_grup');
    $anggota = $this->request->getPost('anggota');

    $data_grup_grid = [
      'nama_grup' => $nama_grup,
      'anggota' => $anggota,
      // 'status' => 'waiting'
    ];
    $model = new M_GrupGrid();
    $model->save_data_grup_grid($data_grup_grid);
    return redirect()->to(base_url('grup_grid'));
  }

  public function edit($id)
  {
    $data['data_detail_grup_grid'] = $this->M_GrupGrid->get_detail_data_grup_grid_by_id($id);
    $data['data_nama_grup'] = $this->M_GrupGrid->get_data_nama_grup();
    
    $session = \Config\Services::session();
    $data['session'] = $session->get('level');
    return view('data_master/master_grup_grid/detail_grup_grid', $data);
  }

  public function update_data_grup_grid()
  {
    $id = $this->request->getPost('id');
    // $approved = $this->request->getPost('approved');
    $model = new M_GrupGrid();
    $nama_grup = $this->request->getPost('nama_grup');
    $anggota = $this->request->getPost('anggota');
    // if ($approved === NULL) {
    //   $status = 'waiting';
    // } else if ($approved === 'approved') {
    //   $status = 'approved';
    // }
    $data_grup_grid = [
      'nama_grup' => $nama_grup,
      'anggota' => $anggota,
      // 'status' => $status
    ];
    $model->update_data_grup_grid($id, $data_grup_grid);
    return redirect()->to(base_url('grup_grid'));
  }
  
  public function delete_data_grup_grid()
  {
    $id = $this->request->getPost('id');
    $model = new M_GrupGrid();
    $model->delete_data_grup_grid($id);

    return redirect()->to(base_url('grup_grid'));
  }
}
