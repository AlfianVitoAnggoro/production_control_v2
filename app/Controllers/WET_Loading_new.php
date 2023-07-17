<?php

namespace App\Controllers;

use App\Models\M_WET_Loading_new;
use App\Models\M_SupplyCharging;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class WET_Loading_new extends BaseController
{
  public function __construct()
  {
    $this->M_WET_Loading_new = new M_WET_Loading_new();
    $this->M_SupplyCharging = new M_SupplyCharging();
    $this->session = \Config\Services::session();

    if ($this->session->get('is_login')) {
      return redirect()->to('login');
    }

    date_default_timezone_set("Asia/Jakarta");
  }

  public function wet_view()
  {
    $data['data_lhp'] = $this->M_WET_Loading_new->get_all_lhp_wet();
    $data['data_line'] = $this->M_WET_Loading_new->get_line();
    $data['data_grup'] = $this->M_WET_Loading_new->get_grup();
    return view('pages/wet_loading/wet_view_new', $data);
  }

  public function add_lhp() {
    $tanggal_produksi = $this->request->getPost('tanggal_produksi');
    $line = $this->request->getPost('line');
    $shift = $this->request->getPost('shift');
    $grup = $this->request->getPost('grup');
    $mp = $this->request->getPost('mp');
    $absen = $this->request->getPost('absen');
    $cuti = $this->request->getPost('cuti');
    $kasubsie = $this->request->getPost('kasubsie');

    $data_lhp = [
        'tanggal_produksi' => $tanggal_produksi,
        'line' => $line,
        'shift' => $shift,
        'grup' => $grup,
        'mp' => $mp,
        'absen' => $absen,
        'cuti' => $cuti,
        'kasubsie' => $kasubsie
    ];

    $cek = $this->M_WET_Loading_new->cek_lhp($tanggal_produksi, $line, $shift, $grup);
    if (count($cek) > 0) {
        $id_lhp = $cek[0]['id_lhp_wet_loading'];
        
        return redirect()->to(base_url('wet_loading_new/detail_lhp/'.$id_lhp));
    } else {
        $save_data = $this->M_WET_Loading_new->save_lhp($data_lhp);

        return redirect()->to(base_url('wet_loading_new/detail_lhp/'.$save_data));
    }
  }

    public function get_proses_breakdown()
    {
        $jenis_breakdown = $this->request->getPost('jenis_breakdown');

        $model = new M_Data();
        echo json_encode($model->getProsesBreakdown($jenis_breakdown));

    }

    public function get_kategori_reject()
    {
        $jenis_reject = $this->request->getPost('jenis_reject');

        $model = new M_Data();
        echo json_encode($model->getKategoriReject($jenis_reject));
    }

    public function detail_lhp($id)
    {
        $data['id_lhp'] = $id;
        $data['data_lhp'] = $this->M_WET_Loading_new->get_lhp_by_id($id);
        $data['data_detail_lhp'] = $this->M_WET_Loading_new->get_detail_lhp_by_id($id);
        $data['data_detail_breakdown'] = $this->M_WET_Loading_new->get_detail_breakdown_by_id($id);
        $data['data_detail_reject'] = $this->M_WET_Loading_new->get_detail_reject_by_id($id);
        $data['data_detail_pending'] = $this->M_WET_Loading_new->get_detail_pending_by_id($id);


        $data['data_line'] = $this->M_WET_Loading_new->get_data_line($data['data_lhp'][0]['line']);
        $data['data_grup'] = $this->M_WET_Loading_new->get_data_grup_pic($data['data_lhp'][0]['grup']);

        $data['data_all_line'] = $this->M_WET_Loading_new->get_line();
        $data['data_all_grup'] = $this->M_WET_Loading_new->get_grup();

        $data['total_menit_breakdown'] = $this->M_WET_Loading_new->get_total_menit_breakdown($id);
        $data['total_pending'] = $this->M_WET_Loading_new->get_total_pending($id);


        $data['data_jenis_battery'] = $this->M_WET_Loading_new->get_jenis_battery();
        $data['data_series_battery'] = $this->M_WET_Loading_new->get_series_battery();
        $data['data_type_battery'] = $this->M_WET_Loading_new->get_all_type_battery();

        if($data['data_lhp'][0]['line'] <= 7) {
            $data['data_breakdown'] = $this->M_WET_Loading_new->getListBreakdown('AMB');
            $data['data_reject'] = $this->M_WET_Loading_new->getListReject('AMB');
        } else if($data['data_lhp'][0]['line'] > 7 && $data['data_lhp'][0]['line'] < 10) {
            $data['data_breakdown'] = $this->M_WET_Loading_new->getListBreakdown('WET');
            $data['data_reject'] = $this->M_WET_Loading_new->getListReject('WET');
            $data['data_pending'] = $this->M_WET_Loading_new->get_pending();
        } else {
            $data['data_breakdown'] = $this->M_WET_Loading_new->getListBreakdown('MCB');
            $data['data_reject'] = $this->M_WET_Loading_new->getListReject('AMB');
        }
        return view('pages/wet_loading/lhp_detail_view_new', $data);
    }

    public function get_series()
    {
        $id_jenis = $this->request->getPost('id_jenis');

        $data = $this->M_WET_Loading_new->get_series($id_jenis);

        echo json_encode($data);
    }

    public function get_type_battery()
    {
        $series = $this->request->getPost('series');

        $data = $this->M_WET_Loading_new->get_type_battery($series);

        echo json_encode($data);
    }

    public function get_ct()
    {
        $series = $this->request->getPost('series');
        $line = $this->request->getPost('line');

        $data = $this->M_WET_Loading_new->get_ct($series, $line);

        echo json_encode($data);
    }

    public function update_lhp()
    {
        date_default_timezone_set("Asia/Jakarta");
        
        $id_lhp = $this->request->getPost('id_lhp');

        $data_lhp = [
            'tanggal_produksi' => $this->request->getPost('tanggal_produksi'),
            'line' => $this->request->getPost('line'),
            'shift' => $this->request->getPost('shift'),
            'grup' => $this->request->getPost('grup'),
            'mp' => $this->request->getPost('mp'),
            'absen' => $this->request->getPost('absen'),
            'cuti' => $this->request->getPost('cuti'),
            'kasubsie' => $this->request->getPost('kasubsie')
        ];

        $update_data = $this->M_WET_Loading_new->update_lhp($id_lhp, $data_lhp);
        
        $total_plan = 0;
        $total_actual = 0;
        $total_detail_line_stop = 0;
        $total_reject = 0;
        $total_pending = 0;
        $total_line_stop = 0;

        if ( $this->request->getPost('shift') == 1) {
            $loading_time = 440;
        } elseif ( $this->request->getPost('shift') == 2) {
            $loading_time = 410;
        } elseif ( $this->request->getPost('shift') == 3) {
            $loading_time = 370;
        }

        if ($update_data > 0) {
            if (!empty($this->request->getPost('no_wo') && !empty($this->request->getPost('type_battery')))) {
                $total_data = count($this->request->getPost('no_wo'));
                for ($i = 0; $i < $total_data; $i++) {
                    if ($this->request->getPost('no_wo')[$i] != '') {
                        $id_detail_lhp = $this->request->getPost('id_detail_lhp')[$i];
                        $data_detail_lhp = [
                            'id_lhp_wet_loading' => $id_lhp,
                            'batch' => $this->request->getPost('batch')[$i],
                            'jam_start' => (!empty($this->request->getPost('start')[$i])) ? $this->request->getPost('start')[$i] : null,
                            'jam_end' => (!empty($this->request->getPost('stop')[$i])) ? $this->request->getPost('stop')[$i] : null,
                            'menit_terpakai' => (!empty($this->request->getPost('menit_terpakai')[$i])) ? $this->request->getPost('menit_terpakai')[$i] : null,
                            'no_wo' => $this->request->getPost('no_wo')[$i],
                            'type_battery' => $this->request->getPost('type_battery')[$i],
                            'ct' => $this->request->getPost('ct')[$i],
                            'plan_cap' => (!empty($this->request->getPost('plan_cap')[$i])) ? $this->request->getPost('plan_cap')[$i] : null,
                            'actual' => $this->request->getPost('actual')[$i],
                            'total_menit_breakdown' => (!empty($this->request->getPost('total_menit_breakdown')[$i])) ? $this->request->getPost('total_menit_breakdown')[$i] : null
                        ];

                        if ($this->request->getPost('actual')[$i] != null) {
                            $total_actual += $this->request->getPost('actual')[$i];
                        }

                        if (!empty($this->request->getPost('total_menit_breakdown')[$i]) && $this->request->getPost('total_menit_breakdown')[$i] != null) {
                            $total_line_stop += $this->request->getPost('total_menit_breakdown')[$i];
                        }

                        $update_detail = $this->M_WET_Loading_new->update_detail_lhp($id_detail_lhp, $data_detail_lhp);

                        $waktu_estimasi_finish = date('H:i:s', strtotime($this->request->getPost('estimasi_finish')[$i]));

                        if ($waktu_estimasi_finish > '06:00:00' && $waktu_estimasi_finish <= '09:00:00') {
                            $sesi = 1;
                        } elseif ($waktu_estimasi_finish > '09:00:00' && $waktu_estimasi_finish <= '11:00:00') {
                            $sesi = 2;
                        } elseif ($waktu_estimasi_finish > '11:00:00' && $waktu_estimasi_finish <= '14:00:00') {
                            $sesi = 3;
                        } elseif ($waktu_estimasi_finish > '14:00:00' && $waktu_estimasi_finish <= '16:00:00') {
                            $sesi = 4;
                        } elseif ($waktu_estimasi_finish > '16:00:00' && $waktu_estimasi_finish <= '18:00:00') {
                            $sesi = 5;
                        } elseif ($waktu_estimasi_finish > '18:00:00' && $waktu_estimasi_finish <= '21:00:00') {
                            $sesi = 6;
                        } elseif ($waktu_estimasi_finish > '21:00:00' && $waktu_estimasi_finish <= '23:00:00') {
                            $sesi = 7;
                        } elseif ($waktu_estimasi_finish > '23:00:00' && $waktu_estimasi_finish <= '23:59:59') {
                            $sesi = 8;
                        } elseif ($waktu_estimasi_finish > '00:00:00' && $waktu_estimasi_finish <= '02:00:00') {
                            $sesi = 8;
                        } elseif ($waktu_estimasi_finish > '02:00:00' && $waktu_estimasi_finish <= '05:00:00') {
                            $sesi = 9;
                        } elseif ($waktu_estimasi_finish > '05:00:00' && $waktu_estimasi_finish <= '06:00:00') {
                            $sesi = 10;
                        }

                        $data_supply_charging = [
                            'id_lhp ' => $id_lhp,
                            'no_wo' => $this->request->getPost('no_wo')[$i],
                            'part_number' => $this->request->getPost('type_battery')[$i],
                            'start_charging' => date('Y-m-d H:i:s'),
                            'estimasi_finish' => date('Y-m-d H:i:s', strtotime($this->request->getPost('estimasi_finish')[$i])),
                            'sesi' => $sesi,
                            'tujuan' => $this->request->getPost('line'),
                            'qty' => $this->request->getPost('actual')[$i],
                            'status' => 'open',
                        ];
                        
                        $add_data_supply_charging = $this->M_SupplyCharging->add_data_supply_charging($this->request->getPost('no_wo')[$i], $data_supply_charging);
                    }
                }
            }
        }

        $total_data_breakdown = $this->request->getPost('no_wo_breakdown');
        if (!empty($total_data_breakdown)) {
            for ($i=0; $i < count($total_data_breakdown); $i++) { 
                if ($this->request->getPost('jenis_breakdown')[$i] == 'ANDON') {
                    $string_ticket = $this->request->getPost('proses_breakdown')[$i];
                    $arr = explode("-", $string_ticket);
                    $ticket = $arr[0];
                    if ($arr[2] == 'DANDORI' OR $arr[2] == 'DT' OR $arr[2] == 'NDT') {
                        $kategori_andon = $arr[2];
                    } else {
                        $kategori_andon = '';
                    }
                    $proses_breakdown = implode('-', array_slice($arr, 2));
                } else {
                    $ticket = '';
                    $kategori_andon = '';
                    $proses_breakdown = $this->request->getPost('proses_breakdown')[$i];
                }

                $id_breakdown = $this->request->getPost('id_breakdown')[$i];

                $data_detail_breakdown = [
                    'id_lhp_wet_loading' => $id_lhp,
                    'jam_start' => $this->request->getPost('start_breakdown')[$i],
                    'jam_end' => $this->request->getPost('stop_breakdown')[$i],
                    'no_wo' => $this->request->getPost('no_wo_breakdown')[$i],
                    'type_battery' => $this->request->getPost('type_battery_breakdown')[$i],
                    'jenis_breakdown' => $this->request->getPost('jenis_breakdown')[$i],
                    'tiket_andon' => $ticket,
                    'kategori_andon' => $kategori_andon,
                    'proses_breakdown' => $this->request->getPost('proses_breakdown')[$i],
                    'uraian_breakdown' => $this->request->getPost('uraian_breakdown')[$i],
                    'menit_breakdown' => $this->request->getPost('menit_breakdown')[$i]
                ];

                if ($this->request->getPost('menit_breakdown')[$i] != '') {
                    $total_detail_line_stop += (int) $this->request->getPost('menit_breakdown')[$i];
                }
    
                $this->M_WET_Loading_new->save_detail_breakdown($id_breakdown, $data_detail_breakdown);
            } 
        }

        $total_data_reject = $this->request->getPost('no_wo_reject');

        if (!empty($total_data_reject)) {
            for ($i=0; $i < count($total_data_reject); $i++) { 
                $id_reject = $this->request->getPost('id_reject')[$i];

                $data_detail_reject = [
                    'id_lhp_wet_loading' => $id_lhp,
                    'series_battery' => $this->request->getPost('series_reject')[$i],
                    'type_battery' => $this->request->getPost('type_battery_reject')[$i],
                    'jenis_battery' => $this->request->getPost('jenis_battery_reject')[$i],
                    'qty_reject' => $this->request->getPost('qty_reject')[$i],
                    'jenis_reject' => $this->request->getPost('jenis_reject')[$i],
                    'kategori_reject' => $this->request->getPost('kategori_reject')[$i],
                    'remark_reject' => $this->request->getPost('remark_reject')[$i]
                ];

                $total_reject += $this->request->getPost('qty_reject')[$i];
    
                $this->M_WET_Loading_new->save_detail_reject($id_reject, $data_detail_reject);
            }
        }

        $data_detail = [
            'total_plan' => $total_plan,
            'total_aktual' => $total_actual,
            'total_line_stop' => $total_line_stop,
            'total_reject' => $total_reject,
            'loading_time' => $loading_time
        ];

        $this->M_WET_Loading_new->update_lhp($id_lhp, $data_detail);

        $total_data_pending = $this->request->getPost('no_wo_pending');

        if (!empty($total_data_pending)) {
            for ($i=0; $i < count($total_data_pending); $i++) { 
                $id_pending = $this->request->getPost('id_pending')[$i];

                $data_detail_pending = [
                    'id_lhp_wet_loading' => $id_lhp,
                    'no_wo' => $this->request->getPost('no_wo_pending')[$i],
                    'type_battery' => $this->request->getPost('type_battery_pending')[$i],
                    'jenis_pending' => $this->request->getPost('jenis_pending')[$i],
                    'kategori_pending' => $this->request->getPost('kategori_pending')[$i],
                    'qty_pending' => $this->request->getPost('qty_pending')[$i],
                ];

                $total_pending += $this->request->getPost('qty_pending')[$i];
    
                $this->M_WET_Loading_new->save_detail_pending($id_pending, $data_detail_pending);
            }
        }

        return redirect()->to(base_url('wet_loading_new/detail_lhp/'.$id_lhp));
    }

    public function hapus_lhp($id_lhp)
    {
        
        $this->M_WET_Loading_new->hapus_lhp($id_lhp);

        return redirect()->to(base_url('wet_loading_new'));
    }

    public function delete_line_stop($id_line_stop, $id_lhp)
    {
        $this->M_WET_Loading_new->delete_line_stop($id_line_stop);

        return redirect()->to(base_url('wet_loading_new/detail_lhp/'.$id_lhp));
    }

    public function delete_reject($id_reject, $id_lhp)
    {
        $this->M_WET_Loading_new->delete_reject($id_reject);

        return redirect()->to(base_url('wet_loading_new/detail_lhp/'.$id_lhp));
    }

    public function download()
    {
        // $date = $this->request->getPost('date');
        $start_date = $this->request->getPost('start_date');
        $end_date = $this->request->getPost('end_date');
        // $month = date('F_Y', strtotime($date));
        $model = new M_WET();

        //data sheet lhp
        $data_lhp = $model->get_all_lhp_by_date($start_date, $end_date);
        // $data_lhp = $model->get_all_lhp_by_month($date);
        if($data_lhp !== NULL) {
            $dates = array_column($data_lhp, "tanggal_produksi");
            $lines = array_column($data_lhp, "line");
            $shift = array_column($data_lhp, "shift");
            array_multisort($dates, SORT_ASC, $shift, SORT_ASC, $lines, SORT_ASC,  $data_lhp);
            $data_detail_lhp = [];
            foreach ($data_lhp as $dl) {
                $temp = $model->get_all_detail_lhp_by_id_lhp($dl['id_lhp_2']);
                if($temp !== NULL) {
                    foreach ($temp as $t) {
                        array_push($data_detail_lhp, $t);
                    }
                }
            }
        }
        // dd($fix_data_detail_lhp);
        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();

        // Menambahkan data ke worksheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('LHP');
        $data = array(
            array('Date', 'Shift', 'Line', 'PIC', 'Kasubsie', 'Jam Start', 'Jam End', 'Menit Terpakai', 'No WO', 'Type Battery', 'CT', 'Plan Cap', 'Actual', 'Total Menit Line Stop'),
        );
        $isExist = [];
        if($data_lhp !== NULL) {
            foreach ($data_lhp as $dl) {
                foreach ($data_detail_lhp as $ddl) {
                    // if($ddl !== NULL) {
                    //     foreach ($ddl as $dt_ddl) {
                            if ($dl['id_lhp_2'] === $ddl['id_lhp_2']) {
                                $data[] = array($dl['tanggal_produksi'], $dl['shift'], $dl['line'], $dl['nama_pic'], $dl['kasubsie'], $ddl['jam_start'], $ddl['jam_end'], $ddl['menit_terpakai'], $ddl['no_wo'], $ddl['type_battery'], $ddl['ct'], $ddl['plan_cap'], $ddl['actual'], $ddl['total_menit_breakdown']);
                            };
                    //     }
                    // } else {
                    //     $data[] = array($dl['tanggal_produksi'], $dl['shift'], $dl['line'], $dl['nama_pic'], $dl['kasubsie']);
                    // }
                }
            }
        }

        // Memasukkan data array ke dalam worksheet
        $sheet->fromArray($data);

        //data sheet line stop
        foreach ($data_lhp as $dl) {
            $data_detail_line_stop[] = $model->get_detail_breakdown_by_id($dl['id_lhp_2']);
        }

        // Menambahkan data ke worksheet
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Line Stop');   

        $data_line_stop = array(
            array('Date', 'Shift', 'Line', 'PIC', 'Kasubsie', 'Jam Start', 'Jam End', 'Menit Terpakai', 'No WO', 'Type Battery', 'Jenis Breakdown', 'Tiket Andon', 'Proses Breakdown', 'Uraian Breakdown', 'Menit Breakdown'),
        );
        $isExist = [];
        if($data_lhp !== NULL) {
            foreach ($data_lhp as $dl) {
                foreach ($data_detail_line_stop as $ddls) {
                    if($ddls !== NULL) {
                        foreach ($ddls as $dt_ddls) {
                            if ($dl['id_lhp_2'] === $dt_ddls['id_lhp']) {
                                $data_line_stop[] = array($dl['tanggal_produksi'], $dl['shift'], $dl['line'], $dl['nama_pic'], $dl['kasubsie'], $dt_ddls['jam_start'], $dt_ddls['jam_end'], $dt_ddls['menit_terpakai'], $dt_ddls['no_wo'], $dt_ddls['type_battery'], $dt_ddls['jenis_breakdown'], $dt_ddls['tiket_andon'], $dt_ddls['proses_breakdown'], $dt_ddls['uraian_breakdown'], $dt_ddls['menit_breakdown']);
                            };
                        }
                    } else {
                        $data_line_stop[] = array($dl['tanggal_produksi'], $dl['shift'], $dl['line'], $dl['nama_pic'], $dl['kasubsie']);
                    }
                }
            }
        }

        // Memasukkan data array ke dalam worksheet
        $sheet2->fromArray($data_line_stop);

        //data sheet reject
        foreach ($data_lhp as $dl) {
            $data_detail_reject[] = $model->get_detail_reject_by_id($dl['id_lhp_2']);
        }

        // Menambahkan data ke worksheet
        $sheet3 = $spreadsheet->createSheet();
        $sheet3->setTitle('Reject');   

        $data_reject = array(
            array('Date', 'Shift', 'Line', 'PIC', 'Kasubsie', 'No WO', 'Type Battery', 'QTY Reject', 'Jenis Reject', 'Kategori Reject', 'Remark Reject'),
        );
        $isExist = [];
        if($data_lhp !== NULL) {
            foreach ($data_lhp as $dl) {
                foreach ($data_detail_reject as $ddj) {
                    if($ddj !== NULL) {
                        foreach ($ddj as $dt_ddj) {
                            if ($dl['id_lhp_2'] === $dt_ddj['id_lhp']) {
                                $data_reject[] = array($dl['tanggal_produksi'], $dl['shift'], $dl['line'], $dl['nama_pic'], $dl['kasubsie'], $dt_ddj['no_wo'], $dt_ddj['type_battery'], $dt_ddj['qty_reject'], $dt_ddj['jenis_reject'], $dt_ddj['kategori_reject'], $dt_ddj['remark_reject']);
                            };
                        }
                    } else {
                        $data_reject[] = array($dl['tanggal_produksi'], $dl['shift'], $dl['line'], $dl['nama_pic'], $dl['kasubsie']);
                    }
                }
            }
        }

        // Memasukkan data array ke dalam worksheet
        $sheet3->fromArray($data_reject);


        // Mengatur header respons HTTP
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Data LHP WET.xlsx"');
        header('Cache-Control: max-age=0');

        ob_end_clean();
        // Membuat objek Writer untuk menulis spreadsheet ke output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

    public function get_part_number() {
        $barc = $this->request->getPost('barcode');

        $data = $this->M_WET_Loading_new->get_part_number($barc);

        echo json_encode($data);
    }

    public function get_ct_part_number() {
        $part_number = $this->request->getPost('part_number');
        $line = $this->request->getPost('line');

        $data = $this->M_WET_Loading_new->get_ct_part_number($part_number, $line);

        echo json_encode($data);
    }

    public function get_part_number_charging() {
        $part_number = $this->request->getPost('part_number');

        $data = $this->M_WET_Loading_new->get_part_number_charging($part_number);

        echo json_encode($data);
    }

    public function get_wo_charging() {
        $part_number = $this->request->getPost('part_number');

        $data = $this->M_WET_Loading_new->get_wo_charging($part_number);

        echo json_encode($data);
    }

    public function get_durasi_charging() {
        $part_number = $this->request->getPost('part_number');
        $line = $this->request->getPost('line');

        $data = $this->M_WET_Loading_new->get_durasi_charging($part_number, $line);

        echo json_encode($data);
    }
}
