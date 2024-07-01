<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class BroadcastController extends BaseController
{
    public function index()
    {
        return view("admin/broadcast/index");
    }

    public function post()
    {
        $client = new \GuzzleHttp\Client();
        
        $session = Services::session();
        $request = Services::request();

        $title = $request->getPost('title');
        $message = $request->getPost('message');

        $url = getenv('API_URL') . '/data/broadcast';
        $body = [
            "title" => $title,
            "message" => $message,
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
}
