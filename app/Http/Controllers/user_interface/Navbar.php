<?php

namespace App\Http\Controllers\user_interface;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users\user;

class Navbar extends Controller
{
  public function index()
  {
    $getuserdetailscn = user::getuserdetailscn();
    return view('content.user-interface.ui-navbar', ['getuserdetailscn' => $getuserdetailscn]);
  }
}
