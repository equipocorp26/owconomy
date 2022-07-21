<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class ApiBalanceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"            => Crypt::encrypt($this->id),
            "title"         => $this->title,
            "amount"        => $this->amount,
            "last_movement" => $this->lastMovement ? $this->lastMovement->amount : null
        ];
    }
}
