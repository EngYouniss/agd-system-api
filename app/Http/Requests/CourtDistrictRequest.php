<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourtDistrictRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'district_ids'   => 'required|array|min:1',
            'district_ids.*' => 'integer|exists:districts,id',
        ];
    }
}
