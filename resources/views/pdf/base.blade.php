<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    <div>
        @yield('content')
    </div>
    <?php Notification::render(); ?>
    @notifications
    {{-- {{ Notification::render() }} --}}
</body>
</html>
