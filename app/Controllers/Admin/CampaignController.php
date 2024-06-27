<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class CampaignController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('COMMERCE_URL') . '/campaign/list', 'GET');
        $data["campaign"] = $result->body;

        return view("admin/campaign/index", $data);
    }

    public function create()
    {
        $result = curlHelper(getenv('API_URL') . '/commerce-service/product', 'GET');
        $data["product"] = $result->data;

        return view("admin/campaign/create", $data);
    }

    public function post()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();

        $index = $request->getPost("index");
        $title = $request->getPost("title");
        $subtitle = $request->getPost("subtitle");
        $backgroundColor = $request->getPost("backgroundColor");
        $titleColor = $request->getPost("titleColor");
        $titleBgColor = $request->getPost("titleBgColor");
        $campaignType = $request->getPost("campaignType");
        $startDate = $request->getPost("startDate");
        $endDate = $request->getPost("endDate");
        $products = $request->getPost("products");

        $startFormat = date("Y-m-d H:i:s", strtotime($startDate));
        $endFormat = date("Y-m-d H:i:s", strtotime($endDate));

        $dataProduct = array();
        $split = explode(",", $products);

        foreach ($split as $value) {
            $dataProduct[] = $value;
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

        $url = getenv('COMMERCE_URL') . '/campaign/create';
        $data = [
            "index" => $index,
            "title" => $title,
            "subtitle" => $subtitle,
            "backgroundColor" => str_replace('#', '', $backgroundColor),
            "titleColor" => str_replace('#', '', $titleColor),
            "titleBgColor" => str_replace('#', '', $titleBgColor),
            "campaignType" => $campaignType,
            "startDate" => $startFormat,
            "endDate" => $endFormat,
            "image" => $dataFiles,
            "products" => $dataProduct,
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

    public function edit($campaignId)
    {
        $result = curlHelper(getenv('COMMERCE_URL') . '/campaign/fetch/' . $campaignId, 'GET');
        $data["campaign"] = $result->body;

        return view("admin/campaign/edit", $data);
    }

    public function update()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();

        $campaignId = $request->getPost("campaignId");
        $index = $request->getPost("index");
        $title = $request->getPost("title");
        $subtitle = $request->getPost("subtitle");
        $backgroundColor = $request->getPost("backgroundColor");
        $titleColor = $request->getPost("titleColor");
        $titleBgColor = $request->getPost("titleBgColor");
        $campaignType = $request->getPost("campaignType");
        $startDate = $request->getPost("startDate");
        $endDate = $request->getPost("endDate");
        $products = $request->getPost("products");

        $startFormat = date("Y-m-d H:i:s", strtotime($startDate));
        $endFormat = date("Y-m-d H:i:s", strtotime($endDate));

        $dataProduct = array();
        $split = explode(",", $products);

        foreach ($split as $value) {
            $dataProduct[] = $value;
        }

        if (isset($_FILES['image']) == false) {
            $result = curlHelper(getenv('COMMERCE_URL') . '/campaign/fetch/' . $campaignId, 'GET');
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

        $url = getenv('COMMERCE_URL') . '/campaign/update';
        $data = [
            "id" => $campaignId,
            "index" => $index,
            "title" => $title,
            "subtitle" => $subtitle,
            "backgroundColor" => str_replace('#', '', $backgroundColor),
            "titleColor" => str_replace('#', '', $titleColor),
            "titleBgColor" => str_replace('#', '', $titleBgColor),
            "campaignType" => $campaignType,
            "startDate" => $startFormat,
            "endDate" => $endFormat,
            "image" => $dataFiles,
            "products" => $dataProduct,
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

    public function delete($campaignId)
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();

        $url = getenv('COMMERCE_URL') . '/campaign/update';
        $data = [
            "id" => $campaignId,
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

        return redirect()->to(base_url('admin/campaign'));
    }
}
