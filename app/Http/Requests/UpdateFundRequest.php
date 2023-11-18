<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFundRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'aliases' => 'nullable|array',
            'start_year' => [
                'required',
                'numeric',
                'max:' . date('Y'),
                'min:'. 1800
            ],
            'fund_manager_id' => [
                'required',
                'exists:fund_managers,id',
            ],
            'companies.*.id' => [
                'exists:companies,id',
            ],
        ];
    }
}
