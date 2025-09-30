@php
    $locale = App::currentLocale();
@endphp
@extends('web.layouts.app')



@section('content')
    <!-- Page Header -->
    <header class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-3">اتصل بنا</h1>
                    <p class="lead mb-0">نحن هنا لمساعدتك! لا تتردد في التواصل معنا لأي استفسارات أو تعليقات.</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Contact Form -->
                <div class="col-lg-12">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


                            @if (session('success'))
                                <div id="success-message"
                                    class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div id="danger-message" class="alert alert-danger alert-dismissible fade show text-center"
                                    role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif



                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        {{-- @dd($errors) --}}
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{-- --------------------------------------------------------------End Alert-------------------------------------------------------------------- --}}

                            <h2 class="h4 mb-4">أرسل لنا رسالة</h2>
                            <form id="contactForm" action="{{ route('contact.store') }}" method="post">
                                @csrf
                                @method('post') <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">الاسم الكامل <span
                                                class="text-danger">*</span></label>
                                        <input name="name" type="text" class="form-control"
                                            placeholder="{!! __('web.name') !!}">
                                        <div class="invalid-feedback">
                                            يرجى إدخال الاسم الكامل
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">البريد الإلكتروني <span
                                                class="text-danger">*</span></label>
                                        <input name="email" type="text" class="form-control"
                                            placeholder="{!! __('web.email') !!}">
                                        <div class="invalid-feedback">
                                            يرجى إدخال بريد إلكتروني صحيح
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="subject" class="form-label">الموضوع <span
                                                class="text-danger">*</span></label>
                                        <input name="phone" type="text" class="form-control"
                                            placeholder="{!! __('web.phone') !!}">
                                        <div class="invalid-feedback">
                                            يرجى إدخال موضوع الرسالة
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="subject" class="form-label">الموضوع <span
                                                class="text-danger">*</span></label>
                                        <input name="subject" type="text" class="form-control"
                                            placeholder="{!! __('web.subject') !!}">
                                        <div class="invalid-feedback">
                                            يرجى إدخال موضوع الرسالة
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label">الرسالة <span
                                                class="text-danger">*</span></label>
                                        <textarea name="message" class="form-control" placeholder="{!! __('web.message') !!}" rows="4"></textarea>
                                        <div class="invalid-feedback">
                                            يرجى إدخال رسالتك
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="g-recaptcha" data-sitekey="YOUR_RECAPTCHA_SITE_KEY"></div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4">إرسال الرسالة</button>
                                    </div>
                                </div>
                            </form>

                            <!-- Success Message (initially hidden) -->
                            <div id="successMessage" class="alert alert-success mt-4 d-none" role="alert">
                                <h4 class="alert-heading">شكراً لك!</h4>
                                <p>تم استلام رسالتك بنجاح. سنقوم بالرد عليك في أقرب وقت ممكن.</p>
                                <hr>
                                <p class="mb-0">رقم الطلب: <span id="ticketNumber"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
