<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin\Client;

class ClientController extends Controller
{
    public function index(){
        view()->share('menu', 'clients');
        return view('admin.client.index');
    }

    public function data(Request $request){
        $model = new Client();

        $filter = false;
        if($request->input('filter_status')){
            $filter = array(
                'status' => $request->input('filter_status'),
            );    
        }

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

    public function edit(Request $request){

        $id = (int)$request['id'];
        $model = new Client();

        $profile = $model->getProfile($id);

        $data = json_encode(
            array('data' => 
                (String) view('admin.client.item', array(
                    'profile'=>$profile,
                )),
                'status' => 1)
            );

        return $data;  
    }
}