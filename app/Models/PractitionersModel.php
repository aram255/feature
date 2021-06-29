<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractitionersModel extends Model
{
    use HasFactory;
    protected $table="practitioner";
    public $timestamps = false;

    protected $fillable = [
        'first_name',
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

//    public function langs()
//    {
//        return $this->hasMany(PractitionerLanguageModel::class, 'practitioner_id', 'id');
//    }
}
