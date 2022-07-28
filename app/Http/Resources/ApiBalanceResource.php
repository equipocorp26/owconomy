<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class ApiBalanceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"                 => Crypt::encrypt($this->id),
            "title"              => $this->title,
            "amount"             => $this->amount,
            "currency"           => $this->currency->symbol,
            "background"         => $this->background_url,
            "last_movement"      => $this->lastMovement ? $this->lastMovement->amount : null,
            "last_movement_date" => $this->lastMovement ? $this->lastMovement->created_at->format('d-m-Y') : null,
        ];
    }
}
