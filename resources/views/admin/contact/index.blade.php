@extends('admin.layout.app')

@section('page', 'home')


@section('contant')





    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">



            <!-- Product List Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{!! __('admin.Contact Us') !!} </h5>
                    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">


                        {{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


                        @if (session('success'))
                            <div id="success-message" class="alert alert-success alert-dismissible fade show text-center"
                                role="alert">
                                {{ session('success') }}
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


                    <table id="products-table" class="datatables-products table border-top dataTable no-footer dtr-column"
                        style="width: 1211px;">
                        <thead>





                            <tr>
                                <th></th>
                                <th></th>
                                <th>{!! __('admin.Name') !!}</th>
                                <th class="text-nowrap text-sm-end">{!! __('admin.Email') !!} &nbsp;</th>
                                <th class="text-nowrap text-sm-end">{!! __('admin.Phone') !!}</th>
                                <th class="text-nowrap text-sm-end">{!! __('admin.Subject') !!}</th>
                                <th class="text-nowrap text-sm-end">{!! __('admin.Date') !!}</th>
                                <th class="text-lg-center">{!! __('admin.Actions') !!}</th>
                            </tr>



                            </tr>
                        </thead>
                    </table>
                </div>
                <br>
                <br>
            </div>

        </div>
        <!-- / Content -->










        <script>
            $(document).ready(function() {

                var o = {

                        1: {
                            title: "{!! __('admin.Publish') !!}",
                            class: "bg-label-success"
                        },
                        2: {
                            title: "{!! __('admin.Scheduled') !!}",
                            class: "bg-label-warning"
                        },
                        3: {
                            title: "{!! __('admin.Inactive') !!}",
                            class: "bg-label-danger"
                        }
                    },
                    i = {
                        0: {
                            title: "{!! __('admin.Out_of_Stock') !!}"
                        },
                        1: {
                            title: "{!! __('admin.In_Stock') !!}"
                        }
                    };
                $('#products-table').DataTable({
                    processing: true,

                    ajax: '{{ route('contact.data') }}',
                    columns: [{
                                data: "id"
                            },


                            {
                                data: "name"
                            },
                            {
                                data: "email"
                            },
                            {
                                data: "phone"
                            },
                            {
                                data: "subject"
                            },
                            {
                                data: "created_at"
                            },

                            {
                                data: " "
                            },




                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            }
                        ]

                        ,
                    columnDefs: [{
                            className: "control",
                            searchable: !1,
                            orderable: !1,
                            responsivePriority: 2,
                            targets: 0,
                            render: function(t, e, s, a) {

                                return ""
                            }
                        }, {
                            targets: 1,
                            orderable: !1,
                            checkboxes: {
                                selectAllRender: '<input type="checkbox"   class="all form-check-input">'
                            },
                            render: function(t, e, s, a) {
                                return '<input type="checkbox" value="' + s.id +
                                    '"   class="dt-checkboxes form-check-input" >'
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


                                // console.log(s)
                                return '<div class="text-sm-center  ">' + s.name + "</div>"

                            }
                        }

                        ////////////2//////////////

                        ///////////3////////////
                        , {
                            targets: 3,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {



                                return '<div class="text-sm-end"><a href="mailto:' + s.email + '">' + s
                                    .email + '</a></div>'

                            }
                        }

                        ////////////3//////////////
                        ///////////4////////////
                        , {
                            targets: 4,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {

                                return '<div class="text-sm-end"><a href="tel:' + s.phone + '">' + s
                                    .phone + '</a></div>'




                            }
                        }

                        ////////////4//////////////
                        ///////////5////////////
                        , {
                            targets: 5,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {

                                return "<div class='fw-medium text-sm-end'>" + s.subject + "</div";




                            }
                        }

                        ////////////5//////////////

                        ///////////6////////////
                        , {
                            targets: 6,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {

                                return "<div class='fw-medium text-sm-end'>" + s.created_at.substring(0,
                                    10) + "</div>";





                            }
                        }

                        ////////////6//////////////


                        ///////////7////////////
                        , {
                            targets: 7,
                            responsivePriority: 1,
                            render: function(t, e, s, a) {


                                return `
            <div class="d-flex align-items-sm-center justify-content-sm-center">
                <button id="edit" class="btn btn-sm btn-icon"
                    data-id="${s.id}"
                    data-name="${s.name}"
                    data-email="${s.email}"
                    data-phone="${s.phone}"
                    data-subject="${s.subject}"
                    data-message="${s.message}"

                    aria-controls="products-table"
                    type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#EditModal1">
                    <i class='bx bxs-show' ></i>
                </button>
            </div>`;
                            }
                        }


                        ////////////7//////////////



                        , {
                            targets: -1,

                            searchable: !1,
                            orderable: !1,

                        }

                    ],

                    order: [6, "desc"],
                    dom: '<"card-header d-flex border-top rounded-0 flex-wrap py-md-0"<"me-5 ms-n2 pe-5"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0"lB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    lengthMenu: [10, 20, 50, 70, 100],
                    language: {
                        sLengthMenu: "_MENU_",
                        search: "",
                        searchPlaceholder: "{!! __('admin.Search') !!} ",
                        info: "{!! __('admin.Displaying _START_ to _END_ of _TOTAL_ entries') !!}"
                    },
                    buttons: [{
                            text: '<i class="bx bx-trash"></i><span class="d-none d-sm-inline-block">حذف </span>',
                            className: "add-new btn btn-danger de me-3",
                            attr: {
                                "data-bs-toggle": "modal",
                                "data-bs-target": "#basicModal2",
                                "style": "display:none"
                            }
                        },

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


            //     function edit(id){
            //       $('#edit').val(id);

            //     }

            // $('#EditModel').on('show', function (event) {
            //       console.log(event)
            //     });


            $(document).on('click', '#edit', function() {

                var name = $(this).data('name');
                var email = $(this).data('email');
                var phone = $(this).data('phone');
                var subject = $(this).data('subject');
                var message = $(this).data('message');



                $('#name').val(name);
                $('#email').val(email);
                $('#phone').val(phone);
                $('#subject').val(subject);
                $('#message').val(message);


            });
        </script>



        {{-- -------------------------------------------------------------- Edit-------------------------------------------------------------------- --}}



        <div class="modal fade" id="EditModal1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 70rem" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">{!! __('admin.View') !!}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="name">{!! __('admin.Name') !!}</label>
                                <input type="text" disabled class="form-control" id="name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email">{!! __('admin.Email') !!}</label>
                                <input type="text" disabled class="form-control" id="email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="phone">{!! __('admin.Phone') !!}</label>
                                <input type="text" disabled class="form-control" id="phone">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="subject">{!! __('admin.Subject') !!}</label>
                                <input type="text" disabled class="form-control" id="subject">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label" for="message">{!! __('admin.Message') !!}</label>
                                <textarea class="form-control" disabled id="message" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                {!! __('admin.Close') !!}</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>











    @endsection



    @section('footer')

    @endsection
