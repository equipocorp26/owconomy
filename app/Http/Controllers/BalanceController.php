<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceRequest;
use App\Http\Requests\BalanceResource;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BalanceController extends Controller
{
    public function index()
    {
        $items = Balance::where('user_id',Auth::id())->orderBy('updated_at','DESC')->with('lastMovement')->get();
        return view('balances.index',compact('items'));
    }
    public function show($balance)
    {
        /* Desencrypt the token */
        try {
            $balance = Balance::findOrFail(Crypt::decrypt($balance));
        } catch (\Throwable $th) {
            abort(404);
        }
        /* Check if owner */
        $this->authorize('owner',$balance);
        return view('balances.show',compact('balance'));
    }
}
