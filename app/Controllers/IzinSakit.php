<?php

namespace App\Controllers;

use App\Models\M_IzinSakit;

class IzinSakit extends BaseController
{
  public function __construct()
  {
    $this->M_IzinSakit = new M_IzinSakit();
    $this->session = \Config\Services::session();
  }

  public function index()
  {
    $data['data_mp'] = $this->M_IzinSakit->get_data_master_man_power();
    return view('pages/izin_sakit/form_izin_sakit', $data);
  }

  public function save_form_izin_sakit()
  {
    $waktu_rencana = $this->request->getPost('waktu_rencana');
    $line = $this->request->getPost('line');
    if ($line == 'undefined')
      $line = 'indirect';
    $group_mp = $this->request->getPost('group_mp');
    $bagian = $this->request->getPost('bagian');
    if ($waktu_rencana[0] !== '') {
      if ($this->session->get('level') > 4 || $this->session->get('level') == NULL) {
        foreach ($waktu_rencana as $wr) {
          $temp_data_mp_absen_by_daily = $this->M_IzinSakit->get_data_mp_absen_by_daily($wr, $line, $group_mp, $bagian);
          if (count($temp_data_mp_absen_by_daily) >= 2) {
            $this->session->setFlashdata('failed', 'Sudah terdapat ' . count($temp_data_mp_absen_by_daily) . ' orang yang mengajukan cuti pada tanggal ' . $wr . '\nSilakan menghubungi Kasie anda');
            return redirect()->to(base_url('form_izin_sakit'));
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
        $data_form_izin_sakit = [
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
          'kategori' => 'Izin Sakit'
        ];

        $save = $this->M_IzinSakit->save_form_izin_sakit($data_form_izin_sakit);

        // $data_resume_izin_sakit = [
        //   'id_data_izin_sakit' => $save,
        //   'tanggal' => $tanggal,
        //   'nama' => $nama,
        //   'keterangan' => 'Izin'
        // ];

        // $save_resume_izin_sakit = $this->M_IzinSakit->save_resume_izin_sakit($data_resume_izin_sakit);

        foreach ($waktu_rencana as $wr) {
          if ($wr !== NULL) {
            $detail_form_izin_sakit = [
              'id_cuti' => $save,
              'tanggal_cuti' => $wr,
            ];
            $save_detail = $this->M_IzinSakit->save_detail_form_izin_sakit($detail_form_izin_sakit);
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
                'kategori' => 'Izin Sakit'
              ];

              $save_lampiran = $this->M_IzinSakit->save_lampiran($data_lampiran);
            }
          }
        }
      }
    } else {
      $this->session->setFlashdata('empty', 'Tidak Ada Data Yang Terkirim');
      return redirect()->to(base_url('form_izin_sakit'));
    }

    $this->session->setFlashdata('success', 'Data Telah Terkirim');
    $data['success'] = 'Data Berhasil Disimpan';
    return redirect()->to(base_url('dashboard_cuti'));
  }

  public function get_data_mp()
  {
    $nama = $this->request->getPost('nama');

    $data = $this->M_IzinSakit->get_data_mp($nama);

    return json_encode($data);
  }
}
