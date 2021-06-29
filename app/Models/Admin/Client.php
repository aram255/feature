<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function getAll($start,$length,$filter,$sort_field,$sort_dir){
    	$query = DB::table($this->table);

		$query->select(array(DB::raw('SQL_CALC_FOUND_ROWS users.id'), 
									'users.id as DT_RowId','first_name','last_name','created_at',
									'phone_number','email'
								));
		
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

	public function getProfile($id){
		$query = DB::table($this->table);


		// Get Main profile data
		$query->select('users.id as id','first_name','last_name','phone_number','email',
						'created_at','gender','created_at');
		$query->where('users.id',$id);
		
		$data = $query->first();
		
		// Get Languages
		$query = DB::table('languages');
		$query->select('languages.id as id','languages.title as title');
		$query->leftJoin('user_lang_rel','user_lang_rel.lang_id', '=', 'languages.id');
		$query->where('user_lang_rel.user_id',$id);
		$lang = $query->get();
		
		$languages = '---';
		if(count($lang) > 0){
			$languages = '';
			foreach($lang as $l){
				$languages .= $l->title.', '; 	
			}
			$languages = rtrim($languages, ", ");
		}
		$data->languages = $languages;
		//

		return $data;
	}
}
