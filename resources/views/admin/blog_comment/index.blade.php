@extends('admin.layout.app')

@section('page', 'Order List')


@section('contant')



    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">





            <div class="row mb-4 g-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body row widget-separator">
                            <div class="col-sm-5 border-shift border-end">
                                <h2 class="text-primary">{{ $avg }}<i class='bx bxs-star mb-2 ms-1'></i></h2>
                                <p class="fw-medium mb-1">{{ __('admin.Total_Reviews', ['count' => $count]) }}</p>
                                <p class="text-muted">{{ __('admin.All reviews are from genuine customers') }}</p>
                                <span class="badge bg-label-primary p-2 mb-3 mb-sm-0">+5 {{ __('admin.This Week') }}</span>
                                <hr class="d-sm-none">
                            </div>

                            <div
                                class="col-sm-7 gy-1 text-nowrap d-flex flex-column justify-content-between ps-4 gap-2 pe-3">
                                <div class="d-flex align-items-center gap-3 w-100 ">
                                    <small>5 {{ __('admin.Star') }}</small>
                                    <div class="progress w-100" style="height:10px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width:  @if ($all->firstWhere('rate', 5)) {{ ($all->firstWhere('rate', 5)->total / $count) * 100 }}@else{{ 0 }} @endif%"
                                            aria-valuenow="61.50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="w-px-20 text-end">{{ $all->firstWhere('rate', 5)->total ?? 0 }}</small>
                                </div>
                                <div class="d-flex align-items-center gap-3 w-100">
                                    <small>4 {{ __('admin.Star') }}</small>
                                    <div class="progress w-100" style="height:10px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width:  @if ($all->firstWhere('rate', 4)) {{ ($all->firstWhere('rate', 4)->total / $count) * 100 }}@else{{ 0 }} @endif%"
                                            aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="w-px-20 text-end">{{ $all->firstWhere('rate', 4)->total ?? 0 }}</small>
                                </div>
                                <div class="d-flex align-items-center gap-3 w-100">
                                    <small>3 {{ __('admin.Star') }}</small>
                                    <div class="progress w-100" style="height:10px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: @if ($all->firstWhere('rate', 3)) {{ ($all->firstWhere('rate', 3)->total / $count) * 100 }} @endif%"
                                            aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="w-px-20 text-end">{{ $all->firstWhere('rate', 3)->total ?? 0 }}</small>
                                </div>
                                <div class="d-flex align-items-center gap-3 w-100">
                                    <small>2 {{ __('admin.Star') }}</small>
                                    <div class="progress w-100" style="height:10px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width:  @if ($all->firstWhere('rate', 2)) {{ ($all->firstWhere('rate', 2)->total / $count) * 100 }}@else{{ 0 }} @endif%"
                                            aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="w-px-20 text-end">{{ $all->firstWhere('rate', 2)->total ?? 0 }}</small>
                                </div>
                                <div class="d-flex align-items-center gap-3 w-100">
                                    <small>1 {{ __('admin.Star') }}</small>
                                    <div class="progress w-100" style="height:10px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: @if ($all->firstWhere('rate', 1)) {{ ($all->firstWhere('rate', 1)->total / $count) * 100 }}@else{{ 0 }} @endif%"
                                            aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <small class="w-px-20 text-end">{{ $all->firstWhere('rate', 1)->total ?? 0 }}</small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body row">
                            <div class="col-sm-5">
                                <div class="mb-5">
                                    <h4 class="mb-2 text-nowrap">{{ __('admin.Reviews Statistics') }}</h4>
                                    <p class="mb-0"> <span
                                            class="me-2">{{ __('admin.New reviews', ['count1' => $count1]) }}
                                        </span> <span class="badge bg-label-success">+{{ $avg1 }}%</span></p>
                                </div>

                                <div>
                                    <h5 class="mb-2 fw-normal">
                                        <span class="text-success me-1">
                                            @if ($all->firstWhere('rate', 5))
                                                {{ ($all->firstWhere('rate', 5)->total / $count) * 100 }}@else{{ 0 }}
                                            @endif%
                                        </span>{{ __('admin.Positive reviews') }}
                                    </h5>
                                    <small class="text-muted">{{ __('admin.Weekly Report') }}</small>
                                </div>
                            </div>
                            <div class="col-sm-7 d-flex justify-content-sm-end align-items-end">
                                <div id="reviewsChart">



                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- review List Table -->
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title">{{ __('admin.Manage Reviews') }}</h5>
                    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">


                        {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


                        @if (session('success'))
                            <div id="success-message" class="alert alert-success alert-dismissible fade show text-center"
                                role="alert">
                                {{ session('success') }}
                            </div>
                        @endif


                        {{-- --------------------------------------------------------------End Alert-------------------------------------------------------------------- --}}


                    </div>

                </div>

                <div class="card-datatable table-responsive">
                    <table id="products-table" class="datatables-review table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>{{ __('admin.Online Sessions') }}</th>
                                <th class="text-nowrap">{{ __('admin.Reviewer') }}</th>
                                <th>{{ __('admin.Review') }}</th>
                                <th>{{ __('admin.Date') }}</th>


                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>


        </div>
        <!-- / Content -->
        <script src="{{ asset('admin') }}/vendor/libs/apex-charts/apexcharts.js"></script>
        <script>
            let e, t, a, o;
            var s = document.querySelector("#reviewsChart"),
                r = {
                    chart: {
                        height: 160,
                        width: 190,
                        type: "bar",
                        toolbar: {
                            show: !1
                        }
                    },
                    plotOptions: {
                        bar: {
                            barHeight: "75%",
                            columnWidth: "40%",
                            startingShape: "rounded",
                            endingShape: "rounded",
                            borderRadius: 5,
                            distributed: !0
                        }
                    },
                    grid: {
                        show: !1,
                        padding: {
                            top: -25,
                            bottom: -12
                        }
                    },
                    colors: [config.colors_label.success, config.colors_label.success, config.colors_label.success, config
                        .colors_label.success, config.colors.success, config.colors_label.success, config.colors_label
                        .success
                    ],
                    dataLabels: {
                        enabled: !1
                    },
                    series: [{
                            data: [{{ $days['mon'] }}, {{ $days['tue'] }}, {{ $days['wed'] }}, {{ $days['thu'] }},
                                {{ $days['fri'] }}, {{ $days['sat'] }}, {{ $days['sun'] }}
                            ]
                        }]


                        ,
                    legend: {
                        show: !1
                    },
                    xaxis: {
                        categories: ["M", "T", "W", "T", "F", "S", "S"],
                        axisBorder: {
                            show: !1
                        },
                        axisTicks: {
                            show: !1
                        },
                        labels: {
                            style: {
                                colors: a,
                                fontSize: "13px"
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            show: !1
                        }
                    }
                };
            null !== s && new ApexCharts(s, r).render()










            $(document).ready(function() {

                var o = {

                        1: {
                            title: "Publish",
                            class: "bg-label-success"
                        },
                        2: {
                            title: "Scheduled",
                            class: "bg-label-warning"
                        },
                        3: {
                            title: "Inactive",
                            class: "bg-label-danger"
                        }
                    },
                    i = {
                        0: {
                            title: "Out_of_Stock"
                        },
                        1: {
                            title: "In_Stock"
                        }
                    };
                $('#products-table').DataTable({
                    processing: true,

                    ajax: '{{ route('courses_review.data') }}',
                    columns: [{
                                data: "id"
                            },

                            {
                                data: "name"
                            },
                            {
                                data: "cat.name"
                            },
                            {
                                data: "stock"
                            },
                            {
                                data: "sku"
                            },

                            // {data: "status"},
                            {
                                data: " "
                            },





                            // { data: 'action', name: 'action', orderable: false, searchable: false }
                        ]

                        ,
                    columnDefs: [{
                            className: "control",
                            searchable: !1,
                            orderable: !1,
                            responsivePriority: 2,
                            targets: 0,
                            render: function(t, e, s, a) {
                                // console.log(s)
                                return ""
                            }
                        }, {
                            targets: 1,
                            orderable: !1,
                            checkboxes: {
                                selectAllRender: '<input type="checkbox" onclick="data1(`all`)" class="all form-check-input">'
                            },
                            render: function(t, e, s, a) {
                                return '<input type="checkbox" value="' + s.id +
                                    '" onclick="data(`dt-checkboxes`)" class="dt-checkboxes form-check-input" >'
                            },
                            searchable: !1
                        }

                        ///////////2////////////
                        //     , {
                        //         targets: 2,
                        //         responsivePriority: 1,
                        //         render: function(t, e, s, a) {

                        // // console.log(s)



                        //             var n = s.id;
                        //             return n;

                        //         }
                        //     }

                        ////////////2//////////////
                        ///////////2////////////
                        , {
                            targets: 2,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                @if (App::isLocale('en'))
                                    var title = s.course.title_en;
                                @else
                                    var title = s.course.title_ar;
                                @endif
                                if (s.course.photo != null) {
                                    var photo = s.course.photo;
                                } else {
                                    var photo = 'no-image.png';
                                }
                                var list =
                                    '<div class="d-flex justify-content-start align-items-center courses-name"><div class="avatar-wrapper"><div class="avatar avatar me-2 rounded-2 bg-label-secondary"><img src="{{ asset('images') }}/' +
                                    photo +
                                    '"   class="rounded-2"></div></div><div class="d-flex flex-column"><h6 class="text-body text-nowrap mb-0">' +
                                    title + '</h6> </div></div>';



                                return list;
                            }
                        }

                        ////////////2//////////////

                        ///////////3////////////
                        , {
                            targets: 3,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {



                                console.log(s)
                                var customerName = s.name;
                                var initials = customerName.split(' ').map(name => name[0]).join('');
                                var colors = ['success', 'danger', 'warning', 'info', 'dark', 'primary',
                                    'secondary'
                                ];

                                var randomColor = colors[Math.floor(Math.random() * colors.length)];

                                var list = `
  <div class="d-flex justify-content-start align-items-center customer-name">
    <div class="avatar-wrapper">
      <!-- العنصر الذي يحتوي على الأحرف الأولى -->
      <div class="avatar-wrapper">
        <div class="avatar me-2">
          <span class="avatar-initial rounded-circle bg-label-${randomColor}">${initials}</span>
          </div>
          </div>

    </div>
    <!-- معلومات العميل -->
    <div class="d-flex flex-column">
      <a href="{{ route('customer.show', '') }}/` + s.customer_id + `">
        <span class="fw-medium">${customerName}</span>
      </a>
      <small class="text-muted text-nowrap">${s.email}</small>
    </div>
  </div>`;

                                return list;


                            }
                        }

                        ////////////3//////////////
                        ///////////4////////////
                        , {
                            targets: 4,
                            responsivePriority: 1,
                            render: function(e, t, a, o) {
                                var s = a.rate,

                                    a = a.review,
                                    n = $(
                                        '<div class="read-only-ratings d-flex justify-content-center mb-2  align-items-center customer-name jq-ry-container"></div>'
                                    );
                                return n.rateYo({
                                        rating: s,
                                        rtl: isRtl,
                                        readOnly: !0,
                                        starWidth: "20px",
                                        spacing: "3px",
                                        starSvg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,2 L15.09,8.09 L22,9.9 L17,14 L18.18,20 L12,17.5 L5.82,20 L7,14 L2,9.9 L8.91,8.09 L12,2 Z" /></svg>'
                                    }),
                                    "<div class='d-flex justify-content-center align-items-center flex-column'>" +
                                    n.prop("outerHTML") + ' <small class="text-break pe-3 text-end">' +
                                    a + "</small></div>"


                            }
                        }

                        ////////////4//////////////

                        ///////////5////////////
                        , {
                            targets: 5,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {
                                if (s.created_at != null) {
                                    var formattedDate = new Date(s.created_at).toLocaleDateString(
                                        'en-US', {
                                            year: 'numeric',
                                            month: 'short',
                                            day: 'numeric'
                                        });

                                    // إنشاء عنصر لعرض التاريخ
                                    var n = `<span class="text-nowrap"  >${formattedDate}</span>`;
                                    return n;
                                } else {
                                    return 'null';
                                }

                            }

                        }

                        ////////////5//////////////






                        , {
                            targets: -1,

                            searchable: !1,
                            orderable: !1,

                        }

                    ],

                    order: [2, "desc"],
                    dom: '<"card-header d-flex border-top rounded-0 flex-wrap py-md-0"<"me-5 ms-n2 pe-5"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0"lB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    lengthMenu: [10, 20, 50, 70, 100],
                    language: {
                        sLengthMenu: "_MENU_",
                        search: "",
                        searchPlaceholder: "{!! __('admin.Search') !!} ",
                        info: "{!! __('admin.Displaying _START_ to _END_ of _TOTAL_ entries') !!}"
                    },
                    buttons: [



                        {
                            text: '<i class="bx bx-trash"></i><span class="d-none d-sm-inline-block">حذف </span>',
                            className: "add-new btn btn-danger de me-3",
                            attr: {
                                "data-bs-toggle": "modal",
                                "data-bs-target": "#basicModal2",
                                "style": "display:none"
                            }
                        },





                        // {
                        //     extend: "collection",
                        //     className: "btn btn-label-secondary dropdown-toggle me-3",
                        //     text: '<i class="bx bx-export me-1"  ><span class="d-none d-sm-inline-block"  >إستخراج<span></i>',
                        //     buttons: [{
                        //         extend: "print",
                        //         text: '<i class="bx bx-printer me-2" ></i>Print',
                        //         className: "dropdown-item",
                        //         exportOptions: {
                        //             columns: [ 2, 3,4 ],
                        //             format: {
                        //                 body: function(t, e, s) {
                        //                     var a;
                        //                     return t.length <= 0 ? t : (t = $.parseHTML(t), a = "", $.each(t, function(t, e) {
                        //                         void 0 !== e.classList && e.classList.contains("product-name") ? a += e.lastChild.firstChild.textContent : void 0 === e.innerText ? a += e.textContent : a += e.innerText
                        //                     }), a)
                        //                 }
                        //             }
                        //         },
                        //         customize: function(t, e, s,a) {
                        //             $(t.document.body).css("color", a).css("border-color", e).css("background-color", s), $(t.document.body).find("table").addClass("compact").css("color", "inherit").css("border-color", "inherit").css("background-color", "inherit")
                        //         }
                        //     },   {
                        //         extend: "pdf",
                        //         text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
                        //         className: "dropdown-item",
                        //         exportOptions: {
                        //             columns: [ 2, 3 ],
                        //             format: {
                        //                 body: function(t, e, s) {
                        //                     var a;
                        //                     return t.length <= 0 ? t : (t = $.parseHTML(t), a = "", $.each(t, function(t, e) {
                        //                         void 0 !== e.classList && e.classList.contains("product-name") ? a += e.lastChild.firstChild.textContent : void 0 === e.innerText ? a += e.textContent : a += e.innerText
                        //                     }), a)
                        //                 }
                        //             }
                        //         }
                        //     } ]
                        // },





                        //   {
                        //       text: '<i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block" data-i18n="Add dialect">Add dialect</span>',
                        //       className: "add-new btn btn-primary",
                        //       attr: {
                        //     "data-bs-toggle": "offcanvas",
                        //     "data-bs-target": "#offcanvasEcommerceCategoryList"
                        //   },
                        //   action: function() {
                        //             window.location.href =
                        //         }
                        //   }


                    ],
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(t) {
                                    return "Details of " + t.data().name
                                }
                            }),
                            type: "column",
                            renderer: function(t, e, s) {
                                s = $.map(s, function(t, e) {
                                    return "" !== t.title ? '<tr data-dt-row="' + t.rowIndex +
                                        '" data-dt-column="' + t.columnIndex + '"><td>' + t.title +
                                        ":</td> <td>" + t.data + "</td></tr>" : ""
                                }).join("");
                                return !!s && $('<table class="table"/><tbody />').append(s)
                            }
                        }
                    },


                });
            });
        </script>



    @endsection

    @section('footer')
        <!-- Vendors JS -->
        <script src="{{ asset('admin') }}/vendor/libs/rateyo/rateyo.js"></script>

        <!-- Page JS -->

        {{-- <script src="{{asset("admin")}}/js/app-ecommerce-reviews.js"></script> --}}
        <script src="{{ asset('admin') }}/js/extended-ui-star-ratings.js"></script>

    @endsection






    <!-- Page JS -->
