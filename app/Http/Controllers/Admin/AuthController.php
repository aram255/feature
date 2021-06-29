<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Session;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest', ['except' => ['logout']]);
    }

    public function getLogin()
    {
        return view('admin.login');
    }

    /**
     * Show the application loginprocess.
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (auth()->guard('admin')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')]))
        {
            $user = auth()->guard('admin')->user();   
            return redirect()->route('dashboard');
        } else {
            return back()->with('error','your username and password are wrong.');
        }
    }

    /**
     * Show the application logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        \Session::flush();     
        return redirect(url('admin'));
    }
    public function saveProfile(Request $request){
        $data['name'] = $request['name'];
        $data['username'] = $request['username'];

        if(empty($data['username'])){
            return json_encode(array('status' => 0, 'message' => 'Username is required.'));
        }

        $usernameExist = DB::table('admin')->where('username', $data['username'])
                ->where('id','<>', auth()->guard('admin')->user()->id)
                ->get();
        if(count($usernameExist)){
            return json_encode(array('status' => 0, 'message' => 'Username is already taken.'));
        }

        DB::table('admin')->where('id', auth()->guard('admin')->user()->id)->update($data);
        return json_encode(array('status' => 1));
    }

    protected static $passwordValidation = array(
        'current_password'   => 'required',
        'new_password'   => 'required|between:3,30',
        'new_password_re' => 'same:new_password'
    );

    public function changePassword(Request $request){
        $data['current_password'] = $request['current_password'];
        $data['new_password'] = $request['new_password'];
        $data['new_password_re'] = $request['new_password_re'];
        
        $validation = Validator::make($data, self::$passwordValidation);
        if ($validation->fails()) {
            return json_encode(array('status' => 0, 'message' => 'Validation error.'));
        }

        if (!Hash::check($data['current_password'], auth()->guard('admin')->user()->password)) {
    		return json_encode(array('status' => 0, 'message' => 'Password is wrong'));
    	}

        $admin = Admin::where('id',auth()->guard('admin')->user()->id)->first();

        if($admin){
	    	$admin->fill([
	            'password' => Hash::make($data['new_password'])
	        ])->save();

	    	return json_encode(array('status' => 1));
    	}else{
            return json_encode(array('status' => 0, 'message' => 'Not saved.'));
    	}
    }
}