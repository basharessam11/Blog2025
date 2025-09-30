@php
    $locale = App::currentLocale();
@endphp
@extends('web.layouts.app')



@section('content')
    <!-- Breadcrumb -->
    <div class="page-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h1 class="mb-0">Privacy Policy</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Help Details -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="terms-content">

                        @if (App::isLocale('en'))
                            <p>{!! $policy->description_en !!}</p>
                        @else
                            <p>{!! $policy->description_ar !!}</p>
                        @endif


                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Help Details -->
@endsection
