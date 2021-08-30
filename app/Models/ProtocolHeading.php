<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtocolHeading extends Model
{
    use HasFactory;
    protected $table = 'protocol_heading';
    public    $timestamps = false;
}
