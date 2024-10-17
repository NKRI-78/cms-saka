<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class TopupController extends BaseController
{
    public function index()
    {
        return view("admin/topup/index");
    }

    public function getData()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $postData = [
            'app_name' => 'saka'
        ];

        $result = getenv('ECOMMERCE_URL') . '/ecommerces/v1/transaction/info/topup';

        try {
            $response = $client->post(
                $result,
                [
                    "json" => $postData,
                    'headers' =>  [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json',
                    ]
                ]
            );
    
            $responseBody = json_decode($response->getBody()->getContents(), true);
    
    
            return json_encode([
                "body" => $responseBody
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Menangkap error dan mengembalikan pesan error
            return json_encode([
                "error" => $e->getMessage(),
                "response" => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null,
            ]);
        }
    }
}
