<!-- Menu -->
@php
    use App\Models\Setting;
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a  class="app-brand-link">
            <span class="app-brand-logo demo">
                <img style="width: 45px; height:auto"
                    src="{{ asset('images') }}/{{ Setting::find(1)->photo ?? 'no-image.png' }}" class="ms-auto"
                    alt="logo" width="30" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{ Setting::find(1)->name }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        {{-- Dashboard --}}
        @can('view dashboard')
            <li class="menu-item {{ Request::route()->getName() == 'home' ? 'active open' : '' }}">
                <a href="{{ route('home') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-home"></i>
                    <div class="text-truncate">{{ __('admin.Dashboards') }}</div>
                </a>
            </li>
        @endcan

        {{-- Bookings --}}
        @canany(['view booking', 'create booking', 'edit booking', 'delete booking'])
            <li class="menu-item {{ Request::route()->getName() == 'booking.index' ? 'active open' : '' }}">
                <a href="{{ route('booking.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-calendar"></i>
                    <div class="text-truncate">{{ __('admin.Bookings') }}</div>
                </a>
            </li>
        @endcanany

        {{-- Expenses --}}
        @canany(['view expenses', 'create expenses', 'edit expenses', 'delete expenses'])
            <li class="menu-item {{ Request::route()->getName() == 'expenses.index' ? 'active open' : '' }}">
                <a href="{{ route('expenses.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-money"></i>
                    <div class="text-truncate">{{ __('admin.Expenses') }}</div>
                </a>
            </li>
        @endcanany

        {{-- Meetings --}}
        @canany(['view meeting', 'create meeting', 'edit meeting', 'delete meeting'])
            <li class="menu-item {{ Request::route()->getName() == 'meeting.index' ? 'active open' : '' }}">
                <a href="{{ route('meeting.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-video"></i>
                    <div class="text-truncate">{{ __('admin.Meetings') }}</div>
                </a>
            </li>
        @endcanany

        {{-- Contact Us --}}
        @canany(['view contact', 'create contact', 'edit contact', 'delete contact'])
            <li class="menu-item {{ Request::route()->getName() == 'contact.index' ? 'active open' : '' }}">
                <a href="{{ route('contact.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-chat"></i>
                    <div class="text-truncate">{{ __('admin.Contact Us') }}</div>
                </a>
            </li>
        @endcanany

        {{-- Customers & Groups --}}
        @canany(['view customer', 'create customer', 'edit customer', 'delete customer', 'view group', 'create group',
            'edit group', 'delete group'])
            <li
                class="menu-item {{ in_array(Request::route()->getName(), ['customer.index', 'group.index']) ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                    <div class="text-truncate">{{ __('admin.Customers') }}</div>
                </a>
                <ul class="menu-sub">
                    @canany(['view customer', 'create customer', 'edit customer', 'delete customer'])
                        <li class="menu-item {{ Request::route()->getName() == 'customer.index' ? 'active' : '' }}">
                            <a href="{{ route('customer.index') }}" class="menu-link">
                                <div class="text-truncate">{{ __('admin.Customers') }}</div>
                            </a>
                        </li>
                    @endcanany

                    @canany(['view group', 'create group', 'edit group', 'delete group'])
                        <li class="menu-item {{ Request::route()->getName() == 'group.index' ? 'active' : '' }}">
                            <a href="{{ route('group.index') }}" class="menu-link">
                                <div class="text-truncate">{{ __('admin.Groups') }}</div>
                            </a>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        {{-- Visits --}}
        @canany(['view visit', 'create visit', 'edit visit', 'delete visit'])
            <li class="menu-item {{ Request::route()->getName() == 'visit.index' ? 'active open' : '' }}">
                <a href="{{ route('visit.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-plane-alt"></i>
                    <div class="text-truncate">{{ __('admin.Visits') }}</div>
                </a>
            </li>
        @endcanany

        {{-- marketing --}}
        @canany(['view marketing', 'create marketing', 'edit marketing', 'delete marketing'])
            <li class="menu-item {{ Request::route()->getName() == 'marketing.index' ? 'active open' : '' }}">
                <a href="{{ route('marketing.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx  bxs-box"></i>
                    <div class="text-truncate">{{ __('admin.Marketing') }}</div>
                </a>
            </li>
        @endcanany

        {{-- Users --}}
        @canany([
            'view user',
            'create user',
            'edit user',
            'delete user',
            'view employees',
            'create employees',
            'edit employees',
            'delete employees',
            'view lecture',
            'create lecture',
            'edit lecture',
            'delete lecture',
            'view exam',
            'create exam',
            'edit exam',
            'delete exam',
            ])
            <li
                class="menu-item {{ in_array(Request::route()->getName(), ['users.index', 'employees.index', 'lecture.index', 'exam.index']) ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-user"></i>
                    <div class="text-truncate">{{ __('admin.Users') }}</div>
                </a>
                <ul class="menu-sub">
                    @canany(['view user', 'create user', 'edit user', 'delete user'])
                        <li class="menu-item {{ Request::route()->getName() == 'users.index' ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}" class="menu-link">
                                <div class="text-truncate">{{ __('admin.User') }}</div>
                            </a>
                        </li>
                    @endcanany

                    {{-- @canany(['view employees', 'create employees', 'edit employees', 'delete employees'])
                        <li class="menu-item {{ Request::route()->getName() == 'employees.index' ? 'active' : '' }}">
                            <a href="{{ route('employees.index') }}" class="menu-link">
                                <div class="text-truncate">{{ __('admin.Employees') }}</div>
                            </a>
                        </li>
                    @endcanany --}}

                    @canany(['view lecture', 'create lecture', 'edit lecture', 'delete lecture'])
                        <li class="menu-item {{ Request::route()->getName() == 'lecture.index' ? 'active' : '' }}">
                            <a href="{{ route('lecture.index') }}" class="menu-link">
                                <div class="text-truncate">{{ __('admin.Lectures') }}</div>
                            </a>
                        </li>
                    @endcanany

                    @canany(['view exam', 'create exam', 'edit exam', 'delete exam'])
                        <li class="menu-item {{ Request::route()->getName() == 'exam.index' ? 'active' : '' }}">
                            <a href="{{ route('exam.index') }}" class="menu-link">
                                <div class="text-truncate">{{ __('admin.Exam') }}</div>
                            </a>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        {{-- Roles --}}
        @canany(['view role', 'create role', 'edit role', 'delete role'])
            <li class="menu-item {{ Request::route()->getName() == 'roles.index' ? 'active open' : '' }}">
                <a href="{{ route('roles.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-id-card"></i>
                    <div class="text-truncate">{{ __('admin.Roles') }}</div>
                </a>
            </li>
        @endcanany

        {{-- Courses --}}
        @canany(['view course', 'create course', 'edit course', 'delete course'])
            <li class="menu-item {{ Request::route()->getName() == 'courses.index' ? 'active open' : '' }}">
                <a href="{{ route('courses.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-carousel"></i>
                    <div class="text-truncate">{{ __('admin.Online Sessions') }}</div>
                </a>
            </li>
        @endcanany

        {{-- Reviews --}}
        @canany(['view review', 'create review', 'edit review', 'delete review'])
            <li class="menu-item {{ Request::route()->getName() == 'courses_review.index' ? 'active open' : '' }}">
                <a href="{{ route('courses_review.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-star"></i>
                    <div class="text-truncate">{{ __('admin.Reviews') }}</div>
                </a>
            </li>
        @endcanany

        {{-- Blogs --}}
        @canany(['view blog', 'create blog', 'edit blog', 'delete blog', 'view blog category', 'create blog category',
            'edit blog category', 'delete blog category'])
            <li
                class="menu-item {{ in_array(Request::route()->getName(), ['blog.index', 'blog_category.index']) ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-book"></i>
                    <div class="text-truncate">{{ __('admin.Blogs') }}</div>
                </a>
                <ul class="menu-sub">
                    @canany(['view blog', 'create blog', 'edit blog', 'delete blog'])
                        <li class="menu-item {{ Request::route()->getName() == 'blog.index' ? 'active' : '' }}">
                            <a href="{{ route('blog.index') }}" class="menu-link">
                                <div class="text-truncate">{{ __('admin.Blogs') }}</div>
                            </a>
                        </li>
                    @endcanany

                    @canany(['view blog category', 'create blog category', 'edit blog category', 'delete blog category'])
                        <li class="menu-item {{ Request::route()->getName() == 'blog_category.index' ? 'active' : '' }}">
                            <a href="{{ route('blog_category.index') }}" class="menu-link">
                                <div class="text-truncate">{{ __('admin.Blog Categores') }}</div>
                            </a>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        {{-- Slider / Settings --}}
        @canany(['view slider', 'create slider', 'edit slider', 'delete slider'])
            <li class="menu-item {{ Request::route()->getName() == 'slider.index' ? 'active open' : '' }}">
                <a href="{{ route('slider.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-cog"></i>
                    <div class="text-truncate">{{ __('admin.Settings') }}</div>
                </a>
            </li>
        @endcanany

    </ul>
</aside>
<!-- / Menu -->
