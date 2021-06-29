<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTitleModel extends Model
{
    use HasFactory;
    protected $table = "category_title";
    public $timestamps = false;
}
