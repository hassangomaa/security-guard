<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
{{-- <html lang="ar" dir="rtl">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trans('main.login') }}</title>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" type="text/css" href="/css/normalize_new.css">
    <!-- main css file -->
    <link rel="stylesheet" type="text/css" href="/css/LogInStyle.css">
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/css/NewNav.css">
    <!-- icon of web site above -->
    <link rel="icon" href="icons/web.png">
    <!-- description -->
    <meta name="description" content="description of your website. This will appear in search results.">
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
@include('layouts/seo')
<body class="no-scroll">

{{--@include('layouts.navigation')--}}

<!-- 0 land  -->
<section class="log-bodyy pt-30">
    <div class="container log-con">


        <div class="log-head">
            <img src="/imgs/web.png" class="RE-img">
        </div>

        <div class="log-body">
            <div class="log-discrip">
                <div class="log-words">
                    <p class="p-words">
{{--                        {{ trans('main.tatweer_en') }}--}}
                        {{ trans('main.welcome_to_tatweer') }}
                        .
                    </p>
                </div>
                <div class="log-logo">
                    <img src="/imgs/single-logo.png" class="login-photo">
                </div>
                <div class="soci">
                    <a href=""><img src="/imgs/facebook.png" class="soci-img"></a>
                    <a href=""><img src="/imgs/Tweter.png" class="soci-img"></a>
                    <a href=""><img src="/imgs/instagram.png" class="soci-img"></a>
                    <a href=""><img src="/imgs/snap.png" class="soci-img"></a>
                    <a href=""><img src="/imgs/whatsapp.png" class="soci-img"></a>
                </div>
            </div>

            <form class="log-form"

                    action="{{ route('user.login.submit') }}"
                      method="POST" name="Form"
                      enctype="multipart/form-data">

                    @csrf
                <h2 class="form-head">
                    {{ trans('main.log_in') }}

                </h2>

                <div class="cell">
                    <div class="cell-label">
                        <span class="cell-name">
                            {{ trans('main.email') }}
                        </span>
                        <div class="star">*</div>
                    </div>
                    <input type="email" name="email" value="" class="cell-entery">

                    <i></i>
                </div>
                @error('email')
                <span class="error-message">{{ $message }}</span>
                @enderror

                <div class="cell">
                    <div class="cell-label">
                        <span class="cell-name">
                                                {{ trans('main.password') }}
                        </span>
                        <div class="star">*</div>
                    </div>

                    <div class="password-container">
                        <input type="password" name="password"    value="" class="cell-entery f-w" id="passwordInput">
                        <i class="password-icon"  onclick="togglePasswordVisibility()" id="Change-dir"></i>
                    </div>

                </div>
                @error('password')
                <span class="error-message">{{ $message }}</span>
                @enderror


                <div class="cell-actions">


                    <div class="forgit">
                        <a href="{{ route('show.forgot-password') }}"
                        class="fo">
                            {{ trans('main.forgot_password') }}
                        </a>

                    </div>


                    <!-- 0 Rememmber me -->

                                            <div class="Rememmber-me">
                                                <input type="checkbox" name="remember" class="chek-tir">
                                                <p class="Re">
                                               {{ trans('main.remember_me') }}
                                                </p>
                                            </div>

                    <!-- 1 Rememmber me  -->
                </div>


                <input type="submit" value="{{ trans('main.log_in') }}" class="log-in">

                    @if (session('success'))
                        <div class="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="error-message">{{ session('error') }}</div>
                    @endif


                <div class="Reg-cell">
                    <p>{{ trans('main.dont_have_account') }}</p>
                    <a
                    style="
                            color: red;
                            font-weight: bold;"
                    class="register-link" href="{{ route('user.register') }}"
                       class="register-link">{{ trans('main.sign_up_now') }}
                    </a>

                </div>

            </form>

        </div>

    </div>
</section>
<!-- 1 land -->
{{--@include('layouts.footer')--}}
<script src="/js/NewNavScript.js"></script>

<!-- 0 scripts  -->
<script >
    const toggleButton = document.getElementById("toggle-button");
    const naviList = document.getElementById("navi-list");
    toggleButton.addEventListener("click", () => {
        naviList.classList.toggle("active");
    });

</script>
<!-- 1 scripts  -->
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('passwordInput');
        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        // Toggle the class for changing the icon on click
        passwordInput.classList.toggle('hide-password');
    }
</script>
<script>
    // Check if the page language is set to 'ar' and direction is 'rtl'
    if (document.documentElement.lang === 'ar' && document.documentElement.dir === 'rtl') {
        // Get the element by its ID
        var targetElement = document.getElementById('Change-dir');

        // Remove the oldClass
        targetElement.classList.remove('password-icon');

        // Add the newClass
        targetElement.classList.add('password-icon-ar');
    }
</script>
</body>
</html>
