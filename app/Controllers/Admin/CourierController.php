<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class CourierController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('API_URL') . '/commerce-service/courier/list', 'GET');
        $data["courier"] = $result->data;

        return view("admin/courier/index", $data);
    }

    public function create()
    {
        return view("admin/courier/create");
    }

    public function post()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();

        $courierId = $request->getPost('courierId');
        $name = $request->getPost('name');
        $checkPriceSupported = $request->getPost('checkPriceSupported');
        $checkResiSupported = $request->getPost('checkResiSupported');
       
        if (isset($_FILES['image'])) {
            $url = getenv('API_URL') . '/commerce-service/upload';
            $options = [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($_FILES['image']['tmp_name'], 'r'),
                        'filename' => $_FILES['image']['name']
                    ],
                ],
            ];

            $req = $client->post($url, $options);
            $response = $req->getBody()->getContents();
            $result = json_decode($response);
            $path = $result->data->path;
        }

        if ($checkPriceSupported == "true") {
            $checkPriceSupported = true;
        } else {
            $checkPriceSupported = false;
        }

        if ($checkResiSupported == "true") {
            $checkResiSupported = true;
        } else {
            $checkResiSupported = false;
        }

        $url = getenv('API_URL') . '/commerce-service/courier/create';
        $data = [
            "courierId" => $courierId,
            "name" => $name,
            "image" => $path,
            "checkPriceSupported" => $checkPriceSupported,
            "checkResiSupported" => $checkResiSupported,
            "status" => 1
        ];

        $req = $client->post(
            $url,
            [
                "body" => json_encode($data),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );
        $response = $req->getBody()->getContents();
        $result = json_decode($response);
    }

    public function edit($courierId)
    {
        $result = curlHelper(getenv('API_URL') . '/commerce-service/courier/list?courierId=' . $courierId, 'GET');
        $data["courier"] = $result->data;

        return view("admin/courier/edit", $data);
    }

    public function update()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();

        $courierId = $request->getPost('courierId');
        $name = $request->getPost('name');
        $checkPriceSupported = $request->getPost('checkPriceSupported');
        $checkResiSupported = $request->getPost('checkResiSupported');

        if (isset($_FILES['image']) == false) {
            $result = curlHelper(getenv('API_URL') . '/commerce-service/courier/list?courierId=' . $courierId, 'GET');
            $image = $result->data[0]->image;
        }

        if (isset($_FILES['image'])) {
            $url = getenv('API_URL') . '/commerce-service/upload';
            $options = [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($_FILES['image']['tmp_name'], 'r'),
                        'filename' => $_FILES['image']['name']
                    ],
                ],
            ];

            $req = $client->post($url, $options);
            $response = $req->getBody()->getContents();
            $result = json_decode($response);
            $image = $result->data->path;
        }

        if ($checkPriceSupported == "true") {
            $checkPriceSupported = true;
        } else {
            $checkPriceSupported = false;
        }

        if ($checkResiSupported == "true") {
            $checkResiSupported = true;
        } else {
            $checkResiSupported = false;
        }

        $url = getenv('API_URL') . '/commerce-service/courier/update?courierId=' . $courierId;
        $data = [
            "courierId" => $courierId,
            "name" => $name,
            "image" => $image,
            "checkPriceSupported" => $checkPriceSupported,
            "checkResiSupported" => $checkResiSupported,
            "status" => 1
        ];

        $req = $client->put(
            $url,
            [
                "body" => json_encode($data),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );
    }

    public function delete($courierId)
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();

        $url = getenv('API_URL') . '/commerce-service/courier/list?courierId=' . $courierId;
        $result = curlHelper($url, 'GET');

        $data = [
            "courierId" => $result->data[0]->_id,
            "name" => $result->data[0]->name,
            "image" => $result->data[0]->image,
            "checkPriceSupported" => $result->data[0]->checkPriceSupported,
            "checkResiSupported" => $result->data[0]->checkResiSupported,
            "status" => 0
        ];

        $url = getenv('API_URL') . '/commerce-service/courier/update?courierId=' . $courierId;
        $req = $client->put(
            $url,
            [
                "body" => json_encode($data),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );

        return redirect()->to(base_url('admin/courier'));
    }

    public function detail($courierId)
    {
        $result = curlHelper(getenv('API_URL') . '/commerce-service/courier-service/list?courierId=' . $courierId, 'GET');
        $data["courier"] = $result->data;

        return view("admin/courier/detail", $data);
    }

    public function createService($courierId)
    {
        $data["courierId"] = $courierId;

        return view("admin/courier/createService", $data);
    }

    public function postService()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();

        $courierId = $request->getPost('courierId');
        $name = $request->getPost('name');
        $code = $request->getPost('code');
        $type = $request->getPost('type');
        $minWeight = $request->getPost('minWeight');
        $estimateDays = $request->getPost('estimateDays');

        $url = getenv('API_URL') . '/commerce-service/courier-service/create';
        $data = [
            "courierId" => $courierId,
            "name" => $name,
            "code" => $code,
            "type" => $type,
            "minWeight" => intval($minWeight),
            "estimateDays" => $estimateDays,
            "status" => 1
        ];

        $req = $client->post(
            $url,
            [
                "body" => json_encode($data),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );
        $response = $req->getBody()->getContents();
        $result = json_decode($response);
    }

    public function editService($courierServiceId, $courierId)
    {
        $result = curlHelper(getenv('API_URL') . '/commerce-service/courier-service/list?courierServiceId=' . $courierServiceId, 'GET');
        $data["courier"] = $result->data;
        $data["courierId"] = $courierId;

        return view("admin/courier/editService", $data);
    }

    public function updateService()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();

        $courierId = $request->getPost('courierId');
        $courierServiceId = $request->getPost('courierServiceId');
        $name = $request->getPost('name');
        $code = $request->getPost('code');
        $type = $request->getPost('type');
        $minWeight = $request->getPost('minWeight');
        $estimateDays = $request->getPost('estimateDays');

        $url = getenv('API_URL') . '/commerce-service/courier-service/update?courierId=' . $courierServiceId;
        $data = [
            "courierId" => $courierId,
            "name" => $name,
            "code" => $code,
            "type" => $type,
            "minWeight" => intval($minWeight),
            "estimateDays" => $estimateDays,
            "status" => 1
        ];

        $req = $client->put(
            $url,
            [
                "body" => json_encode($data),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );
        $response = $req->getBody()->getContents();
        $result = json_decode($response);
    }

    public function deleteService($courierServiceId, $courierId)
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();

        $result = curlHelper(getenv('API_URL') . '/commerce-service/courier-service/list?courierServiceId=' . $courierServiceId, 'GET');

        $url = getenv('API_URL') . '/commerce-service/courier-service/update?courierId=' . $courierServiceId;
        $data = [
            "courierId" => $courierId,
            "name" => $result->data[0]->name,
            "code" => $result->data[0]->code,
            "type" => $result->data[0]->type,
            "minWeight" => $result->data[0]->minWeight,
            "estimateDays" => $result->data[0]->estimateDays,
            "status" => 0
        ];

        $req = $client->put(
            $url,
            [
                "body" => json_encode($data),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );

        return redirect()->to(base_url('admin/courier/detail/' . $courierId));
    }
}
