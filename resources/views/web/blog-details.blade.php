@extends('web.layouts.app')

@section('content')
    @php
        use App\Models\Setting;
        $locale = App::currentLocale();
        $settings = Setting::find(1);

        $date = \Carbon\Carbon::parse($blog->created_at);
        $formattedDate = $date->format('M d, Y'); // مثال: May 20, 2022
        $slug = App::isLocale('en') ? $blog->slug_en : $blog->slug_ar;
    @endphp

    {{-- @dd($blog) --}}
    <!-- Main Content Area -->
    <div class="col-lg-8">
        <!-- Featured Post -->
        <div class="card mb-4">
            <img src="{{ $blog->image }}" alt="{{ $blog->title }}">
            <div class="card-body">
                <div class="text-muted mb-2">
                    <i class="bi bi-calendar3 me-1"></i> {{ $date->translatedFormat('d F Y') }}
                    <span class="mx-2">|</span>
                    <i class="bi bi-folder me-1"></i> <a
                        href="{{ route('category.show', ['slug' => $blog->articleType->slug]) }}"
                        class="text-decoration-none">{{ $blog->articleType->name }}</a>
                </div>
                <h1 class="card-title h3">{{ $blog->title }}</h1>
                @php
                    $content = $blog->content;
                    // إزالة أي div يحمل الكلاس atags
                    $content = preg_replace('/<div[^>]*class=["\']?atags["\']?[^>]*>.*?<\/div>/is', '', $content);
                @endphp
                <p class="card-text">{!! $content !!}</p>
                <a href="{{ route('blogs') }}" class="btn btn-secondary mt-3">رجوع للأخبار</a>

            </div>
        </div>




    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- About Card -->
        {{-- <div class="card mb-4">
            <div class="card-body text-center">
                <img src="https://via.placeholder.com/150" class="rounded-circle mb-3" alt="صورة الملف الشخصي"
                    width="100">
                <h2 class="h4 card-title">عن المدونة</h2>
                <p class="card-text">مرحباً بكم في مدونتي، حيث نقدم محتوى عالي الجودة ومفيد في [مجال المدونة]. نتمنى أن
                    تجدوا ما تبحثون عنه.</p>
                <div class="social-links">
                    <a href="#" class="text-decoration-none me-2"><i class="bi bi-facebook fs-4"></i></a>
                    <a href="#" class="text-decoration-none me-2"><i class="bi bi-twitter fs-4"></i></a>
                    <a href="#" class="text-decoration-none me-2"><i class="bi bi-instagram fs-4"></i></a>
                    <a href="#" class="text-decoration-none"><i class="bi bi-youtube fs-4"></i></a>
                </div>
            </div>
        </div> --}}



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
                @foreach ($blog->tags as $tag)
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
