<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="editMarkModalMAPS" data-bs-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-simple modal-edit-mark modal-dialog-scrollable modal-fullscreen modal-dialog-centered">
        {{-- <div class="modal-content p-3 p-md-5"> --}}
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Edit Mark Information From Maps</h3>
                    {{-- <p class="pt-1">Updating user details will receive a privacy audit.</p> --}}
                </div>
                {{-- <form id="editMarkForm" class="row g-4 needs-validation" onsubmit="return false" novalidate> --}}
                <form id="editMarkFormMAPS" class="row g-2 needs-validation" method="POST"
                    action="{{ route('m-mark-maps-data.edit') }}" novalidate>
                    @csrf
                    <div class="col-12 col-md-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditMarkID2MAPS" name="modalEditMarkID2MAPS"
                                class="form-control" placeholder="mark-id" value="" readonly required />
                            <label for="modalEditMarkID2MAPS">Mark-ID</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditLatitudeMAPS" name="modalEditLatitudeMAPS"
                                class="form-control" placeholder="latitude" value="" required />
                            <label for="modalEditLatitudeMAPS">Latitude</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditLongitudeMAPS" name="modalEditLongitudeMAPS"
                                class="form-control" placeholder="longitude" value="" required />
                            <label for="modalEditLongitudeMAPS">Logitude</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditInstitutionNameMAPS" name="modalEditInstitutionNameMAPS"
                                class="form-control" placeholder="e.g SMA N 1 JAKARTA" required />
                            <label for="modalEditInstitutionNameMAPS">INSTITUTION-NAME</label>
                            {{-- <div class="invalid-feedback">Please enter the institution name.</div> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditInstitutionNPSNMAPS" name="modalEditInstitutionNPSNMAPS"
                                class="form-control" placeholder="e.g 000001" required />
                            <label for="modalEditInstitutionNPSNMAPS">NPSN</label>
                            {{-- <div class="invalid-feedback">Please enter the NPSN.</div> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select form-select-lg dt-add-lat" data-allow-clear="true"
                                    id="modalEditInstitutionCATIDMAPS" name="modalEditInstitutionCATIDMAPS"
                                    aria-describedby="modalEditInstitutionCATIDMAPS" required>
                                    <option value="">Select Category</option>
                                </select>
                                <label for="modalEditInstitutionCATIDMAPS">CATEGORY</label>
                                {{-- <div class="invalid-feedback">Please select a category.</div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditAddressMAPS" name="modalEditAddressMAPS"
                                class="form-control modal-edit-tax-id" placeholder="mark address" required />
                            <label for="modalEditAddressMAPS">Address</label>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="input-group input-group-merge">
                            <span id="modalEditInstitutionLOGOMAPSSPAN" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="file" id="modalEditInstitutionLOGOMAPS" name="modalEditInstitutionLOGOMAPS"
                                    class="form-control dt-add-logo" placeholder="e.g LOGO.png" aria-label="LOGO"
                                    aria-describedby="modalEditInstitutionLOGOMAPS" />
                                <label for="modalEditInstitutionLOGOMAPS">LOGO</label>
                            </div>
                        </div>
                        <div class="logo-preview-container mt-2 mb-2 d-flex justify-content-center"
                            id="addLogoPreview" style="width: 100%">
                            <img src="public/img/noimage.png" alt="" class="logo-preview hover-image"
                                style="height: 96px; width: 96px;">
                        </div>
                        <script>
                            var addLogoPreview = document.getElementsByClassName('logo-preview-container');
                            var addLogoInput = document.getElementById('modalEditInstitutionLOGOMAPS');
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
                    </div>
                    <div class="col-12 col-lg-12 col-md-12">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-control form-floating-outline mb-2">
                                <div for="modalViewImagesEditMAPS" class="mb-2" id="modalViewImagesEditMAPS" name="modalViewImagesEditMAPS"
                                    disabled>Images</div>
                                <div class="form-floating form-floating-outline mb-2">
                                    <div class="swiper-container overflow-hidden">
                                        <div class="swiper-wrapper" id="swiperImagesContainerViewEditMAPS">
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
                            var swiperNavs = document.getElementById('swiperImagesContainerViewEditMAPS');
                            swiperNavs.addEventListener('change', function(event) {
                                event.stopPropagation(); // Stop the event from bubbling up
                            });
                        </script>
                    </div>




                    <div class="col-12 mb-3" id="cs_cb_maps">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="bsvalidationcheckboxMAPS"
                                name="bsvalidationcheckboxMAPS" required />
                            <label class="form-check-label" for="bsvalidationcheckboxMAPS">Proceed to save</label>
                            <div class="feedback text-muted">You must agree before saving.</div>
                        </div>
                    </div>
                    <div class="modal-footer p-0 pl-4 pt-4 pb-4">
                        <div class="col-12 text-center">
                            <div class="d-flex flex-col justify-content-end">
                                <button class="modal-btn modal-mark-map-cancel-btn btn btn-primary me-2"
                                    id="cancel_modalviewMarkUserModalMAPS" data-bs-dismiss="modal"
                                    type="button">Cancel</button>
                                <button class="modal-btn modal-mark-map-save-btn btn btn-success"
                                    type="submit">Save</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>
