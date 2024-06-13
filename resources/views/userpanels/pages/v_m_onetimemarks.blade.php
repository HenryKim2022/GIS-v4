{{-- EXTEND: BASE WRAPPER --}}
@extends('userpanels.layouts.v_main')


@section('head_page_cssjs')
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/dropzone/dropzone.css') }}" />
    <script src="{{ asset('public/materialize/assets/vendor/libs/dropzone/dropzone.js') }}"></script>

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
    </style>
@endsection




<!-- CONTENT: DASHBOARD -->
@section('content')
    @php
        $page = Session::get('page');
        $page_title = $page['page_title'];
        $page_url = $page['page_url'];

        $authenticated_user_data = Session::get('authenticated_user_data');
    @endphp


    <div id="image-popup" class="modal-dialog-centered col-8 col-sm-6 col-md-4 p-2">
        {{-- Add span button here ( image-popup close btn), the button was hovered over the img at the top-right corner over img --}}
        <span class="close-btn btn btn-sm btn-text-primary rounded-pill btn-icon"><i class="mdi mdi-close"></i></span>
        <img src="" alt="Large Image" />
    </div>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-4 d-flex align-content-center justify-center text-center d-none">
            <h1>
                THIS PAGE<br>IS UNDER CONSTRUCTION
            </h1>
        </div>
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">UserPanels /</span> <a
                href="{{ $page_url }}">{{ $page_title }}</a></h4>







        <div class="row gy-4">
            <div class="col-12 col-xl-12">
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
                            <div id="image-popup" class="modal-dialog-centered col-8 col-sm-6 col-md-4 p-2">
                                {{-- Add span button here ( image-popup close btn), the button was hovered over the img at the top-right corner over img --}}
                                <span class="close-btn btn btn-sm btn-text-primary rounded-pill btn-icon"><i
                                        class="mdi mdi-close"></i></span>
                                <img src="" alt="Large Image" />
                            </div>

                            <div id="leaflet_card" class="center_modal_in_layout">
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

                                                @if (auth()->user()->type == 'admin')
                                                    <div class="dropdown-divider"></div>
                                                    <a href="javascript:;" data-bs-toggle="modal"
                                                        data-bs-target="#resetMarkModalTB"
                                                        class="dropdown-item text-danger reset-all-marks-record btn-sm mdi mdi-database-settings">
                                                        ResetTable</a>
                                                @endif
                                            </div>
                                        </div>


                                        <style>
                                            span.clearInput {
                                                top: 4.52rem;
                                                right: -0.28rem;
                                                transform: translate(-50%, -50%);
                                                border-top-left-radius: 0%;
                                                border-bottom-left-radius: 0%;
                                            }

                                            input#searchLeafletField {
                                                padding-right: 3.3rem;
                                            }

                                            div.tt-menu {
                                                z-index: 1085 !important;
                                            }
                                        </style>
                                        <div class="card-body p-0" style="">
                                            <div class="col-12 mt-1">
                                                <label for="searchLeafletField" class="form-label">Search</label>
                                                <div class="w-100">
                                                    <input id="searchLeafletField"
                                                        class="form-control typeahead-multi-datasets" type="text"
                                                        autocomplete="off" placeholder="e.g jl/ jalan/ sma/ 1/ -" />
                                                    <span class="input-group-text clearInput position-absolute"
                                                        type="button" data-bs-dismiss="input" aria-label="Clear input">
                                                        <i class="mdi mdi-close"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <style>
                                        .map-overlay {
                                            z-index: 1000;
                                            display: none;
                                        }

                                        .leaflet-container .modal-dialog {
                                            margin: 0;
                                            /* Override Leaflet's margin */
                                        }

                                        .leaflet-container .modal-open {
                                            overflow: hidden;
                                            /* Prevent the page from scrolling while the modal is open */
                                        }
                                    </style>
                                    <div class="card-body pt-0">
                                        <div id="map-overlay"
                                            class="map-overlay position-fixed top-0 left-0 w-100 h-100 bg-transparent">
                                        </div>
                                        <div id="map" class="leaflet-map">
                                        </div>
                                    </div>

                                    <!-- Tab1 -->
                                    @include('userpanels.modals.vmm.m_one.vm_viewmark_modal_for_maps')
                                    @include('userpanels.modals.vmm.m_one.vm_addmark_modal_for_maps')
                                    @include('userpanels.modals.vmm.m_one.vm_editmark_modal_for_maps')
                                    @include('userpanels.modals.vmm.m_one.vm_deletemark_modal_for_maps')
                                    <script src="{{ asset('resources/views/userpanels/pages/pages_vml/m_one/userpanels_map_one.config.js') }}"></script>



                                </div>

                            </div>

                        </div>



                        <div class="tab-pane fade" id="navs-justified-tables" role="tabpanel">
                            <div class="center_modal_in_layout p-0">
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
                                                <a href="javascript:;" data-bs-toggle="modal"
                                                    data-bs-target="#resetMarkModalTB"
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
                                                            colspan="1" style="width: 18px;" aria-label="Actions">ACT
                                                        </th>
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
                                                                            class="dropdown-item btn-text-warning edit-record btn-sm mdi mdi-pencil-outline">Edit</a>

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
                                                            <td>{{ \Carbon\Carbon::parse($mark->created_at)->isoFormat('dddd, DD MMMM YYYY, h:mm:ss A') }}
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($mark->updated_at)->isoFormat('dddd, DD MMMM YYYY, h:mm:ss A') }}
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <!--/ TABLE -->

                                        </div>
                                    </div>




                                </div>


                            </div>
                        </div>
                    </div>






                </div>
            </div>
        </div>


    </div>
