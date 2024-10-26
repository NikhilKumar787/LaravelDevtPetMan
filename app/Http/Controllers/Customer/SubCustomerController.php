<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Group;
use App\Models\State;
use App\Models\Term;
use App\Models\User;

use App\Models\UserAddress;
use Carbon\Carbon;
use Gate;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
class SubCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $filter_date_id = $request->input('date_id');
            $filter_approve_id = $request->input('approve_id');
            if(isset(auth()->user()->id)){
                $company = \DB::table('company_role_user')->where('user_id',auth()->user()->id)->first(); 
                if($company->role_id != 0){
                    $query = Customer::with(['city', 'state'])->where('company_id',$company->company_id)->select(sprintf('%s.*', (new Customer())->table));
                    
                }elseif($company->role_id == 0){
                    $query = Customer::with(['city', 'state'])->where('company_id',$company->company_id)->where('created_by_id',auth()->user()->id)->select(sprintf('%s.*', (new Customer())->table));
                }  
            }
            // Apply Filters here!;
            if ($filter_date_id == 'date' && $filter_approve_id == 'customer_approve') {
                $query->select(sprintf('%s.*', (new Customer())->table))->get();
            } else {
                if($filter_date_id != 'date') {
                    switch ($filter_date_id) {
                        case 'today':
                            $query->whereDate('created_at', Carbon::today())->select(sprintf('%s.*', (new Customer())->table))->get();
                            break;
                        case 'yesterday':
                            $query->whereDate('created_at', Carbon::yesterday())->select(sprintf('%s.*', (new Customer())->table))->get();
                            break;
                        case 'this_week':
                            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->select(sprintf('%s.*', (new Customer())->table))->get();
                            break;
                        case 'last_week':
                            $query->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->select(sprintf('%s.*', (new Customer())->table))->get();
                            break;
                        case 'this_month':
                            $query->whereMonth('created_at', Carbon::now()->month)->select(sprintf('%s.*', (new Customer())->table))->get();
                            break;
                        case 'last_month':
                            $query->whereMonth('created_at', Carbon::now()->subMonth()->month)->select(sprintf('%s.*', (new Customer())->table))->get();
                            break;
                        case 'this_year':
                            $query->whereYear('created_at', Carbon::now()->year)->select(sprintf('%s.*', (new Customer())->table))->get();
                            break;
                        case 'last_year':
                            $query->whereYear('created_at', Carbon::now()->subYear()->year)->select(sprintf('%s.*', (new Customer())->table))->get();
                            break;
                    }
                   
                }
                if($filter_approve_id != 'customer_approve') {
                    $query->where('is_employee_approved', $filter_approve_id)->select(sprintf('%s.*', (new Customer())->table))->get();
                }
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            
            $table->editColumn('actions', function ($row){
                $approveGate = 'customer_access';
                $viewGate = 'customer_show';
                $editGate = 'customer_edit';
                $deleteGate = 'customer_delete';
                $crudRoutePart = 'subcustomers';
                
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

            $table->editColumn('first_name', function ($row) {
                return $row->company.' '.$row->middle_name.' '.$row->last_name ? $row->first_name.''.$row->middle_name.''.$row->last_name : '';
            });

            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->editColumn('pan_no', function ($row) {
                return $row->pan_no ? $row->pan_no : '';
            });

            $table->editColumn('company',function($row){
                return $row->company ? $row->company : '';
            });

            $table->addColumn('city', function ($row) {
                return $row->city->name ? $row->city->name : '';
            });

            $table->editColumn('state', function ($row) {
                return $row->state->state ? $row->state->state : '';
            });
            
            $table->rawColumns(['actions', 'placeholder', 'city', 'state']);

            return $table->make(true);
        }
        $user = User::where('id', auth()->user()->id)->first();
       
        $company_role_user = \DB::table('company_role_user')->where('user_id', $user->id)->first();
                
        $company = \DB::table('company_role_user')->where('user_id', auth()->user()->id)->first();
                if ($company_role_user->role_id != 0) {
                    $customer_approved = Customer::where('company_id',$company->company_id)->where('is_employee_approved',1)->count();
                    $customer_pending = Customer::where('company_id',$company->company_id)->where('is_employee_approved',0)->count();
                    $customer_total = Customer::where('company_id',$company->company_id)->count();
                } elseif ($company_role_user->role_id == 0) {
                    $customer_approved = Customer::where('company_id',$company->company_id)->where('is_employee_approved',1)->where('created_by_id',auth()->user()->id)->count();
                    $customer_pending = Customer::where('company_id',$company->company_id)->where('is_employee_approved',0)->where('created_by_id',auth()->user()->id)->count();
                    $customer_total = Customer::where('company_id',$company->company_id)->where('created_by_id',auth()->user()->id)->count();
                }
       
       
        return view('customer.subcustomers.index',compact('customer_approved','customer_pending','customer_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('customer.subcustomers.create', compact('cities', 'countries', 'states', 'terms','groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $request->merge([
            'first_name'=>ucfirst($request->first_name),
            'middle_name' => ucfirst($request->middle_name),
            'last_name' => ucfirst($request->last_name),
        ]);
        $customer = Customer::create($request->all());

        $company = \DB::table('company_role_user')->where('user_id',auth()->user()->id)->first();
        $customer->update(['company_id' => $company->company_id]);

        if(isset(auth()->user()->team))
        {   
            $customer->update(['team_id' => auth()->user()->team->id]);
        }

        $user_address = UserAddress::create([
            'name' => $request->title.' '.$request->first_name.' '.$request->middle_name.' '.$request->last_name,
            'phone_no' => $request->mobile ? $request->mobile : $request->phone,
            'addressline_1' => $request->address,
            'city' => City::select("name")->where('id',$request->city_id)->first(),
            'zip_code' => $request->pin_code,
            'type' => 'billing',
            'same_as' => '1',
            'state' => State::select("state")->where('id',$request->state_id)->first(),
            'customer_id' => $customer->id,
            'user_id' => auth()->user()->id
        ]);
        DB::table('customer_group')->insert([
            'group_id' => $request->group,
            'customer_id' => $customer->id
        ]);

        if ($request->input('attachment', false)) {
            $customer->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $customer->id]);
        }
        
        return redirect()->route('customer.subcustomers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer, $id)
    {
    
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer = Customer::with('city', 'state', 'country', 'term', 'team', 'customerUserAddresses', 'customersGroups')->where('id',$id)->first();
        $customer->load('city', 'state', 'country', 'term', 'team', 'customerUserAddresses', 'customersGroups');

        return view('customer.subcustomers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer,$id)
    {   
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customer = Customer::with('city', 'state', 'country', 'term', 'team', 'customerUserAddresses', 'customersGroups')->where('id',$id)->first();
        $customer->load('city', 'state', 'country', 'term', 'team');

        if(auth()->user()->is_customer){
            $view = view('customer.subcustomers.edit', compact('cities', 'countries', 'customer', 'states', 'terms'));
        }else{
            $view = view('customer.subcustomers.review', compact('cities', 'countries', 'customer', 'states', 'terms', 'groups'));
        }
        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer,$id)
    {
        dd('customer_upadte');
        $customer = Customer::where('id',$id)->first();
        $customer->update($request->all());

        if ($request->input('attachment', false)) {
            if (!$customer->attachment || $request->input('attachment') !== $customer->attachment->file_name) {
                if ($customer->attachment) {
                    $customer->attachment->delete();
                }
                $customer->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($customer->attachment) {
            $customer->attachment->delete();
        }
        if(auth()->user()->is_customer){
            return redirect()->route('customer.subcustomers.index');
        }else{
            return redirect()->route('admin.assignedtask.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer,$id)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer = Customer::where('id',$id)->first();
        $customer->delete();

        return back();
    }
    public function massDestroy(MassDestroyCustomerRequest $request)
    {
        Customer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('customer_create') && Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Customer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function gst(Request $request)
    {

        $a = 'https://appyflow.in/api/verifyGST/?gstNo=' . $request->gst_no . '&key_secret=0CnVxAuzyEQOBF9IjkLj36yByR63';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $a,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requested Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }


    public function getSubCustomers(Request $request)
    {
        $term = $request->q['term'];

        if(auth()->user())
        {

            if($request->company_id){
                $users = Customer::leftjoin('terms','terms.id','=','customers.term_id')
                ->where(function ($query) use($term) {
                    $query->where('first_name', 'LIKE', "%$term%")
                          ->orWhere('email', 'LIKE', "%$term%");
                })->where('company_id',$request->company_id)->select('customers.*','terms.credit_period','terms.credit_period_days')->get();
            } else {
                $users = Customer::leftjoin('terms','terms.id','=','customers.term_id')
                ->where(function ($query) use($term) {
                    $query->where('first_name', 'LIKE', "%$term%")
                          ->orWhere('email', 'LIKE', "%$term%");
                })->select('customers.*','terms.credit_period','terms.credit_period_days')->get();
            }
        }


        $users = $users->toArray();
        if(empty($users)){
            $users[] = [
                'id' => 0,
                'first_name' => 'Add New Customer',
                'email' => '',
                'phone' => ''
            ];
        }
        echo json_encode($users);
    }

    public function getGroups(Request $request)
    {
        $term = $request->q['term'];

        if(auth()->user())
        {
            $groups = Group::where('name','LIKE',"%$term%")->get();
        }

        $groups = $groups->toArray();

        if(empty($groups)){
            $groups[] = [
                'id' => 0,
                'name' => 'Add New Group',
            ];
        }
        echo json_encode($groups);
    }
    public function storeGroups(Request $request){
        if($request->name != ''){
            $groups = Group::create($request->all());
        }
        return $groups;
    }

    public function storeCustomer(Request $request)
    {
        $params = array();
        parse_str($request->data, $params);
        $customer = Customer::create($params);
        $customer->update(['created_by_id' => auth()->user()->id]);
        if($request->term_id != ''){
            $customer->update(['term_id' => $request->term_id]);
        }
        $request = json_decode(json_encode($params), FALSE);
        if(isset(auth()->user()->team))
        {
            $customer->update(['team_id' => auth()->user()->team->id]);
        }
        $user_address = UserAddress::create([
            'name' => $request->title.' '.$request->first_name.' '.$request->middle_name.' '.$request->last_name,
            'phone_no' => $request->mobile ? $request->mobile : $request->phone,
            'addressline_1' => $request->bill_address1,
            'addressline_2' => $request->bill_address2,
            'city' => City::where('id',$request->city_id)->first()->name,
            'zip_code' => $request->pin_code,
            'type' => 'billing',
            'state' => State::where('id',$request->state_id)->first()->state,
            'customer_id' => $customer->id,
            'user_id' => auth()->user()->id
        ]);
        $customer->update(['address' => $user_address->addressline_1.', '.$user_address->addressline_2.', '.$user_address->city.', '.$user_address->state.' '.$user_address->zip_code]);
        if(isset($request->same_as_bill) && $request->same_as_bill == '1')
        {
           $user_address->update(['same_as' => '1']);
        }else{
            $user_address2 = UserAddress::create([
                'name' => $request->title.' '.$request->first_name.' '.$request->middle_name.' '.$request->last_name,
                'phone_no' => $request->mobile ? $request->mobile : $request->phone,
                'addressline_1' => $request->ship_address1,
                'addressline_2' => $request->ship_address2,
                'city' => City::where('id',$request->city_id)->first()->name,
                'zip_code' => $request->pin_code2,
                'type' => 'shipping',
                'state' => State::where('id',$request->state_id)->first()->state,
                'customer_id' => $customer->id,
                'user_id' => auth()->user()->id
            ]);
        }


        if(isset($request->group) && $request->group !='')
        {
            DB::table('customer_group')->insert([
                'group_id' => $request->group,
                'customer_id' => $customer->id
            ]);
        }

        $customers = Customer::leftjoin('terms','terms.id','=','customers.term_id')
                ->where('customers.id',$customer->id)->select('customers.*','terms.credit_period','terms.credit_period_days')->first();
        return $customers;

    }

}
