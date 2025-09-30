@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')
    @php
        use Carbon\Carbon;
        use App\Models\Visit;
        use Illuminate\Support\Facades\DB;

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // استخدام COALESCE لاختيار updated_at إذا كان موجودًا، وإلا يستخدم created_at
        $todayCount = Visit::whereDate(DB::raw('COALESCE( created_at)'), $today)->sum('visit_count');
        $yesterdayCount = Visit::whereDate(DB::raw('COALESCE( created_at)'), $yesterday)->sum('visit_count');

        // حساب زيارات الشهر الحالي
        $monthlyCount = Visit::whereMonth(DB::raw('COALESCE( created_at)'), $currentMonth)
            ->whereYear(DB::raw('COALESCE( created_at)'), $currentYear)
            ->sum('visit_count');

        // حساب زيارات السنة الحالية
        $yearlyCount = Visit::whereYear(DB::raw('COALESCE( created_at)'), $currentYear)->sum('visit_count');
    @endphp




    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">



            <h4 class="py-3 mb-4">
                {{ __('admin.Visits') }}
            </h4>

            <!-- Order List Widget -->

            <div class="card mb-4">
                <div class="card-widget-separator-wrapper">
                    <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h3 class="mb-2">{{ $todayCount }}</h3>
                                        <p class="mb-0"> {!! __('admin.Today') !!}</p>
                                    </div>
                                    <div class="avatar me-sm-4">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-calendar bx-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-4">
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h3 class="mb-2">{{ $yesterdayCount }}</h3>
                                        <p class="mb-0">{!! __('admin.Yesterday') !!}</p>
                                    </div>
                                    <div class="avatar me-lg-4">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-check-double bx-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none">
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h3 class="mb-2">{{ $monthlyCount }}</h3>
                                        <p class="mb-0">{!! __('admin.Monthly') !!}</p>
                                    </div>
                                    <div class="avatar me-lg-4">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-calendar bx-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none">
                            </div>

                            <div class="col-sm-6 col-lg-3">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h3 class="mb-2">{{ $yearlyCount }}</h3>
                                        <p class="mb-0">{!! __('admin.Year') !!}</p>
                                    </div>
                                    <div class="avatar me-lg-4">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="bx bx-check-double bx-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none">
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- customers List Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"> {!! __('admin.Visits') !!}</h5>

                    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">


                        {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


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
                                    {{-- @dd($errors) --}}
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- --------------------------------------------------------------End Alert-------------------------------------------------------------------- --}}


                    </div>


                </div>

                <div class="card-datatable table-responsive">

                    <div id="products-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="card-header d-flex border-top rounded-0 flex-wrap py-md-0">


                            {{-- -------------------------------------------------------------- Filter-------------------------------------------------------------------- --}}



                            <form method="GET" action="{{ route('visit.index') }}">
                                <div class="row g-2 mb-4"> <!-- أضف g-2 لزيادة المسافات -->


                                    <!-- التاريخ من -->
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <label class="form-label">من</label>
                                        <input type="date" name="from_date" value="{{ request('from_date') }}"
                                            class="form-control">
                                    </div>

                                    <!-- التاريخ إلى -->
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <label class="form-label">إلى</label>
                                        <input type="date" name="to_date" value="{{ request('to_date') }}"
                                            class="form-control">
                                    </div>

                                    <!-- زر البحث -->
                                    <div class="col-12 col-md-6 col-lg-4 d-flex align-items-end">
                                        <button type="submit"
                                            class="btn btn-primary w-100 mt-4">{!! __('admin.Submit') !!}</button>
                                    </div>

                                </div>
                            </form>

                            {{-- --------------------------------------------------------------End Filter-------------------------------------------------------------------- --}}







                            {{-- --------------------------------------------------------------End button-------------------------------------------------------------------- --}}



                            <div class="d-flex justify-content-start justify-content-md-end align-items-baseline">
                                <div
                                    class="dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0">

                                    <div class="dt-buttons btn-group flex-wrap"> <button
                                            class="btn btn-secondary add-new btn-danger de me-3" tabindex="0"
                                            aria-controls="products-table" type="button" data-bs-toggle="modal"
                                            data-bs-target="#basicModal2" style="display:none"><span><i
                                                    class="bx bx-trash"></i><span class="d-none d-sm-inline-block">حذف
                                                </span></span></button>




                                    </div>
                                </div>
                            </div>
                            {{-- --------------------------------------------------------------End button-------------------------------------------------------------------- --}}


                        </div>


                    </div>

                </div>







<style>
    /* عشان يخلي النصوص الطويلة تنزل تحت بعض */
    table.dataTable td {
        white-space: normal !important;
        word-wrap: break-word;
    }

    /* تأكد إن الأعمدة كلها مرنة وتاخد مساحة طبيعية */
    table.dataTable {
        table-layout: auto !important;
        width: 100% !important;
    }

    /* عرض الأعمدة يتكيف مع المحتوى */
    table.dataTable td,
    table.dataTable th {
        max-width: 300px; /* تقدر تتحكم في العرض الأقصى */
    }
