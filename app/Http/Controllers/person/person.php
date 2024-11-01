<?php

namespace App\Http\Controllers\person;

use App\Http\Controllers\Controller;
use App\Models\person\person as ModalPerson;
use App\Models\users\user;
use App\Models\Directions\directions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class person extends Controller
{

    public function person_view()
    {
        $data = [
            'directions' => directions::all(),
        ];

        $userdetailcn = user::getuserdetailscn();
        return view('content.authentications.admin.auth-person-register', ['getuserdetailscn' => $userdetailcn])->with($data);
    }

    public function Postregistration(Request $request): RedirectResponse
    {

        $validatedData = $request->validate([
            'directions_id' => 'required',
            'person_name' => 'required',
            'person_email' => 'required|email',
            'person_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $person = new ModalPerson($validatedData);
        $person->directions_id = $validatedData['directions_id'];
        $person->person_name = $validatedData['person_name'];
        $person->person_email = $validatedData['person_email'];
        $person->person_registration_date = now();
        $photoPath = $request->file('person_photo')->store('photos', 'public');

        $person->save();
        return redirect()->intended('auth/user-register')->withSuccess('Persona Registrada con Éxito!');
    }
}
