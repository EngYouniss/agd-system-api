<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
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
    public function rules()
    {
        return [
            'contract_number' => 'required|unique:contracts',
            'husband_conditions' => 'nullable|string',
            'wife_conditions' => 'nullable|string',
            'mahr_total' => 'required|numeric',
            'mahr_paid' => 'required|numeric',
            'mahr_remaining' => 'required|numeric',
            'contract_status_id' => 'required|exists:contract_statuses,id',
            'contract_type_id' => 'required|exists:contract_types,id',
        ];
    }
}
