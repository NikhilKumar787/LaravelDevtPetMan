<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\City;
use App\Models\Company;
use App\Models\State;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::with(['city', 'state', 'users', 'team', 'media'])->get();

        return view('frontend.companies.index', compact('companies'));
    }

    public function create()
    {
        abort_if(Gate::denies('company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id');

        return view('frontend.companies.create', compact('cities', 'states', 'users'));
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->all());
        $company->users()->sync($request->input('users', []));
        if ($request->input('copy_of_pan_tan', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('copy_of_pan_tan'))))->toMediaCollection('copy_of_pan_tan');
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

        if ($request->input('stamp_and_sign', false)) {
            $company->addMedia(storage_path('tmp/uploads/' . basename($request->input('stamp_and_sign'))))->toMediaCollection('stamp_and_sign');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $company->id]);
        }

        return redirect()->route('frontend.companies.index');
    }

    public function edit(Company $company)
    {
        abort_if(Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id');

        $company->load('city', 'state', 'users', 'team');

        return view('frontend.companies.edit', compact('cities', 'company', 'states', 'users'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->all());
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

        return redirect()->route('frontend.companies.index');
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->load('city', 'state', 'users', 'team', 'companyAssignedTasks');

        return view('frontend.companies.show', compact('company'));
    }

    public function destroy(Company $company)
    {
        abort_if(Gate::denies('company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
}
