<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Otp</title>
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/boot.min.css')}}">
</head>
<body class="otpBody">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-7 mt-5 mrk-info">
                <div class="wrapper">
                    <img src="{{ asset('assets/images/advikmrk.png') }}" alt="mrk.png" class="w-75 float-start">
                </div>
            </div>
            <div class="col-md-5 mt-5 text-center">
                <div class="wrapper">
                    @php
                        if(session()->has('email')){
                            $email = session('email');
                        }else{
                            $email = old('email');
                        }
                    @endphp
                    <p class="otp-head">Verify OTP</p>
                    <p class="otp-note-head">Note: <span class="otp-note text-mute">OTP has been sent on email {{$email}} successfully!!</span></p>
                    <p class="success-msg alert p-2 mb-3"></p>
                    <form id="otpVerifyForm">
                        <input type="hidden" name="email" value="{{$email}}">
                        <input type="text" name="otp" id="otp" class="form-control" placeholder="Enter OTP" value="{{old('otp')}}">
                        <p class="error text-left" id="otp-error"></p>
                        <a role="button" class="resend pe-none text-decoration-none" id="resend"></a>&nbsp;&nbsp;
                        <span id="timer"></span><br>
                        <button type="submit" class="btn btn-dark mt-4">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jQuery.countdownTimer.min.js') }}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/additional-methods.min.js')}}"></script>
    <script type="text/javascript">
        var minutes = 2;
        var seconds = 0;
        var timer;
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#resend').html('You can resend otp after 2 minutes');
            clearInterval(timer);
            timer = setInterval(function(){
                if(seconds > 0){
                    seconds--;
                }else if(minutes > 0){
                    seconds = 59;
                    minutes--;
                }else{
                    $("#resend").removeClass("pe-none");
                    $("#resend").html('Resend OTP');
                }
                $("#timer").html(minutes+":"+seconds);
            },1000)

            $('#resend').click(function(){
                resendOTP();
            });

            function resendOTP(){
                
                var email = $("#email").val();
                $("button").prop("disabled","true");
                $.ajax({
                    url: "{{route('resendOtp')}}",
                    method: "post",
                    data: {email:email,action:"chkemail"},
                    success: function(response){
                        if(response.hasOwnProperty('success')){
                            $("button").prop("disabled","false");
                            clearInterval(timer); 
                            minutes = 2;
                            seconds = 0;
                            $("#resend").addClass("pe-none");
                            $('#resend').html('You can resend otp after 2 minutes');
                            timer = setInterval(function(){
                                if(seconds > 0){
                                    seconds--;
                                }else if(minutes > 0){
                                    seconds = 59;
                                    minutes--;
                                }else{
                                    $("#resend").removeClass("pe-none");
                                    $("#resend").html('Resend OTP');
                                    $("button").prop("disabled","false");
                                }
                                $("#timer").html(minutes+":"+seconds);
                            },1000)
                        }else{
                            $(".success-msg").html(response.errors);
                            $(".success-msg").addClass('alert-danger');
                        }
                        console.log('sent');
                    }
                })
            }
        });

        $('#otpVerifyForm').validate({
            rules: {
                otp: {
                    required: true,
                    number: true,
                    minlength: 6,
                    maxlength: 6
                }
            },
            messages: {
                otp: {
                    required: "please enter otp first",
                    number: "digits only allowed",
                    minlength: "otp will be of 6 digits long",
                    maxlength: "otp will be of 6 digits long"
                }
            },
            submitHandler: function(form){
                
                $.ajax({
                    url: "{{ route('verify.otp') }}",
                    data: $(form).serialize(),
                    method: "POST",
                    dataType: "json",
                    success: function(data){
                        if(data.hasOwnProperty('errors')){
                            $(".success-msg").html(data.errors);
                            $(".success-msg").addClass('alert-danger');
                        }else if(data.hasOwnProperty('success')){
                            $(".success-msg").html(data.success);
                            $(".success-msg").addClass('alert-success');
                            window.location.href = "{{url('/')}}";
                        }
                    }
                })
            }
        })
    </script>
</body>
</html>