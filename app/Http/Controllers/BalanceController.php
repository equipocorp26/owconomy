<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Movement;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index()
    {
        $items = Balance::where('user_id',1)->orderBy('updated_at','DESC')->with('lastMovement')->get();
        return view('balances.index',compact('items'));
    }

    public function create()
    {
        return view('balances.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Balance $balance)
    {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
