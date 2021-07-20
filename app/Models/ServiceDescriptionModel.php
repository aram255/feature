<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDescriptionModel extends Model
{
    use HasFactory;

    protected $table = "services_description";
    public $timestamps = false;
}
