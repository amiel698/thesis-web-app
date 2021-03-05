@extends('layouts.app')
@section('content')

<div class="jumbotron text-center">
    <h3 align="center">Welcome Please Log-in</h3><br/>
        <div class="login-register-btn">
            <a class="btn btn-primary" href="{{ route('login')}}" role="button">Login</a>
            <a class="btn btn-primary" href="{{ route('register')}}" role="button">Register</a>
        </div>
</div>

@endsection


