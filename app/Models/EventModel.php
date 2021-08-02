<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    use HasFactory;
    protected $table = "event";
    public $timestamps = false;
    protected $fillable = [
        'title', 'start', 'end','protocol_id','user_id'
    ];
}
