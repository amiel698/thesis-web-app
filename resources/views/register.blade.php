@extends('layouts.master')

@section('page-title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store') }}">
                        @csrf

                        <div class="results">
                            @include('partials.error-msg')
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-3 col-form-label text-md-right">First Name</label>
                            <div class="col-md-9">
                                <input id="first_name" type="text" class="form-control" name="first_name" autofocus="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-3 col-form-label text-md-right">Last Name</label>
                            <div class="col-md-9">
                                <input id="last_name" type="text" class="form-control" name="last_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">E-Mail</label>
                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control" name="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">Password</label>
                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-3 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-9">
                                <input id="confirm_password" type="password" class="form-control" name="confirm_password">
                            </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 col-form-label text-md-right" for="user_type">{{ __('Select User Type') }}</label>
                          <div class="col-md-9">
                            <select name="user_type" class="custom-select" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            <option value="1">Student</option>
                            <option value="2">Teacher</option>
                            </select>
                            <span class="text-danger"> @error('user_type') {{$message}} @enderror</span>
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Register
                                </button>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a href="{{route('login')}}">Already have an account?</a>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
