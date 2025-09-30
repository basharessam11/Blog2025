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



            <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
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
                                    <h5 class="card-tile mb-0">{!! __('admin.Add Roles') !!}</h5>
                                    {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


                                    @if (session('success'))
                                        <br>
                                        <div id="success-message"
                                            class="alert alert-success alert-dismissible fade show text-center"
                                            role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <br>

                                        <div id="danger-message"
                                            class="alert alert-danger alert-dismissible fade show text-center"
                                            role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif



                                    @if ($errors->any())
                                        <br>

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


                                </div>
                                <div class="card-body">








                                    {{-- -------------------------------------------------------------- name-------------------------------------------------------------------- --}}
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Name') !!}</label>
                                        <input type="text" class="form-control" required id="ecommerce-product-name"
                                            value="{{ old('name') }}" placeholder=" {!! __('admin.Name') !!}"
                                            name="name" aria-label="Product title">


                                    </div>

                                    {{-- --------------------------------------------------------------end name-------------------------------------------------------------------- --}}



                                    <table class="table table-flush-spacing mb-0 border-top">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-medium text-heading">Administrator Access <i
                                                        class="icon-base bx bx-info-circle" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        aria-label="Allows a full access to the system"
                                                        data-bs-original-title="Allows a full access to the system"></i>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check mb-0">
                                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                                            <label class="form-check-label" for="selectAll"> Select All
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                            @php
                                                // تجميع الأذونات حسب الصفحة (مثل booking, meeting, contact, ...)
                                                $groupedPermissions = [];

                                                foreach ($permissions as $permission) {
                                                    $parts = explode(' ', $permission->name); // تقسيم الاسم إلى أجزاء
                                                    $action = array_shift($parts); // أول جزء (view, create, edit, delete)
                                                    $module = implode(' ', $parts); // باقي الاسم (مثل booking, meeting)

                                                    if (!isset($groupedPermissions[$module])) {
                                                        $groupedPermissions[$module] = [
                                                            'module' => $module,
                                                            'actions' => [],
                                                        ];
                                                    }

                                                    $groupedPermissions[$module]['actions'][$action] =
                                                        $permission->name;
                                                }
                                            @endphp



                                            @foreach ($groupedPermissions as $group)
                                                <tr>
                                                    <td class="text-nowrap fw-medium text-heading">
                                                        {{ ucfirst($group['module']) }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end">
                                                            <div class="form-check mb-0 me-3 me-lg-12">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permissions[]"
                                                                    value="{{ $group['actions']['view'] ?? '' }}"
                                                                    {{ isset($group['actions']['view']) ? '' : 'disabled' }}>
                                                                <label class="form-check-label">
                                                                    view
                                                                </label>
                                                            </div>
                                                            <div class="form-check mb-0 me-3 me-lg-12">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permissions[]"
                                                                    value="{{ $group['actions']['create'] ?? '' }}"
                                                                    {{ isset($group['actions']['create']) ? '' : 'disabled' }}>
                                                                <label class="form-check-label">
                                                                    Create </label>
                                                            </div>
                                                            <div class="form-check mb-0 me-3 me-lg-12">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permissions[]"
                                                                    value="{{ $group['actions']['edit'] ?? '' }}"
                                                                    {{ isset($group['actions']['edit']) ? '' : 'disabled' }}>
                                                                <label class="form-check-label">
                                                                    Edit
                                                                </label>
                                                            </div>

                                                            <div class="form-check mb-0 me-3 me-lg-12">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="permissions[]"
                                                                    value="{{ $group['actions']['delete'] ?? '' }}"
                                                                    {{ isset($group['actions']['delete']) ? '' : 'disabled' }}>
                                                                <label class="form-check-label">
                                                                    Delete </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>
                                    <br>
                                    <br>

                                    <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!} </button>
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

    <!-- Page JS -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectAllCheckbox = document.getElementById("selectAll");
            const allCheckboxes = document.querySelectorAll(".form-check-input:not(#selectAll)");

            selectAllCheckbox.addEventListener("change", function() {
                allCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            // تحديث "Select All" إذا تم إلغاء تحديد أحد العناصر
            allCheckboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    if (!checkbox.checked) {
                        selectAllCheckbox.checked = false;
                    } else if ([...allCheckboxes].every(chk => chk.checked)) {
                        selectAllCheckbox.checked = true;
                    }
                });
            });
        });
    </script>

@endsection
