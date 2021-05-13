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
                    
                        <div class="container">
                            {{ $chart_test->container() }}
                        </div>
                   

                    {{-- @if(Auth::user()->user_type == 2)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                
                                <th width="20%">First Name</th>
                                <th width="20%">Last Name</th>
                                <th width="20%">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $row)
                            <tr>
                                <td>{{ $row->info->first_name }}</td>
                                <td>{{ $row->info->last_name }}</td>
                                <td>{{ $row->scoreRelation->score}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->user_type == 0)
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{{ $chart_test->script() }}
@endif
@endsection




