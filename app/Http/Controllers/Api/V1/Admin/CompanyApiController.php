<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\Admin\CompanyResource;
use App\Models\Company;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyResource(Company::with(['city', 'state', 'users', 'team'])->get());
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

        return (new CompanyResource($company))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyResource($company->load(['city', 'state', 'users', 'team']));
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

        return (new CompanyResource($company))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Company $company)
    {
        abort_if(Gate::denies('company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
