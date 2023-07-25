<?php namespace App\Models;
use CodeIgniter\Model;



class M_SupplyCharging extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        // $this->db2 = \Config\Database::connect('sqlsrv');
        $this->db3 = \Config\Database::connect('baan');
        // $this->db4 = \Config\Database::connect('prod_control');

        $this->session = \Config\Services::session();
    }

    public function get_data_loading($date, $sesi, $line)
    {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($date)));
        // $query = $this->db->query(' SELECT * FROM supply_charging where estimasi_finish > \''.$date.' 06:00:00.000 \' AND estimasi_finish <= \''.$next_day.' 06:00:00.000 \' AND sesi = \''.$sesi.'\'');
        if ($line == 'all' AND $sesi == 'all') {
            $query = $this->db->query(' SELECT * FROM supply_charging where estimasi_finish >= \''.$date.' 00:00:00.000 \' AND estimasi_finish <= \''.$date.' 23:59:59.000 \' ORDER BY id_supply_charging ASC');
        } elseif ($line == 'all' AND $sesi != 'all') {
            $query = $this->db->query(' SELECT * FROM supply_charging where estimasi_finish >= \''.$date.' 00:00:00.000 \' AND estimasi_finish <= \''.$date.' 23:59:59.000 \' AND sesi = \''.$sesi.'\' ORDER BY id_supply_charging ASC');
        } elseif ($line != 'all' AND $sesi == 'all') {
            $query = $this->db->query(' SELECT * FROM supply_charging where estimasi_finish >= \''.$date.' 00:00:00.000 \' AND estimasi_finish <= \''.$date.' 23:59:59.000 \' AND tujuan = \''.$line.'\' ORDER BY id_supply_charging ASC');
        } else {
            $query = $this->db->query(' SELECT * FROM supply_charging where estimasi_finish >= \''.$date.' 00:00:00.000 \' AND estimasi_finish <= \''.$date.' 23:59:59.000 \' AND sesi = \''.$sesi.'\' AND tujuan = \''.$line.'\' ORDER BY id_supply_charging ASC');
        }
        return $query->getResultArray();
    }

    public function get_component_by_wo($wo)
    {
        $query = $this->db3->query('SELECT t$pdno as no_wo, trim(t$sitm) as part_component, t$qune as qty FROM baan.tticst001777 where t$pdno = \'' . $wo . '\'');

        return $query->getResultArray();
    }

    public function get_status_prepare_component($wo, $part_component)
    {
        $query = $this->db->query('SELECT * FROM detail_supply_charging where no_wo = \'' . $wo . '\' and part_component = \'' . $part_component . '\'');

        return $query->getResultArray();
    }

    public function add_detail_supply_charging($no_wo,$part_component,$data)
    {
        $query = $this->db->query('SELECT * FROM detail_supply_charging where no_wo = \'' . $no_wo . '\' and part_component = \'' . $part_component . '\'');

        if ($query->getNumRows() > 0) {
            $this->db->table('detail_supply_charging')->where('no_wo', $no_wo)->where('part_component', $part_component)->update($data);
        } else {
            $this->db->table('detail_supply_charging')->insert($data);
        }
    }

    public function add_data_supply_charging($no_wo, $data) {
        $query = $this->db->query('SELECT * FROM supply_charging where no_wo = \'' . $no_wo . '\'');

        if ($query->getNumRows() > 0) {
            $this->db->table('supply_charging')->where('no_wo', $no_wo)->update($data);
            return $this->db->affectedRows();
        } else {
            $this->db->table('supply_charging')->insert($data);
            return $this->db->insertID();
        }
    }

    public function update_prepare_item($no_wo, $part_component, $data) {
        $this->db->table('detail_supply_charging')->where('no_wo', $no_wo)->where('part_component', $part_component)->update($data);
        return $this->db->affectedRows();
    }

    public function get_data_loading_by_limit($page)
    {
        $query = $this->db->query(' SELECT * FROM supply_charging ORDER BY id_supply_charging ASC OFFSET '.$page.' ROWS FETCH NEXT 1 ROWS ONLY');
        return $query->getResultArray();
    }

    public function get_detail_supply_charging($no_wo) {
        $query = $this->db->query(' SELECT * FROM detail_supply_charging where no_wo = \''.$no_wo.'\' AND supply_at IS NOT NULL ORDER BY id_detail_supply_charging ASC');
        return $query->getResultArray();
    }

    public function get_data_loading_by_wo($no_wo)
    {
        $query = $this->db->query(' SELECT * FROM supply_charging where no_wo = \''.$no_wo.'\'');
        return $query->getResultArray();
    }

    public function update_status_supply($no_wo, $data) {
        $this->db->table('supply_charging')->where('no_wo', $no_wo)->update($data);
        return $this->db->affectedRows();
    }
}
