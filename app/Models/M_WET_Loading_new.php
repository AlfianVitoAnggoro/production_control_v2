<?php namespace App\Models;
use CodeIgniter\Model;



class M_WET_Loading_new extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db2 = \Config\Database::connect('sqlsrv');
        $this->db3 = \Config\Database::connect('baan');
        $this->db4 = \Config\Database::connect('prod_control');

        $this->session = \Config\Services::session();
    }

    public function get_all_lhp_wet()
    {
        $builder = $this->db->table('lhp_wet_loading');
        $builder->select('lhp_wet_loading.*, master_pic_line.nama_pic');
        $builder->join('master_pic_line', 'master_pic_line.id_pic = lhp_wet_loading.grup');

        if ($this->session->get('line') != NULL) {
            $builder->where('line', $this->session->get('line'));
        }
        
        $builder->orderBy('tanggal_produksi', 'DESC');

        $query = $builder->get();

        return $query->getResultArray();
    }

    public function get_all_lhp_by_date($start_date, $end_date)
    {
        $builder = $this->db->table('lhp_wet_loading');
        $builder->select('lhp_wet_loading.*, master_pic_line.nama_pic');
        $builder->join('master_pic_line', 'master_pic_line.id_pic = lhp_wet_loading.grup');
        $builder->where('line', 8);
        $builder->orWhere('line', 9);
        $builder->where('tanggal_produksi >= ', $start_date);
        $builder->where('tanggal_produksi <= ', $end_date);
        $query = $builder->get();

        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }
    
    public function get_grup()
    {
        $query = $this->db->query('SELECT * FROM master_pic_line');

        return $query->getResultArray();
    }

    public function get_line()
    {
        $query = $this->db->query('SELECT * FROM master_line');

        return $query->getResultArray();
    }
    
    public function get_all_detail_lhp_by_id_lhp($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_wet_loading_new WHERE id_lhp_wet_loading = '.$id_lhp);

        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }

    public function get_detail_breakdown_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_breakdown_wet_loading_new WHERE id_lhp_wet_loading = '.$id_lhp);

        return $query->getResultArray();
    }

    public function get_detail_reject_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_reject_wet_loading_new WHERE id_lhp_wet_loading = '.$id_lhp);

        return $query->getResultArray();
    }

    public function cek_lhp($tanggal_produksi, $line, $shift, $grup) 
    {
        $query = $this->db->query('SELECT * FROM lhp_wet_loading WHERE tanggal_produksi = \''.$tanggal_produksi.'\' AND line = \''.$line.'\' AND shift = \''.$shift.'\' AND grup = \''.$grup.'\'');

        return $query->getResultArray();
    }

    public function save_lhp($data)
    {
        $this->db->table('lhp_wet_loading')->insert($data);

        return $this->db->insertID();
    }

    public function get_lhp_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM lhp_wet_loading WHERE id_lhp_wet_loading = '.$id_lhp);

        return $query->getResultArray();
    }

    public function get_detail_lhp_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_wet_loading_new WHERE id_lhp_wet_loading = '.$id_lhp);

        return $query->getResultArray();
    }

    public function get_data_line($id_line)
    {
        $query = $this->db->query('SELECT * FROM master_line WHERE id_line = '.$id_line);

        return $query->getResultArray();
    }

    public function get_data_grup_pic($id_grup)
    {
        $query = $this->db->query('SELECT * FROM master_pic_line WHERE id_pic = '.$id_grup);

        return $query->getResultArray();
    }

    public function get_total_menit_breakdown ($id_lhp) {
        $query = $this->db->query('SELECT SUM(menit_breakdown) AS total_menit FROM detail_breakdown_wet_loading_new WHERE id_lhp_wet_loading = '.$id_lhp);

        return $query->getResultArray();
    }

    public function getListBreakdown($line)
    {
        $query = $this->db->query('SELECT DISTINCT jenis_breakdown FROM data_breakdown WHERE '. $line . '= \'1\'');

        return $query->getResultArray();
    }

    public function getListReject($line)
    {
        $query = $this->db->query('SELECT DISTINCT jenis_reject FROM data_reject WHERE '. $line . '= \'1\'');

        return $query->getResultArray();
    }

    public function get_pending()
    {
        $query = $this->db->query('SELECT DISTINCT(jenis_pending) AS jenis_pending FROM master_pending_wet');

        return $query->getResultArray();
    }

    public function save_detail_pending($id, $data)
    {
        $builder = $this->db->table('detail_pending_wet_loading_new');

        if ($id != '') {
            $builder->where('id_pending_wet_loading', $id);
            $builder->update($data);
            return $id;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
    }

    public function getKategoriPending($jenis_pending)
    {
        $query = $this->db->query('SELECT * FROM master_pending_wet WHERE jenis_pending = \''.$jenis_pending.'\'');

        return $query->getResultArray();
    }

    public function get_detail_pending_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_pending_wet_loading_new WHERE id_lhp_wet_loading = '.$id_lhp);

        return $query->getResultArray();
    }

    public function get_jenis_battery()
    {
        $query = $this->db->query('SELECT * FROM master_wet_jenis_battery');

        return $query->getResultArray();
    }

    public function get_series_battery()
    {
        $query = $this->db->query('SELECT DISTINCT(series_battery) AS series_battery FROM master_wet_series_battery');

        return $query->getResultArray();
    }

    public function get_series($id_jenis_battery)
    {
        $query = $this->db->query('SELECT * FROM master_wet_series_battery WHERE id_jenis = '.$id_jenis_battery);

        return $query->getResultArray();
    }

    public function get_ct($series, $line)
    {
        $partno = "'"."%".$series."%"."'";

        $query = $this->db->query('
            SELECT TOP 1 first_cycle_time as cycle_time FROM master_cycle_time_loading_acid_filling
            WHERE series LIKE '.$partno.' AND first_line = '.$line.' ORDER BY id DESC
        ');

        if ($query->getNumRows() > 0) {
            return $query->getResultArray();
        } else {
            $query = $this->db->query('
                SELECT TOP 1 second_cycle_time as cycle_time FROM master_cycle_time_loading_acid_filling
                WHERE series LIKE '.$partno.' AND second_line = '.$line.' ORDER BY id DESC
            ');
        }

        return $query->getResultArray();
    }

    public function get_type_battery($series_battery)
    {
        $query = $this->db->query('SELECT * FROM master_wet_type_battery WHERE series_battery = \''.$series_battery.'\'');

        return $query->getResultArray();
    }
    
    public function update_lhp($id_lhp, $data)
    {
        $builder = $this->db->table('lhp_wet_loading');
        $builder->where('id_lhp_wet_loading', $id_lhp);
        $builder->update($data);

        return $this->db->affectedRows();
    }

    public function update_detail_lhp($id_detail_lhp, $data)
    {
        $builder = $this->db->table('detail_lhp_wet_loading_new');

        if ($id_detail_lhp != '') {
            $builder->where('id_detail_lhp_wet_loading', $id_detail_lhp);
            $builder->update($data);
            return $id_detail_lhp;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
        
    }

    public function save_detail_breakdown($id, $data)
    {
        $builder = $this->db->table('detail_breakdown_wet_loading_new');

        if ($id != '') {
            $builder->where('id_breakdown_wet_loading', $id);
            $builder->update($data);
            return $id;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
    }

    public function get_total_pending ($id_lhp) {
        $query = $this->db->query('SELECT SUM(qty_pending) AS total_pending FROM detail_pending_wet_loading_new WHERE id_lhp_wet_loading = '.$id_lhp);

        return $query->getResultArray();
    }

    public function get_all_type_battery() {
        $query = $this->db->query('SELECT DISTINCT(type_battery) AS type_battery FROM master_wet_type_battery');

        return $query->getResultArray();
    }

    public function save_detail_reject($id, $data)
    {
        $builder = $this->db->table('detail_reject_wet_loading_new');

        if ($id != '') {
            $builder->where('id_reject_wet_loading', $id);
            $builder->update($data);
            return $id;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
    }

    public function hapus_lhp($id) {
        $this->db->query('DELETE FROM lhp_wet_loading WHERE id_lhp_wet_loading = '.$id);
        $this->db->query('DELETE FROM detail_lhp_wet_loading_new WHERE id_lhp_wet_loading = '.$id); 
        $this->db->query('DELETE FROM detail_breakdown_wet_loading_new WHERE id_lhp_wet_loading = '.$id);
        $this->db->query('DELETE FROM detail_reject_wet_loading_new WHERE id_lhp_wet_loading = '.$id);
        $this->db->query('DELETE FROM detail_pending_wet_loading_new WHERE id_lhp_wet_loading = '.$id);
    }

    public function delete_line_stop($id_line_stop) {
        $this->db->query('DELETE FROM detail_breakdown_wet_loading_new WHERE id_breakdown_wet_loading = '.$id_line_stop);
    }

    public function delete_reject($id_reject) {
        $this->db->query('DELETE FROM detail_reject_wet_loading_new WHERE id_reject_wet_loading = '.$id_reject);
    }

    public function get_part_number($barc)
    {
        $query = $this->db3->query('SELECT t$note AS barc, t$pdno AS no_wo, trim(t$item) AS item, t$admq AS qty FROM baan.tcbinh982777 WHERE t$note = \''.$barc.'\'');

        return $query->getResultArray();
    }

    public function get_ct_part_number($partno, $line)
    {
        $query = $this->db->query('
            SELECT first_cycle_time as cycle_time FROM master_cycle_time_loading_acid_filling
            WHERE part_number =  \''.$partno.'\' AND first_line = \''.$line.'\' ORDER BY id DESC
        ');

        if ($query->getNumRows() > 0) {
            return $query->getResultArray();
        } else {
            $query = $this->db->query('
                SELECT second_cycle_time as cycle_time FROM master_cycle_time_loading_acid_filling
                WHERE part_number = \''.$partno.'\' AND second_line = \''.$line.'\' ORDER BY id DESC
            ');

            return $query->getResultArray();
        }
    }

    public function get_part_number_charging($partno)
    {
        $query = $this->db2->query('SELECT part_number FROM part_number where part_number_assy = \''.$partno.'\'');

        return $query->getResultArray();
    }

    public function get_wo_charging($partno)
    {
        // $query = $this->db3->query('SELECT * FROM baan.ttisfc001777 where trim(t$mitm) = \''.$partno.'\' and (t$osta = 5 or t$osta = 7) order by t$pdno asc');

        $query = $this->db->query('SELECT TOP(1) * FROM list_task_loading_wet where part_number = \''.$partno.'\' and status IS NULL order by no_wo asc');

        return $query->getResultArray();
    }

    public function get_durasi_charging($partno, $line)
    {
        $query = $this->db->query('
            SELECT TOP(1) first_duration as duration FROM master_charging_duration
            WHERE part_number =  \''.$partno.'\' AND first_line = \''.$line.'\' AND first_duration IS NOT NULL ORDER BY id ASC
        ');

        if ($query->getNumRows() > 0) {
            return $query->getResultArray();
        } else {
            $query = $this->db->query('
                SELECT TOP(1) second_duration as duration FROM master_charging_duration
                WHERE part_number = \''.$partno.'\' AND second_line = \''.$line.'\' AND second_duration IS NOT NULL ORDER BY id ASC
            ');

            return $query->getResultArray();
        }
    }

    public function get_list_wo()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_produksi = date('Ymd');
        $tanggal = date('Ymd', strtotime('-14 days', strtotime($tanggal_produksi)));

        $kl = "'"."%KLC%"."'";

        $query = $this->db3->query('
                                SELECT t$pdno as pdno, trim(t$mitm) as item, t$qntl as qty
                                FROM baan.ttisfc001777 
                                WHERE (to_number(to_char(t$prdt + (7/24),\'YYYYMMDD\'))) >= '.$tanggal.'
                                AND t$pdno LIKE '.$kl.' 
                                AND (t$osta = 5 or t$osta = 7)
                                ORDER BY t$pdno asc
                            ');
        return $query->getResultArray();
    }

    public function add_list_wo($data)
    {
        $builder = $this->db->table('list_task_loading_wet');
        $builder->insert($data);
        return $this->db->insertID();
    }

    public function get_task_loading($tanggal_produksi, $line) {
        $query = $this->db->query('
            SELECT * FROM list_task_loading_wet
            WHERE tanggal_loading = \''.$tanggal_produksi.'\' AND line = \''.$line.'\'
        ');

        return $query->getResultArray();
    }

    public function update_status_list_loading_wo($no_wo, $data)
    {
        $builder = $this->db->table('list_task_loading_wet');
        $builder->where('no_wo', $no_wo);
        $builder->update($data);

        return $this->db->affectedRows();
    }

    public function delete_list_wo($id) {
        $this->db->query('DELETE FROM list_task_loading_wet WHERE id = '.$id);
    }
}
