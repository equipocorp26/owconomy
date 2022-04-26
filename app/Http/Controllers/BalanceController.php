<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceRequest;
use App\Http\Requests\BalanceResource;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function index()
    {
        $items = Balance::where('user_id',Auth::id())->orderBy('updated_at','DESC')->with('lastMovement')->get();
        return view('balances.index',compact('items'));
    }

    public function create()
    {
        return view('balances.create');
    }

    public function store(BalanceRequest $request)
    {
        $balance = Auth::user()->balances()->create($request->only('amount','title'));
        return redirect()->route('balances.show',$balance)->with('message','Balance creado con exito');
    }

    public function show(Balance $balance)
    {
        $this->authorize('owner',$balance);
        /* load user balance */
        $balance->load('user');
        /* counters */
        $movements     = $balance->movements->count();
        $reservations  = $balance->reservations->count();
        /* balance month */
        $movements_month = $balance->monthlyMovements(date('m'))->get('amount');
        $balance_month = $movements_month->where('amount','<',0)->sum('amount') + $movements_month->where('amount','>',0)->sum('amount') ;
        /* recordings month */
        $movements_month    = $balance->monthlyMovements(date('m'))->orderBy('created_at','DESC')->limit(5)->get();
        $reservations_month = $balance->monthlyReservations(date('m'))->orderBy('created_at','DESC')->limit(5)->get();
        //return $balance;
        return view('balances.show',compact('balance','movements','reservations','balance_month','movements_month','reservations_month'));
    }

    public function edit(Balance $balance)
    {
        $this->authorize('owner',$balance);
        return view('balances.edit',compact('balance'));
    }

    public function update(BalanceRequest $request, Balance $balance)
    {
        $this->authorize('owner',$balance);
        $balance->update($request->only('title'));
        return redirect()->route('balances.show',$balance)->with('message','Balance actualizado con exito');
    }

    public function destroy(Balance $balance)
    {
        $this->authorize('owner',$balance);
        //
    }
}
