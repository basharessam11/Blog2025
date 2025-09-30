@extends('admin.layout.app')

@section('page', 'Order List')

@section('contant')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row g-4">
                <!-- Options -->
                <div class="col-12 col-lg-12 pt-4 pt-lg-0">
                    <div class="tab-content p-0">
                        <!-- Store Details Tab -->
                        <div class="tab-pane fade show active" id="store_details" role="tabpanel">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{!! __('admin.Add User') !!}</h5>
                                </div>
                                <div class="card-body">

                                    {{-- --------------------------- Alerts --------------------------- --}}
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
                                    {{-- ------------------------- End Alerts ------------------------- --}}

                                    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row g-3">
                                            <!-- Arabic & English Names -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Name_ar') !!}</label>
                                                <input type="text" class="form-control" name="name_ar"
                                                    value="{{ old('name_ar') }}" placeholder="{!! __('admin.Name_ar1') !!}"
                                                    required>
                                                @error('name_ar')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Name_en') !!}</label>
                                                <input type="text" class="form-control" name="name_en"
                                                    value="{{ old('name_en') }}" placeholder="{!! __('admin.Name_en1') !!}"
                                                    required>
                                                @error('name_en')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Meta Descriptions -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Meta_Description_ar') !!}</label>
                                                <input type="text" class="form-control" name="meta_description_ar"
                                                    value="{{ old('meta_description_ar') }}"
                                                    placeholder="{!! __('admin.Meta_Description_ar1') !!}" required>
                                                @error('meta_description_ar')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Meta_Description_en') !!}</label>
                                                <input type="text" class="form-control" name="meta_description_en"
                                                    value="{{ old('meta_description_en') }}"
                                                    placeholder="{!! __('admin.Meta_Description_en1') !!}" required>
                                                @error('meta_description_en')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Phone & Country -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Phone') !!}</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ old('phone') }}" placeholder="{!! __('admin.Phone') !!}"
                                                    required>
                                                @error('phone')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Country') !!}</label>
                                                <select name="country_id" class="form-select select2" required>
                                                    <option value="" disabled selected>Select Country</option>
                                                    @foreach ($country as $c)
                                                        <option value="{{ $c->id }}"
                                                            {{ $c->id == 1 ? 'selected' : '' }}>
                                                            {{ $c->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('country_id')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Specialty & Role -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Category') !!}</label>
                                                <select name="specialty" class="form-select select2">
                                                    <option value="Full-stack" selected>Full-stack</option>
                                                    <option value="Back-end">Back-end</option>
                                                    <option value="Front-end">Front-end</option>
                                                    <option value="Call Center">Call Center</option>
                                                    <option value="Marketing">Marketing</option>
                                                </select>
                                                @error('specialty')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Roles') !!}</label>
                                                <select name="role" class="form-select select2">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Email & Password -->
                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Email') !!}</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}" placeholder="johndoe@gmail.com" required>
                                                @error('email')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">{!! __('admin.Password') !!}</label>
                                                <input type="text" class="form-control" name="password" value="12345678"
                                                    placeholder="Enter a new password" required>
                                            </div>

                                            {{-- Status --}}
                                            <div class="col-md-12">
                                                <label class="form-label">{{ __('admin.Status') }}</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="1">نشط</option>
                                                    <option value="0">غير نشط</option>

                                                </select>
                                            </div>

                                            <!-- Photo -->
                                            <div class="col-12">
                                                <label class="form-label">{!! __('admin.Photo') !!}</label>
                                                <input type="file" class="form-control" name="photo">
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
                <!-- /Options -->
            </div>
        </div>
    </div>
    <!-- /Content wrapper -->

@endsection

@section('footer')
    <!-- Page JS -->
    <script src="{{ asset('admin/js/app-ecommerce-settings.js') }}"></script>
@endsection
