<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can define authorization logic here if needed
    }

    public function rules()
    {
        return [
            'person_id' => 'required|string', // Assuming person_id is a string
            'fee_id' => 'required|string', // Assuming fee_id is a string
            'status' => 'required|in:paid,partially_paid,unpaid', // Validate status field
            // Add more validation rules as needed
        ];
    }
}
