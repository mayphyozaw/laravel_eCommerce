<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('assets/dist/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 sm-4">
                <div class="card ">
                    <div class="card-header bg-primary text-white">
                        Admin Login
                    </div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    <div class="card-body">
                        <form action="{{ route('postlogin') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Enter Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Enter Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Login">
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
    {{-- tostify --}}
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
                className: 'bg-warning',
                position: 'center'
            }).showToast();
        </script>
    @endif
</body>

</html>
