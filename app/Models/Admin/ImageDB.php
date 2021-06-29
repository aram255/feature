<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageHelper;
use Intervention\Image\Facades\Image;
use DB;
use Config;
use File;
use Validator;

class ImageDB extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

    public function get($id){
      $image = DB::table('images')
                ->select('*')
                ->where('id', $id)
                ->first();
      if($image){
        $image->path = asset('images/backendSmall/'.$image->filename.'.'.$image->ext);
        $image->path_original = asset('images/original/'.$image->filename.'.'.$image->ext);
        $image->path_small = asset('images/selfSmall/'.$image->filename.'.'.$image->ext);
        $image->path_medium = asset('images/selfMedium/'.$image->filename.'.'.$image->ext);
        $image->path_large = asset('images/selfLarge/'.$image->filename.'.'.$image->ext);
      }
      return $image;
    }

    public function add($image,$temp = 0){

        $imageHelper = new ImageHelper();

        $filename = $hash = $imageHelper->generateFilename();
        $ext = $image->getClientOriginalExtension();
        $size = $image->getSize();

        if($image->move('content/', $filename.'.'.$ext)){
          $data = array();
          if($temp){
              $tempStoreUntil = time() + (3 * 24 * 60 * 60);
              $data['temp'] = $tempStoreUntil;
          }
           $data['size'] = $size; 
           $data['filename'] = $filename; 
           $data['ext'] = $ext;  
           $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();  
           $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();

           $id = DB::table('images')->insertGetId($data);

           return $this->get($id);
        }
        return false;
    }

    public function remove($imageId){
      $image = ImageDB::find($imageId);

      if($image){
        $path = 'content/'.$image->filename.'.'.$image->ext;
        File::delete($path);

        $image->delete();
	     } 
    }
}

