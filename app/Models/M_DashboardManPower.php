<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DashboardManPower extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect('henkaten');
    // $this->db = \Config\Database::connect('henkaten');

    $this->session = \Config\Services::session();
  }

  // public function get_data_group_man_power($month, $shift, $line)
  // {
  //   if($month !== null && $shift !== null && $line !== null) {
  //     $bulan = date('m', strtotime($month));
  //     $tahun = date('Y', strtotime($month));
  //     $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, mdgmp.line, dmdgmp.mesin
  //                             FROM master_data_man_power mdmp
  //                             JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
  //                             JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.nama = mdmp.id_man_power AND dmdgmp.mesin = dmdmp.mesin
  //                             JOIN master_data_group_man_power mdgmp ON mdgmp.line = dmdmp.line AND mdgmp.id_group = dmdgmp.id_group
  //                             WHERE MONTH(mdgmp.bulan) = \'' . $bulan . '\' AND YEAR(mdgmp.bulan) = \'' . $tahun . '\' AND dmdgmp.shift = \'' . $shift . '\' AND mdgmp.line = \'' . $line . '\'
  //                             ');
  //   } else {
  //     $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, mdgmp.line, dmdgmp.mesin
  //                             FROM master_data_man_power mdmp
  //                             JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
  //                             JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.nama = mdmp.id_man_power AND dmdgmp.mesin = dmdmp.mesin
  //                             JOIN master_data_group_man_power mdgmp ON mdgmp.line = dmdmp.line AND mdgmp.id_group = dmdgmp.id_group
  //                             -- WHERE MONTH(mdgmp.bulan) = 6 AND dmdgmp.shift = 1 AND mdgmp.line = 10
  //                             ');
  //   }

  //   return $query->getResultArray();
  // }

  public function get_data_master_mesin($sub_bagian)
  {
    $query = [];
    if (strcasecmp($sub_bagian, 'amb-1') === 0) {
      for ($i = 1; $i <= 3; $i++) {
        $temp_query = $this->db->query('SELECT * FROM data_master_mesin WHERE line_' . $i . ' > 0 ORDER BY line_' . $i . ' ASC');
        $query = array_merge($temp_query->getResultArray(), $query);
      }
    } else if (strcasecmp($sub_bagian, 'amb-2') === 0) {
      for ($i = 4; $i <= 7; $i++) {
        $temp_query = $this->db->query('SELECT * FROM data_master_mesin WHERE line_' . $i . ' > 0 ORDER BY line_' . $i . ' ASC');
      }
    } else if (strcasecmp($sub_bagian, 'wet-1') === 0) {
      $temp_query = $this->db->query('SELECT * FROM data_master_mesin WHERE wet_a > 0 ORDER BY wet_a ASC');
    } else if (strcasecmp($sub_bagian, 'wet-2') === 0) {
      $temp_query = $this->db->query('SELECT * FROM data_master_mesin WHERE wet_f > 0 ORDER BY wet_f ASC');
    } else {
      $temp_query = $this->db->query('SELECT * FROM data_master_mesin WHERE mcb > 0 ORDER BY mcb ASC');
    }
    return $query;
  }

  public function get_data_mesin($line)
  {
    if ($line <= 7)
      $query = $this->db->query('SELECT * FROM data_master_mesin WHERE line_' . $line . ' > 0 ORDER BY line_' . $line . ' ASC');
    else if ($line == 8)
      $query = $this->db->query('SELECT * FROM data_master_mesin WHERE wet_a > 0 ORDER BY wet_a ASC');
    else if ($line == 9)
      $query = $this->db->query('SELECT * FROM data_master_mesin WHERE wet_f > 0 ORDER BY wet_f ASC');
    else if ($line == 10)
      $query = $this->db->query('SELECT * FROM data_master_mesin WHERE mcb > 0 ORDER BY mcb ASC');

    return $query->getResultArray();
  }

  public function get_data_indirect($sub_bagian)
  {
    $query = $this->db->query('SELECT * FROM data_master_mesin WHERE bag_' . $sub_bagian . ' > 0 ORDER BY bag_' . $sub_bagian . ' ASC');

    return $query->getResultArray();
  }

  public function get_data_group_mesin($sub_bagian)
  {
    $query = $this->db->query('SELECT dmdgmp.mesin, dmdgmp.line, dmdgmp.group_mp, dmdgmp.status
                            FROM detail_master_data_group_man_power dmdgmp
                            JOIN master_data_group_man_power mdgmp ON mdgmp.id_group = dmdgmp.id_group
                            WHERE mdgmp.sub_bagian = \'' . $sub_bagian . '\'
                            ');


    return $query->getResultArray();
  }

  public function get_data_group_man_power($sub_bagian)
  {
    // if(strcasecmp($sub_bagian, 'amb-1') === 0) {
    // $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, mdgmp.line, dmdgmp.mesin
    //                         FROM master_data_man_power mdmp
    //                         JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
    //                         JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.nama = mdmp.id_man_power
    //                         JOIN master_data_group_man_power mdgmp ON mdgmp.line = dmdmp.line AND mdgmp.id_group = dmdgmp.id_group
    // 					              JOIN data_master_mesin dmm ON dmdgmp.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
    //                         WHERE mdgmp.line <= 3
    //                         ');
    // } else if(strcasecmp($sub_bagian, 'amb-2') === 0) {
    // $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, mdgmp.line, dmdgmp.mesin
    //                         FROM master_data_man_power mdmp
    //                         JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
    //                         JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.nama = mdmp.id_man_power
    //                         JOIN master_data_group_man_power mdgmp ON mdgmp.line = dmdmp.line AND mdgmp.id_group = dmdgmp.id_group
    // 					              JOIN data_master_mesin dmm ON dmdgmp.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
    //                         WHERE mdgmp.line >= 4 AND mdgmp.line <= 7
    //                         ');
    // } else if(strcasecmp($sub_bagian, 'wet') === 0) {
    // $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, mdgmp.line, dmdgmp.mesin
    //                         FROM master_data_man_power mdmp
    //                         JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
    //                         JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.nama = mdmp.id_man_power
    //                         JOIN master_data_group_man_power mdgmp ON mdgmp.line = dmdmp.line AND mdgmp.id_group = dmdgmp.id_group
    // 					              JOIN data_master_mesin dmm ON dmdgmp.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
    //                         WHERE mdgmp.line >= 8 AND mdgmp.line <= 9
    //                         ');
    // } else if(strcasecmp($sub_bagian, 'mcb') === 0) {
    // $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, mdgmp.line, dmdgmp.mesin
    //                         FROM master_data_man_power mdmp
    //                         JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
    //                         JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.nama = mdmp.id_man_power
    //                         JOIN master_data_group_man_power mdgmp ON mdgmp.line = dmdmp.line AND mdgmp.id_group = dmdgmp.id_group
    // 					              JOIN data_master_mesin dmm ON dmdgmp.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
    //                         WHERE mdgmp.line = 10
    //                         ');
    // }
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, dmdgmp.mesin, dmdgmp.line, dmdgmp.group_mp, dmdgmp.status
                            FROM master_data_man_power mdmp
                            JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                            JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.nama = mdmp.id_man_power
                            JOIN master_data_group_man_power mdgmp ON mdgmp.id_group = dmdgmp.id_group
                            JOIN data_master_mesin dmm ON dmdgmp.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
                            WHERE mdgmp.sub_bagian = \'' . $sub_bagian . '\'
                            ');


    return $query->getResultArray();
  }

  public function get_data_group_mp($sub_bagian, $line, $group_mp)
  {
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, dmdgmp.mesin, dmdgmp.line, dmdgmp.group_mp, dmdgmp.status
                            FROM master_data_man_power mdmp
                            JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                            JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.nama = mdmp.id_man_power
                            JOIN master_data_group_man_power mdgmp ON mdgmp.id_group = dmdgmp.id_group
                            JOIN data_master_mesin dmm ON dmdgmp.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
                            WHERE mdgmp.sub_bagian = \'' . $sub_bagian . '\' AND dmdgmp.line = \'' . $line . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                            ');


    return $query->getResultArray();
  }

  public function get_data_group_mp_all($sub_bagian)
  {
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, dmdgmp.mesin, dmdgmp.line, dmdgmp.group_mp, dmdgmp.status
                            FROM master_data_man_power mdmp
                            JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                            JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.nama = mdmp.id_man_power
                            JOIN master_data_group_man_power mdgmp ON mdgmp.id_group = dmdgmp.id_group
                            JOIN data_master_mesin dmm ON dmdgmp.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
                            WHERE mdgmp.sub_bagian = \'' . $sub_bagian . '\'
                            ');


    return $query->getResultArray();
  }

  public function get_data_group_mesin_indirect($sub_bagian)
  {
    $query = $this->db->query('SELECT dmdgmpi.mesin, dmdgmpi.group_mp, dmdgmpi.status
                            FROM detail_master_data_group_man_power_indirect dmdgmpi
							              WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'
                            ');
    return array_merge($query->getResultArray());
  }

  public function get_data_group_man_power_indirect($sub_bagian)
  {
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, mdmp.foto, dmdmp.skill, dmdgmpi.mesin, dmdgmpi.group_mp, dmdgmpi.status
                            FROM master_data_man_power mdmp
                            JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                            JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmp.id_man_power
                            JOIN data_master_mesin dmm ON dmdgmpi.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
							              WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'
                            ');
    // WHERE dmdmp.mesin = \'' . $mesin . '\' AND dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'
    $query_non_skill = $this->db->query('SELECT mdmp.nama, mdmp.npk, mdmp.foto, dmdgmpi.mesin, dmdgmpi.group_mp, dmdgmpi.status
                            FROM master_data_man_power mdmp
                            JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmp.id_man_power
                            JOIN data_master_mesin dmm ON dmdgmpi.mesin = dmm.mesin AND dmm.requirement = \'Tidak Baca\'
                            WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'
                            ');
    return array_merge($query->getResultArray(), $query_non_skill->getResultArray());
  }

  public function get_data_group_mp_indirect($sub_bagian, $group_mp, $mesin)
  {
    if (strpos($mesin, 'Improvement') === 0) {
      $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, mdmp.foto, dmdgmpi.mesin, dmdgmpi.group_mp, dmdgmpi.status
                              FROM master_data_man_power mdmp
                              JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmp.id_man_power
                              JOIN data_master_mesin dmm ON dmdgmpi.mesin = dmm.mesin AND \'Tidak Baca\' = dmm.requirement
                              WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\' AND dmdgmpi.group_mp = \'' . $group_mp . '\' AND dmdgmpi.mesin = \'' . $mesin . '\'
                              ');
    } else {
      $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, mdmp.foto, dmdmp.skill, dmdgmpi.mesin, dmdgmpi.group_mp, dmdgmpi.status
                              FROM master_data_man_power mdmp
                              JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                              JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmp.id_man_power
                              JOIN data_master_mesin dmm ON dmdgmpi.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
                              WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\' AND dmdgmpi.group_mp = \'' . $group_mp . '\' AND dmdgmpi.mesin = \'' . $mesin . '\'
                              ');
    }
    return $query->getResultArray();
  }

  // public function get_data_group_mp_all_indirect($sub_bagian)
  // {
  //   if (strpos($mesin, 'Improvement') === 0) {
  //     $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, mdmp.foto, dmdgmpi.mesin, dmdgmpi.group_mp
  //                             FROM master_data_man_power mdmp
  //                             JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmp.id_man_power
  //                             JOIN data_master_mesin dmm ON dmdgmpi.mesin = dmm.mesin AND \'Tidak Baca\' = dmm.requirement
  //                             WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'
  //                             ');
  //   } else {
  //     $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, mdmp.foto, dmdmp.skill, dmdgmpi.mesin, dmdgmpi.group_mp
  //                             FROM master_data_man_power mdmp
  //                             JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
  //                             JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmp.id_man_power
  //                             JOIN data_master_mesin dmm ON dmdgmpi.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
  //                             WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'
  //                             ');
  //   }
  //   return $query->getResultArray();
  // }

  public function get_data_group_man_power_kasubsie($sub_bagian)
  {
    $query = $this->db->query('SELECT mdmpk.nama, mdmpk.npk, mdmpk.foto, dmdgmpi.mesin, dmdgmpi.group_mp, dmdgmpi.status
                            FROM master_data_man_power_kasubsie mdmpk
                            JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmpk.id_man_power
							              WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'
                            ');

    return $query->getResultArray();
  }

  public function get_data_group_mp_kasubsie($sub_bagian, $group_mp, $mesin)
  {
    $query = $this->db->query('SELECT mdmpk.nama, mdmpk.npk, mdmpk.foto, dmdgmpi.mesin, dmdgmpi.group_mp, dmdgmpi.status
                            FROM master_data_man_power_kasubsie mdmpk
                            JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmpk.id_man_power
							              WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\' AND dmdgmpi.group_mp = \'' . $group_mp . '\' AND dmdgmpi.mesin = \'' . $mesin . '\'
                            ');

    return $query->getResultArray();
  }

  public function get_data_group_mp_all_kasubsie($sub_bagian)
  {
    $query = $this->db->query('SELECT mdmpk.nama, mdmpk.npk, mdmpk.foto, dmdgmpi.mesin, dmdgmpi.group_mp, dmdgmpi.status
                            FROM master_data_man_power_kasubsie mdmpk
                            JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmpk.id_man_power
							              WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'
                            ');

    return $query->getResultArray();
  }

  public function get_detail_data_master_group_man_power_by_id($id_group)
  {
    $query = $this->db->query('SELECT * FROM detail_master_data_group_man_power WHERE id_group = \'' . $id_group . '\'');

    return $query->getResultArray();
  }

  public function get_data_group_man_power_by_id($id_group)
  {
    $query = $this->db->query('SELECT mdgmp.line, dmdgmp.* FROM master_data_group_man_power mdgmp
                                JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.id_group = mdgmp.id_group
                              ');

    return $query->getResultArray();
  }

  public function get_data_master_man_power()
  {
    $query = $this->db->query('SELECT nama, npk, id_man_power FROM master_data_man_power ORDER BY nama ASC');
    // $query_gmt = $this->db->query('SELECT nama, npk, id_man_power FROM master_data_man_power_gmt ORDER BY nama ASC');
    // $query = $this->db->query('SELECT * FROM master_data_man_power JOIN detail_master_data_man_power on detail_master_data_man_power.id_man_power = master_data_man_power.id_man_power WHERE detail_master_data_man_power.line = \'' . $line . '\' AND detail_master_data_man_power.mesin = \'' . $mesin . '\'');

    // return array_merge($query->getResultArray(), $query_gmt->getResultArray());
    return array_merge($query->getResultArray());
  }

  public function get_data_master_man_power_kasubsie()
  {
    $query = $this->db->query('SELECT * FROM master_data_man_power_kasubsie');

    return $query->getResultArray();
  }

  public function get_detail_man_power($id_man_power, $requirement)
  {
    if ($requirement !== 'undefined') {
      if ($requirement !== 'Tidak Baca') {
        $query = $this->db->query('SELECT * FROM master_data_man_power mdmp
                                JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                                WHERE mdmp.id_man_power = \'' . $id_man_power . '\' AND dmdmp.mesin = \'' . $requirement . '\'
                                ');
      } else {
        $query = $this->db->query('SELECT * FROM master_data_man_power mdmp
                                WHERE mdmp.id_man_power = \'' . $id_man_power . '\'
                                ');
      }
    } else {
      $query = $this->db->query('SELECT * FROM master_data_man_power_kasubsie
                              WHERE id_man_power = \'' . $id_man_power . '\'
                              ');
    }

    return $query->getResultArray();
  }

  public function get_data_detail_man_power($id_man_power)
  {
    $query = $this->db->query('SELECT * FROM master_data_man_power mdmp
                            -- JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                            WHERE mdmp.id_man_power = \'' . $id_man_power . '\'
                            ');

    return $query->getResultArray();
  }

  public function get_data_mp($npk)
  {
    $query = $this->db->query('SELECT id_man_power FROM master_data_man_power
                            WHERE npk = \'' . $npk . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_data_mp_kasubsie($npk)
  {
    $query = $this->db->query('SELECT id_man_power FROM master_data_man_power_kasubsie
                            WHERE npk = \'' . $npk . '\'
                            ');
    return $query->getResultArray();
  }

  public function save_record_man_power($id_record, $data)
  {
    $query = $this->db->table('detail_record_master_group_man_power');
    if (count($id_record) > 0) {
      $query->where('id_record', $id_record[0]['id_record']);
      $query->update($data);
      return $id_record;
    } else {
      $query->insert($data);
      return $this->db->insertID();
    }
  }

  public function save_record_man_power_indirect($id_record, $data)
  {
    $query = $this->db->table('detail_record_master_group_man_power_indirect');
    if (count($id_record) > 0) {
      $query->where('id_record', $id_record[0]['id_record']);
      $query->update($data);
      return $id_record;
    } else {
      $query->insert($data);
      return $this->db->insertID();
    }
  }

  public function save_record_man_power_tidak_hadir($id_cuti, $data)
  {
    $query = $this->db->table('detail_record_cuti');
    if ($id_cuti !== '') {
      $query->where('id_cuti', $id_cuti);
      $query->update($data);
      return $id_cuti;
    } else {
      $query->insert($data);
      return $this->db->insertID();
    }
  }

  public function save_record_man_power_tidak_hadir_indirect($id_cuti, $data)
  {
    $query = $this->db->table('detail_record_cuti_indirect');
    if ($id_cuti !== '') {
      $query->where('id_cuti', $id_cuti);
      $query->update($data);
      return $id_cuti;
    } else {
      $query->insert($data);
      return $this->db->insertID();
    }
  }

  public function get_daily_record_man_power($sub_bagian, $tanggal, $line, $shift, $mesin)
  {
    $query = $this->db->query('SELECT id_record FROM detail_record_master_group_man_power
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND line = \'' . $line . '\' AND shift = \'' . $shift . '\' AND mesin = \'' . $mesin . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_daily_record_man_power_indirect($sub_bagian, $tanggal, $shift, $mesin)
  {
    $query = $this->db->query('SELECT id_record FROM detail_record_master_group_man_power_indirect
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND shift = \'' . $shift . '\' AND mesin = \'' . $mesin . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_daily_record_man_power_cuti($sub_bagian, $tanggal, $line, $shift)
  {
    $query = $this->db->query('SELECT id_cuti FROM detail_record_cuti
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND line = \'' . $line . '\' AND shift = \'' . $shift . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_data_daily_record_mesin($sub_bagian, $tanggal, $shift)
  {
    $query = $this->db->query('SELECT *
							              FROM detail_record_master_group_man_power
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND shift = \'' . $shift . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_data_daily_record_man_power($sub_bagian, $tanggal, $shift)
  {
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, drmgmp.mesin, drmgmp.line, drmgmp.group_mp, drmgmp.status, drmgmp.status_mesin
                            FROM master_data_man_power mdmp
                            JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
							              JOIN detail_record_master_group_man_power drmgmp ON drmgmp.nama = mdmp.id_man_power
                            JOIN data_master_mesin dmm ON drmgmp.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND shift = \'' . $shift . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_data_daily_record_man_power_indirect_all($sub_bagian, $tanggal, $shift)
  {
    $query = $this->db->query('SELECT nama FROM detail_record_master_group_man_power_indirect
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND shift = \'' . $shift . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_data_daily_record_mesin_indirect($sub_bagian, $tanggal, $shift)
  {
    $query = $this->db->query('SELECT drmgmp.mesin, drmgmp.group_mp, drmgmp.status, drmgmp.status_mesin
							              FROM detail_record_master_group_man_power_indirect drmgmp
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND shift = \'' . $shift . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_data_daily_record_man_power_indirect($sub_bagian, $tanggal, $shift)
  {
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, mdmp.foto, drmgmp.mesin, drmgmp.group_mp, drmgmp.status, drmgmp.status_mesin
                            FROM master_data_man_power mdmp
							              JOIN detail_record_master_group_man_power_indirect drmgmp ON drmgmp.nama = mdmp.id_man_power
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND shift = \'' . $shift . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_data_daily_record_man_power_kasubsie($sub_bagian, $tanggal, $shift)
  {
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, mdmp.foto, drmgmp.mesin, drmgmp.group_mp, drmgmp.status, drmgmp.status_mesin
                            FROM master_data_man_power_kasubsie mdmp
							              JOIN detail_record_master_group_man_power_indirect drmgmp ON drmgmp.nama = mdmp.id_man_power
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND shift = \'' . $shift . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_data_mp_tidak_hadir($sub_bagian, $tanggal, $shift)
  {
    $query = $this->db->query('SELECT DISTINCT mdmp.id_man_power, mdmp.nama, mdmp.npk, drc.keterangan, drc.id_cuti, drc.line
                            FROM master_data_man_power mdmp
                            JOIN detail_record_cuti drc ON drc.nama = mdmp.id_man_power
                            WHERE drc.sub_bagian = \'' . $sub_bagian . '\' AND drc.tanggal = \'' . $tanggal . '\' AND drc.shift = \'' . $shift . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_data_mp_tidak_hadir_indirect($sub_bagian, $tanggal, $shift)
  {
    $query = $this->db->query('SELECT DISTINCT mdmp.id_man_power, mdmp.nama, mdmp.npk, drci.keterangan, drci.id_cuti, drci.line
                            FROM master_data_man_power mdmp
                            JOIN detail_record_cuti_indirect drci ON drci.nama = mdmp.id_man_power
                            WHERE drci.sub_bagian = \'' . $sub_bagian . '\' AND drci.tanggal = \'' . $tanggal . '\' AND drci.shift = \'' . $shift . '\'
                            ');
    return $query->getResultArray();
  }

  public function delete_mp_tidak_hadir($sub_bagian, $tanggal, $shift)
  {
    $this->db->query('DELETE FROM detail_record_cuti
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND shift = \'' . $shift . '\'
                            ');
  }

  public function delete_mp_tidak_hadir_by_id($id_cuti)
  {
    $this->db->query('DELETE FROM detail_record_cuti
                            WHERE id_cuti = \'' . $id_cuti . '\'
                            ');
  }

  public function delete_mp_tidak_hadir_indirect($sub_bagian, $tanggal, $shift)
  {
    $this->db->query('DELETE FROM detail_record_cuti_indirect
                            WHERE sub_bagian = \'' . $sub_bagian . '\' AND tanggal = \'' . $tanggal . '\' AND shift = \'' . $shift . '\'
                            ');
  }

  public function delete_mp_tidak_hadir_indirect_by_id($id_cuti)
  {
    $this->db->query('DELETE FROM detail_record_cuti_indirect
                            WHERE id_cuti = \'' . $id_cuti . '\'
                            ');
  }
}
