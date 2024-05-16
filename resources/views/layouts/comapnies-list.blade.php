<div class="catch-company">
    <!--  0 data -->
    <div class="about-client">
                <a style="color: #2196f3" href="{{ route('companies.index') }}" >
        <h2 class="h-about">{{ trans('main.companies') }}</h2>
                </a>
        {{--            <div class="infu-boxv">--}}
        {{--                <div class="catch-photo">--}}
        {{--                    <img src="/imgs/profile-pic-II.jpg">--}}
        {{--                </div>--}}
        {{--                <div class="data-infu">--}}
        {{--                    <div class="infu">ASGC-ahmed</div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
    </div>
    <!-- 1 data  -->
    @foreach( $companies as $company )

        <!--  0 data -->
        <div class="about-client">
            <div class="infu-boxv">

                <div class="catch-photo">
                    <a href="{{ route('company.other.profile', $company) }}">
                        <img
                            src="{{ asset('imgs/profile').'/'.$company->profile_image }}"
                        >

                </div>
                <div class="data-infu">
                    <div class="infu">
                        {{
                          \Illuminate\Support\Str::limit
                            ($company->company_name,7, '')
                        }}
                    </div>


                </div> </a>
            </div>
        </div>
        <!-- 1 data  -->
    @endforeach
</div>
