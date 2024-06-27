<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class ShareProfitController extends BaseController
{
    public function ppob()
    {
        return view("admin/share/ppob");
    }

    public function ppobPost()
    {
        $request = Services::request();
        $start = $request->getPost('start');
        $end  = $request->getPost('end');

        $result = curlHelper(getenv('API_URL') . '/profit-service/ppob?start=' . $start . '&end=' . $end, 'GET');

        return json_encode([
            "body" =>  $result->body,
            "count" =>  $result->count[0]
        ]);
    }

    public function topup()
    {
        return view("admin/share/topup");
    }

    public function topupPost()
    {
        $request = Services::request();
        $start = $request->getPost('start');
        $end  = $request->getPost('end');

        $result = curlHelper(getenv('API_URL') . '/profit-service/payment/topup?start=' . $start . '&end=' . $end, 'GET');

        return json_encode([
            "body" =>  $result->body
        ]);
    }

    public function commerce()
    {
        return view("admin/share/commerce");
    }

    public function commercePost()
    {
        $request = Services::request();
        $start = $request->getPost('start');
        $end  = $request->getPost('end');

        $result = curlHelper(getenv('API_URL') . '/profit-service/commerce?start=' . $start . '&end=' . $end, 'GET');

        return json_encode([
            "body" =>  $result->body
        ]);
    }
}
