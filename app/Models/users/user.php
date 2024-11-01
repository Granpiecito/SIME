<?php

namespace App\Models\users;

use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class user extends Model
{
    use HasFactory;

    protected $table = 'dbo_user_sys';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_person_id', 'user_rol_id', 'user_name', 'user_record_date', 'user_status'];

    public $timestamps = false;

    public function verifyusername()
    {
        return DB::table('dbo_user_sys')
            ->where('user_id', $this
                ->user_id)->value('user_name');
    }

    public static function getuserdetailscn()
    {
        return DB::table('sessions')
            ->leftJoin('dbo_conecction_sys', 'sessions.id', '=', 'dbo_conecction_sys.sessions_id')
            ->leftJoin('dbo_user_sys', 'dbo_conecction_sys.user_id', '=', 'dbo_user_sys.user_id')
            ->leftJoin('dbo_person_sys', 'dbo_user_sys.user_person_id', '=', 'dbo_person_sys.person_id')
            ->leftJoin('dbo_rol_sys', 'dbo_user_sys.user_rol_id', '=', 'dbo_rol_sys.rol_id')
            ->select(
                'sessions.id',
                'dbo_conecction_sys.sessions_id',
                'dbo_user_sys.user_id',
                'dbo_user_sys.user_name',
                'dbo_person_sys.person_name',
                'dbo_person_sys.person_photo',
                'dbo_rol_sys.rol_name'
            )
            ->get();
    }

    public static function getusersdetailstbl()
    {
        return DB::table('dbo_user_sys')
            ->leftJoin('dbo_person_sys', 'dbo_user_sys.user_person_id', '=', 'dbo_person_sys.person_id')
            ->leftJoin('cat_directions_users', 'dbo_person_sys.directions_id', '=', 'cat_directions_users.directions_id')
            ->leftJoin('dbo_rol_sys', 'dbo_user_sys.user_rol_id', '=', 'dbo_rol_sys.rol_id')
            ->select('dbo_user_sys.user_name', 'dbo_user_sys.user_status', 'dbo_person_sys.person_name', 'cat_directions_users.directions_name', 'dbo_rol_sys.rol_name')
            ->get();
    }

    //Obtener usuarios activos
    public static function getuseractivesdt()
    {
        return DB::table('dbo_user_sys')
            ->where('user_status', '=', '1')->get()->count();
    }
    //Obtener usuarios inactivos
    public static function getuserinactivesdt()
    {
        return DB::table('dbo_user_sys')
            ->where('user_status', '=', '0')->get()->count();
    }

    //Obtener usuarios activos de la semana
    public static function getCurrentWeekActiveUsers()
    {
        return DB::table('dbo_user_sys')
            ->where('user_status', '=', '1')
            ->leftJoin('dbo_conecction_sys', 'dbo_user_sys.user_id', '=', 'dbo_conecction_sys.user_id')
            ->whereBetween('dbo_conecction_sys.conecction_date_entry', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
    }
    //Obtener usuarios activos de la semana pasada
    public static function getLastWeekActiveUsers()
    {
        return DB::table('dbo_user_sys')
            ->where('user_status', '=', '1')
            ->leftJoin('dbo_conecction_sys', 'dbo_user_sys.user_id', '=', 'dbo_conecction_sys.user_id')
            ->whereBetween('dbo_conecction_sys.conecction_date_entry', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->count();
    }

    //Obtener el total de los usuarios
    public static function getusercounts()
    {
        return DB::table('dbo_user_sys')
            ->select('user_id')
            ->get()->count();
    }

    //Obtener cuantos nuevos usuarios existen
    public static function getnewusers()
    {
        return DB::table('dbo_user_sys')
            ->leftJoin('dbo_person_sys', 'dbo_user_sys.user_person_id', '=', 'dbo_person_sys.person_id')
            ->whereNotNull('dbo_user_sys.user_record_date')
            ->whereBetween('dbo_user_sys.user_record_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
    }

    public static function getCurrentWeekinactiveUsers()
    {
        return DB::table('dbo_user_sys')
            ->where('user_status', '=', '0')
            ->leftJoin('dbo_conecction_sys', 'dbo_user_sys.user_id', '=', 'dbo_conecction_sys.user_id')
            ->whereBetween('dbo_conecction_sys.conecction_date_entry', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
    }
    public static function getLastWeekinactiveUsers()
    {
        return DB::table('dbo_user_sys')
            ->where('user_status', '=', '0')
            ->leftJoin('dbo_conecction_sys', 'dbo_user_sys.user_id', '=', 'dbo_conecction_sys.user_id')
            ->whereBetween('dbo_conecction_sys.conecction_date_entry', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->count();
    }

    public static function getsessions()
    {
        return DB::table(('sessions'))
            ->select('id')
            ->count();
    }

    public static function getnewsessions()
    {
        return DB::table('sessions')->where('id')
            ->leftJoin('dbo_conecction_sys', 'sessions.id', '=', 'dbo_conecction_sys.sessions_id')
            ->whereBetween('dbo_conecction_sys.conecction_date_entry', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
    }
}
