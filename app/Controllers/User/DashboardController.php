<?php

namespace App\Controllers\User;

use App\Controllers\Base\BaseController;
use Config\Services;

class DashboardController extends BaseController
{
  public function index()
  {
    return view("user/dashboard/index");
  }

  public function forbidden()
  {
    return view("user/forbidden");
  }
}
