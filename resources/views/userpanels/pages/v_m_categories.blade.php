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




<!-- CONTENT: M-CATEGORIES -->
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
                        <a href="javascript:;" class="dropdown-item text-success add-record btn-sm mdi mdi-image-text"
                            data-bs-toggle="modal" data-bs-target="#addCatModalTB"> Add
                            New Data</a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:;"
                            class="dropdown-item text-danger reset-all-categories-record btn-sm mdi mdi-database-settings">
                            ResetTable</a>
                    </div>
                </div>

            </div>


            <div class="card-datatable table-responsive">
                <!--/ TABLE -->
                <div class="card-body pt-0">
                    <div class="card-datatable table-responsive">
                        <!--/ TABLE -->

                        <table id="DataTables_Table_1" class="dt-fixedheader table table-bordered">
                            <thead>
                                <tr>
                                    <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                        style="width: 18px;" aria-label="Actions">ACT</th>
                                    <th>NO.</th>
                                    <th>Category Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loadCategoriesFromDB as $index => $cat)
                                    <tr>
                                        <td class="dtr-hidden" tabindex="0" style="">
                                            <!-- Action buttons -->
                                            <div class="d-inline-block">
                                                <a href="javascript:;"
                                                    class="btn btn-sm btn-text-primary rounded-pill btn-icon dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end m-0">
                                                    <a class="d-none" href="javascript:;"
                                                        class="dropdown-item btn-text-success detail-record btn-sm mdi mdi-image-text">Details</a>

                                                    <a href="javascript:;" cat_id_value="{{ $cat->cat_id }}"
                                                        class="dropdown-item btn-text-warning edit-record-{{ $index + 1 }} btn-sm mdi mdi-pencil-outline">Edit</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a href="javascript:;" cat_id_value="{{ $cat->cat_id }}"
                                                        class="dropdown-item text-danger delete-record btn-sm mdi mdi-trash-can-outline">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $cat->cat_name }}</td>
                                        <td>{{ $cat->created_at }}</td>
                                        <td>{{ $cat->updated_at }}</td>
                                    </tr>
                                @endforeach
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

            </div>
        </div>


        <!-- Modal to add new record -->
        <!-- MERGED MODALS: v_m_cat_modal -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                @include('userpanels.modals.vmm.m_cat.vm_addcat_modal_for_tb')
                @include('userpanels.modals.vmm.m_cat.vm_editcat_modal_for_tb')

            </div>
        </div>
        <!-- / v_addcat_modal -->


    </div>
@endsection
<!-- CONTENT: M-CATEGORIES -->



@section('footer_page_js')
    {{-- <script src="{{ asset('public/materialize/assets/js/tables-datatables-extensions.js') }}"></script> --}}

    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_cat/tbinit_cat.js') }}"></script>
    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_cat/edit_cat_for_tb.js') }}"></script>
    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_cat/delete_cat_for_tb.js') }}"></script>
    <script src="{{ asset('resources/views/userpanels/pages/pages_vmj/m_cat/reset_cat.js') }}"></script>
@endsection
