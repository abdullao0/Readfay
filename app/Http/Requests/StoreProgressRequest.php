<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'passage_id' => 'required|exists:passages,id',
            'WPM' => 'nullable',
            'Duration' => 'required|numeric|min:1',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Convert Duration to integer if it's a string
        if ($this->has('Duration')) {
            $this->merge([
                'Duration' => (int) $this->input('Duration'),
            ]);
        }
    }
}
