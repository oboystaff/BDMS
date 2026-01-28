<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Book Distribution Management System">
    <meta property="og:title" content="Book Distribution Management System">
    <meta property="og:description" content="Book Distribution Management System">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Book Distribution Management System</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="vh-100" style="background-image:url('{{ asset('assets/images/bg.png') }}'); background-position:center;">
    <div class="authincation h-100">
        <div class="col-12">

            <!-- Navbar -->
            <nav
                class="navbar navbar-expand-lg  border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-4 start-0 end-0 mx-4">
                <div class="container ps-2 pe-0">
                    <a class="navbar-brand m-0 d-flex align-items-center text-wrap" href="#">
                        {{-- <h2>Zoil </h2> --}}
                    </a>
                    <h4 class="text-orange fw-lighter"> Book Distribution Management System </h4>
                </div>
            </nav>
            <!-- End Navbar -->

            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-6">
                        <div class="authincation-content">
                            <div class="row no-gutters">
                                <div class="col-xl-12">
                                    <div class="auth-form">
                                        <div class="text-center mb-2">
                                            <img src="{{ asset('assets/images/appointed_banner.jpeg') }}" class="h-100"
                                                alt="Appointed" style="width:230px;height:250px">
                                            {{-- <h2 class="text-blue">Welcome !</h2> --}}
                                        </div>
                                        <h2 class="text-center fs-16 fw-lighter text-blue mb-4">Please sign in with
                                            your credentials</h2>
                                        <form method="POST" action="{{ route('auth.login') }}">
                                            @csrf

                                            <div class="mb-2">
                                                <label class="mb-1 fs-16  fw-lighter">Phone Number</label>
                                                <input type="text" name="username"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    placeholder="Phone Number">

                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="mb-1 fs-16 fw-lighter">Password</label>
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="text-center   mt-4">
                                                <button type="submit" class="btn btn-primary fw-light btn-block">Sign
                                                    In</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
 Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>
</body>

</html>
