<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
<head>
    <title>Email Verification</title>
</head>
@include('layouts/seo')
<body>
<div>
    <h2>Email Verification</h2>

    @if (session('status') == 'verification-link-sent')
        <div>
            A new verification link has been sent to your email address.
        </div>
    @endif

    @if (Auth::guard('company')->check())
        <form method="POST" action="{{ route('company.verification.send') }}">
            @csrf
            <button type="submit">Resend Verification Email</button>
        </form>
    @else
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">Resend Verification Email</button>
        </form>
    @endif
</div>
</body>
</html>
