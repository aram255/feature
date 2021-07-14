<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractitionerPracticeModel extends Model
{
    use HasFactory;
    protected $table="practitioner_practice";
    public $timestamps = false;
}
