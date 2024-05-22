<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="editMarkModal" data-bs-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user modal-dialog-scrollable modal-dialog-centered">
        {{-- <div class="modal-content p-3 p-md-5"> --}}
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Edit Mark Information</h3>
                    {{-- <p class="pt-1">Updating user details will receive a privacy audit.</p> --}}
                </div>
                {{-- <form id="editMarkForm" class="row g-4 needs-validation" onsubmit="return false" novalidate> --}}
                {{-- <form id="editMarkForm" class="row g-4 needs-validation" onsubmit="return false" novalidate> --}}
                <form id="editMarkForm" class="row g-2 needs-validation" novalidate>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditLatitude" name="modalEditLatitude" class="form-control"
                                placeholder="latitude" required />
                            <label for="modalEditLatitude">Latitude</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditLongitude" name="modalEditLongitude" class="form-control"
                                placeholder="longitude" required />
                            <label for="modalEditLongitude">Logitude</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditInstitutionName" name="modalEditInstitutionName"
                                class="form-control" placeholder="institution name" required />
                            <label for="modalEditInstitutionName">Institution Name</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditNPSN" name="modalEditNPSN" class="form-control"
                                placeholder="npsn" required />
                            <label for="modalEditNPSN">NPSN</label>
                        </div>
                    </div>
                    {{-- <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select"
                                aria-label="Default select example">
                                <option selected>Status</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                                <option value="3">Suspended</option>
                            </select>
                            <label for="modalEditUserStatus">Status</label>
                        </div>
                    </div> --}}
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditAddress" name="modalEditAddress"
                                class="form-control modal-edit-tax-id" placeholder="institution address" required />
                            <label for="modalEditAddress">Address</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating form-floating-outline form-control">
                            <div class="mb-4">
                                <label for="modalEditLogo" class="mb-2" disabled>Logo</label>
                                <input type="file" class="form-control" id="modalEditLogo" name="modalEditLogo" />
                            </div>
                            <div class="logo-edit-preview-container mb-2 d-flex justify-content-center"
                                id="modalEditLogoPreview">
                                {{-- <img src="public/img/noimage.png" alt="" class="logo-preview" style="height: 96px; width: 96px;"> --}}
                            </div>
                        </div>

                        <script>
                            var modalEditLogoPreview = document.getElementsByClassName('logo-edit-preview-container');
                            var modalEditLogoInput = document.getElementById('modalEditLogo');
                            var modalEditZoomImageContent = document.getElementById('modalEditZoomImageContent');

                            modalEditLogoInput.addEventListener('change', function() {
                                const file = this.files[0];
                                if (file && file.type.startsWith('image/')) {
                                    const img = document.createElement('img');
                                    img.src = URL.createObjectURL(file);

                                    img.onload = function() {
                                        for (var i = 0; i < modalEditLogoPreview.length; i++) {
                                            modalEditLogoPreview[i].querySelector('.logo-preview').src = img.src;
                                        }
                                    };
                                }
                            });

                            for (var i = 0; i < modalEditLogoPreview.length; i++) {
                                modalEditLogoPreview[i].addEventListener('click', function() {
                                    var modalEditZoomImageContent = document.getElementById('modalEditZoomImageContent');
                                    modalEditZoomImageContent.src = this.querySelector('.logo-preview').src;
                                    var modalImage = new bootstrap.Modal(document.getElementById('modalEditLogoPopUp'));
                                    modalImage.show();
                                });
                            }
                        </script>


                        {{-- <script>
                            var modalLogoPreview = document.getElementById('modalLogoPreview');
                            var modalEditLogoInput = document.getElementById('modalEditImages');

                            // Add change event listener to the file input
                            modalEditLogoInput.addEventListener('change', function() {
                                // Get the selected file
                                const file = modalEditLogoInput.files[0];

                                // Check if the file is an image
                                if (file && file.type.startsWith('image/')) {
                                    // Create a new image element
                                    const img = document.createElement('img');

                                    // Set the image source to the selected file
                                    img.src = URL.createObjectURL(file);

                                    // Wait for the image to load
                                    img.onload = function() {
                                        // Set the image source to the logo-preview element
                                        modalLogoPreview.querySelector('.logo-preview').src = img.src;
                                    };
                                }
                            });

                            // Add click event listener to open the image in a Bootstrap 5 image modal
                            modalLogoPreview.addEventListener('click', function() {
                                var modalImage = new bootstrap.Modal(document.getElementById('modalEditLogoPopUp'));
                                var modalEditZoomImageContent = document.getElementById('modalEditZoomImageContent');
                                modalEditZoomImageContent.src = modalLogoPreview.querySelector('.logo-preview').src;
                                modalImage.show();
                            });
                        </script> --}}
                    </div>


                    {{-- Working Validation Example: --}}
                    {{-- <div class="col-12 mb-2">
                        <div class="form-floating form-floating-outline form-control mb-2">
                            <div class="mb-2">
                                <label id="modalEditImage" name="modalEditImage" for="modalEditImagesPreview"
                                    disabled>Images</label>
                                <input type="file" class="form-control" id="modalEditImages"
                                    name="modalEditImages" />
                            </div>
                            <div class="mb-2">
                                <label id="modalEditImage" name="modalEditImage" for="modalEditImagesPreview"
                                    disabled>Images</label>
                            </div>
                        </div>
                    </div> --}}


                    {{-- All form field Validation in modal, Not Working after modified it like this : --}}
                    <div class="col-12 mb-2">
                        <div class="form-floating form-floating-outline form-control mb-2">
                            <div>
                                <label id="modalEditImage" name="modalEditImage" for="modalEditImagesPreview"
                                    class="mb-2" disabled>Images</label>

                            </div>
                            <div class="card mb-2">
                                {{-- <h5 class="card-header">Multiple</h5> --}}
                                <div class="card-body dropzone">
                                    {{-- <form action="/uploads/institution/images" class="needsclick" id="dropzone-multi"> --}}
                                    {{-- </form> --}}
                                    <div class="needsclick" id="dropzone-multi">
                                        <div class="dz-message needsclick text-sm">
                                            Drop files here or click to upload
                                            <span class="note needsclick text-sm">(This is just a demo dropzone.
                                                Selected files are
                                                <span class="fw-medium">not</span> actually uploaded.)</span>
                                        </div>
                                        <div class="fallback">
                                            <input id="modalEditImagesPreview" name="modalEditImagesPreview" type="file" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <style>
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


                        <script>
                            var thumbnails = document.querySelectorAll('[data-dz-thumbnail]');
                            thumbnails.forEach(function(thumbnail) {
                                thumbnail.addEventListener('click', function(event) {
                                    var modalEditImage = new bootstrap.Modal(document.getElementById('modalEditLogoPopUp'));
                                    var modalEditZoomImageContent = document.getElementById('modalEditZoomImageContent');

                                    var clickedImage = event.target.closest('img');
                                    if (clickedImage) {
                                        var clickedImageUrl = clickedImage.src;
                                        modalEditZoomImageContent.src = clickedImageUrl;
                                        modalEditImage.show();
                                    }

                                    setLogo(modalEditImage, modalEditZoomImageContent);
                                });
                            });


                            // // Add event listeners to dynamically generated images
                            // document.querySelectorAll('img').forEach(function(thumbnail) {
                            //     thumbnail.addEventListener('click', function(event) {
                            //         var modalEditImage = new bootstrap.Modal(document.getElementById('modalEditLogoPopUp'));
                            //         var modalEditZoomImageContent = document.getElementById('modalEditZoomImageContent');

                            //         var clickedImage = event.target.closest('img');
                            //         if (clickedImage) {
                            //             var clickedImageUrl = clickedImage.src;
                            //             modalEditZoomImageContent.src = clickedImageUrl;
                            //             modalEditImage.show();

                            //             setLogo(modalEditImage, modalEditZoomImageContent);
                            //         }
                            //     });

                            // });
                        </script>
                    </div>
                    {{-- <div class="col-12 col-md-6">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">US (+1)</span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="modalEditUserPhone" name="modalEditUserPhone"
                                    class="form-control phone-number-mask" placeholder="202 555 0111" required />
                                <label for="modalEditUserPhone">Phone Number</label>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select id="modalEditUserLanguage" name="modalEditUserLanguage" class="select2 form-select"
                                multiple>
                                <option value="">Select</option>
                                <option value="english" selected>English</option>
                                <option value="spanish">Spanish</option>
                                <option value="french">French</option>
                                <option value="german">German</option>
                                <option value="dutch">Dutch</option>
                                <option value="hebrew">Hebrew</option>
                                <option value="sanskrit">Sanskrit</option>
                                <option value="hindi">Hindi</option>
                            </select>
                            <label for="modalEditUserLanguage">Language</label>
                        </div>
                    </div> --}}
                    {{-- <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select"
                                data-allow-clear="true">
                                <option value="">Select</option>
                                <option value="Australia">Australia</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Canada">Canada</option>
                                <option value="China">China</option>
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Japan">Japan</option>
                                <option value="Korea">Korea, Republic of</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Russia">Russian Federation</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                            </select>
                            <label for="modalEditUserCountry">Country</label>
                        </div>
                    </div> --}}


                    <div class="col-12 mb-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditLastUpdate" name="modalEditLastUpdate"
                                class="form-control" placeholder="last update" disabled />
                            <label for="modalEditLastUpdate">Last update</label>
                        </div>
                    </div>


                    <div class="col-12 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="bs-validation-checkbox" required />
                            <label class="form-check-label" for="bs-validation-checkbox">Proceed to save</label>
                            <div class="invalid-feedback">You must agree before saving.</div>
                        </div>
                    </div>

                    <div class="modal-footer p-0 pl-4 pt-4 pb-4">
                        <div class="col-12 text-center">
                            <div class="d-flex flex-col justify-content-end">
                                <button class="modal-btn modal-mark-cancel-btn btn btn-primary me-2" data-bs-dismiss="modal"
                                    onclick="closeModal()">Cancel</button>
                                <button class="modal-btn modal-mark-remove-btn btn btn-secondary me-2"
                                    onclick="closeModal()">Remove</button>
                                <button class="modal-btn modal-mark-save-btn btn btn-success" type="submit"
                                    onclick="closeModal()">Save</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>



        </div>
    </div>
