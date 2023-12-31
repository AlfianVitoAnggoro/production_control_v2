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
    // foreach ($waktu_rencana as $wr) {
    //   $temp_data_mp_absen_by_daily = $this->M_CutiBesar->get_data_mp_absen_by_daily($wr, $line, $group_mp);
    //   if (count($temp_data_mp_absen_by_daily) >= 2) {
    //     $this->session->setFlashdata('failed', 'Sudah terdapat ' . count($temp_data_mp_absen_by_daily) . ' orang yang mengajukan cuti pada tanggal ' . $wr);
    //     return redirect()->to(base_url('form_cuti_besar'));
    //   }
    // }
    date_default_timezone_set('Asia/Jakarta');
    $bagian = $this->request->getPost('bagian');
    $jenis = $this->request->getPost('jenis') ?? '';
    $line = $this->request->getPost('line');
    $group_mp = $this->request->getPost('group_mp');
    $start_date = $this->request->getPost('start_date') ?? '';
    $end_date = $this->request->getPost('end_date');
    if ($start_date == '')
      $start_date = NULL;
    if ($end_date == '')
      $end_date = $start_date;
    if ($line == 'undefined')
      $line = 'indirect';
    $back_date = '';
    if ($this->session->get('level') > 4 || $this->session->get('level') == NULL) {
      if (strtolower($jenis) == 'pengambilan cuti besar') {
        if ($start_date !== NULL) {
          if (strtotime($start_date) < strtotime(date('Y-m-d')))
            $back_date = 'true';
          $temp_start_date = strtotime($start_date ?? '');
          $temp_end_date = strtotime($end_date ?? '');
          $temp_current_date = $temp_start_date;
          if ($start_date != NULL) {
            while ($temp_current_date <= $temp_end_date) {
              $current_date = date('Y-m-d', $temp_current_date);
              $temp_data_mp_absen_by_daily = $this->M_CutiBesar->get_data_mp_absen_by_daily($current_date, $line, $group_mp, $bagian);
              if (count($temp_data_mp_absen_by_daily) >= 2) {
                $this->session->setFlashdata('failed', 'Sudah terdapat ' . count($temp_data_mp_absen_by_daily) . ' orang yang mengajukan cuti pada tanggal ' . date('j F Y', strtotime($current_date)) . '\nSilakan menghubungi Kasie anda');
                return redirect()->to(base_url('form_cuti_besar'));
              }
              // Tambahkan 1 hari ke tanggal saat ini
              $temp_current_date = strtotime('+1 day', $temp_current_date);
            }
          }
        }
      }
    }
    $nama = $this->request->getPost('nama');
    $npk = $this->request->getPost('npk');
    $masa_kerja = $this->request->getPost('masa_kerja');
    // $masa_kerja_pelafalan = $this->request->getPost('masa_kerja_pelafalan');
    $tanggal_masa_kerja = $this->request->getPost('tanggal_masa_kerja');
    $jumlah_hari = $this->request->getPost('jumlah_hari');
    $alamat = $this->request->getPost('alamat');
    $telp = $this->request->getPost('telp');
    $lampiran = $this->request->getFiles('lampiran');
    if ($nama !== '') {
      $data_form_cuti_besar = [
        'sub_bagian' => $bagian,
        'tanggal_buat' => date('Y-m-d'),
        'jenis' => $jenis,
        'line' => $line,
        'group_mp' => $group_mp,
        'nama' => $nama,
        'masa_kerja' => $masa_kerja,
        // 'masa_kerja_pelafalan' => $masa_kerja_pelafalan,
        'tanggal_masa_kerja' => $tanggal_masa_kerja,
        'jumlah_hari' => $jumlah_hari,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'alamat' => $alamat,
        'telp' => $telp,
        'status_hrd' => 'pending',
        'status_kadiv' => 'pending',
        'status_kadept' => 'pending',
        'status_kasie' => 'pending',
        'status_kasubsie' => 'pending',
        'back_date' => $back_date,
        'kategori' => 'Cuti Besar'
      ];

      $save = $this->M_CutiBesar->save_form_cuti_besar($data_form_cuti_besar);
      if ($start_date !== NULL && $end_date !== NULL) {
        $start_date = strtotime($start_date ?? '');
        $end_date = strtotime($end_date ?? '');
        $current_date = $start_date;
        if ($start_date != NULL) {
          while ($current_date <= $end_date) {
            $detail_form_cuti_besar = [
              'id_cuti' => $save,
              'tanggal_cuti' => date('Y-m-d', $current_date),
            ];
            $save_detail = $this->M_CutiBesar->save_detail_form_cuti_besar($detail_form_cuti_besar);
            // Tambahkan 1 hari ke tanggal saat ini
            $current_date = strtotime('+1 day', $current_date);
          }
        }
      }
      if (count($lampiran) > 0) {
        foreach ($lampiran['lampiran'] as $lamp) {
          if ($lamp && $lamp->isValid()) {
            $namaFile = $lamp->getName();
            $namaFile = substr($namaFile, -24);
            $fileName = sprintf('%04d', $npk) . '_' . date('Y-m-d') . '_' . $namaFile;
            $file_path = FCPATH . 'uploads\\lampiran_cuti\\' . $fileName; // Ganti "file_name.txt" dengan nama file yang ingin dihapus
            $count = 1;
            while (file_exists($file_path)) {
              $fileName = sprintf('%04d', $npk) . '_' . date('Y-m-d') . '_' . $count . '_' . $namaFile;
              $file_path = FCPATH . 'uploads\\lampiran_cuti\\' . $fileName;
              $count++;
            }
            $lamp->move(ROOTPATH . 'public/uploads/lampiran_cuti', $fileName);

            $data_lampiran = [
              'id_absen' => $save,
              'lampiran' => $fileName,
              'kategori' => 'Cuti Besar'
            ];

            $save_lampiran = $this->M_CutiBesar->save_lampiran($data_lampiran);
          }
        }
      }
    } else {
      $this->session->setFlashdata('empty', 'Tidak Ada Data Yang Terkirim');
      return redirect()->to(base_url('form_cuti_besar'));
    }

    $this->session->setFlashdata('success', 'Data Telah Terkirim');
    $data['success'] = 'Data Berhasil Disimpan';
    return redirect()->to(base_url('dashboard_cuti'));
  }

  public function get_data_mp()
  {
    $nama = $this->request->getPost('nama');

    $data = $this->M_CutiBesar->get_data_mp($nama);

    return json_encode($data);
  }
}
