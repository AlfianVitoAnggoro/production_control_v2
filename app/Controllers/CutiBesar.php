<?php

namespace App\Controllers;

use App\Models\M_CutiBesar;

class CutiBesar extends BaseController
{
  public function __construct()
  {
    $this->M_CutiBesar = new M_CutiBesar();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_mp'] = $this->M_CutiBesar->get_data_master_man_power();
    return view('pages/cuti_besar/form_cuti_besar', $data);
  }

  public function save_form_cuti_besar()
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
      $data_form_cuti_besar = [
        'nama' => $nama,
        'sub_bagian' => $bagian,
        'tanggal_buat' => $tanggal,
        'jenis' => $jenis,
        'tanggal' => $waktu_rencana,
        'keterangan' => $keterangan,
      ];

      $save = $this->M_CutiBesar->save_form_cuti_besar($data_form_cuti_besar);
    }

    $data['success'] = 'Data Berhasil Disimpan';
    return view('pages/cuti_besar/form_cuti_besar', $data);
  }

  public function home()
  {
    $data['data_mp_cuti_besar'] = $this->M_CutiBesar->get_data_mp_cuti_besar();

    return view('pages/cuti_besar/home', $data);
  }

  public function detail_cuti_besar($id_cuti_besar)
  {
    $data['data_mp_cuti_besar'] = $this->M_CutiBesar->get_detail_mp_cuti_besar($id_cuti_besar);

    return view('pages/cuti_besar/detail_cuti_besar', $data);
  }

  public function get_data_mp()
  {
    $nama = $this->request->getPost('nama');

    $data = $this->M_CutiBesar->get_data_mp($nama);

    return json_encode($data);
  }

  public function print()
  {
    return view('pages/cuti_besar/print_form_cuti_besar');
  }
}
