<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- loader-->
    <link href="{{URL::asset('assets/ltr-css/pace.min.css')}}" rel="stylesheet"/>
    <script src="{{URL::asset('assets/js/pace.min.js')}}"></script>

    <!--plugins-->
    <link href="{{URL::asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet"/>

    <!-- CSS Files -->
    <link href="{{URL::asset('assets/ltr-css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/ltr-css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/ltr-css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/ltr-css/icons.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <title>Login</title>
</head>

<body>

<!--start wrapper-->
<div class="wrapper">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent p-3">
            <div class="container-fluid">
                <a href="javascript:;"><img src="" width="140"
                                            alt=""/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto mt-5">
                <div class="card radius-10">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h4>Sign In</h4>
                            <p>Sign In to your account</p>
                        </div>
                        <form action="{{route('dashboard.login')}}" method="post" class="form-body row g-3">
                            <x-dashboard.session_error></x-dashboard.session_error>
                            @csrf
                            @method('post')
                            <div class="col-12">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail">
                            </div>
                            <div class="col-12">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="inputPassword">
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="my-5">
        <div class="container">
            <div class="d-flex align-items-center gap-4 fs-5 justify-content-center social-login-footer">
                <a href="javascript:;">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a>
                <a href="javascript:;">
                    <ion-icon name="logo-linkedin"></ion-icon>
                </a>
                <a href="javascript:;">
                    <ion-icon name="logo-github"></ion-icon>
                </a>
                <a href="javascript:;">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a>
                <a href="javascript:;">
                    <ion-icon name="logo-pinterest"></ion-icon>
                </a>
            </div>
            <div class="text-center">
                <p class="my-4">Copyright © 2021 UI Admin by Codervent.</p>
            </div>
        </div>
    </footer>
</div>
<!--end wrapper-->
<script src={{URL::asset('assets/js/jquery.min.js')}}></script>
<script src="{{URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
