@extends('admin.layout.app')

@section('page', 'Edit Role')

@section('contant')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <form action="{{ route('roles.update', $role->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="app-ecommerce">
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                        @if (session('success'))
                            <div id="success-message" class="alert alert-success alert-dismissible fade show text-center"
                                role="alert">
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
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card mb-12">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{!! __('admin.Edit Role') !!}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">{!! __('admin.Name') !!}</label>
                                        <input type="text" class="form-control" required
                                            value="{{ old('name', $role->name) }}" name="name" aria-label="Role name">
                                        @error('name')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <table class="table table-flush-spacing mb-0 border-top">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-medium text-heading">Administrator Access</td>
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
                                            @foreach ($groupedPermissions as $group)
                                                <tr>
                                                    <td class="text-nowrap fw-medium text-heading">
                                                        {{ ucfirst($group['module']) }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end">
                                                            @foreach (['view', 'create', 'edit', 'delete'] as $action)
                                                                <div class="form-check mb-0 me-3 me-lg-12">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="permissions[]"
                                                                        value="{{ $group['actions'][$action] ?? '' }}"
                                                                        {{ isset($group['actions'][$action]) && in_array($group['actions'][$action], $rolePermissions) ? 'checked' : '' }}
                                                                        {{ isset($group['actions'][$action]) ? '' : 'disabled' }}>
                                                                    <label
                                                                        class="form-check-label">{{ ucfirst($action) }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br><br>
                                    <button type="submit" class="btn btn-primary">{!! __('admin.Submit') !!} </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectAllCheckbox = document.getElementById("selectAll");
            const allCheckboxes = document.querySelectorAll(".form-check-input:not(#selectAll)");

            selectAllCheckbox.addEventListener("change", function() {
                allCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

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
