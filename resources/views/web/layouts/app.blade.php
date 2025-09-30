@php
    use App\Models\Setting;
    use App\Models\Meta;
    use App\Models\Visit;
    use Illuminate\Support\Facades\Http;
    use App\Models\Countries;
    $locale = App::currentLocale();
    $settings = Setting::find(1);
    $page = Route::currentRouteName();
    $meta = Meta::first();

    $metaData = $meta->getMeta($page, $locale);

    $ip_address = request()->ip();
    // dd( $ip_address);
    // $ip_address = '135.220.200.174';

    // احصل على بيانات الدولة من API تحديد الموقع الجغرافي
    $response = Http::get("https://ipwhois.app/json/{$ip_address}");
    // dd($response->json('country'));
    $country_code = strtolower($response->json('country_code')); // مثل "US" أو "EG"

    // البحث عن الدولة في جدول countries
    $country = Countries::where('code', $country_code)->first();
    $country_id = $country ? $country->id : 1; // إذا لم يتم العثور على الدولة، اجعلها null

    $visit = Visit::where('ip_address', $ip_address)->first();
    if ($page == 'blog_details' && isset($blog)) {
        $blog->increment('views');
    }
    if ($visit) {
        $visit->increment('visit_count');
        $visit->update(['country_id' => $country_id]);
    } else {
        $referer = request()->headers->get('referer');
        Visit::create([
            'referer' => $referer,
            'ip_address' => $ip_address,
            'visit_count' => 1,
            'country_id' => $country_id,
        ]);
    }
    $logo = asset('images/' . ($settings->photo ? $settings->photo : 'no-image.png'));
@endphp


