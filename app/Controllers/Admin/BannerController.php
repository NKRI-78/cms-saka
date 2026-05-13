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

        // if ($_FILES['image']) {
        //     $bodyImage = [
        //         "folder" => "images",
        //         "subfolder" => "saka",
        //         "media" => $_FILES['image']
        //     ];

        //     $result = curlImageHelper(getenv('API_URL') . '/media-service/upload', $bodyImage);
        // }

        $image = $request->getFile('image');

        $path = null;

        if ($image && $image->isValid()) {

            try {
                $mediaResponse = $client->post(getenv('API_MEDIA') . '/api/v1/media/upload-local', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                    ],
                    'multipart' => [
                        [
                            'name' => 'folder',
                            'contents' => 'Saka',
                        ],
                        [
                            'name' => 'subfolder',
                            'contents' => 'banner',
                        ],
                        [
                            'name'     => 'media',
                            'contents' => fopen($image->getTempName(), 'r'),
                            'filename' => $image->getClientName(),
                        ],
                    ],
                ]);

                $result = json_decode($mediaResponse->getBody(), true);

                $path = $result['data']['path'] ?? null;
            } catch (\Exception $e) {

                echo 'Error uploading image: ' . $e->getMessage();
            }
        }

        $url = getenv('API_URL') . '/content-service/banner';
        $body = [
            "name" => $name,
            "placement" => intval($placement),
            "picture" => $path ?? '',
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

    public function edit(int $bannerId)
    {
        $result = curlPortHelper(getenv('API_URL') . '/content-service/banner/', 'GET', [], $bannerId);
        $data["banner"] = $result->body ?? [];

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
        $image = $request->getFile('image');
        $bannerOldImage = $request->getPost('bannerOld');

        // if (isset($_FILES['image']) == false) {
        //     $result = curlPortHelper(getenv('API_URL') . '/content-service/banner/', 'GET', [], $bannerId);
        //     $image = $result->body[0]->Media[0]->media_id;
        // }

        // if (isset($_FILES['image'])) {
        //     $bodyImage = [
        //         "folder" => "images",
        //         "subfolder" => "saka",
        //         "media" => $_FILES['image']
        //     ];

        //     $result = curlImageHelper(getenv('API_URL') . '/media-service/upload', $bodyImage);
        // }

        $path = null;

        if ($image && $image->isValid()) {
            try {
                $mediaResponse = $client->post(getenv('API_MEDIA') . '/api/v1/media/upload-local', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                    ],
                    'multipart' => [
                        [
                            'name' => 'folder',
                            'contents' => 'atj',
                        ],
                        [
                            'name' => 'subfolder',
                            'contents' => 'news',
                        ],
                        [
                            'name'     => 'media',
                            'contents' => fopen($image->getTempName(), 'r'),
                            'filename' => $image->getClientName(),
                        ],
                    ],
                ]);

                $result = json_decode($mediaResponse->getBody(), true);

                $path = $result['data']['path'] ?? null;
            } catch (\Exception $e) {

                echo 'Error uploading image: ' . $e->getMessage();
            }
        } else {
            $path = $bannerOldImage;
        }

        $url = getenv('API_URL') . '/content-service/banner/' . $bannerId;
        $body = [
            "name" => $name,
            "placement" => intval($placement),
            "picture" => $path,
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

    public function detail(int $bannerId)
    {
        $result = curlPortHelper(getenv('API_URL') . '/content-service/banner/', 'GET', [], $bannerId);

        return json_encode([
            "data" =>  $result->body
        ]);
    }

    public function delete(int $bannerId)
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
