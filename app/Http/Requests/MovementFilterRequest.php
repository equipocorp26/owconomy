<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovementFilterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date_start'    => 'nullable|required_with:date_end|date|before_or_equal:date_end',
            'date_end'      => 'nullable|required_with:date_start|date',
            'this_month'    => 'nullable|in:true'
        ];
    }
}
