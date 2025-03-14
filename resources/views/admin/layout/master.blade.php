<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Commerce Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- v4.0.0 -->
    <link rel="stylesheet" href="{{ asset('assets/dist/bootstrap/css/bootstrap.min.css') }}">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/dist/img/favicon-16x16.png') }}">

    <link href="../../../../../fonts.googleapis.com/css6079.css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/et-line-font/et-line-font.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/simple-lineicon/simple-line-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/dist/plugins/chartist-js/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/plugins/chartist-js/chartist-plugin-tooltip.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @yield('css')
</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper boxed-wrapper">

        @include('admin.layout.nav')

        <div class="content-wrapper">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/dist/js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/dist/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminkit.js') }}"></script>
    <script src="{{ asset('assets/dist/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/dist/plugins/functions/jquery.peity.init.js') }}"></script>
    <script src="{{ asset('assets/dist/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/dist/plugins/chartjs/chart-int.js') }}"></script>

    @yield('script')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        .toastify {
            background-image: unset;
        }
    </style>

    @if (session()->has('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                className: 'bg-danger',
                position: 'center'
            }).showToast();
        </script>
    @endif

    @if (session()->has('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                className: 'bg-success',
                position: 'center'
            }).showToast();
        </script>
    @endif
</body>


</html>
