<style>
    .lango {
        padding: 5px;
        background-color: black;
        color: white;
        border-radius: 5px;
        margin: 0px 5px
    }
    .speciall {
        border: 2px solid #065BAE;
        padding:5px 7px;
        margin-left:10px;
        border-radius:5px;
    }
    .speciall:hover {
        background-color:#065BAE;
    }
    .speciall-act {
        background-color:#065BAE;
    }
    @media (max-width: 1000px) {
        .speciall {
            font-size:14px;
        }
    }
    @media (max-width: 992px) {
        .speciall {
            font-size:14px;
        }
    }
    .alert {
        position: relative;
    }

    .alert::after {
    content: attr(data-count); /* Use data attribute to hold the notifications count */
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: red;
    color: white;
    position: absolute;
    top: 0;
    right: 0;
    padding-left: 1px;
    padding-top: 1px;
    text-align: center;
    font-size: 16px;

        /* Prefixes for compatibility with various browsers */
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -webkit-background-clip: padding-box;

    }

</style>
{{-- 
@php
    use App\Models\RegistrationType;
       // Get the current route name
$currentRoute = \Request::route()->getName();
  $defaultLocale = env('APP_LOCALE','en');
@endphp
<!-- 0 new nav -->
<section class="newnav" id="home">


    <div class="newnavbar">



        {{--    #########################CASE-1###########################################################--}}

                @if(
                $currentRoute === 'home'
                ||
                  $currentRoute === 'bills.pay'
                  ||$currentRoute === 'homev2'
                ||
                $currentRoute === 'welcome'
                ||
                $currentRoute === 'terms_condition'
                ||
                $currentRoute === 'developers'
                || $currentRoute === 'company.login'
                || $currentRoute === 'company.register'
                || $currentRoute === 'user.login'
                || $currentRoute === 'user.register'
                  )

                    <div class="newicons">

                        @if(!Auth::guard('company')->check() && !Auth::guard('web')->check())
                            <a href="{{ route('company.login') }}"
                               class="speciall speciall-act"
                               style="font-size: 16px;text-align: center;  color: white;height: 30px; width: 90px;">{{ trans('main.login') }}</a>
                            <a href="{{ route('company.register') }}"
                               class="speciall"
                               style="font-size: 16px; text-align: center; color: white; height: 30px; width: 90px;">{{ trans('main.register') }}</a>
                            <a>&nbsp;&nbsp;&nbsp;</a>
                        @endif

                        <form action="{{ route('language.update') }}" method="POST" style="    align-self: center;">
                            @csrf
                            <select name="language" id="language" class="language-select lango" onchange="this.form.submit()">
                                <option value="ar"
                                @if(
                                    (auth()->check() && auth()->user()->language === 'ar')
                                 || (auth()->guard("company")->check() && auth()->guard("company")->user()->language === 'ar')
                             )
                             selected
                             @elseif (session('language') === 'ar')
                             selected
                             @elseif ($defaultLocale === 'ar' && !(session('language') === 'en') )
                             selected
                             @endif>
                                    <img src="/imgs/uae-flag.png" alt="UAE Flag" style="width: 20px;"> العربية
                                </option>
                                <option value="en" @if(
                                    (auth()->check() && auth()->user()->language === 'en')
                                 || (auth()->guard("company")->check() && auth()->guard("company")->user()->language === 'en')
                             )
                             selected
                             @elseif (session('language') === 'en')
                             selected
                             @elseif ($defaultLocale === 'en' && !(session('language') === 'ar') )
                             selected
                             @endif>
                                    <img src="{{asset('imgs/usa-flag.png')}}" alt="USA Flag" style="width: 20px;"> English
                                </option>
                                <!-- Add more options for other supported languages -->
                            </select>
                        </form>


                           @if(Auth::guard('company')->check())
                            <a class=""     href="{{ route('company.profile.show') }}">
                            @elseif(Auth::guard('web')->check())
                                    <a class=""     href="{{ route('user.profile.show') }}" >
                            @endif

                            @if(Auth::guard('company')->check())
                                <img
                                    src="{{ asset('imgs/profile').'/'.auth('company')->user()->profile_image }}"
                                    class="singleicon mkcircle">
                                    </a>

                        <a class="alert" href="{{ route('notifications.index') }}" class=""><img src="/imgs/notificate.png" class="singleicon"></a>

                        <a class="" href="{{ route('logout') }}" class=""><img src="/imgs/logout.png" class="singleicon"></a>
                            @elseif(Auth::guard('web')->check())
                                <img
                                    src="{{ asset('imgs/profile').'/'.auth('web')->user()->profile_image }}"
                                    class="singleicon mkcircle">
                                          </a>

                        <a class="alert" href="{{ route('notifications.index') }}" class=""><img src="/imgs/notificate.png" class="singleicon"></a>

                        <a class="" href="{{ route('logout') }}" class=""><img src="/imgs/logout.png" class="singleicon"></a>
                            @endif

                    </div>

            <ul class="newnavlist" id="navi-list">
                <li class="newlistlink">
                    <a    href="{{route("welcome")}}"
                          class="iconlink">
                        {{ trans('main.Security Shield') }}
                    </a>
                </li>
                <li class="newlistlink">
                    <a  href="{{route("home")}}"
                        class="iconlink">
                        {{ trans('main.home') }}
                    </a>
                </li>

                <li class="newlistlink">
                    <a  href="{{ route('terms_condition') }}"
                        class="iconlink">
                        {{ trans('main.terms_condition') }}
                    </a>
                </li>

                @if(

                    $currentRoute === 'welcome'

                      )
                <li class="newlistlink">
                    <a  href="#services"
                        class="iconlink">
                        {{ trans('main.services') }}
                    </a>
                </li>

                {{-- <li class="newlistlink">
                    <a  href="{{route("home")}}"
                        class="iconlink">
                        {{ trans('main.home') }}
                    </a>
                </li> --}}

                <li class="newlistlink">
                    <a  href="#about-us"
                        class="iconlink">
                        {{ trans('main.about_us') }}
                    </a>
                </li>

                <li class="newlistlink">
                    <a  href="#contact-us"
                        class="iconlink">
                        {{ trans('main.contact_us') }}
                    </a>
                </li>
                @endif


            </ul>
                <div class="menunew" id="toggle-button">
                    <div class="menunew-line"></div>
                    <div class="menunew-line"></div>
                    <div class="menunew-line"></div>
                </div>

         </div>
{{--    #########################CASE2###########################################################--}}
        @else

        <div class="newicons">

            <form action="{{ route('language.update') }}" method="POST" style="    align-self: center;">
                @csrf
                <select name="language" id="language" class="language-select lango" onchange="this.form.submit()">
                    <option value="ar"
                    @if(
                        (auth()->check() && auth()->user()->language === 'ar')
                     || (auth()->guard("company")->check() && auth()->guard("company")->user()->language === 'ar')
                 )
                 selected
                 @elseif (session('language') === 'ar')
                 selected
                 @elseif ($defaultLocale === 'ar' && !(session('language') === 'en') )
                 selected
                 @endif>
                        <img src="/imgs/uae-flag.png" alt="UAE Flag" style="width: 20px;"> العربية
                    </option>
                    <option value="en" @if(
                                               (auth()->check() && auth()->user()->language === 'en')
                                            || (auth()->guard("company")->check() && auth()->guard("company")->user()->language === 'en')
                                        )
                                        selected
                                        @elseif (session('language') === 'en')
                                        selected
                                        @elseif ($defaultLocale === 'en' && !(session('language') === 'ar') )
                                        selected
                                        @endif>
                        <img src="{{asset('imgs/usa-flag.png')}}" alt="USA Flag" style="width: 20px;"> English
                    </option>
                    <!-- Add more options for other supported languages -->
                </select>
            </form>


            @if(Auth::guard('company')->check())
                <a class=""     href="{{ route('company.profile.show') }}">
                    @elseif(Auth::guard('web')->check())
                        <a class=""     href="{{ route('user.profile.show') }}" >
                            @endif

                            @if(Auth::guard('company')->check())
                                <img
                                    src="{{ asset('imgs/profile').'/'.auth('company')->user()->profile_image }}"
                                    class="singleicon mkcircle">
                        </a>

                        <a class="alert" href="{{ route('notifications.index') }}" class=""><img src="/imgs/notificate.png" class="singleicon"></a>

                        <a class="" href="{{ route('logout') }}" class=""><img src="/imgs/logout.png" class="singleicon"></a>
                    @elseif(Auth::guard('web')->check())
                        <img
                            src="{{ asset('imgs/profile').'/'.auth('web')->user()->profile_image }}"
                            class="singleicon mkcircle">
                </a>

                <a class="alert" href="{{ route('notifications.index') }}" class=""><img src="/imgs/notificate.png" class="singleicon"></a>

                <a class="" href="{{ route('logout') }}" class=""><img src="/imgs/logout.png" class="singleicon"></a>
            @endif

        </div>


        <ul class="newnavlist" id="navi-list">
            <li class="newlistlink">
                <a    href="{{route("welcome")}}"
                     class="iconlink">
                     {{ trans('main.Security Shield') }}
                </a>
            </li>
            <li class="newlistlink">
                <a  href="{{route("home")}}"
                   class="iconlink">
                    {{ trans('main.home') }}
                </a>
            </li>

            @if(Auth::guard('company')->check())
                <li class="newlistlink {{ Request::route()->getName() === 'company.dashboard.consultant' ? 'activy' : '' }}">
                    <a href="{{ route('company.dashboard.consultant') }}" class="iconlink">{{ trans('main.consultant') }}</a>
                </li>
                <li class="newlistlink {{ Request::route()->getName() === 'company.dashboard.general-contractor' ? 'activy' : '' }}">
                    <a href="{{ route('company.dashboard.general-contractor') }}" class="iconlink">{{ trans('main.general_contractor') }}</a>
                </li>
                <li class="newlistlink {{ Request::route()->getName() === 'company.dashboard.subcontractor' ? 'activy' : '' }}">
                    <a href="{{ route('company.dashboard.subcontractor') }}" class="iconlink">{{ trans('main.subcontractor') }}</a>
                </li>
                <li class="newlistlink {{ Request::route()->getName() === 'company.dashboard.supplier' ? 'activy' : '' }}">
                    <a href="{{ route('company.dashboard.supplier') }}" class="iconlink">{{ trans('main.supplier') }}</a>
                </li>
            @elseif(Auth::guard('web')->check())
                <!-- Add the following list items based on the user type -->
                <li class="newlistlink {{ Request::route()->getName() === 'user.consultant_posts' ? 'activy' : '' }}">
                    <a href="{{ route('user.consultant_posts') }}" class="iconlink">{{ trans('main.consultant') }}</a>
                </li>
                <li class="newlistlink {{ Request::route()->getName() === 'user.general_contractor_posts' ? 'activy' : '' }}">
                    <a href="{{ route('user.general_contractor_posts') }}" class="iconlink">{{ trans('main.general_contractor') }}</a>
                </li>
                <li class="newlistlink {{ Request::route()->getName() === 'user.subcontractor_posts' ? 'activy' : '' }}">
                    <a href="{{ route('user.subcontractor_posts') }}" class="iconlink">{{ trans('main.subcontractor') }}</a>
                </li>
                <li class="newlistlink {{ Request::route()->getName() === 'user.supplier_posts' ? 'activy' : '' }}">
                    <a href="{{ route('user.supplier_posts') }}" class="iconlink">{{ trans('main.supplier') }}</a>
                </li>
            @endif


            @if(Auth::guard('company')->check())
                <li class="newlistlink {{ Request::route()->getName() === 'company.dashboard' ? 'activy' : '' }}">
                    <a href="{{ route('company.dashboard') }}" class="iconlink">{{ trans('main.my_posts') }}</a>
                </li>
                <li class="newlistlink {{ Request::route()->getName() === 'company.posts.create' ? 'activy' : '' }}">
                    <a href="{{ route('company.posts.create') }}" class="iconlink">{{ trans('main.new_post') }}</a>
                </li>
            @elseif(Auth::guard('web')->check())
                <li class="newlistlink {{ Request::route()->getName() === 'user.dashboard' ? 'activy' : '' }}">
                    <a href="{{ route('user.dashboard') }}" class="iconlink">{{ trans('main.my_posts') }}</a>
                </li>
                <li class="newlistlink {{ Request::route()->getName() === 'user.posts.create' ? 'activy' : '' }}">
                    <a href="{{ route('user.posts.create') }}" class="iconlink">{{ trans('main.new_post') }}</a>
                </li>
            @endif

        </ul>

        <div class="menunew" id="toggle-button">
            <div class="menunew-line"></div>
            <div class="menunew-line"></div>
            <div class="menunew-line"></div>
        </div>
    </div>
    @endif
</section>
<!-- 1  new nav -->
@if (Auth::guard('company')->check() || Auth::guard('web')->check())


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // Function to update the notifications count
    function updateNotificationsCount() {
        $.ajax({
            url: '{{ route('get-notifications-count') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var notificationsCount = response.count;
                var alertElement = $('.alert');

                alertElement.attr('data-count', notificationsCount); // Set the data-count attribute

                if (notificationsCount > 0) {
                    alertElement.addClass('has-notifications'); // Add a class to indicate notifications
                } else {
                    alertElement.removeClass('has-notifications'); // Remove the class to hide notifications
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Update the notifications count initially
    updateNotificationsCount();

    // Update the notifications count every 2 minutes
    setInterval(updateNotificationsCount, 60000); // 1/2 minutes in milliseconds

    </script>
@endif --}}
