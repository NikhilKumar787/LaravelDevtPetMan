<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\Team;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\Facades\DataTables;

class TeamManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if(auth()->user()->roles[0]->id == 5){
                if(request()->type == 'pe'){
                    $query = User::with(['roles', 'departments', 'team'])
                    ->join('role_user','role_user.user_id','=','users.id')
                    ->join('attendance','attendance.emp_id','=','users.id')
                    ->whereIn('role_id',[3])
                    ->whereDate('login_date',\Carbon\Carbon::now())
                    ->select(sprintf('%s.*', (new User())->table),'attendance.login_date', 'attendance.logout_date');
                } else if(request()->type == 'ae'){
                    $userIds = User::with(['roles', 'departments', 'team'])
                    ->join('role_user','role_user.user_id','=','users.id')
                    ->join('attendance','attendance.emp_id','=','users.id')
                    ->whereIn('role_id',[3])
                    ->whereDate('login_date',\Carbon\Carbon::now())
                    ->select(sprintf('%s.*', (new User())->table))
                    ->pluck('users.id');

                    $query = User::with(['roles', 'departments', 'team'])
                    ->join('role_user','role_user.user_id','=','users.id')
                    ->whereIn('role_id',[3])
                    ->whereNotIn('users.id',$userIds)
                    ->select(sprintf('%s.*', (new User())->table));
                } else {
                    $query = User::with(['roles', 'departments', 'team'])
                    ->join('role_user','role_user.user_id','=','users.id')
                    ->whereIn('role_id',[3])
                    ->select(sprintf('%s.*', (new User())->table));
                }
                
            } else {
                // $current_user_comp_id = \DB::table('company_role_user')->where('user_id',auth()->user()->id)->first();
                // $customer_id = \DB::table('company_role_user')->where('company_id',$current_user_comp_id->company_id)->get();
    
                // $team_details = User::where('id',auth()->user()->id)->first();
                $query = User::with(['roles', 'departments', 'team'])->where('team_id',auth()->user()->id)
                ->join('role_user','role_user.user_id','=','users.id')->where('role_id',7)->select(sprintf('%s.*', (new User())->table));
            }

            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $approveGate = 'invoice_approve';
                $viewGate = 'customer_team_show';
                $editGate = 'customer_team_edit';
                $deleteGate = 'customer_team_delete';
                $crudRoutePart = 'team';

                return view('partials.customer_datatablesActions', compact(
                'approveGate',
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->editColumn('approved', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->approved ? 'checked' : null) . '>';
            });
            $table->editColumn('verified', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->verified ? 'checked' : null) . '>';
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('login_date', function ($row) {
                return $row->login_date ? date('H:i', strtotime($row->login_date)) : '';
            });
            $table->editColumn('logout_date', function ($row) {
                return $row->logout_date ? date('H:i', strtotime($row->logout_date)) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'approved', 'verified', 'roles']);

            return $table->make(true);
        }
        $company = \DB::table('company_role_user')->where('user_id',auth()->user()->id)->first();
        if($company == null){
            $user = User::where('id',auth()->user()->id)->first();
            $company_role_user = \DB::table('company_role_user')->where('user_id',$user->team_id)->first();
            $company = $company_role_user->company_id;
        }else{
            $company = $company->company_id; 
        }
        $team= Company::where('id',$company)->first();
        $user = User::where('team_id',auth()->user()->id)->count();

        return view('customer.team.index',compact('user','team'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team_details = User::where('id',auth()->user()->id)->first();
        $roles = Role::where('id',7)->pluck('title','id');
        return view('customer.team.create',compact('team_details','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $team_details = User::where('id',auth()->user()->id)->first(); 
        $company_id = \DB::table('company_role_user')->where('user_id',auth()->user()->id)->first();  
          $team = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone_no' => $request->phone_no,
            'approved' => $request->approved,
            'team_id' => auth()->user()->id, 
 
          ]);
          $company_role_user = \DB::table('company_role_user')->insert([
            'user_id' =>$team->id,
            'role_id' =>'0',
            'company_id' =>$company_id->company_id,
          ]);
          $role_user = \DB::table('role_user')->insert([
            'user_id' =>$team->id,
            'role_id' =>'7',
          ]);

        // $data=['name' =>$request->email,'password' =>$request->password,];
        // $user = $request->email;
        // Mail::send('customer.team.mail',$data,function($message) use ($user){
        //     $message->to($user);
        //     $message->subject('Welcome to Taxtube!!!');

        // });
        return redirect()->route('customer.team.index');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,$id)
    {
        $user = User::where('id',$id)->first();

        return view('customer.team.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,$id)
    {
        $user = User::where('id',$id)->first();
        $roles = Role::where('id',7)->pluck('title','id');
        $team_details = User::where('id',auth()->user()->id)->first();

        return view('customer.team.edit', compact('user','roles','team_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $team_details = User::where('id',auth()->user()->id)->first(); 
        $team = User::where('id',$id)->first();
         $team->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone_no' => $request->phone_no,
            'approved' => $request->approved,
            'team_id' => auth()->user()->id, 
 
          ]);
          return redirect()->route('customer.team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,User $user)
    {
        $user = User::where('id',$id)->first();
        $user->delete();
        return back();
    }
}
