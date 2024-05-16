<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>
    <p>
        You are receiving this email because we received a password reset request for your account.
        Please click the link below to reset your password:
    </p>
    <a href="{{ route('password.reset', $token) }}">Reset Password</a>
    <p>
        If you did not request a password reset, no further action is required.
        Please ignore this email.
    </p>
</body>
</html>
