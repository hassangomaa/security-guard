<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ trans('main.forgot_password_title') }}</title>
  <link rel="stylesheet" href="/css/ForgetPass.css"/>
   <link rel="stylesheet" href="/css/NewNav.css">
  <link rel="stylesheet" href="/css/normalize.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    .no-scroll {
        max-height: 100vh;
    }
    .alert alert-info
    {
        color: red;
        font-weight: bold;
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 10px;
        margin-bottom: 20px;
    }

    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 10px;
        margin-bottom: 20px;
        text-align: center;
    }

</style>
</head>
<body>
     @include('layouts.navigation')
     <section class="Veryfy">

    <div class="main-content">
    <h2>{{ trans('main.verify_email') }}</h2>
    <p>{{ trans('main.enter_email') }}</p>
    <input type="email" class="email" placeholder="{{ trans('main.email_placeholder') }}" required>
    <button class="submit-btn buttons" onclick="sendCode()">{{ trans('main.submit') }}</button>

    <div class="code-box">
      <p>{{ trans('main.enter_received_code') }}</p>
      <button class="resend-btn" onclick="resendCode()">{{ trans('main.resend_code') }}</button>
      <input type="text" class="code" >
      <button class="verify-btn buttons" onclick="verifyCode()">{{ trans('main.verify_code') }}</button>
    </div>

    <div class="new-password-box">
        <p>{{ trans('main.enter_new_password') }}</p>
        <input type="password" class="new-password" required>
        <p>{{ trans('main.confirm_new_password') }}</p>
        <input type="password" class="confirm-password" required>
        <button class="save-btn buttons" onclick="savePassword()">{{ trans('main.save_password') }}</button>
        <a href="" class="login-link" style="display: none;">
            <button class="submit-btn buttons">{{ trans('main.login') }}</button>
        </a>
        <p class="status-message"></p>
    </div>

    <a href="" class="login-link">
        <button  class="submit-btn buttons">{{ trans('main.login') }}</button>
    </a>
    <p class="status-message"></p>

    @if (session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif

    @if (session('message'))
    <div class="success-message">
        {{ session('message') }}
    </div>
    @endif

    @if (session('error'))
    <div class="error-message">{{ session('error') }}</div>
    @endif
  </div>
     </section>
<script type="text/javascript" src="/js/ForgetPass.js"></script>
<script src="/js/NewNavScript.js"></script>
</body>
</html>
