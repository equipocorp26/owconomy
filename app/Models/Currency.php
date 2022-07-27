<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    /* Fields */
    protected $fillable = [
        'name',
        'symbol'
    ];
    /* Relations */
    public function balances(){
        return $this->hasMany(Balance::class);
    }
}
