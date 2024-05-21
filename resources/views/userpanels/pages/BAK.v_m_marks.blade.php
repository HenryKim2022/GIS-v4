{{-- EXTEND: BASE WRAPPER --}}
@extends('userpanels.layouts.v_main')

@section('head_page_cssjs')
    {{-- Leaflet from NPM Leaflet: --}}
    <link rel="stylesheet" href="{{ asset('public/plugins/leaflet-official/leaflet.base.vlastest/dist/leaflet.css') }}" />

    {{-- LeafletFullscreen: For Modern Browser --}}
    <link rel="stylesheet"
        href="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.vlastest/Control.FullScreen.css') }}" />

    {{-- LeafletFullscreen: For Old Browser: NOT USED! --}}
    {{-- <link rel="stylesheet"
     href="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.v1.0.1/dist/leaflet.fullscreen.css') }}" />
     <script src="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.v1.0.1/dist/Leaflet.fullscreen.min.js') }}">
     </script> --}}

    {{-- LeafletGestureHandling --}}
    <link rel="stylesheet"
        href="{{ asset('public/plugins/leaflet-official/leaflet.gesturehandling.vlastest/dist/leaflet-gesture-handling.min.css') }}" />


    {{-- LeafletToolbar (base) --}}
    <link rel="stylesheet"
        href="{{ asset('public/plugins/leaflet-official/leaflet.draw.toolbar/leaflet.toolbar.base.vlastest/dist/leaflet.toolbar.min.css') }}" />

    {{-- LeafletLocateControl (addons) --}}
    <link rel="stylesheet"
        href="{{ asset('public/plugins/leaflet-official/leaflet.locatecontrol.vlastest/dist/L.Control.Locate.min.css') }}" />

    {{-- LeafletSearch (addons) --}}
    <link rel="stylesheet"
        href="{{ asset('public/plugins/leaflet-official/leaflet.search.vlastest/src/leaflet-search.css') }}" />

    {{-- LeafletViewReset (addons) --}}
    <link rel="stylesheet"
        href="{{ asset('public/plugins/leaflet-official/leaflet.resetview/dist/L.Control.ResetView.min.css') }}" />

    {{-- LeafletControlGeocoder (addons) --}}
    <link rel="stylesheet"
        href="{{ asset('public/plugins/leaflet-official/leaflet.control.geocoder/dist/Control.Geocoder.css') }}" />

    {{-- LeafletRoutingMachine (addons) --}}
    <link rel="stylesheet"
        href="{{ asset('public/plugins/leaflet-official/leaflet.routing.machine/dist/leaflet-routing-machine.css') }}" />



    {{-- <link rel="stylesheet"
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
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" /> --}}
@endsection

@push('scripts')
    {{-- LeafletExtraMarkers (addons) --}}
    <script src="{{ asset('public/plugins/leaflet-official/leaflet.base.vlastest/dist/leaflet.js') }}"></script>
    <script src="{{ asset('public/plugins/leaflet-official/leaflet.base.vlastest/dist/leaflet-src.js') }}"></script>
    <script src="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.vlastest/Control.FullScreen.js') }}">
    </script>
    <script
        src="{{ asset('public/plugins/leaflet-official/leaflet.gesturehandling.vlastest/dist/leaflet-gesture-handling.min.js') }}">
    </script>
    <script
        src="{{ asset('public/plugins/leaflet-official/leaflet.draw.toolbar/leaflet.toolbar.base.vlastest/dist/leaflet.toolbar.min.js') }}">
    </script>
    <script
        src="{{ asset('public/plugins/leaflet-official/leaflet.locatecontrol.vlastest/dist/L.Control.Locate.min.js') }}">
    </script>
    <script src="{{ asset('public/plugins/leaflet-official/leaflet.search.vlastest/src/leaflet-search.js') }}"></script>
    <script src="{{ asset('public/plugins/leaflet-official/leaflet.resetview/dist/L.Control.ResetView.min.js') }}">
    </script>
    <script src="{{ asset('public/plugins/leaflet-official/leaflet.control.geocoder/dist/Control.Geocoder.js') }}">
    </script>
    <script src="{{ asset('public/plugins/leaflet-official/leaflet.routing.machine/dist/leaflet-routing-machine.js') }}">
    </script>
@endpush



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
                href="{{ $page_url }}">{{ $page_title }}</a></h4>
        <div id="leaflet_card">

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="mb-0 align-middle">{{ $page_title }} Data</h5>

                    <div class="nav-align-top">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-justified-maps" aria-controls="navs-justified-home"
                                    aria-selected="true">
                                    <i class="tf-icons mdi mdi-map-legend me-1"></i> From Maps
                                    <span
                                        class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">3</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-justified-table" aria-controls="navs-justified-profile"
                                    aria-selected="false">
                                    <i class="tf-icons mdi mdi-table-large me-1"></i> From Table
                                </button>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="card-body pt-0">
                    <div class="tab-content p-0">
                        <div class="tab-pane fade show active leaflet_card_body" id="navs-justified-maps" role="tabpanel">
                            <div id="map" class="leaflet-map leaflet_wrapper" id="userLocation">

                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-justified-table" role="tabpanel">
                            <div class="d-inline-block d-flex justify-content-end" style="z-index: 1103;">
                                <a href="javascript:;"
                                    class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="mdi mdi-table-cog"></i></a>
                                <div class="dropdown-menu dropdown-menu-end m-0">
                                    <a href="javascript:;"
                                        class="dropdown-item text-success add-record btn-sm mdi mdi-image-text"> Add New
                                        Data</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:;"
                                        class="dropdown-item text-danger delete-record btn-sm mdi mdi-database-settings">
                                        ResetTable</a>
                                </div>
                            </div>

                            <div class="card-datatable table-responsive">
                                <!--/ TABLE -->
                                <table id="DataTables_Table_Marks" class="dt-fixedheader table table-bordered">
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
                                                            class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown"><i
                                                                class="mdi mdi-dots-vertical"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                                            <a href="javascript:;"
                                                                class="dropdown-item btn-text-success btn-sm mdi mdi-image-text">
                                                                Details</a>
                                                            <a href="javascript:;"
                                                                class="dropdown-item btn-text-warning btn-sm mdi mdi-pencil-outline">
                                                                Edit</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a href="javascript:;"
                                                                class="dropdown-item text-danger delete-record btn-sm mdi mdi-trash-can-outline">
                                                                Delete</a>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td>John Doe</td>
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

                    </div>
                </div>


                <!-- / v_viewmark_modal -->
                {{-- MERGED MODALS: v_editmark_modal --}}
                @include('userpanels.modals.v_editmark_modal')
                <!-- / v_editmark_modal -->
                {{-- MERGED MODALS: v_viewmark_modal --}}
                @include('userpanels.modals.v_viewmark_modal')
                <!-- / v_viewmark_modal -->


                <script src="{{ asset('public/plugins/leaflet-official/data.geojson.json/data.v1.js') }}"></script>
                <script src="{{ asset('public/plugins/leaflet-official/leaflet-map-merged-config-user-panels.js') }}"></script>


            </div>
            <!--/ TABLE -->

        </div>


    </div>
@endsection
<!-- CONTENT: M-MARKS -->


@section('footer_page_js')
    {{-- <script src="{{ asset('public/materialize/assets/js/tables-datatables-extensions.js') }}"></script> --}}


    <script>
        $(document).ready(function() {
            var dt_fixedheader = $('.dt-fixedheader');
            $('#DataTables_Table_Marks').DataTable({
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

            // // Fixed header
            // if (window.Helpers.isNavbarFixed()) {
            //     var navHeight = $('#layout-navbar').outerHeight();
            //     new $.fn.dataTable.FixedHeader(dt_fixedheader).headerOffset(navHeight);
            // } else {
            //     new $.fn.dataTable.FixedHeader(dt_fixedheader);
            // }
        });
    </script>
@endsection

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
                                        </div>
                                    `;


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
