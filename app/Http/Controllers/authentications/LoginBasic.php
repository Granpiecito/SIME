<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Login\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class LoginBasic extends Controller
{

  public function showlogin_form()
  {

    return view('content.authentications.auth-login-basic');
  }

  public function postlogin(Request $request): RedirectResponse
  {
    $request->validate([
      'user_name' => 'required',
      'user_details_currentpassword' => 'required',

    ]);

    $user = Login::where('user_name', $request->input('user_name'))->first();


    if ($user && $user->verifyPassword($request->input('user_details_currentpassword'))) {
      Auth::login($user);

      //Insertar datos de inicio de sesion a la tabla 'dbo_conecction_sys
      $ip_address = $request->ip();
      $sessionId = Session::getId();

      DB::table('dbo_conecction_sys')->insert([
        'user_id' => $user->user_id,
        'sessions_id' => $sessionId,
        'conecction_ip' => $ip_address,
        'conecction_state' => '1',
        'conecction_date_entry' => now(),

      ]);

      return redirect()->intended('/')->withSuccess('Has iniciado Sesion correctamente');
    }

    return redirect("/auth/login")->withErrors(['Login' => 'Oops, parace que el usuario o la contraseña son incorrectos']);
  }

  public function logout(Request $request): RedirectResponse
  {

    $sesionid = Auth::id();
    $sessionId = Session::getId();

    DB::table('dbo_conecction_sys')->where('sessions_id', '=', $sessionId)
      ->update([
        'conecction_state' => '0',
        'logout_date' => now(),
      ]);

    DB::table('dbo_conecction_sys')
      ->where('user_id', '=', $sesionid)
      ->whereDate('conecction_date_entry', '<', now()->subDay())
      ->where('conecction_state', '=', '1')
      ->update([
        'conecction_state' => '0',
        'logout_date' => now(),
      ]);


    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();



    return redirect('/auth/login');
  }
}
