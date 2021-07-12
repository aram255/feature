<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function profileViewCustomer()
    {
        return view('profile-view-as-a-customer');
    }
}
