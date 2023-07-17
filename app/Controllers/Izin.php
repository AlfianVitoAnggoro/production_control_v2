<?php

namespace App\Controllers;

use App\Models\M_Izin;

class Izin extends BaseController
{
  public function __construct()
  {
    $this->M_Izin = new M_Izin();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_mp'] = $this->M_Izin->get_data_master_man_power();
    return view('pages/izin/form_izin', $data);
  }

  public function save_form_izin()
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
      $data_form_izin = [
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
      $save = $this->M_Izin->save_form_izin($data_form_izin);

      $data_resume_izin = [
        'id_data_izin' => $save,
        'tanggal' => $tanggal,
        'nama' => $nama,
        'keterangan' => 'Izin'
      ];

      $save_resume_izin = $this->M_Izin->save_resume_izin($data_resume_izin);

      foreach ($waktu_rencana as $wr) {
        if ($wr !== NULL) {
          $detail_form_izin = [
            'id_izin' => $save,
            'tanggal_izin' => $wr,
          ];
        }
        $save_detail = $this->M_Izin->save_detail_form_izin($detail_form_izin);
      }
    }

    $data['success'] = 'Data Berhasil Disimpan';
    return redirect()->to(base_url('form_izin'));
  }

  public function get_data_mp()
  {
    $nama = $this->request->getPost('nama');

    $data = $this->M_Izin->get_data_mp($nama);

    return json_encode($data);
  }
}
