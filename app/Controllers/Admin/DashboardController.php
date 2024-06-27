<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class DashboardController extends BaseController
{
  public function index()
  {
    return view("admin/dashboard/index");
  }
}
