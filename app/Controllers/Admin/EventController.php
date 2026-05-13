<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class EventController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('API_URL') . '/content-service/event', 'GET');
        $data["event"] = $result->body;

        return view("admin/event/index", $data);
    }

    public function create()
    {
        return view("admin/event/create");
    }

    public function post()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $start = $request->getPost('start');
        $end = $request->getPost('end');
        $description = $request->getPost('description');
        $location = $request->getPost('location');
        $summary = $request->getPost('summary');
        $shareNews = $request->getPost('shareNews');
        $startDate = $request->getPost('startDate');
        $endDate = $request->getPost('endDate');

        if ($shareNews == "true") {
            $shareValue = true;
        } else {
            $shareValue = false;
        }

        // if ($_FILES['picture']) {
        //     $bodyImage = [
        //         "folder" => "images",
        //         "subfolder" => "saka",
        //         "media" => $_FILES['picture']
        //     ];

        //     $result = curlImageHelper(getenv('API_URL') . '/media-service/upload', $bodyImage);
        // }

        $image = $request->getFile('picture');

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
                            'contents' => 'event',
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

        $url = getenv('API_URL') . '/content-service/event';
        $body = [
            "start_date" => $startDate,
            "end_date" => $endDate,
            "description" => $description,
            "start" => date("H:i", strtotime($start)),
            "end" => date("H:i", strtotime($end)),
            "location" => $location,
            "summary" => $summary,
            "picture" => $path ?? '',
            "share_news" => $shareValue,
        ];

        // var_dump($body, "body");
        // die;

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

    public function edit(int $eventId)
    {
        $result = curlHelper(getenv('API_URL') . '/content-service/event/' . $eventId, 'GET');
        $data["event"] = $result->body;

        return view("admin/event/edit", $data);
    }

    public function update()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $eventId = $request->getPost('eventId');
        $start = $request->getPost('start');
        $end = $request->getPost('end');
        $startDate = $request->getPost('startDate');
        $endDate = $request->getPost('endDate');
        $description = $request->getPost('description');
        $location = $request->getPost('location');
        $summary = $request->getPost('summary');
        $image = $request->getFile('picture');
        $imageOld = $request->getPost('imageOld');

        // if (isset($_FILES['picture']) == false) {
        //     $result = curlPortHelper(getenv('API_URL') . '/content-service/event/', 'GET', [], $eventId);
        //     $image = $result->body[0]->Media[0]->media_id;
        // }

        // if (isset($_FILES['picture'])) {
        //     $bodyImage = [
        //         "folder" => "images",
        //         "subfolder" => "saka",
        //         "media" => $_FILES['picture']
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

        $url = getenv('API_URL') . '/content-service/event/' . $eventId;
        $body = [
            "start_date" => $startDate,
            "end_date" => $endDate,
            "description" => $description,
            "start" => date("H:i", strtotime($start)),
            "end" => date("H:i", strtotime($end)),
            "location" => $location,
            "summary" => $summary,
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

    public function detail(int $eventId)
    {
        $result = curlHelper(getenv('API_URL') . '/content-service/event/' . $eventId, 'GET');

        return json_encode([
            "data" =>  $result->body
        ]);
    }

    public function delete(int $eventId)
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();

        $url = getenv('API_URL') . '/content-service/event/' . $eventId;
        $req = $client->delete(
            $url,
            [
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                ]
            ]
        );

        return redirect()->to(base_url('admin/event'));
    }
}
