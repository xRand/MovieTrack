<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MovieTracker</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body style="background: dimgrey">
    @include('partials/navbar')
    {{--@include('errors.errors')--}}



    <div class="container" >
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    @yield('footer')

</body>
</html>
