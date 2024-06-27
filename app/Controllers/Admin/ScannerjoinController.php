<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class ScannerjoinController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('API_URL') . '/content-service/scanner-joins/list', 'GET');
        // var_dump($result); die;
        $data["join"] = $result->body;
        // var_dump($result); die;
        return view("admin/scannerjoin/index", $data);
    }
}
