<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogText extends Model
{
    use HasFactory;
    protected $table = "blog_text";
    public $timestamps = false;
}
