<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    {{-- @dd(app()->isLocale('ar')) --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
      <nav class="mt-2 @if(app()->isLocale('ar')) justify-content-end @endif"
     style="@if(app()->isLocale('ar')) direction: rtl; text-align: right; @endif">
    <ul class="nav nav-pills nav-sidebar flex-column"
        data-widget="treeview"
        role="menu"
        data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
{{--                @dd(auth()--}}
{{--                        ->guard("web")--}}
{{--                        ->user()->roles )--}}
{{--                @dd(auth()->guard('web')->user()->roles->pluck('name')->toArray()    )--}}





                {{-- @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan --}}


     <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>

                                 <li class="nav-item">
                                <a href="{{ route("admin.contact.index") }}"
                                   class="nav-link {{ request()->is("admin/contact")
                        || request()->is("admin/contact/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-comment">

                                    </i>
                                    <p>
                                        {{ trans('global.contact_me') }}
                                    </p>
                                </a>
                            </li>



                                <li class="nav-item">
                                <a href="{{ route("admin.blogs.index") }}"
                                   class="nav-link {{ request()->is("admin/blogs")
                        || request()->is("admin/blogs/*") ? "active" : "" }}">
                                    <i class="fa-fw nav-icon fas fa-blog">

                                    </i>
                                    <p>
                                        {{ trans('global.blogs') }}
                                    </p>
                                </a>
                            </li>

               {{-- <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
       href="{{ route('admin.orders.index') }}"
       
       >
        <!-- Use an orders or cart icon instead of the dollar sign -->
        <!-- Example using an orders icon -->
        <i class="fas fa-fw fa-shopping-cart nav-icon"></i>
        <!-- Example using a cart icon -->
        <!-- <i class="fas fa-fw fa-cart-arrow-down nav-icon"></i> -->
        <p>{{ trans('cruds.order.title_plural') }}</p>
    </a>
</li> --}}



    <!-- Categories -->
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i class="fas fa-fw fa-folder nav-icon"></i>
                <p>
                    {{ trans('cruds.category.title') }}
                </p>
            </a>
        </li> --}}

        <!-- Products -->
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                <i class="fas fa-fw fa-box nav-icon"></i>
                <p>
                    {{ trans('cruds.product.title') }}
                </p>
            </a>
        </li> --}}

        <!-- Persons -->
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.persons.*') ? 'active' : '' }}" href="{{ route('admin.persons.index') }}">
                <i class="fas fa-fw fa-user nav-icon"></i>
                   <p>
                    {{ trans('cruds.person.title') }}
                </p>
            </a>
        </li>

        <!-- Families -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.families.*') ? 'active' : '' }}" href="{{ route('admin.families.index') }}">
                <i class="fas fa-fw fa-users nav-icon"></i>
                <p>
                    {{ trans ('cruds.family.title') }}
                </p>
            </a>
        </li>

         <!-- Family Branches -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.family-branches.*') ? 'active' : '' }}" href="{{ route('admin.family-branches.index') }}">
                    <i class="fas fa-fw fa-sitemap nav-icon"></i>
                    <p>
                            {{ trans('cruds.familyBranch.title') }}
                    </p>
                </a>
            </li>

        
      
            <!-- Fees -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.fees.*') ? 'active' : '' }}" href="{{ route('admin.fees.index') }}">
                    <i class="fas fa-fw fa-dollar-sign nav-icon"></i>
                    <p>
                        {{ trans('cruds.fee.title') }}
                    </p>
                </a>
            </li>


            <!-- Bills -->
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.bills.*') ? 'active' : '' }}" href="{{ route('admin.bills.index') }}">
        <i class="fas fa-fw fa-file-invoice nav-icon"></i>
        <p>
            {{ trans('cruds.bill.title') }}
        </p>
    </a>
</li>


<!-- Payments -->
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}" href="{{ route('admin.payments.index') }}">
        <i class="fas fa-fw fa-money-bill nav-icon"></i>
        <p>
            {{ trans('cruds.payment.title') }}
        </p>
    </a>
</li> --}}



                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
{{--                        @can('profile_password_edit')--}}
                            <li class="nav-item" >
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
{{--                        @endcan--}}
                    @endif
                    
                        <br>

                <li class="nav-item">
                    <form id="logoutform" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon"></i>
                            <p>{{ trans('global.logout') }}</p>
                            </p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
