@php
    $footerContent = \App\Models\FooterContent::all()->keyBy('id');
    $currentLocale = app()->getLocale(); // Get the current locale
@endphp

<div class="footer">
    <div class="container">
        <div class="box">
            <h3>{{ trans('main.Security Shield') }}</h3>
            <ul class="social">
                @if($footerContent->has(1))
                    <li>
                        <a href="{{ $footerContent[1]->link }}" class="facebook">
                            <i class="{{ $footerContent[1]->icon }}"></i>
                        </a>
                    </li>
                @endif
                @if($footerContent->has(2))
                    <li>
                        <a href="{{ $footerContent[2]->link }}" class="twitter">
                            <i class="{{ $footerContent[2]->icon }}"></i>
                        </a>
                    </li>
                @endif
                @if($footerContent->has(3))

                    <li>
                        <a href="{{ $footerContent[3]->link }}" class="youtube">
                            <i class="{{ $footerContent[3]->icon }}"></i>
                        </a>
                    </li>
                @endif

                    @if($footerContent->has(13))
                        {{--   I but 2 links and icons          --}}

                 <li>

                            <a href="{{ $footerContent[13]->link }}">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                height="1em" viewBox="0 0 448 512">
                                <!--! Font Awesome Free 6.4.0 by @fontawesome
                                    - https://fontawesome.com License - https://fontawesome.com/license
                                    (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <style>svg{font-size: 40px;
                                            fill: #ffffff;}</style>
                                            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                                        </svg>
                            </a>
                        </li>
                      @endif
                      @if($footerContent->has(14))
                        <li>
                            <a href="{{ $footerContent[14]->link }}" class="youtube">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                            </svg>
                            </a>
                        </li>
                @endif

                {{-- @if($footerContent->has(4)) --}}
                {{-- @endif --}}
            </ul>
        </div>
        <div class="box" style="margin-right: 15px;">
            <ul class="links">
                {{-- @if($footerContent->has(4)) --}}
                    <li>
                        <a href="{{ route('developers') }}">
                            {{ trans('global.developers') }}
                            {{-- {{ $footerContent[4]->title }} --}}
                        </a>
                    </li>
                {{-- @endif --}}
{{--                @if($footerContent->has(5))--}}
{{--                    <li>--}}
{{--                        <a href="{{ $footerContent[5]->link }}">--}}
{{--                            {{ $footerContent[5]->title }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endif--}}
{{--                @if($footerContent->has(6))--}}
{{--                    <li>--}}
{{--                        <a href="{{ $footerContent[6]->link }}">--}}
{{--                            {{ $footerContent[6]->title }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endif--}}
            </ul>
        </div>
        <div class="box">
            <div class="line">
                <i class="fas fa-map-marker-alt fa-fw"></i>
                <div class="info">
                    @if($currentLocale === 'ar' && $footerContent->has(12))
                        {{ $footerContent[12]->link }}
                    @else
                        @if($footerContent->has(10))
                            {{ $footerContent[10]->link }}
                        @endif
                    @endif
                </div>
            </div>
            <div class="line">
                <i class="far fa-clock fa-fw"></i>
                <div class="info">
                    @if($currentLocale === 'ar' && $footerContent->has(11))
                        {{ $footerContent[11]->link }}
                    @else
                        @if($footerContent->has(9))
                            {{ $footerContent[9]->link }}
                        @endif
                    @endif
                </div>
            </div>
            <div class="line">
                <i class="fas fa-phone-volume fa-fw"></i>
                <div class="info">
                    @if($footerContent->has(7))
                        <span><a class="c-white" href="{{ $footerContent[7]->link }}">{{ $footerContent[7]->title }}</a></span>
                    @endif
                    @if($footerContent->has(8))
                        <span><a class="c-white" href="{{ $footerContent[8]->link }}">{{ $footerContent[8]->title }}</a></span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <p class="copyright">© 2023 {{ trans('main.cp_rights') }}</p>
</div>
