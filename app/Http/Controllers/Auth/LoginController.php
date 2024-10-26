<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $loginDate = DB::table('attendance')->where('emp_id', auth()->user()->id)->whereDate('login_date',\Carbon\Carbon::now())->count();
        if($loginDate == 0){
            DB::table('attendance')->insert([
                'emp_id' => auth()->user()->id,
                'login_date' => \Carbon\Carbon::now()
            ]);
        }
        if (auth()->user()->is_admin) {
            if(auth()->user()->is_customer){
                return '/customer/home';
            }
            return '/admin';
        }else if(auth()->user()->is_user)
        {
            if(auth()->user()->team != null){
                $company = Company::where('team_id',auth()->user()->team->id)->first();
                if(auth()->user()->profile != 'complete' || (empty($company)  || (!empty($company) && $company->profile != 'complete')))
                {
                    return 'profile';
                }else{
                    return 'home';
                }
            }else{
                return 'profile';
            }
            
        }else{ 
            return 'customer/home';
        }

    }

    public function logout(){
        
        DB::table('attendance')->where('emp_id',auth()->user()->id)
        ->whereDate('login_date',\Carbon\Carbon::now())
        ->update(['logout_date' => \Carbon\Carbon::now()]);

        $user = auth()->user();

        auth()->logout();
        
        if($user->is_admin){
            if($user->is_customer){
               return redirect('/customer/login'); 
            }
            return redirect('/login');
        }else{
            return redirect('/login');
        }
    }
}
