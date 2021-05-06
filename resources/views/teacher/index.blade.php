@extends('layouts.app')

@section('page-title', 'Teacher`s List')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Teachers List</div>

                <div class="card-body">

                        <div class="row ">
                            <div class="col-md-7"></div>
                            <div class="col-md-5">
                                <form action="{{ route('teacher.index') }}" method="get" enctype="multipart/form-data">
                                    <div class="input-group mb-3">
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
                            <tr>
                                <td>
                                    <a href="{{ route('teacher.edit', $row->id) }}" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                                    <a href="{{ route('teacher.show', $row->id) }}" title="Student List"><i class="fa fa-users fa-lg"></i></a>
                                     
                                </td>
                                <td>{{ $row->first_name }}</td>
                                <td>{{ $row->last_name }}</td>
                                <td>{{ $row->email }}</td>
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
