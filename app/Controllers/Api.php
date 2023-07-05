<?php

namespace App\Controllers;

use App\Models\M_Api;

class Api extends BaseController
{
  public function __construct()
  {
    $this->M_Api = new M_Api();
  }

  public function get_detail_rak($pn_qr = NULL)
  {

    $data = $this->M_Api->get_detail_rak($pn_qr);

    return $this->response->setJSON($data);
  }
}
