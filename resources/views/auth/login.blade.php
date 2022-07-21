@extends('layouts.app')

@section('content')
<div class="container-fluid bg-responsive-cover" style="background-image: url('backgrounds/auth.jpg')">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4 offset-md-3 offset-lg-8 d-flex bg-semi-transparent" style="height: 100vh">
            <div class="my-auto">
                <login-component></login-component>
            </div>
        </div>
    </div>
</div>
@endsection
