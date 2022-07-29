<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovementFilterRequest;
use App\Http\Requests\MovementRequest;
use App\Models\Balance;
use App\Models\Movement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MovementController extends Controller
{
    public function index(MovementFilterRequest $request,$balance)
    {
        /* Desencrypt the token */
        try {
            $balance = Balance::findOrFail(Crypt::decrypt($balance));
        } catch (\Throwable $th) {
            abort(404);
        }
        /* Check if owner */
        $this->authorize('owner',$balance);
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
        $this->authorize('owner',$balance);
        return view('movements.create',compact('balance'));
    }

    public function store(MovementRequest $request,Balance $balance)
    {
        $this->authorize('owner',$balance);
        $balance->movements()->create($request->only('amount','title','detail'));
        $balance->update(['amount' => $balance->amount + $request->amount]);
        return redirect()->route('movements.index',$balance)->with('message','Movimiento guardado con exito');
    }

    public function show(Balance $balance,Movement $movement)
    {
        $this->authorize('owner',$balance);
        /* load user balance */
        $balance->load('user');
        return view('movements.show',compact('balance','movement'));
    }

    public function edit(Balance $balance)
    {
        $this->authorize('owner',$balance);
        return view('balances.edit',compact('balance'));
    }

    public function update(BalanceRequest $request, Balance $balance)
    {
        $this->authorize('owner',$balance);
        $balance->update($request->only('title','detail'));
        $balance->update(['amount' => $balance->amount + $request->amount]);
        return redirect()->route('balances.show',$balance)->with('message','Balance actualizado con exito');
    }

    public function destroy(Balance $balance,Movement $movement)
    {
        $this->authorize('owner',$balance);
        $movement->delete();
        $balance->update(['amount' => $balance->amount - $movement->amount]);
        return redirect()->route('movements.index',$balance)->with('message','Balance '.$movement->title.' eliminado con exito');
    }
}
