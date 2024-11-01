<?php

namespace App\Models\Roles;

use Illuminate\Support\Facades\DB;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class rol extends Model
{
    use HasFactory;
    protected $table = 'dbo_rol_sys';
    public $timestamps = false;

    protected $fillable = [
        'rol_name',
        'rol_description',
        'rol_status',
    ];

    public static function getrolsys()
    {
        return DB::table('dbo_rol_sys')
            ->select('dbo_rol_sys.rol_name', 'dbo_rol_sys.rol_description', 'dbo_rol_sys.rol_status')
            ->get();
    }

    public static function getusersrol()
    {
        return DB::table('dbo_user_sys')
            ->join('dbo_rol_sys', 'dbo_user_sys.user_rol_id', '=', 'dbo_rol_sys.rol_id')
            ->select('dbo_user_sys.user_name', 'dbo_user_sys.user_rol_id', 'dbo_rol_sys.rol_name')
            ->get();
    }
}
