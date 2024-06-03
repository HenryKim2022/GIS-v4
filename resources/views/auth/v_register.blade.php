
@php
    $page = Session::get('page');
    $page_title = $page['page_title'];
@endphp

<!doctype html>
<html lang="en" class="dark-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="public/materialize/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ env('APP_NAME') }} | {{ $page_title }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('public/materialize/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/fonts/materialdesignicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/swiper/swiper.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet"
        href="{{ asset('public/materialize/assets/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/typeahead-js/typeahead.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/pages/page-auth.css') }}" />

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">


    <!-- Helpers -->
    <script src="{{ asset('public/materialize/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('public/materialize/assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('public/materialize/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="{{ base_url('landing-page') }}" class="auth-cover-brand d-flex align-items-center gap-2">
            <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">
                    <svg width="268" height="150" viewBox="0 0 38 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                            fill="currentColor" />
                        <path
                            d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                            fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4" />
                        <path
                            d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                            fill="currentColor" />
                        <path
                            d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                            fill="currentColor" />
                        <path
                            d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                            fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4" />
                        <path
                            d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                            fill="currentColor" />
                        <defs>
                            <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138" x2="10.532"
                                y2="24.104" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-opacity="1" />
                                <stop offset="1" stop-opacity="0" />
                            </linearGradient>
                            <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139" x2="10.3357"
                                y2="24.1155" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-opacity="1" />
                                <stop offset="1" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                    </svg>
                </span>
            </span>
            <span class="app-brand-text demo text-heading fw-bold">{{ env('APP_NAME') }}</span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
                {{-- <img src="{{ asset('public/materialize/assets/img/illustrations/auth-register-illustration-light.png') }}" --}}
                <img src="{{ asset('public/materialize/assets/img/illustrations/auth-register-illustration-dark-v2.png') }}"
                    class="auth-cover-illustration w-100" alt="auth-illustration"
                    {{-- data-app-light-img="illustrations/auth-register-illustration-light.png" --}}
                    data-app-light-img="illustrations/auth-register-illustration-dark-v2.png"
                    data-app-dark-img="illustrations/auth-register-illustration-dark-v2.png" />
                <img src="{{ asset('public/materialize/assets/img/illustrations/auth-cover-register-mask-light.png') }}"
                    class="authentication-image" alt="mask"
                    data-app-light-img="illustrations/auth-cover-register-mask-light.png"
                    data-app-dark-img="illustrations/auth-cover-register-mask-dark.png" />
            </div>
            <!-- /Left Text -->

            <!-- Register -->
            <div
                class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
                <div class="w-px-400 mx-auto pt-5 pt-lg-0">
                    <h4 class="mb-2">Adventure starts here 🚀</h4>
                    <p class="mb-4">Make your app management easy and fun!</p>

                    <form id="formAuthentication" class="mb-3" action="index.html" method="GET">
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter your username" autofocus />
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Enter your email" />
                            <label for="email">Email</label>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <label for="password">Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer"><i
                                        class="mdi mdi-eye-off-outline"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions"
                                    name="terms" />
                                <label class="form-check-label" for="terms-conditions" data-bs-toggle="modal"
                                    data-bs-target="#modalPrivacyPolicy">
                                    I agree to
                                    <a href="javascript:void(0);">privacy policy & terms</a>
                                </label>
                            </div>
                        </div>
                        <button id="signupBtn" class="btn btn-primary d-grid w-100">Sign up</button>
                    </form>

                    <p class="text-center mt-2">
                        <span>Already have an account?</span>
                        <a href="{{ base_url('login') }}" target="_self">
                            <span>Sign in instead</span>
                        </a>
                    </p>

                    <div class="divider my-4 d-none">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center gap-2 d-none">
                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
                            <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
                            <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
                            <i class="tf-icons mdi mdi-24px mdi-github"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
                            <i class="tf-icons mdi mdi-24px mdi-google"></i>
                        </a>
                    </div>

                </div>
            </div>
            <!-- /Register -->

            {{-- MODALS --}}
            <!-- Modal: PrivacyPolicy / privacy policy modal -->
            <div class="modal fade" id="modalPrivacyPolicy" data-bs-backdrop="static" tabindex="-1"
                aria-hidden="true" style="z-index: 1102;">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center align-items-center">
                            <h4 class="modal-title" id="modalScrollableTitle">Privacy Policy Agreements</h4>
                        </div>

                        <div>
                            <div class="divider">
                                <div class="divider-text">
                                    <div class="divider-icon">
                                        <i class="mdi mdi-star-outline"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body text-justify text-wrap">
                            <p>At {{ env('APP_NAME') }} ({{ env('APP_ALIAS') }}), we are committed to protecting your
                                privacy and ensuring the security of any personal information you provide to us. This
                                Privacy Policy outlines how we collect, use, and protect your information when you sign
                                up for our services on our website.</p>

                            <h6>Information We Collect:</h6>
                            <ul>
                                <li>When you sign up for an account on {{ env('APP_NAME') }}, we may collect personal
                                    information such as your name, email address, and contact details.</li>
                                <li>We may also collect non-personal information such as your IP address, browser type,
                                    and device information for analytical purposes.</li>
                            </ul>

                            <h6>Use of Information:</h6>
                            <ul>
                                <li>We use the information you provide to create and manage your account on
                                    {{ env('APP_NAME') }}, allowing you to access our services and features.</li>
                                <li>Your personal information may be used to communicate with you regarding your
                                    account, updates, and important notices related to {{ env('APP_NAME') }}.</li>
                                <li>We may use non-personal information for statistical analysis, improving our
                                    services, and enhancing the user experience on our website.</li>
                            </ul>

                            <h6>Data Security:</h6>
                            <ul>
                                <li>We implement strict security measures to protect your personal information from
                                    unauthorized access, alteration, or disclosure.</li>
                                <li>Your account is password-protected, and we recommend choosing a strong password and
                                    keeping it confidential.</li>
                                <li>We use encryption technology to transmit sensitive information securely over the
                                    internet.</li>
                            </ul>

                            <h6>Third-Party Disclosure:</h6>
                            <ul>
                                <li>We do not sell, trade, or transfer your personal information to third parties
                                    without your consent, except as required by law or when necessary to provide our
                                    services.</li>
                                <li>We may share non-personal information with trusted third-party service providers who
                                    assist us in operating our website or analyzing data.</li>
                            </ul>

                            <h6>Terms of Service</h6>
                            <ul>
                                <li>By signing up for an account on {{ env('APP_NAME') }}, you agree to abide by our
                                    Terms of Service.</li>
                                <li>You are responsible for maintaining the confidentiality of your account credentials
                                    and for all activities that occur under your account.</li>
                                <li>You agree not to use {{ env('APP_NAME') }} for any illegal, unauthorized, or
                                    unethical purposes.</li>
                                <li>We reserve the right to suspend or terminate your account if you violate our Terms
                                    of Service.</li>
                            </ul>

                            <h6>Changes to the Privacy Policy:</h6>
                            <ul>
                                <li>
                                    We may update this Privacy Policy from time to time. Any changes will be posted on
                                    this page, and it is your responsibility to review the Privacy Policy periodically.
                                </li>
                            </ul>
                        </div>

                        <div>
                            <div class="divider">
                                <div class="divider-text">
                                    <div class="divider-icon">
                                        <i class="mdi mdi-star-outline"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer align-content-center pt-1 pl-0 pr-1">
                            <div class="d-flex flex-column m-0">
                                <div>
                                    <a class="text-sm pl-0 pt-3 text-wrap">
                                        <i>
                                            By signing up for an account on {{ env('APP_NAME') }}, you acknowledge that
                                            you have read, understood, and agreed to the Privacy Policy and Terms of
                                            Service.
                                        </i>
                                    </a>
                                </div>
                                <div class="mt-3 d-flex justify-content-end">
                                    <button id="confirmPolicyBtn" type="button" class="btn btn-primary"
                                        data-bs-dismiss="modal">Accept</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->







        {{-- Custom JS --}}
        <script src="{{ asset('public/js/custom.js') }}"></script>


        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->
        <script src="{{ asset('public/materialize/assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/vendor/js/menu.js') }}"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('public/materialize/assets/vendor/libs/@form-validation/popular.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('public/materialize/assets/js/main.js') }}"></script>

        <!-- Page JS -->
        <script src="{{ asset('public/materialize/assets/js/pages-auth.js') }}"></script>
        <script src="{{ asset('public/materialize/assets/js/ui-modals.js') }}"></script>


        <div class="content-backdrop fade"></div>
</body>

</html>
