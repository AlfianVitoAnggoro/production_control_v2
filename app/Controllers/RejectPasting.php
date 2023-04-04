<?php

namespace App\Controllers;

use App\Models\M_RejectPasting;

class RejectPasting extends BaseController
{
  public function __construct()
  {
    $this->M_RejectPasting = new M_RejectPasting();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_reject_pasting'] = $this->M_RejectPasting->get_data_reject_pasting();
    $data['data_jenis_reject_pasting'] = $this->M_RejectPasting->get_data_jenis_reject_pasting();
    return view('data_master/master_reject_pasting/home', $data);
  }

  public function save()
  {
    $jenis_reject_pasting = $this->request->getPost('jenis_reject_pasting');
    $kategori_reject_pasting = $this->request->getPost('kategori_reject_pasting');
    $perhitungan = $this->request->getPost('perhitungan');

    $data_reject_pasting = [
      'jenis_reject_pasting' => $jenis_reject_pasting,
      'kategori_reject_pasting' => $kategori_reject_pasting,
      // 'status' => 'waiting'
    ];
    $model = new M_RejectPasting();
    $model->save_data_reject_pasting($data_reject_pasting);
    return redirect()->to(base_url('reject_pasting'));
  }

  public function edit($id_reject_pasting)
  {
    $data['data_detail_reject_pasting'] = $this->M_RejectPasting->get_detail_data_reject_pasting_by_id($id_reject_pasting);
    $data['data_jenis_reject_pasting'] = $this->M_RejectPasting->get_data_jenis_reject_pasting();
    
    $session = \Config\Services::session();
    $data['session'] = $session->get('level');
    return view('data_master/master_reject_pasting/detail_reject_pasting', $data);
  }

  public function update_data_reject_pasting()
  {
    $id_reject_pasting = $this->request->getPost('id_reject_pasting');
    // $approved = $this->request->getPost('approved');
    $model = new M_RejectPasting();
    $jenis_reject_pasting = $this->request->getPost('jenis_reject_pasting');
    $kategori_reject_pasting = $this->request->getPost('kategori_reject_pasting');
    // if ($approved === NULL) {
    //   $status = 'waiting';
    // } else if ($approved === 'approved') {
    //   $status = 'approved';
    // }
    $data_reject_pasting = [
      'jenis_reject_pasting' => $jenis_reject_pasting,
      'kategori_reject_pasting' => $kategori_reject_pasting,
      // 'status' => $status
    ];
    $model->update_data_reject_pasting($id_reject_pasting, $data_reject_pasting);
    return redirect()->to(base_url('reject_pasting'));
  }
  
  public function delete_data_reject_pasting()
  {
    $id_reject_pasting = $this->request->getPost('id_reject_pasting');
    $model = new M_RejectPasting();
    $model->delete_data_reject_pasting($id_reject_pasting);

    return redirect()->to(base_url('reject_pasting'));
  }
}
