<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/boot.min.css')}}">
</head>
<body class="shopers-register">
    <div class="container reg-content">
        <div class="row">
            <div class="col-md-12 text-center align-self-center">
                <p class="reg-head">Create Account</p>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{route('register.store')}}" method="post">
                    @csrf
                    <div class="row text-start">
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <label for="first_name">First Name:</label>
                            <div class="input-group">
                                <input type="text" name="first_name" class="form-control @error('first_name')
                                    is-invalid
                                @enderror" placeholder="Enter First Name" value="{{old('first_name')}}">
                            </div>
                            @error('first_name')
                                <p class="text-start text-danger p-0 m-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <label for="last_name">Last Name:</label>
                            <div class="input-group">
                                <input type="text" name="last_name" class="form-control @error('last_name')
                                    is-invalid
                                @enderror" placeholder="Enter Last Name" value="{{old('last_name')}}">
                            </div>
                            @error('last_name')
                                <p class="text-start text-danger p-0 m-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <label for="email">Email:</label>
                            <div class="input-group">
                                <input type="text" name="email" class="form-control @error('email')
                                    is-invalid
                                @enderror" placeholder="Enter Email" value="{{old('email')}}">
                            </div>
                            @error('email')
                                <p class="text-start text-danger p-0 m-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <label for="contact">Contact:</label>
                            <div class="input-group">
                                <input type="text" name="contact" class="form-control @error('contact')
                                    is-invalid
                                @enderror" placeholder="Enter Contact no." value="{{old('contact')}}">
                            </div>
                            @error('contact')
                                <p class="text-start text-danger p-0 m-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <label for="co_name">Company Name:</label>
                            <div class="input-group">
                                <input type="text" name="co_name" class="form-control @error('co_name')
                                    is-invalid
                                @enderror" placeholder="Enter Company Name" value="{{old('co_name')}}">
                            </div>
                            @error('co_name')
                                <p class="text-start text-danger p-0 m-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <label for="gst_no">GST No.:</label>
                            <div class="input-group">
                                <input type="text" name="gst_no" class="form-control @error('gst_no')
                                    is-invalid
                                @enderror" placeholder="Enter GST number" value="{{old('gst_no')}}">
                            </div>
                            @error('gst_no')
                                <p class="text-start text-danger p-0 m-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <label for="address_1">Address line 1:</label>
                            <div class="input-group">
                                <input type="text" name="address_1" class="form-control @error('address_1')
                                    is-invalid
                                @enderror" placeholder="Enter Address Line 1" value="{{old('address_1')}}">
                            </div>
                            @error('address_1')
                                <p class="text-start text-danger p-0 m-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <label for="address_2">Address line 2:</label>
                            <div class="input-group">
                                <input type="text" name="address_2" class="form-control @error('address_2')
                                    is-invalid
                                @enderror" placeholder="Enter Address Line 2" value="{{old('address_2')}}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <label for="city">City:</label>
                            <div class="input-group">
                                <input type="text" name="city" id="city" class="form-control @error('city')
                                    is-invalid
                                @enderror" placeholder="Enter City" value="{{old('city')}}">
                            </div>
                            @error('city')
                                <p class="text-start text-danger p-0 m-0">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 mt-3">
                            <label for="state">State:</label>
                            <div class="input-group">
                                <input type="text" name="state" id="state" class="form-control @error('state')
                                    is-invalid
                                @enderror" placeholder="Enter State" value="{{old('state')}}">
                            </div>
                            @error('state')
                                <p class="text-start text-danger p-0 m-0">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark my-4">Submit</button>
                </form>
                <small class="extra-info-reg">Already have an account ? <a href="{{route('login')}}">Sign In</a></small>
            </div>
        </div>
    </div>
</body>
</html>