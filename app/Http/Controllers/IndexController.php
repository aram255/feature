<?php

namespace App\Http\Controllers;

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
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;


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

    public function search(Request $request)
    {
        $tags=null;

        if(!empty($request->teg_management))
        {
            $tags = implode(', ', $request->teg_management);
        }

        $Practitioner = DB::select(
            "select p.id, p.first_name, p.last_name, p.email, p.phone_number, group_concat(tm.id) as tag_ids, group_concat(tm.name)as tag_names from practitioner as p
            left join  practitioner_lang_rel as  plr on p.id=plr.practitioner_id
            left join languages as l on l.id=plr.lang_id
            left join practitioner_teg_managements as ptm on p.id=ptm.practitioner_id
            left join teg_managements as tm on tm.id=ptm.teg_managements_id
            where 1=1"
            .(!empty($request->state)?" and l.id=$request->state":"")
            .(!empty($tags)? " and tm.id in ($tags)":"")
            .(!empty($request->vir)?" and mode_of_delivery='$request->vir'":"")
            .(!empty($request->gender)?" and gender='$request->gender'":"")
            ." group by p.id, p.first_name, p.last_name, p.email, p.phone_number"
            . (!empty($tags)?" having count(p.id)=".count($request->teg_management):"")
        );

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
        $Delivery = $request->vir;
        $Gender   = $request->gender;
        $Lang     = $request->state;

        $Practitioners = $this->paginate($Practitioner);

        $Languages      = $this->Languages();
        $TegManagements = $this->tegManagements();




        return view('filter',compact('Practitioners','Languages','TegManagements','Tag','Delivery','Gender','Lang'));

    }

    public function paginate($items, $perPage = 2, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public function blog()
    {
        return view('blog');
    }
}
