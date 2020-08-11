<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Discover</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Spicy+Rice"rel="stylesheet">
{{--        <script src="https://kit.fontawesome.com/3a35c19d1d.js" crossorigin="anonymous"></script>--}}
        <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{asset('./mdb/css/mdb.min.css')}}">

        <script src="{{asset('js/app.js')}}" defer></script>

    </head>
    <body>
        <div id="app">
            <index></index>
        </div>
    </body>

    {{--<script type="text/javascript" src=" {{asset('./mdb/js/jquery.min.js')}} "></script>--}}
    <!-- Bootstrap tooltips -->
    {{--<script type="text/javascript" src="{{asset('./mdb/js/popper.min.js')}}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src=" {{asset('./mdb/js/bootstrap.min.js')}}"></script>--}}
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src=" {{asset('./mdb/js/mdb.min.js')}}" defer></script>
    <script type="text/javascript" src=" {{asset('./mdb/js/addons/datatables.min.js')}}" defer></script>
</html>


