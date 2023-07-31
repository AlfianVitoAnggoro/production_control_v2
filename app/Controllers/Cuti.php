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
    $waktu_rencana = $this->request->getPost('waktu_rencana');
    $line = $this->request->getPost('line');
    if ($line == 'undefined')
      $line = 'indirect';
    $bagian = $this->request->getPost('bagian');
    $group_mp = $this->request->getPost('group_mp');
    if ($waktu_rencana[0] !== '') {
      if ($this->session->get('level') > 4 || $this->session->get('level') == NULL) {
        foreach ($waktu_rencana as $wr) {
          if ($wr != '') {
            $temp_data_mp_absen_by_daily = $this->M_Cuti->get_data_mp_absen_by_daily($wr, $line, $group_mp, $bagian);
            if (count($temp_data_mp_absen_by_daily) >= 2) {
              $this->session->setFlashdata('failed', 'Sudah terdapat ' . count($temp_data_mp_absen_by_daily) . ' orang yang mengajukan cuti pada tanggal ' . $wr . '\nSilakan menghubungi Kasie anda');
              return redirect()->to(base_url('form_cuti'));
            }
          }
        }
      }
      date_default_timezone_set('Asia/Jakarta');
      $nama = $this->request->getPost('nama');
      $npk = $this->request->getPost('npk');
      $tanggal = $this->request->getPost('tanggal');
      $jenis = $this->request->getPost('jenis');
      $keterangan = $this->request->getPost('keterangan');
      $lampiran = $this->request->getFiles('lampiran');

      if ($nama !== '') {
        $data_form_cuti = [
          'sub_bagian' => $bagian,
          'tanggal_buat' => $tanggal,
          'jenis' => $jenis,
          'line' => $line,
          'group_mp' => $group_mp,
          'nama' => $nama,
          'keterangan' => $keterangan,
          'status_hrd' => 'pending',
          'status_kadiv' => 'pending',
          'status_kadept' => 'pending',
          'status_kasie' => 'pending',
          'status_kasubsie' => 'pending',
          'kategori' => 'Cuti'
        ];

        $save = $this->M_Cuti->save_form_cuti($data_form_cuti);

        // $data_resume_cuti = [
        //   'id_data_cuti' => $save,
        //   'tanggal' => $tanggal,
        //   'nama' => $nama,
        //   'keterangan' => 'Cuti'
        // ];

        // $save_resume_cuti = $this->M_Cuti->save_resume_cuti($data_resume_cuti);

        foreach ($waktu_rencana as $wr) {
          if ($wr != '') {
            $detail_form_cuti = [
              'id_cuti' => $save,
              'tanggal_cuti' => $wr,
            ];
            $save_detail = $this->M_Cuti->save_detail_form_cuti($detail_form_cuti);
          }
        }
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
                'kategori' => 'Cuti'
              ];

              $save_lampiran = $this->M_Cuti->save_lampiran($data_lampiran);
            }
          }
        }
      }
    } else {
      $this->session->setFlashdata('empty', 'Tidak Ada Data Yang Terkirim');
      return redirect()->to(base_url('form_cuti'));
    }

    $this->session->setFlashdata('success', 'Data Telah Terkirim');
    $data['success'] = 'Data Berhasil Disimpan';
    return redirect()->to(base_url('dashboard_cuti'));
  }

  public function get_data_mp()
  {
    $nama = $this->request->getPost('nama');

    $data = $this->M_Cuti->get_data_mp($nama);

    return json_encode($data);
  }
}
