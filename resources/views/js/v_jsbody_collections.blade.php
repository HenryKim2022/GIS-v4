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
<script src="{{ asset('public/materialize/assets/vendor/libs/nouislider/nouislider.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/libs/swiper/swiper.js') }}"></script>
{{-- <script src="https://unpkg.com/swiper@9.3.1/swiper-bundle.min.js" type="text/javascript"></script> --}}
<script src="{{ asset('public/materialize/assets/vendor/libs/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

<script src="{{ asset('public/materialize/assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/libs/tagify/tagify.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/libs/@form-validation/popular.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
<script src="{{ asset('public/materialize/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>






<!-- alert:js assets vendor & page -->
<script src="{{ asset('public/materialize/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('public/materialize/assets/js/extended-ui-sweetalert2.js') }}"></script>
<!-- endalert -->


<!-- Main JS -->
<script src="{{ asset('public/materialize/assets/js/front-main.js') }}"></script>
<script src="{{ asset('public/materialize/assets/js/main.js') }}"></script>
<script src="{{ asset('public/materialize/assets/js/form-validation.js') }}"></script>

{{-- Custom JS --}}
<script src="{{ asset('public/js/custom.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('public/materialize/assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('public/materialize/assets/js/front-page-landing.js') }}"></script>
{{-- <script src="{{ asset('public/materialize/assets/js/forms-file-upload.js') }}"></script> --}}

@yield('footer_page_js')

{{-- Template Leaflet JS --}}
{{-- <script src="{{ asset('public/materialize/assets/js/maps-leaflet.js') }}"></script> --}}

<script src="{{ asset('public/materialize/assets/js/app-user-view-account.js') }}"></script>



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





