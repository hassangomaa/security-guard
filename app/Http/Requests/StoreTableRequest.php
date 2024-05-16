<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ResponsesTrait;
use Illuminate\Contracts\Validation\Validator;
class StoreTableRequest extends FormRequest
{
    use ResponsesTrait;

       public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->failed(null,$validator->errors()->first()));
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
