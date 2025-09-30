<div class="container">
    <ul class="nav nav-pills row row-cols-7 row-cols-md-12 g-3">
        @php
            $navItems = [
                [
                    'route' => 'slider.index',
                    'icon' => 'bxs-slideshow',
                    'label' => __('admin.Sliders'),
                    'permission' => 'view slider',
                ],
                [
                    'route' => 'faq.index',
                    'icon' => 'bxs-add-to-queue',
                    'label' => __('admin.FAQ'),
                    'permission' => 'view faq',
                ],
                [
                    'route' => 'settings.index',
                    'icon' => 'bxs-cog',
                    'label' => __('admin.Settings'),
                    'permission' => 'view setting',
                ],
                
                [
                    'route' => 'user.index',
                    'icon' => 'bx-user',
                    'label' => __('admin.Account'),
                    'permission' => 'view user',
                ],
                [
                    'route' => 'meeting.edit',
                    'icon' => 'bx-user',
                    'label' => __('admin.Zoom'),
                    'permission' => 'edit meeting',
                ],
                // [
                //     'route' => 'about.index',
                //     'icon' => 'bx-user',
                //     'label' => __('admin.About Us'),
                //     'permission' => 'view about',
                // ],
                // [
                //     'route' => 'about.edit',
                //     'icon' => 'bx-user',
                //     'label' => __('admin.About Us'),
                //     'params' => [1],
                //     'permission' => 'edit about',
                // ],
                // [
                //     'route' => 'policy.edit',
                //     'icon' => 'bx-user',
                //     'label' => __('admin.Privacy Policy'),
                //     'params' => [1],
                //     'permission' => 'edit policy',
                // ],
                // [
                //     'route' => 'terms.edit',
                //     'icon' => 'bx-user',
                //     'label' => __('admin.Privacy terms'),
                //     'params' => [1],
                //     'permission' => 'edit terms',
                // ],
                [
                    'route' => 'card.index',
                    'icon' => 'bx-user',
                    'label' => __('admin.Card'),
                    'permission' => 'view card',
                ],
                [
                    'route' => 'meta.index',
                    'icon' => 'bx-user',
                    'label' => __('admin.Meta'),
                    'permission' => 'view meta',
                ],
                // [
                //     'route' => 'blog_category.index',
                //     'icon' => 'bx-user',
                //     'label' => __('admin.Blog Categories'),
                //     'permission' => 'view blog category',
                // ],
                [
                    'route' => 'service_category.index',
                    'icon' => 'bx-code',
                    'label' => __('admin.Languages'),
                    'permission' => 'view service category',
                ],
            ];
        @endphp

        @foreach ($navItems as $item)
            {{-- @dd($item['permission']) --}}
            @can($item['permission'])
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
            @endcan
        @endforeach
    </ul>
</div>
