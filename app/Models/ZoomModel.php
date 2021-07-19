<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomModel extends Model
{
    use HasFactory;
    protected $table = "zoom_meetings_list";
    public $timestamps = false;
}
