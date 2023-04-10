<?php

namespace App\Controllers;

use App\Models\M_GridRework as Machine;



class GridRework extends BaseController
{
    public function dashboard()
    {
        return view('rework_grid/content/dashboard');
    }


    protected $db;
    protected $Machine;
    public function __construct()
    {
        $this->Machine = new Machine();
        $this->db = db_connect();
    }
    public function mc($mc)
    {
        $tanggal = date('Y-m-d');
        $machine = $this->Machine->where('CAST(created_at AS date)', $tanggal)->findAll();
        $start = substr($mc, 2, 2);
        $end = substr($mc, 5, 2);
        $data = [
            'title' => 'Home',
            'machine' => $machine,
            'start' => $start,
            'end' => $end
        ];
        return view('rework_grid/content/main', $data);
    }

    public function save()
    {
        $id_mesin = $this->request->getVar('id_machine');

        if ($id_mesin[0] < 10) {
            $start = '0' . $id_mesin[0];
        } else if ($id_mesin[0] >= 10) {
            $start = $id_mesin[0];
        }
        if ($id_mesin[2] < 10) {
            $end = '0' . $id_mesin[2];
        } else if ($id_mesin[2] >= 10) {
            $end = $id_mesin[2];
        }
        $jumlah = $this->request->getVar('jumlah');
        $data = array();
        for ($i = 0; $i < count($id_mesin); $i++) {
            if ($jumlah[$i] !== 0 && $jumlah[$i] !== "") {
                $data[] = array(
                    'id_machine' => $id_mesin[$i],
                    'jumlah' => $jumlah[$i]

                );
            }
        }

        $this->Machine->insertBatch($data);
        return redirect()->to('grid_rework/mc' . $start . '-' . $end);
    }

    public function edit()
    {
        $start = $this->request->getVar('start');
        $end = $this->request->getVar('end');
        $id = $this->request->getVar('id');
        $id_machine = $this->request->getVar('idmc');
        $jumlah = $this->request->getVar('jumlah');

        $data[] = array(
            'id' => $id,
            'id_machine' => $id_machine,
            'jumlah' => $jumlah
        );

        $this->Machine->updateBatch($data, 'id');
        return redirect()->to('grid_rework/mc' . $start . '-' . $end);
    }

    public function delete()
    {
        $start = $this->request->getVar('start');
        $end = $this->request->getVar('end');
        $id = $this->request->getVar('id');
        $id_machine = $this->request->getVar('idmc');
        $jumlah = $this->request->getVar('jumlah');

        $data[] = array(
            'id' => $id,
            'id_machine' => $id_machine,
            'jumlah' => $jumlah
        );

        $this->Machine->delete($id);
        return redirect()->to('grid_rework/mc' . $start . '-' . $end);
    }
}