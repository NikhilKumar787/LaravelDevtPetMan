<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyCustomFields;
use App\Models\State;
use App\Models\User;
use App\Models\CompanyType;
use App\Models\CompanyRole;
use App\Models\Department;
use App\Models\DepartmentHead;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\UserSetPasswordNotification;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;

class CompanyController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Company::with(['city', 'state', 'team'])->withTrashed()->select(sprintf('%s.*', (new Company())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'company_show';
                $editGate = 'company_edit';
                $deleteGate = 'company_delete';
                $crudRoutePart = 'companies';
                $company = Company::withTrashed()->where('id',$row->id)->first();

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row',
                'company',
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('company_logo', function ($row) {
                if ($photo = $row->company_logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail,
                    );
                }
                return '';
            });
            $table->editColumn('copy_of_pan_tan', function ($row) {
                if ($photo = $row->copy_of_pan_tan) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('gst_certificate', function ($row) {
                if ($photo = $row->gst_certificate) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('vat_certficate', function ($row) {
                if ($photo = $row->vat_certficate) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('username_for_pan_tan', function ($row) {
                return $row->username_for_pan_tan ? $row->username_for_pan_tan : '';
            });
            $table->editColumn('password_for_pan_tan', function ($row) {
                return $row->password_for_pan_tan ? $row->password_for_pan_tan : '';
            });
            $table->editColumn('username_for_gst_vat_icegate_dgft', function ($row) {
                return $row->username_for_gst_vat_icegate_dgft ? $row->username_for_gst_vat_icegate_dgft : '';
            });
            $table->editColumn('password_for_gst_vat_icegate_dgft', function ($row) {
                return $row->password_for_gst_vat_icegate_dgft ? $row->password_for_gst_vat_icegate_dgft : '';
            });
            $table->editColumn('username_for_e_way_e_invoicing', function ($row) {
                return $row->username_for_e_way_e_invoicing ? $row->username_for_e_way_e_invoicing : '';
            });
            $table->editColumn('password_for_e_way_e_invoicing', function ($row) {
                return $row->password_for_e_way_e_invoicing ? $row->password_for_e_way_e_invoicing : '';
            });
            $table->editColumn('username_for_traces', function ($row) {
                return $row->username_for_traces ? $row->username_for_traces : '';
            });
            $table->editColumn('password_for_traces', function ($row) {
                return $row->password_for_traces ? $row->password_for_traces : '';
            });
            $table->editColumn('username_for_pf_esi_and_other_labour_law', function ($row) {
                return $row->username_for_pf_esi_and_other_labour_law ? $row->username_for_pf_esi_and_other_labour_law : '';
            });
            $table->editColumn('password_for_pf_esi_and_other_labour_law', function ($row) {
                return $row->password_for_pf_esi_and_other_labour_law ? $row->password_for_pf_esi_and_other_labour_law : '';
            });
            $table->editColumn('username_for_reporting_portal', function ($row) {
                return $row->username_for_reporting_portal ? $row->username_for_reporting_portal : '';
            });
            $table->editColumn('password_for_reporting_portal', function ($row) {
                return $row->password_for_reporting_portal ? $row->password_for_reporting_portal : '';
            });
            $table->editColumn('msme_registration_certificate', function ($row) {
                if ($photo = $row->msme_registration_certificate) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('shop_establishment_certificate', function ($row) {
                if ($photo = $row->shop_establishment_certificate) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('address_proof', function ($row) {
                if ($photo = $row->address_proof) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('company_name', function ($row) {
                return $row->company_name ? $row->company_name : '';
            });
            $table->editColumn('gstin', function ($row) {
                return $row->gstin ? $row->gstin : '';
            });
            $table->editColumn('address_line_1', function ($row) {
                return $row->address_line_1 ? $row->address_line_1 : '';
            });
            $table->editColumn('address_line_2', function ($row) {
                return $row->address_line_2 ? $row->address_line_2 : '';
            });
            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->addColumn('state_state', function ($row) {
                return $row->state ? $row->state->state : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'company_logo', 'copy_of_pan_tan', 'gst_certificate', 'vat_certficate', 'msme_registration_certificate', 'shop_establishment_certificate', 'address_proof', 'city', 'state']);

            return $table->make(true);
        }

        return view('admin.companies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $taxtubeTeams = User::join('role_user','role_user.user_id','=','users.id')->whereIn('role_id',[3])->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), ''); 
        //-> where i have added a condition when we add any company and then select any taxtubeteams then where show only BookKeeping assigned Users.. 

        $companyTypes = CompanyType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.companies.create', compact('cities', 'states', 'users','companyTypes','taxtubeTeams'));
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->all());

        if($request->custom_field_id != '')
        {
            foreach($request->custom_field_id as $key => $data)
            {
                $company_custom_field = CompanyCustomFields::where('id', $key)->first();
                $company_custom_field->update([
                    'custom_field_value' => $data,
                    'company_id' => $company->id,
                ]);
            }
        }

        for($i=1;$i<9;$i++)
        {
            $department[$i]['department_id'] = $i;
            $department[$i]['company_id'] = $company->id;
            $department[$i]['head_of_department_id'] = '0';
        }
        $department = DepartmentHead::insert($department);

        $companyUser = \DB::table('company_role_user')->whereIn('user_id',$request->customer_id)->update([
            'company_id' => $company->id
        ]);
      
        if($request->input('company_logo', false)) {
            $company->addMedia(storage_path('tmp/uploads/'. basename($request->input('company_logo'))))->toMediaCollection('company_logo');
        }

        if ($request->input('copy_of_pan_tan', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('copy_of_pan_tan'))))->toMediaCollection('copy_of_pan_tan');
        }

        if ($request->input('stamp_and_sign', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('stamp_and_sign'))))->toMediaCollection('stamp_and_sign');
        }

        if ($request->input('gst_certificate', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('gst_certificate'))))->toMediaCollection('gst_certificate');
        }

        if ($request->input('vat_certficate', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('vat_certficate'))))->toMediaCollection('vat_certficate');
        }

        if ($request->input('msme_registration_certificate', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('msme_registration_certificate'))))->toMediaCollection('msme_registration_certificate');
        }

        if ($request->input('shop_establishment_certificate', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('shop_establishment_certificate'))))->toMediaCollection('shop_establishment_certificate');
        }

        if ($request->input('address_proof', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('address_proof'))))->toMediaCollection('address_proof');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $company->id]);
        }

        return redirect()->route('admin.companies.index')->with('success','Company created successfully!');  
    }

    public function edit(Company $company)
    {
        abort_if(Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
        $company->load('city', 'state', 'team');
        $users = User::pluck('name', 'id');
        $companyTypes = CompanyType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $companyRoleUser = \DB::table('company_role_user')
        ->join('company_roles','company_roles.id','=','company_role_user.role_id')
        ->join('users','users.id','=','company_role_user.user_id')
        ->where('company_role_user.company_id',$company->id)
        ->select('users.*','company_roles.name as company_role','company_roles.id as company_role_id')
        ->get();
        $company_custom_fields = CompanyCustomFields::where('company_id',$company->id)->get();
        $taxtubeTeams = User::with('department')->join('role_user','role_user.user_id','=','users.id')->whereIn('role_id',[3])->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), ''); 
        return view('admin.companies.edit', compact('cities', 'company', 'states', 'users','companyTypes','companyRoleUser','taxtubeTeams','company_custom_fields'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->all());
        if($request->custom_field_id != '')
        {
            foreach($request->custom_field_id as $key => $data)
            {
                $company_custom_field = CompanyCustomFields::where('id', $key)->first();
                $company_custom_field->update([
                    'custom_field_value' => $data,
                    'company_id' => $company->id,
                ]);
            }
        }
        
        $companyUser = \DB::table('company_role_user')->whereIn('user_id',$request->customer_id)->update([
            'company_id' => $company->id
        ]);
      
        $company->users()->sync($request->input('users', []));
        if ($request->input('copy_of_pan_tan', false)) {
            if (!$company->copy_of_pan_tan || $request->input('copy_of_pan_tan') !== $company->copy_of_pan_tan->file_name) {
                if ($company->copy_of_pan_tan) {
                    $company->copy_of_pan_tan->delete();
                }
                $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('copy_of_pan_tan'))))->toMediaCollection('copy_of_pan_tan');
            }
        } elseif ($company->copy_of_pan_tan) {
            $company->copy_of_pan_tan->delete();
        }

        if ($request->input('company_logo', false)) {
            if (!$company->company_logo || $request->input('company_logo') !== $company->company_logo->file_name) {
                if ($company->company_logo) {
                    $company->company_logo->delete();
                }
                $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('company_logo'))))->toMediaCollection('company_logo');
            }
        } elseif ($company->company_logo) {
            $company->company_logo->delete();
        }

        if ($request->input('stamp_and_sign', false)) {
            if (!$company->stamp_and_sign || $request->input('stamp_and_sign') !== $company->stamp_and_sign->file_name) {
                if ($company->stamp_and_sign) {
                    $company->stamp_and_sign->delete();
                }
                $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('stamp_and_sign'))))->toMediaCollection('stamp_and_sign');
            }
        } elseif ($company->stamp_and_sign) {
            $company->stamp_and_sign->delete();
        }

        if ($request->input('gst_certificate', false)) {
            if (!$company->gst_certificate || $request->input('gst_certificate') !== $company->gst_certificate->file_name) {
                if ($company->gst_certificate) {
                    $company->gst_certificate->delete();
                }
                $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('gst_certificate'))))->toMediaCollection('gst_certificate');
            }
        } elseif ($company->gst_certificate) {
            $company->gst_certificate->delete();
        }

        if ($request->input('vat_certficate', false)) {
            if (!$company->vat_certficate || $request->input('vat_certficate') !== $company->vat_certficate->file_name) {
                if ($company->vat_certficate) {
                    $company->vat_certficate->delete();
                }
                $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('vat_certficate'))))->toMediaCollection('vat_certficate');
            }
        } elseif ($company->vat_certficate) {
            $company->vat_certficate->delete();
        }

        if ($request->input('msme_registration_certificate', false)) {
            if (!$company->msme_registration_certificate || $request->input('msme_registration_certificate') !== $company->msme_registration_certificate->file_name) {
                if ($company->msme_registration_certificate) {
                    $company->msme_registration_certificate->delete();
                }
                $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('msme_registration_certificate'))))->toMediaCollection('msme_registration_certificate');
            }
        } elseif ($company->msme_registration_certificate) {
            $company->msme_registration_certificate->delete();
        }

        if ($request->input('shop_establishment_certificate', false)) {
            if (!$company->shop_establishment_certificate || $request->input('shop_establishment_certificate') !== $company->shop_establishment_certificate->file_name) {
                if ($company->shop_establishment_certificate) {
                    $company->shop_establishment_certificate->delete();
                }
                $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('shop_establishment_certificate'))))->toMediaCollection('shop_establishment_certificate');
            }
        } elseif ($company->shop_establishment_certificate) {
            $company->shop_establishment_certificate->delete();
        }

        if ($request->input('address_proof', false)) {
            if (!$company->address_proof || $request->input('address_proof') !== $company->address_proof->file_name) {
                if ($company->address_proof) {
                    $company->address_proof->delete();
                }
                $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('address_proof'))))->toMediaCollection('address_proof');
            }
        } elseif ($company->address_proof) {
            $company->address_proof->delete();
        }

        return redirect()->route('admin.companies.index');
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $company_type_name = Company::join('company_types','company_types.id','=','companies.company_type_id')
                       ->where('companies.id',$company->id)
                       ->get(['companies.company_type_id','company_types.name']);               

                       
        $company_role_user = Company::join('company_role_user','company_role_user.company_id','=','companies.id')
                            ->where('company_role_user.company_id', $company->id)     
                            ->get(['company_role_user.user_id','company_role_user.role_id']);
        
        $company_owner = \DB::table('company_role_user')
        ->join('company_roles','company_roles.id','=','company_role_user.role_id')
        ->join('users','users.id','=','company_role_user.user_id')
        ->where('company_role_user.company_id',$company->id)
        ->select('users.*','company_roles.name as company_role','company_roles.id as company_role_id')
        ->get();  
        // dd($company_owner);          
        foreach($company_role_user as $data){
            $role_id = $data->role_id;
            $user_id = $data->user_id;
        } 
        $rolename = CompanyRole::where('id',$role_id)->get();
        $username = User::where('id', $user_id)->get('name');
        foreach ($rolename as $data ) {
           $company_type= $data->company_type_id;
        }
        $data = CompanyType::where('id',$company_type)->get();
        $company->load('city', 'state', 'team', 'users', 'companyAssignedTasks');

        return view('admin.companies.show', compact('company','data','company_type_name','rolename','username','company_owner'));
    }

    public function destroy(Company $company)
    {
        // abort_if(Gate::denies('company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $company->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyRequest $request)
    {
        Company::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('company_create') && Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Company();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function getRole(Request $request){
        $companyRoles = CompanyRole::where('company_type_id',$request->type_id)->pluck('name','id');
        return $companyRoles;
    }

    public function storeUser(Request $request){
        
        $checkEmail = User::where('email',$request->email)->count();
        $checkMobile = User::where('phone_no',$request->phone_no)->count();
        if($checkEmail > 0){
            return $res = [
                'status' => 0,
                'message' => 'email already exists'
            ];
        } else if($checkMobile > 0){
            return $res = [
                'status' => 0,
                'message' => 'phone no already exists'
            ];
        }
        $verification_token = Str::uuid()->toString();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'role_id' => $request->role_id,
            'verification_token' => $verification_token
        ]);
        $role_id = $request->role_id;
        $companyRoleUser = \DB::table('company_role_user')->insert([
            'role_id' => $role_id,
            'user_id' => $user->id
        ]);
        $companyRoleUser = \DB::table('role_user')->insert([
            'role_id' => 7,
            'user_id' => $user->id
        ]);

        foreach ($request->input('identity_proof', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identity_proof');
        }

        foreach ($request->input('address_proof', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('address_proof');
        }

        if ($request->input('passport_size_photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport_size_photo'))))->toMediaCollection('passport_size_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'token' => $verification_token
        ];
        // $user->notify(new UserSetPasswordNotification($data));
        return $user;

    }

    public function getUserAjax(Request $request){
        $term = $request->q['term'];

        if(auth()->user())
        {
            $users = User::where(function ($query) use($term) {
                $query->where('name', 'LIKE', "%$term%");
            })->get();

        }


        $users = $users->toArray();
        if(empty($users)){
            $users[] = [
                'id' => 0,
                'name' => 'Add New User',
                'email' => '',
                'phone_no' => ''
            ];
        }
        echo json_encode($users);
    }
    public function setPasswordPage($token){
        
        return view('admin.companies.usersetpassword',compact('token'));

    }
    public function userSetPassword(Request $request){
    
        $user = User::where('verification_token', $request->token)->first(); 

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('login')->with('message','User Successfully Set Password');
    }
    public function searchCompany(Request $request){
        $input = $request->input;
        $searchedCompany = Company::where('company_name', 'LIKE', "%$input%")->pluck('company_name','id');
        return $searchedCompany;
    }
    public function searchIsEmptyCompany(Request $request){
        $searchedCompany = DepartmentHead::with('company')->where('head_of_department_id',auth()->user()->id)->get();
        return $searchedCompany;
    }
    public function checkGstin(Request $request){
        $checkGstin = Company::where('gstin',$request->gstin)->count();
        if($request->gstin == ''){
            return $res = [
                'status' => 1,
                'message' => ''

            ]; 
        } 
         if($checkGstin > 0){
            return $res = [
                'status' => 0,
                'message' => 'Gstin already exists'
            ];
        }else{
            return $res = [
                'status' => 1,
                'message' => ''
            ];

        }
    }

    public function checkCompanyName(Request $request){

        $checkComp_name = Company::where('company_name',$request->comp_name)->count();
        if($request->comp_name == ''){
            return $res = [
                'status' => 1,
                'message' => ''

            ]; 
        }     
         if($checkComp_name > 0){
            return $res = [
                'status' => 0,
                'message' => 'Company already exists'
            ];
        } else{
            return $res = [
                'status' => 1,
                'message' => ''

            ];
        }
    }

    public function getCity(Request $request){
        $city = $request->city;
        $city = City::where('id',$city)->first();
        $state= State::where('id',$city->state_id)->first();
        return $state;
        

    }

    public function removeOwner(Request $request){
      $remove_owner = User::where('id',$request->cust_id)->first();
      $remove_owner->delete();
      $companyRoleUser = \DB::table('company_role_user')->where('user_id',$request->cust_id)->delete();
      $data = [
        'remove_owner'=>$remove_owner,
        'companyRoleUser'=>$companyRoleUser,

      ];
      return $data;
    }

    public function restore(Request $request){
        $company = Company::where('id', $request->comp_id)->withTrashed()->restore();
        return back();
    }
} 
