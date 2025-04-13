<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/boot.min.css')}}">
</head>
<body class="users-login">
    <div class="container page-wrapper" height="100">
        <div class="row mt-5">
            <div class="col-md-7 content-wrapper">
                <p class="content"><span>Sarvadhi</span> Invoice Management System</p>
            </div>
            <div class="col-md-5 text-center align-self-center">
                <p class="log-head">LOGIN</p>
                <form action="{{route('sendOtp')}}" method="post">
                    @csrf
                    <div class="row input-group">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <button type="submit" class="btn btn-dark my-4">Submit</button>
                </form>
                <small class="extra-info">Not Registered/New User ? <a href="{{route('register')}}">Sign Up</a></small>
            </div>
        </div>
    </div>
</body>
</html>