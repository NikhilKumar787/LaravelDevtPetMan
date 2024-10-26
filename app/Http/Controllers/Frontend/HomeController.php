<?php

namespace App\Http\Controllers\Frontend;
use App\Models\User;
use App\Models\Company;

class HomeController
{
    public function index()
    {
        $user = User::where('id',auth()->user()->id)->first();
        if(auth()->user()->team != null){
            $company = Company::where('team_id',auth()->user()->team->id)->first();
            $view = view('frontend.home',compact('user','company'));
        }else{
            $view = view('frontend.home',compact('user'));
        }
        return $view;
    }
}
