<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('public/materialize/assets/img/favicon/favicon.ico') }}" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

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
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/pages/front-page.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/nouislider/nouislider.css') }}" />
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/swiper/swiper.css') }}" />
<link rel="stylesheet"
    href="{{ asset('public/materialize/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

<link rel="stylesheet"
    href="{{ asset('public/materialize/assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/tagify/tagify.css') }}" />
<link rel="stylesheet"
    href="{{ asset('public/materialize/assets/vendor/libs/@form-validation/form-validation.css') }}" />

<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/animate-css/animate.css') }}" />
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

<link rel="stylesheet"
    href="{{ asset('public/materialize/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet"
    href="{{ asset('public/materialize/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet"
    href="{{ asset('public/materialize/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />


<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/dropzone/dropzone.css') }}" />
<script src="{{ asset('public/materialize/assets/vendor/libs/dropzone/dropzone.js') }}"></script>

{{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}
{{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}


{{-- Leaflet from Template --}}
{{-- <link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/libs/leaflet/leaflet.css') }}" /> --}}

<!-- Page CSS -->
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/pages/front-page-landing.css') }}" />
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/pages/cards-statistics.css') }}" />
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/pages/cards-analytics.css') }}" />
<link rel="stylesheet" href="{{ asset('public/materialize/assets/vendor/css/pages/page-profile.css') }}" />

{{-- Custom CSS --}}
<link rel="stylesheet" href="{{ asset('public/css/custom.css') }}">


<!-- Helpers -->
<script src="{{ asset('public/materialize/assets/vendor/js/helpers.js') }}"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('public/materialize/assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('public/materialize/assets/js/front-config.js') }}"></script>
    <script src="{{ asset('public/materialize/assets/js/config.js') }}"></script>


<script src="{{ asset('public/materialize/assets/vendor/js/dropdown-hover.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/js/mega-dropdown.js') }}"></script>




{{-- Leaflet from Leaflet Official --}}
{{-- <link rel="stylesheet" href="{{ asset('public/plugins/leaflet-official/leaflet.base.v1.9.4/leaflet.css') }}" />
<script src="{{ asset('public/plugins/leaflet-official/leaflet.base.v1.9.4/leaflet.js') }}"></script> --}}

<link rel="stylesheet" href="{{ asset('public/plugins/leaflet-official/leaflet.base.vlastest/dist/leaflet.css') }}" />
<script src="{{ asset('public/plugins/leaflet-official/leaflet.base.vlastest/dist/leaflet.js') }}"></script>
<script src="{{ asset('public/plugins/leaflet-official/leaflet.base.vlastest/dist/leaflet-src.js') }}"></script>


{{-- LeafletFullscreen: For Old Browser --}}
{{-- <link rel="stylesheet"
href="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.v1.0.1/dist/leaflet.fullscreen.css') }}" />
<script src="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.v1.0.1/dist/Leaflet.fullscreen.min.js') }}">
</script> --}}

{{-- LeafletFullscreen: For Modern Browser --}}
<link rel="stylesheet"
    href="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.vlastest/Control.FullScreen.css') }}" />
<script src="{{ asset('public/plugins/leaflet-official/leaflet.fullscreen.vlastest/Control.FullScreen.js') }}">
</script>

{{-- LeafletGestureHandling --}}
<link rel="stylesheet"
    href="{{ asset('public/plugins/leaflet-official/leaflet.gesturehandling.vlastest/dist/leaflet-gesture-handling.min.css') }}" />
<script
    src="{{ asset('public/plugins/leaflet-official/leaflet.gesturehandling.vlastest/dist/leaflet-gesture-handling.min.js') }}">
</script>

{{-- LeafletToolbar (base) --}}
<link rel="stylesheet"
    href="{{ asset('public/plugins/leaflet-official/leaflet.draw.toolbar/leaflet.toolbar.base.vlastest/dist/leaflet.toolbar.min.css') }}" />
<script
    src="{{ asset('public/plugins/leaflet-official/leaflet.draw.toolbar/leaflet.toolbar.base.vlastest/dist/leaflet.toolbar.min.js') }}">
</script>

{{-- LeafletLocateControl (addons) --}}
<link rel="stylesheet"
    href="{{ asset('public/plugins/leaflet-official/leaflet.locatecontrol.vlastest/dist/L.Control.Locate.min.css') }}" />
<script
    src="{{ asset('public/plugins/leaflet-official/leaflet.locatecontrol.vlastest/dist/L.Control.Locate.min.js') }}">
</script>

{{-- LeafletSearch (addons) --}}
<link rel="stylesheet"
    href="{{ asset('public/plugins/leaflet-official/leaflet.search.vlastest/src/leaflet-search.css') }}" />
<script src="{{ asset('public/plugins/leaflet-official/leaflet.search.vlastest/src/leaflet-search.js') }}"></script>

{{-- LeafletViewReset (addons) --}}
<link rel="stylesheet"
    href="{{ asset('public/plugins/leaflet-official/leaflet.resetview/dist/L.Control.ResetView.min.css') }}" />
<script src="{{ asset('public/plugins/leaflet-official/leaflet.resetview/dist/L.Control.ResetView.min.js') }}">
</script>

{{-- LeafletControlModals (addons) --}}
{{-- <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script> --}}


{{-- LeafletControlGeocoder (addons) --}}
<link rel="stylesheet"
    href="{{ asset('public/plugins/leaflet-official/leaflet.control.geocoder/dist/Control.Geocoder.css') }}" />
<script src="{{ asset('public/plugins/leaflet-official/leaflet.control.geocoder/dist/Control.Geocoder.js') }}">
</script>


{{-- LeafletRoutingMachine (addons) --}}
<link rel="stylesheet"
    href="{{ asset('public/plugins/leaflet-official/leaflet.routing.machine/dist/leaflet-routing-machine.css') }}" />
<script src="{{ asset('public/plugins/leaflet-official/leaflet.routing.machine/dist/leaflet-routing-machine.js') }}">
</script>


{{-- LeafletControlWindow (addons) --}}
