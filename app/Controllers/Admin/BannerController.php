<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class BannerController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('API_URL') . '/content-service/banner', 'GET');
        $data["banner"] = $result->body;

        return view("admin/banner/index", $data);
    }

    public function create()
    {
        return view("admin/banner/create");
    }

    public function post()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $name = $request->getPost('name');
        $placement = $request->getPost('placement');

        if ($_FILES['image']) {
            $bodyImage = [
                "folder" => "images",
                "subfolder" => "saka",
                "media" => $_FILES['image']
            ];

            $result = curlImageHelper(getenv('API_URL') . '/media-service/upload', $bodyImage);
        }


        $url = getenv('API_URL') . '/content-service/banner';
        $body = [
            "name" => $name,
            "placement" => intval($placement),
            "picture" => isset($_FILES['image']) ? $result->data->media_id : '',
        ];

        $req = $client->post(
            $url,
            [
                "body" => json_encode($body),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                ]
            ]
        );
    }

    public function edit($bannerId)
    {
        $result = curlPortHelper(getenv('API_URL') . '/content-service/banner/', 'GET', [], $bannerId);
        $data["banner"] = $result->body;

        return view("admin/banner/edit", $data);
    }

    public function update()
    {  
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();
        
        $bannerId = $request->getPost('bannerId');
        $name = $request->getPost('name');
        $placement = $request->getPost('placement');

        if (isset($_FILES['image']) == false) {
            $result = curlPortHelper(getenv('API_URL') . '/content-service/banner/', 'GET', [], $bannerId);
            $image = $result->body[0]->Media[0]->media_id;
        }

        if (isset($_FILES['image'])) {
            $bodyImage = [
                "folder" => "images",
                "subfolder" => "saka",
                "media" => $_FILES['image']
            ];

            $result = curlImageHelper(getenv('API_URL') . '/media-service/upload', $bodyImage);
        }

        $url = getenv('API_URL') . '/content-service/banner/' . $bannerId;
        $body = [
            "name" => $name,
            "placement" => intval($placement),
            "picture" => isset($_FILES['image']) ? $result->data->media_id : $image,
        ];

        $req = $client->put(
            $url,
            [
                "body" => json_encode($body),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                ]
            ]
        );
    }

    public function detail($bannerId)
    {
        $result = curlPortHelper(getenv('API_URL') . '/content-service/banner/', 'GET', [], $bannerId);

        return json_encode([
            "data" =>  $result->body
        ]);
    }

    public function delete($bannerId)
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();

        $url = getenv('API_URL') . '/content-service/banner/' . $bannerId;
        $req = $client->delete(
            $url,
            [
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                ]
            ]
        );

        return redirect()->to(base_url('admin/banner'));
    }
}
