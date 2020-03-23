<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Covid Map</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    {{--        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>--}}
    {{--        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" >--}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" >


</head>
<body style="background-color: #ffffff">
<nav class="navbar navbar-expand-lg navbar-light bavbatBgColor shadowBottom navbarStyles">
    <span class="logo">Covid Map</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav colorGray mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Map <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a href="/hot-line" class="nav-link active-link">Contact</a>
            </li>
            {{--  <li class="nav-item">
                  <a class="nav-link" href="#">More official informacion</a>
              </li> --}}
        </ul>
        <ul class=" navbar-nav">
            <li class="nav-item">
            </li>
        </ul>
    </div>
</nav>
გვერდი მზადების პროცესშია
</body>
</html>
