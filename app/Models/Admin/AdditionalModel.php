<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalModel extends Model
{
    use HasFactory;
    protected $table = "additional_document";
    public $timestamps = false;
}
