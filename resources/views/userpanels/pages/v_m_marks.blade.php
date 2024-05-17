{{-- EXTEND: BASE WRAPPER --}}
@extends('userpanels.layouts.v_main')

@section('head_page_cssjs')
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-select-bs5/select.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" />
@endsection



<!-- CONTENT: M-MARKS -->
@section('content')
    @php
        $page = Session::get('page');
        $page_title = $page['page_title'];
        $page_url = $page['page_url'];
    @endphp
    {{-- HTML BELOW --}}

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">UserPanels /</span> <a
                href="{{ route('m-institutions') }}">{{ $page_title }}</a></h4>
        <div class="card">
            <h5 class="card-header">{{ $page_title }} Data</h5>
            <div class="card-datatable table-responsive">
                <!--/ TABLE -->
                <table id="DataTables_Table_2" class="dt-fixedheader table table-bordered">
                    <thead class="">
                        <tr>
                            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                style="width: 18px;" aria-label="Actions">ACT</th>
                            <th>NAME</th>
                            <th>CAT</th>
                            <th>NPSN</th>
                            <th>LOGO</th>
                            <th>ADDR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 25;
                        @endphp
                        @for ($i = 0; $i < $count; $i++)
                            <tr>
                                <td class="dtr-hidden" tabindex="0" style="">
                                    <div class="d-inline-block">
                                        <a href="javascript:;"
                                            class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            <a href="javascript:;" class="dropdown-item btn-sm mdi mdi-image-text">
                                                Details</a>
                                            <a href="javascript:;" class="dropdown-item btn-sm mdi mdi-pencil-outline">
                                                Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:;"
                                                class="dropdown-item text-danger delete-record btn-sm mdi mdi-trash-can-outline">
                                                Delete</a>
                                        </div>
                                    </div>

                                </td>
                                <td class="institution-name">John Doe</td>
                                <td>Category 1</td>
                                <td>1234567890</td>
                                <td><img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt="Logo 1"
                                        style="height: 24px; width: 24px;"></td>
                                <td>Address 1</td>
                            </tr>
                        @endfor


                    </tbody>
                </table>
            </div>
        </div>
        <!--/ TABLE -->

    </div>
@endsection
<!-- CONTENT: M-MARKS -->


@section('footer_page_js')
    {{-- <script src="{{ asset('public/materialize/assets/js/tables-datatables-extensions.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            var dt_fixedheader = $('.dt-fixedheader');
            $('#DataTables_Table_2').DataTable({
                "paging": true,
                "searching": true,
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 75, 100, 150, 200, 250, 300, 350, 400],
                "info": true,
                "ordering": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": 0, // Disable sorting on Actions column
                    "className": "control",
                    // "width": "auto"
                }],

                buttons: [{
                    extend: 'collection',
                    className: 'btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light',
                    text: '<i class="mdi mdi-export-variant me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [{
                            extend: 'print',
                            text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function(inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function(index, item) {
                                            if (item.classList !== undefined && item
                                                .classList.contains('institution-name')) {
                                                result = result + item.lastChild
                                                    .firstChild.textContent;
                                            } else if (item.innerText ===
                                                undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    }
                                }
                            },
                            customize: function(win) {
                                //customize print view for dark
                                $(win.document.body)
                                    .css('color', config.colors.headingColor)
                                    .css('border-color', config.colors.borderColor)
                                    .css('background-color', config.colors.bodyBg);
                                $(win.document.body)
                                    .find('table')
                                    .addClass('compact')
                                    .css('color', 'inherit')
                                    .css('border-color', 'inherit')
                                    .css('background-color', 'inherit');
                            }
                        },
                        {
                            extend: 'csv',
                            text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function(inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function(index, item) {
                                            if (item.classList !== undefined && item
                                                .classList.contains('institution-name')) {
                                                result = result + item.lastChild
                                                    .firstChild.textContent;
                                            } else if (item.innerText ===
                                                undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    }
                                }
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="mdi mdi-file-excel-outline me-1"></i>Excel',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function(inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function(index, item) {
                                            if (item.classList !== undefined && item
                                                .classList.contains('institution-name')) {
                                                result = result + item.lastChild
                                                    .firstChild.textContent;
                                            } else if (item.innerText ===
                                                undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    }
                                }
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function(inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function(index, item) {
                                            if (item.classList !== undefined && item
                                                .classList.contains('institution-name')) {
                                                result = result + item.lastChild
                                                    .firstChild.textContent;
                                            } else if (item.innerText ===
                                                undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    }
                                }
                            }
                        },
                        {
                            extend: 'copy',
                            text: '<i class="mdi mdi-content-copy me-1" ></i>Copy',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function(inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = '';
                                        $.each(el, function(index, item) {
                                            if (item.classList !== undefined && item
                                                .classList.contains('institution-name')) {
                                                result = result + item.lastChild
                                                    .firstChild.textContent;
                                            } else if (item.innerText ===
                                                undefined) {
                                                result = result + item.textContent;
                                            } else result = result + item.innerText;
                                        });
                                        return result;
                                    }
                                }
                            }
                        }
                    ]
                }],



            });

            // Fixed header
            if (window.Helpers.isNavbarFixed()) {
                var navHeight = $('#layout-navbar').outerHeight();
                new $.fn.dataTable.FixedHeader(dt_fixedheader).headerOffset(navHeight);
            } else {
                new $.fn.dataTable.FixedHeader(dt_fixedheader);
            }
        });
    </script>

    {{-- <script>
        $(document).ready(() => {
            Dropzone.autoDiscover = false;
            const dropzones = []
            $('.dropzone').each(function(i, el) {
                const name = 'g_' + $(el).data('field')

                const previewTemplate = `<div class="dz-preview dz-file-preview">
        <div class="dz-details">
        <div class="dz-thumbnail">
            <img data-dz-thumbnail>
            <span class="dz-nopreview">No preview</span>
            <div class="dz-success-mark"></div>
            <div class="dz-error-mark"></div>
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
            <div class="dz-complete">
                <div class="progress">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                </div>
            </div>

        </div>
        <div class="dz-filename" data-dz-name></div>
        <div class="dz-size" data-dz-size></div>
        </div>
        </div>`;


                var myDropzone = new Dropzone(el, {
                    previewTemplate: previewTemplate,
                    url: window.location.pathname,
                    autoProcessQueue: false,
                    uploadMultiple: true,
                    parallelUploads: 100,
                    maxFiles: 100,
                    paramName: name,
                    addRemoveLinks: true,
                })
                dropzones.push(myDropzone)
            })

            // document.querySelector("button[type=submit]").addEventListener("click", function(e) {
            //     // Make sure that the form isn't actually being sent.
            //     e.preventDefault();
            //     e.stopPropagation();
            //     let form = new FormData($('form')[0])

            //     dropzones.forEach(dropzone => {
            //         let {
            //             paramName
            //         } = dropzone.options
            //         dropzone.files.forEach((file, i) => {
            //             form.append(paramName + '[' + i + ']', file)
            //         })
            //     })
            //     $.ajax({
            //         method: 'POST',
            //         data: form,
            //         processData: false,
            //         contentType: false,
            //         success: function(response) {
            //             window.location.replace(response)
            //         }
            //     });
            // });
        })
    </script> --}}
