<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\person\person;
use App\Models\users\user as UserModal;
use App\Models\person\person as ModalPerson;
use App\Models\Roles\rol;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class user extends Controller
{
    public function user_view()
    {
        $data = [
            'roles' => rol::all(),
            'last_person_id' => ModalPerson::orderBy('person_id', 'desc')->first()->person_id,
        ];
        $getuserdetailscn = UserModal::getuserdetailscn();
        return view(
            'content.authentications.admin.auth-user-register',
            ['getuserdetailscn' => $getuserdetailscn]
        )->with($data);
    }

    public function PostUserRegistrion(Request $request): RedirectResponse
    {


        $validatedData = $request->validate([
            'user_rol_id' => 'required',
            'user_name' => 'required',
            'user_details_currentpassword' => 'required',
            'user_status' => 'required',
        ]);

        $userp = new UserModal();
        $userp->user_person_id = $request->input('person_id');
        $userp->user_rol_id = $validatedData['user_rol_id'];
        $userp->user_name = $validatedData['user_name'];
        $userp->user_status = $validatedData['user_status'];
        $userp->user_record_date = now();




        $userp->save();

        // Obtener el ID del usuario recién creado
        $userId = $userp->user_id;

        // Insertar la contraseña en la tabla 'dbo_user_details_sys' junto con el user_id
        DB::table('dbo_user_details')->insert([
            'user_id' => $userId,
            'user_details_currentpassword' => bcrypt($validatedData['user_details_currentpassword']),
        ]);
        return redirect()->intended("auth/person-register")->withSuccess('Usuario Registrado con Exito');
    }
}