<!DOCTYPE html>
<html lang="{{ $locale }}" @if (App::isLocale('ar')) {{ 'dir=rtl' }}  @else {{ 'dir=ltr' }} @endif>
{{-- <html> --}}


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>




    <!-- تعريف الترميز -->
    <meta charset="UTF-8">

    <!-- متوافق مع الأجهزة المحمولة -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">



    <!-- الكلمات المفتاحية (لم تعد مؤثرة بشكل كبير في جوجل) -->


    {{-- ########################################################blog_details####################################################################### --}}

    @if (($page == 'blog_details' && isset($blog)) || ($page == 'btolat.news.show' && isset($blog)))
        @php

            if (App::isLocale('en')) {
                $tags = json_decode($blog->tags, true);
            } else {
                $tags = json_decode($blog->tags, true);
            }

        @endphp



        <meta name="keywords" content="@foreach ($tags as $tag){{ $tag['name'] . ',' }} @endforeach">

        <!-- العنوان الذي يظهر في نتائج البحث -->
        <title>{{ $settings->name }} - {{ $blog->title }}
        </title>
        <!-- وصف الصفحة (يظهر في نتائج البحث) -->
        @php
            // تنظيف الشرح من الأكواد والمسافات أولاً
            $desc = $blog->content;
            $desc = strip_tags($desc);
            $desc = preg_replace('/\s+/', ' ', $desc);
            $desc = trim($desc);
            // ثم استخراج أول سطر نظيف
            $descFirstLine = strtok($desc, ".\n");
        @endphp

        <link rel="icon" type="image/png" sizes="32x32"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="shortcut icon"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">


        <meta name="dindexescription" content="{{ $descFirstLine }}">
        <!-- اسم الكاتب -->

        <!-- السماح أو منع محركات البحث من الأرشفة -->
        <meta name="robots" content="index, follow">
        <!-- تحسين بيانات المدونات -->
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ $blog->title }}">
        <meta property="og:description" content="{{ $descFirstLine }}">
        <meta property="og:image" content="{{ $blog->image }}">
        <meta property="og:site_name" content="{{ $settings->name }}">

        <!-- تحسين بيانات تويتر -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $blog->title }}">
        <meta name="twitter:description" content="{{ $descFirstLine }}">
        <meta name="twitter:image" content="{{ $blog->image }}">
        <meta name="twitter:site" content="{{ $settings->name }}">

        {{-- ########################################################end blog_details####################################################################### --}}


        {{-- ########################################################category####################################################################### --}}
    @elseif ($page == 'category.show' && isset($categories))
        <!-- العنوان الذي يظهر في نتائج البحث -->
        <title>{{ $settings->name }} - {{ $category->name }}
        </title>


        <link rel="icon" type="image/png" sizes="32x32"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="shortcut icon"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">


        <meta name="dindexescription" content="{{ $metaData['description'] }}">
        <!-- اسم الكاتب -->

        <!-- السماح أو منع محركات البحث من الأرشفة -->
        <meta name="robots" content="index, follow">
        <!-- تحسين بيانات المدونات -->
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ $category->name }}">
        <meta property="og:description" content="{{ $metaData['description'] }}">
        <meta property="og:image"
            content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <meta property="og:site_name" content="{{ $settings->name }}">

        <!-- تحسين بيانات تويتر -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $category->name }}">
        <meta name="twitter:description" content="{{ $metaData['description'] }}">
        <meta name="twitter:image"
            content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <meta name="twitter:site" content="{{ $settings->name }}">


        {{-- #######################################################end category######################################################################## --}}

        {{-- ########################################################tag####################################################################### --}}
    @elseif ($page == 'tags.show' && isset($tag))
        <!-- العنوان الذي يظهر في نتائج البحث -->
        <title>{{ $settings->name }} - {{ $tag->name }}
        </title>


        <link rel="icon" type="image/png" sizes="32x32"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="shortcut icon"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">


        <meta name="dindexescription" content="{{ $metaData['description'] }}">
        <!-- اسم الكاتب -->

        <!-- السماح أو منع محركات البحث من الأرشفة -->
        <meta name="robots" content="index, follow">
        <!-- تحسين بيانات المدونات -->
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ $tag->name }}">
        <meta property="og:description" content="{{ $metaData['description'] }}">
        <meta property="og:image"
            content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <meta property="og:site_name" content="{{ $settings->name }}">

        <!-- تحسين بيانات تويتر -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $tag->name }}">
        <meta name="twitter:description" content="{{ $metaData['description'] }}">
        <meta name="twitter:image"
            content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <meta name="twitter:site" content="{{ $settings->name }}">


        {{-- #######################################################end tag######################################################################## --}}
    @else
        <meta name="keywords"
            content="صوت الجمهور, اخبار الرياضة, اخبار كرة القدم, الدوري المصري, الدوري الانجليزي, الدوري الاسباني, الدوري الايطالي, دوري ابطال اوروبا, كأس العالم, كأس افريقيا, نتائج المباريات, جدول المباريات, مواعيد المباريات, انتقالات اللاعبين, اهداف المباريات, تحليل المباريات, اخبار المنتخب المصري, اخبار الزمالك, اخبار الاهلي, اخبار ليفربول, اخبار ريال مدريد, اخبار برشلونة, اخبار مانشستر سيتي, اخبار مانشستر يونايتد, اخبار باريس سان جيرمان, اخبار الرياضة العالمية, مدونة رياضية, موقع رياضي" />

        <!-- العنوان الذي يظهر في نتائج البحث -->
        <title>{{ $settings->name }} - {{ $metaData['title'] }} </title>

        <!-- وصف الصفحة (يظهر في نتائج البحث) -->
        <meta name="description" content="{{ $metaData['description'] }}">
        <!-- اسم الكاتب -->
        <meta name="author" content="{{ $settings->name }}">
        <!-- السماح أو منع محركات البحث من الأرشفة -->
        <meta name="robots" content="index, follow">
        <!-- القيم الافتراضية لباقي الصفحات -->
        <meta property="og:site_name" content="{{ $settings->name }}">
        <meta property="og:title" content="{{ $settings->name }} - {{ $metaData['title'] }}">
        <meta property="og:description" content="{{ $metaData['description'] }}">



        <!-- أيقونة الموقع (Favicon) -->
        <link rel="icon" type="image/png" sizes="32x32"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <link rel="shortcut icon"
            href="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

        <meta property="og:image:secure_url"
            content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">

        <meta property="og:image"
            content="{{ asset('images') }}/{{ $settings->photo != null ? $settings->photo : 'no-image.png' }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:type" content="image/jpeg">

        <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "{{ $settings->name }}",
  "url": "{{ url()->current() }}",
  "logo": "{{ asset('images/' . ($settings->photo ? $settings->photo : 'no-image.png')) }}",
  "sameAs": [],
  "description": {!! json_encode($metaData['description']) !!}
}
</script>
    @endif


    <!-- Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('web') }}/css/style.css">

    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXXXXXXXXXXX"
        crossorigin="anonymous"></script>
    <!-- حل مشكلة الباجينيشن في الموبايل -->
    <style>
        .pagination {
            flex-wrap: wrap;
            /* يخلي الأزرار تلف لو المساحة ضيقة */
            justify-content: center;
            /* يخليها في النص */
        }

        .page-item .page-link {
            font-size: 14px;
            padding: 6px 10px;
        }

        @media (max-width: 576px) {
            .page-item .page-link {
                font-size: 13px;
                padding: 5px 8px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('index') }}">{{ $settings->name }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('index') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogs') ? 'active' : '' }}"
                            href="{{ route('blogs') }}">مقالات</a>
                    </li>
                    @foreach ($categories as $cat)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('category.show') && request()->route('slug') == $cat->slug ? 'active' : '' }}"
                                href="{{ route('category.show', ['slug' => $cat->slug]) }}">{{ $cat->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <form class="d-flex" role="search" method="GET" action="{{ route('blogs') }}">
                    <input class="form-control me-2" type="search" name="search" placeholder="ابحث في المدونة..."
                        aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-outline-light" type="submit">بحث</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">


            {{-- ###################################################################content######################################################## --}}


            @yield('content')

            {{-- ###################################################################End content######################################################## --}}
            @if (session('success'))
                <script>
                    $(document).ready(function() {
                        toastr.success("{{ session('success') }}", "نجاح", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 8000,
                            positionClass: "toast-bottom-left",
                        });
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    $(document).ready(function() {
                        toastr.error("{{ session('error') }}", "خطأ", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 8000,
                            positionClass: "toast-bottom-left",
                        });
                    });
                </script>
            @endif

            @if ($errors->any())
                {{-- @dd($errors) --}}
                @foreach ($errors->all() as $error)
                    <script>
                        $(document).ready(function() {
                            toastr.error("{{ $error }}", "خطأ", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 8000,
                                positionClass: "toast-bottom-left",
                            });
                        });
                    </script>
                @endforeach
            @endif


        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="h6 mb-3">عن المدونة</h5>
                    <p>مدونة عربية تقدم محتوى مفيداً في مجال كرة القدم . نسعى دائماً لتقديم الأفضل لزوارنا الكرام.</p>
                    <div class="social-links">
                        <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-4 mb-md-0">
                    <h5 class="h6 mb-3">روابط سريعة</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('index') }}"
                                class="text-white-50 text-decoration-none">الرئيسية</a>
                        </li>

                        <li class="mb-2"><a href="{{ route('blogs') }}"
                                class="text-white-50 text-decoration-none">المقالات</a>
                        </li>
                        <li><a href="{{ route('contact') }}" class="text-white-50 text-decoration-none">اتصل بنا</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 col-6 mb-4 mb-md-0">
                    <h5 class="h6 mb-3">التصنيفات</h5>
                    <ul class="list-unstyled">
                        @foreach ($categories as $cat)
                            <li class="mb-2"><a href="{{ route('category.show', ['slug' => $cat->slug]) }}"
                                    class="text-white-50 text-decoration-none">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="h6 mb-3">اتصل بنا</h5>
                    <p class="mb-2"><i class="bi bi-envelope me-2"></i> {{ $settings->email }}</p>
                    <p class="mb-2"><i class="bi bi-telephone me-2"></i>{{ $settings->phone }}</p>
                    <p class="mb-0"><i class="bi bi-geo-alt me-2"></i> {{ $settings->location }}</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-3 mb-md-0">©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> {{ $settings->name }}. جميع الحقوق محفوظة.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="{{ route('policy') }}" class="text-white-50 text-decoration-none me-3">سياسة
                        الخصوصية</a>
                    <a href="{{ route('terms') }}" class="text-white-50 text-decoration-none">شروط الاستخدام</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="btn btn-primary btn-lg back-to-top" id="backToTop">
        <i class="bi bi-arrow-up"></i>
    </a>
<style>
#adblock-message {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.8);
    color: white;
    font-size: 20px;
    text-align: center;
    padding-top: 20%;
    z-index: 9999;
}
</style>

<div id="adblock-message">
    🚫 تم اكتشاف مانع إعلانات<br>
    رجاءً قم بإيقافه لدعمنا 🙏
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let ad = document.createElement("div");
    ad.className = "adsbox";
    ad.style.height = "1px";
    document.body.appendChild(ad);

    setTimeout(function () {
        if (ad.offsetHeight === 0) {
            document.getElementById("adblock-message").style.display = "block";
        }
        ad.remove();
    }, 100);
});
</script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/main.js"></script>

    <!-- Schema.org markup for Google -->
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "name": "صوت الجمهور",
  "url": "https://aljawdaalmotamayeza.com",
  "description": "مدونة صوت الجمهور تنقل أجواء الملاعب لحظة بلحظة، أخبار الرياضة، نتائج المباريات، التحليلات، وأحدث الانتقالات من الدوريات المصرية والعالمية.",
  "publisher": {
    "@type": "Organization",
    "name": "صوت الجمهور",
    "logo": {
      "@type": "ImageObject",
      "url": "https://aljawdaalmotamayeza.com/images/logo.png"
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://aljawdaalmotamayeza.com"
  },
  "inLanguage": "ar",
  "author": {
    "@type": "Person",
    "name": "فريق صوت الجمهور"
  }
}
</script>

</body>

</html>
