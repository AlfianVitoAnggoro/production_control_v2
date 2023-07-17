<?php

namespace App\Controllers;

use App\Models\M_Cuti;

class Cuti extends BaseController
{
  public function __construct()
  {
    $this->M_Cuti = new M_Cuti();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_mp'] = $this->M_Cuti->get_data_master_man_power();
    return view('pages/cuti/form_cuti', $data);
  }

  public function save_form_cuti()
  {
    $nama = $this->request->getPost('nama');
    $line = $this->request->getPost('line');
    $group_mp = $this->request->getPost('group_mp');
    $bagian = $this->request->getPost('bagian');
    $tanggal = $this->request->getPost('tanggal');
    $jenis = $this->request->getPost('jenis');
    $waktu_rencana = $this->request->getPost('waktu_rencana');
    $keterangan = $this->request->getPost('keterangan');

    if ($nama !== '') {
      $data_form_cuti = [
        'sub_bagian' => $bagian,
        'tanggal_buat' => $tanggal,
        'jenis' => $jenis,
        'line' => $line,
        'group_mp' => $group_mp,
        'nama' => $nama,
        'keterangan' => $keterangan,
        'status_kadiv' => 'pending',
        'status_kadept' => 'pending',
        'status_kasie' => 'pending',
        'status_kasubsie' => 'pending',
      ];
      $save = $this->M_Cuti->save_form_cuti($data_form_cuti);

      $data_resume_cuti = [
        'id_data_cuti' => $save,
        'tanggal' => $tanggal,
        'nama' => $nama,
        'keterangan' => 'Cuti'
      ];

      $save_resume_cuti = $this->M_Cuti->save_resume_cuti($data_resume_cuti);

      foreach ($waktu_rencana as $wr) {
        if ($wr !== NULL) {
          $detail_form_cuti = [
            'id_cuti' => $save,
            'tanggal_cuti' => $wr,
          ];
        }
        $save_detail = $this->M_Cuti->save_detail_form_cuti($detail_form_cuti);
      }
    }

    $data['success'] = 'Data Berhasil Disimpan';
    return redirect()->to(base_url('form_cuti'));
  }

  public function get_data_mp()
  {
    $nama = $this->request->getPost('nama');

    $data = $this->M_Cuti->get_data_mp($nama);

    return json_encode($data);
  }
}
