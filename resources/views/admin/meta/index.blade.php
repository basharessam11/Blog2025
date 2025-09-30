@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')



    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">



            <div class="row g-4">

                @include('admin.layout.menu-slider')
                <!-- Options -->
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="tab-content p-0">
                        <!-- Store Details Tab -->
                        <div class="tab-pane fade show active" id="store_details" role="tabpanel">
                            <div class="card mb-4">

                                <div class="card-header">
                                    <h5 class="card-title m-0">{!! __('admin.Meta') !!}</h5>
                                </div>

                                <div class="card-body">
                                    {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


                                    @if (session('success'))
                                        <div id="success-message"
                                            class="alert alert-success alert-dismissible fade show text-center"
                                            role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div id="danger-message"
                                            class="alert alert-danger alert-dismissible fade show text-center"
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

                                    <form action="{{ route('meta.update', 1) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')





                                        <div class="card-header">
                                            <h5 class="card-title m-0">{!! __('admin.About Us') !!}</h5>
                                        </div>

                                        <div class="row mb-3 g-3">


                                            {{-- -------------------------------------------------------------- about_title_ar-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Meta_Title_ar') !!}</label>


                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name" value="{{ $meta->about_title_ar }}"
                                                    placeholder="{!! __('admin.Meta_Title_ar1') !!}" name="about_title_ar"
                                                    aria-label="Product title">

                                                @error('about_title_ar')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end about_title_ar-------------------------------------------------------------------- --}}

                                            {{-- -------------------------------------------------------------- about_title_en-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Meta_Title_en') !!}</label>
                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name" value="{{ $meta->about_title_en }}"
                                                    placeholder="{!! __('admin.Meta_Title_en1') !!}" name="about_title_en"
                                                    aria-label="Product title">



                                                @error('about_title_en')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end about_title_en-------------------------------------------------------------------- --}}





                                            {{-- -------------------------------------------------------------- about_description_ar-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name" value="{{ $meta->about_description_ar }}"
                                                    placeholder="{!! __('admin.Meta_Description_ar1') !!}" name="about_description_ar"
                                                    aria-label="Product title">

                                                @error('about_description_ar')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end about_description_ar-------------------------------------------------------------------- --}}

                                            {{-- -------------------------------------------------------------- about_description_en-------------------------------------------------------------------- --}}
                                            <div class="mb-3">
                                                <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                <input type="text" class="form-control" required
                                                    id="ecommerce-product-name" value="{{ $meta->about_description_en }}"
                                                    placeholder="{!! __('admin.Meta_Description_en1') !!}" name="about_description_en"
                                                    aria-label="Product title">



                                                @error('about_description_en')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror



                                            </div>

                                            {{-- --------------------------------------------------------------end about_description_en-------------------------------------------------------------------- --}}






                                            <div class="card-header">
                                                <h5 class="card-title m-0">{!! __('admin.Privacy Policy') !!}</h5>
                                            </div>

                                            <div class="row mb-3 g-3">


                                                {{-- -------------------------------------------------------------- policies_title_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->policies_title_ar }}"
                                                        placeholder="{!! __('admin.Meta_Title_ar1') !!}" name="policies_title_ar"
                                                        aria-label="Product title">

                                                    @error('policies_title_ar')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end policies_title_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- policies_title_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->policies_title_en }}"
                                                        placeholder="{!! __('admin.Meta_Title_en1') !!}" name="policies_title_en"
                                                        aria-label="Product title">



                                                    @error('policies_title_en')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end policies_title_en-------------------------------------------------------------------- --}}





                                                {{-- -------------------------------------------------------------- policies_description_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->policies_description_ar }}"
                                                        placeholder="{!! __('admin.Meta_Description_ar1') !!}"
                                                        name="policies_description_ar" aria-label="Product title">

                                                    @error('policies_description_ar')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end policies_description_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- policies_description_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->policies_description_en }}"
                                                        placeholder="{!! __('admin.Meta_Description_en1') !!}"
                                                        name="policies_description_en" aria-label="Product title">



                                                    @error('policies_description_en')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end policies_description_en-------------------------------------------------------------------- --}}


                                            </div>



                                            <div class="card-header">
                                                <h5 class="card-title m-0">{!! __('admin.Home') !!}</h5>
                                            </div>

                                            <div class="row mb-3 g-3">


                                                {{-- -------------------------------------------------------------- index_title_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->index_title_ar }}"
                                                        placeholder="{!! __('admin.Meta_Title_ar1') !!}" name="index_title_ar"
                                                        aria-label="Product title">

                                                    @error('index_title_ar')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end index_title_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- index_title_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->index_title_en }}"
                                                        placeholder="{!! __('admin.Meta_Title_en1') !!}" name="index_title_en"
                                                        aria-label="Product title">



                                                    @error('index_title_en')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end index_title_en-------------------------------------------------------------------- --}}





                                                {{-- -------------------------------------------------------------- index_description_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->index_description_ar }}"
                                                        placeholder="{!! __('admin.Meta_Description_ar1') !!}" name="index_description_ar"
                                                        aria-label="Product title">

                                                    @error('index_description_ar')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end index_description_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- index_description_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->index_description_en }}"
                                                        placeholder="{!! __('admin.Meta_Description_en1') !!}" name="index_description_en"
                                                        aria-label="Product title">



                                                    @error('index_description_en')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end index_description_en-------------------------------------------------------------------- --}}


                                            </div>



                                            <div class="card-header">
                                                <h5 class="card-title m-0">{!! __('admin.Online Sessions') !!}</h5>
                                            </div>

                                            <div class="row mb-3 g-3">


                                                {{-- -------------------------------------------------------------- courses_title_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->courses_title_ar }}"
                                                        placeholder="{!! __('admin.Meta_Title_ar1') !!}" name="courses_title_ar"
                                                        aria-label="Product title">

                                                    @error('courses_title_ar')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end courses_title_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- courses_title_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->courses_title_en }}"
                                                        placeholder="{!! __('admin.Meta_Title_en1') !!}" name="courses_title_en"
                                                        aria-label="Product title">



                                                    @error('courses_title_en')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end courses_title_en-------------------------------------------------------------------- --}}





                                                {{-- -------------------------------------------------------------- courses_description_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->courses_description_ar }}"
                                                        placeholder="{!! __('admin.Meta_Description_ar1') !!}"
                                                        name="courses_description_ar" aria-label="Product title">

                                                    @error('courses_description_ar')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end courses_description_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- courses_description_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->courses_description_en }}"
                                                        placeholder="{!! __('admin.Meta_Description_en1') !!}"
                                                        name="courses_description_en" aria-label="Product title">



                                                    @error('courses_description_en')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end courses_description_en-------------------------------------------------------------------- --}}






                                            </div>

                                            <div class="card-header">
                                                <h5 class="card-title m-0">{!! __('admin.Blogs') !!}</h5>
                                            </div>

                                            <div class="row mb-3 g-3">


                                                {{-- -------------------------------------------------------------- blog_title_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->blog_title_ar }}"
                                                        placeholder="{!! __('admin.Meta_Title_ar1') !!}" name="blog_title_ar"
                                                        aria-label="Product title">

                                                    @error('blog_title_ar')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}
                                                        </div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end blog_title_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- blog_title_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->blog_title_en }}"
                                                        placeholder="{!! __('admin.Meta_Title_en1') !!}" name="blog_title_en"
                                                        aria-label="Product title">



                                                    @error('blog_title_en')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}
                                                        </div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end blog_title_en-------------------------------------------------------------------- --}}





                                                {{-- -------------------------------------------------------------- blog_description_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->blog_description_ar }}"
                                                        placeholder="{!! __('admin.Meta_Description_ar1') !!}" name="blog_description_ar"
                                                        aria-label="Product title">

                                                    @error('blog_description_ar')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}
                                                        </div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end blog_description_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- blog_description_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->blog_description_en }}"
                                                        placeholder="{!! __('admin.Meta_Description_en1') !!}" name="blog_description_en"
                                                        aria-label="Product title">



                                                    @error('blog_description_en')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}
                                                        </div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end blog_description_en-------------------------------------------------------------------- --}}




                                            </div>





                                            <div class="card-header">
                                                <h5 class="card-title m-0">{!! __('admin.Login') !!}</h5>
                                            </div>

                                            <div class="row mb-3 g-3">


                                                {{-- -------------------------------------------------------------- login_title_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->login_title_ar }}"
                                                        placeholder="{!! __('admin.Meta_Title_ar1') !!}" name="login_title_ar"
                                                        aria-label="Product title">

                                                    @error('login_title_ar')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}
                                                        </div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end login_title_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- login_title_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->login_title_en }}"
                                                        placeholder="{!! __('admin.Meta_Title_en1') !!}" name="login_title_en"
                                                        aria-label="Product title">



                                                    @error('login_title_en')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}
                                                        </div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end login_title_en-------------------------------------------------------------------- --}}





                                                {{-- -------------------------------------------------------------- login_description_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->login_description_ar }}"
                                                        placeholder="{!! __('admin.Meta_Description_ar1') !!}" name="login_description_ar"
                                                        aria-label="Product title">

                                                    @error('login_description_ar')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}
                                                        </div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end login_description_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- login_description_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->login_description_en }}"
                                                        placeholder="{!! __('admin.Meta_Description_en1') !!}" name="login_description_en"
                                                        aria-label="Product title">



                                                    @error('login_description_en')
                                                        <br>
                                                        <div class="alert alert-danger">{{ $message }}
                                                        </div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end login_description_en-------------------------------------------------------------------- --}}






                                            </div>




                                            <div class="card-header">
                                                <h5 class="card-title m-0">{!! __('admin.Register') !!}
                                                </h5>
                                            </div>

                                            <div class="row mb-3 g-3">


                                                {{-- -------------------------------------------------------------- registr_title_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->registr_title_ar }}"
                                                        placeholder="{!! __('admin.Meta_Title_ar1') !!}" name="registr_title_ar"
                                                        aria-label="Product title">

                                                    @error('registr_title_ar')
                                                        <br>
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end registr_title_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- registr_title_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->registr_title_en }}"
                                                        placeholder="{!! __('admin.Meta_Title_en1') !!}" name="registr_title_en"
                                                        aria-label="Product title">



                                                    @error('registr_title_en')
                                                        <br>
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end registr_title_en-------------------------------------------------------------------- --}}





                                                {{-- -------------------------------------------------------------- registr_description_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->registr_description_ar }}"
                                                        placeholder="{!! __('admin.Meta_Description_ar1') !!}"
                                                        name="registr_description_ar" aria-label="Product title">

                                                    @error('registr_description_ar')
                                                        <br>
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end registr_description_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- registr_description_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->registr_description_en }}"
                                                        placeholder="{!! __('admin.Meta_Description_en1') !!}"
                                                        name="registr_description_en" aria-label="Product title">



                                                    @error('registr_description_en')
                                                        <br>
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end registr_description_en-------------------------------------------------------------------- --}}



                                            </div>






                                            <div class="card-header">
                                                <h5 class="card-title m-0">{!! __('admin.Teachers') !!}
                                                </h5>
                                            </div>

                                            <div class="row mb-3 g-3">


                                                {{-- -------------------------------------------------------------- teacher_title_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->teacher_title_ar }}"
                                                        placeholder="{!! __('admin.Meta_Title_ar1') !!}" name="teacher_title_ar"
                                                        aria-label="Product title">

                                                    @error('teacher_title_ar')
                                                        <br>
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end teacher_title_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- teacher_title_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Title_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name" value="{{ $meta->teacher_title_en }}"
                                                        placeholder="{!! __('admin.Meta_Title_en1') !!}" name="teacher_title_en"
                                                        aria-label="Product title">



                                                    @error('teacher_title_en')
                                                        <br>
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end teacher_title_en-------------------------------------------------------------------- --}}





                                                {{-- -------------------------------------------------------------- teacher_description_ar-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->teacher_description_ar }}"
                                                        placeholder="{!! __('admin.Meta_Description_ar1') !!}"
                                                        name="teacher_description_ar" aria-label="Product title">

                                                    @error('teacher_description_ar')
                                                        <br>
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end teacher_description_ar-------------------------------------------------------------------- --}}

                                                {{-- -------------------------------------------------------------- teacher_description_en-------------------------------------------------------------------- --}}
                                                <div class="mb-3">
                                                    <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                    <input type="text" class="form-control" required
                                                        id="ecommerce-product-name"
                                                        value="{{ $meta->teacher_description_en }}"
                                                        placeholder="{!! __('admin.Meta_Description_en1') !!}"
                                                        name="teacher_description_en" aria-label="Product title">



                                                    @error('teacher_description_en')
                                                        <br>
                                                        <div class="alert alert-danger">
                                                            {{ $message }}</div>
                                                    @enderror



                                                </div>

                                                {{-- --------------------------------------------------------------end teacher_description_en-------------------------------------------------------------------- --}}







                                            </div>
                                            <div class="d-flex justify-content-end gap-3">
                                                <button type="submit"
                                                    class="btn btn-primary">{!! __('admin.Submit') !!}</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Options -->

            </div>
        </div>
    </div>
    <!-- /Content wrapper -->






@endsection

@section('footer')

    <!-- Page JS -->
    <script src="{{ asset('admin') }}/js/app-ecommerce-settings.js"></script>

@endsection
