<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeFormModel extends Model
{
    use HasFactory;
    protected $table = "type_form_practitioner";
    public  $timestamps = false;
}
