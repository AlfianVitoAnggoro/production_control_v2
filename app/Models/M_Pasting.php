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
    $query = $this->db->query('SELECT * FROM data_grid');

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
    $query = $this->db->query('SELECT * FROM lhp_pasting');

    return $query->getResultArray();
  }

  public function get_pasting_by_id($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM lhp_pasting WHERE id_lhp_pasting = ' . $id_lhp_pasting);

    return $query->getResultArray();
  }

  public function get_detail_pasting_by_id($id_lhp_pasting)
  {
    $query = $this->db->query('SELECT * FROM detail_lhp_pasting WHERE id_lhp_pasting = ' . $id_lhp_pasting);

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
  
  public function get_data_andon($shift, $tanggal_produksi, $mesin) {
    $nama_mesin = 'Pasting '.$mesin;
    $query = $this->db4->query('SELECT * FROM ticket_produksi1 WHERE tanggal_produksi = \''.$tanggal_produksi.'\' AND shift = \''.$shift.'\' AND seksi_pelapor = \'pasting\' AND kategori_perbaikan = \'DT\' AND nama_mesin = \''.$nama_mesin.'\' ORDER BY nama_mesin ASC');

    return $query->getResultArray();
  }

  function delete_detail_andon($id_lhp_pasting) {
    $builder = $this->db->table('detail_breakdown_andon_pasting');

    $builder->delete(['id_lhp_pasting' => $id_lhp_pasting]);
  }

  function save_detail_andon($data) {
      $builder = $this->db->table('detail_breakdown_andon_pasting');

      $builder->insert($data);
  }

  function get_data_andon_by_id($id_lhp_pasting) {
    $query = $this->db->query('SELECT * FROM detail_breakdown_andon_pasting WHERE id_lhp_pasting = \''.$id_lhp_pasting.'\'');

    return $query->getResultArray();
  }
}
