<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class permissions_users extends Model
{
    use HasFactory;

    public static function getpermissions()
    {
        return DB::table('dbo_permission_sys')
            ->select(
                'permission_name',
                'permission_description',
                'permission_state',
                'permission_create_date'
            )
            ->get();
    }
}
