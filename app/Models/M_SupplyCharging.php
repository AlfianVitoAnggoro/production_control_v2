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

    public function get_data_loading($date, $sesi)
    {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($date)));
        $query = $this->db->query(' SELECT * FROM supply_charging where estimasi_finish > \''.$date.' 06:00:00.000 \' AND estimasi_finish <= \''.$next_day.' 06:00:00.000 \' AND sesi = \''.$sesi.'\'');
        return $query->getResultArray();
    }

    public function get_component_by_wo($wo)
    {
        $query = $this->db->query('SELECT * FROM detail_supply_charging where no_wo = \'' . $wo . '\'');

        if ($query->getNumRows() > 0) {
            return $query->getResultArray();
        } else {
            $query = $this->db3->query('SELECT t$pdno as no_wo, trim(t$sitm) as part_component, t$qune as qty FROM baan.tticst001777 where t$pdno = \'' . $wo . '\'');
        }

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
        } else {
            $this->db->table('supply_charging')->insert($data);
        }
    }
}
