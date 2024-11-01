<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\person\person;
use App\Models\Roles\roles;
use App\Models\users\user;
use App\Http\Controllers\authentications\LoginBasic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Analytics extends Controller
{
  public function index()
  {
    $userdetailscn = user::getuserdetailscn();

    return view('content.dashboard.dashboards-analytics', ['getuserdetailscn' => $userdetailscn]);
  }
}
