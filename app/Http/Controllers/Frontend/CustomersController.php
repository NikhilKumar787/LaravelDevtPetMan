<?php

namespace App\Http\Controllers\Frontend;

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
use Illuminate\Support\Facades\DB;
use App\Models\UserAddress;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CustomersController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::with(['city', 'state', 'country', 'term', 'team', 'media'])->where('team_id',auth()->user()->team->id)->get();

        return view('frontend.customers.index', compact('customers'));
    }

    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.customers.create', compact('cities', 'countries', 'states', 'terms','groups'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->all());
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

        return redirect()->route('frontend.customers.index');
    }

    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customer->load('city', 'state', 'country', 'term', 'team');

        return view('frontend.customers.edit', compact('cities', 'countries', 'customer', 'states', 'terms'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
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

        return redirect()->route('frontend.customers.index');
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->load('city', 'state', 'country', 'term', 'team', 'customerUserAddresses', 'customersGroups');

        return view('frontend.customers.show', compact('customer'));
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

            if(isset(auth()->user()->team))
            {
                $users = Customer::where('team_id',auth()->user()->team->id);
            }else{
                $users = Customer::where('team_id',null);
            }

            $users = $users->where(function ($query) use($term) {
                $query->where('first_name', 'LIKE', "%$term%")
                      ->orWhere('email', 'LIKE', "%$term%");
            })->get();

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

        $customer = Customer::create($request->all());
        if(isset(auth()->user()->team))
        {
            $customer->update(['team_id' => auth()->user()->team->id]);

        }
        $user_address = UserAddress::create([
            'name' => $request->title.' '.$request->first_name.' '.$request->middle_name.' '.$request->last_name,
            'phone_no' => $request->mobile ? $request->mobile : $request->phone,
            'addressline_1' => $request->bill_address1,
            'addressline_2' => $request->bill_address2,
            'city' => City::select("name")->where('id',$request->city_id)->first(),
            'zip_code' => $request->pin_code,
            'type' => 'billing',
            'state' => State::select("state")->where('id',$request->state_id)->first(),
            'customer_id' => $customer->id,
            'user_id' => auth()->user()->id
        ]);
        $customer->update(['address' => $user_address->addressline_1.', '.$user_address->addressline_2.', '.$user_address->city.', '.$user_address->state.' '.$user_address->zip_code]);
        if($request->same_as_bill == '1')
        {
           $user_address->update(['same_as' => '1']);
        }else{
            $user_address2 = UserAddress::create([
                'name' => $request->title.' '.$request->first_name.' '.$request->middle_name.' '.$request->last_name,
                'phone_no' => $request->mobile ? $request->mobile : $request->phone,
                'addressline_1' => $request->ship_address1,
                'addressline_2' => $request->ship_address2,
                'city' => City::select("name")->where('id',$request->city_id2)->first(),
                'zip_code' => $request->pin_code2,
                'type' => 'shipping',
                'state' => State::select("state")->where('id',$request->state_id2)->first(),
                'customer_id' => $customer->id,
                'user_id' => auth()->user()->id
            ]);
        }


        if(isset($request->group))
        {
            DB::table('customer_group')->insert([
                'group_id' => $request->group,
                'customer_id' => $customer->id
            ]);
        }

        return $customer;

    }
}
