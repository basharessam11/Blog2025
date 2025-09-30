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
                    <h1 class="mb-0">Terms & Conditions
                    </h1>
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
                            <p>{!! $terms->description_en !!}</p>
                        @else
                            <p>{!! $terms->description_ar !!}</p>
                        @endif


                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Help Details -->
@endsection
