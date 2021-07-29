<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Card;
use App\Models\ServiceDescriptionModel;
use App\Models\ServiceSessionModel;
use App\Models\ServicesModel;
use Illuminate\Http\Request;
use App\Models\LanguagesModel;
use App\Models\TegManagements;
use App\Models\ProtocolPractitionerModel;
use App\Models\PractitionersModel;
use App\Models\UserLangRel;
use App\Models\TegManagementsPractitionerModel;
use App\Models\CategoryModel;
use App\Models\CategoryTitleModel;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\EventModel;


class IndexController extends Controller
{
    public function Languages()
    {
        return LanguagesModel::all();
    }

    public function tegManagements()
    {
        return TegManagements::where("published",1)->get();
    }

    public function categoryTitle()
    {
        return CategoryTitleModel::first();
    }

    public function category()
    {
        return CategoryModel::where("published",1)->get();
    }

    public function index()
    {
        $Languages      = $this->Languages();
        $TegManagements = $this->tegManagements();

        $TitleCategory  = $this->categoryTitle();
        $Category       = $this->category();

        return view('index',compact('Languages','TegManagements','TitleCategory','Category'));
    }

    public function test(request $request)
    {
        return $request->teg_management;
    }

    public function search(Request $request,$lang, $protocolId = null)
    {
//        var_dump($protocolId);
        $tags=null;

        if(!empty($request->teg_management))
        {
            $tags = implode(', ', $request->teg_management);
        }

//        $leagues = DB::table('practitioner')
//
//            ->select('practitioner.id','practitioner.first_name')
//            ->leftJoin('practitioner_lang_rel', 'practitioner_lang_rel.practitioner_id', '=', 'practitioner.id')
//            ->leftJoin('languages', 'practitioner_lang_rel.lang_id', '=', 'practitioner.id')
//            ->whereRaw('languages.id='.$request->state)
//            ->orderBy('practitioner.first_name')
//            ->groupBy('practitioner.id')
//            ->where(function ($query,$request) {
//                $query->where('languages.id', !empty($request->state))
//                    ->orWhere('practitioner.virtuall', !empty($request->vir))
//                    ->orWhere('practitioner.in_persion', !empty($request->per))
//                    ->orWhere('practitioner.gender', !empty($request->gender));
//            })

//            ->orWhere('languages.id', !empty($request->state))
//            ->orWhere('practitioner.virtuall', !empty($request->vir))
//            ->orWhere('practitioner.in_persion', !empty($request->per))
//            ->orWhere('practitioner.gender', !empty($request->gender))
//               ->whereRaw('languages.id='.$request->state)
   //         ->get();
//        dd($leagues);


        $Practitioner = DB::select(
            "select p.id, p.first_name, p.last_name, p.email, p.phone_number, group_concat(tm.id) as tag_ids, group_concat(tm.name)as tag_names from practitioner as p
            left join  practitioner_lang_rel as  plr on p.id=plr.practitioner_id
            left join languages as l on l.id=plr.lang_id
            left join practitioner_teg_managements as ptm on p.id=ptm.practitioner_id
            left join teg_managements as tm on tm.id=ptm.teg_managements_id
            where 1=1"
            .(!empty($request->state)?" and l.id=$request->state":"")
            .(!empty($tags)? " and tm.id in ($tags)":"")
            .(!empty($request->vir)?" and virtuall='$request->vir'":"")
            .(!empty($request->per)?" and in_persion='$request->per'":"")
            .(!empty($request->gender)?" and gender='$request->gender'":"")
            ." group by p.id, p.first_name, p.last_name, p.email, p.phone_number"
            .(!empty($tags)?" having count(p.id)=".count($request->teg_management):"")
        );



        $Service  =  ServicesModel::all();
        $ServiceSession = ServiceSessionModel::all();
        $ServiceDescription = ServiceDescriptionModel::all();

        $title =[];
        $price =[];
        $ID =[];
        foreach ($Service as $serviceV)
        {
            $title[] =  $serviceV->title;
            $price[] =  $serviceV->price;
            $ID[]    =  $serviceV->id;
        }

        $ServiceSession=[];

        foreach ($ID as $PrId)
        {
            $ServiceSession[] = ServiceSessionModel::where('services_id',$PrId)->get();
        }

        $ServiceDescription=[];

        foreach ($ID as $PrID)
        {
            $ServiceDescription[] = ServiceDescriptionModel::where('services_id',$PrID)->get();
        }


//        dd($Practitioner);

        foreach($Practitioner as $val)
        {

            $val->tag_ids=explode(',', $val->tag_ids);
            $val->tag_names=explode(',', $val->tag_names);
            $tags = array();

            for ($i=0; $i < count($val->tag_ids); $i++) {
                $tags[] = (object) ['id' => $val->tag_ids[$i], 'name' =>  $val->tag_names[$i]];
            }

            $a = $val->tags=$tags;
            unset($val->tag_ids);
            unset($val->tag_names);

        }

        $Tag      = $request->teg_management;
        $Virtual  = $request->vir;
        $Person   = $request->per;
        $Gender   = $request->gender;
        $Lang     = $request->state;

        $Practitioners = $this->paginate($Practitioner);

        $Languages      = $this->Languages();
        $TegManagements = $this->tegManagements();



//        $PID = [];
//        if($request->ajax())
//        {
//        foreach ($Practitioner as $prID)
//        {
//            $data = EventModel::where('protocol_id',$prID->id)
//                ->get(['id', 'title', 'start', 'end', 'user_id', 'protocol_id']);
//
//            return response()->json($data);
//        }
//        }

//        var_dump($PID);

//        dd($_GET);
//        if($request->ajax())
//        {
//
//
//
//
                if($request->ajax())
        {
                $data = EventModel::where('protocol_id',$protocolId)
                    ->get(['id', 'title', 'start', 'end', 'user_id', 'protocol_id']);

                return response()->json($data);
//
        }




        return view('filter',compact('Practitioners','Languages','TegManagements','Tag','Virtual','Person','Gender','Lang','Service','ServiceSession','ServiceDescription'));

    }

    public function paginate($items, $perPage = 2, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public function blog()
    {
        $cards = Card::where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        return view('blog', compact('cards'));
    }


    public function balance()
    {
        $cards = Card::where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        $balance = Balance::where('user_id', Auth::id())->first();
        return view('balance', compact('cards','balance'));
    }

//    public function product_detail($lang,$id,Request $request)
//    {
//
//       // return EventModel::findOrFail($id);
//       // return EventModel::where('user_id',$id)->first();
//
//        if($request->ajax())
//        {
//            $data = EventModel::whereDate('start', '>=', $request->start)
//                ->whereDate('end',   '<=', $request->end)
//                ->get(['id', 'title', 'start', 'end','user_id']);
//            return response()->json($data);
//        }
//        return view('calendar.full-calender');
//    }


    // Calendar
    public function action(Request $request)
    {


        if($request->ajax())
        {

            if($request->type == 'add')
            {
                $event = EventModel::create([
                    'title'		=>	$request->title,
                    'start'		=>	$request->start,
                    'end'		=>	$request->end
                ]);

                return response()->json($event);
            }

            if($request->type == 'update')
            {
                $event = EventModel::find($request->id)->update([
                    'title'		=>	$request->title,
                    'start'		=>	$request->start,
                    'end'		=>	$request->end
                ]);

                return response()->json($event);
            }

            if($request->type == 'delete')
            {
                $event = EventModel::find($request->id)->delete();

                return response()->json($event);
            }
        }
    }
}
