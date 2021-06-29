<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthPractitionersModel extends Model
{
    use HasFactory;
    protected  $table = "practitioner";
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'country_id',
        'city_id',
        'address',
        'mode_of_delivery',
        'additional_document',
        'id_or_passport',
        'practice_id',
        'certifications_licensing',
        'speciality_id',
        'time_zone',
        'email',
        'password',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
