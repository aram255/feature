<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('edit-profile-customer');
    }

    public function profileViewCustomer()
    {
        return view('profile-view-as-a-customer');
    }
}
