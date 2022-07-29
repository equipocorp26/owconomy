@extends('layouts.app')

@section('content')
    <movements-index-component prop_balance_id="{{ Crypt::encrypt($balance->id) }}" prop_balance_background="{{ $balance->background_url }}"></movements-index-component>
@endsection
