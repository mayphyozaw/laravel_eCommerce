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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    @yield('css')
</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper boxed-wrapper">
        @include('admin.layout.nav')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header sty-one">
                <h1>Ecommerce Dashboard</h1>
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><i class="fa fa-angle-right"></i> Ecommerce Dashboard</li>
                </ol>
            </div>
            @yield('content')
        </div>


    </div>

    <script src="{{ asset('assets/dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dist/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminkit.js') }}"></script>
    <script src="{{ asset('assets/dist/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/dist/plugins/functions/jquery.peity.init.js') }}"></script>
    <script src="{{ asset('assets/dist/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/dist/plugins/chartjs/chart-int.js') }}"></script>

    @yield('script')
</body>


</html>
