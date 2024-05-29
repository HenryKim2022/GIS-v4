<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="editInstituModalTB" data-bs-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-simple modal-add-cat modal-dialog-scrollable modal-dialog-centered">
        {{-- <div class="modal-content p-3 p-md-5"> --}}
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Edit Institution</h3>
                    {{-- <p class="pt-1">Updating user details will receive a privacy audit.</p> --}}
                </div>
                {{-- <form id="editInstituForm" class="row g-4 needs-validation" onsubmit="return false" novalidate> --}}
                <form id="editInstituForm" class="row g-2 needs-validation" method="POST" action="/m-inst/edit-inst"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="col-12 col-md-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditInstitutionID2" name="modalEditInstitutionID2"
                                class="form-control" placeholder="institution-id" readonly required />
                            <label for="modalEditInstitutionID2">INSTITUTION-ID</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditInstitutionName2" name="modalEditInstitutionName2"
                                class="form-control" placeholder="e.g SMA N 1 JAKARTA" required />
                            <label for="modalEditInstitutionName2">INSTITUTION-NAME</label>
                            {{-- <div class="invalid-feedback">Please enter the institution name.</div> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditInstitutionNPSN2" name="modalEditInstitutionNPSN2"
                                class="form-control" placeholder="e.g 000001" required />
                            <label for="modalEditInstitutionNPSN2">NPSN</label>
                            {{-- <div class="invalid-feedback">Please enter the npsn.</div> --}}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select form-select-lg dt-add-lat" data-allow-clear="true"
                                    id="modalEditInstitutionCATID2" name="modalEditInstitutionCATID2"
                                    aria-describedby="modalEditInstitutionCATID2" required>
                                    <option value="">Select Category</option>
                                    <!-- Add a default option or remove it if not needed -->
                                </select>
                                <label for="modalEditInstitutionCATID2">CATEGORY</label>
                                {{-- <div class="invalid-feedback">Please select a category.</div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-merge">
                            <span id="modalEditInstitutionLOGO22" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="file" id="modalEditInstitutionLOGO2" name="modalEditInstitutionLOGO2"
                                    class="form-control dt-add-logo" placeholder="e.g LOGO.png" aria-label="LOGO"
                                    aria-describedby="modalEditInstitutionLOGO22" />
                                <label for="modalEditInstitutionLOGO2">LOGO</label>
                            </div>
                        </div>
                        <div class="logo-add-preview-container mt-2 mb-2 d-flex justify-content-center"
                            id="addLogoPreview">
                            <img src="public/img/noimage.png" alt="" class="logo-preview hover-image"
                                style="height: 96px; width: 96px;">
                        </div>
                        <script>
                            var addLogoPreview = document.getElementsByClassName('logo-add-preview-container');
                            var addLogoInput = document.getElementById('modalEditInstitutionLOGO2');
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
                    <div class="col-12">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select form-select-lg dt-add-lat" data-allow-clear="true"
                                    id="modalEditInstitutionMARKID2" name="modalEditInstitutionMARKID2"
                                    aria-describedby="modalEditInstitutionMARKID2" required>
                                    <option value="">Select Mark</option>
                                </select>
                                <label for="modalEditInstitutionMARKID2">MARK-ADDRESS</label>
                                {{-- <div class="invalid-feedback">Please select a mark.</div> --}}
                            </div>
                        </div>
                    </div>



                    <div class="col-12 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="bsvalidationcheckbox2"
                                name="bsvalidationcheckbox2" checked="false" required />
                            <label class="form-check-label" for="bsvalidationcheckbox2">Proceed to save</label>
                            <div class="feedback text-muted">You must agree before saving.</div>
                        </div>
                    </div>
                    <div class="modal-footer p-0 pl-4 pt-4 pb-4">
                        <div class="col-12 text-center">
                            <div class="d-flex flex-col justify-content-end">
                                <button class="modal-btn modal-institu-cancel-btn btn btn-primary me-2"
                                    data-bs-dismiss="modal" type="button">Cancel</button>
                                <button class="modal-btn modal-institu-save-btn btn btn-success"
                                    type="submit">Save</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>
