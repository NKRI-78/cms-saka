<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class ConfigurationController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('API_URL') . '/commerce-service/configuration/list', 'GET');
        $data["configuration"] = $result->data;

        return view("admin/configuration/index", $data);
    }

    public function edit()
    {
        $result = curlHelper(getenv('API_URL') . '/commerce-service/configuration/list', 'GET');
        $data["configuration"] = $result->data;

        return view("admin/configuration/edit", $data);
    }

    public function update()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();

        $configId = $request->getPost('configId');
        $productChargePercentage = $request->getPost('productChargePercentage');
        $serviceCharge = $request->getPost('serviceCharge');
        $expiringOrderWhenNoRespondInHours = $request->getPost('expiringOrderWhenNoRespondInHours');
        $expiringTransactionWhenNotPaidInHours = $request->getPost('expiringTransactionWhenNotPaidInHours');
        $delayedSettlementWhenOrderCompletedInHours = $request->getPost('delayedSettlementWhenOrderCompletedInHours');
        $internalWalletAccount = $request->getPost('internalWalletAccount');

        $url = getenv('API_URL') . '/commerce-service/configuration/update?configId=' . $configId;
        $data = [
            "productChargePercentage" => intval($productChargePercentage),
            "serviceCharge" => intval($serviceCharge),
            "expiringOrderWhenNoRespondInHours" => intval($expiringOrderWhenNoRespondInHours),
            "expiringTransactionWhenNotPaidInHours" => intval($expiringTransactionWhenNotPaidInHours),
            "delayedSettlementWhenOrderCompletedInHours" => intval($delayedSettlementWhenOrderCompletedInHours),
            "internalWalletAccount" => $internalWalletAccount,
            "status" => 1
        ];

        $req = $client->put(
            $url,
            [
                "body" => json_encode($data),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );
    }
}
