<?php

namespace App\Policies;

use App\Models\Balance;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BalancePolicy
{
    use HandlesAuthorization;

    public function owner(User $user, Balance $balance)
    {
        return $user->id == $balance->user_id;
    }
}
