<?php

namespace App\Http\Controllers;

use App\Models\BlogTextModel;
use App\Models\Balance;
use App\Models\Card;
use App\Models\ServiceDescriptionModel;
use App\Models\ServiceSessionModel;
use App\Models\ServicesModel;
use App\Models\TypeFormModel;
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
use App\Models\ZoomModel;
use App\Models\BlogModel;
use App\Models\FavoriteModel;
use App\Models\ReviewModel;
use App\Models\User;
use Illuminate\Support\Carbon;


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

    public function search(Request $request,$lang, $practitioner_id = null, $service_id = null)
    {
//        dd($request->search_go);

//        $tags=null;
//
//        if(!empty($request->teg_management))
//        {
//            $tags = implode(', ', $request->teg_management);
//        }

        $Practitioner = DB::table('practitioner')
                        ->select('practitioner.id','practitioner.first_name','practitioner.phone_number','practitioner.last_name','practitioner.email','practitioner.video','practitioner.description','practitioner.img')

            ->when(isset($_POST['state']), function ($query) {

                $query->leftJoin('practitioner_lang_rel', 'practitioner_lang_rel.practitioner_id', '=', 'practitioner.id')
                        ->leftJoin('languages', 'practitioner_lang_rel.lang_id', '=', 'languages.id');
            })
            ->when(isset($_POST['yesNo']), function ($query) {
                $query->leftJoin('zoom_meetings_list', 'zoom_meetings_list.practitioner_id', '=', 'practitioner.id');
            })


            ->when(isset($_POST['yesNo']), function ($query) {

                if($_POST['yesNo'] == 'Yes' || $_POST['yesNo'] == 'No')
                {
                    $query->addSelect([
                        'count_meting' => ZoomModel::selectRaw('COUNT(start)')
                            ->whereBetween('start',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()] )
                            ->whereColumn('practitioner_id', '=', 'practitioner.id')
                    ]);
                }

                      })

            ->groupBy('practitioner.id', 'practitioner.email', 'practitioner.first_name', 'practitioner.last_name', 'practitioner.phone_number','practitioner.video','practitioner.description','practitioner.img')
            ->orderBy('practitioner.first_name',"DESC")
            ->where(function ($query) use($request) {

                if(!empty($request->state))
                {
                    $query->whereRaw("languages.id=".$request->state);
                }

            })

            ->where(function ($query) use($request) {
                if(!empty($request->vir) and !empty($request->per))
                {
                    $query->where('practitioner.virtuall', $request->vir)
                          ->where('practitioner.in_persion', $request->per);
                }
                if(!empty($request->vir))
                {
                    $query->where('practitioner.virtuall', $request->vir);
                }
                if(!empty($request->per))
                {
                    $query->where('practitioner.in_persion', $request->per);
                }

                if(!empty($request->gender))
                {
                    $query->where('practitioner.gender', $request->gender);
                }

                if(!empty($request->yesNo) && $request->yesNo=="Yes")
                {
                    $query->whereBetween('zoom_meetings_list.start',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()] );
                }

//                if(!empty($request->yesNo) && $request->yesNo=="No")
//                {
//                    $query->whereNotBetween('zoom_meetings_list.start',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()] );
//                }

            })
            ->get();

     //  dd($Practitioner);



//        $Practitioner = DB::select(
//            "select p.id, p.first_name, p.last_name, p.email, p.phone_number, group_concat(tm.id) as tag_ids, group_concat(tm.name)as tag_names from practitioner as p
//            left join  practitioner_lang_rel as  plr on p.id=plr.practitioner_id
//            left join languages as l on l.id=plr.lang_id
//            left join practitioner_teg_managements as ptm on p.id=ptm.practitioner_id
//            left join teg_managements as tm on tm.id=ptm.teg_managements_id
//            where 1=1"
//            .(!empty($request->state)?" and l.id=$request->state":"")
//            .(!empty($tags)? " and tm.id in ($tags)":"")
//            .(!empty($request->vir)?" and virtuall='$request->vir'":"")
//            .(!empty($request->per)?" and in_persion='$request->per'":"")
//            .(!empty($request->gender)?" and gender='$request->gender'":"")
//            ." group by p.id, p.first_name, p.last_name, p.email, p.phone_number"
//            .(!empty($tags)?" having count(p.id)=".count($request->teg_management):"")
//        );

     //  dd($Practitioner);


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

        $Favorite = FavoriteModel::all();


//        dd($Practitioner);

//        foreach($Practitioner as $val)
//        {
//
//            $val->tag_ids=explode(',', $val->tag_ids);
//            $val->tag_names=explode(',', $val->tag_names);
//            $tags = array();
//
//            for ($i=0; $i < count($val->tag_ids); $i++) {
//                $tags[] = (object) ['id' => $val->tag_ids[$i], 'name' =>  $val->tag_names[$i]];
//            }
//
//            $a = $val->tags=$tags;
//            unset($val->tag_ids);
//            unset($val->tag_names);
//
//        }

        $Tag      = $request->teg_management;
        $Virtual  = $request->vir;
        $Person   = $request->per;
        $Gender   = $request->gender;
        $Lang     = $request->state;

        $Week     = $request->yesNo;

        $Practitioners = $this->paginate($Practitioner);

        $Languages      = $this->Languages();
        $TegManagements = $this->tegManagements();


        // Calendar
