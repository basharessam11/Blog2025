@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">المقالات المرتبطة بالتاج: {{ $tag->name }}</h1>
        <div class="row">
            @foreach ($posts as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ $item->image }}" class="card-img-top" alt="صورة الخبر">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <a href="{{ route('btolat.news.show', ['slug' => $item->slug]) }}" class="btn btn-primary">اقرأ
                                المزيد</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
