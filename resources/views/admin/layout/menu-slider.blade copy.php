<div class="container">
    <ul class="nav nav-pills row row-cols-4 row-cols-md-12 g-3">
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'slider.index' ? 'active' : '' }}"
                href="{{ route('slider.index') }}">
                <i class='bx bxs-slideshow me-1'></i>
                {!! __('admin.Sliders') !!}
            </a>
        </li>
        {{-- <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'service.index' ? 'active' : '' }}"
                href="{{ route('service.index') }}">
                <i class='bx bx-plus-medical me-1'></i>
                {!! __('admin.Services') !!}
            </a>
        </li> --}}
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'faq.index' ? 'active' : '' }}"
                href="{{ route('faq.index') }}">
                <i class='bx bxs-add-to-queue me-1'></i>
                {!! __('admin.FAQ') !!}
            </a>
        </li>
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'settings.index' ? 'active' : '' }}"
                href="{{ route('settings.index') }}">
                <i class='me-1 bx bxs-cog'></i>
                {!! __('admin.Settings') !!}
            </a>
        </li>
        {{-- <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'color.index' ? 'active' : '' }}"
                href="{{ route('color.index') }}">
                <i class='me-1 bx bxs-cog'></i>
                {!! __('admin.Color') !!}
            </a>
        </li> --}}
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'user.index' ? 'active' : '' }}"
                href="{{ route('user.index') }}">
                <i class="bx bx-user me-1"></i>
                {!! __('admin.Account') !!}
            </a>
        </li>
        {{-- <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'page.show' ? 'active' : '' }}"
                href="{{ route('page.show') }}">
                <i class="bx bx-user me-1"></i> {!! __('admin.Page Banner') !!}
            </a>
        </li> --}}
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'meeting.edit' ? 'active' : '' }}"
                href="{{ route('meeting.edit') }}">
                <i class="bx bx-user me-1"></i> {!! __('admin.Zoom') !!}
            </a>
        </li>
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'about.index' ? 'active' : '' }}"
                href="{{ route('about.index') }}">
                <i class="bx bx-user me-1"></i>
                {!! __('admin.About Us') !!}
            </a>
        </li>
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'about.edit' ? 'active' : '' }}"
                href="{{ route('about.edit1', 1) }}">
                <i class="bx bx-user me-1"></i>
                {!! __('admin.About Us') !!}
            </a>
        </li>
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'policy.edit' ? 'active' : '' }}"
                href="{{ route('policy.edit', 1) }}">
                <i class="bx bx-user me-1"></i>
                {!! __('admin.Privacy Policy') !!}
            </a>
        </li>

        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'terms.edit' ? 'active' : '' }}"
                href="{{ route('terms.edit', 1) }}">
                <i class="bx bx-user me-1"></i>
                {!! __('admin.Privacy terms') !!}
            </a>
        </li>


        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'card.index' ? 'active' : '' }}"
                href="{{ route('card.index') }}">
                <i class="bx bx-user me-1"></i>
                {!! __('admin.Card') !!}
            </a>
        </li>

        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'meta.index' ? 'active' : '' }}"
                href="{{ route('meta.index') }}">
                <i class="bx bx-user me-1"></i> {!! __('admin.Meta') !!}
            </a>
        </li>

        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'blog_category.index' ? 'active' : '' }}"
                href="{{ route('blog_category.index') }}">
                <i class="bx bx-user me-1"></i> {!! __('admin.Blog Categores') !!}
            </a>
        </li>

        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'service_category.index' ? 'active' : '' }}"
                href="{{ route('service_category.index') }}">
                <i class="bx bx-user me-1"></i> {!! __('admin.Services Categores') !!}
            </a>
        </li>

        {{-- <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'faq.index' ? 'active' : '' }}"
                href="{{ route('faq.index') }}">
                <i class="bx bx-user me-1"></i> {!! __('admin.Page Banner') !!}
            </a>
        </li> --}}
    </ul>
</div>

<div class="container">
    <ul class="nav nav-pills row row-cols-4 row-cols-md-12 g-3">
        @php
            $navItems = [
                ['route' => 'slider.index', 'icon' => 'bxs-slideshow', 'label' => __('admin.Sliders')],
                ['route' => 'faq.index', 'icon' => 'bxs-add-to-queue', 'label' => __('admin.FAQ')],
                ['route' => 'settings.index', 'icon' => 'bxs-cog', 'label' => __('admin.Settings')],
                ['route' => 'user.index', 'icon' => 'bx-user', 'label' => __('admin.Account')],
                ['route' => 'meeting.edit', 'icon' => 'bx-user', 'label' => __('admin.Zoom')],
                ['route' => 'about.index', 'icon' => 'bx-user', 'label' => __('admin.About Us')],
                ['route' => 'about.edit', 'icon' => 'bx-user', 'label' => __('admin.About Us'), 'params' => [1]],
                ['route' => 'policy.edit', 'icon' => 'bx-user', 'label' => __('admin.Privacy Policy'), 'params' => [1]],
                ['route' => 'terms.edit', 'icon' => 'bx-user', 'label' => __('admin.Privacy terms'), 'params' => [1]],
                ['route' => 'card.index', 'icon' => 'bx-user', 'label' => __('admin.Card')],
                ['route' => 'meta.index', 'icon' => 'bx-user', 'label' => __('admin.Meta')],
                ['route' => 'blog_category.index', 'icon' => 'bx-user', 'label' => __('admin.Blog Categories')],
                ['route' => 'service_category.index', 'icon' => 'bx-user', 'label' => __('admin.Services Categories')],
            ];
        @endphp

        @foreach ($navItems as $item)
            @php
                $isActive = Request::route()->getName() == $item['route'] ? 'active' : '';
                $url = isset($item['params']) ? route($item['route'], $item['params']) : route($item['route']);
            @endphp

            <li class="nav-item col">
                <a class="nav-link {{ $isActive }}" href="{{ $url }}">
                    <i class="bx {{ $item['icon'] }} me-1"></i>
                    {!! $item['label'] !!}
                </a>
            </li>
        @endforeach
    </ul>
</div>
