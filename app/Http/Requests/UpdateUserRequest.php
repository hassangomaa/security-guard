<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
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
                'unique:users,email,' . $this->route('user')->id,
                'nullable',
            ],
            'password' => [
                'nullable',
            ],
            'lang' => [
                'required',
                'in:en,ar',
            ],
            'phone' => [
                'required',
                'unique:users,phone,' . $this->route('user')->id,
            ],
        ];
    }
}
