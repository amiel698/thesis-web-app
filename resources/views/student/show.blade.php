@extends('layouts.app')

@section('page-title', $student->first_name . ' ' . $student->last_name . ' Records')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $student->first_name }} {{ $student->last_name }} Records</div>

                <div class="card-body">

                    <!-- <div class="row ">
                        <div class="col-md-7"></div>
                        <div class="col-md-5">
                            <form action="{{ route('student.index') }}" method="get" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search a Name" aria-label="Search a Name" aria-describedby="button-addon2" id="search" name="search" value="{{ $search }}" autofocus="">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                    </div> -->

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                {{--  <th width="20%">Grading</th>  --}}
                                <th width="20%">Difficulty</th>
                                <th width="20%">Score</th>
                                <th width="20%">Total</th>
                                <th width="20%">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                {{--  <td>{{ $record->grading }}</td>  --}}
                                <td>{{ strtoupper($record->difficulty) }}</td>
                                <td>{{ $record->score }}</td>
                                <td>{{ $record->total }}</td>
                                <td>{{ $record->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $records->appends([])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
