@section('title', $meta?->title ?? 'المدونة')


@php
    use App\Models\Meta;
    $locale = App::currentLocale();
    $meta = Meta::first();
@endphp

@extends('web.layouts.app')

@section('content')

    @if (isset($q) && $q)
        <div class="alert alert-info text-center mb-4">نتائج البحث عن: <strong>{{ $q }}</strong></div>
    @endif
    <div class="row">


        @if ($blogs && $blogs->count())
            @foreach ($blogs as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $item->image }}" class="card-img-top" alt="{{ $item->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <a href="{{ route('blog_details', $item->slug) }}" class="btn btn-primary">
                                اقرأ المزيد
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-warning text-center">لا توجد مقالات متاحة حالياً.</div>
            </div>
        @endif

        <!-- pagination -->
        <div class="col-md-12 mb-4">
            <nav aria-label="صفحات الأخبار" class="d-flex justify-content-center">
                {{ $blogs->links('pagination::bootstrap-4') }}
            </nav>
        </div>




    </div>
@endsection
