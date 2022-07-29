<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Balance\ApiBalanceRequest;
use App\Http\Resources\ApiBalanceResource;
use App\Http\Resources\ApiMovementResource;
use App\Models\Balance;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

class ApiBalanceController extends Controller
{
    public function index(Request $request)
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
        /* Make the balances' resource */
        return ApiBalanceResource::collection(Balance::where('user_id',$user->id)->orderBy('updated_at','DESC')->with('lastMovement')->paginate(9));
    }
    public function store(ApiBalanceRequest $request)
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
        /* Search Currency*/
        try {
            $currency = Currency::where('symbol',$request->balance['currency_id'])->firstOrFail();
        } catch (\Throwable $th) {
            return response()->json([
                'message'   => 'error currency id',
                'errors'    => ['currency_id' => [$request->balance['currency_id'] ? 'el currency id no es valido' : 'el currency id es requerido']]
            ],422);
        }
        /* Create balance */
        $balance = $user->balances()->create([
            'currency_id'   => $currency->id,
            'title'         => $request->balance['title'],
            'background_url'=> $request->balance['background'],
        ]);
        /* Return */
        return new ApiBalanceResource($balance);
    }
    public function show(Request $request,$balance)
    {
        /* Desencrypt the token */
        try {
            $balance = Balance::findOrFail(Crypt::decrypt($balance));
        } catch (\Throwable $th) {
            return response()->json([
                'message'   => 'error balance id',
                'errors'    => ['balance_id' => [$balance ? 'el balance id no es valido' : 'el balance id es requerido']]
            ],422);
        }
        /* Month data */
        /* balance */
        $movements_month = $balance->monthlyMovements(date('m'))->get('amount');
        $balance_month = $movements_month->where('amount','<',0)->sum('amount') + $movements_month->where('amount','>',0)->sum('amount') ;
        /* recordings */
        $movements_month    = $balance->monthlyMovements(date('m'))->orderBy('date','DESC')->limit(5)->get();
        $reservations_month = $balance->monthlyReservations(date('m'))->orderBy('created_at','DESC')->limit(5)->get();
        /* Make the balances' resource */
        return response()->json([
            'data' => [
                'balance'       => new ApiBalanceResource($balance),
                'month_data'    => [
                    'balance'   => $balance_month,
                    'movements' => ApiMovementResource::collection($movements_month),
                ]
            ]
        ]);
    }
    public function update(ApiBalanceRequest $request, $balance_id)
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
        /* Desencrypt the balance */
        try {
            $balance = Balance::findOrFail(Crypt::decrypt($balance_id));
        } catch (\Throwable $th) {
            return response()->json([
                'message'   => 'error balance id',
                'errors'    => ['balance_id' => [$balance_id ? 'el balance id no es valido' : 'el balance id es requerido']]
            ],422);
        }
        /* Search Currency*/
        try {
            $currency = Currency::where('symbol',$request->balance['currency_id'])->firstOrFail();
        } catch (\Throwable $th) {
            return response()->json([
                'message'   => 'error currency id',
                'errors'    => ['currency_id' => [$request->balance['currency_id'] ? 'el currency id no es valido' : 'el currency id es requerido']]
            ],422);
        }
        /* Update balance */
        $balance->update([
            'currency_id'   => $currency->id,
            'title'         => $request->balance['title'],
            'background_url'=> $request->balance['background'],
        ]);
        /* Return */
        return new ApiBalanceResource($balance);
    }
}
