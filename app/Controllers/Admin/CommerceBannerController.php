<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class CommerceBannerController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('COMMERCE_URL') . '/banner/list', 'GET');
        $data["banner"] = $result->body;

        return view("admin/commerceBanner/index", $data);
    }

    public function create()
    {
        return view("admin/commerceBanner/create");
    }

    public function postBanner()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();
        $dataFiles = array();

        $files = $_FILES['image'];
        $actionType = $request->getPost('actionType');
        $index = $request->getPost('index');
        $targetId = $request->getPost('targetId');

        if (isset($files)) {
            $url = getenv('API_URL') . '/commerce-service/upload';
            $options = [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($files['tmp_name'], 'r'),
                        'filename' => $files['name']
                    ],
                ],
            ];

            $req = $client->post($url, $options);
            $response = $req->getBody()->getContents();
            $result = json_decode($response);
            array_push($dataFiles, $result->data);
        }

        $url = getenv('COMMERCE_URL') . '/banner/create';
        $data = [
            "index" => $index,
            "image" => $dataFiles[0],
            "actionType" => $actionType,
            "targetId" => $targetId
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

    public function edit($bannerId)
    {
        $result = curlHelper(getenv('COMMERCE_URL') . '/banner/fetch/' . $bannerId, 'GET');
        $data["banner"] = $result->body;

        return view("admin/commerceBanner/edit", $data);
    }

    public function update()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();

        $bannerId = $request->getPost('bannerId');
        $actionType = $request->getPost('actionType');
        $index = $request->getPost('index');
        $targetId = $request->getPost('targetId');

        if (isset($_FILES['image']) == false) {
            $result = curlHelper(getenv('COMMERCE_URL') . '/banner/fetch/' . $bannerId, 'GET');
            $dataFiles = $result->body->image;
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
            $dataFiles = $result->data;
        }

        $url = getenv('COMMERCE_URL') . '/banner/update';
        $data = [
            "id" => $bannerId,
            "index" => $index,
            "image" => $dataFiles,
            "status" => 1,
            "actionType" => $actionType,
            "targetId" => $targetId
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

    public function delete($bannerId)
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();

        $url = getenv('COMMERCE_URL') . '/banner/update';
        $data = [
            "id" => $bannerId,
            "status" => 0,
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

        return redirect()->to(base_url('admin/banner'));
    }

    public function detail($bannerId)
    {
        $result = curlHelper(getenv('COMMERCE_URL') . '/banner/fetch/' . $bannerId, 'GET');

        return json_encode([
            "data" => $result->body
        ]);
    }
}