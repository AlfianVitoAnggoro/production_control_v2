<?php

namespace App\Controllers;

use App\Models\M_ResumeCuti;

class ResumeCuti extends BaseController
{
  public function __construct()
  {
    $this->M_ResumeCuti = new M_ResumeCuti();
    $this->session = \Config\Services::session();
  }

  public function home()
  {
    $data['level_account'] = $this->session->get('level');
    $data['departement_account'] = $this->session->get('departemen');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_data_mp_cuti();

    return view('pages/resumecuti/home', $data);
  }

  public function detail_cuti($id_cuti)
  {
    $data['id_cuti'] = $id_cuti;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_cuti($id_cuti);
    $data['nama'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama'] ?? '');
    $data['nama_hrd'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_hrd'] ?? '');
    $data['nama_kadiv'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadiv'] ?? '');
    $data['nama_kadept'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadept'] ?? '');
    $data['nama_kasie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasie'] ?? '');
    $data['nama_kasubsie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasubsie'] ?? '');
    $data['data_lampiran'] = $this->M_ResumeCuti->get_data_lampiran($id_cuti, 'Cuti');
    $data['list_tanggal_cuti'] = '';
    $format_tanggal = [];
    $month = [];
    $year = '';
    foreach ($data['data_mp_cuti'] as $dmc) {
      if (isset($month[date('F', strtotime($dmc['tanggal_cuti']))])) {
        $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] . ', ' . date('d', strtotime($dmc['tanggal_cuti']));
      } else {
        $month[date('F', strtotime($dmc['tanggal_cuti']))] = date('F', strtotime($dmc['tanggal_cuti']));
        $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = date('d', strtotime($dmc['tanggal_cuti']));
        $year = date('Y', strtotime($dmc['tanggal_cuti']));
      }
    }
    if (count($month) > 0) {
      $count = 0;
      foreach ($month as $m => $tanggal) {
        if ($count > 0)
          $data['list_tanggal_cuti'] = $data['list_tanggal_cuti'] . ', ' . $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        else
          $data['list_tanggal_cuti'] = $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        $count++;
      }
    }

    return view('pages/cuti/detail_cuti', $data);
  }

  public function get_data_mp()
  {
    $nama = $this->request->getPost('nama');

    $data = $this->M_ResumeCuti->get_data_mp($nama);

    return json_encode($data);
  }

  public function approve_cuti()
  {
    date_default_timezone_set('Asia/Jakarta');
    $id_cuti = $this->request->getPost('id_cuti');
    $status_old = $this->request->getPost('status_old');
    $keterangan = $this->request->getPost('keterangan');
    $level = $this->request->getPost('level');
    $nama = $this->session->get('nama');
    $level_account = $this->session->get('level');

    $created = date('Y-m-d H:i:s');

    if ($status_old == 'rejected') {
      $data_approved = [
        'status_' . $level => 'approved',
        'nama_' . $level => $nama,
        'created_' . $level => $created,
        'level_account' => NULL,
        'note' => NULL,
        'status' => NULL,
      ];
      $data = $this->M_ResumeCuti->update_cuti($id_cuti, $data_approved);
    } else {
      $data_approved = [
        'status_' . $level => 'approved',
        'nama_' . $level => $nama,
        'created_' . $level => $created,
      ];
      $data = $this->M_ResumeCuti->update_cuti($id_cuti, $data_approved);
    }

    $check = $this->M_ResumeCuti->checkStatusApprovedCuti($id_cuti);
    if (!empty($check)) {
      $data_approved = [
        'status' => 'approved',
      ];
      $data = $this->M_ResumeCuti->update_cuti($id_cuti, $data_approved);
    }

    return redirect()->to(base_url('cuti'));
  }

  public function reject_cuti()
  {
    date_default_timezone_set('Asia/Jakarta');
    $id_cuti = $this->request->getPost('id_cuti_modal');
    $nama = $this->session->get('nama');
    $level = $this->session->get('level');
    $departemen = $this->session->get('departemen');
    $note = $this->request->getPost('note_reject');
    if (strtolower($departemen) === 'produksi2') {
      $status = ['', 'kadiv', 'kadiv', 'kadept', 'kasie', 'kasubsie'];
    } else if (strtolower($departemen) === 'hrd') {
      $status = 'hrd';
    }
    // $id_data_cuti = $this->M_ResumeCuti->get_data_cuti_by_id($id_cuti);
    $created = date('Y-m-d H:i:s');
    if (strtolower($departemen) == 'produksi2') {
      $data_rejected = [
        'status_' . $status[$level] => 'rejected',
        'nama_' . $status[$level] => $nama,
        'created_' . $status[$level] => $created,
        'level_account' => $level,
        'note' => $note,
        'status' => 'rejected',
      ];
      $this->M_ResumeCuti->update_cuti($id_cuti, $data_rejected);
    } else if (strtolower($departemen) == 'hrd') {
      $data_rejected = [
        'status_' . $status => 'rejected',
        'nama_' . $status => $nama,
        'created_' . $status => $created,
        'level_account' => $status,
        'note' => $note,
        'status' => 'rejected',
      ];
      $this->M_ResumeCuti->update_cuti($id_cuti, $data_rejected);
    }
    return redirect()->to(base_url('cuti'));
  }

  public function approve_izin()
  {
    date_default_timezone_set('Asia/Jakarta');
    $id_cuti = $this->request->getPost('id_cuti');
    $status_old = $this->request->getPost('status_old');
    $keterangan = $this->request->getPost('keterangan');
    $level = $this->request->getPost('level');
    $nama = $this->session->get('nama');
    $level_account = $this->session->get('level');

    $created = date('Y-m-d H:i:s');

    if ($status_old == 'rejected') {
      $data_approved = [
        'status_' . $level => 'approved',
        'nama_' . $level => $nama,
        'created_' . $level => $created,
        'level_account' => NULL,
        'note' => NULL,
        'status' => NULL,
      ];
      $data = $this->M_ResumeCuti->update_izin($id_cuti, $data_approved);
    } else {
      $data_approved = [
        'status_' . $level => 'approved',
        'nama_' . $level => $nama,
        'created_' . $level => $created,
      ];
      $data = $this->M_ResumeCuti->update_izin($id_cuti, $data_approved);
    }
    $check = $this->M_ResumeCuti->checkStatusApprovedIzin($id_cuti);
    if (!empty($check)) {
      $data_approved = [
        'status' => 'approved',
      ];
      $data = $this->M_ResumeCuti->update_izin($id_cuti, $data_approved);
    }

    return redirect()->to(base_url('cuti'));
  }

  public function reject_izin()
  {
    date_default_timezone_set('Asia/Jakarta');
    $id_cuti = $this->request->getPost('id_cuti_modal');
    $nama = $this->session->get('nama');
    $level = $this->session->get('level');
    $departemen = $this->session->get('departemen');
    $note = $this->request->getPost('note_reject');
    if (strtolower($departemen) === 'produksi2') {
      $status = ['', 'kadiv', 'kadiv', 'kadept', 'kasie', 'kasubsie'];
    } else if (strtolower($departemen) === 'hrd') {
      $status = 'hrd';
    }
    // $id_data_cuti = $this->M_ResumeCuti->get_data_cuti_by_id($id_cuti);
    $created = date('Y-m-d H:i:s');
    if (strtolower($departemen) == 'produksi2') {
      $data_rejected = [
        'status_' . $status[$level] => 'rejected',
        'nama_' . $status[$level] => $nama,
        'created_' . $status[$level] => $created,
        'level_account' => $level,
        'note' => $note,
        'status' => 'rejected',
      ];
      $this->M_ResumeCuti->update_izin($id_cuti, $data_rejected);
    } else if (strtolower($departemen) == 'hrd') {
      $data_rejected = [
        'status_' . $status => 'rejected',
        'nama_' . $status => $nama,
        'created_' . $status => $created,
        'level_account' => $status,
        'note' => $note,
        'status' => 'rejected',
      ];
      $this->M_ResumeCuti->update_izin($id_cuti, $data_rejected);
    }
    return redirect()->to(base_url('cuti'));
  }

  public function print($id_cuti)
  {
    $data['id_cuti'] = $id_cuti;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_cuti($id_cuti);
    $data['nama'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama'] ?? '');
    $data['nama_hrd'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_hrd'] ?? '');
    $data['nama_kadiv'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadiv'] ?? '');
    $data['nama_kadept'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadept'] ?? '');
    $data['nama_kasie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasie'] ?? '');
    $data['nama_kasubsie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasubsie'] ?? '');
    $data['data_lampiran'] = $this->M_ResumeCuti->get_data_lampiran($id_cuti, 'Cuti');
    $data['list_tanggal_cuti'] = '';
    $format_tanggal = [];
    $month = [];
    $year = '';
    foreach ($data['data_mp_cuti'] as $dmc) {
      if (isset($month[date('F', strtotime($dmc['tanggal_cuti']))])) {
        $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] . ', ' . date('d', strtotime($dmc['tanggal_cuti']));
      } else {
        $month[date('F', strtotime($dmc['tanggal_cuti']))] = date('F', strtotime($dmc['tanggal_cuti']));
        $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = date('d', strtotime($dmc['tanggal_cuti']));
        $year = date('Y', strtotime($dmc['tanggal_cuti']));
      }
    }
    if (count($month) > 0) {
      $count = 0;
      foreach ($month as $m => $tanggal) {
        if ($count > 0)
          $data['list_tanggal_cuti'] = $data['list_tanggal_cuti'] . ', ' . $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        else
          $data['list_tanggal_cuti'] = $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        $count++;
      }
    }
    return view('pages/cuti/print_form_cuti', $data);
  }

  public function detail_izin($id_cuti)
  {
    $data['id_cuti'] = $id_cuti;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_izin($id_cuti);
    $data['nama'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama'] ?? '');
    $data['nama_hrd'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_hrd'] ?? '');
    $data['nama_kadiv'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadiv'] ?? '');
    $data['nama_kadept'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadept'] ?? '');
    $data['nama_kasie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasie'] ?? '');
    $data['nama_kasubsie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasubsie'] ?? '');
    $data['data_lampiran'] = $this->M_ResumeCuti->get_data_lampiran($id_cuti, 'Izin');
    $data['list_tanggal_cuti'] = '';
    $format_tanggal = [];
    $month = [];
    $year = '';
    foreach ($data['data_mp_cuti'] as $dmc) {
      if (isset($month[date('F', strtotime($dmc['tanggal_cuti']))])) {
        $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] . ', ' . date('d', strtotime($dmc['tanggal_cuti']));
      } else {
        $month[date('F', strtotime($dmc['tanggal_cuti']))] = date('F', strtotime($dmc['tanggal_cuti']));
        $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = date('d', strtotime($dmc['tanggal_cuti']));
        $year = date('Y', strtotime($dmc['tanggal_cuti']));
      }
    }
    if (count($month) > 0) {
      $count = 0;
      foreach ($month as $m => $tanggal) {
        if ($count > 0)
          $data['list_tanggal_cuti'] = $data['list_tanggal_cuti'] . ', ' . $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        else
          $data['list_tanggal_cuti'] = $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        $count++;
      }
    }

    return view('pages/izin/detail_izin', $data);
  }

  public function print_izin($id_cuti)
  {
    $data['id_cuti'] = $id_cuti;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_izin($id_cuti);
    $data['nama'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama'] ?? '');
    $data['nama_hrd'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_hrd'] ?? '');
    $data['nama_kadiv'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadiv'] ?? '');
    $data['nama_kadept'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadept'] ?? '');
    $data['nama_kasie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasie'] ?? '');
    $data['nama_kasubsie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasubsie'] ?? '');
    $data['data_lampiran'] = $this->M_ResumeCuti->get_data_lampiran($id_cuti, 'Izin');
    $data['list_tanggal_cuti'] = '';
    $format_tanggal = [];
    $month = [];
    $year = '';
    foreach ($data['data_mp_cuti'] as $dmc) {
      if (isset($month[date('F', strtotime($dmc['tanggal_cuti']))])) {
        $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] . ', ' . date('d', strtotime($dmc['tanggal_cuti']));
      } else {
        $month[date('F', strtotime($dmc['tanggal_cuti']))] = date('F', strtotime($dmc['tanggal_cuti']));
        $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = date('d', strtotime($dmc['tanggal_cuti']));
        $year = date('Y', strtotime($dmc['tanggal_cuti']));
      }
    }
    if (count($month) > 0) {
      $count = 0;
      foreach ($month as $m => $tanggal) {
        if ($count > 0)
          $data['list_tanggal_cuti'] = $data['list_tanggal_cuti'] . ', ' . $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        else
          $data['list_tanggal_cuti'] = $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        $count++;
      }
    }
    return view('pages/izin/print_form_izin', $data);
  }

  public function detail_cuti_besar($id_cuti)
  {
    $data['id_cuti'] = $id_cuti;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_cuti_besar($id_cuti);
    $data['nama'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama'] ?? '');
    $data['nama_hrd'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_hrd'] ?? '');
    $data['nama_kadiv'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadiv'] ?? '');
    $data['nama_kadept'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadept'] ?? '');
    $data['nama_kasie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasie'] ?? '');
    $data['nama_kasubsie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasubsie'] ?? '');
    $data['data_lampiran'] = $this->M_ResumeCuti->get_data_lampiran($id_cuti, 'Cuti Besar');
    $data['list_tanggal_cuti'] = '';
    $format_tanggal = [];
    $month = [];
    $year = '';
    foreach ($data['data_mp_cuti'] as $dmc) {
      if (($dmc['tanggal_cuti'] ?? '') !== '') {
        if (isset($month[date('F', strtotime($dmc['tanggal_cuti']))])) {
          $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] . ', ' . date('d', strtotime($dmc['tanggal_cuti']));
        } else {
          $month[date('F', strtotime($dmc['tanggal_cuti']))] = date('F', strtotime($dmc['tanggal_cuti']));
          $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = date('d', strtotime($dmc['tanggal_cuti']));
          $year = date('Y', strtotime($dmc['tanggal_cuti']));
        }
      }
    }
    if (count($month) > 0) {
      $count = 0;
      foreach ($month as $m => $tanggal) {
        if ($count > 0)
          $data['list_tanggal_cuti'] = $data['list_tanggal_cuti'] . ', ' . $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        else
          $data['list_tanggal_cuti'] = $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        $count++;
      }
    }

    return view('pages/cuti_besar/detail_cuti_besar', $data);
  }

  public function approve_cuti_besar()
  {
    date_default_timezone_set('Asia/Jakarta');
    $id_cuti = $this->request->getPost('id_cuti');
    $status_old = $this->request->getPost('status_old');
    $keterangan = $this->request->getPost('keterangan');
    $level = $this->request->getPost('level');
    $nama = $this->session->get('nama');
    $level_account = $this->session->get('level');

    $created = date('Y-m-d H:i:s');

    if ($status_old == 'rejected') {
      $data_approved = [
        'status_' . $level => 'approved',
        'nama_' . $level => $nama,
        'created_' . $level => $created,
        'level_account' => NULL,
        'note' => NULL,
        'status' => NULL,
      ];
      $data = $this->M_ResumeCuti->update_cuti_besar($id_cuti, $data_approved);
    } else {
      $data_approved = [
        'status_' . $level => 'approved',
        'nama_' . $level => $nama,
        'created_' . $level => $created,
      ];
      $data = $this->M_ResumeCuti->update_cuti_besar($id_cuti, $data_approved);
    }
    $check = $this->M_ResumeCuti->checkStatusApprovedCutiBesar($id_cuti);
    if (!empty($check)) {
      $data_approved = [
        'status' => 'approved',
      ];
      $data = $this->M_ResumeCuti->update_cuti_besar($id_cuti, $data_approved);
    }

    return redirect()->to(base_url('cuti'));
  }

  public function reject_cuti_besar()
  {
    date_default_timezone_set('Asia/Jakarta');
    $id_cuti = $this->request->getPost('id_cuti_modal');
    $nama = $this->session->get('nama');
    $level = $this->session->get('level');
    $departemen = $this->session->get('departemen');
    $note = $this->request->getPost('note_reject');
    if (strtolower($departemen) === 'produksi2') {
      $status = ['', 'kadiv', 'kadiv', 'kadept', 'kasie', 'kasubsie'];
    } else if (strtolower($departemen) === 'hrd') {
      $status = 'hrd';
    }
    // $id_data_cuti = $this->M_ResumeCuti->get_data_cuti_by_id($id_cuti);
    $created = date('Y-m-d H:i:s');
    if (strtolower($departemen) == 'produksi2') {
      $data_rejected = [
        'status_' . $status[$level] => 'rejected',
        'nama_' . $status[$level] => $nama,
        'created_' . $status[$level] => $created,
        'level_account' => $level,
        'note' => $note,
        'status' => 'rejected',
      ];
      $this->M_ResumeCuti->update_cuti_besar($id_cuti, $data_rejected);
    } else if (strtolower($departemen) == 'hrd') {
      $data_rejected = [
        'status_' . $status => 'rejected',
        'nama_' . $status => $nama,
        'created_' . $status => $created,
        'level_account' => $status,
        'note' => $note,
        'status' => 'rejected',
      ];
      $this->M_ResumeCuti->update_cuti_besar($id_cuti, $data_rejected);
    }
    return redirect()->to(base_url('cuti'));
  }

  public function print_cuti_besar($id_cuti)
  {
    $data['id_cuti'] = $id_cuti;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_cuti_besar($id_cuti);
    $data['nama'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama'] ?? '');
    $data['nama_hrd'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_hrd'] ?? '');
    $data['nama_kadiv'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadiv'] ?? '');
    $data['nama_kadept'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadept'] ?? '');
    $data['nama_kasie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasie'] ?? '');
    $data['nama_kasubsie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasubsie'] ?? '');
    $data['data_lampiran'] = $this->M_ResumeCuti->get_data_lampiran($id_cuti, 'Cuti Besar');
    $data['list_tanggal_cuti'] = '';
    $format_tanggal = [];
    $month = [];
    $year = '';
    foreach ($data['data_mp_cuti'] as $dmc) {
      if (($dmc['tanggal_cuti'] ?? '') !== '') {
        if (isset($month[date('F', strtotime($dmc['tanggal_cuti']))])) {
          $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] . ', ' . date('d', strtotime($dmc['tanggal_cuti']));
        } else {
          $month[date('F', strtotime($dmc['tanggal_cuti']))] = date('F', strtotime($dmc['tanggal_cuti']));
          $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = date('d', strtotime($dmc['tanggal_cuti']));
          $year = date('Y', strtotime($dmc['tanggal_cuti']));
        }
      }
    }
    if (count($month) > 0) {
      $count = 0;
      foreach ($month as $m => $tanggal) {
        if ($count > 0)
          $data['list_tanggal_cuti'] = $data['list_tanggal_cuti'] . ', ' . $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        else
          $data['list_tanggal_cuti'] = $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        $count++;
      }
    }
    return view('pages/cuti_besar/print_form_cuti_besar', $data);
  }

  public function detail_sakit($id_cuti)
  {
    $data['id_cuti'] = $id_cuti;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_sakit($id_cuti);
    $data['nama'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama'] ?? '');
    $data['nama_hrd'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_hrd'] ?? '');
    $data['nama_kadiv'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadiv'] ?? '');
    $data['nama_kadept'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadept'] ?? '');
    $data['nama_kasie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasie'] ?? '');
    $data['nama_kasubsie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasubsie'] ?? '');
    $data['data_lampiran'] = $this->M_ResumeCuti->get_data_lampiran($id_cuti, 'Sakit');
    $data['list_tanggal_cuti'] = '';
    $format_tanggal = [];
    $month = [];
    $year = '';
    foreach ($data['data_mp_cuti'] as $dmc) {
      if (($dmc['tanggal_cuti'] ?? '') !== '') {
        if (isset($month[date('F', strtotime($dmc['tanggal_cuti']))])) {
          $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] . ', ' . date('d', strtotime($dmc['tanggal_cuti']));
        } else {
          $month[date('F', strtotime($dmc['tanggal_cuti']))] = date('F', strtotime($dmc['tanggal_cuti']));
          $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = date('d', strtotime($dmc['tanggal_cuti']));
          $year = date('Y', strtotime($dmc['tanggal_cuti']));
        }
      }
    }
    if (count($month) > 0) {
      $count = 0;
      foreach ($month as $m => $tanggal) {
        if ($count > 0)
          $data['list_tanggal_cuti'] = $data['list_tanggal_cuti'] . ', ' . $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        else
          $data['list_tanggal_cuti'] = $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        $count++;
      }
    }

    return view('pages/sakit/detail_sakit', $data);
  }

  public function approve_sakit()
  {
    date_default_timezone_set('Asia/Jakarta');
    $id_cuti = $this->request->getPost('id_cuti');
    $status_old = $this->request->getPost('status_old');
    $keterangan = $this->request->getPost('keterangan');
    $level = $this->request->getPost('level');
    $nama = $this->session->get('nama');
    $level_account = $this->session->get('level');

    $created = date('Y-m-d H:i:s');

    if ($status_old == 'rejected') {
      $data_approved = [
        'status_' . $level => 'approved',
        'nama_' . $level => $nama,
        'created_' . $level => $created,
        'level_account' => NULL,
        'note' => NULL,
        'status' => NULL,
      ];
      $data = $this->M_ResumeCuti->update_sakit($id_cuti, $data_approved);
    } else {
      $data_approved = [
        'status_' . $level => 'approved',
        'nama_' . $level => $nama,
        'created_' . $level => $created,
      ];
      $data = $this->M_ResumeCuti->update_sakit($id_cuti, $data_approved);
    }
    $check = $this->M_ResumeCuti->checkStatusApprovedSakit($id_cuti);
    if (!empty($check)) {
      $data_approved = [
        'status' => 'approved',
      ];
      $data = $this->M_ResumeCuti->update_sakit($id_cuti, $data_approved);
    }

    return redirect()->to(base_url('cuti'));
  }

  public function reject_sakit()
  {
    date_default_timezone_set('Asia/Jakarta');
    $id_cuti = $this->request->getPost('id_cuti_modal');
    $nama = $this->session->get('nama');
    $level = $this->session->get('level');
    $departemen = $this->session->get('departemen');
    $note = $this->request->getPost('note_reject');
    if (strtolower($departemen) === 'produksi2') {
      $status = ['', 'kadiv', 'kadiv', 'kadept', 'kasie', 'kasubsie'];
    } else if (strtolower($departemen) === 'hrd') {
      $status = 'hrd';
    }
    // $id_data_cuti = $this->M_ResumeCuti->get_data_cuti_by_id($id_cuti);
    $created = date('Y-m-d H:i:s');
    if (strtolower($departemen) == 'produksi2') {
      $data_rejected = [
        'status_' . $status[$level] => 'rejected',
        'nama_' . $status[$level] => $nama,
        'created_' . $status[$level] => $created,
        'level_account' => $level,
        'note' => $note,
        'status' => 'rejected',
      ];
      $this->M_ResumeCuti->update_sakit($id_cuti, $data_rejected);
    } else if (strtolower($departemen) == 'hrd') {
      $data_rejected = [
        'status_' . $status => 'rejected',
        'nama_' . $status => $nama,
        'created_' . $status => $created,
        'level_account' => $status,
        'note' => $note,
        'status' => 'rejected',
      ];
      $this->M_ResumeCuti->update_sakit($id_cuti, $data_rejected);
    }
    return redirect()->to(base_url('cuti'));
  }

  public function print_sakit($id_cuti)
  {
    $data['id_cuti'] = $id_cuti;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_sakit($id_cuti);
    $data['nama'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama'] ?? '');
    $data['nama_hrd'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_hrd'] ?? '');
    $data['nama_kadiv'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadiv'] ?? '');
    $data['nama_kadept'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kadept'] ?? '');
    $data['nama_kasie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasie'] ?? '');
    $data['nama_kasubsie'] = $this->M_ResumeCuti->generateInitials($data['data_mp_cuti'][0]['nama_kasubsie'] ?? '');
    $data['data_lampiran'] = $this->M_ResumeCuti->get_data_lampiran($id_cuti, 'Sakit');
    $data['list_tanggal_cuti'] = '';
    $format_tanggal = [];
    $month = [];
    $year = '';
    foreach ($data['data_mp_cuti'] as $dmc) {
      if (($dmc['tanggal_cuti'] ?? '') !== '') {
        if (isset($month[date('F', strtotime($dmc['tanggal_cuti']))])) {
          $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] . ', ' . date('d', strtotime($dmc['tanggal_cuti']));
        } else {
          $month[date('F', strtotime($dmc['tanggal_cuti']))] = date('F', strtotime($dmc['tanggal_cuti']));
          $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = date('d', strtotime($dmc['tanggal_cuti']));
          $year = date('Y', strtotime($dmc['tanggal_cuti']));
        }
      }
    }
    if (count($month) > 0) {
      $count = 0;
      foreach ($month as $m => $tanggal) {
        if ($count > 0)
          $data['list_tanggal_cuti'] = $data['list_tanggal_cuti'] . ', ' . $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        else
          $data['list_tanggal_cuti'] = $format_tanggal[$m] . ' ' . $m . ' ' . $year;
        $count++;
      }
    }
    return view('pages/sakit/print_form_sakit', $data);
  }

  public function delete_cuti($cuti, $id_cuti)
  {
    $this->M_ResumeCuti->delete_cuti($cuti, $id_cuti);

    return redirect()->to(base_url('cuti'));
  }
}
