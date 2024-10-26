<?php

namespace App\Http\Controllers\Customer;
use App\Models\User;
use App\Models\Company;

class LoginController
{
    public function index()
    {      
        return view('customer.login');
    }
}
