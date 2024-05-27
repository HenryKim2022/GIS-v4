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
        href="{{ asset('public/materialize/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
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
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">UserPanels /</span> <a
                href="{{ $page_url }}">{{ $page_title }}</a></h4>


        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0 align-middle">{{ $page_title }} Data</h5>
                <div class="d-inline-block">
                    <a href="javascript:;"
                        class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown"><i class="mdi mdi-table-cog"></i></a>
                    <div class="dropdown-menu dropdown-menu-end m-0">
                        <a href="javascript:;" class="dropdown-item text-success add-record btn-sm mdi mdi-image-text"> Add
                            New Data</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;"
                            class="dropdown-item text-danger reset-record btn-sm mdi mdi-database-settings"> ResetTable</a>
                    </div>
                </div>

            </div>
            <div class="card-datatable table-responsive">
                <!--/ TABLE -->
                <table id="DataTables_Table_1" class="dt-fixedheader table table-bordered">
                    <thead class="">
                        <tr>
                            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                style="width: 18px;" aria-label="Actions">ACT</th>
                            <th>NO.</th>
                            <th>NAME</th>
                            <th>CATEGORY</th>
                            <th>NPSN</th>
                            <th>LOGO</th>
                            <th>IMAGES</th>
                            <th>ADDRESS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 8;
                        @endphp
                        @for ($i = 1; $i < $count; $i++)
                            <tr>
                                <td class="dtr-hidden" tabindex="0" style="">
                                    <div class="d-inline-block">
                                        <a href="javascript:;"
                                            class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            <a class="d-none" href="javascript:;"
                                                class="dropdown-item btn-text-success detail-record btn-sm mdi mdi-image-text">Details</a>
                                            <a href="javascript:;"
                                                class="dropdown-item btn-text-warning edit-record-{{ $i }} btn-sm mdi mdi-pencil-outline">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:;"
                                                class="dropdown-item text-danger delete-record btn-sm mdi mdi-trash-can-outline">Delete</a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $i }}</td>
                                <td>John Doe {{ $i }}</td>
                                <td>Category {{ $i }}</td>
                                <td>1234567890</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-around">
                                        <img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt="Logo 1"
                                            style="height: 24px; width: 24px;" class="hover-image">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-around gap-1 gap-md-0 gap-lg-0">
                                        <img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt="Logo 1"
                                            class="hover-image mr-2" style="height: 24px; width: 24px;">
                                        <img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt="Logo 1"
                                            class="hover-image mr-2" style="height: 24px; width: 24px;">
                                        <img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt="Logo 1"
                                            class="hover-image mr-2" style="height: 24px; width: 24px;">
                                    </div>
                                </td>
                                <td>Address 1</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>

                <style>
                    .hover-image {
                        cursor: pointer;
                    }

                    #image-popup {
                        display: none;
                        position: fixed;
                        background-color: inherit;
                        padding: 10px;
                        box-shadow: inherit;
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
                <div id="image-popup" class="modal-dialog-centered col-8 col-sm-6 col-md-4 p-2">
                    {{-- Add span button here ( image-popup close btn), the button was hovered over the img at the top-right corner over img --}}
                    <span class="close-btn btn btn-sm btn-text-primary rounded-pill btn-icon"><i
                            class="mdi mdi-close"></i></span>
                    <img src="" alt="Large Image" />
                </div>
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
                    });
                </script>
                <!--/ TABLE -->

            </div>
        </div>


        <!-- Modal to add new record -->
        <!-- MERGED MODALS: v_m_institution_modal  -->
        @include('userpanels.modals.vmm.m_institu.vm_addinstitu_modal')
        @include('userpanels.modals.vmm.m_institu.vm_editinstitu_modal')



    </div>
@endsection
<!-- CONTENT: M-INSTITUTIONS -->



@section('footer_page_js')
    {{-- <script src="{{ asset('public/materialize/assets/js/tables-datatables-extensions.js') }}"></script> --}}
    <script src="{{ asset('public/materialize/assets/js/forms-selects.js') }}"></script>
    {{-- <script src="{{ asset('public/materialize/assets/js/forms-tagify.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/materialize/assets/js/forms-typeahead.js') }}"></script> --}}

    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_institu/tbinit_institu.js') }}"></script>
    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_institu/add_institu.js') }}"></script>
    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_institu/edit_institu.js') }}"></script>
@endsection
