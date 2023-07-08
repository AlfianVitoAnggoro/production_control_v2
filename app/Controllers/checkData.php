<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\M_Rack;

class CheckData extends BaseController
{
  protected $m_rack;

  public function __construct()
  {
    $this->m_rack = new M_Rack();
  }

  public function index()
  {
    $dataMRack =
      [
        'datas' => $this->m_rack->getData()
      ];
    return view('pages/check_data_rack', $dataMRack);
  }

  public function inputDataRack()
  {
    $rack = $this->request->getVar('rack');
    $pn_qr = $this->request->getVar('pn_qr');
    $item = $this->request->getVar('item');
    $barcode = $this->request->getVar('barcode');
    $qty = $this->request->getVar('qty');
    $entry_date = $this->request->getVar('entry_date');

    // Validasi jumlah data
    if (
      (!is_array($pn_qr) || count($pn_qr) === 0) ||
      (!is_array($item) || count($item) === 0) ||
      (!is_array($barcode) || count($barcode) === 0) ||
      (!is_array($qty) || count($qty) === 0) ||
      (!is_array($entry_date) || count($entry_date) === 0)
    ) {
      $data = $this->m_rack->getData(); // Assuming this method returns the relevant data
      $rackId = null;
      foreach ($data as $rackData) {
        if ($rackData['pn_qr'] === $rack) {
          $rackId = $rackData['id'];
          break;
        }
      }
      $this->m_rack->delete($rackId);
      return redirect()->back()->withInput()->with('error', 'Jumlah data tidak valid');
    }

    // Simpan data ke database
    $currentIds = [];
    $currentPn = '';
    $currentBarc = [];

    for ($i = 0; $i < count($pn_qr); $i++) {
      $existingData = $this->m_rack->getDataByBarcode($barcode[$i]);

      if ($existingData) {
        // Data dengan barcode sudah ada, lakukan update
        $data = [
          'pn_qr' => $pn_qr[$i],
          'item' => $item[$i],
          'qty' => $qty[$i],
          'entry_date' => $entry_date[$i],
        ];

        $this->m_rack->update($existingData['id'], $data);
        $currentIds[] = $existingData['id'];
        $currentPn = $existingData['pn_qr'];
      } else {
        // Data dengan barcode belum ada, simpan data baru
        $data = [
          'pn_qr' => $pn_qr[$i],
          'item' => $item[$i],
          'barcode' => $barcode[$i],
          'qty' => $qty[$i],
          'entry_date' => $entry_date[$i],
        ];

        $currentIds[] = $this->m_rack->save($data);
        $currentPn = $pn_qr[$i];
      }
    }

    // Menghapus data yang berkurang berdasarkan ID
    $existingIds = $this->m_rack->getAllIds();

    if (is_countable($existingIds) && count($existingIds) > 0) {
      foreach ($existingIds as $existingId) {
        if (!in_array($existingId, $currentIds)) {
          $this->m_rack->where('id', $existingId)->where('pn_qr', $currentPn)->delete();
        }
      }
    }

    return redirect()->to('/check_data');
  }
}
