@extends('layouts.master')

@section('page-title', 'Login')

@section('content')
<br><br>
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Login</div>

	                <div class="card-body">
	                    <form method="POST" action="{{ route('authentication') }}">
	                        @csrf

	                        <div class="results">
	                            @if(Session::get('auth_msg'))
	                                <div class="alert alert-danger text-md-center">
	                                    {{ Session::get('auth_msg') }}
	                                </div>
	                            @endif
	                        </div>

	                        <div class="form-group row">
	                            <label for="email" class="col-md-4 col-form-label text-md-right">User Name</label>
	                            <div class="col-md-6">
	                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
	                            <div class="col-md-6">
	                                <input id="password" type="password" class="form-control" name="password">
	                            </div>
	                        </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-md-8 offset-md-4">
	                                <button type="submit" class="btn btn-primary">Login</button>
	                            </div>
	                        </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a href="{{route('register')}}">Create an account</a>
                                </div>
                            </div>

	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection
