<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class NewsController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('API_URL') . '/content-service/article', 'GET');
        $data["news"] = $result->body;

        return view("admin/news/index", $data);
    }

    public function create()
    {
        return view("admin/news/create");
    }

    public function post()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $title = $request->getPost('title');
        $highlight = $request->getPost('highlight');
        $content = $request->getPost('content');
        $content =  str_replace("&lsquo;", '"', str_replace("&rsquo;", '"', str_replace("&rdquo;", '"', str_replace("&ldquo;", '"', str_replace("&quot;", '"', str_replace("&nbsp;", "", $content))))));

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

        $url = getenv('API_URL') . '/content-service/article';
        $body = [
            "content" =>  $content,
            "highlight" => intval($highlight),
            "title" => $title,
            "type" => "news",
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

    public function edit(int $newsId)
    {
        $result = curlHelper(getenv('API_URL') . '/content-service/article/' . $newsId, 'GET');
        $data["news"] = $result->body;

        return view("admin/news/edit", $data);
    }

    public function update()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $newsId = $request->getPost('newsId');
        $title = $request->getPost('title');
        $highlight = $request->getPost('highlight');
        $content = $request->getPost('content');
        $content =  str_replace("&lsquo;", '"', str_replace("&rsquo;", '"', str_replace("&rdquo;", '"', str_replace("&ldquo;", '"', str_replace("&quot;", '"', str_replace("&nbsp;", "", $content))))));
        $image = $request->getFile('image');
        $imageOld = $request->getPost('imageOld');

        // if (isset($_FILES['image']) == false) {
        //     $result = curlPortHelper(getenv('API_URL') . '/content-service/article/', 'GET', [], $newsId);
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
            $path = $imageOld;
        }

        $url = getenv('API_URL') . '/content-service/article/' . $newsId;
        $body = [
            "content" =>  $content,
            "highlight" => intval($highlight),
            "title" => $title,
            "type" => "news",
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

    public function detail(int $newsId)
    {
        $result = curlHelper(getenv('API_URL') . '/content-service/article/' . $newsId, 'GET');

        return json_encode([
            "data" =>  $result->body
        ]);
    }

    public function delete(int $newsId)
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();

        $url = getenv('API_URL') . '/content-service/article/' . $newsId;
        $req = $client->delete(
            $url,
            [
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                ]
            ]
        );

        return redirect()->to(base_url('admin/news'));
    }
}
