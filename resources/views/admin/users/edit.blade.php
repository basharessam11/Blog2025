@extends('admin.layout.app')

@section('page', 'Order List')

@section('contant')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row g-4">
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active" id="store_details" role="tabpanel">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{!! __('admin.Edit User') !!}</h5>
                                </div>
                                <div class="card-body">

                                    {{-- Alerts --}}
                                    @if (session('success'))
                                        <div id="success-message" class="alert alert-success text-center">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div id="danger-message" class="alert alert-danger text-center">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    {{-- End Alerts --}}

                                    <form action="{{ route('users.update', $id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row g-3">
                                            <!-- Arabic & English Names -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Name_ar') !!}</label>
                                                <input type="text" class="form-control" name="name_ar"
                                                    value="{{ $teachers->name_ar }}" placeholder="{!! __('admin.Name_ar1') !!}"
                                                    required>
                                                @error('name_ar')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Name_en') !!}</label>
                                                <input type="text" class="form-control" name="name_en"
                                                    value="{{ $teachers->name_en }}" placeholder="{!! __('admin.Name_en1') !!}"
                                                    required>
                                                @error('name_en')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Meta Descriptions -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>
                                                <input type="text" class="form-control" name="meta_description_ar"
                                                    value="{{ $teachers->meta_description_ar }}"
                                                    placeholder="{!! __('admin.Meta_Description_ar1') !!}" required>
                                                @error('meta_description_ar')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                <input type="text" class="form-control" name="meta_description_en"
                                                    value="{{ $teachers->meta_description_en }}"
                                                    placeholder="{!! __('admin.Meta_Description_en1') !!}" required>
                                                @error('meta_description_en')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Phone & Country -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Phone') !!}</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ $teachers->phone }}" placeholder="{!! __('admin.Phone') !!}"
                                                    required>
                                                @error('phone')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Country') !!}</label>
                                                <select name="country_id" class="form-select select2" required>
                                                    <option value="" disabled>Select Country</option>
                                                    @foreach ($country as $c)
                                                        <option value="{{ $c->id }}"
                                                            {{ $teachers->country_id == $c->id ? 'selected' : '' }}>
                                                            {{ $c->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('country_id')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Specialty -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Category') !!}</label>
                                                <select name="specialty" class="form-select select2">
                                                    <option value="Full-stack"
                                                        {{ $teachers->specialty == 'Full-stack' ? 'selected' : '' }}>
                                                        Full-stack</option>
                                                    <option value="Back-end"
                                                        {{ $teachers->specialty == 'Back-end' ? 'selected' : '' }}>Back-end
                                                    </option>
                                                    <option value="Front-end"
                                                        {{ $teachers->specialty == 'Front-end' ? 'selected' : '' }}>
                                                        Front-end</option>
                                                    <option value="Call Center"
                                                        {{ $teachers->specialty == 'Call Center' ? 'selected' : '' }}>Call
                                                        Center</option>
                                                    <option value="Marketing"
                                                        {{ $teachers->specialty == 'Marketing' ? 'selected' : '' }}>
                                                        Marketing</option>
                                                </select>
                                            </div>

                                            <!-- Roles -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Roles') !!}</label>
                                                <select name="role" class="form-select select2">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}"
                                                            {{ $teachers->roles->contains('id', $role->id) ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Email & Password -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Email') !!}</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ $teachers->email }}" placeholder="johndoe@gmail.com"
                                                    required>
                                                @error('email')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Password') !!}</label>
                                                <input type="text" class="form-control" name="password"
                                                    placeholder="Enter a new password">
                                            </div>


                                            {{-- Status --}}
                                            <div class="col-md-12">
                                                <label class="form-label">{{ __('admin.Status') }}</label>
                                                <select name="status" class="form-select" required>
                                                    <option {{ $teachers->status == 1 ? 'selected' : '' }} value="1">
                                                        نشط</option>
                                                    <option {{ $teachers->status == 0 ? 'selected' : '' }} value="0">
                                                        غير نشط</option>

                                                </select>
                                            </div>

                                            <!-- Photo -->
                                            <div class="col-12">
                                                <label class="form-label">{!! __('admin.Photo') !!}</label>
                                                <input type="file" class="form-control" name="photo">
                                                <br>
                                                <img src="{{ asset('images/' . ($teachers->photo ?? 'no-image.png')) }}"
                                                    alt="teacher-photo" style="width:120px; height:auto;">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit"
                                                class="btn btn-primary">{!! __('admin.Submit') !!}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="{{ asset('admin/js/app-ecommerce-settings.js') }}"></script>
@endsection
