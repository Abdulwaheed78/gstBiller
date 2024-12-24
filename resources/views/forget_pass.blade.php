<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
</head>

<body>
    <p>Hello,{{$data->name}}</p>
    <p>We received a request to reset your password. Please use the OTP below to reset your password:</p>
    <h3>Your OTP: <strong>{{ $otp }}</strong></h3>
    <p>If you did not request a password reset, please ignore this email.</p>
    <p>Once you enter the OTP, you'll be able to reset your password.</p>
    <p>Thank you,</p>
    <h4 style="color:rgb(7, 140, 248)">GSTBiller</h4>
</body>

</html>
