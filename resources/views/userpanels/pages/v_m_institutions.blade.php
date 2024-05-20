{{-- EXTEND: BASE WRAPPER --}}
@extends('userpanels.layouts.v_main')

@section('head_page_cssjs')
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/dropzone/dropzone.css') }}" />
    <script src="{{ asset('public/materialize/assets/vendor/libs/dropzone/dropzone.js') }}"></script>

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




<!-- CONTENT: M-INSTITUTIONS -->
@section('content')
    @php
        $page = Session::get('page');
        $page_title = $page['page_title'];
        $page_url = $page['page_url'];
    @endphp
    {{-- HTML BELOW --}}

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">UserPanels /</span> <a href="{{ route('m-institutions') }}">{{ $page_title }}</a></h4>


        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0 align-middle">{{ $page_title }} Data</h5>
                <div class="d-inline-block">
                    <a href="javascript:;"
                        class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown"><i class="mdi mdi-table-cog"></i></a>
                    <div class="dropdown-menu dropdown-menu-end m-0">
                        <a href="javascript:;" class="dropdown-item text-success add-record btn-sm mdi mdi-image-text"> Add New Data</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;" class="dropdown-item text-danger delete-record btn-sm mdi mdi-database-settings"> ResetTable</a>
                    </div>
                </div>

            </div>
            <div class="card-datatable table-responsive">
                <!--/ TABLE -->
                <table id="DataTables_Table_1" class="dt-fixedheader table table-bordered">
                    <thead class="">
                        <tr>
                            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 18px;"
                                aria-label="Actions">ACT</th>
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
                                            class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            <a href="javascript:;" class="dropdown-item btn-text-success btn-sm mdi mdi-image-text"> Details</a>
                                            <a href="javascript:;" class="dropdown-item btn-text-warning btn-sm mdi mdi-pencil-outline"> Edit</a>
                                            <div class="dropdown-divider"></div>
                                                <a href="javascript:;" class="dropdown-item text-danger delete-record btn-sm mdi mdi-trash-can-outline"> Delete</a>
                                        </div>
                                    </div>

                                </td>
                                <td>John Doe</td>
                                <td>Category 1</td>
                                <td>1234567890</td>
                                <td><img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt="Logo 1" style="height: 24px; width: 24px;"></td>
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
<!-- CONTENT: M-INSTITUTIONS -->



@section('footer_page_js')
    {{-- <script src="{{ asset('public/materialize/assets/js/tables-datatables-extensions.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            var dt_fixedheader = $('.dt-fixedheader');
            $('#DataTables_Table_1').DataTable({
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
                }]
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
@endsection
