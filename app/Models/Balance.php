<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'amount'
    ];
    /* RELACIONES */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
    /* MUTATORS */
    protected function amount(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value != null ? $value : 0 ,
        );
    }
    /* FUNCIONES */
    public function lastMovement()
    {
        return $this->hasOne(Movement::class)->latest();
    }
    public function monthlyMovements($month)
    {
        return $this->hasMany(Movement::class)->whereMonth('created_at',$month);
    }
    public function monthlyReservations($month)
    {
        return $this->hasMany(Reservation::class)->whereMonth('created_at',$month);
    }
}
