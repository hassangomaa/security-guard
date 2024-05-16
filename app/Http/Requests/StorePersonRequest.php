<?php

namespace App\Http\Requests;

use App\Models\Person;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePersonRequest extends FormRequest
{
    public function authorize()
    {
        // return Gate::allows('person_create');
        //true
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
            ],
            'phone' => [
                'required',
                'unique:persons',
            ],
            'phone2' => [
                'nullable',
                'unique:persons',
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
            'family_branch_id' => [
                'nullable',
                'integer',
                'exists:family_branches,id',
            ],
        ];
    }
}
