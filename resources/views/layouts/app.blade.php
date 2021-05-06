<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') | ASL</title>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-hand-stop-o"></i>ASL</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}"><i class="fa fa-home fa-lg"></i> Home</a>
                        </li>
                        @if(Auth::user()->user_type == 1)
                        <li class="nav-item">
                            <a class="nav-link" artia-current="page" href="{{route('chart', Auth::user()->id)}}"><i class="fa fa-line-chart" aria-hidden="true"></i> Progress</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" artia-current="page" href="{{route('student.show.score', Auth::user()->id)}}"><i class="fa fa-id-card" aria-hidden="true"></i> Scores</a>
                        </li>

                        @endif
                        @if(Auth::user()->user_type == 0)
                        <li class="nav-item dropdown">
                            <a id="dropdownTeacher" class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-users fa-lg"></i> Teachers</a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownTeacher">
                                <a class="dropdown-item" href="{{ route('teacher.index') }}"><i class="fa fa-list"></i> List</a>
                                <a class="dropdown-item" href="{{ route('teacher.create') }}"><i class="fa fa-plus"></i> Add</a>

                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownStudent" class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-users fa-lg"></i> Students</a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownStudent">
                                <a class="dropdown-item" href="{{ route('student.index') }}"><i class="fa fa-list"></i> List</a>
                                <a class="dropdown-item" href="{{ route('student.create') }}"><i class="fa fa-plus"></i> Add</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" aria-current="page" href="{{ route('teacher.create_student') }}"><i class="fa fa-users fa-lg"></i> Assign Student</a>
                        </li>
                        @endif
                        @if(in_array(Auth::user()->user_type, [2]))
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('teacher.show', Auth::user()->id) }}"><i class="fa fa-users fa-lg"></i> My Students</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="dropdownWords" class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-file fa-lg"></i> Words</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownWords">
                                <a class="dropdown-item" href="{{ route('words.index') }}"><i class="fa fa-list"></i> List</a>
                                <a class="dropdown-item" href="{{ route('words.create') }}"><i class="fa fa-plus"></i> Add</a>
                            </div>
                        </li>


                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-cogs fa-lg"></i>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                @if(Auth::user()->user_type == 0)
                                    <a class="dropdown-item" href="{{ route('teacher.create_student') }}"><i class="fa fa-random"></i> Assignment</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>{{ __('Logout') }}</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('scripts')

</body>
</html>
