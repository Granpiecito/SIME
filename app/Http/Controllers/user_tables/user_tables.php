<?php

namespace App\Http\Controllers\user_tables;

use App\Http\Controllers\Controller;
use App\Models\users\user;
use Illuminate\Http\Request;

class user_tables extends Controller
{
  public function index()
  {
    $userdetailstbl = user::getusersdetailstbl();
    $userdetailcn = user::getuserdetailscn();
    $usersacdt = user::getuseractivesdt();
    $usersweekac = user::getCurrentWeekActiveUsers();
    $userlastweekac = user::getLastWeekActiveUsers();
    $usersweekinac = user::getCurrentWeekinactiveUsers();
    $userlastweekinac = user::getLastWeekinactiveUsers();
    $usersysct = user::getusercounts();
    $newsysusers = user::getnewusers();
    $usersinacdt = user::getuserinactivesdt();
    $getsessionst = user::getsessions();
    $getnewsession = user::getnewsessions();


    //Funcion para calcular el procentaje de usuarios que esten activos
    if ($userlastweekac > 0) {
      $percentchange = (($usersweekac - $userlastweekac) / $userlastweekac) * 100;
    } else {
      $percentchange = 0;
    }

    //Funcion para calcular el procentaje de usuarios que esten inactivos
    if ($userlastweekinac > 0) {
      $inacuserporcent = ($usersweekinac / $usersysct) * 100;
    } else {
      $inacuserporcent = 0;
    }

    //Funcion para calcular el porcentaje de nuevos usuarios
    if ($usersysct > 0) {
      $userspercent = ($newsysusers  / $usersysct) * 100;
    } else {
      $userspercent = 0;
    }

    return view(
      'content.user.user-tables',
      [
        'getusersdetailstbl' => $userdetailstbl,
        'getuserdetailscn' => $userdetailcn,
        'usersacdt' => $usersacdt,
        'currentWeekUsers' => $usersweekac,
        'percentageChange' => $percentchange,
        'currentWeekinacUsers' => $usersweekinac,
        'inacuserporcent' => $inacuserporcent,
        'getusercounts' => $usersysct,
        'userspercent' => $userspercent,
        'usersinacdt' => $usersinacdt,
        'getsessions' => $getsessionst,
        'getnewsessions' => $getnewsession
      ]
    );
  }
}
