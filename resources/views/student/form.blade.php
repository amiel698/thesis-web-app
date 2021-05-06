@extends('layouts.app')

@section('page-title', 'Form Student')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Student</div>

                <div class="card-body">
                    <form action="{{ $route }}" method="post" enctype="multipart/form-data">
                        @csrf()

                        <div class="results">
                            @include('partials.error-msg')
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-3 col-form-label text-md-right">First Name</label>
                            <div class="col-md-9">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $first_name }}" autofocus="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-3 col-form-label text-md-right">Last Name</label>
                            <div class="col-md-9">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $last_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">E-Mail</label>
                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">Password</label>
                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control" name="password" value="{{ $password }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirm_password" class="col-md-3 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-9">
                                <input id="confirm_password" type="password" class="form-control" name="confirm_password" value="{{ $confirm_password }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-5 offset-md-3">
                                @if($button_text != 'Save')
                                    @method('PUT')
                                @endif
                                <button type="submit" class="btn btn-primary">{{ $button_text }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
