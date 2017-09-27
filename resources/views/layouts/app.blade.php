<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <link type="text/css" rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>

<body style="background-color: #FFF8DC;">
    <div id="app" style="padding: 70px;">
        @yield('main')
    </div>

    <!-- Scripts -->
    <script type='text/javascript' src="{{ asset('jquery/jquery-3.2.1.min.js') }}" charset="UTF-8"></script>

    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}" charset="UTF-8"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.cc-add-to-cart').click(function() {
                var url = $(this).attr('href');
                $.get(url, function(count, status, xhr) {
                    $('.cc-cart-item-count').html(count);
                });
                return false;
            });
        });
    </script>

    @if (session('notification'))
        <script type="text/javascript">
            $(document).ready(function(){
                $('#notification').modal('show');
            });
        </script>
    @endif
</body>
</html>
