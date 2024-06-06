<!-- Modal: EditProfile / edit profile modal -->
<div class="modal fade" id="addMarkModalMAPS" data-bs-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-simple modal-edit-mark modal-dialog-scrollable modal-dialog-centered">
        {{-- <div class="modal-content p-3 p-md-5"> --}}
        <div class="modal-content p-3 p-md-1 pt-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Add New Mark From Maps</h3>
                    {{-- <p class="pt-1">Updating user details will receive a privacy audit.</p> --}}
                </div>
                {{-- <form id="editMarkForm" class="row g-4 needs-validation" onsubmit="return false" novalidate> --}}
                <form id="addMarkFormMAPS" class="row g-2 needs-validation" method="POST"
                    action="{{ route('m-mark-maps-data.post') }}" novalidate>
                    @csrf
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditLatitudeMAPS2" name="modalEditLatitudeMAPS2"
                                class="form-control" placeholder="latitude" value="" required />
                            <label for="modalEditLatitudeMAPS2">Latitude</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditLongitudeMAPS2" name="modalEditLongitudeMAPS2"
                                class="form-control" placeholder="longitude" value="" required />
                            <label for="modalEditLongitudeMAPS2">Logitude</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditMarkAddressMAPS2" name="modalEditMarkAddressMAPS2"
                                class="form-control" placeholder="address" value="" required />
                            <label for="modalEditMarkAddressMAPS2">Mark Address</label>
                        </div>
                    </div>
                    <div class="col-12 mb-3" id="cs_cb_maps">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="bsvalidationcheckboxMAPS2"
                                name="bsvalidationcheckboxMAPS2" required />
                            <label class="form-check-label" for="bsvalidationcheckboxMAPS2">Proceed to save</label>
                            <div class="feedback text-muted">You must agree before saving.</div>
                        </div>
                    </div>
                    <div class="modal-footer p-0 pl-4 pt-4 pb-4">
                        <div class="col-12 text-center">
                            <div class="d-flex flex-col justify-content-end">
                                <button class="modal-btn modal-mark-map-cancel-btn btn btn-primary me-2"
                                    id="cancel_modaladdMarkUserModalMAPS" data-bs-dismiss="modal"
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
