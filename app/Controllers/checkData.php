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
    return view('pages/check_data_rack');
  }

  public function inputDataRack()
  {
    $pn_qr = $this->request->getVar('pn_qr');
    $item = $this->request->getVar('item');
    $barcode = $this->request->getVar('barcode');
    $qty = $this->request->getVar('qty');
    $entry_date = $this->request->getVar('entry_date');

    // Validasi jumlah data
    if (
      count($pn_qr) !== count($item) ||
      count($pn_qr) !== count($barcode) ||
      count($pn_qr) !== count($qty) ||
      count($pn_qr) !== count($entry_date)
    ) {
      return redirect()->back()->withInput()->with('error', 'Jumlah data tidak valid');
    }

    // Simpan data ke database
    for ($i = 0; $i < count($pn_qr); $i++) {
      $data = [
        'pn_qr' => $pn_qr[$i],
        'item' => $item[$i],
        'barcode' => $barcode[$i],
        'qty' => $qty[$i],
        'entry_date' => $entry_date[$i],
      ];

      $this->m_rack->save($data);
    }

    return redirect()->to('/check_data');
  }
}
