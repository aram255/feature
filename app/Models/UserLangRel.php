<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLangRel extends Model
{
    use HasFactory;
    protected $table = "user_lang_rel";

    //protected $fillable = ['user_id', 'lang_id'];
}
