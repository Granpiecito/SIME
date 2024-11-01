<?php

namespace App\Http\Controllers\Roles;

use App\Models\Roles\rol;
use App\Models\users\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class roles extends Controller
{
    public function roles_view()
    {
        $userdetailcn = user::getuserdetailscn();
    }

    public function rolesRegistration(Request $request): RedirectResponse {}
}
