<!DOCTYPE html>
<html>

<head>
    <title>Laravel 9 CRUD Application - ItSolutionStuff.com</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</head>

<body>

    <div class="container">
        <!-- MultiStep Form -->
        <div class="row">
            <div class="col-md-12 col-md-offset-3">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- /.MultiStep Form -->
</body>

</html>