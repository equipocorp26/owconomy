@extends('layouts.app')

@section('content')
    <balances-index-component prop_user="{{ Crypt::encrypt(Auth::id()) }}"></balances-index-component>
@endsection
