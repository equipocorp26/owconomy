<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ApiMovementRequest;
use App\Http\Resources\ApiMovementResource;
use App\Models\Balance;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class ApiMovementController extends Controller
{
    public function store(ApiMovementRequest $request)
    {
        /* Desencrypt the token */
        try {
            $user = User::findOrFail(Crypt::decrypt($request->user_id));
        } catch (\Throwable $th) {
            return response()->json([
                'message'   => 'error user id',
                'errors'    => ['user_id' => [$request->user_id ? 'el user id no es valido' : 'el user id es requerido']]
            ],422);
        }
        /* Desencrypt the token */
        try {
            $balance = Balance::findOrFail(Crypt::decrypt($request->movement['balance_id']));
        } catch (\Throwable $th) {
            return response()->json([
                'message'   => 'error balance id',
                'errors'    => ['balance_id' => [$request->movement['balance_id'] ? 'el balance id no es valido' : 'el balance id es requerido']]
            ],422);
        }
        /* Create movement */
        $movement = $balance->movements()->create([
            'title'         => $request->movement['title'],
            'reference'     => $request->movement['reference'],
            'amount'        => $request->movement['type'].$request->movement['amount'],
            'date'          => $request->movement['date'],
            'detail'        => $request->movement['detail'],
        ]);
        /* Update amount balance */
        if($movement)
        {
            $balance->update(['amount' => $balance->amount + $movement->amount]);
        }
        /* Return */
        return new ApiMovementResource($movement);
    }
}
