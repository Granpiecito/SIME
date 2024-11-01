<?php

namespace App\Http\Controllers\direction_tables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\users\user;
use App\Models\Directions\directions;

class direction_tables extends Controller
{
    public function direction_index()
    {
        $getdirections = directions::getdirections();
        $getuserdetailscn = user::getuserdetailscn();

        return view(
            'content.directions.directions-tables',
            ['getdirections' => $getdirections],
            ['getuserdetailscn' => $getuserdetailscn]
        );
    }
}
