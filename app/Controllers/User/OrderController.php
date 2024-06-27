<?php

namespace App\Controllers\User;

use App\Controllers\Base\BaseController;
use Config\Services;

class OrderController extends BaseController
{
  public function index()
  {
    $session = Services::session();
    $data = array();
    $storeId = $session->get('storeId');

    $result = curlHelper(getenv('API_URL') . '/commerce-service/order?storeId=' . $storeId, 'GET');

    $data["order"] = $result->data;

    return view("user/order/index", $data);
  }

  public function status($status)
  {
    $session = Services::session();
    $data = array();
    $storeId = $session->get('storeId');

    $result = curlHelper(getenv('API_URL') . '/commerce-service/order?storeId=' . $storeId . '&orderStatus=' . strtoupper($status), 'GET');

    $data["order"] = $result->data;

    return view("user/order/index", $data);
  }
}
