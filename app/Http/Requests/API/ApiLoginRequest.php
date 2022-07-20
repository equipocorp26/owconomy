<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ApiLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => 'required|string|email',
            'password' => 'required|string',
            'remember' => 'nullable',
        ];
    }
}
