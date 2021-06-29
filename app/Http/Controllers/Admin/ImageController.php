<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ImageDB;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;
use DB;

class ImageController extends Controller
{
	protected $request;

    public function __construct(Request $request){
        $this->request = $request;
    }
    
    public function upload(){

        $image = $this->request->file('file');
        $temp = (int)$this->request->input('temp');

        $fileArray = array('image' => $image);

        $rules = array(
          'image' => 'mimes:jpeg,jpg,png|required|max:10000' // max 10000kb
        );

        $validator = Validator::make($fileArray, $rules);

        if ($validator->fails())
        {   
            $messages = $validator->errors();
            $responseMessages = '';
            foreach ($messages->all(':message') as $message) {
                $responseMessages .= $message;
            }
            return Response::json(['status' => 0, 'message'=> $responseMessages]);
        }else{
            $model = new ImageDB();
            $image = $model->add($image,$temp);
            return Response::json(['status' => 1, 'imageId'=> $image->id, 'path' => $image->path ]);
        }
    }

    public function remove(){
        $image_id = (int)$this->request->input('imageId');

        $owner_id = (int)$this->request->input('owner_id');
        $owner_type = (int)$this->request->input('owner_type');

        $model = new ImageDB();
        $model->remove($image_id);

        if($owner_id){
            if($owner_type == 'blog'){
                DB::table('blog')->where('id', $owner_id)->update(array('image_id' => null));
            }
        }
        return Response::json(['status' => 1]);
    }

    public function sort(){
        $imageIds = $this->request->input('ids');
        foreach($imageIds as $value => $key)
        {
            $image = ImageDB::find($key);
            $image->ordering = $value;
            $image->save();
        }
    }
}
