<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Practice;
use App\Models\Admin\Speciality;
use App\Models\Admin\Blog;
use App\Models\Admin\ImageDB;
use App\Models\Admin\TegManagements;
use App\Models\Admin\TegManagementsPractitionerModel;
use App\Models\Admin\CategoryModel;
use App\Models\Admin\CategoryTitleModel;
use Session;
use File;

class ContentController extends Controller
{
    //Practices
    public function indexPractices(){
        view()->share('menu', 'practices');
        return view('admin.content.practices_index');
    }

    public function dataPractices(Request $request){
        $model = new Practice();

        $filter = false;

        $items = $model->getAll(
            $request->input('start'),
            $request->input('length'),
            $filter,
            $request->input('sort_field'),
            $request->input('sort_dir'),
        );

        $data = json_encode(array('data' => $items['data'], 'recordsFiltered' => $items['count'], 'recordsTotal'=> $items['count']));
        return $data;
    }

    public function publishPractices(Request $request){

        $id = $request['pubItemId'];

        $item = Practice::find($id);
        if($item->published == 0){
            $item->published = 1;
        }else{
            $item->published = 0;
        }
        $item->save();
        $data = json_encode(array('status' => 1, 'id' => $id, 'published' => $item->published));

        return $data;
    }

    public function getPractices(Request $request){

        $id = (int)$request['id'];
        if($id){
            $item = Practice::find($id);
            $mode = "Edit";
        }else{
            $item = new Practice();
            $item->id = 0;
            $mode= "add";
        }
        $data = json_encode(
            array('data' =>
                (String) view('admin.content.practices_item', array(
                    'item'=>$item,
                    'mode' => $mode
                )),
                'status' => 1)
            );

        return $data;
    }

    public function savePractices(Request $request){
        $id = (int)$request['id'];

        if(!$id){
            $item = new Practice();
            $item->save();
        }else{
            $item = Practice::find($id);
        }

        $item->title = $request['title'];
        $item->published = (int)$request['published'];
        $item->save();
        return json_encode(array('status' => 1));
    }

    public function removePractices(Request $request){
        $ids = $request['ids'];
        foreach ($ids as $id) {
            $item = Practice::find($id);
            if($item){
                $item->delete();
            }else{
                return json_encode(array('status' => 0, 'message' => "Can't remove"));
            }
        }

        $data = json_encode(array('status' => 1));
        return $data;
    }

    //Specialities
    public function indexSpecialities(){
        view()->share('menu', 'specialities');
        return view('admin.content.specialities_index');
    }

    public function dataSpecialities(Request $request){
        $model = new Speciality();

        $filter = false;

        $items = $model->getAll(
            $request->input('start'),
            $request->input('length'),
            $filter,
            $request->input('sort_field'),
            $request->input('sort_dir'),
        );

        $data = json_encode(array('data' => $items['data'], 'recordsFiltered' => $items['count'], 'recordsTotal'=> $items['count']));
        return $data;
    }

    public function publishSpecialities(Request $request){

        $id = $request['pubItemId'];

        $item = Speciality::find($id);
        if($item->published == 0){
            $item->published = 1;
        }else{
            $item->published = 0;
        }
        $item->save();
        $data = json_encode(array('status' => 1, 'id' => $id, 'published' => $item->published));

        return $data;
    }

    public function getSpecialities(Request $request){

        $id = (int)$request['id'];
        if($id){
            $item = Speciality::find($id);
            $mode = "Edit";
        }else{
            $item = new Speciality();
            $item->id = 0;
            $mode= "add";
        }
        $data = json_encode(
            array('data' =>
                (String) view('admin.content.specialities_item', array(
                    'item'=>$item,
                    'mode' => $mode
                )),
                'status' => 1)
            );

        return $data;
    }

    public function saveSpecialities(Request $request){
        $id = (int)$request['id'];

        if(!$id){
            $item = new Speciality();
            $item->save();
        }else{
            $item = Speciality::find($id);
        }

        $item->title = $request['title'];
        $item->published = (int)$request['published'];
        $item->save();
        return json_encode(array('status' => 1));
    }

    public function removeSpecialities(Request $request){
        $ids = $request['ids'];
        foreach ($ids as $id) {
            $item = Speciality::find($id);
            if($item){
                $item->delete();
            }else{
                return json_encode(array('status' => 0, 'message' => "Can't remove"));
            }
        }

        $data = json_encode(array('status' => 1));
        return $data;
    }

    //blog
    public function indexBlog(){
        view()->share('menu', 'blog');
        return view('admin.content.blog_index');
    }

    public function dataBlog(Request $request){
        $model = new Blog();

        $filter = false;

        $items = $model->getAll(
            $request->input('start'),
            $request->input('length'),
            $filter,
            $request->input('sort_field'),
            $request->input('sort_dir'),
        );

        $data = json_encode(array('data' => $items['data'], 'recordsFiltered' => $items['count'], 'recordsTotal'=> $items['count']));
        return $data;
    }

    public function publishBlog(Request $request){

        $id = $request['pubItemId'];

        $item = Blog::find($id);
        if($item->published == 0){
            $item->published = 1;
        }else{
            $item->published = 0;
        }
        $item->save();
        $data = json_encode(array('status' => 1, 'id' => $id, 'published' => $item->published));

        return $data;
    }

