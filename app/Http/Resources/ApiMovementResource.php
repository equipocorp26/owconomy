<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class ApiMovementResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => Crypt::encrypt($this->id),
            'amount'    => $this->amount,
            'date'      => $this->date,
            'title'     => $this->title,
            'detail'    => $this->detail,
            'reference' => $this->reference
        ];
    }
}
