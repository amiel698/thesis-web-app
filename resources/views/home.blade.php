@extends('layouts.app')

@section('page-title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::user()->user_type == 0)
                        <div class="container">
                            {{ $chart_test->container() }}
                        </div>
                    @endif

                    @if(Auth::user()->user_type == 1)
                    <div class="row ">
                        <div class="col-md-7"></div>
                        <div class="col-md-5">
                            <form action="{{ route('student.index') }}" method="get" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    @if(Auth::user()->user_type == 0)
                                    <a class="btn btn-outline-primary" href="{{ route('teacher.create_student') }}"><i class="fa fa-plus"></i></a>
                                    @endif
                                    <input type="text" class="form-control" placeholder="Search a Name" aria-label="Search a Name" aria-describedby="button-addon2" id="search" name="search" value="{{ $search }}" autofocus="">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                {{--  <th width="20%">Grading</th>  --}}
                                <th width="20%">First Name</th>
                                <th width="20%">Last Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $row)
                            <tr>
                            
                                <td>{{ $row->info->first_name }}</td>
                                <td>{{ $row->info->last_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $rows->appends(['search' => $search])->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{{ $chart_test->script() }}
@endsection