    public function getBlog(Request $request){

        $id = (int)$request['id'];
        if($id){
            $item = Blog::find($id);

            if($item->image_id){
                $imageDb = new ImageDB();
                $item->image = $imageDb->get($item->image_id);
            }

            $mode = "Edit";
        }else{
            $item = new Blog();
            $item->id = 0;
            $item->published = 1;
            $mode= "add";
        }

        $data = json_encode(
            array('data' =>
                (String) view('admin.content.blog_item', array(
                    'item'=>$item,
                    'mode' => $mode
                )),
                'status' => 1)
            );

        return $data;
    }

    public function saveBlog(Request $request){
        $id = (int)$request['id'];

        if(!$id){
            $item = new Blog();
            $item->save();
        }else{
            $item = Blog::find($id);
        }

        $item->image_id = (int)$request['file'];

        if($item->image_id){
            $imageDB = ImageDB::find($item->image_id);
            $imageDB->temp = 0;
            $imageDB->save();
        }

        $item->title = $request['title'];
        $item->description = $request['description'];
        $item->text = $request['text'];
        $item->published = (int)$request['published'];
        $item->save();
        return json_encode(array('status' => 1));
    }

    public function removeBlog(Request $request){
        $ids = $request['ids'];
        foreach ($ids as $id) {
            $item = Blog::find($id);
            if($item){
                if($item->image_id ){
                    $image = ImageDB::find($item->image_id);
                    if($item->image_id){
                        $image->remove($item->image_id);
                    }
                }

                $item->delete();
            }else{
                return json_encode(array('status' => 0, 'message' => "Can't remove"));
            }
        }

        $data = json_encode(array('status' => 1));
        return $data;
    }

    public function tegManagement()
    {
        $TegManagements = TegManagements::orderBy('id', 'DESC')->paginate(10);
        return view('admin.content.tag-management',compact('TegManagements'));
    }

    public function AddTegManagements(request $request)
    {
        $request->validate([
            'teg'       => 'required',
            'published' => 'required',
        ]);

        $Add            = new TegManagements;
        $Add->name      = $request->teg;
        $Add->published = $request->published;
        $Add->save();

        Session::flash('success', 'Add');
        return redirect()->back();
    }

    public function editTegManagements(request $request)
    {
        $Edit = TegManagements::find($request->teg_id);
        $Edit->name      = $request->teg;
        $Edit->published = $request->published;
        $Edit->save();

        Session::flash('success', 'Edit');
        return redirect()->back();
    }

    public function DeleteTegManagements(request $request)
    {
        foreach ($request->teg_id as $ID) {
            $DeleteTeg = TegManagements::where('id', $ID)->first();
            $DeleteTeg->delete();

            $Delete = TegManagementsPractitionerModel::where('teg_managements_id', $DeleteTeg->id)->first();
            if (!empty($Delete)) {
                $Delete->delete();
            }
        }
        Session::flash('success', 'Delete');
        return redirect()->back();

    }


    // Category and Title Category

    public  function titleCategory()
    {
        return CategoryTitleModel::first();
    }

    public function editTitleCategory(request $request)
    {
        $Edit = CategoryTitleModel::find($request->cat_title_id);

        $Edit->title = $request->cat_title;
        $Edit->save();

        Session::flash('success', 'Edit');
        return redirect()->back();
    }


    public function category()
    {
        $Category      = CategoryModel::orderBy('id', 'DESC')->paginate(10);
        $CategoryTitle = $this->titleCategory();

         return view('admin.content.category',compact('Category','CategoryTitle'));
    }

    public function addCategory(request $request)
    {
        $request->validate([
            'cat'       => 'required',
            'img'       => 'required',
            'published' => 'required',
        ]);

        $ImgName     = rand() . '.' . $request->file('img')->getClientOriginalExtension();
        $request->file('img')->move(public_path('web_sayt/img_category/'), $ImgName);

        $Add            = new CategoryModel;
        $Add->title     = $request->cat;
        $Add->alt       = $request->alt;
        $Add->img       = $ImgName;
        $Add->published = $request->published;
        $Add->save();

        Session::flash('success', 'Add');
        return redirect()->back();
    }

    public function editCategory(request $request)
    {
        $Edit = CategoryModel::find($request->cat_id);

        if(!empty($request->file('img')))
        {
            $ImgName     = rand() . '.' . $request->file('img')->getClientOriginalExtension();
            $request->file('img')->move(public_path('web_sayt/img_category/'), $ImgName);

            if(File::exists(public_path('web_sayt/img_category/'.$Edit->img))){
                File::delete(public_path('web_sayt/img_category/'.$Edit->img));
            }

            $Edit->img       = $ImgName;
            $Edit->title     = $request->cat;
            $Edit->alt       = $request->alt;
            $Edit->published = $request->published;
        }else{
            $Edit->title     = $request->cat;
            $Edit->alt       = $request->alt;
            $Edit->published = $request->published;
        }
        $Edit->save();


        Session::flash('success', 'Edit');
        return redirect()->back();
    }

    public function deleteCategory(request $request)
    {
        foreach ($request->cat_id as $ID) {
            $DeleteCategory = CategoryModel::where('id', $ID)->first();
            $DeleteCategory->delete();

            if(File::exists(public_path('web_sayt/img_category/'.$DeleteCategory->img))){
                File::delete(public_path('web_sayt/img_category/'.$DeleteCategory->img));
            }

        }
        Session::flash('success', 'Delete');
        return redirect()->back();
    }


}
