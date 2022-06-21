<!doctype html>
<html lang="en">
<head>
<title>Login 04</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="{{ asset('public/login/css/style.css') }}">
<style>
    body {
        overflow: hidden; /* Hide scrollbars */
    }
    .btn.btn-primary {
        background: #84D4A6!important;
        border: 1px solid #84D4A6!important;
        color: #fff !important;
    }
    .hlink{
        color: #84D4A6 !important;
    }
</style>
</head>
<body>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Human Resource Information System</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" style="background-image: url({{ asset('/public/login/images/bg-1.jpg') }});"></div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Login to your account</h3>
                            </div>
                        </div>
                        <form action="{{ route('pasok') }}" method="POST" class="signin-form">
                            {{ csrf_field() }}
                            <div class="form-group mb-3">
                                <label class="label" for="name">Email</label>
                                <input type="text" class="form-control" placeholder="Email" name="email" value="admin@holychild.edu.ph">
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" value="admin12345">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                            </div>
                        </form>
                        <p class="text-center hlink"><a data-toggle="tab" href="#signup" class="hlink">Forgot Password</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('public/login/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/login/js/popper.js') }}"></script>
<script src="{{ asset('public/login/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/login/js/main.js') }}"></script>

</body>
</html>

