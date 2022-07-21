<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\ApiBalanceResource;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

class ApiBalanceController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user_id = Crypt::decrypt($request->user_id);
        } catch (\Throwable $th) {
            return response()->json([
                'message'   => 'error user id',
                'errors'    => ['user_id' => [$request->user_id ? 'el user id no es valido' : 'el user id es requerido']]
            ]);
        }
        $balances = ApiBalanceResource::collection(Balance::where('user_id',$user_id)->orderBy('updated_at','DESC')->with('lastMovement')->paginate(9));
        return $balances;
    }
}