//        if($request->ajax())
//        {
//
//            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
//            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
//
//
//
//                    $data = ZoomModel::whereDate('start', '>=', $start)
//                                        ->whereDate('end',   '<=', $end)
//                        ->where(function ($query) use($practitioner_id,$service_id) {
//                            if(!empty($practitioner_id) and empty($service_id))
//                            {
//                                $query ->where('practitioner_id',$practitioner_id);
//                            }
//
//                            if(!empty($practitioner_id) and !empty($service_id))
//                            {
//                                $query ->where('practitioner_id',$practitioner_id)
//                                        ->where('service_id',$service_id);
//                            }
//                        })
//                        ->where('user_id',Auth::id())
//                        ->get();
//
//                return response()->json($data);
//
//        }
        $a = 1;
       $segment = request()->segments();
        if($request->ajax())
        {

            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');



            $data = ZoomModel::whereDate('start', '>=', $start)

                ->whereDate('end',   '<=', $end)
                ->where(function ($query) use($practitioner_id,$service_id) {
                    if(!empty($practitioner_id) and empty($service_id))
                    {
                        $query->where('practitioner_id',$practitioner_id);
                    }

                    if(!empty($practitioner_id) and !empty($service_id))
                    {
                        $query ->where('practitioner_id',$practitioner_id);
                            //->where('service_id',$service_id);
                    }
                })
                //->where('user_id',Auth::id())
                ->where(function ($query) use($practitioner_id,$service_id) {

                    if(!empty($service_id))
                    {
                        $query->where('user_id',Auth::id())
                            ->where('service_id',$service_id)
                            ->OrWhere('user_id',null);
                    }

                })

//                ->when(isset($a), function ($query) {
//
//                        $query->addSelect([
//                            'count_meting' => ZoomModel::select(DB::raw('start'))
//                                //->whereBetween('start',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()] )
//                              //  ->whereColumn('practitioner_id', '=', 'practitioner.id')
//                        ]);
//
//
//                })
                // where practitioner_id=$practitioner_id and (user_id=$auth_id and service_id=$service_id or ( user_id=null))
                ->get();


            return response()->json($data);

        }

       $ZommInfo = ZoomModel::first();


        return view('filter',compact('ZommInfo','Practitioners','Languages','TegManagements','Tag','Virtual','Person','Gender','Lang','Service','ServiceSession','ServiceDescription','Week','Favorite'));

    }

    public function paginate($items, $perPage = 100, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function blog()
    {
          $Blog = BlogModel::join('images','images.id', '=', 'blog.image_id')->where('blog.published',1)->get(
              [
                  'blog.id',
                  'blog.title',
                  'blog.description',
                  'blog.text',
                  'blog.published',
                  'images.filename',
                  'images.ext'
              ]
          );

        $BlogFirst = BlogModel::join('images','images.id', '=', 'blog.image_id')->where('blog.published',1)->orderBy('id', 'desc')
            ->first(
            [
                'blog.id',
                'blog.title',
                'blog.description',
                'blog.text',
                'blog.published',
                'images.filename',
                'images.ext'
            ]
        );

        $BlogText = BlogTextModel::first();

      return view('blog',compact('Blog','BlogFirst','BlogText'));
    }

    public function profileViewCustomer($lang,$practitionerID)
    {
        $Practitioner = PractitionersModel::where('id',$practitionerID)->first();

        $ServizeID = ZoomModel::where('user_id',Auth::id())->get();
        //dd($ServizeID);
//        $ServizeID = DB::table('zoom_meetings_list')
//            ->join('practitioner', 'practitioner.id', 'zoom_meetings_list.practitioner_id')
//            ->where('practitioner.id',$practitionerID)
//            ->where('user_id',Auth::id())
//            ->get();
//        echo '<pre>';
//print_r($ServizeID);
//echo '<pre>';
//dd('dsd');
        $Service  =  ServicesModel::where('practitioner_id',$practitionerID)->get();

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


        $TagManagements = TegManagements::orderBy('published', 'DESC')->orderBy('id', 'DESC')->get();

        $MyTagManagements = DB::table('teg_managements')
            ->join('practitioner_teg_managements', 'practitioner_teg_managements.teg_managements_id', 'teg_managements.id')
            ->where('practitioner_teg_managements.practitioner_id',$practitionerID)
            ->where('published',1)
            ->get();


        $Review = DB::table('reviews')
            ->select('reviews.rate','reviews.description','users.last_name','users.first_name','users.img','reviews.created_at')
            ->join('users', 'users.id', 'reviews.user_id')
            ->where('reviews.practitoner_id',$practitionerID)
            ->where('reviews.description','!=',null)
            ->get();


        $ThisWeekMeetingsList = ZoomModel::whereBetween('start', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('practitioner_id',$practitionerID)->get();

        return view('profile-view-as-a-customer',compact('Practitioner','Service','ServiceSession','ServiceDescription','TagManagements','MyTagManagements','ThisWeekMeetingsList','Review','ServizeID'));
    }

    public function typeFormPractitioner($lang,$practitionerID)
    {
        $TypeForm = TypeFormModel::where('practitioner_id',$practitionerID)->get();

        return view('type-form',compact('TypeForm'));
    }

    public function typeFormPractitionerView($lang,$id)
    {
        $TypeFormView = TypeFormModel::find($id);

        return view('type-form-view',compact('TypeFormView'));
    }


    public function balance()
    {
        $cards = Card::where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        $balance = Balance::where('user_id', Auth::id())->first();
        return view('balance', compact('cards','balance'));
    }



}
