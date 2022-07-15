<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'  => 'required|between:3,255',
            'amount' => 'nullable|numeric',
            'detail' => 'nullable|max:255',
        ];
    }
}
