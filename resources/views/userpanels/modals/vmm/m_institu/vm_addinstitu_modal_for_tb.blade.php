<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="addInstituModalTB" data-bs-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-simple modal-add-cat modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Add New Institution</h3>
                </div>
                <form id="addInstituForm" class="row g-2 needs-validation" method="POST" action="/m-inst/add-inst"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditInstitutionName1" name="modalEditInstitutionName1"
                                class="form-control" placeholder="e.g SMA N 1 JAKARTA" required />
                            <label for="modalEditInstitutionName1">INSTITUTION-NAME</label>
                            {{-- <div class="invalid-feedback">Please enter the institution name.</div> --}}
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditInstitutionNPSN1" name="modalEditInstitutionNPSN1"
                                class="form-control" placeholder="e.g 000001" required />
                            <label for="modalEditInstitutionNPSN1">NPSN</label>
                            {{-- <div class="invalid-feedback">Please enter the NPSN.</div> --}}
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select form-select-lg dt-add-lat" data-allow-clear="true"
                                    id="modalEditInstitutionCATID1" name="modalEditInstitutionCATID1"
                                    aria-describedby="modalEditInstitutionCATID1" required>
                                    <option value="">Select Category</option>
                                    <!-- Add a default option or remove it if not needed -->
                                </select>
                                <label for="modalEditInstitutionCATID1">CATEGORY</label>
                                {{-- <div class="invalid-feedback">Please select a category.</div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-merge">
                            <span id="modalEditInstitutionLOGO12" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="file" id="modalEditInstitutionLOGO1" name="modalEditInstitutionLOGO1"
                                    class="form-control dt-add-logo" placeholder="e.g LOGO.png" aria-label="LOGO"
                                    aria-describedby="modalEditInstitutionLOGO12" />
                                <label for="modalEditInstitutionLOGO1">LOGO</label>
                                {{-- <div class="invalid-feedback">Please select a logo.</div> --}}
                            </div>
                        </div>
                        <div class="logo-add-preview-container mt-2 mb-2 d-flex justify-content-center"
                            id="addLogoPreview" style="width: 100%">
                            <img src="public/img/noimage.png" alt="" class="logo-preview hover-image"
                                style="height: 96px; width: 96px;">
                        </div>
                        <script>
                            var addLogoPreview = document.getElementsByClassName('logo-add-preview-container');
                            var addLogoInput = document.getElementById('modalEditInstitutionLOGO1');
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
                                    id="modalEditInstitutionMARKID1" name="modalEditInstitutionMARKID1"
                                    aria-describedby="modalEditInstitutionMARKID1" required>
                                    <option value="">Select Mark</option>
                                </select>
                                <label for="modalEditInstitutionMARKID1">MARK-ADDRESS</label>
                                {{-- <div class="invalid-feedback">Please select a mark.</div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="d-flex flex-col justify-content-end">
                            <button class="modal-btn modal-institu-cancel-btn btn btn-primary me-2"
                                data-bs-dismiss="modal" type="button">Cancel</button>
                            <button class="modal-btn modal-institu-save-btn btn btn-success"
                                type="submit">Save</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
