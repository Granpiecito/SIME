<?php

namespace App\Models\Login;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Login extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $table = 'dbo_user_sys';

    public $timestamps = false;

    protected $fillable = [
        'user_name',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function getPasswordAttribute()
    {
        return DB::table('dbo_user_details')
            ->where('user_id', $this
                ->user_id)->value('user_details_currentpassword');
    }

    public function getSession()
    {
        return DB::table('sessions')
            ->where('user_id', $this->user_id)
            ->get();
    }

    public function verifyPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public function verifyuser($user)
    {
        return Hash::check($user, $this->user_id);
    }
}
