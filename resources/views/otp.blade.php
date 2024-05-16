<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">

<head>
    <title>{{ trans('main.verify_email_title') }}</title>
</head>
<body>
<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
    <h2 style="text-align: center;">{{ trans('main.verify_email_heading') }}</h2>
    <p>{{ trans('main.verify_email_hello', ['userName' => $userName]) }}</p>
    <p>
        {{ trans('main.verify_email_thank_you') }}
    </p>
    <p>{{ trans('main.verify_email_complete_registration') }}</p>
    <p style="text-align: center; font-size: 20px;">{{ trans('main.verify_email_otp_token', ['token' => $token]) }}</p>
    <p style="text-align: center; margin-bottom: 30px;">{{ trans('main.verify_email_click_link') }}</p>
    <div style="text-align: center;">

        <a href="{{ route('verify.email', ['token' => $token, 'email' => $email]) }}"

           style="background-color: #007BFF; color: #FFFFFF; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold;">
            {{ trans('main.verify_email_verify_btn') }}
        </a>
    </div>
    <p style="margin-top: 30px;">{{ trans('main.verify_email_note_1') }}</p>
    <p>{{ trans('main.verify_email_note_2') }}</p>
    <p>{{ trans('main.verify_email_privacy') }}</p>
    <p>{{ trans('main.verify_email_support') }}</p>
    <p style="text-align: center; font-weight: bold;">{{ trans('main.verify_email_we_look_forward') }}</p>
    <p style="text-align: center;">{{ trans('main.verify_email_best_regards') }}</p>
</div>
</body>
</html>
