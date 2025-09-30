@extends('admin.layout.app')

@section('page', 'home')


@section('contant')







    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">




            <div class="row">


                <div class="col-lg-12 col-md-12 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div id="products-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="card-header d-flex   rounded-0 flex-wrap py-md-0">


                                    {{-- -------------------------------------------------------------- Filter-------------------------------------------------------------------- --}}



                                    <form method="GET" class="col-12 " action="{{ route('home') }}">
                                        <div class="row  "> <!-- أضف g-2 لزيادة المسافات -->



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
                                            <div class="col-12 col-md-6 col-lg-2 d-flex align-items-end">
                                                <button type="submit"
                                                    class="btn btn-primary w-100 mt-4">{!! __('admin.Submit') !!}</button>
                                            </div>

                                        </div>
                                    </form>


                                    {{-- --------------------------------------------------------------End button-------------------------------------------------------------------- --}}

                                </div>
                                <!-- Order List Widget -->


                            </div>

                        </div>
                    </div>
                </div>

                <br>
                <div class="col-lg-12 col-md-12 col-12  ">
                    <div class="card mb-4">
                        <div class="card-widget-separator-wrapper">
                            <div class="card-body card-widget-separator">
                                <div class="row gy-4 gy-sm-1">




                                    <div class="col-sm-6 col-lg-4">
                                        <div
                                            class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                            <div>
                                                <h3 class="mb-2">EGP
                                                    {{ Round($total_bookings, 2) }}

                                                </h3>
                                                <p class="mb-0"> {!! __('admin.Bookings') !!}</p>
                                            </div>
                                            <div class="avatar me-sm-4 ">
                                                <span class="report-list-icon rounded ">
                                                    <img src="{{ asset('admin') }}/icons/paypal-icon.svg" alt="Paypal">
                                                    {{-- <i class="bx bx-calendar bx-sm"></i> --}}
                                                </span>
                                            </div>
                                        </div>
                                        <hr class="d-none d-sm-block d-lg-none me-4">
                                    </div>









                                    <div class="col-sm-6 col-lg-4">
                                        <div
                                            class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                            <div>
                                                <h3 class="mb-2">EGP
                                                    {{ Round($total_expaenses, 2) }}

                                                </h3>
                                                <p class="mb-0">{!! __('admin.Expenses') !!}</p>
                                            </div>
                                            <div class="avatar me-lg-4">
                                                <span class="report-list-icon rounded">
                                                    <div class="avatar flex-shrink-0">
                                                        <span class="badge rounded-2 bg-label-warning p-2"
                                                            style="font-size: 24px;">
                                                            <i class="bx bx-wallet bx-l text-warning"
                                                                style="font-size: 30px;"></i>
                                                        </span>
                                                    </div>

                                                </span>
                                            </div>
                                        </div>
                                        <hr class="d-none d-sm-block d-lg-none">
                                    </div>







                                    <div class="col-sm-6 col-lg-4">
                                        <div
                                            class="d-flex justify-content-between align-items-start   pb-3 pb-sm-0 card-widget-3">
                                            <div>
                                                <h3 class="mb-2">EGP
                                                    {{ Round($total_bookings - $total_expaenses, 2) }}
                                                </h3>
                                                <p class="mb-0">{!! __('admin.Total Income') !!}</p>
                                            </div>
                                            <div class="avatar me-lg-4">
                                                <span class="report-list-icon rounded">
                                                    <div class="avatar flex-shrink-0">
                                                        <span class="badge rounded-2 bg-label-success p-2"
                                                            style="font-size: 24px;">
                                                            <img src="{{ asset('admin') }}/icons/wallet-icon.svg"
                                                                alt="Wallet">
                                                        </span>
                                                    </div>

                                                </span>
                                            </div>



                                        </div>
                                    </div>








                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <div class="col-md-12 col-lg-4">
                    <div class="row">





                        <div class="col-lg-6 col-md-3 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">

                                            <span class="badge rounded-2 bg-label-secondary p-2"
                                                style="font-size: 24px;">EGP</span>



                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>

                                        </div>
                                    </div>
                                    <span class="d-block">{!! __('admin.Expenses') !!} </span>
                                    <h4 class="card-title mb-1">EGP {{ round($month_expenses, 0) }}</h4>
                                    <small class="text-{{ $avg_expenses > 0 ? 'success' : 'danger' }} fw-medium"><i
                                            class='bx bx-{{ $avg_expenses > 0 ? 'up' : 'down' }}-arrow-alt'></i>
                                        {{ $avg_expenses > 0 ? round($avg_expenses, 1) . '+' : round($avg_expenses, 1) }}%</small>
                                </div>
                            </div>
                        </div>





























                        <div class="col-lg-6 col-md-3 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <span class="badge rounded-2 bg-label-success p-2" style="font-size: 24px;">
                                                <img src="{{ asset('admin') }}/icons/wallet-icon.svg" width="22"
                                                    height="22" alt="Wallet">
                                            </span>

                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>

                                        </div>
                                    </div>
                                    <span class="d-block">{!! __('admin.Bookings') !!}</span>
                                    <h4 class="card-title mb-1"> {{ round($count_booking, 0) }}</h4>
                                    <small class="text-{{ $avg_count_booking > 0 ? 'success' : 'danger' }} fw-medium"><i
                                            class='bx bx-{{ $avg_count_booking > 0 ? 'up' : 'down' }}-arrow-alt'></i>
                                        {{ $avg_count_booking > 0 ? round($avg_count_booking, 1) . '+' : round($avg_count_booking, 1) }}%</small>
                                </div>
                            </div>
                        </div>




                        <div class="col-12 col-sm-6 col-md-3 col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <span class="badge rounded-2 bg-label-secondary p-2"
                                                style="font-size: 24px;"><i class="bx bx-dollar bx-l  text-secondary"
                                                    style="font-size: 30px;"></i></span>
                                        </div>

                                    </div>
                                    <span class="d-block mb-1">{!! __('admin.Total Income') !!} </span>
                                    <h3 class="card-title text-nowrap mb-2">EGP {{ round($total_expenses_year, 0) }}</h3>
                                    <small class="text-{{ $avg_expenses_year > 0 ? 'success' : 'danger' }} fw-medium"><i
                                            class='bx bx-{{ $avg_expenses_year > 0 ? 'up' : 'down' }}-arrow-alt'></i>
                                        {{ $avg_expenses_year > 0 ? round($avg_expenses_year, 1) . '+' : round($avg_expenses_year, 1) }}%</small>

                                </div>
                            </div>
                        </div>



                        <div class="col-12 col-sm-6 col-md-3 col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <span class="badge rounded-2 bg-label-warning p-2" style="font-size: 24px;">
                                                <i class="bx bx-wallet bx-l text-warning" style="font-size: 30px;"></i>
                                            </span>
                                        </div>

                                    </div>
                                    <span class="d-block mb-1">{!! __('admin.Year Booking') !!} </span>
                                    <h3 class="card-title text-nowrap mb-2"> {{ round($total_booking_year_count, 0) }}
                                    </h3>
                                    <small
                                        class="text-{{ $avg_count_booking_year > 0 ? 'success' : 'danger' }} fw-medium"><i
                                            class='bx bx-{{ $avg_count_booking_year > 0 ? 'up' : 'down' }}-arrow-alt'></i>
                                        {{ $avg_count_booking_year > 0 ? round($avg_count_booking_year, 1) . '+' : round($avg_count_booking_year, 1) }}%</small>

                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <!-- Total Income -->
                <div class="col-md-12 col-lg-8 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-8">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{!! __('admin.Total Income') !!}</h5>
                                    <small class="card-subtitle">{!! __('admin.Yearly report overview') !!}</small>
                                </div>
                                <div class="card-body">
                                    <div id="totalIncomeChart"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-header d-flex justify-content-between">
                                    <div>
                                        <h5 class="card-title mb-0">{!! __('admin.Monthly Report') !!}</h5>

                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-2" type="button" id="totalIncome"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="report-list">
                                        <div class="report-list-item rounded-2 mb-4">
                                            <div class="d-flex align-items-start">
                                                <div class="report-list-icon shadow-sm me-2">
                                                    <img src="{{ asset('admin') }}/icons/paypal-icon.svg" width="22"
                                                        height="22" alt="Paypal">
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                                    <div class="d-flex flex-column">
                                                        <span>{!! __('admin.Bookings') !!}</span>
                                                        <h5 class="mb-0">EGP {{ round($month_booking, 0) }}</h5>
                                                    </div>
                                                    <small
                                                        class="text-{{ $avg_booking > 0 ? 'success' : 'danger' }} fw-medium"><i
                                                            class='bx bx-{{ $avg_booking > 0 ? 'up' : 'down' }}-arrow-alt'></i>
                                                        {{ $avg_booking > 0 ? round($avg_booking, 1) . '+' : round($avg_booking, 1) }}%</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-list-item rounded-2 mb-4">
                                            <div class="d-flex align-items-start">
                                                <div class="report-list-icon shadow-sm me-2">
                                                    <img src="{{ asset('admin') }}/icons/credit-card-icon.svg"
                                                        width="22" height="22" alt="Shopping Bag">
                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                                    <div class="d-flex flex-column">
                                                        <span>{!! __('admin.Expenses') !!}</span>
                                                        <h5 class="mb-0">EGP {{ round($month_expenses, 0) }}</h5>
                                                    </div>
                                                    <small
                                                        class="text-{{ $avg_expenses > 0 ? 'success' : 'danger' }} fw-medium"><i
                                                            class='bx bx-{{ $avg_expenses > 0 ? 'up' : 'down' }}-arrow-alt'></i>
                                                        {{ $avg_expenses > 0 ? round($avg_expenses, 1) . '+' : round($avg_expenses, 1) }}%</small>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="report-list-item rounded-2">
                                            <div class="d-flex align-items-start">
                                                <div class="report-list-icon shadow-sm me-2">
                                                    <img src="{{ asset('admin') }}/icons/wallet-icon.svg" width="22"
                                                        height="22" alt="Wallet">
                                                </div>



                                                <div
                                                    class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                                    <div class="d-flex flex-column">
                                                        <span>{!! __('admin.Income') !!}</span>
                                                        <h5 class="mb-0">EGP {{ round($total, 0) }}</h5>
                                                    </div>
                                                    <small class="text-{{ $avg > 0 ? 'success' : 'danger' }} fw-medium"><i
                                                            class='bx bx-{{ $avg > 0 ? 'up' : 'down' }}-arrow-alt'></i>
                                                        {{ $avg > 0 ? round($avg, 1) . '+' : round($avg, 1) }}%</small>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Total Income -->
                </div>
                <!--/ Total Income -->
            </div>
            <div class="row">




                {{-- <div class="col-md-6 col-lg-8 mb-4 mb-md-0">
                    <div class="card">
                        <div class="table-responsive text-nowrap">
                            <table class="table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>{!! __('admin.Orders') !!}</th>

                                        <th>{!! __('admin.Customers') !!}</th>
                                        <th>{!! __('admin.Date') !!}</th>
                                        <th>{!! __('admin.Payment') !!}</th>
                                        <th>{!! __('admin.Total') !!}</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @if (count($orders) == 0)
                                        <tr class="odd">
                                            <td valign="top" colspan="5" class="dataTables_empty">
                                                <center> No data available
                                                    in
                                                    table</center>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($orders as $order)
                                        <tr class="odd">
                                            <!-- محاذاة رقم الطلب في المنتصف -->
                                            <td class="sorting_{{ $order->id }}" style="text-align: center;">
                                                <a href="order/{{ $order->id }}">
                                                    <span class="fw-medium">#{{ $order->id }}</span>
                                                </a>
                                            </td>

                                            <!-- محاذاة محتوى العميل في المنتصف -->
                                            <td style="text-align: center;">
                                                <div
                                                    class="d-flex justify-content-center align-items-center customer-name">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar me-2">
                                                                <span class="avatar-initial rounded-circle bg-label-info">
                                                                    {{ collect(explode(' ', $order->customer->name))->map(function ($word) {
                                                                            return strtoupper(mb_substr($word, 0, 1));
                                                                        })->join('') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column text-center">
                                                        <a href="customer/1">
                                                            <span class="fw-medium">{{ $order->customer->name }}</span>
                                                        </a>
                                                        <small
                                                            class="text-muted text-nowrap">{{ $order->customer->phone }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- محاذاة التاريخ في المنتصف -->
                                            <td style="text-align: center;">
                                                <span
                                                    class="text-nowrap">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y, h:i A') }}</span>
                                            </td>

                                            <td style="text-align: center;">

                                                @if ($order->payment == 1)
                                                    <h6 class="mb-0 w-px-100 text-success"><i
                                                            class="bx bxs-circle fs-tiny me-2"></i>{!! __('admin.Paid') !!}
                                                    </h6>
                                                @elseif ($order->payment == 2)
                                                    <h6 class="mb-0 w-px-100 text-warning"><i
                                                            class="bx bxs-circle fs-tiny me-2"></i>{!! __('admin.Pending') !!}
                                                    </h6>
                                                @elseif ($order->payment == 3)
                                                    <h6 class="mb-0 w-px-100 text-danger"><i
                                                            class="bx bxs-circle fs-tiny me-2"></i>{!! __('admin.Failed') !!}
                                                    </h6>
                                                @elseif ($order->payment == 4)
                                                    <h6 class="mb-0 w-px-100 text-secondary"><i
                                                            class="bx bxs-circle fs-tiny me-2"></i>{!! __('admin.Cancelled') !!}
                                                    </h6>
                                                @endif
                                            </td>
                                            <td style="text-align: center;">@php

                                                if ($order->country == 'Egypt') {
                                                    echo 'EGP ' . $order->total;
                                                } else {
                                                    echo "$" . $order->total;
                                                }

                                            @endphp </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}


                {{-- <!-- Performance -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">{!! __('admin.Performance') !!}</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="performanceId" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <small>{!! __('admin.Current Year:') !!} <span
                                            class="fw-medium">${{ round($total_order_year, 0) }}</span></small>
                                </div>
                                <div class="col-6">
                                    <small>{!! __('Last Year:') !!} <span
                                            class="fw-medium">${{ round($total_order_last_year, 0) }}</span></small>
                                </div>
                            </div>
                        </div>
                        <div id="performanceChart"></div>
                    </div>
                </div> --}}
                <!--/ Performance -->




                <div class="col-md-6 col-lg-4 ">
                    <br>

                    <div class="row">

                        <div class="col-12   ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between gap-3">
                                        <div class="d-flex align-items-start flex-column justify-content-between">
                                            <div class="card-title">
                                                <h5 class="mb-0">{!! __('admin.Bookings') !!}</h5>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="mt-auto">
                                                    <h3 class="mb-2">EGP {{ round($total_booking_year, 0) }}</h3>
                                                    <small
                                                        class="text-{{ $avg_booking_year > 0 ? 'success' : 'danger' }} fw-medium"><i
                                                            class='bx bx-{{ $avg_booking_year > 0 ? 'up' : 'down' }}-arrow-alt'></i>
                                                        {{ $avg_booking_year > 0 ? round($avg_booking_year, 1) . '+' : round($avg_booking_year, 1) }}%</small>
                                                </div>
                                            </div>
                                            <span class="badge bg-label-secondary rounded-pill">{{ now()->year }}
                                                {!! __('admin.Year') !!} </span>
                                        </div>
                                        <div id="expensesBarChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <th>{!! __('admin.Orders') !!}</th>

                <th>{!! __('admin.Customers') !!}</th>
                <th>{!! __('admin.Date') !!}</th>
                <th>{!! __('admin.Payment') !!}</th>
                <th>{!! __('admin.Total') !!}</th> --}}


                <div class="col-md-6 col-lg-8 mb-4 mb-md-0">
                    <br>
                    <div class="card">
                        <div class="table-responsive text-nowrap">
                            <table class="table text-nowrap">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{!! __('admin.Online Sessions') !!}</th>


                                        <th>{!! __('admin.Date') !!}</th>


                                        <th>{!! __('admin.Booking type') !!}</th>
                                        <th>{!! __('admin.Installment') !!}</th>
                                        <th>{!! __('admin.Total') !!}</th>

                                        {{-- <th>{!! __('admin.Meeting') !!}</th> --}}

                                        {{-- <th>status</th> --}}
                                        {{-- <th>method</th> --}}
                                        {{-- <th>actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($expenses) --}}
                                    @if ($bookings->isEmpty())
                                        <tr class="odd">
                                            <td valign="top" colspan="6" class="dataTables_empty">لا توجد سجلات
                                                مطابقة</td>
                                        </tr>
                                    @endif

                                    @foreach ($bookings as $key => $booking)
                                        <tr class="odd">
                                            <td>{{ $key + 1 }}</td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-start align-items-center blog-name">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar me-2 rounded-2 bg-label-secondary">
                                                            <a href="{{ asset('images/' . $booking->course->photo) }}"
                                                                target="_blank">
                                                                <img src="{{ asset('images/' . $booking->course->photo) }}"
                                                                    class="rounded-2">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="text-body text-nowrap mb-0">
                                                            @if (App::isLocale('en'))
                                                                {{ $booking->course->title_en }}
                                                            @else
                                                                {{ $booking->course->title_ar }}
                                                            @endif

                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>


                                            <td><span
                                                    class="text-nowrap">{{ \Carbon\Carbon::parse($booking->created_at)->format('Y-m-d') }}</span>
                                            </td>

                                            <td>
                                                @if ($booking->type == 1)
                                                    <h6 class="mb-0 w-px-100 text-danger">
                                                        <i class="bx bxs-circle fs-tiny me-2"></i>اوفلاين
                                                    </h6>
                                                @else
                                                    <h6 class="mb-0 w-px-100 text-success">
                                                        <i class="bx bxs-circle fs-tiny me-2"></i>اونلاين
                                                    </h6>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($booking->installment == 1)
                                                    <h6 class="mb-0 w-px-100 text-primary">
                                                        <i class="bx bxs-circle fs-tiny me-2"></i>دفعة اولي
                                                    </h6>
                                                @elseif ($booking->installment == 2)
                                                    <h6 class="mb-0 w-px-100 text-secondary">
                                                        <i class="bx bxs-circle fs-tiny me-2"></i>دفعة ثانية
                                                    </h6>
                                                @elseif ($booking->installment == 3)
                                                    <h6 class="mb-0 w-px-100 text-success">
                                                        <i class="bx bxs-circle fs-tiny me-2"></i>دفعة ثالثة
                                                    </h6>
                                                @elseif ($booking->installment == 4)
                                                    <h6 class="mb-0 w-px-100 text-danger">
                                                        <i class="bx bxs-circle fs-tiny me-2"></i>دفعة رابعة
                                                    </h6>
                                                @elseif ($booking->installment == 5)
                                                    <h6 class="mb-0 w-px-100 text-warning">
                                                        <i class="bx bxs-circle fs-tiny me-2"></i>دفعة خامسة
                                                    </h6>
                                                @elseif ($booking->installment == 6)
                                                    <h6 class="mb-0 w-px-100 text-info">
                                                        <i class="bx bxs-circle fs-tiny me-2"></i>دفعة سادسة
                                                    </h6>
                                                @elseif ($booking->installment == 7)
                                                    <h6 class="mb-0 w-px-100 text-dark">
                                                        <i class="bx bxs-circle fs-tiny me-2"></i>دفعة سابعة
                                                    </h6>
                                                @endif

                                            </td>
                                            <td><span>EGP {{ $booking->total }}</span></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Total Balance -->








            </div>

        </div>
        <!-- / Content -->


        @php
            $imp = implode(',', $totals);

        @endphp



    @endsection


    @section('footer')


        <script>
            let o, e, r, t, s, a, i, n, l;
            l = isDarkStyle ? (o = config.colors_dark.cardColor, e = config.colors_dark.headingColor, r = config.colors_dark
                .textMuted, s = config.colors_dark.borderColor, t = "dark", a = "#4f51c0", i = "#595cd9", n = "#8789ff",
                "#c3c4ff") : (o = config.colors.cardColor, e = config.colors.headingColor, r = config.colors.textMuted,
                s = config.colors.borderColor, t = "", a = "#e1e2ff", i = "#c3c4ff", n = "#a5a7ff", "#696cff");
            var d = document.querySelector("#visitorsChart"),


                d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#totalIncomeChart")),
                c = {
                    chart: {
                        height: 250,
                        type: "area",
                        toolbar: !1,
                        dropShadow: {
                            enabled: !0,
                            top: 14,
                            left: 2,
                            blur: 3,
                            color: config.colors.primary,
                            opacity: .15
                        }
                    },

                    series: [{
                        data: [{{ $imp }}]
                    }],
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        width: 3,
                        curve: "straight"
                    },
                    colors: [config.colors.primary],
                    fill: {
                        type: "gradient",
                        gradient: {
                            shade: t,
                            shadeIntensity: .8,
                            opacityFrom: .7,
                            opacityTo: .25,
                            stops: [0, 95, 100]
                        }
                    },
                    grid: {
                        show: !0,
                        borderColor: s,
                        padding: {
                            top: -15,
                            bottom: -10,
                            left: 0,
                            right: 0
                        }
                    },
                    xaxis: {
                        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        labels: {
                            offsetX: 0,
                            style: {
                                colors: r,
                                fontSize: "13px"
                            }
                        },
                        axisBorder: {
                            show: !1
                        },
                        axisTicks: {
                            show: !1
                        },
                        lines: {
                            show: !1
                        }
                    },
                    yaxis: {
                        labels: {
                            offsetX: -15,
                            formatter: function(value) {
                                if (value < 1000) {
                                    return "EGP " + value;
                                }

                                return "EGP " + value;
                            },
                            style: {
                                fontSize: "13px",
                                colors: r
                            }
                        },
                        min: 0,
                        max: {{ $max_total }},
                        tickAmount: 5
                    }
                },
                d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#performanceChart")),
                c = {
                    series: [{
                        name: "{!! __('Last Year:') !!}",
                        data: [{{ $imp }}]
                    }],
                    chart: {
                        height: 285,
                        type: "radar",
                        toolbar: {
                            show: !1
                        },
                        dropShadow: {
                            enabled: !0,
                            enabledOnSeries: void 0,
                            top: 6,
                            left: 0,
                            blur: 6,
                            color: "#000",
                            opacity: .14
                        }
                    },
                    plotOptions: {
                        radar: {
                            polygons: {
                                strokeColors: s,
                                connectorColors: s
                            }
                        }
                    },
                    stroke: {
                        show: !1,
                        width: 0
                    },
                    legend: {
                        show: !0,
                        fontSize: "13px",
                        position: "bottom",
                        labels: {
                            colors: "#aab3bf",
                            useSeriesColors: !1
                        },
                        markers: {
                            height: 10,
                            width: 10,
                            offsetX: -3
                        },
                        itemMargin: {
                            horizontal: 10
                        },
                        onItemHover: {
                            highlightDataSeries: !1
                        }
                    },
                    colors: [config.colors.primary, config.colors.info],
                    fill: {
                        opacity: [1, .85]
                    },
                    markers: {
                        size: 0
                    },
                    grid: {
                        show: !1,
                        padding: {
                            top: -8,
                            bottom: -5
                        }
                    },
                    xaxis: {
                        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        labels: {
                            show: !0,
                            style: {
                                colors: [r, r, r, r, r, r, r, r, r, r, r, r],
                                fontSize: "13px",
                                fontFamily: "Public Sans"
                            }
                        }
                    },
                    yaxis: {
                        show: !1,
                        min: -1,
                        max: {{ $max_month_order_count ?? 0 }},
                        tickAmount: 4
                    }
                },

                d = (null !== d && new ApexCharts(d, c).render(), document.querySelector("#expensesBarChart")),
                c = {
                    series: [{
                        name: {{ now()->subYear()->year }}, // السنة الحالية
                        data: [{{ implode(',', $totalsLastYear) }}] // المصفوفة الخاصة بالسنة الماضية
                    }, {
                        name: {{ now()->year }}, // السنة الماضية

                        data: [{{ implode(',', $totalsCurrentYear) }}] // المصفوفة الخاصة بالسنة الحالية
                    }],
                    chart: {
                        height: 150,
                        stacked: !0,
                        type: "bar",
                        toolbar: {
                            show: !1
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: !1,
                            columnWidth: "70%",
                            borderRadius: 5,
                            startingShape: "rounded"
                        }
                    },
                    colors: [config.colors.primary, config.colors.warning],
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        curve: "smooth",
                        width: 2,
                        lineCap: "round",
                        colors: [o]
                    },
                    legend: {
                        show: !1
                    },
                    grid: {
                        show: !1,
                        padding: {
                            top: -10
                        }
                    },
                    xaxis: {
                        show: !1,
                        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        labels: {
                            show: !1
                        },
                        axisTicks: {
                            show: !1
                        },
                        axisBorder: {
                            show: !1
                        }
                    },
                    yaxis: {
                        show: !1
                    },
                    responsive: [{
                        breakpoint: 1440,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 5,
                                    columnWidth: "60%"
                                }
                            }
                        }
                    }, {
                        breakpoint: 1300,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 5,
                                    columnWidth: "70%"
                                }
                            }
                        }
                    }, {
                        breakpoint: 1200,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 4,
                                    columnWidth: "50%"
                                }
                            }
                        }
                    }, {
                        breakpoint: 1040,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 4,
                                    columnWidth: "60%"
                                }
                            }
                        }
                    }, {
                        breakpoint: 991,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 4,
                                    columnWidth: "40%"
                                }
                            }
                        }
                    }, {
                        breakpoint: 420,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 5,
                                    columnWidth: "60%"
                                }
                            }
                        }
                    }, {
                        breakpoint: 360,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 5,
                                    columnWidth: "70%"
                                }
                            }
                        }
                    }],
                    states: {
                        hover: {
                            filter: {
                                type: "none"
                            }
                        },
                        active: {
                            filter: {
                                type: "none"
                            }
                        }
                    }
                }


            null !== d && new ApexCharts(d, c).render()
        </script>


    @endsection
