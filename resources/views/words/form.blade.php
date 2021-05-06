@extends('layouts.app')

@section('page-title', 'Form Word')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Word</div>

                <div class="card-body">
                    <form action="{{ $route }}" method="post" enctype="multipart/form-data">
                        @csrf()

                        <div class="results">
                            @include('partials.error-msg')
                        </div>

                        <div class="form-group row">
                            <div class="col-md-5 offset-md-2">
                                <img src="{{ ($image_location != '')?  asset($image_location) : 'https://www.rpnation.com/gallery/250-x-250-placeholder.30091/full'}}" class="img-thumbnail" alt="250x250" width="250px" height="250px" style="width: 250px; height: 250px;">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">Difficulty</label>
                            <div class="col-md-3">
                                <select class="form-select" aria-label="form-select" id="difficulty" name="difficulty">
                                    <option value="normal">Normal</option>
                                    <option value="hard">Hard</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Problem</label>
                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $name }}" autofocus="">
                            </div>
                        </div>

                        <div class="form-group row" id="answer_div"  style="display: none;" >
                            <label for="answer" class="col-md-2 col-form-label text-md-right">Answer</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="answer" id="answer" value="{{ $answer }}">
                            </div>
                        </div>

                        <div class="form-group row" row id="image_div">
                            <label for="image" class="col-md-2 col-form-label text-md-right">Image</label>
                            <div class="col-md-3">
                                <select class="form-select" aria-label="form-select" id="file_selection" name="file_selection">
                                    <option value="file">File</option>
                                    <option value="url">Url</option>
                                </select>
                            </div>
                            <div class="col-md-7">
                                <input type="file" class="form-control" name="image" id="image">
                                <input type="text" class="form-control" name="image_url" id="image_url" style="display: none;" disabled="" value="{{ $image_url }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-5 offset-md-2">
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

@section('scripts')
<script type="text/javascript">
    $(function(){
        $('#difficulty').val('{{ $difficulty }}');
        $('#file_selection').val('{{ $file_selection }}');

        difficulty_action('{{ $difficulty }}');
        select_action('<?php echo $file_selection; ?>');

        $('#difficulty').change(function(){
            var value = $(this).val();
            difficulty_action(value);
        });

        $('#file_selection').change(function(){
            var value = $(this).val();
            select_action(value);
        });
    });

    function difficulty_action(value)
    {
        if (value == 'hard') {
            $('#image_div').hide();
            $('#answer_div').show();
            $('#file_selection').hide().attr('disabled', true);
        } else {
            $('#answer_div').hide();
            $('#image_div').show();
            $('#file_selection').show().attr('disabled', false);
        }
    }

    function select_action(value)
    {
        if (value == 'file') {
            $('#image_url').hide().attr('disabled', true);
            $('#image').show().attr('disabled', false);
        } else {
            $('#image').hide().attr('disabled', true);
            $('#image_url').show().attr('disabled', false);
        }
    }
</script>
@endsection
