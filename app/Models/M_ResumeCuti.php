<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\fileExists;

class M_ResumeCuti extends Model
{
  public function __construct()
  {
    $this->db = \Config\Database::connect('henkaten');

    $this->session = \Config\Services::session();
  }

  public function get_data_master_man_power()
  {
    $query = $this->db->query('SELECT id_man_power, nama FROM master_data_man_power ORDER BY nama ASC');

    return $query->getResultArray();
  }

  public function get_data_mp($id_man_power)
  {
    $query = $this->db->query('SELECT * FROM master_data_man_power mdmp
                            JOIN detail_master_data_group_man_power dmdgmp ON mdmp.id_man_power = dmdgmp.nama
                            WHERE id_man_power =\'' . $id_man_power . '\'
                          ');

    return $query->getResultArray();
  }

  public function get_data_mp_cuti()
  {
    $query_cuti = $this->db->query('SELECT drac.*, drac.tanggal_buat AS tanggal, drac.group_mp, mdmp.nama AS nama_mp FROM data_record_all_cuti drac
                            JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                            ORDER BY drac.tanggal_buat DESC
                            ');
    $query_izin = $this->db->query('SELECT drac.*, drac.tanggal_buat AS tanggal, drac.group_mp, mdmp.nama AS nama_mp FROM data_record_all_izin drac
                            JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                            ORDER BY drac.tanggal_buat DESC
                            ');
    $query_cuti_besar = $this->db->query('SELECT drac.*, drac.tanggal_buat AS tanggal, drac.group_mp, mdmp.nama AS nama_mp FROM data_record_all_cuti_besar drac
                            JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                            ORDER BY drac.tanggal_buat DESC
                            ');
    $query_sakit = $this->db->query('SELECT drac.*, drac.tanggal_buat AS tanggal, drac.group_mp, mdmp.nama AS nama_mp FROM data_record_all_sakit drac
                              JOIN master_data_man_power mdmp ON drac.nama = mdmp.id_man_power
                              ORDER BY drac.tanggal_buat DESC
                              ');

    $data = array_merge($query_cuti->getResultArray(), $query_izin->getResultArray(), $query_cuti_besar->getResultArray(), $query_sakit->getResultArray());
    $tanggal = array_column($data, 'tanggal');
    $created_at = array_column($data, 'created_at');
    array_multisort($tanggal, SORT_DESC, $created_at, SORT_DESC, $data);
    return $data;
  }

  public function get_detail_mp_cuti($id_cuti)
  {
    $query = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_cuti dt_rac
                            JOIN detail_record_all_cuti d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE dt_rac.id_cuti = \'' . $id_cuti . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_detail_mp_izin($id_cuti)
  {
    $query = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_izin dt_rac
                            JOIN detail_record_all_izin d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE dt_rac.id_cuti = \'' . $id_cuti . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_detail_mp_cuti_besar($id_cuti)
  {
    $query = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_cuti_besar dt_rac
                            JOIN detail_record_all_cuti_besar d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE dt_rac.id_cuti = \'' . $id_cuti . '\'
                            ');
    $data = $query->getResultArray();
    if (count($data) == 0) {
      $query = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, mdmp.npk, mdmp.nama FROM data_record_all_cuti_besar dt_rac
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE dt_rac.id_cuti = \'' . $id_cuti . '\'
                            ');
      $data = $query->getResultArray();
    }
    return $data;
  }

  public function get_detail_mp_sakit($id_cuti)
  {
    $query = $this->db->query('SELECT dt_rac.*, dt_rac.created_at AS created, d_rac.*, mdmp.npk, mdmp.nama FROM data_record_all_sakit dt_rac
                            JOIN detail_record_all_sakit d_rac ON dt_rac.id_cuti = d_rac.id_cuti
							              JOIN master_data_man_power mdmp ON mdmp.id_man_power = dt_rac.nama
                            WHERE dt_rac.id_cuti = \'' . $id_cuti . '\'
                            ');
    return $query->getResultArray();
  }

  public function get_data_lampiran($id_cuti, $kategori)
  {
    $query = $this->db->query('SELECT dt_lamp.lampiran FROM data_record_all_' . strtolower(str_replace(' ', '_', $kategori)) . ' dt_rac
                              JOIN data_all_lampiran_absen dt_lamp ON dt_rac.id_cuti = dt_lamp.id_absen
                              WHERE dt_lamp.id_absen = \'' . $id_cuti . '\' AND dt_lamp.kategori = \'' . $kategori . '\'
                            ');
    return $query->getResultArray();
  }

  public function update_cuti($id, $data)
  {
    $builder = $this->db->table('data_record_all_cuti');
    $builder->where('id_cuti', $id);
    $builder->update($data);

    return $id;
  }

  public function update_izin($id, $data)
  {
    $builder = $this->db->table('data_record_all_izin');
    $builder->where('id_cuti', $id);
    $builder->update($data);

    return $id;
  }

  public function update_cuti_besar($id, $data)
  {
    $builder = $this->db->table('data_record_all_cuti_besar');
    $builder->where('id_cuti', $id);
    $builder->update($data);

    return $id;
  }

  public function update_sakit($id, $data)
  {
    $builder = $this->db->table('data_record_all_sakit');
    $builder->where('id_cuti', $id);
    $builder->update($data);

    return $id;
  }

  public function checkStatusApprovedCuti($id_cuti)
  {
    $query = $this->db->query('SELECT * FROM data_record_all_cuti
                            WHERE id_cuti = \'' . $id_cuti . '\' AND (status_kadiv = \'approved\' OR status_kadept = \'approved\' OR status_hrd = \'approved\') AND (status_kadiv != \'rejected\' AND status_kadept != \'rejected\' AND status_kasie != \'rejected\' AND status_kasubsie != \'rejected\' AND status_hrd != \'rejected\')
                            ');

    return $query->getRowArray();
  }

  public function checkStatusApprovedIzin($id_cuti)
  {
    $query = $this->db->query('SELECT * FROM data_record_all_izin
                            WHERE id_cuti = \'' . $id_cuti . '\' AND (status_kadiv = \'approved\' OR status_kadept = \'approved\' OR status_hrd = \'approved\') AND (status_kadiv != \'rejected\' AND status_kadept != \'rejected\' AND status_kasie != \'rejected\' AND status_kasubsie != \'rejected\' AND status_hrd != \'rejected\')
                            ');

    return $query->getRowArray();
  }

  public function checkStatusApprovedCutiBesar($id_cuti)
  {
    $query = $this->db->query('SELECT * FROM data_record_all_cuti_besar
                            WHERE id_cuti = \'' . $id_cuti . '\' AND (status_kadiv = \'approved\' OR status_kadept = \'approved\' OR status_hrd = \'approved\') AND (status_kadiv != \'rejected\' AND status_kadept != \'rejected\' AND status_kasie != \'rejected\' AND status_kasubsie != \'rejected\' AND status_hrd != \'rejected\')
                            ');

    return $query->getRowArray();
  }

  public function checkStatusApprovedSakit($id_cuti)
  {
    $query = $this->db->query('SELECT * FROM data_record_all_sakit
                            WHERE id_cuti = \'' . $id_cuti . '\' AND (status_kadiv = \'approved\' OR status_kadept = \'approved\' OR status_hrd = \'approved\') AND (status_kadiv != \'rejected\' AND status_kadept != \'rejected\' AND status_kasie != \'rejected\' AND status_kasubsie != \'rejected\' AND status_hrd != \'rejected\')
                            ');

    return $query->getRowArray();
  }

  public function delete_cuti($cuti, $id_cuti)
  {
    $lampiran = $this->db->query('SELECT * FROM data_all_lampiran_absen WHERE id_absen = \'' . $id_cuti . '\' AND kategori = \'' . ucwords(str_replace('_', ' ', $cuti)) . '\'');
    $lampiran = $lampiran->getResultArray();
    foreach ($lampiran as $qry) {
      $file_path = FCPATH . 'uploads\\lampiran_cuti\\' . $qry['lampiran']; // Ganti "file_name.txt" dengan nama file yang ingin dihapus
      if (is_file($file_path)) {
        unlink($file_path);
      }
    }
    $query = $this->db->query('DELETE FROM data_record_all_' . $cuti . ' WHERE id_cuti = \'' . $id_cuti . '\'');
    $query = $this->db->query('DELETE FROM detail_record_all_' . $cuti . ' WHERE id_cuti = \'' . $id_cuti . '\'');
    $query = $this->db->query('DELETE FROM data_all_lampiran_absen WHERE id_absen = \'' . $id_cuti . '\' AND kategori = \'' . ucwords(str_replace('_', ' ', $cuti)) . '\'');

    return $id_cuti;
  }

  public function generateInitials($name)
  {
    if (strlen($name) > 0) {
      $words = explode(' ', $name);
      $initials = '';

      foreach ($words as $word) {
        $initials .= substr($word, 0, 1);
      }

      // Jika inisial kurang dari 3 huruf, tambahkan huruf selanjutnya dari kata terakhir
      if (strlen($initials) < 3) {
        while (strlen($initials) < 3) {
          if (count($words) == 2)
            $initials .= substr(end($words), 1, 1);
          else
            $initials .= substr(end($words), strlen($initials), 1);
        }
      }

      return strtoupper($initials);
    } else {
      return $name;
    }
  }
}
