<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovementFilterRequest;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovementController extends Controller
{
    public function index(MovementFilterRequest $request,Balance $balance)
    {
        $items = $balance->movements();
        /* FILTRO DE FECHAS */
        if ($request->this_month) {
            $items = $items->whereMonth('created_at',date('m'));
        }
        elseif($request->date_start && $request->date_end)
        {
            $items = $items->whereBetween('created_at',[$request->date_start,$request->date_end]);
        }
        /* FILTRO DE TIPO */
        if ($request->type === "0" || $request->type === "1") {
            $items = $items->where('amount', ($request->type > 0 ? '>' : '<') ,0);
        }
        $items = $items->orderBy('updated_at','DESC')->paginate(20);
        return view('movements.index',compact('items','balance'));
    }

    public function create(Balance $balance)
    {
        return view('movements.create',compact('balance'));
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
        $balance->delete();
        return redirect()->route('balances.index')->with('message','Balance '.$balance->title.' eliminado con exito');
    }
}
