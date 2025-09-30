@php
    use App\Models\Setting;
    use App\Models\Meta;
    $locale = App::currentLocale();
    $settings = Setting::find(1);

@endphp
@extends('web.layouts.app')



@section('content')
<br>
<br>
<br>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="error-box">
            <div class="error-logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('images/' . ($settings->photo ?? 'no-image.png')) }}" class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="error-box-img">
                <img src="{{ asset('web') }}/build/img/error-01.png" alt="" class="img-fluid">
            </div>
            <h3 class="h2 mb-3"> {!! __('web.Error 404 : page not found') !!}</h3>
            <p class="h4 font-weight-normal">{!! __(
                'web.The page you are looking for might have been removed had its name changed or is temporarily unavailable.',
            ) !!}</p>
            <a href="{{ route('index') }}" class="btn btn-primary">{{ __('web.Go To Home') }}</a>
        </div>
    </div>
    <!-- /Main Wrapper -->
@endsection
