<?php

namespace App\Controllers;

use App\Models\M_RakManagement;
use App\Controllers\BaseController;
use CodeIgniter\Controller;

class InterlockAging extends BaseController
{
  public function __construct()
  {
    $this->M_RakManagement = new M_RakManagement();
  }

    public function index()
    {
        return view('pages/interlock_aging/home');
    }

    public function list_aging($mesin)
    {
        $data['data_interlock_aging'] = $this->M_RakManagement->get_data_rak_to_aging();
        $data['data_rak_at_aging'] = $this->M_RakManagement->get_data_rak_at_aging($mesin);
        $data['mesin'] = $mesin;
        return view('pages/interlock_aging/list_rak', $data);
    }

    public function get_qty_rak()
    {
        $qr_rak = $this->request->getPost('qr_rak');
        $data = $this->M_RakManagement->get_data_rak_management_by_id($qr_rak);
        echo json_encode($data);
    }

    public function add_rak()
    {
      // var_dump($this->request->getPost('qr_rak_code'));
      // die();
      date_default_timezone_set("Asia/Jakarta");
      $jumlah = count($this->request->getPost('qr_code_rak'));
      for ($i=0; $i < $jumlah; $i++) { 
        $id = $this->request->getPost('id')[$i];
        $qr_rak = $this->request->getPost('qr_code_rak')[$i];
        $item = $this->request->getPost('item_rak')[$i];
        $qty = $this->request->getPost('qty_rak')[$i];
        // $tanggal_produksi = $this->request->getPost('tanggal_produksi_rak')[$i];
        $nama_mesin = $this->request->getPost('nama_mesin')[$i];

        $data = [
          'pn_qr' => $qr_rak,
          'item' => $item,
          'qty' => $qty,
          // 'tanggal_produksi' => $tanggal_produksi,
          'nama_mesin' => $nama_mesin,
          'start_aging' => date('Y-m-d H:i:s')
        ];

        $save = $this->M_RakManagement->insert_data_rak_to_aging($id, $data);
      }

      return redirect()->to(base_url('interlock_aging/list_aging/'.substr($nama_mesin, -1)));
    }

    public function delete_rak_aging($id, $mesin)
    {
      $this->M_RakManagement->delete_rak_aging($id);
      return redirect()->to(base_url('interlock_aging/list_aging/'.$mesin));
    }

    public function update_rak_aging($mesin)
    {
      $this->M_RakManagement->update_rak_aging();
      return redirect()->to(base_url('interlock_aging/list_aging/'.$mesin));
    }
}