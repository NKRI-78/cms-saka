<?php

namespace App\Controllers\Init;

use App\Controllers\Base\BaseController;
use Config\Services;

class InitController extends BaseController
{
  public function index()
  {
    $session = Services::session();
    $role = $session->get('role');
    
    if ($role == "user") {
      return redirect()->to(base_url('user/dashboard'));
    } else {
      return redirect()->to(base_url('admin/dashboard'));
    }
  }
}
