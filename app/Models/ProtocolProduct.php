<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProtocolProduct extends Model
{
    use HasFactory;
    protected $table = 'protocol_product';
    public    $timestamps = false;
    protected $fillable = ['title_product','brand','dosage','instructions','product_link','img','user_id','service_id','practitioner_id'];
}
