<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ApiMovementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validations = [
            'user_id'               => 'required',
            'movement.balance_id'   => 'required',
            'movement.title'        => 'required|between:3,250',
            'movement.reference'    => 'nullable|max:250',
            'movement.amount'       => 'required|numeric|not_in:0',
            'movement.date'         => 'required|date',
            'movement.detail'       => 'nullable|max:250',
            'movement.type'         => 'required|in:+,-',
        ];
        return $validations;
    }
}
