<?php

namespace App\Controllers\User;

use App\Controllers\Base\BaseController;
use Config\Services;

class ProductController extends BaseController
{
  public function index()
  {
    $session = Services::session();
    $data = array();
    $userId = $session->get('userId');

    $resultProduct = curlHelper(getenv('API_URL') . '/commerce-service/product?owner=' . $userId, 'GET');
    $resultCategory = curlHelper(getenv('API_URL') . '/commerce-service/category', 'GET');

    $data["product"] = $resultProduct->data;
    $data["category"] = $resultCategory->data;

    return view("user/product/index", $data);
  }

  public function create()
  {
    $data = array();

    $result = curlHelper(getenv('API_URL') . '/commerce-service/category', 'GET');

    $data["category"] = $result->data;

    return view("user/product/create", $data);
  }

  public function postProduct()
  {
    $session = Services::session();
    $client = new \GuzzleHttp\Client();
    $request = Services::request();
    $userId = $session->get('userId');
    $storeId = $session->get('storeId');
    $dataFiles = array();

    $files = $_FILES['files'];
    $name = $request->getPost('name');
    $price = $request->getPost('price');
    $weight = $request->getPost('weight');
    $stock = $request->getPost('stock');
    $description = $request->getPost('description');
    $category = $request->getPost('category');
    $condition = $request->getPost('condition');
    $minOrder = $request->getPost('minOrder');

    if (isset($files)) {
      for ($i = 0; $i < count($files['name']); $i++) {
        $url = getenv('API_URL') . '/commerce-service/upload';
        $options = [
          'multipart' => [
            [
              'name' => 'file',
              'contents' => fopen($files['tmp_name'][$i], 'r'),
              'filename' => $files['name'][$i]
            ],
          ],
        ];

        $req = $client->post($url, $options);
        $response = $req->getBody()->getContents();
        $result = json_decode($response);
        array_push($dataFiles, $result->data);
      }
    }

    $url = getenv('API_URL') . '/commerce-service/product';
    $data = [
      "name" => $name,
      "price" => intval($price),
      "pictures" => $dataFiles,
      "owner" => $userId,
      "weight" => intval($weight),
      "description" => $description,
      "stock" => intval($stock),
      "condition" => $condition,
      "minOrder" => intval($minOrder),
      "CategoryOid" => $category,
      "StoreOid" => $storeId
    ];

    $req = $client->post(
      $url,
      [
        "body" => json_encode($data),
        'headers' =>  [
          'Authorization' => 'Bearer ' . $session->get('token'),
          'Accept'        => 'application/json',
        ]
      ]
    );
  }

  public function detail($productId)
  {
    $data = array();
    $result = curlHelper(getenv('API_URL') . '/commerce-service/product?productId=' . $productId, 'GET');

    $data["product"] = $result->data;

    return view("user/product/detail", $data);
  }

  public function edit($productId)
  {
    $data = array();
    $resultProduct = curlHelper(getenv('API_URL') . '/commerce-service/product?productId=' . $productId, 'GET');
    $resultCategory = curlHelper(getenv('API_URL') . '/commerce-service/category', 'GET');

    $data["product"] = $resultProduct->data;
    $data["category"] = $resultCategory->data;

    return view("user/product/edit", $data);
  }

  public function updateProduct()
  {
    $session = Services::session();
    $client = new \GuzzleHttp\Client();
    $request = Services::request();
    $dataFiles = array();

    $productId = $request->getPost('productId');
    $name = $request->getPost('name');
    $price = $request->getPost('price');
    $weight = $request->getPost('weight');
    $stock = $request->getPost('stock');
    $description = $request->getPost('description');
    $category = $request->getPost('category');
    $condition = $request->getPost('condition');
    $minOrder = $request->getPost('minOrder');

    if (isset($_FILES['files']) == false) {
      $result = curlHelper(getenv('API_URL') . '/commerce-service/product?productId=' . $productId, 'GET');
      $dataFiles = $result->data[0]->pictures;
    }

    if (isset($_FILES['files'])) {
      for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
        $url = getenv('API_URL') . '/commerce-service/upload';
        $options = [
          'multipart' => [
            [
              'name' => 'file',
              'contents' => fopen($_FILES['files']['tmp_name'][$i], 'r'),
              'filename' => $_FILES['files']['name'][$i]
            ],
          ],
        ];

        $req = $client->post($url, $options);
        $response = $req->getBody()->getContents();
        $result = json_decode($response);
        array_push($dataFiles, $result->data);
      }
    }

    $url = getenv('API_URL') . '/commerce-service/product?productId=' . $productId;

    $data = [
      "name" => $name,
      "price" => intval($price),
      "pictures" => $dataFiles,
      "weight" => intval($weight),
      "description" => $description,
      "stock" => intval($stock),
      "condition" => $condition,
      "minOrder" => intval($minOrder),
      "CategoryOid" => $category,
      "status" => 1
    ];

    $req = $client->put(
      $url,
      [
        "body" => json_encode($data),
        'headers' =>  [
          'Authorization' => 'Bearer ' . $session->get('token'),
          'Accept'        => 'application/json',
        ]
      ]
    );
  }

  public function importProduct()
  {
    $session = Services::session();
    $client = new \GuzzleHttp\Client();
    $request = Services::request();
    $userId = $session->get('userId');
    $storeId = $session->get('storeId');

    $file = $_FILES['file'];
    $category = $request->getPost('category');

    if (isset($file)) {
      $url = getenv('API_URL') . '/commerce-service/import-product';
      $options = [
        'multipart' => [
          [
            'name' => 'file',
            'contents' => fopen($file['tmp_name'], 'r'),
            'filename' => $file['name']
          ],
          [
            'name'     => 'categoryId',
            'contents' => $category
          ],
          [
            'name'     => 'storeId',
            'contents' => $storeId
          ],
          [
            'name'     => 'owner',
            'contents' => $userId
          ]
        ],
        'headers' =>  [
          'Authorization' => 'Bearer ' . $session->get('token'),
          'Accept'        => 'application/json',
        ],
      ];

      $req = $client->post($url, $options);
      $response = $req->getBody()->getContents();
      $result = json_decode($response);
      var_dump($result);
    }
  }

  public function templateProduct()
  {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="product.csv"');

    // Header
    $user_CSV[0] = array('Name Product', 'Price', 'Weight', 'Description', 'Stock', 'Condition', 'Min Order');

    // Isi
    $user_CSV[1] = array('Sample Product', 50000, 34, 'Sample Description', 4, 'NEW', 3);

    $fp = fopen('php://output', 'wb');
    foreach ($user_CSV as $line) {
      // delimeter
      fputcsv($fp, $line, ';');
    }
    fclose($fp);
  }
}
