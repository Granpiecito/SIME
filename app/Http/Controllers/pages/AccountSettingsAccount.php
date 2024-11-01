<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\users\user;
use Illuminate\Http\Request;

class AccountSettingsAccount extends Controller
{
  public function index()
  {
    $userdetailcn = user::getuserdetailscn();
    return view('content.pages.pages-account-settings-account', ['getuserdetailscn' => $userdetailcn]);
  }
}
