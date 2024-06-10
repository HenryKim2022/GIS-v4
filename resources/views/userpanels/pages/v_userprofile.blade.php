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


<!-- CONTENT: MY PROFILE -->
@section('content')
    @php
        $page = Session::get('page');
        $page_title = $page['page_title'];
        $page_url = $page['page_url'];

        $authenticated_user_data = Session::get('authenticated_user_data');
    @endphp


    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- <h4 class="py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> My Profile</h4> --}}
        <h4 class="py-3 mb-4" href="{{ $page_url }}"><span class="text-muted fw-light"></span> {{ $page_title }}
        </h4>

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
                            {{-- <img src="{{ asset('public/materialize/assets/img/avatars/1.png') }}" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" /> --}}
                            <img src="{{ $authenticated_user_data->user_image ?: env('APP_NOIMAGE') }}"
                                alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4>{{ $authenticated_user_data->firstname && $authenticated_user_data->lastname ? $authenticated_user_data->firstname . ' ' . $authenticated_user_data->lastname : $authenticated_user_data->firstname }}
                                    </h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-invert-colors me-1 mdi-20px"></i><span
                                                class="fw-medium">{{ $authenticated_user_data->type }}</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-calendar-blank-outline me-1 mdi-20px"></i>
                                            <span class="fw-medium"> LastUpdate:
                                                {{ \Carbon\Carbon::parse($authenticated_user_data->updated_at)->isoFormat('dddd, DD MMMM YYYY, h:mm:ss A') }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-primary">
                                    <i class="mdi mdi-account-check-outline me-1"></i>Active
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
                {{-- <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i
                                class="mdi mdi-account-outline me-1 mdi-20px"></i>Profile</a>
                    </li>
                    <li class="nav-item" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <a class="nav-link" href="javascript:void(0);"><i
                            class="mdi mdi-account-edit-outline me-1 mdi-20px"></i>Edit Profile</a>
                    </li>
                </ul> --}}

                <ul class="nav nav-pills mb-3 nav-align-left overflow-x-scroll" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                            aria-selected="true">
                            <i class="tf-icons mdi mdi-account-outline me-1 mdi-20px"></i> Profile
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-editprofile"
                            aria-controls="navs-pills-justified-editprofile" aria-selected="false">
                            <i class="tf-icons mdi mdi-account-edit-outline me-1 mdi-20px"></i> Edit Profile
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-security" aria-controls="navs-pills-justified-security"
                            aria-selected="false">
                            <i class="tf-icons mdi mdi-shield-account-outline me-1 mdi-20px"></i> Security
                        </button>
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
                    <div class="card-body p-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-pills-justified-profile" role="tabpanel">
                                <!-- About User -->
                                <small class="card-text text-uppercase">About</small>
                                <ul class="list-unstyled my-3 pt-1">
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="mdi mdi-account-outline mdi-24px"></i><span class="fw-medium mx-2">Full
                                            Name:</span>
                                        <span>{{ $authenticated_user_data->firstname && $authenticated_user_data->lastname ? $authenticated_user_data->firstname . ' ' . $authenticated_user_data->lastname : $authenticated_user_data->firstname }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="mdi mdi-account-outline mdi-24px"></i><span class="fw-medium mx-2">
                                            Username:</span> <span>{{ $authenticated_user_data->user_name }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="mdi mdi-email-outline mdi-24px"></i><span class="fw-medium mx-2">
                                            Email:</span> <span>{{ $authenticated_user_data->user_email }}</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="mdi mdi-calendar-outline mdi-24px"></i><span
                                            class="fw-medium mx-2">Created:</span>
                                        <span>
                                            {{ \Carbon\Carbon::parse($authenticated_user_data->created_at)->isoFormat('dddd, DD MMMM YYYY, h:mm:ss A') }}
                                        </span>
                                    </li>
                                </ul>
                                <small class="card-text text-uppercase d-none">Contacts</small>
                                <ul class="list-unstyled my-3 pt-1 d-none">
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="mdi mdi-whatsapp mdi-24px"></i><span
                                            class="fw-medium mx-2">Contact:</span>
                                        <span>(123) 456-7890</span>
                                    </li>
                                    <li class="d-flex align-items-center mb-3">
                                        <i class="mdi mdi-email-outline mdi-24px"></i><span
                                            class="fw-medium mx-2">Email:</span>
                                        <span>john.doe@example.com</span>
                                    </li>
                                </ul>
                                <!--/ About User -->
                            </div>

                            <div class="tab-pane fade" id="navs-pills-justified-editprofile" role="tabpanel">
                                <!-- Edit Profile -->
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ $authenticated_user_data->user_image ?: env('APP_NOIMAGE') }}"
                                        alt="user-avatar" class="d-block w-px-120 h-px-120 rounded"
                                        id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input" hidden
                                                accept="image/png, image/jpeg" />
                                        </label>
                                        <button type="button" class="btn btn-outline-danger account-image-reset mb-3">
                                            <i class="mdi mdi-reload d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>

                                        <div class="small">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const uploadInput = document.getElementById('upload');
                                        const uploadedAvatar = document.getElementById('uploadedAvatar');
                                        const userId = '{{ $authenticated_user_data->user_id }}';

                                        uploadInput.addEventListener('change', function() {
                                            const file = uploadInput.files[0];
                                            const reader = new FileReader();

                                            reader.onload = function(e) {
                                                const uploadedImage = e.target.result;
                                                uploadedAvatar.src = uploadedImage;

                                                const formData = new FormData();
                                                formData.append('user_id', userId);
                                                formData.append('user_img', file);

                                                const xhr = new XMLHttpRequest();
                                                xhr.open('POST', '{{ route('myprofile.img.edit') }}');
                                                xhr.setRequestHeader('X-CSRF-Token', '{{ csrf_token() }}');
                                                xhr.onload = function() {
                                                    const response = JSON.parse(xhr.responseText);
                                                    if (response.reload) {
                                                        window.location.reload();
                                                    }
                                                };
                                                xhr.send(formData);
                                            };

                                            reader.readAsDataURL(file);
                                        });
                                    });
                                </script>



                                <div class="card-body pt-2 px-0 mt-1">
                                    {{-- <form id="formAccountSettings" method="POST" action="{{ route('myprofile.bio.edit') }}" onsubmit="return false"> --}}
                                    <form id="formAccountSettings" method="POST"
                                        action="{{ route('myprofile.bio.edit') }}">
                                        @csrf
                                        <div class="row mt-2 gy-4">
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input class="form-control" type="hidden" id="user_id"
                                                        name="user_id" value="{{ $authenticated_user_data->user_id }}" />
                                                    <input class="form-control" type="text" id="firstName"
                                                        name="firstName"
                                                        value="{{ $authenticated_user_data->firstname }}" autofocus />
                                                    <label for="firstName">First Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input class="form-control" type="text" name="lastName"
                                                        id="lastName"
                                                        value="{{ $authenticated_user_data->lastname }}" />
                                                    <label for="lastName">Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input class="form-control" type="text" id="userName"
                                                        name="userName" value="{{ $authenticated_user_data->user_name }}"
                                                        placeholder="{{ $authenticated_user_data->user_name }}" />
                                                    <label for="userName">Username</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating form-floating-outline">
                                                    <input class="form-control" type="text" id="userEmail"
                                                        name="userEmail" value="{{ $authenticated_user_data->user_email }}"
                                                        placeholder="{{ $authenticated_user_data->user_email }}" />
                                                    <label for="userEmail">Email</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary"
                                                id="cancelBtn">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                                <script>
                                    var userProfilePhotoPreview = document.getElementById('uploadedAvatar');
                                    var userProfilePhotoInput = document.getElementById('upload');
                                    userProfilePhotoInput.addEventListener('change', function() {
                                        const file = this.files[0];
                                        if (file && file.type.startsWith('image/')) {
                                            const img = document.createElement('img');
                                            img.src = URL.createObjectURL(file);

                                            img.onload = function() {
                                                userProfilePhotoPreview.src = img.src;
                                            };
                                        }
                                    });

                                    var resetButton = document.querySelector('.account-image-reset');
                                    resetButton.addEventListener('click', function() {
                                        userProfilePhotoPreview.src =
                                            '{{ $authenticated_user_data->user_image ?: env('APP_NOIMAGE') }}';
                                        userProfilePhotoInput.value = null;
                                    });
                                </script>
                                <!--/ Edit Profile -->
                            </div>

                            <div class="tab-pane fade" id="navs-pills-justified-security" role="tabpanel">
                                <!-- Edit Security -->
                                <div class="mb-4">
                                    <h5>Change Password</h5>
                                    {{-- <form id="formAccountChangePassSettings" action="{{ route('myprofile.pass.edit') }}" method="GET" onsubmit="return false"> --}}
                                    <form id="formAccountChangePassSettings" action="{{ route('myprofile.pass.edit') }}"
                                        method="POST">
                                        @csrf
                                        <div class="row g-3 mb-4">
                                            <div class="col-12 col-md-6 form-password-toggle">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control" type="hidden" id="user_id"
                                                        name="user_id" value="{{ $authenticated_user_data->user_id }}" />
                                                        <input class="form-control" type="password" id="newPassword"
                                                            name="newPassword"
                                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                        <label for="newPassword">New Password</label>
                                                    </div>
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="mdi mdi-eye-off-outline"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 form-password-toggle">
                                                <div class="input-group input-group-merge">
                                                    <div class="form-floating form-floating-outline">
                                                        <input class="form-control" type="password"
                                                            name="confirm-Password" id="confirm-Password"
                                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                        <label for="confirm-Password">Confirm New Password</label>
                                                    </div>
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="mdi mdi-eye-off-outline"></i></span>
                                                </div>
                                            </div>


                                        </div>
                                        <h6 class="text-body">Password Requirements:</h6>
                                        <ul class="ps-3 mb-0">
                                            <li class="mb-1">Minimum 6 characters long - the more, the better</li>
                                            <li class="mb-1">At least one lowercase character</li>
                                            <li>At least one number, symbol, or whitespace character</li>
                                        </ul>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                        </div>
                                    </form>

                                </div>
                                <!--/ Edit Security -->
                            </div>
                        </div>



                    </div>
                </div>



            </div>
        </div>
        <!--/ User Profile Content -->

        {{-- MERGED MODALS: v_edit_profile_modal --}}
        @include('userpanels.modals.v_editprofile_modal')
        <!-- / v_edit_profile_modal -->


    </div>
@endsection
<!-- / CONTENT: MY PROFILE -->



@section('footer_page_js')
    <script src="{{ asset('public/materialize/assets/js/tables-datatables-extensions.js') }}"></script>

    <script src="{{ asset('public/materialize/assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('public/materialize/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('public/materialize/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>
    {{-- <script src="{{ asset('public/materialize/assets/js/pages-account-settings-account.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/materialize/assets/js/pages-account-settings-security.js') }}"></script> --}}




    {{-- ////////////////////////////////////////////////////////////////////// TOAST //////////////////////////////////////////////////////////////////////  --}}
    {{-- TOAST:  VALIDATION ERROR/FAILED --}}
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
                    var delay_{{ $index }};
                    @if ($index == 1)
                        delay_{{ $index }} = {{ ($index + 1) * 0 }};
                    @else
                        delay_{{ $index }} = {{ ($index + 1) * 1000 }};
                    @endif

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
                    var delay_{{ $index }};
                    @if ($index == 1)
                        delay_{{ $index }} = {{ ($index + 1) * 0 }};
                    @else
                        delay_{{ $index }} = {{ ($index + 1) * 1000 }};
                    @endif

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
                    var delay_{{ $index }};
                    @if ($index == 1)
                        delay_{{ $index }} = {{ ($index + 1) * 0 }};
                    @else
                        delay_{{ $index }} = {{ ($index + 1) * 1000 }};
                    @endif

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




    <script>
        'use strict';

        document.addEventListener('DOMContentLoaded', function(e) {
            (function() {
                const formChangePass = document.querySelector('#formAccountChangePassSettings');

                // // Form validation for Change password
                // if (formChangePass) {
                //     const fv = FormValidation.formValidation(formChangePass, {
                //         fields: {
                //             newPassword: {
                //                 validators: {
                //                     notEmpty: {
                //                         message: 'Please enter new password'
                //                     },
                //                     stringLength: {
                //                         min: 6,
                //                         message: 'Password must be more than 6 characters'
                //                     }
                //                 }
                //             },
                //             confirmPassword: {
                //                 validators: {
                //                     notEmpty: {
                //                         message: 'Please confirm new password'
                //                     },
                //                     identical: {
                //                         compare: function() {
                //                             return formChangePass.querySelector(
                //                                 '[name="newPassword"]').value;
                //                         },
                //                         message: 'The password and its confirm are not the same'
                //                     },
                //                     stringLength: {
                //                         min: 6,
                //                         message: 'Password must be more than 6 characters'
                //                     }
                //                 }
                //             }
                //         },
                //         plugins: {
                //             trigger: new FormValidation.plugins.Trigger(),
                //             bootstrap5: new FormValidation.plugins.Bootstrap5({
                //                 eleValidClass: '',
                //                 rowSelector: '.col-md-4'
                //             }),
                //             submitButton: new FormValidation.plugins.SubmitButton(),
                //             // Submit the form when all fields are valid
                //             // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                //             autoFocus: new FormValidation.plugins.AutoFocus()
                //         },
                //         init: instance => {
                //             instance.on('plugins.message.placed', function(e) {
                //                 if (e.element.parentElement.classList.contains(
                //                         'input-group')) {
                //                     e.element.parentElement.insertAdjacentElement(
                //                         'afterend', e.messageElement);
                //                 }
                //             });
                //         }
                //     });
                // }


                // const formAccSettings = document.querySelector('#formAccountSettings');
                // // Form validation for Add new record
                // if (formAccSettings) {
                //     const fv = FormValidation.formValidation(formAccSettings, {
                //         fields: {
                //             firstName: {
                //                 validators: {
                //                     notEmpty: {
                //                         message: 'Please enter first name'
                //                     }
                //                 }
                //             },
                //             userName: {
                //                 validators: {
                //                     notEmpty: {
                //                         message: 'Please enter username'
                //                     },
                //                     stringLength: {
                //                         min: 7,
                //                         message: 'Username must be more than 7 characters'
                //                     }
                //                 }
                //             }
                //         },
                //         plugins: {
                //             trigger: new FormValidation.plugins.Trigger(),
                //             bootstrap5: new FormValidation.plugins.Bootstrap5({
                //                 eleValidClass: '',
                //                 rowSelector: '.col-md-4'
                //             }),
                //             submitButton: new FormValidation.plugins.SubmitButton(),
                //             // Submit the form when all fields are valid
                //             // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                //             autoFocus: new FormValidation.plugins.AutoFocus()
                //         },
                //         init: instance => {
                //             instance.on('plugins.message.placed', function(e) {
                //                 if (e.element.parentElement.classList.contains(
                //                         'input-group')) {
                //                     e.element.parentElement.insertAdjacentElement(
                //                         'afterend', e.messageElement);
                //                 }
                //             });
                //         }
                //     });
                // }

            })();
        });
    </script>
@endsection
