<?php

namespace App\Http\Requests;

use App\Models\Person;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePersonRequest extends FormRequest
{
    public function authorize()
    {
        // return Gate::allows('person_edit');
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'email',
                'nullable',
                'unique:persons,email,' . $this->route('person')->id,
            ],
            'phone' => [
                'required',
                'unique:persons,phone,' . $this->route('person')->id,
            ],
            'phone2' => [
                'nullable',
                'unique:persons,phone2,' . $this->route('person')->id,
            ],
            'birth_date' => [
                'required',
                'date',
            ],
            'address' => [
                'nullable',
                'string',
            ],
            'death_date' => [
                'nullable',
                'date',
            ],
            'relationship_status' => [
                'nullable',
                'string',
                'in:single,married,divorced,widowed',
            ],
            'paying_bank' => [
                'nullable',
                'string',
            ],
            'parent_id' => [
                'nullable',
                'integer',
                'exists:persons,id',
            ],
        ];
    }
}
