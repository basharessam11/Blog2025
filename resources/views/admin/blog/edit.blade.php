@extends('admin.layout.app')

@section('page', 'Edit blog')

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

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <form action="{{ route('blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="app-ecommerce">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-tile mb-0">{!! __('admin.Edit Blogs') !!}</h5>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        {{-- العنوان --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{!! __('admin.Title') !!}</label>
                                            <input type="text" class="form-control" required
                                                value="{{ old('title', $blog->title) }}"
                                                placeholder="{!! __('admin.Title') !!}" name="title">
                                            @error('title')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- التصنيف --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">التصنيف</label>
                                            <select class="select2 form-select" name="article_type_id" required>
                                                <option value="">اختر التصنيف</option>
                                                @foreach ($articleTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                        {{ old('article_type_id', $blog->article_type_id) == $type->id ? 'selected' : '' }}>
                                                        {{ $type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('article_type_id')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- مصدر المقال --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{!! __('admin.Source Url') !!}</label>
                                            <input type="url" class="form-control" required
                                                value="{{ old('source_url', $blog->source_url) }}"
                                                placeholder="{!! __('admin.Source Url') !!}" name="source_url">
                                            @error('source_url')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- الصورة --}}
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">{!! __('admin.Photo') !!}</label>
                                            <input type="url" class="form-control" required
                                                value="{{ old('image', $blog->image) }}"
                                                placeholder="{!! __('admin.Photo') !!}" name="image">
                                            @error('image')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        {{-- الوصف --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">{!! __('admin.Description') !!}</label>
                                            <textarea id="textarea" class="form-control" name="content" placeholder="اكتب هنا ">{{ old('content', $blog->content) }}</textarea>
                                            @error('content')
                                                <br>
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!}</button>
                                </div> <!-- card-body -->
                            </div> <!-- card -->
                        </div> <!-- col -->
                    </div> <!-- row -->

                </div> <!-- app-ecommerce -->
            </form>
        </div>
    </div>
    <!-- / Content -->
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            var $e = $("#ecommerce-product-tags");
            if ($e.length) {
                new Tagify($e[0]);
            }
            var $e1 = $("#ecommerce-product-tags1");
            if ($e1.length) {
                new Tagify($e1[0]);
            }
        });
    </script>
@endsection
