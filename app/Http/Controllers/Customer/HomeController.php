<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;

class HomeController extends Controller
{
    public function index()
    {      
       // echo "asdf"; die;
        return view('customer.home');
    }
}
