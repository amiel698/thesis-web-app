@extends('layouts.app')

@section('page-title', (((Auth::user()->user_type == 0))? $teacher->first_name . ' ' . $teacher->last_name : 'My') . ' Student`s')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if(Auth::user()->user_type == 0)
                        {{ $teacher->first_name . ' ' . $teacher->last_name . '`s' }} Students
                    @else
                        My Students
                    @endif
                </div>

                <div class="card-body">

                        <div class="results">
                            @include('partials.error-msg')
                        </div>

                        <div class="row ">

                            <div class="col-md-7">

                            </div>

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
                                <th width="10%"></th>
                                <th width="35%">First Name</th>
                                <th width="35%">Last Name</th>
                                <th width="20%">E-Mail</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($rows as $row)
                                <td>
                                    <a href="{{ route('student.show', $row->info) }}" title="Student Score"><i class="fa fa-list fa-lg"></i></a>
                                    @if(Auth::user()->user_type == 0)
                                    <a href="{{ route('teacher.remove.student', $row->info) }}" title="Remove Student"><i class="fa fa-times fa-lg"></i></a>
                                    @endif
                                </td>
                                <td>{{ $row->info->first_name }}</td>
                                <td>{{ $row->info->last_name }}</td>
                                <td>{{ $row->info->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $rows->appends(['search' => $search])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
