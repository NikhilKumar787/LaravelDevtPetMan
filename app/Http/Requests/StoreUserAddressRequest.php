<?php

namespace App\Http\Requests;

use App\Models\UserAddress;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserAddressRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_address_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'phone_no' => [
                'string',
                'required',
            ],
            'addressline_1' => [
                'string',
                'required',
            ],
            'addressline_2' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'required',
            ],
            'zip_code' => [
                'string',
                'required',
            ],
            'state' => [
                'string',
                'required',
            ],
            'uuid' => [
                'string',
                'nullable',
            ],
        ];
    }
}
