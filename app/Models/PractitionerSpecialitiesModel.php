<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractitionerSpecialitiesModel extends Model
{
    use HasFactory;
    protected $table="practitioner_specialities";
    public $timestamps = false;
}
