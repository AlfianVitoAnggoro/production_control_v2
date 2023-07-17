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
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_data_mp_cuti();

    return view('pages/resumecuti/home', $data);
  }

  // public function detail_cuti($id_cuti, $keterangan)
  // {
  //   $data['id_cuti'] = $id_cuti;
  //   $data['keterangan'] = $keterangan;
  //   $data['level_account'] = $this->session->get('level');
  //   $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_cuti($id_cuti, $keterangan);
  //   $data['list_tanggal_cuti'] = '';
  //   $format_tanggal = [];
  //   $month = [];
  //   $year = '';
  //   foreach ($data['data_mp_cuti'] as $dmc) {
  //     if (isset($month[date('F', strtotime($dmc['tanggal_cuti']))])) {
  //       $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] . ', ' . date('d', strtotime($dmc['tanggal_cuti']));
  //     } else {
  //       $month[date('F', strtotime($dmc['tanggal_cuti']))] = date('F', strtotime($dmc['tanggal_cuti']));
  //       $format_tanggal[date('F', strtotime($dmc['tanggal_cuti']))] = date('d', strtotime($dmc['tanggal_cuti']));
  //       $year = date('Y', strtotime($dmc['tanggal_cuti']));
  //     }
  //   }
  //   if (count($month) > 0) {
  //     $count = 0;
  //     foreach ($month as $m => $tanggal) {
  //       if ($count > 0)
  //         $data['list_tanggal_cuti'] = $data['list_tanggal_cuti'] . ', ' . $format_tanggal[$m] . ' ' . $m . ' ' . $year;
  //       else
  //         $data['list_tanggal_cuti'] = $format_tanggal[$m] . ' ' . $m . ' ' . $year;
  //       $count++;
  //     }
  //   }

  //   return view('pages/cuti/detail_cuti', $data);
  // }

  public function detail_cuti($id_cuti)
  {
    $data['id_cuti'] = $id_cuti;
    // $data['keterangan'] = $keterangan;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_cuti($id_cuti);
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
    $id_cuti = $this->request->getPost('id_cuti');
    $status_old = $this->request->getPost('status_old');
    $keterangan = $this->request->getPost('keterangan');
    $level = $this->request->getPost('level');
    $nama = $this->session->get('nama');
    $level_account = $this->session->get('level');

    // $id_data_cuti = $this->M_ResumeCuti->get_data_cuti_by_id($id_cuti);

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
    } else {
      $data_approved = [
        'status_' . $level => 'approved',
        'nama_' . $level => $nama,
        'created_' . $level => $created,
      ];
    }
    $data = $this->M_ResumeCuti->update_cuti($id_cuti, $data_approved);
    // $data = $this->M_ResumeCuti->update_cuti($id_data_cuti[0]['id_data_cuti'], $data_approved);
    return redirect()->to(base_url('cuti/detail_cuti/' . $id_cuti . '/' . $keterangan));
  }

  public function reject_cuti()
  {
    $id_cuti = $this->request->getPost('id_cuti');
    $keterangan = $this->request->getPost('keterangan');
    $nama = $this->session->get('nama');
    $level = $this->session->get('level');
    $note = $this->request->getPost('note_reject');

    // $id_data_cuti = $this->M_ResumeCuti->get_data_cuti_by_id($id_cuti);

    $created = date('Y-m-d H:i:s');

    if ($level === 1) {
      $data_rejected = [
        'status_kadept' => 'rejected',
        'nama_kadept' => $nama,
        'created_kadept' => $created,
        'level_account' => $level,
        'note' => $note,
        'status' => 'rejected',
      ];
    } else if ($level === 2) {
      $data_rejected = [
        'status_kasie' => 'rejected',
        'nama_kasie' => $nama,
        'created_kasie' => $created,
        'level_account' => $level,
        'note' => $note,
        'status' => 'rejected',
      ];
    } else if ($level === 3) {
      $data_rejected = [
        'status_kasubsie' => 'rejected',
        'nama_kasubsie' => $nama,
        'created_kasubsie' => $created,
        'level_account' => $level,
        'note' => $note,
        'status' => 'rejected',
      ];
    }
    // $this->M_ResumeCuti->update_cuti($id_data_cuti[0]['id_data_cuti'], $data_rejected);
    $this->M_ResumeCuti->update_cuti($id_cuti, $data_rejected);
    return redirect()->to(base_url('cuti/detail_cuti/' . $id_cuti . '/' . $keterangan));
  }

  public function print($id_cuti, $keterangan)
  {
    $data['id_cuti'] = $id_cuti;
    $data['keterangan'] = $keterangan;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_cuti($id_cuti, $keterangan);
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

  public function detail_izin($id_cuti, $keterangan)
  {
    $data['id_cuti'] = $id_cuti;
    $data['keterangan'] = $keterangan;
    $data['level_account'] = $this->session->get('level');
    $data['data_mp_cuti'] = $this->M_ResumeCuti->get_detail_mp_cuti($id_cuti, $keterangan);
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
}
