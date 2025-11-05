<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassageRequest extends FormRequest
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
            'title'=>'sometimes|string|max:80',
            'content'=>'sometimes|string',
            'difficultyLevel'=>'sometimes|in:Beginner,Intermediate,Proficient,Advanced,Master',
            'numberOfWords'=>'sometimes|integer',  
        ];

    }
}
