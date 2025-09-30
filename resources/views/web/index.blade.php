@extends('web.layouts.app')



@section('content')
    @php
        use App\Models\Setting;
        use App\Models\Meta;

        $locale = App::currentLocale();
        $settings = Setting::find(1);
        $meta = Meta::first();

    @endphp


    <!-- Main Content Area -->
    <div class="col-lg-8">
        <!-- Featured Post -->
        @if (isset($featuredBlog))
            <div class="card mb-4">
                <img src="{{ $featuredBlog->image }}" alt="{{ $featuredBlog->title }}">
                <div class="card-body">
                    <div class="text-muted mb-2">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ \Carbon\Carbon::parse($featuredBlog->created_at)->translatedFormat('d F Y') }}
                        <span class="mx-2">|</span>
                        <i class="bi bi-folder me-1"></i>
                        <a href="{{ route('category.show', ['slug' => $featuredBlog->articleType->slug]) }}"
                            class="text-decoration-none">{{ $featuredBlog->articleType->name }}</a>
                    </div>
                    <h1 class="card-title h3">{{ $featuredBlog->title }}</h1>
                    <p class="card-text">{{ Str::limit(strip_tags($featuredBlog->content), 200) }}</p>
                    <a href="{{ route('blog_details', $featuredBlog->slug) }}" class="btn btn-primary">اقرأ المزيد</a>
                </div>
            </div>
        @endif

        <!-- Recent Posts Grid -->
        <h2 class="mb-4 border-bottom pb-2">أحدث المقالات</h2>
        <div class="row">
            @foreach ($recentBlogs as $recent)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="{{ $recent->image }}" class="card-img-top" alt="{{ $recent->title }}">
                        <div class="card-body">
                            <h3 class="h5 card-title">{{ $recent->title }}</h3>
                            <p class="card-text">{{ Str::limit(strip_tags($recent->content), 100) }}</p>
                            <a href="{{ route('blog_details', $recent->slug) }}"
                                class="btn btn-sm btn-outline-primary">اقرأ المزيد</a>
                        </div>
                        <div class="card-footer text-muted small">
                            <i class="bi bi-clock me-1"></i> {{ $recent->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-md-12 mb-4">
                <nav aria-label="صفحات الأخبار" class="d-flex justify-content-center">
                    {{ $recentBlogs->links('pagination::bootstrap-4') }}
                </nav>
            </div>
        </div>
    </div>




    <!-- Sidebar -->
    <div class="col-lg-4">

        <!-- Popular Posts -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h3 class="h5 mb-0">المقالات الشائعة</h3>
            </div>
            <div class="list-group list-group-flush">
                @foreach ($popularBlogs as $pop)
                    <a href="{{ route('blog_details', $pop->slug) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex align-items-center">
                            <img src="{{ $pop->image }}" alt="{{ $pop->title }}"
                                style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; margin-left: 10px;">
                            <div class="flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $pop->title }}</h6>
                                    <small>{{ $pop->created_at->diffForHumans() }}</small>
                                </div>
                                <small class="text-muted">{{ $pop->articleType->name ?? '' }}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>


        <!-- Categories -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h3 class="h5 mb-0">التصنيفات</h3>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($categories1 as $cat)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('category.show', ['slug' => $cat->slug]) }}"
                            class="text-decoration-none">{{ $cat->name }}</a>
                        <span class="badge bg-primary rounded-pill">{{ $cat->posts_count ?? $cat->blogs->count() }}</span>
                    </li>
                @endforeach
            </ul>
        </div>



        <!-- Tags -->
        <div class="card mb-4">
            <div class="card-header bg-light">
                <h3 class="h5 mb-0">الوسوم</h3>
            </div>
            <div class="card-body">
                @foreach ($tags as $tag)
                    <a href="{{ route('tags.show', ['slug' => $tag->slug]) }}"
                        class="btn btn-sm btn-outline-secondary mb-2 me-1">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>

        <!-- AdSense Sidebar Ad -->
        <div class="card mb-4">
            <div class="card-body text-center p-3">
                <p class="text-muted small mb-2">إعلان</p>
                <!-- AdSense Ad Code Here -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
                    data-ad-slot="0987654321" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>

        <!-- Newsletter -->
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="h5 mb-0">النشرة البريدية</h3>
            </div>
            <div class="card-body">
                <p>اشترك في نشرتنا البريدية للحصول على أحدث المقالات مباشرة إلى بريدك الإلكتروني.</p>
                <form action="{{ route('subscribe.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="بريدك الإلكتروني" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">اشتراك</button>
                </form>
            </div>
        </div>
    </div>
@endsection
