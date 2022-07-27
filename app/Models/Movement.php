<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;
    protected $fillable = [
        'balance_id',
        'date',
        'title',
        'amount',
        'detail',
        'reference'
    ];
    /* RELACIONES */
    public function balance()
    {
        return $this->belongsTo(Balance::class);
    }
}
