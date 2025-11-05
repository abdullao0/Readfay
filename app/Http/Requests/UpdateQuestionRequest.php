<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }


    public function rules(): array
    {
        return [
            'question'=>'sometimes|string',
            'option1'=>'sometimes|string',
            'option2'=>'sometimes|string',
            'option3'=>'sometimes|string',
            'CorrectOption'=>'sometimes|string'

        ];
    }
}
