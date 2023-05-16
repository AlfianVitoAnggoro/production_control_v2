<?php namespace App\Models;
use CodeIgniter\Model;



class M_Data extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->db2 = \Config\Database::connect('sqlsrv');
        $this->db3 = \Config\Database::connect('baan');
        $this->db4 = \Config\Database::connect('prod_control');

        $this->session = \Config\Services::session();
    }

    // public function test() {
    //     $query = $this->db4->query('SELECT * FROM ticket_assy LIMIT 1');

    //     return $query->getResultArray();
    // }

    public function getDataWO($tanggal_produksi,$line)
    {

        $tanggal = date('Ymd', strtotime('-14 days', strtotime($tanggal_produksi)));

        $query = $this->db3->query('
                                    SELECT t$prto as rfq,t$prdt as tgl_prod,t$pdno as pdno,t$mitm as mitm,t$cwar as cwar, t$qrdr as qty,t$prcd as line, t$osta as status 
                                    FROM baan.ttisfc001777 
                                    WHERE (to_number(to_char(t$prdt + (7/24),\'YYYYMMDD\'))) >= '.$tanggal.' order by t$pdno asc
                                ');
                                // WHERE t$prcd = '.$line.' and (to_number(to_char(t$prdt + (7/24),\'ddmmyyyy\'))) = '.$tanggal.' and (t$osta = 5 or t$osta = 7) order by t$pdno asc
                                // WHERE t$prcd = '.$line.' and (to_number(to_char(t$prdt + (7/24),\'ddmmyyyy\'))) = '.$tanggal.' order by t$pdno asc
        return $query->getResultArray();
    }

    public function get_line()
    {
        $query = $this->db->query('SELECT * FROM master_line');

        return $query->getResultArray();
    }

    public function get_grup()
    {
        $query = $this->db->query('SELECT * FROM master_pic_line');

        return $query->getResultArray();
    }

    public function getPartNo($no_wo)
    {
        $query = $this->db3->query('
                                    SELECT t$mitm as mitm, t$qrdr as qty
                                    FROM baan.ttisfc001777 
                                    WHERE t$pdno = \''.$no_wo.'\' order by t$pdno asc
                                ');

        return $query->getResultArray();
    }

    public function getCT($part_no) {
        // $query = $this->db2->query('
        //                             SELECT * FROM cycle_time
        //                             JOIN part_number on part_number.id_kode = cycle_time.id_kode
        //                             WHERE part_number.part_number = \''.$part_no.'\' ORDER BY cycle_time.id_kode DESC
        //                         ');

        $partno = "'"."%".$part_no."'";
        $query = $this->db->query('
            SELECT * FROM master_cycle_time
            WHERE part_number LIKE '.$partno.' ORDER BY id DESC
        ');

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

    public function getProsesBreakdown($jenis_breakdown)
    {
        $query = $this->db->query('SELECT * FROM data_breakdown WHERE jenis_breakdown = \''.$jenis_breakdown.'\'');

        return $query->getResultArray();
    }

    public function getKategoriReject($jenis_reject)
    {
        $query = $this->db->query('SELECT * FROM data_reject WHERE jenis_reject = \''.$jenis_reject.'\'');

        return $query->getResultArray();
    }

    public function save_lhp($data)
    {
        $this->db->table('lhp_produksi2')->insert($data);

        return $this->db->insertID();
    }

    public function save_detail_lhp($data)
    {
        $builder = $this->db->table('detail_lhp_produksi2');
        $builder->insert($data);

        return $this->db->insertID();
    }

    public function save_detail_breakdown($id, $data)
    {
        $builder = $this->db->table('detail_breakdown');

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
        $builder = $this->db->table('detail_reject');

        if ($id != '') {
            $builder->where('id_reject', $id);
            $builder->update($data);
            return $id;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
    }

    public function get_all_lhp()
    {
        // $query = $this->db->query('SELECT * FROM lhp_produksi2 JOIN master_pic_line ON master_pic_line.id_pic = lhp_produksi2.grup ORDER BY tanggal_produksi DESC');
        $builder = $this->db->table('lhp_produksi2');
        $builder->select('lhp_produksi2.*, master_pic_line.nama_pic');
        $builder->join('master_pic_line', 'master_pic_line.id_pic = lhp_produksi2.grup');

        if ($this->session->get('line') != NULL) {
            $builder->where('line', $this->session->get('line'));
        }
        
        $builder->orderBy('tanggal_produksi', 'DESC');

        $query = $builder->get();

        return $query->getResultArray();
    }

    public function get_lhp_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM lhp_produksi2 WHERE id_lhp_2 = '.$id_lhp);

        return $query->getResultArray();
    }

    // public function get_all_lhp_by_month($bulan)
    // {
    //     // $query = $this->db->query('SELECT * FROM lhp_produksi2 JOIN master_pic_line ON master_pic_line.id_pic = lhp_produksi2.grup ORDER BY tanggal_produksi DESC');
    //     $month = idate('m', strtotime($bulan));
    //     $year = idate('Y', strtotime($bulan));
    //     $builder = $this->db->table('lhp_produksi2');
    //     $builder->select('lhp_produksi2.*, master_pic_line.nama_pic');
    //     $builder->join('master_pic_line', 'master_pic_line.id_pic = lhp_produksi2.grup');
    //     $builder->where('MONTH(tanggal_produksi)', $month);
    //     $builder->where('YEAR(tanggal_produksi)', $year);
    //     // if ($this->session->get('line') != NULL) {
    //     //     $builder->where('line', $this->session->get('line'));
    //     // }
        
    //     // $builder->orderBy('tanggal_produksi', 'DESC');

    //     $query = $builder->get();

    //     if(count($query->getResultArray()) > 0) {
    //         return $query->getResultArray();
    //     } else {
    //         return;
    //     }
    // }

    public function get_all_lhp_by_date($start_date, $end_date)
    {
        // $query = $this->db->query('SELECT * FROM lhp_produksi2 JOIN master_pic_line ON master_pic_line.id_pic = lhp_produksi2.grup ORDER BY tanggal_produksi DESC');
        $builder = $this->db->table('lhp_produksi2');
        $builder->select('lhp_produksi2.*, master_pic_line.nama_pic');
        $builder->join('master_pic_line', 'master_pic_line.id_pic = lhp_produksi2.grup');
        $builder->where('line >= ', 1);
        $builder->where('line <= ', 7);
        $builder->where('tanggal_produksi >= ', $start_date);
        $builder->where('tanggal_produksi <= ', $end_date);
        // if ($this->session->get('line') != NULL) {
        //     $builder->where('line', $this->session->get('line'));
        // }
        
        // $builder->orderBy('tanggal_produksi', 'DESC');

        $query = $builder->get();

        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }

    public function get_detail_lhp_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_produksi2 WHERE id_lhp_2 = '.$id_lhp);

        return $query->getResultArray();
    }

    public function get_all_detail_lhp_by_id_lhp($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_lhp_produksi2 WHERE id_lhp_2 = '.$id_lhp);

        if(count($query->getResultArray()) > 0) {
            return $query->getResultArray();
        } else {
            return;
        }
    }

    public function update_lhp($id_lhp, $data)
    {
        $builder = $this->db->table('lhp_produksi2');
        $builder->where('id_lhp_2', $id_lhp);
        $builder->update($data);

        return $this->db->affectedRows();
    }

    public function update_detail_lhp($id_detail_lhp, $data)
    {
        $builder = $this->db->table('detail_lhp_produksi2');

        if ($id_detail_lhp != '') {
            $builder->where('id_detail_lhp', $id_detail_lhp);
            $builder->update($data);
            return $id_detail_lhp;
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
        
    }

    public function get_detail_breakdown_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_breakdown WHERE id_lhp = '.$id_lhp);

        return $query->getResultArray();
    }

    public function get_detail_reject_by_id($id_lhp)
    {
        $query = $this->db->query('SELECT * FROM detail_reject WHERE id_lhp = '.$id_lhp);

        return $query->getResultArray();
    }

    public function get_data_andon($tanggal_produksi, $line) {
        $query = $this->db4->query('SELECT * FROM ticket_assy WHERE tanggal_produksi = \''.$tanggal_produksi.'\' AND id_line = \''.$line.'\'');

        return $query->getResultArray();
    }

    public function pilih_andon($id_ticket) {
        $query = $this->db4->query('SELECT * FROM ticket_assy WHERE id_ticket = '.$id_ticket);

        return $query->getResultArray();
    }

    public function cek_lhp($tanggal_produksi, $line, $shift, $grup) 
    {
        $query = $this->db->query('SELECT * FROM lhp_produksi2 WHERE tanggal_produksi = \''.$tanggal_produksi.'\' AND line = \''.$line.'\' AND shift = \''.$shift.'\' AND grup = \''.$grup.'\'');

        return $query->getResultArray();
    }

    public function update_detail_breakdown($id_breakdown, $data)
    {
        $builder = $this->db->table('detail_breakdown');

        if ($id_breakdown != '') {
            $builder->where('id_breakdown', $id_breakdown);
            $builder->update($data);
            return $this->db->affectedRows();
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
        
    }

    public function update_detail_reject($id_reject, $data)
    {
        $builder = $this->db->table('detail_reject');

        if ($id_reject != '') {
            $builder->where('id_reject', $id_reject);
            $builder->update($data);
            return $this->db->affectedRows();
        } else {
            $builder->insert($data);
            return $this->db->insertID();
        }
    }

    public function get_data_grup_pic($id_grup)
    {
        $query = $this->db->query('SELECT * FROM master_pic_line WHERE id_pic = '.$id_grup);

        return $query->getResultArray();
    }

    public function get_data_line($id_line)
    {
        $query = $this->db->query('SELECT * FROM master_line WHERE id_line = '.$id_line);

        return $query->getResultArray();
    }

    public function hapus_lhp($id) {
        $this->db->query('DELETE FROM lhp_produksi2 WHERE id_lhp_2 = '.$id);
        $this->db->query('DELETE FROM detail_lhp_produksi2 WHERE id_lhp_2 = '.$id); 
        $this->db->query('DELETE FROM detail_breakdown WHERE id_lhp = '.$id);
        $this->db->query('DELETE FROM detail_reject WHERE id_lhp = '.$id);
    }

    public function delete_line_stop($id_line_stop) {
        $this->db->query('DELETE FROM detail_breakdown WHERE id_breakdown = '.$id_line_stop);
    }

    public function delete_reject($id_reject) {
        $this->db->query('DELETE FROM detail_reject WHERE id_reject = '.$id_reject);
    }
}
