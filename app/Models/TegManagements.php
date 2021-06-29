<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TegManagements extends Model
{
    use HasFactory;
    protected $table="teg_managements";
    public $timestamps = false;

//    public function practitionerTag()
//    {
//        return $this->hasMany(TegManagementsPractitionerModel::class, 'teg_managements_id', 'id');
//    }
}