@endsection



{{-- buttons: [{
    extend: 'collection',
    className: 'btn btn-label-primary dropdown-toggle me-2 waves-effect waves-light',
    text: '<i class="mdi mdi-export-variant me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
    buttons: [{
            extend: 'print',
            text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
            className: 'dropdown-item',
            exportOptions: {
                columns: [3, 4, 5, 6, 7],
                // prevent avatar to be display
                format: {
                    body: function(inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function(index, item) {
                            if (item.classList !== undefined && item
                                .classList.contains('institution-name')) {
                                result = result + item.lastChild
                                    .firstChild.textContent;
                            } else if (item.innerText ===
                                undefined) {
                                result = result + item.textContent;
                            } else result = result + item.innerText;
                        });
                        return result;
                    }
                }
            },
            customize: function(win) {
                //customize print view for dark
                $(win.document.body)
                    .css('color', config.colors.headingColor)
                    .css('border-color', config.colors.borderColor)
                    .css('background-color', config.colors.bodyBg);
                $(win.document.body)
                    .find('table')
                    .addClass('compact')
                    .css('color', 'inherit')
                    .css('border-color', 'inherit')
                    .css('background-color', 'inherit');
            }
        },
        {
            extend: 'csv',
            text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
            className: 'dropdown-item',
            exportOptions: {
                columns: [3, 4, 5, 6, 7],
                // prevent avatar to be display
                format: {
                    body: function(inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function(index, item) {
                            if (item.classList !== undefined && item
                                .classList.contains('institution-name')) {
                                result = result + item.lastChild
                                    .firstChild.textContent;
                            } else if (item.innerText ===
                                undefined) {
                                result = result + item.textContent;
                            } else result = result + item.innerText;
                        });
                        return result;
                    }
                }
            }
        },
        {
            extend: 'excel',
            text: '<i class="mdi mdi-file-excel-outline me-1"></i>Excel',
            className: 'dropdown-item',
            exportOptions: {
                columns: [3, 4, 5, 6, 7],
                // prevent avatar to be display
                format: {
                    body: function(inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function(index, item) {
                            if (item.classList !== undefined && item
                                .classList.contains('institution-name')) {
                                result = result + item.lastChild
                                    .firstChild.textContent;
                            } else if (item.innerText ===
                                undefined) {
                                result = result + item.textContent;
                            } else result = result + item.innerText;
                        });
                        return result;
                    }
                }
            }
        },
        {
            extend: 'pdf',
            text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
            className: 'dropdown-item',
            exportOptions: {
                columns: [3, 4, 5, 6, 7],
                // prevent avatar to be display
                format: {
                    body: function(inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function(index, item) {
                            if (item.classList !== undefined && item
                                .classList.contains('institution-name')) {
                                result = result + item.lastChild
                                    .firstChild.textContent;
                            } else if (item.innerText ===
                                undefined) {
                                result = result + item.textContent;
                            } else result = result + item.innerText;
                        });
                        return result;
                    }
                }
            }
        },
        {
            extend: 'copy',
            text: '<i class="mdi mdi-content-copy me-1" ></i>Copy',
            className: 'dropdown-item',
            exportOptions: {
                columns: [3, 4, 5, 6, 7],
                // prevent avatar to be display
                format: {
                    body: function(inner, coldex, rowdex) {
                        if (inner.length <= 0) return inner;
                        var el = $.parseHTML(inner);
                        var result = '';
                        $.each(el, function(index, item) {
                            if (item.classList !== undefined && item
                                .classList.contains('institution-name')) {
                                result = result + item.lastChild
                                    .firstChild.textContent;
                            } else if (item.innerText ===
                                undefined) {
                                result = result + item.textContent;
                            } else result = result + item.innerText;
                        });
                        return result;
                    }
                }
            }
        }
    ]
}] --}}
