<?php

namespace App\Models\Directions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class directions extends Model
{
    use HasFactory;
    protected $table = 'cat_directions_users';
    public $timestamps = false;

    protected $fillable = [
        'directions_name',
        'directions_description',
    ];

    public static function getdirections()
    {
        return DB::table('cat_directions_users')
            ->select('directions_name', 'directions_description', 'directions_date')
            ->get();
    }
}
