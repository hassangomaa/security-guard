<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class FeeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'issue_date' => 'nullable|date',
            'fee_type_id' => 'required|exists:fee_types,id',
            'person_id' => 'required|exists:persons,id',
            'fee_type_other' => 'nullable|string',
        ];
    }
}
