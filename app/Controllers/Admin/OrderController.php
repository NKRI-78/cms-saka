<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class OrderController extends BaseController
{
  // public function status($status)
  // {
  //   $result = curlHelper(getenv('API_URL') . '/commerce-service/order?orderStatus=' . strtoupper($status), 'GET');
  //   $data["order"] = $result->data;

  //   return view("admin/reportOrder/index", $data);
  // }

  public function status($status)
  {
    $client = new \GuzzleHttp\Client();
    $session = Services::session();
    $request = Services::request();
    $user_id = $session->get('userId');

    $statusMapping = [
      'received' => 'WAITING_PAYMENT',
      'confirmed' => 'PAID',
      'packing' => 'PACKING',
      'shipping' => 'ON PROCESS',
      'delivered' => 'DELIVERED',
      // 'done' => 'DONE',
      // 'cancelled' => 'CANCELLED',
    ];

    if (isset($statusMapping[$status])) {
      $privateStatus = $statusMapping[$status];

      $postData = [
        'app' => 'saka',
        'user_id' => $user_id,
        // 'user_id' => '21244e96-b9ff-40aa-b4b9-1c2e6dffd905',
        'order_status' => $privateStatus
      ];

      $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/order/seller/list';

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
      $data["order"] = $resultStore['data'];

      // foreach ($data["order"] as $index => $order) {
      //   $transaction_id = $order['transaction_id'];

      //   $detailPostData = [
      //     'transaction_id' => $transaction_id,
      //     'app' => 'saka'
      //   ];

      //   $detailUrl = getenv('ECOMMERCE_URL') . '/ecommerces/v1/order/detail';

      //   try {
      //     $detailResponse = $client->post(
      //       $detailUrl,
      //       [
      //         "body" => json_encode($detailPostData),
      //         'headers' =>  [
      //           'Authorization' => 'Bearer ' . $session->get('token'),
      //           'Accept'        => 'application/json',
      //           'Content-Type'  => 'application/json',
      //         ]
      //       ]
      //     );

      //     $productDetail = json_decode($detailResponse->getBody(), true);

      //     // Periksa apakah ada error atau produk ditemukan
      //     if (isset($productDetail['error']) && $productDetail['error'] === true) {
      //       // Jika produk tidak ditemukan, tambahkan informasi ke dalam order
      //       $data["order"][$index]['product_detail'] = "Product not found";
      //     } else {
      //       // Jika produk ditemukan, tambahkan detail produk ke dalam order berdasarkan indeks
      //       $data["order"][$index]['product_detail'] = $productDetail['data'];
      //     }
      //   } catch (\Exception $e) {
      //     // Tangani jika ada error dalam permintaan ke API kedua
      //     $data["order"][$index]['product_detail'] = "Error fetching product details: " . $e->getMessage();
      //   }
      // }

      // var_dump($data); die;
      return view("admin/reportOrder/index", $data);
    }
  }

  public function detail($transactionId)
  {
    $client = new \GuzzleHttp\Client();
    $session = Services::session();

    $payload = [
      'transaction_id' => $transactionId,
      'app' => 'saka'
    ];

    $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/order/detail';

    $response = $client->post(
      $url,
      [
        "body" => json_encode($payload),
        'headers' =>  [
          'Authorization' => 'Bearer ' . $session->get('token'),
          'Accept'        => 'application/json',
          'Content-Type'  => 'application/json',
        ]
      ]
    );

    $result = json_decode($response->getBody(), true);

    return json_encode([
      "body" =>  $result['data']
    ]);
  }

  public function confirmed()
  {
    $client = new \GuzzleHttp\Client();
    $session = Services::session();
    $request = Services::request();
    $user_id = $session->get('userId');

    $transactionId = $request->getPost('transactionId');
    $buyerId = $request->getPost('buyerId');

    $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/order/confirm';

    $body = [
      // "user_id" => $user_id,
      "user_id" => $buyerId,
      "transaction_id" => $transactionId,
      "app" => "saka",
    ];

    $req = $client->post(
      $url,
      [
        "body" => json_encode($body),
        'headers' =>  [
          'Authorization' => 'Bearer ' . $session->get('token'),
          'Accept'        => 'application/json',
          'Content-Type' => 'application/json'
        ]
      ]
    );
  }
}
