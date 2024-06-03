{{-- EXTEND: BASE WRAPPER --}}
@extends('landings.layouts.v_main')

@section('head_page_cssjs')
    {{-- Sub.Core Css --}}
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/pages/front-page.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/pages/front-page-landing.css') }}" />

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


@push('scripts')
    {{--  --}}
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

    <div id="image-popup" class="modal-dialog-centered col-8 col-sm-6 col-md-4 p-2">
        {{-- Add span button here ( image-popup close btn), the button was hovered over the img at the top-right corner over img --}}
        <span class="close-btn btn btn-sm btn-text-primary rounded-pill btn-icon"><i class="mdi mdi-close"></i></span>
        <img src="" alt="Large Image" />
    </div>

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
                            {{-- <div class="card-body pb-0" style="z-index: 9999;">
                                <div class="col-12 mt-1">
                                    <label for="searchLeafletField" class="form-label">Search</label>
                                    <input id="searchLeafletField" class="form-control typeahead-multi-datasets"
                                        type="text" autocomplete="off" placeholder="e.g sma/ jl/ -" />
                                </div>
                            </div>
                            --}}


                            <style>
                                span.clearInput {
                                    top: 4.64rem;
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
                            <div class="card-body pb-0" style="">
                                <div class="col-12 mt-1">
                                    <label for="searchLeafletField" class="form-label">Search</label>
                                    <div class="w-100">
                                        <input id="searchLeafletField" class="form-control typeahead-multi-datasets"
                                            type="text" autocomplete="off" placeholder="e.g sma/ jl/ -" />
                                        <span class="input-group-text clearInput position-absolute" type="button"
                                            data-bs-dismiss="input" aria-label="Clear input">
                                            <i class="mdi mdi-close"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .map-overlay {
                                    position: fixed;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    background-color: transparent;
                                    z-index: 1000;
                                    display: none;
                                }
                            </style>

                            <div class="card-body" id="leaflet_card_body">
                                <div id="map-overlay" class="map-overlay">
                                </div>
                                <div id="map" class="leaflet-map leaflet_wrapper" id="userLocation">

                                    <script src="{{ asset('resources/views/landings/pages/pages_vml/landing_map.config.js') }}"></script>
                                </div>

                                {{-- MERGED MODALS: v_viewmark_modal --}}
                                @include('landings.modals.v_viewmark_modal')

                                {{-- <script src="{{ asset('public/plugins/leaflet-official/data.geojson.json/data.v1.js') }}"></script> --}}
                                {{-- <script src="{{ asset('public/plugins/leaflet-official/leaflet-map-merged-config.js') }}"></script> --}}

                            </div>


                        </div>




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
            {{-- <h3 class="text-center mb-2"><span class="fw-bold">Everything you need</span> to start your next
                project</h3> --}}
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
                        Code optimized for {{ env('APP_ALIAS') }} purpose.
                    </p>
                </div>
                <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                    <div class="features-icon mb-3">
                        <img src="{{ asset('public/materialize/assets/img/front-pages/icons/transition-up.png') }}"
                            alt="transition up" />
                    </div>
                    <h5 class="mb-2">Continuous Updates</h5>
                    <p class="features-icon-description">
                        Institution data is up-to-date.
                        {{-- Free updates for the next 12 months, including new demos and features. --}}
                    </p>
                </div>
                <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                    <div class="features-icon mb-3">
                        <img src="{{ asset('public/materialize/assets/img/front-pages/icons/edit.png') }}"
                            alt="edit" />
                    </div>
                    <h5 class="mb-2">Manageable Data</h5>
                    <p class="features-icon-description">
                        Institution, mark, and images data is easy to manage (CRUD).
                    </p>
                </div>
                <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                    <div class="features-icon mb-3">
                        <img src="{{ asset('public/materialize/assets/img/front-pages/icons/3d-select-solid.png') }}"
                            alt="3d select solid" />
                    </div>
                    <h5 class="mb-2">Searchable Data</h5>
                    <p class="features-icon-description">
                        Data is searchable from Public and UserPanels side.
                    </p>
                </div>
                <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                    <div class="features-icon mb-3">
                        <img src="{{ asset('public/materialize/assets/img/front-pages/icons/lifebelt.png') }}"
                            alt="lifebelt" />
                    </div>
                    <h5 class="mb-2">Authentication</h5>
                    <p class="features-icon-description">Only 1 actor allowed to manage data from UserPanels.</p>
                </div>
                <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                    <div class="features-icon mb-3">
                        <img src="{{ asset('public/materialize/assets/img/front-pages/icons/google-docs.png') }}"
                            alt="google docs" />
                    </div>
                    <h5 class="mb-2">Plugins</h5>
                    <p class="features-icon-description">Leaflet plugins css and javascript, modified for
                        {{ env('APP_ALIAS') }} usage.</p>
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
                <span class="text-uppercase">real location reviews</span>
            </h6>
            <p class="text-center fw-medium mb-3 mb-md-5">Locations saved on our {{ env('APP_NAME') }} database.
            </p>
        </div>
        <div class="swiper-reviews-carousel overflow-hidden mb-5 pt-4 pt-8">
            <div class="swiper" id="swiper-reviews">
                <div class="swiper-wrapper">

                    @foreach ($loadInstReviewFromDB as $index => $inst)
                        <div class="swiper-slide">
                            <div class="card h-100">
                                <div class="card-body text-body d-flex flex-column justify-content-between text-center">
                                    <div class="mb-3">
                                        <img src="{{ $inst->institu_logo ? $inst->institu_logo : env('APP_NOIMAGE') }}"
                                            alt="institution logo" class="client-logo img-fluid hover-image"
                                            style="height: 4.75rem" />
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $inst->institu_name }}</h6>
                                        <p class="mb-0">(npsn: {{ $inst->institu_npsn }})</p>
                                    </div>
                                    <div class="divider text-warning mb-1 mt-0">
                                        <div class="divider-text">
                                            <div class="divider-icon">
                                                <i class="tf-icon mdi mdi-map-marker-outline mdi-24px"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <p>
                                        “{{ $inst->tb_mark->mark_address }}”
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <hr class="m-0" />
        <div class="container d-none">
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
    <script src="{{ asset('public/materialize/assets/js/forms-selects.js') }}"></script>

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

    {{--
    <script>
        'use strict';
        $(function() {

            var nbaTeams = [{
                    search_item: 'Boston Celtics'
                },
                {
                    search_item: 'Dallas Mavericks'
                },
                {
                    search_item: 'Sacramento Kings'
                }
            ];
            var nhlTeams = [{
                    search_item: 'New Jersey Devils'
                },
                {
                    search_item: 'New York Islanders'
                },
                {
                    search_item: 'New York Rangers'
                }
            ];

            var nbaExample = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: nbaTeams
            });
            var nhlExample = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: nhlTeams
            });

            // Multiple
            // --------------------------------------------------------------------
            $('.typeahead-multi-datasets').typeahead({
                hint: !isRtl,
                highlight: true,
                minLength: 0
            }, {
                name: 'nba-teams',
                source: nbaExample,
                display: 'team',
                templates: {
                    header: '<h4 class="league-name border-bottom mb-0 mx-3 mt-3 pb-2">NBA Teams</h4>'
                }
            }, {
                name: 'nhl-teams',
                source: nhlExample,
                display: 'team',
                templates: {
                    header: '<h4 class="league-name border-bottom mb-0 mx-3 mt-3 pb-2">NHL Teams</h4>'
                }
            });
        });
    </script> --}}
@endsection
