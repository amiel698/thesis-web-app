@extends('layouts.app')

@section('page-title', 'Assign Student')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Assign Student</div>

                <div class="card-body">
                    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                        @csrf()

                        <div class="results">
                            @include('partials.error-msg')
                        </div>

                        <div class="form-group row">
                            <label for="teacher_user_id" class="col-md-2 col-form-label text-md-right">Teacher</label>
                            <div class="col-md-10">
                                <select class="form-control" aria-label="Default select example" id="teacher_user_id" name="teacher_user_id">
                                    <option value="">-- Select --</option>
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->last_name .', '. $teacher->first_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{--  <div class="form-group row">
                            <label for="student_user_id" class="col-md-2 col-form-label text-md-right">Student</label>
                            <div class="col-md-10">
                                <select class="form-control" aria-label="Default select example" id="student_user_id" name="student_user_id">
                                    <option value="">-- Select --</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->last_name .', '. $student->first_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  --}}

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="20%"><input type="checkbox" id="checkAll"> Select All</th>
                                    <th width="35%">First Name</th>
                                    <th width="35%">Last Name</th>
                                    <th width="20%">E-Mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" name="student_user_id[]" value="{{ $student->id }}">
                                        </div>
                                    </td>
                                    <td>{{ $student->first_name }}</td>
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group row">
                            <div class="col-md-5 offset-md-2">
                                @if($button_text != 'Save')
                                    @method('PUT')
                                @endif
                                <button type="submit" class="btn btn-primary">{{ $button_text }}</button>
                                <a href="{{ url('/home') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#teacher_user_id').val('{{ $teacher_user_id }}');
        $('#student_user_id').val('{{ $student_user_id }}');
    });

    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@endsection
