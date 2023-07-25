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
    $id_cuti = $this->request->getPost('id_cuti');
    $bagian = $this->request->getPost('bagian');
    $tanggal = $this->request->getPost('tanggal');
    $line = $this->request->getPost('line');
    $group_mp = $this->request->getPost('group_mp');
    $nama = $this->request->getPost('nama');
    $npk = $this->request->getPost('npk');
    $berangkat = $this->request->getPost('berangkat');
    $rencana_kembali = $this->request->getPost('rencana_kembali');
    $keperluan = $this->request->getPost('keperluan');
    $keterangan = $this->request->getPost('keterangan');
    $keterangan_lengkap = $this->request->getPost('keterangan_lengkap');
    $lampiran = $this->request->getFiles('lampiran');

    if ($nama !== '') {
      $data_form_imp = [
        'sub_bagian' => $bagian,
        'tanggal_buat' => $tanggal,
        'jenis' => $keperluan,
        'line' => $line,
        'group_mp' => $group_mp,
        'nama' => $nama,
        'berangkat' => $berangkat,
        'rencana_kembali' => $rencana_kembali,
        'keterangan' => $keterangan,
        'keterangan_lengkap' => $keterangan_lengkap,
        'status_hrd' => 'pending',
        'status_kadiv' => 'pending',
        'status_kadept' => 'pending',
        'status_kasie' => 'pending',
        'status_kasubsie' => 'pending',
        'kategori' => 'Imp'
      ];

      $save = $this->M_Imp->save_form_imp($id_cuti, $data_form_imp);

      if ($save !== '') {
        $detail_form_cuti = [
          'id_cuti' => $save,
          'tanggal_cuti' => $tanggal,
        ];
        $save_detail = $this->M_Imp->save_detail_form_cuti($save, $detail_form_cuti);

        if (count($lampiran) > 0) {
          foreach ($lampiran['lampiran'] as $lamp) {
            if ($lamp && $lamp->isValid()) {
              $namaFile = $lamp->getName();
              $namaFile = substr($namaFile, -24);
              $fileName = sprintf('%04d', $npk) . '_' . $tanggal . '_' . $namaFile;
              $file_path = FCPATH . 'uploads\\lampiran_cuti\\' . $fileName; // Ganti "file_name.txt" dengan nama file yang ingin dihapus
              $count = 1;
              while (file_exists($file_path)) {
                $fileName = sprintf('%04d', $npk) . '_' . $tanggal . '_' . $count . '_' . $namaFile;
                $file_path = FCPATH . 'uploads\\lampiran_cuti\\' . $fileName;
                $count++;
              }
              $lamp->move(ROOTPATH . 'public/uploads/lampiran_cuti', $fileName);

              $data_lampiran = [
                'id_absen' => $save,
                'lampiran' => $fileName,
                'kategori' => 'Imp'
              ];

              $save_lampiran = $this->M_Imp->save_lampiran($data_lampiran);
            }
          }
        }
      }
    }
    return redirect()->to(base_url('form_imp'));
  }

  // public function home()
  // {
  //   $data['data_mp_imp'] = $this->M_Imp->get_data_mp_imp();

  //   return view('pages/imp/home', $data);
  // }

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
