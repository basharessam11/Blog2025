@extends('admin.layout.app')

@section('page', 'Create blog')


@section('contant')








    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif




    {{-- @dd($errors) --}}
    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">



            <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="app-ecommerce">

                    <!-- Add blog -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">




                    </div>

                    <div class="row">

                        <!-- First column-->
                        <div class="col-12 col-lg-12">
                            <!-- blog Information -->
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">{!! __('admin.Add Blogs') !!}</h5>
                                </div>
                                <div class="card-body">


                                        {{-- -------------------------------------------------------------- title_ar-------------------------------------------------------------------- --}}
                                        <div class=" col-md-12 mb-3">
                                            <label class="form-label">{!! __('admin.Title_ar') !!}</label>
                                            <input type="text" class="form-control" required id="ecommerce-blog-name"
                                                value="{{ old('title_ar') }}" placeholder="{!! __('admin.Title_ar1') !!}"
                                                name="title_ar" aria-label="blog title">




                                            @error('title_ar')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end title_ar-------------------------------------------------------------------- --}}

                                        {{-- -------------------------------------------------------------- title_en-------------------------------------------------------------------- --}}
                                        <div class=" col-md-12 mb-3">
                                            <label class="form-label">{!! __('admin.Title_en') !!}</label>
                                            <input type="text" class="form-control" required id="ecommerce-blog-name"
                                                value="{{ old('title_en') }}" placeholder=" {!! __('admin.Title_en1') !!}"
                                                name="title_en" aria-label="blog title">




                                            @error('title_en')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end title_en-------------------------------------------------------------------- --}}





                                        {{-- -------------------------------------------------------------- meta_description_ar-------------------------------------------------------------------- --}}
                                        <div class=" col-md-12 mb-3">
                                            <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>


                                            <input type="text" class="form-control" required id="ecommerce-product-name"
                                                value="{{ old('meta_description_ar') }}"
                                                placeholder="{!! __('admin.Meta_Description_ar1') !!}" name="meta_description_ar"
                                                aria-label="Product title">

                                            @error('meta_description_ar')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end meta_description_ar-------------------------------------------------------------------- --}}

                                        {{-- -------------------------------------------------------------- Meta_Description_en-------------------------------------------------------------------- --}}
                                        <div class=" col-md-12 mb-3">
                                            <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                            <input type="text" class="form-control" required id="ecommerce-product-name"
                                                value="{{ old('meta_description_en') }}"
                                                placeholder="{!! __('admin.Meta_Description_en1') !!}" name="meta_description_en"
                                                aria-label="Product title">



                                            @error('meta_description_en')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror



                                        </div>

                                        {{-- --------------------------------------------------------------end Meta_Description_en-------------------------------------------------------------------- --}}


                                        {{-- --------------------------------------------------------------  category-------------------------------------------------------------------- --}}
                                        <div class="mb-3 col ecommerce-select2-dropdown">
                                            <label class="form-label">{!! __('admin.Blog Categores') !!}</label>
                                            <select id="category-org" required class="select2 form-select"
                                                name="category_id" data-placeholder="Select category">
                                                <option selected value="">select</option>
                                                @foreach ($categorys as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->title_ar }}</option>
                                                @endforeach


                                            </select>

                                            @error('category_id')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        {{-- --------------------------------------------------------------end category-------------------------------------------------------------------- --}}








                                    <div class="row g-6">
                                        {{-- --------------------------------------------------------------  Item-------------------------------------------------------------------- --}}
                                        <div>
                                            <br>
                                            <label class="form-label">{!! __('admin.Description') !!} </label>

                                            <div class="row" id="row_item">




                                            </div>


                                            @error('Item')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <input class="btn btn-primary" onclick="additem()"
                                                value="{!! __('admin.Add Another Description') !!}">


                                        </div>





                                        <script>
                                            additem()

                                            function additem() {

                                                var item = ` <div class="  option-row1 row">
<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Title_ar') !!}</label>
<input required type="text" id="form-repeater "   name="title_ar1[]" class="form-control" placeholder="Enter  " />
</div>


<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Description_ar') !!}</label>
<textarea class=" form-control" name="description_ar1[]" placeholder="اكتب هنا ">{{ old('description_ar1') }}</textarea>
</div>


<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Title_en') !!}</label>
<input required type="text" id="form-repeater "   name="title_en1[]" class="form-control" placeholder="Enter  " />
</div>


<div class="mb-3 col-5 ">
<label class="form-label">{!! __('admin.Description_en') !!}</label>
<textarea class=" form-control" name="description_en1[]" placeholder="اكتب هنا ">{{ old('description_en1') }}</textarea>
</div>


<div class="mb-3 col-2">
<label class="form-label invisible" for="form-repeater-1-2">Not visible</label>

<button type="button" class="btn btn-danger remove-option1">{!! __('admin.Delete') !!}</button>
</div>
</div>
<hr>
`;

                                                $('#row_item').append(item);

                                            }
                                            $(document).on('click', '.remove-option1', function() {
                                                $(this).closest('.option-row1').remove(); // حذف السطر بالكامل
                                            });
                                        </script>
                                        {{-- --------------------------------------------------------------end item-------------------------------------------------------------------- --}}

                                        <div class="row g-6">


                                            {{-- -------------------------------------------------------------- tag_ar-------------------------------------------------------------------- --}}

                                            <div class="mb-3"><br>
                                                <label for="ecommerce-product-tags" class="form-label mb-1">Tag ar</label>
                                                <input id="ecommerce-product-tags" class="form-control" name="tag_ar"
                                                    value="{{ old('tag_ar') }}" value=""
                                                    aria-label="Product tag_ar" />

                                                @error('tag_ar')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror


                                            </div>

                                            {{-- --------------------------------------------------------------end tag_ar-------------------------------------------------------------------- --}}
                                            {{-- -------------------------------------------------------------- tag_en-------------------------------------------------------------------- --}}

                                            <div class="mb-3">
                                                <label for="ecommerce-product-tags" class="form-label mb-1">tag en</label>
                                                <input id="ecommerce-product-tags1" class="form-control" name="tag_en"
                                                    value="{{ old('tag_en') }}" value=""
                                                    aria-label="Product tag_en" />

                                                @error('tag_en')
                                                    <br>
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror


                                            </div>

                                            {{-- --------------------------------------------------------------end tag_en-------------------------------------------------------------------- --}}
                                        </div>


                                        {{-- -------------------------------------------------------------- photos-------------------------------------------------------------------- --}}




                                        <div>

                                            <label class="form-label">{!! __('admin.Photo') !!}</label>
                                            <input type="file"   name="photo" onchange="readURL(this);"
                                                value="{{ old('photo') }}" class="file form-control">

                                            @error('photo')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                <br>
                                            @enderror


                                            <br>
                                            <div class="row last">


                                            </div>


                                            {{-- --------------------------------------------------------------end photos-------------------------------------------------------------------- --}}


                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                            <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}
                                            </button>
                                        </div>
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
















@endsection

@section('footer')

    <script>
        $(document).ready(function() {
            // التعامل مع Tagify
            var $e = $("#ecommerce-product-tags");
            if ($e.length) {
                new Tagify($e[0]);
            }
            // التعامل مع Tagify
            var $e = $("#ecommerce-product-tags1");
            if ($e.length) {
                new Tagify($e[0]);
            }
        });
    </script>
@endsection
