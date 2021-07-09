<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationsModel extends Model
{
    use HasFactory;
    protected $table = "certifications_document";
    public $timestamps = false;
}
