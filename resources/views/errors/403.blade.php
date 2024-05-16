<!DOCTYPE html>
<!-- <html lang="ar" dir="rtl"> -->

<html >
{{--@dd(app()->getLocale(), auth()->guard('company')->check() ? auth()->guard('company')->user()->language : 'Not logged in')<head>--}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/css/page404.css">
<style>
    body {
        font-family:serif;
    }
</style>
</head>
@include('layouts/seo')
<body>
<!-- Error Page -->
<div class="error">
    <div class="container-floud container">
        <div class="col-xs-12 ground-color text-center">
            <div class="container-error-404">
                <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                <div class="msg"> {{ trans('global.OH') }}<span class="triangle"></span></div>
            </div>
            <h2 class="h1" style="font-size: 36px;">
                {{ trans('global.not_autohrized') }}
            </h2>
            <!-- Add the Home button -->
            <a href="{{ route('home') }}" class="btn btn-primary">{{ trans('global.go_to_home') }}</a>
        </div>
    </div>
</div>
<!-- Error Page -->
</body>
<script type="text/javascript">
    function randomNum()
    {
        "use strict";
        return Math.floor(Math.random() * 9)+1;
    }
    var loop1,loop2,loop3,time=30, i=0, number, selector3 = document.querySelector('.thirdDigit'), selector2 = document.querySelector('.secondDigit'),
        selector1 = document.querySelector('.firstDigit');
    loop3 = setInterval(function()
    {
        "use strict";
        if(i > 40)
        {
            clearInterval(loop3);
            selector3.textContent = 4;
        }else
        {
            selector3.textContent = randomNum();
            i++;
        }
    }, time);
    loop2 = setInterval(function()
    {
        "use strict";
        if(i > 80)
        {
            clearInterval(loop2);
            selector2.textContent = 0;
        }else
        {
            selector2.textContent = randomNum();
            i++;
        }
    }, time);
    loop1 = setInterval(function()
    {
        "use strict";
        if(i > 100)
        {
            clearInterval(loop1);
            selector1.textContent = 3;
        }else
        {
            selector1.textContent = randomNum();
            i++;
        }
    }, time);
</script>
</html>
