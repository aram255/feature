<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Practitioner extends Model
{
    use HasFactory;
    protected $table = 'practitioner';

//    public function getAll($start,$length,$filter,$sort_field,$sort_dir){
//    	$query = DB::table($this->table);
//
//		$query->select(array(DB::raw('SQL_CALC_FOUND_ROWS practitioner.id'),
//										'practitioner.id as DT_RowId',
//										DB::raw("CONCAT(practitioner.first_name,' ',practitioner.last_name) as fullname"),
//										DB::raw("CONCAT(countries.title,' ',cities.title) as location"),
//										'specialities.title as speciality_title',
//										'practice.title as practice_title',
//										'practitioner.created_at as created_at',
//										'practitioner.status'
//										)
//								);
//
//		$query->leftJoin('countries', 'practitioner.country_id', '=', 'countries.id');
//		$query->leftJoin('cities', 'practitioner.city_id', '=', 'cities.id');
//		$query->leftJoin('specialities', 'specialities.id', '=', 'practitioner.speciality_id');
//		$query->leftJoin('practice', 'practice.id', '=', 'practitioner.practice_id');
//
//
//		if($length != '-1'){
//			$query->skip($start)->take($length);
//		}
//
//		if($filter){
//            if(isset($filter['status'])){
//                $query->where('status',$filter['status']);
//            }
//        }
//
//		$query->orderBy($sort_field, $sort_dir);
//		$data = $query->get();
//
//		foreach ($data as $d) {
//			$d->DT_RowId = "row_".$d->DT_RowId;
//		}
//
//		$count  = DB::select( DB::raw("SELECT FOUND_ROWS() AS recordsTotal;"))[0];
//
//		$return['data'] = $data;
//		$return['count'] = $count->recordsTotal;
//    	return $return;
//    }
//
//	public function getProfile($id){
//		$query = DB::table($this->table);
//
//
//		// Get Main profile data
//		$query->select('practitioner.id as id','first_name','last_name','time_zone as time_zone','phone_number','email','status','practitioner.rate as rate',
//						'created_at','price_selection','mode_of_delivery','gender','description','services',
//						'countries.title as country','cities.title as city',
//						'specialities.title as speciality',
//						'practice.title as practice'
//						);
//		$query->where('practitioner.id',$id);
//
//		$query->leftJoin('countries', 'practitioner.country_id', '=', 'countries.id');
//		$query->leftJoin('cities', 'practitioner.city_id', '=', 'cities.id');
//		$query->leftJoin('specialities', 'specialities.id', '=', 'practitioner.speciality_id');
//		$query->leftJoin('practice', 'practice.id', '=', 'practitioner.practice_id');
//
//		$data = $query->first();
//
//		// Get Languages
//		$query = DB::table('languages');
//		$query->select('languages.id as id','languages.title as title');
//		$query->leftJoin('practitioner_lang_rel','practitioner_lang_rel.lang_id', '=', 'languages.id');
//		$query->where('practitioner_lang_rel.practitioner_id',$id);
//		$lang = $query->get();
//
//		$languages = '---';
//		if(count($lang) > 0){
//			$languages = '';
//			foreach($lang as $l){
//				$languages .= $l->title.', ';
//			}
//			$languages = rtrim($languages, ", ");
//		}
//		$data->languages = $languages;
//		if(isset($data->services)){
//			$data->services = unserialize($data->services);
//		}
//
//		// Get reviews
//		$reviews = DB::table('reviews')->select('*')->where('practitoner_id',$id)->get();
//		$data->reviews = $reviews;
//
//		return $data;
//	}
}
