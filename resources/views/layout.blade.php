<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Test Online</title>
    <style>
        .form-group label {
            padding: 10px 0px;
        }
    </style>
</head>
<body>
<noscript>Please enable your Javascript</noscript>
<div class="container">
    <div class="row" style="margin-top: 30px;">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            @if(session()->has('message'))
                <div class="alert alert-{{session('type')}}">
                    {!! session('message') !!}
                </div>
            @endif

            @yield('content')
        </div>
        <div class="col-sm-3"></div>

    </div>
</div>
<footer style="padding: 50px 0px">
    <div class="text-center">
        &copy; Copyright 2022
    </div>
</footer>
<script src="{{ asset('asset/jquery/jquery-3.6.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('asset/bootstrap/5.1.3/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
@stack("bottom")
</body>
</html>
