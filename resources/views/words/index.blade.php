@extends('layouts.app')

@section('page-title', 'Word List')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Words List</div>

                <div class="card-body">

                    <div class="results">
                        @include('partials.error-msg')
                    </div>
                        <div class="row ">
                            <div class="col-md-7"></div>
                            <div class="col-md-5">
                                <form action="{{ route('words.index') }}" method="get" enctype="multipart/form-data">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search a word" aria-label="Search a word" aria-describedby="button-addon2" id="search" name="search" value="{{ $search }}" autofocus="">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="10%"></th>
                                <th width="60%">Name</th>
                                <th width="10%" class="text-center">Length</th>
                                <th width="20%">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $row)
                            <tr>
                                <td>
                                    <a href="{{ route('words.edit', $row->id) }}" title="Edit"><i class="fa fa-edit fa-lg"></i></a>
                                    <a href="{{ route('words.delete', $row->id) }}" onclick="return confirm('Are you sure you want to delete this Problem?')" title="Delete"><i class="fa fa-times fa-lg"></i></a>
                                </td>
                                <td>{{ $row->name }}</td>
                                <td class="text-center">{{ $row->length }}</td>
                                <td>{{ $row->created_at->format('M. d, Y H:i A') }}</td>
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
