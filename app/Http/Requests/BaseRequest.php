<?php

namespace App\Http\Requests;

use App\Helper\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function stopOnFirstFailure()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {

        if ($this->is('api/*')) {
            $response = ApiResponse::reponseFn(422, "validation error", $validator->errors());
            throw new ValidationException($validator, $response);
        }
    }
}
