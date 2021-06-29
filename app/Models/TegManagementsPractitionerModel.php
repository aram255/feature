<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TegManagementsPractitionerModel extends Model
{
    use HasFactory;
    protected $table = "practitioner_teg_managements";
    public $timestamps = false;

//    public function practitioners()
//    {
//        return $this->hasMany(PractitionersModel::class, 'id', 'practitioner_id');
//    }
}
