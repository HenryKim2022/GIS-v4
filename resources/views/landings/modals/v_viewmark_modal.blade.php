<style>
    .form-floating.form-control {
        height: fit-content !important;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-family: 'Material Design Icons';
        font-size: 16px;
        font-weight: normal;
        content: '\e5cc';
    }

    .swiper-button-prev::after {
        content: '\e5cb';
    }
</style>


<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="viewMarkVisitorModal" data-bs-backdrop="false" tabindex="-1" style="z-index: 1104 !important;">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">View Mark Information</h3>
                </div>
                <form id="viewMarkForm" class="row g-2">
                    <div class="col-6 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewLatitude" name="modalViewLatitude" class="form-control"
                                placeholder="latitude" readonly />
                            <label for="modalViewLatitude">Latitude</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewLongitude" name="modalViewLongitude" class="form-control"
                                placeholder="longitude" readonly />
                            <label for="modalViewLongitude">Logitude</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9 col-md-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewInstitutionName" name="modalViewInstitutionName"
                                class="form-control" placeholder="institution name" readonly />
                            <label for="modalViewInstitutionName">Institution Name</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 col-md-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewNPSN" name="modalViewNPSN" class="form-control"
                                placeholder="npsn" readonly />
                            <label for="modalViewNPSN">NPSN</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewAddress" name="modalViewAddress"
                                class="form-control modal-edit-tax-id" placeholder="institution address" readonly />
                            <label for="modalViewAddress">Address</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 col-md-12">
                        <div class="form-floating form-floating-outline form-control">
                            <div class="mb-2">
                                <label for="modalViewLogoPreview" disabled>Logo</label>
                                <div id="modalViewLogoPreview" name="modalViewLogoPreview"
                                    class="logo-view-preview-container mb-2 d-flex justify-content-center">
                                    <!-- Initial Image -->
                                    <img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt=""
                                        class="logo-preview hover-image" style="height: 96px; width: 96px;">
                                </div>
                            </div>
                        </div>

                        <script>
                            var modalViewLogoPreview = document.getElementById('modalViewLogoPreview');

                            // Add magnifying icon on hover
                            modalViewLogoPreview.addEventListener('mouseenter', function() {
                                var zoomIcon = document.createElement('i');
                                zoomIcon.classList.add('mdi', 'mdi-magnify', 'magnify-icon');
                                zoomIcon.style.position = 'absolute';
                                zoomIcon.style.top = '50%';
                                zoomIcon.style.left = '50%';
                                zoomIcon.style.transform = 'translate(-50%, -26%)';
                                zoomIcon.style.display = 'flex';
                                zoomIcon.style.justifyContent = 'center';
                                zoomIcon.style.alignItems = 'center';
                                zoomIcon.style.fontSize = '24px';
                                zoomIcon.style.color = 'white';
                                zoomIcon.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
                                zoomIcon.style.borderRadius = '50%';
                                zoomIcon.style.padding = '8px';
                                zoomIcon.style.zIndex = '1';
                                modalViewLogoPreview.appendChild(zoomIcon);
                            });

                            // Remove magnifying icon on hover out
                            modalViewLogoPreview.addEventListener('mouseleave', function() {
                                var zoomIcon = modalViewLogoPreview.querySelector('.magnify-icon');
                                if (zoomIcon) {
                                    zoomIcon.remove();
                                }
                            });

                            // Add click event listener to open the image in a Bootstrap 5 image modal
                            modalViewLogoPreview.addEventListener('click', function() {
                                var modalViewLogoPopUp = new bootstrap.Modal(document.getElementById('modalViewLogoPopUp'));
                                var modalViewZoomImageContent = document.getElementById('modalViewZoomImageContent');
                                modalViewZoomImageContent.src = modalViewLogoPreview.querySelector('.logo-preview').src;
                                modalViewLogoPopUp.show();
                            });
                        </script>
                    </div>

                    <div class="col-12 col-lg-9 col-md-12">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-control form-floating-outline mb-2">
                                {{-- <div class="form-control">

                                </div> --}}
                                <div for="modalViewImages" class="mb-2" id="modalViewImages" name="modalViewImages"
                                    disabled>Images</div>
                                <div class="form-floating form-floating-outline mb-2">
                                    <div class="swiper-container overflow-hidden">
                                        <div class="swiper-wrapper" id="swiperImagesContainerView">
                                            <!-- Slides will be dynamically generated here -->
                                        </div>

                                        <!-- Navigation buttons -->
                                        <div class="swiper-nav swiper-button-next swiper-images-btn-next">
                                            <i class="mdi mdi-chevron-right"></i>
                                        </div>
                                        <div class="swiper-nav swiper-button-prev swiper-images-btn-prev">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <script>
                            var modalViewImagesPreview = document.getElementById('swiperImagesContainerView');
                            // Add event listeners to dynamically generated images
                            document.getElementById('swiperImagesContainerView').addEventListener('click', function(event) {
                                // var modalImagesPreview = document.getElementById('swiperImagesContainerView');
                                var modalViewImage = new bootstrap.Modal(document.getElementById('modalViewLogoPopUp'));
                                var modalViewZoomImageContent = document.getElementById('modalViewZoomImageContent');

                                var clickedImage = event.target.closest('img');
                                if (clickedImage) {
                                    var clickedImageUrl = clickedImage.src;
                                    modalViewZoomImageContent.src = clickedImageUrl;
                                    modalViewImage.show();
                                }
                            });

                            // Get the swiperNavs
                            var swiperNavs = document.getElementById('swiperImagesContainerView');
                            swiperNavs.addEventListener('change', function(event) {
                                event.stopPropagation(); // Stop the event from bubbling up
                            });
                        </script>
                    </div>



                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewLastUpdate" name="modalViewLastUpdate"
                                class="form-control" placeholder="last update" readonly />
                            <label for="modalViewLastUpdate">Last update</label>
                        </div>
                    </div>

                    <div class="modal-footer p-0 pl-4 pt-4 pb-4">
                        <div class="col-12 text-center">
                            <div class="d-flex flex-col justify-content-end">
                                <button class="modal-btn modal-view-mark-cancel-btn btn btn-primary"
                                    {{-- data-bs-dismiss="modal"  --}}
                                    id="close_modalviewMarkVisitorModal">Close</button>

                            </div>
                        </div>
                    </div>


                </form>
            </div>



        </div>
    </div>
</div>

<div class="modal fade" id="modalViewLogoPopUp" data-bs-backdrop="false" tabindex="-1"
    style="z-index: 1105 !important">
    <div class="modal-dialog modal-md modal-simple modal-edit-user modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body py-3 py-md-0 d-flex align-content-around justify-content-around">
                <button type="button" class="modal-btn btn-close" aria-label="Close" data-bs-dismiss="modal"
                    id="close_modalViewLogoPopUp"></button>
                <img id="modalViewZoomImageContent" class="align-self-center col-12 col-lg-7 col-md-12"
                    alt="Modal Image">
            </div>
        </div>
    </div>
</div>




<script>
    const viewMarkVisitorModal = document.getElementById('viewMarkVisitorModal');
    viewMarkVisitorModal.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent autoscroll & prevent leaflet auto-exit fullscreen
    });


    // Get the modal inputs
    var modalInputs = document.querySelectorAll('.form-floating');
    modalInputs.forEach(function(input) {
        input.addEventListener('click', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
        });

        input.addEventListener('change', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
        });
    });

    // Get the modal buttons
    var modalButtons = document.querySelectorAll('.modal-btn');
    modalButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
            event.preventDefault();
        });

        button.addEventListener('change', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
        });
    });
</script>
