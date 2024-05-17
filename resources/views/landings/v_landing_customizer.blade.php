<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    {{-- class="dark-style layout-navbar-fixed layout-wide customizer-hide" dir="ltr" data-theme="theme-default" --}}
    class="dark-style layout-navbar layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    {{-- data-assets-path="../../assets/" --}} data-assets-path="public/materialize/assets/" data-template="front-pages">

{{-- MERGED HEADER: v_header --}}
@include('userpanels.layouts.v_header')

<body class="cst-landing-body">
    <!-- Navbar: Start -->
    <nav class="layout-navbar container shadow-none py-0">
        <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-3 px-md-4">
            <!-- Menu logo wrapper: Start -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                <!-- Mobile menu toggle: Start-->
                <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="tf-icons mdi mdi-menu mdi-24px align-middle"></i>
                </button>
                <!-- Mobile menu toggle: End-->
                <a href="" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <span style="color: #666cff">
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
                                    <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138"
                                        x2="10.532" y2="24.104" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-opacity="1" />
                                        <stop offset="1" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139"
                                        x2="10.3357" y2="24.1155" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-opacity="1" />
                                        <stop offset="1" stop-opacity="0" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                    </span>
                    <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{ env('APP_NAME') }}</span>
                </a>
            </div>
            <!-- Menu logo wrapper: End -->
            <!-- Menu wrapper: Start -->
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                    type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="tf-icons mdi mdi-close"></i>
                </button>
                <ul class="navbar-nav me-auto p-3 p-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fw-medium" aria-current="page" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ base_url('dashboard') }}" target="_self">Dashboard</a>
                    </li>
                </ul>
            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            <!-- Menu wrapper: End -->
            <!-- Toolbar: Start -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Style Switcher -->
                <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <i class="mdi mdi-24px"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                <span class="align-middle"><i class="mdi mdi-weather-sunny me-2"></i>Light</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                <span class="align-middle"><i class="mdi mdi-weather-night me-2"></i>Dark</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                <span class="align-middle"><i class="mdi mdi-monitor me-2"></i>System</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- / Style Switcher-->

                <!-- navbar button: Start -->
                <li>
                    <a href="{{ base_url('login') }}" class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
                        target="_self"><span class="tf-icons mdi mdi-account me-md-1"></span><span
                            class="d-none d-md-block">Login/Register</span></a>
                </li>
                <!-- navbar button: End -->
            </ul>
            <!-- Toolbar: End -->
        </div>
    </nav>
    <!-- Navbar: End -->

    <!-- Sections:Start -->

    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="hero" class="section-py pt-5 landing-hero position-relative">
            <img src="{{ asset('public/materialize/assets/img/front-pages/backgrounds/hero-bg-light.png') }}"
                alt="hero background" class="position-absolute top-0 start-0 w-100 h-100 z-n1" data-speed="1"
                data-app-light-img="front-pages/backgrounds/hero-bg-light.png"
                data-app-dark-img="front-pages/backgrounds/hero-bg-dark.png" />
            <div class="container">
                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-1">
                    <img src="{{ asset('public/materialize/assets/img/front-pages/icons/section-tilte-icon.png') }}"
                        alt="section title icon" class="me-2" />
                    <span class="text-uppercase">
                        <h3 class="text-center mb-2">
                            <span class="fw-bold">{{ env('APP_NAME') . ' : ' }}</span>
                            {{ env('APP_PURPOSE') }}
                        </h3>
                    </span>
                </h6>

                <p class="text-center fw-medium mb-3 mb-md-1 pb-3">
                    {{ env('APP_ALIAS') }}
                    {{-- Not just a set of tools, the package includes ready-to-deploy conceptual application. --}}
                </p>
                <div class="position-relative hero-animation-img">
                    <!-- Draggable Marker With Popup -->
                    <div id="leaflet_card">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card card-header-actions d-flex card-scroll d-none">
                                    <h5
                                        class="card-header d-flex justify-content-between align-items-center m-0 pl-2 pt-1 pb-1 pr-2">
                                        <span>School Location</span>
                                        <div class="no-caret">
                                            <button class="btn minMaxBtn btn-transparent-dark btn-icon"
                                                data-widget="fullscreen" id="mapsfullscreen-btn" role="button"
                                                aria-haspopup="true" aria-expanded="false"
                                                onclick="fullscreenFunct()">
                                                <i class="mdi mdi-24px mdi-fullscreen"></i>
                                            </button>
                                        </div>
                                    </h5>
                                </div>
                                <div class="card-body" id="leaflet_card_body">
                                    <div id="map" class="leaflet-map leaflet_wrapper" id="userLocation">

                                    </div>
                                </div>


                                {{-- MERGED MODALS: v_viewmark_modal --}}
                                @include('userpanels.modals.v_viewmark_modal')
                                <!-- / v_viewmark_modal -->
                                {{-- MERGED MODALS: v_editmark_modal --}}
                                @include('userpanels.modals.v_editmark_modal')
                                <!-- / v_editmark_modal -->

                                <script src="{{ asset('public/plugins/leaflet-official/data.geojson.json/data.v1.js') }}"></script>
                                <script src="{{ asset('public/plugins/leaflet-official/leaflet-map-merged-config.js') }}"></script>


                            </div>
                        </div>

                    </div>
                    <!-- /Draggable Marker With Popup -->
                </div>






            </div>




        </section>
        <!-- Hero: End -->

        <!-- Useful features: Start -->
        <section id="features" class="section-py landing-features">
            <div class="container">
                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
                    <img src="{{ asset('public/materialize/assets/img/front-pages/icons/section-tilte-icon.png') }}"
                        alt="section title icon" class="me-2" />
                    <span class="text-uppercase">Useful features</span>
                </h6>
                <h3 class="text-center mb-2"><span class="fw-bold">Everything you need</span> to start your next
                    project</h3>
                <p class="text-center fw-medium mb-3 mb-md-5 pb-3">
                    Not just a set of tools, the package includes ready-to-deploy conceptual application.
                </p>
                <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="features-icon mb-3">
                            <img src="{{ asset('public/materialize/assets/img/front-pages/icons/laptop-charging.png') }}"
                                alt="laptop charging" />
                        </div>
                        <h5 class="mb-2">Quality Code</h5>
                        <p class="features-icon-description">
                            Code structure that all developers will easily understand and fall in love with.
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="features-icon mb-3">
                            <img src="{{ asset('public/materialize/assets/img/front-pages/icons/transition-up.png') }}"
                                alt="transition up" />
                        </div>
                        <h5 class="mb-2">Continuous Updates</h5>
                        <p class="features-icon-description">
                            Free updates for the next 12 months, including new demos and features.
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="features-icon mb-3">
                            <img src="{{ asset('public/materialize/assets/img/front-pages/icons/edit.png') }}"
                                alt="edit" />
                        </div>
                        <h5 class="mb-2">Stater-Kit</h5>
                        <p class="features-icon-description">
                            Start your project quickly without having to remove unnecessary features.
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="features-icon mb-3">
                            <img src="{{ asset('public/materialize/assets/img/front-pages/icons/3d-select-solid.png') }}"
                                alt="3d select solid" />
                        </div>
                        <h5 class="mb-2">API Ready</h5>
                        <p class="features-icon-description">
                            Just change the endpoint and see your own data loaded within seconds.
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="features-icon mb-3">
                            <img src="{{ asset('public/materialize/assets/img/front-pages/icons/lifebelt.png') }}"
                                alt="lifebelt" />
                        </div>
                        <h5 class="mb-2">Excellent Support</h5>
                        <p class="features-icon-description">An easy-to-follow doc with lots of references and code
                            examples.</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="features-icon mb-3">
                            <img src="{{ asset('public/materialize/assets/img/front-pages/icons/google-docs.png') }}"
                                alt="google docs" />
                        </div>
                        <h5 class="mb-2">Well Documented</h5>
                        <p class="features-icon-description">An easy-to-follow doc with lots of references and code
                            examples.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Useful features: End -->

        <!-- Real location reviews: Start -->
        <section id="landingReviews" class="section-py bg-body landing-reviews pb-0">
            <div class="container">
                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
                    <img src="{{ asset('public/materialize/assets/img/front-pages/icons/section-tilte-icon.png') }}"
                        alt="section title icon" class="me-2" />
                    <span class="text-uppercase">real locations reviews</span>
                </h6>
                <p class="text-center fw-medium mb-3 mb-md-5">See locations saved on {{ env('APP_NAME') }} database.
                </p>
            </div>
            <div class="swiper-reviews-carousel overflow-hidden mb-5 pt-4">
                <div class="swiper" id="swiper-reviews">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-4.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Vuexy. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-1.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>Materio is awesome, and I particularly enjoy knowing that if I get stuck on
                                        something.</p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Tommy haffman</h6>
                                        <p class="mb-0">Founder of Levis</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-3.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        This template is superior in so many ways. The code, the design, the regular
                                        updates, the
                                        support.. It’s the whole package. Excellent Work.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">CTO of Airbnb</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-2.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        All the requirements for developers have been taken into consideration, so I’m
                                        able to build any
                                        interface I want.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Sara Smith</h6>
                                        <p class="mb-0">Founder of Continental</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-5.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Vuexy. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-4.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Vuexy. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star-outline mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-1.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>Materio is awesome, and I particularly enjoy knowing that if I get stuck on
                                        something.</p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Tommy haffman</h6>
                                        <p class="mb-0">Founder of Levis</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-3.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        This template is superior in so many ways. The code, the design, the regular
                                        updates, the
                                        support.. It’s the whole package. Excellent Work.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">CTO of Airbnb</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-2.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        All the requirements for developers have been taken into consideration, so I’m
                                        able to build any
                                        interface I want.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star-outline mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Sara Smith</h6>
                                        <p class="mb-0">Founder of Continental</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-5.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Vuexy. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-4.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Vuexy. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-1.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>Materio is awesome, and I particularly enjoy knowing that if I get stuck on
                                        something.</p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Tommy haffman</h6>
                                        <p class="mb-0">Founder of Levis</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-3.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        This template is superior in so many ways. The code, the design, the regular
                                        updates, the
                                        support.. It’s the whole package. Excellent Work.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">CTO of Airbnb</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-2.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        All the requirements for developers have been taken into consideration, so I’m
                                        able to build any
                                        interface I want.
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Sara Smith</h6>
                                        <p class="mb-0">Founder of Continental</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div
                                    class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-5.png') }}"
                                            alt="client logo" class="client-logo img-fluid" />
                                    </div>
                                    <p>
                                        “I've never used a theme as versatile and flexible as Vuexy. It's my go to for
                                        building dashboard
                                        sites on almost any project.”
                                    </p>
                                    <div class="text-warning mb-3">
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                        <i class="tf-icons mdi mdi-star mdi-24px"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1">Eugenia Moore</h6>
                                        <p class="mb-0">Founder of Hubspot</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <hr class="m-0" />
            <div class="container">
                <div class="swiper-logo-carousel py-4 my-lg-2">
                    <div class="swiper" id="swiper-clients-logos">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-1-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo-1-light.png"
                                    data-app-dark-img="front-pages/branding/logo-1-dark.png" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-2-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo-2-light.png"
                                    data-app-dark-img="front-pages/branding/logo-2-dark.png" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-3-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo-3-light.png"
                                    data-app-dark-img="front-pages/branding/logo-3-dark.png" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-4-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo-4-light.png"
                                    data-app-dark-img="front-pages/branding/logo-4-dark.png" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-5-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo-5-light.png"
                                    data-app-dark-img="front-pages/branding/logo-5-dark.png" />
                            </div>


                            <div class="swiper-slide">
                                <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-1-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo-1-light.png"
                                    data-app-dark-img="front-pages/branding/logo-1-dark.png" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('public/materialize/assets/img/front-pages/branding/logo-2-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo-2-light.png"
                                    data-app-dark-img="front-pages/branding/logo-2-dark.png" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- -------------------------------------------------------------------------------------------------------------- --}}
        </section>
        <!-- Real customers reviews: End -->

        <section id="team" class="section-py landing-team disable-right-click">
            <div class="container bg-icon-right position-relative">
                <img src="{{ asset('public/materialize/assets/img/front-pages/icons/bg-right-icon-light.png') }}"
                    alt="section icon" class="position-absolute top-0 end-0" data-speed="1"
                    data-app-light-img="front-pages/icons/bg-right-icon-light.png"
                    data-app-dark-img="front-pages/icons/bg-right-icon-dark.png" />
                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
                    <img src="{{ asset('public/materialize/assets/img/front-pages/icons/section-tilte-icon.png') }}"
                        alt="section title icon" class="me-2" />
                    <span class="text-uppercase">our great team</span>
                </h6>
                <h3 class="text-center mb-2"><span class="fw-bold">Supported</span> by Real People</h3>
                <p class="text-center fw-medium mb-3 mb-md-5 pb-3">Who is behind these great-looking interfaces?</p>
                <div class="row gy-5 mt-2">

                    @php
                        $groupMembersJson = env('GROUP_MEMBER');
                        $groupMembers = json_decode($groupMembersJson, true);
                    @endphp

                    @if (is_array($groupMembers))
                        @foreach ($groupMembers as $member)
                            <div class="col-lg-3 col-sm-6">
                                <div class="card card-hover-border-primary mt-3 mt-lg-0 shadow-none">
                                    <div class="bg-label-primary position-relative team-image-box">
                                        @php
                                            $memberImg =
                                                $member[3] != null
                                                    ? 'https://' . $member[3]
                                                    : asset(env(key: 'APP_NOIMAGE'));
                                        @endphp
                                        <img src="{{ $memberImg }}"
                                            class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl non-draggable"
                                            alt="human image" />
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title fw-semibold mb-1">{{ $member[0] }}</h5>
                                        <p class="card-text">{{ $member[1] . $member[2] }}</p>
                                        <div class="text-center team-media-icons d-none">
                                            <a href="javascript:void(0);" class="text-heading" target="_blank">
                                                <i class="tf-icons mdi mdi-facebook mdi-24px me-2"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="text-heading" target="_blank">
                                                <i class="tf-icons mdi mdi-twitter mdi-24px me-2"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="text-heading" target="_blank">
                                                <i class="tf-icons mdi mdi-linkedin mdi-24px"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </section>
        <!-- Our great team: End -->

        <!-- Fun facts: Start -->
        <section id="landingFunFacts" class="section-py landing-fun-facts d-none">
            <div class="container">
                <div class="row gx-0 gy-5 gx-sm-5">
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-primary fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-land-plots mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">137+</h2>
                        <p class="fw-medium mb-0">Completed Sites</p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-success fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-clock-outline mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">1,100+</h2>
                        <p class="fw-medium mb-0">Working Hours</p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-warning fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-emoticon-happy-outline mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">137+</h2>
                        <p class="fw-medium mb-0">Happy Customers</p>
                    </div>
                    <div class="col-md-3 col-sm-6 text-center">
                        <span class="badge badge-center rounded-pill bg-label-hover-info fun-facts-icon mb-4"><i
                                class="tf-icons mdi mdi-medal-outline mdi-36px"></i></span>
                        <h2 class="fw-bold mb-1">23+</h2>
                        <p class="fw-medium mb-0">Awards Winning</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Fun facts: End -->

        <!-- FAQ: Start -->
        <section id="landingFAQ" class="section-py bg-body landing-faq d-none">
            <div class="container bg-icon-right">
                <img src="{{ asset('public/materialize/assets/img/front-pages/icons/bg-right-icon-light.png') }}"
                    alt="section icon" class="position-absolute top-0 end-0" data-speed="1"
                    data-app-light-img="front-pages/icons/bg-right-icon-light.png"
                    data-app-dark-img="front-pages/icons/bg-right-icon-dark.png" />
                <h6 class="text-center fw-semibold d-flex justify-content-center align-items-center mb-4">
                    <img src="{{ asset('public/materialize/assets/img/front-pages/icons/section-tilte-icon.png') }}"
                        alt="section title icon" class="me-2" />
                    <span class="text-uppercase">faq</span>
                </h6>
                <h3 class="text-center mb-2">Frequently asked<span class="fw-bold"> questions</span></h3>
                <p class="text-center fw-medium mb-3 mb-md-5 pb-3">
                    Browse through these FAQs to find answers to commonly asked questions.
                </p>
                <div class="row gy-5">
                    <div class="col-lg-5">
                        <div class="text-center">
                            <img src="{{ asset('public/materialize/assets/img/front-pages/landing-page/sitting-girl-with-laptop.png') }}"
                                alt="sitting girl with laptop" class="faq-image" />
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="accordion" id="accordionFront">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="head-One">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true"
                                        aria-controls="accordionOne">
                                        Do you charge for each upgrade?
                                    </button>
                                </h2>

                                <div id="accordionOne" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFront" aria-labelledby="accordionOne">
                                    <div class="accordion-body">
                                        Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping.
                                        Sesame snaps icing
                                        marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée
                                        pastry topping
                                        soufflé. Wafer gummi bears marshmallow pastry pie.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="head-Two">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionTwo"
                                        aria-expanded="false" aria-controls="accordionTwo">
                                        Do I need to purchase a license for each website?
                                    </button>
                                </h2>
                                <div id="accordionTwo" class="accordion-collapse collapse"
                                    aria-labelledby="accordionTwo" data-bs-parent="#accordionFront">
                                    <div class="accordion-body">
                                        Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw
                                        dragée oat cake
                                        dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart
                                        donut gummies. Jelly
                                        beans candy canes carrot cake. Fruitcake chocolate chupa chups.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item active">
                                <h2 class="accordion-header" id="head-Three">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionThree" aria-expanded="true"
                                        aria-controls="accordionThree">
                                        What is regular license?
                                    </button>
                                </h2>
                                <div id="accordionThree" class="accordion-collapse collapse show"
                                    aria-labelledby="accordionThree" data-bs-parent="#accordionFront">
                                    <div class="accordion-body">
                                        Regular license can be used for end products that do not charge users for access
                                        or service(access
                                        is free and there will be no monthly subscription fee). Single regular license
                                        can be used for
                                        single end product and end product can be used by you or your client. If you
                                        want to sell end
                                        product to multiple clients then you will need to purchase separate license for
                                        each client. The
                                        same rule applies if you want to use the same end product on multiple
                                        domains(unique setup). For
                                        more info on regular license you can check official description.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="head-Four">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionFour"
                                        aria-expanded="false" aria-controls="accordionFour">
                                        What is extended license?
                                    </button>
                                </h2>
                                <div id="accordionFour" class="accordion-collapse collapse"
                                    aria-labelledby="accordionFour" data-bs-parent="#accordionFront">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis et aliquid
                                        quaerat possimus maxime!
                                        Mollitia reprehenderit neque repellat deleniti delectus architecto dolorum
                                        maxime, blanditiis
                                        earum ea, incidunt quam possimus cumque.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="head-Five">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionFive"
                                        aria-expanded="false" aria-controls="accordionFive">
                                        Which license is applicable for SASS application?
                                    </button>
                                </h2>
                                <div id="accordionFive" class="accordion-collapse collapse"
                                    aria-labelledby="accordionFive" data-bs-parent="#accordionFront">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi molestias
                                        exercitationem ab cum
                                        nemo facere voluptates veritatis quia, eveniet veniam at et repudiandae mollitia
                                        ipsam quasi
                                        labore enim architecto non!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ: End -->

    </div>

    <!-- / Sections:End -->

    <!-- Footer: Start -->
    <footer class="landing-footer">
        <div class="footer-top position-relative overflow-hidden d-none">
            <img src="{{ asset('public/materialize/assets/img/front-pages/backgrounds/footer-bg.png') }}"
                alt="footer bg" class="footer-bg banner-bg-img" />
            <div class="container position-relative">
                <div class="row gx-0 gy-4 g-md-5">
                    <div class="col-lg-5">
                        <a href="" class="app-brand-link mb-4">
                            <span class="app-brand-logo demo me-2">
                                <span style="color: #666cff">
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
                                            <linearGradient id="paint0_linear_2989_100980" x1="5.36642"
                                                y1="0.849138" x2="10.532" y2="24.104"
                                                gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-opacity="1" />
                                                <stop offset="1" stop-opacity="0" />
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_2989_100980" x1="5.19475"
                                                y1="0.849139" x2="10.3357" y2="24.1155"
                                                gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-opacity="1" />
                                                <stop offset="1" stop-opacity="0" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </span>
                            </span>
                            <span class="app-brand-text demo footer-link fw-bold">Materialize</span>
                        </a>
                        <p class="footer-text footer-logo-description mb-4">
                            Most Powerful & Comprehensive 🤩 React NextJS Admin Template with Elegant Material Design &
                            Unique
                            Layouts.
                        </p>
                        <form>
                            <div class="d-flex mt-2 gap-3">
                                <div class="form-floating form-floating-outline w-px-250">
                                    <input type="text" class="form-control bg-transparent text-white"
                                        id="newsletter-1" placeholder="Your email" />
                                    <label for="newsletter-1">Subscribe to newsletter</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Subscribe</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-4">Demos</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <a href="../vertical-menu-template/" target="_blank" class="footer-link">Vertical
                                    Layout</a>
                            </li>
                            <li class="mb-3">
                                <a href="../horizontal-menu-template/" target="_blank" class="footer-link">Horizontal
                                    Layout</a>
                            </li>
                            <li class="mb-3">
                                <a href="../vertical-menu-template-bordered/" target="_blank"
                                    class="footer-link">Bordered Layout</a>
                            </li>
                            <li class="mb-3">
                                <a href="../vertical-menu-template-semi-dark/" target="_blank"
                                    class="footer-link">Semi Dark Layout</a>
                            </li>
                            <li>
                                <a href="../vertical-menu-template-dark/" target="_blank" class="footer-link">Dark
                                    Layout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-4">Pages</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <a href="pricing-page.html" class="footer-link">Pricing</a>
                            </li>
                            <li class="mb-3">
                                <a href="payment-page.html" class="footer-link">Payment<span
                                        class="badge rounded-pill bg-primary ms-2">New</span></a>
                            </li>
                            <li class="mb-3">
                                <a href="checkout-page.html" class="footer-link">Checkout</a>
                            </li>
                            <li class="mb-3">
                                <a href="help-center-landing.html" class="footer-link">Help Center</a>
                            </li>
                            <li>
                                <a href="../vertical-menu-template/auth-login-cover.html" target="_blank"
                                    class="footer-link">Login/Register</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <h6 class="footer-title mb-4">Download our app</h6>
                        <a href="javascript:void(0);" class="d-block footer-link mb-3 pb-2"><img
                                src="{{ asset('public/materialize/assets/img/front-pages/landing-page/apple-icon.png') }}"
                                alt="apple icon" /></a>
                        <a href="javascript:void(0);" class="d-block footer-link"><img
                                src="{{ asset('public/materialize/assets/img/front-pages/landing-page/google-play-icon.png') }}"
                                alt="google play icon" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom py-3">
            <div
                class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
                <div class="mb-2 mb-md-0">
                    <span class="footer-text">
                        © {{ env('APP_YEAR') == date('Y') ? env('APP_YEAR') : env('APP_YEAR') . '-' . date('Y') }}
                    </span>
                    , made with <span class="text-danger"><i class="tf-icons mdi mdi-heart"></i></span> by
                    <a href="{{ env('APP_URL') }}" target="_blank"
                        class="footer-link fw-medium">{{ env('APP_NAME') }}</a>
                </div>
                <div>
                    <a href="https://www.linkedin.com/in/hendri-%E2%80%8E-087093278/" class="footer-link me-2"
                        target="_blank"><i class="mdi mdi-linkedin"></i></a>
                    <a href="https://github.com/HenryKim2022/" class="footer-link me-2" target="_blank"><i
                            class="mdi mdi-github"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100025068874578/" class="footer-link me-2"
                        target="_blank"><i class="mdi mdi-facebook"></i></a>
                    <a href="https://www.instagram.com/henrykim119/" class="footer-link" target="_blank"><i
                            class="mdi mdi-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer: End -->

    {{-- CST: WHEN MODAL ACTIVE --}}
    {{-- <div class="content-backdrop fade"></div> --}}


    {{-- MERGED MODALS: v_modals --}}
    {{-- @include('userpanels.modals.v_aboutus_modal') --}}
    <!-- / v_modals -->



    @include('js.v_jsbody_collections')
</body>

</html>