</div>

<div class="modal fade" id="modalEditLogoPopUp" data-bs-backdrop="false" tabindex="-1"
    style="z-index: 1105 !important">
    <div class="modal-dialog modal-sm modal-simple modal-edit-user modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body py-3 py-md-0 d-flex align-content-around justify-content-around">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <img id="modalEditZoomImageContent" class="align-self-center col-12 col-lg-6 col-md-12"
                    alt="Modal Image">
            </div>
        </div>
    </div>
</div>




<script>
    const editMarkModal = document.getElementById('editMarkModal');
    editMarkModal.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default scrolling behavior
        // event.stopPropagation();
    });

    // Get the checkbox element
    var checkbox = document.querySelector('.form-check');
    checkbox.addEventListener('click', function(event) {
        event.stopPropagation(); // Stop the event from bubbling up
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

    // Get the modal labels
    var modalLabels = document.querySelectorAll('form label');
    modalLabels.forEach(function(label) {
        label.addEventListener('click', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
        });
    });

    // Get the modal buttons
    var modalButtons = document.querySelectorAll('.modal-btn');
    modalButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
            // event.preventDefault();
        });

        button.addEventListener('change', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
        });
    });


    // Get the modal forms
    var modalForms = document.querySelectorAll('form');
    modalForms.forEach(function(form) {
        form.addEventListener('click', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
        });

        form.addEventListener('change', function(event) {
            event.stopPropagation(); // Stop the event from bubbling up
        });
    });

</script>


{{--
<script>
    // Get the form element
    const form = document.getElementById('editMarkForm');

    // Add a submit event listener to the form
    form.addEventListener('submit', function(event) {
        // Prevent the form from submitting normally
        event.preventDefault();

        // Perform custom validation on the form fields
        const formFields = form.elements;
        let isValid = true;

        for (let i = 0; i < formFields.length; i++) {
            const field = formFields[i];

            // Check if the field is required and empty
            if (field.required && !field.value) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        }

        // If the form is valid, submit it using JavaScript
        if (isValid) {
            // Submit the form using JavaScript
            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();
            // xhr.open('POST', '/submit-form', true);  <---  CHANGE LATER !!!
            xhr.send(formData);
        }
    });
</script> --}}


