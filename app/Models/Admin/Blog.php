<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
	public $timestamps = false;

    public function getAll($start,$length,$filter,$sort_field,$sort_dir){
    	$query = DB::table($this->table);

		$query->select(array(DB::raw('SQL_CALC_FOUND_ROWS blog.id'), 
										'blog.id as DT_RowId',
										'blog.title as title',
										'blog.published as published'
										)
								);
		
		if($length != '-1'){
			$query->skip($start)->take($length);
		}

		$query->orderBy($sort_field, $sort_dir);
		$data = $query->get();

		foreach ($data as $d) {
			$d->DT_RowId = "row_".$d->DT_RowId;
		}

		$count  = DB::select( DB::raw("SELECT FOUND_ROWS() AS recordsTotal;"))[0];

		$return['data'] = $data;
		$return['count'] = $count->recordsTotal;
    	return $return;
    }
}
