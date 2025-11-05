<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question'=>'required|string',
            'option1'=>'sometimes|string',
            'option2'=>'sometimes|string',
            'option3'=>'sometimes|string',
            'CorrectOption'=>'required|string'

        ];



    }
}