</style>




                <div class="card-datatable table-responsive">
                    <table id="products-table" class="datatables-products table border-top dataTable no-footer dtr-column">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th class="text-nowrap">{{ __('admin.ip Address') }}</th>
                                <th>{{ __('admin.Country') }} </th>

                                <th class="text-nowrap">{{ __('admin.Visits') }} </th>
                                <th class="text-nowrap">{{ __('admin.Visits') }} </th>
                                <th class="text-nowrap">{{ __('admin.Date') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visits as $visit)
                                <tr>
                                    <td>
                                        <input type="checkbox" value="{{ $visit->id }}" onclick="data('dt-checkboxes')"
                                            class="dt-checkboxes form-check-input">

                                    </td>
                                    <td>
                                        <input type="checkbox" value="{{ $visit->id }}" onclick="data('dt-checkboxes')"
                                            class="dt-checkboxes form-check-input">

                                    </td>
                                    <td class="sorting_1"><span
                                            class="fw-medium text-heading">{{ $visit->ip_address }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center customer-country">
                                            <div><i
                                                    class="fis fi fi-{{ $visit->country->code }} rounded-circle me-2 fs-3"></i>
                                            </div>
                                            <div><span>{{ $visit->country->name }}</span></div>
                                        </div>
                                    </td>

                                    @php
                                        $referer = $visit->referer;
                                        $host = $referer ? parse_url($referer, PHP_URL_HOST) : null;
                                        $favicon = $host ? "https://www.google.com/s2/favicons?domain=$host" : null;
                                    @endphp

                                    <td>
                                        @if ($host)
                                            <img src="{{ $favicon }}" alt="favicon" width="16" height="16"
                                                style="margin-right: 5px;">
                                        @endif
                                        <span class="fw-medium text-heading">{{ $referer ?? 'Direct' }}</span>
                                    </td>

                                    <td><span class="fw-medium text-heading">{{ $visit->visit_count }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($visit->updated_at)->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row mx-2">
                        {{ $visits->links('vendor.pagination.bootstrap-5') }}
                    </div>
                    <script>
                        $(document).ready(function() {
                            var table = $('#products-table').DataTable({

                                columnDefs: [{

                                        className: "control",
                                        searchable: false,
                                        orderable: false,
                                        responsivePriority: 2,
                                        targets: 0,
                                        render: function(t, e, s, a) {
                                            // console.log(s)
                                            return ""
                                        }

                                    },
                                    {
                                        targets: 1,

                                        checkboxes: {
                                            selectAllRender: '<input type="checkbox" onclick="data1(`all`)" class="all form-check-input">'
                                        },
                                        render: function(t, e, s, a) {
                                            // console.log(s[0])
                                            return s[0];
                                        },
                                        searchable: !1
                                    }
                                ],


                                responsive: {
                                    details: {
                                        display: $.fn.dataTable.Responsive.display.modal({
                                            header: function(row) {
                                                return 'تفاصيل ' + row.data()[
                                                    1]; // عرض اسم العميل في عنوان المودال
                                            }
                                        }),
                                        type: "column",
                                        renderer: function(api, rowIdx, columns) {
                                            var data = $.map(columns, function(col, i) {
                                                return col.title ?
                                                    `<tr><td><strong>${col.title}:</strong></td><td>${col.data}</td></tr>` :
                                                    '';
                                            }).join('');
                                            return data ? $('<table class="table"/>').append('<tbody>' + data +
                                                '</tbody>') : false;
                                        }
                                    }
                                },
                                paging: false, // 🚫 إيقاف الباجيناشن
                                info: false, // 🚫 إخفاء "Showing X to Y of Z entries"
                                ordering: true,
                                searching: false
                            });
                        });
                    </script>

                </div>

            </div>


        </div>
        <!-- / Content -->





        {{-- -------------------------------------------------------------- Delete-------------------------------------------------------------------- --}}

        <div class="modal fade" id="basicModal2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1 " data-i18n="Delete">Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form method="POST" action="{{ route('visit.destroy', 0) }}">
                                @method('delete')
                                @csrf
                                <div id="name" class=" col mb-3">

                                    ﻫﻞ اﻧﺖ ﻣﺘﺄﻛﺪ ﻣﻦ اﻧﻚ ﺗﺮﻳﺪ اﻟﺤﺬﻑ؟

                                </div>
                                <input class="val" type="hidden" name="id">


                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            data-i18n="Close">Close</button>
                        <button type="submit" class="btn btn-danger" data-i18n="Delete">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- --------------------------------------------------------------end Delete-------------------------------------------------------------------- --}}

    @endsection

    @section('footer')
        <!-- Page JS -->


    @endsection
