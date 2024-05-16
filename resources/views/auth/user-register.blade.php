<!DOCTYPE html>
{{--<html>--}}
<html lang="{{ app()->getLocale() }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
<!-- <html lang="ar" dir="rtl"> -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>newRegister</title>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" type="text/css" href="/css/normalize.css">
    <!-- main css file -->

    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/css/NewNav.css">
    <link rel="stylesheet" type="text/css" href="/css/NewRegisterStyle.css">

    <!-- icon of web site above -->
    <link rel="icon" href="icons/web.png">
    <!-- description -->
    <meta name="description" content="description of your website. This will appear in search results.">
    <style>
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
@include('layouts/seo')
<body>
    @include('layouts.navigation')

<!-- 0 land  -->
<section class="log-bodyy" id="reg">
    <div class="container log-con">
        <div class="log-body">
            <div class="log-discrip">
                <div class="log-logo center-img ">
                    <img class="RE-img" src="/imgs/web.png">
                </div>
                <h2 class="color-b">{{ trans('main.welcome') }}</h2>
                <div class="log-words">
                    <p class="p-words f-bold">{{ trans('main.website_description') }}</p>
                </div>
                <div class="log-words">
                    <p class="f-bold">
                        {!! trans('main.register_description', [
                            'login_link' => __('main.login_link'),
                            'register_link' => __('main.register_link')
                        ]) !!}

                    </p>
                </div>
                <div class="soci center-img">
                    <a href=""><img src="/imgs/facebook.png" class="soci-img"></a>
                    <a href=""><img src="/imgs/Tweter.png" class="soci-img"></a>
                    <a href=""><img src="/imgs/instagram.png" class="soci-img"></a>
                    <a href=""><img src="/imgs/snap.png" class="soci-img"></a>
                    <a href=""><img src="/imgs/whatsapp.png" class="soci-img"></a>
                </div>
            </div>

            <form class="log-form" action="{{ route('user.register.submit') }}"
                  method="post" name="User_reg"
                  enctype="multipart/form-data">
                @csrf
                <h2 class="form-head">{{ trans('main.registration') }}</h2>

                <div class="kind">
                    <div> <a class="member-link active" href="{{ route('user.register') }}">{{ trans('main.individual') }}</a></div>
                    <p>&nbsp;&nbsp;</p>
                    <div><a class="company-link" href="{{ route('company.register') }}">{{ trans('main.company') }}</a></div>
                </div>

                <div class="cell">
                    <div class="cell-label">
                        <span class="cell-name">{{ trans('main.name') }}</span>
                        <div class="star">*</div>
                    </div>
                    <input type="text" name="Name" value="{{ old('Name') }}" class="cell-entery">
                </div>
                @error('Name')
                <span class="error">{{ $message }}</span>
                @enderror

                <div class="cell">
                    <div class="cell-label">
                        <span class="cell-name">{{ trans('main.email') }}</span>
                        <div class="star">*</div>
                    </div>
                    <input type="text" name="email" value="{{ old('email') }}"  class="cell-entery">
                </div>
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror

                <div class="cell">
                    <div class="cell-label">
                        <span class="cell-name">{{ trans('main.password') }}</span>
                        <div class="star">*</div>
                    </div>
                    <div class="password-container">
                        <input type="password" name="password" value="{{ old('password') }}"  class="cell-entery f-w" id="passwordInput">
                        <i class="password-icon"  onclick="togglePasswordVisibility()" id="Change-dir"></i>
                    </div>
                </div>
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror

                <div class="cell">
                    <div class="cell-label">
                        <span class="cell-name">{{ trans('main.confirm_password') }}</span>
                        <div class="star">*</div>
                    </div>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="cell-entery">
                </div>
                @error('password_confirmation')
                <span class="error">{{ $message }}</span>
                @enderror
                <div class="cell">
                    <div class="cell-label">
                        <span class="cell-name">{{ trans('main.phone') }}</span>
                        <div class="star">*</div>
                    </div>
                    <input type="text" name="phone" class="cell-entery">
                </div>
                @error('phone')
                <span class="error">{{ $message }}</span>
                @enderror
                <div class="dropdown">
                    <select class="dropdown-select" name="Nationality">
                        <option value="" disabled selected>{{ trans('main.nationality') }}</option>
                        @foreach($nationalities as $nat)
                            <option value="{{$nat->id}}" >
                                {{ app()->isLocale('ar') ? $nat->name_ar : $nat->name_en }}
                            </option>
                        @endforeach
                        {{-- Add options here dynamically --}}
                    </select>
                </div>
                @error('Nationality')
                <span class="error">{{ $message }}</span>
                @enderror

                <div class="custom-input-box" style="    width: 100%;">
                    <label style="font-size:19px;">{{ trans('main.birth_date') }}</label>
                    <input class="custom-date-input" type="date" name="Date"  >
                </div>
                @error('Date')
                <span class="error">{{ $message }}</span>
                @enderror
                <!-- 1 fist down list emara  -->

                <!-- 0 fist down list emara  -->
                <div class="dropdown">
                    <select  class="dropdown-select" name="emirate_city">
                        <option disabled selected>{{ trans('main.emirate_city') }}<div style="color: red; margin: 0 5px">*</div></option>
                        @foreach ($emirateCities as $emirateCity)
                            <option value="{{ $emirateCity->id }}">
                                {{ app()->isLocale('ar') ? $emirateCity->city_name_ar : $emirateCity->city_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('emirate_city')
                <span class="error">{{ $message }}</span>
                @enderror
                <!-- 1 fist down list emara  -->

                <div class="cell ">
                    <div class="cell-label">
                        <span class="cell-name">{{ trans('main.identity_card') }}</span>
                        <div class="star">*</div>
                    </div>
                    <input class="file-style" type="file" name="Identity_card">
                </div>
                @error('Identity_card')
                <span class="error">{{ $message }}</span>
                @enderror
                <div class=" cheky">
                    <input type="checkbox" name="Terms" class="chek">
                    <p class="acceptt">

                        <a class="term-link" href="{{route('terms')}}">
                            {{trans('main.accept_terms')}}
                        </a>
                    </p>
                </div>
                @error('Terms')
                <span class="error">{{ $message }}</span>
                @enderror

                <input  type="submit" value="{{ trans('main.sign_up') }}" class="log-in" name="submit">

                <div class="Reg-cell">
                    <p>{{ trans('main.have_account')}}</p>
                    <a
                    style="
                            color: red;
                            font-weight: bold;"
                             href="{{ route('user.login') }}" class="register-link">{{trans('main.have_accountII')}}</a>
                </div>

            </form>

        </div>

    </div>
</section>

@include('layouts.footer')
<script src="/js/NewNavScript.js"></script>

<!-- 1 land -->

<!-- 0 scripts  -->
<script>
    function showSecondDropdown() {
        var firstDropdown = document.getElementById("firstDropdown");
        var secondDropdown = document.getElementById("secondDropdown");

        var selectedOption = firstDropdown.options[firstDropdown.selectedIndex].value;

        secondDropdown.style.display = "none";

        if (selectedOption === "option3") {
            secondDropdown.style.display = "block";
        }
    }
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
