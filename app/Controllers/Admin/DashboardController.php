<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class DashboardController extends BaseController
{
  public function index()
  {
    $client = new \GuzzleHttp\Client();
    $session = Services::session();
    $request = Services::request();

    $session = session();
    $user_id = $session->get('userId');

    $postData = [
      'user_id' => $user_id
      // 'user_id' => '61f19d24-3826-4f6d-8c80-121da8a2fc3a'
    ];

    $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/stores';

    $response = $client->post(
      $url,
      [
        "body" => json_encode($postData),
        'headers' =>  [
          'Authorization' => 'Bearer ' . $session->get('token'),
          'Accept'        => 'application/json',
          'Content-Type'  => 'application/json',
        ]
      ]
    );

    $resultStore = json_decode($response->getBody(), true);

    $storeId = $resultStore['data']['id'];

    $body = [
      'store_id' => $storeId
    ];

    $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/stores/revenue';

    $responseRevenue = $client->post(
      $url,
      [
        "body" => json_encode($body),
        'headers' =>  [
          'Authorization' => 'Bearer ' . $session->get('token'),
          'Accept'        => 'application/json',
          'Content-Type'  => 'application/json',
        ]
      ]
    );

    $resultRevenue = json_decode($responseRevenue->getBody(), true);

    $data["revenue"] = $resultRevenue['data'];

    return view("admin/dashboard/index", $data);
  }
}
