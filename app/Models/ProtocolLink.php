<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtocolLink extends Model
{
    use HasFactory;
    protected $table = 'protocol_link';
    public    $timestamps = false;
    protected $fillable = ['link_title','link_link','user_id','service_id','practitioner_id','iframe'];
}
