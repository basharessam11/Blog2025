@extends('admin.layout.app')

@section('page', 'Create Product')


@section('contant')








    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}




    {{-- @dd($errors) --}}
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">



            <form action="{{ route('blog_category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="app-ecommerce">

                    <!-- Add Product -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">




                    </div>

                    <div class="row">

                        <!-- First column-->
                        <div class="col-12 col-lg-12">
                            <!-- Product Information -->
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">{!! __('admin.Add Blog Categore') !!}</h5>
                                </div>
                                <div class="card-body">

                                    {{-- -------------------------------------------------------------- title_ar-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Title_ar') !!} </label>
                                        <input type="text" class="form-control" required id="ecommerce-product-name"
                                            value="{{ old('title_ar') }}" placeholder="{!! __('admin.Title_ar1') !!}"
                                            name="title_ar" aria-label="Product title">




                                        @error('title_ar')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end title_ar-------------------------------------------------------------------- --}}

                                    {{-- -------------------------------------------------------------- title_en-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Title_en') !!}</label>
                                        <input type="text" class="form-control" required id="ecommerce-product-name"
                                            value="{{ old('title_en') }}" placeholder="{!! __('admin.Title_en1') !!}"
                                            name="title_en" aria-label="Product title">




                                        @error('title_en')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>

                                    {{-- --------------------------------------------------------------end title_en-------------------------------------------------------------------- --}}



                                    {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}


                                    <br>
                                    <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}</button>
                                </div>





                            </div>


            </form>
        </div>



        <!-- /Organize Card -->
    </div>
    <!-- /Second column -->
    </div>
    </div>
    </div>
    <!-- / Content -->



    </form>












@endsection

@section('footer')
    <script src="{{ asset('admin') }}/js/app-ecommerce-product-add.js"></script>


@endsection
