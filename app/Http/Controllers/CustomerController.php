<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Hash;


class CustomerController extends Controller
{
    public function __construct()
    {

         $this->middleware('auth');
    }
    public function profileCustomer()
    {
        return view('profile-customer');
    }

    public  function editProfileCustomer()
    {
        $cards = Card::where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        return view('edit-profile-customer', compact('cards'));
    }

    public function editProfileCustmerPost(request $request)
    {
//        $request->validate([
//            "password" => 'required|confirmed|min:6'
//        ]);

       //dd($request->gender);
        $EditCustomer = CustomerModel::where('id',Auth::id())->first();

        if(!empty($request->file('img')))
        {
            $ImgName     = rand() . '.' . $request->file('img')->getClientOriginalExtension();
            $request->file('img')->move(public_path('web_sayt/img_customer/'), $ImgName);

            if(File::exists(public_path('web_sayt/img_customer/'.$EditCustomer->img))){
                File::delete(public_path('web_sayt/img_customer/'.$EditCustomer->img));
            }

            $EditCustomer->img       = $ImgName;
            $EditCustomer->first_name = $request->first_name;
            $EditCustomer->last_name = $request->last_name;
            $EditCustomer->phone_number = $request->phone_number;
            $EditCustomer->email = $request->email;
            if($EditCustomer && in_array($request->gender,array('Male','Famale','Other'))) {
            $EditCustomer->gender = $request->gender;
            }
        }else{
            $EditCustomer->first_name = $request->first_name;
            $EditCustomer->last_name = $request->last_name;
            $EditCustomer->phone_number = $request->phone_number;
            $EditCustomer->email = $request->email;
            if($EditCustomer && in_array($request->gender,array('Male','Famale','Other'))) {
                $EditCustomer->gender = $request->gender;
            }
        }

        $EditCustomer->save();

        if($request->password != null) {
            $EditCustomerPassword = CustomerModel::where('id', Auth::id())->first();

//            if (Hash::check($request->password, $EditCustomerPassword->password))
//            {

                if (Hash::check($request->password, Hash::make($request->password_confirmation)))
                {

                    $request->validate([
                        "password"              => 'required',
                        "password_confirmation" => 'required'
                    ]);

                    $EditCustomerPassword->password = Hash::make($request->password);
                    $EditCustomerPassword->save();

                    if(!empty($EditCustomerPassword))
                    {
                        return back()->with('status','Your request has been completed.');
                    }
                }

            }
      //  }
        if(!empty($EditCustomer))
        {
            return back()->with('status','Your request has been completed');
        }

    }

    public function profileViewCustomer()
    {
        return view('profile-view-as-a-customer');
    }
}
