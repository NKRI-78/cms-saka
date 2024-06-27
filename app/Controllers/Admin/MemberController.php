<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class MemberController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('API_URL') . '/user-service/users', 'GET');
        $data["member"] = $result->body;

        return view("admin/member/index", $data);
    }

    public function delete($userId)
    {
        $result = curlHelper(getenv('API_URL') . '/user-service/users/delete/' . $userId, 'GET');
    }

    public function edit($userId)
    {
        $result = curlHelper(getenv('API_URL') . '/user-service/profile/' . $userId, 'GET');
        $data["member"] = $result->body;

        return view("admin/member/edit", $data);
    }

    public function update()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $userId = $request->getPost('userId');
        $fullname = $request->getPost('fullname');
        $address = $request->getPost('address');

        $url = getenv('API_URL') . '/user-service/profile/' . $userId;
        $body = [
            "fullname" => $fullname,
            "address" => $address,
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

    public function detail($userId)
    {
        $result = curlHelper(getenv('API_URL') . '/user-service/users/' . $userId, 'GET');

        return json_encode([
            "data" =>  $result->body
        ]);
    }
}