@endsection
<!-- / CONTENT: DASHBOARD -->




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
                    hover_img.setAttribute('data-bs-custom-class', 'tooltip-primary');
                    hover_img.setAttribute('title', 'Click to Enlarge!');
                });
            }

        });
    </script>




    {{-- ////////////////////////////////////////////////////////////////////// TOAST //////////////////////////////////////////////////////////////////////  --}}
    {{-- TOAST: ERROR/FAILED --}}
    @if ($errors->any())
        @php
            $errorMessages = $errors->all();
        @endphp

        @foreach ($errorMessages as $index => $message)
            @if ($index == 0)
                <input type="hidden" class="error-message" data-delay="{{ ($index + 1) * 0 }}"
                    value="{{ $message }}">
            @else
                <input type="hidden" class="error-message" data-delay="{{ ($index + 1) * 1000 }}"
                    value="{{ $message }}">
            @endif
        @endforeach
    @endif
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                @php
                    $errorMessages = $errors->all();
                @endphp

                @foreach ($errorMessages as $index => $message)
                    var toastErrorMsg_{{ $index }} = "{{ $message }}";
                    var delay_{{ $index }} = {{ ($index + 1) * 1000 }};

                    setTimeout(function() {
                        toastr.error(toastErrorMsg_{{ $index }}, '', {
                            closeButton: false,
                            debug: false,
                            newestOnTop: false,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            preventDuplicates: false,
                            onclick: null,
                            showDuration: '300',
                            hideDuration: '1000',
                            timeOut: '5000',
                            extendedTimeOut: '1000',
                            showEasing: 'swing',
                            hideEasing: 'linear',
                            showMethod: 'fadeIn',
                            hideMethod: 'fadeOut'
                        });
                    }, delay_{{ $index }});
                @endforeach
            @endif
        });
    </script>


    {{-- TOAST: SUCCESS --}}
    @if (Session::has('success'))
        @foreach (Session::get('success') as $index => $message)
            @if ($index == 1)
                <input type="hidden" class="success-message" data-delay="{{ ($index + 1) * 0 }}"
                    value="{{ $message }}">
            @else
                <input type="hidden" class="success-message" data-delay="{{ ($index + 1) * 1000 }}"
                    value="{{ $message }}">
            @endif
        @endforeach
    @endif

    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                @foreach (Session::get('success') as $index => $message)
                    var toastSuccessMsg_{{ $index }} = "{{ $message }}";
                    var delay_{{ $index }} = {{ ($index + 1) * 1000 }};

                    setTimeout(function() {
                        toastr.success(toastSuccessMsg_{{ $index }}, '', {
                            closeButton: false,
                            debug: false,
                            newestOnTop: false,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            preventDuplicates: false,
                            onclick: null,
                            showDuration: '300',
                            hideDuration: '1000',
                            timeOut: '5000',
                            extendedTimeOut: '1000',
                            showEasing: 'swing',
                            hideEasing: 'linear',
                            showMethod: 'fadeIn',
                            hideMethod: 'fadeOut'
                        });
                    }, delay_{{ $index }});
                @endforeach
            @endif
        });
    </script>





    {{-- TOAST: NORMAL ERROR MESSAGE --}}
    @if (Session::has('n_errors'))
        @foreach (Session::get('n_errors') as $index => $message)
            @if ($index == 1)
                <input type="hidden" class="n-error-message" data-delay="{{ ($index + 1) * 0 }}"
                    value="{{ $message }}">
            @else
                <input type="hidden" class="n-error-message" data-delay="{{ ($index + 1) * 1000 }}"
                    value="{{ $message }}">
            @endif
        @endforeach
    @endif
    <script>
        $(document).ready(function() {
            @if (Session::has('n_errors'))
                @foreach (Session::get('n_errors') as $index => $message)
                    var toastNErrorMsg_{{ $index }} = "{{ $message }}";
                    var delay_{{ $index }} = {{ ($index + 1) * 1000 }};

                    setTimeout(function() {
                        toastr.error(toastNErrorMsg_{{ $index }}, '', {
                            closeButton: false,
                            debug: false,
                            newestOnTop: false,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            preventDuplicates: false,
                            onclick: null,
                            showDuration: '300',
                            hideDuration: '1000',
                            timeOut: '5000',
                            extendedTimeOut: '1000',
                            showEasing: 'swing',
                            hideEasing: 'linear',
                            showMethod: 'fadeIn',
                            hideMethod: 'fadeOut'
                        });
                    }, delay_{{ $index }});
                @endforeach
            @endif
        });
    </script>

    {{-- ////////////////////////////////////////////////////////////////////// ./TOAST //////////////////////////////////////////////////////////////////////  --}}




@endsection
