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

@section('footer_page_js')
    <script src="{{ asset('public/materialize/assets/js/tables-datatables-extensions.js') }}"></script>
@endsection


<!-- CONTENT: MY PROFILE -->
@section('content')
@php
    $page = Session::get('page');
    $page_title = $page['page_title'];
    $page_url = $page['page_url'];
@endphp


<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> My Profile</h4> --}}
    <h4 class="py-3 mb-4" href="{{ $page_url }}"><span class="text-muted fw-light"></span> {{ $page_title }}</h4>

    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset('public/materialize/assets/img/pages/profile-banner.png') }}" alt="Banner image"
                        class="rounded-top" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{ asset('public/materialize/assets/img/avatars/1.png') }}" alt="user image"
                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>John Doe</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item">
                                        <i class="mdi mdi-invert-colors me-1 mdi-20px"></i><span class="fw-medium">UX
                                            Designer</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="mdi mdi-map-marker-outline me-1 mdi-20px"></i><span
                                            class="fw-medium">Vatican City</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="mdi mdi-calendar-blank-outline me-1 mdi-20px"></i><span
                                            class="fw-medium"> Joined April 2021</span>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary">
                                <i class="mdi mdi-account-check-outline me-1"></i>Connected
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- Navbar pills -->
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i
                            class="mdi mdi-account-outline me-1 mdi-20px"></i>Profile</a>
                </li>
                <li class="nav-item" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <a class="nav-link" href="javascript:void(0);"><i
                            class="mdi mdi-account-edit-outline me-1 mdi-20px"></i>Edit Profile</a>
                </li>

            </ul>
        </div>
    </div>
    <!--/ Navbar pills -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">About</small>
                    <ul class="list-unstyled my-3 py-1">
                        <li class="d-flex align-items-center mb-3">
                            <i class="mdi mdi-account-outline mdi-24px"></i><span class="fw-medium mx-2">Full
                                Name:</span> <span>John Doe</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="mdi mdi-check mdi-24px"></i><span class="fw-medium mx-2">Status:</span>
                            <span>Active</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="mdi mdi-star-outline mdi-24px"></i><span class="fw-medium mx-2">Role:</span>
                            <span>Developer</span>
                        </li>
                    </ul>
                    <small class="card-text text-uppercase">Contacts</small>
                    <ul class="list-unstyled my-3 py-1">
                        <li class="d-flex align-items-center mb-3">
                            <i class="mdi mdi-whatsapp mdi-24px"></i><span class="fw-medium mx-2">Contact:</span>
                            <span>(123) 456-7890</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="mdi mdi-email-outline mdi-24px"></i><span class="fw-medium mx-2">Email:</span>
                            <span>john.doe@example.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!--/ About User -->

        </div>
    </div>
    <!--/ User Profile Content -->

    {{-- MERGED MODALS: v_edit_profile_modal --}}
    @include('userpanels.modals.v_editprofile_modal')
    <!-- / v_edit_profile_modal -->


</div>
@endsection
<!-- / CONTENT: MY PROFILE -->
