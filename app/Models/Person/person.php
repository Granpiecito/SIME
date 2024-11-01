<?php

namespace App\Models\person;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'dbo_person_sys';
    public $timestamps = false;

    protected $fillable = [
        'person_id',
        'directions_id',
        'person_name',
        'person_email',
        'person_registration_date',
        'person_photo',
    ];
}
