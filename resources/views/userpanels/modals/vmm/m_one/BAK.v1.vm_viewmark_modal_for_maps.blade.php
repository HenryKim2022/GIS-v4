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

    /* CSS */
    @-moz-document url-prefix() {
        .modal-body {
            overflow-x: hidden !important;
        }
    }
</style>

<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" style="overflow-x: hidden" id="viewMarkUserModal" data-bs-backdrop="false" tabindex="-1"
    style="z-index: 1104 !important;">
    {{-- <div class="modal-dialog modal-lg modal-simple modal-edit-user modal-dialog-scrollable modal-dialog-centered"> --}}
    <div
        class="modal-dialog modal-lg modal-simple modal-edit-user modal-dialog-scrollable modal-fullscreen modal-dialog-centered">
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">View Mark Information</h3>
                </div>
                <form id="viewMarkForm" class="row g-2">
                    <div class="col-6 col-md-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewMarkID" name="modalViewMarkID" class="form-control"
                                placeholder="latitude" readonly />
                            <label for="modalViewMarkID">Mark-ID</label>
                        </div>
                    </div>
                    <div class="col-6 col-md-5">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewLatitude" name="modalViewLatitude" class="form-control"
                                placeholder="latitude" readonly />
                            <label for="modalViewLatitude">Latitude</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewLongitude" name="modalViewLongitude" class="form-control"
                                placeholder="longitude" readonly />
                            <label for="modalViewLongitude">Logitude</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewInstitutionName" name="modalViewInstitutionName"
                                class="form-control" placeholder="e.g SMA N 1 JAKARTA" readonly />
                            <label for="modalViewInstitutionName">INSTITUTION-NAME</label>
                            {{-- <div class="invalid-feedback">Please enter the institution name.</div> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewInstitutionNPSN" name="modalViewInstitutionNPSN"
                                class="form-control" placeholder="e.g 000001" readonly />
                            <label for="modalViewInstitutionNPSN">NPSN</label>
                            {{-- <div class="invalid-feedback">Please enter the NPSN.</div> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select form-select-lg dt-add-lat" data-allow-clear="true"
                                    id="modalViewInstitutionCATID" name="modalViewInstitutionCATID"
                                    aria-describedby="modalViewInstitutionCATID" required>
                                    <option value="">Select Category</option>
                                </select>
                                <label for="modalViewInstitutionCATID">CATEGORY</label>
                                {{-- <div class="invalid-feedback">Please select a category.</div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalViewAddress" name="modalViewAddress"
                                class="form-control modal-edit-tax-id" placeholder="mark address" readonly />
                            <label for="modalViewAddress">Address</label>
                        </div>
                    </div>

                    {{-- <div class="col-12 col-lg-3 col-md-8">
                        <div class="input-group input-group-merge">
                            <span id="modalViewInstitutionLOGO" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="file" id="modalViewInstitutionLOGO" name="modalViewInstitutionLOGO"
                                    class="form-control dt-add-logo" placeholder="e.g LOGO.png" aria-label="LOGO"
                                    aria-describedby="modalViewInstitutionLOGO" />
                                <label for="modalViewInstitutionLOGO">LOGO</label>
                            </div>
                        </div>
                        <div class="logo-preview-container mt-2 mb-2 d-flex justify-content-center"
                            id="addLogoPreview" style="width: 100%">
                            <img src="public/img/noimage.png" alt="" class="logo-preview hover-image"
                                style="height: 96px; width: 96px;">
                        </div>
                        <script>
                            var addLogoPreview = document.getElementsByClassName('logo-view-preview-container');
                            var addLogoInput = document.getElementById('modalViewInstitutionLOGO');
                            addLogoInput.addEventListener('change', function() {
                                const file = this.files[0];
                                if (file && file.type.startsWith('image/')) {
                                    const img = document.createElement('img');
                                    img.src = URL.createObjectURL(file);
                                    img.classList.add('hover-image');

                                    img.onload = function() {
                                        for (var i = 0; i < addLogoPreview.length; i++) {
                                            addLogoPreview[i].querySelector('.logo-preview').src = img.src;
                                        }
                                    };
                                } else {
                                    for (var i = 0; i < addLogoPreview.length; i++) {
                                        addLogoPreview[i].querySelector('.logo-preview').src = 'public/img/noimage.png';
                                    }
                                }
                            });
                        </script>
                    </div> --}}



                    <div class="col-12 col-lg-3 col-md-12">
                        <div class="form-floating form-floating-outline form-control">
                            <div class="mb-2">
                                <label for="modalViewLogoPreview" disabled>Logo</label>
                                <div id="addLogoPreview" name="modalViewLogoPreview"
                                    class="logo-preview-container mb-2 d-flex justify-content-center">
                                    <!-- Initial Image -->
                                    <img src="{{ asset(env(key: 'APP_NOIMAGE')) }}" alt=""
                                        class="logo-preview hover-image" style="height: 96px; width: 96px;">
                                </div>
                            </div>
                        </div>
                        <script>
                            var addLogoPreview = document.getElementsByClassName('logo-view-preview-container');
                            // var addLogoInput = document.getElementById('modalViewInstitutionLOGO');
                            // addLogoInput.addEventListener('change', function() {
                            //     const file = this.files[0];
                            //     if (file && file.type.startsWith('image/')) {
                            //         const img = document.createElement('img');
                            //         img.src = URL.createObjectURL(file);
                            //         img.classList.add('hover-image');

                            //         img.onload = function() {
                            //             for (var i = 0; i < addLogoPreview.length; i++) {
                            //                 addLogoPreview[i].querySelector('.logo-preview').src = img.src;
                            //             }
                            //         };
                            //     } else {
                            //         for (var i = 0; i < addLogoPreview.length; i++) {
                            //             addLogoPreview[i].querySelector('.logo-preview').src = 'public/img/noimage.png';
                            //         }
                            //     }
                            // });
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

                    <div class="modal-footer p-0 pt-4 pb-4">
                        <div class="col-12 text-center">
                            <div class="d-flex flex-col justify-content-between">
                                <button class="modal-btn modal-view-mark-delete-btn btn btn-danger ms-2"
                                    id="delete_modalviewMarkUserModal">Delete</button>
                                <div class="d-flex flex-col justify-content-end">
                                    <button class="modal-btn modal-view-mark-cancel-btn btn btn-primary me-2"
                                        {{-- data-bs-dismiss="modal"  --}} id="close_modalviewMarkUserModal">Close</button>
                                    <button class="modal-btn modal-edit-mark-btn btn btn-success" type="submit"
                                        id="edit_modalviewMarkUserModal">Edit</button>
                                </div>
                            </div>


                        </div>
                    </div>


                </form>
            </div>



        </div>
    </div>
</div>




<script>
    const viewMarkUserModal = document.getElementById('viewMarkUserModal');
    viewMarkUserModal.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent autoscroll & prevent leaflet auto-exit fullscreen
        event.stopPropagation();
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
