<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class OrderController extends BaseController
{
  public function status($status)
  {
    $result = curlHelper(getenv('API_URL') . '/commerce-service/order?orderStatus=' . strtoupper($status), 'GET');
    $data["order"] = $result->data;

    return view("admin/reportOrder/index", $data);
  }
}
