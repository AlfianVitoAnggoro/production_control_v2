<?php

namespace App\Controllers;

use App\Models\M_Imp;

class Imp extends BaseController
{
  public function __construct()
  {
    $this->M_Imp = new M_Imp();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_mp'] = $this->M_Imp->get_data_master_man_power();
    return view('pages/imp/form_imp', $data);
  }

  public function save_form_imp()
  {
    $nama = $this->request->getPost('nama');
    $bagian = $this->request->getPost('bagian');
    $tanggal = $this->request->getPost('tanggal');
    $jenis = $this->request->getPost('jenis');
    $waktu_rencana = $this->request->getPost('waktu_rencana');
    foreach ($waktu_rencana as $wr) {
      $temp[] = date('d', strtotime($wr));
      $tempmonth = date('m', strtotime($wr));
    }
    $keterangan = $this->request->getPost('keterangan');

    if ($nama !== '') {
      $data_form_imp = [
        'nama' => $nama,
        'sub_bagian' => $bagian,
        'tanggal_buat' => $tanggal,
        'jenis' => $jenis,
        'tanggal' => $waktu_rencana,
        'keterangan' => $keterangan,
      ];

      $save = $this->M_Imp->save_form_imp($data_form_imp);
    }

    $data['success'] = 'Data Berhasil Disimpan';
    return view('pages/imp/form_imp', $data);
  }

  public function home()
  {
    $data['data_mp_imp'] = $this->M_Imp->get_data_mp_imp();

    return view('pages/imp/home', $data);
  }

  public function detail_imp($id_imp)
  {
    $data['data_mp_imp'] = $this->M_Imp->get_detail_mp_imp($id_imp);

    return view('pages/imp/detail_imp', $data);
  }

  public function get_data_mp()
  {
    $nama = $this->request->getPost('nama');

    $data = $this->M_Imp->get_data_mp($nama);

    return json_encode($data);
  }

  public function print()
  {
    return view('pages/imp/print_form_imp');
  }
}
