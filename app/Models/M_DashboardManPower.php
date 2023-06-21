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
    if(strcasecmp($sub_bagian, 'amb-1') === 0) {
      for ($i=1; $i <= 3; $i++) { 
        $temp_query = $this->db->query('SELECT * FROM data_master_mesin WHERE line_' . $i . ' > 0 ORDER BY line_' . $i . ' ASC');
        $query = array_merge($temp_query->getResultArray(), $query);
      }
    } else if(strcasecmp($sub_bagian, 'amb-2') === 0) {
      for ($i=4; $i <= 7; $i++) { 
        $temp_query = $this->db->query('SELECT * FROM data_master_mesin WHERE line_' . $i . ' > 0 ORDER BY line_' . $i . ' ASC');
      }
    } else if(strcasecmp($sub_bagian, 'wet-1') === 0) {
      $temp_query = $this->db->query('SELECT * FROM data_master_mesin WHERE wet_a > 0 ORDER BY wet_a ASC');
    } else if(strcasecmp($sub_bagian, 'wet-2') === 0) {
      $temp_query = $this->db->query('SELECT * FROM data_master_mesin WHERE wet_f > 0 ORDER BY wet_f ASC');
    } else {
      $temp_query = $this->db->query('SELECT * FROM data_master_mesin WHERE mcb > 0 ORDER BY mcb ASC');
    }
    return $query;
  }

  public function get_data_mesin($line)
  {
    if($line <= 7)
      $query = $this->db->query('SELECT * FROM data_master_mesin WHERE line_' . $line . ' > 0 ORDER BY line_' . $line . ' ASC');
    else if($line === 8)
      $query = $this->db->query('SELECT * FROM data_master_mesin WHERE wet_a > 0 ORDER BY wet_a ASC');
    else if($line === 9)
      $query = $this->db->query('SELECT * FROM data_master_mesin WHERE wet_f > 0 ORDER BY wet_f ASC');
    else if($line === 10)
      $query = $this->db->query('SELECT * FROM data_master_mesin WHERE mcb > 0 ORDER BY mcb ASC');

    return $query->getResultArray();
  }

  public function get_data_indirect($sub_bagian)
  {
    $query = $this->db->query('SELECT * FROM data_master_mesin WHERE bag_' . $sub_bagian . ' > 0 ORDER BY bag_' . $sub_bagian . ' ASC');

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
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, dmdgmp.mesin, dmdgmp.line, dmdgmp.group_mp
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
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, dmdmp.skill, mdmp.foto, dmdgmp.mesin, dmdgmp.line, dmdgmp.group_mp
                            FROM master_data_man_power mdmp
                            JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                            JOIN detail_master_data_group_man_power dmdgmp ON dmdgmp.nama = mdmp.id_man_power
                            JOIN master_data_group_man_power mdgmp ON mdgmp.id_group = dmdgmp.id_group
                            JOIN data_master_mesin dmm ON dmdgmp.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
                            WHERE mdgmp.sub_bagian = \'' . $sub_bagian . '\' AND dmdgmp.line = \'' . $line . '\' AND dmdgmp.group_mp = \'' . $group_mp . '\'
                            ');
    

    return $query->getResultArray();
  }

  public function get_data_group_man_power_indirect($sub_bagian)
  {
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, mdmp.foto, dmdmp.skill, dmdgmpi.mesin, dmdgmpi.group_mp
                            FROM master_data_man_power mdmp
                            JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                            JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmp.id_man_power
                            JOIN data_master_mesin dmm ON dmdgmpi.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
							              WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'
                            ');
							              // WHERE dmdmp.mesin = \'' . $mesin . '\' AND dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'

    return $query->getResultArray();
  }

  public function get_data_group_mp_indirect($sub_bagian, $group_mp)
  {
    $query = $this->db->query('SELECT mdmp.nama, mdmp.npk, mdmp.foto, dmdmp.skill, dmdgmpi.mesin, dmdgmpi.group_mp
                            FROM master_data_man_power mdmp
                            JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                            JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmp.id_man_power
                            JOIN data_master_mesin dmm ON dmdgmpi.mesin = dmm.mesin AND dmdmp.mesin = dmm.requirement
                            WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\' AND dmdgmpi.group_mp = \'' . $group_mp . '\'
                            ');
							              // WHERE dmdmp.mesin = \'' . $mesin . '\' AND dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'

    return $query->getResultArray();
  }

  public function get_data_group_man_power_kasubsie($sub_bagian)
  {
    $query = $this->db->query('SELECT mdmpk.nama, mdmpk.npk, mdmpk.foto, dmdgmpi.mesin, dmdgmpi.group_mp
                            FROM master_data_man_power_kasubsie mdmpk
                            JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmpk.id_man_power
							              WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\'
                            ');

    return $query->getResultArray();
  }

  public function get_data_group_mp_kasubsie($sub_bagian, $group_mp)
  {
    $query = $this->db->query('SELECT mdmpk.nama, mdmpk.npk, mdmpk.foto, dmdgmpi.mesin, dmdgmpi.group_mp
                            FROM master_data_man_power_kasubsie mdmpk
                            JOIN detail_master_data_group_man_power_indirect dmdgmpi ON dmdgmpi.nama = mdmpk.id_man_power
							              WHERE dmdgmpi.sub_bagian = \'' . $sub_bagian . '\' AND dmdgmpi.group_mp = \'' . $group_mp . '\'
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
    $query = $this->db->query('SELECT nama, id_man_power FROM master_data_man_power ORDER BY nama ASC');
    // $query = $this->db->query('SELECT * FROM master_data_man_power JOIN detail_master_data_man_power on detail_master_data_man_power.id_man_power = master_data_man_power.id_man_power WHERE detail_master_data_man_power.line = \'' . $line . '\' AND detail_master_data_man_power.mesin = \'' . $mesin . '\'');

    return $query->getResultArray();
  }

  public function get_data_master_man_power_kasubsie()
  {
    $query = $this->db->query('SELECT * FROM master_data_man_power_kasubsie');

    return $query->getResultArray();
  }

  public function get_detail_man_power($id_man_power, $requirement)
  {
    $query = $this->db->query('SELECT * FROM master_data_man_power mdmp
                            JOIN detail_master_data_man_power dmdmp ON mdmp.id_man_power = dmdmp.id_man_power
                            WHERE mdmp.id_man_power = \'' . $id_man_power . '\' AND dmdmp.mesin = \'' . $requirement . '\'
                            ');
    
    return $query->getResultArray();
  }
}
