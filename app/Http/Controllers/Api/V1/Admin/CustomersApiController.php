<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\Admin\CustomerResource;
use App\Models\Customer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CustomerResource(Customer::with(['city', 'state', 'country', 'term', 'team'])->get());
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        if ($request->input('attachment', false)) {
            $customer->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        return (new CustomerResource($customer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CustomerResource($customer->load(['city', 'state', 'country', 'term', 'team']));
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

        return (new CustomerResource($customer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
