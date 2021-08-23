<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin\Practitioner;
use App\Models\Admin\AdditionalModel;
use App\Models\Admin\CertificationsModel;
use App\Models\Admin\ServiceDescriptionModel;
use App\Models\Admin\ServiceSessionModel;
use App\Models\Admin\ServicesModel;
use DB;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Str;

class PractitionerController extends Controller
{
    public function index(request $request){
        view()->share('menu', 'practitioners');

        $Practitioners = DB::table('practitioner')
            ->select( 'practitioner.*', 'countries.title as country','states.title as city')
            ->join('countries','countries.id','practitioner.country_id')
            ->join('states','states.id','practitioner.city_id')
            ->where(function($query) use ($request) {
                if (!empty($request->status)) {
                    return $query->where('practitioner.status', $request->input('status'));
                }
            })
            ->orderBy('practitioner.id', 'DESC')
            ->paginate(100);


        $Lang = DB::table('practitioner_lang_rel')
                ->select( 'practitioner_lang_rel.*', 'languages.title as language',)
                ->join('languages','practitioner_lang_rel.lang_id','languages.id')
                ->get();

        $Reviews =  DB::table('reviews')
                    ->select( 'reviews.*', 'users.*')
                    ->join('users','reviews.user_id','users.id')
                    ->get();



        $PractitionersNewCount = Practitioner::where('status','pending')->count();

        $Additional                    = AdditionalModel::all();
        $Certifications                = CertificationsModel::all();

        $PractitionerSpecialities = DB::table('specialities')
                                    ->select( 'specialities.*','practitioner_specialities.*')
                                    ->join('practitioner_specialities','practitioner_specialities.specialities_id','specialities.id')
                                    ->where('specialities.published',1)
                                    ->get();

        $PractitionerPractice      = DB::table('practice')
                                    ->select( 'practice.*','practitioner_practice.*')
                                    ->join('practitioner_practice','practitioner_practice.practice_id','practice.id')
                                    ->where('practice.published',1)
                                    ->get();

        $CheckStatus = $request->status;


        $Service            = ServicesModel::all();
        $ServiceSession     = ServiceSessionModel::all();
        $ServiceDescription = ServiceDescriptionModel::all();



        return view('admin.practitioner.index',compact('Practitioners','Lang','Reviews','CheckStatus','PractitionersNewCount','Additional','Certifications','PractitionerSpecialities','PractitionerPractice','Service','ServiceSession','ServiceDescription'));
    }

    public function data(Request $request){
        $model = new Practitioner();

        $filter = false;
        if($request->input('filter_status')){
            $filter = array(
                'status' => $request->input('filter_status'),
            );
        }

        $practitioners = $model->getAll(
            $request->input('start'),
            $request->input('length'),
            $filter,
            $request->input('sort_field'),
            $request->input('sort_dir'),
        );

        $data = json_encode(array('data' => $practitioners['data'], 'recordsFiltered' => $practitioners['count'], 'recordsTotal'=> $practitioners['count']));
        return $data;
    }

    public function edit(Request $request){

        $id = (int)$request['id'];

        $model = new Practitioner();
        $profile = $model->getProfile($id);
        $data = json_encode(
            array('data' =>
                (String) view('admin.practitioner.item',
                array(
                    'profile'=>$profile, 'id'=>$id,
                )),
                'status' => 1)
            );
        // return response()->json($profile);
        return $data;
    }

    public function changeStatus(Request $request){
        $id = (int)$request['p_id'];

        $status = $request['status'];



        $practitioner = Practitioner::find($id);


        Mail::send('email.status-practitioners',['status' => $status], function($message) use ($practitioner) {
            $message->from($practitioner->email);
            $message->to($practitioner->email);
            $message->subject('Your status');
        });

        if($practitioner && in_array($status,array('pending','accept','reject','disable'))){

            $practitioner->status = $status;
            $practitioner->save();


              return back()->with('status', 'Your email empty');
        }else{
            return json_encode(array('status' => 0, 'message' => 'Something wrong'));
        }
    }
}
