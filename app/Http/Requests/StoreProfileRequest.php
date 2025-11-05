<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'DOB'=>'required',
            'bio'=>'string|nullable',
            'image'=>'sometimes|mimes:png,jpg,jpeg|max:2048'

        ];

    }
}
