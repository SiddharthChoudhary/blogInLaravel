<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', 'Happy Blogging')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css')}}">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <script src="/js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{asset('plugins/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>


    <!-- Scripts -->
    <script>
        window.Laravel = '{!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}';
    </script>
</head>
<body>
    <div id="app">
        @yield('content')
        @yield('extra-scripts')
        <!-- Scripts -->
    </div>
</body>
</html>
