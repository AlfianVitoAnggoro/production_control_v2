<?php

namespace App\Models;

use CodeIgniter\Model;

class M_PotongBattery extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db3 = \Config\Database::connect('baan');
        $this->db4 = \Config\Database::connect('prod_control');
        $this->db5 = \Config\Database::connect('manajemen_rak');
        $this->db6 = \Config\Database::connect('timah');
    }

    public function getAll()
    {
        $query = $this->db->table('lhp_potong_battery')->get();
        return $query->getResultArray();
    }

    public function save_data($data)
    {
        $this->db->table('lhp_potong_battery')->insert($data);
        return $this->db->insertID();
    }

    public function get_data_by_id($id)
    {
        $query = $this->db->query('SELECT * FROM lhp_potong_battery WHERE id_lhp_potong_battery = ' . $id);
        return $query->getResultArray();
    }

    public function get_data_plate()
    {
        $query = $this->db->query('SELECT * FROM plate');
        return $query->getResultArray();
    }

    public function get_data_plate_ng($id)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_potong_battery_plate WHERE id_lhp_potong_battery = ' . $id);
        return $query->getResultArray();
    }

    public function get_data_element($id)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_potong_battery_element WHERE id_lhp_potong_battery = ' . $id);
        return $query->getResultArray();
    }

    public function update_data($id, $data)
    {
        $this->db->table('lhp_potong_battery')->update($data, ['id_lhp_potong_battery' => $id]);
    }

    public function update_data_plate($id, $data)
    {
        if (!empty($id)) {
            $this->db->table('detail_lhp_potong_battery_plate')->update($data, ['id_detail_lhp_potong_battery_plate' => $id]);
        } else {
            $this->db->table('detail_lhp_potong_battery_plate')->insert($data);
        }
    }

    public function update_data_element($id, $data)
    {
        if (!empty($id)) {
            $this->db->table('detail_lhp_potong_battery_element')->update($data, ['id_detail_lhp_potong_battery_element' => $id]);
        } else {
            $this->db->table('detail_lhp_potong_battery_element')->insert($data);
        }
    }
}
