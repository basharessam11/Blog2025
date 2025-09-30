@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">{{ $news['title'] }}</h1>
                        <div class="card-text">{!! $news['content'] !!}</div>
                        <a href="{{ route('btolat.news.index') }}" class="btn btn-secondary mt-3">رجوع للأخبار</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
