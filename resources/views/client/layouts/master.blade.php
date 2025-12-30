<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>Sixteen Clothing HTML Template</title>

    <link href="{{ asset('client/vonder/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('client/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/templatemo-sixteen.css') }}">
    <link rel="stylesheet" href="{{ asset('client/assets/css/owl.css') }}">

</head>

<body>


    @include('client.partials.header')


    @yield('content')


    @include('client.partials.footer')


    <script src="{{ asset('client/vonder/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('client/vonder/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <script src="{{ asset('client/assets/js/custom.js') }}"></script>
    <script src="{{ asset('client/assets/js/owl.js') }}"></script>
    <script src="{{ asset('client/assets/js/slick.js') }}"></script>
    <script src="{{ asset('client/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('client/assets/js/accordions.js') }}"></script>


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


</body>

</html>