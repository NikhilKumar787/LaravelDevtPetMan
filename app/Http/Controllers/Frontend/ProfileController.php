<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Models\Company;
use App\Models\State;
use App\Models\City;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $user->update($request->validated());

        return redirect()->route('frontend.profile.index')->with('message', __('global.update_profile_success'));
    }

    public function destroy()
    {
        $user = auth()->user();

        $user->update([
            'email' => time() . '_' . $user->email,
        ]);

        $user->delete();

        return redirect()->route('login')->with('message', __('global.delete_account_success'));
    }

    public function password(UpdatePasswordRequest $request)
    {
        auth()->user()->update($request->validated());

        return redirect()->route('frontend.profile.index')->with('message', __('global.change_password_success'));
    }

    public function edit(Request $request)
    {
        $user = User::where('id',auth()->user()->id)->first();
        return view('frontend.profile.edit',compact('user'));
    }

    public function step2()
    {
        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
        dd()
        if(auth()->user()->team != null){
            $company = Company::where('team_id',auth()->user()->team->id)->first();
            $view = view('frontend.profile.step2',compact('states','cities','company'));
        }else{
            $company_user = \DB::table('company_user')->where('user_id',auth()->user()->id)->first();
            if($company_user != null){
                $company = Company::where('id',$company_user->company_id)->first();
                $view = view('frontend.profile.step2',compact('states','cities','company'));
            }else{
                $view = view('frontend.profile.step2',compact('states','cities'));
            }
        }
        return $view;
    }

    public function storeStep1(Request $request)
    {
        User::where('id',auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
        ]);

        $user = User::where('id',auth()->user()->id)->first();
        if(isset($user->name) && !empty($user->name))
        {
            $user->update(['profile' => 'complete']);
        }
        if (count($user->identity_proof) > 0) {
            foreach ($user->identity_proof as $media) {
                if (!in_array($media->file_name, $request->input('identity_proof', []))) {
                    $media->delete();
                }
            }
        }
        $media = $user->identity_proof->pluck('file_name')->toArray();
        foreach ($request->input('identity_proof', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identity_proof');
            }
        }

        if (count($user->address_proof) > 0) {
            foreach ($user->address_proof as $media) {
                if (!in_array($media->file_name, $request->input('address_proof', []))) {
                    $media->delete();
                }
            }
        }
        $media = $user->address_proof->pluck('file_name')->toArray();
        foreach ($request->input('address_proof', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('address_proof');
            }
        }

        if ($request->input('passport_size_photo', false)) {
            if (!$user->passport_size_photo || $request->input('passport_size_photo') !== $user->passport_size_photo->file_name) {
                if ($user->passport_size_photo) {
                    $user->passport_size_photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('passport_size_photo'))))->toMediaCollection('passport_size_photo');
            }
        } elseif ($user->passport_size_photo) {
            $user->passport_size_photo->delete();
        }
        return $this->step2();
    }

    public function storeStep2(Request $request)
    {
        if(auth()->user()->team != null){
        $company = Company::where('team_id',auth()->user()->team->id)->first();
        if(isset($company) && !empty($company))
        {
            $company_update = Company::where('team_id',auth()->user()->team->id)->update([
                'username_for_pan_tan' => $request->username_for_pan_tan,
                'password_for_pan_tan' => $request->password_for_pan_tan,
                'username_for_gst_vat_icegate_dgft' => $request->username_for_gst_vat_icegate_dgft,
                'password_for_gst_vat_icegate_dgft' => $request->password_for_gst_vat_icegate_dgft,
                'username_for_e_way_e_invoicing' => $request->username_for_e_way_e_invoicing,
                'password_for_e_way_e_invoicing' => $request->password_for_e_way_e_invoicing,
                'username_for_traces' => $request->username_for_traces,
                'password_for_traces' => $request->password_for_traces,
                'username_for_pf_esi_and_other_labour_law' => $request->username_for_pf_esi_and_other_labour_law,
                'password_for_pf_esi_and_other_labour_law' => $request->password_for_pf_esi_and_other_labour_law,
                'username_for_reporting_portal' => $request->username_for_reporting_portal,
                'password_for_reporting_portal' => $request->password_for_reporting_portal,
                'company_name' => $request->company_name,
                'gstin' => $request->gstin,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'cin' => $request->cin,
            ]);

        }else{
            $company = Company::create($request->all());
            $company_user = \DB::table('company_user')->insert([
                'company_id' => $company->id,
                'user_id' => auth()->user()->id,
            ]);
        }
        }else{
            $company = Company::create($request->all());
            $company_user = \DB::table('company_user')->insert([
                'company_id' => $company->id,
                'user_id' => auth()->user()->id,
            ]); 
        }


        if(isset($company) && !empty($company->company_name))
        {
            $company->update(['profile' => 'complete']);
        }

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
    }
}
