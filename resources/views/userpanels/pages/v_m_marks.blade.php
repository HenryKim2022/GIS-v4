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

    <style>
        .hover-image {
            cursor: pointer;
        }

        #image-popup {
            display: none;
            position: fixed;
            background-color: #30334e;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            background-clip: padding-box;
            border: 1px solid rgba(20, 21, 33, 0.175);
            border-radius: 0.625rem;
            outline: 0;
            z-index: 9999;
        }

        #image-popup img {
            width: 100%;
        }

        #image-popup .close-btn {
            position: absolute;
            top: 1rem;
            right: 1.6rem;
            cursor: pointer;
            color: #fff;
            background-color: rgba(248, 23, 23, 0.267);
        }

        #image-popup .close-btn:hover {
            background-color: rgba(248, 23, 23, 0.945);
        }

        /* CSS */
        @-moz-document url-prefix() {
            .modal-body {
                overflow-x: hidden !important;
            }
        }
    </style>
@endsection

@section('scripts')
@endsection

@push('scripts')
@endpush



<!-- CONTENT: M-MARKS -->
@section('content')
    @php
        $page = Session::get('page');
        $page_title = $page['page_title'];
        $page_url = $page['page_url'];
    @endphp
    {{-- HTML BELOW --}}


    <div id="image-popup" class="modal-dialog-centered col-8 col-sm-6 col-md-4 p-2">
        {{-- Add span button here ( image-popup close btn), the button was hovered over the img at the top-right corner over img --}}
        <span class="close-btn btn btn-sm btn-text-primary rounded-pill btn-icon"><i class="mdi mdi-close"></i></span>
        <img src="" alt="Large Image" />
    </div>


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">UserPanels /</span> <a
                href="{{ $page_url }}">{{ $page_title }}</a></h4>

        <div class="card">
            <div class="card-header p-0">
                <div class="nav-align-top">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-maps" aria-controls="navs-justified-profile"
                                aria-selected="true">
                                <i class="tf-icons mdi mdi-table-large me-1"></i> From Maps
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-tables" aria-controls="navs-justified-home"
                                aria-selected="false">
                                <i class="tf-icons mdi mdi-map-legend me-1"></i> From Table
                                {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">3</span> --}}
                            </button>
                        </li>
                    </ul>
                </div>
            </div>




            {{-- <div class="card-body"> --}}
            <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="navs-justified-maps" role="tabpanel">

                    <div id="leaflet_card">
                        <div class="card mb-0">
                            <div class="card-header d-flex justify-content-end">
                                <div class="d-inline-block d-none">
                                    <a href="javascript:;"
                                        class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="mdi mdi-table-cog"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end m-0" style="z-index: 1086;">
                                        <a href="javascript:;" target="modal" data-bs-target="#addMarkModalTB"
                                            class="dropdown-item text-success add-record btn-sm mdi mdi-image-text">
                                            Add
                                            New Data</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="javascript:;"
                                            class="dropdown-item text-danger reset-all-marks-record btn-sm mdi mdi-database-settings">
                                            ResetTable</a>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body pt-0">
                                <div id="map" class="leaflet-map">

                                </div>
                            </div>

                            {{-- MERGED MODALS: v_viewmark_modal --}}
                            @include('userpanels.modals.v_viewmark_modal')
                            <!-- / v_viewmark_modal -->
                            {{-- MERGED MODALS: v_editmark_modal --}}
                            @include('userpanels.modals.v_editmark_modal')
                            <!-- / v_editmark_modal -->

                            <script src="{{ asset('public/plugins/leaflet-official/data.geojson.json/data.v1.js') }}"></script>
                            <script src="{{ asset('public/plugins/leaflet-official/leaflet-map-merged-config-user-panels.js') }}"></script>

                        </div>

                    </div>

                </div>



                <div class="tab-pane fade" id="navs-justified-tables" role="tabpanel">
                    <div id="leaflet_card p-0">
                        <div class="card mb-0">

                            <div class="card-header d-flex justify-content-end pb-0">
                                <div class="d-inline-block">
                                    <a href="javascript:;"
                                        class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="mdi mdi-table-cog"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end m-0">
                                        <a href="javascript:;"
                                            class="dropdown-item text-success add-record btn-sm mdi mdi-image-text"
                                            data-bs-toggle="modal" data-bs-target="#addMarkModalTB"> Add
                                            New Data</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="javascript:;"
                                            class="dropdown-item text-danger reset-all-marks-record btn-sm mdi mdi-database-settings">
                                            ResetTable</a>
                                    </div>
                                </div>

                            </div>

                            <div class="card-body pt-0">
                                <div class="card-datatable table-responsive">
                                    <!--/ TABLE -->

                                    <table id="DataTables_Table_1" class="dt-fixedheader table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="control sorting_disabled dtr-hidden" rowspan="1"
                                                    colspan="1" style="width: 18px;" aria-label="Actions">ACT</th>
                                                <th style="width: 18px;">NO.</th>
                                                <th>LATITUDE</th>
                                                <th>LONGITUDE</th>
                                                <th>MARK-ADDR</th>
                                                <th>CREATED</th>
                                                <th>LAST-UPDATE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($loadMarksFromDB as $index => $mark)
                                                <tr>
                                                    <td class="dtr-hidden" tabindex="0" style="">
                                                        <!-- Action buttons -->
                                                        <div class="d-inline-block">
                                                            <a href="javascript:;"
                                                                class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown"><i
                                                                    class="mdi mdi-dots-vertical"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end m-0">
                                                                <a class="d-none" href="javascript:;"
                                                                    class="dropdown-item btn-text-success detail-record btn-sm mdi mdi-image-text">Details</a>

                                                                <a href="javascript:;"
                                                                    mark_id_value="{{ $mark->mark_id }}"
                                                                    class="dropdown-item btn-text-warning edit-record-{{ $index + 1 }} btn-sm mdi mdi-pencil-outline">Edit</a>

                                                                <div class="dropdown-divider"></div>
                                                                <a href="javascript:;"
                                                                    mark_id_value="{{ $mark->mark_id }}"
                                                                    class="dropdown-item text-danger delete-record btn-sm mdi mdi-trash-can-outline">Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $mark->mark_lat }}</td>
                                                    <td>{{ $mark->mark_lon }}</td>
                                                    <td>{{ $mark->mark_address }}</td>
                                                    <td>{{ $mark->created_at }}</td>
                                                    <td>{{ $mark->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!--/ TABLE -->

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal to add new record -->
                    <!-- MERGED MODALS: v_m_marks_modal -->
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            {{-- @include('userpanels.modals.v_addmark_modal') --}}
                            @include('userpanels.modals.vmm.m_mark.vm_addmark_modal_for_tb')
                            @include('userpanels.modals.vmm.m_mark.vm_editmark_modal_for_tb')

                        </div>
                    </div>
                    <!-- / v_addmark_modal -->

                </div>




            </div>
            {{-- </div> --}}


            <!-- Add the necessary JavaScript code to handle tab functionality -->
            {{-- <script>
                // Wait for the page to fully load
                document.addEventListener("DOMContentLoaded", function() {
                    // Add event listener to the tab links
                    const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
                    tabLinks.forEach(function(tabLink) {
                        tabLink.addEventListener("shown.bs.tab", function(event) {
                            // Get the target tab pane ID
                            const targetPaneId = event.target.getAttribute("data-bs-target");
                            // Find the target tab pane element
                            const targetPane = document.querySelector(targetPaneId);
                            // Scroll to the target tab pane
                            if (targetPane) {
                                targetPane.scrollIntoView({
                                    behavior: "smooth"
                                });
                            }
                        });
                    });
                });
            </script> --}}







        </div>


    </div>
@endsection
<!-- CONTENT: M-MARKS -->



@section('footer_page_js')
    {{-- <script src="{{ asset('public/materialize/assets/js/tables-datatables-extensions.js') }}"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hoverImages = document.querySelectorAll('.hover-image');
            const imagePopup = document.getElementById('image-popup');
            const popupImage = imagePopup.querySelector('img');
            const closeBtn = imagePopup.querySelector('.close-btn');

            hoverImages.forEach(function(image) {
                image.addEventListener('click', function() {
                    const largeImageSrc = this.getAttribute('src');
                    popupImage.src = largeImageSrc;
                    imagePopup.style.display = 'block';
                    centerPopup();
                });
            });

            closeBtn.addEventListener('click', function() {
                imagePopup.style.display = 'none';
            });


            var modalViewImagesPreview = document.getElementById('swiperImagesContainerView');
            if (modalViewImagesPreview) {
                document.getElementById('swiperImagesContainerView').addEventListener('click', function(event) {
                    // var modalImagesPreview = document.getElementById('swiperImagesContainerView');
                    var modalViewImage = new bootstrap.Modal(document.getElementById('modalViewLogoPopUp'));
                    var modalViewZoomImageContent = document.getElementById('modalViewZoomImageContent');

                    var clickedImage = event.target.closest('img');
                    if (clickedImage) {
                        const largeImageSrc = clickedImage.getAttribute('src');
                        // var clickedImageUrl = clickedImage.src;
                        popupImage.src = largeImageSrc;
                        imagePopup.style.display = 'block';
                        centerPopup();
                    }
                });
            }


            // Center the popup when the window is resized
            window.addEventListener('resize', function() {
                if (imagePopup.style.display === 'block') {
                    centerPopup();
                }
            });

            // Function to center the popup
            function centerPopup() {
                const windowWidth = window.innerWidth;
                const windowHeight = window.innerHeight;
                const popupWidth = imagePopup.offsetWidth;
                const popupHeight = imagePopup.offsetHeight;

                const topPosition = (windowHeight - popupHeight) / 2;
                const leftPosition = (windowWidth - popupWidth) / 2;

                imagePopup.style.top = topPosition + 'px';
                imagePopup.style.left = leftPosition + 'px';
            }

            var hover_images = document.querySelectorAll('.hover-image');
            if (hover_images.length > 0) {
                hover_images.forEach(function(hover_img) {
                    hover_img.setAttribute('data-bs-toggle', 'tooltip');
                    hover_img.setAttribute('data-bs-placement', 'top');
                    hover_img.setAttribute('title', 'Click to Enlarge!');
                });
            }
        });
    </script>

    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_mark/tbinit_mark.js') }}"></script>
    {{-- <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_mark/add_mark_for_tb.js') }}"></script> --}}
    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_mark/edit_mark_for_tb.js') }}"></script>
    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_mark/delete_mark_for_tb.js') }}"></script>
    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_mark/reset_mark.js') }}"></script>
@endsection
