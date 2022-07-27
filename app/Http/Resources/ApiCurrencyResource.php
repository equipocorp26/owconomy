<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class ApiCurrencyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => Crypt::encrypt($this->id),
            'name'  => $this->name,
            'symbol'=> $this->symbol
        ];
    }
}
