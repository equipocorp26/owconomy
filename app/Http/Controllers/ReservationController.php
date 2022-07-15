<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Balance;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Balance $balance)
    {
        $this->authorize('owner',$balance);
        $items = $balance->reservations()->orderBy('updated_at','DESC')->paginate(20);
        return view('reservations.index',compact('items','balance'));
    }
    public function create(Balance $balance)
    {
        $this->authorize('owner',$balance);
        return view('reservations.create',compact('balance'));
    }
    public function store(ReservationRequest $request,Balance $balance)
    {
        $this->authorize('owner',$balance);
        $balance->reservations()->create($request->only('amount','title'));
        if ($request->amount <= -1 ) {
            $balance->update(['amount' => $balance->amount + $request->amount]);
        }
        return redirect()->route('reservations.index',$balance)->with('message','Reservacion guardada con exito');
    }
    public function show(Balance $balance,Reservation $reservation)
    {
        $this->authorize('owner',$balance);
        /* load user balance */
        $balance->load('user');
        return view('reservations.show',compact('balance','reservation'));
    }
    public function destroy(Balance $balance,Reservation $reservation)
    {
        $this->authorize('owner',$balance);
        $reservation->delete();
        if ($reservation->amount <= -1 ) {
            $balance->update(['amount' => $balance->amount - $reservation->amount]);
        }
        return redirect()->route('reservations.index',$balance)->with('message','Reservacion '.$reservation->title.' eliminada con exito');
    }
    public function check(Balance $balance,Reservation $reservation)
    {
        $this->authorize('owner',$balance);
        /* load user balance */
        $balance->movements()->create($reservation->only('amount','title','detail'));
        if ($reservation->amount >= 0 ) {
            $balance->update(['amount' => $balance->amount + $reservation->amount]);
        }
        $reservation->delete();
        return redirect()->route('reservations.index',$balance)->with('message','Reservacion procesada con exito');
    }
}
