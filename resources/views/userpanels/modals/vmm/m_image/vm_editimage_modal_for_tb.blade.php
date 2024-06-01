<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="editImageModalTB" data-bs-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-simple modal-add-cat modal-dialog-scrollable modal-dialog-centered">
        {{-- <div class="modal-content p-3 p-md-5"> --}}
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Edit Image</h3>
                    {{-- <p class="pt-1">Updating user details will receive a privacy audit.</p> --}}
                </div>
                {{-- <form id="editImageForm" class="row g-4 needs-validation" onsubmit="return false" novalidate> --}}
                <form id="editImageForm" class="row g-2 needs-validation" method="POST" action="/m-image/edit-img"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="col-12 col-md-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditImageID2" name="modalEditImageID2"
                                class="form-control" placeholder="image-id" readonly required />
                            <label for="modalEditImageID2">IMAGE-ID</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-10">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select form-select-lg dt-add-lat" data-allow-clear="true"
                                    id="modalEditInstitutionIDSelect2" name="modalEditInstitutionIDSelect2"
                                    aria-describedby="modalEditInstitutionIDSelect2" required>
                                    <option value="">Select Institution Name</option>
                                </select>
                                <label for="modalEditInstitutionIDSelect2">INSTITUTION-NAME</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditImageTitle2" name="modalEditImageTitle2"
                                data-allow-clear="true" class="form-control" placeholder="e.g Image 1" required />
                            <label for="modalEditImageTitle2">IMAGE-TITLE</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-12">
                        <div class="form-floating form-floating-outline">
                            <textarea class="form-control" id="modalEditImageDescb2" name="modalEditImageDescb2"
                                placeholder="e.g Here was the institution front area" style="height: 60px"></textarea>
                            <label for="modalEditImageDescb2">IMAGE-DESCRIPTION</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-merge">
                            <span id="modalEditImageSRC22" class="input-group-text"><i
                                    class="mdi mdi-briefcase-outline"></i></span>
                            <div class="form-floating form-floating-outline">
                                <input type="file" id="modalEditImageSRC2" name="modalEditImageSRC2"
                                    class="form-control dt-add-logo" placeholder="e.g IMAGE.png" aria-label="IMG SOURCE"
                                    aria-describedby="modalEditImageSRC22" />
                                <label for="modalEditImageSRC2">IMG-SOURCE</label>
                            </div>
                        </div>
                        <div class="logo-add-preview-container mt-2 mb-2 d-flex justify-content-center"
                            id="addLogoPreview" style="width: 100%">
                            <img src="public/img/noimage.png" alt="" class="logo-preview hover-image"
                                style="height: 96px; width: 96px;">
                        </div>
                        <script>
                            var addLogoPreview = document.getElementsByClassName('logo-add-preview-container');
                            var addLogoInput = document.getElementById('modalEditImageSRC2');
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
                                <button class="modal-btn modal-image-cancel-btn btn btn-primary me-2"
                                    data-bs-dismiss="modal" type="button">Cancel</button>
                                <button class="modal-btn modal-image-save-btn btn btn-success"
                                    type="submit">Save</button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>


        </div>
    </div>
</div>
