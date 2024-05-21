<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    {{-- class="dark-style layout-navbar-fixed layout-menu-fixed layout-compact customizer-hide" dir="ltr" --}}
    class="dark-style layout-navbar layout-menu-fixed layout-compact customizer-hide" dir="ltr"
    data-theme="theme-default" data-assets-path="public/materialize/assets/" data-template="vertical-menu-template">

{{-- MERGED HEADER: v_header --}}
@include('userpanels.layouts.v_header')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            {{-- MERGED ASIDE: v_aside --}}
            @include('userpanels.layouts.v_aside')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                {{-- MERGED MODALS: v_navbar --}}
                @include('userpanels.layouts.v_navbar')
                <!-- / v_navbar -->


                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')


                    <!-- Footer -->
                    {{-- MERGED FOOTER: v_footer --}}
                    @include('userpanels.layouts.v_footer')
                    <!-- / Footer -->


                </div>
                <!-- Content wrapper -->

            </div>

        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle" style="display: none"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target" style="z-index: 0"></div>
    </div>
    <!-- / Layout wrapper -->


    {{-- MERGED MODALS: v_modals --}}
    @include('userpanels.modals.v_aboutus_modal')
    <!-- / v_modals -->


    @include('js.v_jsbody_collections')
</body>

</html>
