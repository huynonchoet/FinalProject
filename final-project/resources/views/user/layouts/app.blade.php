<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet">

    <title>Your Homestay</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/owl.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
</head>

<body>
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/user/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Additional Scripts -->
    <script src="{{ asset('assets/user/js/custom.js') }}"></script>
    <script src="{{ asset('assets/user/js/owl.js') }}"></script>
    <script src="{{ asset('assets/user/js/slick.js') }}"></script>
    <script src="{{ asset('assets/user/js/isotope.js') }}"></script>
    <script src="{{ asset('assets/user/js/accordions.js') }}"></script>

    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>

    @include('user.layouts.header')

    @yield('content')

    @include('user.layouts.footer')


</body>

</html>
