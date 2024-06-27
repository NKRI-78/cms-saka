<?php

namespace App\Controllers\Auth;

use App\Controllers\Base\BaseController;
use Config\Services;
use GuzzleHttp\Client;

class LoginController extends BaseController
{
    public function index()
    {
        return view("auth/login");
    }

    public function store()
    {
        $data = array();
        $request = Services::request();

        $phoneNumber = $request->getPost('phoneNumber');
        $password = $request->getPost('password');

        $client = new Client();
        $data = array(
            'phone_number' => $phoneNumber,
            'password' => $password
        );
        $url = getenv('API_URL') . '/user-service/login';

        $req = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);

        $response = $req->getBody()->getContents();
        
        $result = json_decode($response);

        // $resultStore = curlHelper(getenv('API_URL') . '/commerce-service/store?owner=' . $result->body->user->user_id, 'GET');

        // if ($resultStore->data != NULL) {
        //     $storeId = $resultStore->data[0]->_id;
        // }

        return json_encode([
            "authenticated" => true,
            "fullname" => $result->body->user->fullname,
            "userId" => $result->body->user->user_id,
            "token" => $result->body->token,
            "storeId" => null,
            "role" =>  $result->body->user->role,
        ]);
    }

    public function session()
    {
        $data = array();
        $request = Services::request();
        $session = Services::session();
        $token = $request->getPost('token');
        $fullname = $request->getPost('fullname');
        $userId = $request->getPost('userId');
        $storeId = $request->getPost('storeId');
        $role = $request->getPost('role');

        $data["token"] = $token;
        $data["fullname"] = $fullname;
        $data["userId"] = $userId;
        $data["storeId"] = $storeId;
        $data["role"] = $role;
        $data["authenticated"] = true;
        $session->set($data);
    }

    public function logout()
    {
        $session = Services::session();
        $session->remove('token');
        $session->remove('fullname');
        $session->remove('storeId');
        $session->remove('userId');
        $session->remove('role');
        $session->remove('authenticated');

        return redirect()->to(base_url('auth/login'));
    }
}
