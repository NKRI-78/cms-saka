<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class OfficialStoreController extends BaseController
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

        try {
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

            if ($resultStore['status'] === 400 && $resultStore['message'] === "Store not found") {
                $data["storeNotFound"] = true;
            } else {
                $data["store"] = $resultStore['data'];
                $province = $resultStore['data']['province'];
                $city = $resultStore['data']['city'];
                $district = $resultStore['data']['district'];

                $resultProvince = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/regions/province', 'GET');
                $resultCity = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/regions/city/' . $province, 'GET');
                $resultDistrict = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/regions/district/' . $city, 'GET');
                $resultSubistrict = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/regions/subdistrict/' . $district, 'GET');

                $data["province"] = $resultProvince->data;
                $data["city"] = $resultCity->data;
                $data["district"] = $resultDistrict->data;
                $data["subdistrict"] = $resultSubistrict->data;
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = (string) $response->getBody();
            $responseArray = json_decode($responseBodyAsString, true);

            // Ambil message dari response jika ada
            if (isset($responseArray['message']) && $responseArray['message'] === "Store not found") {
                // Set kondisi untuk menampilkan tombol "Buka Toko"
                $data['show_open_store_button'] = true;
            } else {
                $data['error_message'] = $responseArray['message'] ?? 'An unexpected error occurred.';
            }
        } catch (\Exception $e) {
            $data['error'] = $e->getMessage();
        }
        // var_dump($data); die;

        return view("admin/officialStore/index", $data);
    }

    public function getCity()
    {
        $request = Services::request();

        $province = $request->getPost('province_id');

        $result = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/regions/city/' . $province, 'GET');
        // var_dump($result); die;

        return json_encode([
            "body" =>  $result->data
        ]);
    }

    public function getDistrict()
    {
        $request = Services::request();

        $city = $request->getPost('city_name');

        $result = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/regions/district/' . $city, 'GET');

        return json_encode([
            "body" =>  $result->data
        ]);
    }

    public function getSubdistrict()
    {
        $request = Services::request();

        $district = $request->getPost('city_name');

        $result = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/regions/subdistrict/' . $district, 'GET');

        return json_encode([
            "body" =>  $result->data
        ]);
    }

    public function update()
    {
        $session = session();
        $user_id = $session->get('userId');

        $resultApp = curlHelper(getenv('ECOMMERCE_URL') . '/apps/v1/all', 'GET');

        $appId = $resultApp->data[0]->id;

        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $store_id = $request->getPost('store_id');
        $title = $request->getPost('title');
        $email = $request->getPost('email');
        $phone = $request->getPost('phone');
        $address = $request->getPost('address');
        $province = $request->getPost('province');
        $city = $request->getPost('city');
        $district = $request->getPost('district');
        $subdistrict = $request->getPost('subdistrict');
        $description = $request->getPost('description');
        $imageOld = $request->getPost('imageOld');
        $posCode = $request->getPost('posCode');

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $bodyImage = [
                "folder" => "saka",
                "subfolder" => "product",
                "media" => $_FILES['image']
            ];

            $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
            $path = $result->data->path;
        } else {
            $path = $imageOld;
        }

        $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/stores/assign';

        $body = [
            "id" => $store_id,
            "name" => $title,
            "logo" => $path,
            "description" => $description,
            "address" => $address,
            "province" => $province,
            "city" => $city,
            "district" => $district,
            "subdistrict" => $subdistrict,
            "postal_code" => $posCode,
            "is_open" => true,
            "phone" => $phone,
            "email" => $email,
            "app_id" => $appId,
            "user_id" => $user_id,
        ];

        // var_dump($body); die;

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

    public function create()
    {
        $resultProvince = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/regions/province', 'GET');

        $data["province"] = $resultProvince->data;

        return view("admin/officialStore/create", $data);
    }

    public function post()
    {
        $session = session();
        $user_id = $session->get('userId');

        $resultApp = curlHelper(getenv('ECOMMERCE_URL') . '/apps/v1/all', 'GET');

        $appId = $resultApp->data[0]->id;

        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $store_id = $request->getPost('store_id');
        $title = $request->getPost('title');
        $email = $request->getPost('email');
        $phone = $request->getPost('phone');
        $address = $request->getPost('address');
        $province = $request->getPost('province');
        $city = $request->getPost('city');
        $district = $request->getPost('district');
        $subdistrict = $request->getPost('subdistrict');
        $description = $request->getPost('description');
        $imageOld = $request->getPost('imageOld');
        $posCode = $request->getPost('posCode');

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $bodyImage = [
                "folder" => "saka",
                "subfolder" => "product",
                "media" => $_FILES['image']
            ];

            $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
            $path = $result->data->path;
        } else {
            $path = $imageOld;
        }

        $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/stores/assign';

        $body = [
            "id" => $store_id,
            "name" => $title,
            "logo" => $path,
            "description" => $description,
            "address" => $address,
            "province" => $province,
            "city" => $city,
            "district" => $district,
            "subdistrict" => $subdistrict,
            "postal_code" => $posCode,
            "is_open" => true,
            "phone" => $phone,
            "email" => $email,
            "app_id" => $appId,
            "user_id" => $user_id,
        ];

        // var_dump($body); die;

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
