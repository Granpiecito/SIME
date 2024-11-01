<?php

namespace App\Http\Controllers\user_permission;


use Illuminate\Http\Request;
use App\Models\users\user;
use App\Models\Permission\permissions_users;
use App\Http\Controllers\Controller;

class user_permission extends Controller
{
    public function permission_index()
    {
        $getuserdetailscn = user::getuserdetailscn();
        $getpermissiond = permissions_users::getpermissions();

        return view(
            'content.permissions.permissions-tables',
            ['getuserdetailscn' => $getuserdetailscn],
            ['getpermissions' => $getpermissiond]
        );
    }
}
