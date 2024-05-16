<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
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
                'unique:users',
                'nullable',

            ],
            'password' => [
                'required',
            ],
            //lang
            'lang' => [
                'required',
                'in:en,ar',
            ],

//            'roles.*' => [
//                'integer',
//            ],
//            'roles' => [
//                'required',
//                'array',
//            ],
            'phone' => [
                'required',
                'unique:users',
            ],
        ];
    }
}
