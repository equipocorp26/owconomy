<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ApiMovementRequest;
use App\Http\Resources\ApiMovementResource;
use App\Models\Balance;
use App\Models\Movement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ApiMovementController extends Controller
{
    public function index(Request $request,$balance_id)
    {
        /*
            month: true,
            date_start: null,
            date_end: null,
            reference: null,
            type: null,
        */
        /* Desencrypt the token */
        try {
            $balance = Balance::findOrFail(Crypt::decrypt($balance_id));
        } catch (\Throwable $th) {
            return response()->json([
                'message'   => 'error balance id',
                'errors'    => ['balance_id' => [$balance_id ? 'el balance id no es valido' : 'el balance id es requerido']]
            ],422);
        }
        /* Filters */
        $movements = Movement::where('balance_id',$balance->id);
        if ($request->month === "true")
        {
            $movements->whereMonth('date',date('m'));
        }
        elseif ($request->date_start && $request->date_end)
        {
            $movements->whereBetween('date',[$request->date_start,$request->date_end]);
        }
        elseif($request->date_start)
        {
            $movements->whereBetween('date',[$request->date_start,date('Y-m-d')]);
        }
        if ($request->reference) {
            $movements->where('reference','like','%'.$request->reference.'%');
        }
        if ($request->type) {
            $request->type == '+' ? $movements->where('amount','>',0) : $movements->where('amount','<',0) ;
        }
        /* Make the balances' resource */
        return ApiMovementResource::collection($movements->orderBy('updated_at','DESC')->paginate(20));
    }
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
