@extends('layouts.admin')

@section('content')

@section('styles')
<style>
    /* Add your custom CSS here */

    /* Centering the dashboard content */
    .dashboard-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50%;
        background-color: #f0f0f0;
    }

    /* Card styling */
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
        background-color: #fff;
        margin-bottom: 20px;
        text-align: center;
    }

    .card h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .card p {
        font-size: 18px;
        margin-bottom: 10px;
    }

    /* Colors for the cards */
    .user-card {
        border-left: 5px solid #007bff; /* Blue color */
    }

    .order-card {
        border-left: 5px solid #17a2b8; /* Aqua color */
    }

    .completed-order-card {
        border-left: 5px solid #28a745; /* Green color */
    }

    .pending-order-card {
        border-left: 5px solid #ffc107; /* Yellow color */
    }

    .product-card {
        border-left: 5px solid #6610f2; /* Purple color */
    }

    .category-card {
        border-left: 5px solid #6c757d; /* Gray color */
    }

    .payment-card {
        border-left: 5px solid #dc3545; /* Red color */
    }

    .company-card {
        border-left: 5px solid #fd7e14; /* Orange color */
    }
</style>
@endsection

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('panel.dashboard.title') }}
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @php
                        use Carbon\Carbon;

                        // Get the current time in Cairo's time zone
                        $cairoTime = Carbon::now('Africa/Cairo');
                        // Format the current time in 12-hour format with AM/PM
                        $currentDateTime = $cairoTime->format('h:i A');

                        // Format the current time in 12-hour format with AM/PM
                        $currentPeriod = $cairoTime->format('A');

                        // Initialize the greeting
                        $greeting = '';

                        // Determine the appropriate greeting based on the current time period (AM/PM)
                        if ($currentPeriod == 'AM') {
                            $greeting = trans('panel.good_morning');
                        } else {
                            $greeting = trans('panel.good_afternoon');
                        }
                    @endphp

                    <h1>{{ $greeting }}</h1>
                    <p>@lang('panel.CurrentTime'): {{ $currentDateTime }}</p>
                    {{ trans('panel.dashboard.logged_in_message') }}
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-container">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card user-card">
                        <h2><i class="fas fa-users"></i> @lang('panel.number_of_users')</h2>
                        <p>@lang('panel.total_users'): <span id="totalUsers">{{ $totalUsers }}</span></p>
                    </div>
                </div>

                <div class="col-md-3">
    <div class="card contact-card">
        <h2><i class="fas fa-address-book"></i> @lang('panel.number_of_contacts')</h2>
        <p>@lang('panel.total_contacts'): <span id="totalContacts">{{ $totalContacts }}</span></p>
    </div>
</div>


                {{-- <div class="col-md-3">
                    <div class="card order-card">
                        <h2><i class="fas fa-shopping-cart"></i> @lang('panel.total_orders')</h2>
                        <p>@lang('panel.total_orders_count'): <span id="totalOrders">{{ $totalOrders }}</span></p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card completed-order-card">
                        <h2><i class="fas fa-check-circle"></i> @lang('panel.completed_orders')</h2>
                        <p>@lang('panel.completed_orders_count'): <span id="completedOrders">{{ $completedOrders }}</span></p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card pending-order-card">
                        <h2><i class="fas fa-exclamation-circle"></i> @lang('panel.pending_orders')</h2>
                        <p>@lang('panel.pending_orders_count'): <span id="pendingOrders">{{ $pendingOrders }}</span></p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card product-card">
                        <h2><i class="fas fa-box"></i> @lang('panel.total_products')</h2>
                        <p>@lang('panel.total_products_count'): <span id="totalProducts">{{ $totalProducts }}</span></p>
                    </div>
                </div> --}}
                {{-- <!-- Family-->
                <div class="col-md-3">
                    <div class="card category-card">
                        <h2><i class="fas fa-users"></i> @lang('panel.total_families')</h2>
                        <p>@lang('panel.total_families_count'): <span id="totalFamilies">{{ $totalFamily }}</span></p>
                    </div>
                </div>
                <!-- Family Branches-->
                <div class="col-md-3">
                    <div class="card category-card">
                        <h2><i class="fas fa-sitemap"></i> @lang('panel.total_family_branches')</h2>
                        <p>@lang('panel.total_family_branches_count'): <span id="totalFamilyBranches">{{ $totalFamilyBranch }}</span></p>
                    </div>
                </div> --}}

                {{-- <div class="col-md-3">
                    <div class="card category-card">
                        <h2><i class="fas fa-list"></i> @lang('panel.total_categories')</h2>
                        <p>@lang('panel.total_categories_count'): <span id="totalCategories">{{ $totalCategories }}</span></p>
                    </div>
                </div> --}}
{{-- 
                <div class="col-md-3">
                    <div class="card payment-card">
                        <h2><i class="fas fa-money-bill"></i> @lang('panel.total_system_paid_money')</h2>
                        <p>@lang('panel.total_paid_money'): <span id="totalPaidMoney">{{ $totalPaidMoney }} EGP</span></p>
                    </div>
                </div> --}}

                
                <!-- Add more cards for other statistics here if needed -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
@endsection
