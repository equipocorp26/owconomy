<?php

namespace App\Http\Requests\Api\Balance;

use Illuminate\Foundation\Http\FormRequest;

class ApiBalanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $validations = [
            'user_id'               => 'required',
            'balance.title'         => 'required|between:3,255',
            'balance.currency_id'   => 'required|exists:currencies,symbol',
            'balance.background'    => 'required|url',
        ];
        return $validations;
    }
}
