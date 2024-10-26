<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\AssignedTask;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Group;
use App\Models\State;
use App\Models\Term;
use App\Models\Task;
use App\Models\UserAddress;
use Gate;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CustomersController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Customer::with(['city', 'state', 'country', 'term', 'team'])->select(sprintf('%s.*', (new Customer())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'customer_show';
                $editGate = 'customer_edit';
                $deleteGate = 'customer_delete';
                $crudRoutePart = 'customers';

                return view('partials.datatablesActions', compact(
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
            $table->editColumn('title', function ($row) {
                return $row->title ? Customer::TITLE_SELECT[$row->title] : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('gstin', function ($row) {
                return $row->gstin ? $row->gstin : '';
            });
            $table->editColumn('gst_type', function ($row) {
                return $row->gst_type ? Customer::GST_TYPE_SELECT[$row->gst_type] : '';
            });
            $table->editColumn('gst_customer_name', function ($row) {
                return $row->gst_customer_name ? $row->gst_customer_name : '';
            });
            $table->editColumn('mobile', function ($row) {
                return $row->mobile ? $row->mobile : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->addColumn('state_state', function ($row) {
                return $row->state ? $row->state->state : '';
            });

            $table->addColumn('country_name', function ($row) {
                return $row->country ? $row->country->name : '';
            });

            $table->editColumn('pin_code', function ($row) {
                return $row->pin_code ? $row->pin_code : '';
            });
            $table->editColumn('company', function ($row) {
                return $row->company ? $row->company : '';
            });
            $table->editColumn('other', function ($row) {
                return $row->other ? $row->other : '';
            });
            $table->editColumn('website', function ($row) {
                return $row->website ? $row->website : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->addColumn('term_name', function ($row) {
                return $row->term ? $row->term->name : '';
            });

            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('pan_no', function ($row) {
                return $row->pan_no ? $row->pan_no : '';
            });
            $table->editColumn('tan', function ($row) {
                return $row->tan ? $row->tan : '';
            });
            $table->editColumn('payment_method', function ($row) {
                return $row->payment_method ? Customer::PAYMENT_METHOD_SELECT[$row->payment_method] : '';
            });
            $table->editColumn('delivery_method', function ($row) {
                return $row->delivery_method ? Customer::DELIVERY_METHOD_SELECT[$row->delivery_method] : '';
            });
            $table->editColumn('attachment', function ($row) {
                return $row->attachment ? '<a href="' . $row->attachment->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('optional_data_1', function ($row) {
                return $row->optional_data_1 ? $row->optional_data_1 : '';
            });
            $table->editColumn('optional_data_2', function ($row) {
                return $row->optional_data_2 ? $row->optional_data_2 : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('is_my_vendor', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_my_vendor ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'city', 'state', 'country', 'term', 'attachment', 'is_my_vendor']);

            return $table->make(true);
        }

        return view('admin.customers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customers.create', compact('cities', 'countries', 'states', 'terms','groups'));
    }

    public function store(StoreCustomerRequest $request)
    {
       
        $customer = Customer::create($request->all());
        $company = \DB::table('company_role_user')->where('user_id',auth()->user()->id)->first();
        if($company != null){
            $customer->update(['company_id' => $company->company_id]);
        }
        
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

        return redirect()->route('admin.customers.index');
    }

    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customer->load('city', 'state', 'country', 'term', 'team');

        return view('admin.customers.edit', compact('cities', 'countries', 'customer', 'states', 'terms', 'groups'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {  
        $customer->update($request->all());
        if($request->customer_approval == 1 ){
            $customer->update(['is_employee_approved' => '1']);
            $assignedtask = AssignedTask::where('customer_id',$customer->id)->get();
            foreach($assignedtask as $data){
                $data->update(['customer_request_status' => '2']);
            }
          
        }
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
        if(auth()->user()->id == 1){
            $redirect = redirect()->route('admin.customers.index');
        }else{
            $redirect = redirect()->route('admin.assigned-tasks.index',);   
        }
        return $redirect;
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->load('city', 'state', 'country', 'term', 'team', 'customerUserAddresses', 'customersGroups');

        return view('admin.customers.show', compact('customer'));
    }

    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

    
    public function getCustomers(Request $request)
    {
        $term = $request->q['term'];
        if(auth()->user())
        {

            if($request->company_id){
                $users = Customer::leftjoin('terms','terms.id','=','customers.term_id')
                ->where(function ($query) use($term) {
                    $query->where('first_name', 'LIKE', "%$term%")
                          ->orWhere('email', 'LIKE', "%$term%")->orWhere('company','LIKE',"%$term%");
                })->where('company_id',$request->company_id)->select('customers.*','terms.credit_period','terms.credit_period_days')->get();
            } else {    
                $users = Customer::leftjoin('terms','terms.id','=','customers.term_id')
                ->where(function ($query) use($term) {
                    $query->where('first_name', 'LIKE', "%$term%")
                          ->orWhere('email', 'LIKE', "%$term%")->orWhere('company','LIKE',"%$term%");
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

    public function storeCustomer(Request $request)
    { 
        $company_id = $request->company_id;
        $term_id = $request->term_id;
        $params = array();
        parse_str($request->data, $params);
        $customer = Customer::create($params);
        $request = json_decode(json_encode($params), FALSE);
        $customer->term_id = $term_id;
        $customer->created_by_id = auth()->user()->id;
        $customer->company_id = $company_id;
        $customer->save();
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
