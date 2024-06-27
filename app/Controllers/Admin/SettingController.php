<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class SettingController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('API_URL') . '/user-service/profile/'. session("userId"), 'GET');
        $data["profile"] = $result->body;

        return view("admin/setting/index", $data);
    }

    public function changePassword()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $oldPassword = $request->getPost('oldPassword');
        $newPassword = $request->getPost('newPassword');
        $confirmNewPassword = $request->getPost('confirmNewPassword');


        $url = getenv('API_URL') . '/user-service/change-password';
        $body = [
            "old_password" => $oldPassword,
            "new_password" => $newPassword,
            "confirm_new_password" => $confirmNewPassword,
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
