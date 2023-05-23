<?php

namespace App\Models;

use CodeIgniter\Model;



class M_Pasting extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect();
    // $this->db2 = \Config\Database::connect('sqlsrv');
    // $this->db3 = \Config\Database::connect('baan');
    $this->db4 = \Config\Database::connect('prod_control');
    $this->db5 = \Config\Database::connect('manajemen_rak');
  }

  // public function test() {
  //     $query = $this->db4->query('SELECT * FROM ticket_assy LIMIT 1');

  //     return $query->getResultArray();
  // }

  // public function getDataWO($tanggal_produksi, $line)
  // {
  //   $tanggal = date('mY', strtotime($tanggal_produksi));
  //   $query = $this->db3->query('
  //                                   SELECT t$prto as rfq,t$prdt as tgl_prod,t$pdno as pdno,t$mitm as mitm,t$cwar as cwar, t$qrdr as qty,t$prcd as line, t$osta as status 
  //                                   FROM baan.ttisfc001777 
  //                                   WHERE (to_number(to_char(t$prdt + (7/24),\'mmyyyy\'))) = ' . $tanggal . ' order by t$pdno asc
  //                               ');
  //   // WHERE t$prcd = '.$line.' and (to_number(to_char(t$prdt + (7/24),\'ddmmyyyy\'))) = '.$tanggal.' and (t$osta = 5 or t$osta = 7) order by t$pdno asc
  //   // WHERE t$prcd = '.$line.' and (to_number(to_char(t$prdt + (7/24),\'ddmmyyyy\'))) = '.$tanggal.' order by t$pdno asc
  //   return $query->getResultArray();
  // }

  public function get_mesin_pasting()
  {
    $query = $this->db->query('SELECT * FROM data_mesin_pasting');

    return $query->getResultArray();
  }

  public function get_grup()
  {
    $query = $this->db->query('SELECT * FROM master_pic_line');

    return $query->getResultArray();
  }

  // public function getPartNo($no_wo)
  // {
  //   $query = $this->db3->query('
  //                                   SELECT t$mitm as mitm, t$qrdr as qty
  //                                   FROM baan.ttisfc001777 
  //                                   WHERE t$pdno = \'' . $no_wo . '\' order by t$pdno asc
  //                               ');

  //   return $query->getResultArray();
  // }

  public function get_data_type_grid()
  {
    $query = $this->db->query('SELECT * FROM data_grid ORDER BY type_grid ASC');

    return $query->getResultArray();
  }

  // public function getCT($part_no)
  // {
  //   // $query = $this->db2->query('
  //   //                             SELECT * FROM cycle_time
  //   //                             JOIN part_number on part_number.id_kode = cycle_time.id_kode
  //   //                             WHERE part_number.part_number = \''.$part_no.'\' ORDER BY cycle_time.id_kode DESC
  //   //                         ');

  //   $partno = "'" . "%" . $part_no . "'";
  //   $query = $this->db->query('
  //           SELECT * FROM master_cycle_time
  //           WHERE part_number LIKE ' . $partno . ' ORDER BY id DESC
  //       ');

  //   return $query->getResultArray();
  // }

  public function getListKategoriLineStopCasting()
  {
    $query = $this->db->query('SELECT DISTINCT kategori_line_stop FROM master_line_stop_pasting_casting');

    return $query->getResultArray();
  }

  public function getListJenisLineStopCasting($kategori_line_stop)
  {
    $query = $this->db->query('SELECT * FROM master_line_stop_pasting_casting WHERE kategori_line_stop = \'' . $kategori_line_stop . '\'');

    return $query->getResultArray();
  }

  public function getListKategoriLineStopPunching()
  {
    $query = $this->db->query('SELECT DISTINCT kategori_line_stop FROM master_line_stop_pasting_punching');

    return $query->getResultArray();
  }

  public function getListJenisLineStopPunching($kategori_line_stop)
  {
    $query = $this->db->query('SELECT * FROM master_line_stop_pasting_punching WHERE kategori_line_stop = \'' . $kategori_line_stop . '\'');

    return $query->getResultArray();
  }

  public function getListReject()
  {
    $query = $this->db->query('SELECT DISTINCT jenis_reject_pasting FROM data_reject_pasting');

    return $query->getResultArray();
  }

  // public function getProsesBreakdown($jenis_breakdown)
  // {
  //   $query = $this->db->query('SELECT * FROM data_breakdown WHERE jenis_breakdown = \'' . $jenis_breakdown . '\'');

  //   return $query->getResultArray();
  // }

  public function getKategoriReject($jenis_reject_pasting)
  {
    $query = $this->db->query('SELECT * FROM data_reject_pasting WHERE jenis_reject_pasting = \'' . $jenis_reject_pasting . '\'');

    return $query->getResultArray();
  }

  public function save_pasting($data)
  {
    $this->db->table('lhp_pasting')->insert($data);

    return $this->db->insertID();
  }

  public function save_detail_pasting($data)
  {
    $builder = $this->db->table('detail_lhp_pasting');
    $builder->insert($data);

    return $this->db->insertID();
  }

  public function save_detail_breakdown($id, $data)
  {
    $builder = $this->db->table('detail_breakdown_lhp_pasting');

    if ($id != '') {
      $builder->where('id_breakdown', $id);
      $builder->update($data);
      return $id;
    } else {
      $builder->insert($data);
      return $this->db->insertID();
    }
  }

  public function save_detail_reject($id, $data)
  {
    $builder = $this->db->table('detail_reject_pasting');

    if ($id != '') {
      $builder->where('id_reject_pasting', $id);
      $builder->update($data);
      return $id;
    } else {
      $builder->insert($data);
      return $this->db->insertID();
    }
  }

  public function get_all_lhp_pasting()
  {
    $query = $this->db->query('SELECT * FROM lhp_pasting ORDER BY tanggal_produksi DESC, shift ASC');

    return $query->getResultArray();
  }

  public function get_pasting_by_id($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM lhp_pasting WHERE id_lhp_pasting = ' . $id_lhp_pasting);

    return $query->getResultArray();
  }

  public function get_detail_pasting_by_id($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM detail_lhp_pasting WHERE id_lhp_pasting = ' . $id_lhp_pasting . ' ORDER BY jam_start ASC, id_detail_lhp_pasting ASC');

    return $query->getResultArray();
  }

  public function update_pasting($id_lhp_pasting, $data)
  {
    $builder = $this->db->table('lhp_pasting');
    $builder->where('id_lhp_pasting', $id_lhp_pasting);
    $builder->update($data);

    return $this->db->affectedRows();
  }

  public function update_detail_pasting($id_detail_lhp_pasting, $data)
  {
    $builder = $this->db->table('detail_lhp_pasting');

    if ($id_detail_lhp_pasting != '') {
      $builder->where('id_detail_lhp_pasting', $id_detail_lhp_pasting);
      $builder->update($data);
      return $id_detail_lhp_pasting;
    } else {
      $builder->insert($data);
      return $this->db->insertID();
    }
  }

  public function add_detail_pasting($data) {
    $builder = $this->db->table('detail_lhp_pasting');
    $builder->insert($data);
    return $this->db->insertID();
  }

  public function get_detail_breakdown_by_id($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM detail_breakdown_lhp_pasting WHERE id_lhp_pasting = ' . $id_lhp_pasting);

    return $query->getResultArray();
  }

  public function delete_detail_line_stop_by_id_breakdown($id_breakdown)
  {
    $query = $this->db->query('DELETE FROM detail_breakdown_lhp_pasting WHERE id_breakdown = ' . $id_breakdown);
    return $query;
  }

  public function delete_detail_line_stop_by_id_lhp($id_lhp_pasting)
  {
    $query = $this->db->query('DELETE FROM detail_breakdown_lhp_pasting WHERE id_lhp_pasting = ' . $id_lhp_pasting);
    return $query;
  }

  public function get_detail_reject_pasting_by_id($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM detail_reject_pasting WHERE id_lhp_pasting = ' . $id_lhp_pasting);

    return $query->getResultArray();
  }

  public function delete_detail_reject_pasting_by_id_reject_pasting($id_reject_pasting)
  {
    $query = $this->db->query('DELETE FROM detail_reject_pasting WHERE id_reject_pasting = ' . $id_reject_pasting);
    return $query;
  }

  public function delete_detail_reject_pasting_by_id_lhp($id_lhp_pasting)
  {
    $query = $this->db->query('DELETE FROM detail_reject_pasting WHERE id_lhp_pasting = ' . $id_lhp_pasting);
    return $query;
  }

  public function get_detail_reject_by_id($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM detail_reject_pasting WHERE id_lhp_pasting = ' . $id_lhp_pasting);

    return $query->getResultArray();
  }

  // public function get_data_andon($tanggal_produksi, $line)
  // {
  //   $query = $this->db4->query('SELECT * FROM ticket_assy WHERE tanggal_produksi = \'' . $tanggal_produksi . '\' AND id_line = \'' . $line . '\'');

  //   return $query->getResultArray();
  // }

  // public function pilih_andon($id_ticket)
  // {
  //   $query = $this->db4->query('SELECT * FROM ticket_assy WHERE id_ticket = ' . $id_ticket);

  //   return $query->getResultArray();
  // }

  public function cek_lhp($tanggal_produksi, $mesin_pasting, $shift, $grup)
  {
    $query = $this->db->query('SELECT * FROM lhp_pasting WHERE tanggal_produksi = \'' . $tanggal_produksi . '\' AND mesin_pasting = \'' . $mesin_pasting . '\' AND shift = \'' . $shift . '\' AND grup = \'' . $grup . '\'');

    return $query->getResultArray();
  }

  public function update_detail_breakdown($id_breakdown, $data)
  {
    $builder = $this->db->table('detail_breakdown_lhp_pasting');

    if ($id_breakdown != '') {
      $builder->where('id_breakdown', $id_breakdown);
      $builder->update($data);
      return $this->db->affectedRows();
    } else {
      $builder->insert($data);
      return $this->db->insertID();
    }
  }

  public function update_detail_reject($id_reject_pasting, $data)
  {
    $builder = $this->db->table('detail_reject_pasting');

    if ($id_reject_pasting != '') {
      $builder->where('id_reject_pasting', $id_reject_pasting);
      $builder->update($data);
      return $this->db->affectedRows();
    } else {
      $builder->insert($data);
      return $this->db->insertID();
    }
  }

  public function get_data_grup_pic($id_grup)
  {
    $query = $this->db->query('SELECT * FROM master_pic_line WHERE id_pic = ' . $id_grup);

    return $query->getResultArray();
  }

  public function get_data_mesin_pasting($id_mesin_pasting)
  {
    $query = $this->db->query('SELECT * FROM data_mesin_pasting WHERE id_mesin_pasting = ' . $id_mesin_pasting);

    return $query->getResultArray();
  }

  public function get_grup_pasting()
  {
    $query = $this->db->query('SELECT DISTINCT nama_grup FROM data_grup_pasting');

    return $query->getResultArray();
  }

  public function hapus_pasting($id)
  {
    $this->db->query('DELETE FROM lhp_pasting WHERE id_lhp_pasting = ' . $id);
    $this->db->query('DELETE FROM detail_lhp_pasting WHERE id_lhp_pasting = ' . $id);
    $this->db->query('DELETE FROM detail_breakdown_lhp_pasting WHERE id_lhp_pasting = ' . $id);
    $this->db->query('DELETE FROM detail_reject_pasting WHERE id_lhp_pasting = ' . $id);
  }

  function get_qty_rak($barcode)
  {
    $query = $this->db5->query('SELECT * FROM data_barcode WHERE t$note = \'' . $barcode . '\'');

    return $query->getResultArray();
  }

  function update_data_master_rak($pn_qr, $data)
  {
    $builder = $this->db5->table('data_master_rak');
    $builder->where('pn_qr', $pn_qr);
    $builder->update($data);
    return $pn_qr;
  }

  // function add_rak($id, $data)
  // {
  //   $builder = $this->db->table('data_record_rak_pasting_in');
  //   // $builder->insert($data);

  //   if ($id != '') {
  //     $builder->where('id', $id);
  //     $builder->update($data);
  //     return $id;
  //   } else {
  //     $builder->insert($data);
  //     return $this->db->insertID();
  //   }
  // }

  // function add_rak_out($id, $data)
  // {
  //   $builder = $this->db->table('data_record_rak_pasting_out');
  //   // $builder->insert($data);

  //   if ($id != '') {
  //     $builder->where('id', $id);
  //     $builder->update($data);
  //     return $id;
  //   } else {
  //     $builder->insert($data);
  //     return $this->db->insertID();
  //   }
  // }

  function cek_detail_record_rak($pn_qr)
  {
    $query = $this->db5->query('SELECT * FROM detail_record_rak WHERE pn_qr = \'' . $pn_qr . '\' AND status = \'open\'');
    $id_log_detail_record_rak = $query->getResultArray();
    // return $builder->getResultArray();
    return $id_log_detail_record_rak;
  }

  function cek_detail_record_rak_out($pn_qr, $barcode)
  {
    $query = $this->db5->query('SELECT MAX(id_log) as id_log FROM detail_record_rak WHERE pn_qr = \'' . $pn_qr . '\' AND barcode = \'' . $barcode . '\' AND status = \'close\'');
    $id_log_detail_record_rak = $query->getResultArray();
    // return $builder->getResultArray();
    return $id_log_detail_record_rak[0]['id_log'];
  }

  // function cek_data_master_rak($pn_qr, $status)
  // {
  //   $query = $this->db5->query('SELECT id_log FROM detail_record_rak WHERE pn_qr = \'' . $pn_qr . '\' AND status = \'' . $status . '\'');
  //   $id_log_detail_record_rak = $query->getResultArray();
  //   if (count($id_log_detail_record_rak) === 0) {
  //     $data = [
  //       'status' => 0
  //     ];
  //   } else {
  //     $data = [
  //       'status' => 1
  //     ];
  //   }
  //   $builder = $this->db5->table('data_master_rak');
  //   $builder->where('pn_qr', $pn_qr);
  //   $builder->update($data);
  //   // return $builder->getResultArray();
  //   return $query->getResultArray();
  // }

  // function update_detail_record_rak_by_id($id_log, $data)
  // {
  //   $builder = $this->db5->table('detail_record_rak');
  //   $builder->where('id_log', $id_log);
  //   $builder->update($data);
  // }

  function delete_detail_record_rak_by_id($id_log)
  {
    $builder = $this->db5->table('detail_record_rak');
    $builder->delete(['id_log' => $id_log]);
  }

  function delete_detail_barcode_rak($barcode)
  {
    $query = $this->db5->query('SELECT MAX(id) as id FROM detail_barcode_rak WHERE barcode = \'' . $barcode . '\'');
    $id_detail_barcode_rak = $query->getResultArray();

    $builder = $this->db5->table('detail_barcode_rak');
    $builder->delete(['id' => $id_detail_barcode_rak[0]['id']]);

    return $id_detail_barcode_rak[0]['id'];
  }

  function add_detail_barcode_rak($data)
  {
    $builder = $this->db5->table('detail_barcode_rak');
    $builder->insert($data);
    return $this->db5->insertID();
  }

  function add_detail_record_rak($data)
  {
    $builder = $this->db5->table('detail_record_rak');
    $builder->insert($data);
    return $this->db5->insertID();
  }

  function update_detail_record_rak($pn_qr, $data)
  {
    $builder = $this->db5->table('detail_record_rak');
    $builder->where('pn_qr', $pn_qr);
    $builder->update($data);
    // return $builder->getResultArray();
    return $pn_qr;
  }

  function get_data_rak_in_by_id($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM data_record_rak_pasting_in WHERE id_lhp_pasting = \'' . $id_lhp_pasting . '\'');

    return $query->getResultArray();
  }

  function get_data_detail_record_rak_by_id_rak_in($id_lhp_pasting, $wh_from)
  {
    $query = $this->db5->query('SELECT * FROM detail_record_rak WHERE id_lhp_wh_end = \'' . $id_lhp_pasting . '\' AND wh_from = \'' . $wh_from . '\'');

    return $query->getResultArray();
  }

  function get_data_detail_record_rak_by_id_rak_out($id_lhp_pasting, $wh_from)
  {
    $query = $this->db5->query('SELECT * FROM detail_record_rak WHERE id_lhp_wh_start = \'' . $id_lhp_pasting . '\' AND wh_from = \'' . $wh_from . '\'');

    return $query->getResultArray();
  }

  function get_data_rak_out_by_id($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM data_record_rak_pasting_out WHERE id_lhp_pasting = \'' . $id_lhp_pasting . '\'');

    return $query->getResultArray();
  }

  // function delete_rak($id_lhp_pasting)
  // {
  //   $builder = $this->db->table('data_record_rak_pasting_in');

  //   $builder->delete(['id' => $id_lhp_pasting]);
  // }

  // function delete_rak_out($id_lhp_pasting)
  // {
  //   $builder = $this->db->table('data_record_rak_pasting_out');

  //   $builder->delete(['id' => $id_lhp_pasting]);
  // }

  public function get_data_andon($shift, $tanggal_produksi, $mesin)
  {
    $nama_mesin = 'Pasting ' . $mesin;
    $query = $this->db4->query('SELECT * FROM ticket_produksi1 WHERE tanggal_produksi = \'' . $tanggal_produksi . '\' AND shift = \'' . $shift . '\' AND seksi_pelapor = \'pasting\' AND kategori_perbaikan = \'DT\' AND nama_mesin = \'' . $nama_mesin . '\' ORDER BY nama_mesin ASC');

    return $query->getResultArray();
  }

  function delete_detail_andon($id_lhp_pasting)
  {
    $builder = $this->db->table('detail_breakdown_andon_pasting');

    $builder->delete(['id_lhp_pasting' => $id_lhp_pasting]);
  }

  function save_detail_andon($data)
  {
    $builder = $this->db->table('detail_breakdown_andon_pasting');

    $builder->insert($data);
  }

  function get_data_andon_by_id($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM detail_breakdown_andon_pasting WHERE id_lhp_pasting = \'' . $id_lhp_pasting . '\'');

    return $query->getResultArray();
  }

  function delete_rows($id) {
    $builder = $this->db->table('detail_lhp_pasting');

    $builder->delete(['id_detail_lhp_pasting' => $id]);
  }

  function get_summary_total_aktual_per_type($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT type_grid, SUM(actual) AS actual
                                FROM detail_lhp_pasting
                                WHERE id_lhp_pasting = \'' . $id_lhp_pasting . '\'
                                AND type_grid != \'\'
                                GROUP BY type_grid');

    return $query->getResultArray();
  }

  function get_summary_note($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM detail_lhp_pasting_note WHERE id_lhp_pasting = \'' . $id_lhp_pasting . '\'');

    return $query->getResultArray();
  }

  function add_note_pasting($id, $data) {
    $builder = $this->db->table('detail_lhp_pasting_note');

    if ($id != '') {
      $builder->where('id_detail_lhp_pasting_note', $id);
      $builder->update($data);
      return $this->db->affectedRows();
    } else {
      $builder->insert($data);
      return $this->db->insertID();
    }
  }
}
