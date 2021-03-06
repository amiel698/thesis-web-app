@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('create') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name">
                                <span class="text-danger"> @error('first_name') {{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name">
                                <span class="text-danger"> @error('last_name') {{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>
                            <div class="col-md-6">
                                <input type="user_name" class="form-control" name="user_name" value="{{ old('user_name') }}" placeholder="Enter User Name">
                                <span class="text-danger"> @error('user_name') {{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                <span class="text-danger"> @error('password') {{$message}} @enderror</span>
                            </div>
                        </div>


                        <div class="form-group row">
                          <label class="col-md-4 col-form-label text-md-right" for="user_type">{{ __('Select User Type') }}</label>
                          <div class="col-md-6">
                            <select class="custom-select" id="inputGroupSelect01">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
