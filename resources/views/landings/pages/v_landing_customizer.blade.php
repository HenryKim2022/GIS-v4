{{-- EXTEND: BASE WRAPPER --}}
@extends('landings.layouts.v_main')

@section('head_page_cssjs')
    {{-- Sub.Core Css --}}
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/pages/front-page.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/pages/front-page-landing.css') }}" />

    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/dropzone/dropzone.css') }}" />
    <script src="{{ asset('public/materialize/assets/vendor/libs/dropzone/dropzone.js') }}"></script>


    {{-- Leaflet from NPM Leaflet: --}}
    <link rel="stylesheet" href="{{ asset('public/plugins/leaflet-official/leaflet.base.vlastest/dist/leaflet.css') }}" />

    {{-- LeafletFullscreen: For Old Browser: NOT USED! --}}
    {{-- <link rel="stylesheet"
        href="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.v1.0.1/dist/leaflet.fullscreen.css') }}" />
        <script src="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.v1.0.1/dist/Leaflet.fullscreen.min.js') }}">
        </script> --}}

    {{-- LeafletFullscreen: For Modern Browser --}}
    <link rel="stylesheet"
        href="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.vlastest/Control.FullScreen.css') }}" />

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



@section('head_page_helper_js')
    {{-- <script src="{{ asset('public/materialize/assets/js/front-config.js') }}"></script> --}}
@endsection


<!-- CONTENT: LANDINGS -->
@section('content')
    @php
        $page = Session::get('page');
        $page_title = $page['page_title'];
    @endphp

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
                                        <button class="btn minMaxBtn btn-transparent-dark btn-icon" data-widget="fullscreen"
                                            id="mapsfullscreen-btn" role="button" aria-haspopup="true"
                                            aria-expanded="false" onclick="fullscreenFunct()">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center h-100">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center">
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
                            <div class="card-body text-body d-flex flex-column justify-content-between text-center">
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
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                    Do you charge for each upgrade?
                                </button>
                            </h2>

                            <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionFront"
                                aria-labelledby="accordionOne">
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
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                                    Do I need to purchase a license for each website?
                                </button>
                            </h2>
                            <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="accordionTwo"
                                data-bs-parent="#accordionFront">
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
                                    data-bs-target="#accordionThree" aria-expanded="true" aria-controls="accordionThree">
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
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionFour" aria-expanded="false" aria-controls="accordionFour">
                                    What is extended license?
                                </button>
                            </h2>
                            <div id="accordionFour" class="accordion-collapse collapse" aria-labelledby="accordionFour"
                                data-bs-parent="#accordionFront">
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
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionFive" aria-expanded="false" aria-controls="accordionFive">
                                    Which license is applicable for SASS application?
                                </button>
                            </h2>
                            <div id="accordionFive" class="accordion-collapse collapse" aria-labelledby="accordionFive"
                                data-bs-parent="#accordionFront">
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
@endsection
<!-- / CONTENT: LANDINGS -->




@section('footer_page_js')
    <script src="{{ asset('public/materialize/assets/js/tables-datatables-extensions.js') }}"></script>

    <script>
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
            </div>`;


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
    </script>
@endsection
