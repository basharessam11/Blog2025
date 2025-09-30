<!-- Navbar -->




<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">











    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>


    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">




        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                    <i class="bx bx-search bx-sm"></i>
                    <span class="d-none d-md-inline-block text-muted">{!! __('admin.Search (Ctrl+/)') !!} </span>
                </a>
            </div>
        </div>
        <!-- /Search -->





        <ul class="navbar-nav flex-row align-items-center ms-auto">




            <!-- Language -->
            <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class='bx bx-globe bx-sm'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">

                    @if (App::isLocale('en'))
                        <li>
                            <a class="dropdown-item" href="{{ route('language', 'ar') }}" data-language="ar"
                                data-text-direction="rtl">
                                <span class="align-middle">{!! __('admin.Arabic') !!}</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a class="dropdown-item" href="{{ route('language', 'en') }}" data-language="en"
                                data-text-direction="ltr">
                                <span class="align-middle">{!! __('admin.English') !!}</span>
                            </a>
                        </li>
                    @endif





                </ul>
            </li>
            <!-- /Language -->




            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class='bx bx-sm'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                            <span class="align-middle"><i class='bx bx-sun me-2'></i>{!! __('admin.Light') !!} </span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                            <span class="align-middle"><i class="bx bx-moon me-2"></i>{!! __('admin.Dark') !!}</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                            <span class="align-middle"><i class="bx bx-desktop me-2"></i>{!! __('admin.System') !!}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- / Style Switcher-->


            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('images') }}/{{ Auth::user()->photo != null ? Auth::user()->photo : 'user1.png' }}"
                            alt class="w-px-40 h-px-40 h-auto rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('user.index') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('images') }}/{{ Auth::user()->photo != null ? Auth::user()->photo : 'user1.png' }}"
                                            alt class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block">
                                        @if (App::isLocale('ar'))
                                            {{ Auth::user()->name_ar }}
                                        @else
                                            {{ Auth::user()->name_en }}
                                        @endif
                                    </span>
                                    <small class="text-muted"> @php
                                        // نجيب أول رول عند المستخدم (لو عنده أكثر من رول)
                                        $role = Auth::user()->roles->first();
                                    @endphp
                                        {{ $role ? $role->name : __('admin.NoRole') }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    @can('view user')
                        <li>
                            <a class="dropdown-item" href="{{ route('user.index') }}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">{!! __('admin.My Profile') !!} </span>
                            </a>
                        </li>
                    @endcan
                    @can('view setting')
                        <li>
                            <a class="dropdown-item" href="{{ route('settings.index') }}">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">{!! __('admin.Settings') !!}</span>
                            </a>
                        </li>
                    @endcan

                    @can('view setting')
                        <li>
                            <a class="dropdown-item" href="{{ route('settings.index') }}">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">{!! __('admin.Settings') !!}</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                    @endcan



                    @can('view faq')
                        <li>
                            <a class="dropdown-item" href="{{ route('faq.index') }}">
                                <i class="bx bx-help-circle me-2"></i>
                                <span class="align-middle">{!! __('admin.FAQ') !!}</span>
                            </a>
                        </li>

                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                    @endcan



                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle"> {!! __('admin.Logout') !!} </span>

                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>


                    </li>
                </ul>
            </li>
            <!--/ User -->


        </ul>
    </div>


    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper  d-none">
        <input type="text" class="form-control search-input container-xxl border-0"
            placeholder="{!! __('admin.Search...') !!}" aria-label="{!! __('admin.Search...') !!}">
        <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
    </div>


</nav>



<!-- / Navbar -->
