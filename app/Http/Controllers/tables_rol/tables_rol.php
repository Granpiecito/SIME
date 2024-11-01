<?php

namespace App\Http\Controllers\tables_rol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles\rol;
use App\Models\users\user;
use Illuminate\Http\RedirectResponse;

class tables_rol extends Controller
{
    public function rol_index()
    {
        $rolesdetailtbl = rol::getrolsys();
        $getuserdetailscn = user::getuserdetailscn();
        $getusersroldtl = rol::getusersrol();

        return view(
            'content.roles.roles-tables',
            [
                'getrolsys' => $rolesdetailtbl,
                'getuserdetailscn' => $getuserdetailscn,
                'getusersrol' => $getusersroldtl
            ]
        );
    }

    public function addrol(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'rol_name',
            'rol_description',
            'rol_status'
        ]);

        $rol = new rol($validatedData);

        $rol->rol_name = $validatedData['rol_name'];
        $rol->rol_description = $validatedData['rol_description'];
        $rol->rol_status = $validatedData['rol_status'];

        $rol->save();
        return redirect()->intended('roles/tables')->WithSuccess('Rol Registrado con Exito!');
    }
}
