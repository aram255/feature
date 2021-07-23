<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSessionModel extends Model
{
    use HasFactory;

    protected $table = "services_sessions";
    public $timestamps = false;
}
